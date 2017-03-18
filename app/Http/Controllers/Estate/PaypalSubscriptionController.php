<?php

namespace App\Http\Controllers\Estate;

use App\AppPaypal;
use App\CompanyApp;
use App\PayPalRest;
use App\ProductPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Exception\PayPalConnectionException;

class PaypalSubscriptionController extends Controller
{

    /**
     * @param api
     * Holds api credentials and config
     */
    protected $api;

    /**
     * PaypalSubscriptionController constructor.
     */
    public function __construct()
    {
        $this->middleware('company.admin');

        //paypal rest api init
        $paypalRest = new PayPalRest();

        //api
        $this->api = $paypalRest->getApi();

    }

    /**
     * PaypalSubscriptionController constructor.
     */
    public function create($id)
    {
        //app
        $app = CompanyApp::find($id);

        //check app
        if ($app == null)
            abort(404);

        //authorize
        $this->authorize('view', $app);

        //company
        $company = $app->company;

        //plans
        $plans = $app->product->plans()->where('status', 1)->get();

        return view('v1.estates.subscription.paypal')
            ->with('company', $company)
            ->with('plans', $plans)
            ->with('app', $app);
    }

    /**
     * PaypalSubscriptionController plan.
     */
    public function plan(Request $request)
    {
        $properties = $request->input('properties');

        $plan = ProductPlan::where('minimum', '<=', $properties)->where('limit', '>=', $properties)->first();

        if ($plan != null) {
            //total amount
            $totalAmount = doubleval(ceil($plan->price * $properties));

            return response()->json(['status' => 1, 'plan' => $plan, 'totalAmount' => $totalAmount]);
        }
        return response()->json(['status' => 0, 'message' => 'Sorry, we currently do not cover a plan to suit your needs.']);

    }

    /**
     * PaypalSubscriptionController store.
     */
    public function store(Request $request)
    {

        $z = 0;
        $_success = array();
        $_error = array();

        $this->validate($request, [
            'properties' => 'required|integer',
            'plan' => 'required|integer|exists:product_plans,id',
            '_id' => 'required|integer|exists:company_apps,id',
        ], [
            'plan.integer' => 'Select a valid plan.'
        ]);

        $success = route('estate.subscribe.paypal.pay', ['approved' => true]);
        $cancel = route('estate.subscribe.paypal.pay', ['approved' => false]);

        //properties
        $properties = $request->input('properties');
        $price = $request->input('price');
        $features = $request->input('feature');

        //plan
        $plan_id = $request->input('plan');
        $plan = ProductPlan::find($plan_id);

        //total
        $total = ceil($plan->price * $properties);

        //summary
        $summary = "Payment for one month subscription for " . $properties . " properties.";

        $when = Carbon::now();

        $payer = new Payer();
        $details = new Details();
        $amount = new Amount();
        $transaction = new Transaction();
        $payment = new Payment();
        $redirectUrls = new RedirectUrls();

        //Payer
        $payer->setPaymentMethod('paypal');

        //Details
        $details
            ->setTax('0.00')
            ->setSubtotal($total);

        //Amount
        $amount->setCurrency('USD')
            ->setTotal($total)
            ->setDetails($details);

        //Transaction
        $transaction->setAmount($amount)
            ->setDescription($summary)
            ->setInvoiceNumber(uniqid());

        //Payment
        $payment->setIntent('authorize')
            ->setPayer($payer)
            ->setTransactions([$transaction]);

        //Redirect Urls
        $redirectUrls->setReturnUrl($success)
            ->setCancelUrl($cancel);

        $payment->setRedirectUrls($redirectUrls);

        try {
            //create payment
            $payment->create($this->api);

            //Generate and store hash
            $hash = bcrypt($payment->getId());
            $request->session()->put('paypal_hash', $hash);

            //Prepare and execute transaction storage
            $store = new AppPaypal();
            $store->company_app_id = $request->input('_id');
            $store->payment_id = $payment->getId();
            $store->payment_plan = $plan->id;
            $store->quantity = $properties;
            $store->payment_hash = $hash;
            $store->trial_ends_at = Carbon::now()->addDays($plan->trial_days);

            //save
            $store->user_id = (Auth::user()->id);
            $store->save();

        } catch (PayPalConnectionException $e) {
            Storage::append(
                'logs/paypal.log',
                [
                    'message' => $e->getMessage(),
                    'data' => $e->getData(),
                ]
            );

            //errors
            $_error = array_add($_error, $z++, 'Whoops! Some error occured.');
            $_error = array_add($_error, $z++, 'Subscription failed.');
            $_error = array_add($_error, $z++, $e->getMessage());

//            return redirect()->route('estate.subscribe.paypal.error')
            return redirect()->back()
                ->withInput()
                ->with('bulk_error', $_error);
        }

//        foreach ($payment->getLinks() as $link) {
//            if ($link->getRel() == 'approval_url') {
//                $redirectUrl = $link->getHref();
//            }
//        }

        // ### Get redirect url
        // The API response provides the url that you must redirect
        // the buyer to. Retrieve the url from the $payment->getApprovalLink()
        // method
        $redirectUrl = $payment->getApprovalLink();

        return redirect()->to($redirectUrl);
    }

    /**
     * PaypalSubscriptionController pay.
     */
    public function pay(Request $request)
    {
        //approved
        $approved = $request->approved;

        //paypal hash
        $hash = $request->session()->has('paypal_hash') ? $request->session()->get('paypal_hash') : null;

        if ($approved) {

            //get payer id
            $payerId = $request->PayerID;

            //get payment id from database
            $paymentId = AppPaypal::where('payment_hash', $hash)->first();
            $plan = ProductPlan::find($paymentId->payment_plan);

            //get the paypal payment
            $payment = Payment::get($paymentId->payment_id, $this->api);

            //payment execution
            $execution = new PaymentExecution();
            $execution->setPayerId($payerId);

            //execute paypal payment (charge)
            $payment->execute($execution, $this->api);

            //update transaction
            $updateTransaction = $paymentId;
            $updateTransaction->completed = 1;
            $updateTransaction->ends_at = Carbon::now()->addDays($plan->trial_days)->addMonths($plan->duration);
            $updateTransaction->save();

            //set app as subscribed
            $setSubscribed = $updateTransaction->app;
            $setSubscribed->subscribed = 1;

            if ($setSubscribed->save()) {

                //unset paypal hash
                $request->session()->forget('paypal_hash');

                //redirect to complete
                return redirect()
                    ->route('estate.subscribe.paypal.complete', ['id' => $setSubscribed->id])
                    ->with('success', 'Your app has now been subscribed.');
            }

        } else {

            //get payment id from database
            $paymentId = AppPaypal::where('payment_hash', $hash)->first();
            $app = $paymentId->app;

            return redirect()->route('estate.subscribe.paypal.cancel', ['app' => $app->id])
                ->with('success', 'Subscription cancelled.');
        }
    }

    /**
     * PaypalSubscriptionController complete.
     */
    public function complete($id)
    {
        //app
        $app = CompanyApp::find($id);

        //check app
        if ($app == null)
            abort(404);

        //authorize
        $this->authorize('view', $app);

        //company
        $company = $app->company;

        //product
        $product = $app->product;

        //plan
        $plan = $app->paypalSubscription;

        return view('v1.estates.subscription.complete')
            ->with('company', $company)
            ->with('product', $product)
            ->with('plan', $plan)
            ->with('app', $app);

    }

    /**
     * PaypalSubscriptionController error.
     */
    public function error()
    {
        return view('paypal.error');
    }

    /**
     * PaypalSubscriptionController cancel.
     */
    public function cancel()
    {
        return view('v1.paypal.cancel');
    }
}

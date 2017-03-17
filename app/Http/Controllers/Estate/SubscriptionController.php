<?php

namespace App\Http\Controllers\Estate;

use App\CompanyApp;
use App\ProductPlan;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{

    protected $user;

    /**
     * SubscriptionController constructor.
     */
    public function __construct()
    {
        $this->middleware('company.app.admin');
    }

    public function create($id)
    {
        //client token
//        $clientToken = ClientToken::generate();
        $clientToken = 'token';

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

        return view('v1.estates.subscription.stripe')
            ->with('clientToken', $clientToken)
            ->with('company', $company)
            ->with('plans', $plans)
            ->with('app', $app);
    }

    public function subscribe(Request $request)
    {
        $user = Auth::user();

        $card = $request->input('card-number');
        $expiry_month = $request->input('card-expiry-month');
        $expiry_year = $request->input('card-expiry-year');
        $cvc = $request->input('card-cvc');
        $email = $user->email;
        $id = $request->input('_id');
        $plan = $request->input('plan');
        $plan = ProductPlan::find($plan);

        $token = $request->input('stripeToken');

        $app = CompanyApp::find($id);

        if ($app->newSubscription($plan->title, $plan->title)->create($token, ['email' => $email,])) {
            //redirect with success
            return redirect()->back()
                ->with('error', $app->company->title . ' is now subscribed.');
        }

        //redirect with error
        return redirect()->back()
            ->with('error', 'Failed adding subscription');
    }


}

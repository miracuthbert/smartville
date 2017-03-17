<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\ProductPlan;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Stripe\Plan;
use Stripe\Stripe;

class ProductPlanController extends Controller
{

    /**
     * ProductPlanController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Get a validator for an incoming product plan create/update request.
     *
     * @param  array $data
     * @return \Illuminate\Support\Facades\Validator
     */
    protected function validator(array $data, $type)
    {
        //'title' => 'required|unique:product_plans,title|min:3|max:255',

        if ($type === "update") {
            return $validate = Validator::make($data, [
                '_plan' => 'required|integer|exists:product_plans,id',
                'title' => 'required|min:3|max:255',
                'summary' => 'required|min:10|max:255',
                'description' => 'required|max:1500',
                'description' => 'required|max:1500',
                'price' => 'required|numeric',
                'limit' => 'required|integer',
                'trial' => 'required|boolean',
                'trial_days' => 'required|integer',
                'status' => 'required|boolean',
            ]);
        } else {
            return $validate = Validator::make($data, [
                '_app' => 'required|integer|exists:products,id',
                'title' => 'required|min:3|max:255',
                'summary' => 'required|min:10|max:255',
                'description' => 'required|max:1500',
                'price' => 'required|numeric',
                'limit' => 'required|integer',
                'trial' => 'required | boolean',
                'trial_days' => 'required | integer',
                'status' => 'required | boolean',
            ]);
        }
    }

    /**
     * ProductPlanController create.
     */
    public function create($id)
    {
        $app = Product::find($id);

        return view('v1.admin.plans.create')
            ->with('app', $app);
    }

    /**
     * ProductPlanController view.
     */
    public function view($id)
    {
        $plan = ProductPlan::find($id);

        return view('v1.admin.plans.view')
            ->with('plan', $plan);
    }

    /**
     * ProductPlanController features.
     */
    public function features($id)
    {
        $plan = ProductPlan::find($id);

        //product
        $product = $plan->app;

        //features
        $features = $product->features()->where('status', 1)->get();

        return view('v1.admin.plans.features')
            ->with('product', $product)
            ->with('plan', $plan)
            ->with('features', $features);
    }

    /**
     * ProductPlanController store.
     */
    public function store(Request $request)
    {
        $validator = $this->validator($request->all(), null);

        //check for errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        //catch input
        $product = Product::find($request->input('_app'));
        $title = $request->input('title');

        //new plan
        $plan = new ProductPlan();
        $plan->title = $request->input('title');
        $plan->summary = $request->input('summary');
        $plan->description = $request->input('description');
        $plan->price = $request->input('price');
        $plan->minimum = $request->input('minimum');
        $plan->limit = $request->input('limit');
        $plan->trial = $request->input('trial');
        $plan->trial_days = $request->input('trial_days');
        $plan->status = $request->input('status');

        if ($product->plans()->save($plan)) {
//            return redirect()->route('admin.app.view', ['id' => $product->id])
            return redirect()->back()
                ->with('success', $title . ' plan added successfully . ');
        }

        //redirect with error if failed
        return redirect()->back()
            ->with('error', 'Some error encountered. Failed adding plan. Try again!')
            ->withInput();
    }

    public function stripeCreate(Request $request)
    {
        //catch input
        $product = Product::find($request->input('_app'));
        $title = $request->input('title');

        //save
        $stripe = Plan::create(array(
            'name' => $request->input('title'),
            'id' => $request->input('id'),
            'interval' => $request->input('interval'),
            'currency' => $request->input('currency'),
            'amount' => $request->input('amount'),
        ));

        if ($stripe) {
            return redirect()->route('admin.app.view', ['id' => $product->id])
                ->with('success', $title . ' plan added successfully . ');
        }
    }

    /**
     * ProductPlanController update.
     */
    public function update(Request $request)
    {
        $validator = $this->validator($request->all(), "update");

        //check for errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        //catch input
        $id = $request->input('_plan');
        $title = $request->input('title');

        //new plan
        $plan = ProductPlan::find($id);
        $plan->title = $request->input('title');
        $plan->summary = $request->input('summary');
        $plan->description = $request->input('description');
        $plan->price = $request->input('price');
        $plan->minimum = $request->input('minimum');
        $plan->limit = $request->input('limit');
        $plan->trial = $request->input('trial');
        $plan->trial_days = $request->input('trial_days');
        $plan->status = $request->input('status');

        //save
        if ($plan->save()) {
//            return redirect()->route('admin.app.view', ['id' => $plan->product_id])
            return redirect()->back()
                ->with('success', $title . ' plan updated successfully . ');
        }

        //redirect with error if failed
        return redirect()->back()
            ->with('error', 'Some error encountered. Failed updating plan. Try again!')
            ->withInput();
    }

    /**
     * ProductPlanController toggleStatus.
     */
    public function toggleStatus($id)
    {
        $app = ProductPlan::find($id);

        //check if null
        if ($app == null)
            return redirect()->back()
                ->with('error', 'You tried to perform an action on an invalid record.');

        if ($app->status == 1)
            $app->status = 0;
        else
            $app->status = 1;

        if ($app->save())
            return redirect()->back()
                ->with('success', $app->title . ' plan status updated successfully!');
        else
            return redirect()->back()
                ->with('success', $app->title . ' plan status update failed. Try again!');

    }

    /**
     * ProductPlanController delete.
     */
    public function delete($id)
    {
        //find
        $app = ProductPlan::find($id);

        //check if null
        if ($app == null)
            return redirect()->back()
                ->with('error', 'You tried to perform an action on an invalid record.');

        //title
        $title = $app->title;

        //delete
        if ($app->delete()) {
            return redirect()->back()
                ->with('success', $title . ' plan moved to trash successfully.');
        }
        return redirect()->back()
            ->with('error', 'Failed moving ' . $title . ' plan to trash. Try again!');
    }

    /**
     * ProductPlanController restore.
     */
    public function restore($id)
    {
        //find
        $app = ProductPlan::onlyTrashed()->where('id', $id)->first();

        //check if null
        if ($app == null)
            return redirect()->back()
                ->with('error', 'You tried to perform an action on an invalid record.');

        //restore
        if ($app->restore()) {
            return redirect()->back()
                ->with('success', $app->title . ' plan restored successfully . ');
        }
        return redirect()->back()
            ->with('error', 'Failed restoring ' . $app->title . '. Try again!');
    }

    /**
     * ProductPlanController destroy.
     */
    public function destroy($id)
    {
        //find
        $app = ProductPlan::onlyTrashed()->where('id', $id)->first();

        //check if null
        if ($app == null)
            return redirect()->back()
                ->with('error', 'You tried to perform an action on an invalid record.');

        //title
        $title = $app->title;

        //delete
        if ($app->forceDelete()) {
            return redirect()->back()
                ->with('success', 'Plan deletion successful. ' . $title . ' is removed completely!');
        }
        return redirect()->back()
            ->with('error', 'Failed deleting plan. Try again!');
    }
}

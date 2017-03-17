<?php

namespace App\Http\Controllers\Estate;

use App\CompanyApp;
use App\EstateBill;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BillServiceController extends Controller
{

    /**
     * BillServiceController constructor.
     */
    public function __construct()
    {
        $this->middleware('company.app.admin');
    }

    /**
     * Get a validator for an incoming amenity create/update request.
     *
     * @param  array $data
     * @return \Illuminate\Support\Facades\Validator
     */
    protected function validator(array $data, $type)
    {
        #TODO: fields for consideration
        //'listing' => 'required|boolean',
        //'booking' => 'required|boolean',


        if ($type === "update") {
            return $validate = Validator::make($data, [
                'id' => 'required|exists:amenities,id',
                'title' => 'required|min:2|max:255',
                'description' => 'required|min:3|max:255',
                'status' => 'required|boolean',
            ]);
        } else {
            return $validate = Validator::make($data, [
                '_app' => 'required|integer|exists:company_apps,id',
                'bill_name' => 'required|min:2|max:255',
                'bill_summary' => 'required|min:3|max:255',
                'bill_details' => 'max:1500',
                'billing_interval' => 'required|integer|min:1',
                'bill_interval_type' => 'required',
                'billing_amount' => 'required|numeric',
                'billing_properties' => 'required|boolean',
                'billing_plan' => 'required|boolean',
                'billing_reminder' => 'required|integer|min:1|max:31',
                'status' => 'required|boolean',
            ]);
        }
    }

    /**
     * BillServiceController create.
     */
    public function create($id)
    {
        //app
        $app = CompanyApp::find($id);

        //check app
        if($app == null)
            abort(404);

        //authorize
        $this->authorize('view', $app);

        return view('v1.estates.bills.create-bill')
            ->with('app', $app);

    }

    /**
     * BillServiceController edit.
     */
    public function edit($id)
    {
        //bill
        $bill = EstateBill::find($id);

        //check if null
        if($bill == null)
            abort(404);

        //bill App
        $app = $bill->app;

        //authorize
        $this->authorize('view', $app);

        return view('v1.estates.bills.bill-setting')
            ->with('app', $app)
            ->with('bill', $bill);
    }

    /**
     * BillServiceController index.
     */
    public function index($id, $sort)
    {
        //app
        $app = CompanyApp::find($id);

        //check app
        if($app == null)
            abort(404);

        //authorize
        $this->authorize('view', $app);

        //trashed
        if ($sort == "trashed")
            $bills = $app->billingServices()->onlyTrashed()->orderBy('deleted_at', 'DESC')->paginate(25);
        //disabled
        if ($sort == "disabled")
            $bills = $app->billingServices()->where('status', 0)->orderBy('created_at', 'DESC')->paginate(25);
        //active
        if ($sort == "active")
            $bills = $app->billingServices()->where('status', 1)->orderBy('created_at', 'DESC')->paginate(25);
        //all
        if ($sort == "all")
            $bills = $app->billingServices()->paginate(25);

        return view('v1.estates.bills.bill-settings')
            ->with('app', $app)
            ->with('sort', $sort)
            ->with('bills', $bills);

    }

    /**
     * BillServiceController store.
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
        $app = CompanyApp::find($request->input('_app'));
        $title = $request->input('bill_name');

        //check if null
        if ($app == null)
            return redirect()->back()
                ->with('error', 'You tried to perform an action on an invalid record.');

        //new billing service
        $bill = new EstateBill();
        $bill->title = $title;
        $bill->summary = $request->input('bill_summary');
        $bill->description = $request->input('bill_details');
        $bill->billing_interval = $request->input('billing_interval');
        $bill->interval_type = $request->input('bill_interval_type');
        $bill->billing_amount = $request->input('billing_amount');
        $bill->properties = $request->input('billing_properties');
        $bill->bill_plan = $request->input('billing_plan');
        $bill->billing_reminder = $request->input('billing_reminder');
        $bill->status = $request->input('status');

        //save
        if ($app->billingServices()->save($bill)) {
            return redirect()->route('estate.bills.services', ['id' => $app->id, 'sort' => 'all'])
                ->with('success', 'Billing service added successfully.');
        }

        //redirect with error if failed
        return redirect()->back()
            ->with('error', 'Failed adding billing service. Try again!')
            ->withInput();

    }

    /**
     * BillServiceController update.
     */
    public function update(Request $request)
    {
        $validator = $this->validator($request->all(), null);

        //check for errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        //catch input
        $title = $request->input('bill_name');
        $id = $request->input('id');

        //check if null
        if ($id == null)
            return redirect()->back()
                ->with('error', 'You tried to perform an action on an invalid record.');

        //new billing service
        $bill = EstateBill::find($id);

        $bill->title = $title;
        $bill->summary = $request->input('bill_summary');
        $bill->description = $request->input('bill_details');
        $bill->billing_interval = $request->input('billing_interval');
        $bill->interval_type = $request->input('bill_interval_type');
        $bill->billing_amount = $request->input('billing_amount');
        $bill->properties = $request->input('billing_properties');
        $bill->bill_plan = $request->input('billing_plan');
        $bill->billing_reminder = $request->input('billing_reminder');
        $bill->status = $request->input('status');

        //save
        if ($bill->save()) {
            return redirect()->back()
                ->with('success', $title . ' billing service updated successfully.');
        }

        //redirect with error if failed
        return redirect()->back()
            ->with('error', 'Failed updating ' . $title . ' billing service. Try again!')
            ->withInput();
    }

    /**
     * BillServiceController toggleStatus.
     */
    public function toggleStatus($id)
    {
        $app = EstateBill::find($id);

        //check if null
        if($app == null)
            abort(404);

        //authorize
        $this->authorize('update', $app->app);

        if ($app->status == 1)
            $app->status = 0;
        else
            $app->status = 1;

        if ($app->save())
            return redirect()->back()
                ->with('success', $app->title . ' billing service status updated successfully!');
        else
            return redirect()->back()
                ->with('error', $app->title . ' billing service status update failed. Try again!');

    }

    /**
     * BillServiceController delete.
     */
    public function delete($id)
    {
        //find
        $app = EstateBill::find($id);

        //check if null
        if($app == null)
            abort(404);

        //authorize
        $this->authorize('delete', $app->app);

        //title
        $title = $app->title;

        //delete
        if ($app->delete()) {
            return redirect()->back()
                ->with('success', $title . ' billing service moved to trash successfully.');
        }

        return redirect()->back()
            ->with('error', 'Failed moving ' . $title . ' billing service to trash. Try again!');
    }

    /**
     * BillServiceController restore.
     */
    public function restore($id)
    {
        //find
        $app = EstateBill::onlyTrashed()->where('id', $id)->first();

        //check if null
        if($app == null)
            abort(404);

        //authorize
        $this->authorize('update', $app->app);

        //restore
        if ($app->restore()) {
            return redirect()->back()
                ->with('success', $app->title . ' billing service restored successfully.');
        }
        return redirect()->back()
            ->with('error', 'Failed restoring ' . $app->title . ' billing service. Try again!');
    }

    /**
     * BillServiceController destroy.
     */
    public function destroy($id)
    {
        //find
        $app = EstateBill::onlyTrashed()->where('id', $id)->first();

        //check if null
        if($app == null)
            abort(404);

        //authorize
        $this->authorize('delete', $app->app);

        //title
        $title = $app->title;

        //delete
        if ($app->forceDelete()) {
            return redirect()->back()
                ->with('success', ' Billing service deletion successful. ' . $title . ' is removed completely!');
        }
        return redirect()->back()
            ->with('error', 'Failed deleting ' . $title . ' billing service. Try again!');

    }

}

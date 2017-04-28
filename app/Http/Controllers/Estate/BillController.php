<?php

namespace App\Http\Controllers\Estate;

use App\Models\v1\Company\CompanyApp;
use App\Models\v1\Estate\EstateBill;
use App\Models\v1\Estate\EstateProperty;
use App\Models\v1\Tenant\TenantBill;
use App\Models\v1\Tenant\TenantProperty;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class BillController extends Controller
{

    /**
     * BillController constructor.
     */
    public function __construct()
    {
        $this->middleware('company.app.admin');
    }

    /**
     * Get a validator for an incoming app rent create/update request.
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
                '_bill' => 'required|integer|exists:tenant_bills,id',
                'bill_plan' => 'required|boolean',
                'bill_from_date' => 'required|date',
                'bill_to_date' => 'required|date|after:bill_from_date.*',
                'bill_due' => 'required|date|after:bill_from_date.*',
                'bill_total' => 'required|numeric',
                'bill_status' => 'required|boolean',
            ]);
        } else {
            return $validate = Validator::make($data, [
                '_app' => 'required|integer|exists:company_apps,id',
                'property.*' => 'required|integer|exists:estate_properties,id',
                '_bill' => 'required|integer|exists:estate_bills,id',
                'bill_plan' => 'required|boolean',
                'bill_from_date.*' => 'required|date',
                'bill_to_date.*' => 'required|date|after:bill_from_date.*',
                'bill_due.*' => 'required|date|after:bill_from_date.*',
                'bill_total.*' => 'required|numeric',
                'bill_status.*' => 'required|boolean',
            ],
                [],
                [
                    'bill_due.*' => 'bill due',
                    'bill_to_date.*' => 'bill to-date',
                    'bill_from_date.*' => 'bill from-date',
                ]);
        }
    }

    /**
     * BillController generateInvoices.
     */
    public function generateInvoices(Request $request, $id)
    {
        //app
        $app = CompanyApp::find($id);

        //check if null
        if ($app == null)
            abort(404);

        //authorize
        $this->authorize('view', $app);

        //check
        $notification = $app->notifications()->where('id', $request->notify)->first();

        if ($notification->read_at == null) {
            $notification->update(['read_at' => Carbon::now()]);
        }

        //service
        $service = $request->service;

        //groups
        $groups = $app->groups()->where('status', 1)->get();

        //properties
        $properties = $app->properties()->where('property_group', null)->where('status', 1)->get();

        //bills
        $bills = $app->billingServices()->where('status', 1)->get();

        return view('v1.estates.bills.generate-invoices')
            ->with('app', $app)
            ->with('service', $service)
            ->with('bills', $bills)
            ->with('groups', $groups)
            ->with('properties', $properties);

    }

    /**
     * BillController create.
     */
    public function create(Request $request, $id)
    {
        $this->validate($request, [
            'bill' => 'required',
            'invoices' => 'required',
        ]);

        //properties
        $invoices = $request->input('invoices');

        //property render
        $properties = array();

        if ($invoices != null) {

            foreach ($invoices as $invoice) {
                $property = EstateProperty::find($invoice);

                $properties = array_add($properties, $invoice, $property);
            }
        }

        //bill
        $bill = $request->input('bill');
        $bill = EstateBill::find($bill);

        //from date
        $from_date = Carbon::parse(Input::get('from_date'));
        $from = $from_date->format('Y-m-d');

        //due date
        $due_date = Carbon::parse(Input::get('due_date'))->format('Y-m-d');

        //to date
        //if month
        if ($bill->interval_type == "month")
            $to_date = $from_date->addMonths($bill->billing_interval);

        if ($bill->interval_type == "week")
            $to_date = $from_date->addWeeks($bill->billing_interval);

        if ($bill->interval_type == "year")
            $to_date = $from_date->addYears($bill->billing_interval);

        $to_date = $to_date->format('Y-m-d');

        //app
        $app = CompanyApp::find($id);

        //check if null
        if ($app == null)
            abort(404);

        //authorize
        $this->authorize('view', $app);

        return view('v1.estates.bills.create')
            ->with('app', $app)
            ->with('bill', $bill)
            ->with('from_date', $from)
            ->with('to_date', $to_date)
            ->with('due_date', $due_date)
            ->with('properties', $properties);

    }

    /**
     * BillController edit.
     */
    public function edit($id)
    {
        //bill
        $bill = TenantBill::find($id);

        //check if null
        if ($bill == null)
            abort(404);

        //app
        $app = $bill->property->app;

        //authorize
        $this->authorize('view', $app);

        return view('v1.estates.bills.edit-bill-invoice')
            ->with('groups', $app->groups()->where('status', 1)->get())
            ->with('app', $app)
            ->with('bill', $bill);
    }

    /**
     * BillController index.
     */
    public function index(Request $request, $id, $sort)
    {
        //app
        $app = CompanyApp::find($id);

        //check app
        if ($app == null)
            abort(404);

        //authorize
        $this->authorize('view', $app);

        $service = $request->service;
        $today = $request->today;

        //check
        $notification = $app->notifications()->where('id', $request->notify)->first();

        if ($notification != null) {
            $notification->update(['read_at' => Carbon::now()]);
        }

        //trashed
        if ($sort == "trashed") {
            $bills = $app->bills()->onlyTrashed()->orderBy('tenant_bills.deleted_at', 'DESC')->paginate();
        }
        //pending
        if ($sort == "pending") {
            if ($service == null)
                $bills = $app->bills()->where('tenant_bills.status', 0)->whereNull('paid_at')->orderBy('date_due', 'ASC')->paginate();
            else {
                if (!empty($today) && $today) {//get pending today
                    $bills = $app->bills()->whereDate('date_due', $request->date)
                        ->where('bill_id', $service)
                        ->where('tenant_bills.status', 0)
                        ->whereNull('paid_at')
                        ->orderBy('date_due', 'ASC')
                        ->paginate();
                } else {//get past due
                    $bills = $app->bills()->whereDate('date_due', '<', $request->date)
                        ->where('bill_id', $service)
                        ->where('tenant_bills.status', 0)
                        ->whereNull('paid_at')
                        ->orWhere('paid_at', '<', $request->date)
                        ->orderBy('date_due', 'ASC')
                        ->paginate();
                }
            }
        }

        //paid
        if ($sort == "paid") {
            $bills = $app->bills()->where('tenant_bills.status', 1)->orderBy('date_due', 'ASC')->orderBy('updated_at', 'DESC')->paginate();
        }

        //all
        if ($sort == "all") {
            $bills = $app->bills()->orderBy('date_due', 'ASC')->orderBy('tenant_bills.status', 'ASC')->paginate();
        }

        return view('v1.estates.bills.index')
            ->with('app', $app)
            ->with('sort', $sort)
            ->with('bills', $bills);

    }

    /**
     * BillController pdfReport.
     */
    public function pdfReport($id, $sort)
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

        //when
        $when = Carbon::now();

        //trashed
        if ($sort == "trashed")
            $bills = $app->bills()->onlyTrashed()->orderBy('tenant_bills.deleted_at', 'DESC')->get();

        //pending
        if ($sort == "pending")
            $bills = $app->bills()->where('tenant_bills.status', 0)->orderBy('date_due', 'ASC')->get();

        //paid
        if ($sort == "paid")
            $bills = $app->bills()->where('tenant_bills.status', 1)->orderBy('date_due', 'ASC')->orderBy('updated_at', 'DESC')->get();

        //all
        if ($sort == "all")
            $bills = $app->bills()->orderBy('date_due', 'ASC')->orderBy('tenant_bills.status', 'ASC')->get();

        //generate pdf
        //pdf options
        $pdf = PDF::setOptions(['defaultMediaType' => 'all', 'defaultFont' => 'sans-serif']);

        //view render
        $pdf->loadView('v1.reports.bills.default', [
            'app' => $app,
            'bills' => $bills,
            'sort' => $sort,
            'company' => $company,
            'product' => $product,
            'when' => $when
        ]);

        //paper and layout
        $pdf->setPaper('a4', 'portrait');

        //pdf name
        $pdfName = $company->title . ' - ' . title_case($sort) . ' Bills Report ' . ' (' . $when . ')';

        //download and redirect
        return $pdf->download($pdfName . '.pdf');

    }

    /**
     * BillController store.
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

        //alerts
        $success = array();
        $error = array();

        //catch input
        $bills = $request->input('_bill');

        //verify bill
        $bill = EstateBill::where('id', $bills)->where('status', 1)->first();

        if ($bill == null)
            return redirect()->back()
                ->with('error', 'Some error occured. You tried to generate invoices for an invalid billing service')
                ->withInput();

        //if bill plan is 1
        if ($bill->bill_plan == 1) {
            $this->validate($request, [
                'previous_usage' => 'required',
                'current_usage' => 'required',
            ]);

            $previous = $request->input('previous_usage');
            $current = $request->input('current_usage');

        }

        $_id = $request->input('_app');

        //app
        $app = CompanyApp::find($_id);

        //check if null
        if ($app == null)
            abort(404);

        //authorize
        $this->authorize('view', $app);

        $properties = $request->input('property');
        $bill_from_date = $request->input('bill_from_date');
        $bill_to_date = $request->input('bill_to_date');
        $bill_due = $request->input('bill_due');
        $bill_status = $request->input('bill_status');
        $bill_total = $request->input('bill_total');

        //count successfully generated invoices
        $invoice_gen = 0;
        $invoice_total = count($properties);
        $z = 0;
        $_usage_error = 0;

        if (count($properties) > 0) {

            //dates validation
            /*if (count($bill_from_date) > 0) {
                //check dates
                for ($x = 0; $x < count($properties); $x++) {
                    if ($properties[$x] != null) {
                        //find property
                        $property = EstateProperty::find($properties[$x]);

                        //validator
                        $validate = Validator::make($request->all, [
                            'bill_from_date.*' => 'required|date',
                            'bill_to_date.*' => 'required|date|after:bill_from_date.*',
                            'bill_due.*' => 'required|date|after:bill_to_date.*',
                        ]);

                        if ($previous[$x] != null && $previous[$x] > $current[$x]) {
                            //count
                            $_usage_error++;

                            //error
                            $error = array_add($error, $z++, $property->title . " current usage cannot be less than previous usage.");
                        }
                    }
                }

                //usage error
                if ($_usage_error > 0) {
                    $error = array_add($error, $z++, "Failed creating any bill invoice.");

                    return redirect()->back()
                        ->with('bulk_error', $error)
                        ->withInput();
                }
            }*/

            //check if bill plan is dependent
            if ($bill->bill_plan == 1) {
                //loop
                for ($x = 0; $x < count($properties); $x++) {
                    if ($properties[$x] != null) {
                        //find property
                        $property = EstateProperty::find($properties[$x]);

                        if ($previous[$x] != null && $previous[$x] > $current[$x]) {
                            //count
                            $_usage_error++;

                            //error
                            $error = array_add($error, $z++, $property->title . " current usage cannot be less than previous usage.");
                        }
                    }
                }

                //usage error
                if ($_usage_error > 0) {
                    $error = array_add($error, $z++, "Failed creating any bill invoice.");

                    return redirect()->back()
                        ->with('bulk_error', $error)
                        ->withInput();
                }
            }

            for ($i = 0; $i < count($properties); $i++) {

                if ($properties[$i] != null) {
                    //find property
                    $property = EstateProperty::find($properties[$i]);

                    //find tenant
                    $tenant = TenantProperty::where('property_id', $properties[$i])->where('status', 1)->first();

                    //amount

                    //units

                    //new tenant bill
                    $_bill = new TenantBill();
                    $_bill->property_id = $property->id;
                    $_bill->bill_id = $bill->id;
                    $_bill->details = null;

                    //for continous
                    if ($bill->bill_plan == 1) {
                        $_bill->previous_usage = $previous[$i];
                        $_bill->current_usage = $current[$i];
                    }

                    $_bill->unit_cost = $bill->billing_amount;
                    $_bill->date_from = $bill_from_date[$i];
                    $_bill->date_to = $bill_to_date[$i];
                    $_bill->date_due = $bill_due[$i];
                    $_bill->hash = bcrypt(str_random(12));
                    $_bill->status = $bill_status[$i];

                    //check if saved
                    if ($tenant->bills()->save($_bill)) {
                        $invoice_gen++;

                        //property message
//                        $success = array_add($success, $z++, $bill->title . " bill invoice for " . $property->title . " created successfully");

                    } else {
                        $error = array_add($error, $z++, $bill->title . " bill invoice for " . $property->title . " failed creating.");
                    }
                    //end of property check
                } else { //catch invalid property
                    $error = array_add($error, $z++, "Property no " . $i . " is invalid or doesn't exist!");
                }
            } //end of properties loop

            if ($invoice_gen > 0) {
                $success = array_add($success, $z++, $invoice_gen . " out of " . $invoice_total . " " . $bill->title . " bill invoices generated successfully.");

                return redirect()->route('estate.rental.bills.tenants', ['id' => $app->id, 'sort' => 'all'])
                    ->with('bulk_success', $success);
            } else {
                $error = array_add($error, $z++, "Failed creating any bill invoice.");

                return redirect()->back()
                    ->with('bulk_error', $error)
                    ->withInput();
            }

        }

        //redirect with error if failed
        return redirect()->back()
            ->with('error', 'Failed adding bill invoices. Try again!')
            ->withInput();

    }

    /**
     * BillController update.
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
        $bills = $request->input('_bill');
        $id = $request->input('id');

        //verify bill
        $bill = EstateBill::where('id', $bills)->where('status', 1)->first();

        $properties = $request->input('property');
        $bill_from_date = $request->input('bill_from_date');
        $bill_to_date = $request->input('bill_to_date');
        $bill_due = $request->input('bill_due');
        $bill_status = $request->input('bill_status');
        $bill_total = $request->input('bill_total');

        $previous = $request->input('previous_usage');
        $current = $request->input('current_usage');

        //find tenant bill
        $_bill = TenantBill::find($id);

        //check if not null
        if ($_bill == null)
            return redirect()->back()->with('error', 'You tried to perform an action on an invalid record!');

        $_bill->details = null;

        //for continous billing plan
        if ($bill->bill_plan == 1) {
            $_bill->previous_usage = $previous;
            $_bill->current_usage = $current;
        }

        $_bill->unit_cost = $bill->billing_amount;
        $_bill->date_from = $bill_from_date;
        $_bill->date_to = $bill_to_date;
        $_bill->date_due = $bill_due;
        $_bill->status = $bill_status;

        //check bill status and assign paid date
        if ($bill_status == 0) {
            $_bill->paid_at = null;
        } else {
            $_bill->paid_at = Carbon::now();
        }


        //update
        if ($_bill->update()) {
            return redirect()->back()
                ->with('success', $bill->title . ' bill invoice for ' . $_bill->property->title . ' updated successfully.');
        }

        //redirect with error
        return redirect()->back()
            ->with('error', $bill->title . ' bill invoice for ' . $_bill->property->title . ' failed updating. Try again!');

    }

    /**
     * BillController toggleStatus.
     */
    public function toggleStatus($id)
    {
        $app = TenantBill::find($id);

        //check if null
        if ($app == null)
            abort(404);

        //authorize
        $this->authorize('update', $app->property->app);

        $from = MonthNameReturn($app->date_from);
        $to = MonthNameReturn($app->date_to);

        if ($app->status == 1) {
            $app->status = 0;
            $app->paid_at = null;
        } else {
            $app->status = 1;
            $app->paid_at = Carbon::now();
        }

        if ($app->save())
            return redirect()->back()
                ->with('success', $app->bill->title . ' rent invoice for ' . $from . ' - ' . $to . ' status updated successfully!');
        else
            return redirect()->back()
                ->with('success', $app->bill->title . ' rent invoice for ' . $from . ' - ' . $to . ' status update failed. Try again!');


    }

    /**
     * BillController delete.
     */
    public function delete(Request $request)
    {
        $z = 0;
        $c = 0;
        $success = array();
        $error = array();

        //catch delete ids
        $bills = $request->id != null ? $request->id : Input::get('bill');

        //count
        $counted = count($bills);

        //check if array not empty
        if ($counted > 1) {
            foreach ($bills as $id) {
                $app = TenantBill::find($id);

                //check if null
                if ($app != null) {

                    //bill details
                    $bill = $app->bill->title;
                    $title = $app->property->title;
                    $from = MonthNameReturn($app->date_from);
                    $to = MonthNameReturn($app->date_to);

                    //delete check
                    if ($app->delete()) {
                        $c++;

                        //message
                        //$success = array_add($success, $z++, $title . ' bill invoice for ' . $bill . ' for ' . $from . ' - ' . $to . ' moved to trash successfully.');
                    }
                }
            }
        } else if ($counted == 1) { //find if only one

            //id
            $id = $bills[0];

            $app = TenantBill::find($id);

            //check if null
            if (!empty($app)) {

                //bill details
                $bill = $app->bill->title;
                $title = $app->property->title;
                $from = MonthNameReturn($app->date_from);
                $to = MonthNameReturn($app->date_to);

                //authorize
                $this->authorize('delete', $app->property->app);

                //delete check
                if ($app->delete()) {
                    $c++;

                    //message
                    $success = array_add($success, $z++, $title . ' bill invoice for ' . $bill . ' for ' . $from . ' - ' . $to . ' moved to trash successfully.');
                }
            }
        }

        $success = array_add($success, $z++, $c . ' of ' . $counted . ' bill invoices moved to trash successfully');

        if ($c > 0) {
            return redirect()->back()
                ->with('bulk_success', $success);
        }

        return redirect()->back()
            ->with('error', 'You tried to delete an empty record. Select some first...');

//        return redirect()->back()
//            ->with('error', 'Failed moving ' . $title . ' bill invoice for ' . $bill . ' for ' . $from . ' - ' . $to . ' to trash. Try again!');

    }

    /**
     * BillController restore.
     */
    public function restore($id)
    {
        //find
        $app = TenantBill::onlyTrashed()->where('id', $id)->first();

        //check if null
        if ($app == null)
            abort(404);

        //authorize
        $this->authorize('view', $app->property->app);

        //title
        $bill = $app->bill->title;
        $title = $app->property->title;
        $from = MonthNameReturn($app->date_from);
        $to = MonthNameReturn($app->date_to);

        //restore
        if ($app->restore()) {
            return redirect()->back()
                ->with('success', $title . ' bill invoice for ' . $bill . ' for ' . $from . ' - ' . $to . ' restored successfully.');
        }

        return redirect()->back()
            ->with('error', 'Failed restoring ' . $title . ' bill invoice for ' . $bill . ' for ' . $from . ' - ' . $to . '. Try again!');
    }

    /**
     * BillController destroy.
     */
    public function destroy(Request $request)
    {
        $z = 0;
        $c = 0;
        $success = array();
        $error = array();

        //catch ids
        $bills = $request->id != null ? $request->id : Input::get('bill');

        //count
        $counted = count($bills);

        if ($counted == 1) {

            //id
            $id = $bills;

            //find
            $app = TenantBill::onlyTrashed()->where('id', $id)->first();

            //check if null
            if ($app != null) {

                //authorize
                $this->authorize('delete', $app->property->app);

                //title
                $bill = $app->bill->title;
                $title = $app->property->title;
                $from = MonthNameReturn($app->date_from);
                $to = MonthNameReturn($app->date_to);

                //delete
                if ($app->forceDelete()) {
                    return redirect()->back()
                        ->with('success', 'Invoice deletion successful. ' . $bill . ' bill invoice for ' . $title . ' is removed completely!');
                }
            }
        } else {
            foreach ($bills as $id) {
                $app = TenantBill::onlyTrashed()->where('id', $id)->first();

                //check if null
                if ($app != null) {

                    //bill details
                    $bill = $app->bill->title;
                    $title = $app->property->title;
                    $from = MonthNameReturn($app->date_from);
                    $to = MonthNameReturn($app->date_to);

                    //delete check
                    if ($app->forceDelete()) {
                        $c++;

                        //message
                        //$success = array_add($success, $z++, $title . ' bill invoice for ' . $bill . ' for ' . $from . ' - ' . $to . ' moved to trash successfully.');
                    }
                }
            }
        }

        $success = array_add($success, $z++, $c . ' of ' . $counted . ' bill invoices deleted completely.');

        //check for any success message
        if ($c > 0) {
            return redirect()->back()
                ->with('bulk_success', $success);
        }

        //bulk error
        return redirect()->back()
            ->with('error', 'You tried to delete empty record(s). Select some first...');
    }
}

<?php

namespace App\Http\Controllers\Estate;

use App\Models\v1\Company\CompanyApp;
use App\Models\v1\Estate\EstateGroup;
use App\Models\v1\Estate\EstateProperty;
use App\Models\v1\Tenant\TenantRent;
use App\Models\v1\Property\PropertyPrice;
use App\Models\v1\Tenant\TenantProperty;
use App\Notifications\Tenant\RentInvoiceSentNotification;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class RentController extends Controller
{

    /**
     * RentController constructor.
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
                'id' => 'required|exists:estate_rents,id',
                'rent_from_date' => 'required|date',
                'rent_to_date' => 'required|date',
                'rent_due' => 'required|date',
                'rent_status' => 'required|boolean',
            ]);
        } else {
            return $validate = Validator::make($data, [
                '_app' => 'required|integer|exists:company_apps,id',
                'property.*' => 'required|exists:estate_properties,id',
                'rent.*' => 'required|numeric',
                'rent_from_date.*' => 'required|date',
                'duration.*' => 'required|integer',
                'rent_due.*' => 'required|date',
                'rent_total.*' => 'required|numeric',
                'rent_status.*' => 'required|boolean',
            ]);
        }
    }

    /**
     * RentController invoice.
     */
    public function invoice($id)
    {
        //app
        $app = CompanyApp::find($id);

        //check if null
        if ($app == null)
            abort(404);

        //authorize
        $this->authorize('view', $app);

        //groups
        $groups = $app->groups()->where('status', 1)->get();

        //properties
        $properties = $app->properties()->where('property_group', null)->where('status', 1)->get();

        return view('v1.estates.rent.generate')
            ->with('groups', $app->groups()->where('status', 1)->get())
            ->with('properties', $properties)
            ->with('app', $app);
    }

    /**
     * RentController create.
     */
    public function create($id)
    {
        //app
        $app = CompanyApp::find($id);

        //check if null
        if ($app == null)
            abort(404);

        //authorize
        $this->authorize('view', $app);

        //invoices
        $invoices = Input::get('invoices');

        $generate = array();

        if ($invoices != null) {

            foreach ($invoices as $invoice) {
                $property = EstateProperty::find($invoice);

                $generate = array_add($generate, $invoice, $property);
            }
        }

        //properties
        $properties = $app->properties()->where('status', 1)->get();

        return view('v1.estates.rent.create')
            ->with('groups', $app->groups()->where('status', 1)->get())
            ->with('invoices', $generate)
            ->with('properties', $properties)
            ->with('app', $app);
    }

    /**
     * RentController groupProperties.
     */
    public function groupProperties(Request $request)
    {
        //group app
        $app = $request->input('app');

        //group id
        $id = $request->input('id');

        $properties = "";

        if ($id > 0) { //app
            $app = EstateGroup::find($id);

            //group properties
            $properties = $app->properties()->where('status', 1)->get();
        } else if ($id == null) {
            $properties = EstateProperty::where('company_app_id', $app)->where('property_group', null)->where('status', 1)->get();
        }

        if ($properties != null)
            return response()->json(['status' => 1, 'message' => 'Properties retrieved successfully.', 'properties' => $properties]);

        //failed
        return response()->json(['status' => 1, 'message' => 'Failed retrieving properties.', 'properties' => $properties]);
    }

    /**
     * RentController groupProperty.
     */
    public function groupProperty(Request $request)
    {
        //group app
        $app = $request->input('app');

        //group id
        $id = $request->input('id');

        $property = "";

        if ($id > 0) { //app
            $property = PropertyPrice::where('property_id', $id)->where('status', 1)->first();
        }

        if ($property != null)
            return response()->json(['status' => 1, 'message' => 'Properties retrieved successfully.', 'property' => $property]);

        //failed
        return response()->json(['status' => 1, 'message' => 'Failed retrieving properties.', 'property' => $property]);
    }

    /**
     * RentController edit.
     */
    public function edit($id)
    {
        //rent
        $rent = TenantRent::find($id);

        //check if null
        if ($rent == null)
            return redirect()->back()
                ->with('error', 'You tried to perform an action on an invalid record.');

        //app
        $app = $rent->property->app;

        return view('v1.estates.rent.edit')
            ->with('groups', $app->groups()->where('status', 1)->get())
            ->with('app', $app)
            ->with('rent', $rent);
    }

    /**
     * RentController index.
     */
    public function index(Request $request, $id, $sort)
    {
        //app
        $app = CompanyApp::find($id);

        //check if null
        if ($app == null)
            abort(404);

        //authorize
        $this->authorize('view', $app);

        //query string
        $query_string = array_except($request->query->all(), 'page');

        $today = $request->today;
        $date = $request->date;
        $month = $request->month;

        //check
        $notification = $app->notifications()->where('id', $request->notify)->first();

        if ($notification != null) {
            $notification->update(['read_at' => Carbon::now()]);
        }

        //trashed
        if ($sort == "trashed")
            $rents = $app->rents()->orderBy('date_due', 'ASC')->orderBy('date_from', 'ASC')
                ->orderBy('tenant_rents.status', 'ASC')->onlyTrashed()->paginate();

        //paid
        if ($sort == "paid")
            $rents = $app->rents()->where('tenant_rents.status', 1)->orderBy('date_due', 'ASC')
                ->orderBy('date_from', 'ASC')->orderBy('status', 'ASC')->paginate();

        //pending
        if ($sort == "pending") {
            if ($request->has(['today', 'date'])) {   //get pending rents today
                if (Carbon::today()->toDateString() === $date && $today == true) {
                    $rents = $app->rents()
                        ->where('tenant_rents.status', 0)
                        ->whereDate('date_due', $date)
                        ->whereNull('paid_at')
                        ->orderBy('date_due', 'ASC')
                        ->paginate();
                    $date = $date == Carbon::today() ? "Today: " . $date : 'On: ' . $date;
                } else {
                    $rents = $app->rents()
                        ->where('tenant_rents.status', 0)
                        ->whereDate('date_due', '<', $date)
                        ->whereNull('paid_at')
                        ->orderBy('date_due', 'ASC')
                        ->paginate();
                    $date = "Before or on: " . $date;
                }
            } elseif ($request->has('date') && !empty($date)) {    //get pending rents by date
                $rents = $app->rents()
                    ->where('tenant_rents.status', 0)
                    ->whereDate('date_due', $date)
                    ->whereNull('paid_at')
                    ->orderBy('date_due', 'ASC')
                    ->paginate();
            } elseif ($request->has('today') && $today == true) { //get pending and due today
                $rents = $app->rents()
                    ->where('tenant_rents.status', 0)
                    ->whereDate('date_due', Carbon::today())
                    ->whereNull('paid_at')
                    ->orderBy('date_due', 'ASC')
                    ->paginate();
                $date = "Today";
            } elseif ($request->has('month') && $month == true) { //get pending this month
                $rents = $app->rents()
                    ->where('tenant_rents.status', 0)
                    ->whereNull('paid_at')
                    ->whereMonth('date_due', Carbon::today()->month)
                    ->orderBy('date_due', 'ASC')
                    ->paginate();
            } else {    //get pending rents
                $rents = $app->rents()
                    ->where('tenant_rents.status', 0)
                    ->whereNull('paid_at')
                    ->orderBy('date_due', 'ASC')
                    ->orderBy('date_from', 'ASC')
                    ->orderBy('status', 'ASC')
                    ->paginate();
            }
        }

        //all
        if ($sort == "all")
            $rents = $app->rents()->where('tenant_rents.status', 'ASC')->orderBy('date_due', 'ASC')
                ->orderBy('date_from', 'ASC')->orderBy('status', 'ASC')->paginate();

        //pass month date
        $_month = $month != null ? Carbon::today() : '';

        return view('v1.estates.rent.index')
            ->with('app', $app)
            ->with('month', $_month)
            ->with('today', $date)
            ->with('sort', $sort)
            ->with('query_string', $query_string)
            ->with('rents', $rents);
    }

    /**
     * RentController pdfReport.
     */
    public function pdfReport(Request $request, $id, $sort)
    {
        //app
        $app = CompanyApp::find($id);

        //check if null
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

        //query string
        $query_string = $request->getQueryString();

        $today = $request->today;
        $date = $request->date;
        $month = $request->month;

        //check
        $notification = $app->notifications()->where('id', $request->notify)->first();

        if ($notification != null) {
            $notification->update(['read_at' => Carbon::now()]);
        }

        //trashed
        if ($sort == "trashed")
            $rents = $app->rents()->orderBy('date_due', 'ASC')->orderBy('date_from', 'ASC')
                ->orderBy('tenant_rents.status', 'ASC')->onlyTrashed()->get();

        //paid
        if ($sort == "paid")
            $rents = $app->rents()->where('tenant_rents.status', 1)->orderBy('date_due', 'ASC')
                ->orderBy('date_from', 'ASC')->orderBy('status', 'ASC')->get();

        //pending
        if ($sort == "pending") {
            if ($request->has(['today', 'date'])) {   //get pending rents today
                if (Carbon::today()->toDateString() === $date && $today == true) {
                    $rents = $app->rents()
                        ->where('tenant_rents.status', 0)
                        ->whereDate('date_due', $date)
                        ->whereNull('paid_at')
                        ->orderBy('date_due', 'ASC')
                        ->get();
                    $date = $date == Carbon::today() ? "Today: " . $date : 'On: ' . $date;
                } else {
                    $rents = $app->rents()
                        ->where('tenant_rents.status', 0)
                        ->whereDate('date_due', '<', $date)
                        ->whereNull('paid_at')
                        ->orderBy('date_due', 'ASC')
                        ->get();
                    $date = "Before or on: " . $date;
                }
            } elseif ($request->has('date') && !empty($date)) {    //get pending rents by date
                $rents = $app->rents()
                    ->where('tenant_rents.status', 0)
                    ->whereDate('date_due', $date)
                    ->whereNull('paid_at')
                    ->orderBy('date_due', 'ASC')
                    ->get();
            } elseif ($request->has('today') && $today == true) { //get pending and due today
                $rents = $app->rents()
                    ->where('tenant_rents.status', 0)
                    ->whereDate('date_due', Carbon::today())
                    ->whereNull('paid_at')
                    ->orderBy('date_due', 'ASC')
                    ->get();
                $date = "Today";
            } elseif ($request->has('month') && $month == true) { //get pending this month
                $rents = $app->rents()
                    ->where('tenant_rents.status', 0)
                    ->whereNull('paid_at')
                    ->whereMonth('date_due', Carbon::today()->month)
                    ->orderBy('date_due', 'ASC')
                    ->get();
            } else {    //get pending rents
                $rents = $app->rents()
                    ->where('tenant_rents.status', 0)
                    ->whereNull('paid_at')
                    ->orderBy('date_due', 'ASC')
                    ->orderBy('date_from', 'ASC')
                    ->orderBy('status', 'ASC')
                    ->get();
            }
        }

        //all
        if ($sort == "all")
            $rents = $app->rents()->where('tenant_rents.status', 'ASC')->orderBy('date_due', 'ASC')
                ->orderBy('date_from', 'ASC')->orderBy('status', 'ASC')->get();

        //generate pdf
        //pdf options
        $pdf = PDF::setOptions(['defaultMediaType' => 'all', 'defaultFont' => 'Arial']);

        //view render
        $pdf->loadView('v1.reports.rents.default', [
            'app' => $app,
            'rents' => $rents,
            'sort' => $sort,
            'company' => $company,
            'product' => $product,
            'when' => $when
        ]);

        //paper and layout
        $pdf->setPaper('a4', 'landscape');

        //pdf name
        $pdfName = $company->title . ' - ' . title_case($sort) . ' Rent Collection Report ' . ' (' . $when . ')';

        //download and redirect
        return $pdf->download($pdfName . '.pdf');

    }

    /**
     * RentController Create Estate Tenant Rent.
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

        $success = array();
        $error = array();

        $_id = $request->input('_app');

        //app
        $app = CompanyApp::find($_id);

        //check if null
        if ($app == null)
            abort(404);

        //authorize
//        $this->authorize('view', $app);

        $properties = $request->input('property');
        $rents = $request->input('rent');
        $rent_from_date = $request->input('rent_from_date');
        $duration = $request->input('duration');
        $rent_due = $request->input('rent_due');
        $rent_status = $request->input('rent_status');

        if (count($properties) > 0) {
            $z = 0;

            for ($i = 0; $i < count($properties); $i++) {
                //count successfully generated invoices
                $invoice_gen = 0;
                $invoice_total = $duration[$i];

                if ($properties[$i] != null) {
                    //find property
                    $property = EstateProperty::find($properties[$i]);

                    //find tenant
                    $tenant = TenantProperty::where('property_id', $properties[$i])->where('status', 1)->first();

                    //amount
                    $amount = $rents[$i];

                    //status
                    $status = $rent_status[$i];

                    for ($x = 1; $x <= $duration[$i]; $x++) {
                        //parse dates
                        $date = Carbon::parse($rent_from_date[$i]);
                        $due = Carbon::parse($rent_due[$i]);

                        //store last duration
                        $last = $duration[$i];

                        //init from
                        $from = $date;

                        //loop date from
                        if ($x == 1) {
                            $from = $date;
                        }
                        if ($x > 1) {
                            $from = $date->subMonth(1)->addMonths($x);
                        }

                        if ($x > 1 && $x < $last) {
                            $date_due = $due->subMonth(1)->addMonths($x)->toDateString();
                        } else if ($x == $last) {
                            $l = $last - 1;
                            $date_due = $due->addMonths($l)->toDateString();
                        } else {
                            $date_due = $due->toDateString();
                        }

                        //new rent invoice init
                        $rent = new TenantRent();
                        $rent->tenant_property_id = $tenant->id;
                        $rent->details = null;
                        $rent->amount = $amount;
                        $rent->date_from = $from->toDateString();
                        $rent->date_to = $from->addMonth(1)->toDateString();
                        $rent->date_due = $date_due;
                        $rent->hash = bcrypt(str_random(12));
                        $rent->status = $status;

                        //save
                        if ($property->rents()->save($rent)) {
                            //lease
                            $lease = $rent->lease;

                            //tenant
                            $tenant = $lease->tenant;

                            //user
                            $user = $tenant->user;

                            //user dash route
                            $route = route('tenant.rent', ['id' => $rent->id]);

                            //app
                            $app = $tenant->company;

                            //company
                            $company = $app->company;

                            //notify
                            $user->notify(new RentInvoiceSentNotification($rent, $app, $company, $user, $route));

                            $invoice_gen++;

                        } //end of save if

                    } //end of duration loop

                } else { //catch invalid property
                    $error = array_add($error, $z++, "Property no " . $i . " is invalid or doesn't exist!");
                }

                $success = array_add($success, $z++, $invoice_gen . " of " . $invoice_total . " rent invoices for " . $property->title . " created successfully");

            } //end of properties loop

            if ($invoice_gen > 0)
                return redirect()->route('estate.rental.rents', ['id' => $app->id, 'sort' => 'all'])
                    ->with('bulk_success', $success)
                    ->with('bulk_error', $error)
                    ->withInput();
        }

        //redirect with error if failed
        return redirect()->back()
            ->with('error', 'Failed adding invoices. Try again!')
            ->withInput();
    }

    /**
     * RentController update.
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
        $id = $request->input('id');
        $property = $request->input('property');
        $from = $request->input('rent_from_date');
        $to = $request->input('rent_to_date');
        $due = $request->input('rent_due');
        $status = $request->input('rent_status');

        //find rent invoice
        $rent = TenantRent::find($id);

        //check if not null
        if ($rent == null)
            return redirect()->back()->with('error', 'You tried to perform an action on an invalid record!');

        //update
        $rent->details = null;
        $rent->date_from = $from;
        $rent->date_to = $to;
        $rent->date_due = $due;
        $rent->status = $status;

        //check rent status and assign paid date
        if ($status == 0) {
            $rent->paid_at = null;
        } else {
            $rent->paid_at = Carbon::now();
        }

        if ($rent->update()) {
            return redirect()->back()
                ->with('success', 'Rent invoice for ' . $rent->property->title . ' updated successfully.');
        }

        return redirect()->back()
            ->with('error', 'Rent invoice for ' . $rent->property->title . ' failed updating. Try again!');

    }

    /**
     * RentController toggleStatus.
     */
    public function toggleStatus($id)
    {
        $app = TenantRent::find($id);

        //check if null
        if ($app == null)
            return redirect()->back()
                ->with('error', 'You tried to perform an action on an invalid record.');

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
                ->with('success', $app->property->title . ' rent invoice for ' . $from . ' - ' . $to . ' status updated successfully!');
        else
            return redirect()->back()
                ->with('success', $app->property->title . ' rent invoice for ' . $from . ' - ' . $to . ' status update failed. Try again!');

    }

    /**
     * RentController delete.
     */
    public function delete(Request $request)
    {

        $z = 0;
        $c = 0;
        $success = array();
        $error = array();

        //catch ids
        $rents = $request->id != null ? $request->id : Input::get('rent');

        //count
        $counted = count($rents);

        if ($counted == 1) {
            //id
            $id = $rents;

            //find
            $app = TenantRent::find($id);

            //check if null
            if ($app != null) {

                //title
                $title = $app->property->title;
                $from = MonthNameReturn($app->date_from);
                $to = MonthNameReturn($app->date_to);

                //delete
                if ($app->delete()) {
                    return redirect()->back()
                        ->with('success', $title . ' rent invoice for ' . $from . ' - ' . $to . ' moved to trash successfully.');
                }
                //error
                return redirect()->back()
                    ->with('error', 'Failed moving ' . $title . ' rent invoice for ' . $from . ' - ' . $to . ' to trash. Try again!');
            }

        } elseif ($counted > 1) {
            foreach ($rents as $id) {
                $app = TenantRent::find($id);

                //check if null
                if ($app != null) {

                    //rent details
                    $title = $app->property->title;
                    $from = MonthNameReturn($app->date_from);
                    $to = MonthNameReturn($app->date_to);

                    //delete check
                    if ($app->delete()) {
                        $c++;

                        //message
                        //success message here
                    }
                }
            }
        }

        //successful deletes
        $success = array_add($success, $z++, $c . ' of ' . $counted . ' rent invoices moved to trash successfully');

        if ($c > 0) {
            return redirect()->back()
                ->with('bulk_success', $success);
        }

        return redirect()->back()
            ->with('error', 'Select records first before a bulk delete');

    }

    /**
     * RentController restore.
     */
    public function restore($id)
    {
        //find
        $app = TenantRent::onlyTrashed()->where('id', $id)->first();

        //check if null
        if ($app == null)
            return redirect()->back()
                ->with('error', 'You tried to perform an action on an invalid record.');

        //title
        $title = $app->property->title;
        $from = MonthNameReturn($app->date_from);
        $to = MonthNameReturn($app->date_to);

        //restore
        if ($app->restore()) {
            return redirect()->back()
                ->with('success', $title . ' rent invoice for ' . $from . ' - ' . $to . ' restored successfully.');
        }
        return redirect()->back()
            ->with('error', 'Failed restoring ' . $title . ' rent invoice for ' . $from . ' - ' . $to . '. Try again!');
    }

    /**
     * RentController destroy.
     */
    public function destroy(Request $request)
    {

        $z = 0;
        $c = 0;
        $success = array();
        $error = array();

        //catch ids
        $rents = $request->id != null ? $request->id : Input::get('rent');

        //count
        $counted = count($rents);

        if ($counted == 1) {

            //id
            $id = $rents;

            //find
            $app = TenantRent::onlyTrashed()->where('id', $id)->first();

            //check if null
            if ($app == null)
                return redirect()->back()
                    ->with('error', 'You tried to perform an action on an empty record.');

            //title
            $title = $app->property->title;
            $from = MonthNameReturn($app->date_from);
            $to = MonthNameReturn($app->date_to);

            //delete
            if ($app->forceDelete()) {
                return redirect()->back()
                    ->with('success', 'Invoice deletion successful. ' . $title . ' rent invoice for ' . $from . ' - ' . $to . ' is removed completely!');
            }

            return redirect()->back()
                ->with('error', 'Failed deleting ' . $title . ' rent invoice for ' . $from . ' - ' . $to . '. Try again!');
        } else {
            foreach ($rents as $id) {
                $app = TenantRent::onlyTrashed()->where('id', $id)->first();

                //check if null
                if ($app != null) {

                    //rent details
                    $title = $app->property->title;
                    $from = MonthNameReturn($app->date_from);
                    $to = MonthNameReturn($app->date_to);

                    //delete check
                    if ($app->forceDelete()) {
                        $c++;

                        //message
                        //$success = array_add($success, $z++, $title . ' rent for ' . $from . '-' . $to . ' invoices deleted completely.');
                    }
                }
            }

            //successful deletes
            $success = array_add($success, $z++, $c . ' of ' . $counted . ' rent invoices deleted completely');

            if ($c > 0) {
                return redirect()->back()
                    ->with('bulk_success', $success);
            }

        }

        return redirect()->back()
            ->with('error', 'You tried to delete an empty record . Select some first...');
    }

}

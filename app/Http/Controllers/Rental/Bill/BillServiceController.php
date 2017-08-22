<?php

namespace App\Http\Controllers\Rental\Bill;

use App\Http\Requests\Rental\Bill\StoreBillServiceFormRequest;
use App\Models\v1\Company\CompanyApp;
use App\Models\v1\Estate\EstateBill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param CompanyApp $app
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, CompanyApp $app)
    {
        $sort = $request->sort;

        //authorize
        $this->authorize('view', $app);

        if (isset($sort) && $sort != "all") {
            //trashed
            if ($sort == "trashed")
                $billing_services = $app->billingServices()->onlyTrashed()->latestDelete()->paginate();
            //disabled
            if ($sort == "disabled")
                $billing_services = $app->billingServices()->isNotActive()->latestFirst()->paginate();
            //active
            if ($sort == "active")
                $billing_services = $app->billingServices()->isActive()->latestFirst()->paginate();
        } else {
            $billing_services = $app->billingServices()->latestFirst()->paginate();
        }

        return view('rental.bills.services.index')
            ->with('app', $app)
            ->with('sort', $sort)
            ->with('billing_services', $billing_services);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @param CompanyApp $app
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, CompanyApp $app)
    {

        //authorize
        $this->authorize('create', $app);

        return view('rental.bills.services.create')
            ->with('app', $app);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBillServiceFormRequest|Request $request
     * @param CompanyApp $app
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBillServiceFormRequest $request, CompanyApp $app)
    {

        //validate in request

        //authorize
        $this->authorize('create', $app);

        //new billing service
        $bill = new EstateBill();
        $bill->title = $request->input('bill_name');
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
            return redirect()->route('rental.bills.services.index', [$app])
                ->withSuccess('Billing service added successfully.');
        }

        //redirect with error if failed
        return back()
            ->withError('Failed adding billing service. Try again!')
            ->withInput();

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param CompanyApp $app
     * @param EstateBill $service
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Request $request, CompanyApp $app, EstateBill $service)
    {

        //check authorized
        $this->authorize('update', $app);

        return view('rental.bills.services.edit')
            ->with('app', $app)
            ->with('service', $service);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreBillServiceFormRequest|Request $request
     * @param CompanyApp $app
     * @param EstateBill $service
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBillServiceFormRequest $request, CompanyApp $app, EstateBill $service)
    {
        //authorize
        $this->authorize('update', $app);

        //title
        $title = $request->input('bill_name');

        $amount_change = $service->billing_amount === $request->input('billing_amount');

        if ($service->tenantBills()->count() && $amount_change == true) {
            return back()
                ->withError("You cannot change `' . $title . '` billing service 'amount' since it has related records.")
                ->withInfo('You can disable it to stop its use and create a new but similar one one.');
        }

        $service->title = $title;
        $service->summary = $request->input('bill_summary');
        $service->description = $request->input('bill_details');
        $service->billing_interval = $request->input('billing_interval');
        $service->interval_type = $request->input('bill_interval_type');
        $service->billing_amount = $request->input('billing_amount');
        $service->properties = $request->input('billing_properties');
        $service->bill_plan = $request->input('billing_plan');
        $service->billing_reminder = $request->input('billing_reminder');
        $service->status = $request->input('status');

        //save
        if ($service->save()) {
            return back()
                ->withSuccess('`' . $title . '` billing service updated successfully.');
        }

        //redirect with error if failed
        return back()
            ->withError('Failed updating `' . $title . '`` billing service. Try again!')
            ->withInput();

    }

    /**
     * Update resource 'status' in storage.
     *
     * @param Request $request
     * @param CompanyApp $app
     * @param EstateBill $service
     * @return mixed
     */
    public function toggleStatus(Request $request, CompanyApp $app, EstateBill $service)
    {
        //authorize
        $this->authorize('update', $app);

        $service->status == 1 ? $service->status = 0 : $service->status = 1;

        if ($service->save())
            return back()
                ->withSuccess('`' . $service->title . '` billing service status updated successfully!');
        else
            return back()
                ->withError('`' . $service->title . '` billing service status update failed. Try again!');

    }

    /**
     * Soft delete resource in storage.
     *
     * @param Request $request
     * @param CompanyApp $app
     * @param EstateBill $service
     * @return mixed
     */
    public function delete(Request $request, CompanyApp $app, EstateBill $service)
    {
        //authorize
        $this->authorize('delete', $app);

        //title
        $title = $service->title;

        if ($service->tenantBills()->count()) {
            return back()
                ->withError('You cannot remove `' . $title . '` billing service since it has related records.')
                ->withInfo('You can disable it to stop its use and create a new but similar one one.');
        }

        //delete
        if ($service->delete()) {
            return back()
                ->withSuccess('`' . $title . '` billing service moved to trash successfully.');
        }

        return back()
            ->withError('Failed moving `' . $title . '` billing service to trash. Try again!');
    }

    /**
     * Restore soft deleted resource in storage.
     *
     * @param Request $request
     * @param CompanyApp $app
     * @param $service
     * @return mixed
     */
    public function restore(Request $request, CompanyApp $app, $service)
    {
        //find
        $service = EstateBill::onlyTrashed()->where('id', $service)->firstOrFail();

        //authorize
        $this->authorize('update', $app);

        //restore
        if ($service->restore()) {
            return back()
                ->withSuccess('`' . $service->title . '` billing service restored successfully.');
        }
        return back()
            ->withError('Failed restoring `' . $service->title . '` billing service. Try again!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param CompanyApp $app
     * @param EstateBill $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CompanyApp $app, $service)
    {
        //authorize
        $this->authorize('delete', $app);

        //find
        $service = EstateBill::onlyTrashed()->where('id', $service)->firstOrFail();

        //title
        $title = $service->title;

        if ($service->tenantBills()->count()) {
            return back()
                ->withError('You cannot delete `' . $title . '` billing service since it has related records.')
                ->withInfo('You can disable it to stop its use and create a new but similar one one.');
        }

        //delete
        if ($service->forceDelete()) {
            return back()
                ->withSuccess('`' . $title . '` billing service deleted completely.');
        }
        return back()
            ->withError('Failed deleting `' . $title . '` billing service. Try again!');
    }
}

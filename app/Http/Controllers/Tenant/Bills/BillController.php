<?php

namespace App\Http\Controllers\Tenant\Bills;

use App\Models\v1\Tenant\Tenant;
use App\Models\v1\Tenant\TenantBill;
use PDF;
use ExtCountries;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BillController extends Controller
{
    /**
     * BillController constructor.
     */
    public function __construct()
    {
        $this->middleware('tenant');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        //tenant
        $tenant = Tenant::find($id);

        //check if null
        if ($tenant == null)
            abort(404);

        $this->authorize('view', $tenant);

        //app
        $app = $tenant->company;

        //company
        $company = $app->company;

        //country
        $code = ExtCountries::where('name.common', $company->country)->first()->callingCode[0];

        //currency sign or iso code
        $currency = ExtCountries::where('name.common', $company->country)->first()->currency;
        $currency = $currency[0]['sign'] != null ? $currency[0]['sign'] : $currency[0]['ISO4217Code'];

        //bills
        $bills = $tenant->bills()->orderBy('status', 'ASC')->orderBy('date_due', 'ASC')->paginate(10);

        return view('v1.tenants.bills.index')
            ->with('app', $app)
            ->with('code', $code)
            ->with('currency', $currency)
            ->with('company', $company)
            ->with('bills', $bills)
            ->with('tenant', $tenant);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $notify_id = $request->read;

        if ($notify_id != null) {
            //find notification
            $notification = $request->user()->notifications()->where('id', $notify_id)->first();

            //mark as read
            $notification->read_at == null ? $notification->update(['read_at' => Carbon::now()]) : '';
        }

        //bill
        $bill = TenantBill::find($id);

        //check if null
        if ($bill == null)
            abort(404);

        //tenant
        $tenant = $bill->lease->tenant;

        $this->authorize('view', $tenant);

        //app
        $app = $bill->property->app;

        //company
        $company = $app->company;

        //country
        $code = ExtCountries::where('name.common', $company->country)->first()->callingCode[0];

        $currency = ExtCountries::where('name.common', $company->country)->first()->currency[0]['sign'];

//        dd($currency);

        //app
        $app = $bill->property->app;

        return view('v1.tenants.bills.show')
            ->with('app', $app)
            ->with('code', $code)
            ->with('currency', $currency)
            ->with('bill', $bill)
            ->with('tenant', $tenant);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

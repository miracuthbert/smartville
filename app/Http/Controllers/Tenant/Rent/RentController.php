<?php

namespace App\Http\Controllers\Tenant\Rent;

use App\Models\v1\Tenant\Tenant;
use App\Models\v1\Tenant\TenantRent;
use Carbon\Carbon;
use PDF;
use ExtCountries;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RentController extends Controller
{
    /**
     * RentController constructor.
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
    public function index($id)
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

        //leases
        $leases = $tenant->leases;

        //rents
        $rents = $tenant->rents()->orderBy('status', 'ASC')->orderBy('date_due', 'ASC')->paginate(25);

        //bills
        $bills = $tenant->bills;

        return view('v1.tenants.rents.index')
            ->with('app', $app)
            ->with('code', $code)
            ->with('currency', $currency)
            ->with('company', $company)
            ->with('leases', $leases)
            ->with('rents', $rents)
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param  int $id
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

        //rent
        $rent = TenantRent::find($id);

        //check if null
        if ($rent == null)
            abort(404);

        //tenant
        $tenant = $rent->lease->tenant;

        $this->authorize('view', $tenant);

        //app
        $app = $rent->property->app;

        //company
        $company = $app->company;

        //country
        $code = ExtCountries::where('name.common', $company->country)->first()->callingCode[0];

        //currency sign or iso code
        $currency = ExtCountries::where('name.common', $company->country)->first()->currency;
        $currency = $currency[0]['sign'] != null ? $currency[0]['sign'] : $currency[0]['ISO4217Code'];

        return view('v1.tenants.rents.show')
            ->with('app', $app)
            ->with('code', $code)
            ->with('currency', $currency)
            ->with('company', $company)
            ->with('rent', $rent)
            ->with('tenant', $tenant);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

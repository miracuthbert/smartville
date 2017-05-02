<?php

namespace App\Http\Controllers\Tenant;

use App\Models\v1\Tenant\Tenant;
use Carbon\Carbon;
use ExtCountries;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    /**
     * AdminController constructor.
     */
    public function __construct()
    {
        $this->middleware('tenant');
    }

    /**
     * AdminController dashboard.
     * @param Request $request
     * @param $id
     * @return
     */
    public function dashboard(Request $request, $id)
    {
        //tenant
        $tenant = Tenant::find($id);

        $this->authorize('view', $tenant);

        $notify_id = $request->read;

        if ($notify_id != null) {
            //find notification
            $notification = $request->user()->notifications()->where('id', $notify_id)->first();

            //mark as read
            $notification->read_at == null ? $notification->update(['read_at' => Carbon::now()]) : '';
        }

        //app
        $app = $tenant->company;

        //company
        $company = $app->company;

        //country code
        $code = ExtCountries::where('name.common', $company->country)->first()->callingCode[0];

        //currency sign or iso code
        $currency = ExtCountries::where('name.common', $company->country)->first()->currency;
        $currency = $currency[0]['sign'] != null ? $currency[0]['sign'] : $currency[0]['ISO4217Code'];

        //leases
        $leases = $tenant->leases()->orderBy('move_in', 'DESC')->paginate(3);

        //rents
        $rents = $tenant->rents()->where('tenant_rents.status', 0)->orderBy('date_due', 'ASC')->paginate(3);

        //bills
        $bills = $tenant->bills()->where('tenant_bills.status', 0)->orderBy('date_due', 'ASC')->paginate(3);

        return view('v1.tenants.dashboard')
            ->with('app', $app)
            ->with('code', $code)
            ->with('currency', $currency)
            ->with('company', $company)
            ->with('leases', $leases)
            ->with('rents', $rents)
            ->with('bills', $bills)
            ->with('tenant', $tenant);
    }

}

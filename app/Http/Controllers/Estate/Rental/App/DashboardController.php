<?php

namespace App\Http\Controllers\Estate\Rental\App;

use App\Models\v1\Company\CompanyApp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('company.app.admin');
    }

    /**
     * Show the dashboard for the 'rental' app
     *
     * @param $id
     * @return
     */
    function __invoke($id)
    {
        $app = CompanyApp::find($id);

        //check app
        if ($app == null)
            abort(404);

        //authorize
        $this->authorize('view', $app);

        //properties
        $properties = $app->properties()->paginate();

        //tenants
        $tenants = $app->leases()->orderBy('move_in', 'DESC')->where('tenant_properties.status', 1)->paginate();

        //pending bills
        $p_bills = $app->bills()->where('tenant_bills.status', 0)->whereNull('paid_at')->orderBy('date_due', 'ASC')->paginate();

        //pending rent
        $p_rents = $app->rents()->where('tenant_rents.status', 0)->whereNull('paid_at')->orderBy('date_due', 'ASC')->paginate();

        //pending bills
        $p_bills_month = $app->bills()->where('tenant_bills.status', 0)->whereNull('paid_at')
            ->whereMonth('date_due', Carbon::today()->month)->orderBy('date_due', 'ASC')->paginate();

        //pending rent
        $p_rents_month = $app->rents()->where('tenant_rents.status', 0)->whereNull('paid_at')
            ->whereMonth('date_due', Carbon::today()->month)->orderBy('date_due', 'ASC')->paginate();

        return view('v1.estates.dashboard')
            ->with('app', $app)
            ->with('properties', $properties)
            ->with('tenants', $tenants)
            ->with('p_bills', $p_bills)
            ->with('pm_bills', $p_bills_month)
            ->with('p_rents', $p_rents)
            ->with('pm_rents', $p_rents_month);

    }


}

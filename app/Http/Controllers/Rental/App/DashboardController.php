<?php

namespace App\Http\Controllers\Rental\App;

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
        $app = CompanyApp::with([
            'leases' => function ($query) {
                $query->orderBy('move_in', 'DESC')->where('tenant_properties.status', 1);
            },
            'properties',
            'bills' => function ($query) {
                $query->where('tenant_bills.status', 0)->whereNull('paid_at')->orderBy('date_due', 'ASC');
            },
            'rents' => function ($query) {
                $query->where('tenant_rents.status', 0)->whereNull('paid_at')->orderBy('date_due', 'ASC');
            },
        ])->find($id);

        //check app
        if ($app == null)
            abort(404);

        //authorize
        $this->authorize('view', $app);

        //properties
        $properties = $app->properties()->paginate(5);

        //tenants
        $tenants = $app->leases()->paginate(5);

        //pending bills
        $p_bills = $app->bills()->with(['property', 'bill'])->paginate(5);

        //pending rent
        $p_rents = $app->rents()->with(['property', 'lease'])->paginate(5);

        //pending bills
        $p_bills_month = $app->bills()->with(['property', 'bill'])->where('tenant_bills.status', 0)->whereNull('paid_at')
            ->whereMonth('date_due', Carbon::today()->month)->orderBy('date_due', 'ASC')->paginate(5);

        //pending rent
        $p_rents_month = $app->rents()->with(['property', 'lease'])->where('tenant_rents.status', 0)->whereNull('paid_at')
            ->whereMonth('date_due', Carbon::today()->month)->orderBy('date_due', 'ASC')->paginate(5);

        return view('rental.dashboard.index')
            ->with('app', $app)
            ->with('properties', $properties)
            ->with('tenants', $tenants)
            ->with('p_bills', $p_bills)
            ->with('pm_bills', $p_bills_month)
            ->with('p_rents', $p_rents)
            ->with('pm_rents', $p_rents_month);

    }


}

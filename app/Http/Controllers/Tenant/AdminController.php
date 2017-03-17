<?php

namespace App\Http\Controllers\Tenant;

use App\Tenant;
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
     */
    public function dashboard($id)
    {
        //tenant
        $tenant = Tenant::find($id);

        $this->authorize('view', $tenant);

        //app
        $app = $tenant->company;

        //leases
        $leases = $tenant->leases;

        //rents
        $rents = $tenant->rents()->orderBy('date_due', 'ASC')->paginate(3);

        //bills
        $bills = $tenant->bills()->orderBy('date_due', 'ASC')->paginate(3);

        return view('v1.tenants.dashboard')
            ->with('app', $app)
            ->with('leases', $leases)
            ->with('rents', $rents)
            ->with('bills', $bills)
            ->with('tenant', $tenant);
    }


}

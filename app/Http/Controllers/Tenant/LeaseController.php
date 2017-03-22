<?php

namespace App\Http\Controllers\Tenant;

use App\Models\v1\Tenant\Tenant;
use App\Models\v1\Tenant\TenantProperty;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LeaseController extends Controller
{

    /**
     * LeaseController constructor.
     */
    public function __construct()
    {
        $this->middleware('tenant');
    }

    /**
     * LeaseController dashboard.
     */
    public function index($id)
    {
        //tenant
        $tenant = Tenant::find($id);

        $this->authorize('view', $tenant);

        //app
        $app = $tenant->company;

        //leases
        $leases = $tenant->leases()->orderBy('move_in', 'DESC')->paginate(10);

        return view('v1.tenants.leases.index')
            ->with('app', $app)
            ->with('leases', $leases)
            ->with('tenant', $tenant);
    }


    /**
     * LeaseController lease.
     */
    public function lease($id)
    {
        //lease
        $lease = TenantProperty::find($id);

        //check if null
        if ($lease == null)
            abort(404);

        //tenant
        $tenant = $lease->tenant;

        $this->authorize('view', $tenant);

        //app
        $app = $lease->tenant->company;

        //group
        $group = $lease->property->property_group;

        //property
        $property = $lease->property;

        return view('v1.tenants.leases.edit')
            ->with('app', $app)
            ->with('lease', $lease)
            ->with('group', $group)
            ->with('property', $property)
            ->with('tenant', $tenant);
    }
}

<?php

namespace App\Http\Controllers\Tenant;

use App\Tenant;
use App\TenantRent;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
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
     * RentController index.
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

        //leases
        $leases = $tenant->leases;

        //rents
        $rents = $tenant->rents()->orderBy('date_due', 'ASC')->paginate(25);

        //bills
        $bills = $tenant->bills;

        return view('v1.tenants.rents.index')
            ->with('app', $app)
            ->with('leases', $leases)
            ->with('rents', $rents)
            ->with('bills', $bills)
            ->with('tenant', $tenant);

    }

    /**
     * RentController rent.
     */
    public function rent($id)
    {
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

        return view('v1.tenants.rents.edit')
            ->with('app', $app)
            ->with('rent', $rent)
            ->with('tenant', $tenant);

    }

    /**
     * RentController billToPdf.
     * @param $id
     * @return mixed
     */
    public function rentToPdf($id)
    {
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

        //product
        $product = $app->product;

        //property
        $property = $rent->property;

        //when
        $when = Carbon::now();

//        return view('v1.tenants.downloads.rents.single.default')
//            ->with('app', $app)
//            ->with('company', $company)
//            ->with('rent', $rent)
//            ->with('tenant', $tenant);

        //generate pdf
        //pdf options
        $pdf = PDF::setOptions(['defaultMediaType' => 'all', 'defaultFont' => 'sans-serif']);

        //view render
        $pdf->loadView('v1.tenants.downloads.rents.single.default', [
            'app' => $app,
            'company' => $company,
            'rent' => $rent,
            'property' => $property,
            'tenant' => $tenant,
            'when' => $when
        ]);

        //paper and layout
        $pdf->setPaper('a4', 'portrait');

        //pdf name
        $pdfName = $company->title . ' - ' . title_case($property->title) . ' Invoice ' . ' (' . $when . ')';

        //download and redirect
        return $pdf->download($pdfName . '.pdf');

    }

}

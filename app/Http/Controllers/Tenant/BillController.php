<?php

namespace App\Http\Controllers\Tenant;

use App\Tenant;
use App\TenantBill;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
     * BillController index.
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

        //bills
        $bills = $tenant->bills()->orderBy('date_due', 'ASC')->paginate(25);

        return view('v1.tenants.bills.index')
            ->with('app', $app)
            ->with('bills', $bills)
            ->with('tenant', $tenant);

    }

    /**
     * BillController bill.
     * @param $id
     * @return mixed
     */
    public function bill($id)
    {
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

        return view('v1.tenants.bills.edit')
            ->with('app', $app)
            ->with('bill', $bill)
            ->with('tenant', $tenant);
    }

    /**
     * BillController billToPdf.
     * @param $id
     * @return mixed
     */
    public function billToPdf($id)
    {
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

        //product
        $product = $app->product;

        //bill
        $_bill = $bill->bill;

        //when
        $when = Carbon::now();

//        return view('v1.tenants.downloads.bills.single.default')
//            ->with('app', $app)
//            ->with('company', $company)
//            ->with('bill', $bill)
//            ->with('tenant', $tenant);

        //generate pdf
        //pdf options
        $pdf = PDF::setOptions(['defaultMediaType' => 'all', 'defaultFont' => 'sans-serif']);

        //view render
        $pdf->loadView('v1.tenants.downloads.bills.single.default', [
            'app' => $app,
            'company' => $company,
            'bill' => $bill,
            'tenant' => $tenant,
            'when' => $when
        ]);

        //paper and layout
        $pdf->setPaper('a4', 'portrait');

        //pdf name
        $pdfName = $company->title . ' - ' . title_case($_bill->title) . ' Invoice ' . ' (' . $when . ')';

        //download and redirect
        return $pdf->download($pdfName . '.pdf');

    }
}

<?php

namespace App\Http\Controllers\Tenant\Bills;

use App\Models\v1\Tenant\TenantBill;
use PDF;
use ExtCountries;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PdfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function show($id)
    {
        //
    }

    /**
     * Download the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id)
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

        //country
        $code = ExtCountries::where('name.common', $company->country)->first()->callingCode[0];

        //currency sign or iso code
        $currency = ExtCountries::where('name.common', $company->country)->first()->currency;
        $currency = $currency[0]['sign'] != null ? $currency[0]['sign'] : $currency[0]['ISO4217Code'];

        //country
//        $timezone = ExtCountries::where('name.common', $company->country)->first()->timezone;

//        $states = ExtCountries::where('name.common', $company->country)->first()->states->sortBy('name')->pluck('name', 'postal');

        //product
        $product = $app->product;

        //bill
        $_bill = $bill->bill;

        //when
        $when = Carbon::now();

//        return view('v1.tenants.downloads.bills.single.draft.default')
//            ->with('app', $app)
//            ->with('timezone', $timezone)
//            ->with('code', $code)
//            ->with('company', $company)
//            ->with('bill', $bill)
//            ->with('tenant', $tenant);

        //generate pdf
        //pdf options
        $pdf = PDF::setOptions(['defaultMediaType' => 'all', 'defaultFont' => 'sans-serif']);

        //view render
        $pdf->loadView('v1.tenants.downloads.bills.single.00', [
            'app' => $app,
            'code' => $code,
            'currency' => $currency,
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

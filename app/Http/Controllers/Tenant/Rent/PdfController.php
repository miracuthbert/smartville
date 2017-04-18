<?php

namespace App\Http\Controllers\Tenant\Rent;

use App\Models\v1\Tenant\TenantRent;
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * Download the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function download($id)
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

        //country
        $code = ExtCountries::where('name.common', $company->country)->first()->callingCode[0];

        //currency sign or iso code
        $currency = ExtCountries::where('name.common', $company->country)->first()->currency;
        $currency = $currency[0]['sign'] != null ? $currency[0]['sign'] : $currency[0]['ISO4217Code'];

        //product
        $product = $app->product;

        //property
        $property = $rent->property;

        //when
        $when = Carbon::now();

        //Uncomment lines below to preview the template
//        return view('v1.tenants.downloads.rents.single.00', [
//            'app' => $app,
//            'code' => $code,
//            'currency' => $currency,
//            'company' => $company,
//            'rent' => $rent,
//            'property' => $property,
//            'tenant' => $tenant,
//            'when' => $when
//        ]);

        //generate pdf
        //pdf options
        $pdf = PDF::setOptions(['defaultMediaType' => 'all', 'defaultFont' => 'sans-serif']);

        //view render
        $pdf->loadView('v1.tenants.downloads.rents.single.00', [
            'app' => $app,
            'code' => $code,
            'currency' => $currency,
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

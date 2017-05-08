<?php

namespace App\Http\Controllers\Estate\Rental\Property;

use App\Models\Image\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ExtCountries;
use Image;

class PhotoController extends Controller
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
    public function create(Request $request, $id)
    {
        //gallery
        $gallery = Gallery::find($id);

        //Property
        $property = $gallery->galleryable;

        //check app
        if ($property == null)
            abort(404);

        //Property App
        $app = $property->app;

        //company
        $company = $app->company;

        //country code
        $code = ExtCountries::where('name.common', $company->country)->first()->callingCode[0];

        //currency sign or iso code
        $currency = ExtCountries::where('name.common', $company->country)->first()->currency;
        $currency = $currency[0]['sign'] != null ? $currency[0]['sign'] : $currency[0]['ISO4217Code'];

        //authorize
        $this->authorize('view', $app);

        //TODO: use for debug only
        //dd($property->prices()->where('status',1)->first());

        return view('v1.estates.properties.photos.create')
            ->with('app', $app)
            ->with('code', $code)
            ->with('currency', $currency)
            ->with('company', $company)
            ->with('property', $property)
            ->with('gallery', $gallery);
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

<?php

namespace App\Http\Controllers\Rental\Property;

use App\Models\v1\Company\CompanyApp;
use App\Models\v1\Estate\EstateProperty;
use App\Models\v1\Property\PropertyAmenity;
use App\Models\v1\Shared\Amenity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PropertyAmenityController extends Controller
{
    /**
     * PropertyAmenityController constructor.
     */
    public function __construct()
    {
        $this->middleware('company.app.admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param CompanyApp $app
     * @param EstateProperty $property
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, CompanyApp $app, EstateProperty $property)
    {
        //authorize
        $this->authorize('update', $app);

        return view('rental.properties.amenities.index')
            ->with('app', $app)
            ->with('property_price', $property->price)
            ->with('amenities', $app->amenities()->with(['properties'])->where('status', 1)->get())
            ->with('groups', $app->groups()->where('status', 1)->get())
            ->with('property', $property);
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
     * @param CompanyApp $app
     * @param EstateProperty $property
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CompanyApp $app, EstateProperty $property)
    {
        $amenities = $request->input('amenity');
        $amenity_success = 0;
        $extra_msg = null;

        //sync
        $property->amenities()->syncWithoutDetaching($amenities);
        $amenities_count = count($amenities);              //count amenities

        //soft delete amenities
        $deletes = $property->amenities()->whereNotIn('amenity_id', $amenities)->get();

        foreach ($deletes as $delete) {
            $property->amenities()->detach($delete->id);
            $amenity_success++;
        }

        if ($amenity_success > 0) {
            $extra_msg = $amenity_success . str_plural(' amenity', $amenity_success) . " removed.";
        }

        return back()->
        withSuccess("{$amenities_count} " . str_plural('amenity', $amenities_count) . " added to property. {$extra_msg}");

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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

<?php

namespace App\Http\Controllers\Estate\Rental\Property;

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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        //Property
        $property = EstateProperty::find($id);

        //check app
        if ($property == null)
            abort(404);

        //Property App
        $app = $property->app;

        //authorize
        $this->authorize('view', $app);

        //TODO: use for debug only
        //dd($property->prices()->where('status',1)->first());

        return view('v1.estates.properties.amenities.index')
            ->with('app', $app)
            ->with('old_prices', $property->prices()->where('status', 0)->get())
            ->with('property_price', $property->prices()->where('status', 1)->first())
            ->with('amenities', $app->amenities()->where('status', 1)->get())
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->input('id');

        //save property
        $property = EstateProperty::find($id);

        $amenities = $request->input('amenity');
        $amenities_length = count($amenities);              //count amenities
        $amenity_success = 0;
        $amenity_fails = 0;
        $success = array();
        $error = array();

        //check if amenities is empty
        if ($amenities_length > 0) {

            $_property_amenities = $property->amenities()->where('property_id', $id)->get();

            $_in = array();

            foreach ($_property_amenities as $item) {
                $_in = array_add($_in, $item->amenity_id, $item->amenity_id);
            }

            foreach ($_in as $item) {
                if (collect($amenities)->search($item)) {
//                        $_in = array_add($_in, $item, $item);
                } else {
                    $_amenity = PropertyAmenity::where('property_id', $id)->where('amenity_id', $item)->first();

                    if ($_amenity->status == 1) {
                        $_amenity->status = 0;

                        if ($_amenity->save()) { //if property amenity status is 1
                            $success = array_add($success, $_amenity->id, $_amenity->amenity->title . ' amenity status updated.');
                        } else {
                            $error = array_add($error, $_amenity->id, $_amenity->amenity->title . ' amenity status update failed.');
                        }
                    }
                }
            }

            foreach ($amenities as $amenity) {
                //save if not empty
                $amenity_model = Amenity::find($amenity);

                if (!empty($amenity_model)) {

                    $_property = PropertyAmenity::where('property_id', $id)->where('amenity_id', $amenity)->first();

                    $title = $amenity_model->title;

                    if (empty($_property)) {//find amenity
                        //amenity title

                        //add amenity
                        $new_amenity = new PropertyAmenity();
                        $new_amenity->amenity_id = $amenity;
                        $new_amenity->property_id = $property->id;

                        //save amenity
                        if ($amenity_model->properties()->save($new_amenity)) {
                            $success = array_add($success, $title, $title . " amenity added to " . $property->title);
                            $amenity_success++;
                        } else {
                            $error = array_add($error, $title, "Failed to add " . $title . ' amenity to ' . $property->title);
                            $amenity_fails++;
                        }
                    } else {
                        if ($_property->status == 0) {//if property amenity status is 0
                            $_property->status = 1;

                            $update_amenity = $_property->save();

                            if ($update_amenity) {
                                $success = array_add($success, $_property->id, $title . ' amenity status updated.');
                            } else {
                                $error = array_add($error, $_property->id, $title . ' amenity status update failed.');
                            }

                        }
                    }
                }
            }

            //amenities added
            if ($amenity_success > 0)
                $success = array_add($success, 'Amenities', 'Only ' . $amenity_success . ' of ' . $amenities_length . ' amenities added successfully!');

            //amenities failed
            if ($amenity_fails > 0)
                $error = array_add($error, 'Amenities', 'Only ' . $amenity_fails . ' of ' . $amenities_length . ' amenities not added.');


            return redirect()->back()
                ->with('bulk_error', $error)
                ->with('bulk_success', $success)
                ->with('success', 'Property amenities updated.');
        }

        return redirect()->back()
            ->with('error', 'No changes made.');
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

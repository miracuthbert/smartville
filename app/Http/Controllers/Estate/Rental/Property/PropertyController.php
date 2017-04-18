<?php

namespace App\Http\Controllers\Estate\Rental\Property;

use App\Http\Requests\Estate\Rental\Property\StorePropertyRequest;
use App\Models\v1\Company\CompanyApp;
use App\Models\v1\Estate\EstateProperty;
use App\Models\v1\Property\PropertyAmenity;
use App\Models\v1\Property\PropertyFeature;
use App\Models\v1\Property\PropertyPrice;
use App\Models\v1\Shared\Amenity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ExtCountries;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id, $sort)
    {
        //app
        $app = CompanyApp::find($id);

        //check app
        if ($app == null)
            abort(404);

        //layout
        $layout = $request->layout != null ? $request->layout : '';

        //authorize
        $this->authorize('view', $app);

        //company
        $company = $app->company;

        //country code
        $code = ExtCountries::where('name.common', $company->country)->first()->callingCode[0];

        //currency sign or iso code
        $currency = ExtCountries::where('name.common', $company->country)->first()->currency;
        $currency = $currency[0]['sign'] != null ? $currency[0]['sign'] : $currency[0]['ISO4217Code'];

        //properties
        if ($sort == "all")
            $properties = $app->properties()->paginate(25);
        if ($sort == "trashed")
            $properties = $app->propertiesTrashed()->paginate(25);
        if ($sort == "active")
            $properties = $app->properties()->where('status', 1)->paginate(25);
        if ($sort == "vacant")
            $properties = $app->properties()->where('status', 0)->paginate(25);

        return view('v1.estates.properties.index')
            ->with('app', $app)
            ->with('code', $code)
            ->with('currency', $currency)
            ->with('company', $company)
            ->with('sort', $sort)
            ->with('properties', $properties)
            ->with('layout', $layout);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //app
        $app = CompanyApp::find($id);

        //check app
        if ($app == null)
            abort(404);

        //authorize
        $this->authorize('view', $app);

        //company
        $company = $app->company;

        //country code
        $code = ExtCountries::where('name.common', $company->country)->first()->callingCode[0];

        //currency sign or iso code
        $currency = ExtCountries::where('name.common', $company->country)->first()->currency;
        $currency = $currency[0]['sign'] != null ? $currency[0]['sign'] : $currency[0]['ISO4217Code'];

        return view('v1.estates.properties.create')
            ->with('code', $code)
            ->with('currency', $currency)
            ->with('company', $company)
            ->with('amenities', $app->amenities()->where('status', 1)->get())
            ->with('groups', $app->groups()->where('status', 1)->get())
            ->with('app', $app);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePropertyRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePropertyRequest $request)
    {
        //catch input
        $app = CompanyApp::find($request->input('_app'));
        $group = $request->input('group');
        $rentable = $request->input('_rentable');
        $multiple = $request->input('multiple_tenancy');
        $amenities = $request->input('amenity');
        $features = $request->input('feature');             //feature title
        $details = $request->input('details');              //feature details
        $values = $request->input('value');                 //feature no.
        $amenities_length = count($amenities);              //count amenities
        $features_length = count($features);                //count features
        $amenity_success = 0;
        $feature_success = 0;
        $amenity_fails = 0;
        $feature_fails = 0;
        $success = array();
        $error = array();
        $amenity_failed = array();

        //save property
        $property = new EstateProperty();
        $property->title = $request->input('title');
        $property->summary = $request->input('summary');
        $property->description = $request->input('description');
        $property->property_type = $request->input('type');
        $property->size = $request->input('size');
        $property->interval = $request->input('interval');

        //check if group not null
        if (!empty($group)) {
            if (integerValue($group))
                $property->property_group = $group;
        }

        //check if rentable
        if ($rentable) {
            $property->rentable = $rentable;

            if ($multiple) {
                $property->multiple_tenancy = $multiple;
                $property->tenants = $request->input('interval');
            }
        }

        $property->location = $request->input('location');
        $property->status = $request->input('status');

        if ($app->properties()->save($property)) {

            //property id
            $id = $property->id;
            $prop_title = $property->title;

            $price = new PropertyPrice();
            $price->property_id = $id;
            $price->price = $request->input('price');

            //save price
            if ($price->save()) {
                $success = array_add($success, "Price", "Property price added successfully.");
            } else {
                $error = array_add($error, "Price", "Property price not added.");
            }

            //check if amenities is empty
            if ($amenities_length > 0) {
                //loop
                foreach ($amenities as $amenity) {
                    //find amenity
                    $amenity_model = Amenity::find($amenity);
                    //save if not empty
                    if (!empty($amenity_model)) {
                        //amenity title
                        $title = $amenity_model->title;

                        $new_amenity = new PropertyAmenity();
                        $new_amenity->amenity_id = $amenity;
                        $new_amenity->property_id = $property->id;

                        //save amenity
                        if ($amenity_model->properties()->save($new_amenity)) {
                            $success = array_add($success, $title, $title . " amenity added to " . $prop_title);
                            $amenity_success++;
                        } else {
                            $error = array_add($error, $title, "Failed to add " . $title . ' amenity to ' . $prop_title);
                            $amenity_fails++;
                        }
                    }
                } //loop end

                //amenities added
                if ($amenity_success > 0)
                    $success = array_add($success, 'Amenities', $amenity_success . ' of ' . $amenities_length . ' amenities added successfully!');

                //amenities failed
                if ($amenity_fails > 0)
                    $error = array_add($error, 'Amenities', $amenity_fails . ' amenities not added.');
            }

            //check if feature is empty
            if ($features_length > 0) {
                //loop
                for ($i = 0; $i < $features_length; $i++) {
                    //save if not empty
                    if (!empty($features[$i])) {
                        //new feature
                        $feature = new PropertyFeature();

                        $feature->property_id = $id;
                        $feature->title = $features[$i];
                        $feature->details = $details[$i];
                        $feature->total_no = $values[$i];

                        //save feature
                        if ($feature->save()) {
                            $success = array_add($success, $features[$i], "Feature " . $features[$i] . " added to " . $prop_title);
                            $feature_success++;
                        } else {
                            $error = array_add($error, $features[$i], $features[$i] . " not added to " . $prop_title);
                            $feature_fails++;
                        }
                    }
                } //loop end

                //features added
                if ($feature_success > 0)
                    $success = array_add($success, 'Features', $feature_success . " of " . $features_length . " features added successfully!");

                //features failed
                if ($feature_fails > 0)
                    $error = array_add($error, 'Features', $feature_fails . " features not added.");
            }

            return redirect()->route('estate.rental.properties', ['id' => $app->id, 'sort' => 'all'])
                ->with('bulk_error', $error)
                ->with('bulk_success', $success)
                ->with('success', 'Property added successfully.');
        }

        //redirect with error if failed
        return redirect()->back()
            ->with('error', 'Failed adding property. Try again!')
            ->withInput();
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
        //Property
        $property = EstateProperty::find($id);

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

        return view('v1.estates.properties.edit')
            ->with('app', $app)
            ->with('code', $code)
            ->with('currency', $currency)
            ->with('company', $company)
            ->with('old_prices', $property->prices()->where('status', 0)->get())
            ->with('property_price', $property->prices()->where('status', 1)->first())
            ->with('amenities', $app->amenities()->where('status', 1)->get())
            ->with('groups', $app->groups()->where('status', 1)->get())
            ->with('property', $property);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StorePropertyRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePropertyRequest $request, $id)
    {

        //catch input
        $id = $request->input('id');
        $group = $request->input('group');
        $rentable = $request->input('_rentable');
        $multiple = $request->input('multiple_tenancy');

        //save property
        $property = EstateProperty::find($id);

        $property->title = $request->input('title');
        $property->summary = $request->input('summary');
        $property->description = $request->input('description');
        $property->property_type = $request->input('type');
        $property->size = $request->input('size');
        $property->interval = $request->input('interval');
        $amenities = $request->input('amenity');
        $features = $request->input('feature');             //feature title
        $details = $request->input('details');              //feature details
        $values = $request->input('value');                 //feature no.
        $amenities_length = count($amenities);              //count amenities
        $features_length = count($features);                //count features
        $amenity_success = 0;
        $feature_success = 0;
        $amenity_fails = 0;
        $feature_fails = 0;
        $success = array();
        $error = array();

//        dd($_amenities);

        //check if group not null
        if (!empty($group)) {
            if (integerValue($group))
                $property->property_group = $group;
        }

        //check if rentable
        if ($rentable) {
            $property->rentable = $rentable;

            if ($multiple) {
                $property->multiple_tenancy = $multiple;
                $property->tenants = $request->input('interval');
            }
        }

        $property->location = $request->input('location');

        if ($property->save()) {
            $prop_title = $property->title;

            //price
            $oldPrice = $property->prices()->where('status', 1)->first();
            $newPrice = $request->input('price');

            if ($oldPrice->price != $newPrice) {
                //set property prices status to 0
                if ($property->prices()->update(['status' => 0])) {
                    //price
                    $price = new PropertyPrice();
                    $price->price = $newPrice;

                    //save price
                    if ($property->save($price)) {
                        $success = array_add($success, "Price", "Property price changed successfully.");
                    } else {
                        $error = array_add($error, "Price", "Property price not added.");
                    }
                } else {
                    $error = array_add($error, "Price", "Failed changing property price.");
                }
            }

            //redirect on success
            return redirect()->back()
                ->with('bulk_success', $success)
                ->with('bulk_error', $error)
                ->with('success', 'Property updated successfully.');
        }

        //redirect with error if failed
        return redirect()->back()
            ->with('error', 'Failed updating property. Try again!')
            ->withInput();
    }

    /**
     * Move to trash the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //find
        $app = EstateProperty::find($id);

        //check if null
        if ($app == null)
            return redirect()->back()
                ->with('error', 'You tried to perform an action on an invalid record.');

        //title
        $title = $app->title;

        //delete
        if ($app->delete()) {
            return redirect()->back()
                ->with('success', $title . ' moved to trash successfully.');
        }
        return redirect()->back()
            ->with('error', 'Failed moving ' . $title . ' to trash. Try again!');
    }

    /**
     * Restore the specified resource in storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        //find
        $app = EstateProperty::onlyTrashed()->where('id', $id)->first();

        //check if null
        if ($app == null)
            return redirect()->back()
                ->with('error', 'You tried to perform an action on an invalid record.');

        //restore
        if ($app->restore()) {
            return redirect()->back()
                ->with('success', $app->title . ' restored successfully.');
        }
        return redirect()->back()
            ->with('error', 'Failed restoring ' . $app->title . '. Try again!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find
        $app = EstateProperty::onlyTrashed()->where('id', $id)->first();

        //check if null
        if ($app == null)
            return redirect()->back()
                ->with('error', 'You tried to perform an action on an invalid record.');

        //title
        $title = $app->title;

        //delete
        if ($app->forceDelete()) {
            return redirect()->back()
                ->with('success', 'Property deletion successful. ' . $title . ' is removed completely!');
        }
        return redirect()->back()
            ->with('error', 'Failed deleting property. Try again!');
    }
}

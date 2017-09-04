<?php

namespace App\Http\Controllers\Rental\Property;

use App\Http\Requests\Property\StorePropertyRequest;
use App\Models\v1\Company\CompanyApp;
use App\Models\v1\Estate\EstateProperty;
use App\Models\v1\Property\Property;
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
     * PropertyController constructor.
     */
    public function __construct()
    {
        $this->middleware('company.app.admin')->except(['show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param CompanyApp $app
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, CompanyApp $app)
    {

        //sort
        $sort = $request->sort;

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
        if (isset($sort) && $sort != "all") {
            if ($sort == "trashed")
                $properties = $app->propertiesTrashed()->with(['group', 'type', 'price'])->latestDelete()->paginate();
            elseif ($sort == "active")
                $properties = $app->properties()->with(['group', 'type', 'price'])->where('status', 1)->latestFirst()->paginate();
            elseif ($sort == "vacant")
                $properties = $app->properties()->with(['group', 'type', 'price'])->where('status', 0)->latestFirst()->paginate();
        } else {
            $properties = $app->properties()->with(['group', 'type', 'price'])->latestFirst()->paginate();
        }

        return view('rental.properties.index')
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
     * @param Request $request
     * @param CompanyApp $app
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, CompanyApp $app)
    {
        //authorize
        $this->authorize('create', $app);

        //company
        $company = $app->company;

        //country code
        $code = ExtCountries::where('name.common', $company->country)->first()->callingCode[0];

        //currency sign or iso code
        $currency = ExtCountries::where('name.common', $company->country)->first()->currency;
        $currency = $currency[0]['sign'] != null ? $currency[0]['sign'] : $currency[0]['ISO4217Code'];

        return view('rental.properties.create')
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
     * @param CompanyApp $app
     * @return \Illuminate\Http\Response
     */
    public function store(StorePropertyRequest $request, CompanyApp $app)
    {
        //catch input
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
                foreach ($amenities as $amenity) {  //loop
                    //find amenity
                    $amenity = Amenity::find($amenity);

                    if (isset($amenity)) {    //save if not empty
                        $title = $amenity->title;

                        $property_amenity = new PropertyAmenity();
                        $property_amenity->amenity_id = $amenity->id;
                        $property_amenity->status = true;

                        //save amenity
                        if ($property->amenities()->save($property_amenity)) {
                            //TODO: Uncomment line below to append success message of failed amenity
                            //$success = array_add($success, $title, $title . " amenity added to " . $prop_title);
                            $amenity_success++;
                        } else {
                            //TODO: Uncomment line below to append error message of failed amenity
                            //$error = array_add($error, $title, "Failed to add " . $title . ' amenity to ' . $prop_title);
                            $amenity_fails++;
                        }
                    }   //save amenity endif
                }   //end amenity loop end

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

                    if (isset($features[$i])) { //save if not empty
                        //new feature
                        $feature = new PropertyFeature();

                        $feature->property_id = $id;
                        $feature->title = $features[$i];
                        $feature->details = $details[$i];
                        $feature->total_no = $values[$i];

                        //save feature
                        if ($feature->save()) {
//                            $success = array_add($success, $features[$i], "Feature " . $features[$i] . " added to " . $prop_title);
                            $feature_success++;
                        } else {
//                            $error = array_add($error, $features[$i], $features[$i] . " not added to " . $prop_title);
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
            }   //endif

            return redirect()->route('rental.properties.index', [$app])
                ->with('bulk_error', $error)
                ->with('bulk_success', $success)
                ->withSuccess('Property added successfully.');
        }

        //redirect with error if failed
        return back()
            ->withError('Failed adding property. Try again!')
            ->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param CompanyApp $app
     * @param $property
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, CompanyApp $app, $property)
    {
        //Property
        $property = EstateProperty::withCount([
            'galleries' => function ($query) {
                $query->where('status', 1)
                    ->where('audience_id', 17);
            },
            'features' => function ($query) {
                $query->where('status', 1);
            },
            'amenities' => function ($query) {
                $query->where('status', 1);
            },
        ])->with([
            'galleries' => function ($query) {
                $query->where('status', 1)
                    ->where('audience_id', 17);
            },
            'features' => function ($query) {
                $query->where('status', 1);
            },
            'amenities' => function ($query) {
                $query->where('status', 1);
            },
            'prices' => function ($query) {
                $query->where('status', 1);
            },
        ])->findOrFail($property);

//        dd($property->galleries()->whereNotNull('cover')->get()->random()->cover);

        //cover
        $cover = $property->galleries()->whereNotNull('cover')->get();
        $cover = count($cover) > 0 ? $cover->random()->cover : null;

        //amenities
        $amenities = $property->amenities;

        //features
        $features = $property->features;

        //Property App
        $app = $property->app;

        //company
        $company = $app->company;

        //price
        $price = $property->prices()->first();

        //country code
        $code = ExtCountries::where('name.common', $company->country)->first()->callingCode[0];

        //currency sign or iso code
        $currency = ExtCountries::where('name.common', $company->country)->first()->currency;
        $currency = $currency[0]['sign'] != null ? $currency[0]['sign'] : $currency[0]['ISO4217Code'];

        // authorize
        //TODO: to show only to company admins' uncomment
//        $this->authorize('view', $app);

        //TODO: use for debug only
        //dd($property->prices()->where('status',1)->first());

        return view('rental.properties.show')
            ->with('app', $app)
            ->with('code', $code)
            ->with('currency', $currency)
            ->with('company', $company)
            ->with('old_prices', $property->prices()->where('status', 0)->get())
            ->with('price', $price)
            ->with('amenities', $amenities)
            ->with('features', $features)
            ->with('groups', $app->groups()->where('status', 1)->get())
            ->with('cover', $cover)
            ->with('property', $property);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param CompanyApp $app
     * @param EstateProperty|Property $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, CompanyApp $app, EstateProperty $property)
    {
        //authorize
        $this->authorize('update', $app);

        //company
        $company = $app->company;

        //country code
        $code = ExtCountries::where('name.common', $company->country)->first()->callingCode[0];

        //currency sign or iso code
        $currency = ExtCountries::where('name.common', $company->country)->first()->currency;
        $currency = $currency[0]['sign'] != null ? $currency[0]['sign'] : $currency[0]['ISO4217Code'];

        return view('rental.properties.edit')
            ->with('app', $app)
            ->with('code', $code)
            ->with('currency', $currency)
            ->with('company', $company)
            ->with('old_prices', $property->prices()->where('status', 0)->get())
            ->with('property_price', $property->price)
            ->with('amenities', $app->amenities()->where('status', 1)->get())
            ->with('groups', $app->groups()->where('status', 1)->get())
            ->with('property', $property);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StorePropertyRequest|Request $request
     * @param CompanyApp $app
     * @param EstateProperty|Property $property
     * @return \Illuminate\Http\Response
     */
    public function update(StorePropertyRequest $request, CompanyApp $app, EstateProperty $property)
    {

        //authorize
        $this->authorize('update', $app);

        //init
        $success = array();
        $error = array();

        //catch input
        $group = $request->input('group');
        $rentable = $request->input('_rentable');
        $multiple = $request->input('multiple_tenancy');

        $property->title = $request->input('title');
        $property->summary = $request->input('summary');
        $property->description = $request->input('description');
        $property->property_type = $request->input('type');
        $property->size = $request->input('size');
        $property->interval = $request->input('interval');

        //check if group not null
        if (isset($group) and integerValue($group)) {
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
            //price
            $oldPrice = $property->prices()->where('status', 1)->first();
            $newPrice = $request->input('price');

            if (isset($oldPrice) && $oldPrice->price != $newPrice or !isset($oldPrice)) {
                //set property old price status to false
                if (isset($oldPrice)) {
                    $oldPrice->update(['status' => false]);
                }

                //new price
                $price = PropertyPrice::updateOrCreate(['property_id' => $property->id, 'price' => $newPrice, 'status' => true]);

                //save price
                if ($price) {
                    $success = array_add($success, "Price", "Property price changed successfully.");
                } else {
                    $error = array_add($error, "Price", "Failed changing property price.");
                }
            }

            //redirect on success
            return back()
                ->with('bulk_success', $success)
                ->with('bulk_error', $error)
                ->withSuccess('Property updated successfully.');
        }

        //redirect with error if failed
        return back()
            ->withError('Failed updating property. Try again!')
            ->withInput();
    }

    /**
     * Soft delete the specified resource from storage.
     *
     * @param Request $request
     * @param CompanyApp $app
     * @param Property $property
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, CompanyApp $app, Property $property)
    {

        //authorize
        $this->authorize('delete', $app);

        //title
        $title = $property->title;

        //delete
        if ($property->delete()) {
            return back()
                ->withSuccess($title . ' moved to trash successfully.');
        }
        return back()
            ->withError('Failed moving ' . $title . ' to trash. Try again!');
    }

    /**
     * Restore the specified resource in storage.
     *
     * @param Request $request
     * @param CompanyApp $app
     * @param $property
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, CompanyApp $app, $property)
    {
        //find
        $app = EstateProperty::onlyTrashed()->where('id', $property)->first();

        //check if null
        if ($app == null)
            return back()
                ->withError('You tried to perform an action on an invalid record.');

        //restore
        if ($app->restore()) {
            return back()
                ->withSuccess($app->title . ' restored successfully.');
        }
        return back()
            ->withError('Failed restoring ' . $app->title . '. Try again!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param CompanyApp $app
     * @param $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CompanyApp $app, $property)
    {
        //find
        $app = EstateProperty::onlyTrashed()->where('id', $property)->first();

        //check if null
        if ($app == null)
            return back()
                ->withError('You tried to perform an action on an invalid record.');

        //title
        $title = $app->title;

        //delete
        if ($app->forceDelete()) {
            return back()
                ->withSuccess('Property deletion successful. ' . $title . ' is removed completely!');
        }
        return back()
            ->withError('Failed deleting property. Try again!');
    }
}

<?php

namespace App\Http\Controllers\Estate;

use App\Models\v1\Shared\Amenity;
use App\Models\v1\Company\CompanyApp;
use App\Models\v1\Estate\EstateProperty;
use App\Models\v1\Property\PropertyAmenity;
use App\Models\v1\Property\PropertyFeature;
use App\Models\v1\Property\PropertyPrice;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{

    /**
     * PropertyController constructor.
     */
    public function __construct()
    {
        $this->middleware('company.app.admin');
    }

    /**
     * Get a validator for an incoming app group create/update request.
     *
     * @param  array $data
     * @return \Illuminate\Support\Facades\Validator
     */
    protected function validator(array $data, $type)
    {
        #TODO: fields for consideration

        if ($type === "update") {
            return $validate = Validator::make($data, [
                'id' => 'required|exists:estate_properties,id',
                'title' => 'required|min:2|max:255',
                'summary' => 'required',
                'description' => 'nullable|min:3|max:2500',
                'type' => 'required|integer|exists:categories,id',
                'group' => 'nullable|integer|exists:estate_groups,id',
                'size' => 'required|numeric',
                'interval' => 'required|integer',
                'price' => 'required|numeric',
                '_rentable' => 'required|boolean',
            ]);
        } else if ($type == "features") {
            return $validate = Validator::make($data, [
                'feature.*' => 'required|string',
                'details.*' => 'required|string',
                'value.*' => 'required|numeric',
            ]);
        } else if ($type == "featuresUpdate") {
            return $validate = Validator::make($data, [
                'id' => 'required|exists:property_features,id',
                'feature' => 'required|min:2|max:255',
                'details.*' => 'required|string|min:2|max:255',
                'value.*' => 'required|numeric',
            ]);
        } else {
            return $validate = Validator::make($data, [
                '_app' => 'required|integer|exists:company_apps,id',
                'title' => 'required|min:2|max:255',
                'summary' => 'required',
                'description' => 'nullable|min:3|max:2500',
                'type' => 'required|integer|exists:categories,id',
                'group' => 'nullable|integer|exists:estate_groups,id',
                'size' => 'required|numeric',
                'interval' => 'required|integer',
                'price' => 'required|numeric',
                '_rentable' => 'required|boolean',
                'amenity.*' => 'integer',
                'feature.*' => 'string',
                'details.*' => 'string',
                'value.*' => 'numeric',
                'status' => 'required|boolean',
            ]);
        }
    }

    /**
     * PropertyController create.
     * Get Add Estate Property.
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

        return view('v1.estates.properties.create')
            ->with('amenities', $app->amenities()->where('status', 1)->get())
            ->with('groups', $app->groups()->where('status', 1)->get())
            ->with('app', $app);
    }

    /**
     * PropertyController index.
     * Get Estate Properties.
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
            ->with('sort', $sort)
            ->with('properties', $properties)
            ->with('layout', $layout);
    }

    /**
     * PropertyController edit.
     * Get Estate Property.
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

        //authorize
        $this->authorize('view', $app);

        //TODO: use for debug only
        //dd($property->prices()->where('status',1)->first());

        return view('v1.estates.properties.edit')
            ->with('app', $app)
            ->with('old_prices', $property->prices()->where('status', 0)->get())
            ->with('property_price', $property->prices()->where('status', 1)->first())
            ->with('amenities', $app->amenities()->where('status', 1)->get())
            ->with('groups', $app->groups()->where('status', 1)->get())
            ->with('property', $property);
    }

    /**
     * PropertyController amenities.
     * Get Estate Property.
     */
    public function amenities($id)
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
     * PropertyController features.
     * Get Estate Property features.
     */
    public function features($id)
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

        //property type
        $type = $property->type;

        //TODO: find property type features
        $results = collect();

        foreach ($type->features as $feature) {
            $result = $property->features()->where('title', 'like', '%' . $feature['name'] . '%')->first();
            $results->push($result);
        }

        //TODO: use for debug only
        //dd($property->prices()->where('status',1)->first());

        return view('v1.estates.properties.features.index')
            ->with('app', $app)
            ->with('old_prices', $property->prices()->where('status', 0)->get())
            ->with('property_price', $property->prices()->where('status', 1)->first())
            ->with('amenities', $app->amenities()->where('status', 1)->get())
            ->with('groups', $app->groups()->where('status', 1)->get())
            ->with('results', $results)
            ->with('type', $type)
            ->with('property', $property);
    }

    /**
     * PropertyController store.
     */
    public function store(Request $request)
    {
        $validator = $this->validator($request->all(), null);

        //check for errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

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
     * PropertyController update.
     */
    public function update(Request $request)
    {
        $validator = $this->validator($request->all(), "update");

        //check for errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

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
     * PropertyController update features.
     */
    public function addFeatures(Request $request)
    {
        $validator = $this->validator($request->all(), "features");

        //check for errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $property = EstateProperty::find($request->input('id'));
        $prop_title = $property->title;

        $features = $request->input('feature');             //feature title
        $details = $request->input('details');              //feature details
        $values = $request->input('value');                 //feature no.
        $features_length = count($features);                //count features
        $feature_success = 0;
        $feature_fails = 0;
        $success = array();
        $error = array();
        $errMsg = null;

        //check if feature is empty
        if ($features_length > 0) {
            //loop
            for ($i = 0; $i < $features_length; $i++) {
                //save if not empty
                if (!empty($features[$i])) {
                    //new feature
                    $feature = new PropertyFeature();

                    $feature->title = $features[$i];
                    $feature->details = $details[$i];
                    $feature->total_no = $values[$i];

                    //save feature
                    if ($property->features()->save($feature)) {
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
                $success = array_add($success, 'Features', "Only " . $feature_success . ' of ' . $features_length . " features added successfully!");

            //features failed
            if ($feature_fails > 0)
                $error = array_add($error, 'Features', "Only " . $feature_fails . ' of ' . $features_length . ' features not added.');
        }

        if ($features_length <= 0) {
            $errMsg = 'Whoops, looks like you did not add any feature. Add at least 1 and try again!';
        }

        return redirect()->back()
            ->withInput()
            ->with('error', $errMsg)
            ->with('bulk_error', $error)
            ->with('bulk_success', $success);

    }

    /**
     * PropertyController update features.
     */
    public function updateFeature(Request $request)
    {
        $validator = $this->validator($request->all(), "featuresUpdate");
        $msg = "Whoops some error occured";

        //check for errors
        if ($validator->fails()) {
            $msg = "";
            $errors = $validator->errors()->all();

            foreach ($errors as $error) {
                $msg .= "<li>" . $error . "</li>";
            }
            return response()->json(['status' => 0, 'message' => $msg]);
        }

        //catch
        $id = $request->input('id');
        $value = $request->input('value');
        $details = $request->input('details');
        $title = $request->input('feature');

        //save if not empty
        $feature = PropertyFeature::find($id);

        if ($feature != null) {
            //new feature

            $feature->title = $title;
            $feature->details = $details;
            $feature->total_no = $value;

            if ($feature->save()) {
                return response()->json(['status' => 1, 'message' => $title . ' updated successfully.']);
            }
            return response()->json(['status' => 0, 'message' => $title . ' update failed. Try again!']);
        }
        return response()->json(['status' => 0, 'message' => $title . ' is invalid.']);
    }

    /**
     * PropertyController update.
     */
    public function updateAmenities(Request $request)
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
     * PropertyController toggleStatus.
     */
    public function toggleStatus($id)
    {
        $property = EstateProperty::find($id);

        //check app
        if ($property == null)
            abort(404);

        //Property App
        $app = $property->app;

        //authorize
        $this->authorize('update', $app);

        if ($property->status == 1)
            $property->status = 0;
        else
            $property->status = 1;

        if ($property->save())
            return redirect()->back()
                ->with('success', $property->title . ' status updated successfully!');
        else
            return redirect()->back()
                ->with('success', $property->title . ' status update failed. Try again!');

    }

    /**
     * PropertyController toggleFeatureStatus.
     */
    public function toggleFeatureStatus($id)
    {
        $app = PropertyFeature::find($id);

        //check if null
        if ($app == null)
            return redirect()->back()
                ->with('error', 'You tried to perform an action on an invalid record.');

        if ($app->status == 1)
            $app->status = 0;
        else
            $app->status = 1;

        if ($app->save())
            return redirect()->back()
                ->with('success', $app->title . ' status updated successfully!');
        else
            return redirect()->back()
                ->with('success', $app->title . ' status update failed. Try again!');

    }

    /**
     * PropertyController delete.
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
     * PropertyController delete.
     */
    public function deleteFeature($id)
    {
        //find
        $app = PropertyFeature::find($id);

        //check if null
        if ($app == null)
            return redirect()->back()
                ->with('error', 'You tried to perform an action on an invalid record.');

        //title
        $title = $app->title;

        //delete
        if ($app->delete()) {
            return redirect()->back()
                ->with('success', $title . ' feature moved to trash successfully.');
        }
        return redirect()->back()
            ->with('error', 'Failed moving ' . $title . ' feature to trash. Try again!');
    }

    /**
     * PropertyController restore.
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
     * PropertyController destroy.
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

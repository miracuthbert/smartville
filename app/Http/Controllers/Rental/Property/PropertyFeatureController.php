<?php

namespace App\Http\Controllers\Rental\Property;

use App\Http\Requests\Property\StorePropertyFeatureFormRequest;
use App\Models\v1\Company\CompanyApp;
use App\Models\v1\Estate\EstateProperty;
use App\Models\v1\Property\PropertyFeature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PropertyFeatureController extends Controller
{
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

        //sort
        $sort = $request->sort;

        //features init
        $features = collect();

        //authorize
        $this->authorize('update', $app);

        //property type
        $type = $property->type;

        //TODO: find property type features
        $results = collect();

        foreach ($type->features as $feature) {
            $result = $property->features()->where('title', $feature['name'])->first();
            $results->push($result);
        }

        if (isset($sort)) {
            if ($sort == 'trash') {
                $features = $property->features()->onlyTrashed()->latestDelete()->paginate();
            } elseif ($sort == 'active') {
                $features = $property->features()->where('property_features.status', 1)->latestDelete()->paginate();
            }
            if ($sort == 'disabled') {
                $features = $property->features()->where('property_features.status', 0)->latestDelete()->paginate();
            }
        } else {
            $features = $property->features()->latestFirst()->paginate();
        }

        return view('rental.properties.features.index')
            ->with('app', $app)
            ->with('results', $results)
            ->with('type', $type)
            ->with('sort', $sort)
            ->with('features', $features)
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
     * @param StorePropertyFeatureFormRequest|Request $request
     * @param CompanyApp $app
     * @param EstateProperty $property
     * @return \Illuminate\Http\Response
     */
    public function store(StorePropertyFeatureFormRequest $request, CompanyApp $app, EstateProperty $property)
    {
        //authorize
        $this->authorize('update', $app);

        $features = $request->input('feature');             //feature title
        $details = $request->input('details');              //feature details
        $values = $request->input('value');                 //feature no.
        $features_length = count($features);                //count features
        $feature_success = 0;
        $feature_fails = 0;
        $success = array();
        $error = array();
        $errMsg = null;

        if ($features_length > 0) { //check if feature is empty
            for ($i = 0; $i < $features_length; $i++) { //loop
                if (isset($features[$i])) {//save if not empty
                    //new feature
                    $feature = new PropertyFeature();
                    $feature->title = $features[$i];
                    $feature->details = $details[$i];
                    $feature->total_no = $values[$i];

                    //save feature
                    if ($property->features()->save($feature)) {
                        $feature_success++;
                    } else {
                        $feature_fails++;
                    }
                }   //endif
            } //loop end

            //features added
            if ($feature_success > 0)
                $success = array_add($success, 'Features', "{$feature_success} of {$features_length} features added to property successfully.");

            //features failed
            if ($feature_fails > 0)
                $error = array_add($error, 'Features', "{$feature_fails} of  {$features_length} features not added.");
        } else {
            $errMsg = 'Whoops, looks like you did not add any feature. Add at least 1 and try again!';
        }

        return back()->with('error', $errMsg)
            ->with('bulk_error', $error)
            ->with('bulk_success', $success);

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
     * @param CompanyApp $app
     * @param EstateProperty $property
     * @param PropertyFeature $feature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyApp $app, EstateProperty $property, PropertyFeature $feature)
    {

        //authorize
        $this->authorize('update', $app);

        //catch input
        $value = $request->input('_value');
        $details = $request->input('_details');
        $title = $request->input('_feature');

        $feature->title = $title;
        $feature->details = $details;
        $feature->total_no = $value;

        if ($feature->save()) { //save
            return back()->withSuccess("Feature `{$title}` updated successfully.");
        }

        //on error
        return back()->withSuccess("Feature `{$title}` update failed. Try again!.");
    }

    /**
     * Soft delete the specified resource from storage.
     *
     * @param Request $request
     * @param CompanyApp $app
     * @param EstateProperty $property
     * @param PropertyFeature $feature
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, CompanyApp $app, EstateProperty $property, PropertyFeature $feature)
    {
        //authorize
        $this->authorize('delete', $app);

        //title
        $title = $feature->title;

        //delete
        if ($feature->delete()) {
            return back()->withSuccess("{$title} feature moved to trash successfully.");
        }

        //error
        return back()->withError("Failed moving {$title} feature to trash. Try again!");

    }

    /**
     * Restore the specified resource from storage.
     *
     * @param Request $request
     * @param CompanyApp $app
     * @param EstateProperty $property
     * @param PropertyFeature $feature
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, CompanyApp $app, EstateProperty $property, $feature)
    {
        //authorize
        $this->authorize('update', $app);

        //find
        $feature = PropertyFeature::onlyTrashed()->findOrFail($feature);

        //title
        $title = $feature->title;

        //restore
        if ($feature->restore()) {
            if ($property->features()->onlyTrashed()->count() == 0) {
                return redirect()->route('rental.properties.features.index', [$app, $property])
                    ->withSuccess("{$title} feature restored successfully. There are no more features in trash.");
            } else {
                return back()->withSuccess("{$title} feature restored successfully.");
            }
        }

        //error
        return back()->withError("Failed restoring {$title} feature. Try again!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param CompanyApp $app
     * @param EstateProperty $property
     * @param PropertyFeature $feature
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CompanyApp $app, EstateProperty $property, $feature)
    {

        //authorize
        $this->authorize('delete', $app);

        //find
        $feature = PropertyFeature::onlyTrashed()->findOrFail($feature);

        //title
        $title = $feature->title;

        //destroy
        if ($feature->forceDelete()) {
            if ($property->features()->onlyTrashed()->count() == 0) {
                return redirect()->route('rental.properties.features.index', [$app, $property])
                    ->withSuccess("{$title} feature deleted successfully. There are no more features in trash.");
            } else {
                return back()->withSuccess("{$title} feature deleted successfully.");
            }
        }

        //error
        return back()->withError("Failed deleting {$title} feature. Try again!");
    }
}

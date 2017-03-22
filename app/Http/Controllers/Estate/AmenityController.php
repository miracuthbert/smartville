<?php

namespace App\Http\Controllers\Estate;

use App\Models\v1\Shared\Amenity;
use App\Models\v1\Company\CompanyApp;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AmenityController extends Controller
{

    /**
     * AmenityController constructor.
     */
    public function __construct()
    {
        $this->middleware('company.app.admin');
    }

    /**
     * Get a validator for an incoming amenity create/update request.
     *
     * @param  array $data
     * @return \Illuminate\Support\Facades\Validator
     */
    protected function validator(array $data, $type)
    {
        #TODO: fields for consideration
        //'listing' => 'required|boolean',
        //'booking' => 'required|boolean',


        if ($type === "update") {
            return $validate = Validator::make($data, [
                'id' => 'required|exists:amenities,id',
                'title' => 'required|min:2|max:255',
                'description' => 'required|min:3|max:255',
                'status' => 'required|boolean',
            ]);
        } else {
            return $validate = Validator::make($data, [
                '_app' => 'required|integer|exists:company_apps,id',
                'title' => 'required|min:2|max:255',
                'description' => 'required|min:3|max:255',
                'status' => 'required|boolean',
            ]);
        }
    }

    /**
     * AmenityController index.
     * Get Estate Amenities.
     */
    public function index($id)
    {
        $app = CompanyApp::find($id);

        //check app
        if($app == null)
            abort(404);

        //authorize
        $this->authorize('view', $app);

        return view('v1.estates.amenity.index')
            ->with('app', $app);
    }

    /**
     * AmenityController edit.
     * Get Estate Amenities.
     */
    public function edit($id)
    {
        //Amenity
        $amenity = Amenity::find($id);

        //Amenity App
        $app = $amenity->app;

        //check app
        if($app == null)
            abort(404);

        //authorize
        $this->authorize('view', $app);

        return view('v1.estates.amenity.show')
            ->with('app', $app)
            ->with('amenity', $amenity);
    }

    /**
     * AmenityController store.
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

        //save
        $amenity = new Amenity();
        $amenity->title = $request->input('title');
        $amenity->description = $request->input('description');
        $amenity->status = $request->input('status');

        if ($app->amenities()->save($amenity)) {
            return redirect()->back()
                ->with('success', 'Amenity added successfully.');
        }

        //redirect with error if failed
        return redirect()->back()
            ->with('error', 'Failed adding amenity. Try again!')
            ->withInput();
    }

    /**
     * AmenityController update.
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

        //save
        $amenity = Amenity::find($request->input('id'));
        $amenity->title = $request->input('title');
        $amenity->description = $request->input('description');
        $amenity->status = $request->input('status');

        if ($amenity->save()) {
            return redirect()->back()
                ->with('success', 'Amenity updated successfully.');
        }

        //redirect with error if failed
        return redirect()->back()
            ->with('error', 'Failed updating amenity. Try again!')
            ->withInput();
    }

    /**
     * AmenityController toggleStatus.
     */
    public function toggleStatus($id)
    {
        $app = Amenity::find($id);

        //check if null
        if($app == null)
            abort(404);

        //authorize
        $this->authorize('update', $app->app);

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
     * AmenityController delete.
     */
    public function delete($id)
    {
        //find
        $app = Amenity::find($id);

        //check if null
        if($app == null)
            abort(404);

        //authorize
        $this->authorize('delete', $app->app);

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
     * AmenityController restore.
     */
    public function restore($id)
    {
        //find
        $app = Amenity::onlyTrashed()->where('id', $id)->first();

        //check if null
        if($app == null)
            abort(404);

        //authorize
        $this->authorize('update', $app->app);

        //restore
        if ($app->restore()) {
            return redirect()->back()
                ->with('success', $app->title . ' restored successfully.');
        }
        return redirect()->back()
            ->with('error', 'Failed restoring ' . $app->title . '. Try again!');
    }

    /**
     * AmenityController destroy.
     */
    public function destroy($id)
    {
        //find
        $app = Amenity::onlyTrashed()->where('id', $id)->first();

        //check if null
        if($app == null)
            abort(404);

        //authorize
        $this->authorize('delete', $app->app);

        //title
        $title = $app->title;

        //delete
        if ($app->forceDelete()) {
            return redirect()->back()
                ->with('success', 'Amenity deletion successful. ' . $title . ' is removed completely!');
        }
        return redirect()->back()
            ->with('error', 'Failed deleting amenity. Try again!');
    }
}

<?php

namespace App\Http\Controllers\Rental\Amenity;

use App\Http\Requests\Rental\Amenity\StoreAmenityFormRequest;
use App\Models\v1\Company\CompanyApp;
use App\Models\v1\Shared\Amenity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param CompanyApp $app
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, CompanyApp $app)
    {

        $sort = $request->sort;

        //check app
        if ($app == null)
            abort(404);

        //authorize
        $this->authorize('create', $app);

        if (isset($sort) && $sort == 'trashed') {
            $amenities = $app->amenities()->onlyTrashed()->latestDelete()->paginate();
        } else {
            $amenities = $app->amenities()->latestFirst()->paginate();
        }

        return view('rental.amenities.index')
            ->with('app', $app)
            ->with('sort', $sort)
            ->with('amenities', $amenities);
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
        //check app
        if ($app == null)
            abort(404);

        //authorize
        $this->authorize('create', $app);

        return view('rental.amenities.create')
            ->with('app', $app);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAmenityFormRequest|Request $request
     * @param CompanyApp $app
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAmenityFormRequest $request, CompanyApp $app)
    {

        //validation in request

        //check authorized
        $this->authorize('create', $app);

        //save
        $amenity = new Amenity();
        $amenity->title = $request->input('title');
        $amenity->description = $request->input('description');
        $amenity->status = $request->input('status');

        if ($app->amenities()->save($amenity)) {
            return redirect()->route('rental.amenities.index', [$app])
                ->withSuccess('Amenity added successfully.');
        }

        //redirect with error if failed
        return redirect()->back()
            ->withError('Failed adding amenity. Try again!')
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
     * @param Request $request
     * @param CompanyApp $app
     * @param Amenity $amenity
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, CompanyApp $app, Amenity $amenity)
    {

        //authorize
        $this->authorize('update', $app);

        return view('rental.amenities.edit')
            ->with('app', $app)
            ->with('amenity', $amenity);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreAmenityFormRequest|Request $request
     * @param CompanyApp $app
     * @param Amenity $amenity
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAmenityFormRequest $request, CompanyApp $app, Amenity $amenity)
    {

        //validate in request

        //authorize
        $this->authorize('update', $app);

        //check if app subscribed
        if (!$app->subscribed)
            return back()
                ->withSuccess('To update amenity subscribe first.');

        //save
        $amenity->title = $request->input('title');
        $amenity->description = $request->input('description');
        $amenity->status = $request->input('status');

        if ($amenity->save()) {
            return redirect()->back()
                ->withSuccess('Amenity updated successfully.');
        }

        //redirect with error if failed
        return redirect()->back()
            ->withError('Failed updating amenity. Try again!')
            ->withInput();
    }

    /**
     * Update resource 'status' in storage.
     * @param Request $request
     * @param CompanyApp $app
     * @param Amenity $amenity
     * @return
     */
    public function toggleStatus(Request $request, CompanyApp $app, Amenity $amenity)
    {
        //authorize
        $this->authorize('update', $app);

        $amenity->status == 1 ? $amenity->status = 0 : $amenity->status = 1;

        if ($amenity->save())
            return redirect()->back()
                ->withSuccess($amenity->title . ' status updated successfully!');
        else
            return redirect()->back()
                ->withSuccess($amenity->title . ' status update failed. Try again!');

    }

    /**
     * SoftDelete resource in storage.
     * @param Request $request
     * @param CompanyApp $app
     * @param Amenity $amenity
     * @return
     */
    public function delete(Request $request, CompanyApp $app, Amenity $amenity)
    {
        //authorize
        $this->authorize('delete', $app);

        //title
        $title = $amenity->title;

        //delete
        if ($amenity->delete()) {
            return redirect()->back()
                ->withSuccess($title . ' moved to trash successfully.');
        }
        return redirect()->back()
            ->withError('Failed moving ' . $title . ' to trash. Try again!');
    }

    /**
     * Restore soft deleted resource in storage.
     * @param Request $request
     * @param CompanyApp $app
     * @param $amenity
     * @return
     */
    public function restore(Request $request, CompanyApp $app, $amenity)
    {
        //find
        $amenity = Amenity::onlyTrashed()->where('id', $amenity)->first();

        //authorize
        $this->authorize('update', $app);

        //restore
        if ($amenity->restore()) {
            return redirect()->back()
                ->withSuccess($amenity->title . ' restored successfully.');
        }
        return redirect()->back()
            ->withError('Failed restoring ' . $amenity->title . '. Try again!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param CompanyApp $app
     * @param Amenity $amenity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, CompanyApp $app, $amenity)
    {

        //find
        $amenity = Amenity::onlyTrashed()->where('id', $amenity)->firstOrFail();

        //authorize
        $this->authorize('delete', $app);

        //title
        $title = $amenity->title;

        //delete
        if ($amenity->forceDelete()) {
            return redirect()->back()
                ->withSuccess('Amenity deletion successful. ' . $title . ' is removed completely!');
        }
        return redirect()->back()
            ->withError('Failed deleting amenity. Try again!');
    }
}

<?php

namespace App\Http\Controllers\Rental\Property;

use App\Http\Requests\Property\StorePropertyGroupFormRequest;
use App\Models\v1\Company\CompanyApp;
use App\Models\v1\Estate\EstateGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PropertyGroupController extends Controller
{
    /**
     * PropertyGroupController constructor.
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
        //sort
        $sort = $request->sort;

        //authorize
        $this->authorize('view', $app);

        //groups
        if (isset($sort) && $sort != "all") {
            //trashed
            if ($sort == "trashed")
                $groups = $app->groupsTrashed()->latestDelete()->paginate();
            //active
            elseif ($sort == "active")
                $groups = $app->groups()->where('status', 1)->latestFirst()->paginate();
            //disabled
            elseif ($sort == "disabled")
                $groups = $app->groups()->where('status', 0)->latestFirst()->paginate();
        } else {
            $groups = $app->groups()->latestFirst()->paginate();

        }

        return view('rental.properties.groups.index')
            ->with('app', $app)
            ->with('sort', $sort)
            ->with('groups', $groups);
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

        return view('rental.properties.groups.create')
            ->with('app', $app);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePropertyGroupFormRequest|Request $request
     * @param CompanyApp $app
     * @return \Illuminate\Http\Response
     */
    public function store(StorePropertyGroupFormRequest $request, CompanyApp $app)
    {
        //save
        $group = new EstateGroup();
        $group->title = $request->input('title');
        $group->description = $request->input('description');
        $group->location = $request->input('location');
        $group->status = $request->input('status');

        if ($app->groups()->save($group)) {
            return redirect()->route('rental.properties.groups.index', ['id' => $app->id])
                ->withSuccess('Group added successfully.');
        }

        //redirect with error if failed
        return redirect()->back()
            ->withError('Failed adding group. Try again!')
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
     * @param EstateGroup $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, CompanyApp $app, EstateGroup $group)
    {
        //authorize
        $this->authorize('update', $app);

        return view('rental.properties.groups.edit')
            ->with('app', $app)
            ->with('group', $group);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StorePropertyGroupFormRequest|Request $request
     * @param CompanyApp $app
     * @param EstateGroup $group
     * @return \Illuminate\Http\Response
     */
    public function update(StorePropertyGroupFormRequest $request, CompanyApp $app, EstateGroup $group)
    {
        //authorize
        $this->authorize('update', $app);

        $group->title = $request->input('title');
        $group->description = $request->input('description');
        $group->location = $request->input('location');
        $group->status = $request->input('status');

        if ($group->save()) {
            return redirect()->back()
                ->withSuccess('Group updated successfully.');
        }

        //redirect with error if failed
        return redirect()->back()
            ->withError('Failed updating group. Try again!')
            ->withInput();
    }

    /**
     * Update resource 'status' in storage.
     *
     * @param Request $request
     * @param CompanyApp $app
     * @param EstateGroup $group
     * @return mixed
     */
    public function toggleStatus(Request $request, CompanyApp $app, EstateGroup $group)
    {
        //authorize
        $this->authorize('update', $app);

        $group->status == 1 ? $group->status = 0 : $group->status = 1;

        if ($group->save())
            return redirect()->back()
                ->with('success', '`' . $group->title . '` status updated successfully!');
        else
            return redirect()->back()
                ->with('error', '`' . $group->title . '` status update failed. Try again!');

    }

    /**
     * Soft delete resource in storage.
     *
     * @param Request $request
     * @param CompanyApp $app
     * @param EstateGroup $group
     * @return mixed
     */
    public function delete(Request $request, CompanyApp $app, EstateGroup $group)
    {
        //authorize
        $this->authorize('delete', $app);

        //title
        $title = $group->title;

        if ($group->properties()->count()) {
            return back()
                ->withWarning('`' . $title . '` cannot be deleted since it has related records.')
                ->withInfo('You can only disable it or delete related records first to remove it.');
        }

        //delete
        if ($group->delete()) {
            return redirect()->back()
                ->with('success', '`' . $title . '` moved to trash successfully.');
        }
        return redirect()->back()
            ->with('error', 'Failed moving `' . $title . '` to trash. Try again!');
    }

    /**
     * Restore soft deleted resource in storage.
     *
     * @param Request $request
     * @param CompanyApp $app
     * @param $group
     * @return mixed
     */
    public function restore(Request $request, CompanyApp $app, $group)
    {
        //find
        $group = EstateGroup::onlyTrashed()->where('id', $group)->firstOrFail();

        //authorize
        $this->authorize('update', $app);

        //restore
        if ($group->restore()) {
            return redirect()->back()
                ->with('success', '`' . $group->title . '` property group restored successfully.');
        }
        return redirect()->back()
            ->with('error', 'Failed restoring `' . $group->title . '` property group. Try again!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param CompanyApp $app
     * @param $group
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(Request $request, CompanyApp $app, $group)
    {
        //find
        $group = EstateGroup::onlyTrashed()->where('id', $group)->firstOrFail();

        //authorize
        $this->authorize('delete', $app);

        //title
        $title = $group->title;

        if ($group->properties()->count()) {
            return back()
                ->withWarning('`' . $title . '` cannot be deleted since it has related records.')
                ->withInfo('You can only disable it or delete related records first to remove it.');
        }
        
        //delete
        if ($group->forceDelete()) {
            return redirect()->back()
                ->with('success', 'Property group `' . $title . '` removed completely.');
        }
        return redirect()->back()
            ->with('error', 'Failed deleting `' . $title . '` property group. Try again!');
    }
}

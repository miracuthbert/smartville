<?php

namespace App\Http\Controllers\Estate;

use App\Models\v1\Company\CompanyApp;
use App\Models\v1\Estate\EstateGroup;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{

    /**
     * GroupController constructor.
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
        //'listing' => 'required|boolean',
        //'booking' => 'required|boolean',


        if ($type === "update") {
            return $validate = Validator::make($data, [
                'id' => 'required|exists:estate_groups,id',
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
     * GroupController create.
     * Get Add Group view.
     */
    public function create($id)
    {
        $app = CompanyApp::find($id);

        //check app
        if($app == null)
            abort(404);

        //authorize
        $this->authorize('view', $app);

        return view('v1.estates.groups.create')
            ->with('app', $app);
    }

    /**
     * GroupController index.
     * Get Estate Groups.
     */
    public function index($id, $sort)
    {
        //App
        $app = CompanyApp::find($id);

        //check app
        if($app == null)
            abort(404);

        //authorize
        $this->authorize('view', $app);

        //groups
        if ($sort == "all")
            $groups = $app->groups()->paginate(25);
        //trashed
        if ($sort == "trashed")
            $groups = $app->groupsTrashed()->paginate(25);
        //active
        if ($sort == "active")
            $groups = $app->groups()->where('status', 1)->paginate(25);
        //disabled
        if ($sort == "disabled")
            $groups = $app->groups()->where('status', 0)->paginate(25);

        //debug
        //dd($groups);

        return view('v1.estates.groups.index')
            ->with('app', $app)
            ->with('sort', $sort)
            ->with('groups', $groups);
    }

    /**
     * GroupController edit.
     * Get Estate Group.
     */
    public function edit($id)
    {
        //Group
        $group = EstateGroup::find($id);

        //check app
        if($group == null)
            abort(404);

        //Group App
        $app = $group->app;

        //authorize
        $this->authorize('view', $app);

        return view('v1.estates.groups.edit')
            ->with('app', $app)
            ->with('group', $group);
    }

    /**
     * GroupController store.
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
        $group = new EstateGroup();
        $group->title = $request->input('title');
        $group->description = $request->input('description');
        $group->location = $request->input('location');
        $group->status = $request->input('status');

        if ($app->groups()->save($group)) {
            return redirect()->route('estate.rental.groups.index', ['id' => $app->id, 'sort' => 'all'])
                ->with('success', 'Group added successfully.');
        }

        //redirect with error if failed
        return redirect()->back()
            ->with('error', 'Failed adding group. Try again!')
            ->withInput();
    }

    /**
     * GroupController update.
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
        $group = EstateGroup::find($request->input('id'));
        $group->title = $request->input('title');
        $group->description = $request->input('description');
        $group->location = $request->input('location');
        $group->status = $request->input('status');

        if ($group->save()) {
            return redirect()->back()
                ->with('success', 'Group updated successfully.');
        }

        //redirect with error if failed
        return redirect()->back()
            ->with('error', 'Failed updating group. Try again!')
            ->withInput();
    }

    /**
     * GroupController toggleStatus.
     */
    public function toggleStatus($id)
    {
        $group = EstateGroup::find($id);

        //check group
        if($group == null)
            abort(404);

        //Group App
        $app = $group->app;

        //authorize
        $this->authorize('update', $app);

        if ($group->status == 1)
            $group->status = 0;
        else
            $group->status = 1;

        if ($group->save())
            return redirect()->back()
                ->with('success', $group->title . ' status updated successfully!');
        else
            return redirect()->back()
                ->with('error', $group->title . ' status update failed. Try again!');

    }

    /**
     * GroupController delete.
     */
    public function delete($id)
    {
        //find
        $group = EstateGroup::find($id);

        //check group
        if($group == null)
            abort(404);

        //Group App
        $app = $group->app;

        //authorize
        $this->authorize('delete', $app);

        //title
        $title = $group->title;

        //delete
        if ($group->delete()) {
            return redirect()->back()
                ->with('success', $title . ' moved to trash successfully.');
        }
        return redirect()->back()
            ->with('error', 'Failed moving ' . $title . ' to trash. Try again!');
    }

    /**
     * GroupController restore.
     */
    public function restore($id)
    {
        //find
        $group = EstateGroup::onlyTrashed()->where('id', $id)->first();

        //check group
        if($group == null)
            abort(404);

        //Group App
        $app = $group->app;

        //authorize
        $this->authorize('update', $app);

        //restore
        if ($group->restore()) {
            return redirect()->back()
                ->with('success', $group->title . ' restored successfully.');
        }
        return redirect()->back()
            ->with('error', 'Failed restoring ' . $group->title . '. Try again!');
    }

    /**
     * GroupController destroy.
     */
    public function destroy($id)
    {
        //find
        $group = EstateGroup::onlyTrashed()->where('id', $id)->first();

        //check group
        if($group == null)
            abort(404);

        //Group App
        $app = $group->app;

        //authorize
        $this->authorize('delete', $app);

        //title
        $title = $group->title;

        //delete
        if ($group->forceDelete()) {
            return redirect()->back()
                ->with('success', 'Group deletion successful. ' . $title . ' is removed completely!');
        }
        return redirect()->back()
            ->with('error', 'Failed deleting group. Try again!');
    }

}

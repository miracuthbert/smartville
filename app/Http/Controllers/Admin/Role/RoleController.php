<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Requests\Admin\Role\StoreRoleRequest;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * RoleController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::latest()->paginate();

        return view('v1.admin.roles.index')
            ->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tables = DB::select('SHOW TABLES;');

        $tables = array_map('reset', $tables);

        return view('v1.admin.roles.create')
            ->with('tables', $tables);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRoleRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $title = $request->input('role');
        $alias = $request->input('alias');
        $summary = $request->input('summary');
        $desc = $request->input('description');
        $create = $request->input('create');
        $read = $request->input('read');
        $update = $request->input('update');
        $delete = $request->input('delete');
        $status = $request->input('status');
        $tables = $request->input('tables');

        $role = new Role();
        $role->role = $title;
        $role->alias = $alias;
        $role->summary = $summary;
        $role->desc = $desc;
        $role->create = !empty($create) ? $create : 0;
        $role->read = !empty($read) ? $read : 0;
        $role->update = !empty($update) ? $update : 0;
        $role->delete = !empty($delete) ? $delete : 0;
        $role->status = $status;
        $role->tables = $tables;

        if ($role->save()) {
            return redirect()->route('roles.show', ['id' => $role->id])
                ->with('success', $title . ' role created successfully!');
        }

        return redirect()->back()
            ->with('error', $title . ' role failed creating. Try Again!')
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
        $role = Role::find($id);

        return view('v1.admin.roles.show')
            ->with('role', $role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);

        $tables = DB::select('SHOW TABLES;');

        $tables = array_map('reset', $tables);

        return view('v1.admin.roles.edit')
            ->with('tables', $tables)
            ->with('role', $role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreRoleRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRoleRequest $request, $id)
    {
        $title = $request->input('role');
        $alias = $request->input('alias');
        $summary = $request->input('summary');
        $desc = $request->input('description');
        $create = $request->input('create');
        $read = $request->input('read');
        $update = $request->input('update');
        $delete = $request->input('delete');
        $status = $request->input('status');
        $tables = $request->input('tables');

        $role = Role::findOrFail($id);
        $role->role = $title;
        $role->alias = $alias;
        $role->summary = $summary;
        $role->desc = $desc;
        $role->create = !empty($create) ? $create : 0;
        $role->read = !empty($read) ? $read : 0;
        $role->update = !empty($update) ? $update : 0;
        $role->delete = !empty($delete) ? $delete : 0;
        $role->status = $status;
        $role->tables = $tables;

        if ($role->save()) {
            return redirect()->route('roles.show', ['id' => $role->id])
                ->with('success', $title . ' role updated successfully!');
        }

        return redirect()->back()
            ->with('error', $title . ' role failed updating. Try Again!')
            ->withInput();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $role = Role::withCount('users')->findOrFail($id);
        $role_status = $role->status == 1 ? 0 : 1;
        $role->status = $role_status;

        $count = $role->users_count;
        if ($count <= 0) {
            //message
            $msg = $role_status == 1 ? 'marked as active' : 'disabled';
            $r_msg = $role_status == 1 ? 'Disable this role' : 'Activate this role';

            if ($role->update())
                return redirect()->back()
                    ->with('success_link', route('roles.destroy', ['id' => $role->id]))
                    ->with('link_name', $r_msg)
                    ->with('success', $role->role . " role is " . $msg . ".");
        } else {
            return redirect()->back()
                ->with('error', "Role '" . $role->role . "' status cannot be changed since some users are using it!");
        }
        return redirect()->back()
            ->with('error_link', route('roles.destroy', ['id' => $role->id]))
            ->with('link_name', 'Try Again!')
            ->with('error', $role->role . " role status update failed.");
    }
}

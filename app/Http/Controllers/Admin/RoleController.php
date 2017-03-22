<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'role' => 'required|max:255|unique:roles',
            'summary' => 'required|min:10|max:100',
            'desc' => 'required|min:6|confirmed',
            'create' => 'required|boolean',
            'read' => 'required|boolean',
            'update' => 'required|boolean',
            'delete' => 'required|boolean',
            'status' => 'required|boolean',
        ]);
    }

    /**
     * RoleController Get Add Role View
     */
    public function getAddRole()
    {
        return view('v1.admin.role.new');
    }

    /**
     * RoleController Get Roles View
     */
    public function getRolesIndex()
    {
        return view('v1.admin.roles.index');
    }

    /**
     * RoleController Get Roles View
     */
    public function getRoleIndex($id)
    {
        $role = Role::find($id);

        return view('v1.admin.roles.role')
            ->with('role', $role);
    }

    /**
     * RoleController create
     */
    public function create(Request $request)
    {

    }

    /**
     * RoleController update
     */
    public function update(Request $request)
    {

    }

    /**
     * RoleController update
     */
    public function delete(array $passed)
    {
        $i = 0;

        foreach ($passed as $id) {
            $role = Role::find($id);
            if ($role->delete()) {
                $i++;
            }
        }

        if ($i > 0) {
            return redirect()->back()
                ->with('error', $i . ' roles deleted successfully!');
        }

        return redirect()->back()
            ->with('error', 'Failed deleting selected role(s)');
    }

}

<?php

namespace App\Http\Controllers\Estate;

use App\Models\v1\Company\CompanyApp;
use App\Models\v1\Estate\EstateGroup;
use App\Models\v1\Estate\EstateProperty;
use App\Models\v1\Tenant\Tenant;
use App\Models\v1\Tenant\TenantProperty;
use App\Role;
use App\User;
use App\UserRole;
use Carbon\Carbon;
use ExtCountries;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TenantController extends Controller
{
    /**
     * @var string $tenant_dashboard_route
     *
     * Holds tenant panel dashboard route name
     */
    protected $tenant_dashboard_route = 'tenant.dashboard';

    /**
     * TenantController constructor.
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
                'id' => 'required|exists:tenant_properties,id',
                'group' => 'nullable|exists:estate_groups,id',
                'property' => 'required|integer|exists:estate_properties,id',
                'move_in' => 'required|date',
                'lease_duration' => 'required|integer',
                'status' => 'required|boolean',
            ]);
        } else {
            return $validate = Validator::make($data, [
                '_app' => 'required|integer|exists:company_apps,id',
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|max:255',
                'group' => 'nullable|integer|exists:estate_groups,id',
                'property' => 'required|integer|exists:estate_properties,id',
                'move_in' => 'required|date',
                'lease_duration' => 'required|integer',
                'status' => 'required|boolean',
            ]);
        }
    }

    /**
     * TenantController create.
     */
    public function create($id)
    {
        //app
        $app = CompanyApp::find($id);
        $countries = ExtCountries::all()->pluck('name.common');

        return view('v1.estates.tenants.create')
            ->with('countries', $countries)
            ->with('groups', $app->groups()->where('status', 1)->get())
            ->with('app', $app);
    }

    /**
     * TenantController groupProperties.
     */
    public function groupProperties(Request $request)
    {
        //group app
        $app = $request->input('app');

        //group id
        $id = $request->input('id');

        $properties = "";

        if ($id > 0) { //app
            $app = EstateGroup::find($id);

            //group properties
            $properties = $app->properties()->where('status', 0)->get();
        } else if ($id == null) {
            $properties = EstateProperty::where('company_app_id', $app)->where('property_group', null)->where('status', 0)->get();
        }

        if ($properties != null)
            return response()->json(['status' => 1, 'message' => 'Properties retrieved successfully.', 'properties' => $properties]);

        //failed
        return response()->json(['status' => 1, 'message' => 'Failed retrieving properties.', 'properties' => $properties]);
    }

    /**
     * TenantController index.
     */
    public function index(Request $request, $id, $sort)
    {
        //app
        $app = CompanyApp::find($id);

        //leases
        $leases = $request->leases;

        if ($leases == 1) {
            if ($sort == "all")
                $tenants = $app->leases()->orderBy('move_in', 'DESC')->paginate();
            if ($sort == "trashed")
                $tenants = $app->leasesTrashed()->orderBy('deleted_at', 'DESC')->paginate();
            if ($sort == "active")
                $tenants = $app->leases()->orderBy('move_in', 'DESC')->where('tenant_properties.status', 1)->paginate();
            if ($sort == "vacated")
                $tenants = $app->leases()->orderBy('move_out', 'DESC')->where('tenant_properties.status', 0)->paginate();
        } else {
            //sort
            if ($sort == "all")
                $tenants = $app->tenants()->orderBy('created_at', 'DESC')->paginate();
            if ($sort == "trashed")
                $tenants = $app->leasesTrashed()->paginate();
            if ($sort == "active")
                $tenants = $app->tenants()->where('status', 1)->paginate();
            if ($sort == "vacated")
                $tenants = $app->tenants()->where('status', 0)->paginate();
        }

        return view('v1.estates.tenants.index')
            ->with('app', $app)
            ->with('sort', $sort)
            ->with('leases', $leases)
            ->with('tenants', $tenants);
    }

    /**
     * TenantController edit.
     */
    public function edit($id)
    {
        //lease
        $lease = TenantProperty::find($id);

        //app
        $app = $lease->tenant->company;

        //lease
        $tenant = $lease->tenant;

        //group
        $group = $lease->property->property_group;

        //property
        $tenant_property = $lease->property_id;

        //properties
        $properties = EstateProperty::where('company_app_id', $app->id)->where('property_group', $group)->get();

        return view('v1.estates.tenants.edit')
            ->with('app', $app)
            ->with('lease', $lease)
            ->with('tenant_group', $group)
            ->with('tenant_property', $tenant_property)
            ->with('properties', $properties)
            ->with('groups', $app->groups()->where('status', 1)->get())
            ->with('tenant', $tenant);
    }

    /**
     * TenantController store.
     */
    public function store(Request $request)
    {
        $validator = $this->validator($request->all(), null);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        //messages
        $success = array();
        $success_count = 0;
        $error = array();
        $passwd = str_random(8);

        //get input property
        $_property = $request->input('property');

        //find occupied
        $property = EstateProperty::findOrFail($_property);

        //app
        $app = $property->app;

        //company
        $company = $app->company;

        //find property leases
        $_occupied = $property->tenants()->where('status', 1)->count();

        if ($_occupied < $property->tenants) {

            //check if user exists
            $user = User::where('email', $request->input('email'))->first();

            if ($user == null) {
                //add user
                $user = new User();
                $user->firstname = $request->input('first_name');
                $user->lastname = $request->input('last_name');
                $user->phone = $request->input('phone');
                $user->country = $request->input('country');
                $user->email = $request->input('email');
                $user->id_no = $request->input('id_no');
                $user->password = bcrypt($passwd);

                //save
                if ($user->save()) {
                    //id
                    $id = $user->id;

                    //success
                    $success = array_add($success, $id, "User created successfully.");
                    $success_count++;
                } else {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', "Failed creating user. Try again!");
                }
            } //end of create user

            //id
            $id = $user->id;

            //fetch tenant or create record tenant
            $tenant = Tenant::firstOrCreate([
                'company_app_id' => $request->input('_app'),
                'user_id' => $user->id,
            ]);

            if ($tenant->save()) {
                $success_count++;
                $tenant_id = $tenant->id;

                //add tenant's property and lease
                $tenantProperty = new TenantProperty();
                $tenantProperty->tenant_id = $tenant_id;
                $tenantProperty->property_id = $property->id;
                $tenantProperty->move_in = Carbon::parse($request->input('move_in'));
                $tenantProperty->lease_duration = $request->input('lease_duration');

                //Check if tenancy is assigned
                if ($tenantProperty->save()) {
                    //success
                    $success = array_add($success, $tenantProperty->id, "Tenancy details added successfully.");
                    $success_count++;

                    //Update Property Status
                    $property->status = 1;

                    if ($property->save()) {
                        $success = array_add($success, $property->id, $property->title . " is now occupied.");
                        $success_count++;
                    } else {
                        $error = array_add($error, $property->id, $property->title . " status has not been set to occupied, please do it manually.");
                    }

                    //Fetch or Assign 'Tenant' role to user
                    $role = UserRole::firstOrCreate([
                        'user_id' => $user->id,
                        'role_id' => Role::where('alias', 'company-tenant')->first()->id,
                    ]);

                    //Check if user role assigned
                    if ($role->save()) {
                        //success
                        $success = array_add($success, $role->id, "Tenant given tenant privileges.");
                        $success_count++;
                    } else {
                        //error
                        $error = array_add($error, "role", "Failed assigning 'tenant' privileges to " . $user->first_name);

                        //all good but not assigned tenant privileges
                        return redirect()->back()
                            ->withInput()
                            ->with('bulk_error', $error)
                            ->with('bulk_success', $success);
                    }
                } else {
                    //error
                    $error = array_add($error, "property", "Failed adding tenancy details of " . $user->first_name);
                }
            } //end of add tenant
        }

        if ($success_count > 0) {//all good
            return redirect()->back()
                ->with('bulk_success', $success);
        }

        return redirect()->back()
            ->withInput()
            ->with('error', "Failed creating tenant. Try again!");
    }

    /**
     * TenantController update.
     */
    public function update(Request $request)
    {
        $validator = $this->validator($request->all(), "update");

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        //find
        $lease = TenantProperty::find($request->input('id'));

        if ($lease != null) {
            $duration = $request->input('lease_duration');
            $status = $request->input('status');

            //save
            $lease->property_id = $request->input('property');
            $lease->move_in = Carbon::parse($request->input('move_in'));
            $lease->lease_duration = $duration;

            //property
            $_property = $request->input('property');
            $oldStatus = $lease->status;

            //if status is 0 check for move out date
            if ($status == 0) {
                $this->validate($request, [
                    'move_out' => 'required|date|after:move_in',
                ], [], [
                    'move_out' => 'move out date',
                ]);

                $lease->move_out = $request->input('move_out');

            } else if ($lease->move_out != null) { //set move out null
                $lease->move_out = null;
            }

            //status
            $lease->status = $status;

            //check if lease saved
            if ($lease->save()) {

                //update property status if lease status changed
                if ($status != $oldStatus) {
                    $property = EstateProperty::find($_property);
                    $property->status = $status;
                    $property->save();
                }

                return redirect()->back()
                    ->with('success', 'Tenant details updated successfully.');

            }
        }

        return redirect()->back()
            ->with('error', 'Failed updating tenant details')
            ->withInput();

    }

    /**
     * TenantController toggleStatus.
     */
    public function toggleStatus($id)
    {
        $app = TenantProperty::find($id);

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
                ->with('success', $app->tenant->user->firstname . '\'s lease status updated successfully!');
        else
            return redirect()->back()
                ->with('success', $app->tenant->user->firstname . '\'s lease status update failed. Try again!');

    }

    /**
     * TenantController delete.
     */
    public function delete($id)
    {
        //find
        $app = TenantProperty::find($id);

        //check if null
        if ($app == null)
            return redirect()->back()
                ->with('error', 'You tried to perform an action on an invalid record.');

        //title
        $title = $app->tenant->user->firstname;
        //lease
        $lease = $app->property->title;

        //delete
        if ($app->delete()) {
            return redirect()->back()
                ->with('success', $title . ' lease for ' . $lease . ' moved to trash successfully.');
        }
        return redirect()->back()
            ->with('error', 'Failed moving ' . $title . ' lease for ' . $lease . ' to trash. Try again!');
    }

    /**
     * TenantController restore.
     */
    public function restore($id)
    {
        //find
        $app = TenantProperty::onlyTrashed()->where('id', $id)->first();

        //check if null
        if ($app == null)
            return redirect()->back()
                ->with('error', 'You tried to perform an action on an invalid record.');

        //title
        $title = $app->tenant->user->firstname;
        //lease
        $lease = $app->property->title;

        //restore
        if ($app->restore()) {
            return redirect()->back()
                ->with('success', $title . ' lease for ' . $lease . ' restored successfully.');
        }
        return redirect()->back()
            ->with('error', 'Failed restoring ' . $title . ' lease for ' . $lease . '. Try again!');
    }

    /**
     * TenantController destroy.
     */
    public function destroy($id)
    {
        //find
        $app = TenantProperty::onlyTrashed()->where('id', $id)->first();

        //check if null
        if ($app == null)
            return redirect()->back()
                ->with('error', 'You tried to perform an action on an invalid record.');

        //title
        $title = $app->tenant->user->firstname;
        //lease
        $lease = $app->property->title;

        //delete
        if ($app->forceDelete()) {
            return redirect()->back()
                ->with('success', 'Lease deletion successful. ' . $title . ' is removed completely!');
        }
        return redirect()->back()
            ->with('error', 'Failed deleting ' . $title . ' lease for ' . $lease . ' Try again!');
    }

}

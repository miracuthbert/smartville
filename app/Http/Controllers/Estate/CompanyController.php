<?php

namespace App\Http\Controllers\Estate;

use App\Avatar;
use App\Company;
use App\CompanyApp;
use App\CompanyUser;
use App\Product;
use App\UserRole;
use Carbon\Carbon;
use Countries;
use ExtCountries;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Image;

class CompanyController extends Controller
{

    /**
     * CompanyController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');

        //
        $this->middleware('company.admin')->except('create');
    }

    /**
     * Get a validator for an incoming app feature create/update request.
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
                'id' => 'required|exists:companies,id',
                'company' => 'required|min:2|max:255',
                'country' => 'required',
                'phone' => 'required|numeric',
                'email' => 'required|email|max:255',
            ], [
                'country.required' => 'Pick a valid country',
            ]);
        } else {
            return $validate = Validator::make($data, [
                'company' => 'required|unique:companies,title|min:2|max:255',
                '_app' => 'required|integer|exists:products,id',
                '_role' => 'required|integer|exists:roles,id',
                'country' => 'required',
                'phone' => 'required|numeric',
                'email' => 'required|email|unique:companies|max:255',
                'terms' => 'required|accepted',
            ], [
                'country.required' => 'Pick a valid country',
            ]);
        }
    }

    /**
     * CompanyController create.
     */
    public function create($app)
    {
        $app = title_case(str_replace("-", " ", $app));

        //find
        $passed = Product::where('title', $app)->first();

        //get the list of countries
        $countries = Countries::getList('en', 'php');

        //check if null
        if ($passed == null)
            return redirect()->back()
                ->with('error', 'Sorry, the page you are looking for does not exist.');

        //generate view
        return view('v1.company.create')
            ->with('app', $app)
            ->with('app_data', $passed)
            ->with('countries', $countries);
    }

    /**
     * CompanyController store.
     */
    public function store(Request $request)
    {
        //@vars
        $success = array();
        $error = array();
        $s = 0;
        $e = 0;

        $validator = $this->validator($request->all(), null);

        //check for errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        //catch input
        $app = Product::find($request->input('_app'));

        //save company
        $company = new Company();
        $company->title = $request->input('company');
        $company->country = $request->input('country');
        $company->city = $request->input('city');
        $company->zipcode = $request->input('zipcode');
        $company->state = $request->input('state');
        $company->address = $request->input('address');
        $company->phone = $request->input('phone');
        $company->email = $request->input('email');
        $company->status = 1;

        //save
        if ($company->save()) {
            //init @message
            $success = array_add($success, $s++, "Company successfully added.");

            //catch id
            $id = $company->id;

            //save company app
            $type = new CompanyApp();
            $type->company_id = $id;

            if ($app->companies()->save($type)) {
                $success = array_add($success, $s++, "App successfully created.");
            } else {
                $error = array_add($error, $e++, "Failed adding app to company");
                return redirect()->back()
                    ->with('bulk_error', $error);
            }

            //save company user
            $user = new CompanyUser();
            $user->company_id = $type->id;
            $user->admin = 1;

            if (Auth::user()->companies()->save($user)) {
                $success = array_add($success, $s++, "You have been set as the admin for the company.");

                $role = new UserRole();
                $role->role_id = $request->input('_role');

                if (Auth::user()->roles()->save($role)) {
                    $success = array_add($success, $s++, "You have been given full privileges on the app.");
                } else {
                    $error = array_add($error, $e++, "Failed assigning you full privileges on the app.");
                }
            } else {
                $error = array_add($error, $e++, "Failed setting you as admin for the company");
            }

            if ($error != null) {
                return redirect()->route('estate.dashboard', ['id' => $type->id])
                    ->with('bulk_success', $success)
                    ->with('bulk_error', $error);
            }

            //redirect without errors
            return redirect()->route('estate.dashboard', ['id' => $type->id])
                ->with('bulk_success', $success);
        }

        //redirect with error if failed
        return redirect()->back()
            ->with('error', 'Some error encountered. Failed adding company. Try again!')
            ->withInput();
    }

    /**
     * CompanyController update.
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

        //save company
        $company = Company::find($id);
        $company->title = $request->input('company');
        $company->country = $request->input('country');
        $company->city = $request->input('city');
        $company->zipcode = $request->input('zipcode');
        $company->state = $request->input('state');
        $company->address = $request->input('address');
        $company->phone = $request->input('phone');
        $company->email = $request->input('email');
        $company->status = $request->input('status');

        //save
        if ($company->save()) {
            return redirect()->back()
                ->with('success', 'Company profile updated successfully.');
        }

        //redirect with error if failed
        return redirect()->back()
            ->with('error', 'Some error encountered. Failed adding company. Try again!')
            ->withInput();
    }

    /**
     * CompanyController toggleStatus.
     */
    public function toggleStatus($id)
    {
        $app = Company::find($id);

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
                ->with('success', $app->title . ' company status updated successfully!');
        else
            return redirect()->back()
                ->with('success', $app->title . ' company status update failed. Try again!');

    }

    /**
     * CompanyController delete.
     */
    public function delete($id)
    {
        //find
        $app = Company::find($id);

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
     * CompanyController restore.
     */
    public function restore($id)
    {
        //find
        $app = Company::onlyTrashed()->where('id', $id)->first();

        //check if null
        if ($app == null)
            return redirect()->back()
                ->with('error', 'You tried to perform an action on an invalid record.');

        //restore
        if ($app->restore()) {
            return redirect()->route('user.dashboard')
                ->with('success', $app->title . ' company restored successfully.');
        }
        return redirect()->back()
            ->with('error', 'Failed restoring company ' . $app->title . '. Try again!');
    }

    /**
     * CompanyController destroy.
     */
    public function destroy($id)
    {
        //find
        $app = Company::onlyTrashed()->where('id', $id)->first();

        //check if null
        if ($app == null)
            return redirect()->back()
                ->with('error', 'You tried to perform an action on an invalid record.');

        //title
        $title = $app->title;

        //delete
        if ($app->forceDelete()) {
            return redirect()->back()
                ->with('success', 'Company deletion successful. ' . $title . ' is removed completely!');
        }
        return redirect()->back()
            ->with('error', 'Failed deleting company. Try again!');
    }

    /**
     * CompanyController profile.
     */
    public function profile(Request $request, $id)
    {

        //section
        $section = $request->section;

        //company
        $company = Company::find($id);

        //avatars
        $avatars = $company->avatars()->orderBy('created_at', 'DESC')->get();

        //logo
        $logo = $company->avatars()->where('status', 1)->first();

        //get the list of countries
        $countries = Countries::getList('en', 'php');

//        dd($avatars);

        $data = [
            'section' => $section,
            'company' => $company,
            'countries' => $countries,
            'avatars' => $avatars,
            'logo' => $logo,
        ];

        //view
        if ($section == null)
            return view('v1.company.profile', $data);

        else if ($section == "logo")
            return view('v1.company.logo', $data);

    }

    /**
     * CompanyController storeLogo.
     * @param Request $request
     */
    public function storeLogo(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,jpg,png,gif',
            'type' => 'required',
            '_company' => 'required|exists:companies,id',
            'data-alt' => 'required',
        ]);

        //grab
        $id = $request->input('_company');
        $image = $request->file('image');
        $type = $request->input('type');
        $alt = $request->input('data-alt');

        //company
        $company = Company::find($id);

//        dd($id);

        //ext
        $fileExt = $image->getClientOriginalExtension();

        //org name
        $orgName = $image->getClientOriginalName();

        //org path
        $orgPath = $image->getRealPath();

        //mime
        $mime = $image->getMimeType();

        //new name
        $newName = md5(str_random(16)) . '.' . $fileExt;

        //directory
        $directory = config('settings.avatar_storage_company') . '/' . $company->id;

        //thumb
        $thumbDir = config('settings.avatar_storage_company') . '/' . $company->id . '/' . 'thumbs';

        //create directories
        Storage::disk('common')->makeDirectory($directory);
        Storage::disk('common')->makeDirectory($thumbDir);

        //storage paths
        $path = public_path($directory . '/' . $newName);
        $thumbPath = public_path($thumbDir . '/' . $newName);

        //url paths
        $url = ($directory . '/' . $newName);
        $thumbUrl = ($thumbDir . '/' . $newName);

        //image data
        $data = [
            'url' => $url,
            'thumbUrl' => $thumbUrl,
            'alt' => $alt,
            'mime' => $mime,
            'tag' => 'profile; logo; avatar;',
            'description' => 'company logo',
            'gallery' => 'profile pictures',
        ];

        //debug
//        dd([$newName, $type, $data]);

        //resize
        Image::make($orgPath)->resize(468, 249)->save($path);
        Image::make($orgPath)->resize(96, 96)->save($thumbPath);

        //save
        $logo = new Avatar();
        $logo->name = $newName;
        $logo->type = $type;
        $logo->data = $data;
        $logo->status = 1;

        //debug
//        dd($logo);

        if ($company->avatars()->save($logo)) {
            //catch id
            $id = $logo->id;

            //disable previous logo
            $company->avatars()->where('id', '<>', $id)->where('status', 1)->update(['status' => 0]);

            return redirect()->back()
                ->with('success', 'Company logo uploaded successfully.');
        } else {

            return redirect()->back()
                ->with('error', 'Company logo upload failed. No changes made.');
        }
    }

    /**
     * CompanyController changeLogo.
     */
    public function changeLogo($id)
    {
        //avatar
        $avatar = Avatar::find($id);

        if ($avatar == null)
            abort(401);

        //company
        $company = $avatar->avatarable;

        if ($avatar->update(['status' => 1])) {

            //disable previous logo
            $company->avatars()->where('id', '<>', $id)->where('status', 1)->update(['status' => 0]);

            return redirect()->back()
                ->with('success', 'Company logo changed successfully.');
        }

        //error
        return redirect()->back()
            ->with('error', 'Company logo upload failed. No changes made.');
    }

    /**
     * CompanyController deleteLogo.
     */
    public function deleteLogo($id)
    {
        if (Avatar::destroy($id))
            return redirect()->back()
                ->with('success', 'Logo deleted completely');

        return redirect()->back()
            ->with('error', 'Sorry, logo deletion failed. Please try again.');
    }

    /**
     * CompanyController settings.
     */
    public function settings()
    {

    }

//        $ex_countries = ExtCountries::all()->pluck('area', 'name.common', 'currency.0.ISO4217Code', 'name.common');
//        $ex_countries = ExtCountries::all()->toArray();
//        $ex_countries = ExtCountries::all()->pluck('name.common');
}

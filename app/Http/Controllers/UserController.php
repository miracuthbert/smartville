<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|max:255',
            'phone' => 'numeric',
            'password' => 'required',
        ]);
    }

    /*
     * Method : dashboard
     * Handles User Dashboard View
     * */
    public function dashboard(Request $request)
    {

        //section
        $section = $request->section;

        View::share('section', $section);

        $apps = $request->user()->apps;

        if ($section == "apps-new")
            return view('v1.user.dashboard.apps');

        elseif ($section == "apps") {

            //active apps
            $active_apps = $request->user()->activeApps()->with('app')->get();

            //disabled apps
            $disabled_apps = $request->user()->disabledApps;

            //trashed apps
            $trashed_apps = $request->user()->trashedApps;

            return view('v1.user.dashboard.myapps')
                ->with('active_apps', $active_apps)
                ->with('disabled_apps', $disabled_apps)
                ->with('trashed_apps', $trashed_apps);
        } elseif ($section == null)
            return view('v1.user.dashboard.dashboard')
                ->with('user_apps', $apps);
    }

    /*
     * Method : getUserSetting
     * Handles User General Settings
     * */
    public function settings()
    {
        return view('v1.user.settings');
    }

    /*
     * Method : profile
     * Handles User General Profile
     * */
    public function profile()
    {
        //user
        $user = Auth::user();

        return view('v1.user.profile');
    }

    /*
     * Method : update profile
     * Handles User Profile Update
     * */
    public function update(Request $request)
    {

        if (!password_verify($request->input('password'), Auth::user()->password)) {
            return redirect()->back()
                ->with('error', 'Invalid password. Profile update failed.');
        }

        $profile = Auth::user();
        $profile->firstname = $request->input('first_name');
        $profile->lastname = $request->input('last_name');
        $profile->email = $request->input('email');
        $profile->phone = $request->input('phone');
        $profile->country = $request->input('country');

        if ($profile->update()) {
            return redirect()->back()
                ->with('success', 'Profile updated successfully.');
        } else {
            return redirect()->back()
                ->with('error', 'Profile update failed.');
        }

    }

    public function verifyEmail(Request $request)
    {

    }
}

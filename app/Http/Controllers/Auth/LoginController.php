<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating user for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect user after login.
     *
     * @var string
     */
    protected $redirectTo = '/user/dashboard';

    /**
     * @param auth
     * Used to catch the passed guard
     */
    protected $auth;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->auth = $auth;
    }


    /**
     * Method : getLogin
     * Handles Login View
     */
    public function getLogin()
    {
        return view('v1.auth.login');
    }

    /**
     * Method : postLogIn
     * Handles Login Process
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($this->auth->attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')],
            $request->input('remember') == 1 ? true : false)
        ) {

            //redirect to previous request url
            if (Session::has('oldUrl')) {
                $oldUrl = Session::get('oldUrl');
                Session::forget('oldUrl');

                return redirect()->to($oldUrl);
            }

            return redirect()->route('user.dashboard')
                ->with('success', 'Welcome back ' . Auth::user()->firstname . '. You are now logged in.');
        }

        return redirect()->back()
            ->with('error', 'Whoops! Incorrect email or password given. Failed login!')
            ->withInput();
    }

    /**
     * Method : getLogout
     * Handles LogOut Process
     */
    public function getLogout(Request $request)
    {
        Auth::logout();
        return redirect()->route('home')
            ->with('success', 'You have successfully logged out. See you soon!');
    }

}

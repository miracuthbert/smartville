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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @param Request $request
     * @param mixed $user
     */
    protected function authenticated(Request $request, $user)
    {

        //TODO: create a helper file or package or db table to generate more custom greetings
        $greeting = $request->session()->has('oldUrl') ? "Resumed from where you left off last time" : "Nice to see you again!";

        $redirect = $request->session()->has('oldUrl') ? $request->session()->pull('oldUrl') : $this->redirectTo;

        $username = !empty($user->username) ? $user->username : $user->firstname;

        //pass greeting
        $request->session()->flash('success', "Welcome back, " . $username . ". " . $greeting);

        $this->redirectTo = $redirect;

    }
}

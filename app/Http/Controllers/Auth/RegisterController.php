<?php

namespace App\Http\Controllers\Auth;

use App\Traits\ActivationKeyTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new user as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers, ActivationKeyTrait;

    /**
     * Where to redirect user after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'first_name' => 'required|string|max:30',
            'last_name' => 'required|string|max:30',
            'username' => 'required|string|max:30|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'firstname' => $data['first_name'],
            'lastname' => $data['last_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'activated' => !config('settings.send_activation_email'),
        ]);
    }

    /**
     * @param Request $request
     * @param mixed $user
     */
    protected function registered(Request $request, $user)
    {
        $redirect = Session::has('oldUrl') ? Session::get('oldUrl') : $this->redirectTo;

        //TODO: create a helper file or package or db table to generate more custom greetings
        $greeting = Session::has('oldUrl') ? "Picking up from where you were" : "";

        $username = !empty($user->username) ? $user->username : $user->firstname;

        //pass greeting
        $request->session()->flash('success', "Welcome , " . $username . ". " . $greeting);

        $this->redirectTo = $redirect;
    }

}

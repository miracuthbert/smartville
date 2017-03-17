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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|max:20|confirmed',
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
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'activated' => !config('settings.send_activation_email'),
        ]);
    }

    /**
     * UserController getSignUp.
     */
    public function getSignUp()
    {
        return view('v1.auth.signup');
    }

    /**
     * UserController postSignUp.
     */
    public function postSignUp(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // create the user
        if ($user = $this->create($request->all())) {

            // process the activation email for the user
            if ($this->queueActivationKeyNotification($user)) {
                Auth::login($user);

                //redirect to previous request url
                if (Session::has('oldUrl')) {
                    $oldUrl = Session::get('oldUrl');
                    Session::forget('oldUrl');

                    return redirect()->to($oldUrl);
                }

                return redirect()->route('user.dashboard')
                    ->with('success', 'Welcome ' . $user->firstname . ', your account has been activated.');
            } else {
                // we do not want to login the new user
                return redirect('/login')
                    ->with('success', 'We sent you an activation code. Please check your email.');
            }
        } else {
            return redirect()->back()
                ->with('error', 'Whoops! Some error occured. Failed signin you up. Please try again!')
                ->withErrors()
                ->withInput();
        }
    }

}

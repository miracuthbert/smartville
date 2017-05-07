<?php

namespace App\Http\Controllers\Auth;

use App\Activation;
use App\Traits\ActivationKeyTrait;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ActivationController extends Controller
{
    use ActivationKeyTrait;

    /**
     * ActivationController constructor.
     */
    public function __construct()
    {
//        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        $validator = Validator::make($data, [
            'email' => 'required|email',
        ]);

        return $validator;

    }

    public function showKeyResendForm(Request $request)
    {
        return view('v1.auth.resend_key');
    }

    public function activateKey($activation_key)
    {
        // determine if the user is logged-in already
        if (Auth::check()) {
            if (auth()->user()->activated) {

                return redirect()->route('user.dashboard')
                    ->with('success', 'Your email is already activated.');
            }
        }

        // get the activation key and check if its valid
        $activationKey = Activation::where('activation_key', $activation_key)->first();

        if (empty($activationKey)) {
            return redirect()->route('home')
                ->with('error', 'The provided activation key appears to be invalid');
        }

        // process the activation key we're received
        $this->processActivationKey($activationKey);

        // redirect to the login page after a successful activation
        return redirect()->route('login')
            ->with('success', 'You successfully activated your email! You can now login');
    }

    public function resendKey(Request $request)
    {

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $email = $request->get('email');

        // get the user associated to this activation key
        $user = User::where('email', $email)->first();

        if (empty($user)) {
            return redirect()->route('activation_key_resend')
                ->with('error', 'We could not find this email in our system');
        }

        if ($user->activated) {
            return redirect()->route('login')
                ->with('success', 'This email address is already activated');
        }

        // queue up another activation email for the user
        $this->queueActivationKeyNotification($user);

        return redirect()->route('home')
            ->with('success', 'The activation email has been re-sent.');
    }
}

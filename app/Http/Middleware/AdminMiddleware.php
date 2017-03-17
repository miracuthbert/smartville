<?php

namespace App\Http\Middleware;

use App\UserRole;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {

            //get user root privilege
            $root = Auth::user()->root;

            //get user admin privilege
            $admin = Auth::user()->admin;

            if ($root != null && $root->role_id === 1) {
                return $next($request);
            }
            else if($admin != null && $admin->role_id === 2) {
                return $next($request);
            }

            abort(401);
            //send back to user dashboard if logged in
            return redirect()->route('user.dashboard')
                ->with('error', 'Access denied. You have no permission to perform such request!');
        }

        //let app perform default exception handling
        return redirect()->route('login')
            ->with('error', 'Please login first!');

    }
}

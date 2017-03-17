<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CompanyAppAdminMiddleware
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
            //get app admin model
            $app = Auth::user()->companyAppAdmin;

            if ($app == null)
                abort(401);

            if ($app->status === 1) {
                if (count($app) > 0 && $app->role_id === 5) {
                    return $next($request);
                }
            }

            //send back to user dashboard if logged in
            abort(401);
        }

        //let app perform default exception handling
        return redirect()->route('login')
            ->with('error', 'Please login first!');
    }
}

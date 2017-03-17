<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            //get company admin model
            $tenant = Auth::user()->tenant;

            if (count($tenant) > 0) {
                return $next($request);
            }

            //send back to user dashboard if logged in
            return redirect()->route('user.dashboard')
                ->with('error', 'Access denied. You have no permission to perform such request!');
        }

        //let app perform default exception handling
        return redirect()->route('login')
            ->with('error', 'Please login first!');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EstateAdminMiddleware
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
            $role = UserRole::where('user_id', Auth::user()->id)->where('role', 3)->first();
            if ($role->role == 1) {
                return $next($request);
            }
        }

        return redirect()->back()
            ->with('error', 'Access denied. You have no permission to perform such request!');
    }
}

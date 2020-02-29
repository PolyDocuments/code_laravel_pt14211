<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckRoleAdmin
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
        // Check Auth by calling check_auth middleware

        if (Auth::user()->role !== config('common.role.admin')) {
            abort(403);
        }

        return $next($request);
    }
}

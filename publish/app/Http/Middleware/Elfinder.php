<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class Elfinder
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        if (!Sentinel::check()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('admin/login');
            }
        }

        if (Sentinel::hasAnyAccess('elfinder','superadmin')){
            return $next($request);
        }

        return response('Unauthorized.', 401);
    }
}
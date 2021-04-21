<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guard = \Tenant::isTenantRequest() ? 'tenant' : 'system';

        if(empty(session('environment'))){
            session(['environment' => \Request::segment(1)]);
        }

        if (Auth::guard($guard)->check()) {
            //dd(Auth::guard($guard)->check());

            return $guard == 'tenant'?
                redirect()->route('tenant.home', \Request::route('environment')):
                redirect()->route('system.home');
        }

        //dd(session('environment'));

        return $next($request);
    }
}

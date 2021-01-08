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

        //dd(Auth::guard($guard)->check());

        if (Auth::guard($guard)->check()) {
            //dd(Auth::guard($guard)->check());
            return $guard == 'tenant'?
                redirect()->route('tenant.home', \Request::route('environment')):
                redirect()->route('system.home');
        }

        return $next($request);

        /*
        //dd($request->route());
        $guards = empty($guards) ? [null] : $guards;

        //dd($guards);

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                //dd($guard);

                
                return ($request->routeIs('system.*')) ? 
                            redirect('system/' . RouteServiceProvider::HOME) : 
                            redirect($request->route('environment') . '/' . RouteServiceProvider::HOME);
                
                //return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
        */
    }
}

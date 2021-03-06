<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        //dd($request->expectsJson());
        if (! $request->expectsJson()) {
            //dd(\Tenant::isTenantRequest());

            //dd('authenticate');
            $url = \Tenant::isTenantRequest() ?
                route('tenant.login', \Request::route('environment')) :
                route('system.login', 'system');

            //dd($url);
            return $url;
        }
    }
}

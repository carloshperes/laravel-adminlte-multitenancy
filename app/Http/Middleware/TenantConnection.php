<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\System\Company;

class TenantConnection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $environment    = $request->route('environment');
        $company        = null;

        //dd($environment);

        if($environment){
            $company    = Company::where('environment', $environment)->first();

            //dd($company);
            if($company){
                \Tenant::setTenant($company);

                \Config::set('app.tenant', $environment);
            }
        }

        //dd(\Tenant::isTenantRequest());

        if(\Tenant::isTenantRequest() && !$company){
            abort(403, 'Tenant not found');
        }

        return $next($request);
    }
}


<?php

namespace App\Tenant;

use App\Models\System\Company;
use Illuminate\Support\Facades\Schema;

class TenantManager
{
    private $tenant;


    public function getTenant(): ?Company
    {
        return $this->tenant;
    }


    public function setTenant(?Company $tenant): void
    {
        //dd($tenant);
        $this->tenant = $tenant;
        $this->makeTenantConnection();
    }

    private function makeTenantConnection()
    {
        //dd($this->getTenant()->database);
        $clone              = config('database.connections.system');
        $clone['database']  = $this->getTenant()->database;

        \Config::set('database.connections.tenant', $clone);
        \DB::reconnect('tenant');

        //dd($clone);
    }

    public function loadConnections()
    {
        if(Schema::hasTable((new Company())->getTable())) {
            $companies  = Company::all();
            foreach($companies as $company){
                $clone = config('database.connections.system');
                $clone['database'] = $company->database;
                \Config::set("database.connections.{$company->environment}", $clone);
            }
        }
    }

    public function isTenantRequest(){
        return !\Request::is('system/*') && \Request::route('environment');
    }
}
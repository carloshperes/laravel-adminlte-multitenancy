<?php

namespace App\Console\Commands;

use App\Models\System\Company;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SeedTenant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant:seed {--drop}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed tenants databases';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $drop = $this->option('drop');

        //dd($drop);

        if($drop){
            if(Schema::hasTable((new Company())->getTable())){
                $companies = Company::all();
                foreach ($companies as $company) {
                    DB::statement("DROP DATABASE IF EXISTS {$company->database}"); // 
                }
                $this->info('Tenant database dropped');
            }

            $fresh = ':fresh';
        
        } else {

            $fresh = '';

        }

        $this->info('Seeding system');
        $this->call('migrate' . $fresh, [
            '--database'    => 'system',
            '--path'        => 'database/migrations/system'
        ]);

        // If database was droped, seed again
        if($drop){
            $this->call('db:seed', [
                '--class'        => 'SystemDatabaseSeeder'
            ]);
        }

        \Tenant::LoadConnections();
        $this->info('Seeding system finished');

        $query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME =  ?";

        //$this->call('tenant:create', [
        //    '--ids' => implode(',', $companies->pluck('id')->toArray())
        //]);

        $companies = Company::all();

        foreach($companies as $company){

            $db = DB::select($query, [$company->database]);

            if(empty($db)){
                $this->call('tenant:create', [
                    '--ids' => $company->id
                ]);
            }

            // If database was droped, seed again
            if($drop){
                $this->call('db:seed', [
                    '--database'    => $company->environment,
                    '--class'       => 'TenantDatabaseSeeder'
                ]);
            }

        }
    }
}

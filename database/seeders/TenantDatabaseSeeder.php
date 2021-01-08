<?php

namespace Database\Seeders;

use App\Models\System\Company;
use Illuminate\Database\Seeder;

class TenantDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { //db:seed --database=company1
        $connection = \DB::getDefaultConnection();

        //dd($connection);
        $company    = Company::where('environment', $connection)->first();

        //dd($company);
        \Tenant::setTenant($company);

        $this->call(UsersTenantsTableSeeder::class);
        //$this->call(CategoriesTableSeeder::class);
    }
}

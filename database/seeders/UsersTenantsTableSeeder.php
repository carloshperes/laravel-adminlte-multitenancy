<?php

namespace Database\Seeders;

use App\Models\Tenant\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $company = \Tenant::getTenant();

        User::create([
            'name'      => "User - {$company->environment}",
            'email'     => "user@{$company->environment}.com",
            'password'  => Hash::make('123')
        ]);

    }
}

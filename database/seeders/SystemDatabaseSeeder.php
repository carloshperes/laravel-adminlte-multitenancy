<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SystemDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(UserSystemsTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
    }
}
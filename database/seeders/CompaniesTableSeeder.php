<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\System\Company;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 5) as $k => $value) {
            $n = $k+1;
            Company::create([
                'name'          => "Company $value",
                'database'      => "tenant_{$n}_".Str::random(16),
                'environment'   => "company$value"
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\System\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSystemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'Carlos',
            'email'     => 'carlos@system.com',
            'password'  => Hash::make('123')
        ]);
    }
}
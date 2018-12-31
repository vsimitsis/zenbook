<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'Vagelis Simitsis',
            'email' => 'vagelis@example.com',
            'timezone_id' => 339,
            'company_id' => 1,
            'company_role_id' => 1,
            'password' => bcrypt('vagelis')
        ]);

        \App\User::create([
            'name' => 'Tea Sapna',
            'email' => 'tea@example.com',
            'timezone_id' => 339,
            'company_id' => 1,
            'company_role_id' => 2,
            'password' => bcrypt('tea')
        ]);

        \App\User::create([
            'name' => 'Mpampis Saragias',
            'email' => 'mpampis@example.com',
            'timezone_id' => 339,
            'company_id' => 2,
            'company_role_id' => 1,
            'password' => bcrypt('mpampis')
        ]);
    }
}

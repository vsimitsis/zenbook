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
            'company_id' => 1,
            'user_role_id' => 1,
            'password' => bcrypt('vagelis'),
            'status' => 1,
        ]);

        \App\User::create([
            'name' => 'Tea Sapna',
            'email' => 'tea@example.com',
            'company_id' => 1,
            'user_role_id' => 2,
            'password' => bcrypt('tea'),
            'status' => 1,
        ]);

        \App\User::create([
            'name' => 'Mpampis Saragias',
            'email' => 'mpampis@example.com',
            'company_id' => 2,
            'user_role_id' => 1,
            'password' => bcrypt('mpampis'),
            'status' => 1,
        ]);
    }
}

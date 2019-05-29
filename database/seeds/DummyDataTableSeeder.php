<?php

use Illuminate\Database\Seeder;

class DummyDataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Company::create([
            'unique_ref'  => \App\Company::generateUniqueID(),
            'name' => 'VS Solutions',
        ]);

        \App\Company::create([
            'unique_ref'  => \App\Company::generateUniqueID(),
            'name' => 'Hexabit',
        ]);

        \App\User::create([
            'unique_ref'  => \App\User::generateUniqueID(),
            'first_name' => 'Vagelis',
            'last_name'  => 'Simitsis',
            'email' => 'vagelis@example.com',
            'email_verified_at' => \Carbon\Carbon::now(),
            'company_id' => 1,
            'user_role_id' => 1,
            'password' => bcrypt('vagelis'),
            'status' => 1,
        ]);

        \App\User::create([
            'unique_ref'  => \App\User::generateUniqueID(),
            'first_name' => 'Tea',
            'last_name'  => 'Sapna',
            'email' => 'tea@example.com',
            'email_verified_at' => \Carbon\Carbon::now(),
            'company_id' => 1,
            'user_role_id' => 2,
            'password' => bcrypt('tea'),
            'status' => 1,
        ]);

        \App\User::create([
            'unique_ref'  => \App\User::generateUniqueID(),
            'first_name' => 'Mpampis',
            'last_name'  => 'Saragias',
            'email' => 'mpampis@example.com',
            'email_verified_at' => \Carbon\Carbon::now(),
            'company_id' => 2,
            'user_role_id' => 1,
            'password' => bcrypt('mpampis'),
            'status' => 1,
        ]);

        \App\UserSetting::create([
            'user_id'     => 1,
            'language_id' => 1
        ]);

        \App\UserSetting::create([
            'user_id'     => 2,
            'language_id' => 1
        ]);

        \App\UserSetting::create([
            'user_id'     => 3,
            'language_id' => 2
        ]);
    }
}

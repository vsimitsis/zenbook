<?php

use Illuminate\Database\Seeder;

class CompanyRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\CompanyRole::create([
            'name' => 'Administrator'
        ]);

        \App\CompanyRole::create([
            'name' => 'Manager'
        ]);

        \App\CompanyRole::create([
            'name' => 'Employee'
        ]);
    }
}

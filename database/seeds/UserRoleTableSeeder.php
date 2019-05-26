<?php

use Illuminate\Database\Seeder;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\UserRole::create([
            'name' => 'Administrator'
        ]);

        \App\UserRole::create([
            'name' => 'Teacher'
        ]);

        \App\UserRole::create([
            'name' => 'Student'
        ]);
    }
}

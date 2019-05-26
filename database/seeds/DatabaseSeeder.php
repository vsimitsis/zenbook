<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Fixed Seeders
         */
        $this->call(UserRoleTableSeeder::class);

        /**
         * Dummy Seeders
         */
        $this->call(CompanyTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}

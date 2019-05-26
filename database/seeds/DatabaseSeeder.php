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
        $this->call(LanguageTableSeeder::class);

        /**
         * Dummy Seeders
         */
        if (env('APP_ENV') == 'local') {
            $this->call(DummyDataTableSeeder::class);
        }
    }
}

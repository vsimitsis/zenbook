<?php

use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Company::create([
            'name' => 'VSimitsis',
            'subdomain' => 'vsimitsis',
        ]);

        \App\Company::create([
            'name' => 'Hexabit',
            'subdomain' => 'hexabit',
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class ModuleTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\ModuleType::create(['name' => 'Question/Answer']);
        \App\ModuleType::create(['name' => 'Question/MultipleChoice']);
        \App\ModuleType::create(['name' => 'Missing Word']);
    }
}

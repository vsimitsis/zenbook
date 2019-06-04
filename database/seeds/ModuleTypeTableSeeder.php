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
        \App\ModuleType::create([
            'name' => 'question_answer',
            'type' => \App\QuestionAnswer::class,
        ]);

        \App\ModuleType::create([
            'name' => 'multiple_choice',
            'type' => \App\MultipleChoice::class,
        ]);
    }
}

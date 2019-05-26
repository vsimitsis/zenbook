<?php

use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Language::create([
            'language' => 'English',
            'locale'   => 'en',
            'icon'     => 'images/flags/uk.svg'
        ]);

        \App\Language::create([
            'language' => 'Greek',
            'locale'   => 'el',
            'icon'     => 'images/flags/gr.svg'
        ]);
    }
}

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
        /**
         * ---------------------------------------------------
         * General model seeders
         * ---------------------------------------------------
         */

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
            'language_id' => 2
        ]);

        \App\UserSetting::create([
            'user_id'     => 2,
            'language_id' => 2
        ]);

        \App\UserSetting::create([
            'user_id'     => 3,
            'language_id' => 1
        ]);

        /**
         * ---------------------------------------------------
         * Educational model seeders
         * ---------------------------------------------------
         */

        \App\Exam::create([
            'company_id' => 1,
            'user_id'    => 1,
            'name'       => 'Διαγώνισμα Ιστορίας',
            'status'     => 1,
            'visibility' => 0,
        ]);

        \App\Exam::create([
            'company_id' => 1,
            'user_id'    => 1,
            'name'       => 'Διαγώνισμα Μαθηματικών',
            'status'     => 2,
            'visibility' => 1,
        ]);

        \App\Exam::create([
            'company_id' => 1,
            'user_id'    => 1,
            'name'       => 'Διαγώνισμα Φυσικής',
            'status'     => 2,
            'visibility' => 1,
        ]);

        \App\Exam::create([
            'company_id' => 1,
            'user_id'    => 1,
            'name'       => 'Ετήσιο Γενικό',
            'status'     => 2,
            'visibility' => 0,
        ]);

        \App\Exam::create([
            'company_id' => 1,
            'user_id'    => 1,
            'name'       => 'Μηνιαίο Γενικό',
            'status'     => 2,
            'visibility' => 0,
        ]);

        \App\Exam::create([
            'company_id' => 1,
            'user_id'    => 1,
            'name'       => 'Τεστ απόδοσης Αγγλικών',
            'status'     => 2,
            'visibility' => 0,
        ]);

        \App\Exam::create([
            'company_id' => 1,
            'user_id'    => 1,
            'name'       => 'Τεστ Γεωγραφίας',
            'status'     => 2,
            'visibility' => 0,
        ]);

        \App\Exam::create([
            'company_id' => 1,
            'user_id'    => 1,
            'name'       => 'Διαγώνισμα Αγγλικών',
            'status'     => 1,
            'visibility' => 1,
        ]);

        \App\Exam::create([
            'company_id' => 1,
            'user_id'    => 1,
            'name'       => 'Διαγώνισμα Γεωγραφίας',
            'status'     => 2,
            'visibility' => 0,
        ]);

        \App\Exam::create([
            'company_id' => 1,
            'user_id'    => 1,
            'name'       => 'Διαγώνισμα Γαλλικών',
            'status'     => 2,
            'visibility' => 0,
        ]);

        \App\Exam::create([
            'company_id' => 1,
            'user_id'    => 1,
            'name'       => 'Διαγώνισμα Γερμανικών',
            'status'     => 2,
            'visibility' => 0,
        ]);

        \App\Section::create([
            'parent_type' => 'App\Exam',
            'parent_id'   => 8,
            'name'        => 'Ενότητα 1',
            'visibility'  => 1
        ]);

        \App\Section::create([
            'parent_type' => 'App\Exam',
            'parent_id'   => 8,
            'name'        => 'Ενότητα 2',
            'visibility'  => 1
        ]);

        \App\Section::create([
            'parent_type' => 'App\Exam',
            'parent_id'   => 8,
            'name'        => 'Ενότητα 3',
            'visibility'  => 1
        ]);

        \App\Section::create([
            'parent_type' => 'App\Exam',
            'parent_id'   => 8,
            'name'        => 'Ενότητα 4',
            'visibility'  => 0
        ]);

        \App\Section::create([
            'parent_type' => 'App\Exam',
            'parent_id'   => 2,
            'name'        => 'Ενότητα 1',
            'visibility'  => 1
        ]);

        \App\Section::create([
            'parent_type' => 'App\Exam',
            'parent_id'   => 2,
            'name'        => 'Ενότητα 2',
            'visibility'  => 1
        ]);

        \App\Section::create([
            'parent_type' => 'App\Exam',
            'parent_id'   => 2,
            'name'        => 'Ενότητα 3',
            'visibility'  => 0
        ]);

        \App\Section::create([
            'parent_type' => 'App\Exam',
            'parent_id'   => 3,
            'name'        => 'Ενότητα 1',
            'visibility'  => 1
        ]);

        \App\Section::create([
            'parent_type' => 'App\Exam',
            'parent_id'   => 3,
            'name'        => 'Ενότητα 2',
            'visibility'  => 1
        ]);

        \App\Section::create([
            'parent_type' => 'App\Exam',
            'parent_id'   => 3,
            'name'        => 'Ενότητα 3',
            'visibility'  => 0
        ]);
    }
}

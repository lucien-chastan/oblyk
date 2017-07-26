<?php

use Illuminate\Database\Seeder;

class UserPartnerSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Lucien
        DB::table('user_partner_settings')->insert([
            'user_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        //oblyk
        DB::table('user_partner_settings')->insert([
            'user_id' => 2,
            'partner' => 1,
            'description' => 'Je suis robot Oblyk, je cherche d\'autre robot pour grimper avec moi ! COMMUNICATION TERMINER',
            'climb_5' => 1,
            'climb_7' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        //Léna
        DB::table('user_partner_settings')->insert([
            'user_id' => 3,
            'partner' => 1,
            'grade_min' => '5a',
            'grade_max' => '6c',
            'description' => 'Je viens d\'arriver à Caille, je cherche des gens pour grimper, bonne journée',
            'climb_2' => 1,
            'climb_3' => 1,
            'climb_4' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

    }
}

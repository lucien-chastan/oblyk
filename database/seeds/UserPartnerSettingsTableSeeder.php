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
        DB::table('user_partner_settings')->insert([
            'user_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('user_partner_settings')->insert([
            'user_id' => 2,
            'partner' => 1,
            'description' => 'Je viens d\'arriver à Caille, je cherche des gens pour grimper, bonne journée',
            'climb_2' => 1,
            'climb_3' => 1,
            'climb_4' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('user_partner_settings')->insert([
            'user_id' => 3,
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

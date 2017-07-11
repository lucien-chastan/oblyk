<?php

use Illuminate\Database\Seeder;

class UserSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_settings')->insert([
            'user_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('user_settings')->insert([
            'user_id' => 2,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('user_settings')->insert([
            'user_id' => 3,
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

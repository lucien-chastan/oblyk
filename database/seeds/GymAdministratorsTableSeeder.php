<?php

use Illuminate\Database\Seeder;

class GymAdministratorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Lucien - M'roc Villerbanne
        DB::table('gym_administrators')->insert([
            'gym_id' => 1,
            'user_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        // Lucien - Mur de lyon
        DB::table('gym_administrators')->insert([
            'gym_id' => 3,
            'user_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        // Lucien - M'Roc Laennec
        DB::table('gym_administrators')->insert([
            'gym_id' => 4,
            'user_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        // Oblyk - Azium
        DB::table('gym_administrators')->insert([
            'gym_id' => 2,
            'user_id' => 2,
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

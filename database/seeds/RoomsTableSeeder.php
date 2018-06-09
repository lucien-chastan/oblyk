<?php

use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('gym_rooms')->insert([
            'gym_id' => 1,
            'label' => 'Salle principal Villerbanne',
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('gym_rooms')->insert([
            'gym_id' => 3,
            'label' => 'Voie',
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('gym_rooms')->insert([
            'gym_id' => 3,
            'label' => 'Pan',
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('gym_rooms')->insert([
            'gym_id' => 3,
            'label' => 'Bloc',
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('gym_rooms')->insert([
            'gym_id' => 4,
            'label' => 'Salle principal Laennec',
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

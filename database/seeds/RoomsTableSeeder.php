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
            'banner_color' => 'rgb(40,40,40)',
            'banner_bg_color' => 'rgb(255, 255, 255, 0.7)',
            'scheme_bg_color' => 'rgb(255,255,255)',
            'scheme_height' => '578',
            'scheme_width' => '2000',
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

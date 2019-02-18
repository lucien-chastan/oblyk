<?php

use Illuminate\Database\Seeder;

class GymSectorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('gym_sectors')->insert([
            'room_id' => 1,
            'label' => 'Le toit',
            'ref' => '1A',
            'height' => '4',
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('gym_sectors')->insert([
            'room_id' => 1,
            'label' => 'La proue',
            'ref' => '1B',
            'height' => '4',
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('gym_sectors')->insert([
            'room_id' => 1,
            'label' => 'La Dalle',
            'ref' => '2A',
            'height' => '4',
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

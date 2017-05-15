<?php

use Illuminate\Database\Seeder;

class SectorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sectors')->insert([
            'crag_id' => 1,
            'user_id' => 1,
            'lat' => 0,
            'lng' => 0,
            'label' => 'Rose des sables',
            'approach' => 25,
            'rain_id' => 2,
            'sun_id' => 3,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('sectors')->insert([
            'crag_id' => 1,
            'user_id' => 2,
            'lat' => 0,
            'lng' => 0,
            'label' => 'Les Lames',
            'approach' => 15,
            'rain_id' => 1,
            'sun_id' => 3,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('sectors')->insert([
            'crag_id' => 1,
            'user_id' => 2,
            'lat' => 0,
            'lng' => 0,
            'label' => 'Aéria',
            'approach' => 0,
            'rain_id' => 3,
            'sun_id' => 5,
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

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
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('sectors')->insert([
            'crag_id' => 1,
            'user_id' => 2,
            'lat' => 0,
            'lng' => 0,
            'label' => 'Les Lames',
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('sectors')->insert([
            'crag_id' => 1,
            'user_id' => 2,
            'lat' => 0,
            'lng' => 0,
            'label' => 'Aéria',
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

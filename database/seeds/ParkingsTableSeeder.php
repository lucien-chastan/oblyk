<?php

use Illuminate\Database\Seeder;

class ParkingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parkings')->insert([
            'crag_id' => 1,
            'user_id' => 1,
            'lat' => 44.466373,
            'lng' => 5.055227,
            'description' => 'Se garer dans le champs',
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('parkings')->insert([
            'crag_id' => 2,
            'user_id' => 2,
            'lat' => 44.470047,
            'lng' => 5.136188,
            'description' => 'Ne pas se garer chez les Gros',
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

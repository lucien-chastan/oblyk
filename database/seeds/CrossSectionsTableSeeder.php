<?php

use Illuminate\Database\Seeder;

class CrossSectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //La croix sur blue de lucien
        DB::table('cross_sections')->insert([
            'cross_id' => 1,
            'route_section_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        //La croix sur blue par Léna
        DB::table('cross_sections')->insert([
            'cross_id' => 2,
            'route_section_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        //croix sur la lavandière (voie de 2 longueur)
        DB::table('cross_sections')->insert([
            'cross_id' => 3,
            'route_section_id' => 6,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('cross_sections')->insert([
            'cross_id' => 3,
            'route_section_id' => 7,
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

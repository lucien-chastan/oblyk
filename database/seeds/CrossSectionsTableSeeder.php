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
            'mode_id' => 2, //en moulinette
            'hardness_id' => 2, //juste bien côté
            'route_section_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        //La croix sur blue par Léna
        DB::table('cross_sections')->insert([
            'cross_id' => 2,
            'mode_id' => 1, //en tête
            'hardness_id' => 1, //facile bien côté
            'route_section_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        //croix sur la lavandière (voie de 2 longueur)
        DB::table('cross_sections')->insert([
            'cross_id' => 3,
            'mode_id' => 3, //en leader
            'hardness_id' => 3, //dur pour la cotation
            'route_section_id' => 6,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('cross_sections')->insert([
            'cross_id' => 3,
            'mode_id' => 4, //en second
            'hardness_id' => 1, //facile pour la cotation
            'route_section_id' => 7,
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

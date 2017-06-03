<?php

use Illuminate\Database\Seeder;

class RouteSectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // 1 - Blue
        DB::table('route_sections')->insert([
            'route_id' => 1,
            'grade' => '6b',
            'sub_grade' => '+',
            'grade_val' => 34,
            'section_height' => 0,
            'nb_point' => 0,
            'type_point' => 1,
            'type_anchor' => 1,
            'steepness' => 3,
            'section_order' => 1,
        ]);

        // 2 - Crespin
        DB::table('route_sections')->insert([
            'route_id' => 2,
            'grade' => '7a',
            'sub_grade' => '+',
            'grade_val' => 38,
            'section_height' => 0,
            'nb_point' => 0,
            'type_point' => 1,
            'type_anchor' => 1,
            'steepness' => 3,
            'section_order' => 1,
        ]);


        // 3 - A l'aise breizh
        DB::table('route_sections')->insert([
            'route_id' => 3,
            'grade' => '6b',
            'sub_grade' => '+',
            'grade_val' => 34,
            'section_height' => 0,
            'nb_point' => 0,
            'type_point' => 1,
            'type_anchor' => 1,
            'steepness' => 3,
            'section_order' => 1,
        ]);

        // 4 - Joly
        DB::table('route_sections')->insert([
            'route_id' => 4,
            'grade' => '6b',
            'sub_grade' => '',
            'grade_val' => 33,
            'section_height' => 0,
            'nb_point' => 0,
            'type_point' => 1,
            'type_anchor' => 1,
            'steepness' => 3,
            'section_order' => 1,
        ]);

        // 5 - L'attrape cœur
        DB::table('route_sections')->insert([
            'route_id' => 5,
            'grade' => '6c',
            'sub_grade' => '',
            'grade_val' => 35,
            'section_height' => 0,
            'nb_point' => 0,
            'type_point' => 1,
            'type_anchor' => 1,
            'steepness' => 3,
            'section_order' => 1,
        ]);

        // 6 - Lavandière
        DB::table('route_sections')->insert([
            'route_id' => 6,
            'grade' => '7b',
            'sub_grade' => '',
            'grade_val' => 39,
            'section_height' => 0,
            'nb_point' => 0,
            'type_point' => 1,
            'type_anchor' => 1,
            'steepness' => 3,
            'section_order' => 1,
        ]);
    }
}
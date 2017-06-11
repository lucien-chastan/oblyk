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
            'point_id' => 1,
            'anchor_id' => 1,
            'reception_id' => 1,
            'start_id' => 1,
            'incline_id' => 1,
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
            'point_id' => 2,
            'anchor_id' => 2,
            'reception_id' => 2,
            'start_id' => 2,
            'incline_id' => 2,
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
            'point_id' => 3,
            'anchor_id' => 3,
            'reception_id' => 3,
            'start_id' => 3,
            'incline_id' => 3,
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
            'point_id' => 4,
            'anchor_id' => 4,
            'reception_id' => 4,
            'start_id' => 4,
            'incline_id' => 4,
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
            'point_id' => 5,
            'anchor_id' => 5,
            'reception_id' => 5,
            'start_id' => 5,
            'incline_id' => 5,
            'section_order' => 1,
        ]);

        // 6 - Lavandière
        DB::table('route_sections')->insert([
            'route_id' => 6,
            'grade' => '6a',
            'sub_grade' => '',
            'grade_val' => 31,
            'section_height' => 40,
            'nb_point' => 9,
            'point_id' => 2,
            'anchor_id' => 2,
            'reception_id' => 1,
            'start_id' => 1,
            'incline_id' => 3,
            'section_order' => 1,
        ]);

        DB::table('route_sections')->insert([
            'route_id' => 6,
            'grade' => '5c',
            'sub_grade' => '',
            'grade_val' => 30,
            'section_height' => 40,
            'nb_point' => 10,
            'point_id' => 2,
            'anchor_id' => 3,
            'reception_id' => 1,
            'start_id' => 1,
            'incline_id' => 2,
            'section_order' => 2,
        ]);
    }
}
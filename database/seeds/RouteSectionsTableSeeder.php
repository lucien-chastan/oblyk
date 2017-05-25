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
        DB::table('route_sections')->insert([
            'route_id' => 1,
            'grade' => '6b',
            'sub_grade' => '+',
            'grade_val' => 45,
            'sections_height' => 0,
            'nb_point' => 0,
            'type_point' => 1,
            'type_anchor' => 1,
            'steepness' => 3,
            'sections_order' => 1,
        ]);

        DB::table('route_sections')->insert([
            'route_id' => 2,
            'grade' => '6a',
            'sub_grade' => '/+',
            'grade_val' => 45,
            'sections_height' => 0,
            'nb_point' => 0,
            'type_point' => 1,
            'type_anchor' => 1,
            'steepness' => 3,
            'sections_order' => 1,
        ]);
    }
}
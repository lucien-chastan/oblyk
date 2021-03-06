<?php

use Illuminate\Database\Seeder;

class OrientationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //ORIENTATION DES FALAISES

        DB::table('orientations')->insert([
            'orientable_id' => 1,
            'orientable_type' => 'App\Crag',
            'north' => 0,
            'east' => 0,
            'south' => 1,
            'west' => 0,
            'north_east' => 0,
            'north_west' => 0,
            'south_east' => 1,
            'south_west' => 0,
        ]);

        DB::table('orientations')->insert([
            'orientable_id' => 2,
            'orientable_type' => 'App\Crag',
            'north' => 0,
            'east' => 0,
            'south' => 0,
            'west' => 1,
            'north_east' => 0,
            'north_west' => 0,
            'south_east' => 0,
            'south_west' => 1,
        ]);

        DB::table('orientations')->insert([
            'orientable_id' => 3,
            'orientable_type' => 'App\Crag',
            'north' => 0,
            'east' => 0,
            'south' => 0,
            'west' => 1,
            'north_east' => 0,
            'north_west' => 0,
            'south_east' => 0,
            'south_west' => 1,
        ]);

        DB::table('orientations')->insert([
            'orientable_id' => 4,
            'orientable_type' => 'App\Crag',
            'north' => 0,
            'east' => 0,
            'south' => 0,
            'west' => 1,
            'north_east' => 0,
            'north_west' => 0,
            'south_east' => 0,
            'south_west' => 1,
        ]);

        DB::table('orientations')->insert([
            'orientable_id' => 5,
            'orientable_type' => 'App\Crag',
            'north' => 0,
            'east' => 0,
            'south' => 0,
            'west' => 1,
            'north_east' => 0,
            'north_west' => 0,
            'south_east' => 0,
            'south_west' => 1,
        ]);

        //ORIENTATION DES SECTEURS

        DB::table('orientations')->insert([
            'orientable_id' => 1,
            'orientable_type' => 'App\Sector',
            'north' => 0,
            'east' => 1,
            'south' => 1,
            'west' => 1,
            'north_east' => 0,
            'north_west' => 0,
            'south_east' => 1,
            'south_west' => 1,
        ]);

        DB::table('orientations')->insert([
            'orientable_id' => 2,
            'orientable_type' => 'App\Sector',
            'north' => 0,
            'east' => 0,
            'south' => 0,
            'west' => 0,
            'north_east' => 1,
            'north_west' => 0,
            'south_east' => 0,
            'south_west' => 0,
        ]);

        DB::table('orientations')->insert([
            'orientable_id' => 3,
            'orientable_type' => 'App\Sector',
            'north' => 0,
            'east' => 1,
            'south' => 1,
            'west' => 0,
            'north_east' => 0,
            'north_west' => 0,
            'south_east' => 1,
            'south_west' => 0,
        ]);
    }
}

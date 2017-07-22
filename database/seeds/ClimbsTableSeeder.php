<?php

use Illuminate\Database\Seeder;

class ClimbsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('climbs')->insert(['label' => 'inconnu']); // 1
        DB::table('climbs')->insert(['label' => 'bloc']); // 2
        DB::table('climbs')->insert(['label' => 'voie']); // 3
        DB::table('climbs')->insert(['label' => 'grande-voie']); // 4
        DB::table('climbs')->insert(['label' => 'trad']); // 5
        DB::table('climbs')->insert(['label' => 'artif']); // 6
        DB::table('climbs')->insert(['label' => 'deep-water']); // 7
        DB::table('climbs')->insert(['label' => 'via-ferrata']); // 8
    }
}
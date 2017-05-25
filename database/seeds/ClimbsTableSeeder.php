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
        DB::table('climbs')->insert(['label' => 'inconnu']);
        DB::table('climbs')->insert(['label' => 'bloc']);
        DB::table('climbs')->insert(['label' => 'voie']);
        DB::table('climbs')->insert(['label' => 'grande-voie']);
        DB::table('climbs')->insert(['label' => 'trad']);
        DB::table('climbs')->insert(['label' => 'artif']);
        DB::table('climbs')->insert(['label' => 'deep-water']);
    }
}
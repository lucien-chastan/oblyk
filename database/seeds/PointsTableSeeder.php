<?php

use Illuminate\Database\Seeder;

class PointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('points')->insert(['label' => 'inconnue']);
        DB::table('points')->insert(['label' => 'broches']);
        DB::table('points')->insert(['label' => 'plaquettes']);
        DB::table('points')->insert(['label' => 'crochets']);
        DB::table('points')->insert(['label' => 'anneaux']);
        DB::table('points')->insert(['label' => 'pas de point']);
    }
}

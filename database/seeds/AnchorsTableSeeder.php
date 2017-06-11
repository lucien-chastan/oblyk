<?php

use Illuminate\Database\Seeder;

class AnchorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('anchors')->insert(['label' => 'inconnue']);
        DB::table('anchors')->insert(['label' => 'relais chaîné']);
        DB::table('anchors')->insert(['label' => '2 points non chaîné']);
        DB::table('anchors')->insert(['label' => 'tête de bélier']);
        DB::table('anchors')->insert(['label' => 'relais sur freinds']);
        DB::table('anchors')->insert(['label' => 'pas de relais']);
    }
}

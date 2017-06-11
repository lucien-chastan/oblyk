<?php

use Illuminate\Database\Seeder;

class InclinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inclines')->insert(['label' => 'inconnue']);
        DB::table('inclines')->insert(['label' => 'dalle positive']);
        DB::table('inclines')->insert(['label' => 'mur vertical']);
        DB::table('inclines')->insert(['label' => 'léger dévers']);
        DB::table('inclines')->insert(['label' => 'dévers']);
        DB::table('inclines')->insert(['label' => 'toit']);
    }
}

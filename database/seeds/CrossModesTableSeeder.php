<?php

use Illuminate\Database\Seeder;

class CrossModesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cross_modes')->insert(['label' => 'tête']);
        DB::table('cross_modes')->insert(['label' => 'moulinette']);
        DB::table('cross_modes')->insert(['label' => 'leader']);
        DB::table('cross_modes')->insert(['label' => 'second']);
        DB::table('cross_modes')->insert(['label' => 'réversible']);
    }
}

<?php

use Illuminate\Database\Seeder;

class CrossStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cross_status')->insert(['label' => 'projet']);
        DB::table('cross_status')->insert(['label' => 'terminé']);
        DB::table('cross_status')->insert(['label' => 'après travail']);
        DB::table('cross_status')->insert(['label' => 'flash']);
        DB::table('cross_status')->insert(['label' => 'a vue']);
    }
}

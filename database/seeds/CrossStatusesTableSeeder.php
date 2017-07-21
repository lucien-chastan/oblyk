<?php

use Illuminate\Database\Seeder;

class CrossStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cross_statuses')->insert(['label' => 'projet']);
        DB::table('cross_statuses')->insert(['label' => 'terminé']);
        DB::table('cross_statuses')->insert(['label' => 'après travail']);
        DB::table('cross_statuses')->insert(['label' => 'flash']);
        DB::table('cross_statuses')->insert(['label' => 'a vue']);
        DB::table('cross_statuses')->insert(['label' => 'répétition']);
    }
}

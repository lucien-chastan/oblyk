<?php

use Illuminate\Database\Seeder;

class StartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('starts')->insert(['label' => 'inconnue']);
        DB::table('starts')->insert(['label' => 'départ assis']);
        DB::table('starts')->insert(['label' => 'départ debout']);
        DB::table('starts')->insert(['label' => 'départ sauté']);
        DB::table('starts')->insert(['label' => 'run and jump']);
    }
}

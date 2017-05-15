<?php

use Illuminate\Database\Seeder;

class SunsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suns')->insert(['label' => 'ensoleillement non renseigné']);
        DB::table('suns')->insert(['label' => 'ensoleillé toute la journée']);
        DB::table('suns')->insert(['label' => 'à l\'ombre toute la journée']);
        DB::table('suns')->insert(['label' => 'au soleil l\'après-midi']);
        DB::table('suns')->insert(['label' => 'au soleil le matin']);
    }
}
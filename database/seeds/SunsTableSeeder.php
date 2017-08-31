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
        DB::table('suns')->insert(['label' => 'ensoleillement inconnu']); // 1
        DB::table('suns')->insert(['label' => 'ensoleillé toute la journée']); // 2
        DB::table('suns')->insert(['label' => 'à l\'ombre toute la journée']); // 3
        DB::table('suns')->insert(['label' => 'au soleil l\'après-midi']); // 4
        DB::table('suns')->insert(['label' => 'au soleil le matin']); // 5
    }
}
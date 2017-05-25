<?php

use Illuminate\Database\Seeder;

class RainExposuresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rain_exposures')->insert(['label' => 'éxposition à la pluie inconnu']);
        DB::table('rain_exposures')->insert(['label' => 'abrité de la pluie']);
        DB::table('rain_exposures')->insert(['label' => 'éxposé à la pluie']);
    }
}

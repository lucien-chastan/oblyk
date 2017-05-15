<?php

use Illuminate\Database\Seeder;

class RainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rains')->insert(['label' => 'éxposition à la pluie non renseigné']);
        DB::table('rains')->insert(['label' => 'abrité de la pluie']);
        DB::table('rains')->insert(['label' => 'éxposé à la pluie']);
    }
}

<?php

use Illuminate\Database\Seeder;

class CrossHardnessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cross_hardness')->insert(['label' => 'facile pour la cotation']);
        DB::table('cross_hardness')->insert(['label' => 'juste, bien coté']);
        DB::table('cross_hardness')->insert(['label' => 'dur pour la cotation']);
    }
}

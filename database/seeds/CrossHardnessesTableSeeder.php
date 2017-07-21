<?php

use Illuminate\Database\Seeder;

class CrossHardnessesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cross_hardnesses')->insert(['label' => 'facile pour la cotation']);
        DB::table('cross_hardnesses')->insert(['label' => 'juste, bien coté']);
        DB::table('cross_hardnesses')->insert(['label' => 'dur pour la cotation']);
    }
}

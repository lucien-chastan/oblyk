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
        DB::table('cross_hardnesses')->insert(['label' => 'pas d\'avis']); // 1
        DB::table('cross_hardnesses')->insert(['label' => 'facile pour la cotation']); // 2
        DB::table('cross_hardnesses')->insert(['label' => 'juste, bien coté']); // 3
        DB::table('cross_hardnesses')->insert(['label' => 'dur pour la cotation']); // 4
    }
}

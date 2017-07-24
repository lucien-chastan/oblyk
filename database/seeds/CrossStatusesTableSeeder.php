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
        DB::table('cross_statuses')->insert(['label' => 'projet']); // 1
        DB::table('cross_statuses')->insert(['label' => 'terminé']); // 2
        DB::table('cross_statuses')->insert(['label' => 'après travail']); // 3
        DB::table('cross_statuses')->insert(['label' => 'flash']); // 4
        DB::table('cross_statuses')->insert(['label' => 'à vue']); // 5
        DB::table('cross_statuses')->insert(['label' => 'répétition']); // 6
    }
}

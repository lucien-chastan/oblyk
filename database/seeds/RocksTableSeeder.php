<?php

use Illuminate\Database\Seeder;

class RocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rocks')->insert(['label' => 'inconnue']);     // 1
        DB::table('rocks')->insert(['label' => 'ardoise']);      // 2
        DB::table('rocks')->insert(['label' => 'calcaire']);     // 3
        DB::table('rocks')->insert(['label' => 'conglomérats']); // 4
        DB::table('rocks')->insert(['label' => 'gabbro']);       // 5
        DB::table('rocks')->insert(['label' => 'gneiss']);       // 6
        DB::table('rocks')->insert(['label' => 'granite']);      // 7
        DB::table('rocks')->insert(['label' => 'grès']);         // 8
        DB::table('rocks')->insert(['label' => 'migmatite']);    // 9
        DB::table('rocks')->insert(['label' => 'molasse']);      // 10
        DB::table('rocks')->insert(['label' => 'quartzite']);    // 11
        DB::table('rocks')->insert(['label' => 'serpentine']);   // 12
        DB::table('rocks')->insert(['label' => 'silex']);        // 13
        DB::table('rocks')->insert(['label' => 'basalte']);      // 14
        DB::table('rocks')->insert(['label' => 'rhiolyte']);     // 15
        DB::table('rocks')->insert(['label' => 'andésite']);     // 16
        DB::table('rocks')->insert(['label' => 'schiste']);      // 17
        DB::table('rocks')->insert(['label' => 'phonolithe']);   // 18
    }
}

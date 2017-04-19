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
        DB::table('rocks')->insert(['label' => 'inconnue']);
        DB::table('rocks')->insert(['label' => 'ardoise']);
        DB::table('rocks')->insert(['label' => 'calcaire']);
        DB::table('rocks')->insert(['label' => 'conglomérats']);
        DB::table('rocks')->insert(['label' => 'gabbro']);
        DB::table('rocks')->insert(['label' => 'gneiss']);
        DB::table('rocks')->insert(['label' => 'granite']);
        DB::table('rocks')->insert(['label' => 'grès']);
        DB::table('rocks')->insert(['label' => 'migmatite']);
        DB::table('rocks')->insert(['label' => 'molasse']);
        DB::table('rocks')->insert(['label' => 'quartzite']);
        DB::table('rocks')->insert(['label' => 'serpentine']);
        DB::table('rocks')->insert(['label' => 'silex']);
        DB::table('rocks')->insert(['label' => 'basalte']);
        DB::table('rocks')->insert(['label' => 'rhiolyte']);
        DB::table('rocks')->insert(['label' => 'andésite']);
        DB::table('rocks')->insert(['label' => 'schiste']);
        DB::table('rocks')->insert(['label' => 'phonolithe']);
    }
}

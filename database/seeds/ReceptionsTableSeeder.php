<?php

use Illuminate\Database\Seeder;

class ReceptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('receptions')->insert(['label' => 'inconnue']);
        DB::table('receptions')->insert(['label' => 'bonne']);
        DB::table('receptions')->insert(['label' => 'correcte']);
        DB::table('receptions')->insert(['label' => 'mauvaise']);
        DB::table('receptions')->insert(['label' => 'dangeureuse']);
    }
}

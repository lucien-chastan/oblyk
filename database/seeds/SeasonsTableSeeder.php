<?php

use Illuminate\Database\Seeder;

class SeasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //SAISON SUR FALAISE

        DB::table('seasons')->insert([
            'seasontable_id' => 1,
            'seasontable_type' => 'App\Crag',
            'summer' => 0,
            'autumn' => 1,
            'winter' => 0,
            'spring' => 1,
        ]);

        DB::table('seasons')->insert([
            'seasontable_id' => 2,
            'seasontable_type' => 'App\Crag',
            'summer' => 1,
            'autumn' => 0,
            'winter' => 1,
            'spring' => 0,
        ]);


        //SAISON SUR SECTEUR

        DB::table('seasons')->insert([
            'seasontable_id' => 1,
            'seasontable_type' => 'App\Sector',
            'summer' => 1,
            'autumn' => 0,
            'winter' => 1,
            'spring' => 0,
        ]);

        DB::table('seasons')->insert([
            'seasontable_id' => 2,
            'seasontable_type' => 'App\Sector',
            'summer' => 1,
            'autumn' => 1,
            'winter' => 1,
            'spring' => 1,
        ]);
    }
}

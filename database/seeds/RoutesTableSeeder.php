<?php

use Illuminate\Database\Seeder;

class RoutesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('routes')->insert([
            'label' => 'Blue',
            'crag_id' => 1,
            'sector_id' => 1,
            'user_id' => 1,
            'climbing_id' => 2,
            'height' => 25,
            'open_year' => 2001,
            'opener' => 'François Crespo',
            'note' => 6,
            'nb_note' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('routes')->insert([
            'label' => 'Crespin',
            'crag_id' => 1,
            'sector_id' => 1,
            'user_id' => 1,
            'climbing_id' => 2,
            'height' => 28,
            'open_year' => 2001,
            'opener' => 'François Crespo',
            'note' => 3,
            'nb_note' => 2,
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}
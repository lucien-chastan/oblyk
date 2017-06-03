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

        // 1 - Blue
        DB::table('routes')->insert([
            'label' => 'Blue',
            'crag_id' => 1,
            'sector_id' => 1,
            'user_id' => 1,
            'climb_id' => 3,
            'height' => 36,
            'open_year' => 2001,
            'opener' => 'François Crespo',
            'note' => 6,
            'nb_note' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        // 2 - Crespin
        DB::table('routes')->insert([
            'label' => 'Crespin',
            'crag_id' => 1,
            'sector_id' => 1,
            'user_id' => 1,
            'climb_id' => 3,
            'height' => 28,
            'open_year' => 2001,
            'opener' => 'François Crespo',
            'note' => 3,
            'nb_note' => 2,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        // 3 - A l'aise breizh
        DB::table('routes')->insert([
            'label' => 'A l\'aise breizh',
            'crag_id' => 1,
            'sector_id' => 1,
            'user_id' => 1,
            'climb_id' => 3,
            'height' => 25,
            'open_year' => 2015,
            'opener' => '',
            'note' => 1,
            'nb_note' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        // 4 - Joly
        DB::table('routes')->insert([
            'label' => 'Joly',
            'crag_id' => 1,
            'sector_id' => 1,
            'user_id' => 1,
            'climb_id' => 3,
            'height' => 16,
            'open_year' => 2015,
            'opener' => '',
            'note' => 1,
            'nb_note' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        // 5 - L'attrape cœur
        DB::table('routes')->insert([
            'label' => 'L\'attrape cœur',
            'crag_id' => 1,
            'sector_id' => 1,
            'user_id' => 1,
            'climb_id' => 3,
            'height' => 25,
            'open_year' => 2015,
            'opener' => '',
            'note' => 1,
            'nb_note' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        // 6 - Lavandière
        DB::table('routes')->insert([
            'label' => 'Lavandière',
            'crag_id' => 1,
            'sector_id' => 1,
            'user_id' => 1,
            'climb_id' => 3,
            'height' => 25,
            'open_year' => 2015,
            'opener' => '',
            'note' => 1,
            'nb_note' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}
<?php

use Illuminate\Database\Seeder;

class GymRoutesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('gym_routes')->insert([
            'sector_id' => 1,
            'reference' => '0015190158990',
            'label' => 'Bicepsator',
            'grade' => '7a',
            'val_grade' => '37',
            'color' => 'rgb(255,0,0);rgb(0,0,0)',
            'type' => 0,
            'height' => 4,
            'opener' => 'Alex',
            'opener_date' => date('Y-m-d H:m:s'),
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('gym_routes')->insert([
            'sector_id' => 1,
            'reference' => '0015190158991',
            'label' => 'Paresse',
            'grade' => '5a',
            'val_grade' => '25',
            'color' => 'rgb(0,255,0)',
            'type' => 0,
            'height' => 4,
            'opener' => 'Ju',
            'opener_date' => date('Y-m-d H:m:s'),
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('gym_routes')->insert([
            'sector_id' => 1,
            'reference' => '0015190158991',
            'label' => 'Six Pack',
            'grade' => '7c',
            'val_grade' => '41',
            'color' => 'rgb(255,255,255)',
            'type' => 0,
            'height' => 4,
            'opener' => 'Mattieu',
            'opener_date' => date('Y-m-d H:m:s'),
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

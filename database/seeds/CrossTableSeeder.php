<?php

use Illuminate\Database\Seeder;

class CrossTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //croix sur blue par lucien
        DB::table('cross')->insert([
            'route_id' => 1,
            'user_id' => 1,
            'release_at' => date('Y-m-d H:m:s'),
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        //croix sur blue par léna
        DB::table('cross')->insert([
            'route_id' => 1,
            'user_id' => 3,
            'release_at' => date('Y-m-d H:m:s'),
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        //croix sur la lavandière (voie de 2 longueur)
        DB::table('cross')->insert([
            'route_id' => 6,
            'user_id' => 1,
            'release_at' => date('Y-m-d H:m:s'),
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

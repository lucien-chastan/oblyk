<?php

use Illuminate\Database\Seeder;

class CrossesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //croix sur blue par lucien
        DB::table('crosses')->insert([
            'route_id' => 1,
            'user_id' => 1,
            'status_id' => 1, //en projet
            'release_at' => date('Y-m-d H:m:s'),
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        //croix sur blue par léna
        DB::table('crosses')->insert([
            'route_id' => 1,
            'user_id' => 3,
            'status_id' => 5, //à vue
            'release_at' => date('Y-m-d H:m:s'),
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        //croix sur la lavandière (voie de 2 longueur)
        DB::table('crosses')->insert([
            'route_id' => 6,
            'user_id' => 1,
            'status_id' => 3, //après travail
            'release_at' => date('Y-m-d H:m:s'),
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

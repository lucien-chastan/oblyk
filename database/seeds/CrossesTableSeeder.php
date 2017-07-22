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
            'mode_id' => 2, //en moulinette
            'hardness_id' => 2, //juste bien côté
            'release_at' => date('Y-m-d H:m:s'),
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        //croix sur blue par léna
        DB::table('crosses')->insert([
            'route_id' => 1,
            'user_id' => 3,
            'status_id' => 5, //à vue
            'mode_id' => 1, //en tête
            'hardness_id' => 1, //facile bien côté
            'release_at' => date('Y-m-d H:m:s'),
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        //croix sur la lavandière (voie de 2 longueur)
        DB::table('crosses')->insert([
            'route_id' => 6,
            'user_id' => 1,
            'status_id' => 3, //après travail
            'mode_id' => 3, //en leader
            'hardness_id' => 3, //dur pour la cotation
            'release_at' => date('Y-m-d H:m:s'),
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

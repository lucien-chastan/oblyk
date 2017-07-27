<?php

use Illuminate\Database\Seeder;

class UserPlacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // user 1 : Lucien
        DB::table('user_places')->insert([
            'user_id' => 1,
            'lat' => 45.774754,
            'lng' => 4.872788,
            'rayon' => 5,
            'label' => 'Lyon, M\'Roc 2',
            'description' => 'Je grimpe ici le Mercredi de 20h à 22h',
            'active' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('user_places')->insert([
            'user_id' => 1,
            'lat' => 43.773609,
            'lng' => 6.722931,
            'rayon' => 20,
            'label' => 'Caille',
            'description' => 'Pour grimper au chapeau, ou autre endroit',
            'active' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        // user 2 : Oblyk
        DB::table('user_places')->insert([
            'user_id' => 2,
            'lat' => 45.739487,
            'lng' => 4.865331,
            'rayon' => 5,
            'label' => 'Lyon, Rue Marius Berliet',
            'description' => '',
            'active' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('user_places')->insert([
            'user_id' => 2,
            'lat' => 44.836951,
            'lng' => 5.186745,
            'rayon' => 25,
            'label' => 'Le Moulin de la Pipie',
            'description' => '',
            'active' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('user_places')->insert([
            'user_id' => 2,
            'lat' => 45.191061,
            'lng' => 5.716076,
            'rayon' => 1,
            'label' => 'Grenoble, Le Labo',
            'description' => 'Je suis un grand habitué du labo, j\'y vais 2 à 3 fois par semaine le soir',
            'active' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);


        // user 3 : Léna
        DB::table('user_places')->insert([
            'user_id' => 3,
            'lat' => 45.175085,
            'lng' => 5.728760,
            'rayon' => 10,
            'label' => 'Grenoble',
            'description' => 'Je grimpe à la salle ABK et au Labo de temps en temps',
            'active' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

    }
}

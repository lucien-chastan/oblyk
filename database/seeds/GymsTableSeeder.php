<?php

use Illuminate\Database\Seeder;

class GymsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //1 : M'roc 2
        DB::table('gyms')->insert([
            'user_id' => 1,
            'label' => 'M\'Roc 2',
            'description' => 'Anciennement M\'Roc 2, première salle modérne de Lyon',
            'type_boulder' => 1,
            'type_route' => 0,
            'free' => 1,
            'address' => '52 Rue Alexis Perroncel',
            'postal_code' => 69100,
            'code_country' => 'fr',
            'city' => 'Villeurbanne',
            'big_city' => 'Lyon',
            'country' => 'France',
            'region' => 'Rhône',
            'lat' => 45.774841,
            'lng' => 4.876160,
            'email' => 'contact@mroc2.com',
            'phone_number' => '0437478001',
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        //2 : Les enfants du roc Épinal
        DB::table('gyms')->insert([
            'user_id' => 3,
            'label' => 'Les Enfants du Roc',
            'description' => 'Salle d\'escalade du club des enfants du Roc ',
            'type_boulder' => 1,
            'type_route' => 1,
            'free' => 0,
            'address' => 'Rue Charles Perrault',
            'postal_code' => 88000,
            'code_country' => 'fr',
            'city' => 'Épinal',
            'big_city' => 'Épinal',
            'country' => 'France',
            'region' => 'Vosges',
            'lat' => 48.186268,
            'lng' => 6.457853,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

    }
}

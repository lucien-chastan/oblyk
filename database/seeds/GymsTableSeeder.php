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

        //1 : M'roc Villerbanne
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

        //3 : Climb'Up Lyon
        DB::table('gyms')->insert([
            'user_id' => 1,
            'label' => 'Climb\'Up Lyon',
            'description' => 'Meilleurs salle de voie de Lyon',
            'type_boulder' => 1,
            'type_route' => 1,
            'free' => 1,
            'address' => '11 Rue Lortet, 69007 Lyon',
            'postal_code' => 69007,
            'code_country' => 'fr',
            'city' => 'Lyon',
            'big_city' => 'Lyon',
            'country' => 'France',
            'region' => 'Rhône',
            'lat' => 45.743047,
            'lng' => 4.835540,
            'email' => 'info@email.com',
            'phone_number' => '0472718384',
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        //4 : M'roc Laennec
        DB::table('gyms')->insert([
            'user_id' => 1,
            'label' => 'M\'Roc Laennec',
            'description' => 'Meilleurs salle de bloc de Lyon',
            'type_boulder' => 1,
            'type_route' => 0,
            'free' => 1,
            'address' => '49 Rue Président Krüger',
            'postal_code' => 69008,
            'code_country' => 'fr',
            'city' => 'Lyon',
            'big_city' => 'Lyon',
            'country' => 'France',
            'region' => 'Rhône',
            'lat' => 45.737306,
            'lng' => 4.879983,
            'email' => 'contact@mroc3.com',
            'phone_number' => '0486112721',
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

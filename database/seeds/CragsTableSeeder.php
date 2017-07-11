<?php

use Illuminate\Database\Seeder;

class CragsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //1
        DB::table('crags')->insert([
            'label' => 'Rocher des Aures',
            'rock_id' => 3,
            'bandeau' => '/img/default-crag-bandeau.jpg',
            'code_country' => 'fr',
            'city' => 'Roche-St-Secret',
            'country' => 'France',
            'region' => 'Drôme',
            'user_id' => 1,
            'lat' => 44.469432,
            'lng' => 5.057882,
            'type_voie' => 1,
            'type_grande_voie' => 1,
            'type_bloc' => 0,
            'type_deep_water' => 0,
            'type_via_ferrata' => 0,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        //2
        DB::table('crags')->insert([
            'label' => 'Arzelier',
            'rock_id' => 8,
            'bandeau' => '/img/default-crag-bandeau.jpg',
            'code_country' => 'fr',
            'city' => 'Teyssière',
            'country' => 'France',
            'region' => 'Drôme',
            'user_id' => 2,
            'lat' => 44.473142,
            'lng' => 5.140590,
            'type_voie' => 1,
            'type_grande_voie' => 0,
            'type_bloc' => 0,
            'type_deep_water' => 0,
            'type_via_ferrata' => 0,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        //3
        DB::table('crags')->insert([
            'label' => 'Rocher des Abeilles',
            'rock_id' => 3,
            'bandeau' => '/img/default-crag-bandeau.jpg',
            'code_country' => 'fr',
            'city' => 'Soyan',
            'country' => 'France',
            'region' => 'Drôme',
            'user_id' => 1,
            'lat' => 44.62762,
            'lng' => 5.02232,
            'type_voie' => 1,
            'type_grande_voie' => 0,
            'type_bloc' => 0,
            'type_deep_water' => 0,
            'type_via_ferrata' => 0,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        //4
        DB::table('crags')->insert([
            'label' => 'Label',
            'rock_id' => 3,
            'bandeau' => '/img/default-crag-bandeau.jpg',
            'code_country' => 'fr',
            'city' => 'Bezaudun',
            'country' => 'France',
            'region' => 'Drôme',
            'user_id' => 1,
            'lat' => 44.60223,
            'lng' => 5.17119,
            'type_voie' => 1,
            'type_grande_voie' => 0,
            'type_bloc' => 0,
            'type_deep_water' => 0,
            'type_via_ferrata' => 0,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        //5
        DB::table('crags')->insert([
            'label' => 'Le Palloir',
            'rock_id' => 3,
            'bandeau' => '/img/default-crag-bandeau.jpg',
            'code_country' => 'fr',
            'city' => 'Bezaudun',
            'country' => 'France',
            'region' => 'Drôme',
            'user_id' => 1,
            'lat' => 44.64747,
            'lng' => 5.0762,
            'type_voie' => 1,
            'type_grande_voie' => 0,
            'type_bloc' => 0,
            'type_deep_water' => 0,
            'type_via_ferrata' => 0,
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

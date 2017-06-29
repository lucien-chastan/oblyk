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
        DB::table('crags')->insert([
            'label' => 'Rocher des Aures',
            'rock_id' => 3,
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
        ]);

        DB::table('crags')->insert([
            'label' => 'Arzelier',
            'rock_id' => 8,
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
        ]);
    }
}

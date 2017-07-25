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


        // user 3 : Léna
        DB::table('user_places')->insert([
            'user_id' => 3,
            'lat' => 43.759259,
            'lng' => 6.584270,
            'rayon' => 10,
            'label' => 'La Martre, Le Pont de Madame',
            'description' => '',
            'active' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

    }
}

<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('links')->insert([
            'linkable_id' => 1,
            'linkable_type' => 'App\Crag',
            'label' => 'Climbing away',
            'link' => 'http://climbingaway.fr/fr/site-escalade/rocher-des-aures',
            'description' => 'une petite description du lien',
            'user_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('links')->insert([
            'linkable_id' => 1,
            'linkable_type' => 'App\Crag',
            'label' => 'FFME',
            'link' => 'http://www.ffme.fr/site/falaise-fiche/238.html',
            'description' => 'Le rocher des aures sur la FFME',
            'user_id' => 2,
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

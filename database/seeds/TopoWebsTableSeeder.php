<?php

use Illuminate\Database\Seeder;

class TopoWebsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //1
        DB::table('topo_webs')->insert([
            'user_id' => 1,
            'crag_id' => 1,
            'label' => 'Topo internet du rocher des aures',
            'url' => 'http://www.oblyk.net/outdoor/accueil.php?id=18',
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        //2
        DB::table('topo_webs')->insert([
            'user_id' => 1,
            'crag_id' => 2,
            'label' => 'Topo de l\'arzelier',
            'url' => 'https://www.camptocamp.org/waypoints/302989/fr/teyssieres-l-alancon-et-l-arzelier',
            'created_at' => date('Y-m-d H:m:s'),
        ]);

    }
}

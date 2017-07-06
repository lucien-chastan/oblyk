<?php

use Illuminate\Database\Seeder;

class TopoSalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('topo_sales')->insert([
            'topo_id' => 1,
            'user_id' => 1,
            'label' => 'Vieux campeur',
            'description' => 'Demander à l\'accueil',
            'url' => 'https://www.auvieuxcampeur.fr/',
            'lat' => 45.756917,
            'lng' => 4.842791,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('topo_sales')->insert([
            'topo_id' => 1,
            'user_id' => 2,
            'label' => 'Alti-Grimpe',
            'description' => 'Salle d\'escalade de François Crespo',
            'url' => 'http://www.altigrimp.com/',
            'lat' => 44.426054,
            'lng' => 4.983662,
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

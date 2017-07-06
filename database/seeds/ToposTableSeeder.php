<?php

use Illuminate\Database\Seeder;

class ToposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //1
        DB::table('topos')->insert([
            'user_id' => 1,
            'label' => 'Topo de la drôme provençale',
            'author' => 'Berlingo',
            'editor' => 'FFME 26',
            'editionYear' => 2014,
            'price' => 25,
            'page' => 250,
            'weight' => 150,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        //2
        DB::table('topos')->insert([
            'user_id' => 2,
            'label' => '7 + 8',
            'author' => 'Van',
            'editor' => 'Fontainebook',
            'editionYear' => 2010,
            'price' => 20,
            'page' => 99,
            'weight' => 85,
            'created_at' => date('Y-m-d H:m:s'),
        ]);


        //3
        DB::table('topos')->insert([
            'user_id' => 1,
            'label' => 'Saou et ses environs',
            'author' => 'CAF',
            'editor' => 'FFME',
            'editionYear' => 2012,
            'price' => 25,
            'page' => 120,
            'weight' => 100,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        //4
        DB::table('topos')->insert([
            'user_id' => 1,
            'label' => 'St Ferréol, Esson',
            'author' => 'Club',
            'editor' => '',
            'editionYear' => 2008,
            'price' => 12,
            'page' => 50,
            'weight' => 40,
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

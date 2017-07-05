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
        DB::table('topos')->insert([
            'user_id' => 1,
            'label' => 'Topo de la drôme provençale',
            'author' => 'Berlingo',
            'editor' => 'FFME 26',
            'editionYear' => 2014,
            'price' => 25,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('topos')->insert([
            'user_id' => 2,
            'label' => '7 + 8',
            'author' => 'Van',
            'editor' => 'Fontainebook',
            'editionYear' => 2010,
            'price' => 20,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

    }
}

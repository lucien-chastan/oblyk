<?php

use Illuminate\Database\Seeder;

class TopoPdfsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //1
        DB::table('topo_pdfs')->insert([
            'user_id' => 1,
            'crag_id' => 1,
            'label' => 'Topo de la moulure',
            'description' => 'Topo de la moulure, édité par blocnote',
            'author' => 'blocnote',
            'slug_label' => 'topo-de-la-moulure-1.pdf',
            'created_at' => date('Y-m-d H:m:s'),
        ]);

    }
}

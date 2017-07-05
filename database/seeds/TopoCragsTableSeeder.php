<?php

use Illuminate\Database\Seeder;

class TopoCragsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('topo_crags')->insert([
            'user_id' => 1,
            'crag_id' => 1,
            'topo_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

    }
}

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

        //1
        DB::table('topo_crags')->insert([
            'user_id' => 1,
            'crag_id' => 1,
            'topo_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);


        //2
        DB::table('topo_crags')->insert([
            'user_id' => 1,
            'crag_id' => 3,
            'topo_id' => 3,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        //3
        DB::table('topo_crags')->insert([
            'user_id' => 1,
            'crag_id' => 4,
            'topo_id' => 3,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        //4
        DB::table('topo_crags')->insert([
            'user_id' => 1,
            'crag_id' => 5,
            'topo_id' => 4,
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

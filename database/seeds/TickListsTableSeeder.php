<?php

use Illuminate\Database\Seeder;

class TickListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Alaise blaise
        DB::table('tick_lists')->insert([
            'user_id' => 1,
            'route_id' => 3,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        //Crespin
        DB::table('tick_lists')->insert([
            'user_id' => 1,
            'route_id' => 2,
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

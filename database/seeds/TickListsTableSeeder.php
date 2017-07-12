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
        DB::table('tick_lists')->insert([
            'user_id' => 1,
            'route_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('tick_lists')->insert([
            'user_id' => 1,
            'route_id' => 2,
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

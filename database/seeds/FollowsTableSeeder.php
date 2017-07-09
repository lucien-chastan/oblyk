<?php

use Illuminate\Database\Seeder;

class FollowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('follows')->insert([
            'followed_id' => 1,
            'followed_type' => 'App\Crag',
            'user_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('follows')->insert([
            'followed_id' => 1,
            'followed_type' => 'App\Topo',
            'user_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

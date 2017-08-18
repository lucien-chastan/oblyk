<?php

use Illuminate\Database\Seeder;

class RouteTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // 1 - Blue - Tag 1
        DB::table('route_tags')->insert([
            'route_id' => 1,
            'user_id' => 1,
            'tag_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        // 1 - Blue - Tag 5
        DB::table('route_tags')->insert([
            'route_id' => 1,
            'user_id' => 1,
            'tag_id' => 5,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        // 2 - Crespin
        DB::table('route_tags')->insert([
            'route_id' => 2,
            'user_id' => 2,
            'tag_id' => 3,
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}
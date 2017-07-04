<?php

use Illuminate\Database\Seeder;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('videos')->insert([
            'viewable_id' => 1,
            'viewable_type' => 'App\Crag',
            'user_id' => 1,
            'iframe' => 'https://www.youtube.com/embed/wuwTbBCrQus',
            'description' => 'vidéo youtube',
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('videos')->insert([
            'viewable_id' => 1,
            'viewable_type' => 'App\Crag',
            'user_id' => 1,
            'iframe' => 'https://player.vimeo.com/video/100836349',
            'description' => 'vidéo vimeo',
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('videos')->insert([
            'viewable_id' => 1,
            'viewable_type' => 'App\Crag',
            'user_id' => 1,
            'iframe' => '//www.dailymotion.com/embed/video/x634bp',
            'description' => 'vidéo dailymotion',
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class SocialNetworksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('social_networks')->insert(['label' => 'site web']); // 1
        DB::table('social_networks')->insert(['label' => 'facebook']); // 2
        DB::table('social_networks')->insert(['label' => 'tiwitter']); // 3
        DB::table('social_networks')->insert(['label' => 'google +']); // 4
        DB::table('social_networks')->insert(['label' => 'instagramme']); // 5
        DB::table('social_networks')->insert(['label' => 'pinterest']); // 6
        DB::table('social_networks')->insert(['label' => 'youtube']); // 7
        DB::table('social_networks')->insert(['label' => 'vimeo']); // 8
        DB::table('social_networks')->insert(['label' => 'dailymotion']); // 9
        DB::table('social_networks')->insert(['label' => 'diaspora']); // 10
        DB::table('social_networks')->insert(['label' => 'tumblr']); // 11
        DB::table('social_networks')->insert(['label' => 'camptocamp']); // 12
        DB::table('social_networks')->insert(['label' => 'ilooove.it']); // 13
        DB::table('social_networks')->insert(['label' => 'behance']); // 14
        DB::table('social_networks')->insert(['label' => 'flickr']); // 15
        DB::table('social_networks')->insert(['label' => 'verticall']); //16
    }
}

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
        DB::table('social_networks')->insert(['label' => 'site web']);
        DB::table('social_networks')->insert(['label' => 'facebook']);
        DB::table('social_networks')->insert(['label' => 'tiwitter']);
        DB::table('social_networks')->insert(['label' => 'google +']);
        DB::table('social_networks')->insert(['label' => 'instagramme']);
        DB::table('social_networks')->insert(['label' => 'pinterest']);
        DB::table('social_networks')->insert(['label' => 'youtube']);
        DB::table('social_networks')->insert(['label' => 'vimeo']);
        DB::table('social_networks')->insert(['label' => 'dailymotion']);
        DB::table('social_networks')->insert(['label' => 'diaspora']);
        DB::table('social_networks')->insert(['label' => 'tumblr']);
        DB::table('social_networks')->insert(['label' => 'camptocamp']);
        DB::table('social_networks')->insert(['label' => 'ilooove.it']);
        DB::table('social_networks')->insert(['label' => 'behance']);
        DB::table('social_networks')->insert(['label' => 'flickr']);
        DB::table('social_networks')->insert(['label' => 'verticall']);
    }
}

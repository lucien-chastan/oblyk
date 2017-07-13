<?php

use Illuminate\Database\Seeder;

class UserSocialNetworksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_social_networks')->insert([
            'user_id' => 1,
            'social_network_id' => 1,
            'label'=>'Portfolio',
            'url'=>'http://www.lucien-chastan.fr/',
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('user_social_networks')->insert([
            'user_id' => 1,
            'social_network_id' => 2,
            'url'=>'https://www.facebook.com/cht.lucien',
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

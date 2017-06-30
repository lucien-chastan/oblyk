<?php

use Illuminate\Database\Seeder;

class PhotosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('photos')->insert([
            'illustrable_id' => 1,
            'illustrable_type' => 'App\Crag',
            'slug_label' => 'rocher-des-aures-1.jpg',
            'user_id' => 1,
            'album_id' => 1,
            'description' => 'photo du secteur du haut',
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

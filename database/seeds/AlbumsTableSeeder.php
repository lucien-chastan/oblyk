<?php

use Illuminate\Database\Seeder;

class AlbumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('albums')->insert([
            'label' => 'Album 1',
            'description' => 'Première album',
            'user_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

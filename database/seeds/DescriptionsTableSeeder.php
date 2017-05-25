<?php

use Illuminate\Database\Seeder;

class DescriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('descriptions')->insert([
            'descriptive_id' => 1,
            'descriptive_type' => 'App\Crag',
            'description' => 'salut c\'est une nouvelle description',
            'user_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('descriptions')->insert([
            'descriptive_id' => 1,
            'descriptive_type' => 'App\Sector',
            'description' => 'Super secteur, peut être le meilleur du site',
            'user_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

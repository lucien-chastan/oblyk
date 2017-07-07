<?php

use Illuminate\Database\Seeder;

class MassivesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        DB::table('massives')->insert([
            'label' => 'Les Barronies',
            'user_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        //2
        DB::table('massives')->insert([
            'label' => 'La fôret de Saou',
            'user_id' => 2,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

    }
}

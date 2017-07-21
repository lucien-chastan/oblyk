<?php

use Illuminate\Database\Seeder;

class CrossUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //La croix sur blue de lucien faite avec léna
        DB::table('cross_users')->insert([
            'cross_id' => 1,
            'user_id' => 3, //en projet
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        //Croix sur la lavandière faite avec léna et oblyk
        DB::table('cross_users')->insert([
            'cross_id' => 3,
            'user_id' => 2, //oblyk
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('cross_users')->insert([
            'cross_id' => 3,
            'user_id' => 3, //léna
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

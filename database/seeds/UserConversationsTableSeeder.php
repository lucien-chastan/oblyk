<?php

use Illuminate\Database\Seeder;

class UserConversationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Lucien(1) + léna(3)
        DB::table('user_conversations')->insert([
            'user_id' => 1,
            'conversation_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('user_conversations')->insert([
            'user_id' => 3,
            'conversation_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);



        // Lucien(1) + Oblyk(2)
        DB::table('user_conversations')->insert([
            'user_id' => 1,
            'conversation_id' => 2,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('user_conversations')->insert([
            'user_id' => 2,
            'conversation_id' => 2,
            'created_at' => date('Y-m-d H:m:s'),
        ]);



        //Lucien(1) + Oblyk(2) + Léna(3)
        DB::table('user_conversations')->insert([
            'user_id' => 1,
            'conversation_id' => 3,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('user_conversations')->insert([
            'user_id' => 2,
            'conversation_id' => 3,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('user_conversations')->insert([
            'user_id' => 3,
            'conversation_id' => 3,
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

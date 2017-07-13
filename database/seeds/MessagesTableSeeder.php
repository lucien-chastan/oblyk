<?php

use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Lucien(1) + léna(3)
        DB::table('messages')->insert([
            'user_id' => 1,
            'conversation_id' => 1,
            'message' => 'Salut, comment va tu ?',
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('messages')->insert([
            'user_id' => 3,
            'conversation_id' => 1,
            'message' => 'Bien, est toi ?',
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('messages')->insert([
            'user_id' => 1,
            'conversation_id' => 1,
            'message' => 'Je bosse à fond sur la nouvelle version d\'oblyk, c\'est long, mais ça va être bien !',
            'created_at' => date('Y-m-d H:m:s'),
        ]);



        // Lucien(1) + Oblyk(2)
        DB::table('messages')->insert([
            'user_id' => 2,
            'conversation_id' => 2,
            'message' => 'Bienvenue sur Oblyk, n\'hésite pas à me poser des questions si tu as des problèmes',
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('messages')->insert([
            'user_id' => 1,
            'conversation_id' => 2,
            'message' => 'Si je pose des questions c\'est moi qui vais y répondre ...',
            'created_at' => date('Y-m-d H:m:s'),
        ]);



        //Lucien(1) + Oblyk(2) + Léna(3)
        DB::table('messages')->insert([
            'user_id' => 1,
            'conversation_id' => 3,
            'message' => 'Test de conversation à 3',
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('messages')->insert([
            'user_id' => 2,
            'conversation_id' => 3,
            'message' => 'Robot Oblyk est présent',
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('messages')->insert([
            'user_id' => 3,
            'conversation_id' => 3,
            'message' => 'Ça marche pour moi aussi !',
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('messages')->insert([
            'user_id' => 1,
            'conversation_id' => 3,
            'message' => 'Bon bah ça c\'est cool',
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

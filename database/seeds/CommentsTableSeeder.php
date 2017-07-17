<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'commentable_id' => 6,
            'commentable_type' => 'App\Post',
            'comment' => 'Super, j\'ai très hate de cette nouvelle version !',
            'user_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('comments')->insert([
            'commentable_id' => 6,
            'commentable_type' => 'App\Post',
            'comment' => 'Moi aussi ! Bonne chance ; )',
            'user_id' => 3,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('comments')->insert([
            'commentable_id' => 1,
            'commentable_type' => 'App\Post',
            'comment' => 'Merci, je me suis déjà perdu sur cette marche d\'approche',
            'user_id' => 3,
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

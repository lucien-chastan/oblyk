<?php

use Illuminate\Database\Seeder;

class ForumTopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('forum_topics')->insert([
            'user_id' => 1,
            'category_id' => 3,
            'label' => 'Oblyk le nouveau forum',
            'created_at' => date('Y-m-d H:m:s'),
            'last_post' => date('Y-m-d H:m:s'),
        ]);

        DB::table('forum_topics')->insert([
            'user_id' => 3,
            'category_id' => 16,
            'label' => 'Projet de salle d\'escalade à la Martre (Var 83)',
            'nb_post' => 0,
            'created_at' => date('Y-m-d H:m:s'),
            'last_post' => date('Y-m-d H:m:s'),
        ]);
    }
}

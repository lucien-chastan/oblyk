<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'postable_id' => 1,
            'postable_type' => 'App\Crag',
            'content' => 'Premier flux sur le Rocher des Aures',
            'user_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('posts')->insert([
            'postable_id' => 1,
            'postable_type' => 'App\Topo',
            'content' => 'Il y a une erreur à la page 52, il faut prendre le à droit après la boîte aux lettres (et non pas à gauche)',
            'user_id' => 2,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('posts')->insert([
            'postable_id' => 1,
            'postable_type' => 'App\Massive',
            'content' => 'Nouvelle asso qui gère les Barronies : [Grimponies](www.grimponies.fr), venez et participez à l\'activité de l\'association',
            'user_id' => 3,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('posts')->insert([
            'postable_id' => 1,
            'postable_type' => 'App\User',
            'content' => 'Un post sur le mur de Lucien par Léna',
            'user_id' => 3,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('posts')->insert([
            'postable_id' => 1,
            'postable_type' => 'App\User',
            'content' => 'Un post sur mon mur',
            'user_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

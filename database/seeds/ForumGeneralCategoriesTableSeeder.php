<?php

use Illuminate\Database\Seeder;

class ForumGeneralCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        DB::table('forum_general_categories')->insert(['label' => 'Communauté']);

        //2
        DB::table('forum_general_categories')->insert(['label' => 'Oblyk']);

        //3
        DB::table('forum_general_categories')->insert(['label' => 'Matos']);

        //4
        DB::table('forum_general_categories')->insert(['label' => 'Escalade']);

        //5
        DB::table('forum_general_categories')->insert(['label' => 'Entraînement']);

        //6
        DB::table('forum_general_categories')->insert(['label' => 'Actus - Évènements']);

        //7
        DB::table('forum_general_categories')->insert(['label' => 'Topos']);
    }
}

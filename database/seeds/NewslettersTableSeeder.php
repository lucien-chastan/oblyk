<?php

use Illuminate\Database\Seeder;

class NewslettersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('newsletters')->insert([
            'ref' => '18-05',
            'title' => 'Première news-letter oblyk',
            'abstract' => 'Voici la première news-letter d\'oblyk',
            'content' => 'Après plusireurs années d\'existance oblyk met enfin en place une news letter, effectivement un site basé sur l\'activité de sa communauté doit tenir au courant sa communauté',
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

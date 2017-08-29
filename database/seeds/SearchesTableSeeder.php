<?php

use Illuminate\Database\Seeder;

class SearchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //SEARCHE SUR LES FALAISE

        DB::table('searches')->insert([
            'searchable_id' => 1,
            'searchable_type' => 'App\Crag',
            'label' => 'rocher-des-aures',
            'created_at'=> date('Y-m-d H:m:s'),
        ]);

        DB::table('searches')->insert([
            'searchable_id' => 2,
            'searchable_type' => 'App\Crag',
            'label' => 'arzelier',
            'created_at'=> date('Y-m-d H:m:s'),
        ]);

        DB::table('searches')->insert([
            'searchable_id' => 3,
            'searchable_type' => 'App\Crag',
            'label' => 'rocher-des-abeilles',
            'created_at'=> date('Y-m-d H:m:s'),
        ]);

        DB::table('searches')->insert([
            'searchable_id' => 4,
            'searchable_type' => 'App\Crag',
            'label' => 'label',
            'created_at'=> date('Y-m-d H:m:s'),
        ]);

        DB::table('searches')->insert([
            'searchable_id' => 5,
            'searchable_type' => 'App\Crag',
            'label' => 'le-palloir',
            'created_at'=> date('Y-m-d H:m:s'),
        ]);

        //SEARCHE SUR LES USERS

        DB::table('searches')->insert([
            'searchable_id' => 1,
            'searchable_type' => 'App\User',
            'label' => 'lucien',
            'created_at'=> date('Y-m-d H:m:s'),
        ]);

        DB::table('searches')->insert([
            'searchable_id' => 2,
            'searchable_type' => 'App\User',
            'label' => 'oblyk',
            'created_at'=> date('Y-m-d H:m:s'),
        ]);

        DB::table('searches')->insert([
            'searchable_id' => 3,
            'searchable_type' => 'App\User',
            'label' => 'lena',
            'created_at'=> date('Y-m-d H:m:s'),
        ]);

        //SEARCHE SUR LE LEXIQUE

        DB::table('searches')->insert([
            'searchable_id' => 1,
            'searchable_type' => 'App\Word',
            'label' => 'a-doigts',
            'created_at'=> date('Y-m-d H:m:s'),
        ]);

        DB::table('searches')->insert([
            'searchable_id' => 2,
            'searchable_type' => 'App\Word',
            'label' => 'a-la-rue-être',
            'created_at'=> date('Y-m-d H:m:s'),
        ]);

        DB::table('searches')->insert([
            'searchable_id' => 3,
            'searchable_type' => 'App\Word',
            'label' => 'Baffer',
            'created_at'=> date('Y-m-d H:m:s'),
        ]);

        //SEARCHE SUR LES TOPOS

        DB::table('searches')->insert([
            'searchable_id' => 1,
            'searchable_type' => 'App\Topo',
            'label' => 'topo-de-la-drome-provencale',
            'created_at'=> date('Y-m-d H:m:s'),
        ]);

        DB::table('searches')->insert([
            'searchable_id' => 2,
            'searchable_type' => 'App\Topo',
            'label' => '7-8',
            'created_at'=> date('Y-m-d H:m:s'),
        ]);

        DB::table('searches')->insert([
            'searchable_id' => 3,
            'searchable_type' => 'App\Topo',
            'label' => 'saou-et-ses-environs',
            'created_at'=> date('Y-m-d H:m:s'),
        ]);

        DB::table('searches')->insert([
            'searchable_id' => 4,
            'searchable_type' => 'App\Topo',
            'label' => 'st-ferreol-esson',
            'created_at'=> date('Y-m-d H:m:s'),
        ]);

        //SEARCHE SUR LES TOPOS WEB

        DB::table('searches')->insert([
            'searchable_id' => 1,
            'searchable_type' => 'App\TopoWeb',
            'label' => 'topo-internet-du-rocher-des-aures',
            'created_at'=> date('Y-m-d H:m:s'),
        ]);

        DB::table('searches')->insert([
            'searchable_id' => 2,
            'searchable_type' => 'App\TopoWeb',
            'label' => 'topo-de-l-arzelier',
            'created_at'=> date('Y-m-d H:m:s'),
        ]);

        //SEARCHE SUR LES TOPOS PDF
        DB::table('searches')->insert([
            'searchable_id' => 1,
            'searchable_type' => 'App\TopoPdf',
            'label' => 'topo-de-la-moulure',
            'created_at'=> date('Y-m-d H:m:s'),
        ]);

        //SEARCHE LES MASSIFS
        DB::table('searches')->insert([
            'searchable_id' => 1,
            'searchable_type' => 'App\Massive',
            'label' => 'les-barronies',
            'created_at'=> date('Y-m-d H:m:s'),
        ]);

        DB::table('searches')->insert([
            'searchable_id' => 2,
            'searchable_type' => 'App\Massive',
            'label' => 'la-foret-de-saou',
            'created_at'=> date('Y-m-d H:m:s'),
        ]);

        //SEARCHE LES SALLES
        DB::table('searches')->insert([
            'searchable_id' => 1,
            'searchable_type' => 'App\Gym',
            'label' => 'm-roc-2',
            'created_at'=> date('Y-m-d H:m:s'),
        ]);

        DB::table('searches')->insert([
            'searchable_id' => 2,
            'searchable_type' => 'App\Gym',
            'label' => 'les-enfants-du-Roc',
            'created_at'=> date('Y-m-d H:m:s'),
        ]);

        //SEARCHE SUR LE FORUM
        DB::table('searches')->insert([
            'searchable_id' => 1,
            'searchable_type' => 'App\ForumTopic',
            'label' => 'oblyk-le-nouveau-forum',
            'created_at'=> date('Y-m-d H:m:s'),
        ]);

    }
}

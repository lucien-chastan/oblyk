<?php

use Illuminate\Database\Seeder;

class DescriptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('descriptions')->insert([
            'descriptive_id' => 1,
            'descriptive_type' => 'App\Crag',
            'description' => 'salut c\'est une nouvelle description',
            'user_id' => 1,
            'note' => 0,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('descriptions')->insert([
            'descriptive_id' => 1,
            'descriptive_type' => 'App\Sector',
            'description' => 'Super secteur, peut être le meilleur du site',
            'user_id' => 1,
            'note' => 0,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('descriptions')->insert([
            'descriptive_id' => 6,
            'descriptive_type' => 'App\Route',
            'description' => 'Très belle grande voie, il y a du gaz',
            'user_id' => 1,
            'note' => 6,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('descriptions')->insert([
            'descriptive_id' => 6,
            'descriptive_type' => 'App\Route',
            'description' => 'Attention, des pierres se délite dans la deuxième longueur',
            'user_id' => 2,
            'note' => 0,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('descriptions')->insert([
            'descriptive_id' => 1,
            'descriptive_type' => 'App\Route',
            'description' => 'Petite ligne sympathique, si vous passez dans le coin ça fait partie des voie à faire',
            'user_id' => 2,
            'note' => 2,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('descriptions')->insert([
            'descriptive_id' => 1,
            'descriptive_type' => 'App\Topo',
            'description' => 'Topo très fourni, qui regroupe 13 sites d\'escalade (voie et grande voie), en Drôme provençale. On y trouve de nombreuses informations comme le type d\'équipement, des commentaires sur les voies, etc. Merci au CD26 pour cette mine d\'or',
            'user_id' => 1,
            'note' => 0,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('descriptions')->insert([
            'descriptive_id' => 1,
            'descriptive_type' => 'App\Article',
            'description' => 'Je ne suis pas d\'accord !!',
            'user_id' => 1,
            'note' => 0,
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

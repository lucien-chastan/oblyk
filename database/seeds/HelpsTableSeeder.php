<?php

use Illuminate\Database\Seeder;

class HelpsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('helps')->insert([
            'category' => 'Carnet de croix',
            'label' => 'Ajouter une croix à mon carnet',
            'contents' => '
            Pour ajouter une croix à mon carnet
            
            - Allez sur la voie en question
            - En dessous des informations de la ligne, cliquez sur "ajouter à mon carnet"
            - Remplissez la popup et validez
            
            La voie a été ajoutée à votre carnet
            ',
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('helps')->insert([
            'category' => 'Carnet de croix',
            'label' => 'Supprimer une croix à mon carnet',
            'contents' => '
            Pour supprimer une croix à mon carnet
            
            - Allez sur la voie en question
            - En dessous des informations de la ligne, cliquez sur "supprimer de mon carnet"
            - validez
            
            La voie a été supprimé à votre carnet
            ',
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('helps')->insert([
            'category' => 'Les sites',
            'label' => 'Ajotuer un site',
            'contents' => '
            Pour ajouter un site sur oblyk
            
            - Allez sur la grande carte
            
            Le site à été ajouté
            ',
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

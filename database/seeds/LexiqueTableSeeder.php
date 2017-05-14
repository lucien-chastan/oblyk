<?php

use Illuminate\Database\Seeder;

class LexiqueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lexique')->insert([
            'label' => 'À doigts',
            'definition' => 'Une escalade ou un passage qui nécessite de la force dans les doigts.',
            'user_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('lexique')->insert([
            'label' => 'À la rue (être)',
            'definition' => 'Dépassé par le niveau de la voie ou n\'ayant pas trouvé les bonnes méthodes, le grimpeur à la rue ou à l\'envers est un candidat potentiel au plomb. ',
            'user_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('lexique')->insert([
            'label' => 'Baffer',
            'definition' => 'Jeter la main sur une prise située très haut. On emploiera également claquer : " Tu vas mettre une claquette sur la boule, ça te permet de relancer jusqu\'à la réglette main gauche ..."',
            'user_id' => 2,
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Lucien',
            'email' => 'chastanlucien@gmail.com',
            'password' => bcrypt('Lucien'),
            'localisation' => 'Drôme, Vosges, Alpes Maritime',
            'birth' => 1990,
            'sex' => 2,
            'admin_level' => 1,
            'description' => 'Bonjour, je suis Lucien !',
            'last_fil_read' => date('Y-m-d H:m:s'),
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('users')->insert([
            'name' => 'Oblyk',
            'email' => 'ekip@oblyk.net',
            'password' => bcrypt('EkipOblyk'),
            'last_fil_read' => date('Y-m-d H:m:s'),
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('users')->insert([
            'name' => 'Martine',
            'email' => 'martine@mail.com',
            'password' => bcrypt('mdpMartine'),
            'birth' => 1842,
            'sex' => 1,
            'last_fil_read' => date('Y-m-d H:m:s'),
            'created_at' => date('Y-m-d H:m:s'),
        ]);
    }
}

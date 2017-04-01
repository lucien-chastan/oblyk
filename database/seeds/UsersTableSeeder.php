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
        ]);

        DB::table('users')->insert([
            'name' => 'Oblyk',
            'email' => 'ekip@oblyk.net',
            'password' => bcrypt('EkipOblyk'),
        ]);

        DB::table('users')->insert([
            'name' => 'Léna',
            'email' => 'lena@gmail.com',
            'password' => bcrypt('mdpLéna'),
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RocksSeeder::class);
        $this->call(OrientationsSeeder::class);
        $this->call(SeasonsSeeder::class);
        $this->call(UsersTableSeeder::class);
         $this->call(CragsTableSeeder::class);
    }
}

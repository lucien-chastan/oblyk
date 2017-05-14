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
        $this->call(RocksTableSeeder::class);
        $this->call(OrientationsTableSeeder::class);
        $this->call(SeasonsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CragsTableSeeder::class);
        $this->call(DescriptionsTableSeeder::class);
        $this->call(LinksTableSeeder::class);
        $this->call(ParkingsTableSeeder::class);
    }
}

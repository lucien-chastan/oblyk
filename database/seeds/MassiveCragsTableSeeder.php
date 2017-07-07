<?php

use Illuminate\Database\Seeder;

class MassiveCragsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('massive_crags')->insert([
            'user_id' => 1,
            'crag_id' => 1,
            'massive_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('massive_crags')->insert([
            'user_id' => 1,
            'crag_id' => 2,
            'massive_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('massive_crags')->insert([
            'user_id' => 1,
            'crag_id' => 3,
            'massive_id' => 2,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

        DB::table('massive_crags')->insert([
            'user_id' => 1,
            'crag_id' => 4,
            'massive_id' => 2,
            'created_at' => date('Y-m-d H:m:s'),
        ]);

    }
}

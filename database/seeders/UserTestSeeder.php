<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_formations')->insert([
            'user_id' => 1,
            'test_id' => 1,
            'tauxDevalidation' => 100,
            'status' => 'valider'
        ]);
    }
}

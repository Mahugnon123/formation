<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserFormationSeeder extends Seeder
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
                'formations' => '1,2,3,4',
                'statut' => 'En entente ,commencer,terminer,en cours',
            ]);

        
    }
}

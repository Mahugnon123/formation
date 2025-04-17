<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaiementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<4; $i++){
            DB::table('resumes')->insert([
                'nom' => 'Resume 1',
                'formation_id' => $i,
                'user_id' => 1,
                
            ]);
        }
    }
}

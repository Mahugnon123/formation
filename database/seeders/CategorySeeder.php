<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $noms = ["L'informatique",'Éducation et enseignement','Computer Science',"Programmation", "Science des données"];
       
        foreach($noms as $nom)
        {
            DB::table('categories')->insert([
                'nom' => $nom,
                'slug'=> strtolower(str_replace(' ', '-', $nom)),
                'user_slug'=> '123456789',
            ]);
        }
    }
    
}

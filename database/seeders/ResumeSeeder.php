<?php

namespace Database\Seeders;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResumeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = "{
            'chpt':{
                1:{
                    'chapitre_id': 1,
                    'nom: 'chapitre 1',
                    'commentaire': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut ',
                    'image': 'note.jpeg'
                },
                2:{
                    'chapitre_id': 2,
                    'nom: 'chapitre 2',
                    'commentaire': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut ',
                    'image': 'note.jpeg'
                },
                3:{
                    'chapitre_id': 3,
                    'nom: 'chapitre 3',
                    'commentaire': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut ',
                    'image': 'note.jpeg'
                },
            }
        }";

        for($i=1; $i<4; $i++){
            DB::table('resumes')->insert([
                'titre' => 'Resume 1',
                'resumeChapitre' => [
                    1 => [
                        'chapitre_id' => 1,
                        'nom'=>'chapitre 1',
                        'commentaire'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut ',
                        'image' =>'note.jpeg',
                    ],
                    2 => [
                        'chapitre_id' => 2,
                        'nom'=>'chapitre 2',
                        'commentaire'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut ',
                        'image' =>'note.jpeg',
                    ],
                    3 => [
                        'chapitre_id' => 3,
                        'nom'=>'chapitre 3',
                        'commentaire'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut ',
                        'image' =>'note.jpeg',
                    ],
                ] ,
                "formation_id" => $i,
                "user_id" => 1,
            ]);
        }
        
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<4; $i++){
            DB::table('questions')->insert([
                'titre' => 'Question 1 QCM',
                'questionReponse' => [
                    1 => [
                        'question' => 1,
                        'reponses'=>['reponse 1','reponse 2','reponse 3','reponse 4'],
                        'reponseValide' =>1,
                        'commentaire'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut ',
                        'image' =>'note.jpeg',
                    ],
                    2 => [
                        'question' => 2,
                        'reponses'=>['reponse 1','reponse 2','reponse 3','reponse 4'],
                        'reponseValide' =>2,
                        'commentaire'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut ',
                        'image' =>'note.jpeg',
                    ],
                    3 => [
                        'question' => 3,
                        'reponses'=>['reponse 1','reponse 2','reponse 3','reponse 4'],
                        'reponseValide' =>3,
                        'commentaire'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut ',
                    ],
                ] ,
                "description" => 'Lorem ipsum dolor sit amet, consectetur adipiscing',
                "user_id" => 2,
            ]);
        }
    }
}

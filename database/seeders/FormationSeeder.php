<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormationSeeder extends Seeder
{
    static $types = [
        'video',
        'Texte',
        'video',
        'Texte',
        'video',
        'Texte',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i=0;

        foreach (self::$types as $type) {

            DB::table('formations')->insert([
                'type' => $type,
                'payante_ou_non' => 'oui',                
                'prix_formation' => '20$',
                'prix_certification' => '70$',
                'editordata' => 'lorem ipsum',
                'chapitre' => [
                    1 => [
                        'nom'=>'chapitre 1',
                        'description'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui',
                        'video_url'=> 'youtub.com',
                        'tauxDeValidation'=> 50,
                        'duree' => '1h30',
                        'statuts' => 1,
                    ],
                    2 => [
                        'nom'=>'chapitre 2',
                        'description'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui',
                        'video_url'=> 'youtub.com',
                        'tauxDeValidation'=> 50,
                        'duree' => '1h30',
                        'statuts' => 1,
                    ],
                    3 => [
                        'nom'=>'chapitre 3',
                        'description'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui',
                        'video_url'=> 'youtub.com',
                        'tauxDeValidation'=> 50,
                        'duree' => '1h30',
                        'statuts' => 1,
                    ],
                ],
                'ressource_id' => 1,
                'slug' => 'lorem-ipsum',
                'titre' => 'Formation '.$i,
                'description' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
            ]);
            $i++;
        }
    }
}

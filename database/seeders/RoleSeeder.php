<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role; // Importez le modèle Role

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'id' => 1,
            'nom' => 'Utilisateur',
            'slug' => 'utilisateur',
            'description' => 'Rôle par défaut pour les utilisateurs enregistrés',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Role::create([
            'id' => 2,
            'nom' => 'Formateur',
            'slug' => 'formateur',
            'description' => 'Rôle pour les formateurs',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Role::create([
            'id' => 3,
            'nom' => 'Administrateur',
            'slug' => 'administrateur',
            'description' => 'Rôle pour les administrateurs',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Vous pouvez ajouter d'autres rôles ici si nécessaire
    }
}
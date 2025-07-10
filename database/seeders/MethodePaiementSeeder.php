<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MethodePaiement;
use App\Models\Paiement;

class MethodePaiementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Créer l'entrée de paiement de base
        $paiement = Paiement::create([
            'description' => 'Paiements des formations',
            'montant' => 0,
            'statut' => 'en_attente',
            'date_paiement' => now()
        ]);

        // Ajouter les méthodes de paiement
        MethodePaiement::create([
            'nom' => 'Fedapay',
            'type' => 'fedapay',
            'public_key' => env('FEDAPAY_PUBLIC_KEY'),
            'secret_key' => env('FEDAPAY_SECRET_KEY'),
            'is_active' => true,
            'paiement_id' => $paiement->id
        ]);

        MethodePaiement::create([
            'nom' => 'Kkiapay',
            'type' => 'kkiapay',
            'public_key' => env('KKIAPAY_PUBLIC_KEY'),
            'secret_key' => env('KKIAPAY_SECRET_KEY'),
            'is_active' => true,
            'paiement_id' => $paiement->id
        ]);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avis;  // Assurez-vous d'importer le modèle Avis
use Illuminate\Support\Facades\Auth;

class AvisController extends Controller
{
    /**
     * Afficher une liste des avis (facultatif).
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Récupérer tous les avis de la base de données, si nécessaire
        $avis = Avis::all();
        return view('avis.index', compact('avis'));  // Passer les avis à la vue
    }

    /**
     * Stocker un avis dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'message' => 'required|string|max:1000',  // Assurez-vous que le message est valide
        ]);

        // Créer un nouvel avis et l'enregistrer dans la base de données
        Avis::create([
            'message' => $request->input('message'),
            'user_id' => Auth::id(),  // L'ID de l'utilisateur connecté
        ]);

        // Retourner une réponse JSON pour confirmer que l'avis a été soumis
        return response()->json(['resultat' => 'ok']);
    }

    /**
     * Afficher un avis spécifique (facultatif).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $avis = Avis::findOrFail($id);  // Récupérer l'avis par son ID
        return view('avis.show', compact('avis'));  // Afficher la vue avec l'avis
    }

    // Autres méthodes comme `edit`, `update`, `destroy` peuvent être ajoutées si nécessaire.
}

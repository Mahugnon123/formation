<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\Requete;
use App\Models\UserFormation;
use Illuminate\Support\Facades\Auth;

class FormateurController extends Controller
{
    public function dashboard()
    {
        $formateur = Auth::user();

        // Récupérer ses formations via son slug
        $formations = Formation::where('user_slug', $formateur->slug)->get();
        $formationIds = $formations->pluck('id');

        // Nombre de formations
        $nombreFormations = $formations->count();

        // Nombre de questions (requetes) liées à ses formations
        $nombreQuestions = Requete::whereIn('formation_id', $formationIds)->count();

        // Nombre d'apprenants inscrits à ses formations via la table user_formations
        $nombreApprenants = UserFormation::whereIn('formation_id', $formationIds)
            ->distinct('user_id')
            ->count('user_id');

        return view('Formateur.dashboard', compact(
            'nombreFormations',
            'nombreQuestions',
            'nombreApprenants',
            'formations'
        ));
    }
}

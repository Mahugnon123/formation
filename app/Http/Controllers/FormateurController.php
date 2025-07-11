<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\Requete;
use App\Models\UserFormation;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

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
    
    public function apprenants()
    {
        $formateur = Auth::user();
        // Récupérer les formations du formateur
        $formations = \App\Models\Formation::where('user_slug', $formateur->slug)->get();
        $formationIds = $formations->pluck('id')->toArray();

        // Récupérer tous les user_formations
        $userFormations = \App\Models\UserFormation::with('user')->get();

        $apprenants = [];

        foreach ($userFormations as $uf) {
            $formationsArray = json_decode($uf->formations, true);
            if (!is_array($formationsArray)) continue;

            $formationsSuivies = [];
            foreach ($formationsArray as $formation) {
                if (in_array($formation['id'], $formationIds)) {
                    // On récupère l'objet Formation pour le titre
                    $formationObj = $formations->where('id', $formation['id'])->first();
                    if ($formationObj) {
                        $formationsSuivies[] = $formationObj;
                    }
                }
            }

            if (count($formationsSuivies) > 0) {
                $userId = $uf->user_id;
                if (!isset($apprenants[$userId])) {
                    $apprenants[$userId] = [
                        'apprenant' => $uf->user,
                        'formations' => []
                    ];
                }
                $apprenants[$userId]['formations'] = array_merge($apprenants[$userId]['formations'], $formationsSuivies);
            }
        }

        return view('Formateur.apprenants', compact('apprenants'));
    }

    public function apprenantFormations($id)
    {
        $apprenant = User::findOrFail($id);

        // 1. Formations créées par le formateur connecté (via user_slug)
        $formateurSlug = Auth::user()->slug;
        $formationsFormateur = \App\Models\Formation::where('user_slug', $formateurSlug)->get()->keyBy('id');

        // 2. Formations auxquelles l'apprenant est inscrit (depuis le JSON)
        $userFormation = \App\Models\UserFormation::where('user_id', $id)->first();

        $formations = [];
        if ($userFormation && $userFormation->formations) {
            $formationsData = json_decode($userFormation->formations, true);
            foreach ($formationsData as $f) {
                $formationId = (int) $f['id'];
                // 3. On ne garde que si la formation appartient au formateur connecté
                if (isset($formationsFormateur[$formationId])) {
                    $formation = $formationsFormateur[$formationId];
                    $date = $f['date_inscription'] ?? null;
                    $date_formatted = $date ? Carbon::parse($date)->format('d/m/Y') : '-';
                    $formations[] = [
                        'titre' => $formation->titre,
                        'date_inscription' => $date_formatted,
                        'status' => $f['status'] ?? '-',
                    ];
                }
            }
        }

        return view('Formateur.apprenant_formations', compact('apprenant', 'formations'));
    }
}

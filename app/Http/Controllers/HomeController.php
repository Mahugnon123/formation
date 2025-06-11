<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\UserFormation;

use App\Models\User;
use Notification;
use App\Notification\FormateurNotification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->role_id == 1) {
            $formation_all = Formation::all();
            $userformation = UserFormation::where('user_id', auth()->user()->id)->first();
            return view('Apprenant.index', compact('userformation', 'formation_all'));
        }

if (auth()->user()->role_id == 2) {
    $formateur = auth()->user();

    $formations = Formation::where('user_slug', $formateur->slug)->get();
    $formationIds = $formations->pluck('id')->toArray();

    $nombreFormations = count($formations);

    $nombreVues = \App\Models\FormationView::whereIn('formation_id', $formationIds)->count();

    $nombreQuestions = \App\Models\Requete::whereIn('formation_id', $formationIds)->count();

    // Calcul nombre d'apprenants inscrits sur toutes les formations du formateur
    $userFormations = UserFormation::all();

    $userIds = collect();

    foreach ($userFormations as $userFormation) {
        $formationsJson = $userFormation->formations;
        $formationsArray = json_decode($formationsJson, true);

        if (is_array($formationsArray)) {
            foreach ($formationsArray as $f) {
                if (in_array($f['id'], $formationIds)) {
                    $userIds->push($userFormation->user_id);
                    break; // On ajoute l'user_id une fois seulement s’il est inscrit à au moins une formation du formateur
                }
            }
        }
    }

    $nombreApprenants = $userIds->unique()->count();

    return view("Formateur.index", compact(
        'formations',
        'nombreFormations',
        'nombreQuestions',
        'nombreApprenants',
        'nombreVues'
    ));
}


        if (auth()->user()->role_id == 3) {
            return view("Admin.app");
        }

        auth()->user()->last_connexion = date('d/m/Y H:i:s');
    }
}

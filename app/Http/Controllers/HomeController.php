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

            // Construction de $fmts avec la progression réelle
            $fmts = [];
            if ($userformation && $userformation->formations) {
                $formations = is_array($userformation->formations) ? $userformation->formations : json_decode($userformation->formations, true);
                $j = 0;
                foreach ($formation_all as $frmt) {
                    foreach ($formations as $fmt) {
                        if ($frmt->id == $fmt['id']) {
                            // Récupérer la progression réelle
                            $progression = \App\Models\Progression::where('user_id', auth()->user()->id)
                                ->where('formation_id', $frmt->id)
                                ->first();
                            $progressionValue = $progression ? $progression->pourcentage_progression : 0;
                            $fmts[$j] = [
                                "fmt" => $frmt,
                                "progression" => $progressionValue,
                            ];
                            $j++;
                        }
                    }
                }
            }

            $tauxCertif = \App\Models\UserTest::where('user_id', auth()->user()->id)
                ->where('status', 'Validé')
                ->count();
            return view('Apprenant.index', compact('userformation', 'formation_all', 'fmts', 'tauxCertif'));
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
                    foreach ($formationsArray as $formation) {
                        $userIds->push($userFormation->user_id);
                    }
                }
            }

            $nombreApprenants = $userIds->unique()->count();

            return view('Formateur.index', compact(
                'nombreFormations',
                'nombreVues',
                'nombreQuestions',
                'nombreApprenants',
                'formations'
            ));
        }

        if (auth()->user()->role_id == 3) {
            return view("Admin.app");
        }

        auth()->user()->last_connexion = date('d/m/Y H:i:s');
    }
}

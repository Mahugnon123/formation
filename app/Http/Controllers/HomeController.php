<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\UserFormation;

use App\Models\User;
use Notification;
use App\Notification\FormateurNotification;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
                                "date_inscription" => $fmt['date_inscription'] ?? null
                            ];
                            $j++;
                        }
                    }
                }
            }

            $fmts = collect($fmts)->sortByDesc(function($item) {
                return $item['date_inscription'] ?? null;
            })->values()->all();

            $tauxCertif = \App\Models\UserTest::where('user_id', auth()->user()->id)
                ->where('status', 'Validé')
                ->count();
            return view('Apprenant.index', compact('userformation', 'formation_all', 'fmts', 'tauxCertif'));
        }

        if (auth()->user()->role_id == 2) {
            $formateur = auth()->user();

            $formations = Formation::where('user_slug', $formateur->slug)->get();
            // Récupérer les IDs des formations du formateur connecté
            $formationIds = $formations->pluck('id')->toArray();

            $nombreFormations = count($formations);

            $nombreVues = \App\Models\FormationView::whereIn('formation_id', $formationIds)->count();

            $nombreQuestions = \App\Models\Requete::whereIn('formation_id', $formationIds)->count();

            // Calcul nombre d'apprenants inscrits sur toutes les formations du formateur
            $userFormations = UserFormation::all();
            $userIds = collect();

            foreach ($userFormations as $userFormation) {
                $formationsArray = json_decode($userFormation->formations, true);
                if (is_array($formationsArray)) {
                    // Vérifier si l'utilisateur est inscrit à au moins une formation du formateur
                    foreach ($formationsArray as $formation) {
                        if (in_array($formation['id'], $formationIds)) {
                            $userIds->push($userFormation->user_id);
                            break; // On compte l'utilisateur une seule fois
                        }
                    }
                }
            }

            $nombreApprenants = $userIds->unique()->count();

            // Récupérer la date de la première formation
            $firstFormation = $formations->sortBy('created_at')->first();
            $firstDay = $firstFormation ? \Carbon\Carbon::parse($firstFormation->created_at)->startOfDay() : \Carbon\Carbon::today();
            $today = \Carbon\Carbon::today();

            $daysCount = $firstDay->diffInDays($today) + 1; // +1 pour inclure le premier jour

            if ($daysCount < 30) {
                $startDate = $firstDay;
            } else {
                $startDate = $today->copy()->subDays(29);
            }
            $endDate = $today;

            $labels = [];
            $data = [];

            for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                $labels[] = $date->format('d/m');
                $views = \DB::table('formation_views')
                    ->whereIn('formation_id', $formationIds)
                    ->whereDate('viewed_at', $date->format('Y-m-d'))
                    ->count();
                $data[] = $views;
            }

            return view('Formateur.index', compact(
                'nombreFormations',
                'nombreVues',
                'nombreQuestions',
                'nombreApprenants',
                'formations',
                'labels',
                'data'
            ));
        }

        if (auth()->user()->role_id == 3) {
            return view("Admin.app");
        }

        auth()->user()->last_connexion = date('d/m/Y H:i:s');
    }
}

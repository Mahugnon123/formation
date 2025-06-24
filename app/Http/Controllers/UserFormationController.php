<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Formation;
use App\Models\UserFormation;
use App\Models\Resume;
use App\Models\Progression;
use App\Helpers;
use App\Models\UserTest;

use Illuminate\Http\Request;

class UserFormationController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   

   
     public function chapitre($slug){
        $resumeChapitre = [];
        $formation = Formation::where('slug', $slug)->first();
        $userFormation = UserFormation::where('user_id', auth()->user()->id)->first();
        $resume = Resume::where('formation_id', $formation->id)->first();
        
        // S'assurer que chapitre est un tableau
        $chapitres = $formation->chapitre;
        if (is_string($chapitres)) {
            $chapitres = json_decode($chapitres, true);
        }
        if (!is_array($chapitres)) {
            $chapitres = [];
        }
        
        $totalChapitres = count($chapitres);
        
        // Récupérer la progression depuis la nouvelle table
        $progression = Progression::where('user_id', auth()->user()->id)
            ->where('formation_id', $formation->id)
            ->first();
        
        $progressionValue = 0;
        $lastChapterIndex = 0;
        
        if ($progression) {
            // Calculer le pourcentage de progression
            $chapitresCompletes = $progression->chapitres_completes;
            if (is_string($chapitresCompletes)) {
                $chapitresCompletes = json_decode($chapitresCompletes, true);
            }
            if (!is_array($chapitresCompletes)) {
                $chapitresCompletes = [];
            }

            if ($totalChapitres > 0) {
                $progressionValue = min(100, (count($chapitresCompletes) * 100) / $totalChapitres);
                $progressionValue = round($progressionValue, 2);
            }
            $lastChapterIndex = $progression->chapitre_courant;
        }

        $resumeNotes = [];
        if ($resume && $resume->resumeChapitre) {
            $resumeNotes = is_array($resume->resumeChapitre)
                ? $resume->resumeChapitre
                : json_decode($resume->resumeChapitre, true);
        }

        // Récupérer les questions du test pour cette formation
        $questions = \App\Models\Question::where('formation_id', $formation->id)
            ->with('reponses')
            ->get();

        foreach ($questions as $question) {
            if ($question->type === 'QCM') {
                if (is_string($question->reponse_correcte)) {
                    $question->reponse_correcte = json_decode($question->reponse_correcte, true);
                }
                if (!is_array($question->reponse_correcte)) {
                    $question->reponse_correcte = [];
                }
            } elseif ($question->type === 'Vrai/Faux') {
                if (is_string($question->reponse_correcte) && is_numeric($question->reponse_correcte)) {
                    $question->reponse_correcte = intval($question->reponse_correcte);
                }
            }
        }

        // Récupérer le statut de validation du test pour cette formation et cet utilisateur
        $userTest = UserTest::where('user_id', auth()->id())
            ->where('formation_id', $formation->id)
            ->where('status', 'Validé')
            ->first();

        return view('Apprenant.formations.suivi-formation', compact(
            'formation',
            'chapitres',
            'resume',
            'progressionValue',
            'lastChapterIndex',
            'totalChapitres',
            'progression',
            'resumeNotes',
            'questions',
            'userTest'
        ));
    }
    
    public function suivis()
    {
        $user = auth()->user();
        \Log::info('Début de la méthode suivis - User ID: ' . $user->id);

        $userFormations = UserFormation::where('user_id', $user->id)->get();
        \Log::info('Nombre de formations trouvées: ' . $userFormations->count());
        
        $fmts = [];

        foreach ($userFormations as $userFormation) {
            // Décoder le JSON des formations
            $formations = json_decode($userFormation->formations, true);
            \Log::info('Formations décodées: ' . json_encode($formations));

            if (is_array($formations)) {
                foreach ($formations as $fmt) {
                    \Log::info('Traitement de la formation ID: ' . $fmt['id']);
                    
                    $formation = Formation::find($fmt['id']);
                    if ($formation) {
                        \Log::info('Formation trouvée: ' . $formation->titre);
                        
                        $progression = \App\Models\Progression::where('user_id', $user->id)
                            ->where('formation_id', $formation->id)
                            ->first();

                        $progressionValue = $progression ? $progression->pourcentage_progression : 0;
                        \Log::info('Progression trouvée: ' . $progressionValue);

                        $fmts[] = [
                            'fmt' => $formation,
                            'progression' => $progressionValue
                        ];
                    } else {
                        \Log::warning('Formation non trouvée pour ID: ' . $fmt['id']);
                    }
                }
            }
        }

        \Log::info('Données finales envoyées à la vue: ' . json_encode($fmts));
        \Log::info('Nombre d\'éléments dans $fmts: ' . count($fmts));

        return view('Apprenant.formations.suivi', compact('fmts'));
    }

    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Vérifier si l'utilisateur est connecté
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter ou vous inscrire pour accéder aux cours');
        }

        $id = $request->input('id');
        $fmts =  [];
        $id_fmt = 0;
        $userfmt = UserFormation::where('user_id', auth()->user()->id)->first();
        
        /**Association de l'utilisateur a ses formations */
        if($userfmt == null){
            $formations[0]= [
                "id"=>$id,
                "status"=> "Inscrire",
                "progression" => 0
            ];
            
            UserFormation::create([
                'user_id' => auth()->user()->id,
                'formations' =>json_encode($formations),
            ]);

        }else{
            $verify = false;
            $formations = (is_array($userfmt->formations))? $userfmt->formations:json_decode($userfmt->formations,true);
            for($i=0; $i<count($formations); $i++){
                if($formations[$i]["id"] == $id){
                    $verify = true;
                }
            }
            if($verify == false){
                $id_fmt = count($formations);
                $formations[$id_fmt]["id"] = $id;
                $formations[$id_fmt]["status"] = "Inscrire";
                $formations[$id_fmt]["progression"] = 0;
                UserFormation::where('user_id',auth()->user()->id )->update([
                    'formations' =>json_encode($formations),
                ]);
            }
        }
    
        return redirect('/home');
    }

    public function formation(){
        $userId = auth()->user()->id;
        $this->syncUserFormations($userId);

        $formations = [];
        $fmts = [];
        $status = [];
        $formation_all = Formation::all();
        $userfmt = UserFormation::where('user_id', $userId)->first();
        
        if($userfmt != null){
            $formations = (is_array($userfmt->formations)) ? $userfmt->formations : json_decode($userfmt->formations, true);
            
            if(is_array($formations)) {
                foreach($formation_all as $formation){
                    foreach($formations as $fmt){
                        if($formation->id == $fmt['id']){
                            // Vérifie si la formation est validée dans user_tests
                            $userTest = UserTest::where('user_id', $userId)
                                ->where('formation_id', $formation->id)
                                ->where('status', 'Validé')
                                ->first();

                            if ($userTest) {
                                $currentStatus = 'Validé';
                            } else {
                                // Statut normal selon la progression
                                $progression = Progression::where('user_id', $userId)
                                    ->where('formation_id', $formation->id)
                                    ->first();
                                $currentStatus = 'Inscrire';
                                if ($progression) {
                                    if ($progression->pourcentage_progression > 0 && $progression->pourcentage_progression < 100) {
                                        $currentStatus = 'En cours';
                                    } elseif ($progression->pourcentage_progression == 100) {
                                        $currentStatus = 'Terminer';
                                    }
                                }
                            }

                            $fmts[] = $formation;
                            $status[] = $currentStatus;
                            break;
                        }
                    }
                }
            }
        }

        return view('Apprenant.formations.formation', [
            'userfmt' => $userfmt,
            'status' => $status,
            'formations' => $fmts
        ]);
    }

    
    function progress(Request $request){
        try {
            $fmt = Formation::where('id', $request->fmt)->first();
            if (!$fmt) {
                return response()->json(['error' => 'Formation non trouvée'], 404);
            }

            // Récupérer ou créer la progression
            $progression = Progression::firstOrNew([
                'user_id' => auth()->user()->id,
                'formation_id' => $request->fmt
            ]);

            // Récupérer les chapitres complétés
            $chapitresCompletes = [];
            if ($progression->chapitres_completes) {
                $chapitresCompletes = is_string($progression->chapitres_completes) 
                    ? json_decode($progression->chapitres_completes, true) 
                    : $progression->chapitres_completes;
            }

            // Vérifier si le chapitre actuel est déjà complété
            $chapitreActuel = (int)$request->progress;
            
            // Si le chapitre n'est pas déjà complété, l'ajouter
            if (!in_array($chapitreActuel, $chapitresCompletes)) {
                $chapitresCompletes[] = $chapitreActuel;
                sort($chapitresCompletes);
            }

            // Calculer la progression
            $chapitres = (is_array($fmt->chapitre)) ? $fmt->chapitre : json_decode($fmt->chapitre, true);
            $totalChapitres = count($chapitres);
            $pourcentageProgression = 0;
            
            if ($totalChapitres > 0) {
                $pourcentageProgression = min(100, (count($chapitresCompletes) * 100) / $totalChapitres);
                $pourcentageProgression = round($pourcentageProgression, 2);
            }

            // Mettre à jour la progression
            $progression->chapitre_courant = $chapitreActuel;
            $progression->chapitres_completes = json_encode($chapitresCompletes);
            $progression->pourcentage_progression = $pourcentageProgression;
            $progression->save();

            // Mettre à jour le statut dans UserFormation
            $userFormation = UserFormation::where('user_id', auth()->user()->id)->first();
            $formations = is_array($userFormation->formations) ? $userFormation->formations : json_decode($userFormation->formations, true);

            $newStatus = 'Inscrire'; // Statut par défaut
            if ($pourcentageProgression > 0 && $pourcentageProgression < 100) {
                $newStatus = 'En cours';
            } elseif ($pourcentageProgression == 100) {
                $newStatus = 'Terminer';
            }

            foreach ($formations as &$fmt) {
                if ($fmt['id'] == $request->fmt) {
                    $fmt['status'] = $newStatus;
                    break;
                }
            }

            // Sauvegarder les modifications
            UserFormation::where('user_id', auth()->user()->id)->update([
                'formations' => json_encode($formations),
            ]);

            // Synchroniser les formations
            $this->syncUserFormations(auth()->user()->id);

            return response()->json([
                'progression' => $pourcentageProgression,
                'chapitres_completes' => $chapitresCompletes,
                'chapitre_courant' => $chapitreActuel,
                'total_chapitres' => $totalChapitres,
                'chapitres_completes_count' => count($chapitresCompletes),
                'status' => $newStatus
            ]);

        } catch (\Exception $e) {
            \Log::error('Erreur dans la progression: ' . $e->getMessage());
            return response()->json(['error' => 'Une erreur est survenue'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->input('id');
        $userfmt = UserFormation::where('user_id', auth()->user()->id)->first();
        $formations = $userfmt->formations;
        $status [$id]= $request->input('status');

        if($formations.in_array($id)){
            $status[$id]=$request->input('id');
            UserFormation::where('user_id',$id )->update([
                'status'=>$status
            ]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = User::where('slug',$request->slug)->first()->delete();
        $ok=true;
        return Response()->json($ok );
    }
    public function restore(Request $request){
        $user = User::withTrashed()->where('slug', $request->slug)->restore();
        $ok=true;
        return Response()->json($ok );
    }

    public function updateProgression(Request $request)
    {
        try {
            $progression = Progression::firstOrNew([
                'user_id' => auth()->user()->id,
                'formation_id' => $request->formation_id
            ]);

            $chapitreActuel = (int)$request->chapter_number;
            
            // Récupérer les chapitres complétés
            $chapitresCompletes = [];
            if ($progression->chapitres_completes) {
                $chapitresCompletes = is_string($progression->chapitres_completes) 
                    ? json_decode($progression->chapitres_completes, true) 
                    : $progression->chapitres_completes;
            }

            // Mettre à jour le chapitre courant
            $progression->chapitre_courant = $chapitreActuel;
            $progression->chapitres_completes = json_encode($chapitresCompletes);
            $progression->save();

            return response()->json([
                'success' => true,
                'chapitre_courant' => $chapitreActuel,
                'chapitres_completes' => $chapitresCompletes
            ]);

        } catch (\Exception $e) {
            \Log::error('Erreur dans updateProgression: ' . $e->getMessage());
            return response()->json(['error' => 'Une erreur est survenue'], 500);
        }
    }

    public function index()
    {
        $user = auth()->user();
        $userformation = UserFormation::where('user_id', $user->id)->first();
        $formation_all = Formation::all();
        $fmts = [];
        $tauxFmt = 0;
        $tauxCertif = 0;
        $taux = 0;

        // Compter le nombre de formations validées dans user_tests
        $tauxCertif = UserTest::where('user_id', $user->id)
            ->where('status', 'Validé')
            ->count();

        if ($userformation && $userformation->formations) {
            $formations = is_array($userformation->formations) ? $userformation->formations : json_decode($userformation->formations, true);
            $j = 0;
            foreach ($formation_all as $frmt) {
                foreach ($formations as $fmt) {
                    if ($frmt->id == $fmt['id']) {
                        // Récupérer la progression réelle
                        $progression = \App\Models\Progression::where('user_id', $user->id)
                            ->where('formation_id', $frmt->id)
                            ->first();
                        $progressionValue = $progression ? $progression->pourcentage_progression : 0;
                        if ($progressionValue == 100) {
                            $tauxFmt += 1;
                        }
                        $fmts[$j] = [
                            "fmt" => $frmt,
                            "progression" => $progressionValue,
                        ];
                        $j++;
                    }
                }
            }
            $taux = (count($fmts) == 0) ? 0 : round(($tauxFmt * 100) / count($fmts), 2);
        }
        return view('Apprenant.index', compact('userformation', 'formation_all', 'fmts', 'taux', 'tauxCertif'));
    }

    private function syncUserFormations($userId)
    {
        $userFormation = UserFormation::where('user_id', $userId)->first();
        if (!$userFormation) return;

        $formations = is_array($userFormation->formations) ? $userFormation->formations : json_decode($userFormation->formations, true);

        foreach ($formations as &$formation) {
            $progression = Progression::where('user_id', $userId)
                ->where('formation_id', $formation['id'])
                ->first();

            $pourcentage = $progression ? $progression->pourcentage_progression : 0;

            // Calcul du statut
            $status = 'Inscrire';
            if ($pourcentage > 0 && $pourcentage < 100) {
                $status = 'En cours';
            } elseif ($pourcentage == 100) {
                $status = 'Terminer';
            }
            // Si tu veux gérer "certifier", ajoute ici une condition supplémentaire

            $formation['progression'] = $pourcentage;
            $formation['status'] = $status;
        }

        // Sauvegarde
        $userFormation->formations = json_encode($formations);
        $userFormation->save();
    }
}

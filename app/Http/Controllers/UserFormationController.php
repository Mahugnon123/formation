<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Formation;
use App\Models\UserFormation;
use App\Models\Resume;
use App\Helpers;

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
        $resumeChapitre=[];
        $formation = Formation::where('slug',$slug)->firstOrFail();
        $userfmt = UserFormation::where('user_id',auth()->user()->id)->first();
        $resume = Resume::where('formation_id',$formation->id)->first();
        /*if($resume !=null){
            $resumeChapitre = (is_array($resume->resumeChapitre))?$resume->resumeChapitre:json_decode($resume->resumeChapitre, true);
        }*/
        $chapitres = $formation->chapitre;
        $progression = 0; // Initialisez $progression à 0 par défaut
    
        // ... code existant ...
$lastChapterIndex = 0;
if ($userfmt) {
    $formationsSuivies = (is_array($userfmt->formations)) ? $userfmt->formations : json_decode($userfmt->formations, true);
    foreach ($formationsSuivies as $formationSuivie) {
        if ($formation->id == $formationSuivie['id'] && isset($formationSuivie['chapitres_completes'])) {
            $chapitresCompletes = $formationSuivie['chapitres_completes'];
            if (is_array($chapitresCompletes) && count($chapitresCompletes) > 0) {
                $lastChapterIndex = max($chapitresCompletes);
            }
        }
    }
}

return view('Apprenant.formations.suivi-formation', compact('formation','chapitres','resume','progression', 'lastChapterIndex'));
    
    }
    
    public function suivis(){
        $userfmt = UserFormation::where('user_id',auth()->user()->id)->first();
        $formation_all = Formation::all();
        $j=0;
        $fmts=[];
        if($userfmt !=null){
            $formations = (is_array($userfmt->formations))? $userfmt->formations:json_decode($userfmt->formations,true);

        foreach($formation_all as $formation){
            for ($i=0; $i<count($formations);$i++){
                    if($formation->id==$formations[$i]['id']){
                    $fmts[$j]= [
                        "fmt" =>$formation,
                        "progression"=> $formations[$i]['progression'],
                        
                    ];
                    $j++;
            }
            }
        }
    }
        
        return view('Apprenant.formations.suivi',compact('fmts'));
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
            return response()->json([
                'status' => 'error',
                'message' => 'Veuillez vous connecter ou vous inscrire pour accéder aux cours'
            ], 401);
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
     
        return response()->json([
            'status' => 'success',
            'message' => 'Inscription réussie',
            'redirect' => '/home'
        ]);
    }

    public function formation(){
        $formations = null;
        $fmts = [];
        $status=[];
        $formation_all = Formation::all();
        $userfmt = UserFormation::where('user_id', auth()->user()->id)->first();
        if($userfmt !=null){
            $formations = (is_array($userfmt->formations))? $userfmt->formations:json_decode($userfmt->formations,true);

            foreach($formation_all as $formation){
                for ($i=0; $i<count($formations);$i++){
                        if($formation->id==$formations[$i]['id']){
                        $fmts[]=$formation;
                        $status[]= $formations[$i]['status'];
                }
                }
            }
        }
        
        
        return view('Apprenant.formations.formation', [ 'userfmt'=> $userfmt,'status'=> $status, 'formations'=> $fmts]);
    }

    
    function progress(Request $request){
        try {
            $chpt_fini = ($request->chapitres == null) ? [] : str_split($request->chapitres);
            array_push($chpt_fini, $request->progress);
            $chpt_fini = array_unique($chpt_fini);
            sort($chpt_fini); // Trier les chapitres pour maintenir l'ordre
            $progression = 0;
            
            $userfmt = UserFormation::where('user_id', auth()->user()->id)->first();
            if (!$userfmt) {
                return response()->json(['error' => 'Utilisateur non trouvé'], 404);
            }

            $formations = (is_array($userfmt->formations)) ? $userfmt->formations : json_decode($userfmt->formations, true);
            $formationFound = false;

            for ($i = 0; $i < count($formations); $i++) {
                if ($request->fmt == $formations[$i]['id']) {
                    $formationFound = true;
                    $fmt = Formation::where('id', $request->fmt)->first();
                    if (!$fmt) {
                        return response()->json(['error' => 'Formation non trouvée'], 404);
                    }

                    $chapitres = (is_array($fmt->chapitre)) ? $fmt->chapitre : json_decode($fmt->chapitre, true);
                    $totalChapitres = count($chapitres);
                    
                    if ($totalChapitres > 0) {
                        $progression = (count($chpt_fini) * 100) / $totalChapitres;
                        $progression = round($progression, 2); // Arrondir à 2 décimales
                    }

                    $formations[$i]['progression'] = $progression;
                    $formations[$i]['status'] = ($progression >= 100) ? 'Terminer' : 'Commencer';
                    $formations[$i]['chapitres_completes'] = $chpt_fini; // Stocker les chapitres complétés
                    break;
                }
            }

            if (!$formationFound) {
                return response()->json(['error' => 'Formation non trouvée dans les formations de l\'utilisateur'], 404);
            }

            $userfmt->update([
                'formations' => json_encode($formations)
            ]);

            return response()->json([
                'progression' => $progression,
                'chapitres_completes' => $chpt_fini,
                'status' => ($progression >= 100) ? 'Terminer' : 'Commencer'
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
}

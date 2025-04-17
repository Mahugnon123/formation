<?php

namespace App\Http\Controllers;
use App\Models\Resume;
use App\Models\Formation;
use Illuminate\Http\Request;
use App\Http\Requests\ResumeRequest;

class ResumeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $resumeChapitre = [];
        $resumes = Resume::where('user_id',auth()->user()->id)->get();
        $formations = Formation::all();

        $fmts = [];
        $i = 0;
        $j = 1;
        foreach($resumes as $r){
            $formation = Formation::where('id',$r->formation_id)->first();
            if($formation!=null){
                $fmts[$r->formation_id] = $formation->titre;
            }
            
        }
        return view('Apprenant.resume.index', ['resumes'=> $resumes, 'formation'=> $fmts]);
    }
    

    public function chapitre(Request $request){
        $resume = Resume::where('id',$request->input('id'))->first();
        $resumeChapitre = (is_array($resume->resumeChapitre))?$resume->resumeChapitre:json_decode($resume->resumeChapitre, true);
        $chapitre = $resumeChapitre[$request->input('id_chapitre')];
        /*foreach($resumeChapitre as $rsChapitre){
            if($rsChapitre->titre == $request->input('titre') ){
                $chapitre= $rsChapitre;
            }
        }*/
        return view('Apprenant.resume.chapitre', compact('chapitre'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ResumeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $resumes = Resume::where('formation_id',$request->formation_id)->first();

        if($resumes ==null){
            $resumeChapitre [$request->chapitre_id]= [
                'chapitre_id' => $request->chapitre_id,
                'titre' => $request->titre,
                'description' => $request->description,
                'commentaire'=> $request->commentaire,
                'updated_at'=> date('d/m/Y H:i:s'),

        ];

        $resume = Resume::create([
                'titre'		=>	'Note des chapitre',
                'resumeChapitre' =>	json_encode($resumeChapitre),
                'user_id' => auth()->user()->id,
                'formation_id'	=>	$request->formation_id,
                
            ]);
        }
        else{
            $resumeChapitre = (is_array($resumes->resumeChapitre))?$resumes->resumeChapitre:json_decode($resumes->resumeChapitre, true);
            $resumeChapitre [$request->chapitre_id]= [
                'chapitre_id' => $request->chapitre_id,
                'titre' => $request->titre,
                'description' => $request->description,
                'commentaire'=> $request->commentaire,
                'updated_at'=> date('d/m/Y H:i:s'),

            ];
            $resume = Resume::where('formation_id',$request->formation_id)->update([
                'resumeChapitre' =>	json_encode($resumeChapitre),
                'user_id' => auth()->user()->id,
                ]);
            }
        return Response()->json(array("resultat"=>$resumeChapitre));


        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$chapitre_id)
    {
       
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $resume = Resume::where('id',$request->input('id_resume'))->first();
        if(is_array($resume->resumeChapitre)){
            $resumeChapitre = $resume->resumeChapitre;
        }else{
            $resumeChapitre = json_decode($resume->resumeChapitre, true);
        }
        $resumeChapitre [$request->chapitre_id]= [
            'chapitre_id' => $request->chapitre_id,
            'titre' => $request->titre,
            'description' => $request->description,
            'commentaire'=> $request->commentaire,
            'updated_at'=> date('d/m/Y H:i:s'),

        ];

        $resume = Resume::where('id',$request->input('id_resume'))->update([
            'resumeChapitre' =>	json_encode($resumeChapitre)     
            ]);
            
         return redirect()->back();
    }

    public function supChapitre(Request $request){
        $resume = Resume::where('id',$request->input('id_resume'))->first();
        $resumeChapitre = (is_array($resume->resumeChapitre))?$resume->resumeChapitre:json_decode($resume->resumeChapitre, true);
        unset($resumeChapitre[$request->id_chpt]);
        array_splice($request->$request->id_chpt, 4);

        var_dump($resumeChapitre);

        //$resume_chapitre->delete();

        return redirect()->back();
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }
}

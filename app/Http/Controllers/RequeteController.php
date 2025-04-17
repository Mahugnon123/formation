<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Requete;
use App\Models\Formation;
use App\Models\ForumReponse;
use App\Models\User;

use App\Models\UserFormation;
use App\Helpers;
class RequeteController extends Controller
{

    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formations=[];
        $formation_iscrt=[];
        $reponse=[];
        $formation_all = Formation::all();
        $userfmt = UserFormation::where('user_id', auth()->user()->id)->first();
        $requetes = Requete::where('user_id', auth()->user()->id)->get();
        $users = Helpers::seachUserById();
        /** Recuperer les formations auquelles l'user a fait des requetes */
        if($requetes!=null){
            foreach($requetes as $requete){
                $reponse[$requete->id]= ForumReponse::where('requete_id', $requete->id)->get();
                $formations[$requete->id] = Formation::where('id',$requete->formation_id)->first();
            }
        }
        
        /** Recuperer les formations auquelles l'user s'est inscrit */
       
        if($userfmt !=null){
            $formation_inscrites = (is_array($userfmt->formations))? $userfmt->formations:json_decode($userfmt->formations,true);
            foreach($formation_all as $formation){
                foreach ($formation_inscrites as $fmt){
                        if($formation->id==$fmt['id']){
                        $formation_iscrt[]=$formation;
                }
                }
            }
        }
        
        return view('Apprenant.formations.question',compact('requetes','formations', 'formation_iscrt','reponse','users') );
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Requete::create([
            'nom' =>$request->titre,
            'description' =>$request->description,
            'user_id' =>auth()->user()->id,
            'formation_id' =>$request->fmt_id,
            'slug' => Helpers::generateSlug(),
        ]);
         return redirect()->back()->with('message','Requete creer avec succes');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($slug)
    {
        $responses = [];
        $responses_no_parent =[];
        $slug = substr($slug, 4, strlen($slug)-1);
        $requete = Requete::where('nom', $slug)->first();
        $enseignant = Formation::where('id', $requete->formation_id)->first();
        $reponses = ForumReponse::where('requete_id', $requete->id)->get();
        //$responses_no_parent = ForumReponse::where([['requete_id', $requete->id],['parent_id',null]])->get();
        $enseignant = User::where('slug',$enseignant->user_slug)->first();
        $users = Helpers::seachUserById();

        return view('Apprenant.formations.forum',compact('requete','reponses','users','enseignant') );
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
    public function update(Request $request, $id)
    {
        Requete::where('id', $request->input('id'))->update([
            'nom' =>$request->nom,
            'descritption' =>$request->description,
            'user_id' =>auth()->user()->id,
            'formation_id' =>$request->fmt_id,
        ]);

        return redirect('/apprenant-requete')->with('message','Requete creer avec succes');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $total_checked = str_split($request->total_checked);
        var_dump($total_checked);
        if($total_checked !=null){
            for($i=0;$i<count($total_checked);$i++){
                $requete = Requete::where('id',$total_checked[$i])->first();
                $requete->delete();
            }
        }
       
        return redirect()->back()->with('message','Requete supprimer avec succes');

   
    }
}

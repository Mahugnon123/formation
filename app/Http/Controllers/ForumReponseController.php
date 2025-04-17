<?php

namespace App\Http\Controllers;
use App\Models\Requete;
use App\Models\ForumReponse;
use Illuminate\Http\Request;
use App\Helpers;

class ForumReponseController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $slug = $request->requete_slug;
        $requete = Requete::where('slug', $slug)->first();
        $requete_id = $requete->id;
        $parent_id = ForumReponse::where('slug', $request->parent_id)->first();
        var_dump($requete_id);
        $reponse = ForumReponse::create([
            'description' =>	$request->description,
            'user_id' => auth()->user()->id,
            'parent_id'	=>	($parent_id == null)?null :$parent_id->id ,
            'slug' => Helpers::generateSlug(),
            'requete_id' => $requete_id
        ]);

        return redirect()->back()->with('message','Reponse envoyer avec succes!');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

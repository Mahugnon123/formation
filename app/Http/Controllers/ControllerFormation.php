<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers;
use App\Models\Formation;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ControllerFormation extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $formation = Formation::all();
        return view('Formateur.formations.index',compact('formation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
         return view('Formateur.formations.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  public function store(Request $request)
    {

        $intitule = [];
        $chapitre_description = [];
        $intitule_texte = [];
        $chapitre_descriptiond_texte = [];
        $video = [];
        $chapitre = [];
        $contenu = [];
        $competence = [];
        $besoin = [];
        $chapitre_summernote = [];
        $folderVideo = "/Video/";
        $folderImage = "/images/";
        $category_id=null;
        if($request->hasFile('photo_type'))
            {
                $formation_image = $request->file('photo_type');
                $nomphoto = Str::random(10)."-".time().'.png';
                $formation_image->move(public_path($folderImage), $nomphoto);
                $destination_photo = /*"/public".*/$folderImage.$nomphoto;
                
            }

//------------------- request all contenu-----------------------//

           $liste_contenu = $request->contenu;
        
            for ($i=0; $i < count($liste_contenu) ; $i++) { 
             $contenu[$i] = [
                  'value' => $liste_contenu[$i],
              ];
            }
        

       
//------------------- request all competence-----------------------//

        $liste_competence = $request->competence;

       for ($i=0; $i < count($liste_competence) ; $i++) { 
             $competence[$i] = [
                  'value' => $liste_competence[$i],
              ];
            }

//------------------- request all besoin-----------------------//

        $liste_besoin = $request->besoin;

       for ($i=0; $i < count($liste_besoin) ; $i++) { 
             $besoin[$i] = [
                  'value' => $liste_besoin[$i],
              ];
            }
       

//---------------------rquest categorie_id if not existe --------------//

            if ($request->category_id =="autre") {

                Category::create([
                 'nom' => $request->categorie,
                 'slug' => Helpers::generateSlug(),
                 'user_slug' => Auth::user()->slug,
                ]);
                $category_id = DB::table('categories')->latest('id')->value('id');
            }
            else
            {
                $category_id = $request->category_id;
            }
       
        if ($request->type=="video") {
        //------------------- request all intitule-----------------------//
           $list_intitule = $request->intitule;
            for ($i=0; $i < count($list_intitule) ; $i++) { 
             $intitule[$i] = [
                  'value' => $list_intitule[$i],
              ];
              
            }

        //------------------- request all chapitre_description-----------------------//
            $list_chapitre_description = $request->chapitre_description;

            for ($i=0; $i < count($list_chapitre_description) ; $i++) { 
             $chapitre_description[$i] = [
                  'value' => $list_chapitre_description[$i],
              ];
            }
       //------------------- request all video-----------------------//
           $list_video = $request->video;
          
            for ($i=0; $i < count($list_video) ; $i++) 
            { 

                if ( file_exists($list_video[$i]) )
                 {
                  $one_video = $list_video[$i];
                  $extensionVid = $one_video->getClientOriginalExtension();
                  $nomVideo = Str::random(10)."-".time().'.'.$extensionVid;
                  $one_video->move(public_path($folderVideo), $nomVideo);
                  $destination_video = $folderVideo.$nomVideo;

                    $video[$i] = [
                      'value' => /*"/public".*/$destination_video,
                  ];
                }
           }

 //------------------- Create chapitre -----------------------//
          for ($i=0; $i <count($list_intitule) ; $i++)
           { 
                $chapitre[$i]=[
                  'num_chapitre' => $i,
                  'intitule' => $intitule[$i]['value'],
                  'chapitre_description' => $chapitre_description[$i]['value'],
                  'video_url' => $video[$i]['value'],
                ];

            }

           

 //------------------- create formation-----------------------//
            Formation::create([
                'user_slug' => Auth::user()->slug,
                'titre' => $request->title,
                'type' => $request->type,
                'description' => $request->description,
                'image_url' => $destination_photo,
                'payante_ou_non' => $request->payante_ou_non,
                'prix_formation' => $request->prix_formation, 
                'prix_certification' => $request->prix_certification,
                'duree' => $request->duree,
                'contenu' => json_encode($contenu),
                'competence' => json_encode($competence),
                'besoin' => json_encode($besoin),
                'a_propos' => $request->a_propos,
                'chapitre' => json_encode($chapitre),
                'status' => "Pending",
                'category_id' => $category_id,
                'slug' => Helpers::generateSlug(),
              ]);

              $formation = Formation::all();
              return view('Formateur.formations.show',compact('formation'));

            }
            else{

           //------------------- request all intitule-----------------------//
           $list_intitule = $request->intitule_texte;
            for ($i=0; $i < count($list_intitule) ; $i++) { 
             $intitule_texte[$i] = [
                  'value' => $list_intitule[$i],
              ];
              
            }

        //------------------- request all chapitre_description-----------------------//
            $list_chapitre_description = $request->chapitre_descriptiond_texte;

            for ($i=0; $i < count($list_chapitre_description) ; $i++) { 
             $chapitre_descriptiond_texte[$i] = [
                  'value' => $list_chapitre_description[$i],
              ];
            }

        //------------------- request all summernote-----------------------//
            $list_chapitre_summernote = $request->editordata_texte;
           
            if (count($list_chapitre_summernote)==0) {
                $chapitre_summernote[0] = [
                  'value' => htmlentities($request->summernote),
              ];
            }
            else
            {

            for ($i=0; $i < count($list_chapitre_summernote) ; $i++) { 
             $chapitre_summernote[$i] = [
                  'value' => htmlentities($list_chapitre_summernote[$i]),
              ];
            }

            }



       //------------------- Create chapitre texte-----------------------//
          for ($i=0; $i <count($list_intitule) ; $i++)
           { 
                $chapitre[$i]=[
                  'num_chapitre' => $i,
                  'intitule' => $intitule_texte[$i]['value'],
                  'chapitre_description' => $chapitre_descriptiond_texte[$i]['value'],
                  'summernote' => $chapitre_summernote[$i]['value'],
                ];

            }
            
            Formation::create([
                'user_slug' => Auth::user()->slug,
                'titre' => $request->title,
                'type' => $request->type,
                'description' => $request->description,
                'image_url' => $destination_photo,
                'payante_ou_non' => $request->payante_ou_non,
                'prix_formation' => $request->prix_formation, 
                'prix_certification' => $request->prix_certification,
                'duree' => $request->duree,
                'contenu' => json_encode($contenu),
                'competence' => json_encode($competence),
                'besoin' => json_encode($besoin),
                'a_propos' => $request->a_propos,
                'chapitre' => json_encode($chapitre),
                'editordata' => "Texte",
                'status' => "Pending",
                'category_id' => $category_id,
                'slug' => Helpers::generateSlug(),
              ]);
            $formation = Formation::all();
              return view('Formateur.formations.show',compact('formation'));
            }
            
    
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $formation = Formation::where('user_slug',$slug)->get();

        return view('Formateur.formations.show',compact('formation'));

    }

    public function course_detail($slug)
    {
        $formation = Formation::where('slug',$slug)->first();
       // var_dump($formation);
        return view('Formateur.formations.course_detail',compact('formation'));

    }

    public function apprenant_course_detail($slug)
    {
        $formation = Formation::where('slug',$slug)->first();
        $enseignant = User::where('slug',$formation->user_slug)->first();
        $fmt_meme_categorie = Formation::where('category_id',$formation->category_id)->get();
        return view('front.course-single',compact('formation','enseignant','fmt_meme_categorie'));

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

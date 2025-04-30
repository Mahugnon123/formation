<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\UserFormation;
use App\Models\Formation;
use App\Models\User;

class FormationController extends Controller
{
   
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(?string $category_slug = null)
    {
        $categories = Category::get();
        $formations = Formation::with('category');
    
        if ($category_slug) {
            $category = Category::where('slug', $category_slug)->firstOrFail();
            $formations = $formations->where('category_id', $category->id);
        }
    
        // Assurez-vous d'utiliser paginate() ici, par exemple avec le nombre d'éléments par page
        $formations = $formations->where('status', 'Pending')->orderBy('created_at', 'desc')->paginate(12);
    
        return view('front.courses', compact('categories', 'formations'));
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

     //
    }

   
    public function show($slug)
    {
        $bool= false;
        $categories = Category::all();
        $formation = Formation::where('slug','=',$slug)->first();
        $chapitres = $formation->chapitre;

        if(auth()->user()!=null){
            $userfmt = UserFormation::where('user_id',  auth()->user()->id)->first();
            if($userfmt !=null){
                $formation_inscrites = (is_array($userfmt->formations))? $userfmt->formations:json_decode($userfmt->formations,true);
                foreach($formation_inscrites as $fmt){
                            if($formation->id ==$fmt['id']){
                            $bool = true;
                            break;
                            }
                }
            }
        }
        
        //var_dump($bool);
        $enseignant = User::where('slug',$formation->user_slug)->first();
        $fmt_meme_categorie = Formation::where('category_id',$formation->category_id)->get();
        return view('front.course-single', compact('fmt_meme_categorie','formation','categories','chapitres','bool','enseignant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        
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

    public function showCategory($slug)
{
    $category = Category::where('slug', $slug)->firstOrFail();
    $fmt_meme_categorie = Formation::where('category_id', $category->id)
                                ->where('status', 'Pending') // Ajoutez vos conditions de statut si nécessaire
                                ->with('category') // Charger la relation category si vous en avez besoin dans la vue
                                ->get();
    $categories = Category::all(); // Récupérer toutes les catégories pour le menu ou autre

    return view('front.courses-by-category', compact('fmt_meme_categorie', 'category', 'categories'));
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
}

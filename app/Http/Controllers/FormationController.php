<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\UserFormation;
use App\Models\Formation;
use App\Models\User;
use App\Models\FormationView;
//rebecca
use App\Models\Categorie;
use Carbon\Carbon;


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
        $formations = $formations->where('status', 'Valider')->orderBy('created_at', 'desc')->paginate(12);
    
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
    $bool = false;
    $categories = Category::all();
    $formation = Formation::where('slug', '=', $slug)->firstOrFail();  // Utiliser firstOrFail() pour gérer erreur

    // Enregistrement de la vue
    $ip = request()->ip();
    $userId = auth()->check() ? auth()->id() : null;

    $key = 'viewed_formation_' . $formation->id;
    if (!session()->has($key)) {
        FormationView::create([
            'formation_id' => $formation->id,
            'user_id' => $userId,
            'ip_address' => $ip,
        ]);
        session()->put($key, true);
    }

    $chapitres = $formation->chapitre;

    if(auth()->user() != null){
        $userfmt = UserFormation::where('user_id',  auth()->user()->id)->first();
        if($userfmt != null){
            $formation_inscrites = is_array($userfmt->formations) ? $userfmt->formations : json_decode($userfmt->formations,true);
            foreach($formation_inscrites as $fmt){
                if($formation->id == $fmt['id']){
                    $bool = true;
                    break;
                }
            }
        }
    }
    
    $enseignant = User::where('slug', $formation->user_slug)->first();
    $fmt_meme_categorie = Formation::where('category_id', $formation->category_id)->get();

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
                                ->where('status', 'Valider') // Ajoutez vos conditions de statut si nécessaire
                                ->with('category') // Charger la relation category si vous en avez besoin dans la vue
                                ->get();
    $categories = Category::all(); // Récupérer toutes les catégories pour le menu ou autre

    return view('front.courses-by-category', compact('fmt_meme_categorie', 'category', 'categories'));
}

//rebecca

public function destroy(Request $request)
    {
        $formation = Formation::where('slug', $request->slug)->firstOrFail();
        $formation->delete(); // Soft delete
        return response()->json(['message' => 'Formation supprimée avec succès']);
    }

    /**
     * Archive the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
public function archive(Request $request)
{
    $formation = Formation::where('slug', $request->slug)->firstOrFail();
    $formation->status = 'Archiver'; // Met à jour le statut
    $formation->save();
    return response()->json(['message' => 'Formation archivée avec succès']);
}

public function unarchive(Request $request)
{
    $formation = Formation::where('slug', $request->slug)->firstOrFail();
    $formation->status = 'Valider'; // Remet le statut à Valider
    $formation->save();
    return response()->json(['message' => 'Formation désarchivée avec succès']);
}
 
    public function showCategories()
    {
        $categories = Category::all();
        return view('Admin.Formations.categories_selection', compact('categories'));
    }

    public function formationsParCategorie(Request $request, $id)
    {
        $categorie = Category::findOrFail($id);

        // Récupérer les formations uniquement pour cette catégorie
        $query = $categorie->formations();

        // Si un terme de recherche est présent
        if ($request->has('search') && $request->search != '') {
            $query->where('titre', 'like', '%' . $request->search . '%');
        }

        // Récupérer les formations avec pagination, 4 par page
        $formations = $query->latest('created_at')->paginate(4);

        return view('admin.formations.par_categorie', compact('categorie', 'formations'));
    }


public function ajaxByCategory($id)
{
    $formations = \App\Models\Formation::where('category_id', $id)
        ->where('status', 'Valider')
        ->orderBy('created_at', 'desc')
        ->get();

    $html = '';
    foreach ($formations as $formation) {
        $html .= view('front.partials.formation-card', compact('formation'))->render();
    }

    return response()->json(['html' => $html]);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
}

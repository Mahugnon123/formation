<?php
namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\Categorie;
use App\Models\Formation;




class CategorieController extends Controller

{
    public function __construct()
    {
        $this->middleware('auth');}
    /**
     */
   
    public function index()
    {
        try {
            $categories = Category::all(); 
            return view('Admin.category', compact('categories'));
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la récupération des catégories : ' . $e->getMessage());
            return response()->view('errors.500', [], 500);
        }
    }

   

    public function categories()
    {
        try {
            // Récupérer toutes les catégories triées par date de création
            $categories = Category::orderBy('created_at', 'desc')->get();
            
            return view('Admin.category', compact('categories'));
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la récupération des catégories : ' . $e->getMessage());
    
            return response()->view('errors.500', [], 500);
        }
    }
    
        public function categorieCreer(Request $request)
        {
            try {
                $validated = $request->validate([
                    'nom' => 'required|string|max:255|unique:categories,nom',
                    'description' => 'required|string|max:500',
                ]);
    
                $baseSlug = Str::slug($request->nom);
                $slug = $baseSlug;
                $counter = 1;
    
                while (Category::where('user_slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }
    
                 // Récupère le slug de l'utilisateur connecté (adapte selon ton modèle User)
        $userSlug = $request->user()->slug; // ou $request->user()->username

        \App\Models\Category::create([
            'nom' => $validated['nom'],
            'description' => $validated['description'],
            'slug' => $slug,
            'user_slug' => $userSlug,
        ]);
    
                return redirect()->route('admin.categories.creer')->with('message', 'Catégorie créée avec succès !');
            } catch (\Exception $e) {
                Log::error('Erreur lors de la création de la catégorie : ' . $e->getMessage());
                return redirect()->back()->with('error', 'Erreur lors de la création de la catégorie : ' . $e->getMessage());
            }
        }
    
        public function update(Request $request, $id)
        {
            try {
                $categorie = Category::findOrFail($id);
    
                $validated = $request->validate([
                    'nom' => 'required|string|max:255|unique:categories,nom,' . $id,
                    'description' => 'required|string|max:500',
                ]);
    
                if ($categorie->nom !== $validated['nom']) {
                    $baseSlug = Str::slug($validated['nom']);
                    $slug = $baseSlug;
                    $counter = 1;
    
                    // Vérifier si le nouveau slug existe déjà
                    while (Category::where('user_slug', $slug)->where('id', '!=', $id)->exists()) {
                        $slug = $baseSlug . '-' . $counter;
                        $counter++;
                    }
                    $validated['user_slug'] = $slug;
                }
    
                $categorie->update($validated);
    
                return redirect()->route('admin.categories')->with('message', 'Catégorie mise à jour avec succès.');
            } catch (\Illuminate\Validation\ValidationException $e) {
                return redirect()->back()->withErrors($e->validator)->withInput();
            } catch (\Exception $e) {
                Log::error('Erreur lors de la mise à jour de la catégorie : ' . $e->getMessage());
                return redirect()->back()->with('error', 'Erreur lors de la mise à jour de la catégorie : ' . $e->getMessage());
            }
    }
    
    public function destroy($id)
    {
        try {
            $categorie = Category::findOrFail($id);
            $categorie->delete();
            return redirect()->route('admin.categories')->with('message', 'Catégorie supprimée avec succès.');
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la suppression de la catégorie : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur lors de la suppression.');
        }
    }
 

        /**
        * Affiche la liste des catégories
        *
        * @return \Illuminate\View\View
        */
  
}
     



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
use Illuminate\Support\Facades\Redirect;

class ControllerFormation extends Controller
{
    public function index(Request $request)
    {
        $query = Formation::query()->where('user_slug', Auth::user()->slug);

        if ($request->has('search') && $request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where('titre', 'like', '%' . $searchTerm . '%');
        }

        $formations = $query->get();
        return view('Formateur.formations.index', compact('formations'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('Formateur.formations.create', compact('categories'));
    }

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
        $category_id = null;

        if ($request->hasFile('photo_type')) {
            $formation_image = $request->file('photo_type');
            $nomphoto = Str::random(10) . "-" . time() . '.png';
            $formation_image->move(public_path($folderImage), $nomphoto);
            $destination_photo = $folderImage . $nomphoto;
        }

        $liste_contenu = $request->contenu;
        for ($i = 0; $i < count($liste_contenu); $i++) {
            $contenu[$i] = ['value' => $liste_contenu[$i]];
        }

        $liste_competence = $request->competence;
        for ($i = 0; $i < count($liste_competence); $i++) {
            $competence[$i] = ['value' => $liste_competence[$i]];
        }

        $liste_besoin = $request->besoin;
        for ($i = 0; $i < count($liste_besoin); $i++) {
            $besoin[$i] = ['value' => $liste_besoin[$i]];
        }

        if ($request->category_id == "autre") {
            // Vérifier si la catégorie existe déjà (insensible à la casse)
            $existingCategory = Category::whereRaw('LOWER(nom) = ?', [strtolower($request->categorie)])->first();
            if ($existingCategory) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['categorie' => 'Cette catégorie existe déjà. Veuillez choisir un autre nom.']);
            }
            $newCategory = Category::create([
                'nom' => $request->categorie,
                'slug' => Helpers::generateSlug(),
                'user_slug' => Auth::user()->slug,
            ]);
            $category_id = $newCategory->id;
        } else {
            $category_id = $request->category_id;
        }

        if ($request->type == "video") {
            $list_intitule = $request->intitule;
            $list_editordata_video = $request->editordata_video;
            for ($i = 0; $i < count($list_intitule); $i++) {
                $intitule[$i] = ['value' => $list_intitule[$i]];
            }

            $list_chapitre_description = $request->chapitre_description;
            for ($i = 0; $i < count($list_chapitre_description); $i++) {
                $chapitre_description[$i] = ['value' => $list_chapitre_description[$i]];
            }

            $list_video = $request->video;
            for ($i = 0; $i < count($list_video); $i++) {
                if ($list_video[$i]) {
                    $one_video = $list_video[$i];
                    $extensionVid = $one_video->getClientOriginalExtension();
                    $nomVideo = Str::random(10) . "-" . time() . '.' . $extensionVid;
                    $one_video->move(public_path($folderVideo), $nomVideo);
                    $destination_video = $folderVideo . $nomVideo;
                    $video[$i] = ['value' => $destination_video];
                }
            }

            for ($i = 0; $i < count($list_intitule); $i++) {
                $editordata_video = isset($list_editordata_video[$i]) ? htmlentities($list_editordata_video[$i]) : '';
                $chapitre[$i] = [
                    'num_chapitre' => $i,
                    'intitule' => $intitule[$i]['value'],
                    'chapitre_description' => $chapitre_description[$i]['value'],
                    'video_url' => $video[$i]['value'],
                    'editordata_video' => $editordata_video,
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
                'status' => "Valider",
                'category_id' => $category_id,
                'slug' => Helpers::generateSlug(),
            ]);

            $formation = Formation::where('user_slug', Auth::user()->slug)->orderBy('created_at', 'desc')->get();
            return view('Formateur.formations.show', compact('formation'));
        } else {
            $list_intitule = $request->intitule_texte;
            for ($i = 0; $i < count($list_intitule); $i++) {
                $intitule_texte[$i] = ['value' => $list_intitule[$i]];
            }

            $list_chapitre_description = $request->chapitre_description_texte;
            for ($i = 0; $i < count($list_chapitre_description); $i++) {
                $chapitre_descriptiond_texte[$i] = ['value' => $list_chapitre_description[$i]];
            }

            $list_chapitre_summernote = $request->editordata_texte;
            if (count($list_chapitre_summernote) == 0) {
                $chapitre_summernote[0] = ['value' => htmlentities($request->summernote)];
            } else {
                for ($i = 0; $i < count($list_chapitre_summernote); $i++) {
                    $chapitre_summernote[$i] = ['value' => htmlentities($list_chapitre_summernote[$i])];
                }
            }

            for ($i = 0; $i < count($list_intitule); $i++) {
                $chapitre[$i] = [
                    'num_chapitre' => $i,
                    'intitule' => $intitule_texte[$i]['value'],
                    'chapitre_description' => $list_chapitre_description[$i] ?? '',
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
                'status' => "Valider",
                'category_id' => $category_id,
                'slug' => Helpers::generateSlug(),
            ]);

            $formation = Formation::where('user_slug', Auth::user()->slug)->orderBy('created_at', 'desc')->get();
        session()->flash('success', 'Formation ajoutée avec succès.');
            return view('Formateur.formations.show', compact('formation'));
        }
    }

    public function show($slug)
    {
        $formation = Formation::where('user_slug', $slug)->orderBy('created_at', 'desc')->get();

        return view('Formateur.formations.show', compact('formation'));
    }

    public function course_detail($slug)
    {
        $formation = Formation::where('slug', $slug)->first();
        return view('Formateur.formations.course_detail', compact('formation'));
    }

    public function apprenant_course_detail($slug)
    {
        $formation = Formation::where('slug', $slug)->first();
        $enseignant = User::where('slug', $formation->user_slug)->first();
        $fmt_meme_categorie = Formation::where('category_id', $formation->category_id)->get();
        return view('front.course-single', compact('formation', 'enseignant', 'fmt_meme_categorie'));
    }

    public function edit($slug)
    {
        $formation = Formation::where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        $formation->contenus = json_decode($formation->contenu, true) ?? [];
        $formation->competences = json_decode($formation->competence, true) ?? [];
        $formation->besoins = json_decode($formation->besoin, true) ?? [];
        $chapters = json_decode($formation->chapitre, true) ?? [];
        return view('Formateur.formations.edit', compact('formation', 'categories', 'chapters'));
    }

   public function update(Request $request, $id)
{
    try {
        $formation = Formation::findOrFail($id);

        if ($formation->user_slug !== Auth::user()->slug) {
            abort(403, 'Non autorisé');
        }

        \Log::info('Données reçues dans la requête : ', $request->all());

        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'photo_type' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'payante_ou_non' => 'required|in:Oui,Non',
            'prix_formation' => 'required_if:payante_ou_non,Oui|nullable|numeric|min:0',
            'prix_certification' => 'nullable|numeric|min:0',
            'duree' => 'required|string|max:255',
            'category_id' => 'required',
            'categorie' => 'nullable|required_if:category_id,autre|string|max:255',
            'contenu.*' => 'nullable|string|max:255',
            'competence.*' => 'nullable|string|max:255',
            'besoin.*' => 'nullable|string|max:255',
            'a_propos' => 'required|string',
            'type' => 'required|in:video,texte',
            'intitule.*' => 'nullable|string|max:255',
            'chapitre_description.*' => 'nullable|string',
            'editordata_texte.*' => 'nullable|string',
        ];

        if ($request->type == 'video') {
            foreach ($request->input('intitule', []) as $i => $titre) {
                $oldVideo = $request->input('old_video_url')[$i] ?? null;
                // Si pas d'ancienne vidéo, la nouvelle est requise
                $rules["video.$i"] = $oldVideo ? 'nullable|file|mimes:mp4,mov,avi|max:102400' : 'required|file|mimes:mp4,mov,avi|max:102400';
                $rules["intitule.$i"] = 'required|string|max:255';
                $rules["chapitre_description.$i"] = 'required|string';
            }
        }

        $validatedData = $request->validate($rules, [
            'title.required' => 'Le titre est requis.',
            'description.required' => 'La description est requise.',
            'type.required' => 'Le type est requis.',
            'video.*.required' => 'La vidéo est requise pour chaque chapitre sans vidéo existante.',
        ]);

        \Log::info('Validation passée');

        $folderVideo = "/Video/";
        $folderImage = "/images/";
        $category_id = $request->category_id;

        $destination_photo = $formation->image_url;
        if ($request->hasFile('photo_type')) {
            if ($formation->image_url && file_exists(public_path($formation->image_url))) {
                unlink(public_path($formation->image_url));
            }
            $formation_image = $request->file('photo_type');
            $nomphoto = Str::random(10) . "-" . time() . '.png';
            $formation_image->move(public_path($folderImage), $nomphoto);
            $destination_photo = $folderImage . $nomphoto;
        }

        if ($request->category_id == "autre") {
            // Vérifier si la catégorie existe déjà (insensible à la casse)
            $existingCategory = Category::whereRaw('LOWER(nom) = ?', [strtolower($request->categorie)])->first();
            if ($existingCategory) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['categorie' => 'Cette catégorie existe déjà. Veuillez choisir un autre nom.']);
            }
            $newCategory = Category::create([
                'nom' => $request->categorie,
                'slug' => Helpers::generateSlug(),
                'user_slug' => Auth::user()->slug,
            ]);
            $category_id = $newCategory->id;
        }

        $contenu = [];
        if ($request->contenu) {
            foreach ($request->contenu as $index => $value) {
                if (!empty($value)) {
                    $contenu[] = ['value' => $value];
                }
            }
        }

        $competence = [];
        if ($request->competence) {
            foreach ($request->competence as $index => $value) {
                if (!empty($value)) {
                    $competence[] = ['value' => $value];
                }
            }
        }

        $besoin = [];
        if ($request->besoin) {
            foreach ($request->besoin as $index => $value) {
                if (!empty($value)) {
                    $besoin[] = ['value' => $value];
                }
            }
        }

        $chapitre = [];
        $existing_chapters = json_decode($formation->chapitre, true) ?? [];

        if ($request->type == "video") {
            foreach ($request->intitule as $index => $intitule) {
                if (!empty($intitule)) {
                    $video_url = $request->input('old_video_url')[$index] ?? null;
                    if ($request->hasFile("video.$index")) {
                        // Supprimer l'ancienne vidéo si besoin
                        if ($video_url && file_exists(public_path($video_url))) {
                            unlink(public_path($video_url));
                        }
                        $one_video = $request->file("video.$index");
                        $extensionVid = $one_video->getClientOriginalExtension();
                        $nomVideo = Str::random(10) . "-" . time() . '.' . $extensionVid;
                        $one_video->move(public_path($folderVideo), $nomVideo);
                        $video_url = $folderVideo . $nomVideo;
                    }
                    $editordata_video = isset($request->editordata_video[$index]) ? htmlentities($request->editordata_video[$index]) : '';
                    $chapitre[] = [
                        'num_chapitre' => $index,
                        'intitule' => $intitule,
                        'chapitre_description' => $request->chapitre_description[$index] ?? '',
                        'video_url' => $video_url,
                        'editordata_video' => $editordata_video,
                    ];
                }
            }
        } else {
            if ($request->intitule_texte) {
                foreach ($request->intitule_texte as $index => $intitule) {
                    if (!empty($intitule)) {
                        $summernote = isset($existing_chapters[$index]) ? $existing_chapters[$index]['summernote'] : '';
                        if (isset($request->editordata_texte[$index]) && !empty($request->editordata_texte[$index])) {
                            $summernote = htmlentities($request->editordata_texte[$index]);
                        }
                        $chapitre[] = [
                            'num_chapitre' => $index,
                            'intitule' => $intitule,
                            'chapitre_description' => $request->chapitre_description_texte[$index] ?? ($existing_chapters[$index]['chapitre_description'] ?? ''),
                            'summernote' => $summernote,
                        ];
                    }
                }
            }
        }

        $data = [
            'titre' => $request->title,
            'type' => $request->type,
            'description' => $request->description,
            'image_url' => $destination_photo,
            'payante_ou_non' => $request->payante_ou_non,
            'prix_formation' => $request->payante_ou_non == 'Oui' ? $request->prix_formation : null,
            'prix_certification' => $request->prix_certification ?? null,
            'duree' => $request->duree,
            'contenu' => json_encode($contenu),
            'competence' => json_encode($competence),
            'besoin' => json_encode($besoin),
            'a_propos' => $request->a_propos,
            'chapitre' => json_encode($chapitre),
            'category_id' => $category_id,
        ];

        \Log::info('Données à mettre à jour : ', $data);
        $result = $formation->update($data);
        \Log::info('Résultat update : ' . ($result ? 'OK' : 'FAIL'));

        if ($result) {
            \Log::info('Mise à jour réussie pour la formation ID : ' . $id);
        } else {
            \Log::warning('Mise à jour échouée pour la formation ID : ' . $id);
        }

        $formation = Formation::where('user_slug', Auth::user()->slug)
    ->orderBy('created_at', 'desc')
    ->get();
    session()->flash('success', 'Formation mise à jour avec succès.');
return view('Formateur.formations.show', compact('formation'));

    } catch (\ValidationException $e) {
        \Log::error('Erreur de validation : ', $e->validator->errors()->all());
        return redirect()->back()->withErrors($e->validator)->withInput();
    } catch (\Exception $e) {
        \Log::error('Erreur lors de la mise à jour : ' . $e->getMessage());
        return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour. Veuillez réessayer.');
    }
}

    public function destroy($slug)
    {
        $formation = Formation::where('slug', $slug)->firstOrFail();
        $userSlug = $formation->user_slug;
        $formation->delete();
        return Redirect::route('formations.show', $userSlug)->with('success', 'La formation a été supprimée avec succès.');
    }
}
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
            Category::create([
                'nom' => $request->categorie,
                'slug' => Helpers::generateSlug(),
                'user_slug' => Auth::user()->slug,
            ]);
            $category_id = DB::table('categories')->latest('id')->value('id');
        } else {
            $category_id = $request->category_id;
        }

        if ($request->type == "video") {
            $list_intitule = $request->intitule;
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
                $chapitre[$i] = [
                    'num_chapitre' => $i,
                    'intitule' => $intitule[$i]['value'],
                    'chapitre_description' => $chapitre_description[$i]['value'],
                    'video_url' => $video[$i]['value'],
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
                'status' => "Pending",
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

            $list_chapitre_description = $request->chapitre_descriptiond_texte;
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

            $formation = Formation::where('user_slug', Auth::user()->slug)->orderBy('created_at', 'desc')->get();
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
        $formation = Formation::findOrFail($id);
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

        // Validate input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'photo_type' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'payante_ou_non' => 'required|in:Oui,Non',
            'prix_formation' => 'nullable|numeric|min:0',
            'prix_certification' => 'nullable|numeric|min:0',
            'duree' => 'required|string|max:255',
            'category_id' => 'required',
            'categorie' => 'required_if:category_id,autre|string|max:255',
            'contenu.*' => 'required|string|max:255',
            'competence.*' => 'required|string|max:255',
            'besoin.*' => 'required|string|max:255',
            'a_propos' => 'required|string',
            'type' => 'required|in:video,texte',
            'intitule.*' => 'required_if:type,video|string|max:255',
            'chapitre_description.*' => 'required_if:type,video|string',
            'video.*' => 'nullable|file|mimes:mp4,mov,avi|max:102400',
            'intitule_texte.*' => 'required_if:type,texte|string|max:255',
            'chapitre_descriptiond_texte.*' => 'required_if:type,texte|string',
            'editordata_texte.*' => 'required_if:type,texte|string',
        ]);

        // Handle image upload
        if ($request->hasFile('photo_type')) {
            $formation_image = $request->file('photo_type');
            $nomphoto = Str::random(10) . "-" . time() . '.png';
            $formation_image->move(public_path($folderImage), $nomphoto);
            $destination_photo = $folderImage . $nomphoto;
        } else {
            $destination_photo = $formation->image_url;
        }

        // Handle contenu
        $liste_contenu = $request->contenu;
        for ($i = 0; $i < count($liste_contenu); $i++) {
            $contenu[$i] = ['value' => $liste_contenu[$i]];
        }

        // Handle competence
        $liste_competence = $request->competence;
        for ($i = 0; $i < count($liste_competence); $i++) {
            $competence[$i] = ['value' => $liste_competence[$i]];
        }

        // Handle besoin
        $liste_besoin = $request->besoin;
        for ($i = 0; $i < count($liste_besoin); $i++) {
            $besoin[$i] = ['value' => $liste_besoin[$i]];
        }

        // Handle category
        if ($request->category_id == "autre") {
            Category::create([
                'nom' => $request->categorie,
                'slug' => Helpers::generateSlug(),
                'user_slug' => Auth::user()->slug,
            ]);
            $category_id = DB::table('categories')->latest('id')->value('id');
        } else {
            $category_id = $request->category_id;
        }

        if ($request->type == "video") {
            $list_intitule = $request->intitule;
            for ($i = 0; $i < count($list_intitule); $i++) {
                $intitule[$i] = ['value' => $list_intitule[$i]];
            }

            $list_chapitre_description = $request->chapitre_description;
            for ($i = 0; $i < count($list_chapitre_description); $i++) {
                $chapitre_description[$i] = ['value' => $list_chapitre_description[$i]];
            }

            $list_video = $request->video;
            $existing_chapters = json_decode($formation->chapitre, true) ?? [];
            for ($i = 0; $i < count($list_intitule); $i++) {
                if (isset($list_video[$i]) && $list_video[$i]) {
                    $one_video = $list_video[$i];
                    $extensionVid = $one_video->getClientOriginalExtension();
                    $nomVideo = Str::random(10) . "-" . time() . '.' . $extensionVid;
                    $one_video->move(public_path($folderVideo), $nomVideo);
                    $destination_video = $folderVideo . $nomVideo;
                    $video[$i] = ['value' => $destination_video];
                } else {
                    $video[$i] = ['value' => $existing_chapters[$i]['video_url'] ?? ''];
                }
            }

            for ($i = 0; $i < count($list_intitule); $i++) {
                $chapitre[$i] = [
                    'num_chapitre' => $i,
                    'intitule' => $intitule[$i]['value'],
                    'chapitre_description' => $chapitre_description[$i]['value'],
                    'video_url' => $video[$i]['value'],
                ];
            }

            $formation->update([
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
                'category_id' => $category_id,
            ]);
        } else {
            $list_intitule = $request->intitule_texte;
            for ($i = 0; $i < count($list_intitule); $i++) {
                $intitule_texte[$i] = ['value' => $list_intitule[$i]];
            }

            $list_chapitre_description = $request->chapitre_descriptiond_texte;
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
                    'chapitre_description' => $chapitre_descriptiond_texte[$i]['value'],
                    'summernote' => $chapitre_summernote[$i]['value'],
                ];
            }

            $formation->update([
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
                'category_id' => $category_id,
            ]);
        }

        $formation = Formation::where('user_slug', Auth::user()->slug)->orderBy('created_at', 'desc')->get();
        return view('Formateur.formations.show', compact('formation'))->with('success', 'Formation mise à jour avec succès.');
    }

    public function destroy($slug)
    {
        $formation = Formation::where('slug', $slug)->firstOrFail();
        $userSlug = $formation->user_slug;
        $formation->delete();
        return Redirect::route('formations.show', $userSlug)->with('success', 'La formation a été supprimée avec succès.');
    }
}
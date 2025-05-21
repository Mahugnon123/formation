<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Requete;
use App\Models\Formation;
use App\Models\ForumReponse;
use App\Models\User;
use App\Models\UserFormation;
use App\Helpers;
use Illuminate\Support\Str;

class RequeteController extends Controller
{
    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formations = [];
        $formation_iscrt = [];
        $reponse = [];
        $formation_all = Formation::all();
        $userfmt = UserFormation::where('user_id', auth()->user()->id)->first();
        $requetes = Requete::where('user_id', auth()->user()->id)->get();
        $users = Helpers::seachUserById();

        if ($requetes && !$requetes->isEmpty()) {
            foreach ($requetes as $requete) {
                $reponse[$requete->id] = ForumReponse::where('requete_id', $requete->id)->get();
                $formations[$requete->id] = Formation::where('id', $requete->formation_id)->first();
            }
        }

        if ($userfmt && $userfmt->formations) {
            $formation_inscrites = is_array($userfmt->formations) ? $userfmt->formations : json_decode($userfmt->formations, true);
            foreach ($formation_all as $formation) {
                foreach ($formation_inscrites as $fmt) {
                    if ($formation->id == $fmt['id']) {
                        $formation_iscrt[] = $formation;
                    }
                }
            }
        }

        return view('Apprenant.formations.question', compact('requetes', 'formations', 'formation_iscrt', 'reponse', 'users'));
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
        Requete::create([
            'nom' => $request->titre,
            'description' => $request->description,
            'user_id' => auth()->user()->id,
            'formation_id' => $request->fmt_id,
            'slug' => Helpers::generateSlug(),
        ]);
        return redirect()->back()->with('message', 'Requete creer avec succes');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // Extraire le nom après le tiret, si présent
        $nom = strpos($slug, '-') !== false ? substr($slug, strpos($slug, '-') + 1) : $slug;

        $requete = Requete::where('slug', $slug)->orWhere('nom', $nom)->first();
        if (!$requete) {
            abort(404, 'Requête non trouvée');
        }

        $enseignant = Formation::where('id', $requete->formation_id)->first();
        if (!$enseignant) {
            abort(404, 'Formation non trouvée');
        }

        $reponses = ForumReponse::where('requete_id', $requete->id)->get();
        $responses_no_parent = ForumReponse::where([
            ['requete_id', $requete->id],
            ['parent_id', null]
        ])->get();
        $enseignant = User::where('slug', $enseignant->user_slug)->first();
        if (!$enseignant) {
            abort(404, 'Enseignant non trouvé');
        }

        $users = Helpers::seachUserById();

        $role = auth()->user()->role_id ?? 0; // Ajuste selon ta logique de rôles (ex. 2 pour formateur, 1 pour apprenant)
    if ($role == 2) { // Formateur
        return view('Formateur.formations.forum', compact('requete', 'reponses', 'users', 'enseignant', 'responses_no_parent'));
    } else { // Apprenant ou autre
        return view('Apprenant.formations.forum', compact('requete', 'reponses', 'users', 'enseignant', 'responses_no_parent'));
    }
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
            'nom' => $request->nom,
            'description' => $request->description,
            'user_id' => auth()->user()->id,
            'formation_id' => $request->fmt_id,
        ]);

        return redirect('/apprenant-requete')->with('message', 'Requete mise à jour avec succes');
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
        if ($total_checked && is_array($total_checked)) {
            foreach ($total_checked as $id) {
                $requete = Requete::where('id', $id)->first();
                if ($requete) {
                    $requete->delete();
                }
            }
        }

        return redirect()->back()->with('message', 'Requete(s) supprimée(s) avec succes');
    }

    public function indexFormateur()
    {
        $formateur = auth()->user();
        $formations = Formation::where('user_slug', $formateur->slug)->get();
        $requetes = Requete::with(['user', 'formation', 'reponses'])
            ->whereIn('formation_id', $formations->pluck('id'))
            ->get();

        $reponse = [];
        $formations_associees = [];
        $users = Helpers::seachUserById();

        foreach ($requetes as $requete) {
            $reponse[$requete->id] = $requete->reponses;
            $formations_associees[$requete->id] = $requete->formation;
        }

        return view('Formateur.requetes.index', compact('requetes', 'formations_associees', 'reponse', 'users'));
    }

    public function storeReponse(Request $request)
    {
        $validated = $request->validate([
            'requete_id' => 'required|exists:requetes,id',
            'description' => 'required|string|max:1000',
        ]);

        ForumReponse::create([
            'requete_id' => $request->requete_id,
            'user_id' => auth()->user()->id,
            'description' => $request->description,
            'slug' => Helpers::generateSlug(),
            'parent_id' => null,
        ]);

        return redirect()->route('formateur.requetes.index')->with('message', 'Réponse envoyée avec succès');
    }
    public function updateReponse(Request $request, $id)
{
    $reponse = ForumReponse::findOrFail($id);
    if (auth()->id() !== $reponse->user_id) {
        return response()->json(['success' => false], 403);
    }
    $reponse->update(['description' => $request->description]);
    return response()->json(['success' => true]);
}


public function storeOrUpdateResponse(Request $request)
{
    \Log::info('Méthode storeOrUpdateResponse appelée', ['request' => $request->all()]);

    $validated = $request->validate([
        'description' => 'required|string|max:1000',
        'requete_slug' => 'required|exists:requetes,slug',
        'parent_id' => 'nullable|exists:forum_reponses,slug',
        'response_id' => 'nullable|exists:forum_reponses,id',
    ]);

    try {
        if ($request->response_id) {
            $reponse = ForumReponse::findOrFail($request->response_id);
            if (auth()->id() !== $reponse->user_id) {
                return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à modifier cette réponse.');
            }
            $reponse->update(['description' => $request->description]);
            \Log::info('Réponse mise à jour avec succès', ['response_id' => $reponse->id]);
            return redirect()->back()->with('message', 'Réponse modifiée avec succès');
        } else {
            $requete = Requete::where('slug', $request->requete_slug)->firstOrFail();
            $parentReponse = $request->parent_id ? ForumReponse::where('slug', $request->parent_id)->first() : null;
            $parentId = $parentReponse ? $parentReponse->id : null;

            $reponseData = [
                'requete_id' => $requete->id,
                'user_id' => auth()->user()->id,
                'description' => $request->description,
                'slug' => Helpers::generateSlug(),
                'parent_id' => $parentId,
            ];

            $reponse = ForumReponse::create($reponseData);
            \Log::info('Réponse créée avec succès', ['response_id' => $reponse->id, 'data' => $reponseData]);

            $reponseCheck = ForumReponse::find($reponse->id);
            if (!$reponseCheck) {
                \Log::error('Échec de la persistance dans la base de données', ['response_id' => $reponse->id]);
                return redirect()->back()->with('error', 'La réponse n\'a pas été enregistrée dans la base de données.');
            }
            \Log::info('Vérification après création', ['reponse_check' => $reponseCheck->toArray()]);
        }

        return redirect()->back()->with('message', 'Réponse envoyée avec succès');
    } catch (\Exception $e) {
        \Log::error('Erreur lors de l\'enregistrement de la réponse', [
            'error' => $e->getMessage(),
            'stack' => $e->getTraceAsString(),
            'request' => $request->all(),
        ]);
        return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'enregistrement : ' . $e->getMessage());
    }
}


public function deleteReponse($id)
{
    $reponse = ForumReponse::findOrFail($id);
    if (auth()->id() !== $reponse->user_id) {
        return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à supprimer cette réponse.');
    }
    $reponse->delete();
    return redirect()->back()->with('message', 'Réponse supprimée avec succès');
}
}
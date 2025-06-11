<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequeteFormateur;
use App\Models\ForumReponse;
use App\Helpers;
use Illuminate\Support\Str;

class RequeteFormateurController extends Controller
{
    /**
     * Display a listing of the formateur's private requests to the admin
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formateur = auth()->user();
        $requetes = RequeteFormateur::where('user_id', $formateur->id)->get();

        $reponse = [];
        $users = Helpers::seachUserById();

        foreach ($requetes as $requete) {
            $reponse[$requete->id] = ForumReponse::where('requete_id', $requete->id)->get();
        }

        return view('Formateur.requetes.create', compact('requetes', 'reponse', 'users'));
    }

    /**
     * Show the form for creating a new private request
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Formateur.requetes.create');
    }

    /**
     * Store a new private request from the formateur to the admin
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        RequeteFormateur::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'user_id' => auth()->user()->id,
            'slug' => Helpers::generateSlug(),
        ]);

        return redirect()->route('formateur.messages.index')->with('message', 'Requête créée avec succès');
    }

    /**
     * Display the specified private request
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $nom = strpos($slug, '-') !== false ? substr($slug, strpos($slug, '-') + 1) : $slug;
        $requete = RequeteFormateur::where('slug', $slug)->orWhere('titre', $nom)->first();

        if (!$requete || $requete->user_id !== auth()->user()->id) {
            abort(404, 'Requête non trouvée');
        }

        $reponses = ForumReponse::where('requete_id', $requete->id)->get();
        $users = Helpers::seachUserById();

        return view('Formateur.requetes.show', compact('requete', 'reponses', 'users'));
    }

    /**
     * Remove the specified resource from storage
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $total_checked = $request->input('total_checked') ? explode(',', $request->input('total_checked')) : [];

        if (!empty($total_checked) && is_array($total_checked)) {
            foreach ($total_checked as $id) {
                $requete = RequeteFormateur::where('id', $id)
                    ->where('user_id', auth()->user()->id)
                    ->first();
                if ($requete) {
                    $requete->delete();
                }
            }
        }

        return redirect()->route('formateur.messages.index')->with('message', 'Requête(s) supprimée(s) avec succès');
    }

    /**
     * Store or update a response to a private request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeOrUpdateResponse(Request $request)
    {
        \Log::info('Méthode storeOrUpdateResponse appelée', ['request' => $request->all()]);

        $validated = $request->validate([
            'description' => 'required|string|max:1000',
            'requete_slug' => 'required|exists:requete_formateurs,slug',
            'parent_id' => 'nullable|exists:forum_reponses,slug',
            'response_id' => 'nullable|exists:forum_reponses,id',
        ]);

        try {
            $requete = RequeteFormateur::where('slug', $request->requete_slug)->firstOrFail();
            $user = auth()->user();
            $adminId = 1; // ID de l'administrateur (ajustez selon votre base de données)
            $isFormateur = $user->role_id == 2; // Supposons que 2 est le role_id du formateur
            $isAdmin = $user->id == $adminId;

            // Autorisation : seuls le créateur (formateur) ou l'administrateur peuvent répondre
            if (!$isFormateur && !$isAdmin) {
                return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à répondre à cette requête.');
            }
            if ($isFormateur && $requete->user_id !== $user->id) {
                return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à répondre à cette requête.');
            }

            if ($request->response_id) {
                $reponse = ForumReponse::findOrFail($request->response_id);
                if ($user->id !== $reponse->user_id) {
                    return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à modifier cette réponse.');
                }
                $reponse->update(['description' => $request->description]);
                \Log::info('Réponse mise à jour avec succès', ['response_id' => $reponse->id]);
                return redirect()->back()->with('message', 'Réponse modifiée avec succès');
            } else {
                $parentReponse = $request->parent_id ? ForumReponse::where('slug', $request->parent_id)->first() : null;
                $parentId = $parentReponse ? $parentReponse->id : null;

                $reponseData = [
                    'requete_id' => $requete->id,
                    'user_id' => $user->id,
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
            return redirect()->back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }

    /**
     * Delete a response to a private request
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteReponse($id)
    {
        $reponse = ForumReponse::findOrFail($id);
        if (auth()->id() !== $reponse->user_id) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à supprimer cette réponse.');
        }
        $reponse->delete();
        return redirect()->back()->with('message', 'Réponse supprimée avec succès');
    }

// Admin methods for managing formateur requests
public function adminIndex()
{
    // Affiche la liste des requêtes pour l'admin
    $requetes = RequeteFormateur::latest()->get();
    $users = Helpers::seachUserById();
    $formations_associees = []; // à remplir si besoin
    $reponse = []; // à remplir si besoin

    foreach ($requetes as $requete) {
        $reponse[$requete->id] = ForumReponse::where('requete_id', $requete->id)->get();
        // $formations_associees[$requete->id] = ... (ta logique ici)
    }

    return view('Admin.request_formateur', compact('requetes', 'users', 'formations_associees', 'reponse'));
}

public function adminShow($slug)
{
    $requete = RequeteFormateur::where('slug', $slug)->firstOrFail();
    $reponses = ForumReponse::where('requete_id', $requete->id)->get();
    $users = Helpers::seachUserById();

return view('Admin.discusssion', [
    'requete' => $requete,
    'reponses' => $reponses,
    'users' => $users
]);

}

public function adminStoreOrUpdateResponse(Request $request, $id)
{
    \Log::info('Méthode adminStoreOrUpdateResponse appelée', ['request' => $request->all()]);

   $validated = $request->validate([
    'description' => 'required|string|max:1000',
    'parent_id' => 'nullable|string', // contient un SLUG, on le traite ensuite
    'response_id' => 'nullable|exists:forum_reponses,id',
]);



    try {
        $requete = RequeteFormateur::findOrFail($id);
        $user = auth()->user();

        // Autorisation : seul l'admin peut répondre ici
        if ($user->role_id != 3) {
            return redirect()->back()->with('error', 'Seul l\'administrateur peut répondre ici.');
        }

        if ($request->response_id) {
            // Modification
            $reponse = ForumReponse::findOrFail($request->response_id);
            $reponse->update(['description' => $request->description]);
            return redirect()->route('admin.request.show', $requete->slug)->with('message', 'Réponse modifiée avec succès');
        } else {
            // Création
            $parentReponse = $request->parent_id ? ForumReponse::where('slug', $request->parent_id)->first() : null;
            $parentId = $parentReponse ? $parentReponse->id : null;

          ForumReponse::create([
    'requete_id' => $requete->id,
    'user_id' => $user->id,
    'description' => $request->description,
    'slug' => \App\Helpers::generateSlug(),
    'parent_id' => $parentId,
]);

            return redirect()->route('admin.request.show', $requete->slug)->with('message', 'Réponse envoyée avec succès');
        }
    } catch (\Exception $e) {
        \Log::error('Erreur admin réponse', [
            'error' => $e->getMessage(),
            'stack' => $e->getTraceAsString(),
            'request' => $request->all(),
        ]);
        return redirect()->back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
    }
}
public function adminDeleteReponse($id)
{
    $reponse = ForumReponse::findOrFail($id);
    // Seul l'admin ou l'auteur peut supprimer
    if (auth()->user()->role_id == 1 || auth()->id() == $reponse->user_id) {
        $reponse->delete();
        return back()->with('message', 'Réponse supprimée avec succès');
    }
    abort(403, 'Non autorisé');
}

public function updateResponse(Request $request, $id)
{
    try {
        $validated = $request->validate([
            'description' => 'required|string|max:1000',
        ]);

        $reponse = ForumReponse::findOrFail($id);

        // Autorisation : seul l'auteur ou l'admin peut modifier
        if (auth()->id() !== $reponse->user_id && auth()->user()->role_id != 3) {
            return redirect()->back()->with('error', 'Non autorisé.');
        }

        $reponse->description = $validated['description'];
        $reponse->save();

        return redirect()->back()->with('message', 'Message modifié avec succès.');
    } catch (ValidationException $e) {
        return redirect()->back()->withErrors($e->errors())->withInput();
    } catch (ModelNotFoundException $e) {
        return redirect()->back()->with('error', 'Réponse non trouvée.');
    } catch (\Exception $e) {
        \Log::error('Erreur lors de la mise à jour de la réponse : ' . $e->getMessage());
        return redirect()->back()->with('error', 'Une erreur est survenue. Veuillez réessayer.');
    }
}
}
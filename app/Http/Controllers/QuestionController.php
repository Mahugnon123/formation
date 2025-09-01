<?php
namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\Question;
use App\Models\Reponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function index()
    {
        $formateur = Auth::user();
        $formations = Formation::where('user_slug', $formateur->slug)->get();
        return view('formateur.questions.index', compact('formations'));
    }

    public function show(Formation $formation)
    {
        $formateur = Auth::user();
        if ($formation->user_slug !== $formateur->slug) {
            abort(403, 'Accès non autorisé.');
        }

        $questions = Question::where('formation_id', $formation->id)
            ->with('reponses')
            ->orderBy('created_at', 'desc') 
            ->get();

        return view('formateur.questions.show', compact('formation', 'questions'));
    }

    public function create(Formation $formation)
    {
        $formateur = Auth::user();
        if ($formation->user_slug !== $formateur->slug) {
            abort(403, 'Accès non autorisé.');
        }

        return view('formateur.questions.create', compact('formation'));
    }

public function store(Request $request, $slug)
{
    $formation = Formation::where('slug', $slug)->firstOrFail();

    // Validation des données avec condition spécifique
    $validated = $request->validate([
        'type' => 'required|in:Vrai/Faux,QCM',
        'titre' => 'required|string|max:500',
        'description' => 'required|string',
    ]);

    // Validation conditionnelle pour correct_option
    if ($request->type === 'Vrai/Faux') {
        $validated['correct_option'] = $request->validate([
            'correct_option' => 'required|in:Vrai,Faux',
        ])['correct_option'];
    } elseif ($request->type === 'QCM') {
        $correctOption = $request->input('correct_option', []); // Récupérer le tableau, vide par défaut
        if (empty($correctOption)) {
            return back()->withErrors(['correct_option' => 'Veuillez sélectionner au moins une réponse correcte.']);
        }
        $validated['correct_option'] = $request->validate([
            'correct_option' => 'array',
            'correct_option.*' => 'integer|min:0',
        ])['correct_option'];

        $validated['options'] = $request->validate([
            'options' => 'required|array|min:2',
            'options.*' => 'required|string',
        ])['options'];

        // Vérifier que les indices sont valides
        $maxIndex = count($validated['options']) - 1;
        foreach ($validated['correct_option'] as $index) {
            if ($index > $maxIndex || $index < 0) {
                return back()->withErrors(['correct_option' => 'Un ou plusieurs indices de réponses correctes sont invalides.']);
            }
        }
    }

    // Vérification d'autorisation
    $formateur = auth()->user();
    if ($formation->user_slug !== $formateur->slug) {
        abort(403, 'Accès non autorisé.');
    }

    try {
        // Création de la question
        $question = new Question();
        $question->titre = $validated['titre'];
        $question->description = $validated['description'];
        $question->type = $validated['type'];
        $question->formation_id = $formation->id;
        $question->user_id = auth()->id();

        $question->save();

        // Gestion des réponses
        if ($request->type === 'QCM') {
            $correctResponseIds = [];
            foreach ($validated['options'] as $index => $text) {
                $isCorrect = in_array($index, $validated['correct_option']);
                $reponse = Reponse::create([
                    'question_id' => $question->id,
                    'text' => $text,
                    'is_correct' => $isCorrect ? 1 : 0,
                    'commentaires' => $isCorrect ? 'Correcte' : 'Incorrecte',
                ]);

                if ($isCorrect) {
                    $correctResponseIds[] = $reponse->id;
                }
            }
            // Stocker les IDs des réponses correctes sous forme de JSON
            $question->update(['reponse_correcte' => json_encode($correctResponseIds)]);
        } elseif ($request->type === 'Vrai/Faux') {
            // Créer les deux réponses
            $reponseVrai = Reponse::create([
                'question_id' => $question->id,
                'text' => 'Vrai',
                'is_correct' => ($validated['correct_option'] === 'Vrai') ? 1 : 0,
                'commentaires' => ($validated['correct_option'] === 'Vrai') ? 'Correcte' : 'Incorrecte',
            ]);

            $reponseFaux = Reponse::create([
                'question_id' => $question->id,
                'text' => 'Faux',
                'is_correct' => ($validated['correct_option'] === 'Faux') ? 1 : 0,
                'commentaires' => ($validated['correct_option'] === 'Faux') ? 'Correcte' : 'Incorrecte',
            ]);

            // Mettre à jour reponse_correcte avec l'ID de la réponse correcte
            $correctResponseId = ($validated['correct_option'] === 'Vrai') ? $reponseVrai->id : $reponseFaux->id;
            $question->update(['reponse_correcte' => $correctResponseId]);
        }

        return redirect()->route('formateur.questions.show', $formation->slug)
            ->with('success', 'Question ajoutée avec succès.');
    } catch (\Exception $e) {
        \Log::error('Erreur lors de l\'enregistrement de la question : ' . $e->getMessage());
        return back()->withErrors(['error' => 'Une erreur est survenue : ' . $e->getMessage()]);
    }
}



    public function edit(Formation $formation, Question $question)
{
    $formateur = Auth::user();
    if ($formation->user_slug !== $formateur->slug || $question->formation_id !== $formation->id) {
        abort(403, 'Accès non autorisé.');
    }

    $question->load('reponses'); // Charger les réponses avec la question
    return view('formateur.questions.edit', compact('formation', 'question'));
}

     public function update(Request $request, $slug, $id)
{
    $formation = Formation::where('slug', $slug)->firstOrFail();
    $question = Question::findOrFail($id);

    // Vérification d'autorisation
    $formateur = auth()->user();
    if ($formation->user_slug !== $formateur->slug || $question->formation_id !== $formation->id) {
        abort(403, 'Accès non autorisé.');
    }

    // Validation des données
    $validated = $request->validate([
        'type' => 'required|in:Vrai/Faux,QCM',
        'titre' => 'required|string|max:500',
        'description' => 'required|string',
    ]);

    if ($request->type === 'Vrai/Faux') {
        $validated['correct_option'] = $request->validate([
            'correct_option' => 'required|in:Vrai,Faux',
        ])['correct_option'];
    } elseif ($request->type === 'QCM') {
        $validated['options'] = $request->validate([
            'options' => 'required|array|min:2',
            'options.*' => 'required|string',
        ])['options'];

        $correctOption = $request->input('correct_option', []);
        if (!is_array($correctOption) || empty($correctOption)) {
            return back()->withErrors(['correct_option' => 'Vous devez sélectionner au moins une réponse correcte pour un QCM.']);
        }

        $validated['correct_option'] = array_map('intval', array_filter($correctOption, 'is_numeric'));
        $maxIndex = count($validated['options']) - 1;
        foreach ($validated['correct_option'] as $index) {
            if ($index > $maxIndex || $index < 0) {
                return back()->withErrors(['correct_option' => 'Un ou plusieurs indices de réponses correctes sont invalides.']);
            }
        }
    }

    try {
        // Mettre à jour la question
        $question->update([
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'type' => $validated['type'],
        ]);

        // Supprimer les anciennes réponses
        $question->reponses()->delete();

        // Gestion des nouvelles réponses
        if ($request->type === 'QCM') {
            $correctResponseIds = [];
            foreach ($validated['options'] as $index => $text) {
                $isCorrect = in_array($index, $validated['correct_option']);
                $reponse = Reponse::create([
                    'question_id' => $question->id,
                    'text' => $text,
                    'is_correct' => $isCorrect ? 1 : 0,
                    'commentaires' => $isCorrect ? 'Correcte' : 'Incorrecte',
                ]);

                if ($isCorrect) {
                    $correctResponseIds[] = $reponse->id;
                }
            }
            $question->update(['reponse_correcte' => json_encode($correctResponseIds)]);
        } elseif ($request->type === 'Vrai/Faux') {
            $reponseVrai = Reponse::create([
                'question_id' => $question->id,
                'text' => 'Vrai',
                'is_correct' => ($validated['correct_option'] === 'Vrai') ? 1 : 0,
                'commentaires' => ($validated['correct_option'] === 'Vrai') ? 'Correcte' : 'Incorrecte',
            ]);

            $reponseFaux = Reponse::create([
                'question_id' => $question->id,
                'text' => 'Faux',
                'is_correct' => ($validated['correct_option'] === 'Faux') ? 1 : 0,
                'commentaires' => ($validated['correct_option'] === 'Faux') ? 'Correcte' : 'Incorrecte',
            ]);

            $correctResponseId = ($validated['correct_option'] === 'Vrai') ? $reponseVrai->id : $reponseFaux->id;
            $question->update(['reponse_correcte' => $correctResponseId]);
        }

        return redirect()->route('formateur.questions.show', $formation->slug)
            ->with('success', 'Question mise à jour avec succès.');
    } catch (\Exception $e) {
        \Log::error('Erreur lors de la mise à jour de la question : ' . $e->getMessage());
        return back()->withErrors(['error' => 'Une erreur est survenue : ' . $e->getMessage()]);
    }
}

    public function destroy(Formation $formation, Question $question)
    {
        $formateur = Auth::user();
        if ($formation->user_slug !== $formateur->slug || $question->formation_id !== $formation->id) {
            abort(403, 'Accès non autorisé.');
        }

        $question->reponses()->delete();
        $question->delete();

        return redirect()->route('formateur.questions.show', $formation->slug)
            ->with('success', 'Question supprimée avec succès.');
    }
   

}

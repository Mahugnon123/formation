<?php

namespace App\Http\Controllers;

use App\Models\Progression;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressionController extends Controller
{
   
public function getProgression(Request $request)
{
    $progression = Progression::where('user_id', Auth::id())
        ->where('formation_id', $request->formation_id)
        ->first();

    if ($progression) {
        return response()->json([
            'chapitres' => $progression->chapitres_completes,
            'chapitre_courant' => $progression->chapitre_courant
        ]);
    }

    return response()->json([
        'chapitres' => [],
        'chapitre_courant' => 0
    ]);
}

    public function updateProgression(Request $request)
    {
        try {
            // Vérifier que les données requises sont présentes
            if (!$request->has('fmt') || !$request->has('progress')) {
                return response()->json(['error' => 'Données manquantes'], 400);
            }

            // Récupérer la formation pour obtenir le nombre total de chapitres
            $formation = \App\Models\Formation::find($request->fmt);
            if (!$formation) {
                return response()->json(['error' => 'Formation non trouvée'], 404);
            }

            // Récupérer ou créer la progression
            $progression = Progression::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'formation_id' => $request->fmt
                ],
                [
                    'chapitre_courant' => $request->progress
                ]
            );

            // Gérer les chapitres complétés
            $chapitresCompletes = [];
            if ($request->has('chapitres')) {
                $chapitresCompletes = json_decode($request->chapitres, true) ?? [];
            }

            // Ajouter le chapitre courant s'il n'est pas déjà dans la liste
            if (!in_array($request->progress, $chapitresCompletes)) {
                $chapitresCompletes[] = $request->progress;
                sort($chapitresCompletes); // Trier les chapitres
            }

            // Calculer le pourcentage de progression
            $chapitres = (is_array($formation->chapitre)) ? $formation->chapitre : json_decode($formation->chapitre, true);
            $totalChapitres = count($chapitres);
            $pourcentageProgression = 0;
            
            if ($totalChapitres > 0) {
                $pourcentageProgression = min(100, (count($chapitresCompletes) * 100) / $totalChapitres);
                $pourcentageProgression = round($pourcentageProgression, 2);
            }

            // Mettre à jour les chapitres complétés et le pourcentage
            $progression->chapitres_completes = json_encode($chapitresCompletes);
            $progression->pourcentage_progression = $pourcentageProgression;
            $progression->save();

            return response()->json([
                'success' => true,
                'chapitres_completes' => $chapitresCompletes,
                'chapitre_courant' => $request->progress,
                'pourcentage_progression' => $pourcentageProgression
            ]);

        } catch (\Exception $e) {
            \Log::error('Erreur dans updateProgression: ' . $e->getMessage());
            return response()->json(['error' => 'Une erreur est survenue'], 500);
        }
    }
} 
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
            'chapitres' => '',
            'chapitre_courant' => 0
        ]);
    }

    public function updateProgression(Request $request)
    {
        $progression = Progression::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'formation_id' => $request->fmt
            ],
            [
                'chapitre_courant' => $request->progress,
                'chapitres_completes' => $request->chapitres
            ]
        );

        return response()->json(['success' => true]);
    }
} 
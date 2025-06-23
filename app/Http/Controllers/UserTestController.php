<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserTest;
use Illuminate\Support\Facades\Auth;
use App\Models\Certification;
use Carbon\Carbon;

class UserTestController extends Controller
{
    public function store(Request $request)
    {
        
        $request->validate([
            'formation_id' => 'required|exists:formations,id',
            'taux' => 'required|integer|min:0|max:100',
        ]);

        $user = Auth::user();
        $formationId = $request->formation_id;
        $taux = $request->taux;

        // Vérifie si déjà validé
        $existing = \App\Models\UserTest::where('user_id', $user->id)
            ->where('formation_id', $formationId)
            ->where('status', 'Validé')
            ->first();

        if ($existing) {
            return response()->json(['success' => false, 'message' => 'Test déjà validé, vous ne pouvez plus le repasser.'], 403);
        }

        $status = $taux >= 80 ? 'Validé' : 'Non validé';

        \App\Models\UserTest::updateOrCreate(
            [
                'user_id' => $user->id,
                'formation_id' => $formationId,
            ],
            [
                'tauxDevalidation' => $taux,
                'status' => $status,
            ]
        );

        if ($status === 'Validé') {
            // Vérifie si la certification existe déjà
            $certif = Certification::where('user_id', $user->id)
                ->where('formation_id', $formationId)
                ->first();

            if (!$certif) {
                Certification::create([
                    'dateFinFormation' => Carbon::now(),
                    'appreciation' => 'Félicitations, formation validée !',
                    'user_id' => $user->id,
                    'formation_id' => $formationId,
                ]);
            }
        }

        return response()->json(['success' => true, 'status' => $status]);
    }

    public function show($formation_id)
    {
        // ... (récupération formation, questions, etc.)
        $userTest = UserTest::where('user_id', auth()->id())
            ->where('formation_id', $formation_id)
            ->where('status', 'Validé')
            ->first();

        // Passe $userTest à la vue
        return view('Apprenant.formations.suivi-formation', [
            // ... autres variables
            'userTest' => $userTest,
        ]);
    }
}

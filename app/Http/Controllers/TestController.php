<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($formation_id)
    {
        $questions = Question::where('formation_id', $formation_id)
            ->with('reponses')
            ->get();

        $formation = \App\Models\Formation::findOrFail($formation_id);

        $progression = \App\Models\Progression::where('user_id', auth()->user()->id)
            ->where('formation_id', $formation_id)
            ->first();

        $chapitres = is_array($formation->chapitre) ? $formation->chapitre : json_decode($formation->chapitre, true);
        $total_chapitre = is_array($chapitres) ? count($chapitres) : 0;

        $lastChapterIndex = $progression ? $progression->chapitre_courant : 0;

        $resumeNotes = [];

        return view('Apprenant.formations.suivi-formation', [
            'formation' => $formation,
            'questions' => $questions,
            'progression' => $progression,
            'total_chapitre' => $total_chapitre,
            'lastChapterIndex' => $lastChapterIndex,
            'resumeNotes' => $resumeNotes,
        ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function submit(Request $request, $formation_id)
    {
        $reponses = $request->input('reponses', []);
        $score = 0;
        $total = 0;

        $questions = Question::where('formation_id', $formation_id)->with('reponses')->get();

        foreach ($questions as $question) {
            $total++;
            if ($question->type === 'qcu') {
                $bonne = $question->reponses->where('is_correct', 1)->first();
                if ($bonne && isset($reponses[$question->id]) && $reponses[$question->id] == $bonne->id) {
                    $score++;
                }
            }
            // Ajoute la logique pour QCM et texte si besoin
        }

        return response()->json([
            'score' => $score,
            'total' => $total,
            'message' => "Vous avez obtenu $score/$total"
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Question;
use App\Models\Reponse;
use App\Models\UserAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentTestController extends Controller
{
    public function show(Test $test)
    {
        $questions = $test->questions()->with('reponses')->get();
        return view('student.test.show', compact('test', 'questions'));
    }

    public function submit(Request $request, Test $test)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required',
        ]);

        foreach ($validated['answers'] as $questionId => $answer) {
            $question = Question::findOrFail($questionId);
            $isCorrect = false;

            if ($question->type === 'QCM') {
                $reponse = Reponse::find($answer);
                $isCorrect = $reponse && $reponse->is_correct;
                UserAnswer::create([
                    'user_id' => $user->id,
                    'question_id' => $questionId,
                    'reponse_id' => $answer,
                    'is_correct' => $isCorrect,
                ]);
            } elseif ($question->type === 'Éditeur de code') {
                $correctAnswer = $question->reponses->firstWhere('is_correct', true);
                $isCorrect = $answer === $correctAnswer->text;
                UserAnswer::create([
                    'user_id' => $user->id,
                    'question_id' => $questionId,
                    'text_answer' => $answer,
                    'is_correct' => $isCorrect,
                ]);
            }
        }

        return redirect()->route('student.test.results', $test)->with('success', 'Test soumis avec succès.');
    }

    public function results(Test $test)
    {
        $user = Auth::user();
        $answers = UserAnswer::where('user_id', $user->id)
            ->whereIn('question_id', $test->questions->pluck('id'))
            ->with('question.reponses')
            ->get();

        $score = $answers->where('is_correct', true)->count();
        $total = $answers->count();

        return view('student.test.results', compact('test', 'answers', 'score', 'total'));
    }
}
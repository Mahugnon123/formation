<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserTest;
use App\Models\UserFormation;
class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //$tests = UserTest::where(['user_id', '=', auth()->user()->id],['status', '=', 'valider'])->get();
        $tests = UserTest::where(['user_id', '=', 1],['status', '=', 'valider'])->get();
        if(count($tests)>1){
            $questions=[];
            $testTitre = [];

            foreach($tests as $test){
                $question = Question::where('userTest_id',$test->id)->first();
                $questions[] = $question;
                $testTitre[$question->id] = Test::where('id',$test->test_id)->first();
            }
        }
        else{
            $questions = Question::where('userTest_id',$test->id)->first();
            $testTitre = Test::where('id',$test->test_id)->first();

        }
        return view('Apprenant.formations.question', [ 'testTitre'=> $testTitre, 'questions'=> $questions, ]);

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
    public function show($id)
    {
        //
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
}

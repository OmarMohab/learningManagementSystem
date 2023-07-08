<?php

namespace App\Http\Controllers\Admin;

use App\Models\QuizQuestion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Quiz;
use Carbon\Carbon;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $questions = QuizQuestion::where('quiz_id',$id)->get();
        return view('question.index',compact('questions','id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        return view('question.create',compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$id)
    {
        $quiz= Quiz::where('id', $id)->first();

        if($quiz->start_date <= Carbon::now()->toDateTimeString()){
            return redirect()->route('quiz.index', $quiz->course_id)->with('failure','You cannot add new question as the quiz already started.');
        }

        $request->validate([
            'content' => 'required',
            'score' => 'required',
            'type' => 'required',
            'answers.*' => 'required_if:type,==,mcq',
            'valid' => 'required'
        ]);

        $new_question = QuizQuestion::create([
            'content' => $request->input('content'),
            'quiz_id' => $id,
            'type' => $request->input('type') == "mcq" ? "mcq" : "true&false",
            'score' => $request->input('score'),
        ]);

        if($request->input('answers.0') != null){
            for($i = 0; $i < count($request->input('answers')); $i++){
                Answer::create([
                    'content' => $request->input('answers.'.$i),
                    'quiz_question_id' => $new_question->id,
                    'valid' => $request->input('valid') == $i ? 1 : 0 
                ]);
            }
        }else{
            $answertrue = Answer::create([
                'content' => "True",
                'quiz_question_id' => $new_question->id,
                'valid' => $request->input('valid') == "true" ? 1 : 0 
            ]);
            $answerfalse = Answer::create([
                'content' => "False",
                'quiz_question_id' => $new_question->id,
                'valid' => $request->input('valid') == "false" ? 1 : 0 
            ]);
        }

        return redirect()->route('question.index',$id)
        ->with('success','Question created successfully.');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

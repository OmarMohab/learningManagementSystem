<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\QuizQuestion;
use Carbon\Carbon;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $quizes = Quiz::where('course_id',$id)->get();
        return view('quiz.index',compact('quizes','id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        return view('quiz.create',compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$id)
    {
        $request->validate([
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        $new_quiz = Quiz::create([
            'title' => $request->input('title'),
            'course_id' => $id,
            'end_date' => Carbon::parse($request->input('end_date'))->format('Y-m-d H:i'),
            'start_date' => Carbon::parse($request->input('start_date'))->format('Y-m-d H:i')
        ]);
        
        
        return redirect()->route('quiz.index',$id)
                        ->with('success','Quiz created successfully.');
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
    public function edit($id)
    {
        $quiz = Quiz::where('id', $id)->first();
        return view('quiz.edit',compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'end_date' => 'required'
        ]);

        $quiz = Quiz::where('id', $id)->firstOrFail();
        $quiz->title = $request->input('title');
        $quiz->end_date = $request->input('end_date');
        $quiz->save();

        return redirect()->route('quiz.index', $quiz->course_id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $quiz = Quiz::where('id', $id)->firstOrFail();
        $course_id = $quiz->course_id;
        $quiz->delete();
        return redirect()->route('quiz.index', $course_id);
    }
}

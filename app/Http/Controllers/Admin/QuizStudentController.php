<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StudentQuiz;

class QuizStudentController extends Controller
{

    public function startQuizPage($id){
        return view('quiz.start-quiz',compact('id'));

    }

    public function startQuiz($id){
        if(StudentQuiz::where('quiz_id',$id)->where('student_id',auth()->user()->id)->count() > 0){
            
        }
    }
}

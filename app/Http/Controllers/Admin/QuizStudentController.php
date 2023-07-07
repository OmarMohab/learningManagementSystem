<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Quiz;
use App\Models\Student;
use App\Models\StudentQuiz;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QuizStudentController extends Controller
{

    public function startQuizPage($quiz_id){
        if(StudentQuiz::where('quiz_id',$quiz_id)->where('student_id',auth()->user()->id)->count() > 0){
            return view('quiz.error');
        }
        return view('quiz.start-quiz',compact('quiz_id'));
    }

    public function startQuiz($id){
        if(StudentQuiz::where('quiz_id',$id)->where('student_id',auth()->user()->id)->count() == 0){
            StudentQuiz::create([
                'quiz_id' => $id,
                'student_id' => auth()->user()->id,
                'studnet_score' => 0
            ]);
            $quiz = Quiz::where('id', $id)
                ->with(['quiz_question.answer' => function ($query) {
                    $query->select(['content','quiz_question_id','id']);
                }])
                ->first();
            
            if(Carbon::now() > $quiz->end_date){
                $remain_time = 0;
            }else{
                $start = Carbon::now();
                $end = Carbon::parse($quiz->end_date);
                $remain_time = $end->diffInSeconds($start);
            }

            return view('quiz.quiz',compact('quiz','remain_time'));
        }else{
            return view('quiz.error');
        }
    }

    public function submitQuiz(Request $request, $id){

        $quiz = Quiz::where('id', $id)
        ->with('quiz_question.answer',  function ($query) {
            $query->where('valid', 1);
        })
        ->first();

        $score = 0;
        foreach($quiz->quiz_question as $question){
            foreach($question->answer as $answer){
                if($answer->id == $request->input($question->id)){
                    $score = $score + $question->score;
                }
            }
        }

        $student_quiz = StudentQuiz::where('quiz_id',$id)->where('student_id',auth()->user()->id)->first();
        $student_quiz->studnet_score = $score;
        $student_quiz->save();
        return view('quiz.success');
    }
}

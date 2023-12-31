<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Quiz;
use App\Models\StudentQuiz;
use App\Models\Teacher;
use App\Models\User;
use App\Notifications\NewCourseNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'user-access:admin'])->except('index','show');
        $this->middleware('auth')->only('index' ,'show');   
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $courses = Course::latest();
    if (request()->has('search')) {
        $courses->where('name', 'Like', '%' . request()->input('search') . '%');
    }
    if(Auth::user()->role == 'student'){
        $student_grade = Auth::user()->userable->grade->id;
        $courses->where('grade_id','Like','%'.$student_grade.'%');
    }
    if(Auth::user()->role == 'teacher'){
        $courses->where('teacher_id', 'Like', '%'.Auth::user()->userable->id.'%');
    }
    $courses = $courses->paginate(5);
    return view('course.index',compact('courses'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grades = Grade::all();
        $teachers = User::whereHasMorph(
            'userable', 
            ['App\Models\Teacher']
        )->get();
        return view('course.create', compact('grades','teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $course = Course::create($request->all());

        foreach($course->grade->students as $student)
        {
            $student->courses()->attach($course->id);
        }

        $students = $course->students;
        $teacher = $course->teacher;

        Notification::send($students, new NewCourseNotification($course->id, $course->name));
        Notification::send($teacher, new NewCourseNotification($course->id, $course->name));
     
        return redirect()->route('courses.index')
                        ->with('success','Course created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $materials = $course->materials;
        $meetings = $course->meetings;
        $assignments = $course->assignments()->with(
            ['students' => function ($query) {
                $query->where('student_id', auth()->user()->userable_id);
            }])
        ->get();
        $quiz = Quiz::where('course_id',$course->id)
                    ->where('start_date','<=',Carbon::now()->toDateTimeString())
                    ->where('end_date','>=',Carbon::now()->toDateTimeString())
                    ->latest('created_at')->first();
                    
        $quiz_student_check = $quiz ? StudentQuiz::where('quiz_id',$quiz->id)->count() : 0;

        return view('course.show',compact('course','materials','meetings','assignments','quiz','quiz_student_check'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('course.edit',compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required',
        ]);
    
        $course->update($request->all());
    
        return redirect()->route('courses.index')
                        ->with('success','Course updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
    
        return redirect()->route('courses.index')
                        ->with('success','Course deleted successfully');
    }
}

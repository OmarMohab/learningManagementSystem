<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        return view('course.create');
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
        $assignments = $course->assignments;
        return view('course.show',compact('course','materials','meetings','assignments'));
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

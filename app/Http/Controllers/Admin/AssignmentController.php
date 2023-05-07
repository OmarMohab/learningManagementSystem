<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\NewAssignmentNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        return view('assignment.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $assignment = $request->file('assignment')->getClientOriginalName();
        $path = $request->file('assignment')->storeAs('assignments',$assignment,'public');
        $new_assignment = Assignment::create([
            'course_id' => $request->course_id,
            'user_id' => $request->user_id,
            'name' => $request->name,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'path' => $path
        ]);

        foreach($new_assignment->course->students as $student)
        {
            $student->assignments()->attach($new_assignment->id);
        }

        $students = $new_assignment->students;
        $course_id = $new_assignment->course->id;
        $course_name = $new_assignment->course->name;
        Notification::send($students, new NewAssignmentNotification($course_id, $course_name));

        return redirect()->route('courses.show', ['course' => $new_assignment->course])->with('success','Assignment Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Assignment $assignment)
    {
        return view('assignment.show', compact('assignment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assignment $assignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assignment $assignment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assignment $assignment)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Meeting;
use App\Notifications\NewMeetingNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class MeetingController extends Controller
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
        return view('meeting.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|numeric|exists:courses,id',
            'meeting_id' => 'required|string|max:100',
            'topic' => 'required|string|max:100',
            'start_at' => 'required|date',
            'duration' => 'required|numeric',
            'password' => 'required|max:100',
            'start_url' => 'required|max:100',
            'join_url' => 'required|max:100'
        ]);

        $meeting = Meeting::create($request->all() + ['user_id' => auth()->user()->id]);
        $students = $meeting->course->students;
        $course_id = $meeting->course->id;
        $course_name = $meeting->course->name;

        Notification::send($students, new NewMeetingNotification($course_id, $course_name));

        return redirect()->route('courses.show', ['course' => $meeting->course])->with('message', 'Meeting Created Successfully');
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
    public function destroy(Meeting $meeting)
    {
        $meeting_course_id = $meeting->course->id;
        $meeting->delete();

        return to_route('course.show', ['id' => $meeting_course_id])->with('success', 'Meeting Removed Successfully');
    }
}

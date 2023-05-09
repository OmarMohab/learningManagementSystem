<?php

namespace App\Http\Controllers\Student;

use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubmssionController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $submission = $request->file('submission')->getClientOriginalName();
        $path = $request->file('submission')->storeAs('submissions',$submission,'public');
        $new_submission = Submission::create([
            'assignment_id' => $request->assignment_id,
            'student_id' => $request->student_id,
            'path' => $path

        ]);

        $assignment = Auth::user()->userable->assignments->find($new_submission->assignment_id);
        $assignment->pivot->update(['is_submitted' => 1]);

        return redirect()->route('courses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Submission $submission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Submission $submission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Submission $submission)
    {
        //
    }

    public function specific(Assignment $assignment)
    {
        $submissions = $assignment->submissions;
        return view('submission.specific', compact('submissions'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Submission $submission)
    {
        //
    }
}

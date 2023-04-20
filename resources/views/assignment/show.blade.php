@extends('layouts.app')

@section('content')
    <h2>{{$assignment->description}}</h2>
    <a href="{{route('prompt.open', $assignment)}}">{{$assignment->name}}</a><br>

    @if (Auth::user()->role == 'student')
        
        <form action="{{route('submissions.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="assignment_id" value="{{$assignment->id}}">
            <input type="hidden" name="student_id" value="{{Auth::user()->userable->id}}">
            <strong>Upload Submission</strong>
                <input type="file" name="submission">
            <button type="submit">Submit</button>
        </form>    
    @endif
    
    @if (Auth::user()->role == 'teacher' or Auth::user()->role == 'admin')
        <a href="{{route('submissions.assignment', $assignment)}}">View Students Submissions</a>    
    @endif

@endsection
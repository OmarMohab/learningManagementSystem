@extends('layouts.app')

@section('content')
    <form action="{{route('assignments.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="course_id" value={{$course->id}}>
        <input type="hidden" name="user_id" value={{Auth::user()->id}}>
        <strong>Name</strong>
            <input type="text" name="name"><br>
        <strong>Description</strong>
            <input type="text" name="description"><br>
        <strong>Due Date</strong>
            <input type="datetime-local" name="due_date"><br>
        <strong>Upload Assignment</strong>
            <input type="file" name="assignment"><br>
        <button type="submit">Create Assignment</button>
    </form>
@endsection
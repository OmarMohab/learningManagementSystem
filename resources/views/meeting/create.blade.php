@extends('layouts.app')

@section('content')
    <form action="{{route('meetings.store')}}" method="POST">
        @csrf
        <input type="hidden" name="course_id" value={{$course->id}}>
        <input type="hidden" name="user_id" value={{Auth::user()->id}}>
        <strong>Meeting ID</strong>
            <input type="text" name="meeting_id"><br>
        <strong>topic</strong>
            <input type="text" name="topic"><br>
        <strong>Date & Time</strong>
            <input type="datetime-local" name="start_at"><br>
        <strong>Duration</strong>
            <input type="number" name="duration"><br>
        <strong>Meeting Password</strong>
            <input type="text" name="password"><br>
        <strong>Start Meeting URL</strong>
            <input type="text" name="start_url"><br>
        <strong>Join Meeting URL</strong>
            <input type="text" name="join_url"><br>
        <button type="submit">Create the Meeting</button>
    </form>
@endsection
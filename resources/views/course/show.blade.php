@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Course</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('courses.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $course->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Description:</strong>
                {{ $course->description }}
            </div>
        </div>
        @if (Auth::user()->role == 'teacher' or Auth::user()->role == 'admin')
            <div>
                <h2>Upload Material</h2>
                <form action="{{Route('materials.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="material"><br>
                    <input type="hidden" name=course_id value={{$course->id}}>
                    <button type="submit">Upload</button>
                </form>
            </div>
        @endif
    </div>
    <h2>Material</h2>
    <div>
        @foreach ($materials as $material)
            <a href="{{route('file.open', $material)}}">{{$material->path}}</a><br>
        @endforeach
    </div>
    <h2>Meetings</h2>
    @if (Auth::user()->role == 'teacher' or Auth::user()->role == 'admin')
        <div>
            <a href="{{route('meetings.create', $course)}}">Create a Meeting</a>
        </div>
    @endif
    <div>
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Course</th>
                <th>Teacher</th>
                <th>Topic</th>
                <th>DateTime</th>
                <th>URL</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($meetings as $meeting)
                <tr>
                    <td>{{ 1 }}</td>
                    <td>{{ $meeting->course->name }}</td>
                    <td>{{ $meeting->user->name }}</td>
                    <td>{{ $meeting->topic }}</td>
                    <td>{{ $meeting->start_at }}</td>
                    @if (Auth::user()->id == $meeting->user_id)
                        <td><a href="{{$meeting->start_url}}">Join</a></td>
                    @else
                        <td><a href="{{$meeting->start_url}}">Join</a></td>
                    @endif
                </tr>
            @endforeach
        <table></table>
    </div>
@endsection
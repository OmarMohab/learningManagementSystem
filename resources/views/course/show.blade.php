@extends('layouts.app')

@section('content')
    <div class="row text-center">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ $course->name }}</h2>
                <p>{{ $course->description }}</p>
            </div>
        </div>
    </div>
   
    @if (Auth::user()->role == 'teacher' or Auth::user()->role == 'admin')
        <h2>Upload Material</h2>
        <form action="{{Route('materials.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group">
                <input class="form-control" type="file" name="material"><br>
                <input type="hidden" name=course_id value={{$course->id}}>
                <button class="btn btn-primary" type="submit">Upload</button>
            </div>
        </form>
    @endif
    <br>
    <h2>Material</h2>
    <div>
        @foreach ($materials as $material)
            <i class="bi bi-book-half"></i>
            <a href="{{route('file.open', $material)}}">{{basename($material->path)}}</a><br>
         @endforeach
    </div>
    <div class="d-flex">
        <i class="bi bi-camera-video-fill" style="font-size:25px"></i>
        <h2>Meetings</h2>
    </div>
    @if (Auth::user()->role == 'teacher' or Auth::user()->role == 'admin')
        <div>
            <a class="btn btn-primary" href="{{route('meetings.create', $course)}}">Create a Meeting</a>
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
                    <td>{{ ++$i }}</td>
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
        </table>
    
    <h2>Assignments</h2>
    @if (Auth::user()->role == 'teacher' or Auth::user()->role == 'admin')
        <div>
            <a class="btn btn-primary" href="{{route('assignments.create', $course)}}">Create an Assignment</a>
        </div>
    @endif
    @foreach ($assignments as $assignment)
        <i class="bi bi-pencil-fill"></i>
        <a href="{{route('assignments.show', $assignment->id)}}">{{$assignment->name}}</a><br>
    @endforeach
    </div>
@endsection
@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-md-12 col-lg-12 mb-3">
                <div class="card h-100">
                <div class="card-body">
                    <a href="{{ url('courses') }}" class="fw-light">Courses /</a> <h2 class="card-title">{{$assignment->name}}</h2>
                    <embed src="{{route('prompt.open', $assignment)}}" style="width:100%; height:1000px;" frameborder="0">
                    @if (Auth::user()->role == 'teacher' or Auth::user()->role == 'admin')
                        <a class="btn btn-info" href="{{route('submissions.assignment', $assignment)}}">View Students Submissions</a>    
                    @endif
                </div>
                @if (Auth::user()->role == 'student')
                <div class="card-body">
                    <form action="{{route('submissions.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div>
                            <input type="hidden" name="assignment_id" value="{{$assignment->id}}">
                            <input type="hidden" name="student_id" value="{{Auth::user()->userable->id}}">
                        </div>
                        <div>
                            <label for="defaultFormControlInput" class="form-label">Submission</label>
                            <input
                            type="file"
                            name="submission"
                            class="form-control"
                            id="defaultFormControlInput"
                            aria-describedby="defaultFormControlHelp"
                            />
                        </div>
                        <div class="row mt-3">
                            <div class="d-grid gap-2 col-lg-6 mx-auto">
                              <button type="submit" class="btn btn-primary btn-lg">Submit Assignment</button>
                            </div>
                        </div>
                    </form>
                </div>
                @endif
                </div>
            </div>
        </div>
    </div>
@endsection
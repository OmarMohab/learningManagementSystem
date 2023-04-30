@extends('layouts.app')

@section('content')
    <h2>{{$assignment->description}}</h2>
    <i class="bi bi-pencil-fill"></i>
    <a href="{{route('prompt.open', $assignment)}}">{{$assignment->name}}</a><br>

    @if (Auth::user()->role == 'student')
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Submit Assignment</h5>
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
                </div>
            </div>
        </div>
    @endif
    
    @if (Auth::user()->role == 'teacher' or Auth::user()->role == 'admin')
        <a class="btn btn-info" href="{{route('submissions.assignment', $assignment)}}">View Students Submissions</a>    
    @endif

@endsection
@extends('layouts.app')

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-md-12 col-lg-12 mb-3">
                <div class="card h-100">
                <div class="card-body">
                    <a href="{{ url('courses') }}" class="fw-light">Courses /</a> <h2 class="card-title">{{ $course->name }}</h2>
                </div>
                <div class="card-body">
                    @if (Auth::user()->role == 'teacher' or Auth::user()->role == 'admin')
                    <div class="row">
                        <div class="col-md-4 col-xl-4">
                            <div class="card shadow-none bg-transparent border border-active mb-3"> 
                                <div class="card-body">
                                    <h2>Upload Material</h2>
                                    <form action="{{Route('materials.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="input-group">
                                            <input class="form-control" type="file" name="material"><br>
                                            <input type="hidden" name=course_id value={{$course->id}}>
                                            <button class="btn btn-primary" type="submit">Upload</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-xl-4">
                            <div class="card shadow-none bg-transparent border border-active mb-3">
                                <div class="card-body">
                                    <h2>Create new Meeting</h2>
                                    <a class="btn btn-primary" href="{{route('meetings.create', $course)}}">Create</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-xl-4">
                            <div class="card shadow-none bg-transparent border border-active mb-3">
                                <div class="card-body">
                                    <h2>Create new Assignment</h2>
                                    <a class="btn btn-primary" href="{{route('assignments.create', $course)}}">Create</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div id="accordionIcon" class="accordion mt-3 accordion-without-arrow">
                        <div class="accordion-item card">
                          <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionIconOne">
                            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionIcon-1" aria-controls="accordionIcon-1">
                                <h3>Materials</h3>
                            </button>
                          </h2>
    
                          <div id="accordionIcon-1" class="accordion-collapse collapse" data-bs-parent="#accordionIcon">
                            <div class="accordion-body">
                                <div>
                                    @foreach ($materials as $material)
                                    <div class="col-md-12 col-xl-12">
                                        <div class="card shadow-none bg-transparent border border-primary mb-3">
                                            <div class="card-body">
                                            <i class="bi bi-book-half"></i>
                                            <a href="{{route('file.open', $material)}}">
                                                {{basename($material->path)}} </a><br>
                                            </div>
                                        </div>
                                    </div>
                                     @endforeach
                                </div>
                            </div>
                          </div>
                        </div>
    
                        <div class="accordion-item card">
                          <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionIconTwo">
                            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionIcon-2" aria-controls="accordionIcon-2">
                                <h3>Meetings</h3>
                            </button>
                          </h2>
                          <div id="accordionIcon-2" class="accordion-collapse collapse" data-bs-parent="#accordionIcon">
                            <div class="accordion-body">
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Course</th>
                                            <th>Teacher</th>
                                            <th>Topic</th>
                                            <th>DateTime</th>
                                            <th>URL</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($meetings as $meeting)
                                        <tr>
                                            <td>{{ ++$loop->index }}</td>
                                            <td>{{ $meeting->course->name }}</td>
                                            <td>{{ $meeting->user->name }}</td>
                                            <td>{{ $meeting->topic }}</td>
                                            <td>{{ $meeting->start_at }}</td>
                                            @if (Auth::user()->id == $meeting->user_id)
                                                <td><a target="_blank" class="btn btn-info" href="{{$meeting->start_url}}">Join</a></td>
                                            @else
                                                <td><a target="_blank" class="btn btn-info" href="{{$meeting->start_url}}">Join</a></td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                          </div>
                        </div>
    
                        <div class="accordion-item card active">
                          <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionIconThree">
                            <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionIcon-3" aria-expanded="true" aria-controls="accordionIcon-3">
                                <h3>Assignments</h3>
                            </button>
                          </h2>
                          <div id="accordionIcon-3" class="accordion-collapse collapse show" data-bs-parent="#accordionIcon">
                            <div class="accordion-body">
                                @foreach ($assignments as $assignment)
                                    <div class="col-md-12 col-xl-12">
                                        <div class="card shadow-none bg-transparent border border-primary mb-3">
                                        <div class="card-body">
                                            @if (!Auth::user()->role == 'teacher' or !Auth::user()->role == 'admin')
                                                @if($assignment->students[0]->pivot->is_submitted)
                                                You Already Submmited the Assignment
                                                @else
                                                <i class="bi bi-pencil-fill"></i>
                                                <a  href="{{route('assignments.show', $assignment->id)}}">
                                                    {{$assignment->name}}</a><br>
                                                @endif
                                            @else
                                            <i class="bi bi-pencil-fill"></i>
                                            <a  href="{{route('assignments.show', $assignment->id)}}">
                                                {{$assignment->name}}</a><br>
                                            @endif
                                        </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
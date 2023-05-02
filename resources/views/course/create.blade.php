@extends('layouts.app')

@section('content')
   
    @if ($errors->any())
        <div class="alert alert-danger">
            There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Create New Course</h5>
                <div class="card-body">
                    <form action="{{ route('courses.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div>
                            <label for="defaultFormControlInput" class="form-label">Course ID</label>
                            <input
                            type="number"
                            name="id"
                            class="form-control"
                            id="defaultFormControlInput"
                            aria-describedby="defaultFormControlHelp"
                            />
                        </div>
                        <div>
                            <label for="defaultFormControlInput" class="form-label">Course Name</label>
                            <input
                            type="text"
                            name="name"
                            class="form-control"
                            id="defaultFormControlInput"
                            aria-describedby="defaultFormControlHelp"
                            />
                        </div>
                        <div>
                            <label for="defaultFormControlInput" class="form-label">Description</label>
                            <input
                            type="text"
                            name="description"
                            class="form-control"
                            id="defaultFormControlInput"
                            aria-describedby="defaultFormControlHelp"
                            />
                        </div>
                        <div class="mb-3" id="grade-select">
                            <label for="exampleFormControlSelect1" class="form-label">Teacher</label>
                            <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="teacher_id">
                              <option value="" disabled selected>---- Teacher ----</option>
                              @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->userable_id }}">{{ $teacher->name }}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="mb-3" id="grade-select">
                            <label for="exampleFormControlSelect1" class="form-label">Grade</label>
                            <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example" name="grade_id">
                              <option value="" disabled selected>---- Grade ----</option>
                              @foreach ($grades as $grade)
                                <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="row mt-3">
                            <div class="d-grid gap-2 col-lg-6 mx-auto">
                              <button type="submit" class="btn btn-primary btn-lg">Create Course</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
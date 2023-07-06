@extends('layouts.app')

@section('content')


        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Courses / Quizes / </span> Create Quiz</h4>

   
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
                            <h5 class="card-header">Create New Quiz</h5>
                            <div class="card-body">
                                <form action="{{ route('quiz.store',$id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div>
                                        <label for="defaultFormControlInput" class="form-label">Quiz Title</label>
                                        <input
                                        type="text"
                                        name="title"
                                        class="form-control"
                                        id="defaultFormControlInput"
                                        aria-describedby="defaultFormControlHelp"
                                        value="{{ old('id') }}"
                                        placeholder="Quiz Title"
                                        />
                                    </div>
                                    <div>
                                        <label for="defaultFormControlInput" class="form-label">Start Date</label>
                                        <input 
                                        type="datetime-local" 
                                        id="birthdaytime" 
                                        class="form-control"
                                        name="start_date"
                                        />
                                    </div>
                                    <div>
                                        <label for="defaultFormControlInput" class="form-label">End Date</label>
                                        <input 
                                        type="datetime-local" 
                                        id="birthdaytime" 
                                        class="form-control"
                                        name="end_date"
                                        />
                                    </div>
                                    <div class="row mt-3">
                                        <div class="d-grid gap-2 col-lg-6 mx-auto">
                                        <button type="submit" class="btn btn-primary btn-lg">Create</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
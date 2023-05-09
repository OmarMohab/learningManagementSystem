@extends('layouts.app')

@section('content')

        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Courses /</span> Create Assignment</h4>

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
                            <h5 class="card-header">Create Assignment</h5>
                            <div class="card-body">
                                <form action="{{route('assignments.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <div>
                                        <input type="hidden" name="course_id" value={{$course->id}}>
                                    </div>
                                    <div>
                                        <label for="defaultFormControlInput" class="form-label">Name</label>
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
                                    <div>
                                        <label for="defaultFormControlInput" class="form-label">Due Date</label>
                                        <input
                                        type="datetime-local"
                                        name="due_date"
                                        class="form-control"
                                        id="defaultFormControlInput"
                                        aria-describedby="defaultFormControlHelp"
                                        />
                                    </div>
                                    <div>
                                        <label for="defaultFormControlInput" class="form-label">File</label>
                                        <input
                                        type="file"
                                        name="file"
                                        class="form-control"
                                        id="defaultFormControlInput"
                                        aria-describedby="defaultFormControlHelp"
                                        />
                                    </div>
                                    <div class="row mt-3">
                                        <div class="d-grid gap-2 col-lg-6 mx-auto">
                                        <button type="submit" class="btn btn-primary btn-lg">Create Assignment</button>
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
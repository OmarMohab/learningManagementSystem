@extends('layouts.app')

@section('content')

        
        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Users /</span> Create User</h4>

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
                    <h5 class="card-header">Create User</h5>
                    <div class="card-body">
                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Name</label>
                                <input
                                type="text"
                                name="name"
                                class="form-control"
                                id="defaultFormControlInput"
                                placeholder="John Doe"
                                aria-describedby="defaultFormControlHelp"
                                />
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Email</label>
                                <input
                                type="text"
                                name="email" 
                                class="form-control"
                                id="defaultFormControlInput"
                                placeholder="email@email.com"
                                aria-describedby="defaultFormControlHelp"
                                />
                            </div>
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Password</label>
                                <input
                                type="password"
                                name="password" 
                                class="form-control"
                                id="defaultFormControlInput"
                                placeholder="Password"
                                aria-describedby="defaultFormControlHelp"
                                />
                            </div>
                            <div class="form-check mt-3">
                                <input
                                  name="role"
                                  class="form-check-input"
                                  type="radio"
                                  value="0"
                                  id="defaultRadio1"
                                />
                                <label class="form-check-label" for="defaultRadio1"> Student </label>
                            </div>
                            <div class="form-check">
                                <input
                                  name="role"
                                  class="form-check-input"
                                  type="radio"
                                  value="1"
                                  id="defaultRadio2"
                                />
                                <label class="form-check-label" for="defaultRadio2"> Admin </label>
                            </div>
                            <div class="form-check">
                                <input
                                  name="role"
                                  class="form-check-input"
                                  type="radio"
                                  value="2"
                                  id="defaultRadio2"
                                />
                                <label class="form-check-label" for="defaultRadio2"> Teacher </label>
                              </div>
                              <div class="mb-3" id="grade-select" style="display: none;">
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
                                  <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
            </div>
        </div>
   
      @section('js')
      <script>
        $(document).ready(function () {

            $('input[type="radio"]').click(function () {
                if ($(this).attr("value") == 0) {
                    $("#grade-select").show('slow');
                }else{
                    $("#grade-select").hide('slow');
                }
            });
        });
      </script>
      @endsection


@endsection
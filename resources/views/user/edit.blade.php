@extends('layouts.app')

@section('content')

        
        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Basic Inputs</h4>

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
                    <h5 class="card-header">Default</h5>
                    <div class="card-body">
                        <form action="{{ route('users.update',$user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="defaultFormControlInput" class="form-label">Name</label>
                                <input
                                type="text"
                                name="name" value="{{ $user->name }}" 
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
                                name="email" value="{{ $user->email }}" 
                                class="form-control"
                                id="defaultFormControlInput"
                                placeholder="John Doe"
                                aria-describedby="defaultFormControlHelp"
                                />
                            </div>
                            <input type="hidden" name="role" value="@if($user->role == "teacher") 2 @elseif($user->role == "admin") 1 @else 0 @endif">
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
   


@endsection
@extends('layouts.app')

@section('content')

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
  
        <div class="container-xxl flex-grow-1 container-p-y">
          <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Courses</h4>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <form method="GET" action="{{ route('courses.index') }}">
        <div class="py-2 flex">
            <div class="input-group">
                <input type="search" name="search" value="{{ request()->input('search') }}" class="form-control" placeholder="Search">
                <button type='submit' class='btn btn-primary'>
                {{ __('Search') }}
                </button>
            </div>
        </div>
    </form>
   
    <!-- Bordered Table -->
    <div class="card">
        <h5 class="card-header">Courses Table</h5>
        <div class="card-body">
          <div class="table-responsive text-nowrap">
            <table class="table table-bordered">
              <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Descrition</th>
                    <th>Grade</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($courses as $course)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->description }}</td>
                    <td>{{ $course->grade->name }}</td>
                    <td>
                        <form action="{{ route('courses.destroy',$course->id) }}" method="POST">
                            <div class="input-group">
                            <a class="btn btn-info" href="{{ route('courses.show',$course->id) }}">Show</a>
                            @if (Auth::user()->role == 'admin')
                    
                            <a class="btn btn-primary" href="{{ route('courses.edit',$course->id) }}">Edit</a>
           
                            @csrf
                            @method('DELETE')
        
                            <button type="submit" class="btn btn-danger">Delete</button>
                            @endif
                            </div>                    
                        </form>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--/ Bordered Table -->
      
    {!! $courses->links() !!}
      
@endsection
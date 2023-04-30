@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Courses</h2>
            </div>
        </div>
    </div>
   
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
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Descrition</th>
            <th>Grade</th>
            <th width="280px">Action</th>
        </tr>
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
    </table>
  
    {!! $courses->links() !!}
      
@endsection
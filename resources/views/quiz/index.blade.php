@extends('layouts.app')

@section('content')

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
  
        <div class="container-xxl flex-grow-1 container-p-y">
          <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Quiz List</h4>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    
    <div class="col-md-12 col-xl-12">
        <div class="card shadow-none bg-transparent border border-active mb-3">
                <a class="btn btn-primary" href="{{route('quiz.create', $id)}}">Create New Quiz</a>
                
        </div>
    </div>
   
    <!-- Bordered Table -->
    <div class="card">
        <h5 class="card-header">Quizes Table</h5>
        <div class="card-body">
          <div class="table-responsive text-nowrap">
            <table class="table table-bordered">
              <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Duration</th>
                    <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($quizes as $quiz)
                <tr>
                    <td>{{ $quiz->id }}</td>
                    <td>{{ $quiz->title }}</td>
                    <td>{{ Carbon\Carbon::parse($quiz->start_date)->format('d M Y') }}</td>
                    <td>Start Time: {{ Carbon\Carbon::parse($quiz->start_date)->format('H:i') }} | End Time: {{ Carbon\Carbon::parse($quiz->end_date)->format('H:i') }}</td>
                    <td><a class="btn btn-info" href="{{ route('question.index',$quiz->id) }}">Questions</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--/ Bordered Table -->
      
      
@endsection
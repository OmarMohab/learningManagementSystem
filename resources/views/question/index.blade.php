@extends('layouts.app')

@section('content')

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
  
        <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Courses / Quizes /  </span> Questions </h4>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    
    <div class="col-md-12 col-xl-12">
        <div class="card shadow-none bg-transparent border border-active mb-3">
                <a class="btn btn-primary" href="{{route('question.create', $id)}}">Create Question</a>
        </div>
    </div>
   
    <!-- Bordered Table -->
    <div class="card">
        <h5 class="card-header">Questions</h5>
        <div class="card-body">
          <div class="table-responsive text-nowrap">
            <table class="table table-bordered">
              <thead>
                <tr>
                    <th>Content</th> 
                    <th>Type</th> 
                </tr>
              </thead>
              <tbody>
                @foreach ($questions as $question)
                <tr>
                    <td>{{ $question->content }}</td>
                    <td>{{ $question->type == "mcq" ? "MCQ" : "True Or False"}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--/ Bordered Table -->
      
      
@endsection
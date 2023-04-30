@extends('layouts.app')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
  
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
  
                    <div class="card-body">
                        <div>
                            <p>Hello {{ auth()->user()->name }}</p>
                        </div>
    
                        <div class="card" style="width: 10rem">
                            <img src="{{asset('admintool/assets/img/elements/courseCard.png')}}" alt="">
                            <a class="btn btn-primary" href="{{Route('courses.index')}}">My Courses</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
  
                <div class="card-body">
                    You are an Admin.
                </div>
                <div class="card-body">
                    <a href="{{Route('users.index')}}">Manage Users</a>
                </div>
                <div class="card-body">
                    <a href="{{Route('courses.index')}}">Manage Courses</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
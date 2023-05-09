@extends('layouts.app')

@section('content')

    
    <!-- Content wrapper -->
    <div class="content-wrapper">
      <!-- Content -->

      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Users /</span> {{ $role }}</h4>
        
    <!-- Bordered Table -->
    <div class="card">
      <h5 class="card-header">Bordered Table</h5>
      <div class="card-body">
        <div class="table-responsive text-nowrap">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                       
                            <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
           
                            @csrf
                            @method('DELETE')
              
                            <button type="submit" class="btn btn-danger">Delete</button>
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

      </div>
    </div>
@endsection
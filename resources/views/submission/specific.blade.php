@extends('layouts.app')

@section('content')
    <div>
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Student Name</th>
                <th>Submited at</th>
                <th>submission</th>
                <th width="280px">Action</th>
            </tr>

            @foreach ($submissions as $submission)
            <tr>
                <td>{{ ++$loop->index }}</td>
                <td>{{$submission->student->user->name}}</td>
                <td>{{$submission->updated_at}}</td>
                <td><a class="btn btn-info" href="{{Route('response.open', $submission)}}">Show</a></td>
            </tr>
            @endforeach
        </table>
@endsection
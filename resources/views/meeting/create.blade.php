@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h5 class="card-header">Create New Meeting</h5>
            <div class="card-body">
                <form action="{{route('meetings.store')}}" method="POST">
                    @csrf
                    @method('POST')
                    <div>
                        <input type="hidden" name="course_id" value={{$course->id}}>
                        <input type="hidden" name="user_id" value={{Auth::user()->id}}>
                    </div>
                    <div>
                        <label for="defaultFormControlInput" class="form-label">Meeting ID</label>
                        <input
                        type="text"
                        name="meeting_id"
                        class="form-control"
                        id="defaultFormControlInput"
                        aria-describedby="defaultFormControlHelp"
                        />
                    </div>
                    <div>
                        <label for="defaultFormControlInput" class="form-label">Topic</label>
                        <input
                        type="text"
                        name="topic"
                        class="form-control"
                        id="defaultFormControlInput"
                        aria-describedby="defaultFormControlHelp"
                        />
                    </div>
                    <div>
                        <label for="defaultFormControlInput" class="form-label">Date & Time</label>
                        <input
                        type="datetime-local"
                        name="start_at"
                        class="form-control"
                        id="defaultFormControlInput"
                        aria-describedby="defaultFormControlHelp"
                        />
                    </div>
                    <div>
                        <label for="defaultFormControlInput" class="form-label">Duration</label>
                        <input
                        type="number"
                        name="duration"
                        class="form-control"
                        id="defaultFormControlInput"
                        aria-describedby="defaultFormControlHelp"
                        />
                    </div>
                    <div>
                        <label for="defaultFormControlInput" class="form-label">Meeting Password</label>
                        <input
                        type="text"
                        name="password"
                        class="form-control"
                        id="defaultFormControlInput"
                        aria-describedby="defaultFormControlHelp"
                        />
                    </div>
                    <div>
                        <label for="defaultFormControlInput" class="form-label">Strat Meeting URL</label>
                        <input
                        type="text"
                        name="start_url"
                        class="form-control"
                        id="defaultFormControlInput"
                        aria-describedby="defaultFormControlHelp"
                        />
                    </div>
                    <div>
                        <label for="defaultFormControlInput" class="form-label">Join Meeting URL</label>
                        <input
                        type="text"
                        name="join_url"
                        class="form-control"
                        id="defaultFormControlInput"
                        aria-describedby="defaultFormControlHelp"
                        />
                    </div>
                    <div class="row mt-3">
                        <div class="d-grid gap-2 col-lg-6 mx-auto">
                          <button type="submit" class="btn btn-primary btn-lg">Create Meeting</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
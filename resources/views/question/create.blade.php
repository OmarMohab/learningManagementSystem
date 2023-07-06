@extends('layouts.app')

@section('content')


        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Courses / Quizes / <a href="{{ route('question.index', $id) }}">Questions</a> / </span> Create Question</h4>

   
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
                            <h5 class="card-header">Create New Question</h5>
                            <div class="card-body">
                                <form action="{{ route('question.store',$id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div>
                                        <label for="defaultFormControlInput" class="form-label">Question Content</label>
                                        <input
                                        type="text"
                                        name="content"
                                        class="form-control"
                                        id="defaultFormControlInput"
                                        aria-describedby="defaultFormControlHelp"
                                        value="{{ old('content') }}"
                                        placeholder="Question Content"
                                        />
                                    </div>
                                    <div>
                                        <label for="defaultFormControlInput" class="form-label">Question Score</label>
                                        <input
                                        type="number"
                                        name="score"
                                        class="form-control"
                                        id="defaultFormControlInput"
                                        aria-describedby="defaultFormControlHelp"
                                        value="{{ old('score') }}"
                                        placeholder="Question Score"
                                        />
                                    </div>
                                    <div class="form-check mt-3">
                                        <input
                                        name="type"
                                        class="form-check-input"
                                        type="radio"
                                        value="mcq"
                                        id="defaultRadio1"
                                        />
                                        <label class="form-check-label" for="defaultRadio1"> MCQ </label>
                                    </div>
                                    <div class="form-check">
                                        <input
                                        name="type"
                                        class="form-check-input"
                                        type="radio"
                                        value="truefalse"
                                        id="defaultRadio2"
                                        />
                                        <label class="form-check-label" for="defaultRadio2"> True or False </label>
                                    </div>
                                    <br>
                                    <div class="mb-3" id="question-type" style="display: none;">
                                        <h1>Answers</h1>
                                        <div>
                                            <label for="defaultFormControlInput" class="form-label">Answer A</label>
                                            <input
                                            type="text"
                                            name="answers[]"
                                            class="form-control"
                                            id="defaultFormControlInput"
                                            aria-describedby="defaultFormControlHelp"
                                            value="{{ old('answers[0]') }}"
                                            placeholder="Question A"
                                            />
                                        </div>
                                        <div>
                                            <label for="defaultFormControlInput" class="form-label">Answer B</label>
                                            <input
                                            type="text"
                                            name="answers[]"
                                            class="form-control"
                                            id="defaultFormControlInput"
                                            aria-describedby="defaultFormControlHelp"
                                            value="{{ old('answers[1]') }}"
                                            placeholder="Question B"
                                            />
                                        </div>
                                        <div>
                                            <label for="defaultFormControlInput" class="form-label">Answer C</label>
                                            <input
                                            type="text"
                                            name="answers[]"
                                            class="form-control"
                                            id="defaultFormControlInput"
                                            aria-describedby="defaultFormControlHelp"
                                            value="{{ old('answers[2]') }}"
                                            placeholder="Question C"
                                            />
                                        </div>
                                        <div>
                                            <label for="defaultFormControlInput" class="form-label">Answer D</label>
                                            <input
                                            type="text"
                                            name="answers[]"
                                            class="form-control"
                                            id="defaultFormControlInput"
                                            aria-describedby="defaultFormControlHelp"
                                            value="{{ old('answers[3]') }}"
                                            placeholder="Question D"
                                            />
                                        </div>
                                        <br>
                                        <h1>Which is valid ?</h1>
                                        <div class="form-check mt-3">
                                            <input
                                            name="valid"
                                            class="form-check-input"
                                            type="radio"
                                            value="0"
                                            id="defaultRadio1"
                                            />
                                            <label class="form-check-label" for="defaultRadio1"> A </label>
                                        </div>
                                        <div class="form-check">
                                            <input
                                            name="valid"
                                            class="form-check-input"
                                            type="radio"
                                            value="1"
                                            id="defaultRadio2"
                                            />
                                            <label class="form-check-label" for="defaultRadio2"> B </label>
                                        </div>
                                        <div class="form-check">
                                            <input
                                            name="valid"
                                            class="form-check-input"
                                            type="radio"
                                            value="2"
                                            id="defaultRadio3"
                                            />
                                            <label class="form-check-label" for="defaultRadio3"> C </label>
                                        </div>
                                        <div class="form-check">
                                            <input
                                            name="valid"
                                            class="form-check-input"
                                            type="radio"
                                            value="3"
                                            id="defaultRadio4"
                                            />
                                            <label class="form-check-label" for="defaultRadio4"> D </label>
                                        </div>
                                    </div>

                                    <div class="mb-3" id="truefalseValid" style="display: none;">
                                        <h1>Which is valid ?</h1>
                                        <div class="form-check mt-3">
                                            <input
                                            name="valid"
                                            class="form-check-input"
                                            type="radio"
                                            value="true"
                                            id="defaultRadio1"
                                            />
                                            <label class="form-check-label" for="defaultRadio1"> True </label>
                                        </div>
                                        <div class="form-check">
                                            <input
                                            name="valid"
                                            class="form-check-input"
                                            type="radio"
                                            value="false"
                                            id="defaultRadio2"
                                            />
                                            <label class="form-check-label" for="defaultRadio2"> False </label>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="d-grid gap-2 col-lg-6 mx-auto">
                                        <button type="submit" class="btn btn-primary btn-lg">Create</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      @section('js')
      <script>
        $(document).ready(function () {

            $('input[type="radio"]').click(function () {
                if($(this).attr("value") == "truefalse"){
                    $("#question-type").hide('slow');
                    $("#truefalseValid").show('slow');
                }
                if($(this).attr("value") == "mcq") {
                    $("#question-type").show('slow');
                    $("#truefalseValid").hide('slow');
                }

            });
        });
      </script>
      @endsection

@endsection
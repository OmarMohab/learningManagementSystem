<html>
  <head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
        * {
      margin: 0;  
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background: #3586ff;
      font-family: 'Font1', sans-serif;
    }

    .container {
      width: 95%;
      max-width: 64rem;
      background: #fff;
      padding: 0.8rem;
      border-radius: 1rem; 
      overflow: auto; 
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      
      display: grid;
      gap: 1rem;
      grid-template-columns: 2fr 2fr 1.5fr;
      grid-template-rows: 0.1fr 2fr 1fr;
      grid-template-areas:
        "quiz-title quiz-title quiz-title"
        "question-section question-section questions-nav-section"
        "explanation-section explanation-section questions-nav-section"; 
    }

    .quiz-title {
      grid-area: quiz-title;
      font-weight: 800;
      font-size: 1rem; 
      text-align: center;
      margin-bottom: 1rem; 
    }

    .question-section {
      grid-area: question-section
    }

    .question {
      padding: 0.5rem;
      border: 2px solid #799efe;
      border-radius: 0.5rem;
      margin-bottom: 1rem;
    }

    .question .question-text {
      margin-bottom: 0.5rem;
    }

    .question .question-num {
      font-weight: 700; 
      font-size: 0.9rem;
      margin-bottom: 1rem; 
    }

    .answer-item {
      padding: 1rem 0;
      display:block;
      box-shadow: 0 7px 7px rgba(0, 0, 0, 0.1);
      border-radius: 0.5rem;
      margin-bottom: 0.5rem;
      cursor: pointer;
    }

    .answer-item.checked {
      background: #aabdff;
      color: #fff;
    }

    .answer-item.wrong {
      background: #da4955;
      color: #fff;
    }

    .answer-item span {
      margin-left: 2rem;
    }

    .answer-item:hover,
    .answer-item:active {
      background: #aabdff;
      color: #fff;
    }

    .answer-item input[type="radio"] {
      display: none;
    } 

    .action {
      margin-top: 1rem;
      margin-bottom: 1rem;
      text-align: center;
    }

    .btn {
      background: inherit;
      border: 0;
      border-radius: 0.5rem; 
      background-color: #696cff;
      border-color: #696cff;
      box-shadow: 0 0.125rem 0.25rem 0 rgba(105, 108, 255, 0.4);
      padding: 0.5rem 1rem;
      margin-right: 1.5rem;
      font-weight: 700;
      cursor: pointer;
      width: 100%;
      color: white;
    }

    .btn:hover,
    .btn:active { 
      background: #aabdff;
      color: #fff;
    } 

    .explanation-section {
      grid-area: explanation-section;
      padding: 0.5rem; 
      border-radius: 0.5rem;
      box-shadow: 0 7px 7px rgba(0, 0, 0, 0.1);
    }

    .explanation-section .section-title {
      font-weight: 700;
      font-size: 0.9rem;
      margin-bottom: 1rem; 
    } 

    .explanation-section .explanation-text {
      margin-right: 1rem;
      margin-left: 1rem;
      margin-bottom: 1.5rem;
    }

    .questions-nav-section {
      grid-area: questions-nav-section;
      padding: 1rem;
      box-shadow: 0 7px 7px rgba(0, 0, 0, 0.1);
      border-radius: 0.5rem;
    }

    .questions-nav-section .question-nums-list {
      /* max-width: 100%; */
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      grid-auto-rows: minmax(0, 1fr);
      gap: 10px;
      list-style: none;
      padding: 0;
      margin: 0;  
    } 

    .questions-nav-section .question-nums-list a {
      text-decoration: none;
      color: inherit;
      padding: 0.5rem; 
      background: #c4c4c4 ;
      border-radius: 50%;
      display: inline-block;
      width: 2.5rem; 
      height: 2.5rem;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      color: #fff;
    } 
    .questions-nav-section .question-nums-list a:hover {
      filter: brightness(0.9) 
    }
    .questions-nav-section .question-nums-list a.done { 
      background: #aabdff;
    }

    .questions-nav-section .question-nums-list a.active { 
      background: #ffaaaf;
    }

    .question-context {
      margin-bottom: 2rem;
      display: flex;
      justify-content: space-between;
    }

    .question-context a { 
      font-weight: 700;
      font-size: 0.9rem;
      text-decoration: none;
      color: inherit;
    }

    .question-context a:hover {
      color: #aabdff;
    }

    .d-flex {
      display: flex;
      justify-content: center;
      width: 100%; 
    } 
    
    @media(max-width: 50rem) {
      .container {   
        grid-template-rows: 0.1fr 1fr 1fr;
        border-radius: 0;
        position: static;
        height: 100vh;
        width: 100%; 
        top: 0%;
        left: 0%;
        transform: translate(0%, 0%);  
      }
    } 

    @media (max-width: 38rem) {
      .container {
        position: static;
        width: 100%;
        padding: 0.8rem;
        border-radius: 0;
        top: 0%;
        left: 0%;
        transform: translate(0%, 0%);

        grid-template-columns: 1fr;
        grid-template-rows: 0.1fr 1fr 1fr auto;
        grid-template-areas:
          "quiz-title"
          "questions-nav-section"
          "question-section"
          "explanation-section";
      }
    }
    .hiddenfile {
      opacity: 0;
      visibility: hidden;
      display: none;
    }
    </style>
  </head>
  <main>
  <form action="{{ route('quiz-submit', $quiz) }}" method="post" id="quiz-form">
  @csrf
  @method('POST')
  <div class="container">
    <h1 class="quiz-title">{{ $quiz->title }}</h1>
      
    <section class="question-section">
    @foreach ($quiz->quiz_question as $question)
    <div  id="{{ $question->id }}" class="SOMETHING @if($loop->index > 0) hiddenfile @endif">
      <div class="question">
          <h2 class="question-num">Question {{ $loop->index + 1 }}</h2>
          <p class="question-text">{{ $question->content }}</p>
        </div>
        <div class="answer">
          @foreach ($question->answer as $answer)
            <label class="answer-item" id="answer-item-{{$question->id}}">
              <input type="radio" name="{{$question->id}}" value="{{$answer->id}}" onchange="toggleParentClass(this,{{$question->id}})" id="{{$answer->id}}">
              <span>{{ $answer->content }}</span>
            </label>
          @endforeach
        </div>
    </div>
    @endforeach
    </section>

    <section class="explanation-section">
      <h2 class="section-title">NOTES</h2>
      <p class="explanation-text">Do not refresh this page or you will lose your quiz</p>
    </section>
    
    <section class="questions-nav-section">
      <h4 style="color:#FF0000;" ><span id="iTimeShow">Time Remaining: </span><br/><span id='timer' style="font-size:25px;"></span></h4>
      <br>
      <button class="btn" type="submit">Submit Quiz</button>
      <br>
      <br>
      <div class="d-flex"> 
        <ul class="question-nums-list">
        @foreach ($quiz->quiz_question as $question)
          <li><a class="done" href="#{{$question->id}}" id="{{ $loop->index }}">{{ $loop->index + 1 }}</a></li>
        @endforeach
        </ul>
      </div>
      <br>
    </section>
  </div>
  </form>
</main>

<script>
    var c={{$remain_time}};
    window.onload = function() {
      document.getElementById("0").click();
      timedCount();
    }
    function toggleParentClass(radio, id) {

      var parent = radio.parentNode;

      var answerItems = document.querySelectorAll('#answer-item-'+id);
      for (var i = 0; i < answerItems.length; i++) {
        if (answerItems[i] !== parent) { 
          answerItems[i].classList.remove('checked');
          answerItems[i].querySelector('input[type="radio"]').checked = false; 
        }
      }

      if (radio.checked) {
        parent.classList.add('checked');
      } else {
        parent.classList.remove('checked');
      }
    }

    function checkSomething(event) {
        [...document.querySelectorAll(".SOMETHING")].slice(0).forEach( (div) =>
            // hide or show all "SOMETHING" elements as necessary
            div.classList[(div.id == window.location.hash.substring(1)) ? "remove" : "add"]("hiddenfile")
        )
    }

    function init() {
        window.onhashchange = checkSomething;
        // need to check if an external link was to an anchor
        checkSomething(); 
    }

    document.addEventListener("DOMContentLoaded", init)

    function timedCount()
    {
      if(c == 185) 
      { 
        return false; 
      }
      
      var hours = parseInt( c / 3600 ) % 24;
      var minutes = parseInt( c / 60 ) % 60;
      var seconds = c % 60;
      var result = (hours < 10 ? "0" + hours : hours) + ":" + (minutes < 10 ? "0" + minutes : minutes) + ":" + (seconds  < 10 ? "0" + seconds : seconds);            
      $('#timer').html(result);
      
      if(c == 0 )
      {
        document.getElementById("quiz-form").submit();
      }
      
      /*if(c == 0 )
      {	
        if (!quizOver) 
        {
          var val = $("input[type='radio']:checked").val();
                if (val == questions[currentQuestion].correctAnswer) 
          {
            correctAnswers++;
          }
          currentQuestion++; // Since we have already displayed the first question on DOM ready
          
          if (currentQuestion < questions.length) 
          {
            displayCurrentQuestion();
            c=15;
          } 
          else 
          {
            displayScore();
            $('#timer').html('');
            c=16;
            $(document).find(".nextButton").text("Play Again?");
            quizOver = true;
            return false;
          }
        }
        else 
        { // quiz is over and clicked the next button (which now displays 'Play Again?'
          quizOver = false;
          $(document).find(".nextButton").text("Next Question");
          resetQuiz();
          displayCurrentQuestion();
          hideScore();
        }		
      }	*/
      c = c - 1;
      t = setTimeout(function()
      {
        timedCount()
      },1000);
    }
</script>
</html>


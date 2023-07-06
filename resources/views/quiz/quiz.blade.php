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
  box-shadow: 0 7px 7px rgba(0, 0, 0, 0.1);
  padding: 0.5rem 1rem;
  margin-right: 1.5rem;
  font-weight: 700;
  cursor: pointer;
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
</style>
<main>
  <div class="container">
    <h1 class="quiz-title">Quiz Title</h1>
    <section class="question-section">
      <div class="question">
        <h2 class="question-num">Question 11</h2>
        <p class="question-text">Which lifecycle method is called after a component is rendered for the first time?</p>
      </div>
      <div class="answer">
        <label class="answer-item">
          <input type="radio" name="option1" onchange="toggleParentClass(this)" id="">
          <span>componentDidMount</span>
        </label>
        <label class="answer-item">
          <input type="radio" name="option2" onchange="toggleParentClass(this)" id="">
          <span>componentDidUpdate</span>
        </label>
        <label class="answer-item">
          <input type="radio" name="option3" onchange="toggleParentClass(this)" id="">
          <span>componentWillMount</span>
        </label>
        <label class="answer-item">
          <input type="radio" name="option4" onchange="toggleParentClass(this)" id="">
          <span>componentWillUpdate</span>
        </label>
      </div>
      <div class="action">
        <button class="btn">Prev</button>
        <button class="btn">Next</button>
      </div>
    </section>
    <section class="explanation-section">
      <h2 class="section-title">Explanation</h2>
      <p class="explanation-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </section>
    <section class="questions-nav-section">
      <p class="question-context"> 
       <a href="#"><span class="question-num">Question 11/20</span></a>  
       <a href="#"><span class="question-help">Need Help?</span></a> 
      </p>
      <div class="d-flex"> 
        <ul class="question-nums-list">
          <li><a class="done" href="#">1</a></li>
          <li><a class="done" href="#">2</a></li>
          <li><a class="done" href="#">3</a></li>
          <li><a class="done" href="#">4</a></li>
          <li><a class="done" href="#">5</a></li>
          <li><a class="done" href="#">6</a></li>
          <li><a class="done" href="#">7</a></li>
          <li><a class="done" href="#">8</a></li>
          <li><a class="done" href="#">9</a></li>
          <li><a class="done" href="#">10</a></li>
          <li><a class="active" href="#">11</a></li>
          <li><a href="#">12</a></li>
          <li><a href="#">13</a></li>
          <li><a href="#">14</a></li>
          <li><a href="#">15</a></li>
          <li><a href="#">16</a></li>
          <li><a href="#">17</a></li>
          <li><a href="#">18</a></li>
          <li><a href="#">19</a></li>
          <li><a href="#">20</a></li>
        </ul>
      </div>
    </section>
  </div>
</main>

<script>
    function toggleParentClass(radio) {
  var parent = radio.parentNode;

  // Remove 'checked' class from all answer-items
  var answerItems = document.querySelectorAll('.answer-item');
  for (var i = 0; i < answerItems.length; i++) {
    if (answerItems[i] !== parent) { 
      answerItems[i].classList.remove('checked');
      answerItems[i].querySelector('input[type="radio"]').checked = false; 
    }
  } 
  
  if (parent.querySelector('span').innerHTML.trim() !== "componentDidMount") {
  parent.classList.add('wrong');
  console.log(parent.querySelector('span').innerHTML);
}


  if (radio.checked) {
    parent.classList.add('checked');
  } else {
    parent.classList.remove('checked');
  }
}
</script>
<style>
  body {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  font-size: 1.75em;
}

button {
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
  border: none;
  font-size: inherit;
  border-radius: 2em;
  padding: 0.75em 1em;
  background: #696cff;
  color: white;
  display: inline-flex;
  align-items: center;
  cursor: pointer;
}

.spinner {
  --size: 1.25em;
  --offset-r: calc(var(--size) * -1);
  --offset-l: 0;
  --opacity: 0;
  position: relative;
  display: inline-flex;
  height: var(--size);
  width: var(--size);
  margin-top: calc(var(--size) * -0.5);
  margin-right: var(--offset-r);
  margin-bottom: calc(var(--size) * -0.5);
  margin-left: var(--offset-l);
  box-sizing: border-box;
  border: 0.125em solid rgba(255, 255, 255, 0.333);
  border-top-color: white;
  border-radius: 50%;
  opacity: var(--opacity);
  transition: 0.25s;
}

button:active .spinner, button:focus .spinner, button:hover .spinner {
  --width: 1em;
  --offset-r: 0.333em;
  --offset-l: -0.333em;
  --opacity: 1;
  -webkit-animation: 0.666s load infinite;
          animation: 0.666s load infinite;
}
@-webkit-keyframes load {
  to {
    transform: rotate(360deg);
  }
}
@keyframes load {
  to {
    transform: rotate(360deg);
  }
}
</style>
<form action="{{ route('start-quiz-submit',$quiz_id) }}" method="POST">
  @csrf
  @method('POST')
  <button>
      <div class="spinner"></div>Start Quiz
  </button>
</form>

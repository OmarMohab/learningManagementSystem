<style>
  body {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  font-size: 1.75em;
}

a {
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
  border: none;
  font-size: inherit;
  border-radius: 2em;
  padding: 0.75em 1em;
  background: blue;
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

a:active .spinner, a:focus .spinner, a:hover .spinner {
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
<a href="{{ route('start-quiz',quiz_id) }}">
  <div class="spinner"></div>Start Quiz
</a>

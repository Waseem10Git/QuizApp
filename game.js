const question = document.getElementById("question");
const choices = Array.from(document.getElementsByClassName("choice-text"));
const progressText = document.getElementById("progressText");
const scoreText = document.getElementById("score");
const progressBarFull = document.getElementById("progressBarFull");
const loader = document.getElementById('loader');
const game = document.getElementById('game');
const elements = document.getElementsByClassName("hideElement");
const ele = document.getElementById("hid");
const EndQuiz = document.getElementById("EndQuiz");

let currentQuestion = {};
let acceptingAnswers = false;
let score = 0;
let questionCounter = 0;
let availableQuestions = [];

let questions = [];
//get data from local storage
let MAX_QUESTIONS = window.localStorage.getItem("amountOfQuestions");
let CORRECT_BONUS = window.localStorage.getItem("score");
const categoryId = window.localStorage.getItem("category");
const diff = window.localStorage.getItem("difficulty");
const typ = window.localStorage.getItem("type");
//get api according to data that comes
let api = `https://opentdb.com/api.php?amount=${MAX_QUESTIONS}`;
if (categoryId === "any" && diff === "any" && typ === "any")
  api = `https://opentdb.com/api.php?amount=${MAX_QUESTIONS}`;
if (categoryId === "any" && diff === "any" && typ !== "any")
  api = `https://opentdb.com/api.php?amount=${MAX_QUESTIONS}&type=${typ}`;
if (categoryId === "any" && diff !== "any" && typ === "any")
  api = `https://opentdb.com/api.php?amount=${MAX_QUESTIONS}&difficulty=${diff}`;
if (categoryId === "any" && diff !== "any" && typ !== "any")
  api = `https://opentdb.com/api.php?amount=${MAX_QUESTIONS}&difficulty=${diff}&type=${typ}`;
if (categoryId !== "any" && diff === "any" && typ === "any")
  api = `https://opentdb.com/api.php?amount=${MAX_QUESTIONS}&category=${categoryId}`;
if (categoryId !== "any" && diff === "any" && typ !== "any")
  api = `https://opentdb.com/api.php?amount=${MAX_QUESTIONS}&category=${categoryId}&type=${typ}`;
if (categoryId !== "any" && diff !== "any" && typ === "any")
  api = `https://opentdb.com/api.php?amount=${MAX_QUESTIONS}&category=${categoryId}&difficulty=${diff}`;
if (categoryId !== "any" && diff !== "any" && typ !== "any")
  api = `https://opentdb.com/api.php?amount=${MAX_QUESTIONS}&category=${categoryId}&difficulty=${diff}&type=${typ}`;

fetch(
    api
)
    .then(res => {
    return res.json();
})
    .then(loadedQuestions => {
      questions = loadedQuestions.results.map(loadedQuestion => {
        const formattedQuestion = {
          question: loadedQuestion.question
        };


        const answerChoices = [...loadedQuestion.incorrect_answers];
        formattedQuestion.answer = Math.floor(Math.random() * 3) + 1;
        answerChoices.splice(
            formattedQuestion.answer - 1,
            0,
            loadedQuestion.correct_answer
        );

        answerChoices.forEach((choice, index) => {
          formattedQuestion["choice" + (index + 1)] = choice;
        });

        return formattedQuestion;
      })
      startGame();
    })
    .catch(err => {
      console.error(err);
});


startGame = () => {
  questionCounter = 0;
  score = 0;
  availableQuestions = [...questions];
  getNewQuestion();
  game.classList.remove("hidden");
  loader.classList.add("hidden");
};

getNewQuestion = () => {
  if (availableQuestions.length === 0 || questionCounter >= MAX_QUESTIONS) {
    localStorage.setItem("mostRecentScore", score);
    //go to the end page
    if (questionCounter !== 0)
    return window.location.assign("end.php");
  }


  questionCounter++;
  progressText.innerText = `Question ${questionCounter}/${MAX_QUESTIONS}`;
  //Update the progress bar
  progressBarFull.style.width = `${(questionCounter / MAX_QUESTIONS) * 100}%`;


  const questionIndex = Math.floor(Math.random() * availableQuestions.length);
  currentQuestion = availableQuestions[questionIndex];
  question.innerHTML = currentQuestion.question;
  choices.forEach(choice => {
    const number = choice.dataset["number"];
    choice.innerHTML = currentQuestion["choice" + number];
  });

  if (choices[0].innerText === "True" || choices[0].innerText === "False") {
    for (const element of elements) {
      element.style.visibility = 'hidden';
    }
  }
  else {
    for (const element of elements) {
      element.style.visibility = 'visible';
    }
  }

  availableQuestions.splice(questionIndex, 1);
  acceptingAnswers = true;

    
};




choices.forEach(choice => {
  choice.addEventListener("click", e => {
    if (!acceptingAnswers) return;

    acceptingAnswers = false;
    const selectedChoice = e.target;
    const selectedAnswer = selectedChoice.dataset["number"];

    const classToApply =
        selectedAnswer == currentQuestion.answer ? "correct" : "incorrect";

    if (classToApply === "correct") {
      incrementScore(CORRECT_BONUS);
    }

    selectedChoice.parentElement.classList.add(classToApply);

    setTimeout(() => {
      selectedChoice.parentElement.classList.remove(classToApply);
      getNewQuestion();
    }, 1000);
  });
});

incrementScore = num => {
  if (num > 0) {
    while (num > 0) {
      score++;
      num--;
    }
  }
  if (num < 0) {
    while (score < 0) {
      score--;
      num++;
    }
  }
  scoreText.innerText = score;
};
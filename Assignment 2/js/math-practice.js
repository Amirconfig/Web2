// Author:       Amir Hosein Khanmohammadi
// Student ID:   991646689


const startBtn = document.querySelector(".start-btn");
const note = document.querySelector(".note");
const questionEl = document.querySelector(".question");
const answer1El = document.querySelector("#answer1");
const answer2El = document.querySelector("#answer2");
const answer3El = document.querySelector("#answer3");
const scoreEl = document.querySelector(".score");
const restartBtn = document.querySelector(".restart-btn");
const timerDisplay = document.querySelector(".timer");
const textBox = document.querySelector(".textBox");


const questions = [
    {
      text: "What is 2 + 2?",
      answers: [
        { text: "3", correct: false },
        { text: "4", correct: true },
        { text: "5", correct: false }
      ]
    },
    {
      text: "What is 5 - 3?",
      answers: [
        { text: "2", correct: true },
        { text: "3", correct: false },
        { text: "4", correct: false }
      ]
    },
    {
      text: "What is 8 / 2?",
      answers: [
        { text: "3", correct: false },
        { text: "4", correct: true },
        { text: "5", correct: false }
      ]
    },
    {
      text: "What is 6 * 3?",
      answers: [
        { text: "16", correct: false },
        { text: "12", correct: false },
        { text: "18", correct: true }
      ]
    },
    {
      text: "What is 20 % 3?",
      answers: [
        { text: "1", correct: false },
        { text: "3", correct: false },
        { text: "2", correct: true }
      ]
    }
  ];

let currentQuestionIndex = 0;
let score = 0;
let timerInterval;
let timeLeft = 120;



startBtn.addEventListener("click", function() {
startPractice();
});

function loadQuestion() {
  if (currentQuestionIndex === questions.length) {
    currentQuestionIndex = 0;
    clearInterval(timerInterval);
    restartBtn.style.display = "none";

   } else{
    const currentQuestion = questions[currentQuestionIndex];
    questionEl.textContent = currentQuestion.text;
    answer1El.textContent = currentQuestion.answers[0].text;
    answer2El.textContent = currentQuestion.answers[1].text;
    answer3El.textContent = currentQuestion.answers[2].text;
    
   }
  }


function startPractice() {
startBtn.style.display = "none";
note.style.display = "none";
questionEl.style.display = "block";
answer1El.style.display = "inline-block";
answer2El.style.display = "inline-block";
answer3El.style.display = "inline-block";
scoreEl.style.display = "block";
timerDisplay.style.display = "block";

timerDisplay.textContent = `Time Left: ${timeLeft} seconds`;
timerInterval = setInterval(function() {
    timeLeft--;
    if (timeLeft >= 0) {
      timerDisplay.textContent = `Time Left: ${timeLeft} seconds`;
    }
    if (timeLeft === 0) {
        clearInterval(timerInterval);
        answer1El.removeEventListener("click", checkAnswer);
        answer2El.removeEventListener("click", checkAnswer);
        answer3El.removeEventListener("click", checkAnswer);
        restartBtn.style.display = "block";
      }
    }, 1000);

loadQuestion();
}



answer1El.addEventListener("click", function() {
    if ((timeLeft > 0)  && (currentQuestionIndex <=questions.length) ) {
        checkAnswer(0);
    }
});

answer2El.addEventListener("click", function() {
    if ((timeLeft > 0)  && (currentQuestionIndex <=questions.length)) {
        checkAnswer(1);
    }

});

answer3El.addEventListener("click", function() {
    if ((timeLeft > 0) && (currentQuestionIndex <=questions.length)) {
        checkAnswer(2);
    }
});



function checkAnswer(answerIndex) {
const currentQuestion = questions[currentQuestionIndex];
if (timeLeft === 0) {
    alert("Time's up! Please restart the quiz to answer questions again.");
    return;
  }
if (currentQuestion.answers[answerIndex].correct) {
    score++;
}
scoreEl.textContent = `Score: ${score}`;
if (currentQuestionIndex === questions.length-1) {
     currentQuestionIndex = 0;
     clearInterval(timerInterval);
     answer1El.style.display = "none";
     answer2El.style.display = "none";
     answer3El.style.display = "none";
     questionEl.style.display = "none";
     restartBtn.style.display = "block";
     textBox.style.display = "block";
} 
else {
  currentQuestionIndex++;
  loadQuestion();
}
}

restartBtn.addEventListener("click", function() {
    currentQuestionIndex = 0;
    score = 0;
    timeLeft = 120;
    scoreEl.textContent = `Score: ${score}`;
    restartBtn.style.display = "none";
    textBox.style.display = "none";

    startPractice();
});


    
  
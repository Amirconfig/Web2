const creditsElem = document.getElementById('credits');
const betElem = document.getElementById('bet-input');
const resultElem = document.getElementById('result');
const payoutElem = document.getElementById('payout');
const spinButton = document.getElementById('spin-button');
const resetButton = document.getElementById('reset-button');

let credits = 100;
let payout = 0;

function spin() {
    const bet = parseInt(betElem.value);
    if (credits < bet) {
      alert('You do not have enough credits to make this bet');
      return;
    }
    if (bet < 1 || bet > 10) {
      alert('Please enter a valid bet between 1 and 10');
      return;
    }
    const randomNumber = Math.floor(Math.random() * 10) + 1;
    resultElem.innerHTML = randomNumber;
    if (randomNumber === parseInt(betElem.value)) {
      payout = bet * 2;
      credits += payout;
    } else {
      payout = 0;
      credits -= bet;
    }
    creditsElem.innerHTML = `Credits: ${credits}`;
    payoutElem.innerHTML = `Payout: ${payout}`;
    if (credits === 0) {
      alert('You have run out of credits!');
      spinButton.disabled = true;
    }
  }
  

spinButton.addEventListener('click', spin);

resetButton.addEventListener('click', function() {
credits = 100;
payout = 0;
creditsElem.innerHTML = `Credits: ${credits}`;
payoutElem.innerHTML = `Payout: ${payout}`;
resultElem.innerHTML = '';
betElem.value = 1;
spinButton.disabled = false;
});


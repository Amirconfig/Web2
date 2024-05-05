<?php
session_start();

if (!isset($_SESSION['credits'])) {
  $_SESSION['credits'] = 100;
  $_SESSION['payout'] = 0;
}

if (isset($_POST['action'])) {
  if ($_POST['action'] === 'spin') {
    $bet = intval($_POST['bet']);
    if ($_SESSION['credits'] < $bet) {
      echo 'not_enough_credits';
    } else {
      $randomNumber = rand(1, 10);
      if ($randomNumber === intval($_POST['bet'])) {
        $_SESSION['payout'] = $bet * 2;
        $_SESSION['credits'] += $_SESSION['payout'];
      } else {
        $_SESSION['payout'] = 0;
        $_SESSION['credits'] -= $bet;
      }
      echo $randomNumber;
    }
  } else if ($_POST['action'] === 'reset') {
    session_unset();
    session_destroy();
  }
}
?>

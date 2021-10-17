<?php
  require_once 'dbconnect.inc.php';
  require_once 'functions.inc.php';

  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

  if (isset($_POST['submit'])) {

    $_SESSION['color'] = $_POST['submit'];
    updateUserColor($pdo, $_SESSION['user_id'], $_SESSION['color']);

    header("location: ../room");
    exit();
  }

  // Returns to index if URL for this page is manually typed in.
  else {
    header("location: ../");
    exit();
  }
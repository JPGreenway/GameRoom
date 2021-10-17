<?php 
  require_once 'dbconnect.inc.php';
  require_once 'functions.inc.php';

  if (session_status() === PHP_SESSION_NONE) {
   session_start();
  }

  if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    $pwdRepeat = $_POST['pwdrepeat'];

  // Signup Validation
    if (checkEmptySignupFields($username, $pwd, $pwdRepeat)) {
      header("location: ../signup?error=emptyinput");
      exit();
    }

    if (!checkPasswordMatchesRepeat($pwd, $pwdRepeat)) {
      header("location: ../signup?error=passwordsdontmatch");
      exit();
    }

    if (checkUsernameExists($pdo, $username)) {
      header("location: ../signup?error=usernametaken");
      exit();
    }

 // Executes if all checks above pass.
    addNewUser($pdo, $username, $pwd);
    header("location: ../?success");
    exit();
  } 
// Returns to index if URL for this page is manually typed in.
  else {
    header("location: ../");
    exit();
  }
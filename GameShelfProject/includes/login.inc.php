<?php

if (session_status() === PHP_SESSION_NONE) {
  session_start();
  
 require_once 'dbconnect.inc.php';
 require_once 'functions.inc.php';
 

}

if (isset($_POST['submit'])) {
  
  $pwd = $_POST['pwd'];
  $username = $_POST['username'];

  // Login Validation
  if (checkEmptyLoginFields($username, $pwd)) {
    header("location: ../?error=emptyinput");  
    exit();
  }

  if (!checkUsernameExists($pdo, $username)) {
    header("location: ../?error=usernamedoesntexist");
    exit();
  }

  if (!checkPasswordMatchesUsername($pdo, $username, $pwd)) {
    header("location: ../?error=incorrectpassword");
    exit();
  }

  // Executes if all checks above pass.
    $_SESSION['current_user'] = $username;
    $_SESSION['user_id'] = fetchUserId($pdo, $_SESSION['current_user']);
    $_SESSION['color'] = fetchUserColor($pdo, $_SESSION['user_id']);
    header("location: ../room");
    exit();
} 
// Returns to index if URL for this page is manually typed in.
else {
  header("location: ../");
  exit();
}
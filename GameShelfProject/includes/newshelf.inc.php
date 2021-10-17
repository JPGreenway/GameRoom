<?php
  require_once 'dbconnect.inc.php';
  require_once 'functions.inc.php';

  if (session_status() === PHP_SESSION_NONE) {
   session_start();
  }

  if (isset($_POST['submit'])) {
    addNewShelf($pdo, $_POST['shelf-title'], $_SESSION['user_id']);

    header("location: ../room"); 
    exit();
  }
  // Returns to index if URL for this page is manually typed in.
  else {
    header("location: ../");
    exit();
  }
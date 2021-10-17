<?php
  require_once 'dbconnect.inc.php';
  require_once 'functions.inc.php';

  if (session_status() === PHP_SESSION_NONE) {
   session_start();
  }

  if (isset($_POST['submit'])) {
    $shelf['shelf_id'] = $_POST['edit-shelf-shelf-id'];
    $shelf['title'] = $_POST['new-shelf-title'];
    
    updateShelf($pdo, $shelf);

    header('Location: ../room');
    exit();
  }
  // Returns to index if URL for this page is manually typed in.
  else {
    header("location: ../");
    exit();
  }
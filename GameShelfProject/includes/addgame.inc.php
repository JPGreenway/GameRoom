<?php
  require_once 'dbconnect.inc.php';
  require_once 'functions.inc.php';

  if (session_status() === PHP_SESSION_NONE) {
   session_start();
  }

  if (isset($_POST['submit'])) {

    // IMGAE UPLOAD HANDLING
    // Only doing file validation if a file is present.
    if ($_FILES["image"]["name"] !== "") {
      $targetFile = "../img/" . $_FILES["image"]["name"];
      $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
      $uploadOk = 1;

    // Check if a file with the same name already exists
    if (file_exists($targetFile)) {
      $uploadOk = 0;
    }

    // Limiting file size
    if ($_FILES["image"]["size"] > 2000000) {
      $uploadOk = 0;
    }

    // Only allows jpg, png, jpeg, gif.
    if ($imageFileType !== "jpg" && $imageFileType !== "png" && $imageFileType !== "jpeg" && $imageFileType !== "gif") {
      $uploadOk = 0;
    }

    // Upload file if all above checks pass.
    if ($uploadOk == 1) {
      move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
    } 
  }

  // Game details assignment & addNewGame function call
  $game['title'] = $_POST['gametitle'];
  $game['console'] = $_POST['console'];
  $game['genre'] = $_POST['genre'];
  $game['quality'] = $_POST['quality'];
  $game['version'] = $_POST['version'];
  $game['release_year'] = $_POST['releaseyear'];
  $game['shelf_id'] = $_POST['add-game-shelf-id'];
  $game['image'] = $_FILES["image"]["name"];
  
  // Validating the "game beaten?" checkbox.
  if (isset($_POST['gamebeaten'])) {
    $game['beaten'] = 1;
  } else {
    $game['beaten'] = 0;
  }

  addNewGame($pdo, $game);
  
  header("location: ../room");
  exit();
}
// Returns to index if URL for this page is manually typed in.
else {
  header("location: ../");
  exit();
}
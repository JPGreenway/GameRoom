<?php 
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Game Room - Login</title>
  <link rel="stylesheet" href="css/login.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>

<body>
  <h1 class="heading-primary">GAME ROOM</h1>

  <!-- Login Form -->
  <main class="container">
    <h2 class="heading-secondary">Account Login</h2>
    <form class="form" action="includes/login.inc.php" method="post" autocomplete="off">
      <input class="input controls" type="text" name="username" placeholder="Username...">
      <input class="input controls" type="password" name="pwd" placeholder="Password...">
      <button class="button controls" type="submit" name="submit">Login</button>
    </form>
    <a class="signup-link" href="signup">Create an account</a>
  </main>

  <?php

if (isset($_GET['success'])) {
  echo '<p class="error-text">Account successfully created, go ahead and login!</p>';
}

// Error handling
if (isset($_GET['error'])) {
  if ($_GET['error'] === 'usernamedoesntexist') {
    echo "<p class='error-text'>That username doesn't exist.</p>";
   }
  else if ($_GET['error'] === 'incorrectpassword') {
    echo "<p class='error-text'>That password is incorrect.</p>";
   }
  else if ($_GET['error'] === 'emptyinput') {
    echo "<p class='error-text'>Please fill in all input fields.</p>";
  }
  else if ($_GET['error'] === 'notloggedin') {
    echo "<p class='error-text'>Please login.</p>";
  }
 }
?>

</body>

</html>
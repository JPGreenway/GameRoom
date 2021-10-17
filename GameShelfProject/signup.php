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
  <title>Game Room - Create Account</title>
  <link rel="stylesheet" href="css/login.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>

<body>
  <h1 class="heading-primary">GAME ROOM</h1>
  <!-- Signup Form -->
  <main class="container">
    <!-- 'Go Back' Button -->
    <a href="." class="go-back"><svg xmlns="http://www.w3.org/2000/svg" class="go-back-icon" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
      </svg></a>
    <h2 class="heading-secondary">Sign Up</h2>
    <form class="form" action="includes/signup.inc.php" method="post" autocomplete="off">
      <input class="input controls" type="text" name="username" placeholder="Choose a username">
      <input class="input controls" type="password" name="pwd" placeholder="Choose a password">
      <input class="input controls" type="password" name="pwdrepeat" placeholder="Re-enter your password">
      <button class="button controls" type="submit" name="submit">Create Account</button>
    </form>

  </main>


  <!-- Error Handling -->
  <?php
  if (isset($_GET['error'])) {
    if($_GET['error'] === "emptyinput") {
      echo "<p class='error-text'>Please fill in all fields.</p>";
    }
    else if($_GET['error'] === "passwordsdontmatch") {
      echo "<p class='error-text'>Please enter matching passwords.</p>";
    }
    else if($_GET['error'] === "usernametaken") {
      echo "<p class='error-text'>That username is taken, please try another.</p>";
    }
  } ?>
</body>

</html>
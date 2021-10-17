<?php
  if (isset($_POST['submit'])) {
    session_start();
    session_destroy();
    header('Location: ../');
    exit();
  }
  // Returns to index if URL for this page is manually typed in.
  else {
    header("location: ../");
    exit();
  }
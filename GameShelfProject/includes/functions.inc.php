<?php
// SIGNUP & LOGIN FUNCTIONS
// Basic form checks
function checkPasswordMatchesRepeat($pwd, $pwdRepeat) {
  return ($pwd === $pwdRepeat);
}

function checkEmptyLoginFields($username, $pwd) {
  return ((empty($username) && !is_numeric($username)) || (empty($pwd) && !is_numeric($pwd))); 
}

function checkEmptySignupFields($username, $pwd, $pwdRepeat) {
  return (empty($username) || empty($pwd) || empty($pwdRepeat)); 
}

// DATABASE FUNCTIONS
// Database Selects
function checkUsernameExists($pdo, $username) {
  try {
   // Username exists if there is at least 1 row in this query.
   $result = $pdo->query("SELECT * FROM users WHERE username='$username'");
   return ($result->rowCount() > 0);
  }

  catch (PDOException $e) {
    header("location: error");
  }
}

function checkPasswordMatchesUsername($pdo, $username, $pwd) {
  try {
    $result = $pdo->query("SELECT * FROM users WHERE username='$username'");
    $hashedPwd = $result->fetch(PDO::FETCH_ASSOC)['pwd'];
    return password_verify($pwd, $hashedPwd);
  }
  catch (PDOException $e) {
    header("location: error");
  }
}

function fetchUserId($pdo, $username) {
  try {
    $result = $pdo->query("SELECT user_id FROM users WHERE username = '$username'");
    return $result->fetch(PDO::FETCH_ASSOC)['user_id'];
  }
  catch (PDOException $e) {
    header("location: error");
  }
}

function fetchUserColor($pdo, $userId) {
  try {
    $result = $pdo->query("SELECT color FROM users WHERE user_id = '$userId'");
    return $result->fetch(PDO::FETCH_ASSOC)['color'];
  }
  catch (PDOExeption $e) {
    header("location: error");
  }
}

function fetchGamesForShelf($pdo, $shelfId) {
  try {
    $result = $pdo->query("SELECT * FROM games WHERE shelf_id = '$shelfId'");
    return $result->fetchAll();
  }
  catch (PDOException $e) {
    header("location: error");
  }
}

function fetchUserShelves($pdo, $userId) {
  try {
    $result = $pdo->query("SELECT * FROM shelves WHERE user_id = '$userId'");
    return $result->fetchAll();
  }
  catch (PDOException $e) {
    header("location: error");
  }
}

function fetchShelfGameCount($pdo, $shelfId) {
  try {
    $result = $pdo->query("SELECT COUNT(*) FROM games WHERE shelf_id = '$shelfId'");
    return $result->fetch();
  }
  catch (PDOException $e) {
    header("location: error");
  }
}

function fetchGame($pdo, $gameId) {
  try {
    $result = $pdo->query("SELECT * FROM games WHERE game_id = '$gameId'");
    return $result->fetch();
  }
  catch (PDOException $e) {
    header("location: error");
  }
}

// Database Inserts
function addNewUser($pdo, $username, $pwd) {
  try {
    $username = strtolower($username);
    $pwd = password_hash($pwd, PASSWORD_DEFAULT);
    
    $s = $pdo->prepare('INSERT INTO users SET username = :username, pwd = :pwd');
    $s->bindValue(':username', $username);
    $s->bindValue(':pwd', $pwd);
    $s->execute();
  }
  catch (PDOException $e) {
    header("location: error");
  }
}

function addNewGame($pdo, $game) {
  try {
    $s = $pdo->prepare('INSERT INTO games SET title = :title, played = :played, console = :console, genre = :genre, quality = :quality, game_version = :game_version, release_year = :release_year, shelf_id = :shelf_id, image_path = :image_path');

    $s->bindValue(':title', $game['title']);
    $s->bindValue(':played', $game['beaten']);
    $s->bindValue(':console', $game['console']);
    $s->bindValue(':genre', $game['genre']);
    $s->bindValue(':quality', $game['quality']);
    $s->bindValue(':game_version', $game['version']);
    $s->bindValue(':release_year', $game['release_year']);
    $s->bindValue(':shelf_id', $game['shelf_id']);
    $s->bindValue(':image_path', $game['image']);

    $s->execute();
  }
  catch (PDOException $e) {
    header("location: error");
  }
}

function addNewShelf($pdo, $shelfTitle, $userId) {
  try {
    $s = $pdo->prepare('INSERT INTO shelves SET title = :title, user_id = :user_id');

    $s->bindValue(':title', $shelfTitle);
    $s->bindValue(':user_id', $userId);

    $s->execute();
  }
  catch (PDOException $e) {
    header("location: error");
  }
}

// Database Updates
function updateUserColor($pdo, $userId, $color) {
  try {
    $s = $pdo->prepare('UPDATE users SET color = :color WHERE user_id = :user_id');

    $s->bindValue(':color', $color);
    $s->bindValue(':user_id', $userId);

    $s->execute();
  }
  catch (PDOException $e) {
    header("location: error");
  }
}

function updateGame($pdo, $game) {
  try {
    $s = $pdo->prepare('UPDATE games SET title = :title, played = :played, console = :console, genre = :genre, quality = :quality, game_version = :game_version, release_year = :release_year, image_path = :image_path WHERE game_id = :game_id');

    $s->bindValue(':title', $game['title']);
    $s->bindValue(':played', $game['beaten']);
    $s->bindValue(':console', $game['console']);
    $s->bindValue(':genre', $game['genre']);
    $s->bindValue(':quality', $game['quality']);
    $s->bindValue('game_version', $game['version']);
    $s->bindValue(':release_year', $game['release_year']);
    $s->bindValue(':image_path', $game['image']);
    $s->bindValue(':game_id', $game['game_id']);

    $s->execute();
  }
  catch (PDOException $e) {
    header("location: error");
  }
}

function updateShelf($pdo, $shelf) {
  try {
    $s = $pdo->prepare('UPDATE shelves SET title = :title WHERE shelf_id = :shelf_id');

    $s->bindValue(':title', $shelf['title']);
    $s->bindValue(':shelf_id', $shelf['shelf_id']);

    $s->execute();
  }
  catch (PDOException $e) {
    header ("location: error");
  }
}

 // Database Deletes
 function deleteGame($pdo, $gameId) {
   try {
     $pdo->query("DELETE FROM games WHERE game_id = '$gameId'");
    }
    catch (PDOException $e) {
      header("locatoin: error");
    }
 }

 function deleteShelf($pdo, $shelfId) {
   try {
     $pdo->query("DELETE FROM shelves WHERE shelf_id = '$shelfId'");
    }
    catch (PDOException $e) {
      header("location: error");
    }
 }
 
 // Game Checking Functions

function checkGamePropertyExists($property) {
  if ($property) {
    echo '<h3>' . htmlspecialchars($property, ENT_QUOTES, 'UTF-8') . '</h3>';
  } else {
    echo '<h3>N/A</h3>';
  }
}

function checkGameBeaten($game) {
  if ($game) {
    echo '<h3>Yes</h3>';
  } else {
    echo '<h3>No</h3>';
  }
}

function checkGameImageExists($image) {
  if ($image) {
    echo '<img class="game-img" src="img/' . htmlspecialchars($image, ENT_QUOTES, 'UTF-8') . '"/>';
  } else {
    echo '<h3 class="image-unavailable">No Image Uploaded</h3>';
  }
}

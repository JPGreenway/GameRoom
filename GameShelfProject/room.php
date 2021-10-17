<?php
  require_once 'includes/dbconnect.inc.php';
  require_once 'includes/functions.inc.php';

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION['current_user'])) {
  header('Location: ./?error=notloggedin');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatibwle" content="IE=edge">
  <meta name="viewport" content="idth=device-width, initial-scale=1.0">
  <title>Game Room - View Room</title>
  <link rel="stylesheet" href="css/room.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>

<body onload="changeAccentColor('<?php echo $_SESSION['color']?>')">
  <nav class="navigation">
    <?php echo '<h1 class="heading-primary">' . htmlspecialchars($_SESSION['current_user'], ENT_QUOTES, 'UTF-8') . "'s Game Room</h1>"; ?>
    <div class="navigation-controls-container">
      <form action="includes/newshelf.inc.php" method="post" class="add-shelf-form">
        <input type="text" name="shelf-title" class="add-shelf-input" placeholder="Enter a shelf name"
          autocomplete="off">
        <button type="submit" name="submit" class="add-shelf-button">New Shelf</button>
      </form>

      <!-- Open / Close Settings Button -->
      <button onclick="toggleSettingsMenu()" class="user-settings-button"><svg class="user-settings-icon-1" fill="none"
          stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
          </path>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
          </path>
        </svg><svg xmlns="http://www.w3.org/2000/svg" class="user-settings-icon-2 hidden" fill="none"
          viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
  </nav>

  <!-- Shelves -->
  <main class="shelf-container">
    <?php include 'includes/shelfgenerator.inc.php'; ?>
  </main>

  <!-- MODALS: all hidden by default  -->
  <!-- "Add Game" Modal -->
  <div class="add-game-modal-container hidden">
    <div class="add-game-modal">
      <button onclick="toggleAddGameMenu()" class="close-modal-button">X</button>
      <h3>Add a new game</h3>
      <form class="add-game-form" action="includes/addgame.inc.php" method="post" enctype="multipart/form-data"
        autocomplete="off">
        <input id="add-game-shelf-id" type="hidden" name="add-game-shelf-id" value="">
        <input class="add-game-input" type="text" name="gametitle" placeholder="Game title...">
        <input class="add-game-input" type="text" name="console" placeholder="Console...">
        <input class="add-game-input" type="text" name="genre" placeholder="Genre...">
        <input class="add-game-input" type="text" name="quality" placeholder="Quality...">
        <input class="add-game-input" type="text" name="version" placeholder="Version...">
        <input class="add-game-input" type="text" name="releaseyear" placeholder="Release year...">
        <label for="image"> Upload Image </label>
        <input class="add-game-image" type="file" name="image" placeholder="none">
        <label for="gamebeaten"> Game Beaten? </label>
        <input class="game-beaten-checkbox" type="checkbox" name="gamebeaten">
        <button class="add-new-game-button" type="submit" name="submit">Add Game</button>
      </form>
    </div>
  </div>

  <!-- SETTINGS MODAL-->
  <div id="settings-modal" class="settings-modal hidden">
    <div id="my-settings-modal" class="my-settings-modal">
      <h3 class="settings-header">Settings</h3>

      <!-- Color Options -->
      <div class="color-container">
        <h4>UI Color</h4>
        <form class="color-form" method="post" action="includes/dbupdatecolor.inc.php">
          <button class="red-button color-button" value="Red" name="submit"></button>
          <button class="orange-button color-button" value="Orange" name="submit"></button>
          <button class="yellow-button color-button" value="Yellow" name="submit"></button>
          <button class="green-button color-button" value="Green" name="submit"></button>
          <button class="blue-button color-button" value="Blue" name="submit"></button>
          <button class="purple-button color-button" value="Purple" name="submit"></button>
        </form>
      </div>

      <!-- Logout Button -->
      <form action="includes/logout.inc.php" method="post" class="logout-form">
        <button type="submit" name="submit" class="logout-button"><svg xmlns="http://www.w3.org/2000/svg"
            class="logout-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
          </svg>Logout</button>
      </form>
    </div>
  </div>

  <script src="scripts/functions.js"></script>
  <script src="scripts/room.js"></script>
</body>

</html>
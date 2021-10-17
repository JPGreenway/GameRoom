<?php
  require_once 'includes/dbconnect.inc.php';
  require_once 'includes/functions.inc.php';

  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  $game = fetchGame($pdo, $_POST['submit']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Game Room - View Game</title>
  <link rel="stylesheet" href="css/game.css">
</head>

<body onload="changeAccentColor('<?php echo $_SESSION['color']?>')">
  <main class="game-info-container">

    <!-- LEFT SIDE OF PAGE-->
    <section class="game-details game-details-left">

      <!-- Game Image -->
      <div class="game-img-container">
        <?php checkGameImageExists($game['image_path']) ?>
      </div>

      <!-- Game Details Beneath Image -->
      <div class="detail-box-container">
        <div class="detail-box">
          <h2>Beaten?</h2>
          <?php checkGameBeaten($game['played']) ?>
        </div>

        <div class="detail-box">
          <h2>Quality</h2>
          <?php checkGamePropertyExists($game['quality']) ?>
        </div>

        <div class="detail-box">
          <h2>Version</h2>
          <?php checkGamePropertyExists($game['game_version']) ?>
        </div>
      </div>

      <!-- Edit Game & Delete Game Buttons -->
      <div class="game-button-container">
        <button onclick="toggleEditGameMenu()" class="game-button">Edit Game</button>
        <form action="includes/deletegame.inc.php" method="post">
          <button class="game-button" name="submit" value="<?php echo $game['game_id']?>">Delete Game</button>
        </form>
      </div>

    </section>

    <!-- RIGHT SIDE OF PAGE -->
    <section class="game-details game-details-right">
      <h2>Game Title</h2>
      <div>
        <?php checkGamePropertyExists($game['title']) ?>
      </div>

      <h2>System</h2>
      <div>
        <?php checkGamePropertyExists($game['console']) ?>
      </div>

      <h2>Genre</h2>
      <div>
        <?php checkGamePropertyExists($game['genre']) ?>
      </div>

      <h2>Release Year</h2>
      <div>
        <?php checkGamePropertyExists($game['release_year']) ?>
      </div>
    </section>

    <!-- Close Game Button -->
    <form class="close-game-form" action="room">
      <button class="x-button">
        <svg xmlns="http://www.w3.org/2000/svg" class="x-button-icon" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </form>

  </main>

  <!-- Edit Game Modal -->
  <div class="edit-game-modal-container hidden">
    <div class="edit-game-modal">
      <button onclick="toggleEditGameMenu()" class="x-button">
        <svg xmlns="http://www.w3.org/2000/svg" class="x-button-icon" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
      <h3>Edit Game Details</h3>
      <form class="edit-game-form" action="includes/editgame.inc.php" method="post" enctype="multipart/form-data"
        autocomplete="off">
        <input type="hidden" name="game_id" value="<?php echo $game['game_id'];?>">
        <input class="modal-input modal-controls" type="text" name="gametitle" placeholder="Game title...">
        <input class="modal-input modal-controls" type="text" name="console" placeholder="Console...">
        <input class="modal-input modal-controls" type="text" name="genre" placeholder="Genre...">
        <input class="modal-input modal-controls" type="text" name="quality" placeholder="Quality...">
        <input class="modal-input modal-controls" type="text" name="version" placeholder="Version...">
        <input class="modal-input modal-controls" type="text" name="releaseyear" placeholder="Release year...">
        <label for="image"> Upload Image </label>
        <input class="modal-image modal-controls" type="file" name="image" placeholder="none">
        <label for="gamebeaten"> Game Beaten? </label>
        <input class="modal-checkbox modal-controls" type="checkbox" name="gamebeaten">
        <button class="modal-button game-button" type="submit" name="submit">Save Changes</button>
      </form>
    </div>
  </div>

  <script src="scripts/functions.js"></script>
  <script src="scripts/game.js"></script>
</body>

</html>
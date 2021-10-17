<?php 
  $results = fetchGamesForShelf($pdo, $result['shelf_id']);
  foreach($results as $result) {
 ?>

<div class="game">
  <form class="game-form" type="submit" action="game" method="post">
    <button class="game-button" type="submit" name="submit" value="<?php echo $result['game_id']?>">

      <!-- Using image if one exists for current game, else using game title -->
      <?php if ($result['image_path']) {?>
      <img class="game-img" src="img/<?php echo $result['image_path']?>" />
      <?php } else { ?>
      <p class="game-title"><?php echo htmlspecialchars($result['title'], ENT_QUOTES, 'UTF-8')?></p>
      <?php } ?>

    </button>
  </form>
</div>

<!-- Closing foreach -->
<?php } ?>

<!-- Add Game -->
<button onclick="toggleAddGameMenu(this.id)" class="add-game-button" id="<?php echo $result['shelf_id']; ?>">Add
  Game</button>
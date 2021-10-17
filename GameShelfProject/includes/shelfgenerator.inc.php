<?php
  $results = fetchUserShelves($pdo, $_SESSION['user_id']);
  if ($results) { // If checks if there's at least one shelf before attempting to populate shelf list
    $shelfCounter = 1; // $shelfCounter allows for unique ID on each shelf.
    foreach($results as $result) {
      $games = fetchShelfGameCount($pdo, $result['shelf_id']);
?>
<div class="shelf">

  <!-- Shelf Expand Button -->
  <button onclick="expandGameContainer(this.id)" class="shelf-open"
    id="shelf-button-<?php echo strval($shelfCounter)?>">
    <svg xmlns="http://www.w3.org/2000/svg" class="shelf-open-icon" fill="none" viewBox="0 0 24 24"
      stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
    </svg>
  </button>

  <!-- Shelf Title / Game Count -->
  <div class="shelf-data">
    <span class="shelf-title">
      <?php echo htmlspecialchars($result['title'], ENT_QUOTES, 'UTF-8')?>
    </span>
    <span class="shelf-game-count">
      Games: <?=$games['COUNT(*)']?>
    </span>
  </div>

  <!-- Delete Shelf -->
  <form class="delete-shelf-form hidden" action="includes/deleteshelf.inc.php" method="post">
    <button class="delete-shelf-button" type="submit" name="submit" value="<?php echo $result['shelf_id']?>">
      Delete Shelf
    </button>
  </form>

  <!-- Edit Shelf Button-->
  <button onclick="toggleEditShelfMenu(this.value)" class="open-edit-shelf-button hidden"
    value="<?php echo $result['shelf_id']?>">
    Edit Shelf
  </button>

  <!-- Games -->
  <div class=" game-container">
    <?php include 'includes/gamegenerator.inc.php'?>
  </div>
</div>

<?php
  $shelfCounter++; }  // Increment $shelfCounter and close foreach 
  } else { // Close if, open else ?>

<!-- This shows if user has no shelves -->
<p class="no-shelf">Let's <span class="no-shelf-highlight">create</span> your first shelf!
  <svg xmlns="http://www.w3.org/2000/svg" class="no-shelf-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
  </svg>
</p>

<!-- Close else -->
<?php } ?>

<!-- Edit Shelf Modal -->
<div class="edit-shelf-modal-container hidden">
  <div class="edit-shelf-modal">
    <button onclick="toggleEditShelfMenu()" id="close-edit-shelf-modal-button"
      class="close-edit-shelf-modal-button">X</button>
    <h3>Edit Shelf Name</h3>
    <form class="edit-shelf-form" action="includes/editshelf.inc.php" method="post" autocomplete="off">
      <input id="edit-shelf-shelf-id" type="hidden" name="edit-shelf-shelf-id" value="">
      <input class="edit-shelf-input" type="text" name="new-shelf-title" placeholder="Enter a new shelf name">
      <button class="edit-shelf-button" type="submit" name="submit">Update Shelf</button>
    </form>
  </div>
</div>
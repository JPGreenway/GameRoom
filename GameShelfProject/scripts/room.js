function expandGameContainer(id) {
  // Toggles flex-wrap property to expand shelf
  document
    .getElementById(`${id}`)
    .nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.classList.toggle(
      "game-container-expanded"
    );

  // Rotates the expand shelf icon
  document
    .getElementById(`${id}`)
    .lastElementChild.classList.toggle("shelf-open-icon-rotated");

  // Toggles "Delete Shelf" button visibility
  document
    .getElementById(`${id}`)
    .nextElementSibling.nextElementSibling.classList.toggle("hidden");

  // Toggles "Edit Shelf" button visibility
  document
    .getElementById(`${id}`)
    .nextElementSibling.nextElementSibling.nextElementSibling.classList.toggle(
      "hidden"
    );
}

// MODAL HANDLING
function toggleAddGameMenu(shelf_id) {
  document
    .querySelector(".add-game-modal-container")
    .classList.toggle("hidden");
  document.getElementById("add-game-shelf-id").value = shelf_id;
}

function toggleSettingsMenu() {
  document.querySelector(".settings-modal").classList.toggle("hidden");
  document.querySelector(".user-settings-icon-1").classList.toggle("hidden");
  document.querySelector(".user-settings-icon-2").classList.toggle("hidden");
}

function toggleEditShelfMenu(shelf_id) {
  document
    .querySelector(".edit-shelf-modal-container")
    .classList.toggle("hidden");
  document.getElementById("edit-shelf-shelf-id").value = shelf_id;
}

// Closes either Edit Shelf or Add Game modals if they're open
// and user clicks outside of the modal.
window.onclick = function (event) {
  if (event.target === document.querySelector(".edit-shelf-modal-container")) {
    document
      .querySelector(".edit-shelf-modal-container")
      .classList.toggle("hidden");
  } else if (
    event.target === document.querySelector(".add-game-modal-container")
  ) {
    document
      .querySelector(".add-game-modal-container")
      .classList.toggle("hidden");
  }
};

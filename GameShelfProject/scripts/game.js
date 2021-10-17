function toggleEditGameMenu() {
  document
    .querySelector(".edit-game-modal-container")
    .classList.toggle("hidden");
}

window.onclick = function (event) {
  if (event.target === document.querySelector(".edit-game-modal-container")) {
    document
      .querySelector(".edit-game-modal-container")
      .classList.toggle("hidden");
  }
};

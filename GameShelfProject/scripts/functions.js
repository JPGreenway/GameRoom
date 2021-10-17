// Color changing functions
function changeAccentColor(color) {
  let css = "";

  switch (color) {
    case "Red":
      css = `--accent-color-main: rgb(200, 0, 0);
        --accent-color-highlight: rgb(230, 0, 0);
        --accent-color-transparent: rgba(200, 0, 0, 0.7)`;
      break;
    case "Orange":
      css = `--accent-color-main: rgb(240, 100, 0);
        --accent-color-highlight: rgb(255, 130, 0);
        --accent-color-transparent: rgba(240, 100, 0, 0.7)`;
      break;
    case "Yellow":
      css = `--accent-color-main: rgb(220, 160, 0);
      --accent-color-highlight: rgb(220, 180, 0);
      --accent-color-transparent: rgba(220, 170, 0, 0.7)`;
      break;
    case "Green":
      css = `--accent-color-main: rgb(0, 170, 0);
      --accent-color-highlight: rgb(0, 200, 0);
      --accent-color-transparent: rgba(0, 170, 0, 0.7)`;
      break;
    case "Blue":
      css = `--accent-color-main: rgb(0, 100, 240);
      --accent-color-highlight: rgb(0, 130, 240);
      --accent-color-transparent: rgba(0, 100, 240, 0.7)`;
      break;
    case "Purple":
      css = `--accent-color-main: rgb(160, 0, 240);
      --accent-color-highlight: rgb(170, 100, 240);
      --accent-color-transparent: rgba(160, 0, 240, 0.7)`;
      break;
  }

  document.querySelector(":root").style.cssText = css;
}

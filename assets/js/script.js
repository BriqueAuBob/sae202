const darkModeButton = document.getElementById("dark-mode-toggle");
const darkModeMediaQuery = window.matchMedia("(prefers-color-scheme: dark)");
const darkMode = localStorage.getItem("dark-mode");

const toggleDarkMode = (shouldSave = false, value = undefined) => {
  document.body.classList.toggle("dark", value);
  darkModeButton.children[0].setAttribute(
    "src",
    document.body.classList.contains("dark")
      ? "./assets/images/icons/sun.svg"
      : "./assets/images/icons/moon.svg"
  );
  darkModeButton.children[0].setAttribute(
    "alt",
    document.body.classList.contains("dark") ? "Sun Icon" : "Moon Icon"
  );

  if (shouldSave) {
    localStorage.setItem("dark-mode", document.body.classList.contains("dark"));
  }
};

if (darkMode === "true" || (darkModeMediaQuery.matches && darkMode === null)) {
  toggleDarkMode();
}
darkModeButton.addEventListener("click", () => {
  toggleDarkMode(true);
});
darkModeMediaQuery.addEventListener("change", (e) => {
  if (localStorage.getItem("dark-mode") === null) {
    toggleDarkMode(false, e.matches);
  }
});

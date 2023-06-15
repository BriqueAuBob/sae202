const mobileMenuButton = document.getElementById("menu-mobile-button");
const nav = document.querySelector("nav");
mobileMenuButton.addEventListener("click", () => {
  document.body.classList.toggle("overflow-hidden");
  nav.classList.toggle("hidden");
  nav.classList.toggle("open");
});

const darkModeButton = document.getElementById("dark-mode-toggle");
const darkModeMediaQuery = window.matchMedia("(prefers-color-scheme: dark)");
const darkMode = localStorage.getItem("dark-mode");

const toggleDarkMode = (shouldSave = false, value = undefined) => {
  document.body.classList.toggle("dark", value);
  darkModeButton.children[0].setAttribute(
    "src",
    document.body.classList.contains("dark")
      ? "/assets/images/icons/sun.svg"
      : "/assets/images/icons/moon.svg"
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

const saveChangesPopup = document.querySelector(".save_changes_popup");
if (saveChangesPopup) {
  const inputs = document.querySelectorAll("input, textarea", "select");
  inputs.forEach((input) => {
    if (input.getAttribute("data-no-trigger-save") !== null) return;
    input.addEventListener("input", (data) => {
      // if (!data.data) return;
      saveChangesPopup.classList.remove("hidden");
    });
  });
}

let currentModal = null;
function openModal(modalId) {
  const modal = document.getElementById(modalId);
  modal.classList.remove("hidden");
  document.body.classList.add("overflow-hidden");
  currentModal = modalId;
}

function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  modal.classList.add("hidden");
  document.body.classList.remove("overflow-hidden");
  currentModal = null;
}

function closeModalOnOutsideClick(e) {
  if (e.target.classList.contains("modal")) {
    closeModal(e.target.id);
  }
}

function closeModalOnEscape(e) {
  if (e.key === "Escape") {
    closeModal(currentModal);
  }
}

const modals = document.querySelectorAll(".modal");
modals.forEach((modal) => {
  modal.addEventListener("click", closeModalOnOutsideClick);
});
document.addEventListener("keydown", closeModalOnEscape);

const closeModalButton = document.querySelectorAll("[data-close-modal]");
closeModalButton.forEach((button) => {
  button.addEventListener("click", () => {
    closeModal(button.getAttribute("data-close-modal"));
  });
});

const demo = document.getElementById("demo");
if (demo) {
  const buttons = document.querySelectorAll("#demo .buttons .btn");
  let currentActive = document.querySelector("#demo .buttons .btn.active");
  buttons.forEach((button) => {
    button.addEventListener("click", () => {
      if (button.classList.contains("active")) return;
      currentActive.classList.remove("active");
      document.body.classList.remove("overflow-hidden");
      button.classList.add("active");
      currentActive = button;

      const demoContainer = document.getElementById(
        button.getAttribute("data-toggle")
      );
      const currentDemoContainer = document.querySelector(
        "#demo .col-2 > div:not(.hidden)"
      );
      currentDemoContainer.classList.add("hidden");
      demoContainer.classList.remove("hidden");
    });
  });
}

const fileInput = document.querySelectorAll("input[type=file]");
fileInput.forEach((input) => {
  input.addEventListener("change", () => {
    const file = input.files[0];
    const img = input.parentElement.querySelector("img");
    const reader = new FileReader();
    reader.onloadend = () => {
      img.src = reader.result;
    };
    if (file) {
      reader.readAsDataURL(file);
    }
  });
});

flatpickr("#calendar", {
  dateFormat: "Y-m-d H:i",
  minDate: "today",
  enableTime: true,
});

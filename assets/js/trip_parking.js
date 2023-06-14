const trip_form = document.querySelector("#trip_form");

const departure_city = document.querySelector("#departure_city");
const departure_options = document.querySelector("#departure_options");
const p1 = document.querySelector("#p1");
const p2 = document.querySelector("#p2");

const areas = document.querySelectorAll(".parking > path");
const departure_address = document.querySelector("#departure_address");

departure_options.style.display = "none";
p1.style.display = "none";
p2.style.display = "none";

departure_city.addEventListener("input", () => {
  let city = departure_city.value.toLowerCase();
  if (city == "troyes") {
    departure_options.style.display = "block";
  } else {
    departure_options.style.display = "none";
    p1.style.display = "none";
    p2.style.display = "none";
  }
});

departure_options.addEventListener("change", () => {
  let option = departure_options.value;
  departure_address.value = "";

  if (option == "p1") {
    p1.style.display = "block";
    p2.style.display = "none";
  } else if (option == "p2") {
    p2.style.display = "block";
    p1.style.display = "none";
  } else {
    p1.style.display = "none";
    p2.style.display = "none";
  }
});

areas.forEach((area) => {
  area.addEventListener("click", () => {
    let id = area.getAttribute("id");

    departure_address.value = id;
  });
});

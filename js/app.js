var navMenu = document.getElementById("navMenu");
var startX; // Position de départ du toucher

navMenu.addEventListener("show.bs.collapse", function () {
  setTimeout(function () {
    navMenu.classList.remove("collapsed");
    navMenu.classList.add("collapsing");
  }, 1);
});

navMenu.addEventListener("hide.bs.collapse", function () {
  navMenu.classList.remove("collapsing");
  navMenu.classList.add("collapsed");
});

navMenu.addEventListener("touchstart", function (e) {
  startX = e.touches[0].clientX; // Enregistrez la position de départ du toucher
});

navMenu.addEventListener("touchmove", function (e) {
  var currentX = e.touches[0].clientX;
  var distance = currentX - startX;

  if (distance > 50) {
    // Si le geste de balayage va vers la droite (distance positive),
    // fermez le menu
    navMenu.classList.remove("collapsing");
    navMenu.classList.add("collapsed");
  }
});

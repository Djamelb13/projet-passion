var navMenu = document.getElementById("navMenu");
var startX; // Position de départ du toucher

// Ajoutez un gestionnaire d'événements pour le clic sur la croix
document.querySelector(".btn-close").addEventListener("click", function() {
  navMenu.classList.remove("collapsing");
  navMenu.classList.add("collapsed");
});

navMenu.addEventListener("touchstart", function (e) {
  startX = e.touches[0].clientX; // Enregistrez la position de départ du toucher
});

navMenu.addEventListener("touchmove", function (e) {
  var currentX = e.touches[0].clientX;
  var distance = currentX - startX;

  if (distance > 0) {
    // Si le balayage va vers la droite (distance positive),
    // fermez le menu
    navMenu.classList.remove("collapsing");
    navMenu.classList.add("collapsed");
  }
});
var menuButton = document.querySelector(".d-xl-none");

// Ajoutez un gestionnaire d'événements pour le clic sur le bouton "Menu"
menuButton.addEventListener("click", function() {
  // Vérifiez si le menu est déjà fermé
  if (navMenu.classList.contains("collapsed")) {
    // Si le menu est fermé, réactivez-le
    navMenu.classList.remove("collapsed");
    navMenu.classList.add("collapsing");
  } else {
    // Si le menu est ouvert, fermez-le
    navMenu.classList.remove("collapsing");
    navMenu.classList.add("collapsed");
  }
});
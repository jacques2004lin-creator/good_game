// On récupère les éléments HTML par leur ID
const profileBtn = document.getElementById("profileBtn");
const sideMenu = document.getElementById("sideMenu");

// On écoute le clic sur l'image de profil
profileBtn.addEventListener("click", function (event) {
  // On ajoute ou on enlève la classe "active" au menu
  sideMenu.classList.toggle("active");

  // Empêche l'événement de se propager (évite que le menu se ferme direct)
  event.stopPropagation();
});

// On ferme le menu si l'utilisateur clique ailleurs sur la page
window.addEventListener("click", function (event) {
  if (sideMenu.classList.contains("active")) {
    sideMenu.classList.remove("active");
  }
});

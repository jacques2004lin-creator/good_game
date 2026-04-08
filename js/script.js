// On récupère les éléments HTML
const profileBtn = document.getElementById("profileBtn");
const sideMenu = document.getElementById("sideMenu");

// Menu burger
const burgerBtn = document.getElementById('burgerBtn');
const navLinks = document.getElementById('navLinks');

profileBtn.addEventListener("click", function (event) {
  // On ajoute ou on enlève la classe "active" au menu
  sideMenu.classList.toggle("active");

  navLinks.classList.remove('active'); 

  // Empêche l'événement de se propager (évite que le menu se ferme direct)
  event.stopPropagation();
});

// On ferme le menu si l'utilisateur clique ailleurs sur la page
window.addEventListener("click", function (event) {
  if (sideMenu.classList.contains("active")) {
    sideMenu.classList.remove("active");
  }
});

// On ajoute ou on enlève la classe "active" au menu
burgerBtn.addEventListener('click', () => {
  navLinks.classList.toggle('active');
});

// Ferme automatiquement le menu burger si l'utilisateur clique n'importe ou sur la page
document.addEventListener('click', (e) => {
  if (!burgerBtn.contains(e.target) && !navLinks.contains(e.target)) {
    navLinks.classList.remove('active');
  }
});
import Route from "./route.js";

export const websiteName = "ÉcoRide - Le premier site de covoiturage écologique";

export const allRoutes = [
  new Route("/", "Bienvenue", "pages/home.html"),
  new Route("/covoiturer", "Covoiturer", "pages/covoiturer.html"),
  new Route("/trajets", "Trajets", "pages/les-trajets.html"),
  new Route("/contact", "Contact", "pages/contact.html"),
  new Route("/connexion", "Connexion", "pages/connexion.html"),
  new Route("/inscription", "Inscription", "pages/inscription.html"),
  new Route("/membres", "Membres", "pages/membres.html")

];
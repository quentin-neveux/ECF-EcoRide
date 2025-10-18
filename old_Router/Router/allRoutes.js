import Route from "./route.js";

export const websiteName = "EcoRide";

export const allRoutes = [
  new Route("home", "Bienvenue", "pages/home.php"),
  new Route("covoiturer", "Covoiturer", "pages/covoiturer.php"),
  new Route("inscription", "Inscription", "pages/inscription.php"),
  new Route("connexion", "Connexion", "pages/connexion.php"),
  new Route("contact", "Contact", "pages/contact.html"),
  new Route("recherche", "Recherche", "pages/recherche.php"),
];
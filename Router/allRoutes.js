import Route from "./route.js";

export const websiteName = "EcoRide";

export const allRoutes = [
  new Route("home", "Accueil", "pages/home.html"),
  new Route("covoiturer", "Covoiturer", "pages/covoiturer.php"),
  new Route("les-trajets", "Les trajets", "pages/les-trajets.php"),
  new Route("inscription", "Inscription", "pages/inscription.php"),
  new Route("connexion", "Connexion", "pages/connexion.php"),
  new Route("contact", "Contact", "pages/contact.html")
];
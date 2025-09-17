import Route from "./route.js";

export const websiteName = "EcoRide";

export const allRoutes = [
  new Route("home", "Accueil", "pages/home.html"),
  new Route("covoiturer", "Covoiturer", "pages/covoiturer.html"),
  new Route("les-trajets", "Les trajets", "pages/les-trajets.html"),
  new Route("inscription", "Inscription", "pages/inscription.html"),
  new Route("connexion", "Connexion", "pages/connexion.html"),
  new Route("contact", "Contact", "pages/contact.html")
];
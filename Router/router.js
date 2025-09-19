import Route from "./route.js";
import { allRoutes, websiteName } from "./allRoutes.js";

// Route 404 (fallback)
const route404 = new Route("404", "Page introuvable", "pages/404.html");

// Normalise le chemin à partir du hash
const normalizePath = () => {
  // On récupère ce qu’il y a après #
  let path = window.location.hash.replace("#", "");

  // Cas accueil
  if (path === "" || path === "index.html") {
    return "home";
  }

  // Retourne le chemin normalisé
  return path;
};

// Trouve une route à partir d'une URL
const getRouteByUrl = (url) => {
  return allRoutes.find(r => r.url === url) ?? route404;
};

//  Met à jour l’état actif dans la navbar
const updateActiveNavLink = (currentPath) => {
  document.querySelectorAll(".navbar-nav .nav-link").forEach(link => {
    link.classList.remove("active");
  });

  const activeLink = document.querySelector(`.navbar-nav .nav-link[href="#${currentPath}"]`);
  if (activeLink) {
    activeLink.classList.add("active");
  }
};

// Charge et injecte une page
const LoadContentPage = async () => {
  let path = normalizePath();
  const actualRoute = getRouteByUrl(path);

  try {
    const res = await fetch(actualRoute.pathHtml, { cache: "no-store" });
    if (!res.ok) throw new Error(`HTTP ${res.status}`);
    const html = await res.text();

    document.getElementById("main-page").innerHTML = html;
    document.title = `${actualRoute.title} - ${websiteName}`;

    // Mets à jour la navbar après le rendu
    updateActiveNavLink(path);
  } catch (err) {
    console.error(err);
    document.getElementById("main-page").innerHTML = `
      <div class="container py-5">
        <div class="alert alert-danger">
          Impossible de charger <code>${actualRoute.pathHtml}</code>.
        </div>
      </div>`;
    document.title = `Erreur - ${websiteName}`;

    // Mets à jour aussi dans le cas d’une erreur
    updateActiveNavLink("404");
  }
};

// Intercepte les clics sur <a data-link>
const routeEvent = (event) => {
  const a = event.target.closest("a[data-link]");
  if (!a) return;

  event.preventDefault();
  const href = a.getAttribute("href") || "#home";

  // Met à jour le hash (déclenche popstate)
  window.location.hash = href;
  LoadContentPage();
};

// Écouteurs globaux
document.addEventListener("click", routeEvent);
window.addEventListener("popstate", LoadContentPage);

// Premier rendu
LoadContentPage();

// Router/router.js
import Route from "./route.js";                  // ✅
import { allRoutes, websiteName } from "./allRoutes.js";

// Route 404 (fallback)
const route404 = new Route("/404", "Page introuvable", "pages/404.html");

// Trouve une route à partir d'une URL
const getRouteByUrl = (url) => {
  let currentRoute = null;
  for (const r of allRoutes) {
    if (r.url === url) {
      currentRoute = r;
      break;
    }
  }
  return currentRoute ?? route404;
};

// Normalise le chemin (évite les surprises)
const normalizePath = (path) => {
  // /index.html ou /  => /
  if (path === "/index.html" || path === "") return "/";
  return path;
};

// Charge et injecte le fragment HTML + JS optionnel
const LoadContentPage = async () => {
  let path = normalizePath(window.location.pathname);
  const actualRoute = getRouteByUrl(path);

  try {
    const res = await fetch(actualRoute.pathHtml, { cache: "no-store" });
    if (!res.ok) throw new Error(`HTTP ${res.status} sur ${actualRoute.pathHtml}`);
    const html = await res.text();
    const outlet = document.getElementById("main-page");
    if (!outlet) {
      console.error("Zone d'injection #main-page introuvable.");
      return;
    }
    outlet.innerHTML = html;

    // Charge le JS spécifique si défini
    if (actualRoute.pathJS && actualRoute.pathJS !== "") {
      const scriptTag = document.createElement("script");
      scriptTag.type = "text/javascript";
      scriptTag.src = actualRoute.pathJS;
      document.body.appendChild(scriptTag);
    }

    // Titre d'onglet
    document.title = `${actualRoute.title} - ${websiteName}`;
  } catch (err) {
    console.error(err);
    document.getElementById("main-page").innerHTML = `
      <div class="container py-5">
        <div class="alert alert-danger">
          Impossible de charger <code>${actualRoute.pathHtml}</code>.
        </div>
      </div>`;
    document.title = `Erreur - ${websiteName}`;
  }
};

// Intercepte les clics sur <a data-link> pour navigation SPA
const routeEvent = (event) => {
  const a = event.target.closest('a[data-link]');
  if (!a) return;

  // Clics "nouvel onglet" ou modifiés : on laisse le navigateur gérer
  if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey || event.button === 1) return;

  event.preventDefault();
  const href = a.getAttribute("href") || "/";
  const path = normalizePath(href);

  // Met à jour l'URL sans recharger
  window.history.pushState({}, "", path);
  LoadContentPage();
};

// Écouteurs globaux
document.addEventListener("click", routeEvent);
window.addEventListener("popstate", LoadContentPage);

// Premier rendu
LoadContentPage();

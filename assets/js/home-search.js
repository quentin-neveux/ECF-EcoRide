document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("search-form");
  const results = document.getElementById("results");

  if (!form) return;

  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const depart = document.getElementById("ville_depart").value;
    const arrivee = document.getElementById("ville_arrivee").value;
    const date = document.getElementById("date_depart").value;

    try {
      const response = await fetch(
        `backend/trajet/search.php?depart=${encodeURIComponent(depart)}&arrivee=${encodeURIComponent(arrivee)}&date=${encodeURIComponent(date)}`
      );

      if (!response.ok) throw new Error("Erreur de serveur");

      const html = await response.text();
      results.innerHTML = html;
    } catch (error) {
      results.innerHTML = `<div class="alert alert-danger mt-3">Erreur : ${error.message}</div>`;
    }
  });
});

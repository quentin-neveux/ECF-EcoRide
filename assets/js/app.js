document.addEventListener("DOMContentLoaded", () => {
  console.log("✅ app.js chargé"); // Test simple

  const logoutLink = document.getElementById("logoutLink");
  if (logoutLink) {
    logoutLink.addEventListener("click", (e) => {
      e.preventDefault();

      const confirmLogout = confirm("Voulez-vous vraiment vous déconnecter ?");
      if (confirmLogout) {
        console.log("🚪 Déconnexion confirmée");
        window.location.href = "backend/user/logout.php";
      } else {
        console.log("❌ Déconnexion annulée");
      }
    });
  } else {
    console.warn("⚠️ logoutLink introuvable dans le DOM.");
  }
});

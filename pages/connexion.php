<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- Hero login -->
<section class="hero-login d-flex align-items-center justify-content-center text-center">
  <div class="text-white">
    <h1 class="display-5 fw-bold">Accédez à votre compte</h1>
  </div>
</section>

<!-- Formulaire -->
<section class="d-flex align-items-center justify-content-center py-5 bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6">
        <div class="card shadow p-4 rounded-4">
          <h2 class="text-center mb-4">Se connecter</h2>

          <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
  <div class="alert alert-success text-center" role="alert">
    ✅ Votre compte a bien été créé ! Vous pouvez maintenant vous connecter.
  </div>
<?php endif; ?>


          <!-- Ici, on redirige vers le vrai script PHP -->
          <form action="backend/user/login.php" method="POST" novalidate>

            <!-- Email -->
            <div class="mb-3">
              <label for="email" class="form-label">Adresse e-mail</label>
              <input type="email" class="form-control" id="email" name="email" required>
              <div class="invalid-feedback">Entre ton adresse e-mail.</div>
            </div>

            <!-- Mot de passe -->
            <div class="mb-3">
              <label for="mot_de_passe" class="form-label">Mot de passe</label>
              <div class="input-group">
                <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
                <button class="btn btn-outline-secondary" type="button" id="togglePwd">Afficher</button>
              </div>
              <div class="invalid-feedback">Entre ton mot de passe.</div>
            </div>

            <!-- Bouton -->
            <button type="submit" class="btn btn-ecoride w-100">Se connecter</button>

            <p class="text-center mt-3 mb-0">
              Pas encore de compte ? <a href="index.php?page=inscription" class="text-success">S’inscrire</a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Script validation et affichage mot de passe -->
<script>
  (function () {
    const form = document.querySelector("form");
    const pwd = document.getElementById("mot_de_passe");
    const toggle = document.getElementById("togglePwd");

    // Afficher / masquer le mot de passe
    toggle.addEventListener("click", () => {
      const type = pwd.type === "password" ? "text" : "password";
      pwd.type = type;
      toggle.textContent = type === "password" ? "Afficher" : "Masquer";
    });

    // Validation Bootstrap
    form.addEventListener("submit", function (event) {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add("was-validated");
    }, false);
  })();
</script>

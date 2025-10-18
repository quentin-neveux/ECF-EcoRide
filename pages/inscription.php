<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!-- Hero -->
<section class="hero-inscription d-flex align-items-center justify-content-center text-center text-white">
  <div>
    <h1 class="display-5 fw-bold">Vite, rejoins-nous !</h1>
    <p class="lead mb-4">
      Crée ton compte et rejoins la communauté !
    </p>
  </div>
</section>

<!-- Formulaire -->
<section class="d-flex align-items-center justify-content-center py-5 bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6">
        <div class="card shadow p-4 rounded-4">
          <h2 class="text-center mb-4">Créer un compte</h2>

          <form id="register-form" action="backend/user/register.php" method="post" novalidate>

            <!-- Identité -->
            <div class="row g-3">
              <div class="col-md-6">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
                <div class="invalid-feedback">Indique ton prénom.</div>
              </div>
              <div class="col-md-6">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
                <div class="invalid-feedback">Indique ton nom.</div>
              </div>
            </div>

            <!-- Email -->
            <div class="mt-3">
              <label for="email" class="form-label">Adresse e-mail</label>
              <input type="email" class="form-control" id="email" name="email" required>
              <div class="form-text">Nous n'utiliserons jamais ton e-mail pour du spam (c’est vraiment pas écolo).</div>
              <div class="invalid-feedback">Entre une adresse e-mail valide.</div>
            </div>

            <!-- Téléphone (optionnel, non encore stocké en BDD mais prêt pour plus tard) -->
            <div class="mt-3">
              <label for="telephone" class="form-label">Téléphone (optionnel)</label>
              <input type="tel" class="form-control" id="telephone" name="telephone">
            </div>

            <!-- Mot de passe -->
            <div class="mt-3">
              <label for="mot_de_passe" class="form-label">Mot de passe</label>
              <div class="input-group">
                <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required minlength="8">
                <button class="btn btn-outline-secondary" type="button" id="togglePwd">Afficher</button>
              </div>
              <div class="form-text">8 caractères minimum.</div>
              <div class="invalid-feedback">Mot de passe trop court.</div>
            </div>

            <!-- Confirmation -->
            <div class="mt-3">
              <label for="password_confirm" class="form-label">Confirmer le mot de passe</label>
              <input type="password" class="form-control" id="password_confirm" required>
              <div class="invalid-feedback">Les mots de passe ne correspondent pas.</div>
            </div>

            <!-- CGU -->
            <div class="form-check mt-4">
              <input class="form-check-input" type="checkbox" value="1" id="cgu" required>
              <label class="form-check-label" for="cgu">
                J’accepte les <a href="index.php?page=cgu" class="text-success">conditions d’utilisation</a>.
              </label>
              <div class="invalid-feedback">Tu dois accepter les conditions.</div>
            </div>

           <!-- Bouton -->
            <button type="submit" class="btn btn-ecoride w-100">Créer mon compte</button>

            <p class="text-center mt-3 mb-0">
              Déjà inscrit ? <a href="index.php?page=connexion" class="text-success">Se connecter</a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Script validation & affichage mot de passe -->
<script>
  (function () {
    const form = document.getElementById('register-form');
    const pwd = document.getElementById('mot_de_passe');
    const pwd2 = document.getElementById('password_confirm');
    const toggle = document.getElementById('togglePwd');

    // Toggle afficher/masquer le mot de passe
    toggle.addEventListener('click', () => {
      const type = pwd.type === 'password' ? 'text' : 'password';
      pwd.type = type;
      toggle.textContent = type === 'password' ? 'Afficher' : 'Masquer';
    });

    // Vérifie la correspondance des mots de passe
    function checkMatch() {
      if (pwd2.value && pwd.value !== pwd2.value) {
        pwd2.setCustomValidity('Les mots de passe ne correspondent pas');
      } else {
        pwd2.setCustomValidity('');
      }
    }
    pwd.addEventListener('input', checkMatch);
    pwd2.addEventListener('input', checkMatch);

    // Validation Bootstrap
    form.addEventListener('submit', function (event) {
      checkMatch();
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  })();
</script>

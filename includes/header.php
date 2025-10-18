<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>

<nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">
  <div class="container d-flex align-items-center">
    <a class="navbar-brand text-white fw-bold me-4" href="index.php?page=home">
      <h2>EcoRide</h2>
    </a>

    <!-- Burger -->
    <button class="navbar-toggler ms-auto" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav mb-2 mb-lg-0 align-items-center">

        <?php if (isset($_SESSION['prenom'])): ?>
          <!-- Utilisateur connecté -->
          <li class="nav-item mx-3">
            <a href="index.php?page=profil" 
               class="nav-link text-white <?= ($_GET['page'] ?? '') === 'profil' ? 'active text-success' : '' ?>">
               Mon profil
            </a>
          </li>

          <li class="nav-item mx-3">
            <a href="index.php?page=mes-trajets" 
               class="nav-link text-white <?= ($_GET['page'] ?? '') === 'mes-trajets' ? 'active text-success' : '' ?>">
               Mes trajets
            </a>
          </li>

          <li class="nav-item mx-3">
            <a href="index.php?page=historique" 
               class="nav-link text-white <?= ($_GET['page'] ?? '') === 'historique' ? 'active text-success' : '' ?>">
               Historique
            </a>
          </li>

          <li class="nav-item mx-3">
            <span class="nav-link text-white">
              Bonjour <?= htmlspecialchars($_SESSION['prenom']) ?>
            </span>
          </li>

          <li class="nav-item mx-3">
            <a id="logoutLink"
               href="#"
               class="nav-link text-danger fw-semibold">
               Déconnexion
            </a>
          </li>

        <?php else: ?>
          <!-- Utilisateur non connecté -->
          <li class="nav-item mx-3">
            <a href="index.php?page=covoiturer" 
               class="nav-link text-white <?= ($_GET['page'] ?? '') === 'covoiturer' ? 'active text-success' : '' ?>">
               Covoiturer
            </a>
          </li>

          <li class="nav-item mx-3">
            <a href="index.php?page=recherche" 
               class="nav-link text-white <?= ($_GET['page'] ?? '') === 'recherche' ? 'active text-success' : '' ?>">
               Rechercher
            </a>
          </li>

          <li class="nav-item mx-3">
            <a href="index.php?page=on-parle-de-nous" 
               class="nav-link text-white <?= ($_GET['page'] ?? '') === 'on-parle-de-nous' ? 'active text-success' : '' ?>">
               On parle de nous
            </a>
          </li>

          <li class="nav-item mx-3">
            <a href="index.php?page=inscription" class="nav-link text-white">S’inscrire</a>
          </li>

          <li class="nav-item mx-3">
            <a href="index.php?page=connexion" class="nav-link text-white">Connexion</a>
          </li>
        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>

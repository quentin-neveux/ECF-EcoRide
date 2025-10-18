<?php
require_once __DIR__ . '/../backend/auth/check_auth.php';
?>

<section class="hero-trajets d-flex align-items-center justify-content-center text-center text-white">
  <div>
    <h1 class="display-5 fw-bold">Mes trajets</h1>
    <p class="lead mb-0">Gère ici tes annonces de covoiturage ou tes réservations.</p>
  </div>
</section>

<section class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="m-0">Mes trajets</h3>
    <a href="#" class="btn btn-success disabled">+ Ajouter un trajet (bientôt)</a>
  </div>

  <div class="card shadow p-4 rounded-4">
    <p class="text-center text-muted mb-4">Tu n’as encore aucun trajet enregistré 🚗</p>
  </div>
</section>

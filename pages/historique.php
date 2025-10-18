<?php
require_once __DIR__ . '/../backend/auth/check_auth.php';
?>

<section class="hero-historique d-flex align-items-center justify-content-center text-center text-white">
  <div>
    <h1 class="display-5 fw-bold">Mon historique</h1>
    <p class="lead mb-0">Retrouve ici tes trajets passés et à venir.</p>
  </div>
</section>

<section class="container py-5">
  <div class="card shadow p-4 rounded-4">
    <h3 class="text-center mb-4">Historique de tes trajets</h3>
    <p class="text-center text-muted mb-4">Aucun trajet enregistré pour le moment 🚙</p>

    <!-- Table de trajets (préparation future) -->
    <table class="table table-striped text-center">
      <thead class="table-success">
        <tr>
          <th scope="col">Date</th>
          <th scope="col">Départ</th>
          <th scope="col">Arrivée</th>
          <th scope="col">Statut</th>
        </tr>
      </thead>
      <tbody>
        <!-- Exemple statique pour l’instant -->
        <tr>
          <td>15/10/2025</td>
          <td>Lyon</td>
          <td>Grenoble</td>
          <td><span class="badge bg-secondary">Terminé</span></td>
        </tr>
      </tbody>
    </table>
  </div>
</section>

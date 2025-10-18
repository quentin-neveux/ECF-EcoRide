<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- Hero -->
<section class="hero-home text-white text-center position-relative d-flex flex-column justify-content-between">
  <!-- Bloc titres centré -->
<div class="hero-title-wrapper text-center">
  <h1 class="display-4 fw-bold">EcoRide</h1>
  <h4>Changeons d'air, pas de Terre.</h4>
</div>

<!-- Barre de recherche EcoRide -->
<div class="eco-searchbar">
  <form id="search-form" class="eco-search-form mx-auto" action="/pages/recherche.php" method="get">
    <div class="row g-0">
      <div class="col eco-search-field rounded-start d-flex align-items-center">
        <i class="fa-solid fa-location-dot me-2"></i>
        <input type="text" id="ville_depart" name="depart" placeholder="Départ" required class="form-control border-0 bg-transparent">
      </div>
      <div class="col eco-search-field d-flex align-items-center">
        <i class="fa-solid fa-location-arrow me-2"></i>
        <input type="text" id="ville_arrivee" name="arrivee" placeholder="Arrivée"  class="form-control border-0 bg-transparent">
      </div>
      <div class="col eco-search-field d-flex align-items-center">
        <i class="fa-regular fa-calendar me-2"></i>
        <input type="date" id="date_depart" name="date" class="form-control border-0 bg-transparent">
      </div>
      <div class="col-auto eco-search-button rounded-end d-flex align-items-center">
        <button type="submit" class="btn btn-ecoride">Rechercher</button>
      </div>
    </div>
  </form>
</div>
</section>

<!-- Présentation -->
<section class="py-5">
  <div class="container text-center">
    <h2 class="fw-bold mb-4 text-primary">Pourquoi EcoRide ?</h2>
    <p class="lead">EcoRide est le premier site de covoiturage écologique favorisant l'utilisation de véhicules électriques. Devant l'inaction de nos gouvernements, c'est à nous de prendre les choses en main.</p>
    <h2 class="fw-bold text-primary">Parce que la planète ne peut pas attendre.</h2>
    <p class="lead">En choisissant EcoRide, vous faites un choix sur le long terme, en investissant dans un avenir plus durable pour tous.</p>

    <div class="row g-4">
      <div class="col-md-4">
        <i class="bi bi-car-front fs-1 text-primary"></i>
        <h5 class="mt-3">Écologique</h5>
        <p>Des véhicules électriques (en grande partie) et partagés pour réduire l'empreinte carbone.</p>
      </div>
      <div class="col-md-4">
        <i class="bi bi-wallet2 fs-1 text-primary"></i>
        <h5 class="mt-3">Économique</h5>
        <p>Un service flexible et abordable, pour vos trajets quotidiens ou occasionnels.</p>
      </div>
      <div class="col-md-4">
        <i class="bi bi-people fs-1 text-primary"></i>
        <h5 class="mt-3">Collaboratif</h5>
        <p>Une communauté qui partage le même objectif : respecter l'environnement.</p>
      </div>
    </div>
  </div>
</section>

<!-- Résultats de recherche -->
<div id="results" class="container mt-4"></div>

<script src="assets/js/home-search.js" defer></script>
</body>
</html>
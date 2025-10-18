<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../backend/database.php';

// Récupération des filtres
$ville_depart = $_GET['ville_depart'] ?? null;
$ville_arrivee = $_GET['ville_arrivee'] ?? null;

$sql = "SELECT * FROM trajets WHERE 1=1";
$params = [];

if ($ville_depart) {
    $sql .= " AND ville_depart = :ville_depart";
    $params[':ville_depart'] = $ville_depart;
}
if ($ville_arrivee) {
    $sql .= " AND ville_arrivee = :ville_arrivee";
    $params[':ville_arrivee'] = $ville_arrivee;
}

$sql .= " ORDER BY date_depart ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$trajets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Hero Recherche -->
<section class="hero-recherche d-flex align-items-center justify-content-center text-center">
  <div class="text-white">
    <h1 class="display-5 fw-bold">
      <?= $ville_depart && $ville_arrivee ? 
        "Résultats : $ville_depart ↔ $ville_arrivee" : 
        "Rechercher un trajet" ?>
    </h1>
    <p class="lead mb-4">Trouvez le trajet qui vous convient, au bon moment et au bon prix.</p>
  </div>
</section>

<!-- Résultats -->
<section class="py-5 bg-light">
  <div class="container">
    <?php if ($trajets): ?>
      <div class="row g-4">
        <?php foreach ($trajets as $trajet): ?>
          <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                  <i class="bi bi-geo-alt fs-4 text-primary me-2"></i>
                  <h5 class="card-title mb-0">
                    <?= htmlspecialchars($trajet['ville_depart']) ?> ↔ <?= htmlspecialchars($trajet['ville_arrivee']) ?>
                  </h5>
                </div>
                <p class="card-text text-secondary"><?= htmlspecialchars($trajet['infos']) ?></p>
                <ul class="list-unstyled small mb-3">
                  <li><i class="bi bi-calendar"></i> Départ le <?= date('d/m/Y à H:i', strtotime($trajet['date_depart'])) ?></li>
                  <li><i class="bi bi-people"></i> <?= $trajet['nb_places'] ?> places disponibles</li>
                  <li><i class="bi bi-cash"></i> <?= number_format($trajet['prix'], 2, ',', ' ') ?> €</li>
                </ul>
                <button class="btn btn-success w-100 fw-bold">Réserver</button>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <p class="text-center text-muted fs-5">
        Aucun trajet trouvé pour cette recherche.<br>
        <a href="index.php?page=covoiturer" class="btn btn-outline-success mt-3">Voir les trajets populaires</a>
      </p>
    <?php endif; ?>
  </div>
</section>

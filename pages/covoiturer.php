<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

require_once __DIR__ . '/../backend/database.php';

// Récupère les paramètres de filtrage si présents dans l'URL
$ville_depart = $_GET['ville_depart'] ?? null;
$ville_arrivee = $_GET['ville_arrivee'] ?? null;

// Préparation de la requête SQL
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

<!-- Hero Section -->
<section class="hero-covoiturer d-flex align-items-center justify-content-center text-center">
  <div class="text-white">
    <h1 class="display-5 fw-bold">Covoiturer, c'est mieux à plusieurs</h1>
    <p class="lead mb-4">Réduisez vos coûts, votre CO₂… et gardez le plaisir de la route.</p>
    <a href="index.php?page=inscription" class="btn btn-light btn-lg px-4">Devenir membre</a>
  </div>
</section>

<!-- Popular Trips Section -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="fw-bold text-primary mb-4 text-center">Trajets fréquemment réservés</h2>
    <div class="row g-4">
      <?php
      $popular_trips = [
        ["title" => "Paris ↔ Lyon", "description" => "Axe très fréquenté, idéal pour partager et réduire les coûts.", "link" => "index.php?page=recherche&ville_depart=Paris&ville_arrivee=Lyon"],
        ["title" => "Paris ↔ Marseille", "description" => "Long trajet, parfait pour optimiser un véhicule bien rempli.", "link" => "index.php?page=recherche&ville_depart=Paris&ville_arrivee=Marseille"],
        ["title" => "Paris ↔ Bordeaux", "description" => "Trajet régulier semaine/week-end, bons horaires partagés.", "link" => "index.php?page=recherche&ville_depart=Paris&ville_arrivee=Bordeaux"],
        ["title" => "Lyon ↔ Marseille", "description" => "Relier Rhône et Méditerranée au meilleur coût carbone.", "link" => "index.php?page=recherche&ville_depart=Lyon&ville_arrivee=Marseille"],
        ["title" => "Annecy ↔ Genève", "description" => "Beaucoup de frontaliers : pratique pour les départs en semaine.", "link" => "index.php?page=recherche&ville_depart=Annecy&ville_arrivee=Genève"],
        ["title" => "Marseille ↔ Bordeaux", "description" => "Transversale sud-ouest : covoit' souvent plus pertinent.", "link" => "index.php?page=recherche&ville_depart=Marseille&ville_arrivee=Bordeaux"],
        ["title" => "Lyon ↔ Grenoble", "description" => "Trajet montagneux, idéal pour les amateurs de paysages.", "link" => "index.php?page=recherche&ville_depart=Lyon&ville_arrivee=Grenoble"],
        ["title" => "Paris ↔ Rouen", "description" => "Métro, boulot, écolo.", "link" => "index.php?page=recherche&ville_depart=Paris&ville_arrivee=Rouen"],
        ["title" => "Nantes ↔ Rennes", "description" => "Pour débattre si Nantes et Rennes sont en Bretagne...", "link" => "index.php?page=recherche&ville_depart=Nantes&ville_arrivee=Rennes"]
      ];

      
        foreach ($popular_trips as $index => $trip):
          $city_class = "trip-" . ($index + 1); // ex: trip-1, trip-2...
        ?>
          <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm <?= $city_class ?>">
              <div class="card-body text-white d-flex flex-column justify-content-between">
                <div>
                  <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-geo-alt fs-4 me-2"></i>
                    <h5 class="card-title mb-0"><?= htmlspecialchars($trip['title']) ?></h5>
                  </div>
                  <p class="card-text"><?= htmlspecialchars($trip['description']) ?></p>
                </div>
                <a href="<?= htmlspecialchars($trip['link']) ?>" class="btn btn-light fw-bold mt-auto">Voir les trajets</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>

    </div>
  </div>
</section>

<!-- Engagement Section -->
<section class="py-5">
  <div class="container">
    <h2 class="fw-bold text-primary mb-3 text-center">Notre engagement pour l'environnement</h2>
    <p class="lead mb-3 text-center">
      Réduire l'empreinte carbone des déplacements, c'est jouer sur 4 leviers simples :
    </p>
    <div class="row g-4">
      <?php
      $engagements = [
        ["icon" => "bi-people", "title" => "Mutualiser les trajets", "description" => "Covoiturer augmente le taux de remplissage et divise l'impact par passager."],
        ["icon" => "bi-ev-front", "title" => "Électrifier progressivement", "description" => "Priorité aux motorisations électriques."],
        ["icon" => "bi-arrow-left-right", "title" => "Mixer les modes", "description" => "Train + covoit' d'approche, vélo + bus… le bon mix au bon moment."],
        ["icon" => "bi-graph-down", "title" => "Sobriété utile", "description" => "Optimiser les trajets indispensables, éviter ceux qui ne le sont pas."]
      ];

      foreach ($engagements as $e): ?>
        <div class="col-md-6 d-flex">
          <i class="<?= $e['icon'] ?> fs-3 text-primary me-3"></i>
          <div>
            <h5 class="mb-1"><?= $e['title'] ?></h5>
            <p class="mb-0"><?= $e['description'] ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Call to Action -->
<section class="py-5">
  <div class="container">
    <div class="p-4 p-md-5 bg-secondary text-white rounded-3 shadow-sm d-flex flex-column flex-md-row align-items-md-center justify-content-between">
      <div class="mb-3 mb-md-0">
        <h3 class="fw-bold mb-1">Rejoignez la communauté EcoRide</h3>
        <p class="mb-0">Publiez des trajets, réservez en quelques clics et suivez vos économies de CO₂.</p>
      </div>
      <a href="index.php?page=inscription" class="btn btn-light btn-lg mt-3 mt-md-0">Devenir membre</a>
    </div>
  </div>
</section>

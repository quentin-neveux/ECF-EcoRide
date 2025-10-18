<?php
require_once __DIR__ . '/../backend/auth/check_auth.php';
require_once __DIR__ . '/../backend/database.php';

// ID de l'utilisateur connecté
$userId = $_SESSION['user_id'];

try {
    // Récupère les infos depuis la base
    $stmt = $pdo->prepare("
        SELECT prenom, nom, email, date_inscription
        FROM utilisateurs
        WHERE id = :id
    ");
    $stmt->execute([':id' => $userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "<div class='alert alert-danger text-center m-4'>Utilisateur introuvable.</div>";
        exit;
    }
} catch (PDOException $e) {
    echo "<div class='alert alert-danger text-center m-4'>Erreur : " . htmlspecialchars($e->getMessage()) . "</div>";
    exit;
}
?>

<!-- Hero -->
<section class="hero-profil d-flex align-items-center justify-content-center text-center text-white">
  <div>
    <h1 class="display-5 fw-bold">Mon profil</h1>
    <p class="lead mb-0">Bienvenue dans ton espace personnel, <?= htmlspecialchars($user['prenom']); ?> 🌱</p>
  </div>
</section>

<!-- Contenu -->
<section class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
      <div class="card shadow p-4 rounded-4">
        <h3 class="text-center mb-4">Informations du compte</h3>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><strong>Prénom :</strong> <?= htmlspecialchars($user['prenom']); ?></li>
          <li class="list-group-item"><strong>Nom :</strong> <?= htmlspecialchars($user['nom']); ?></li>
          <li class="list-group-item"><strong>Email :</strong> <?= htmlspecialchars($user['email']); ?></li>
          <li class="list-group-item"><strong>Inscrit depuis :</strong>
            <?= date('d/m/Y à H:i', strtotime($user['date_inscription'])); ?>
          </li>
        </ul>

        <div class="text-center mt-4">
          <a href="#" class="btn btn-outline-success disabled">Modifier mes infos (à venir)</a>
        </div>
      </div>
    </div>
  </div>
</section>

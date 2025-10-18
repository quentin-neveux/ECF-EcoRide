<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

require_once __DIR__ . '/../backend/database.php';

// Vérifie que seul un administrateur puisse y accéder
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header('Location: index.php?page=connexion');
  exit();
}

// Traitement du formulaire
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $titre   = trim($_POST['titre']);
  $resume  = trim($_POST['resume']);
  $tag     = trim($_POST['tag']);
  $lien    = trim($_POST['lien']);
  $image   = trim($_POST['image']);

  if ($titre && $resume) {
    $stmt = $pdo->prepare("
      INSERT INTO articles (titre, resume, image, tag, lien)
      VALUES (:titre, :resume, :image, :tag, :lien)
    ");
    $stmt->execute([
      ':titre'  => $titre,
      ':resume' => $resume,
      ':image'  => $image,
      ':tag'    => $tag,
      ':lien'   => $lien
    ]);
    $message = "<div class='alert alert-success'>Article ajouté avec succès ✅</div>";
  } else {
    $message = "<div class='alert alert-danger'>Veuillez remplir tous les champs obligatoires.</div>";
  }
}
?>

<section class="hero-news d-flex align-items-center justify-content-center text-center text-white">
  <div>
    <h1 class="display-5 fw-bold">Ajouter un article 📰</h1>
    <p class="lead mb-0">Interface réservée aux administrateurs EcoRide.</p>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container">
    <h2 class="fw-bold text-primary mb-4 text-center">Nouvel article</h2>
    <?= $message ?>

    <form method="post" class="card shadow p-4 rounded-4 bg-white mx-auto" style="max-width:700px;">
      <div class="mb-3">
        <label for="titre" class="form-label fw-semibold">Titre *</label>
        <input type="text" name="titre" id="titre" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="resume" class="form-label fw-semibold">Résumé *</label>
        <textarea name="resume" id="resume" rows="4" class="form-control" required></textarea>
      </div>

      <div class="mb-3">
        <label for="image" class="form-label fw-semibold">URL de l’image (ex: assets/images/articles/monarticle.jpg)</label>
        <input type="text" name="image" id="image" class="form-control">
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="tag" class="form-label fw-semibold">Tag</label>
          <input type="text" name="tag" id="tag" class="form-control" placeholder="Innovation, Écologie…">
        </div>
        <div class="col-md-6 mb-3">
          <label for="lien" class="form-label fw-semibold">Lien de l’article (facultatif)</label>
          <input type="url" name="lien" id="lien" class="form-control" placeholder="https://exemple.com/article">
        </div>
      </div>

      <div class="text-center mt-4">
        <button type="submit" class="btn btn-success btn-lg px-4">Publier</button>
      </div>
    </form>
  </div>
</section>

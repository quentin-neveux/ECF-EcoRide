<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

require_once __DIR__ . '/../backend/functions.php';
require_once __DIR__ . '/../backend/database.php';

// Récupération des articles
$articles = getArticles($pdo);
?>

<section class="py-5 bg-light">
  <div class="container">
    <h2 class="fw-bold text-primary mb-5 text-center">Articles & mentions</h2>

    <div class="row g-4">
      <?php foreach ($articles as $article): ?>
        <?php
        // Gestion du chemin de l’image
        $imagePath = !empty($article['image'])
            ? '../' . htmlspecialchars($article['image'])
            : '../assets/images/articles/default.jpg';
        ?>

        <div class="col-md-6 col-lg-4">
          <div class="card h-100 shadow-sm border-0">
            <img src="<?= $imagePath ?>"
                 class="card-img-top"
                 alt="<?= htmlspecialchars($article['titre']) ?>">

            <div class="card-body">
              <span class="badge bg-success-subtle text-success fw-semibold mb-2">ACTUALITÉ</span>
              <h5 class="card-title fw-bold text-dark"><?= htmlspecialchars($article['titre']) ?></h5>

              <?php if (!empty($article['resume'])): ?>
                <p class="card-text text-secondary">
                  <?= htmlspecialchars($article['resume']) ?>
                </p>
              <?php endif; ?>
              
              <a href="<?= htmlspecialchars($article['lien']) ?>"
                 target="_blank"
                 rel="noopener noreferrer"
                 class="btn btn-outline-success">
                 Lire l’article <i class="bi bi-box-arrow-up-right"></i>
              </a>
            </div>
          </div>
        </div>

      <?php endforeach; ?>
    </div>
  </div>
</section>

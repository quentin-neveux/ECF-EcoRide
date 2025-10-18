<?php
// Sécurité : on démarre la session seulement si nécessaire
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <?php include __DIR__ . '/includes/head.php'; ?>
</head>

<body class="d-flex flex-column min-vh-100">

  <!-- Header / Navbar -->
  <?php include __DIR__ . '/includes/header.php'; ?>

  <!-- Contenu principal -->
  <main class="flex-grow-1">
    <?php
      // Routage simple
      $page = $_GET['page'] ?? 'home';
      $file = __DIR__ . "/pages/$page.php";

      if (file_exists($file)) {
        include $file;
      } else {
        include __DIR__ . "/pages/404.php";
      }
    ?>
  </main>

  <!-- Footer -->
  <?php include __DIR__ . '/includes/footer.php'; ?>

  <!-- Scripts locaux -->
  <script src="assets/js/bootstrap.bundle.min.js" defer></script>
  <script src="assets/js/app.js" defer></script>
</body>
</html>

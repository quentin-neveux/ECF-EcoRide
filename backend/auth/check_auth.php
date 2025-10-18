<?php
// Toujours vérifier qu’une session est active avant de faire quoi que ce soit
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Si aucun utilisateur connecté, on redirige vers la page de connexion
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../index.php?page=connexion&auth=required");
    exit;
}

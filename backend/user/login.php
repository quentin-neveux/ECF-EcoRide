<?php
session_start();
require_once __DIR__ . '/../database.php';

// Vérifie que le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';

    if (empty($email) || empty($mot_de_passe)) {
        exit("❌ Tous les champs sont obligatoires.");
    }

    try {
        // On récupère l'utilisateur
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        if (!$user) {
            exit("⚠️ Aucun compte trouvé avec cette adresse e-mail.");
        }

        // Vérifie le mot de passe
        if (password_verify($mot_de_passe, $user['mot_de_passe'])) {

            // Connexion réussie → on crée la session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['prenom'] = $user['prenom'];
            $_SESSION['nom'] = $user['nom'];
            $_SESSION['email'] = $user['email'];

            // Redirection vers la page d'accueil
            header("Location: ../../index.php?page=home");
            exit;

        } else {
            exit("❌ Mot de passe incorrect.");
        }

    } catch (PDOException $e) {
        exit("Erreur serveur : " . $e->getMessage());
    }

} else {
    exit("⛔ Méthode non autorisée.");
}

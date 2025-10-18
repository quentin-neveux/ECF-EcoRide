<?php
require_once __DIR__ . '/../database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prenom = trim($_POST['prenom'] ?? '');
    $nom = trim($_POST['nom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';

    if (empty($prenom) || empty($nom) || empty($email) || empty($mot_de_passe)) {
        exit("❌ Tous les champs sont obligatoires.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        exit("❌ Adresse e-mail invalide.");
    }

    try {
        // Vérifie si l'email existe déjà
        $check = $pdo->prepare("SELECT id FROM utilisateurs WHERE email = ?");
        $check->execute([$email]);
        if ($check->fetch()) {
            exit("⚠️ Cet e-mail est déjà enregistré.");
        }

        // Hash du mot de passe
        $hash = password_hash($mot_de_passe, PASSWORD_BCRYPT);

        // Insertion
        $stmt = $pdo->prepare("
            INSERT INTO utilisateurs (prenom, nom, email, mot_de_passe)
            VALUES (:prenom, :nom, :email, :mot_de_passe)
        ");
        $stmt->execute([
            ':prenom' => $prenom,
            ':nom' => $nom,
            ':email' => $email,
            ':mot_de_passe' => $hash
        ]);

        // ✅ Redirection après succès
        header("Location: ../../index.php?page=connexion&success=1");
        exit;

    } catch (PDOException $e) {
        exit("❌ Erreur lors de l’inscription : " . $e->getMessage());
    }

} else {
    echo "⛔ Méthode non autorisée.";
}

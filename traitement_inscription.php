<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Connexion à la base de données
$host = 'db';
$dbname = 'ecoride';
$user = 'root';
$pass = 'admin';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}


// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $prenom = htmlspecialchars(trim($_POST['firstname']));
    $nom = htmlspecialchars(trim($_POST['lastname']));
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $telephone = isset($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : null;
    $password = $_POST['password'];
    $confirmPassword = $_POST['password_confirm'];
    $conditions = isset($_POST['cgu']);

    if (!$email || empty($prenom) || empty($nom) || empty($password) || !$conditions) {
        die("Veuillez remplir tous les champs obligatoires et accepter les conditions.");
    }

    if ($password !== $confirmPassword) {
        die("Les mots de passe ne correspondent pas.");
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO utilisateurs (prenom, nom, email, telephone, mot_de_passe, date_creation) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$prenom, $nom, $email, $telephone, $passwordHash]);

        // 🔁 Redirection après inscription réussie
        header("Location: connexion.php"); 
        exit;
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo "Un compte avec cette adresse e-mail existe déjà.";
        } else {
            echo "Erreur : " . $e->getMessage();
        }
    }
} else {
    echo "Méthode non autorisée.";
}


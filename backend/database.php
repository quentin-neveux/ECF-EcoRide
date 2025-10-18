<?php
// backend/database.php

$host = getenv('DB_HOST') ?: 'db';           // Nom du service Docker (par défaut : "db")
$dbname = getenv('DB_NAME') ?: 'ecoride';    // Nom de ta base
$username = getenv('DB_USER') ?: 'root';     // Utilisateur
$password = getenv('DB_PASSWORD') ?: 'root'; // Mot de passe

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Exceptions sur erreurs SQL
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Résultats associatifs
        PDO::ATTR_EMULATE_PREPARES => false, // Vrais prepared statements
    ]);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

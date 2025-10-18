<?php
require_once __DIR__ . '/database.php'; // Connexion à la BDD

header('Content-Type: application/json');

// Récupération des paramètres GET envoyés par la requête
$depart = $_GET['depart'] ?? null;
$arrivee = $_GET['arrivee'] ?? null;
$date = $_GET['date'] ?? null;

// Construction dynamique de la requête
$sql = "SELECT t.*, u.nom AS conducteur, v.marque, v.modele
        FROM trajets t
        JOIN users u ON t.conducteur_id = u.id
        JOIN vehicules v ON t.vehicule_id = v.id
        WHERE 1=1";

$params = [];

// Filtres
if (!empty($depart)) {
    $sql .= " AND t.depart = :depart";
    $params[':depart'] = $depart;
}

if (!empty($arrivee)) {
    $sql .= " AND t.arrivee = :arrivee";
    $params[':arrivee'] = $arrivee;
}

if (!empty($date)) {
    $sql .= " AND DATE(t.date_heure) = :date";
    $params[':date'] = $date;
}

$sql .= " ORDER BY t.date_heure ASC";

// Exécution
try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $trajets = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($trajets);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => "Erreur serveur : " . $e->getMessage()]);
}
?>

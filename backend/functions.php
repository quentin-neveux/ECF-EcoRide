<?php
function getOgImage($url) {
    $cacheDir = __DIR__ . '/../cache/og/';
    if (!is_dir($cacheDir)) mkdir($cacheDir, 0777, true);

    $hash = md5($url);
    $cacheFile = $cacheDir . $hash . '.txt';

    // 1️⃣ si déjà en cache
    if (file_exists($cacheFile)) {
        return trim(file_get_contents($cacheFile));
    }

    // 2️⃣ sinon on va chercher la page distante
    $context = stream_context_create([
        'http' => ['timeout' => 5, 'user_agent' => 'EcoRideBot/1.0']
    ]);
    $html = @file_get_contents($url, false, $context);
    if (!$html) return null;

    // 3️⃣ on récupère la balise OG:image
    if (preg_match('/<meta property="og:image" content="([^"]+)"/i', $html, $m)) {
        $ogImage = $m[1];
        file_put_contents($cacheFile, $ogImage);
        return $ogImage;
    }

    return null;
}

function getArticles(PDO $pdo): array {
    $sql = "SELECT id, titre, image, resume, lien 
            FROM articles 
            ORDER BY id DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

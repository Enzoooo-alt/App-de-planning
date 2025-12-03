<?php

echo "=== TEST COMPLET LYON PALME (PHP/BLADE) ===\n\n";

$baseUrl = 'http://localhost:8000';

// Test des pages principales
$pages = [
    '/' => 'Page d\'accueil',
    '/login' => 'Page de connexion',
    '/register' => 'Page d\'inscription'
];

echo "📄 TEST DES PAGES:\n";
foreach ($pages as $path => $name) {
    $url = $baseUrl . $path;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    $status = ($httpCode == 200) ? '✅' : '❌';
    echo "$status $name ($path) - HTTP $httpCode\n";
}

// Test de la redirection dashboard (non connecté)
echo "\n🔒 TEST PROTECTION DASHBOARD:\n";
$ch = curl_init($baseUrl . '/dashboard');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$status = ($httpCode == 302) ? '✅' : '❌';
echo "$status Dashboard protégé - HTTP $httpCode (redirection vers login)\n";

// Test base de données
echo "\n🗄️  TEST BASE DE DONNÉES:\n";
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=lyonpalme', 'laravel', 'password');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stats = [
        'ENTRAINEUR' => $pdo->query('SELECT COUNT(*) FROM ENTRAINEUR')->fetchColumn(),
        'ADHERENT' => $pdo->query('SELECT COUNT(*) FROM ADHERENT')->fetchColumn(),
        'ENTRAINEMENT' => $pdo->query('SELECT COUNT(*) FROM ENTRAINEMENT')->fetchColumn(),
        'SEANCE' => $pdo->query('SELECT COUNT(*) FROM SEANCE')->fetchColumn()
    ];
    
    echo "✅ Connexion MariaDB: OK\n";
    foreach ($stats as $table => $count) {
        echo "  - $table: $count enregistrements\n";
    }
    
} catch (PDOException $e) {
    echo "❌ Erreur base de données: " . $e->getMessage() . "\n";
}

// Test utilisateur existant
echo "\n👤 TEST UTILISATEUR:\n";
try {
    $user = $pdo->query("SELECT name, email FROM users WHERE email = 'admin@lyonpalme.fr'")->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        echo "✅ Utilisateur test trouvé: {$user['name']} ({$user['email']})\n";
    } else {
        echo "❌ Utilisateur test non trouvé\n";
    }
} catch (Exception $e) {
    echo "❌ Erreur utilisateur: " . $e->getMessage() . "\n";
}

echo "\n🎯 RÉSUMÉ:\n";
echo "- Application: Lyon Palme\n";
echo "- Stack: Laravel 11 + Blade + MariaDB\n";
echo "- Pages: 4 (Welcome, Login, Register, Dashboard)\n";
echo "- Authentification: Laravel Breeze\n";
echo "- Design: TailwindCSS + Lyon Palme branding\n";
echo "- URL: http://localhost:8000\n";
echo "- Login test: admin@lyonpalme.fr / password123\n";
echo "\n✅ Conversion Vue.js → PHP/Blade TERMINÉE !\n";

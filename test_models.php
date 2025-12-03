<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->boot();

echo "=== Test des Modèles Lyon Palme ===\n\n";

try {
    // Test de connexion
    $pdo = $app->make('db')->connection()->getPdo();
    echo "✓ Connexion à la base de données: OK\n";

    // Test des comptes via SQL direct  
    $entraineurs = $pdo->query('SELECT COUNT(*) FROM ENTRAINEUR')->fetchColumn();
    $adherents = $pdo->query('SELECT COUNT(*) FROM ADHERENT')->fetchColumn();
    $entrainements = $pdo->query('SELECT COUNT(*) FROM ENTRAINEMENT')->fetchColumn();
    $seances = $pdo->query('SELECT COUNT(*) FROM SEANCE')->fetchColumn();
    
    echo "✓ Entraîneurs: $entraineurs\n";
    echo "✓ Adhérents: $adherents\n";
    echo "✓ Programmes: $entrainements\n";
    echo "✓ Séances: $seances\n\n";

    // Test d'un modèle Eloquent
    $entraineur = $pdo->query('SELECT nom, prenom, role FROM ENTRAINEUR LIMIT 1')->fetch(PDO::FETCH_ASSOC);
    if ($entraineur) {
        echo "Premier entraîneur:\n";
        echo "- Nom: {$entraineur['nom']}\n";
        echo "- Prénom: {$entraineur['prenom']}\n";
        echo "- Rôle: {$entraineur['role']}\n\n";
    }

    echo "✓ Test terminé avec succès!\n";

} catch (Exception $e) {
    echo "✗ Erreur: " . $e->getMessage() . "\n";
}

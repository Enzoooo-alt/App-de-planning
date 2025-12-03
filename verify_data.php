<?php

// Vérification des données Lyon Palme
$host = '127.0.0.1';
$username = 'laravel';
$password = 'password';
$database = 'lyonpalme';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "=== RAPPORT DES DONNÉES LYON PALME ===\n\n";
    
    // Statistiques générales
    $stats = [
        'ENTRAINEUR' => $pdo->query('SELECT COUNT(*) FROM ENTRAINEUR')->fetchColumn(),
        'ADHERENT' => $pdo->query('SELECT COUNT(*) FROM ADHERENT')->fetchColumn(),
        'ENTRAINEMENT' => $pdo->query('SELECT COUNT(*) FROM ENTRAINEMENT')->fetchColumn(),
        'SEANCE' => $pdo->query('SELECT COUNT(*) FROM SEANCE')->fetchColumn(),
        'COMMENTAIRE' => $pdo->query('SELECT COUNT(*) FROM COMMENTAIRE')->fetchColumn()
    ];
    
    echo "STATISTIQUES:\n";
    foreach ($stats as $table => $count) {
        echo "- $table: $count\n";
    }
    echo "\n";
    
    // Détail des entraîneurs
    echo "ENTRAÎNEURS:\n";
    $entraineurs = $pdo->query('SELECT nom, prenom, role FROM ENTRAINEUR')->fetchAll(PDO::FETCH_ASSOC);
    foreach ($entraineurs as $entraineur) {
        echo "- {$entraineur['prenom']} {$entraineur['nom']} ({$entraineur['role']})\n";
    }
    echo "\n";
    
    // Programmes d'entraînement
    echo "PROGRAMMES D'ENTRAÎNEMENT:\n";
    $programmes = $pdo->query('
        SELECT e.titre, e.dateCreation, en.nom, en.prenom 
        FROM ENTRAINEMENT e 
        JOIN ENTRAINEUR en ON e.idEntraineur = en.idEntraineur 
        ORDER BY e.dateCreation
    ')->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($programmes as $prog) {
        echo "- {$prog['titre']} (par {$prog['prenom']} {$prog['nom']}) - {$prog['dateCreation']}\n";
    }
    echo "\n";
    
    // Séances à venir
    echo "SÉANCES PLANIFIÉES:\n";
    $seances = $pdo->query('
        SELECT s.dateSeance, s.heureDebut, s.heureFin, e.titre
        FROM SEANCE s
        JOIN ENTRAINEMENT e ON s.idEntrainement = e.idEntrainement
        ORDER BY s.dateSeance, s.heureDebut
    ')->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($seances as $seance) {
        echo "- {$seance['dateSeance']} {$seance['heureDebut']}-{$seance['heureFin']}: {$seance['titre']}\n";
    }
    
    echo "\n✓ Données vérifiées avec succès!\n";
    
} catch (PDOException $e) {
    echo "✗ Erreur de connexion: " . $e->getMessage() . "\n";
}

<?php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->boot();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

try {
    $user = User::create([
        'name' => 'Admin Lyon Palme',
        'email' => 'admin@lyonpalme.fr',
        'password' => Hash::make('password123'),
        'email_verified_at' => now()
    ]);
    
    echo "Utilisateur créé avec succès!\n";
    echo "Email: admin@lyonpalme.fr\n";
    echo "Mot de passe: password123\n";
} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage() . "\n";
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Entrainement;
use App\Models\Seance;
use Illuminate\Support\Facades\Hash;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Créer des utilisateurs test pour chaque rôle
        
        // Président
        User::create([
            'name' => 'Jean-Claude Président',
            'email' => 'president@lyonpalme.fr',
            'password' => Hash::make('password'),
            'role_id' => 4, // président
        ]);

        // Responsable planning
        User::create([
            'name' => 'Marie Planification',
            'email' => 'planning@lyonpalme.fr',
            'password' => Hash::make('password'),
            'role_id' => 3, // responsable_planning
        ]);

        // Entraîneur
        User::create([
            'name' => 'Pierre Entraîneur',
            'email' => 'entraineur@lyonpalme.fr',
            'password' => Hash::make('password'),
            'role_id' => 2, // entraineur
        ]);

        // Membre
        User::create([
            'name' => 'Sophie Membre',
            'email' => 'membre@lyonpalme.fr',
            'password' => Hash::make('password'),
            'role_id' => 1, // membre
        ]);

        // Créer quelques entraînements
        $entrainement1 = Entrainement::create([
            'titre' => 'Entraînement Endurance',
            'description' => 'Séance axée sur l\'endurance cardiovasculaire',
            'entraineur_id' => 3, // Pierre Entraîneur
        ]);

        $entrainement2 = Entrainement::create([
            'titre' => 'Technique Nage Libre',
            'description' => 'Perfectionnement de la technique en nage libre',
            'entraineur_id' => 3,
        ]);

        $entrainement3 = Entrainement::create([
            'titre' => 'Préparation Compétition',
            'description' => 'Entraînement intensif pour les compétitions',
            'entraineur_id' => 3,
        ]);

        // Créer des séances
        Seance::create([
            'date_seance' => now()->addDays(1),
            'heure_debut' => '18:00:00',
            'heure_fin' => '19:30:00',
            'entrainement_id' => $entrainement1->id,
        ]);

        Seance::create([
            'date_seance' => now()->addDays(3),
            'heure_debut' => '19:00:00',
            'heure_fin' => '20:30:00',
            'entrainement_id' => $entrainement2->id,
        ]);

        Seance::create([
            'date_seance' => now()->addDays(5),
            'heure_debut' => '17:30:00',
            'heure_fin' => '19:00:00',
            'entrainement_id' => $entrainement3->id,
        ]);

        Seance::create([
            'date_seance' => now()->addWeek()->addDays(1),
            'heure_debut' => '18:00:00',
            'heure_fin' => '19:30:00',
            'entrainement_id' => $entrainement1->id,
        ]);

        // Ajouter quelques membres supplémentaires
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => "Membre Test $i",
                'email' => "membre$i@lyonpalme.fr",
                'password' => Hash::make('password'),
                'role_id' => 1, // membre
            ]);
        }
    }
}

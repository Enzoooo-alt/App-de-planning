<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LyonPalmeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample trainers (ENTRAINEUR)
        $trainers = [
            [
                'nom' => 'Martin',
                'prenom' => 'Sophie',
                'role' => 'Entraîneur principal',
                'login' => 'sophie.martin',
                'mot_de_passe' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Dubois',
                'prenom' => 'Pierre',
                'role' => 'Entraîneur assistant',
                'login' => 'pierre.dubois',
                'mot_de_passe' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($trainers as $trainer) {
            DB::table('entraineur')->insert($trainer);
        }

        // Create sample members (adherent)
        $members = [
            [
                'nom' => 'Moreau',
                'prenom' => 'Emma',
                'email' => 'emma.moreau@email.com',
                'password' => Hash::make('password123'),
                'telephone' => '0123456791',
                'adresse' => '789 Rue de l\'Eau, Lyon',
                'niveau' => 'debutant',
                'actif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Petit',
                'prenom' => 'Léa',
                'email' => 'lea.petit@email.com',
                'password' => Hash::make('password123'),
                'telephone' => '0123456792',
                'adresse' => '321 Boulevard Aquatique, Lyon',
                'niveau' => 'intermediaire',
                'actif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($members as $member) {
            DB::table('adherent')->insert($member);
        }

        // Create sample training programs (entrainement)
        $trainings = [
            [
                'titre' => 'Programme Junior - Bases',
                'description' => 'Programme d\'initiation pour les jeunes nageurs',
                'entraineur_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titre' => 'Programme Intermédiaire - Perfectionnement',
                'description' => 'Programme de perfectionnement technique',
                'entraineur_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($trainings as $training) {
            DB::table('entrainement')->insert($training);
        }

        // Create sample training sessions (seance)
        $sessions = [
            [
                'date_seance' => '2024-12-05',
                'heure_debut' => '18:00:00',
                'heure_fin' => '19:30:00',
                'description' => 'Séance d\'initiation technique',
                'entrainement_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date_seance' => '2024-12-07',
                'heure_debut' => '10:00:00',
                'heure_fin' => '12:00:00',
                'description' => 'Séance de perfectionnement',
                'entrainement_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($sessions as $session) {
            DB::table('seance')->insert($session);
        }

        // Create sample comments (commentaire)
        $comments = [
            [
                'contenu' => 'Excellente séance, les nageuses ont bien progressé sur les figures de base.',
                'adherent_id' => 1,
                'entrainement_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'contenu' => 'Programme très intéressant, j\'ai beaucoup appris sur les techniques avancées.',
                'adherent_id' => 2,
                'entrainement_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($comments as $comment) {
            DB::table('commentaire')->insert($comment);
        }
    }
}

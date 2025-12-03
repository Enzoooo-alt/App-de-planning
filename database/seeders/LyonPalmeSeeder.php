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
                'idEntraineur' => 1,
                'nom' => 'Martin',
                'prenom' => 'Sophie',
                'role' => 'Entraîneur principal',
                'login' => 'sophie.martin',
                'mot_de_passe' => Hash::make('password123'),
            ],
            [
                'idEntraineur' => 2,
                'nom' => 'Dubois',
                'prenom' => 'Pierre',
                'role' => 'Entraîneur assistant',
                'login' => 'pierre.dubois',
                'mot_de_passe' => Hash::make('password123'),
            ],
        ];

        foreach ($trainers as $trainer) {
            DB::table('ENTRAINEUR')->insert($trainer);
        }

        // Create sample members (ADHERENT)
        $members = [
            [
                'idAdherent' => 1,
                'nom' => 'Moreau',
                'prenom' => 'Emma',
                'profession' => 'Étudiante',
                'mail' => 'emma.moreau@email.com',
                'telephone' => '0123456791',
                'adresse' => '789 Rue de l\'Eau, Lyon',
                'login' => 'emma.moreau',
                'mot_de_passe' => Hash::make('password123'),
            ],
            [
                'idAdherent' => 2,
                'nom' => 'Petit',
                'prenom' => 'Léa',
                'profession' => 'Étudiante',
                'mail' => 'lea.petit@email.com',
                'telephone' => '0123456792',
                'adresse' => '321 Boulevard Aquatique, Lyon',
                'login' => 'lea.petit',
                'mot_de_passe' => Hash::make('password123'),
            ],
        ];

        foreach ($members as $member) {
            DB::table('ADHERENT')->insert($member);
        }

        // Create sample training programs (ENTRAINEMENT)
        $trainings = [
            [
                'idEntrainement' => 1,
                'titre' => 'Programme Junior - Bases',
                'dateCreation' => '2024-01-01 10:00:00',
                'idEntraineur' => 1,
            ],
            [
                'idEntrainement' => 2,
                'titre' => 'Programme Intermédiaire - Perfectionnement',
                'dateCreation' => '2024-01-15 14:00:00',
                'idEntraineur' => 2,
            ],
        ];

        foreach ($trainings as $training) {
            DB::table('ENTRAINEMENT')->insert($training);
        }

        // Create sample training sessions (SEANCE)
        $sessions = [
            [
                'idSeance' => 1,
                'dateSeance' => '2024-12-05',
                'heureDebut' => '18:00:00',
                'heureFin' => '19:30:00',
                'idEntrainement' => 1,
            ],
            [
                'idSeance' => 2,
                'dateSeance' => '2024-12-07',
                'heureDebut' => '10:00:00',
                'heureFin' => '12:00:00',
                'idEntrainement' => 2,
            ],
        ];

        foreach ($sessions as $session) {
            DB::table('SEANCE')->insert($session);
        }

        // Link trainers to training programs (ENTRAINER)
        $trainerTrainings = [
            [
                'idEntraineur' => 1,
                'idEntrainement' => 1,
                'idJour' => 1,
            ],
            [
                'idEntraineur' => 2,
                'idEntrainement' => 2,
                'idJour' => 3,
            ],
        ];

        foreach ($trainerTrainings as $trainerTraining) {
            DB::table('ENTRAINER')->insert($trainerTraining);
        }

        // Create sample comments (COMMENTAIRE)
        $comments = [
            [
                'idCommentaire' => 1,
                'texte' => 'Excellente séance, les nageuses ont bien progressé sur les figures de base.',
                'dateCommentaire' => '2024-12-05 20:00:00',
                'idEntraineur' => 1,
                'idSeance' => 1,
            ],
            [
                'idCommentaire' => 2,
                'texte' => 'Prévoir plus de temps pour les étirements lors de la prochaine séance.',
                'dateCommentaire' => '2024-12-07 12:30:00',
                'idEntraineur' => 2,
                'idSeance' => 2,
            ],
        ];

        foreach ($comments as $comment) {
            DB::table('COMMENTAIRE')->insert($comment);
        }
    }
}

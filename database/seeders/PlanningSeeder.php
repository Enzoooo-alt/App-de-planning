<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Planning;

class PlanningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plannings = [
            [
                'date' => '2025-11-18',
                'day' => 'Lundi',
                'start_time' => '18:00',
                'end_time' => '19:30',
                'coach1' => 'Coach Principal',
                'coach2' => null,
                'description' => 'Entraînement technique - Perfectionnement des mouvements',
                'max_participants' => 15
            ],
            [
                'date' => '2025-11-20',
                'day' => 'Mercredi',
                'start_time' => '19:00',
                'end_time' => '20:30',
                'coach1' => 'Coach Principal',
                'coach2' => 'Assistant Coach',
                'description' => 'Entraînement physique - Endurance et vitesse',
                'max_participants' => 20
            ],
            [
                'date' => '2025-11-22',
                'day' => 'Vendredi',
                'start_time' => '17:30',
                'end_time' => '19:00',
                'coach1' => 'Coach Principal',
                'coach2' => null,
                'description' => 'Entraînement libre - Pratique personnelle supervisée',
                'max_participants' => 12
            ],
            [
                'date' => '2025-11-25',
                'day' => 'Lundi',
                'start_time' => '18:00',
                'end_time' => '19:30',
                'coach1' => 'Coach Principal',
                'coach2' => null,
                'description' => 'Entraînement technique - Travail des virages',
                'max_participants' => 15
            ]
        ];

        foreach ($plannings as $planning) {
            Planning::create($planning);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Training;
use App\Models\Planning;

class TrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plannings = Planning::all();
        
        $trainings = [
            [
                'title' => 'Technique Crawl Perfectionnement',
                'description' => 'Séance axée sur l\'amélioration de la technique crawl.

Objectifs :
- Correction du roulis et de la position
- Amélioration de la respiration bilatérale  
- Fluidité des mouvements
- Coordination bras/jambes

Matériel : planches, pull-buoy, palmes courtes, élastiques

Structure :
- Échauffement : 200m nage libre
- Technique : 8x25m crawl avec récupération
- Éducatifs : 4x50m avec matériel
- Récupération : 100m dos/brasse',
                'type' => 'technique',
                'niveau' => 'intermediaire',
                'duree_minutes' => 60,
            ],
            [
                'title' => 'Endurance Aérobie Base',
                'description' => 'Développement de la capacité aérobie fondamentale.

Objectifs :
- Amélioration de l\'endurance cardio-vasculaire
- Développement du système aérobie
- Résistance à la fatigue
- Nage en continue

Intensité : 70-80% FCMax (Zone 2)

Structure :
- Échauffement : 300m progressif
- Série principale : 1000m en nage continue
- Récupération active : 200m choix de nage
- Retour au calme : 100m dos',
                'type' => 'endurance',
                'niveau' => 'intermediaire',
                'duree_minutes' => 45,
            ],
            [
                'title' => 'Vitesse et Puissance',
                'description' => 'Développement de la vitesse de nage et explosivité.

Objectifs :
- Amélioration de la vitesse maximale
- Développement de la puissance anaérobie
- Travail de l\'explosivité au départ
- Résistance à la vitesse

Intensité : 90-95% (Zone 4-5)

Structure :
- Échauffement : 400m progressif + éducatifs
- Vitesse : 8x25m sprint (récup 1min)
- Puissance : 4x50m intense (récup 2min)
- Récupération : 200m souple',
                'type' => 'vitesse',
                'niveau' => 'avance',
                'duree_minutes' => 75,
            ],
            [
                'title' => 'Préparation Compétition 100m',
                'description' => 'Séance spécifique pour la préparation au 100m nage libre.

Objectifs :
- Simulation des conditions de course
- Travail du rythme de course spécifique
- Préparation mentale et tactique
- Optimisation des virages

Structure spécifique 100m :
- Échauffement compétition : 600m
- Technique virages : 6x25m départ plongé
- Allures : 4x100m à allure course (récup 3min)
- Vitesse : 4x25m survitesse
- Récupération : 300m détente',
                'type' => 'competition',
                'niveau' => 'competition',
                'duree_minutes' => 90,
            ],
            [
                'title' => 'Technique Dos Crawlé',
                'description' => 'Perfectionnement de la technique en dos crawlé.

Objectifs :
- Position du corps et alignement
- Technique de bras et coordination
- Rythme de battement
- Orientation et navigation

Éducatifs spécifiques :
- Position corps (planche sur le ventre)
- Battements avec planche
- Moulinets de bras
- Nage complète avec comptage

Structure :
- Échauffement : 200m 4 nages
- Éducatifs : 12x25m dos (récup 15s)
- Application : 6x50m dos technique
- Récupération : 150m libre',
                'type' => 'technique',
                'niveau' => 'debutant',
                'duree_minutes' => 50,
            ],
            [
                'title' => 'Endurance Lactique Seuil',
                'description' => 'Travail au seuil lactique pour l\'amélioration des performances.

Objectifs :
- Amélioration du seuil anaérobie
- Tolérance à l\'accumulation de lactates
- Maintien de la vitesse en condition acide
- Préparation aux distances moyennes (200-400m)

Intensité : 85-90% FCMax (Zone 3)

Structure :
- Échauffement : 400m progressif
- Seuil : 5x200m au seuil (récup 45s)
- Survitesse : 4x50m rapide (récup 1min30)
- Récupération : 300m souple 4 nages',
                'type' => 'endurance',
                'niveau' => 'avance',
                'duree_minutes' => 80,
            ]
        ];

        foreach ($trainings as $trainingData) {
            $training = Training::create($trainingData);
            
            // Associer avec des plannings aléatoires
            $randomPlannings = $plannings->random(rand(1, 2));
            $training->plannings()->attach($randomPlannings->pluck('id'));
        }
    }
}

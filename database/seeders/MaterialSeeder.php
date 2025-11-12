<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Material;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materials = [
            [
                'name' => 'Palmes Beuchat Mundial',
                'description' => 'Palmes longues en fibre de carbone pour l\'apnée',
                'quantity_total' => 10,
                'quantity_available' => 8,
                'price' => 150.00,
                'category' => 'palmes',
                'status' => 'available'
            ],
            [
                'name' => 'Masque Cressi Big Eyes',
                'description' => 'Masque de plongée avec grand champ de vision',
                'quantity_total' => 15,
                'quantity_available' => 12,
                'price' => 45.00,
                'category' => 'masques',
                'status' => 'available'
            ],
            [
                'name' => 'Tuba Mares Ergo Dry',
                'description' => 'Tuba semi-sec avec valve de purge',
                'quantity_total' => 20,
                'quantity_available' => 18,
                'price' => 25.00,
                'category' => 'tubas',
                'status' => 'available'
            ],
            [
                'name' => 'Combinaison Beuchat Focea 5mm',
                'description' => 'Combinaison néoprène épaisseur 5mm taille M',
                'quantity_total' => 5,
                'quantity_available' => 4,
                'price' => 120.00,
                'category' => 'combinaisons',
                'status' => 'available'
            ],
            [
                'name' => 'Planche à palmes',
                'description' => 'Planche en mousse pour l\'entraînement des jambes',
                'quantity_total' => 12,
                'quantity_available' => 10,
                'price' => 15.00,
                'category' => 'accessoires',
                'status' => 'available'
            ],
            [
                'name' => 'Pull-buoy',
                'description' => 'Flotteur pour l\'entraînement des bras',
                'quantity_total' => 8,
                'quantity_available' => 6,
                'price' => 12.00,
                'category' => 'accessoires',
                'status' => 'available'
            ]
        ];

        foreach ($materials as $material) {
            Material::create($material);
        }
    }
}

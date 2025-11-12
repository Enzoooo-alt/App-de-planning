<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'adhérent',
                'description' => 'Membre standard du club'
            ],
            [
                'name' => 'coach',
                'description' => 'Entraîneur du club'
            ],
            [
                'name' => 'responsable',
                'description' => 'Responsable administratif du club'
            ],
            [
                'name' => 'admin',
                'description' => 'Administrateur système'
            ]
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role['name']], $role);
        }
    }
}

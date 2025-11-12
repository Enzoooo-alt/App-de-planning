<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer un administrateur
        $admin = User::firstOrCreate(
            ['email' => 'admin@lyonpalme.fr'],
            [
                'name' => 'Administrateur',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );
        $admin->roles()->attach(Role::where('name', 'admin')->first());

        // Créer un coach
        $coach = User::firstOrCreate(
            ['email' => 'coach@lyonpalme.fr'],
            [
                'name' => 'Coach Principal',
                'password' => Hash::make('coach123'),
                'email_verified_at' => now(),
            ]
        );
        $coach->roles()->attach(Role::where('name', 'coach')->first());

        // Créer un responsable
        $responsable = User::firstOrCreate(
            ['email' => 'responsable@lyonpalme.fr'],
            [
                'name' => 'Responsable Club',
                'password' => Hash::make('resp123'),
                'email_verified_at' => now(),
            ]
        );
        $responsable->roles()->attach(Role::where('name', 'responsable')->first());

        // Créer quelques adhérents
        for ($i = 1; $i <= 5; $i++) {
            $adherent = User::firstOrCreate(
                ['email' => "adherent{$i}@lyonpalme.fr"],
                [
                    'name' => "Adhérent {$i}",
                    'password' => Hash::make('adherent123'),
                    'email_verified_at' => now(),
                ]
            );
            $adherent->roles()->attach(Role::where('name', 'adhérent')->first());
        }
    }
}

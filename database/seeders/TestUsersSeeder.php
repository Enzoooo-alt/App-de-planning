<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Entraineur;
use App\Models\Adherent;
use Illuminate\Support\Facades\Hash;

class TestUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Crée des utilisateurs de test pour chaque rôle :
     * - Président
     * - Responsable Planning
     * - Entraîneur
     * - Membre (avec et sans profil adhérent)
     */
    public function run(): void
    {
        // Créer les rôles s'ils n'existent pas
        $rolePresident = Role::firstOrCreate(
            ['nom_role' => 'president'],
            ['description' => 'Président du club - Accès complet']
        );

        $roleResponsablePlanning = Role::firstOrCreate(
            ['nom_role' => 'responsable_planning'],
            ['description' => 'Responsable planning - Gestion séances et entraînements']
        );

        $roleEntraineur = Role::firstOrCreate(
            ['nom_role' => 'entraineur'],
            ['description' => 'Entraîneur - Gestion de ses entraînements']
        );

        $roleMembre = Role::firstOrCreate(
            ['nom_role' => 'membre'],
            ['description' => 'Membre - Consultation uniquement']
        );

        // ====== 1. PRÉSIDENT ======
        $userPresident = User::create([
            'name' => 'Jean Président',
            'first_name' => 'Jean',
            'last_name' => 'Président',
            'email' => 'president@lyonpalme.fr',
            'password' => Hash::make('password123'),
            'role_id' => $rolePresident->id,
            'email_verified_at' => now(),
        ]);

        echo "✅ Président créé : president@lyonpalme.fr / password123\n";

        // ====== 2. RESPONSABLE PLANNING (aussi adhérent) ======
        $userResponsable = User::create([
            'name' => 'Marie Planificatrice',
            'first_name' => 'Marie',
            'last_name' => 'Planificatrice',
            'email' => 'planning@lyonpalme.fr',
            'password' => Hash::make('password123'),
            'role_id' => $roleResponsablePlanning->id,
            'email_verified_at' => now(),
        ]);

        // Ajouter le rôle de membre aussi (double casquette)
        $userResponsable->roles()->attach($roleMembre->id);
        
        // Créer son profil adhérent
        $adherentMarie = Adherent::create([
            'nom' => 'Planificatrice',
            'prenom' => 'Marie',
            'email' => 'planning@lyonpalme.fr',
            'telephone' => '06 77 88 99 00',
            'date_adhesion' => now()->subYears(3),
            'niveau' => 'avance',
            'actif' => true,
            'user_id' => $userResponsable->id,
        ]);

        echo "✅ Responsable Planning créé : planning@lyonpalme.fr / password123 (AUSSI adhérent avancé)\n";

        // ====== 3. ENTRAÎNEURS (3 exemples) ======
        
        // Entraîneur 1
        $userEntraineur1 = User::create([
            'name' => 'Pierre Coach',
            'first_name' => 'Pierre',
            'last_name' => 'Coach',
            'email' => 'pierre.coach@lyonpalme.fr',
            'password' => Hash::make('password123'),
            'role_id' => $roleEntraineur->id,
            'email_verified_at' => now(),
        ]);

        $entraineur1 = Entraineur::create([
            'user_id' => $userEntraineur1->id,
            'nom' => 'Coach',
            'prenom' => 'Pierre',
            'login' => 'pierre.coach',
            'mot_de_passe' => Hash::make('password123'),
            'specialite' => 'Natation synchronisée',
            'niveau_certification' => 'BEESAN',
            'telephone' => '06 12 34 56 78',
        ]);

        echo "✅ Entraîneur 1 créé : pierre.coach@lyonpalme.fr / password123 (Natation synchronisée)\n";

        // Entraîneur 2
        $userEntraineur2 = User::create([
            'name' => 'Sophie Nageuse',
            'first_name' => 'Sophie',
            'last_name' => 'Nageuse',
            'email' => 'sophie.nageuse@lyonpalme.fr',
            'password' => Hash::make('password123'),
            'role_id' => $roleEntraineur->id,
            'email_verified_at' => now(),
        ]);

        $entraineur2 = Entraineur::create([
            'user_id' => $userEntraineur2->id,
            'nom' => 'Nageuse',
            'prenom' => 'Sophie',
            'login' => 'sophie.nageuse',
            'mot_de_passe' => Hash::make('password123'),
            'specialite' => 'Compétition - Crawl et Dos',
            'niveau_certification' => 'Maître Nageur Sauveteur',
            'telephone' => '06 98 76 54 32',
        ]);

        echo "✅ Entraîneur 2 créé : sophie.nageuse@lyonpalme.fr / password123 (Compétition)\n";

        // Entraîneur 3
        $userEntraineur3 = User::create([
            'name' => 'Thomas Aquatique',
            'first_name' => 'Thomas',
            'last_name' => 'Aquatique',
            'email' => 'thomas.aquatique@lyonpalme.fr',
            'password' => Hash::make('password123'),
            'role_id' => $roleEntraineur->id,
            'email_verified_at' => now(),
        ]);

        $entraineur3 = Entraineur::create([
            'user_id' => $userEntraineur3->id,
            'nom' => 'Aquatique',
            'prenom' => 'Thomas',
            'login' => 'thomas.aquatique',
            'mot_de_passe' => Hash::make('password123'),
            'specialite' => 'Débutants et perfectionnement',
            'niveau_certification' => 'BPJEPS AAN',
            'telephone' => '06 55 44 33 22',
        ]);

        echo "✅ Entraîneur 3 créé : thomas.aquatique@lyonpalme.fr / password123 (Débutants)\n";

        // ====== 4. MEMBRES (4 exemples) ======
        
        // Membre 1 - avec profil adhérent
        $userMembre1 = User::create([
            'name' => 'Lucas Nageur',
            'first_name' => 'Lucas',
            'last_name' => 'Nageur',
            'email' => 'lucas.nageur@example.com',
            'password' => Hash::make('password123'),
            'role_id' => $roleMembre->id,
            'email_verified_at' => now(),
        ]);

        $adherent1 = Adherent::create([
            'nom' => 'Nageur',
            'prenom' => 'Lucas',
            'email' => 'lucas.nageur@example.com',
            'telephone' => '06 11 22 33 44',
            'date_adhesion' => now()->subMonths(6),
            'niveau' => 'intermediaire',
            'actif' => true,
            'user_id' => $userMembre1->id,
        ]);

        echo "✅ Membre 1 créé : lucas.nageur@example.com / password123 (avec profil adhérent - intermédiaire)\n";

        // Membre 2 - avec profil adhérent
        $userMembre2 = User::create([
            'name' => 'Emma Piscine',
            'first_name' => 'Emma',
            'last_name' => 'Piscine',
            'email' => 'emma.piscine@example.com',
            'password' => Hash::make('password123'),
            'role_id' => $roleMembre->id,
            'email_verified_at' => now(),
        ]);

        $adherent2 = Adherent::create([
            'nom' => 'Piscine',
            'prenom' => 'Emma',
            'email' => 'emma.piscine@example.com',
            'telephone' => '06 22 33 44 55',
            'date_adhesion' => now()->subYear(),
            'niveau' => 'avance',
            'actif' => true,
            'user_id' => $userMembre2->id,
        ]);

        echo "✅ Membre 2 créé : emma.piscine@example.com / password123 (avec profil adhérent - avancé)\n";

        // Membre 3 - sans profil adhérent (nouveau compte)
        $userMembre3 = User::create([
            'name' => 'Hugo Debutant',
            'first_name' => 'Hugo',
            'last_name' => 'Debutant',
            'email' => 'hugo.debutant@example.com',
            'password' => Hash::make('password123'),
            'role_id' => $roleMembre->id,
            'email_verified_at' => now(),
        ]);

        echo "✅ Membre 3 créé : hugo.debutant@example.com / password123 (sans profil adhérent)\n";

        // Membre 4 - avec profil adhérent compétition
        $userMembre4 = User::create([
            'name' => 'Léa Champion',
            'first_name' => 'Léa',
            'last_name' => 'Champion',
            'email' => 'lea.champion@example.com',
            'password' => Hash::make('password123'),
            'role_id' => $roleMembre->id,
            'email_verified_at' => now(),
        ]);

        $adherent4 = Adherent::create([
            'nom' => 'Champion',
            'prenom' => 'Léa',
            'email' => 'lea.champion@example.com',
            'telephone' => '06 99 88 77 66',
            'date_adhesion' => now()->subYears(2),
            'niveau' => 'competition',
            'actif' => true,
            'user_id' => $userMembre4->id,
        ]);

        echo "✅ Membre 4 créé : lea.champion@example.com / password123 (avec profil adhérent - compétition)\n";

        // ====== ADHÉRENTS SANS COMPTE ======
        
        // Quelques adhérents supplémentaires sans compte utilisateur
        Adherent::create([
            'nom' => 'Martin',
            'prenom' => 'Antoine',
            'email' => 'antoine.martin@example.com',
            'telephone' => '06 77 66 55 44',
            'date_adhesion' => now()->subMonths(3),
            'niveau' => 'debutant',
            'actif' => true,
        ]);

        Adherent::create([
            'nom' => 'Bernard',
            'prenom' => 'Claire',
            'email' => 'claire.bernard@example.com',
            'telephone' => '06 33 22 11 00',
            'date_adhesion' => now()->subMonths(8),
            'niveau' => 'intermediaire',
            'actif' => true,
        ]);

        Adherent::create([
            'nom' => 'Dubois',
            'prenom' => 'Maxime',
            'email' => 'maxime.dubois@example.com',
            'telephone' => '06 44 55 66 77',
            'date_adhesion' => now()->subMonths(2),
            'niveau' => 'debutant',
            'actif' => false, // Cotisation non à jour
        ]);

        echo "✅ 3 adhérents supplémentaires créés (sans compte utilisateur)\n";

        // ====== RÉSUMÉ ======
        echo "\n";
        echo "========================================\n";
        echo "📊 RÉSUMÉ DES COMPTES CRÉÉS\n";
        echo "========================================\n";
        echo "👑 PRÉSIDENT : president@lyonpalme.fr\n";
        echo "📅 RESPONSABLE : planning@lyonpalme.fr\n";
        echo "🏊 ENTRAÎNEURS :\n";
        echo "   - pierre.coach@lyonpalme.fr (Natation synchronisée)\n";
        echo "   - sophie.nageuse@lyonpalme.fr (Compétition)\n";
        echo "   - thomas.aquatique@lyonpalme.fr (Débutants)\n";
        echo "👥 MEMBRES :\n";
        echo "   - lucas.nageur@example.com (intermédiaire)\n";
        echo "   - emma.piscine@example.com (avancé)\n";
        echo "   - hugo.debutant@example.com (nouveau)\n";
        echo "   - lea.champion@example.com (compétition)\n";
        echo "\n";
        echo "🔑 Mot de passe pour tous : password123\n";
        echo "========================================\n";
    }
}


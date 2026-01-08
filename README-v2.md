# Lyon Palme - Plateforme de Gestion d'Activités Aquatiques

![Laravel 12](https://img.shields.io/badge/Laravel-12-FF2D20?style=flat-square&logo=laravel)
![Design System Maritime](https://img.shields.io/badge/Design-Maritime-0D9488?style=flat-square)
![Status Production](https://img.shields.io/badge/Status-Production-22C55E?style=flat-square)

## À propos du projet

**Lyon Palme** est une plateforme professionnelle développée avec Laravel 12, spécialement conçue pour la gestion complète d'activités aquatiques. L'application intègre un Design System Maritime avec des composants spécialisés pour la planification de séances de plongée, natation et entraînements aquatiques.

### Design System Maritime v2.0

- **Palette professionnelle** : Navy (#0c4a6e), Teal (#0d9488), Marine Blue (#0284c7)
- **Composants spécialisés** : Calendrier maritime, cartes de sessions, timeline d'activités
- **Interface responsive** : Design mobile-first optimisé pour tous les appareils
- **Animations fluides** : Transitions inspirées du mouvement de l'eau

## Fonctionnalités principales

### Gestion des membres
- Inscription et authentification sécurisée
- Profils détaillés des adhérents
- Suivi de l'activité et des présences

### Gestion des entraîneurs
- Attribution des créneaux d'entraînement
- Suivi des séances animées
- Gestion des disponibilités

### Planification d'entraînements
- Création et organisation des sessions
- Calendrier interactif maritime
- Système de réservation en ligne

### Système de commentaires et suivi
- Retours sur les entraînements
- Évaluation des séances
- Historique des activités

## Structure du projet

### Architecture générale

```
App-de-planning/
├── app/                    # Code source de l'application
│   ├── Http/
│   │   ├── Controllers/    # Contrôleurs de l'application
│   │   ├── Middleware/     # Middlewares personnalisés
│   │   └── Requests/       # Validation des requêtes
│   ├── Models/             # Modèles Eloquent
│   └── Providers/          # Service providers
├── bootstrap/              # Fichiers de démarrage Laravel
├── config/                 # Configuration de l'application
├── database/
│   ├── migrations/         # Migrations de base de données
│   └── seeders/            # Seeders pour données de test
├── public/                 # Point d'entrée web et assets
├── resources/
│   ├── css/                # Fichiers CSS et Design System
│   ├── js/                 # Composants Vue.js et JavaScript
│   └── views/              # Templates Blade
├── routes/                 # Définition des routes
├── storage/                # Stockage et logs
└── tests/                  # Tests automatisés
```

### Modèles (app/Models/)

Les modèles Eloquent représentent les entités de la base de données :

- **User.php** - Modèle utilisateur avec authentification
- **Adherent.php** - Membres du club
- **Entraineur.php** - Entraîneurs et leur spécialités
- **Entrainement.php** - Sessions d'entraînement
- **Seance.php** - Séances planifiées
- **Commentaire.php** - Retours et évaluations
- **Role.php** - Système de rôles et permissions

### Contrôleurs (app/Http/Controllers/)

- **DashboardController** - Tableaux de bord par rôle
- **MemberController** - Gestion des adhérents
- **TrainerController** - Gestion des entraîneurs
- **EntrainementController** - Création et gestion des entraînements
- **SeanceController** - Planification des séances
- **ProfileController** - Gestion des profils utilisateurs

### Base de données (database/)

#### Migrations principales

- **users** - Utilisateurs et authentification
- **roles** - Rôles et permissions
- **entraineur** - Informations des entraîneurs
- **entrainement** - Entraînements créés
- **seance** - Séances d'entraînement planifiées
- **adherent** - Adhérents du club
- **commentaire** - Commentaires et évaluations

#### Relations

- Un entraîneur peut créer plusieurs entraînements
- Un entraînement peut avoir plusieurs séances
- Les adhérents peuvent commenter les entraînements
- Système de rôles avec permissions (Membre, Entraîneur, Responsable Planning, Président)

### Resources (resources/)

#### Views (resources/views/)

Templates Blade pour l'interface utilisateur :
- **layouts/** - Layouts de base
- **auth/** - Authentification (login, register)
- **dashboard/** - Tableaux de bord par rôle
- **entrainements/** - Gestion des entraînements
- **seances/** - Gestion des séances
- **adherents/** - Gestion des adhérents
- **profile/** - Profils utilisateurs

#### Assets (resources/css/, resources/js/)

- **lyon-palme-v2.css** - Design System Maritime professionnel
- **app.css** - Styles globaux et Tailwind CSS
- **app.js** - Point d'entrée JavaScript avec Inertia.js
- **Components/** - Composants Vue.js réutilisables

### Routes (routes/)

- **web.php** - Routes web principales
- **auth.php** - Routes d'authentification
- **console.php** - Commandes Artisan personnalisées

### Configuration (config/)

- **app.php** - Configuration générale
- **database.php** - Configuration base de données
- **auth.php** - Configuration authentification
- **session.php** - Gestion des sessions

## Installation et démarrage

### Prérequis

- PHP 8.2 ou supérieur
- Composer
- Node.js 18+ et npm
- SQLite (ou MySQL/PostgreSQL)

### Installation

1. **Cloner le projet**

```bash
git clone <url-du-repository>
cd App-de-planning
```

2. **Installer les dépendances PHP**

```bash
composer install
```

3. **Installer les dépendances JavaScript**

```bash
npm install
```

4. **Configuration de l'environnement**

```bash
cp .env.example .env
php artisan key:generate
```

5. **Configurer la base de données**

Éditer le fichier `.env` :

```env
APP_NAME="Lyon Palme"
APP_LOCALE=fr

DB_CONNECTION=sqlite
# ou pour MySQL/PostgreSQL
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=lyonpalme
# DB_USERNAME=root
# DB_PASSWORD=
```

6. **Créer la base de données SQLite** (si SQLite)

```bash
touch database/database.sqlite
```

7. **Exécuter les migrations**

```bash
php artisan migrate
```

8. **Peupler avec des données de test** (optionnel)

```bash
php artisan db:seed --class=LyonPalmeSeeder
```

9. **Compiler les assets**

```bash
npm run dev
# ou pour la production
npm run build
```

10. **Démarrer le serveur de développement**

```bash
php artisan serve
```

L'application sera accessible sur `http://localhost:8000`

## Technologies utilisées

- **Backend** : Laravel 12 (PHP 8.2+)
- **Frontend** : Inertia.js avec Vue 3
- **Styling** : Tailwind CSS + Design System Maritime personnalisé
- **Build** : Vite
- **Base de données** : SQLite / MySQL / MariaDB
- **Tests** : PHPUnit
- **Authentification** : Laravel Breeze

## Commandes utiles

### Développement

```bash
# Compiler les assets en mode watch
npm run dev

# Serveur de développement Laravel
php artisan serve

# Mode développement complet (concurrent)
composer run dev
```

### Migrations et base de données

```bash
# Créer une migration
php artisan make:migration create_table_name

# Exécuter les migrations
php artisan migrate

# Rollback dernière migration
php artisan migrate:rollback

# Reset complet de la base
php artisan migrate:fresh

# Avec seeders
php artisan migrate:fresh --seed
```

### Modèles et contrôleurs

```bash
# Créer un modèle avec migration
php artisan make:model NomModele -m

# Créer un contrôleur
php artisan make:controller NomController

# Créer un contrôleur de ressources
php artisan make:controller NomController --resource
```

### Tests

```bash
# Exécuter tous les tests
php artisan test

# Tests avec couverture
php artisan test --coverage
```

### Cache et optimisation

```bash
# Nettoyer tous les caches
php artisan optimize:clear

# Nettoyer le cache de configuration
php artisan config:clear

# Nettoyer le cache des vues
php artisan view:clear

# Nettoyer le cache des routes
php artisan route:clear

# Optimiser pour la production
php artisan optimize
```

## Structure de la base de données

### Tables principales

#### users
- Utilisateurs de l'application
- Champs : id, name, first_name, last_name, email, password, role_id
- Relations : belongsTo(Role)

#### roles
- Rôles et permissions
- Types : Membre, Entraîneur, Responsable Planning, Président

#### adherent
- Membres du club
- Informations détaillées des adhérents

#### entraineur
- Entraîneurs du club
- Spécialités et qualifications

#### entrainement
- Entraînements créés
- Relations : belongsTo(Entraineur), hasMany(Seance, Commentaire)

#### seance
- Séances planifiées
- Date, heure, lieu, participants
- Relations : belongsTo(Entrainement)

#### commentaire
- Commentaires et évaluations
- Relations : belongsTo(User), belongsTo(Entrainement)

## Système de rôles

### Membre (role_id: 1)
- Consulter les entraînements disponibles
- S'inscrire aux séances
- Laisser des commentaires
- Gérer son profil

### Entraîneur (role_id: 2)
- Toutes les permissions Membre
- Créer et gérer ses entraînements
- Planifier des séances
- Voir la liste des inscrits

### Responsable Planning (role_id: 3)
- Toutes les permissions Entraîneur
- Gérer tous les entraînements
- Gérer le planning global
- Valider les inscriptions

### Président (role_id: 4)
- Accès complet à toutes les fonctionnalités
- Gestion des utilisateurs et rôles
- Statistiques et rapports
- Configuration de l'application

## Développement

### Standards de code

Le projet utilise :
- **Laravel Pint** pour le formatage PHP
- **ESLint** pour JavaScript/Vue
- **Conventions** : PSR-12 pour PHP

```bash
# Formatter le code PHP
./vendor/bin/pint

# Vérifier le code
./vendor/bin/pint --test
```

### Architecture

L'application suit les principes :
- **MVC** (Model-View-Controller)
- **RESTful** pour les routes API
- **Repository Pattern** pour la logique métier complexe
- **Service Layer** pour les opérations métier

## Déploiement

### Préparation pour la production

1. **Optimiser l'application**

```bash
composer install --optimize-autoloader --no-dev
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

2. **Configuration .env**

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://votre-domaine.com
```

3. **Permissions**

```bash
chmod -R 755 storage bootstrap/cache
```

## Support et contribution

### Documentation supplémentaire

- [PLAN_AMELIORATION.md](PLAN_AMELIORATION.md) - Plan de développement
- [resources/css/DESIGN_SYSTEM.md](resources/css/DESIGN_SYSTEM.md) - Guide du Design System

### Liens utiles

- Site officiel Lyon Palme : [https://www.lyonpalme.com/](https://www.lyonpalme.com/)
- Documentation Laravel : [https://laravel.com/docs](https://laravel.com/docs)
- Documentation Inertia.js : [https://inertiajs.com/](https://inertiajs.com/)
- Documentation Vue.js : [https://vuejs.org/](https://vuejs.org/)

## Licence

Ce projet est développé pour Lyon Palme. Tous droits réservés.

---

Développé avec soin pour Lyon Palme - Club de plongée et d'activités aquatiques

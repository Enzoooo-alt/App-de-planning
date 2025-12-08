# Lyon Palme - Système de Gestion d'Entraînements

<p align="center">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
</p>

## À propos du projet

Lyon Palme est une application web développée avec Laravel 12 pour la gestion des entraînements et des adhérents d'un club de natation. L'application permet de gérer les entraîneurs, les entraînements, les séances et les adhérents du club.

## Fonctionnalités principales

- Gestion des adhérents (inscription, profils, authentification)
- Gestion des entraîneurs
- Création et planification d'entraînements
- Organisation de séances d'entraînement
- Système de commentaires
- Audit et logs des actions

## Structure du projet

### 📁 Architecture générale

```
lyonpalme/
├── app/                    # Code source de l'application
├── bootstrap/              # Fichiers de démarrage Laravel
├── config/                 # Fichiers de configuration
├── database/               # Migrations, seeders et factories
├── public/                 # Point d'entrée web et assets publics
├── resources/              # Vues, CSS, JS et autres ressources
├── routes/                 # Définition des routes
├── storage/                # Stockage de fichiers et logs
├── tests/                  # Tests automatisés
└── vendor/                 # Dépendances Composer
```

### 🎯 Dossier `app/`

#### Models (app/Models/)
Les modèles Eloquent représentent les entités de la base de données :

- **`Adherent.php`** - Modèle pour les adhérents du club
- **`Entraineur.php`** - Modèle pour les entraîneurs
- **`Entrainement.php`** - Modèle pour les entraînements
- **`Seance.php`** - Modèle pour les séances d'entraînement
- **`User.php`** - Modèle utilisateur Laravel par défaut

#### Controllers (app/Http/Controllers/)
Les contrôleurs gèrent la logique métier et les interactions utilisateur.

#### Middleware (app/Http/Middleware/)
Middlewares personnalisés pour la sécurité et la validation des requêtes.

#### Requests (app/Http/Requests/)
Classes de validation des formulaires et requêtes HTTP.

### 🗄️ Base de données (database/)

#### Migrations (database/migrations/)
Fichiers de migration pour créer et modifier la structure de la base de données :

- **Tables utilisateurs** : `users`, `cache`, `jobs`
- **Tables métier** :
  - `entraineur` - Informations des entraîneurs
  - `entrainement` - Entraînements créés
  - `seance` - Séances d'entraînement
  - `adherent` - Adhérents du club
  - `commentaire` - Commentaires sur les entraînements
  - `audit_log` - Logs d'audit
  - `echanger` - Relations d'échange
  - `entrainer` - Relations entraîneur/entraînement

#### Seeders (database/seeders/)
- **`DatabaseSeeder.php`** - Seeder principal
- **`LyonPalmeSeeder.php`** - Données de test spécifiques au projet

### 🎨 Resources (resources/)

#### Views (resources/views/)
Templates Blade pour l'interface utilisateur.

#### Assets (resources/css/, resources/js/)
Fichiers CSS et JavaScript à compiler avec Vite.

### 🛣️ Routes (routes/)

- **`web.php`** - Routes web principales
- **`auth.php`** - Routes d'authentification
- **`console.php`** - Commandes Artisan

### ⚙️ Configuration (config/)

Fichiers de configuration Laravel :
- **`app.php`** - Configuration générale de l'application
- **`database.php`** - Configuration de la base de données
- **`auth.php`** - Configuration de l'authentification
- **`cache.php`** - Configuration du cache
- Et autres...

## 🚀 Installation et démarrage

### Prérequis

- PHP 8.2 ou supérieur
- Composer
- Node.js et npm
- Base de données (MySQL/PostgreSQL)

### Étapes d'installation

1. **Cloner le projet**
   ```bash
   git clone <url-du-repository>
   cd lyonpalme
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
   - Éditer le fichier `.env` avec vos paramètres de base de données
   - Créer la base de données

6. **Exécuter les migrations**
   ```bash
   php artisan migrate
   ```

7. **Optionnel : Peupler avec des données de test**
   ```bash
   php artisan db:seed --class=LyonPalmeSeeder
   ```

8. **Compiler les assets**
   ```bash
   npm run dev
   # ou pour la production
   npm run build
   ```

9. **Démarrer le serveur de développement**
   ```bash
   php artisan serve
   ```

## 🛠️ Technologies utilisées

- **Backend** : Laravel 12 (PHP 8.2+)
- **Frontend** : Inertia.js avec Vite
- **Styling** : Tailwind CSS
- **Base de données** : MySQL/PostgreSQL avec Eloquent ORM
- **Tests** : PHPUnit

## 📝 Commandes utiles

```bash
# Créer une migration
php artisan make:migration create_table_name

# Créer un modèle avec migration
php artisan make:model ModelName -m

# Créer un contrôleur
php artisan make:controller ControllerName

# Exécuter les tests
php artisan test

# Nettoyer le cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## 📊 Structure de la base de données

### Tables principales

- **ADHERENT** : Informations des adhérents (nom, prénom, email, etc.)
- **ENTRAINEUR** : Données des entraîneurs
- **ENTRAINEMENT** : Entraînements créés par les entraîneurs
- **SEANCE** : Séances d'entraînement planifiées
- **COMMENTAIRE** : Commentaires sur les entraînements

### Relations

- Un entraîneur peut créer plusieurs entraînements
- Un entraînement peut avoir plusieurs séances
- Les adhérents peuvent commenter les entraînements
- Système d'audit pour tracer les actions

## 📞 Contact

Pour toute question concernant le projet Lyon Palme, n'hésitez pas à nous contacter.

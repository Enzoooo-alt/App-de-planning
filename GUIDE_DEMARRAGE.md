# Guide de Démarrage - Lyon Palme

## Démarrer l'application en local

### Option 1 : Démarrage simple

```bash
# Se placer dans le dossier du projet
cd /var/www/html/websites/App-de-planning

# Démarrer le serveur Laravel
php artisan serve
```

L'application sera accessible sur : **http://localhost:8000**

### Option 2 : Démarrage avec watch des assets (développement)

**Terminal 1** : Serveur Laravel
```bash
cd /var/www/html/websites/App-de-planning
php artisan serve
```

**Terminal 2** : Watch des assets (compilation automatique)
```bash
cd /var/www/html/websites/App-de-planning
npm run dev
```

## Créer un utilisateur de test

### Option 1 : Via Tinker

```bash
php artisan tinker
```

Puis dans Tinker :
```php
use App\Models\User;

// Créer un utilisateur simple (Membre)
User::factory()->create([
    'name' => 'Test User',
    'first_name' => 'Test',
    'last_name' => 'User',
    'email' => 'test@lyonpalme.com',
    'password' => bcrypt('password'),
    'role_id' => 1 // 1=Membre, 2=Entraîneur, 3=Responsable Planning, 4=Président
]);

// Créer un entraîneur
User::factory()->create([
    'name' => 'Entraîneur Lyon',
    'first_name' => 'Jean',
    'last_name' => 'Dupont',
    'email' => 'entraineur@lyonpalme.com',
    'password' => bcrypt('password'),
    'role_id' => 2
]);

// Créer un président
User::factory()->create([
    'name' => 'Président Lyon',
    'first_name' => 'Marie',
    'last_name' => 'Martin',
    'email' => 'president@lyonpalme.com',
    'password' => bcrypt('password'),
    'role_id' => 4
]);

exit
```

### Option 2 : Via inscription normale

1. Aller sur http://localhost:8000
2. Cliquer sur "Inscription"
3. Remplir le formulaire
4. Se connecter

### Option 3 : Via Seeder (si disponible)

```bash
php artisan db:seed --class=LyonPalmeSeeder
```

## URLs importantes

- **Page d'accueil** : http://localhost:8000
- **Connexion** : http://localhost:8000/login
- **Inscription** : http://localhost:8000/register
- **Dashboard** : http://localhost:8000/dashboard
- **Profil** : http://localhost:8000/profile
- **Entraîneurs** : http://localhost:8000/entraineurs
- **Adhérents** : http://localhost:8000/adherents
- **Entraînements** : http://localhost:8000/entrainements
- **Séances** : http://localhost:8000/seances

## Identifiants de test

Après avoir créé les utilisateurs ci-dessus :

**Membre**
- Email : `test@lyonpalme.com`
- Mot de passe : `password`

**Entraîneur**
- Email : `entraineur@lyonpalme.com`
- Mot de passe : `password`

**Président**
- Email : `president@lyonpalme.com`
- Mot de passe : `password`

## Résolution de problèmes

### Erreur "No application encryption key has been specified"

```bash
php artisan key:generate
```

### Erreur de base de données

```bash
# Vérifier que le fichier database.sqlite existe
ls -la database/database.sqlite

# Si absent, le créer
touch database/database.sqlite

# Relancer les migrations
php artisan migrate:fresh
```

### Erreur "Class 'App\Models\Role' not found"

```bash
# S'assurer que la table roles existe
php artisan migrate

# Vérifier les tables
php artisan tinker
>>> DB::table('roles')->get()
```

### Les styles ne s'appliquent pas

```bash
# Recompiler les assets
npm run build

# Ou en mode dev avec watch
npm run dev

# Nettoyer le cache
php artisan optimize:clear
```

### Port 8000 déjà utilisé

```bash
# Utiliser un autre port
php artisan serve --port=8001
```

## Commandes utiles

### Développement

```bash
# Mode développement complet (serveur + watch)
# Dans terminal 1 :
php artisan serve

# Dans terminal 2 :
npm run dev
```

### Base de données

```bash
# Reset complet de la base
php artisan migrate:fresh

# Reset avec seeders
php artisan migrate:fresh --seed

# Voir l'état des migrations
php artisan migrate:status
```

### Cache

```bash
# Nettoyer tous les caches
php artisan optimize:clear

# Ou individuellement
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
```

### Tests

```bash
# Lancer tous les tests
php artisan test

# Tests avec couverture
php artisan test --coverage
```

## Structure du projet

```
App-de-planning/
├── app/                    # Code PHP (Models, Controllers)
├── resources/
│   ├── css/
│   │   ├── lyon-palme-v2.css    # Nouveau Design System
│   │   └── lyon-palme.css       # Ancien (backup)
│   ├── views/
│   │   ├── welcome-v2.blade.php # Nouvelle page d'accueil
│   │   └── layouts/
│   │       └── app-v2.blade.php # Nouveau layout
│   └── js/                # JavaScript et Vue.js
├── routes/
│   └── web.php            # Routes de l'application
├── database/
│   ├── migrations/        # Migrations de base de données
│   └── seeders/           # Seeders pour données de test
└── public/
    └── build/             # Assets compilés (généré par Vite)
```

## Vérifications avant de démarrer

- [ ] PHP 8.2+ installé (`php -v`)
- [ ] Composer installé (`composer --version`)
- [ ] Node.js et npm installés (`node -v`, `npm -v`)
- [ ] Fichier `.env` existe (`ls .env`)
- [ ] Clé d'application générée (dans `.env`, ligne `APP_KEY=`)
- [ ] Base de données créée (`ls database/database.sqlite`)
- [ ] Migrations exécutées (`php artisan migrate:status`)
- [ ] Dépendances installées (`ls vendor/`, `ls node_modules/`)
- [ ] Assets compilés (`ls public/build/`)

## Démarrage rapide (tout en une commande)

```bash
cd /var/www/html/websites/App-de-planning && \
composer install && \
npm install && \
cp .env.example .env 2>/dev/null || true && \
php artisan key:generate && \
touch database/database.sqlite && \
php artisan migrate && \
npm run build && \
php artisan serve
```

## En cas de problème

1. Vérifier les logs Laravel : `storage/logs/laravel.log`
2. Vérifier la console du navigateur (F12)
3. Nettoyer tous les caches : `php artisan optimize:clear`
4. Recompiler les assets : `npm run build`
5. Vérifier les permissions : `chmod -R 755 storage bootstrap/cache`

## Support

En cas de problème :
1. Consulter [RAPPORT_PROGRESSION.md](RAPPORT_PROGRESSION.md)
2. Consulter [PLAN_AMELIORATION.md](PLAN_AMELIORATION.md)
3. Vérifier les logs dans `storage/logs/`

---

**Bon développement !**

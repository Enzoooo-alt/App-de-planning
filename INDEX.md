# Lyon Palme - Index de la Documentation

## Documentation Principale

### 📚 Guides Essentiels

| Fichier | Description | Utilité |
|---------|-------------|---------|
| [README-v2.md](README-v2.md) | Documentation complète du projet | Comprendre le projet, installation, structure |
| [GUIDE_DEMARRAGE.md](GUIDE_DEMARRAGE.md) | Guide de démarrage rapide | Lancer l'application en local |
| [GUIDE_GITHUB.md](GUIDE_GITHUB.md) | Guide pour pousser sur GitHub | Déployer sur GitHub |
| [RECAPITULATIF.md](RECAPITULATIF.md) | Récapitulatif de la session | Vue d'ensemble du travail accompli |

### 🎯 Planning et Suivi

| Fichier | Description | Utilité |
|---------|-------------|---------|
| [PLAN_AMELIORATION.md](PLAN_AMELIORATION.md) | Plan de développement en 5 phases | Roadmap du projet |
| [RAPPORT_PROGRESSION.md](RAPPORT_PROGRESSION.md) | Rapport de la session actuelle | État des lieux et statistiques |

### 🎨 Design System

| Fichier | Description | Utilité |
|---------|-------------|---------|
| [resources/css/DESIGN_SYSTEM.md](resources/css/DESIGN_SYSTEM.md) | Guide du Design System Maritime | Utiliser les composants CSS |
| [resources/css/lyon-palme-v2.css](resources/css/lyon-palme-v2.css) | Fichier CSS du Design System v2.0 | Styles de l'application |

## Guide de Lecture Rapide

### Je veux démarrer le projet

1. Lire [GUIDE_DEMARRAGE.md](GUIDE_DEMARRAGE.md)
2. Exécuter : `php artisan serve`
3. Ouvrir : http://localhost:8000

### Je veux comprendre le projet

1. Lire [README-v2.md](README-v2.md)
2. Explorer [RECAPITULATIF.md](RECAPITULATIF.md)
3. Consulter [PLAN_AMELIORATION.md](PLAN_AMELIORATION.md)

### Je veux pousser sur GitHub

1. Lire [GUIDE_GITHUB.md](GUIDE_GITHUB.md)
2. Choisir une option (PR recommandée)
3. Exécuter les commandes

### Je veux développer une nouvelle fonctionnalité

1. Consulter [PLAN_AMELIORATION.md](PLAN_AMELIORATION.md) pour voir les prochaines étapes
2. Consulter [resources/css/DESIGN_SYSTEM.md](resources/css/DESIGN_SYSTEM.md) pour utiliser les composants
3. Suivre les conventions du projet

## Structure de la Documentation

```
App-de-planning/
├── INDEX.md                        ← Vous êtes ici
├── README-v2.md                    ← Documentation principale
├── GUIDE_DEMARRAGE.md              ← Démarrage rapide
├── GUIDE_GITHUB.md                 ← Push sur GitHub
├── RECAPITULATIF.md                ← Vue d'ensemble
├── PLAN_AMELIORATION.md            ← Roadmap
├── RAPPORT_PROGRESSION.md          ← Rapport de session
└── resources/css/
    ├── DESIGN_SYSTEM.md            ← Guide Design System
    └── lyon-palme-v2.css           ← CSS Design System v2.0
```

## Quick Start (Démarrage Ultra-Rapide)

```bash
# 1. Cloner et installer
git clone <url-du-repo>
cd App-de-planning
composer install && npm install

# 2. Configuration
cp .env.example .env
php artisan key:generate
touch database/database.sqlite

# 3. Base de données
php artisan migrate

# 4. Compiler et démarrer
npm run build
php artisan serve
```

Ensuite : http://localhost:8000

## Commandes les Plus Utilisées

```bash
# Démarrer le serveur
php artisan serve

# Compiler les assets (production)
npm run build

# Compiler les assets (dev avec watch)
npm run dev

# Créer un utilisateur de test
php artisan tinker
>>> User::factory()->create(['email' => 'test@lyonpalme.com'])

# Nettoyer les caches
php artisan optimize:clear

# Voir les routes
php artisan route:list

# Voir les logs
tail -f storage/logs/laravel.log
```

## État du Projet

### Phase 1 : Design System ✅ COMPLÉTÉE

- ✅ Design System Maritime v2.0
- ✅ Page d'accueil professionnelle
- ✅ Layout professionnel
- ✅ Documentation complète
- ✅ 7 commits sur branche `design-system`

### Phase 2 : Dashboards et Navigation 🔜 À VENIR

Voir [PLAN_AMELIORATION.md](PLAN_AMELIORATION.md) pour les détails.

## Statistiques

| Métrique | Valeur |
|----------|--------|
| Commits (Phase 1) | 7 |
| Fichiers créés | 13 |
| Lignes de CSS | ~1000 |
| Lignes de documentation | ~2000 |
| Composants CSS | 15+ |
| Pages refaites | 2 |
| Couverture responsive | 100% |

## Ressources Externes

### Officielles Lyon Palme

- **Site officiel** : https://www.lyonpalme.com/
- **Contact** : contact@lyonpalme.com

### Technologies

- **Laravel 12** : https://laravel.com/docs
- **Vue.js 3** : https://vuejs.org/
- **Inertia.js** : https://inertiajs.com/
- **Tailwind CSS** : https://tailwindcss.com/
- **Vite** : https://vitejs.dev/

### Git & GitHub

- **GitHub** : https://github.com
- **Git Docs** : https://git-scm.com/doc
- **Conventional Commits** : https://www.conventionalcommits.org/

## Aide et Support

### En cas de problème

1. Consulter [GUIDE_DEMARRAGE.md](GUIDE_DEMARRAGE.md) section "Résolution de problèmes"
2. Vérifier les logs : `storage/logs/laravel.log`
3. Nettoyer les caches : `php artisan optimize:clear`
4. Consulter la documentation Laravel

### Contribution

Pour contribuer au projet :

1. Créer une branche depuis `main` : `git checkout -b feature/ma-feature`
2. Suivre les conventions de commits (Conventional Commits)
3. Utiliser le Design System v2.0
4. Documenter les nouvelles fonctionnalités
5. Créer une Pull Request

### Conventions de Commits

```
feat: Nouvelle fonctionnalité
fix: Correction de bug
docs: Documentation
style: Formatage, point-virgules manquants, etc.
refactor: Refactorisation du code
test: Ajout de tests
chore: Maintenance, dépendances, etc.
```

Exemples :
```bash
git commit -m "feat: Ajout du calendrier maritime interactif"
git commit -m "fix: Correction de l'affichage mobile du header"
git commit -m "docs: Mise à jour du guide d'installation"
```

## Feuille de Route

### Phase 1 ✅ (Complétée)
- Design System Maritime v2.0
- Page d'accueil professionnelle
- Documentation complète

### Phase 2 🔜 (Prochaine)
- Dashboards par rôle
- Navigation améliorée
- Statistiques visuelles

### Phase 3 (Planifiée)
- Modules de gestion (adhérents, entraîneurs)
- Calendrier interactif
- Système de réservation

### Phase 4 (Planifiée)
- Composants Vue.js dynamiques
- Animations et transitions
- Notifications en temps réel

### Phase 5 (Planifiée)
- Tests automatisés
- Optimisations performance
- Déploiement production

Voir [PLAN_AMELIORATION.md](PLAN_AMELIORATION.md) pour plus de détails.

---

## Navigation Rapide

- 🏠 [Retour au README principal](README-v2.md)
- 🚀 [Guide de démarrage](GUIDE_DEMARRAGE.md)
- 📊 [Plan d'amélioration](PLAN_AMELIORATION.md)
- 🎨 [Design System](resources/css/DESIGN_SYSTEM.md)
- 🐙 [Guide GitHub](GUIDE_GITHUB.md)
- 📝 [Récapitulatif](RECAPITULATIF.md)

---

**Dernière mise à jour** : 8 janvier 2026  
**Version** : 2.0 (Design System Maritime)  
**Statut** : ✅ Phase 1 complétée, prêt pour Phase 2

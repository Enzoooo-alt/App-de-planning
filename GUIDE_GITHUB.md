# Guide GitHub - Lyon Palme

## État Actuel

- ✅ **6 commits** sur la branche `design-system`
- ✅ **12 fichiers** créés/modifiés
- ✅ **Phase 1** terminée
- ✅ Prêt à être poussé sur GitHub

## Option 1 : Pousser la branche design-system (Recommandé)

Cette option permet de créer une Pull Request pour review avant de merger dans master.

```bash
cd /var/www/html/websites/App-de-planning

# Vérifier qu'on est bien sur la branche design-system
git branch

# Pousser la branche sur GitHub
git push -u origin design-system
```

**Ensuite sur GitHub** :
1. Aller sur le repository
2. Cliquer sur "Compare & pull request"
3. Ajouter une description :
   ```
   ## Phase 1 : Professionnalisation du Design System Maritime
   
   ### Réalisations
   - ✅ Design System v2.0 sans emojis
   - ✅ Nouvelle page d'accueil professionnelle
   - ✅ Nouveau layout cohérent
   - ✅ Documentation complète (1500+ lignes)
   - ✅ Palette de couleurs Lyon Palme
   - ✅ 100% responsive
   
   ### Commits (6)
   - feat: Professionnalisation du Design System Maritime
   - feat: Refonte professionnelle de la page d'accueil
   - docs: Ajout du rapport de progression
   - feat: Activation de la nouvelle page d'accueil et layout v2
   - docs: Ajout du guide de démarrage complet
   - docs: Récapitulatif complet de la session
   
   Prêt pour la Phase 2 !
   ```
4. Cliquer sur "Create pull request"
5. Merger après review

## Option 2 : Merger dans master puis pousser

Cette option merge directement dans master localement avant de pousser.

```bash
cd /var/www/html/websites/App-de-planning

# Passer sur master
git checkout master

# Merger la branche design-system
git merge design-system

# Vérifier que tout est OK
git log --oneline -6

# Pousser sur GitHub
git push origin master
```

## Option 3 : Créer un nouveau repository GitHub

Si c'est un nouveau projet sur GitHub :

### Étape 1 : Créer le repository sur GitHub

1. Aller sur https://github.com/new
2. Nom du repository : `lyon-palme` (ou `App-de-planning`)
3. Description : `Plateforme de gestion d'activités aquatiques - Lyon Palme`
4. ⚠️ **NE PAS** initialiser avec README, .gitignore ou licence
5. Cliquer sur "Create repository"

### Étape 2 : Configurer le remote local

```bash
cd /var/www/html/websites/App-de-planning

# Vérifier les remotes existants
git remote -v

# Si origin existe déjà et pointe vers un autre repo
git remote remove origin

# Ajouter le nouveau remote
git remote add origin https://github.com/VOTRE-USERNAME/lyon-palme.git

# Vérifier
git remote -v
```

### Étape 3 : Pousser toutes les branches

```bash
# Renommer la branche principale si nécessaire
git branch -M main

# OU rester sur master
# git branch -M master

# Pousser la branche principale
git push -u origin main

# Pousser aussi design-system
git push -u origin design-system
```

## Vérifications Avant de Pousser

### Checklist Sécurité

```bash
# 1. Vérifier que .env est bien ignoré
cat .gitignore | grep .env

# 2. Vérifier qu'il n'y a pas de secrets dans le code
git diff master..design-system | grep -i "password\|secret\|key\|token"

# 3. Vérifier les fichiers qui seront poussés
git status
git log --stat -6

# 4. S'assurer que node_modules et vendor sont ignorés
du -sh node_modules vendor
cat .gitignore | grep -E "node_modules|vendor"
```

### Checklist Qualité

```bash
# 1. Compiler les assets
npm run build

# 2. Nettoyer les caches
php artisan optimize:clear

# 3. Vérifier qu'il n'y a pas d'erreurs
php artisan route:list
php artisan config:show

# 4. Tester localement
php artisan serve
# Ouvrir http://localhost:8000
```

## Après le Push

### Configurer GitHub Pages (optionnel)

Si vous voulez héberger la documentation sur GitHub Pages :

1. Aller dans Settings > Pages
2. Source : Deploy from a branch
3. Branch : main (ou master) / docs
4. Cliquer sur Save

### Protéger la branche principale

1. Aller dans Settings > Branches
2. Add rule
3. Branch name pattern : `main` (ou `master`)
4. Cocher :
   - ✅ Require a pull request before merging
   - ✅ Require approvals (1)
   - ✅ Require status checks to pass
5. Cliquer sur Create

### Ajouter un README au root

Le fichier `README-v2.md` est complet, vous pouvez :

```bash
# Utiliser README-v2 comme README principal
git mv README-v2.md README.md
git commit -m "docs: README-v2 devient README principal"
git push
```

## Commandes Git Utiles

```bash
# Voir l'historique graphique
git log --oneline --graph --all

# Voir les différences entre branches
git diff master..design-system

# Voir les fichiers modifiés
git diff --name-only master..design-system

# Voir les statistiques de commits
git diff --stat master..design-system

# Créer un tag de version
git tag -a v2.0.0 -m "Phase 1 - Design System Maritime v2.0"
git push origin v2.0.0
```

## Gestion des Branches

### Stratégie Recommandée

```
main (ou master)  ← Branche stable, production-ready
  ↓
design-system     ← Phase 1 complétée
  ↓
feature/dashboards ← Phase 2 (prochaine)
feature/calendar   ← Phase 3
...
```

### Créer une nouvelle branche pour Phase 2

```bash
# Depuis design-system
git checkout design-system

# Créer une nouvelle branche
git checkout -b feature/dashboards

# Ou depuis main après merge
git checkout main
git checkout -b feature/dashboards
```

## En Cas de Problème

### Erreur de push (rejected)

```bash
# Si le remote a des commits que vous n'avez pas
git pull --rebase origin design-system
git push origin design-system
```

### Annuler un commit local (avant push)

```bash
# Annuler le dernier commit (garde les modifications)
git reset --soft HEAD~1

# Annuler le dernier commit (supprime les modifications)
git reset --hard HEAD~1
```

### Modifier le dernier commit

```bash
# Modifier le message
git commit --amend -m "Nouveau message"

# Ajouter des fichiers oubliés
git add fichier-oublie.md
git commit --amend --no-edit
```

## Liens Utiles

- **GitHub Docs** : https://docs.github.com/
- **Git Cheatsheet** : https://education.github.com/git-cheat-sheet-education.pdf
- **Conventional Commits** : https://www.conventionalcommits.org/

## Résumé des Commandes

### Scénario le plus courant

```bash
# 1. Pousser la branche design-system
cd /var/www/html/websites/App-de-planning
git push -u origin design-system

# 2. Créer une PR sur GitHub (via interface web)

# 3. Après merge, mettre à jour master local
git checkout master
git pull origin master

# 4. Supprimer la branche locale (optionnel)
git branch -d design-system
```

---

**Prêt à pousser sur GitHub !** 🚀

Suivez l'Option 1 pour une approche professionnelle avec Pull Request.

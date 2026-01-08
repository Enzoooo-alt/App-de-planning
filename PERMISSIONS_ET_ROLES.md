# 🔐 Système de Permissions et Rôles Multiples - Lyon Palme

## ✨ Nouvelles Fonctionnalités Implémentées

### 1. 👥 Rôles Multiples par Utilisateur

Les utilisateurs peuvent maintenant avoir **plusieurs rôles simultanément**. Par exemple :
- Marie (planning@lyonpalme.fr) est à la fois **Responsable Planning** ET **Adhérent**
- Permet des doubles casquettes administratives + participation active

**Implémentation technique :**
- Table pivot `role_user` avec contrainte unique `[user_id, role_id]`
- Méthodes User : `hasRole()`, `hasAnyRole()`, `getRoleNames()`
- Support complet backward compatibility avec l'ancien champ `role_id`

---

### 2. 🚫 Masquage des Éléments UI selon les Permissions

Les boutons et liens sont maintenant **cachés automatiquement** selon le rôle :

#### Entraîneurs (Trainers)
- **Voir la liste** : Tous (president, responsable_planning, entraineur, membre)
- **Créer/Modifier/Supprimer** : Uniquement president et responsable_planning
- Bouton "Nouvel Entraîneur" caché pour les membres

#### Adhérents (Members)
- **Voir la liste** : Uniquement president et responsable_planning
- **Créer/Modifier/Supprimer** : Uniquement president et responsable_planning
- Navigation "Adhérents" cachée pour entraineur et membre

#### Entraînements (Training Programs)
- **Voir la liste** : Tous
- **Créer/Modifier/Supprimer** : president, responsable_planning, entraineur
- Boutons cachés pour les membres simples

#### Séances (Training Sessions)
- **Voir la liste** : Tous
- **Créer/Modifier/Supprimer** : president, responsable_planning, entraineur
- Boutons cachés pour les membres simples

---

### 3. 🛡️ Protection des Routes Backend

Toutes les routes sont protégées par middleware `CheckRole` :

```php
// Entraîneurs - Seuls président et responsable peuvent modifier
Route::resource('entraineurs', TrainerController::class)
    ->except(['index', 'show'])
    ->middleware('role:president,responsable_planning');

// Adhérents - Seuls président et responsable peuvent gérer
Route::resource('adherents', MemberController::class)
    ->middleware('role:president,responsable_planning');

// Entraînements - Tous sauf membres
Route::resource('entrainements', EntrainementController::class)
    ->except(['index', 'show'])
    ->middleware('role:president,responsable_planning,entraineur');

// Séances - Tous sauf membres
Route::resource('seances', SeanceController::class)
    ->except(['index', 'show'])
    ->middleware('role:president,responsable_planning,entraineur');
```

---

## 🧪 Comptes de Test

Utilisez ces comptes pour tester les permissions :

| Email | Mot de passe | Rôle(s) | Permissions |
|-------|--------------|---------|-------------|
| president@lyonpalme.fr | password123 | Président | **Tout** |
| planning@lyonpalme.fr | password123 | Responsable + Adhérent | Gestion complète (double casquette) |
| pierre.coach@lyonpalme.fr | password123 | Entraîneur | Entraînements + Séances |
| lucas.nageur@example.com | password123 | Membre | Lecture seule |

### Test du Double Rôle
Connectez-vous avec **planning@lyonpalme.fr** pour voir :
- ✅ Accès administrateur complet (créer entraîneurs, adhérents)
- ✅ Profil adhérent actif (niveau : avancé)
- ✅ Démonstration du système multi-rôles

---

## 📋 Vérifications Effectuées

✅ **Migration & Base de données**
- Table `role_user` créée avec succès
- Contrainte unique sur [user_id, role_id]
- Foreign keys avec CASCADE DELETE

✅ **Modèles Eloquent**
- User::hasRole($name) - vérifie un rôle spécifique
- User::hasAnyRole(['role1', 'role2']) - vérifie plusieurs rôles
- User::getRoleNames() - retourne tous les noms de rôles
- Relationship roles() via belongsToMany

✅ **Routes Web**
- Toutes les routes CRUD protégées par middleware
- Séparation correcte index/show (lecture) vs create/edit/destroy (écriture)
- Tests effectués pour TrainerController (7 méthodes RESTful)

✅ **Vues Blade**
- Boutons "Créer" cachés avec @if(auth()->check() && auth()->user()->hasAnyRole(...))
- Boutons "Modifier/Supprimer" cachés dans les listes
- Navigation filtrée selon les rôles dans app.blade.php et app-v2.blade.php

✅ **Seeders**
- TestUsersSeeder crée 9 comptes test
- Marie (planning) a 2 rôles : responsable_planning + membre
- Profil adhérent créé pour Marie avec niveau avancé

---

## 🎨 Design Système Maritime v2.0

Le site utilise un design professionnel inspiré des sports aquatiques :

**Palette de couleurs :**
- Navy primaire : `#0c4a6e` (Deep Ocean Blue)
- Teal accentuation : `#0d9488` (Primary Teal)
- Amber actions : `#f59e0b` (Primary Amber)
- Backgrounds : `#fdfdfd` (Ultra clean white) + `#f8fafb` (Soft off-white)

**Éléments SVG :**
- Icônes sans emojis (sauf où c'est culturellement approprié)
- Ombres subtiles maritimes
- Radius consistants : 8px, 12px, 16px

---

## 🚀 Prochaines Étapes Recommandées

1. **Tester en conditions réelles**
   - Connectez-vous avec chaque compte test
   - Vérifiez que les boutons apparaissent/disparaissent correctement
   - Testez les routes protégées (essayer d'accéder à /entraineurs/create en tant que membre)

2. **Améliorer le Dashboard**
   - Afficher les rôles de l'utilisateur connecté
   - Statistiques personnalisées selon le rôle

3. **Fonctionnalités futures**
   - Notifications en temps réel
   - Calendrier de séances interactif
   - Exports PDF des plannings

4. **SEO & Performance**
   - Optimiser les requêtes Eloquent (eager loading)
   - Ajouter cache pour les listes longues
   - Meta tags pour le référencement

---

## 📞 Support

Pour toute question sur le système de permissions :
1. Consultez les méthodes dans [app/Models/User.php](app/Models/User.php)
2. Vérifiez les routes dans [routes/web.php](routes/web.php)
3. Examinez le middleware dans [app/Http/Middleware/CheckRole.php](app/Http/Middleware/CheckRole.php)

**Dernière mise à jour :** 8 janvier 2026
**Version :** 2.0 - Système multi-rôles avec masquage UI

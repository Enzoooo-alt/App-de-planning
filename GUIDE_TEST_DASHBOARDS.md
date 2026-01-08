# 🧪 Guide de Test - Dashboards par Rôle
## App de Planning - Lyon Palme

---

## 🎯 Objectif

Tester les dashboards pour chaque type d'utilisateur et vérifier :
- ✅ Contenu adapté au rôle
- ✅ Permissions d'accès (création/modification/suppression)
- ✅ Navigation et boutons appropriés
- ✅ Affichage des statistiques correctes

---

## 🔐 Comptes de Test Créés

| Rôle | Email | Mot de passe | Description |
|------|-------|--------------|-------------|
| **👑 Président** | president@lyonpalme.fr | password123 | Accès complet à toutes les fonctionnalités |
| **📅 Responsable Planning** | planning@lyonpalme.fr | password123 | Gestion séances, entraînements, adhérents |
| **🏊 Entraîneur 1** | pierre.coach@lyonpalme.fr | password123 | Natation synchronisée - BEESAN |
| **🏊 Entraîneur 2** | sophie.nageuse@lyonpalme.fr | password123 | Compétition - Maître Nageur |
| **🏊 Entraîneur 3** | thomas.aquatique@lyonpalme.fr | password123 | Débutants - BPJEPS AAN |
| **👤 Membre 1** | lucas.nageur@example.com | password123 | Niveau intermédiaire, adhérent depuis 6 mois |
| **👤 Membre 2** | emma.piscine@example.com | password123 | Niveau avancé, adhérent depuis 1 an |
| **👤 Membre 3** | hugo.debutant@example.com | password123 | Nouveau, sans profil adhérent |
| **👤 Membre 4** | lea.champion@example.com | password123 | Niveau compétition, adhérent depuis 2 ans |

---

## 📋 Tests à Effectuer

### 1. 👑 Test Président

#### Connexion
```
URL: http://localhost:8000/login
Email: president@lyonpalme.fr
Mot de passe: password123
```

#### Dashboard Attendu
- **Vue** : `dashboard/president-v2.blade.php`
- **Titre** : "Tableau de Bord Président"
- **Statistiques** :
  - Total membres actifs
  - Total entraîneurs
  - Séances cette semaine
  - Programmes actifs
- **Sections** :
  - Vue d'ensemble complète
  - Accès rapides à toutes les sections
  - Gestion complète (créer/modifier/supprimer)

#### Actions à Tester
- [x] Créer un entraîneur ✅ (devrait fonctionner)
- [x] Créer un adhérent ✅ (devrait fonctionner)
- [x] Créer un entraînement ✅ (devrait fonctionner)
- [x] Créer une séance ✅ (devrait fonctionner)
- [x] Modifier n'importe quel élément ✅ (devrait fonctionner)
- [x] Supprimer n'importe quel élément ✅ (devrait fonctionner)

---

### 2. 📅 Test Responsable Planning

#### Connexion
```
Email: planning@lyonpalme.fr
Mot de passe: password123
```

#### Dashboard Attendu
- **Vue** : `dashboard/responsable-planning-v2.blade.php`
- **Titre** : "Tableau de Bord Responsable Planning"
- **Focus** : Gestion des séances et planning
- **Sections** :
  - Calendrier des séances
  - Statistiques planning
  - Gestion séances/entraînements
  - Gestion adhérents

#### Actions à Tester
- [x] Créer un entraîneur ✅ (devrait fonctionner)
- [x] Créer un adhérent ✅ (devrait fonctionner)
- [x] Créer un entraînement ✅ (devrait fonctionner)
- [x] Créer une séance ✅ (devrait fonctionner)
- [x] Modifier entraînement/séance ✅ (devrait fonctionner)
- [ ] Supprimer (limité - seulement si autorisé)

---

### 3. 🏊 Test Entraîneur

#### Connexion (Pierre)
```
Email: pierre.coach@lyonpalme.fr
Mot de passe: password123
```

#### Dashboard Attendu
- **Vue** : `dashboard/entraineur-v2.blade.php`
- **Titre** : "Tableau de Bord Entraîneur"
- **Focus** : Ses entraînements et séances
- **Sections** :
  - Mes entraînements
  - Prochaines séances
  - Adhérents dans mes groupes
  - Planning personnel

#### Actions à Tester
- [ ] Créer un entraîneur ❌ (devrait être bloqué - 403)
- [ ] Créer un adhérent ❌ (devrait être bloqué - 403)
- [x] Créer un entraînement ✅ (devrait fonctionner)
- [x] Créer une séance ✅ (devrait fonctionner)
- [x] Modifier ses entraînements ✅ (devrait fonctionner)
- [ ] Modifier entraînements d'autres ⚠️ (à limiter idéalement)

---

### 4. 👤 Test Membre

#### Connexion (Lucas)
```
Email: lucas.nageur@example.com
Mot de passe: password123
```

#### Dashboard Attendu
- **Vue** : `dashboard/membre-v2.blade.php`
- **Titre** : "Tableau de Bord Membre"
- **Mode** : Consultation uniquement
- **Sections** :
  - Mes informations
  - Prochaines séances disponibles
  - Mon niveau et progression
  - Entraînements auxquels je participe

#### Actions à Tester
- [ ] Créer un entraîneur ❌ (devrait être bloqué - 403)
- [ ] Créer un adhérent ❌ (devrait être bloqué - 403)
- [ ] Créer un entraînement ❌ (devrait être bloqué - 403)
- [ ] Créer une séance ❌ (devrait être bloqué - 403)
- [ ] Voir liste entraînements ✅ (consultation seule)
- [ ] Voir liste séances ✅ (consultation seule)
- [ ] Modifier/Supprimer ❌ (tous bloqués)

---

## 🔍 Vérifications Visuelles

### Design System v2.0
- [ ] Couleurs maritimes cohérentes (Navy, Teal, Marine)
- [ ] SVG icons partout (0 émojis)
- [ ] Cards avec border-left coloré
- [ ] Badges de statut appropriés
- [ ] Layout responsive (mobile/desktop)
- [ ] Navigation claire et intuitive

### Contenu Adapté
- [ ] Statistiques pertinentes au rôle
- [ ] Boutons d'action selon permissions
- [ ] Messages d'accueil personnalisés
- [ ] Sections prioritaires en haut

---

## 🚨 Tests de Permissions (Critiques)

### Blocages Attendus pour Membres

#### Test 1 : Création Entraîneur
```
1. Se connecter comme lucas.nageur@example.com
2. Aller sur /entraineurs/create
3. Attendu: Page 403 Forbidden
4. Message: "Vous n'avez pas les permissions nécessaires"
```

#### Test 2 : Modification Adhérent
```
1. Se connecter comme lucas.nageur@example.com
2. Aller sur /adherents/1/edit
3. Attendu: Page 403 Forbidden
```

#### Test 3 : Création Séance
```
1. Se connecter comme lucas.nageur@example.com
2. Aller sur /seances/create
3. Attendu: Page 403 Forbidden
```

---

## 📊 Checklist Complète

### Président ✅
- [ ] Dashboard avec toutes statistiques
- [ ] Peut créer entraîneurs
- [ ] Peut créer adhérents
- [ ] Peut créer entraînements
- [ ] Peut créer séances
- [ ] Peut modifier tout
- [ ] Peut supprimer tout
- [ ] Navigation vers toutes sections

### Responsable Planning ✅
- [ ] Dashboard axé planning
- [ ] Peut créer entraîneurs
- [ ] Peut créer adhérents
- [ ] Peut créer entraînements
- [ ] Peut créer séances
- [ ] Peut modifier entraînements/séances
- [ ] Navigation vers gestion

### Entraîneur ✅
- [ ] Dashboard personnel
- [ ] NE PEUT PAS créer entraîneurs ❌
- [ ] NE PEUT PAS créer adhérents ❌
- [ ] Peut créer ses entraînements
- [ ] Peut créer ses séances
- [ ] Peut modifier ses entraînements
- [ ] Voit ses groupes

### Membre ✅
- [ ] Dashboard consultation
- [ ] NE PEUT PAS créer entraîneurs ❌
- [ ] NE PEUT PAS créer adhérents ❌
- [ ] NE PEUT PAS créer entraînements ❌
- [ ] NE PEUT PAS créer séances ❌
- [ ] NE PEUT PAS modifier ❌
- [ ] NE PEUT PAS supprimer ❌
- [ ] Peut consulter listes
- [ ] Voit ses informations

---

## 🐛 Bugs Potentiels à Surveiller

### Permissions
- [ ] 403 pages bien stylisées
- [ ] Redirection login si non connecté
- [ ] Messages d'erreur clairs
- [ ] Pas de failles de sécurité (accès direct URL)

### Dashboard
- [ ] Statistiques correctes
- [ ] Compteurs à jour
- [ ] Liens fonctionnels
- [ ] Pas d'erreurs 404

### Navigation
- [ ] Boutons appropriés au rôle
- [ ] Sections masquées si pas de permission
- [ ] Menu adapté au rôle
- [ ] Breadcrumbs corrects

---

## 📝 Rapport de Test (à compléter)

### Date du Test : ______________

#### Président
- Dashboard : ✅ / ❌
- Permissions : ✅ / ❌
- Navigation : ✅ / ❌
- Notes : ___________________________________________

#### Responsable Planning
- Dashboard : ✅ / ❌
- Permissions : ✅ / ❌
- Navigation : ✅ / ❌
- Notes : ___________________________________________

#### Entraîneur
- Dashboard : ✅ / ❌
- Permissions : ✅ / ❌
- Blocages OK : ✅ / ❌
- Notes : ___________________________________________

#### Membre
- Dashboard : ✅ / ❌
- Permissions : ✅ / ❌
- Blocages OK : ✅ / ❌
- Notes : ___________________________________________

---

## 🔗 URLs de Test Rapide

```bash
# Login
http://localhost:8000/login

# Dashboards (après login)
http://localhost:8000/dashboard

# Listes
http://localhost:8000/entraineurs
http://localhost:8000/adherents
http://localhost:8000/entrainements
http://localhost:8000/seances

# Création (tester permissions)
http://localhost:8000/entraineurs/create
http://localhost:8000/adherents/create
http://localhost:8000/entrainements/create
http://localhost:8000/seances/create
```

---

## ✅ Conclusion

Une fois tous les tests effectués :
1. Vérifier que tous les rôles voient le dashboard approprié
2. Confirmer que les membres ne peuvent PAS créer d'entraîneurs
3. Confirmer que les permissions sont respectées
4. Valider le Design System maritime sur tous les dashboards
5. Documenter les bugs éventuels

**Status Final** : ✅ PRODUCTION READY / ⚠️ CORRECTIONS NÉCESSAIRES

---

**Serveur de test** : `php artisan serve --host=0.0.0.0 --port=8000`  
**Base de données** : MariaDB `lyonpalme_db`  
**User** : `lyonpalme_user`

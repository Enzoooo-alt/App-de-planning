# Documentation Base de Données Lyon Palme v2.0

## 📊 Mise à jour effectuée le 24 novembre 2025

### 🗃️ **Fichiers de base de données disponibles :**

1. **`SQL BDD VERSION 1.sql`** - Version originale (obsolète)
2. **`SQL_BDD_VERSION_2_ACTUELLE.sql`** - ✅ **VERSION ACTUELLE** (recommandée)
3. **`BACKUP_BDD_COMPLETE_20251124_162253.sql`** - Sauvegarde complète avec données

---

### 🏗️ **Structure actuelle de la base de données**

#### **Tables principales :**
- **`users`** - Utilisateurs/Adhérents avec authentification Sanctum
- **`roles`** - Système de permissions (adhérent, coach, responsable, admin)
- **`plannings`** - Séances d'entraînement avec inscriptions
- **`trainings`** - Bibliothèque d'exercices et entraînements

#### **Tables de liaison :**
- **`user_role`** - Relation utilisateurs ↔ rôles
- **`user_planning`** - Inscriptions aux séances
- **`planning_training`** - Association plannings ↔ exercices

#### **Tables système Laravel :**
- `cache`, `sessions`, `personal_access_tokens`, `password_reset_tokens`, `migrations`

---

### 🔄 **Modifications apportées :**

#### **✅ Ajouts :**
- Colonne `title` dans la table `plannings`
- Colonnes `phone`, `birth_date`, `address`, `telephone`, `date_naissance` dans `users`
- Support complet de Laravel Sanctum
- Tables de sessions et cache

#### **❌ Suppressions :**
- Table `materials` et ses relations *(supprimée le 24/11/2025)*
- Table `competitions` et ses relations *(supprimée le 24/11/2025)*
- Table `user_competition` *(supprimée le 24/11/2025)*

---

### 👥 **Comptes par défaut créés :**

| Email | Mot de passe | Rôle | Usage |
|-------|--------------|------|--------|
| `admin@lyonpalme.fr` | `password` | Admin | Compte administrateur |
| `test@test.com` | `password` | Adhérent | Compte de test |

---

### 🚀 **Installation/Restauration :**

#### **Pour une nouvelle installation :**
```bash
mysql -u [user] -p[password] < SQL_BDD_VERSION_2_ACTUELLE.sql
```

#### **Pour restaurer la base complète avec données :**
```bash
mysql -u [user] -p[password] < BACKUP_BDD_COMPLETE_20251124_162253.sql
```

---

### 📋 **Fonctionnalités supportées :**

✅ **Authentification complète** (connexion, inscription, déconnexion)  
✅ **Gestion des utilisateurs** avec rôles  
✅ **Planification des séances** d'entraînement  
✅ **Inscriptions** aux séances  
✅ **Bibliothèque d'exercices**  
✅ **Interface responsive** avec Tailwind CSS  
✅ **Protection CSRF** et sécurité renforcée  

❌ **Supprimé :** Gestion du matériel et des compétitions  

---

### 🔧 **Configuration recommandée :**

- **PHP** : 8.1+
- **Laravel** : 12.x
- **MySQL/MariaDB** : 5.7+
- **Extensions PHP** : PDO, OpenSSL, Mbstring, Tokenizer

---

### 📝 **Notes importantes :**

- La base de données utilise `utf8mb4_unicode_ci` pour un support complet des caractères
- Les clés étrangères sont configurées avec `CASCADE DELETE` pour maintenir la cohérence
- Les timestamps sont automatiquement gérés par Laravel
- Les mots de passe sont hachés avec bcrypt

---

*Dernière mise à jour : 24 novembre 2025*

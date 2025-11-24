-- Base de données Lyon Palme - Structure mise à jour
-- Date de génération: 24 novembre 2025
-- Correspond à la structure actuelle de l'application

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------
-- Structure de la base de données `lyonpalme`
-- --------------------------------------------------------

CREATE DATABASE IF NOT EXISTS `lyonpalme` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `lyonpalme`;

-- --------------------------------------------------------
-- Structure de la table `users`
-- --------------------------------------------------------

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Structure de la table `roles`
-- --------------------------------------------------------

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Structure de la table `plannings`
-- --------------------------------------------------------

CREATE TABLE `plannings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `day` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `coach1` varchar(255) NOT NULL,
  `coach2` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `max_participants` int(11) NOT NULL DEFAULT 20,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Structure de la table `trainings`
-- --------------------------------------------------------

CREATE TABLE `trainings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `pdf_path` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'general',
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Structure de la table `user_role`
-- --------------------------------------------------------

CREATE TABLE `user_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Structure de la table `user_planning`
-- --------------------------------------------------------

CREATE TABLE `user_planning` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `planning_id` bigint(20) UNSIGNED NOT NULL,
  `registration_date` date NOT NULL DEFAULT (curdate()),
  `status` varchar(255) NOT NULL DEFAULT 'registered',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Structure de la table `planning_training`
-- --------------------------------------------------------

CREATE TABLE `planning_training` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `planning_id` bigint(20) UNSIGNED NOT NULL,
  `training_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Structure des tables système Laravel
-- --------------------------------------------------------

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Index pour les tables
-- --------------------------------------------------------

-- Index pour la table `users`
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

-- Index pour la table `roles`
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

-- Index pour la table `plannings`
ALTER TABLE `plannings`
  ADD PRIMARY KEY (`id`);

-- Index pour la table `trainings`
ALTER TABLE `trainings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trainings_created_by_foreign` (`created_by`);

-- Index pour la table `user_role`
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_role_user_id_role_id_unique` (`user_id`,`role_id`),
  ADD KEY `user_role_role_id_foreign` (`role_id`);

-- Index pour la table `user_planning`
ALTER TABLE `user_planning`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_planning_user_id_foreign` (`user_id`),
  ADD KEY `user_planning_planning_id_foreign` (`planning_id`);

-- Index pour la table `planning_training`
ALTER TABLE `planning_training`
  ADD PRIMARY KEY (`id`),
  ADD KEY `planning_training_planning_id_foreign` (`planning_id`),
  ADD KEY `planning_training_training_id_foreign` (`training_id`);

-- Index pour les tables système
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

-- --------------------------------------------------------
-- AUTO_INCREMENT pour les tables
-- --------------------------------------------------------

ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `plannings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `trainings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `user_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `user_planning`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `planning_training`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------
-- Contraintes pour les tables
-- --------------------------------------------------------

-- Contraintes pour la table `trainings`
ALTER TABLE `trainings`
  ADD CONSTRAINT `trainings_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

-- Contraintes pour la table `user_role`
ALTER TABLE `user_role`
  ADD CONSTRAINT `user_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_role_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

-- Contraintes pour la table `user_planning`
ALTER TABLE `user_planning`
  ADD CONSTRAINT `user_planning_planning_id_foreign` FOREIGN KEY (`planning_id`) REFERENCES `plannings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_planning_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

-- Contraintes pour la table `planning_training`
ALTER TABLE `planning_training`
  ADD CONSTRAINT `planning_training_planning_id_foreign` FOREIGN KEY (`planning_id`) REFERENCES `plannings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `planning_training_training_id_foreign` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`id`) ON DELETE CASCADE;

-- --------------------------------------------------------
-- Données initiales
-- --------------------------------------------------------

-- Insertion des rôles de base
INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'adhérent', 'Membre du club', NOW(), NOW()),
(2, 'coach', 'Entraîneur du club', NOW(), NOW()),
(3, 'responsable', 'Responsable de section', NOW(), NOW()),
(4, 'admin', 'Administrateur du système', NOW(), NOW());

-- Insertion d'un utilisateur administrateur par défaut
INSERT INTO `users` (`id`, `name`, `email`, `password`, `email_verified_at`, `created_at`, `updated_at`) VALUES
(1, 'Administrateur', 'admin@lyonpalme.fr', '$2y$12$enps88.3yjfdtTqAfllJ0Ok1xqWCoY.JF.prDXySD0LBq6tndMYxW', NOW(), NOW(), NOW());

-- Attribution du rôle admin à l'utilisateur par défaut
INSERT INTO `user_role` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 4, NOW(), NOW());

-- Insertion d'un utilisateur test
INSERT INTO `users` (`id`, `name`, `email`, `password`, `email_verified_at`, `created_at`, `updated_at`) VALUES
(2, 'Test User', 'test@test.com', '$2y$12$enps88.3yjfdtTqAfllJ0Ok1xqWCoY.JF.prDXySD0LBq6tndMYxW', NOW(), NOW(), NOW());

-- Attribution du rôle adhérent à l'utilisateur test
INSERT INTO `user_role` (`user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(2, 1, NOW(), NOW());

COMMIT;

-- --------------------------------------------------------
-- Informations sur la base de données
-- --------------------------------------------------------
-- 
-- Base de données: Lyon Palme - Club de plongée sous-marine
-- Version: 2.0 (mise à jour novembre 2025)
-- 
-- Tables principales:
-- - users: Gestion des utilisateurs/adhérents avec authentification
-- - roles: Système de rôles (adhérent, coach, responsable, admin)
-- - plannings: Séances d'entraînement programmées
-- - trainings: Bibliothèque d'exercices et entraînements
-- - user_role: Relation many-to-many users <-> roles
-- - user_planning: Inscriptions des utilisateurs aux séances
-- - planning_training: Association plannings <-> exercices
-- 
-- Fonctionnalités supprimées:
-- - Materials (matériel) - supprimé le 24/11/2025
-- - Competitions (compétitions) - supprimé le 24/11/2025
-- 
-- Comptes par défaut:
-- - admin@lyonpalme.fr / password (Administrateur)
-- - test@test.com / password (Utilisateur test)
--

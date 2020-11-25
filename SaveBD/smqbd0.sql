-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : lun. 19 oct. 2020 à 01:05
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `smqbd`
--
CREATE DATABASE IF NOT EXISTS `smqbd` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `smqbd`;

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$..JwMnPViTfjBwbP8INWA.h7LPFYtPLiAceQNul4Vxq5pgl8aiTea', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `categorieslois`
--

DROP TABLE IF EXISTS `categorieslois`;
CREATE TABLE `categorieslois` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categorieslois` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorieslois`
--

INSERT INTO `categorieslois` (`id`, `categorieslois`, `created_at`, `updated_at`) VALUES
(1, 'Décret', '2020-10-17 10:57:24', '2020-10-17 10:57:24'),
(2, 'Conventions', '2020-10-17 10:57:39', '2020-10-17 10:57:39');

-- --------------------------------------------------------

--
-- Structure de la table `cotation`
--

DROP TABLE IF EXISTS `cotation`;
CREATE TABLE `cotation` (
  `IdCotation` int(10) UNSIGNED NOT NULL,
  `LibCotation` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ValeurCotation` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cotation`
--

INSERT INTO `cotation` (`IdCotation`, `LibCotation`, `ValeurCotation`, `created_at`, `updated_at`) VALUES
(1, 'Risque & opportunité maîtrisé', 10, '2020-10-18 21:06:38', '2020-10-18 21:06:38'),
(2, 'Risque & opportunité maîtrisé mais à suivre', 15, '2020-10-18 21:06:54', '2020-10-18 21:06:54'),
(3, 'Risque & opportunité critique - Pas de maîtrise à prendre en compte dans l\'analyse du risque', 16, '2020-10-18 21:07:04', '2020-10-18 21:07:04');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fonctions`
--

DROP TABLE IF EXISTS `fonctions`;
CREATE TABLE `fonctions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `LibFonction` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fonctions`
--

INSERT INTO `fonctions` (`id`, `LibFonction`, `created_at`, `updated_at`) VALUES
(1, 'Directeur Général', '2020-10-12 15:58:09', '2020-10-12 15:58:09'),
(2, 'Directeur Financier', '2020-10-12 15:58:22', '2020-10-12 15:58:22'),
(3, 'Directeur Production', '2020-10-12 15:58:35', '2020-10-12 15:58:35'),
(4, 'Directeur Technique', '2020-10-12 15:58:47', '2020-10-12 15:58:47'),
(5, 'Directeur Commercial', '2020-10-12 15:58:59', '2020-10-12 15:58:59'),
(6, 'Responsable ERD', '2020-10-12 15:59:11', '2020-10-12 15:59:11'),
(7, 'Responsable logistique', '2020-10-14 17:04:51', '2020-10-14 17:04:51'),
(8, 'Responsable maintenance', '2020-10-14 17:05:20', '2020-10-14 17:05:20'),
(9, 'Responsable de faction', '2020-10-14 17:05:34', '2020-10-14 17:05:34'),
(10, 'Responsable BDF', '2020-10-14 17:13:25', '2020-10-14 17:13:25'),
(11, 'Fonction3', '2020-10-17 10:39:09', '2020-10-17 10:39:09');

-- --------------------------------------------------------

--
-- Structure de la table `indicateurs`
--

DROP TABLE IF EXISTS `indicateurs`;
CREATE TABLE `indicateurs` (
  `IdIndicateur` int(10) NOT NULL,
  `IdProcessus` int(11) DEFAULT NULL,
  `LibIndicateur` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Periodicite` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DateDebutPeriode` datetime NOT NULL,
  `DebutPeriode` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FinPeriode` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Objectif` double NOT NULL,
  `Resultat` double NOT NULL,
  `Etat` tinyint(4) NOT NULL,
  `Observation` varchar(192) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `IdSousProcessus` int(11) DEFAULT NULL,
  `NumLigne` int(11) NOT NULL,
  `Archiver` tinyint(1) DEFAULT NULL,
  `id` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `indicateurs`
--

INSERT INTO `indicateurs` (`IdIndicateur`, `IdProcessus`, `LibIndicateur`, `Periodicite`, `DateDebutPeriode`, `DebutPeriode`, `FinPeriode`, `Objectif`, `Resultat`, `Etat`, `Observation`, `created_at`, `updated_at`, `IdSousProcessus`, `NumLigne`, `Archiver`, `id`) VALUES
(1, NULL, 'Taux de respect Délais clients', 'M', '2020-10-12 00:00:00', 'Octobre 2020', 'Novembre 2020', 5, 1, 1, 'xcvbnnvb', '2020-10-12 16:58:52', '2020-10-18 01:42:46', 1, 1, 0, 5),
(2, 4, 'Approvisionner & stocker MP / Planifier et lancer la Production', 'M', '2020-10-12 00:00:00', 'Octobre 2020', 'Novembre 2020', 3, 0, 1, NULL, '2020-10-12 17:17:43', '2020-10-18 00:29:47', NULL, 1, 0, 6),
(3, 3, 'Approvisionner & stocker MP / Planifier et lancer la Production', 'S', '2020-10-14 00:00:00', 'Octobre 2020', 'Novembre 2020', 3, 0, 1, NULL, '2020-10-14 10:46:03', '2020-10-18 00:29:57', NULL, 1, 0, 7),
(4, 6, 'Sauvegarde des bases', 'M', '2020-10-17 00:00:00', 'Octobre 2020', 'Novembre 2020', 3, 0, 1, NULL, '2020-10-17 10:46:34', '2020-10-18 00:30:24', NULL, 1, 0, 8),
(5, NULL, 'Indicateur 111', 'T', '2020-10-18 00:00:00', 'Octobre 2020', 'Novembre 2020', 6, 0, 0, '', '2020-10-18 01:05:08', '2020-10-18 01:06:33', 4, 1, 0, 9),
(1, NULL, 'Taux de respect Délais clients', 'M', '2020-10-12 00:00:00', 'Octobre 2020', 'Novembre 2020', 5, 0, 0, '', '2020-10-18 01:56:44', '2020-10-18 01:56:44', 1, 2, 0, 10),
(6, 1, 'Indicateur 2', 'S', '2020-10-18 00:00:00', 'Octobre 2020', 'Novembre 2020', 3, 0, 0, '', '2020-10-18 02:11:23', '2020-10-18 02:11:23', NULL, 1, 0, 11);

-- --------------------------------------------------------

--
-- Structure de la table `lois`
--

DROP TABLE IF EXISTS `lois`;
CREATE TABLE `lois` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `IdCategoriesLois` int(11) NOT NULL,
  `LibLois` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DatePromulgation` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `lois`
--

INSERT INTO `lois` (`id`, `IdCategoriesLois`, `LibLois`, `DatePromulgation`, `created_at`, `updated_at`) VALUES
(1, 1, 'Lois n° 2020/03-26', '2020-10-17 00:00:00', '2020-10-17 10:58:14', '2020-10-17 10:58:14');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_08_19_173145_create_postetable', 1),
(2, '2014_10_12_000000_create_users_table', 2),
(3, '2014_10_12_100000_create_password_resets_table', 2),
(4, '2019_08_19_000000_create_failed_jobs_table', 2),
(5, '2020_09_22_220232_create_categorieslois_table', 2),
(6, '2020_09_24_143137_create_lois_table', 2),
(7, '2020_09_26_124626_create_admins_table', 2),
(8, '2020_10_03_104025_create_typesprocessus_table', 2),
(9, '2020_10_03_130917_create_processus_table', 2),
(22, '2020_10_08_012233_alter_users_table', 6),
(23, '2020_10_11_122019_alter_processus_table', 7),
(12, '2020_10_11_134517_create_fonctions_table', 2),
(13, '2020_10_11_193030_create_indicateurs_table', 2),
(15, '2020_10_13_093121_create_planactions_table', 3),
(18, '2020_10_13_104802_create_typemoyen_table', 4),
(21, '2020_10_13_102808_create_taches_table', 5),
(24, '2020_10_14_173031_create_sousprocessus_table', 8),
(29, '2020_10_16_154943_alter_indicateurs_table', 9),
(31, '2020_10_18_143206_create_niveauimportance_table', 10),
(32, '2020_10_18_154006_create_niveaurelation_table', 11),
(51, '2020_10_18_161415_create_cotation_table', 12),
(54, '2020_10_18_173836_create_partiesinteressees_table', 13);

-- --------------------------------------------------------

--
-- Structure de la table `niveauimportance`
--

DROP TABLE IF EXISTS `niveauimportance`;
CREATE TABLE `niveauimportance` (
  `IdNivImportance` int(10) UNSIGNED NOT NULL,
  `LibNivImportance` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ValeurNivImportance` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `niveauimportance`
--

INSERT INTO `niveauimportance` (`IdNivImportance`, `LibNivImportance`, `ValeurNivImportance`, `created_at`, `updated_at`) VALUES
(1, 'SONACO n\'a pas d\'impact sur la partie intéressée, ou celle-ci n\'a pas d\'influences sur elle.', 1, '2020-10-18 15:15:15', '2020-10-18 15:28:03'),
(2, 'SONACO a des impacts négligeables sur la partie intéressée, ou celle-ci ne pourrait remettre en cause que marginalement ses projets.', 2, '2020-10-18 15:29:28', '2020-10-18 15:29:28'),
(3, 'SONACO a des impacts significatifs sur la partie intéressée, ou celle-ci pourrait remettre en cause la réussite de certains projets, à la réalisation desquels elle est utile..', 3, '2020-10-18 15:29:54', '2020-10-18 15:29:54'),
(4, 'SONACO a des impacts importants sur la partie intéressée, ou celle-ci pourrait remettre en cause la réussite de certains projets majeurs, pour lesquels elle est', 4, '2020-10-18 15:30:18', '2020-10-18 15:30:18'),
(5, 'SONACO a des impacts négligeables sur la partie intéressée, ou celle-ci ne pourrait remettre en cause que marginalement ses projets.', 5, '2020-10-18 15:30:39', '2020-10-18 15:30:39');

-- --------------------------------------------------------

--
-- Structure de la table `niveaurelation`
--

DROP TABLE IF EXISTS `niveaurelation`;
CREATE TABLE `niveaurelation` (
  `IdNivRelation` int(10) UNSIGNED NOT NULL,
  `LibNivRelation` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ValeurNivRelation` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `niveaurelation`
--

INSERT INTO `niveaurelation` (`IdNivRelation`, `LibNivRelation`, `ValeurNivRelation`, `created_at`, `updated_at`) VALUES
(1, 'SONACO a une excellente relation avec la partie intéressé, et elle procède à une évaluation continue,  de ses impacts sur elle et des intérêts de celle-ci. Le dialogue est', 1, '2020-10-18 16:04:29', '2020-10-18 16:04:29'),
(2, 'SONACO a une bonne relation avec la partie intéressé, et elle a une connaissance documentée (note, études, enquêtes, etc., ...) de ses impacts sur elle et des intérêts', 2, '2020-10-18 16:04:56', '2020-10-18 16:04:56'),
(3, 'SONACO a une relation régulière avec la partie intéressé, et elle a identifié ses principaux impacts sur elle et les principaux  intérêts de celle-ci (ou des organisations', 3, '2020-10-18 16:05:20', '2020-10-18 16:05:20'),
(4, 'SONACO a peu de relation avec la partie intéressée, et elle n\'a qu\'une connaissance partielle de ses impacts sur elle et des intérêts de celle-ci.', 4, '2020-10-18 16:06:12', '2020-10-18 16:06:12'),
(5, 'SONACO n\'a pas de relation avec la partie intéressée, et elle n\'a aucune connaissance de ses impacts sur elle et ni des intérêts de celle-ci.', 5, '2020-10-18 16:06:32', '2020-10-18 16:06:32');

-- --------------------------------------------------------

--
-- Structure de la table `partiesinteressees`
--

DROP TABLE IF EXISTS `partiesinteressees`;
CREATE TABLE `partiesinteressees` (
  `IdPartiesInt` int(10) UNSIGNED NOT NULL,
  `IdProcessus` int(11) NOT NULL,
  `IdNivImportance` int(11) NOT NULL,
  `IdNivRelation` int(11) NOT NULL,
  `IdCotation` int(11) NOT NULL,
  `LibPartiesInt` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Contexte` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Attentes` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Risques` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Opportunites` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DateRevision` datetime NOT NULL,
  `Archiver` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `partiesinteressees`
--

INSERT INTO `partiesinteressees` (`IdPartiesInt`, `IdProcessus`, `IdNivImportance`, `IdNivRelation`, `IdCotation`, `LibPartiesInt`, `Contexte`, `Attentes`, `Risques`, `Opportunites`, `DateRevision`, `Archiver`, `created_at`, `updated_at`) VALUES
(4, 1, 4, 1, 2, 'Fournisseurs de Services', 'externe', 'Remontée des informations par rapport à la qualité du service', '\'Défaut de collecte des données', '\'Amélioration de la qualité des services', '2020-10-18 00:00:00', 0, '2020-10-18 22:20:02', '2020-10-18 22:20:02'),
(5, 4, 2, 2, 1, 'Fournisseurs de Services', 'externe', 'Remontée des informations par rapport à la qualité du service', '\'Défaut de collecte des données', '\'Amélioration de la qualité des services', '2020-10-18 00:00:00', 0, '2020-10-18 22:21:28', '2020-10-18 22:21:28'),
(6, 4, 1, 3, 3, 'Fournisseurs de Services', 'externe', 'Remontée des informations par rapport à la qualité du service', '\'Défaut de collecte des données', '\'Amélioration de la qualité des services', '2020-10-18 00:00:00', 0, '2020-10-18 22:21:53', '2020-10-18 22:21:53');

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `planactions`
--

DROP TABLE IF EXISTS `planactions`;
CREATE TABLE `planactions` (
  `IdPlanaction` int(10) UNSIGNED NOT NULL,
  `CodePlanaction` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IdProcessus` int(11) NOT NULL,
  `LibPlanaction` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `planactions`
--

INSERT INTO `planactions` (`IdPlanaction`, `CodePlanaction`, `IdProcessus`, `LibPlanaction`, `created_at`, `updated_at`) VALUES
(1, '2009-001', 4, 'Plan d\'action n° 1', '2020-10-13 10:23:14', '2020-10-13 10:25:50'),
(2, '2009-002', 4, 'Plan d\'action n° 2', '2020-10-13 10:23:36', '2020-10-13 10:26:01'),
(3, '001-326140', 6, 'Plan d\'action 10', '2020-10-17 10:47:41', '2020-10-17 10:47:41');

-- --------------------------------------------------------

--
-- Structure de la table `postetable`
--

DROP TABLE IF EXISTS `postetable`;
CREATE TABLE `postetable` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `processus`
--

DROP TABLE IF EXISTS `processus`;
CREATE TABLE `processus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `IdTypeProcessus` int(11) NOT NULL,
  `LibProcessus` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ChampApplication` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `IdPilote` int(11) DEFAULT NULL,
  `IdSousPilote` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `processus`
--

INSERT INTO `processus` (`id`, `IdTypeProcessus`, `LibProcessus`, `ChampApplication`, `created_at`, `updated_at`, `IdPilote`, `IdSousPilote`) VALUES
(1, 1, 'PM(DGE)MAG1', 'Piloter le système de management de la qualité', '2020-10-12 16:50:07', '2020-10-12 16:50:07', 1, NULL),
(2, 1, 'PM(DGE)MAG2', 'Améliorer le système de management de la qualité', '2020-10-12 16:50:48', '2020-10-12 16:50:48', 1, NULL),
(3, 2, 'PR(DCO)OFC1', 'Être à l\'écoute des clients / Traiter les offres et les commandes', '2020-10-12 16:51:46', '2020-10-12 16:51:46', 2, NULL),
(4, 2, 'PR(DPR)EMB', 'PRODUCTION', '2020-10-12 16:53:22', '2020-10-16 15:40:03', 3, NULL),
(5, 2, 'PR(DPR)EMB4', 'Stocker et livrer les produits finis (emballages, plaques, SF)', '2020-10-14 17:27:02', '2020-10-14 17:27:02', NULL, 4),
(6, 3, 'Processus 1111', 'Piloter le système d\'Information', '2020-10-17 10:42:15', '2020-10-17 10:42:15', 8, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `sousprocessus`
--

DROP TABLE IF EXISTS `sousprocessus`;
CREATE TABLE `sousprocessus` (
  `IdSousProcessus` int(10) UNSIGNED NOT NULL,
  `IdProcessus` int(11) NOT NULL,
  `CodeSousProcessus` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LibSousProcessus` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IdSousPilote` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sousprocessus`
--

INSERT INTO `sousprocessus` (`IdSousProcessus`, `IdProcessus`, `CodeSousProcessus`, `LibSousProcessus`, `IdSousPilote`, `created_at`, `updated_at`) VALUES
(1, 4, 'PR(DPR)EMB1', 'Approvisionner & stocker MP / Planifier et lancer la Production', 7, '2020-10-16 15:41:36', '2020-10-16 15:41:36'),
(2, 4, 'PR(DPR)EMB1', 'Gestion des papiers', 7, '2020-10-16 15:42:14', '2020-10-16 15:42:14'),
(3, 4, 'PR(DPR)EMB2', 'Réaliser la production des plaques et simples faces', 5, '2020-10-16 15:42:45', '2020-10-16 15:42:45'),
(4, 4, 'PR(DPR)EMB3', 'Réaliser la production des emballages', 6, '2020-10-16 15:43:09', '2020-10-16 15:43:09'),
(5, 4, 'PR(DPR)EMB4', 'Stocker et livrer les produits finis (emballages, plaques, SF)', 4, '2020-10-16 15:43:46', '2020-10-16 15:43:46'),
(7, 6, 'Administrateur Réseau', 'Sous processus 1llkopiopipo', 7, '2020-10-17 10:43:31', '2020-10-17 10:43:31');

-- --------------------------------------------------------

--
-- Structure de la table `taches`
--

DROP TABLE IF EXISTS `taches`;
CREATE TABLE `taches` (
  `IdTaches` int(10) UNSIGNED NOT NULL,
  `IdPlanaction` int(11) NOT NULL,
  `LibTaches` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IdIntervenant` int(11) NOT NULL,
  `IdTypeMoyen` int(11) NOT NULL,
  `DateDebut` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DateFin` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Etat` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `taches`
--

INSERT INTO `taches` (`IdTaches`, `IdPlanaction`, `LibTaches`, `IdIntervenant`, `IdTypeMoyen`, `DateDebut`, `DateFin`, `Etat`, `created_at`, `updated_at`) VALUES
(1, 2, 'Tâche n° 1fg hfghfgh', 1, 5, '2020-10-20', '2020-10-24', 0, '2020-10-13 14:37:13', '2020-10-13 14:49:39'),
(2, 2, 'Tâche n° 2', 2, 4, '2020-10-27', '2020-10-30', 0, '2020-10-13 14:37:48', '2020-10-13 14:50:04'),
(3, 1, 'Installer un ordinateur à la salle d\'accueil', 5, 4, '2020-10-17', '2020-10-26', 0, '2020-10-17 10:51:52', '2020-10-17 10:51:52');

-- --------------------------------------------------------

--
-- Structure de la table `typemoyen`
--

DROP TABLE IF EXISTS `typemoyen`;
CREATE TABLE `typemoyen` (
  `IdTypeMoyen` int(10) UNSIGNED NOT NULL,
  `LibTypeMoyen` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `typemoyen`
--

INSERT INTO `typemoyen` (`IdTypeMoyen`, `LibTypeMoyen`, `created_at`, `updated_at`) VALUES
(1, 'Milieu', '2020-10-13 11:09:39', '2020-10-13 11:10:57'),
(2, 'Méthode', '2020-10-13 11:09:48', '2020-10-13 11:11:10'),
(4, 'Matériels', '2020-10-13 11:10:03', '2020-10-13 11:11:26'),
(5, 'Matières', '2020-10-13 11:11:53', '2020-10-13 11:11:53'),
(6, 'Main d’œuvres', '2020-10-13 11:13:46', '2020-10-13 11:14:01');

-- --------------------------------------------------------

--
-- Structure de la table `typesprocessus`
--

DROP TABLE IF EXISTS `typesprocessus`;
CREATE TABLE `typesprocessus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `LibTypesProcessus` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `typesprocessus`
--

INSERT INTO `typesprocessus` (`id`, `LibTypesProcessus`, `created_at`, `updated_at`) VALUES
(1, 'Management', '2020-10-12 16:08:50', '2020-10-12 16:08:50'),
(2, 'Réalisation', '2020-10-12 16:09:00', '2020-10-12 16:09:00'),
(3, 'Support', '2020-10-12 16:09:10', '2020-10-12 16:09:10');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pilote` tinyint(1) DEFAULT NULL,
  `Idfonction` int(192) DEFAULT NULL,
  `SousPilote` tinyint(1) DEFAULT NULL,
  `Auditeur` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `pilote`, `Idfonction`, `SousPilote`, `Auditeur`) VALUES
(1, 'fniamke', 'fniamke@yahoo.com', NULL, '$2y$10$NR7OihXhQiQBGnnuCOcZguOHpkewjiPQUss6.AdR1snOMyXC8CqAG', NULL, '2020-10-12 15:54:52', '2020-10-12 16:00:03', 1, 1, NULL, NULL),
(2, 'Cisco', 'cisco@yahoo.fr', NULL, '$2y$10$t6oNyIoSHT1NowfN/evnVekQCsHvs4MXZPu4BsVv4kpU8mou4HwqG', NULL, '2020-10-12 16:46:02', '2020-10-13 09:15:22', 1, 2, NULL, NULL),
(3, 'Yves CHAMPEVAL', 'francis@yahoo.fr', NULL, '$2y$10$frrCkwHGyi0cevrJkReuZeKNDY67P5Ob06sTsXB13QSfhgELEvnDG', NULL, '2020-10-12 16:48:14', '2020-10-14 16:42:33', 1, 3, NULL, NULL),
(4, 'Victor VANIE', 'vannie@yahoo.fr', NULL, '$2y$10$73px3eK.MpAkOGzaxr7gKeAk.9cMGZawIUKc83aqhEsrMRuW4N3jy', NULL, '2020-10-14 17:03:00', '2020-10-14 17:09:56', NULL, 7, 1, NULL),
(5, 'Emmanuel AKE', 'EAKE@yahoo.fr', NULL, '$2y$10$rkxlHiky2GsG0ua5xIwMk.7dZwkQDgW7a6ntn6AtwolcjAQ.j7cgq', NULL, '2020-10-14 17:11:11', '2020-10-14 17:11:11', NULL, 9, 1, NULL),
(6, 'Georges KOUADIANE', 'GKOUADIANE@yahoo.fr', NULL, '$2y$10$px3TEMugjbrTaasd4qYd6uCKTsiBOagYjW9LEwzSU16vCzYALcRHS', NULL, '2020-10-14 17:12:07', '2020-10-14 17:12:07', NULL, 9, 1, NULL),
(7, 'Jean Jacques KONE', 'JJKONE@yahoo.fr', NULL, '$2y$10$5b6d9LIaM5O.k9bqCqArM.y8x5MQITukq0rmUBaTPpWv0/sfX0.UC', NULL, '2020-10-14 17:12:59', '2020-10-14 17:13:58', NULL, 10, 1, NULL),
(8, 'utilisateur11', 'utilisateur11@yahoo.com', NULL, '$2y$10$FgG4SUUeFz8ORK/i9JHMRegdydihiP0OCDNgPwOPvn9R9u45bjRKq', NULL, '2020-10-17 10:37:01', '2020-10-17 10:37:31', 1, 10, 1, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Index pour la table `categorieslois`
--
ALTER TABLE `categorieslois`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cotation`
--
ALTER TABLE `cotation`
  ADD PRIMARY KEY (`IdCotation`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `fonctions`
--
ALTER TABLE `fonctions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `indicateurs`
--
ALTER TABLE `indicateurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lois`
--
ALTER TABLE `lois`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `niveauimportance`
--
ALTER TABLE `niveauimportance`
  ADD PRIMARY KEY (`IdNivImportance`);

--
-- Index pour la table `niveaurelation`
--
ALTER TABLE `niveaurelation`
  ADD PRIMARY KEY (`IdNivRelation`);

--
-- Index pour la table `partiesinteressees`
--
ALTER TABLE `partiesinteressees`
  ADD PRIMARY KEY (`IdPartiesInt`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `planactions`
--
ALTER TABLE `planactions`
  ADD PRIMARY KEY (`IdPlanaction`),
  ADD UNIQUE KEY `planactions_codeplanaction_unique` (`CodePlanaction`);

--
-- Index pour la table `postetable`
--
ALTER TABLE `postetable`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `processus`
--
ALTER TABLE `processus`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sousprocessus`
--
ALTER TABLE `sousprocessus`
  ADD PRIMARY KEY (`IdSousProcessus`);

--
-- Index pour la table `taches`
--
ALTER TABLE `taches`
  ADD PRIMARY KEY (`IdTaches`);

--
-- Index pour la table `typemoyen`
--
ALTER TABLE `typemoyen`
  ADD PRIMARY KEY (`IdTypeMoyen`);

--
-- Index pour la table `typesprocessus`
--
ALTER TABLE `typesprocessus`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `categorieslois`
--
ALTER TABLE `categorieslois`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `cotation`
--
ALTER TABLE `cotation`
  MODIFY `IdCotation` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fonctions`
--
ALTER TABLE `fonctions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `indicateurs`
--
ALTER TABLE `indicateurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `lois`
--
ALTER TABLE `lois`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `niveauimportance`
--
ALTER TABLE `niveauimportance`
  MODIFY `IdNivImportance` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `niveaurelation`
--
ALTER TABLE `niveaurelation`
  MODIFY `IdNivRelation` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `partiesinteressees`
--
ALTER TABLE `partiesinteressees`
  MODIFY `IdPartiesInt` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `planactions`
--
ALTER TABLE `planactions`
  MODIFY `IdPlanaction` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `postetable`
--
ALTER TABLE `postetable`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `processus`
--
ALTER TABLE `processus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `sousprocessus`
--
ALTER TABLE `sousprocessus`
  MODIFY `IdSousProcessus` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `taches`
--
ALTER TABLE `taches`
  MODIFY `IdTaches` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `typemoyen`
--
ALTER TABLE `typemoyen`
  MODIFY `IdTypeMoyen` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `typesprocessus`
--
ALTER TABLE `typesprocessus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

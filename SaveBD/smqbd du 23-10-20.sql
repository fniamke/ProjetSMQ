-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 23 oct. 2020 à 18:04
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `smqbd`
--

DELIMITER $$
--
-- Procédures
--
DROP PROCEDURE IF EXISTS `IndicateursParProcessus`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `IndicateursParProcessus` ()  NO SQL
Select processus.id, LibProcessus, ChampApplication, name, Count(Indicateurs.IdIndicateur) as NbreIndicateurs, Count(planactions.IdPlanAction) as NbrePA, Count(taches.IdPlanAction) as NbreTaches

FROM ((processus LEFT JOIN indicateurs ON processus.id = indicateurs.IdProcessus) LEFT JOIN (planactions  LEFT JOIN taches ON planactions.IdPlanaction= taches.IdPlanaction) ON processus.id= planactions.IdProcessus) LEFT JOIN users ON processus.IdPilote= users.id

Group by processus.id, LibProcessus, ChampApplication, name$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$..JwMnPViTfjBwbP8INWA.h7LPFYtPLiAceQNul4Vxq5pgl8aiTea', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `analyserisques`
--

DROP TABLE IF EXISTS `analyserisques`;
CREATE TABLE IF NOT EXISTS `analyserisques` (
  `IdAnalyserisques` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IdProcessus` int(11) NOT NULL,
  `IdGravite` int(11) NOT NULL,
  `IdProbabilite` int(11) NOT NULL,
  `IdDetection` int(11) NOT NULL,
  `IdCriticite` int(11) NOT NULL,
  `LibRisqueOpportunite` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Nature` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Effets` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Causes` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DescriptionMA` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `EvaluationMA` double NOT NULL,
  `EvaluationRR` double NOT NULL,
  `DateRevision` datetime NOT NULL,
  `Archiver` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IdAnalyserisques`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categorieslois`
--

DROP TABLE IF EXISTS `categorieslois`;
CREATE TABLE IF NOT EXISTS `categorieslois` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `categorieslois` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
CREATE TABLE IF NOT EXISTS `cotation` (
  `IdCotation` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `LibCotation` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ValeurCotation` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IdCotation`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cotation`
--

INSERT INTO `cotation` (`IdCotation`, `LibCotation`, `ValeurCotation`, `created_at`, `updated_at`) VALUES
(1, 'Risque & opportunité maîtrisé', 10, '2020-10-18 21:06:38', '2020-10-18 21:06:38'),
(2, 'Risque & opportunité maîtrisé mais à suivre', 15, '2020-10-18 21:06:54', '2020-10-18 21:06:54'),
(3, 'Risque & opportunité critique - Pas de maîtrise à prendre en compte dans l\'analyse du risque', 16, '2020-10-18 21:07:04', '2020-10-18 21:07:04');

-- --------------------------------------------------------

--
-- Structure de la table `criticite`
--

DROP TABLE IF EXISTS `criticite`;
CREATE TABLE IF NOT EXISTS `criticite` (
  `IdCriticite` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Criticite` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NoteCriticite` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IdCriticite`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `criticite`
--

INSERT INTO `criticite` (`IdCriticite`, `Criticite`, `NoteCriticite`, `created_at`, `updated_at`) VALUES
(1, 'Aucune', 5, '2020-10-20 17:32:20', '2020-10-20 17:32:20'),
(2, 'A suivre', 20, '2020-10-20 17:32:38', '2020-10-20 17:32:38'),
(3, 'Critique - A prendre en compte', 21, '2020-10-20 17:32:59', '2020-10-20 17:32:59');

-- --------------------------------------------------------

--
-- Structure de la table `detection`
--

DROP TABLE IF EXISTS `detection`;
CREATE TABLE IF NOT EXISTS `detection` (
  `IdDetection` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Detection` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NoteDetection` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IdDetection`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `detection`
--

INSERT INTO `detection` (`IdDetection`, `Detection`, `NoteDetection`, `created_at`, `updated_at`) VALUES
(1, 'Facilement détectable', 1, '2020-10-19 17:42:24', '2020-10-19 17:42:24'),
(2, 'Détectable par observation', 2, '2020-10-19 17:42:38', '2020-10-19 17:42:38'),
(3, 'Détectable par instrument', 3, '2020-10-19 17:42:52', '2020-10-19 17:42:52'),
(4, 'Aucune détection possible', 4, '2020-10-19 17:43:09', '2020-10-19 17:43:09');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fonctions`
--

DROP TABLE IF EXISTS `fonctions`;
CREATE TABLE IF NOT EXISTS `fonctions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `LibFonction` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(11, 'Fonction3', '2020-10-17 10:39:09', '2020-10-17 10:39:09'),
(12, 'Fonction 1', '2020-10-21 11:01:19', '2020-10-21 11:01:19'),
(13, 'Fonction 1', '2020-10-21 11:04:14', '2020-10-21 11:04:14'),
(14, 'Fonction 1', '2020-10-21 11:05:28', '2020-10-21 11:05:28'),
(15, 'Fonction 3', '2020-10-21 11:06:30', '2020-10-21 11:06:30');

-- --------------------------------------------------------

--
-- Structure de la table `gravite`
--

DROP TABLE IF EXISTS `gravite`;
CREATE TABLE IF NOT EXISTS `gravite` (
  `IdGravite` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Gravite` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DefinitionGravite` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NoteGravite` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IdGravite`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `gravite`
--

INSERT INTO `gravite` (`IdGravite`, `Gravite`, `DefinitionGravite`, `NoteGravite`, `created_at`, `updated_at`) VALUES
(1, 'Mineure', 'Conséquence très limitée', 1, '2020-10-19 17:11:09', '2020-10-19 17:11:09'),
(2, 'Significative', 'Dommage visible', 2, '2020-10-19 17:11:33', '2020-10-19 17:11:33'),
(3, 'Grave', 'Dommage important', 3, '2020-10-19 17:12:03', '2020-10-19 17:12:03'),
(4, 'Critique', 'Dommage irréversible', 4, '2020-10-19 17:12:31', '2020-10-19 17:12:31');

-- --------------------------------------------------------

--
-- Structure de la table `indicateurs`
--

DROP TABLE IF EXISTS `indicateurs`;
CREATE TABLE IF NOT EXISTS `indicateurs` (
  `IdIndicateur` int(10) NOT NULL,
  `IdProcessus` int(11) DEFAULT NULL,
  `LibIndicateur` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Periodicite` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `DateDebutPeriode` datetime NOT NULL,
  `DebutPeriode` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `FinPeriode` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Objectif` double NOT NULL,
  `Resultat` double NOT NULL,
  `Etat` tinyint(4) NOT NULL,
  `Observation` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `IdSousProcessus` int(11) DEFAULT NULL,
  `NumLigne` int(11) NOT NULL,
  `Archiver` tinyint(1) DEFAULT NULL,
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IdSociete` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `indicateurs`
--

INSERT INTO `indicateurs` (`IdIndicateur`, `IdProcessus`, `LibIndicateur`, `Periodicite`, `DateDebutPeriode`, `DebutPeriode`, `FinPeriode`, `Objectif`, `Resultat`, `Etat`, `Observation`, `created_at`, `updated_at`, `IdSousProcessus`, `NumLigne`, `Archiver`, `id`, `IdSociete`) VALUES
(1, NULL, 'Taux de respect Délais clients', 'M', '2020-10-12 00:00:00', 'Octobre 2020', 'Novembre 2020', 5, 1, 1, 'xcvbnnvb', '2020-10-12 16:58:52', '2020-10-18 01:42:46', 1, 1, 1, 5, 1),
(2, 4, 'Approvisionner & stocker MP / Planifier et lancer la Production', 'M', '2020-10-12 00:00:00', 'Octobre 2020', 'Novembre 2020', 3, 0, 1, NULL, '2020-10-12 17:17:43', '2020-10-18 00:29:47', NULL, 1, 0, 6, 1),
(3, 3, 'Approvisionner & stocker MP / Planifier et lancer la Production', 'S', '2020-10-14 00:00:00', 'Octobre 2020', 'Novembre 2020', 3, 0, 1, NULL, '2020-10-14 10:46:03', '2020-10-18 00:29:57', NULL, 1, 0, 7, 1),
(4, 6, 'Sauvegarde des bases', 'M', '2020-10-17 00:00:00', 'Octobre 2020', 'Novembre 2020', 3, 0, 1, NULL, '2020-10-17 10:46:34', '2020-10-18 00:30:24', NULL, 1, 0, 8, 1),
(5, NULL, 'Indicateur 111', 'T', '2020-10-18 00:00:00', 'Octobre 2020', 'Novembre 2020', 6, 0, 0, '', '2020-10-18 01:05:08', '2020-10-23 17:24:43', 4, 1, 0, 9, 1),
(1, NULL, 'Taux de respect Délais clients', 'M', '2020-10-12 00:00:00', 'Octobre 2020', 'Novembre 2020', 5, 6, 1, 'q srfsqetrfzetzer tersd ter te gtedfg esdt zesfd', '2020-10-18 01:56:44', '2020-10-23 17:56:45', 1, 2, 1, 10, 1),
(6, 1, 'Indicateur 2', 'S', '2020-10-18 00:00:00', 'Octobre 2020', 'Novembre 2020', 3, 0, 0, '', '2020-10-18 02:11:23', '2020-10-23 17:25:41', NULL, 1, 0, 11, 1),
(7, 6, 'Indicateur 16666', 'S', '2020-10-25 00:00:00', 'Octobre0 2020', 'Novembre 02020', 69, 0, 0, '', '2020-10-23 17:40:32', '2020-10-23 17:42:59', 4, 1, 0, 12, 1),
(1, NULL, 'Taux de respect Délais clients', 'M', '2020-10-12 00:00:00', 'Octobre 2020', 'Novembre 2020', 5, 0, 0, '', '2020-10-23 17:57:23', '2020-10-23 17:57:23', 1, 3, 0, 13, NULL),
(1, NULL, 'Taux de respect Délais clients', 'M', '2020-10-12 00:00:00', 'Octobre 2020', 'Novembre 2020', 5, 0, 0, '', '2020-10-23 17:58:41', '2020-10-23 17:58:41', 1, 4, 0, 14, NULL),
(1, NULL, 'Taux de respect Délais clients', 'M', '2020-10-12 00:00:00', 'Octobre 2020', 'Novembre 2020', 5, 0, 0, '', '2020-10-23 18:00:47', '2020-10-23 18:00:47', 1, 5, 0, 15, NULL),
(1, NULL, 'Taux de respect Délais clients', 'M', '2020-10-12 00:00:00', 'Octobre 2020', 'Novembre 2020', 5, 0, 0, '', '2020-10-23 18:01:20', '2020-10-23 18:01:20', 1, 6, 0, 16, NULL),
(1, NULL, 'Taux de respect Délais clients', 'M', '2020-10-12 00:00:00', 'Octobre 2020', 'Novembre 2020', 5, 0, 0, '', '2020-10-23 18:02:04', '2020-10-23 18:02:04', 1, 7, 0, 17, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `lois`
--

DROP TABLE IF EXISTS `lois`;
CREATE TABLE IF NOT EXISTS `lois` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IdCategoriesLois` int(11) NOT NULL,
  `LibLois` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `DatePromulgation` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `lois`
--

INSERT INTO `lois` (`id`, `IdCategoriesLois`, `LibLois`, `DatePromulgation`, `created_at`, `updated_at`) VALUES
(1, 1, 'Lois n° 2020/03-26', '2020-10-17 00:00:00', '2020-10-17 10:58:14', '2020-10-17 10:58:14');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `from_id` int(10) UNSIGNED NOT NULL,
  `to_id` int(10) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `from` (`from_id`),
  KEY `to` (`to_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(69, '2020_10_08_012233_alter_users_table', 23),
(68, '2020_10_11_122019_alter_processus_table', 22),
(12, '2020_10_11_134517_create_fonctions_table', 2),
(13, '2020_10_11_193030_create_indicateurs_table', 2),
(15, '2020_10_13_093121_create_planactions_table', 3),
(18, '2020_10_13_104802_create_typemoyen_table', 4),
(21, '2020_10_13_102808_create_taches_table', 5),
(24, '2020_10_14_173031_create_sousprocessus_table', 8),
(71, '2020_10_16_154943_alter_indicateurs_table', 25),
(31, '2020_10_18_143206_create_niveauimportance_table', 10),
(32, '2020_10_18_154006_create_niveaurelation_table', 11),
(51, '2020_10_18_161415_create_cotation_table', 12),
(54, '2020_10_18_173836_create_partiesinteressees_table', 13),
(55, '2020_10_19_155523_create_probabilite_table', 14),
(56, '2020_10_19_165027_create_gravite_table', 15),
(58, '2020_10_19_171432_create_detection_table', 16),
(59, '2020_10_20_171221_create_criticite_table', 17),
(60, '2020_10_20_173711_create_analyserisques_table', 18),
(62, '2020_10_21_103900_create_mouchard_table', 19),
(63, '2020_10_21_114054_create_messages_table', 20),
(70, '2020_10_23_164416_alter_sousprocessus_table', 24),
(67, '2020_10_23_083847_create_societe_table', 21);

-- --------------------------------------------------------

--
-- Structure de la table `mouchard`
--

DROP TABLE IF EXISTS `mouchard`;
CREATE TABLE IF NOT EXISTS `mouchard` (
  `NumId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `DateEvmt` datetime NOT NULL,
  `NomEmploye` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TypeAction` int(11) NOT NULL,
  `Action` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ValAncienne` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ValNouveau` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Poste` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`NumId`)
) ENGINE=MyISAM AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mouchard`
--

-- --------------------------------------------------------

--
-- Structure de la table `niveauimportance`
--

DROP TABLE IF EXISTS `niveauimportance`;
CREATE TABLE IF NOT EXISTS `niveauimportance` (
  `IdNivImportance` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `LibNivImportance` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ValeurNivImportance` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IdNivImportance`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
CREATE TABLE IF NOT EXISTS `niveaurelation` (
  `IdNivRelation` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `LibNivRelation` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ValeurNivRelation` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IdNivRelation`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
CREATE TABLE IF NOT EXISTS `partiesinteressees` (
  `IdPartiesInt` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IdProcessus` int(11) NOT NULL,
  `IdNivImportance` int(11) NOT NULL,
  `IdNivRelation` int(11) NOT NULL,
  `IdCotation` int(11) NOT NULL,
  `LibPartiesInt` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Contexte` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Attentes` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Risques` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Opportunites` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `DateRevision` datetime NOT NULL,
  `Archiver` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IdPartiesInt`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `planactions`
--

DROP TABLE IF EXISTS `planactions`;
CREATE TABLE IF NOT EXISTS `planactions` (
  `IdPlanaction` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `CodePlanaction` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `IdProcessus` int(11) NOT NULL,
  `LibPlanaction` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IdPlanaction`),
  UNIQUE KEY `planactions_codeplanaction_unique` (`CodePlanaction`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
CREATE TABLE IF NOT EXISTS `postetable` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `probabilite`
--

DROP TABLE IF EXISTS `probabilite`;
CREATE TABLE IF NOT EXISTS `probabilite` (
  `IdProbabilite` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Probabilite` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DefinitionProbabilite` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NoteProbabilite` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IdProbabilite`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `probabilite`
--

INSERT INTO `probabilite` (`IdProbabilite`, `Probabilite`, `DefinitionProbabilite`, `NoteProbabilite`, `created_at`, `updated_at`) VALUES
(1, 'Très rare', '1 fois tous les 5 ans', 1, '2020-10-19 16:28:12', '2020-10-19 16:28:12'),
(2, 'Rare', '1 fois tous les 1 an', 2, '2020-10-19 16:28:35', '2020-10-19 16:28:35'),
(3, 'Peu fréquent', '1 fois par 3 mois', 3, '2020-10-19 16:28:58', '2020-10-19 16:28:58'),
(4, 'Fréquent', '1 fois par semaine', 4, '2020-10-19 16:29:22', '2020-10-19 16:29:22');

-- --------------------------------------------------------

--
-- Structure de la table `processus`
--

DROP TABLE IF EXISTS `processus`;
CREATE TABLE IF NOT EXISTS `processus` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IdTypeProcessus` int(11) NOT NULL,
  `LibProcessus` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ChampApplication` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `IdPilote` int(11) DEFAULT NULL,
  `IdSousPilote` int(11) DEFAULT NULL,
  `IdSociete` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `processus`
--

INSERT INTO `processus` (`id`, `IdTypeProcessus`, `LibProcessus`, `ChampApplication`, `created_at`, `updated_at`, `IdPilote`, `IdSousPilote`, `IdSociete`) VALUES
(1, 1, 'PM(DGE)MAG1', 'Piloter le système de management de la qualité', '2020-10-12 16:50:07', '2020-10-12 16:50:07', 1, NULL, 1),
(2, 1, 'PM(DGE)MAG2', 'Améliorer le système de management de la qualité', '2020-10-12 16:50:48', '2020-10-12 16:50:48', 1, NULL, 1),
(3, 2, 'PR(DCO)OFC1', 'Être à l\'écoute des clients / Traiter les offres et les commandes', '2020-10-12 16:51:46', '2020-10-12 16:51:46', 3, NULL, 1),
(4, 2, 'PR(DPR)EMB', 'PRODUCTION', '2020-10-12 16:53:22', '2020-10-16 15:40:03', 3, NULL, 1),
(5, 2, 'PR(DPR)EMB4', 'Stocker et livrer les produits finis (emballages, plaques, SF)', '2020-10-14 17:27:02', '2020-10-14 17:27:02', 1, 0, 1),
(6, 3, 'Processus 1111', 'Piloter le système d\'Information', '2020-10-17 10:42:15', '2020-10-17 10:42:15', 1, 0, 1),
(7, 1, 'pRO25520', 's iuqpôrapea$êrpo', '2020-10-23 16:16:08', '2020-10-23 16:16:08', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `societe`
--

DROP TABLE IF EXISTS `societe`;
CREATE TABLE IF NOT EXISTS `societe` (
  `IdSociete` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `NomSociete` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NomContact` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Telephone` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Fax` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Statut` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IdSociete`),
  UNIQUE KEY `societe_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `societe`
--

INSERT INTO `societe` (`IdSociete`, `NomSociete`, `NomContact`, `email`, `Telephone`, `Fax`, `Statut`, `created_at`, `updated_at`) VALUES
(1, 'C2S (Cisco Solutions And Services', 'NIAMKE Francis Blin', 'fniamke@yahoo.com', '02-88-44-50 / 05-63-84-81', '23-05-03-05', 0, '2020-10-23 09:36:27', '2020-10-23 09:36:27'),
(2, 'SONACO', 'Contact1', 'sonaco@yahoo.fr', '23-55-55-00', '23-03-66-03', 0, '2020-10-23 09:40:45', '2020-10-23 09:40:45');

-- --------------------------------------------------------

--
-- Structure de la table `sousprocessus`
--

DROP TABLE IF EXISTS `sousprocessus`;
CREATE TABLE IF NOT EXISTS `sousprocessus` (
  `IdSousProcessus` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IdProcessus` int(11) NOT NULL,
  `CodeSousProcessus` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `LibSousProcessus` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `IdSousPilote` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `IdSociete` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdSousProcessus`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sousprocessus`
--

INSERT INTO `sousprocessus` (`IdSousProcessus`, `IdProcessus`, `CodeSousProcessus`, `LibSousProcessus`, `IdSousPilote`, `created_at`, `updated_at`, `IdSociete`) VALUES
(1, 4, 'PR(DPR)EMB1', 'Approvisionner & stocker MP / Planifier et lancer la Production', 7, '2020-10-16 15:41:36', '2020-10-23 16:57:50', 1),
(2, 4, 'PR(DPR)EMB1', 'Gestion des papiers', 7, '2020-10-16 15:42:14', '2020-10-23 16:57:55', 1),
(3, 4, 'PR(DPR)EMB2', 'Réaliser la production des plaques et simples faces', 5, '2020-10-16 15:42:45', '2020-10-23 16:57:59', 1),
(4, 4, 'PR(DPR)EMB3', 'Réaliser la production des emballages', 6, '2020-10-16 15:43:09', '2020-10-23 16:58:04', 1),
(5, 4, 'PR(DPR)EMB4', 'Stocker et livrer les produits finis (emballages, plaques, SF)', 4, '2020-10-16 15:43:46', '2020-10-23 16:58:15', 1);

-- --------------------------------------------------------

--
-- Structure de la table `taches`
--

DROP TABLE IF EXISTS `taches`;
CREATE TABLE IF NOT EXISTS `taches` (
  `IdTaches` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IdPlanaction` int(11) NOT NULL,
  `LibTaches` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `IdIntervenant` int(11) NOT NULL,
  `IdTypeMoyen` int(11) NOT NULL,
  `DateDebut` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `DateFin` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Etat` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IdTaches`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
CREATE TABLE IF NOT EXISTS `typemoyen` (
  `IdTypeMoyen` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `LibTypeMoyen` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IdTypeMoyen`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
CREATE TABLE IF NOT EXISTS `typesprocessus` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `LibTypesProcessus` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(192) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pilote` tinyint(1) DEFAULT NULL,
  `Idfonction` int(192) DEFAULT NULL,
  `SousPilote` tinyint(1) DEFAULT NULL,
  `Auditeur` tinyint(1) DEFAULT NULL,
  `IdSociete` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `pilote`, `Idfonction`, `SousPilote`, `Auditeur`, `IdSociete`) VALUES
(1, 'fniamke', 'fniamke@yahoo.com', NULL, '$2y$10$WVziPaIwMKv2KY.HT.2d/OrDEiuUatVKtUeBSQbFI.lgJqbKD8DdK', NULL, '2020-10-12 15:54:52', '2020-10-23 12:21:06', 1, 1, NULL, NULL, 1),
(2, 'Cisco', 'cisco@yahoo.fr', NULL, '$2y$10$KJFfJwCpFREiQ7vZ3YlrpOlZzkRkRcUufdhYbbVu/6x.nfAN180JC', NULL, '2020-10-12 16:46:02', '2020-10-23 11:48:09', 1, NULL, NULL, NULL, 2),
(3, 'Yves CHAMPEVAL', 'francis@yahoo.fr', NULL, '$2y$10$DUKbXRe.FRJNgVLZjCOsj.cjGgzloFq4VsKnCqWSLPq8P6fJF8AD6', NULL, '2020-10-12 16:48:14', '2020-10-23 12:22:13', 1, 3, NULL, NULL, 1),
(4, 'Victor VANIE', 'vannie@yahoo.fr', NULL, '$2y$10$jy..X/sdjJ5p0giBiZWl1uoAmqxyfTYoghZAaFnebg4BGKaXZADJ2', NULL, '2020-10-14 17:03:00', '2020-10-23 12:21:52', NULL, 7, 1, NULL, 1),
(5, 'Emmanuel AKE', 'EAKE@yahoo.fr', NULL, '$2y$10$JcqoZpBd3ENH8nvteGDkm./t3D4P2t86xLj5xZWwVuNX.0ZOQhkp.', NULL, '2020-10-14 17:11:11', '2020-10-23 12:20:45', NULL, 9, 1, NULL, 1),
(6, 'Georges KOUADIANE', 'GKOUADIANE@yahoo.fr', NULL, '$2y$10$h8tRJ6rAiFNN1BK.O2aQcueB0RyPri3gvXtNLIvYEq4p6Ag0zJ3hG', NULL, '2020-10-14 17:12:07', '2020-10-23 12:21:22', NULL, 9, 1, NULL, 1),
(7, 'Jean Jacques KONE', 'JJKONE@yahoo.fr', NULL, '$2y$10$x0SfOXofM6ViK3AzbIf/jOtCr0T2r6jEEzEtIS//tAwCK5KWKHEbW', NULL, '2020-10-14 17:12:59', '2020-10-23 12:21:37', NULL, 6, 1, NULL, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

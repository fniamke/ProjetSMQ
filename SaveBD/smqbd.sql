-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : jeu. 22 oct. 2020 à 00:16
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
  `name` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `analyserisques`
--

INSERT INTO `analyserisques` (`IdAnalyserisques`, `IdProcessus`, `IdGravite`, `IdProbabilite`, `IdDetection`, `IdCriticite`, `LibRisqueOpportunite`, `Nature`, `Effets`, `Causes`, `DescriptionMA`, `EvaluationMA`, `EvaluationRR`, `DateRevision`, `Archiver`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 2, 'Faille de Sécurité système (Sécurité - Virus, Intrusion)/ Panne matériels', 'R', 'Pertes et Détournements des données', 'Messagerie (Spam) Supports Amovibles Absence de logiciel antivirus Internet (Absence de pare-feu)', 'Serveur antivirus Pare-feu Serveur anti-spam', 0.25, 3, '2020-10-20 00:00:00', 0, '2020-10-20 20:59:08', '2020-10-20 20:59:08'),
(2, 4, 2, 1, 2, 1, 'Indisponibilité des services (Temps de reprise des activités trop long en cas de crash des deux serveurs hôtes)', 'R', 'Problème d\'accès aux services', 'Panne Matériel Serveurs', 'Fournisseurs externes (Maintenance préventive/curative)', 0.3, 3.5, '2020-10-20 00:00:00', 0, '2020-10-20 21:01:32', '2020-10-20 21:01:32');

-- --------------------------------------------------------

--
-- Structure de la table `categorieslois`
--

DROP TABLE IF EXISTS `categorieslois`;
CREATE TABLE IF NOT EXISTS `categorieslois` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `categorieslois` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `LibCotation` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `uuid` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
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
  `LibFonction` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(13, 'Fonction 1765568', '2020-10-21 19:57:28', '2020-10-21 19:57:28');

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
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
CREATE TABLE IF NOT EXISTS `lois` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IdCategoriesLois` int(11) NOT NULL,
  `LibLois` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(54, '2020_10_18_173836_create_partiesinteressees_table', 13),
(55, '2020_10_19_155523_create_probabilite_table', 14),
(56, '2020_10_19_165027_create_gravite_table', 15),
(58, '2020_10_19_171432_create_detection_table', 16),
(59, '2020_10_20_171221_create_criticite_table', 17),
(60, '2020_10_20_173711_create_analyserisques_table', 18),
(61, '2020_10_21_193905_create_mouchard_table', 19);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mouchard`
--

INSERT INTO `mouchard` (`NumId`, `DateEvmt`, `NomEmploye`, `TypeAction`, `Action`, `ValAncienne`, `ValNouveau`, `Poste`, `created_at`, `updated_at`) VALUES
(1, '2020-10-21 19:52:33', 'fniamke', 1, 'Création de la fonction Fonction 2366 ayant id 12', '', '', '', '2020-10-21 19:52:33', '2020-10-21 19:52:33'),
(2, '2020-10-21 19:57:28', 'fniamke', 1, 'Création de la fonction Fonction 1765568 ayant id 13', '', '', '', '2020-10-21 19:57:28', '2020-10-21 19:57:28'),
(3, '2020-10-21 19:58:30', 'fniamke', 1, 'Modification de la fonction ayant id 12', 'Fonction 4444', 'Fonction 4444', '', '2020-10-21 19:58:30', '2020-10-21 19:58:30'),
(4, '2020-10-21 20:04:01', 'fniamke', 1, 'Modification de la fonction ayant id 12', 'Fonction 4444', 'Fonction 6666', '', '2020-10-21 20:04:01', '2020-10-21 20:04:01'),
(5, '2020-10-21 20:04:36', 'fniamke', 1, 'Modification de la fonction ayant id 11', 'Fonction3', 'Fonction 55555', '', '2020-10-21 20:04:36', '2020-10-21 20:04:36'),
(6, '2020-10-21 20:06:15', 'fniamke', 1, 'Suppression de la fonction Fonction 6666 ayant id 12', '', '', '', '2020-10-21 20:06:15', '2020-10-21 20:06:15'),
(7, '2020-10-21 20:06:37', 'fniamke', 1, 'Suppression de la fonction Fonction 55555 ayant id 11', '', '', '', '2020-10-21 20:06:37', '2020-10-21 20:06:37');

-- --------------------------------------------------------

--
-- Structure de la table `niveauimportance`
--

DROP TABLE IF EXISTS `niveauimportance`;
CREATE TABLE IF NOT EXISTS `niveauimportance` (
  `IdNivImportance` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `LibNivImportance` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `LibNivRelation` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `LibPartiesInt` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Contexte` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Attentes` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Risques` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Opportunites` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `email` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `CodePlanaction` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IdProcessus` int(11) NOT NULL,
  `LibPlanaction` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Content` text COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `LibProcessus` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ChampApplication` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `IdPilote` int(11) DEFAULT NULL,
  `IdSousPilote` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
CREATE TABLE IF NOT EXISTS `sousprocessus` (
  `IdSousProcessus` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IdProcessus` int(11) NOT NULL,
  `CodeSousProcessus` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LibSousProcessus` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IdSousPilote` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IdSousProcessus`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
CREATE TABLE IF NOT EXISTS `taches` (
  `IdTaches` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IdPlanaction` int(11) NOT NULL,
  `LibTaches` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IdIntervenant` int(11) NOT NULL,
  `IdTypeMoyen` int(11) NOT NULL,
  `DateDebut` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DateFin` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `LibTypeMoyen` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `LibTypesProcessus` varchar(192) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `Auditeur` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

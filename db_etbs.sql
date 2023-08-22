-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 22 août 2023 à 20:27
-- Version du serveur : 5.7.26
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_etbs`
--

-- --------------------------------------------------------

--
-- Structure de la table `etbs_action_acces`
--

DROP TABLE IF EXISTS `etbs_action_acces`;
CREATE TABLE IF NOT EXISTS `etbs_action_acces` (
  `id_action` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_menu` bigint(20) UNSIGNED NOT NULL,
  `libelle_action` varchar(255) DEFAULT NULL,
  `dev_action` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_action`),
  KEY `matierefp_action_acces_id_menu_foreign` (`id_menu`)
) ENGINE=MyISAM AUTO_INCREMENT=303 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etbs_action_acces`
--

INSERT INTO `etbs_action_acces` (`id_action`, `id_menu`, `libelle_action`, `dev_action`, `created_at`, `updated_at`) VALUES
(1, 3, 'Ajouter un menu', 'add_menu', '2022-06-20 14:10:01', '2022-06-20 14:10:01'),
(2, 3, 'Modifier un menu', 'update_menu', '2022-06-20 14:10:01', '2022-06-20 14:10:01'),
(3, 3, 'Supprimer un menu', 'delete_menu', '2022-06-20 14:10:01', '2022-06-20 14:10:01'),
(4, 3, 'Ajouter une action', 'add_action', '2022-06-20 14:10:01', '2022-06-20 14:10:01'),
(5, 3, 'Supprimer une action', 'delete_action', '2022-06-20 14:10:01', '2022-06-20 14:10:01'),
(6, 4, 'Ajouter un rôle', 'add_role', '2022-06-20 14:10:01', '2022-06-20 14:10:01'),
(7, 4, 'Modifier un rôle', 'update_role', '2022-06-20 14:10:01', '2022-06-20 14:10:01'),
(8, 4, 'Supprimer un rôle', 'delete_role', '2022-06-20 14:10:01', '2022-06-20 14:10:01'),
(9, 5, 'Ajouter un utilisateur', 'add_user', '2022-06-20 14:10:01', '2022-06-20 14:10:01'),
(10, 5, 'Modifier un utilisateur', 'update_user', '2022-06-20 14:10:01', '2022-06-20 14:10:01'),
(11, 5, 'Supprimer un utilisateur', 'delete_user', '2022-06-20 14:10:01', '2022-06-20 14:10:01'),
(12, 5, 'Réinitialiser un mot de passe', 'reinitialiser_mdp', '2022-06-20 14:10:01', '2022-06-20 14:10:01'),
(24, 6, 'Exporter trace', 'exporter_trace', '2022-07-20 13:43:03', '2022-07-20 13:43:03'),
(23, 5, 'testet', 'testet', '2022-07-20 09:03:18', '2022-07-20 09:03:18'),
(170, 19, 'Accéder à la colonne Initiateur', 'init_giwu', '2022-10-28 13:13:55', '2022-10-28 13:13:55'),
(210, 19, 'Accéder à la liste des écoles dans les critères de recherche', 'combo_ecole', '2022-12-11 04:21:17', '2022-12-11 04:21:17'),
(263, 172, 'Ajouter ecole', 'add_ecole', '2023-06-09 14:04:37', '2023-06-09 14:04:37'),
(264, 172, 'Modifier ecole', 'update_ecole', '2023-06-09 14:04:37', '2023-06-09 14:04:37'),
(265, 172, 'Supprimer ecole', 'delete_ecole', '2023-06-09 14:04:37', '2023-06-09 14:04:37'),
(266, 172, 'Exporter ecole', 'exporter_ecole', '2023-06-09 14:04:37', '2023-06-09 14:04:37'),
(267, 175, 'Ajouter anneesco', 'add_anneesco', '2023-06-09 14:40:04', '2023-06-09 14:40:04'),
(268, 175, 'Modifier anneesco', 'update_anneesco', '2023-06-09 14:40:04', '2023-06-09 14:40:04'),
(269, 175, 'Supprimer anneesco', 'delete_anneesco', '2023-06-09 14:40:04', '2023-06-09 14:40:04'),
(270, 175, 'Exporter anneesco', 'exporter_anneesco', '2023-06-09 14:40:04', '2023-06-09 14:40:04'),
(282, 182, 'Exporter classe', 'exporter_classe', '2023-06-10 12:04:37', '2023-06-10 12:04:37'),
(281, 182, 'Supprimer classe', 'delete_classe', '2023-06-10 12:04:37', '2023-06-10 12:04:37'),
(280, 182, 'Modifier classe', 'update_classe', '2023-06-10 12:04:37', '2023-06-10 12:04:37'),
(279, 182, 'Ajouter classe', 'add_classe', '2023-06-10 12:04:37', '2023-06-10 12:04:37'),
(275, 179, 'Ajouter trimsem', 'add_trimsem', '2023-06-10 08:50:47', '2023-06-10 08:50:47'),
(276, 179, 'Modifier trimsem', 'update_trimsem', '2023-06-10 08:50:47', '2023-06-10 08:50:47'),
(277, 179, 'Supprimer trimsem', 'delete_trimsem', '2023-06-10 08:50:47', '2023-06-10 08:50:47'),
(278, 179, 'Exporter trimsem', 'exporter_trimsem', '2023-06-10 08:50:47', '2023-06-10 08:50:47'),
(283, 185, 'Ajouter promotion', 'add_promotion', '2023-06-10 14:13:49', '2023-06-10 14:13:49'),
(284, 185, 'Modifier promotion', 'update_promotion', '2023-06-10 14:13:49', '2023-06-10 14:13:49'),
(285, 185, 'Supprimer promotion', 'delete_promotion', '2023-06-10 14:13:49', '2023-06-10 14:13:49'),
(286, 185, 'Exporter promotion', 'exporter_promotion', '2023-06-10 14:13:49', '2023-06-10 14:13:49'),
(287, 190, 'Ajouter discipline', 'add_discipline', '2023-08-20 19:10:06', '2023-08-20 19:10:06'),
(288, 190, 'Modifier discipline', 'update_discipline', '2023-08-20 19:10:06', '2023-08-20 19:10:06'),
(289, 190, 'Supprimer discipline', 'delete_discipline', '2023-08-20 19:10:06', '2023-08-20 19:10:06'),
(290, 190, 'Exporter discipline', 'exporter_discipline', '2023-08-20 19:10:06', '2023-08-20 19:10:06'),
(291, 193, 'Ajouter eleve', 'add_eleve', '2023-08-20 19:40:56', '2023-08-20 19:40:56'),
(292, 193, 'Modifier eleve', 'update_eleve', '2023-08-20 19:40:56', '2023-08-20 19:40:56'),
(293, 193, 'Supprimer eleve', 'delete_eleve', '2023-08-20 19:40:56', '2023-08-20 19:40:56'),
(294, 193, 'Exporter eleve', 'exporter_eleve', '2023-08-20 19:40:56', '2023-08-20 19:40:56'),
(295, 196, 'Ajouter emploitemp', 'add_emploitemp', '2023-08-20 20:03:27', '2023-08-20 20:03:27'),
(296, 196, 'Modifier emploitemp', 'update_emploitemp', '2023-08-20 20:03:27', '2023-08-20 20:03:27'),
(297, 196, 'Supprimer emploitemp', 'delete_emploitemp', '2023-08-20 20:03:27', '2023-08-20 20:03:27'),
(298, 196, 'Exporter emploitemp', 'exporter_emploitemp', '2023-08-20 20:03:27', '2023-08-20 20:03:27'),
(299, 200, 'Ajouter frequenter', 'add_frequenter', '2023-08-22 19:56:30', '2023-08-22 19:56:30'),
(300, 200, 'Modifier frequenter', 'update_frequenter', '2023-08-22 19:56:30', '2023-08-22 19:56:30'),
(301, 200, 'Supprimer frequenter', 'delete_frequenter', '2023-08-22 19:56:30', '2023-08-22 19:56:30'),
(302, 200, 'Exporter frequenter', 'exporter_frequenter', '2023-08-22 19:56:30', '2023-08-22 19:56:30');

-- --------------------------------------------------------

--
-- Structure de la table `etbs_action_menu_acces`
--

DROP TABLE IF EXISTS `etbs_action_menu_acces`;
CREATE TABLE IF NOT EXISTS `etbs_action_menu_acces` (
  `id_actionmenu` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_menu` bigint(20) UNSIGNED NOT NULL,
  `action_id` bigint(20) UNSIGNED NOT NULL,
  `statut_action` bigint(20) DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_actionmenu`),
  KEY `emp_action_menu_acces_id_menu_foreign` (`id_menu`),
  KEY `emp_action_menu_acces_action_id_foreign` (`action_id`),
  KEY `emp_action_menu_acces_role_id_foreign` (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1122 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etbs_action_menu_acces`
--

INSERT INTO `etbs_action_menu_acces` (`id_actionmenu`, `id_menu`, `action_id`, `statut_action`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 1, 1, '2022-06-20 14:10:01', '2023-08-22 18:58:00'),
(2, 3, 2, 1, 1, '2022-06-20 14:10:01', '2023-08-22 18:58:00'),
(3, 3, 3, 1, 1, '2022-06-20 14:10:01', '2023-08-22 18:58:00'),
(4, 3, 4, 1, 1, '2022-06-20 14:10:01', '2023-08-22 18:58:00'),
(5, 3, 5, 1, 1, '2022-06-20 14:10:01', '2023-08-22 18:58:00'),
(6, 4, 6, 1, 1, '2022-06-20 14:10:01', '2022-07-22 21:47:14'),
(7, 4, 7, 1, 1, '2022-06-20 14:10:01', '2022-07-22 21:47:14'),
(8, 4, 8, 1, 1, '2022-06-20 14:10:01', '2022-07-22 21:47:14'),
(9, 5, 9, 1, 1, '2022-06-20 14:10:01', '2022-07-22 21:47:14'),
(10, 5, 10, 1, 1, '2022-06-20 14:10:01', '2022-07-22 21:47:14'),
(11, 5, 11, 1, 1, '2022-06-20 14:10:01', '2022-07-22 21:47:14'),
(12, 5, 12, 1, 1, '2022-06-20 14:10:01', '2022-07-22 21:47:14'),
(31, 5, 23, 1, 1, '2022-07-20 09:03:18', '2022-07-22 21:47:14'),
(59, 6, 24, 1, 1, '2022-07-20 13:43:03', '2022-07-22 21:47:14'),
(335, 19, 170, 1, 1, '2022-10-28 13:13:55', '2022-10-28 13:13:55'),
(398, 19, 210, 1, 1, '2022-12-11 04:21:17', '2022-12-11 04:21:17'),
(986, 172, 263, 1, 1, '2023-06-09 13:08:09', '2023-06-09 13:08:09'),
(987, 172, 264, 1, 1, '2023-06-09 13:08:09', '2023-06-09 13:08:09'),
(988, 172, 265, 1, 1, '2023-06-09 13:08:09', '2023-06-09 13:08:09'),
(989, 172, 266, 1, 1, '2023-06-09 13:08:09', '2023-06-09 13:08:09'),
(990, 175, 267, 1, 1, '2023-06-09 13:43:15', '2023-06-09 13:43:15'),
(991, 175, 268, 1, 1, '2023-06-09 13:43:15', '2023-06-09 13:43:15'),
(992, 175, 269, 1, 1, '2023-06-09 13:43:15', '2023-06-09 13:43:15'),
(993, 175, 270, 1, 1, '2023-06-09 13:43:15', '2023-06-09 13:43:15'),
(994, 179, 275, 1, 1, '2023-06-10 07:54:23', '2023-06-10 07:54:23'),
(995, 179, 276, 1, 1, '2023-06-10 07:54:23', '2023-06-10 07:54:23'),
(996, 179, 277, 1, 1, '2023-06-10 07:54:23', '2023-06-10 07:54:23'),
(997, 179, 278, 1, 1, '2023-06-10 07:54:23', '2023-06-10 07:54:23'),
(998, 182, 282, 1, 1, '2023-06-10 11:07:19', '2023-06-10 11:07:19'),
(999, 182, 281, 1, 1, '2023-06-10 11:07:19', '2023-06-10 11:07:19'),
(1000, 182, 280, 1, 1, '2023-06-10 11:07:19', '2023-06-10 11:07:19'),
(1001, 182, 279, 1, 1, '2023-06-10 11:07:19', '2023-06-10 11:07:19'),
(1002, 185, 283, 1, 1, '2023-06-10 13:14:56', '2023-06-10 13:14:56'),
(1003, 185, 284, 1, 1, '2023-06-10 13:14:56', '2023-06-10 13:14:56'),
(1004, 185, 285, 1, 1, '2023-06-10 13:14:56', '2023-06-10 13:14:56'),
(1005, 185, 286, 1, 1, '2023-06-10 13:14:56', '2023-06-10 13:14:56'),
(1006, 3, 1, 0, 15, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(1007, 3, 2, 0, 15, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(1008, 3, 3, 0, 15, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(1009, 3, 4, 0, 15, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(1010, 3, 5, 0, 15, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(1011, 4, 6, 0, 15, '2023-06-10 14:12:41', '2023-08-22 19:19:22'),
(1012, 4, 7, 0, 15, '2023-06-10 14:12:41', '2023-08-22 19:19:22'),
(1013, 4, 8, 0, 15, '2023-06-10 14:12:41', '2023-08-22 19:19:22'),
(1014, 5, 9, 1, 15, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(1015, 5, 10, 1, 15, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(1016, 5, 11, 1, 15, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(1017, 5, 12, 1, 15, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(1018, 6, 24, 1, 15, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(1019, 5, 23, 0, 15, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(1020, 19, 170, 1, 15, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(1021, 19, 210, 1, 15, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(1022, 172, 263, 0, 15, '2023-06-10 14:12:41', '2023-06-10 15:45:27'),
(1023, 172, 264, 0, 15, '2023-06-10 14:12:41', '2023-06-10 15:45:27'),
(1024, 172, 265, 1, 15, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(1025, 172, 266, 0, 15, '2023-06-10 14:12:41', '2023-06-10 15:45:27'),
(1026, 175, 267, 1, 15, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(1027, 175, 268, 1, 15, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(1028, 175, 269, 1, 15, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(1029, 175, 270, 1, 15, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(1030, 182, 282, 1, 15, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(1031, 182, 281, 1, 15, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(1032, 182, 280, 1, 15, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(1033, 182, 279, 1, 15, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(1034, 179, 275, 1, 15, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(1035, 179, 276, 1, 15, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(1036, 179, 277, 1, 15, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(1037, 179, 278, 1, 15, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(1038, 185, 283, 1, 15, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(1039, 185, 284, 1, 15, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(1040, 185, 285, 1, 15, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(1041, 185, 286, 1, 15, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(1042, 190, 287, 1, 1, '2023-08-20 18:10:57', '2023-08-20 18:10:57'),
(1043, 190, 288, 1, 1, '2023-08-20 18:10:57', '2023-08-20 18:10:57'),
(1044, 190, 289, 1, 1, '2023-08-20 18:10:57', '2023-08-20 18:10:57'),
(1045, 190, 290, 1, 1, '2023-08-20 18:10:57', '2023-08-20 18:10:57'),
(1046, 193, 291, 1, 1, '2023-08-20 18:41:24', '2023-08-20 18:41:24'),
(1047, 193, 292, 1, 1, '2023-08-20 18:41:24', '2023-08-20 18:41:24'),
(1048, 193, 293, 1, 1, '2023-08-20 18:41:24', '2023-08-20 18:41:24'),
(1049, 193, 294, 1, 1, '2023-08-20 18:41:24', '2023-08-20 18:41:24'),
(1050, 196, 295, 1, 1, '2023-08-20 19:05:03', '2023-08-20 19:05:03'),
(1051, 196, 296, 1, 1, '2023-08-20 19:05:03', '2023-08-20 19:05:03'),
(1052, 196, 297, 1, 1, '2023-08-20 19:05:03', '2023-08-20 19:05:03'),
(1053, 196, 298, 1, 1, '2023-08-20 19:05:03', '2023-08-20 19:05:03'),
(1054, 3, 1, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1055, 3, 2, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1056, 3, 3, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1057, 3, 4, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1058, 3, 5, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1059, 4, 6, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1060, 4, 7, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1061, 4, 8, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1062, 5, 9, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1063, 5, 10, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1064, 5, 11, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1065, 5, 12, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1066, 6, 24, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1067, 5, 23, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1068, 19, 170, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1069, 19, 210, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1070, 172, 263, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1071, 172, 264, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1072, 172, 265, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1073, 172, 266, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1074, 175, 267, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1075, 175, 268, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1076, 175, 269, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1077, 175, 270, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1078, 182, 282, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1079, 182, 281, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1080, 182, 280, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1081, 182, 279, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1082, 179, 275, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1083, 179, 276, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1084, 179, 277, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1085, 179, 278, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1086, 185, 283, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1087, 185, 284, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1088, 185, 285, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1089, 185, 286, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1090, 190, 287, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1091, 190, 288, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1092, 190, 289, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1093, 190, 290, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1094, 193, 291, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1095, 193, 292, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1096, 193, 293, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1097, 193, 294, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1098, 196, 295, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1099, 196, 296, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1100, 196, 297, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1101, 196, 298, 0, 16, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1102, 200, 299, 1, 1, '2023-08-22 18:58:00', '2023-08-22 18:58:00'),
(1103, 200, 300, 1, 1, '2023-08-22 18:58:00', '2023-08-22 18:58:00'),
(1104, 200, 301, 1, 1, '2023-08-22 18:58:00', '2023-08-22 18:58:00'),
(1105, 200, 302, 1, 1, '2023-08-22 18:58:00', '2023-08-22 18:58:00'),
(1106, 190, 287, 1, 15, '2023-08-22 19:19:22', '2023-08-22 19:19:22'),
(1107, 190, 288, 1, 15, '2023-08-22 19:19:22', '2023-08-22 19:19:22'),
(1108, 190, 289, 1, 15, '2023-08-22 19:19:22', '2023-08-22 19:19:22'),
(1109, 190, 290, 1, 15, '2023-08-22 19:19:22', '2023-08-22 19:19:22'),
(1110, 193, 291, 1, 15, '2023-08-22 19:19:22', '2023-08-22 19:19:22'),
(1111, 193, 292, 1, 15, '2023-08-22 19:19:22', '2023-08-22 19:19:22'),
(1112, 193, 293, 1, 15, '2023-08-22 19:19:22', '2023-08-22 19:19:22'),
(1113, 193, 294, 1, 15, '2023-08-22 19:19:22', '2023-08-22 19:19:22'),
(1114, 196, 295, 1, 15, '2023-08-22 19:19:22', '2023-08-22 19:19:22'),
(1115, 196, 296, 1, 15, '2023-08-22 19:19:22', '2023-08-22 19:19:22'),
(1116, 196, 297, 1, 15, '2023-08-22 19:19:22', '2023-08-22 19:19:22'),
(1117, 196, 298, 1, 15, '2023-08-22 19:19:22', '2023-08-22 19:19:22'),
(1118, 200, 299, 1, 15, '2023-08-22 19:19:22', '2023-08-22 19:19:22'),
(1119, 200, 300, 1, 15, '2023-08-22 19:19:22', '2023-08-22 19:19:22'),
(1120, 200, 301, 1, 15, '2023-08-22 19:19:22', '2023-08-22 19:19:22'),
(1121, 200, 302, 1, 15, '2023-08-22 19:19:22', '2023-08-22 19:19:22');

-- --------------------------------------------------------

--
-- Structure de la table `etbs_annee_sco`
--

DROP TABLE IF EXISTS `etbs_annee_sco`;
CREATE TABLE IF NOT EXISTS `etbs_annee_sco` (
  `id_annee` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `annee_debut` bigint(20) NOT NULL,
  `annee_fin` bigint(20) NOT NULL,
  `statut_annee` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `init_id` bigint(20) UNSIGNED NOT NULL,
  `etablis_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_annee`),
  KEY `etbs_annee_sco_init_id_foreign` (`init_id`),
  KEY `etbs_annee_sco_etablis_id_foreign` (`etablis_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etbs_annee_sco`
--

INSERT INTO `etbs_annee_sco` (`id_annee`, `annee_debut`, `annee_fin`, `statut_annee`, `init_id`, `etablis_id`, `created_at`, `updated_at`) VALUES
(1, 2021, 2022, 'a', 1, 1, '2023-06-09 13:49:31', '2023-06-09 14:00:45'),
(2, 2023, 2024, 'd', 1, 2, '2023-06-10 13:55:57', '2023-06-10 13:55:57');

-- --------------------------------------------------------

--
-- Structure de la table `etbs_classe`
--

DROP TABLE IF EXISTS `etbs_classe`;
CREATE TABLE IF NOT EXISTS `etbs_classe` (
  `id_clas` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelle_clas` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee_id` bigint(20) UNSIGNED NOT NULL,
  `init_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_clas`),
  KEY `etbs_classe_annee_id_foreign` (`annee_id`),
  KEY `etbs_classe_init_id_foreign` (`init_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etbs_classe`
--

INSERT INTO `etbs_classe` (`id_clas`, `libelle_clas`, `annee_id`, `init_id`, `created_at`, `updated_at`) VALUES
(1, '6ième', 1, 1, '2023-06-10 13:06:42', '2023-06-10 13:06:42'),
(2, '5ieme', 1, 1, '2023-06-10 13:06:51', '2023-06-10 13:07:58'),
(3, '4ieme', 1, 1, '2023-06-10 13:06:59', '2023-06-10 13:06:59'),
(4, '3ieme', 1, 1, '2023-06-10 13:07:04', '2023-06-10 13:07:04');

-- --------------------------------------------------------

--
-- Structure de la table `etbs_discipline`
--

DROP TABLE IF EXISTS `etbs_discipline`;
CREATE TABLE IF NOT EXISTS `etbs_discipline` (
  `id_disci` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code_disci` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `libelle_disci` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `init_id` bigint(20) UNSIGNED NOT NULL,
  `ecole_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_disci`),
  KEY `etbs_discipline_init_id_foreign` (`init_id`),
  KEY `etbs_discipline_ecole_id_foreign` (`ecole_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etbs_discipline`
--

INSERT INTO `etbs_discipline` (`id_disci`, `code_disci`, `libelle_disci`, `init_id`, `ecole_id`, `created_at`, `updated_at`) VALUES
(1, 'MATHS', 'Mathématique', 1, 1, '2023-08-20 18:12:51', '2023-08-20 18:12:51'),
(2, 'HIST-GEO', 'Histoire Géographie', 1, 1, '2023-08-20 18:13:52', '2023-08-20 18:14:22');

-- --------------------------------------------------------

--
-- Structure de la table `etbs_ecole`
--

DROP TABLE IF EXISTS `etbs_ecole`;
CREATE TABLE IF NOT EXISTS `etbs_ecole` (
  `id_eco` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom_eco` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sigle_eco` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `adres_eco` text COLLATE utf8mb4_unicode_ci,
  `ville_eco` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `CodePos_eco` text COLLATE utf8mb4_unicode_ci,
  `pays_eco` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel_eco` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_eco` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `directeur_eco` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `niveau_educ_eco` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `init_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_eco`),
  KEY `etbs_ecole_init_id_foreign` (`init_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etbs_ecole`
--

INSERT INTO `etbs_ecole` (`id_eco`, `nom_eco`, `sigle_eco`, `adres_eco`, `ville_eco`, `CodePos_eco`, `pays_eco`, `tel_eco`, `email_eco`, `directeur_eco`, `niveau_educ_eco`, `init_id`, `created_at`, `updated_at`) VALUES
(1, 'Complexe Scolaire Félix Houphouet Boigny', 'C.S.F.H.B.', 'Zogbohoue', 'Cotonou', NULL, 'Bénin', '98000000', 'houphouetboigny@gmail.com', 'ASSOGBA Jean Benoit', 's', 1, '2023-06-09 13:11:59', '2023-06-09 13:11:59'),
(2, 'Complexe Scolaire Cours du soutient', 'C.S.S.', 'Akpakpa', 'Cotonou', 'ZE90909', 'Bénin', '98999009', 'courssoutient@gmail.com', 'Père YAROU Jean', 's', 1, '2023-06-10 09:18:00', '2023-06-10 09:18:00');

-- --------------------------------------------------------

--
-- Structure de la table `etbs_eleve`
--

DROP TABLE IF EXISTS `etbs_eleve`;
CREATE TABLE IF NOT EXISTS `etbs_eleve` (
  `id_el` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom_el` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_el` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `matricule_el` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_nais_el` date DEFAULT NULL,
  `sexe_el` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_el` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tuteur_el` text COLLATE utf8mb4_unicode_ci,
  `email_el` text COLLATE utf8mb4_unicode_ci,
  `tel_el` text COLLATE utf8mb4_unicode_ci,
  `ecole_id` bigint(20) UNSIGNED NOT NULL,
  `init_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_el`),
  KEY `etbs_eleve_ecole_id_foreign` (`ecole_id`),
  KEY `etbs_eleve_init_id_foreign` (`init_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etbs_eleve`
--

INSERT INTO `etbs_eleve` (`id_el`, `nom_el`, `prenom_el`, `matricule_el`, `date_nais_el`, `sexe_el`, `photo_el`, `tuteur_el`, `email_el`, `tel_el`, `ecole_id`, `init_id`, `created_at`, `updated_at`) VALUES
(1, 'ALLADAYE', 'Eric', '233232', '2000-08-08', 'F', 'phpEB1A.tmp.jpeg', 'TOHON Richard', 'richardtohon@gmail.com', '89898989', 1, 1, '2023-08-22 19:13:17', '2023-08-22 19:13:17');

-- --------------------------------------------------------

--
-- Structure de la table `etbs_emploi_temp`
--

DROP TABLE IF EXISTS `etbs_emploi_temp`;
CREATE TABLE IF NOT EXISTS `etbs_emploi_temp` (
  `id_empl` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `jour_semaine` bigint(20) NOT NULL,
  `discipline_id` bigint(20) UNSIGNED NOT NULL,
  `promotion_id` bigint(20) UNSIGNED NOT NULL,
  `init_id` bigint(20) UNSIGNED NOT NULL,
  `annee_id` bigint(20) UNSIGNED NOT NULL,
  `prof_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_empl`),
  KEY `etbs_emploi_temp_discipline_id_foreign` (`discipline_id`),
  KEY `etbs_emploi_temp_promotion_id_foreign` (`promotion_id`),
  KEY `etbs_emploi_temp_init_id_foreign` (`init_id`),
  KEY `etbs_emploi_temp_annee_id_foreign` (`annee_id`),
  KEY `etbs_emploi_temp_prof_id_foreign` (`prof_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etbs_emploi_temp`
--

INSERT INTO `etbs_emploi_temp` (`id_empl`, `heure_debut`, `heure_fin`, `jour_semaine`, `discipline_id`, `promotion_id`, `init_id`, `annee_id`, `prof_id`, `created_at`, `updated_at`) VALUES
(1, '12:00:00', '13:00:00', 5, 1, 1, 1, 1, 20, '2023-08-22 13:17:37', '2023-08-22 13:18:50'),
(2, '17:00:00', '20:00:00', 2, 2, 2, 1, 1, 20, '2023-08-22 18:23:01', '2023-08-22 18:23:01');

-- --------------------------------------------------------

--
-- Structure de la table `etbs_failed_jobs`
--

DROP TABLE IF EXISTS `etbs_failed_jobs`;
CREATE TABLE IF NOT EXISTS `etbs_failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `etbs_frequenter`
--

DROP TABLE IF EXISTS `etbs_frequenter`;
CREATE TABLE IF NOT EXISTS `etbs_frequenter` (
  `id_freq` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `eleve_id` bigint(20) UNSIGNED NOT NULL,
  `promotion_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_freq`),
  KEY `etbs_frequenter_eleve_id_foreign` (`eleve_id`),
  KEY `etbs_frequenter_promotion_id_foreign` (`promotion_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etbs_frequenter`
--

INSERT INTO `etbs_frequenter` (`id_freq`, `eleve_id`, `promotion_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2023-08-22 19:15:08', '2023-08-22 19:15:08');

-- --------------------------------------------------------

--
-- Structure de la table `etbs_menu`
--

DROP TABLE IF EXISTS `etbs_menu`;
CREATE TABLE IF NOT EXISTS `etbs_menu` (
  `id_menu` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelle_menu` varchar(255) DEFAULT NULL,
  `titre_page` varchar(255) DEFAULT NULL,
  `controler` varchar(255) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `topmenu_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `menu_icon` varchar(255) DEFAULT NULL,
  `num_ordre` bigint(20) DEFAULT NULL,
  `order_ss` bigint(20) DEFAULT NULL,
  `architecture` varchar(255) DEFAULT NULL,
  `elmt_menu` varchar(3) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_menu`),
  KEY `matierefp_menu_topmenu_id_foreign` (`topmenu_id`),
  KEY `matierefp_menu_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=203 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etbs_menu`
--

INSERT INTO `etbs_menu` (`id_menu`, `libelle_menu`, `titre_page`, `controler`, `route`, `topmenu_id`, `user_id`, `menu_icon`, `num_ordre`, `order_ss`, `architecture`, `elmt_menu`, `created_at`, `updated_at`) VALUES
(1, 'Accueil', 'Bienvenu à la page d\'accueil', '', 'home', 0, 1, 'ri-home-4-line', 1, 0, '/', 'oui', '2022-06-20 14:10:01', '2022-10-18 17:40:50'),
(2, 'Administrations', 'Bienvenu à la page d\'administrateur', '', 'admin', 0, 1, 'ri-settings-2-line', 4, 0, '/admin', 'oui', '2022-06-20 14:10:01', '2022-07-26 15:07:48'),
(3, 'Menu', 'Liste des menus', 'GiwuMenuController', 'menu', 2, 1, 'ri-menu-fill', 1, 2, '/admin/menu', 'oui', '2022-06-20 14:10:01', '2022-07-25 08:02:48'),
(4, 'Définir les rôles', 'Liste des rôles', 'RoleController', 'role', 2, 1, 'ri-shield-user-line', 2, 0, '/admin/role', 'oui', '2022-06-20 14:10:01', '2022-07-25 08:20:17'),
(5, 'Utilisateurs', 'Gestion des utilisateurs', 'PlaUserappController', 'users', 2, 1, 'ri-user-settings-fill', 3, 0, '/admin/user', 'oui', '2022-06-20 14:10:01', '2022-07-25 08:21:14'),
(6, 'Suivi des mouvements', 'Suivi des mouvements', 'IndexController', 'trace', 2, 1, 'ri-file-list-2-fill', 6, 0, '/admin/trace', 'oui', '2022-06-20 14:10:01', '2022-11-21 13:36:37'),
(7, 'Aide', 'Aide sur l\'application', '', 'aide', 0, 1, 'ri-information-line', 5, 0, '/aide', 'oui', '2022-06-20 14:10:01', '2022-07-26 15:07:33'),
(8, 'Manuel d\'utilisation', 'Manuel d\'utilisation', '', 'manuel', 7, 1, 'ri-book-2-fill', 1, 0, '/aide/manuel', 'oui', '2022-06-20 14:10:01', '2022-07-25 08:23:03'),
(9, 'Détails profil', 'Mon profil', '', 'myprofile', 0, 1, 'ri-group-line', 1, 0, '/profil', 'non', '2022-06-20 14:10:01', '2022-07-25 08:24:07'),
(10, 'Création d\'un utilisateur', 'Création d\'un utilisateur', 'PlaUserappController', 'users/create', 5, 1, 'ri-user-add-line', 1, 0, '/admin/user/create', 'non', '2022-06-20 14:10:01', '2022-07-25 08:23:49'),
(18, 'Modification d\'un menu', 'Modification d\'un menu', NULL, 'menu/edit', 0, 1, 'ri-menu-add-fill', 1, NULL, '/admin/menu/edit', 'non', '2022-07-25 08:07:26', '2022-07-25 08:07:26'),
(19, 'Paramètres', 'Paramètres', NULL, 'param', 0, 1, 'ri-chat-settings-line', 1, NULL, '/param', 'oui', '2022-07-25 10:12:48', '2023-06-07 17:43:31'),
(17, 'Création d\'un menu', 'Création d\'un menu', NULL, 'menu/create', 3, 1, 'ri-menu-add-line', 1, NULL, '/admin/menu/create', 'non', '2022-07-22 18:51:01', '2022-07-25 08:03:10'),
(20, 'Modification d\'un rôle', 'Modification d\'un rôle', NULL, 'role/edit', 0, 1, 'ri-shield-user-line', 1, NULL, '/admin/role/edit', 'non', '2022-07-25 10:16:06', '2022-07-25 10:16:37'),
(24, 'Consultation', 'Consultation', NULL, 'cons', 0, 1, 'ri-file-list-2-line', 3, NULL, '/cons', 'oui', '2022-07-26 15:06:45', '2023-08-22 19:02:29'),
(74, 'Société', 'Société', NULL, 'mysociety', 2, 1, 'ri-home-4-line', 2, NULL, '/admin/societe', 'oui', '2022-10-07 16:26:14', '2022-11-09 19:50:58'),
(172, 'École', 'École', 'EcoleController', 'ecole', 19, 1, 'ri-bill-line', 1, NULL, '/param/ecole', 'oui', '2023-06-09 14:04:37', '2023-06-09 13:07:50'),
(173, 'Ajouter une école', 'Ajout d\'une école', 'EcoleController', 'ecole/create', 172, 1, 'ri-bill-line', 1, NULL, '/param/ecole/create', 'non', '2023-06-09 14:04:38', '2023-06-09 13:06:45'),
(174, 'Modifier une école', 'Modification d\'une école', 'EcoleController', 'ecole/edit', 172, 1, 'ri-bill-line', 1, NULL, '/param/ecole/edit', 'non', '2023-06-09 14:04:38', '2023-06-09 13:07:03'),
(175, 'Année Scolaire', 'Année Scolaire', 'AnneescoController', 'anneesco', 19, 1, 'ri-bill-line', 2, NULL, '/param/anneesco', 'oui', '2023-06-09 14:40:03', '2023-06-10 11:06:26'),
(184, 'Modifier une classe', 'Modification de Classe', 'ClasseController', 'classe/edit', 182, 1, 'ri-bill-line', 1, NULL, '/param/classe/edit', 'non', '2023-06-10 12:04:37', '2023-06-10 12:04:37'),
(183, 'Ajouter une classe', 'Ajout de Classe', 'ClasseController', 'classe/create', 182, 1, 'ri-bill-line', 1, NULL, '/param/classe/create', 'non', '2023-06-10 12:04:37', '2023-06-10 12:04:37'),
(182, 'Classe', 'Classe', 'ClasseController', 'classe', 19, 1, 'ri-bill-line', 4, NULL, '/param/classe', 'oui', '2023-06-10 12:04:37', '2023-06-10 11:05:47'),
(179, 'Période', 'Période', 'TrimsemController', 'trimsem', 19, 1, 'ri-bill-line', 3, NULL, '/param/trimsem', 'oui', '2023-06-10 08:50:47', '2023-06-10 11:06:12'),
(180, 'Ajouter une période', 'Ajout d\'une période', 'TrimsemController', 'trimsem/create', 179, 1, 'ri-bill-line', 1, NULL, '/param/trimsem/create', 'non', '2023-06-10 08:50:47', '2023-06-10 07:53:18'),
(181, 'Modifier une période', 'Modification d\'une période', 'TrimsemController', 'trimsem/edit', 179, 1, 'ri-bill-line', 1, NULL, '/param/trimsem/edit', 'non', '2023-06-10 08:50:47', '2023-06-10 07:53:07'),
(185, 'Promotion', 'Promotion', 'PromotionController', 'promotion', 19, 1, 'ri-bill-line', 5, NULL, '/param/promotion', 'oui', '2023-06-10 14:13:49', '2023-06-10 13:15:40'),
(186, 'Ajouter une promotion', 'Ajout de Promotion', 'PromotionController', 'promotion/create', 185, 1, 'ri-bill-line', 1, NULL, '/param/promotion/create', 'non', '2023-06-10 14:13:49', '2023-06-10 14:13:49'),
(187, 'Modifier une promotion', 'Modification de Promotion', 'PromotionController', 'promotion/edit', 185, 1, 'ri-bill-line', 1, NULL, '/param/promotion/edit', 'non', '2023-06-10 14:13:49', '2023-06-10 14:13:49'),
(188, 'Ajouter une année scolaire', 'Ajouter une année scolaire', NULL, 'anneesco/create', 175, 1, 'ri-bill-line', 1, NULL, '/param/anneesco/create', 'non', '2023-06-10 13:49:15', '2023-06-10 13:49:15'),
(189, 'Modifier une année scolaire', 'Modifier une année scolaire', NULL, 'anneesco/edit', 175, 1, 'ri-bill-line', 1, NULL, '/param/anneesco/edit', 'non', '2023-06-10 13:51:03', '2023-06-10 13:51:03'),
(190, 'Discipline', 'Discipline', 'DisciplineController', 'discipline', 19, 1, 'ri-bill-line', 6, NULL, '/param/discipline', 'oui', '2023-08-20 19:10:06', '2023-08-20 18:18:10'),
(191, 'Ajouter une discipline', 'Ajout d\'une Discipline', 'DisciplineController', 'discipline/create', 190, 1, 'ri-bill-line', 1, NULL, '/param/discipline/create', 'non', '2023-08-20 19:10:06', '2023-08-20 18:17:05'),
(192, 'Modifier une discipline', 'Modification d\'une Discipline', 'DisciplineController', 'discipline/edit', 190, 1, 'ri-bill-line', 1, NULL, '/param/discipline/edit', 'non', '2023-08-20 19:10:06', '2023-08-20 18:17:17'),
(193, 'Elève', 'Elève', 'EleveController', 'eleve', 19, 1, 'ri-bill-line', 7, NULL, '/param/eleve', 'oui', '2023-08-20 19:40:56', '2023-08-20 18:43:45'),
(194, 'Ajouter', 'Ajout d\'un Elève', 'EleveController', 'eleve/create', 193, 1, 'ri-bill-line', 1, NULL, '/param/eleve/create', 'non', '2023-08-20 19:40:56', '2023-08-20 18:44:11'),
(195, 'Modifier', 'Modification d\'un Elève', 'EleveController', 'eleve/edit', 193, 1, 'ri-bill-line', 1, NULL, '/param/eleve/edit', 'non', '2023-08-20 19:40:56', '2023-08-20 18:44:26'),
(196, 'Emploi du temps', 'Emploi du temps', 'EmploitempController', 'emploitemp', 19, 1, 'ri-bill-line', 8, NULL, '/param/emploitemp', 'oui', '2023-08-20 20:03:27', '2023-08-20 19:07:19'),
(197, 'Ajouter', 'Ajout d\'un emploi temps', 'EmploitempController', 'emploitemp/create', 196, 1, 'ri-bill-line', 1, NULL, '/param/emploitemp/create', 'non', '2023-08-20 20:03:27', '2023-08-20 19:22:41'),
(198, 'Modifier', 'Modification d\'un emploi temps', 'EmploitempController', 'emploitemp/edit', 196, 1, 'ri-bill-line', 1, NULL, '/param/emploitemp/edit', 'non', '2023-08-20 20:03:27', '2023-08-20 19:23:00'),
(199, 'Faire un appel', 'Faire un appel', NULL, 'appel', 0, 1, 'ri-file-list-2-line', 3, NULL, '/appel', 'oui', '2023-08-22 18:39:07', '2023-08-22 18:39:19'),
(200, 'Elèves par promotion', 'Elèves par promotion', 'FrequenterController', 'frequenter', 24, 1, 'ri-bill-line', 10, NULL, '/cons/frequenter', 'oui', '2023-08-22 19:56:30', '2023-08-22 19:05:25'),
(201, 'Ajouter', 'Ajout de Frequenter', 'FrequenterController', 'frequenter/create', 200, 1, 'ri-bill-line', 1, NULL, '/cons/frequenter/create', 'non', '2023-08-22 19:56:30', '2023-08-22 19:02:03'),
(202, 'Modifier', 'Modification de Frequenter', 'FrequenterController', 'frequenter/edit', 200, 1, 'ri-bill-line', 1, NULL, '/cons/frequenter/edit', 'non', '2023-08-22 19:56:30', '2023-08-22 19:01:56');

-- --------------------------------------------------------

--
-- Structure de la table `etbs_migrations`
--

DROP TABLE IF EXISTS `etbs_migrations`;
CREATE TABLE IF NOT EXISTS `etbs_migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=131 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etbs_migrations`
--

INSERT INTO `etbs_migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(123, '2023_06_01_135_CreerEtbsanneescoTable', 2),
(124, '2023_06_01_138_CreerEtbsclasseTable', 3),
(125, '2023_06_01_139_CreerEtbspromotionTable', 4),
(127, '2023_06_01_158_CreerEtbsdisciplineTable', 5),
(128, '2023_06_01_159_CreerEtbseleveTable', 6),
(129, '2023_06_01_160_CreerEtbsemploitempTable', 7),
(130, '2023_06_01_162_CreerEtbsfrequenterTable', 8);

-- --------------------------------------------------------

--
-- Structure de la table `etbs_password_resets`
--

DROP TABLE IF EXISTS `etbs_password_resets`;
CREATE TABLE IF NOT EXISTS `etbs_password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `etbs_personal_access_tokens`
--

DROP TABLE IF EXISTS `etbs_personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `etbs_personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `etbs_promotion`
--

DROP TABLE IF EXISTS `etbs_promotion`;
CREATE TABLE IF NOT EXISTS `etbs_promotion` (
  `id_pro` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelle_pro` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `init_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pro`),
  KEY `etbs_promotion_class_id_foreign` (`class_id`),
  KEY `etbs_promotion_init_id_foreign` (`init_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etbs_promotion`
--

INSERT INTO `etbs_promotion` (`id_pro`, `libelle_pro`, `class_id`, `init_id`, `created_at`, `updated_at`) VALUES
(1, '6ieme - A1', 1, 1, '2023-06-10 14:00:49', '2023-06-10 14:00:49'),
(2, '5ieme - A1', 2, 1, '2023-06-10 15:43:42', '2023-06-10 15:43:42');

-- --------------------------------------------------------

--
-- Structure de la table `etbs_role`
--

DROP TABLE IF EXISTS `etbs_role`;
CREATE TABLE IF NOT EXISTS `etbs_role` (
  `id_role` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelle_role` varchar(255) NOT NULL,
  `user_save_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_role`),
  KEY `matierefp_role_user_save_id_foreign` (`user_save_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etbs_role`
--

INSERT INTO `etbs_role` (`id_role`, `libelle_role`, `user_save_id`, `created_at`, `updated_at`) VALUES
(1, 'Administrateur inputer', 1, '2022-06-20 14:10:01', '2023-08-22 18:58:00'),
(15, 'Administrateur', 1, '2023-06-10 14:12:41', '2023-08-22 19:19:21'),
(16, 'Professeur', 1, '2023-08-22 18:20:28', '2023-08-22 18:20:28');

-- --------------------------------------------------------

--
-- Structure de la table `etbs_role_acces`
--

DROP TABLE IF EXISTS `etbs_role_acces`;
CREATE TABLE IF NOT EXISTS `etbs_role_acces` (
  `role_id` bigint(20) NOT NULL,
  `id_menu` bigint(20) UNSIGNED NOT NULL,
  `id_roleacces` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `statut_role` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_roleacces`),
  KEY `matierefp_role_acces_role_id_foreign` (`role_id`),
  KEY `matierefp_role_acces_id_menu_foreign` (`id_menu`)
) ENGINE=MyISAM AUTO_INCREMENT=787 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etbs_role_acces`
--

INSERT INTO `etbs_role_acces` (`role_id`, `id_menu`, `id_roleacces`, `statut_role`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2022-06-20 14:10:01', '2022-07-22 21:30:34'),
(1, 2, 2, 1, '2022-06-20 14:10:01', '2022-07-22 21:30:34'),
(1, 5, 3, 1, '2022-06-20 14:10:01', '2022-07-22 21:30:34'),
(1, 6, 4, 1, '2022-06-20 14:10:01', '2022-07-22 21:30:34'),
(1, 3, 5, 1, '2022-06-20 14:10:01', '2023-08-22 18:58:00'),
(1, 4, 6, 1, '2022-06-20 14:10:01', '2022-07-22 21:30:34'),
(1, 7, 7, 1, '2022-06-20 14:10:01', '2022-07-22 21:30:34'),
(1, 8, 8, 1, '2022-06-20 14:10:01', '2022-07-22 21:30:34'),
(1, 24, 49, 1, '2022-07-26 15:06:45', '2022-07-26 15:06:45'),
(1, 17, 31, 1, '2022-07-22 21:43:07', '2022-07-22 21:43:15'),
(1, 10, 30, 1, '2022-07-22 21:43:07', '2022-07-22 21:43:07'),
(1, 9, 29, 1, '2022-07-22 21:43:07', '2022-07-22 21:43:07'),
(1, 20, 45, 1, '2022-07-25 10:18:59', '2022-07-25 10:18:59'),
(1, 19, 44, 1, '2022-07-25 10:18:59', '2022-07-25 10:18:59'),
(1, 18, 43, 1, '2022-07-25 08:30:53', '2022-07-25 08:30:53'),
(1, 74, 142, 1, '2022-10-07 16:26:14', '2022-10-07 16:26:14'),
(1, 172, 672, 1, NULL, NULL),
(1, 173, 673, 1, NULL, NULL),
(1, 174, 674, 1, NULL, NULL),
(1, 175, 675, 1, NULL, NULL),
(1, 183, 683, 1, NULL, NULL),
(1, 182, 682, 1, NULL, NULL),
(1, 184, 684, 1, NULL, NULL),
(1, 179, 679, 1, NULL, NULL),
(1, 180, 680, 1, NULL, NULL),
(1, 181, 681, 1, NULL, NULL),
(1, 185, 685, 1, NULL, NULL),
(1, 186, 686, 1, NULL, NULL),
(1, 187, 687, 1, NULL, NULL),
(1, 188, 688, 1, '2023-06-10 13:49:15', '2023-06-10 13:49:15'),
(1, 189, 689, 1, '2023-06-10 13:51:03', '2023-06-10 13:51:03'),
(15, 1, 690, 1, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(15, 2, 691, 1, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(15, 3, 692, 0, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(15, 4, 693, 0, '2023-06-10 14:12:41', '2023-08-22 19:19:21'),
(15, 5, 694, 1, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(15, 6, 695, 1, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(15, 7, 696, 1, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(15, 8, 697, 1, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(15, 9, 698, 1, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(15, 10, 699, 1, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(15, 18, 700, 1, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(15, 19, 701, 1, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(15, 17, 702, 1, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(15, 20, 703, 1, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(15, 24, 704, 1, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(15, 74, 705, 1, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(15, 172, 706, 1, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(15, 173, 707, 1, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(15, 174, 708, 1, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(15, 175, 709, 1, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(15, 184, 710, 1, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(15, 183, 711, 1, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(15, 182, 712, 1, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(15, 179, 713, 1, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(15, 180, 714, 1, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(15, 181, 715, 1, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(15, 185, 716, 1, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(15, 186, 717, 1, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(15, 187, 718, 1, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(15, 188, 719, 1, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(15, 189, 720, 1, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(1, 190, 721, 1, NULL, NULL),
(1, 191, 722, 1, NULL, NULL),
(1, 192, 723, 1, NULL, NULL),
(1, 193, 724, 1, NULL, NULL),
(1, 194, 725, 1, NULL, NULL),
(1, 195, 726, 1, NULL, NULL),
(1, 196, 727, 1, NULL, NULL),
(1, 197, 728, 1, NULL, NULL),
(1, 198, 729, 1, NULL, NULL),
(16, 1, 730, 1, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 2, 731, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 3, 732, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 4, 733, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 5, 734, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 6, 735, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 7, 736, 1, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 8, 737, 1, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 9, 738, 1, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 10, 739, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 18, 740, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 19, 741, 1, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 17, 742, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 20, 743, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 24, 744, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 74, 745, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 172, 746, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 173, 747, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 174, 748, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 175, 749, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 184, 750, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 183, 751, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 182, 752, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 179, 753, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 180, 754, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 181, 755, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 185, 756, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 186, 757, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 187, 758, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 188, 759, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 189, 760, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 190, 761, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 191, 762, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 192, 763, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 193, 764, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 194, 765, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 195, 766, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 196, 767, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 197, 768, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(16, 198, 769, 0, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(1, 199, 770, 1, '2023-08-22 18:39:07', '2023-08-22 18:39:07'),
(1, 200, 771, 1, NULL, NULL),
(1, 201, 772, 1, NULL, NULL),
(1, 202, 773, 1, NULL, NULL),
(15, 190, 774, 1, '2023-08-22 19:19:21', '2023-08-22 19:19:21'),
(15, 191, 775, 1, '2023-08-22 19:19:21', '2023-08-22 19:19:21'),
(15, 192, 776, 1, '2023-08-22 19:19:21', '2023-08-22 19:19:21'),
(15, 193, 777, 1, '2023-08-22 19:19:21', '2023-08-22 19:19:21'),
(15, 194, 778, 1, '2023-08-22 19:19:21', '2023-08-22 19:19:21'),
(15, 195, 779, 1, '2023-08-22 19:19:21', '2023-08-22 19:19:21'),
(15, 196, 780, 1, '2023-08-22 19:19:21', '2023-08-22 19:19:21'),
(15, 197, 781, 1, '2023-08-22 19:19:21', '2023-08-22 19:19:21'),
(15, 198, 782, 1, '2023-08-22 19:19:22', '2023-08-22 19:19:22'),
(15, 199, 783, 1, '2023-08-22 19:19:22', '2023-08-22 19:19:22'),
(15, 200, 784, 1, '2023-08-22 19:19:22', '2023-08-22 19:19:22'),
(15, 201, 785, 1, '2023-08-22 19:19:22', '2023-08-22 19:19:22'),
(15, 202, 786, 1, '2023-08-22 19:19:22', '2023-08-22 19:19:22');

-- --------------------------------------------------------

--
-- Structure de la table `etbs_save_trace`
--

DROP TABLE IF EXISTS `etbs_save_trace`;
CREATE TABLE IF NOT EXISTS `etbs_save_trace` (
  `id_trace` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelle_trace` varchar(13000) NOT NULL,
  `naviguateur` varchar(255) DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_trace`),
  KEY `matierefp_save_trace_id_user_foreign` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=127 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etbs_save_trace`
--

INSERT INTO `etbs_save_trace` (`id_trace`, `libelle_trace`, `naviguateur`, `id_user`, `created_at`, `updated_at`) VALUES
(43, 'Modification du menu : Old infos ((elmt_menu=>non) <br/>)  New infos ((elmt_menu=>oui) <br/>) ', ' ', 1, '2023-06-07 17:43:31', '2023-06-07 17:43:31'),
(44, 'Modification du menu : Old infos ((libelle_menu=>Ajouter une ecole) <br/>(titre_page=>Ajout de Ecole) <br/>)  New infos ((libelle_menu=>Ajouter une école) <br/>(titre_page=>Ajout d\'une école) <br/>) ', ' ', 1, '2023-06-09 13:06:45', '2023-06-09 13:06:45'),
(45, 'Modification du menu : Old infos ((libelle_menu=>Modifier une ecole) <br/>(titre_page=>Modification de Ecole) <br/>)  New infos ((libelle_menu=>Modifier une école) <br/>(titre_page=>Modification d\'une école) <br/>) ', ' ', 1, '2023-06-09 13:07:03', '2023-06-09 13:07:03'),
(46, 'Modification du menu : Old infos ((libelle_menu=>Ecole) <br/>(titre_page=>Ecole) <br/>)  New infos ((libelle_menu=>École) <br/>(titre_page=>École) <br/>) ', ' ', 1, '2023-06-09 13:07:50', '2023-06-09 13:07:50'),
(47, 'Modification du rôle : Old infos ((id_role=>1) <br/>(user_save_id=>1) <br/>(created_at=>2022-06-20T15:10:01.000000Z) <br/>)  New infos ((_token=>losDeIGjJ1nJoqlCUhUJIa2w8jw9U2lfhhclt0pZ) <br/>(_method=>PATCH) <br/>(cocher1=>1) <br/>(cocher2=>2) <br/>(cocher4=>4) <br/>(action6=>6) <br/>(action7=>7) <br/>(action8=>8) <br/>(cocher5=>5) <br/>(action9=>9) <br/>(action10=>10) <br/>(action11=>11) <br/>(action12=>12) <br/>(action23=>23) <br/>(cocher6=>6) <br/>(action24=>24) <br/>(cocher7=>7) <br/>(cocher8=>8) <br/>(cocher9=>9) <br/>(cocher10=>10) <br/>(cocher18=>18) <br/>(cocher19=>19) <br/>(action170=>170) <br/>(action210=>210) <br/>(cocher17=>17) <br/>(cocher20=>20) <br/>(cocher24=>24) <br/>(cocher74=>74) <br/>(cocher172=>172) <br/>(action263=>263) <br/>(action264=>264) <br/>(action265=>265) <br/>(action266=>266) <br/>(cocher173=>173) <br/>(cocher174=>174) <br/>) ', ' ', 1, '2023-06-09 13:08:09', '2023-06-09 13:08:09'),
(48, 'Ajout du nouveau ecole : (nom_eco=>Complexe Scolaire Félix Houphouet Boigny) <br/>(sigle_eco=>C.S.F.H.B.) <br/>(adres_eco=>Zogbohoue) <br/>(ville_eco=>Cotonou) <br/>(CodePos_eco=>) <br/>(pays_eco=>Bénin) <br/>(tel_eco=>98000000) <br/>(email_eco=>houphouetboigny@gmail.com) <br/>(directeur_eco=>ASSOGBA Jean Benoit) <br/>(niveau_educ_eco=>Oui) <br/>(init_id=>1) <br/>(created_at=>2023-06-09T14:11:59.000000Z) <br/>(id_eco=>1) <br/>', ' ', 1, '2023-06-09 13:11:59', '2023-06-09 13:11:59'),
(49, 'Modification ecole : ', ' ', 1, '2023-06-09 13:19:03', '2023-06-09 13:19:03'),
(50, 'Modification du rôle : Old infos ((id_role=>1) <br/>(user_save_id=>1) <br/>(created_at=>2022-06-20T15:10:01.000000Z) <br/>)  New infos ((_token=>0KgZQArPAG3pVBYObDHXe5RV1L1aQvGhKg2tvw9u) <br/>(_method=>PATCH) <br/>(cocher1=>1) <br/>(cocher2=>2) <br/>(cocher4=>4) <br/>(action6=>6) <br/>(action7=>7) <br/>(action8=>8) <br/>(cocher5=>5) <br/>(action9=>9) <br/>(action10=>10) <br/>(action11=>11) <br/>(action12=>12) <br/>(action23=>23) <br/>(cocher6=>6) <br/>(action24=>24) <br/>(cocher7=>7) <br/>(cocher8=>8) <br/>(cocher9=>9) <br/>(cocher10=>10) <br/>(cocher18=>18) <br/>(cocher19=>19) <br/>(action170=>170) <br/>(action210=>210) <br/>(cocher17=>17) <br/>(cocher20=>20) <br/>(cocher24=>24) <br/>(cocher74=>74) <br/>(cocher172=>172) <br/>(action263=>263) <br/>(action264=>264) <br/>(action265=>265) <br/>(action266=>266) <br/>(cocher173=>173) <br/>(cocher174=>174) <br/>(cocher175=>175) <br/>(action267=>267) <br/>(action268=>268) <br/>(action269=>269) <br/>(action270=>270) <br/>(cocher176=>176) <br/>(cocher177=>177) <br/>) ', ' ', 1, '2023-06-09 13:43:15', '2023-06-09 13:43:15'),
(51, 'Modification du menu : Old infos ((libelle_menu=>Anneesco) <br/>(titre_page=>Anneesco) <br/>)  New infos ((libelle_menu=>Année Scolaire) <br/>(titre_page=>Année Scolaire) <br/>) ', ' ', 1, '2023-06-09 13:44:32', '2023-06-09 13:44:32'),
(52, 'Modification du menu : Old infos ((libelle_menu=>Ajouter une annee) <br/>(titre_page=>Ajout de Anneesco) <br/>)  New infos ((libelle_menu=>Ajouter une année Scolaire) <br/>(titre_page=>Ajout d\'une année Scolaire) <br/>) ', ' ', 1, '2023-06-09 13:44:44', '2023-06-09 13:44:44'),
(53, 'Modification du menu : Old infos ((libelle_menu=>Modifier une annee) <br/>(titre_page=>Modification de Anneesco) <br/>)  New infos ((libelle_menu=>Modifier une année Scolaire) <br/>(titre_page=>Modification d\'une année Scolaire) <br/>) ', ' ', 1, '2023-06-09 13:44:54', '2023-06-09 13:44:54'),
(54, 'Ajout du nouveau anneesco : (annee_debut=>2022) <br/>(annee_fin=>2023) <br/>(statut_annee=>a) <br/>(init_id=>1) <br/>(etablis_id=>1) <br/>(created_at=>2023-06-09T14:49:31.000000Z) <br/>(id_annee=>1) <br/>', ' ', 1, '2023-06-09 13:49:31', '2023-06-09 13:49:31'),
(55, 'Modification anneesco : Old infos ((annee_debut=>2022) <br/>(annee_fin=>2023) <br/>(statut_annee=>a) <br/>)  New infos ((annee_debut=>2021) <br/>(annee_fin=>2022) <br/>(statut_annee=>d) <br/>) ', ' ', 1, '2023-06-09 13:55:56', '2023-06-09 13:55:56'),
(56, 'Modification anneesco : Old infos ((statut_annee=>d) <br/>)  New infos ((statut_annee=>a) <br/>) ', ' ', 1, '2023-06-09 14:00:45', '2023-06-09 14:00:45'),
(57, 'Suppression du menu : (id_menu=>178) <br/>(libelle_menu=>Trimsem) <br/>(titre_page=>Trimsem) <br/>(controler=>TrimsemController) <br/>(route=>trimsem) <br/>(topmenu_id=>19) <br/>(user_id=>1) <br/>(menu_icon=>ri-bill-line) <br/>(num_ordre=>1) <br/>(order_ss=>) <br/>(architecture=>/param/trimsem) <br/>(elmt_menu=>oui) <br/>(created_at=>2023-06-10T09:49:13.000000Z) <br/>', ' ', 1, '2023-06-10 07:52:04', '2023-06-10 07:52:04'),
(58, 'Suppression du menu : (id_menu=>176) <br/>(libelle_menu=>Ajouter une année Scolaire) <br/>(titre_page=>Ajout d\'une année Scolaire) <br/>(controler=>AnneescoController) <br/>(route=>anneesco/create) <br/>(topmenu_id=>175) <br/>(user_id=>1) <br/>(menu_icon=>ri-bill-line) <br/>(num_ordre=>1) <br/>(order_ss=>) <br/>(architecture=>/param/anneesco/create) <br/>(elmt_menu=>non) <br/>(created_at=>2023-06-09T15:40:04.000000Z) <br/>', ' ', 1, '2023-06-10 07:52:10', '2023-06-10 07:52:10'),
(59, 'Suppression du menu : (id_menu=>177) <br/>(libelle_menu=>Modifier une année Scolaire) <br/>(titre_page=>Modification d\'une année Scolaire) <br/>(controler=>AnneescoController) <br/>(route=>anneesco/edit) <br/>(topmenu_id=>175) <br/>(user_id=>1) <br/>(menu_icon=>ri-bill-line) <br/>(num_ordre=>1) <br/>(order_ss=>) <br/>(architecture=>/param/anneesco/edit) <br/>(elmt_menu=>non) <br/>(created_at=>2023-06-09T15:40:04.000000Z) <br/>', ' ', 1, '2023-06-10 07:52:17', '2023-06-10 07:52:17'),
(60, 'Modification du menu : Old infos ((libelle_menu=>Trimsem) <br/>(titre_page=>Trimsem) <br/>)  New infos ((libelle_menu=>Période) <br/>(titre_page=>Période) <br/>) ', ' ', 1, '2023-06-10 07:52:46', '2023-06-10 07:52:46'),
(61, 'Modification du menu : Old infos ((libelle_menu=>Modifier une periode) <br/>(titre_page=>Modification de Trimsem) <br/>)  New infos ((libelle_menu=>Modifier une période) <br/>(titre_page=>Modification d\'une période) <br/>) ', ' ', 1, '2023-06-10 07:53:07', '2023-06-10 07:53:07'),
(62, 'Modification du menu : Old infos ((libelle_menu=>Ajouter une periode) <br/>(titre_page=>Ajout de Trimsem) <br/>)  New infos ((libelle_menu=>Ajouter une période) <br/>(titre_page=>Ajout d\'une période) <br/>) ', ' ', 1, '2023-06-10 07:53:18', '2023-06-10 07:53:18'),
(63, 'Modification du rôle : Old infos ((id_role=>1) <br/>(user_save_id=>1) <br/>(created_at=>2022-06-20T15:10:01.000000Z) <br/>)  New infos ((_token=>7S13EV6tzsB4b6hSxF6TO08X2LqSxHFFpDYEWm9d) <br/>(_method=>PATCH) <br/>(cocher1=>1) <br/>(cocher2=>2) <br/>(cocher4=>4) <br/>(action6=>6) <br/>(action7=>7) <br/>(action8=>8) <br/>(cocher5=>5) <br/>(action9=>9) <br/>(action10=>10) <br/>(action11=>11) <br/>(action12=>12) <br/>(action23=>23) <br/>(cocher6=>6) <br/>(action24=>24) <br/>(cocher7=>7) <br/>(cocher8=>8) <br/>(cocher9=>9) <br/>(cocher10=>10) <br/>(cocher18=>18) <br/>(cocher19=>19) <br/>(action170=>170) <br/>(action210=>210) <br/>(cocher17=>17) <br/>(cocher20=>20) <br/>(cocher24=>24) <br/>(cocher74=>74) <br/>(cocher172=>172) <br/>(action263=>263) <br/>(action264=>264) <br/>(action265=>265) <br/>(action266=>266) <br/>(cocher173=>173) <br/>(cocher174=>174) <br/>(cocher175=>175) <br/>(action267=>267) <br/>(action268=>268) <br/>(action269=>269) <br/>(action270=>270) <br/>(cocher179=>179) <br/>(action275=>275) <br/>(action276=>276) <br/>(action277=>277) <br/>(action278=>278) <br/>(cocher180=>180) <br/>(cocher181=>181) <br/>) ', ' ', 1, '2023-06-10 07:54:23', '2023-06-10 07:54:23'),
(64, 'Ajout du nouveau trimsem : (libelle_trimSem=>1er Trimestre) <br/>(statut_trimSem=>a) <br/>(annee_id=>1) <br/>(init_id=>1) <br/>(created_at=>2023-06-10T09:10:03.000000Z) <br/>(id_trimSem=>1) <br/>', ' ', 1, '2023-06-10 08:10:03', '2023-06-10 08:10:03'),
(65, 'Ajout du nouveau trimsem : (libelle_trimSem=>2iem Trimestre) <br/>(statut_trimSem=>a) <br/>(annee_id=>1) <br/>(init_id=>1) <br/>(created_at=>2023-06-10T09:10:27.000000Z) <br/>(id_trimSem=>2) <br/>', ' ', 1, '2023-06-10 08:10:27', '2023-06-10 08:10:27'),
(66, 'Ajout du nouveau trimsem : (libelle_trimSem=>3iem Trimestre) <br/>(statut_trimSem=>a) <br/>(annee_id=>1) <br/>(init_id=>1) <br/>(created_at=>2023-06-10T09:10:42.000000Z) <br/>(id_trimSem=>3) <br/>', ' ', 1, '2023-06-10 08:10:42', '2023-06-10 08:10:42'),
(67, 'Ajout du nouveau ecole : (nom_eco=>Complexe Scolaire Cours du soutient) <br/>(sigle_eco=>C.S.S.) <br/>(adres_eco=>Akpakpa) <br/>(ville_eco=>Cotonou) <br/>(CodePos_eco=>ZE90909) <br/>(pays_eco=>Bénin) <br/>(tel_eco=>98999009) <br/>(email_eco=>courssoutient@gmail.com) <br/>(directeur_eco=>Père YAROU Jean) <br/>(niveau_educ_eco=>s) <br/>(init_id=>1) <br/>(created_at=>2023-06-10T10:18:00.000000Z) <br/>(id_eco=>2) <br/>', ' ', 1, '2023-06-10 09:18:00', '2023-06-10 09:18:00'),
(68, 'Modification du menu : Old infos ((num_ordre=>1) <br/>)  New infos ((num_ordre=>4) <br/>) ', ' ', 1, '2023-06-10 11:05:47', '2023-06-10 11:05:47'),
(69, 'Modification du menu : Old infos ((num_ordre=>1) <br/>)  New infos ((num_ordre=>13) <br/>) ', ' ', 1, '2023-06-10 11:06:00', '2023-06-10 11:06:00'),
(70, 'Modification du menu : Old infos ((num_ordre=>13) <br/>)  New infos ((num_ordre=>3) <br/>) ', ' ', 1, '2023-06-10 11:06:12', '2023-06-10 11:06:12'),
(71, 'Modification du menu : Old infos ((num_ordre=>1) <br/>)  New infos ((num_ordre=>2) <br/>) ', ' ', 1, '2023-06-10 11:06:26', '2023-06-10 11:06:26'),
(72, 'Modification du menu : ', ' ', 1, '2023-06-10 11:06:45', '2023-06-10 11:06:45'),
(73, 'Modification du rôle : Old infos ((id_role=>1) <br/>(user_save_id=>1) <br/>(created_at=>2022-06-20T15:10:01.000000Z) <br/>)  New infos ((_token=>f8VARLPB2Sczu8uoGOK3HfZjzyR96OQeY0ztrYbp) <br/>(_method=>PATCH) <br/>(cocher1=>1) <br/>(cocher2=>2) <br/>(cocher4=>4) <br/>(action6=>6) <br/>(action7=>7) <br/>(action8=>8) <br/>(cocher5=>5) <br/>(action9=>9) <br/>(action10=>10) <br/>(action11=>11) <br/>(action12=>12) <br/>(action23=>23) <br/>(cocher6=>6) <br/>(action24=>24) <br/>(cocher7=>7) <br/>(cocher8=>8) <br/>(cocher9=>9) <br/>(cocher10=>10) <br/>(cocher18=>18) <br/>(cocher19=>19) <br/>(action170=>170) <br/>(action210=>210) <br/>(cocher17=>17) <br/>(cocher20=>20) <br/>(cocher24=>24) <br/>(cocher74=>74) <br/>(cocher172=>172) <br/>(action263=>263) <br/>(action264=>264) <br/>(action265=>265) <br/>(action266=>266) <br/>(cocher173=>173) <br/>(cocher174=>174) <br/>(cocher175=>175) <br/>(action267=>267) <br/>(action268=>268) <br/>(action269=>269) <br/>(action270=>270) <br/>(cocher184=>184) <br/>(cocher183=>183) <br/>(cocher182=>182) <br/>(action282=>282) <br/>(action281=>281) <br/>(action280=>280) <br/>(action279=>279) <br/>(cocher179=>179) <br/>(action275=>275) <br/>(action276=>276) <br/>(action277=>277) <br/>(action278=>278) <br/>(cocher180=>180) <br/>(cocher181=>181) <br/>) ', ' ', 1, '2023-06-10 11:07:19', '2023-06-10 11:07:19'),
(74, 'Ajout du nouveau classe : (libelle_clas=>6ième) <br/>(annee_id=>1) <br/>(init_id=>1) <br/>(created_at=>2023-06-10T14:06:42.000000Z) <br/>(id_clas=>1) <br/>', ' ', 1, '2023-06-10 13:06:42', '2023-06-10 13:06:42'),
(75, 'Ajout du nouveau classe : (libelle_clas=>5iem) <br/>(annee_id=>1) <br/>(init_id=>1) <br/>(created_at=>2023-06-10T14:06:51.000000Z) <br/>(id_clas=>2) <br/>', ' ', 1, '2023-06-10 13:06:51', '2023-06-10 13:06:51'),
(76, 'Ajout du nouveau classe : (libelle_clas=>4ieme) <br/>(annee_id=>1) <br/>(init_id=>1) <br/>(created_at=>2023-06-10T14:06:59.000000Z) <br/>(id_clas=>3) <br/>', ' ', 1, '2023-06-10 13:06:59', '2023-06-10 13:06:59'),
(77, 'Ajout du nouveau classe : (libelle_clas=>3ieme) <br/>(annee_id=>1) <br/>(init_id=>1) <br/>(created_at=>2023-06-10T14:07:04.000000Z) <br/>(id_clas=>4) <br/>', ' ', 1, '2023-06-10 13:07:04', '2023-06-10 13:07:04'),
(78, 'Modification classe : Old infos ((libelle_clas=>5iem) <br/>)  New infos ((libelle_clas=>5ieme) <br/>) ', ' ', 1, '2023-06-10 13:07:58', '2023-06-10 13:07:58'),
(79, 'Modification du rôle : Old infos ((id_role=>1) <br/>(user_save_id=>1) <br/>(created_at=>2022-06-20T15:10:01.000000Z) <br/>)  New infos ((_token=>hWVPZzA1G6jSxM07ztzHWRq2nEBMFguLLAVJy8aM) <br/>(_method=>PATCH) <br/>(cocher1=>1) <br/>(cocher2=>2) <br/>(cocher4=>4) <br/>(action6=>6) <br/>(action7=>7) <br/>(action8=>8) <br/>(cocher5=>5) <br/>(action9=>9) <br/>(action10=>10) <br/>(action11=>11) <br/>(action12=>12) <br/>(action23=>23) <br/>(cocher6=>6) <br/>(action24=>24) <br/>(cocher7=>7) <br/>(cocher8=>8) <br/>(cocher9=>9) <br/>(cocher10=>10) <br/>(cocher18=>18) <br/>(cocher19=>19) <br/>(action170=>170) <br/>(action210=>210) <br/>(cocher17=>17) <br/>(cocher20=>20) <br/>(cocher24=>24) <br/>(cocher74=>74) <br/>(cocher172=>172) <br/>(action263=>263) <br/>(action264=>264) <br/>(action265=>265) <br/>(action266=>266) <br/>(cocher173=>173) <br/>(cocher174=>174) <br/>(cocher175=>175) <br/>(action267=>267) <br/>(action268=>268) <br/>(action269=>269) <br/>(action270=>270) <br/>(cocher184=>184) <br/>(cocher183=>183) <br/>(cocher182=>182) <br/>(action282=>282) <br/>(action281=>281) <br/>(action280=>280) <br/>(action279=>279) <br/>(cocher179=>179) <br/>(action275=>275) <br/>(action276=>276) <br/>(action277=>277) <br/>(action278=>278) <br/>(cocher180=>180) <br/>(cocher181=>181) <br/>(cocher185=>185) <br/>(action283=>283) <br/>(action284=>284) <br/>(action285=>285) <br/>(action286=>286) <br/>(cocher186=>186) <br/>(cocher187=>187) <br/>) ', ' ', 1, '2023-06-10 13:14:56', '2023-06-10 13:14:56'),
(80, 'Modification du menu : Old infos ((num_ordre=>1) <br/>)  New infos ((num_ordre=>5) <br/>) ', ' ', 1, '2023-06-10 13:15:40', '2023-06-10 13:15:40'),
(81, 'Ajout du nouveau menu : (libelle_menu=>Ajouter une année scolaire) <br/>(titre_page=>Ajouter une année scolaire) <br/>(route=>anneesco/create) <br/>(menu_icon=>ri-bill-line) <br/>(num_ordre=>1) <br/>(topmenu_id=>175) <br/>(architecture=>/param/anneesco/create) <br/>(elmt_menu=>non) <br/>(user_id=>1) <br/>(created_at=>2023-06-10T14:49:15.000000Z) <br/>(id_menu=>188) <br/>', ' ', 1, '2023-06-10 13:49:15', '2023-06-10 13:49:15'),
(82, 'Ajout du nouveau menu : (libelle_menu=>Modifier une année scolaire) <br/>(titre_page=>Modifier une année scolaire) <br/>(route=>anneesco/edit) <br/>(menu_icon=>ri-bill-line) <br/>(num_ordre=>1) <br/>(topmenu_id=>175) <br/>(architecture=>/param/anneesco/edit) <br/>(elmt_menu=>non) <br/>(user_id=>1) <br/>(created_at=>2023-06-10T14:51:03.000000Z) <br/>(id_menu=>189) <br/>', ' ', 1, '2023-06-10 13:51:03', '2023-06-10 13:51:03'),
(83, 'Ajout du nouveau anneesco : (annee_debut=>2023) <br/>(annee_fin=>2024) <br/>(statut_annee=>d) <br/>(init_id=>1) <br/>(etablis_id=>2) <br/>(created_at=>2023-06-10T14:55:57.000000Z) <br/>(id_annee=>2) <br/>', ' ', 1, '2023-06-10 13:55:57', '2023-06-10 13:55:57'),
(84, 'Ajout du nouveau promotion : (libelle_pro=>6ieme - A1) <br/>(class_id=>1) <br/>(init_id=>1) <br/>(created_at=>2023-06-10T15:00:49.000000Z) <br/>(id_pro=>1) <br/>', ' ', 1, '2023-06-10 14:00:49', '2023-06-10 14:00:49'),
(85, 'Ajout du role : (libelle_role=>Administrateur) <br/>(user_save_id=>1) <br/>(created_at=>2023-06-10T15:12:41.000000Z) <br/>(id_role=>15) <br/>', ' ', 1, '2023-06-10 14:12:41', '2023-06-10 14:12:41'),
(86, 'Ajout du nouveau utilisateur : (name=>test) <br/>(prenom=>test) <br/>(tel_user=>test) <br/>(email=>test@gmail.com) <br/>(id_role=>15) <br/>(etablis_id=>1) <br/>(is_active=>1) <br/>(other_infos_user=>) <br/>(id_ini=>1) <br/>(code=>07ee93c8-139c-46a5-abb5-553f1e6a5c73) <br/>(image_profil=>defaut.jpg) <br/>(created_at=>2023-06-10T15:13:09.000000Z) <br/>(id=>20) <br/>', ' ', 1, '2023-06-10 14:13:09', '2023-06-10 14:13:09'),
(87, 'Ajout du nouveau ecole : (nom_eco=>TESTE) <br/>(sigle_eco=>TEST) <br/>(adres_eco=>TEST) <br/>(ville_eco=>TESTE) <br/>(CodePos_eco=>TESTE) <br/>(pays_eco=>TESTE) <br/>(tel_eco=>TEST) <br/>(email_eco=>TEST) <br/>(directeur_eco=>TESTE) <br/>(niveau_educ_eco=>s) <br/>(init_id=>1) <br/>(created_at=>2023-06-10T16:35:37.000000Z) <br/>(id_eco=>3) <br/>', ' ', 1, '2023-06-10 15:35:37', '2023-06-10 15:35:37'),
(88, 'Modification ecole : Old infos ((sigle_eco=>TEST) <br/>(adres_eco=>TEST) <br/>(ville_eco=>TESTE) <br/>(CodePos_eco=>TESTE) <br/>(pays_eco=>TESTE) <br/>(tel_eco=>TEST) <br/>(email_eco=>TEST) <br/>(directeur_eco=>TESTE) <br/>)  New infos ((sigle_eco=>aaaa) <br/>(adres_eco=>aaaaa) <br/>(ville_eco=>aaaaa) <br/>(CodePos_eco=>aaaa) <br/>(pays_eco=>aaaa) <br/>(tel_eco=>aaaa) <br/>(email_eco=>aaaa) <br/>(directeur_eco=>aaaaaa) <br/>) ', ' ', 1, '2023-06-10 15:37:19', '2023-06-10 15:37:19'),
(89, 'Suppression du ecole : (id_eco=>3) <br/>(nom_eco=>TESTE) <br/>(sigle_eco=>aaaa) <br/>(adres_eco=>aaaaa) <br/>(ville_eco=>aaaaa) <br/>(CodePos_eco=>aaaa) <br/>(pays_eco=>aaaa) <br/>(tel_eco=>aaaa) <br/>(email_eco=>aaaa) <br/>(directeur_eco=>aaaaaa) <br/>(niveau_educ_eco=>s) <br/>(init_id=>1) <br/>(created_at=>2023-06-10T16:35:37.000000Z) <br/>', ' ', 1, '2023-06-10 15:37:43', '2023-06-10 15:37:43'),
(90, 'Ajout du nouveau promotion : (libelle_pro=>5ieme - A1) <br/>(class_id=>2) <br/>(init_id=>1) <br/>(created_at=>2023-06-10T16:43:42.000000Z) <br/>(id_pro=>2) <br/>', ' ', 1, '2023-06-10 15:43:42', '2023-06-10 15:43:42'),
(91, 'Modification du rôle : Old infos ((id_role=>15) <br/>(user_save_id=>1) <br/>(created_at=>2023-06-10T15:12:41.000000Z) <br/>)  New infos ((_token=>fmc6d7m8PycL5ySqeS2ZmZ5IzltLzor0kPjITKta) <br/>(_method=>PATCH) <br/>(cocher1=>1) <br/>(cocher2=>2) <br/>(cocher4=>4) <br/>(action6=>6) <br/>(action7=>7) <br/>(action8=>8) <br/>(cocher5=>5) <br/>(action9=>9) <br/>(action10=>10) <br/>(action11=>11) <br/>(action12=>12) <br/>(cocher6=>6) <br/>(action24=>24) <br/>(cocher7=>7) <br/>(cocher8=>8) <br/>(cocher9=>9) <br/>(cocher10=>10) <br/>(cocher18=>18) <br/>(cocher19=>19) <br/>(action170=>170) <br/>(action210=>210) <br/>(cocher17=>17) <br/>(cocher20=>20) <br/>(cocher24=>24) <br/>(cocher74=>74) <br/>(cocher172=>172) <br/>(action265=>265) <br/>(cocher173=>173) <br/>(cocher174=>174) <br/>(cocher175=>175) <br/>(action267=>267) <br/>(action268=>268) <br/>(action269=>269) <br/>(action270=>270) <br/>(cocher184=>184) <br/>(cocher183=>183) <br/>(cocher182=>182) <br/>(action282=>282) <br/>(action281=>281) <br/>(action280=>280) <br/>(action279=>279) <br/>(cocher179=>179) <br/>(action275=>275) <br/>(action276=>276) <br/>(action277=>277) <br/>(action278=>278) <br/>(cocher180=>180) <br/>(cocher181=>181) <br/>(cocher185=>185) <br/>(action283=>283) <br/>(action284=>284) <br/>(action285=>285) <br/>(action286=>286) <br/>(cocher186=>186) <br/>(cocher187=>187) <br/>(cocher188=>188) <br/>(cocher189=>189) <br/>) ', ' ', 1, '2023-06-10 15:45:27', '2023-06-10 15:45:27'),
(92, 'Modification du rôle : Old infos ((id_role=>1) <br/>(user_save_id=>1) <br/>(created_at=>2022-06-20T15:10:01.000000Z) <br/>)  New infos ((_token=>1DEMHJ5cb5Pn2C83UNgh85MklmInqXlNPl3cFqoG) <br/>(_method=>PATCH) <br/>(cocher1=>1) <br/>(cocher2=>2) <br/>(cocher4=>4) <br/>(action6=>6) <br/>(action7=>7) <br/>(action8=>8) <br/>(cocher5=>5) <br/>(action9=>9) <br/>(action10=>10) <br/>(action11=>11) <br/>(action12=>12) <br/>(action23=>23) <br/>(cocher6=>6) <br/>(action24=>24) <br/>(cocher7=>7) <br/>(cocher8=>8) <br/>(cocher9=>9) <br/>(cocher10=>10) <br/>(cocher18=>18) <br/>(cocher19=>19) <br/>(action170=>170) <br/>(action210=>210) <br/>(cocher17=>17) <br/>(cocher20=>20) <br/>(cocher24=>24) <br/>(cocher74=>74) <br/>(cocher172=>172) <br/>(action263=>263) <br/>(action264=>264) <br/>(action265=>265) <br/>(action266=>266) <br/>(cocher173=>173) <br/>(cocher174=>174) <br/>(cocher175=>175) <br/>(action267=>267) <br/>(action268=>268) <br/>(action269=>269) <br/>(action270=>270) <br/>(cocher184=>184) <br/>(cocher183=>183) <br/>(cocher182=>182) <br/>(action282=>282) <br/>(action281=>281) <br/>(action280=>280) <br/>(action279=>279) <br/>(cocher179=>179) <br/>(action275=>275) <br/>(action276=>276) <br/>(action277=>277) <br/>(action278=>278) <br/>(cocher180=>180) <br/>(cocher181=>181) <br/>(cocher185=>185) <br/>(action283=>283) <br/>(action284=>284) <br/>(action285=>285) <br/>(action286=>286) <br/>(cocher186=>186) <br/>(cocher187=>187) <br/>(cocher188=>188) <br/>(cocher189=>189) <br/>(cocher190=>190) <br/>(action287=>287) <br/>(action288=>288) <br/>(action289=>289) <br/>(action290=>290) <br/>(cocher191=>191) <br/>(cocher192=>192) <br/>) ', ' ', 1, '2023-08-20 18:10:57', '2023-08-20 18:10:57'),
(93, 'Ajout du nouveau discipline : (code_disci=>MATHS) <br/>(libelle_disci=>Mathématique) <br/>(ecole_id=>1) <br/>(init_id=>1) <br/>(created_at=>2023-08-20T19:12:51.000000Z) <br/>(id_disci=>1) <br/>', ' ', 1, '2023-08-20 18:12:51', '2023-08-20 18:12:51'),
(94, 'Ajout du nouveau discipline : (code_disci=>HIST-GEO) <br/>(libelle_disci=>Histoire Géographie) <br/>(ecole_id=>1) <br/>(init_id=>1) <br/>(created_at=>2023-08-20T19:13:52.000000Z) <br/>(id_disci=>2) <br/>', ' ', 1, '2023-08-20 18:13:52', '2023-08-20 18:13:52'),
(95, 'Modification discipline : Old infos ((libelle_disci=>Histoire Géographie) <br/>)  New infos ((libelle_disci=>Histoire Géographiess) <br/>) ', ' ', 1, '2023-08-20 18:14:11', '2023-08-20 18:14:11'),
(96, 'Modification discipline : Old infos ((libelle_disci=>Histoire Géographiess) <br/>)  New infos ((libelle_disci=>Histoire Géographie) <br/>) ', ' ', 1, '2023-08-20 18:14:22', '2023-08-20 18:14:22'),
(97, 'Modification du menu : Old infos ((titre_page=>Ajout de Discipline) <br/>)  New infos ((titre_page=>Ajout d\'une Discipline) <br/>) ', ' ', 1, '2023-08-20 18:17:05', '2023-08-20 18:17:05'),
(98, 'Modification du menu : Old infos ((titre_page=>Modification de Discipline) <br/>)  New infos ((titre_page=>Modification d\'une Discipline) <br/>) ', ' ', 1, '2023-08-20 18:17:17', '2023-08-20 18:17:17'),
(99, 'Modification du menu : Old infos ((num_ordre=>1) <br/>)  New infos ((num_ordre=>6) <br/>) ', ' ', 1, '2023-08-20 18:18:10', '2023-08-20 18:18:10'),
(100, 'Modification du rôle : Old infos ((id_role=>1) <br/>(user_save_id=>1) <br/>(created_at=>2022-06-20T15:10:01.000000Z) <br/>)  New infos ((_token=>32Uqr1pB3FAUNjqXs8imY8ot4MrpA6x7jAcUCEU0) <br/>(_method=>PATCH) <br/>(cocher1=>1) <br/>(cocher2=>2) <br/>(cocher4=>4) <br/>(action6=>6) <br/>(action7=>7) <br/>(action8=>8) <br/>(cocher5=>5) <br/>(action9=>9) <br/>(action10=>10) <br/>(action11=>11) <br/>(action12=>12) <br/>(action23=>23) <br/>(cocher6=>6) <br/>(action24=>24) <br/>(cocher7=>7) <br/>(cocher8=>8) <br/>(cocher9=>9) <br/>(cocher10=>10) <br/>(cocher18=>18) <br/>(cocher19=>19) <br/>(action170=>170) <br/>(action210=>210) <br/>(cocher17=>17) <br/>(cocher20=>20) <br/>(cocher24=>24) <br/>(cocher74=>74) <br/>(cocher172=>172) <br/>(action263=>263) <br/>(action264=>264) <br/>(action265=>265) <br/>(action266=>266) <br/>(cocher173=>173) <br/>(cocher174=>174) <br/>(cocher175=>175) <br/>(action267=>267) <br/>(action268=>268) <br/>(action269=>269) <br/>(action270=>270) <br/>(cocher184=>184) <br/>(cocher183=>183) <br/>(cocher182=>182) <br/>(action282=>282) <br/>(action281=>281) <br/>(action280=>280) <br/>(action279=>279) <br/>(cocher179=>179) <br/>(action275=>275) <br/>(action276=>276) <br/>(action277=>277) <br/>(action278=>278) <br/>(cocher180=>180) <br/>(cocher181=>181) <br/>(cocher185=>185) <br/>(action283=>283) <br/>(action284=>284) <br/>(action285=>285) <br/>(action286=>286) <br/>(cocher186=>186) <br/>(cocher187=>187) <br/>(cocher188=>188) <br/>(cocher189=>189) <br/>(cocher190=>190) <br/>(action287=>287) <br/>(action288=>288) <br/>(action289=>289) <br/>(action290=>290) <br/>(cocher191=>191) <br/>(cocher192=>192) <br/>(cocher193=>193) <br/>(action291=>291) <br/>(action292=>292) <br/>(action293=>293) <br/>(action294=>294) <br/>(cocher194=>194) <br/>(cocher195=>195) <br/>) ', ' ', 1, '2023-08-20 18:41:24', '2023-08-20 18:41:24'),
(101, 'Modification du menu : Old infos ((libelle_menu=>Eleve) <br/>(titre_page=>Eleve) <br/>(num_ordre=>1) <br/>)  New infos ((libelle_menu=>Elève) <br/>(titre_page=>Elève) <br/>(num_ordre=>7) <br/>) ', ' ', 1, '2023-08-20 18:43:45', '2023-08-20 18:43:45'),
(102, 'Modification du menu : Old infos ((titre_page=>Ajout de Eleve) <br/>)  New infos ((titre_page=>Ajout d\'un Elève) <br/>) ', ' ', 1, '2023-08-20 18:44:11', '2023-08-20 18:44:11'),
(103, 'Modification du menu : Old infos ((titre_page=>Modification de Eleve) <br/>)  New infos ((titre_page=>Modification d\'un Elève) <br/>) ', ' ', 1, '2023-08-20 18:44:26', '2023-08-20 18:44:26'),
(104, 'Modification du menu : ', ' ', 1, '2023-08-20 18:45:21', '2023-08-20 18:45:21'),
(105, 'Modification du rôle : Old infos ((id_role=>1) <br/>(user_save_id=>1) <br/>(created_at=>2022-06-20T15:10:01.000000Z) <br/>)  New infos ((_token=>YSU0V7cu3lxpvqN8wC1QX1EXmP78Jmnbv39utSlQ) <br/>(_method=>PATCH) <br/>(cocher1=>1) <br/>(cocher2=>2) <br/>(cocher4=>4) <br/>(action6=>6) <br/>(action7=>7) <br/>(action8=>8) <br/>(cocher5=>5) <br/>(action9=>9) <br/>(action10=>10) <br/>(action11=>11) <br/>(action12=>12) <br/>(action23=>23) <br/>(cocher6=>6) <br/>(action24=>24) <br/>(cocher7=>7) <br/>(cocher8=>8) <br/>(cocher9=>9) <br/>(cocher10=>10) <br/>(cocher18=>18) <br/>(cocher19=>19) <br/>(action170=>170) <br/>(action210=>210) <br/>(cocher17=>17) <br/>(cocher20=>20) <br/>(cocher24=>24) <br/>(cocher74=>74) <br/>(cocher172=>172) <br/>(action263=>263) <br/>(action264=>264) <br/>(action265=>265) <br/>(action266=>266) <br/>(cocher173=>173) <br/>(cocher174=>174) <br/>(cocher175=>175) <br/>(action267=>267) <br/>(action268=>268) <br/>(action269=>269) <br/>(action270=>270) <br/>(cocher184=>184) <br/>(cocher183=>183) <br/>(cocher182=>182) <br/>(action282=>282) <br/>(action281=>281) <br/>(action280=>280) <br/>(action279=>279) <br/>(cocher179=>179) <br/>(action275=>275) <br/>(action276=>276) <br/>(action277=>277) <br/>(action278=>278) <br/>(cocher180=>180) <br/>(cocher181=>181) <br/>(cocher185=>185) <br/>(action283=>283) <br/>(action284=>284) <br/>(action285=>285) <br/>(action286=>286) <br/>(cocher186=>186) <br/>(cocher187=>187) <br/>(cocher188=>188) <br/>(cocher189=>189) <br/>(cocher190=>190) <br/>(action287=>287) <br/>(action288=>288) <br/>(action289=>289) <br/>(action290=>290) <br/>(cocher191=>191) <br/>(cocher192=>192) <br/>(cocher193=>193) <br/>(action291=>291) <br/>(action292=>292) <br/>(action293=>293) <br/>(action294=>294) <br/>(cocher194=>194) <br/>(cocher195=>195) <br/>(cocher196=>196) <br/>(action295=>295) <br/>(action296=>296) <br/>(action297=>297) <br/>(action298=>298) <br/>(cocher197=>197) <br/>(cocher198=>198) <br/>) ', ' ', 1, '2023-08-20 19:05:03', '2023-08-20 19:05:03'),
(106, 'Modification du menu : Old infos ((libelle_menu=>Emploitemp) <br/>(titre_page=>Emploitemp) <br/>(num_ordre=>1) <br/>)  New infos ((libelle_menu=>Emploi du temps) <br/>(titre_page=>Emploi du temps) <br/>(num_ordre=>8) <br/>) ', ' ', 1, '2023-08-20 19:07:19', '2023-08-20 19:07:19'),
(107, 'Modification du menu : Old infos ((titre_page=>Ajout de Emploitemp) <br/>)  New infos ((titre_page=>Ajout d\'un emploi temps) <br/>) ', ' ', 1, '2023-08-20 19:22:41', '2023-08-20 19:22:41'),
(108, 'Modification du menu : Old infos ((titre_page=>Modification de Emploitemp) <br/>)  New infos ((titre_page=>Modification d\'un emploi temps) <br/>) ', ' ', 1, '2023-08-20 19:23:00', '2023-08-20 19:23:00'),
(109, 'Ajout du nouveau emploi de temps : (heure_debut=>12:00) <br/>(heure_fin=>13:00) <br/>(jour_semaine=>3) <br/>(discipline_id=>1) <br/>(promotion_id=>1) <br/>(annee_id=>1) <br/>(prof_id=>20) <br/>(init_id=>1) <br/>(created_at=>2023-08-22T14:17:37.000000Z) <br/>(id_empl=>1) <br/>', ' ', 1, '2023-08-22 13:17:38', '2023-08-22 13:17:38'),
(110, 'Modification emploitemp : Old infos ((jour_semaine=>3) <br/>)  New infos ((jour_semaine=>5) <br/>) ', ' ', 1, '2023-08-22 13:18:50', '2023-08-22 13:18:50'),
(111, 'Ajout du role : (libelle_role=>Professeur) <br/>(user_save_id=>1) <br/>(created_at=>2023-08-22T19:20:28.000000Z) <br/>(id_role=>16) <br/>', ' ', 1, '2023-08-22 18:20:28', '2023-08-22 18:20:28'),
(112, 'Ajout du nouveau emploi de temps : (heure_debut=>17:00) <br/>(heure_fin=>20:00) <br/>(jour_semaine=>2) <br/>(discipline_id=>2) <br/>(promotion_id=>2) <br/>(annee_id=>1) <br/>(prof_id=>20) <br/>(init_id=>1) <br/>(created_at=>2023-08-22T19:23:01.000000Z) <br/>(id_empl=>2) <br/>', ' ', 1, '2023-08-22 18:23:01', '2023-08-22 18:23:01'),
(113, 'Ajout du nouveau menu : (libelle_menu=>Faire un appel) <br/>(titre_page=>Faire un appel) <br/>(route=>appel) <br/>(menu_icon=>ri-file-list-2-line) <br/>(num_ordre=>3) <br/>(topmenu_id=>) <br/>(architecture=>/appel) <br/>(elmt_menu=>oui) <br/>(user_id=>1) <br/>(created_at=>2023-08-22T19:39:07.000000Z) <br/>(id_menu=>199) <br/>', ' ', 1, '2023-08-22 18:39:07', '2023-08-22 18:39:07'),
(114, 'Modification du menu : Old infos ((topmenu_id=>) <br/>)  New infos ((topmenu_id=>0) <br/>) ', ' ', 1, '2023-08-22 18:39:19', '2023-08-22 18:39:19'),
(115, 'Modification du menu : Old infos ((libelle_menu=>Frequenter) <br/>(titre_page=>Frequenter) <br/>(num_ordre=>1) <br/>)  New infos ((libelle_menu=>Liste des élèves par promotion) <br/>(titre_page=>Liste des élèves par promotion) <br/>(num_ordre=>10) <br/>) ', ' ', 1, '2023-08-22 18:57:39', '2023-08-22 18:57:39'),
(116, 'Modification du rôle : Old infos ((id_role=>1) <br/>(user_save_id=>1) <br/>(created_at=>2022-06-20T15:10:01.000000Z) <br/>)  New infos ((_token=>9OQnAKYT8KrXAKqgDMJWsPchsyRFNXsA8XixxVat) <br/>(_method=>PATCH) <br/>(cocher1=>1) <br/>(cocher2=>2) <br/>(cocher4=>4) <br/>(action6=>6) <br/>(action7=>7) <br/>(action8=>8) <br/>(cocher5=>5) <br/>(action9=>9) <br/>(action10=>10) <br/>(action11=>11) <br/>(action12=>12) <br/>(action23=>23) <br/>(cocher6=>6) <br/>(action24=>24) <br/>(cocher7=>7) <br/>(cocher8=>8) <br/>(cocher9=>9) <br/>(cocher10=>10) <br/>(cocher18=>18) <br/>(cocher19=>19) <br/>(action170=>170) <br/>(action210=>210) <br/>(cocher17=>17) <br/>(cocher20=>20) <br/>(cocher24=>24) <br/>(cocher74=>74) <br/>(cocher172=>172) <br/>(action263=>263) <br/>(action264=>264) <br/>(action265=>265) <br/>(action266=>266) <br/>(cocher173=>173) <br/>(cocher174=>174) <br/>(cocher175=>175) <br/>(action267=>267) <br/>(action268=>268) <br/>(action269=>269) <br/>(action270=>270) <br/>(cocher184=>184) <br/>(cocher183=>183) <br/>(cocher182=>182) <br/>(action282=>282) <br/>(action281=>281) <br/>(action280=>280) <br/>(action279=>279) <br/>(cocher179=>179) <br/>(action275=>275) <br/>(action276=>276) <br/>(action277=>277) <br/>(action278=>278) <br/>(cocher180=>180) <br/>(cocher181=>181) <br/>(cocher185=>185) <br/>(action283=>283) <br/>(action284=>284) <br/>(action285=>285) <br/>(action286=>286) <br/>(cocher186=>186) <br/>(cocher187=>187) <br/>(cocher188=>188) <br/>(cocher189=>189) <br/>(cocher190=>190) <br/>(action287=>287) <br/>(action288=>288) <br/>(action289=>289) <br/>(action290=>290) <br/>(cocher191=>191) <br/>(cocher192=>192) <br/>(cocher193=>193) <br/>(action291=>291) <br/>(action292=>292) <br/>(action293=>293) <br/>(action294=>294) <br/>(cocher194=>194) <br/>(cocher195=>195) <br/>(cocher196=>196) <br/>(action295=>295) <br/>(action296=>296) <br/>(action297=>297) <br/>(action298=>298) <br/>(cocher197=>197) <br/>(cocher198=>198) <br/>(cocher199=>199) <br/>(cocher200=>200) <br/>(action299=>299) <br/>(action300=>300) <br/>(action301=>301) <br/>(action302=>302) <br/>(cocher201=>201) <br/>(cocher202=>202) <br/>) ', ' ', 1, '2023-08-22 18:58:00', '2023-08-22 18:58:00'),
(117, 'Modification du menu : Old infos ((architecture=>/param/frequenter/edit) <br/>)  New infos ((architecture=>/cons/frequenter/edit) <br/>) ', ' ', 1, '2023-08-22 19:01:56', '2023-08-22 19:01:56'),
(118, 'Modification du menu : Old infos ((architecture=>/param/frequenter/create) <br/>)  New infos ((architecture=>/cons/frequenter/create) <br/>) ', ' ', 1, '2023-08-22 19:02:03', '2023-08-22 19:02:03'),
(119, 'Modification du menu : Old infos ((elmt_menu=>non) <br/>)  New infos ((elmt_menu=>oui) <br/>) ', ' ', 1, '2023-08-22 19:02:29', '2023-08-22 19:02:29'),
(120, 'Modification du menu : Old infos ((architecture=>/param/frequenter) <br/>)  New infos ((architecture=>/cons/frequenter) <br/>) ', ' ', 1, '2023-08-22 19:03:03', '2023-08-22 19:03:03'),
(121, 'Modification du menu : ', ' ', 1, '2023-08-22 19:03:25', '2023-08-22 19:03:25'),
(122, 'Modification du menu : Old infos ((topmenu_id=>19) <br/>)  New infos ((topmenu_id=>24) <br/>) ', ' ', 1, '2023-08-22 19:05:08', '2023-08-22 19:05:08'),
(123, 'Modification du menu : Old infos ((libelle_menu=>Liste des élèves par promotion) <br/>(titre_page=>Liste des élèves par promotion) <br/>)  New infos ((libelle_menu=>Elèves par promotion) <br/>(titre_page=>Elèves par promotion) <br/>) ', ' ', 1, '2023-08-22 19:05:25', '2023-08-22 19:05:25'),
(124, 'Ajout du nouveau eleve : (nom_el=>ALLADAYE) <br/>(prenom_el=>Eric) <br/>(matricule_el=>233232) <br/>(date_nais_el=>2000-08-08) <br/>(sexe_el=>F) <br/>(photo_el=>phpEB1A.tmp.jpeg) <br/>(tuteur_el=>TOHON Richard) <br/>(email_el=>richardtohon@gmail.com) <br/>(tel_el=>89898989) <br/>(ecole_id=>1) <br/>(init_id=>1) <br/>(created_at=>2023-08-22T20:13:17.000000Z) <br/>(id_el=>1) <br/>', ' ', 1, '2023-08-22 19:13:17', '2023-08-22 19:13:17'),
(125, 'Ajout du nouveau frequenter : (eleve_id=>1) <br/>(promotion_id=>1) <br/>(created_at=>2023-08-22T20:15:08.000000Z) <br/>(id_freq=>1) <br/>', ' ', 1, '2023-08-22 19:15:08', '2023-08-22 19:15:08'),
(126, 'Modification du rôle : Old infos ((id_role=>15) <br/>(user_save_id=>1) <br/>(created_at=>2023-06-10T15:12:41.000000Z) <br/>)  New infos ((_token=>IoIyllMUAcfCdbsJlB2na9BRv4v5u49YzyhOjuBc) <br/>(_method=>PATCH) <br/>(cocher1=>1) <br/>(cocher2=>2) <br/>(cocher5=>5) <br/>(action9=>9) <br/>(action10=>10) <br/>(action11=>11) <br/>(action12=>12) <br/>(cocher6=>6) <br/>(action24=>24) <br/>(cocher7=>7) <br/>(cocher8=>8) <br/>(cocher9=>9) <br/>(cocher10=>10) <br/>(cocher18=>18) <br/>(cocher19=>19) <br/>(action170=>170) <br/>(action210=>210) <br/>(cocher17=>17) <br/>(cocher20=>20) <br/>(cocher24=>24) <br/>(cocher74=>74) <br/>(cocher172=>172) <br/>(action265=>265) <br/>(cocher173=>173) <br/>(cocher174=>174) <br/>(cocher175=>175) <br/>(action267=>267) <br/>(action268=>268) <br/>(action269=>269) <br/>(action270=>270) <br/>(cocher184=>184) <br/>(cocher183=>183) <br/>(cocher182=>182) <br/>(action282=>282) <br/>(action281=>281) <br/>(action280=>280) <br/>(action279=>279) <br/>(cocher179=>179) <br/>(action275=>275) <br/>(action276=>276) <br/>(action277=>277) <br/>(action278=>278) <br/>(cocher180=>180) <br/>(cocher181=>181) <br/>(cocher185=>185) <br/>(action283=>283) <br/>(action284=>284) <br/>(action285=>285) <br/>(action286=>286) <br/>(cocher186=>186) <br/>(cocher187=>187) <br/>(cocher188=>188) <br/>(cocher189=>189) <br/>(cocher190=>190) <br/>(action287=>287) <br/>(action288=>288) <br/>(action289=>289) <br/>(action290=>290) <br/>(cocher191=>191) <br/>(cocher192=>192) <br/>(cocher193=>193) <br/>(action291=>291) <br/>(action292=>292) <br/>(action293=>293) <br/>(action294=>294) <br/>(cocher194=>194) <br/>(cocher195=>195) <br/>(cocher196=>196) <br/>(action295=>295) <br/>(action296=>296) <br/>(action297=>297) <br/>(action298=>298) <br/>(cocher197=>197) <br/>(cocher198=>198) <br/>(cocher199=>199) <br/>(cocher200=>200) <br/>(action299=>299) <br/>(action300=>300) <br/>(action301=>301) <br/>(action302=>302) <br/>(cocher201=>201) <br/>(cocher202=>202) <br/>) ', ' ', 1, '2023-08-22 19:19:22', '2023-08-22 19:19:22');

-- --------------------------------------------------------

--
-- Structure de la table `etbs_societe`
--

DROP TABLE IF EXISTS `etbs_societe`;
CREATE TABLE IF NOT EXISTS `etbs_societe` (
  `id_societe` int(2) NOT NULL,
  `nom_soc` varchar(255) DEFAULT NULL,
  `contact_soc` varchar(50) DEFAULT NULL,
  `mail_soc` varchar(100) DEFAULT NULL,
  `adres_soc` longtext,
  `logo_soc` varchar(255) DEFAULT NULL,
  `pdf_aide` varchar(255) DEFAULT NULL,
  `pied_page_soc` longtext,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `etbs_societe`
--

INSERT INTO `etbs_societe` (`id_societe`, `nom_soc`, `contact_soc`, `mail_soc`, `adres_soc`, `logo_soc`, `pdf_aide`, `pied_page_soc`, `created_at`, `updated_at`) VALUES
(1, 'GIWU-SOFT', '(229) 95 xx xx xx', 'giwudev@gmail.com', 'Cotonou - Bénin', 'Logo-2022-12-30-075100.jpeg', 'Aide-2022-11-22-025901.pdf', NULL, NULL, '2022-12-30 18:51:00');

-- --------------------------------------------------------

--
-- Structure de la table `etbs_trim_sem`
--

DROP TABLE IF EXISTS `etbs_trim_sem`;
CREATE TABLE IF NOT EXISTS `etbs_trim_sem` (
  `id_trimSem` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `libelle_trimSem` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `statut_trimSem` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee_id` bigint(20) UNSIGNED NOT NULL,
  `init_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_trimSem`),
  KEY `etbs_trim_sem_annee_id_foreign` (`annee_id`),
  KEY `etbs_trim_sem_init_id_foreign` (`init_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etbs_trim_sem`
--

INSERT INTO `etbs_trim_sem` (`id_trimSem`, `libelle_trimSem`, `statut_trimSem`, `annee_id`, `init_id`, `created_at`, `updated_at`) VALUES
(1, '1er Trimestre', 'a', 1, 1, '2023-06-10 08:10:03', '2023-06-10 08:10:03'),
(2, '2iem Trimestre', 'a', 1, 1, '2023-06-10 08:10:27', '2023-06-10 08:10:27'),
(3, '3iem Trimestre', 'a', 1, 1, '2023-06-10 08:10:42', '2023-06-10 08:10:42');

-- --------------------------------------------------------

--
-- Structure de la table `etbs_users`
--

DROP TABLE IF EXISTS `etbs_users`;
CREATE TABLE IF NOT EXISTS `etbs_users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_infos_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_ini` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `etablis_id` int(11) NOT NULL,
  `image_profil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `init_id` bigint(20) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_init_id_foreign` (`init_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `etbs_users`
--

INSERT INTO `etbs_users` (`id`, `code`, `name`, `prenom`, `email`, `email_verified_at`, `password`, `remember_token`, `tel_user`, `other_infos_user`, `id_ini`, `id_role`, `etablis_id`, `image_profil`, `is_active`, `created_at`, `updated_at`, `init_id`) VALUES
(1, 'a40d4493-c471-462e-80ed-2bcdd2365c09', 'GIWU', 'Richard123', 'richardtohon@gmail.com', NULL, '$2y$10$6QUE1GIJXGAd1NmEZtXAie/zMMih2hdA1RSKLhVJ6W8kjs04LU5AW', NULL, '956617', 'test', 1, 1, 1, 'php1627.tmp.png', 1, '2022-06-20 14:06:09', '2022-12-30 18:51:25', NULL),
(20, '07ee93c8-139c-46a5-abb5-553f1e6a5c73', 'test', 'test', 'test@gmail.com', NULL, '$2y$10$pi5KqYRhJuK4C8Emx5xu9.tEveBprhww2KDYA6kg.cbCO7eGdssvS', NULL, 'test', NULL, 1, 15, 1, 'defaut.jpg', 1, '2023-06-10 14:13:09', '2023-06-10 14:13:09', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

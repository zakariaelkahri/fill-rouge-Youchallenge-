-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3308
-- Generation Time: Apr 28, 2025 at 01:44 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `youchalleng`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `id` bigint UNSIGNED NOT NULL,
  `team1_id` int NOT NULL,
  `team2_id` int NOT NULL,
  `winner_team` int DEFAULT NULL,
  `loser_team` int DEFAULT NULL,
  `status` enum('not_started','started','finished') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not_started',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `round_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_03_15_152340_create_roles_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2025_03_15_152411_create_permissions_table', 1),
(7, '2025_03_15_152653_create_permission_role_table', 1),
(8, '2025_03_20_104519_create_organisators_table', 1),
(9, '2025_03_20_104548_create_participants_table', 1),
(10, '2025_03_20_221313_create_role_user_table', 1),
(11, '2025_04_08_133748_create_tournaments_table', 1),
(12, '2025_04_08_222723_create_teams_table', 1),
(13, '2025_04_10_105444_add_is_validated_to_tournaments_table', 1),
(14, '2025_04_12_204859_add_participanted_teams_to_tournaments', 1),
(15, '2025_04_13_223643_create_participant_team_table', 1),
(16, '2025_04_13_225046_add_validation_code_to_teams', 1),
(17, '2025_04_14_101541_add_team_bio_to_teams', 1),
(18, '2025_04_18_095228_create_matches_table', 1),
(19, '2025_04_18_102900_create_rounds_table', 1),
(20, '2025_04_18_140700_create_resaults_table', 1),
(21, '2025_04_18_140837_create_rankings_table', 1),
(22, '2025_04_18_144911_create_round_team_table', 1),
(23, '2025_04_19_183904_add_eliminated_to_teams', 1),
(24, '2025_04_20_163354_add_round_id_to_matches', 1),
(25, '2025_04_20_223008_add_tournament_id_to_rounds', 1);

-- --------------------------------------------------------

--
-- Table structure for table `organisators`
--

CREATE TABLE `organisators` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organisators`
--

INSERT INTO `organisators` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, '2025-04-24 12:24:55', '2025-04-24 12:24:55'),
(2, 3, '2025-04-24 12:24:55', '2025-04-24 12:24:55'),
(3, 20, '2025-04-26 14:19:00', '2025-04-26 14:19:00');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 4, '2025-04-24 12:24:55', '2025-04-24 12:24:55'),
(2, 5, '2025-04-24 12:24:55', '2025-04-24 12:24:55'),
(3, 6, '2025-04-24 12:24:55', '2025-04-24 12:24:55'),
(4, 7, '2025-04-24 12:24:55', '2025-04-24 12:24:55'),
(5, 8, '2025-04-24 12:24:55', '2025-04-24 12:24:55'),
(6, 9, '2025-04-24 12:24:55', '2025-04-24 12:24:55'),
(7, 10, '2025-04-24 12:24:55', '2025-04-24 12:24:55'),
(8, 11, '2025-04-24 12:24:55', '2025-04-24 12:24:55'),
(9, 12, '2025-04-24 12:24:55', '2025-04-24 12:24:55'),
(10, 13, '2025-04-24 12:24:55', '2025-04-24 12:24:55'),
(11, 14, '2025-04-24 12:24:55', '2025-04-24 12:24:55'),
(12, 15, '2025-04-24 12:24:55', '2025-04-24 12:24:55'),
(13, 16, '2025-04-24 12:24:55', '2025-04-24 12:24:55'),
(14, 17, '2025-04-24 12:24:55', '2025-04-24 12:24:55'),
(15, 18, '2025-04-24 12:24:55', '2025-04-24 12:24:55'),
(16, 19, '2025-04-24 12:24:55', '2025-04-24 12:24:55');

-- --------------------------------------------------------

--
-- Table structure for table `participant_team`
--

CREATE TABLE `participant_team` (
  `id` bigint UNSIGNED NOT NULL,
  `participant_id` bigint UNSIGNED NOT NULL,
  `team_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `participant_team`
--

INSERT INTO `participant_team` (`id`, `participant_id`, `team_id`, `created_at`, `updated_at`) VALUES
(6, 4, 2, NULL, NULL),
(9, 3, 5, NULL, NULL),
(13, 6, 8, NULL, NULL),
(15, 1, 10, NULL, NULL),
(16, 2, 11, NULL, NULL),
(17, 3, 12, NULL, NULL),
(18, 4, 13, NULL, NULL),
(19, 5, 14, NULL, NULL),
(20, 6, 15, NULL, NULL),
(22, 7, 17, NULL, NULL),
(23, 8, 18, NULL, NULL),
(24, 8, 19, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'manage_users', '2025-04-24 12:24:53', '2025-04-24 12:24:53'),
(2, 'manage_tournaments', '2025-04-24 12:24:53', '2025-04-24 12:24:53'),
(3, 'manage_teams', '2025-04-24 12:24:53', '2025-04-24 12:24:53'),
(4, 'manage_Players', '2025-04-24 12:24:53', '2025-04-24 12:24:53'),
(5, 'manage_matches', '2025-04-24 12:24:53', '2025-04-24 12:24:53'),
(6, 'manage_settings', '2025-04-24 12:24:53', '2025-04-24 12:24:53'),
(7, 'create_tournament', '2025-04-24 12:24:53', '2025-04-24 12:24:53'),
(8, 'update_tournament', '2025-04-24 12:24:53', '2025-04-24 12:24:53'),
(9, 'delete_tournament', '2025-04-24 12:24:53', '2025-04-24 12:24:53'),
(10, 'manage_team', '2025-04-24 12:24:53', '2025-04-24 12:24:53'),
(11, 'submit_results', '2025-04-24 12:24:53', '2025-04-24 12:24:53'),
(12, 'view_tournaments', '2025-04-24 12:24:53', '2025-04-24 12:24:53'),
(13, 'view_matches', '2025-04-24 12:24:53', '2025-04-24 12:24:53'),
(14, 'participate', '2025-04-24 12:24:53', '2025-04-24 12:24:53'),
(15, 'view_rankings', '2025-04-24 12:24:53', '2025-04-24 12:24:53');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `permission_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(4, 1, 4, NULL, NULL),
(5, 1, 5, NULL, NULL),
(6, 1, 6, NULL, NULL),
(7, 2, 3, NULL, NULL),
(8, 2, 4, NULL, NULL),
(9, 2, 5, NULL, NULL),
(10, 2, 7, NULL, NULL),
(11, 2, 8, NULL, NULL),
(12, 2, 9, NULL, NULL),
(13, 2, 10, NULL, NULL),
(14, 2, 11, NULL, NULL),
(15, 3, 12, NULL, NULL),
(16, 3, 13, NULL, NULL),
(17, 3, 14, NULL, NULL),
(18, 3, 15, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rankings`
--

CREATE TABLE `rankings` (
  `id` bigint UNSIGNED NOT NULL,
  `team_id` bigint UNSIGNED NOT NULL,
  `points` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resaults`
--

CREATE TABLE `resaults` (
  `id` bigint UNSIGNED NOT NULL,
  `match_id` bigint UNSIGNED NOT NULL,
  `score_team1` int NOT NULL,
  `score_team2` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2025-04-24 12:24:53', '2025-04-24 12:24:53'),
(2, 'organizator', '2025-04-24 12:24:53', '2025-04-24 12:24:53'),
(3, 'participant', '2025-04-24 12:24:53', '2025-04-24 12:24:53');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 2, 3, NULL, NULL),
(4, 3, 4, NULL, NULL),
(5, 3, 5, NULL, NULL),
(6, 3, 6, NULL, NULL),
(7, 3, 7, NULL, NULL),
(8, 3, 8, NULL, NULL),
(9, 3, 9, NULL, NULL),
(10, 3, 10, NULL, NULL),
(11, 3, 11, NULL, NULL),
(12, 3, 12, NULL, NULL),
(13, 3, 13, NULL, NULL),
(14, 3, 14, NULL, NULL),
(15, 3, 15, NULL, NULL),
(16, 3, 16, NULL, NULL),
(17, 3, 17, NULL, NULL),
(18, 3, 18, NULL, NULL),
(19, 3, 19, NULL, NULL),
(20, 2, 20, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rounds`
--

CREATE TABLE `rounds` (
  `id` bigint UNSIGNED NOT NULL,
  `round` int NOT NULL DEFAULT '1',
  `status` enum('not_started','finished') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not_started',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tournament_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `round_team`
--

CREATE TABLE `round_team` (
  `id` bigint UNSIGNED NOT NULL,
  `team_id` bigint UNSIGNED NOT NULL,
  `round_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint UNSIGNED NOT NULL,
  `tournament_id` bigint UNSIGNED NOT NULL,
  `team_captain` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `team_bio` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `participated_members` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `invitation_code` bigint NOT NULL,
  `eliminated` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `tournament_id`, `team_captain`, `name`, `photo`, `team_bio`, `participated_members`, `created_at`, `updated_at`, `invitation_code`, `eliminated`) VALUES
(2, 1, 3, 'Timon Mclean', 'teams_photo/2_1745502241.jpg', 'Inventore suscipit d', 1, '2025-04-24 12:44:01', '2025-04-24 23:21:17', 349775, 0),
(5, 1, 3, 'Vivien Mckee', NULL, 'Id commodi rerum op', 1, '2025-04-24 14:48:24', '2025-04-24 14:48:24', 959341, 0),
(8, 1, 6, 'Felix James', 'teams_photo/8_1745569010.jpg', 'Labore nulla sed vol', 1, '2025-04-25 07:16:50', '2025-04-25 07:16:50', 522105, 0),
(10, 2, 1, 'Yael Espinoza', NULL, 'Soluta dolor reicien', 1, '2025-04-25 09:11:18', '2025-04-25 10:13:58', 455652, 0),
(11, 2, 2, 'Channing Pratt', 'teams_photo/11_1745576028.jpg', 'Ducimus pariatur B', 1, '2025-04-25 09:13:48', '2025-04-25 10:13:58', 414680, 0),
(12, 2, 3, 'Octavia Fox', NULL, 'Possimus cum quam m', 1, '2025-04-25 09:14:18', '2025-04-25 09:47:21', 670509, 0),
(13, 2, 4, 'Cassidy Atkinson', NULL, 'Dolores nobis volupt', 1, '2025-04-25 09:15:31', '2025-04-25 09:46:06', 721729, 0),
(14, 2, 5, 'Quentin Johnson', NULL, 'Reprehenderit non a', 1, '2025-04-25 09:16:12', '2025-04-25 10:13:58', 161497, 0),
(15, 2, 6, 'Phyllis Mcpherson', NULL, 'Est rerum labore su', 1, '2025-04-25 09:16:46', '2025-04-25 10:13:59', 674970, 0),
(17, 2, 7, 'Keaton Garcia', NULL, 'Officia quia quis nu', 1, '2025-04-25 09:18:35', '2025-04-25 09:18:35', 145157, 0),
(18, 2, 8, 'Dustin Elliott', NULL, 'Consequuntur cupidit', 1, '2025-04-25 09:19:17', '2025-04-25 09:46:57', 876837, 0),
(19, 1, 8, 'Roary Bennett', 'teams_photo/19_1745590181.jpg', 'Ut sed iste harum es', 1, '2025-04-25 13:09:41', '2025-04-25 13:09:41', 481939, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tournaments`
--

CREATE TABLE `tournaments` (
  `id` bigint UNSIGNED NOT NULL,
  `organisator_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `format` enum('FC25','VALORANT','CSGO','eFOOTBALL') COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_participants` enum('8','16','32') COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_mode` int NOT NULL DEFAULT '1',
  `particpated_teams` int NOT NULL DEFAULT '0',
  `reward` text COLLATE utf8mb4_unicode_ci,
  `rules` text COLLATE utf8mb4_unicode_ci,
  `status` enum('upcoming','ongoing','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'upcoming',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `is_validated` tinyint(1) NOT NULL DEFAULT '0',
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tournaments`
--

INSERT INTO `tournaments` (`id`, `organisator_id`, `name`, `photo`, `format`, `max_participants`, `team_mode`, `particpated_teams`, `reward`, `rules`, `status`, `deleted`, `is_validated`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 2, 'Aladdin Mccarthy', 'tournament_photos/1_1745501175.jpg', 'VALORANT', '8', 4, 4, 'Eu magna aut dolor c', 'Reiciendis perspicia', 'upcoming', 0, 1, '1992-03-15 09:13:00', NULL, '2025-04-24 12:26:15', '2025-04-25 13:09:41'),
(2, 1, 'Harriet Waters', 'tournament_photos/2_1745569211.jpg', 'FC25', '8', 1, 8, 'Irure rerum pariatur', 'Voluptas enim offici', 'upcoming', 0, 1, '1989-04-14 15:08:00', NULL, '2025-04-25 07:20:11', '2025-04-26 12:52:16'),
(3, 1, 'Eagan Simon', 'tournament_photos/3_1745679616.jpg', 'VALORANT', '32', 4, 0, 'Quam qui consectetur', 'Qui quis sint in at', 'upcoming', 0, 1, '2020-03-01 17:09:00', NULL, '2025-04-26 13:28:33', '2025-04-26 14:00:16'),
(4, 1, 'Sigourney Ferrell', NULL, 'CSGO', '16', 2, 0, 'Non enim quia at off', 'Aperiam provident a', 'upcoming', 0, 0, '1992-04-07 17:38:00', NULL, '2025-04-26 15:38:32', '2025-04-26 15:38:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `status`, `password`, `photo`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'zakaria', 'zakaria@gmail.com', '2025-04-24 12:24:53', 'active', '$2y$10$ySPkzCABRU.ZkQr9RflKxuGqh8r7S5K6.O5SEo2bvaUnWcpF7YZWS', NULL, NULL, '2025-04-24 12:24:53', '2025-04-24 12:24:53'),
(2, 'Organisator 1', 'organisator1@example.com', '2025-04-24 12:24:53', 'active', '$2y$10$vWnZFEoylse4jRdQvOk13eu4c4ngC6nxAaK8ACDJ4/ZFW9EAUVVpW', NULL, 'zDmcd9Yo3SD2pLGWY99x5x17XxqkjEVoE50oyzUXzssMoLeZAZv77fDaJJOv', '2025-04-24 12:24:53', '2025-04-24 12:24:53'),
(3, 'Organisator 2', 'organisator2@example.com', '2025-04-24 12:24:53', 'active', '$2y$10$yMu/KqBr.Ni3IIoLo5LIwOBt4pqxxMy7u/uXfckYSEzvqUW/8atOG', NULL, 'k8MmF1Z9RL816R7q3AW222nD9HfRck3UcDLdpP9RmqgIGrYJgOun6CLdk8et', '2025-04-24 12:24:53', '2025-04-24 12:24:53'),
(4, 'Participant 1', 'participant1@example.com', '2025-04-24 12:24:53', 'active', '$2y$10$4MqmHwmFPKtUj8ceUewX6..ItzHY1saTdf/EK53.Yz33M6Qe5mgkm', NULL, 'Pe3bBT4TWKEKXLe0pIfNq1tcMY8yiWcC5THaKmQsWpBDv7bnwp2S3SNosd0f', '2025-04-24 12:24:53', '2025-04-24 12:24:53'),
(5, 'Participant 2', 'participant2@example.com', '2025-04-24 12:24:54', 'active', '$2y$10$60CpfMAQmV2oHvb.SmrsVuOO7Hh8qmyQkDxVSmUj1wTKBZkkf//Pm', NULL, 'B1KI9VWg76O1YZ8k4ZkpZTZ96jhDZia4x7Orz27tq8pnzGkgdCfknyyESZ4i', '2025-04-24 12:24:54', '2025-04-24 12:24:54'),
(6, 'Participant 3', 'participant3@example.com', '2025-04-24 12:24:54', 'active', '$2y$10$v637zBDeE20DW1/s8wSJP.4TeXhJU2TkkxwrsE8R0zJ3kBWdb/Uri', NULL, 'NE05nZgO7LtMHDfBnJGwwD1hPTfL1iy0XFEqzKQJL8dVmd59MYyTacQuPCKC', '2025-04-24 12:24:54', '2025-04-24 12:24:54'),
(7, 'Participant 4', 'participant4@example.com', '2025-04-24 12:24:54', 'active', '$2y$10$Dfv./dGewO8Aclo406XZPuwoEzRFbhYQccISFQukwqAIxvYuEh55W', NULL, 'mECziN8DB24YrXLHzPYmXOfGrhGXcFa4JVZkkX1bGYy6NUFGQ82IMs7jdbcQ', '2025-04-24 12:24:54', '2025-04-24 12:24:54'),
(8, 'Participant 5', 'participant5@example.com', '2025-04-24 12:24:54', 'active', '$2y$10$buNnNxIluxnlA.XkCdIl9eRL/T83awR2Gu78QtoPHyai7Ct/bo7uq', NULL, '5CPimXWM8lCYnl99GnLv29uTXkYl1y6aUDSvV8ShGfp9sC2AnQOIndVnKYRM', '2025-04-24 12:24:54', '2025-04-24 12:24:54'),
(9, 'Participant 6', 'participant6@example.com', '2025-04-24 12:24:54', 'active', '$2y$10$8UQtePI7xtO9ZOUbaeREEOYmSf5ybELn0X09fdj6JtmnZU6hJl7Eu', NULL, 'rbuHv1E2erqW1izP3PDJuLxsnwxFbKnlohpmwWywAgHmLwGidCgXeChKp5qE', '2025-04-24 12:24:54', '2025-04-24 12:24:54'),
(10, 'Participant 7', 'participant7@example.com', '2025-04-24 12:24:54', 'active', '$2y$10$aUc2P8yPz5uP2OwwO7UjFOQ9G2imtEyYVM6EiMJLodJiG1FLaSpb.', NULL, 'exNiCiMQmFSajfwEdCUn2weyt92EY6IElUZQRfu0aJ1bB8LZkuW5STa9kIwt', '2025-04-24 12:24:54', '2025-04-24 12:24:54'),
(11, 'Participant 8', 'participant8@example.com', '2025-04-24 12:24:54', 'active', '$2y$10$8tQjXFdzqcy2FYOySgHkFOdMu0Lpj6cyMrs9/kyqy2.holfqn5mlW', NULL, 'HRplfn6hcTGmRZuaFiW1lsdEMWf7ejYC7k5TXIMkzNsr6jAV3CUuzLnXeyTt', '2025-04-24 12:24:54', '2025-04-24 12:24:54'),
(12, 'Participant 9', 'participant9@example.com', '2025-04-24 12:24:54', 'active', '$2y$10$8f3tsh1.K0vnvMB8adfikeQoSU5JMH.X5t0eTNbmw3jkAEQmM.MxC', NULL, '27IVipPmt8', '2025-04-24 12:24:54', '2025-04-24 12:24:54'),
(13, 'Participant 10', 'participant10@example.com', '2025-04-24 12:24:54', 'active', '$2y$10$Gk92QhtIieV0EUKdWsglmuy3nML1tHYywSL18SivjKTEWqf9QaSmC', NULL, 'G2A7olbm52', '2025-04-24 12:24:54', '2025-04-24 12:24:54'),
(14, 'Participant 11', 'participant11@example.com', '2025-04-24 12:24:54', 'active', '$2y$10$EJ167Gmw5j37j7rK4UDkI.oJCyUkR637VpvF9XBapizlW0kfT.a.G', NULL, 'KMteC6hUAF', '2025-04-24 12:24:54', '2025-04-24 12:24:54'),
(15, 'Participant 12', 'participant12@example.com', '2025-04-24 12:24:54', 'active', '$2y$10$dOToQUGVn3DQspTlRLrDbObfe.w6V4vClpWUhdsGxQzN1J0GJziFu', NULL, 'vHtZIHrv4g', '2025-04-24 12:24:54', '2025-04-24 12:24:54'),
(16, 'Participant 13', 'participant13@example.com', '2025-04-24 12:24:54', 'active', '$2y$10$3zwX2gUN.nnSNdu4CVIZbeaFsDSdHicvCwN.42Tz2eYLtj1/GZEKq', NULL, 'WgoRYKZ4iP', '2025-04-24 12:24:54', '2025-04-24 12:24:54'),
(17, 'Participant 14', 'participant14@example.com', '2025-04-24 12:24:54', 'active', '$2y$10$uTDukunE0ziuBjSpS0AdB./uGLqZXefWY5MazMujeMEVYgvtJt9jK', NULL, 'wJT8WCA7vC', '2025-04-24 12:24:54', '2025-04-24 12:24:54'),
(18, 'Participant 15', 'participant15@example.com', '2025-04-24 12:24:54', 'active', '$2y$10$QNfbQ5TM8n9idh5VO1UOIOVaRy7pi/DkPEhv8I/o1RYi7mtFU.9Ay', NULL, 'aLlWSRTzwO', '2025-04-24 12:24:54', '2025-04-24 12:24:54'),
(19, 'Participant 16', 'participant16@example.com', '2025-04-24 12:24:54', 'active', '$2y$10$CfF2FNpV7krP7wifM4NDbOzgeaENC9AyQRvTekgOfouP7FLsCoKci', NULL, 'EO1kkylWXW', '2025-04-24 12:24:54', '2025-04-24 12:24:54'),
(20, 'Eric Singleton', 'nyrito@mailinator.com', NULL, 'inactive', '$2y$10$VtQ3zhLxDTFBFXtdRvYbm.0vMZQB4Jp8gKO/fNXKHsZmszXykouKW', 'profile_photos/20_1745680740.jpg', NULL, '2025-04-26 14:19:00', '2025-04-26 14:19:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matches_round_id_foreign` (`round_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organisators`
--
ALTER TABLE `organisators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organisators_user_id_foreign` (`user_id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participants_user_id_foreign` (`user_id`);

--
-- Indexes for table `participant_team`
--
ALTER TABLE `participant_team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participant_team_participant_id_foreign` (`participant_id`),
  ADD KEY `participant_team_team_id_foreign` (`team_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rankings`
--
ALTER TABLE `rankings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rankings_team_id_foreign` (`team_id`);

--
-- Indexes for table `resaults`
--
ALTER TABLE `resaults`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resaults_match_id_foreign` (`match_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `rounds`
--
ALTER TABLE `rounds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rounds_tournament_id_foreign` (`tournament_id`);

--
-- Indexes for table `round_team`
--
ALTER TABLE `round_team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `round_team_team_id_foreign` (`team_id`),
  ADD KEY `round_team_round_id_foreign` (`round_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_tournament_id_foreign` (`tournament_id`),
  ADD KEY `teams_team_captain_foreign` (`team_captain`);

--
-- Indexes for table `tournaments`
--
ALTER TABLE `tournaments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tournaments_organisator_id_foreign` (`organisator_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `organisators`
--
ALTER TABLE `organisators`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `participant_team`
--
ALTER TABLE `participant_team`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rankings`
--
ALTER TABLE `rankings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resaults`
--
ALTER TABLE `resaults`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `rounds`
--
ALTER TABLE `rounds`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `round_team`
--
ALTER TABLE `round_team`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tournaments`
--
ALTER TABLE `tournaments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `matches_round_id_foreign` FOREIGN KEY (`round_id`) REFERENCES `rounds` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `organisators`
--
ALTER TABLE `organisators`
  ADD CONSTRAINT `organisators_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `participants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `participant_team`
--
ALTER TABLE `participant_team`
  ADD CONSTRAINT `participant_team_participant_id_foreign` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `participant_team_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rankings`
--
ALTER TABLE `rankings`
  ADD CONSTRAINT `rankings_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `resaults`
--
ALTER TABLE `resaults`
  ADD CONSTRAINT `resaults_match_id_foreign` FOREIGN KEY (`match_id`) REFERENCES `matches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rounds`
--
ALTER TABLE `rounds`
  ADD CONSTRAINT `rounds_tournament_id_foreign` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `round_team`
--
ALTER TABLE `round_team`
  ADD CONSTRAINT `round_team_round_id_foreign` FOREIGN KEY (`round_id`) REFERENCES `rounds` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `round_team_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_team_captain_foreign` FOREIGN KEY (`team_captain`) REFERENCES `participants` (`id`),
  ADD CONSTRAINT `teams_tournament_id_foreign` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`);

--
-- Constraints for table `tournaments`
--
ALTER TABLE `tournaments`
  ADD CONSTRAINT `tournaments_organisator_id_foreign` FOREIGN KEY (`organisator_id`) REFERENCES `organisators` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

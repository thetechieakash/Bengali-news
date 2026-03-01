-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2026 at 08:40 AM
-- Server version: 11.8.3-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u235530863_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `ad_type` enum('image','script') NOT NULL DEFAULT 'image',
  `image` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `script` text DEFAULT NULL,
  `pages` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`pages`)),
  `position` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`position`)),
  `view_count` int(11) NOT NULL DEFAULT 0,
  `click_count` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `title`, `ad_type`, `image`, `url`, `script`, `pages`, `position`, `view_count`, `click_count`, `status`, `created_at`, `updated_at`) VALUES
(3, 'top 1 ', 'image', '1771621068_a40a8518810834894949.jpg', 'https://wmsn.in/', NULL, '[\"home\", \"category\", \"sub_category\", \"post\", \"tag\", \"search\"]', '[\"top\"]', 0, 0, 1, '2026-02-20 20:57:48', '2026-02-20 21:23:22'),
(4, 'top 2', 'image', '1771621143_823f87fbc97cb7c2d47e.jpg', '', NULL, '[\"home\", \"category\", \"sub_category\", \"post\", \"tag\", \"search\"]', '[\"top\"]', 0, 0, 1, '2026-02-20 20:59:03', '2026-02-20 21:23:32'),
(5, 'top 3', 'image', '1771621165_c9a948c64aa728ea3c47.jpg', 'https://wmsn.in/', NULL, '[\"home\", \"category\", \"sub_category\", \"post\", \"tag\", \"search\"]', '[\"top\"]', 0, 0, 1, '2026-02-20 20:59:25', '2026-02-20 21:23:41'),
(6, 'top 4 ', 'image', '1771621195_ec0cd0c2d213994cbb63.jpg', '', NULL, '[\"home\", \"category\", \"sub_category\", \"post\", \"tag\", \"search\"]', '[\"top\"]', 0, 0, 1, '2026-02-20 20:59:55', '2026-02-20 20:59:55'),
(7, 'B1', 'image', '1771621784_d2ffb03c5a94100551d2.jpg', 'https://wmsn.in/', NULL, '[\"home\", \"category\", \"sub_category\", \"post\", \"tag\", \"search\"]', '[\"bottom\"]', 0, 0, 1, '2026-02-20 21:09:44', '2026-02-20 21:24:03'),
(8, 'B2', 'image', '1771621814_68921324386bb79be6ec.jpg', '', NULL, '[\"home\", \"category\", \"sub_category\", \"post\", \"tag\", \"search\"]', '[\"bottom\"]', 0, 0, 1, '2026-02-20 21:10:14', '2026-02-20 21:12:25'),
(9, 'B3', 'image', '1771621843_b70a85de6c4b1fbccd3f.jpg', 'https://wmsn.in/', NULL, '[\"home\", \"category\", \"sub_category\", \"post\", \"tag\", \"search\"]', '[\"bottom\"]', 0, 0, 1, '2026-02-20 21:10:43', '2026-02-20 21:23:55'),
(10, 'B4', 'image', '1771621873_0313e38cf864d29c02d3.jpg', '', NULL, '[\"home\", \"category\", \"sub_category\", \"post\", \"tag\", \"search\"]', '[\"bottom\"]', 0, 0, 1, '2026-02-20 21:11:13', '2026-02-20 21:11:56');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `group` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`id`, `user_id`, `group`, `created_at`) VALUES
(1, 1, 'superadmin', '2026-01-11 20:36:36'),
(9, 5, 'author', '2026-02-08 07:43:15');

-- --------------------------------------------------------

--
-- Table structure for table `auth_identities`
--

CREATE TABLE `auth_identities` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `secret` varchar(255) NOT NULL,
  `secret2` varchar(255) DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `extra` text DEFAULT NULL,
  `force_reset` tinyint(1) NOT NULL DEFAULT 0,
  `last_used_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_identities`
--

INSERT INTO `auth_identities` (`id`, `user_id`, `type`, `name`, `secret`, `secret2`, `expires`, `extra`, `force_reset`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'email_password', NULL, 'admin@example.com', '$2y$12$bIYZGzeWYnILOHUkn4hDyubP7HKRTo6FLLgOTi.iW3TQ9hFonx5k.', NULL, NULL, 0, '2026-03-01 07:28:56', '2026-01-11 20:36:36', '2026-03-01 07:28:56'),
(2, 2, 'email_password', NULL, 'user@example.com', '$2y$12$7e3dYDhhO9Do9A0iLHV3DuTjV1T04xrcsCvznSTGTccpssTFJlhBa', NULL, NULL, 0, '2026-02-08 07:39:55', '2026-01-11 20:48:32', '2026-02-08 07:39:55'),
(3, 3, 'email_password', NULL, 'test@example.com', '$2y$12$OlccI1xbr/V42YfsjQHRH.6O66kWbJNzD67WFVIU3fTXPS4wvi/ky', NULL, NULL, 0, NULL, '2026-02-08 05:33:12', '2026-02-08 05:33:12'),
(4, 4, 'email_password', NULL, 'test@test.com', '$2y$12$a5B36CPrEX1X4cY2n/hNA.eDduF2oysaNCW1qC8QPhAsUHThyE412', NULL, NULL, 0, NULL, '2026-02-08 07:06:47', '2026-02-08 07:06:47'),
(5, 5, 'email_password', NULL, 'akashhalder277@gmail.com', '$2y$12$Q27ma5ERJXvIAj7cA2z24eqiy8J3CJKRNroeQR//oSNfKmdec8tJe', NULL, NULL, 0, '2026-02-08 07:43:30', '2026-02-08 07:07:36', '2026-02-08 07:43:30');

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `user_agent`, `id_type`, `identifier`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-01-11 20:37:29', 1),
(2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'user@example.com', NULL, '2026-01-11 20:49:20', 0),
(3, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'user@example.com', 2, '2026-01-11 20:49:30', 1),
(4, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-01-11 20:51:19', 1),
(5, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-01-11 21:15:59', 1),
(6, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-01-12 06:27:36', 1),
(7, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-01-12 16:23:55', 1),
(8, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', NULL, '2026-01-14 15:49:38', 0),
(9, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-01-14 15:49:47', 1),
(10, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-01-27 04:41:47', 1),
(11, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-01-27 14:47:43', 1),
(12, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-01-28 08:24:42', 1),
(13, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-01-29 05:04:58', 1),
(14, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-01-29 14:14:43', 1),
(15, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-01-30 06:38:38', 1),
(16, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-01-30 14:11:06', 1),
(17, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-01-31 06:53:14', 1),
(18, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-01-31 17:51:53', 1),
(19, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-04 11:07:25', 1),
(20, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-04 13:51:41', 1),
(21, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-05 06:24:47', 1),
(22, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-05 16:21:21', 1),
(23, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'akashhalder277@gmail.com', NULL, '2026-02-06 19:46:42', 0),
(24, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-06 19:46:53', 1),
(25, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-06 20:16:17', 1),
(26, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'akashhalder277@gmail.com', NULL, '2026-02-06 20:16:40', 0),
(27, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-07 10:55:19', 1),
(28, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-07 14:50:22', 1),
(29, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-08 05:28:53', 1),
(30, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'user@example.com', 2, '2026-02-08 07:39:55', 1),
(31, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-08 07:42:12', 1),
(32, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'akashhalder277@gmail.com', 5, '2026-02-08 07:43:30', 1),
(33, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-08 07:50:16', 1),
(34, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-08 07:51:32', 1),
(35, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-08 15:28:22', 1),
(36, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-09 06:02:53', 1),
(37, '103.251.54.42', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-09 18:18:53', 1),
(38, '2409:40e1:454:eb1d:8000::', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-11 11:23:18', 1),
(39, '103.251.54.190', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-11 14:35:28', 1),
(40, '103.251.54.190', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-13 15:40:01', 1),
(41, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-13 17:15:01', 1),
(42, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-13 20:22:45', 1),
(43, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-14 08:11:36', 1),
(44, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-14 16:41:17', 1),
(45, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-14 19:39:11', 1),
(46, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-15 18:41:47', 1),
(47, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-16 05:39:22', 1),
(48, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-16 14:54:34', 1),
(49, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-16 20:25:43', 1),
(50, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-17 06:49:00', 1),
(51, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-17 10:20:41', 1),
(52, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-17 13:33:46', 1),
(53, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-18 09:14:52', 1),
(54, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-20 17:59:03', 1),
(55, '2405:201:9007:a054:4424:d2b0:4d5a:7022', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-26 08:43:12', 1),
(56, '2409:40e1:404a:f76f:f1c3:195d:b905:b95b', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-02-27 13:46:30', 1),
(57, '2409:40e1:404f:70:79c5:aabc:e42d:f765', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-03-01 07:28:56', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions_users`
--

CREATE TABLE `auth_permissions_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `permission` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_remember_tokens`
--

CREATE TABLE `auth_remember_tokens` (
  `id` int(10) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_token_logins`
--

CREATE TABLE `auth_token_logins` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `cat` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat`, `slug`, `is_active`, `status`, `created_at`, `updated_at`) VALUES
(1, 'জাতীয়', 'জাতীয়', 1, 1, '2026-02-04 16:39:01', '2026-02-04 16:39:01'),
(2, 'রাজনীতি', 'রাজনীতি', 1, 1, '2026-02-04 16:39:01', '2026-02-04 16:39:01'),
(3, 'আন্তর্জাতিক', 'আন্তর্জাতিক', 1, 1, '2026-02-04 16:39:01', '2026-02-04 16:39:01'),
(4, 'অর্থনীতি', 'অর্থনীতি', 1, 1, '2026-02-04 16:39:01', '2026-02-04 16:39:01'),
(5, 'খেলা', 'খেলা', 1, 1, '2026-02-04 16:39:01', '2026-02-04 16:39:01'),
(6, 'বিনোদন', 'বিনোদন', 1, 1, '2026-02-04 16:39:01', '2026-02-04 16:39:01'),
(7, 'প্রযুক্তি', 'প্রযুক্তি', 1, 1, '2026-02-04 16:39:01', '2026-02-04 16:39:01'),
(8, 'শিক্ষা', 'শিক্ষা', 1, 1, '2026-02-04 16:39:01', '2026-02-04 16:39:01'),
(9, 'স্বাস্থ্য', 'স্বাস্থ্য', 1, 1, '2026-02-04 16:39:01', '2026-02-04 16:39:01'),
(10, 'লাইফস্টাইল', 'লাইফস্টাইল', 0, 1, '2026-02-04 16:39:01', '2026-02-04 11:12:14'),
(11, 'আবহাওয়া', 'আবহাওয়া', 0, 1, '2026-02-04 16:39:01', '2026-02-04 11:12:17'),
(12, 'আইন ও আদালত', 'আইন-ও-আদালত', 0, 1, '2026-02-04 16:39:01', '2026-02-04 11:12:19'),
(13, 'কৃষি', 'কৃষি', 0, 1, '2026-02-04 16:39:01', '2026-02-04 11:12:21'),
(14, 'চাকরি', 'চাকরি', 1, 1, '2026-02-04 16:39:01', '2026-02-08 15:35:17'),
(15, 'ভ্রমণ', 'ভ্রমণ', 0, 1, '2026-02-04 16:39:01', '2026-02-04 11:12:48');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(10) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(50) NOT NULL COMMENT 'image, video, pdf etc',
  `folder` varchar(50) DEFAULT NULL COMMENT 'example: 02_26',
  `file_size` int(11) DEFAULT NULL COMMENT 'size in bytes',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `file_name`, `file_path`, `file_type`, `folder`, `file_size`, `created_at`, `updated_at`) VALUES
(1, '1771340544_1fc1ecb9efbb6b1c4021.jpg', 'uploads/posts/thumbnails/02_26/1771340544_1fc1ecb9efbb6b1c4021.jpg', 'image/jpeg', '02_26', 75664, '2026-02-17 20:32:24', '2026-02-17 20:32:24'),
(2, '1771340544_6187b49048607066812a.jpg', 'uploads/posts/thumbnails/02_26/1771340544_6187b49048607066812a.jpg', 'image/jpeg', '02_26', 81712, '2026-02-17 20:32:24', '2026-02-17 20:32:24'),
(3, '1771340544_efd131b17ae3077dd9a2.jpg', 'uploads/posts/thumbnails/02_26/1771340544_efd131b17ae3077dd9a2.jpg', 'image/jpeg', '02_26', 36801, '2026-02-17 20:32:24', '2026-02-17 20:32:24'),
(4, '1771340554_16ebb1128b50b0390f2e.jpg', 'uploads/posts/thumbnails/02_26/1771340554_16ebb1128b50b0390f2e.jpg', 'image/jpeg', '02_26', 38877, '2026-02-17 20:32:34', '2026-02-17 20:32:34'),
(5, '1771340554_ea41c43c5839279fc910.jpg', 'uploads/posts/thumbnails/02_26/1771340554_ea41c43c5839279fc910.jpg', 'image/jpeg', '02_26', 46185, '2026-02-17 20:32:34', '2026-02-17 20:32:34'),
(6, '1771340554_77f5b28f0a84d1176e78.jpg', 'uploads/posts/thumbnails/02_26/1771340554_77f5b28f0a84d1176e78.jpg', 'image/jpeg', '02_26', 39214, '2026-02-17 20:32:34', '2026-02-17 20:32:34'),
(7, '1771340554_aa96e01245f5516d483b.jpg', 'uploads/posts/thumbnails/02_26/1771340554_aa96e01245f5516d483b.jpg', 'image/jpeg', '02_26', 46261, '2026-02-17 20:32:34', '2026-02-17 20:32:34'),
(8, '1771340554_769b5d97bc6f2304c130.jpg', 'uploads/posts/thumbnails/02_26/1771340554_769b5d97bc6f2304c130.jpg', 'image/jpeg', '02_26', 46150, '2026-02-17 20:32:34', '2026-02-17 20:32:34'),
(9, '1771340554_7118c8fd428c7cba1fd3.jpg', 'uploads/posts/thumbnails/02_26/1771340554_7118c8fd428c7cba1fd3.jpg', 'image/jpeg', '02_26', 58533, '2026-02-17 20:32:34', '2026-02-17 20:32:34'),
(10, '1771340554_b0b2761e0f0017d1eb25.jpg', 'uploads/posts/thumbnails/02_26/1771340554_b0b2761e0f0017d1eb25.jpg', 'image/jpeg', '02_26', 139281, '2026-02-17 20:32:34', '2026-02-17 20:32:34'),
(11, '1771340554_089513f08acf80f0b714.jpg', 'uploads/posts/thumbnails/02_26/1771340554_089513f08acf80f0b714.jpg', 'image/jpeg', '02_26', 794831, '2026-02-17 20:32:34', '2026-02-17 20:32:34'),
(12, '1771340554_2d266b5d7c99386c2e3a.jpg', 'uploads/posts/thumbnails/02_26/1771340554_2d266b5d7c99386c2e3a.jpg', 'image/jpeg', '02_26', 91185, '2026-02-17 20:32:34', '2026-02-17 20:32:34'),
(13, '1771340591_6417af183fdfc5ca9394.png', 'uploads/posts/thumbnails/02_26/1771340591_6417af183fdfc5ca9394.png', 'image/png', '02_26', 40088, '2026-02-17 20:33:11', '2026-02-17 20:33:11'),
(14, '1771340591_6bac58dcde7942e0ddf3.png', 'uploads/posts/thumbnails/02_26/1771340591_6bac58dcde7942e0ddf3.png', 'image/png', '02_26', 51169, '2026-02-17 20:33:11', '2026-02-17 20:33:11'),
(15, '1771340591_2106af59d74a1a6954a9.png', 'uploads/posts/thumbnails/02_26/1771340591_2106af59d74a1a6954a9.png', 'image/png', '02_26', 44815, '2026-02-17 20:33:11', '2026-02-17 20:33:11'),
(16, '1771340591_2695f3b55b3a71695d5e.png', 'uploads/posts/thumbnails/02_26/1771340591_2695f3b55b3a71695d5e.png', 'image/png', '02_26', 44793, '2026-02-17 20:33:11', '2026-02-17 20:33:11'),
(17, '1771340591_52be6304259df83a6884.png', 'uploads/posts/thumbnails/02_26/1771340591_52be6304259df83a6884.png', 'image/png', '02_26', 56701, '2026-02-17 20:33:11', '2026-02-17 20:33:11'),
(18, '1771340591_ca3e69a97ffbdb2676ec.png', 'uploads/posts/thumbnails/02_26/1771340591_ca3e69a97ffbdb2676ec.png', 'image/png', '02_26', 72735, '2026-02-17 20:33:11', '2026-02-17 20:33:11'),
(19, '1771340591_74a38592be1842d9acdb.png', 'uploads/posts/thumbnails/02_26/1771340591_74a38592be1842d9acdb.png', 'image/png', '02_26', 78493, '2026-02-17 20:33:11', '2026-02-17 20:33:11'),
(20, '1771340619_b29d7b0364dfe5e08620.png', 'uploads/posts/thumbnails/02_26/1771340619_b29d7b0364dfe5e08620.png', 'image/png', '02_26', 114790, '2026-02-17 20:33:39', '2026-02-17 20:33:39'),
(21, '1771340619_f035b90c27bd449be755.png', 'uploads/posts/thumbnails/02_26/1771340619_f035b90c27bd449be755.png', 'image/png', '02_26', 46941, '2026-02-17 20:33:39', '2026-02-17 20:33:39'),
(22, '1771340619_80762161187e7bfa54fb.png', 'uploads/posts/thumbnails/02_26/1771340619_80762161187e7bfa54fb.png', 'image/png', '02_26', 114068, '2026-02-17 20:33:39', '2026-02-17 20:33:39'),
(23, '1771340619_f6c8e4adb0f2ab291b40.jpg', 'uploads/posts/thumbnails/02_26/1771340619_f6c8e4adb0f2ab291b40.jpg', 'image/jpeg', '02_26', 134961, '2026-02-17 20:33:39', '2026-02-17 20:33:39'),
(24, '1771340619_7e1c6e7553504e4f0f4d.jpg', 'uploads/posts/thumbnails/02_26/1771340619_7e1c6e7553504e4f0f4d.jpg', 'image/jpeg', '02_26', 143551, '2026-02-17 20:33:39', '2026-02-17 20:33:39'),
(25, '1771340619_e61887d9edfeaec9db94.jpg', 'uploads/posts/thumbnails/02_26/1771340619_e61887d9edfeaec9db94.jpg', 'image/jpeg', '02_26', 108605, '2026-02-17 20:33:39', '2026-02-17 20:33:39'),
(26, '1771340619_71be4f6d95979699e6e9.jpg', 'uploads/posts/thumbnails/02_26/1771340619_71be4f6d95979699e6e9.jpg', 'image/jpeg', '02_26', 110068, '2026-02-17 20:33:39', '2026-02-17 20:33:39'),
(27, '1771340619_26c3a64ff2e821112f6e.jpg', 'uploads/posts/thumbnails/02_26/1771340619_26c3a64ff2e821112f6e.jpg', 'image/jpeg', '02_26', 215795, '2026-02-17 20:33:39', '2026-02-17 20:33:39'),
(28, '1771340619_acff3c704ccf90014052.jpg', 'uploads/posts/thumbnails/02_26/1771340619_acff3c704ccf90014052.jpg', 'image/jpeg', '02_26', 262873, '2026-02-17 20:33:39', '2026-02-17 20:33:39'),
(29, '1771340720_b305996d18b4fbd1bb37.png', 'uploads/posts/thumbnails/02_26/1771340720_b305996d18b4fbd1bb37.png', 'image/png', '02_26', 247588, '2026-02-17 20:35:20', '2026-02-17 20:35:20'),
(30, '1771340720_5b80bd8dc5d820701902.png', 'uploads/posts/thumbnails/02_26/1771340720_5b80bd8dc5d820701902.png', 'image/png', '02_26', 404772, '2026-02-17 20:35:20', '2026-02-17 20:35:20'),
(31, '1771340720_d1808eb1e9f49141d353.png', 'uploads/posts/thumbnails/02_26/1771340720_d1808eb1e9f49141d353.png', 'image/png', '02_26', 243669, '2026-02-17 20:35:20', '2026-02-17 20:35:20'),
(32, '1771340720_cc189fe8541c771df37d.png', 'uploads/posts/thumbnails/02_26/1771340720_cc189fe8541c771df37d.png', 'image/png', '02_26', 215075, '2026-02-17 20:35:20', '2026-02-17 20:35:20'),
(33, '1771340720_f4582d58676278b9e6f3.png', 'uploads/posts/thumbnails/02_26/1771340720_f4582d58676278b9e6f3.png', 'image/png', '02_26', 240176, '2026-02-17 20:35:20', '2026-02-17 20:35:20'),
(34, '1771340720_862e0b29c082c642cafe.png', 'uploads/posts/thumbnails/02_26/1771340720_862e0b29c082c642cafe.png', 'image/png', '02_26', 149012, '2026-02-17 20:35:20', '2026-02-17 20:35:20'),
(35, '1771340905_9ef5b9c969157c98b90c.jpg', 'uploads/posts/thumbnails/02_26/1771340905_9ef5b9c969157c98b90c.jpg', 'image/jpeg', '02_26', 101419, '2026-02-17 20:38:25', '2026-02-17 20:38:25'),
(36, '1771340905_e6fc0d450b7615dd55a8.jpg', 'uploads/posts/thumbnails/02_26/1771340905_e6fc0d450b7615dd55a8.jpg', 'image/jpeg', '02_26', 177695, '2026-02-17 20:38:25', '2026-02-17 20:38:25'),
(37, '1771340905_23ecf8d8109c2d4d468f.jpg', 'uploads/posts/thumbnails/02_26/1771340905_23ecf8d8109c2d4d468f.jpg', 'image/jpeg', '02_26', 48196, '2026-02-17 20:38:25', '2026-02-17 20:38:25'),
(38, '1771340905_7ee4d1e6393c24256f48.jpg', 'uploads/posts/thumbnails/02_26/1771340905_7ee4d1e6393c24256f48.jpg', 'image/jpeg', '02_26', 49956, '2026-02-17 20:38:25', '2026-02-17 20:38:25'),
(39, '1771341008_8562f278bc1eef026cf2.jpg', 'uploads/posts/thumbnails/02_26/1771341008_8562f278bc1eef026cf2.jpg', 'image/jpeg', '02_26', 117570, '2026-02-17 20:40:08', '2026-02-17 20:40:08'),
(40, '1771341008_6dcf66c8f239e878e1fc.jpg', 'uploads/posts/thumbnails/02_26/1771341008_6dcf66c8f239e878e1fc.jpg', 'image/jpeg', '02_26', 377791, '2026-02-17 20:40:08', '2026-02-17 20:40:08'),
(41, '1771341008_f4738bd132c881b04a1a.jpg', 'uploads/posts/thumbnails/02_26/1771341008_f4738bd132c881b04a1a.jpg', 'image/jpeg', '02_26', 246485, '2026-02-17 20:40:08', '2026-02-17 20:40:08'),
(42, '1771341008_d2b605e8cd1f3b1fde86.jpg', 'uploads/posts/thumbnails/02_26/1771341008_d2b605e8cd1f3b1fde86.jpg', 'image/jpeg', '02_26', 807178, '2026-02-17 20:40:08', '2026-02-17 20:40:08'),
(43, '1771342223_e12ad6295a679e7c0a53.png', 'uploads/posts/thumbnails/02_26/1771342223_e12ad6295a679e7c0a53.png', 'image/png', '02_26', 171290, '2026-02-17 21:00:23', '2026-02-17 21:00:23'),
(44, '1771342223_a09365526573f8d1bd1d.png', 'uploads/posts/thumbnails/02_26/1771342223_a09365526573f8d1bd1d.png', 'image/png', '02_26', 171612, '2026-02-17 21:00:23', '2026-02-17 21:00:23'),
(45, '1771342223_074f3fb82a49f87437a1.png', 'uploads/posts/thumbnails/02_26/1771342223_074f3fb82a49f87437a1.png', 'image/png', '02_26', 164750, '2026-02-17 21:00:23', '2026-02-17 21:00:23'),
(46, '1771342223_aa4cc47720e115246fba.png', 'uploads/posts/thumbnails/02_26/1771342223_aa4cc47720e115246fba.png', 'image/png', '02_26', 150105, '2026-02-17 21:00:23', '2026-02-17 21:00:23'),
(47, '1771342223_a847c7ace7540ceb4ad2.png', 'uploads/posts/thumbnails/02_26/1771342223_a847c7ace7540ceb4ad2.png', 'image/png', '02_26', 182949, '2026-02-17 21:00:23', '2026-02-17 21:00:23'),
(48, '1771342223_f43c5aa530760b411952.jpg', 'uploads/posts/thumbnails/02_26/1771342223_f43c5aa530760b411952.jpg', 'image/jpeg', '02_26', 196437, '2026-02-17 21:00:23', '2026-02-17 21:00:23'),
(49, '1771342223_ab0823cef9e2483a34b5.png', 'uploads/posts/thumbnails/02_26/1771342223_ab0823cef9e2483a34b5.png', 'image/png', '02_26', 1557526, '2026-02-17 21:00:23', '2026-02-17 21:00:23'),
(50, '1771342396_fcceac402ea1fa872e33.jpg', 'uploads/posts/thumbnails/02_26/1771342396_fcceac402ea1fa872e33.jpg', 'image/jpeg', '02_26', 830046, '2026-02-17 21:03:16', '2026-02-17 21:03:16'),
(51, '1771342396_384daf492754663a96a6.png', 'uploads/posts/thumbnails/02_26/1771342396_384daf492754663a96a6.png', 'image/png', '02_26', 46050, '2026-02-17 21:03:16', '2026-02-17 21:03:16'),
(53, '1771356465_31f8be8404207afb28a1.png', 'uploads/posts/thumbnails/02_26/1771356465_31f8be8404207afb28a1.png', 'image', '02_26', 46050, '2026-02-18 00:57:45', '2026-02-18 00:57:45'),
(54, '1771358431_720e8667e27fb42e3e29.jpg', 'uploads/posts/thumbnails/02_26/1771358431_720e8667e27fb42e3e29.jpg', 'image', '02_26', 1550528, '2026-02-18 01:30:31', '2026-02-18 01:30:31');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2020-12-28-223112', 'CodeIgniter\\Shield\\Database\\Migrations\\CreateAuthTables', 'default', 'CodeIgniter\\Shield', 1768163640, 1),
(2, '2021-07-04-041948', 'CodeIgniter\\Settings\\Database\\Migrations\\CreateSettingsTable', 'default', 'CodeIgniter\\Settings', 1768163640, 1),
(3, '2021-11-14-143905', 'CodeIgniter\\Settings\\Database\\Migrations\\AddContextColumn', 'default', 'CodeIgniter\\Settings', 1768163641, 1),
(4, '2026-01-16-161406', 'App\\Database\\Migrations\\CreateCategoriesTable', 'default', 'App', 1769488881, 2),
(5, '2026-01-16-165148', 'App\\Database\\Migrations\\CreateSubCategoriesTable', 'default', 'App', 1769488881, 2),
(6, '2026-01-26-143435', 'App\\Database\\Migrations\\CreateNewsPostsTable', 'default', 'App', 1769488881, 2),
(7, '2026-01-26-143454', 'App\\Database\\Migrations\\CreateTagsTable', 'default', 'App', 1769488881, 2),
(8, '2026-01-26-143520', 'App\\Database\\Migrations\\CreateNewsPostCategoriesTable', 'default', 'App', 1769488881, 2),
(9, '2026-01-26-143552', 'App\\Database\\Migrations\\CreateNewsPostSubCategoriesTable', 'default', 'App', 1769488881, 2),
(10, '2026-01-26-143616', 'App\\Database\\Migrations\\CreateNewsPostTagsTable', 'default', 'App', 1769488881, 2),
(11, '2026-01-26-144422', 'App\\Database\\Migrations\\CreateNewsPostThumbnailsTable', 'default', 'App', 1769488881, 2),
(12, '2026-02-06-050147', 'App\\Database\\Migrations\\CreateNewsPostCommentsTable', 'default', 'App', 1770372991, 3),
(13, '2026-02-14-171523', 'App\\Database\\Migrations\\CreatePostViewsTable', 'default', 'App', 1771089431, 4),
(14, '2026-02-17-081231', 'App\\Database\\Migrations\\CreateMediaTable', 'default', 'App', 1771315989, 5),
(15, '2026-02-17-171353', 'App\\Database\\Migrations\\CreateSubAuthorTable', 'default', 'App', 1771349032, 6),
(16, '2026-02-20-060144', 'App\\Database\\Migrations\\CreateAdsManagerTable', 'default', 'App', 1771610168, 7);

-- --------------------------------------------------------

--
-- Table structure for table `news_posts`
--

CREATE TABLE `news_posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `headline` varchar(255) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `author` varchar(150) NOT NULL,
  `sub_author_id` int(10) UNSIGNED DEFAULT NULL,
  `post_date_time` datetime DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `description` longtext NOT NULL,
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=published,0=draft',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news_posts`
--

INSERT INTO `news_posts` (`id`, `headline`, `slug`, `author`, `sub_author_id`, `post_date_time`, `short_description`, `description`, `views`, `status`, `created_at`, `updated_at`) VALUES
(1, 'আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার।', 'আজিও-চেননি-সোনার-আদর-চেননি-মুক্তাহার-হাসি-মুখে-তাই-সোনা-ঝরে-পড়ে-তোমাদের-যারতার', 'admin', NULL, '2026-02-04 13:59:06', 'আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার।', '<p>আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার। বিহগ ছাড়িয়া ভোরের ভজন আহারের সন্ধ্যানে, বাতাসে বাঁধিয়া পাখা-সেতু-বাঁধ ছুটিবে সুদুর-পানে। এখনো বসিয়া সেঁউতীর মালা গাঁথিছে ভোরের তারা, ঊষার রঙিন শাড়ীখানি তার বুনান হয়নি সারা। তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি।</p>\r\n\r\n<p>কালিন্দী লতা গলায় জড়ায়ে সোনার গোকুল কাঁদে ব্রজের দুলাল বাঁধা নাহি পড়ে যেন মথুরার ফাঁদে। আজো কানে গোঁজ শিরীষ কুসুম কিংশুক-মঞ্জরী, অলকে বাঁধিয়া পাটল ফুলেতে ভরে লও উত্তরী! হেথা যৌবন মেলিয়া ধরিয়া জমা-খরচের খাতা, লাভ লেকাসান নিতেছে বুঝিয়া খুলিয়া পাতায় পাতা। ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল।</p>\r\n\r\n<p>তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি। ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল। তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি। তরুণ কিশোর! তোমার জীবনে সবে এ ভোরের বেলা, ভোরের বাতাস ভোরের কুসুমে জুড়েছে রঙের খেলা।</p>\r\n\r\n<p>হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার? সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়! তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। হেথা যৌবন যত কিছু এর খাতায় লিখিয়া লয়, পান হতে চুন খসেনাক-এমনি হিসাবময়। কে এলে তবে ভাই, সোনার গোকুল আঁধার করিয়া এই মথুরার ঠাই।</p>\r\n\r\n<p>মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে। তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল। এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি।</p>\r\n\r\n<p>ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়! সখালী পাতাও সখাদের সাথে, বিনামূলে দাও প্রাণ, এপারে মোদের মথুরার মত নাই দান-প্রতিদান। এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি। এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে।</p>\r\n\r\n<p>কালিন্দী লতা গলায় জড়ায়ে সোনার গোকুল কাঁদে ব্রজের দুলাল বাঁধা নাহি পড়ে যেন মথুরার ফাঁদে। শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন। হেথা যৌবন মেলিয়া ধরিয়া জমা-খরচের খাতা, লাভ লেকাসান নিতেছে বুঝিয়া খুলিয়া পাতায় পাতা। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল। কালিন্দী লতা গলায় জড়ায়ে সোনার গোকুল কাঁদে ব্রজের দুলাল বাঁধা নাহি পড়ে যেন মথুরার ফাঁদে।</p>\r\n\r\n<p>আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে। সেথায় তোমার কিশোরী বধূটি মাটির প্রদীপ ধরি, তুলসীর মূলে প্রণাম যে আঁকে হয়ত তোমারে স্মরি। হায়রে করুণ হায়, এখনি যে সবে জাগিয়া উঠিবে প্রভাতের কিনারায়। তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়।</p>\r\n\r\n<p>সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়! তরুণ কিশোর! তোমার জীবনে সবে এ ভোরের বেলা, ভোরের বাতাস ভোরের কুসুমে জুড়েছে রঙের খেলা। সেথায় তোমার কিশোরী বধূটি মাটির প্রদীপ ধরি, তুলসীর মূলে প্রণাম যে আঁকে হয়ত তোমারে স্মরি। এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে। তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে।</p>\r\n\r\n<p>তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি। তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে। এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে। হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার?</p>\r\n\r\n<p>হেথা যৌবন যত কিছু এর খাতায় লিখিয়া লয়, পান হতে চুন খসেনাক-এমনি হিসাবময়। আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার। ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? সেথায় তোমার কিশোরী বধূটি মাটির প্রদীপ ধরি, তুলসীর মূলে প্রণাম যে আঁকে হয়ত তোমারে স্মরি। তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়।</p>\r\n\r\n<p>আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে মাধবীলতার দোলনা বাঁধিয়া কদম্ব-শাখে শাখে, কিশোর! তোমার কিশোর সখারা তোমারে যে ওই ডাকে। হেথা যৌবন মেলিয়া ধরিয়া জমা-খরচের খাতা, লাভ লেকাসান নিতেছে বুঝিয়া খুলিয়া পাতায় পাতা। মাধবীলতার দোলনা বাঁধিয়া কদম্ব-শাখে শাখে, কিশোর! তোমার কিশোর সখারা তোমারে যে ওই ডাকে। শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন।</p>\r\n\r\n<p>আজো কানে গোঁজ শিরীষ কুসুম কিংশুক-মঞ্জরী, অলকে বাঁধিয়া পাটল ফুলেতে ভরে লও উত্তরী! কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা! তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? মাধবীলতার দোলনা বাঁধিয়া কদম্ব-শাখে শাখে, কিশোর! তোমার কিশোর সখারা তোমারে যে ওই ডাকে। তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়!</p>\r\n\r\n<p>রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে। হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার? তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়। এখন হইবে লোক জানাজানি, মুখ চেনাচেনি আর, হিসাব নিকাশ হইবে এখন কতটুকু আছে কার। তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়।</p>\r\n\r\n<p>আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন। তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার? হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি।</p>\r\n\r\n<p>আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি। এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি। তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি। হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল।</p>\r\n\r\n<p>সেথায় তোমার কিশোরী বধূটি মাটির প্রদীপ ধরি, তুলসীর মূলে প্রণাম যে আঁকে হয়ত তোমারে স্মরি। ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল।</p>\r\n\r\n<p>এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে। এখনো বসিয়া সেঁউতীর মালা গাঁথিছে ভোরের তারা, ঊষার রঙিন শাড়ীখানি তার বুনান হয়নি সারা। শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন। এখন হইবে লোক জানাজানি, মুখ চেনাচেনি আর, হিসাব নিকাশ হইবে এখন কতটুকু আছে কার। ডাকে কেয়াবনে ফুল-মঞ্জরি ঘন-দেয়া সম্পাতে, মাটির বুকেতে তমাল তাহার ফুল-বাহুখানি পাতে।</p>\r\n\r\n<p>আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা! আজো কানে গোঁজ শিরীষ কুসুম কিংশুক-মঞ্জরী, অলকে বাঁধিয়া পাটল ফুলেতে ভরে লও উত্তরী! সখালী পাতাও সখাদের সাথে, বিনামূলে দাও প্রাণ, এপারে মোদের মথুরার মত নাই দান-প্রতিদান। কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা!</p>\r\n\r\n<p>এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি। ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি। হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার।</p>\r\n\r\n<p>তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়। তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি। তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়। হেথা যৌবন যত কিছু এর খাতায় লিখিয়া লয়, পান হতে চুন খসেনাক-এমনি হিসাবময়।</p>\r\n\r\n<p>সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়! হায়রে করুণ হায়, এখনি যে সবে জাগিয়া উঠিবে প্রভাতের কিনারায়। সেথায় তোমার কিশোরী বধূটি মাটির প্রদীপ ধরি, তুলসীর মূলে প্রণাম যে আঁকে হয়ত তোমারে স্মরি। আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে মাধবীলতার দোলনা বাঁধিয়া কদম্ব-শাখে শাখে, কিশোর! তোমার কিশোর সখারা তোমারে যে ওই ডাকে।</p>\r\n\r\n<p>এখনো বসিয়া সেঁউতীর মালা গাঁথিছে ভোরের তারা, ঊষার রঙিন শাড়ীখানি তার বুনান হয়নি সারা। কে এলে তবে ভাই, সোনার গোকুল আঁধার করিয়া এই মথুরার ঠাই। তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়। আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। হায়রে করুণ হায়, এখনি যে সবে জাগিয়া উঠিবে প্রভাতের কিনারায়।</p>\r\n\r\n<p>ডাকে কেয়াবনে ফুল-মঞ্জরি ঘন-দেয়া সম্পাতে, মাটির বুকেতে তমাল তাহার ফুল-বাহুখানি পাতে। সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়! তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি।</p>\r\n\r\n<p>হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। ডাকে কেয়াবনে ফুল-মঞ্জরি ঘন-দেয়া সম্পাতে, মাটির বুকেতে তমাল তাহার ফুল-বাহুখানি পাতে। আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। বিহগ ছাড়িয়া ভোরের ভজন আহারের সন্ধ্যানে, বাতাসে বাঁধিয়া পাখা-সেতু-বাঁধ ছুটিবে সুদুর-পানে। হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল।</p>\r\n\r\n<p>তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি। কালিন্দী লতা গলায় জড়ায়ে সোনার গোকুল কাঁদে ব্রজের দুলাল বাঁধা নাহি পড়ে যেন মথুরার ফাঁদে। সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়! বঁধুর কোলেতে বধুয়া ঘুমায়, খোলেনি বাহুর বাঁধ, দীঘির জলেতে নাহিয়া নাহিয়া মেটেনি তারার সাধ। এখনো বসিয়া সেঁউতীর মালা গাঁথিছে ভোরের তারা, ঊষার রঙিন শাড়ীখানি তার বুনান হয়নি সারা।</p>\r\n\r\n<p>মাধবীলতার দোলনা বাঁধিয়া কদম্ব-শাখে শাখে, কিশোর! তোমার কিশোর সখারা তোমারে যে ওই ডাকে। আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার। ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি। হায়রে কিশোর হায়! ফুলের পরাণ বিকাতে এসেছ এই পাপ-মথুরায়। তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে।</p>\r\n\r\n<p>হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল। হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। তুমি যে কিশোর তোমার দেশেতে হিসাব নিকাশ নাই, যে আসে নিকটে তাহারেই লও আপন বলিয়া তাই। রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে। আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে</p>\r\n\r\n<p>তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল। এখন হইবে লোক জানাজানি, মুখ চেনাচেনি আর, হিসাব নিকাশ হইবে এখন কতটুকু আছে কার। মাধবীলতার দোলনা বাঁধিয়া কদম্ব-শাখে শাখে, কিশোর! তোমার কিশোর সখারা তোমারে যে ওই ডাকে। ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি।</p>\r\n\r\n<p>এখন হইবে লোক জানাজানি, মুখ চেনাচেনি আর, হিসাব নিকাশ হইবে এখন কতটুকু আছে কার। হায়রে কিশোর হায়! ফুলের পরাণ বিকাতে এসেছ এই পাপ-মথুরায়। আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার। তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়। ডাকে কেয়াবনে ফুল-মঞ্জরি ঘন-দেয়া সম্পাতে, মাটির বুকেতে তমাল তাহার ফুল-বাহুখানি পাতে।</p>\r\n\r\n<p>আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার। হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল। বঁধুর কোলেতে বধুয়া ঘুমায়, খোলেনি বাহুর বাঁধ, দীঘির জলেতে নাহিয়া নাহিয়া মেটেনি তারার সাধ। ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? বঁধুর কোলেতে বধুয়া ঘুমায়, খোলেনি বাহুর বাঁধ, দীঘির জলেতে নাহিয়া নাহিয়া মেটেনি তারার সাধ।</p>\r\n\r\n<p>তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। এখনো বসিয়া সেঁউতীর মালা গাঁথিছে ভোরের তারা, ঊষার রঙিন শাড়ীখানি তার বুনান হয়নি সারা। তরুণ কিশোর! তোমার জীবনে সবে এ ভোরের বেলা, ভোরের বাতাস ভোরের কুসুমে জুড়েছে রঙের খেলা। এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি।</p>\r\n\r\n<p>রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে। সেথায় তোমার কিশোরী বধূটি মাটির প্রদীপ ধরি, তুলসীর মূলে প্রণাম যে আঁকে হয়ত তোমারে স্মরি। ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার? তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়!</p>\r\n\r\n<p>কে এলে তবে ভাই, সোনার গোকুল আঁধার করিয়া এই মথুরার ঠাই। এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি। তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়! সখালী পাতাও সখাদের সাথে, বিনামূলে দাও প্রাণ, এপারে মোদের মথুরার মত নাই দান-প্রতিদান। মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে।</p>\r\n\r\n<p>তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়! ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল। তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। তরুণ কিশোর! তোমার জীবনে সবে এ ভোরের বেলা, ভোরের বাতাস ভোরের কুসুমে জুড়েছে রঙের খেলা।</p>\r\n\r\n<p>তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি। তুমি যে কিশোর তোমার দেশেতে হিসাব নিকাশ নাই, যে আসে নিকটে তাহারেই লও আপন বলিয়া তাই। কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা! কে এলে তবে ভাই, সোনার গোকুল আঁধার করিয়া এই মথুরার ঠাই। এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে।</p>\r\n\r\n<p>তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়! আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল।</p>\r\n\r\n<p>হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল। মাধবীলতার দোলনা বাঁধিয়া কদম্ব-শাখে শাখে, কিশোর! তোমার কিশোর সখারা তোমারে যে ওই ডাকে। বঁধুর কোলেতে বধুয়া ঘুমায়, খোলেনি বাহুর বাঁধ, দীঘির জলেতে নাহিয়া নাহিয়া মেটেনি তারার সাধ। তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি।</p>\r\n\r\n<p>তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি। ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি। এখনো বসিয়া সেঁউতীর মালা গাঁথিছে ভোরের তারা, ঊষার রঙিন শাড়ীখানি তার বুনান হয়নি সারা। তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে।</p>\r\n\r\n<p>হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। সেথায় তোমার কিশোরী বধূটি মাটির প্রদীপ ধরি, তুলসীর মূলে প্রণাম যে আঁকে হয়ত তোমারে স্মরি। হেথা যৌবন মেলিয়া ধরিয়া জমা-খরচের খাতা, লাভ লেকাসান নিতেছে বুঝিয়া খুলিয়া পাতায় পাতা। তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়! রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে।</p>\r\n\r\n<p>এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে। তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়। তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি। তরুণ কিশোর! তোমার জীবনে সবে এ ভোরের বেলা, ভোরের বাতাস ভোরের কুসুমে জুড়েছে রঙের খেলা। মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে।</p>\r\n\r\n<p>আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার। সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়! শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন। হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল। এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে।</p>\r\n\r\n<p>হেথা যৌবন যত কিছু এর খাতায় লিখিয়া লয়, পান হতে চুন খসেনাক-এমনি হিসাবময়। এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে। আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল।</p>\r\n\r\n<p>তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি। সখালী পাতাও সখাদের সাথে, বিনামূলে দাও প্রাণ, এপারে মোদের মথুরার মত নাই দান-প্রতিদান। তুমি যে কিশোর তোমার দেশেতে হিসাব নিকাশ নাই, যে আসে নিকটে তাহারেই লও আপন বলিয়া তাই। বঁধুর কোলেতে বধুয়া ঘুমায়, খোলেনি বাহুর বাঁধ, দীঘির জলেতে নাহিয়া নাহিয়া মেটেনি তারার সাধ। হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার?</p>\r\n\r\n<p>মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে। হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার? তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়। তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে?</p>\r\n\r\n<p>ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি। আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে। বঁধুর কোলেতে বধুয়া ঘুমায়, খোলেনি বাহুর বাঁধ, দীঘির জলেতে নাহিয়া নাহিয়া মেটেনি তারার সাধ। ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি।</p>\r\n\r\n<p>আজো কানে গোঁজ শিরীষ কুসুম কিংশুক-মঞ্জরী, অলকে বাঁধিয়া পাটল ফুলেতে ভরে লও উত্তরী! কালিন্দী লতা গলায় জড়ায়ে সোনার গোকুল কাঁদে ব্রজের দুলাল বাঁধা নাহি পড়ে যেন মথুরার ফাঁদে। সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়! আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে।</p>\r\n\r\n<p>হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার? ডাকে কেয়াবনে ফুল-মঞ্জরি ঘন-দেয়া সম্পাতে, মাটির বুকেতে তমাল তাহার ফুল-বাহুখানি পাতে। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল। রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে। সখালী পাতাও সখাদের সাথে, বিনামূলে দাও প্রাণ, এপারে মোদের মথুরার মত নাই দান-প্রতিদান।</p>\r\n\r\n<p>তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে। তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? কালিন্দী লতা গলায় জড়ায়ে সোনার গোকুল কাঁদে ব্রজের দুলাল বাঁধা নাহি পড়ে যেন মথুরার ফাঁদে। হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার?</p>\r\n\r\n<p>কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা! হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে। হায়রে করুণ হায়, এখনি যে সবে জাগিয়া উঠিবে প্রভাতের কিনারায়। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল।</p>', 0, 1, '2026-02-04 11:17:39', '2026-02-04 13:59:06'),
(2, 'কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা', 'কারে-ভালবাস-কারে-যে-বাস-না-তোমরা-শেখনি-তাহা', 'admin', NULL, '2026-02-04 14:16:12', 'কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা', '<p>আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার। বিহগ ছাড়িয়া ভোরের ভজন আহারের সন্ধ্যানে, বাতাসে বাঁধিয়া পাখা-সেতু-বাঁধ ছুটিবে সুদুর-পানে। এখনো বসিয়া সেঁউতীর মালা গাঁথিছে ভোরের তারা, ঊষার রঙিন শাড়ীখানি তার বুনান হয়নি সারা। তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি।</p>\r\n\r\n<p>কালিন্দী লতা গলায় জড়ায়ে সোনার গোকুল কাঁদে ব্রজের দুলাল বাঁধা নাহি পড়ে যেন মথুরার ফাঁদে। আজো কানে গোঁজ শিরীষ কুসুম কিংশুক-মঞ্জরী, অলকে বাঁধিয়া পাটল ফুলেতে ভরে লও উত্তরী! হেথা যৌবন মেলিয়া ধরিয়া জমা-খরচের খাতা, লাভ লেকাসান নিতেছে বুঝিয়া খুলিয়া পাতায় পাতা। ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল।</p>\r\n\r\n<p>তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি। ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল। তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি। তরুণ কিশোর! তোমার জীবনে সবে এ ভোরের বেলা, ভোরের বাতাস ভোরের কুসুমে জুড়েছে রঙের খেলা।</p>\r\n\r\n<p>হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার? সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়! তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। হেথা যৌবন যত কিছু এর খাতায় লিখিয়া লয়, পান হতে চুন খসেনাক-এমনি হিসাবময়। কে এলে তবে ভাই, সোনার গোকুল আঁধার করিয়া এই মথুরার ঠাই।</p>\r\n\r\n<p>মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে। তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল। এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি।</p>\r\n\r\n<p>ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়! সখালী পাতাও সখাদের সাথে, বিনামূলে দাও প্রাণ, এপারে মোদের মথুরার মত নাই দান-প্রতিদান। এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি। এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে।</p>\r\n\r\n<p>কালিন্দী লতা গলায় জড়ায়ে সোনার গোকুল কাঁদে ব্রজের দুলাল বাঁধা নাহি পড়ে যেন মথুরার ফাঁদে। শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন। হেথা যৌবন মেলিয়া ধরিয়া জমা-খরচের খাতা, লাভ লেকাসান নিতেছে বুঝিয়া খুলিয়া পাতায় পাতা। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল। কালিন্দী লতা গলায় জড়ায়ে সোনার গোকুল কাঁদে ব্রজের দুলাল বাঁধা নাহি পড়ে যেন মথুরার ফাঁদে।</p>\r\n\r\n<p>আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে। সেথায় তোমার কিশোরী বধূটি মাটির প্রদীপ ধরি, তুলসীর মূলে প্রণাম যে আঁকে হয়ত তোমারে স্মরি। হায়রে করুণ হায়, এখনি যে সবে জাগিয়া উঠিবে প্রভাতের কিনারায়। তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়।</p>\r\n\r\n<p>সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়! তরুণ কিশোর! তোমার জীবনে সবে এ ভোরের বেলা, ভোরের বাতাস ভোরের কুসুমে জুড়েছে রঙের খেলা। সেথায় তোমার কিশোরী বধূটি মাটির প্রদীপ ধরি, তুলসীর মূলে প্রণাম যে আঁকে হয়ত তোমারে স্মরি। এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে। তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে।</p>\r\n\r\n<p>তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি। তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে। এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে। হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার?</p>\r\n\r\n<p>হেথা যৌবন যত কিছু এর খাতায় লিখিয়া লয়, পান হতে চুন খসেনাক-এমনি হিসাবময়। আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার। ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? সেথায় তোমার কিশোরী বধূটি মাটির প্রদীপ ধরি, তুলসীর মূলে প্রণাম যে আঁকে হয়ত তোমারে স্মরি। তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়।</p>\r\n\r\n<p>আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে মাধবীলতার দোলনা বাঁধিয়া কদম্ব-শাখে শাখে, কিশোর! তোমার কিশোর সখারা তোমারে যে ওই ডাকে। হেথা যৌবন মেলিয়া ধরিয়া জমা-খরচের খাতা, লাভ লেকাসান নিতেছে বুঝিয়া খুলিয়া পাতায় পাতা। মাধবীলতার দোলনা বাঁধিয়া কদম্ব-শাখে শাখে, কিশোর! তোমার কিশোর সখারা তোমারে যে ওই ডাকে। শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন।</p>\r\n\r\n<p>আজো কানে গোঁজ শিরীষ কুসুম কিংশুক-মঞ্জরী, অলকে বাঁধিয়া পাটল ফুলেতে ভরে লও উত্তরী! কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা! তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? মাধবীলতার দোলনা বাঁধিয়া কদম্ব-শাখে শাখে, কিশোর! তোমার কিশোর সখারা তোমারে যে ওই ডাকে। তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়!</p>\r\n\r\n<p>রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে। হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার? তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়। এখন হইবে লোক জানাজানি, মুখ চেনাচেনি আর, হিসাব নিকাশ হইবে এখন কতটুকু আছে কার। তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়।</p>\r\n\r\n<p>আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন। তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার? হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি।</p>\r\n\r\n<p>আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি। এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি। তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি। হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল।</p>\r\n\r\n<p>সেথায় তোমার কিশোরী বধূটি মাটির প্রদীপ ধরি, তুলসীর মূলে প্রণাম যে আঁকে হয়ত তোমারে স্মরি। ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল।</p>\r\n\r\n<p>এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে। এখনো বসিয়া সেঁউতীর মালা গাঁথিছে ভোরের তারা, ঊষার রঙিন শাড়ীখানি তার বুনান হয়নি সারা। শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন। এখন হইবে লোক জানাজানি, মুখ চেনাচেনি আর, হিসাব নিকাশ হইবে এখন কতটুকু আছে কার। ডাকে কেয়াবনে ফুল-মঞ্জরি ঘন-দেয়া সম্পাতে, মাটির বুকেতে তমাল তাহার ফুল-বাহুখানি পাতে।</p>\r\n\r\n<p>আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা! আজো কানে গোঁজ শিরীষ কুসুম কিংশুক-মঞ্জরী, অলকে বাঁধিয়া পাটল ফুলেতে ভরে লও উত্তরী! সখালী পাতাও সখাদের সাথে, বিনামূলে দাও প্রাণ, এপারে মোদের মথুরার মত নাই দান-প্রতিদান। কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা!</p>\r\n\r\n<p>এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি। ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি। হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার।</p>\r\n\r\n<p>তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়। তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি। তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়। হেথা যৌবন যত কিছু এর খাতায় লিখিয়া লয়, পান হতে চুন খসেনাক-এমনি হিসাবময়।</p>\r\n\r\n<p>সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়! হায়রে করুণ হায়, এখনি যে সবে জাগিয়া উঠিবে প্রভাতের কিনারায়। সেথায় তোমার কিশোরী বধূটি মাটির প্রদীপ ধরি, তুলসীর মূলে প্রণাম যে আঁকে হয়ত তোমারে স্মরি। আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে মাধবীলতার দোলনা বাঁধিয়া কদম্ব-শাখে শাখে, কিশোর! তোমার কিশোর সখারা তোমারে যে ওই ডাকে।</p>\r\n\r\n<p>এখনো বসিয়া সেঁউতীর মালা গাঁথিছে ভোরের তারা, ঊষার রঙিন শাড়ীখানি তার বুনান হয়নি সারা। কে এলে তবে ভাই, সোনার গোকুল আঁধার করিয়া এই মথুরার ঠাই। তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়। আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। হায়রে করুণ হায়, এখনি যে সবে জাগিয়া উঠিবে প্রভাতের কিনারায়।</p>\r\n\r\n<p>ডাকে কেয়াবনে ফুল-মঞ্জরি ঘন-দেয়া সম্পাতে, মাটির বুকেতে তমাল তাহার ফুল-বাহুখানি পাতে। সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়! তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি।</p>\r\n\r\n<p>হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। ডাকে কেয়াবনে ফুল-মঞ্জরি ঘন-দেয়া সম্পাতে, মাটির বুকেতে তমাল তাহার ফুল-বাহুখানি পাতে। আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। বিহগ ছাড়িয়া ভোরের ভজন আহারের সন্ধ্যানে, বাতাসে বাঁধিয়া পাখা-সেতু-বাঁধ ছুটিবে সুদুর-পানে। হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল।</p>\r\n\r\n<p>তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি। কালিন্দী লতা গলায় জড়ায়ে সোনার গোকুল কাঁদে ব্রজের দুলাল বাঁধা নাহি পড়ে যেন মথুরার ফাঁদে। সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়! বঁধুর কোলেতে বধুয়া ঘুমায়, খোলেনি বাহুর বাঁধ, দীঘির জলেতে নাহিয়া নাহিয়া মেটেনি তারার সাধ। এখনো বসিয়া সেঁউতীর মালা গাঁথিছে ভোরের তারা, ঊষার রঙিন শাড়ীখানি তার বুনান হয়নি সারা।</p>\r\n\r\n<p>মাধবীলতার দোলনা বাঁধিয়া কদম্ব-শাখে শাখে, কিশোর! তোমার কিশোর সখারা তোমারে যে ওই ডাকে। আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার। ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি। হায়রে কিশোর হায়! ফুলের পরাণ বিকাতে এসেছ এই পাপ-মথুরায়। তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে।</p>\r\n\r\n<p>হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল। হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। তুমি যে কিশোর তোমার দেশেতে হিসাব নিকাশ নাই, যে আসে নিকটে তাহারেই লও আপন বলিয়া তাই। রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে। আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে</p>\r\n\r\n<p>তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল। এখন হইবে লোক জানাজানি, মুখ চেনাচেনি আর, হিসাব নিকাশ হইবে এখন কতটুকু আছে কার। মাধবীলতার দোলনা বাঁধিয়া কদম্ব-শাখে শাখে, কিশোর! তোমার কিশোর সখারা তোমারে যে ওই ডাকে। ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি।</p>\r\n\r\n<p>এখন হইবে লোক জানাজানি, মুখ চেনাচেনি আর, হিসাব নিকাশ হইবে এখন কতটুকু আছে কার। হায়রে কিশোর হায়! ফুলের পরাণ বিকাতে এসেছ এই পাপ-মথুরায়। আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার। তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়। ডাকে কেয়াবনে ফুল-মঞ্জরি ঘন-দেয়া সম্পাতে, মাটির বুকেতে তমাল তাহার ফুল-বাহুখানি পাতে।</p>\r\n\r\n<p>আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার। হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল। বঁধুর কোলেতে বধুয়া ঘুমায়, খোলেনি বাহুর বাঁধ, দীঘির জলেতে নাহিয়া নাহিয়া মেটেনি তারার সাধ। ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? বঁধুর কোলেতে বধুয়া ঘুমায়, খোলেনি বাহুর বাঁধ, দীঘির জলেতে নাহিয়া নাহিয়া মেটেনি তারার সাধ।</p>\r\n\r\n<p>তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। এখনো বসিয়া সেঁউতীর মালা গাঁথিছে ভোরের তারা, ঊষার রঙিন শাড়ীখানি তার বুনান হয়নি সারা। তরুণ কিশোর! তোমার জীবনে সবে এ ভোরের বেলা, ভোরের বাতাস ভোরের কুসুমে জুড়েছে রঙের খেলা। এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি।</p>\r\n\r\n<p>রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে। সেথায় তোমার কিশোরী বধূটি মাটির প্রদীপ ধরি, তুলসীর মূলে প্রণাম যে আঁকে হয়ত তোমারে স্মরি। ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার? তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়!</p>\r\n\r\n<p>কে এলে তবে ভাই, সোনার গোকুল আঁধার করিয়া এই মথুরার ঠাই। এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি। তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়! সখালী পাতাও সখাদের সাথে, বিনামূলে দাও প্রাণ, এপারে মোদের মথুরার মত নাই দান-প্রতিদান। মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে।</p>\r\n\r\n<p>তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়! ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল। তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। তরুণ কিশোর! তোমার জীবনে সবে এ ভোরের বেলা, ভোরের বাতাস ভোরের কুসুমে জুড়েছে রঙের খেলা।</p>\r\n\r\n<p>তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি। তুমি যে কিশোর তোমার দেশেতে হিসাব নিকাশ নাই, যে আসে নিকটে তাহারেই লও আপন বলিয়া তাই। কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা! কে এলে তবে ভাই, সোনার গোকুল আঁধার করিয়া এই মথুরার ঠাই। এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে।</p>\r\n\r\n<p>তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়! আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল।</p>\r\n\r\n<p>হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল। মাধবীলতার দোলনা বাঁধিয়া কদম্ব-শাখে শাখে, কিশোর! তোমার কিশোর সখারা তোমারে যে ওই ডাকে। বঁধুর কোলেতে বধুয়া ঘুমায়, খোলেনি বাহুর বাঁধ, দীঘির জলেতে নাহিয়া নাহিয়া মেটেনি তারার সাধ। তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি।</p>\r\n\r\n<p>তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি। ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি। এখনো বসিয়া সেঁউতীর মালা গাঁথিছে ভোরের তারা, ঊষার রঙিন শাড়ীখানি তার বুনান হয়নি সারা। তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে।</p>\r\n\r\n<p>হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। সেথায় তোমার কিশোরী বধূটি মাটির প্রদীপ ধরি, তুলসীর মূলে প্রণাম যে আঁকে হয়ত তোমারে স্মরি। হেথা যৌবন মেলিয়া ধরিয়া জমা-খরচের খাতা, লাভ লেকাসান নিতেছে বুঝিয়া খুলিয়া পাতায় পাতা। তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়! রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে।</p>\r\n\r\n<p>এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে। তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়। তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি। তরুণ কিশোর! তোমার জীবনে সবে এ ভোরের বেলা, ভোরের বাতাস ভোরের কুসুমে জুড়েছে রঙের খেলা। মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে।</p>\r\n\r\n<p>আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার। সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়! শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন। হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল। এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে।</p>\r\n\r\n<p>হেথা যৌবন যত কিছু এর খাতায় লিখিয়া লয়, পান হতে চুন খসেনাক-এমনি হিসাবময়। এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে। আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল।</p>\r\n\r\n<p>তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি। সখালী পাতাও সখাদের সাথে, বিনামূলে দাও প্রাণ, এপারে মোদের মথুরার মত নাই দান-প্রতিদান। তুমি যে কিশোর তোমার দেশেতে হিসাব নিকাশ নাই, যে আসে নিকটে তাহারেই লও আপন বলিয়া তাই। বঁধুর কোলেতে বধুয়া ঘুমায়, খোলেনি বাহুর বাঁধ, দীঘির জলেতে নাহিয়া নাহিয়া মেটেনি তারার সাধ। হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার?</p>\r\n\r\n<p>মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে। হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার? তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়। তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে?</p>\r\n\r\n<p>ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি। আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে। বঁধুর কোলেতে বধুয়া ঘুমায়, খোলেনি বাহুর বাঁধ, দীঘির জলেতে নাহিয়া নাহিয়া মেটেনি তারার সাধ। ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি।</p>\r\n\r\n<p>আজো কানে গোঁজ শিরীষ কুসুম কিংশুক-মঞ্জরী, অলকে বাঁধিয়া পাটল ফুলেতে ভরে লও উত্তরী! কালিন্দী লতা গলায় জড়ায়ে সোনার গোকুল কাঁদে ব্রজের দুলাল বাঁধা নাহি পড়ে যেন মথুরার ফাঁদে। সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়! আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে।</p>\r\n\r\n<p>হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার? ডাকে কেয়াবনে ফুল-মঞ্জরি ঘন-দেয়া সম্পাতে, মাটির বুকেতে তমাল তাহার ফুল-বাহুখানি পাতে। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল। রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে। সখালী পাতাও সখাদের সাথে, বিনামূলে দাও প্রাণ, এপারে মোদের মথুরার মত নাই দান-প্রতিদান।</p>\r\n\r\n<p>তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে। তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? কালিন্দী লতা গলায় জড়ায়ে সোনার গোকুল কাঁদে ব্রজের দুলাল বাঁধা নাহি পড়ে যেন মথুরার ফাঁদে। হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার?</p>\r\n\r\n<p>কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা! হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে। হায়রে করুণ হায়, এখনি যে সবে জাগিয়া উঠিবে প্রভাতের কিনারায়। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল।</p>', 4, 1, '2026-02-04 14:06:48', '2026-02-16 14:54:39');
INSERT INTO `news_posts` (`id`, `headline`, `slug`, `author`, `sub_author_id`, `post_date_time`, `short_description`, `description`, `views`, `status`, `created_at`, `updated_at`) VALUES
(3, 'ঘরে ফিরে যাও সোনার কিশোর', 'ঘরে-ফিরে-যাও-সোনার-কিশোর', 'admin', NULL, '2026-02-05 16:45:31', 'ঘরে ফিরে যাও সোনার কিশোর', '<p>এখনো বসিয়া সেঁউতীর মালা গাঁথিছে ভোরের তারা, ঊষার রঙিন শাড়ীখানি তার বুনান হয়নি সারা। এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি। কালিন্দী লতা গলায় জড়ায়ে সোনার গোকুল কাঁদে ব্রজের দুলাল বাঁধা নাহি পড়ে যেন মথুরার ফাঁদে। শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন। তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি।</p>\r\n\r\n<p>কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা! কে এলে তবে ভাই, সোনার গোকুল আঁধার করিয়া এই মথুরার ঠাই। আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার? আজো কানে গোঁজ শিরীষ কুসুম কিংশুক-মঞ্জরী, অলকে বাঁধিয়া পাটল ফুলেতে ভরে লও উত্তরী!</p>\r\n\r\n<p>শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন। হায়রে কিশোর হায়! ফুলের পরাণ বিকাতে এসেছ এই পাপ-মথুরায়। রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে। এখন হইবে লোক জানাজানি, মুখ চেনাচেনি আর, হিসাব নিকাশ হইবে এখন কতটুকু আছে কার। সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়!</p>\r\n\r\n<p>আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল। ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি। তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে।</p>\r\n\r\n<p>তুমি যে কিশোর তোমার দেশেতে হিসাব নিকাশ নাই, যে আসে নিকটে তাহারেই লও আপন বলিয়া তাই। ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে। এখন হইবে লোক জানাজানি, মুখ চেনাচেনি আর, হিসাব নিকাশ হইবে এখন কতটুকু আছে কার। তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়।</p>\r\n\r\n<p>কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা! হেথা যৌবন যত কিছু এর খাতায় লিখিয়া লয়, পান হতে চুন খসেনাক-এমনি হিসাবময়। এখন হইবে লোক জানাজানি, মুখ চেনাচেনি আর, হিসাব নিকাশ হইবে এখন কতটুকু আছে কার। সখালী পাতাও সখাদের সাথে, বিনামূলে দাও প্রাণ, এপারে মোদের মথুরার মত নাই দান-প্রতিদান। তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি।</p>\r\n\r\n<p>তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি। হায়রে করুণ হায়, এখনি যে সবে জাগিয়া উঠিবে প্রভাতের কিনারায়। ডাকে কেয়াবনে ফুল-মঞ্জরি ঘন-দেয়া সম্পাতে, মাটির বুকেতে তমাল তাহার ফুল-বাহুখানি পাতে। আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে।</p>\r\n\r\n<p>তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়! বঁধুর কোলেতে বধুয়া ঘুমায়, খোলেনি বাহুর বাঁধ, দীঘির জলেতে নাহিয়া নাহিয়া মেটেনি তারার সাধ। সখালী পাতাও সখাদের সাথে, বিনামূলে দাও প্রাণ, এপারে মোদের মথুরার মত নাই দান-প্রতিদান। হেথা যৌবন যত কিছু এর খাতায় লিখিয়া লয়, পান হতে চুন খসেনাক-এমনি হিসাবময়। হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার?</p>\r\n\r\n<p>আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। কালিন্দী লতা গলায় জড়ায়ে সোনার গোকুল কাঁদে ব্রজের দুলাল বাঁধা নাহি পড়ে যেন মথুরার ফাঁদে। এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে। ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? হায়রে করুণ হায়, এখনি যে সবে জাগিয়া উঠিবে প্রভাতের কিনারায়।</p>\r\n\r\n<p>কে এলে তবে ভাই, সোনার গোকুল আঁধার করিয়া এই মথুরার ঠাই। তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়! এখন হইবে লোক জানাজানি, মুখ চেনাচেনি আর, হিসাব নিকাশ হইবে এখন কতটুকু আছে কার। আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে।</p>\r\n\r\n<p>সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়! আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে। হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে।</p>\r\n\r\n<p>এখন হইবে লোক জানাজানি, মুখ চেনাচেনি আর, হিসাব নিকাশ হইবে এখন কতটুকু আছে কার। হায়রে কিশোর হায়! ফুলের পরাণ বিকাতে এসেছ এই পাপ-মথুরায়। হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল। তুমি যে কিশোর তোমার দেশেতে হিসাব নিকাশ নাই, যে আসে নিকটে তাহারেই লও আপন বলিয়া তাই। শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন।</p>\r\n\r\n<p>হেথা যৌবন যত কিছু এর খাতায় লিখিয়া লয়, পান হতে চুন খসেনাক-এমনি হিসাবময়। ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি। এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল। এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি।</p>\r\n\r\n<p>আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়। রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে। রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে। আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে।</p>\r\n\r\n<p>হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল। সখালী পাতাও সখাদের সাথে, বিনামূলে দাও প্রাণ, এপারে মোদের মথুরার মত নাই দান-প্রতিদান। কালিন্দী লতা গলায় জড়ায়ে সোনার গোকুল কাঁদে ব্রজের দুলাল বাঁধা নাহি পড়ে যেন মথুরার ফাঁদে। হেথা যৌবন মেলিয়া ধরিয়া জমা-খরচের খাতা, লাভ লেকাসান নিতেছে বুঝিয়া খুলিয়া পাতায় পাতা। শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন।</p>\r\n\r\n<p>তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা! কে এলে তবে ভাই, সোনার গোকুল আঁধার করিয়া এই মথুরার ঠাই। হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি।</p>\r\n\r\n<p>বিহগ ছাড়িয়া ভোরের ভজন আহারের সন্ধ্যানে, বাতাসে বাঁধিয়া পাখা-সেতু-বাঁধ ছুটিবে সুদুর-পানে। তরুণ কিশোর! তোমার জীবনে সবে এ ভোরের বেলা, ভোরের বাতাস ভোরের কুসুমে জুড়েছে রঙের খেলা। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল। হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। হেথা যৌবন মেলিয়া ধরিয়া জমা-খরচের খাতা, লাভ লেকাসান নিতেছে বুঝিয়া খুলিয়া পাতায় পাতা।</p>\r\n\r\n<p>ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি। কে এলে তবে ভাই, সোনার গোকুল আঁধার করিয়া এই মথুরার ঠাই। আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। কে এলে তবে ভাই, সোনার গোকুল আঁধার করিয়া এই মথুরার ঠাই।</p>\r\n\r\n<p>কে এলে তবে ভাই, সোনার গোকুল আঁধার করিয়া এই মথুরার ঠাই। হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। বিহগ ছাড়িয়া ভোরের ভজন আহারের সন্ধ্যানে, বাতাসে বাঁধিয়া পাখা-সেতু-বাঁধ ছুটিবে সুদুর-পানে। শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন। হেথা যৌবন যত কিছু এর খাতায় লিখিয়া লয়, পান হতে চুন খসেনাক-এমনি হিসাবময়।</p>\r\n\r\n<p>হেথা যৌবন মেলিয়া ধরিয়া জমা-খরচের খাতা, লাভ লেকাসান নিতেছে বুঝিয়া খুলিয়া পাতায় পাতা। তুমি যে কিশোর তোমার দেশেতে হিসাব নিকাশ নাই, যে আসে নিকটে তাহারেই লও আপন বলিয়া তাই। তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়! হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার?</p>\r\n\r\n<p>হায়রে করুণ হায়, এখনি যে সবে জাগিয়া উঠিবে প্রভাতের কিনারায়। তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। সখালী পাতাও সখাদের সাথে, বিনামূলে দাও প্রাণ, এপারে মোদের মথুরার মত নাই দান-প্রতিদান। আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার। তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি।</p>\r\n\r\n<p>হায়রে করুণ হায়, এখনি যে সবে জাগিয়া উঠিবে প্রভাতের কিনারায়। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল। হেথা যৌবন মেলিয়া ধরিয়া জমা-খরচের খাতা, লাভ লেকাসান নিতেছে বুঝিয়া খুলিয়া পাতায় পাতা। তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়! বিহগ ছাড়িয়া ভোরের ভজন আহারের সন্ধ্যানে, বাতাসে বাঁধিয়া পাখা-সেতু-বাঁধ ছুটিবে সুদুর-পানে।</p>\r\n\r\n<p>সেথায় তোমার কিশোরী বধূটি মাটির প্রদীপ ধরি, তুলসীর মূলে প্রণাম যে আঁকে হয়ত তোমারে স্মরি। হেথা যৌবন যত কিছু এর খাতায় লিখিয়া লয়, পান হতে চুন খসেনাক-এমনি হিসাবময়। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল। তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। এখনো বসিয়া সেঁউতীর মালা গাঁথিছে ভোরের তারা, ঊষার রঙিন শাড়ীখানি তার বুনান হয়নি সারা।</p>\r\n\r\n<p>তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়! হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল। এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে। হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল।</p>\r\n\r\n<p>তরুণ কিশোর! তোমার জীবনে সবে এ ভোরের বেলা, ভোরের বাতাস ভোরের কুসুমে জুড়েছে রঙের খেলা। সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়! ডাকে কেয়াবনে ফুল-মঞ্জরি ঘন-দেয়া সম্পাতে, মাটির বুকেতে তমাল তাহার ফুল-বাহুখানি পাতে। কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা! আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে</p>\r\n\r\n<p>বঁধুর কোলেতে বধুয়া ঘুমায়, খোলেনি বাহুর বাঁধ, দীঘির জলেতে নাহিয়া নাহিয়া মেটেনি তারার সাধ। তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়! রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল। হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল।</p>\r\n\r\n<p>ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। হেথা যৌবন মেলিয়া ধরিয়া জমা-খরচের খাতা, লাভ লেকাসান নিতেছে বুঝিয়া খুলিয়া পাতায় পাতা। মাধবীলতার দোলনা বাঁধিয়া কদম্ব-শাখে শাখে, কিশোর! তোমার কিশোর সখারা তোমারে যে ওই ডাকে। এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি।</p>\r\n\r\n<p>আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি। হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি।</p>\r\n\r\n<p>হেথা যৌবন মেলিয়া ধরিয়া জমা-খরচের খাতা, লাভ লেকাসান নিতেছে বুঝিয়া খুলিয়া পাতায় পাতা। কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা! কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা! মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে। মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে।</p>\r\n\r\n<p>এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি। হায়রে কিশোর হায়! ফুলের পরাণ বিকাতে এসেছ এই পাপ-মথুরায়। হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার? আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার। তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি।</p>', 0, 1, '2026-02-04 14:19:51', '2026-02-05 16:45:31'),
(8, 'ফুলের পরাণ বিকাতে এসেছ এই পাপ-মথুরায়', 'ফুলের-পরাণ-বিকাতে-এসেছ-এই-পাপমথুরায়', 'admin', NULL, '2026-02-05 16:45:46', 'ফুলের পরাণ বিকাতে এসেছ এই পাপ-মথুরায়', '<p>এখনো বসিয়া সেঁউতীর মালা গাঁথিছে ভোরের তারা, ঊষার রঙিন শাড়ীখানি তার বুনান হয়নি সারা। এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি। কালিন্দী লতা গলায় জড়ায়ে সোনার গোকুল কাঁদে ব্রজের দুলাল বাঁধা নাহি পড়ে যেন মথুরার ফাঁদে। শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন। তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি।</p>\r\n\r\n<p>কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা! কে এলে তবে ভাই, সোনার গোকুল আঁধার করিয়া এই মথুরার ঠাই। আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার? আজো কানে গোঁজ শিরীষ কুসুম কিংশুক-মঞ্জরী, অলকে বাঁধিয়া পাটল ফুলেতে ভরে লও উত্তরী!</p>\r\n\r\n<p>শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন। হায়রে কিশোর হায়! ফুলের পরাণ বিকাতে এসেছ এই পাপ-মথুরায়। রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে। এখন হইবে লোক জানাজানি, মুখ চেনাচেনি আর, হিসাব নিকাশ হইবে এখন কতটুকু আছে কার। সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়!</p>\r\n\r\n<p>আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল। ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি। তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে।</p>\r\n\r\n<p>তুমি যে কিশোর তোমার দেশেতে হিসাব নিকাশ নাই, যে আসে নিকটে তাহারেই লও আপন বলিয়া তাই। ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে। এখন হইবে লোক জানাজানি, মুখ চেনাচেনি আর, হিসাব নিকাশ হইবে এখন কতটুকু আছে কার। তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়।</p>\r\n\r\n<p>কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা! হেথা যৌবন যত কিছু এর খাতায় লিখিয়া লয়, পান হতে চুন খসেনাক-এমনি হিসাবময়। এখন হইবে লোক জানাজানি, মুখ চেনাচেনি আর, হিসাব নিকাশ হইবে এখন কতটুকু আছে কার। সখালী পাতাও সখাদের সাথে, বিনামূলে দাও প্রাণ, এপারে মোদের মথুরার মত নাই দান-প্রতিদান। তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি।</p>\r\n\r\n<p>তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি। হায়রে করুণ হায়, এখনি যে সবে জাগিয়া উঠিবে প্রভাতের কিনারায়। ডাকে কেয়াবনে ফুল-মঞ্জরি ঘন-দেয়া সম্পাতে, মাটির বুকেতে তমাল তাহার ফুল-বাহুখানি পাতে। আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে।</p>\r\n\r\n<p>তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়! বঁধুর কোলেতে বধুয়া ঘুমায়, খোলেনি বাহুর বাঁধ, দীঘির জলেতে নাহিয়া নাহিয়া মেটেনি তারার সাধ। সখালী পাতাও সখাদের সাথে, বিনামূলে দাও প্রাণ, এপারে মোদের মথুরার মত নাই দান-প্রতিদান। হেথা যৌবন যত কিছু এর খাতায় লিখিয়া লয়, পান হতে চুন খসেনাক-এমনি হিসাবময়। হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার?</p>\r\n\r\n<p>আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। কালিন্দী লতা গলায় জড়ায়ে সোনার গোকুল কাঁদে ব্রজের দুলাল বাঁধা নাহি পড়ে যেন মথুরার ফাঁদে। এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে। ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? হায়রে করুণ হায়, এখনি যে সবে জাগিয়া উঠিবে প্রভাতের কিনারায়।</p>\r\n\r\n<p>কে এলে তবে ভাই, সোনার গোকুল আঁধার করিয়া এই মথুরার ঠাই। তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়! এখন হইবে লোক জানাজানি, মুখ চেনাচেনি আর, হিসাব নিকাশ হইবে এখন কতটুকু আছে কার। আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে।</p>\r\n\r\n<p>সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়! আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে। হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে।</p>\r\n\r\n<p>এখন হইবে লোক জানাজানি, মুখ চেনাচেনি আর, হিসাব নিকাশ হইবে এখন কতটুকু আছে কার। হায়রে কিশোর হায়! ফুলের পরাণ বিকাতে এসেছ এই পাপ-মথুরায়। হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল। তুমি যে কিশোর তোমার দেশেতে হিসাব নিকাশ নাই, যে আসে নিকটে তাহারেই লও আপন বলিয়া তাই। শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন।</p>\r\n\r\n<p>হেথা যৌবন যত কিছু এর খাতায় লিখিয়া লয়, পান হতে চুন খসেনাক-এমনি হিসাবময়। ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি। এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল। এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি।</p>\r\n\r\n<p>আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়। রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে। রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে। আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে।</p>\r\n\r\n<p>হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল। সখালী পাতাও সখাদের সাথে, বিনামূলে দাও প্রাণ, এপারে মোদের মথুরার মত নাই দান-প্রতিদান। কালিন্দী লতা গলায় জড়ায়ে সোনার গোকুল কাঁদে ব্রজের দুলাল বাঁধা নাহি পড়ে যেন মথুরার ফাঁদে। হেথা যৌবন মেলিয়া ধরিয়া জমা-খরচের খাতা, লাভ লেকাসান নিতেছে বুঝিয়া খুলিয়া পাতায় পাতা। শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন।</p>\r\n\r\n<p>তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা! কে এলে তবে ভাই, সোনার গোকুল আঁধার করিয়া এই মথুরার ঠাই। হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি।</p>\r\n\r\n<p>বিহগ ছাড়িয়া ভোরের ভজন আহারের সন্ধ্যানে, বাতাসে বাঁধিয়া পাখা-সেতু-বাঁধ ছুটিবে সুদুর-পানে। তরুণ কিশোর! তোমার জীবনে সবে এ ভোরের বেলা, ভোরের বাতাস ভোরের কুসুমে জুড়েছে রঙের খেলা। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল। হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। হেথা যৌবন মেলিয়া ধরিয়া জমা-খরচের খাতা, লাভ লেকাসান নিতেছে বুঝিয়া খুলিয়া পাতায় পাতা।</p>\r\n\r\n<p>ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি। কে এলে তবে ভাই, সোনার গোকুল আঁধার করিয়া এই মথুরার ঠাই। আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। কে এলে তবে ভাই, সোনার গোকুল আঁধার করিয়া এই মথুরার ঠাই।</p>\r\n\r\n<p>কে এলে তবে ভাই, সোনার গোকুল আঁধার করিয়া এই মথুরার ঠাই। হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। বিহগ ছাড়িয়া ভোরের ভজন আহারের সন্ধ্যানে, বাতাসে বাঁধিয়া পাখা-সেতু-বাঁধ ছুটিবে সুদুর-পানে। শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন। হেথা যৌবন যত কিছু এর খাতায় লিখিয়া লয়, পান হতে চুন খসেনাক-এমনি হিসাবময়।</p>\r\n\r\n<p>হেথা যৌবন মেলিয়া ধরিয়া জমা-খরচের খাতা, লাভ লেকাসান নিতেছে বুঝিয়া খুলিয়া পাতায় পাতা। তুমি যে কিশোর তোমার দেশেতে হিসাব নিকাশ নাই, যে আসে নিকটে তাহারেই লও আপন বলিয়া তাই। তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়! হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার?</p>\r\n\r\n<p>হায়রে করুণ হায়, এখনি যে সবে জাগিয়া উঠিবে প্রভাতের কিনারায়। তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। সখালী পাতাও সখাদের সাথে, বিনামূলে দাও প্রাণ, এপারে মোদের মথুরার মত নাই দান-প্রতিদান। আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার। তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি।</p>\r\n\r\n<p>হায়রে করুণ হায়, এখনি যে সবে জাগিয়া উঠিবে প্রভাতের কিনারায়। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল। হেথা যৌবন মেলিয়া ধরিয়া জমা-খরচের খাতা, লাভ লেকাসান নিতেছে বুঝিয়া খুলিয়া পাতায় পাতা। তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়! বিহগ ছাড়িয়া ভোরের ভজন আহারের সন্ধ্যানে, বাতাসে বাঁধিয়া পাখা-সেতু-বাঁধ ছুটিবে সুদুর-পানে।</p>\r\n\r\n<p>সেথায় তোমার কিশোরী বধূটি মাটির প্রদীপ ধরি, তুলসীর মূলে প্রণাম যে আঁকে হয়ত তোমারে স্মরি। হেথা যৌবন যত কিছু এর খাতায় লিখিয়া লয়, পান হতে চুন খসেনাক-এমনি হিসাবময়। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল। তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। এখনো বসিয়া সেঁউতীর মালা গাঁথিছে ভোরের তারা, ঊষার রঙিন শাড়ীখানি তার বুনান হয়নি সারা।</p>\r\n\r\n<p>তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়! হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল। এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে। হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল।</p>\r\n\r\n<p>তরুণ কিশোর! তোমার জীবনে সবে এ ভোরের বেলা, ভোরের বাতাস ভোরের কুসুমে জুড়েছে রঙের খেলা। সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়! ডাকে কেয়াবনে ফুল-মঞ্জরি ঘন-দেয়া সম্পাতে, মাটির বুকেতে তমাল তাহার ফুল-বাহুখানি পাতে। কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা! আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে</p>\r\n\r\n<p>বঁধুর কোলেতে বধুয়া ঘুমায়, খোলেনি বাহুর বাঁধ, দীঘির জলেতে নাহিয়া নাহিয়া মেটেনি তারার সাধ। তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়! রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল। হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল।</p>\r\n\r\n<p>ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। হেথা যৌবন মেলিয়া ধরিয়া জমা-খরচের খাতা, লাভ লেকাসান নিতেছে বুঝিয়া খুলিয়া পাতায় পাতা। মাধবীলতার দোলনা বাঁধিয়া কদম্ব-শাখে শাখে, কিশোর! তোমার কিশোর সখারা তোমারে যে ওই ডাকে। এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি।</p>\r\n\r\n<p>আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি। হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি।</p>\r\n\r\n<p>হেথা যৌবন মেলিয়া ধরিয়া জমা-খরচের খাতা, লাভ লেকাসান নিতেছে বুঝিয়া খুলিয়া পাতায় পাতা। কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা! কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা! মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে। মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে।</p>\r\n\r\n<p>এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি। হায়রে কিশোর হায়! ফুলের পরাণ বিকাতে এসেছ এই পাপ-মথুরায়। হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার? আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার। তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি।</p>', 1, 1, '2026-02-04 14:21:24', '2026-02-16 15:31:10'),
(11, 'হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি', 'হাসিটি-হেথায়-বাজারে-বিকায়-গানের-বেসাত-করি', 'admin', NULL, '2026-02-05 16:26:39', 'হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি', '<p>হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। হেথা যৌবন মেলিয়া ধরিয়া জমা-খরচের খাতা, লাভ লেকাসান নিতেছে বুঝিয়া খুলিয়া পাতায় পাতা। মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে। হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। বঁধুর কোলেতে বধুয়া ঘুমায়, খোলেনি বাহুর বাঁধ, দীঘির জলেতে নাহিয়া নাহিয়া মেটেনি তারার সাধ।</p>\r\n\r\n<p>ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি। হায়রে কিশোর হায়! ফুলের পরাণ বিকাতে এসেছ এই পাপ-মথুরায়। হেথা যৌবন যত কিছু এর খাতায় লিখিয়া লয়, পান হতে চুন খসেনাক-এমনি হিসাবময়। কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা! কালিন্দী লতা গলায় জড়ায়ে সোনার গোকুল কাঁদে ব্রজের দুলাল বাঁধা নাহি পড়ে যেন মথুরার ফাঁদে।</p>\r\n\r\n<p>এখন হইবে লোক জানাজানি, মুখ চেনাচেনি আর, হিসাব নিকাশ হইবে এখন কতটুকু আছে কার। সখালী পাতাও সখাদের সাথে, বিনামূলে দাও প্রাণ, এপারে মোদের মথুরার মত নাই দান-প্রতিদান। কে এলে তবে ভাই, সোনার গোকুল আঁধার করিয়া এই মথুরার ঠাই। কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা! সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়!</p>\r\n\r\n<p>এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে। তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। বিহগ ছাড়িয়া ভোরের ভজন আহারের সন্ধ্যানে, বাতাসে বাঁধিয়া পাখা-সেতু-বাঁধ ছুটিবে সুদুর-পানে। আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে?</p>\r\n\r\n<p>মাধবীলতার দোলনা বাঁধিয়া কদম্ব-শাখে শাখে, কিশোর! তোমার কিশোর সখারা তোমারে যে ওই ডাকে। সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়! কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা! ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি। এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি।</p>\r\n\r\n<p>ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি। কালিন্দী লতা গলায় জড়ায়ে সোনার গোকুল কাঁদে ব্রজের দুলাল বাঁধা নাহি পড়ে যেন মথুরার ফাঁদে। আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার। বিহগ ছাড়িয়া ভোরের ভজন আহারের সন্ধ্যানে, বাতাসে বাঁধিয়া পাখা-সেতু-বাঁধ ছুটিবে সুদুর-পানে। হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার?</p>\r\n\r\n<p>আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে। আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে হায়রে কিশোর হায়! ফুলের পরাণ বিকাতে এসেছ এই পাপ-মথুরায়। এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি।</p>\r\n\r\n<p>তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়। তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার। বিহগ ছাড়িয়া ভোরের ভজন আহারের সন্ধ্যানে, বাতাসে বাঁধিয়া পাখা-সেতু-বাঁধ ছুটিবে সুদুর-পানে। হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল।</p>\r\n\r\n<p>হেথা যৌবন যত কিছু এর খাতায় লিখিয়া লয়, পান হতে চুন খসেনাক-এমনি হিসাবময়। হায়রে করুণ হায়, এখনি যে সবে জাগিয়া উঠিবে প্রভাতের কিনারায়। বিহগ ছাড়িয়া ভোরের ভজন আহারের সন্ধ্যানে, বাতাসে বাঁধিয়া পাখা-সেতু-বাঁধ ছুটিবে সুদুর-পানে। মাধবীলতার দোলনা বাঁধিয়া কদম্ব-শাখে শাখে, কিশোর! তোমার কিশোর সখারা তোমারে যে ওই ডাকে। রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে।</p>\r\n\r\n<p>আজো কানে গোঁজ শিরীষ কুসুম কিংশুক-মঞ্জরী, অলকে বাঁধিয়া পাটল ফুলেতে ভরে লও উত্তরী! কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা! এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি। বঁধুর কোলেতে বধুয়া ঘুমায়, খোলেনি বাহুর বাঁধ, দীঘির জলেতে নাহিয়া নাহিয়া মেটেনি তারার সাধ। সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়!</p>\r\n\r\n<p>সেথায় তোমার কিশোরী বধূটি মাটির প্রদীপ ধরি, তুলসীর মূলে প্রণাম যে আঁকে হয়ত তোমারে স্মরি। ডাকে কেয়াবনে ফুল-মঞ্জরি ঘন-দেয়া সম্পাতে, মাটির বুকেতে তমাল তাহার ফুল-বাহুখানি পাতে। এখনো বসিয়া সেঁউতীর মালা গাঁথিছে ভোরের তারা, ঊষার রঙিন শাড়ীখানি তার বুনান হয়নি সারা। আজো কানে গোঁজ শিরীষ কুসুম কিংশুক-মঞ্জরী, অলকে বাঁধিয়া পাটল ফুলেতে ভরে লও উত্তরী! তরুণ কিশোর! তোমার জীবনে সবে এ ভোরের বেলা, ভোরের বাতাস ভোরের কুসুমে জুড়েছে রঙের খেলা।</p>\r\n\r\n<p>তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল। আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার। মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে।</p>\r\n\r\n<p>আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। কালিন্দী লতা গলায় জড়ায়ে সোনার গোকুল কাঁদে ব্রজের দুলাল বাঁধা নাহি পড়ে যেন মথুরার ফাঁদে। মাধবীলতার দোলনা বাঁধিয়া কদম্ব-শাখে শাখে, কিশোর! তোমার কিশোর সখারা তোমারে যে ওই ডাকে। মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে। সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়!</p>\r\n\r\n<p>এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি। সখালী পাতাও সখাদের সাথে, বিনামূলে দাও প্রাণ, এপারে মোদের মথুরার মত নাই দান-প্রতিদান। আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে হায়রে করুণ হায়, এখনি যে সবে জাগিয়া উঠিবে প্রভাতের কিনারায়। তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি।</p>\r\n\r\n<p>আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার। এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে। ডাকে কেয়াবনে ফুল-মঞ্জরি ঘন-দেয়া সম্পাতে, মাটির বুকেতে তমাল তাহার ফুল-বাহুখানি পাতে। তুমি যে কিশোর তোমার দেশেতে হিসাব নিকাশ নাই, যে আসে নিকটে তাহারেই লও আপন বলিয়া তাই। মাধবীলতার দোলনা বাঁধিয়া কদম্ব-শাখে শাখে, কিশোর! তোমার কিশোর সখারা তোমারে যে ওই ডাকে।</p>\r\n\r\n<p>ডাকে কেয়াবনে ফুল-মঞ্জরি ঘন-দেয়া সম্পাতে, মাটির বুকেতে তমাল তাহার ফুল-বাহুখানি পাতে। হেথা যৌবন মেলিয়া ধরিয়া জমা-খরচের খাতা, লাভ লেকাসান নিতেছে বুঝিয়া খুলিয়া পাতায় পাতা। আজো কানে গোঁজ শিরীষ কুসুম কিংশুক-মঞ্জরী, অলকে বাঁধিয়া পাটল ফুলেতে ভরে লও উত্তরী! তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি। কে এলে তবে ভাই, সোনার গোকুল আঁধার করিয়া এই মথুরার ঠাই।</p>\r\n\r\n<p>আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার। কালিন্দী লতা গলায় জড়ায়ে সোনার গোকুল কাঁদে ব্রজের দুলাল বাঁধা নাহি পড়ে যেন মথুরার ফাঁদে। ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি। শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন। ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি?</p>\r\n\r\n<p>আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। সেথায় তোমার কিশোরী বধূটি মাটির প্রদীপ ধরি, তুলসীর মূলে প্রণাম যে আঁকে হয়ত তোমারে স্মরি। হেথা যৌবন মেলিয়া ধরিয়া জমা-খরচের খাতা, লাভ লেকাসান নিতেছে বুঝিয়া খুলিয়া পাতায় পাতা। তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়! তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে?</p>\r\n\r\n<p>বিহগ ছাড়িয়া ভোরের ভজন আহারের সন্ধ্যানে, বাতাসে বাঁধিয়া পাখা-সেতু-বাঁধ ছুটিবে সুদুর-পানে। তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি। এখন হইবে লোক জানাজানি, মুখ চেনাচেনি আর, হিসাব নিকাশ হইবে এখন কতটুকু আছে কার। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল। শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন।</p>\r\n\r\n<p>তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। এখন হইবে লোক জানাজানি, মুখ চেনাচেনি আর, হিসাব নিকাশ হইবে এখন কতটুকু আছে কার। শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন। তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়।</p>\r\n\r\n<p>হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল। মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে। মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে। সখালী পাতাও সখাদের সাথে, বিনামূলে দাও প্রাণ, এপারে মোদের মথুরার মত নাই দান-প্রতিদান। আজো কানে গোঁজ শিরীষ কুসুম কিংশুক-মঞ্জরী, অলকে বাঁধিয়া পাটল ফুলেতে ভরে লও উত্তরী!</p>\r\n\r\n<p>আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার। তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার? সেথায় তোমার কিশোরী বধূটি মাটির প্রদীপ ধরি, তুলসীর মূলে প্রণাম যে আঁকে হয়ত তোমারে স্মরি। তরুণ কিশোর! তোমার জীবনে সবে এ ভোরের বেলা, ভোরের বাতাস ভোরের কুসুমে জুড়েছে রঙের খেলা।</p>\r\n\r\n<p>তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়। সেথায় তোমার কিশোরী বধূটি মাটির প্রদীপ ধরি, তুলসীর মূলে প্রণাম যে আঁকে হয়ত তোমারে স্মরি। বঁধুর কোলেতে বধুয়া ঘুমায়, খোলেনি বাহুর বাঁধ, দীঘির জলেতে নাহিয়া নাহিয়া মেটেনি তারার সাধ। এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি। শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন।</p>\r\n\r\n<p>তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়! তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার। হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল।</p>\r\n\r\n<p>সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়! তরুণ কিশোর! তোমার জীবনে সবে এ ভোরের বেলা, ভোরের বাতাস ভোরের কুসুমে জুড়েছে রঙের খেলা। হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার? তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়। আজো কানে গোঁজ শিরীষ কুসুম কিংশুক-মঞ্জরী, অলকে বাঁধিয়া পাটল ফুলেতে ভরে লও উত্তরী!</p>\r\n\r\n<p>শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন। ডাকে কেয়াবনে ফুল-মঞ্জরি ঘন-দেয়া সম্পাতে, মাটির বুকেতে তমাল তাহার ফুল-বাহুখানি পাতে। মাধবীলতার দোলনা বাঁধিয়া কদম্ব-শাখে শাখে, কিশোর! তোমার কিশোর সখারা তোমারে যে ওই ডাকে। সেথায় তোমার কিশোরী বধূটি মাটির প্রদীপ ধরি, তুলসীর মূলে প্রণাম যে আঁকে হয়ত তোমারে স্মরি। তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি।</p>', 0, 1, '2026-02-04 19:34:37', '2026-02-05 17:11:51'),
(12, 'তুমি ভাই সেই ব্রজের রাখাল', 'তুমি-ভাই-সেই-ব্রজের-রাখাল', 'admin', NULL, '2026-02-05 16:35:26', 'তুমি ভাই সেই ব্রজের রাখাল', '<p>তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি। সেথায় তোমার কিশোরী বধূটি মাটির প্রদীপ ধরি, তুলসীর মূলে প্রণাম যে আঁকে হয়ত তোমারে স্মরি। হেথা যৌবন যত কিছু এর খাতায় লিখিয়া লয়, পান হতে চুন খসেনাক-এমনি হিসাবময়। হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল। তরুণ কিশোর! তোমার জীবনে সবে এ ভোরের বেলা, ভোরের বাতাস ভোরের কুসুমে জুড়েছে রঙের খেলা।</p>\r\n\r\n<p>সখালী পাতাও সখাদের সাথে, বিনামূলে দাও প্রাণ, এপারে মোদের মথুরার মত নাই দান-প্রতিদান। তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়! হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল। তুমি যে কিশোর তোমার দেশেতে হিসাব নিকাশ নাই, যে আসে নিকটে তাহারেই লও আপন বলিয়া তাই। তরুণ কিশোর! তোমার জীবনে সবে এ ভোরের বেলা, ভোরের বাতাস ভোরের কুসুমে জুড়েছে রঙের খেলা।</p>\r\n\r\n<p>ডাকে কেয়াবনে ফুল-মঞ্জরি ঘন-দেয়া সম্পাতে, মাটির বুকেতে তমাল তাহার ফুল-বাহুখানি পাতে। শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন। আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার? তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে?</p>\r\n\r\n<p>হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার? হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল। তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি। তুমি যে কিশোর তোমার দেশেতে হিসাব নিকাশ নাই, যে আসে নিকটে তাহারেই লও আপন বলিয়া তাই।</p>\r\n\r\n<p>ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে। ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি। আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে এখনো বসিয়া সেঁউতীর মালা গাঁথিছে ভোরের তারা, ঊষার রঙিন শাড়ীখানি তার বুনান হয়নি সারা।</p>', 2, 1, '2026-02-05 16:28:10', '2026-02-16 16:19:36'),
(13, 'আমার বাংলা নিয়ে প্রথম কাজ', 'আমার-বাংলা-নিয়ে-প্রথম-কাজ', 'admin', NULL, '2026-02-08 16:15:59', 'অর্থহীন লেখা যার মাঝে আছে অনেক কিছু। হ্যাঁ, এই লেখার মাঝেই আছে অনেক কিছু। যদি তুমি মনে করো, এটা তোমার কাজে লাগবে, তাহলে তা লাগবে কাজে। নিজের ভাষায় লেখা দেখতে অভ্যস্ত হও।', '<p>আমার বাংলা নিয়ে প্রথম কাজ করবার সুযোগ তৈরি হয়েছিল abc নামক এক যুগান্তকারী বাংলা সফ্&zwnj;টওয়্যার হাতে পাবার মধ্য দিয়ে। এর পর একে একে বাংলা উইকিপিডিয়া, ওয়ার্ডপ্রেস বাংলা কোডেক্সসহ বিভিন্ন বাংলা অনলাইন পত্রিকা তৈরির কাজ করতে করতে বাংলার সাথে নিজেকে বেঁধে নিয়েছি আষ্টেপৃষ্ঠে। বিশেষ করে অনলাইন পত্রিকা তৈরি করতে ডিযাইন করার সময়, সেই ডিযাইনকে কোডে রূপান্তর করবার সময় বারবার অনুভব করেছি কিছু নমুনা লেখার। যে লেখাগুলো ফটোশপে বসিয়ে বাংলায় ডিযাইন করা যাবে, আবার সেই লেখাই অনলাইনে ব্যবহার করা যাবে। কিন্তু দুঃখজনক হলেও সত্য যে, ইংরেজিতে লাতিন Lorem Ipsum&hellip; সূচক নমুনা লেখা (dummy texts) থাকলেও বাংলা ভাষায় এরকম কোনো লেখা নেই। তাই নিজের তাগিদেই বাংলা ভাষার জন্য প্রথম নমুনা লেখা তৈরি করলাম, এ হলো বাংলা Lorem ipsum&nbsp;&ndash; কিন্তু তার অনুবাদ নয়। আমি একে নামকরণ করেছি:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>অর্থহীন লেখা যার মাঝে আছে অনেক কিছু। হ্যাঁ, এই লেখার মাঝেই আছে অনেক কিছু। যদি তুমি মনে করো, এটা তোমার কাজে লাগবে, তাহলে তা লাগবে কাজে। নিজের ভাষায় লেখা দেখতে অভ্যস্ত হও। মনে রাখবে লেখা অর্থহীন হয়, যখন তুমি তাকে অর্থহীন মনে করো; আর লেখা অর্থবোধকতা তৈরি করে, যখন তুমি তাতে অর্থ ঢালো। যেকোনো লেখাই তোমার কাছে অর্থবোধকতা তৈরি করতে পারে, যদি তুমি সেখানে অর্থদ্যোতনা দেখতে পাও। &hellip;ছিদ্রান্বেষণ? না, তা হবে কেন?</p>\r\n\r\n<p>যে কথাকে কাজে লাগাতে চাও, তাকে কাজে লাগানোর কথা চিন্তা করার আগে ভাবো, তুমি কি সেই কথার জাদুতে আচ্ছন্ন হয়ে গেছ কিনা। তুমি যদি নিশ্চিত হও যে, তুমি কোনো মোহাচ্ছাদিত আবহে আবিষ্ট হয়ে অন্যের শেখানো বুলি আত্মস্থ করছো না, তাহলে তুমি নির্ভয়ে, নিশ্চিন্তে অগ্রসর হও। তুমি সেই কথাকে জানো, বুঝো, আত্মস্থ করো; মনে রাখবে, যা অনুসরণ করতে চলেছো, তা আগে অনুধাবন করা জরুরি; এখানে কিংকর্তব্যবিমূঢ় হবার কোনো সুযোগ নেই।</p>\r\n\r\n<p>কোনো কথা শোনামাত্রই কি তুমি তা বিশ্বাস করবে? হয়তো বলবে, করবে, হয়তো বলবে &ldquo;আমি করবো না।&rdquo; হ্যা, &ldquo;আমি করবো না&rdquo; বললেই সবকিছু অস্বীকার করা যায় না, হয়তো তুমি মনের গহীন গভীর থেকে ঠিকই বিশ্বাস করতে শুরু করেছো সেই কথাটি, কিন্তু মুখে অস্বীকার করছো। তাই সচেতন থাকো, তুমি কী ভাবছো&mdash; তার প্রতি; সচেতন থাকো, তুমি কি আসলেই বিশ্বাস করতে চলেছো ঐ কথাটি&hellip; শুধু এতটুকু বলি, যা-ই বিশ্বাস করো না কেন, আগে যাচাই করে নাও; আর এতে চাই তোমার প্রত্যুৎপন্নমতিত্ব।</p>\r\n\r\n<p>তাই কোন কথাটি কাজে লাগবে, তা নির্ধারণ করবে তুমি&mdash; হ্যাঁ, তুমি। হয়তো সামান্য ক&rsquo;টা বাংলা অক্ষর: খন্ড-ত, অনুস্বার, বিঃসর্গ কিংবা চন্দ্রবিন্দু&mdash; কিন্তু যদি তুমি বিশ্বাস করো, তাহলে হয়তো তুমি তা দিয়েই তৈরি করতে পারো এক উচ্চমার্গীয় মহাকাব্য- এক চিরসবুজ অর্ঘ্য। রচিত হতে পারে পৃথিবীর ১ম বিরাম চিহ্নের ইতিকথা &ndash; এক নতুন ঊষা। &hellip;মহাকাব্য লিখতে ঋষি-মুনি হওয়া লাগে না।<br />\r\nঅর্থহীনতা আর অর্থদ্যোতনার সেই ঈর্ষাকাতর মোহাবিষ্টতা তাই তৈরি করে নাও নিজের মাঝে- চাই একটুখানি ঔৎসুক্য। নিজেই ঠিক করো, নিজের ভাষাটা কি অর্থহীন, নাকি কিছু সত্যিই বলছে!</p>', 2, 1, '2026-02-08 16:15:50', '2026-02-16 14:54:43'),
(14, 'আমার পেশাগত কাজেই ওয়েব ডিযাইন', 'আমার-পেশাগত-কাজেই-ওয়েব-ডিযাইন', 'admin', NULL, '2026-02-08 16:23:10', 'কিংবা ওয়েব ডেভলপমেন্টের সময় আমরা যখন প্রয়োজনীয় লেখার যোগান পেতাম না, তখন লাতিন হরফের lorem ipsum দিয়ে সেই ঘাটতি পূরণ করতাম। তখন বাংলায় বিভিন্ন ওয়েবসাইট, ওয়েবপোর্টাল তৈরি করবার সময় লোরেম ইপসামের মতোই কিছু একটার খুব অভাব অনুভব করি।', '<p>আমার পেশাগত কাজেই ওয়েব ডিযাইন, কিংবা ওয়েব ডেভলপমেন্টের সময় আমরা যখন প্রয়োজনীয় লেখার যোগান পেতাম না, তখন লাতিন হরফের lorem ipsum দিয়ে সেই ঘাটতি পূরণ করতাম। তখন বাংলায় বিভিন্ন ওয়েবসাইট, ওয়েবপোর্টাল তৈরি করবার সময় লোরেম ইপসামের মতোই কিছু একটার খুব অভাব অনুভব করি। তখন তো লোরেম ইপসাম জেনারেটর তৈরির জ্ঞানগম্যি ছিলো না বলে সাহিত্যজ্ঞান দিয়ে তৈরি করি &ldquo;অর্থহীন লেখা&rdquo;। সেটাই&nbsp;&nbsp;২০১৪ খ্রিষ্টাব্দে। সেসময় অনেকেই এর উপকার ভোগ করেছেন, অনেক ওয়েবসাইটে এখনও &lsquo;অর্থহীন লেখা&rsquo;র অস্তিত্ব পাওয়া যায়।</p>\r\n\r\n<p>দীর্ঘদিন থেকে ব্লগটা বন্ধ ছিলো বলে ২০২৩-এ এসে আমি একটা বাংলা লোরেম ইপসাম জেনারেটর তৈরির পরিকল্পনা করি। প্রথমত সেখানে আমার সেই &lsquo;অর্থহীন লেখা&rsquo;টা থাকবে, আর সাথে মানুষের নাম তৈরি করবার যন্ত্রও থাকবে। ঠিক তখনই সাইফুল ইসলাম রাসেল-এর তৈরি&nbsp;-এর কাজটা দৃষ্টি আকর্ষণ করলো আমার, যা মূলত Corporate Ipsum-এর আদলে তৈরি করা। সেখানে কোডগুলো অবশ্য অগোছালো ছিলো, আর বেশ কিছু deprecated কোডও ছিলো। ঠিক করলাম, তাঁর এই কাজটাকেও পুণর্জীবিত করা যেতে পারে। তখন এই তিনটে জিনিসকেই একত্র করে কাজে হাত দিলাম।</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>কী আছে এতে?</h3>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>আমার কাজের ডিযাইন হিসেবে আমি Corporate Ipsum Chromium Extension-এর ডিযাইনটাকে প্রাথমিক আদল হিসেবে নিয়ে কাজ শুরু করলাম। প্রথমেই নাম তৈরির কাজটি করতে শুরু করলাম। এই নাম তৈরির ধারণা আমি প্রথম পেয়েছিলাম Laravel-এর Faker প্যাকেজ থেকে। সেই ধারণা নিয়েই বাঙালি মানুষের নামের &ldquo;শুরুর অংশ&rdquo; আর &ldquo;শেষাংশ&rdquo; জোড়া লাগিয়ে কাজে হাত দিলাম। জাভাস্ক্রিপ্ট দিয়ে খুব দ্রুত একটা বানিয়েও ফেললাম।</p>\r\n\r\n<p>কিন্তু শুরুতেই ঘটলো বিপত্তি!</p>\r\n\r\n<p>যে নামগুলো তৈরি হচ্ছে, তা খুবই বিদঘুটে শোনাচ্ছে। যেমন ধরা যাক, রবীন্দ্রনাথ খাতুন, বনলতা আলম কিংবা মোহাম্মদ রোজারিও। ঠিক করলাম এর একটা বিহীত করা দরকার। বুঝলাম বাংলাতে যেমন নামের প্রশ্নে ধর্মের একটা গুরুত্বপূর্ণ প্রভাব আছে, তেমনি লিঙ্গের প্রভাব আছে। তাই বাধ্য হয়ে নামের অংশগুলোকে ধর্ম আর লিঙ্গে ভাগ করতে বাধ্য হলাম। খ্রিষ্টান, বৌদ্ধ, মুসলমান, হিন্দু &ndash; এই চার ধর্মের মানুষের নাম খুঁজে নামের দুটো অংশ বসালাম। তার মধ্যে আবার পুরুষ আর নারীর নাম আলাদা করলাম। তারপর এগুলোর সমন্বয় করে নাম তৈরি করলাম। সহজ কাজটা একটু জটিল হলো বটে, তবে এবারে নামগুলো বাস্তবসম্মত হয়ে উঠলো।</p>\r\n\r\n<p>বাংলালোরেম-এর জেনারেটর নিয়ে কাজ করবার সময় আমি বাংলাদেশের পল্লীকবি জসিমউদ্দীনের &ldquo;তরুণ কিশোর&rdquo; কবিতাটি ব্যবহার করলাম। কবিতাটি এই প্রথম বোধহয় দেখলাম কিংবা এই প্রথম মনোযোগ দিয়ে পড়লাম। কবিতাটি আমার মনে ধরলো বেশ (ঈশ্বরের কাছে তাঁর আত্মার শান্তি কমনা করি)। এই কবিতাটি ব্যবহার করবার সময় গদ্য-বাক্য তৈরি করবার সুবিধার্থে কবিতার কয়েকটা চরণকে একত্রে জুড়ে নিতে বাধ্য হলাম অবশ্য। তবে আশানুরূপ ফলাফল পেয়ে ভালো লাগলো।</p>\r\n\r\n<p><ins data-ad-client=\"ca-pub-3526212672565487\" data-ad-format=\"auto\" data-ad-status=\"unfilled\" data-adsbygoogle-status=\"done\"><iframe allow=\"attribution-reporting; run-ad-auction\" allowtransparency=\"true\" aria-label=\"Advertisement\" data-google-container-id=\"a!3\" data-google-query-id=\"COPrhMOlypIDFerwFgUdiEImMw\" data-load-complete=\"true\" frameborder=\"0\" height=\"0\" hspace=\"0\" id=\"aswift_2\" marginheight=\"0\" marginwidth=\"0\" name=\"aswift_2\" sandbox=\"allow-forms allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts allow-top-navigation-by-user-activation\" scrolling=\"no\" src=\"https://googleads.g.doubleclick.net/pagead/ads?client=ca-pub-3526212672565487&amp;output=html&amp;h=280&amp;adk=1515812176&amp;adf=4212326266&amp;pi=t.aa~a.1376357989~i.15~rp.4&amp;w=700&amp;fwrn=4&amp;fwrnh=100&amp;lmt=1770588987&amp;rafmt=1&amp;armr=3&amp;sem=mc&amp;pwprc=1167521840&amp;ad_type=text_image&amp;format=700x280&amp;url=https%3A%2F%2Fnishachor.com%2Fbangla-lorem-ipsum%2F&amp;host=ca-host-pub-2644536267352236&amp;fwr=0&amp;pra=3&amp;rh=175&amp;rw=699&amp;rpe=1&amp;resp_fmts=3&amp;aieuf=1&amp;aicrs=1&amp;fa=27&amp;uach=WyJXaW5kb3dzIiwiMTAuMC4wIiwieDg2IiwiIiwiMTQ0LjAuNzU1OS4xMzMiLG51bGwsMCxudWxsLCI2NCIsW1siTm90KEE6QnJhbmQiLCI4LjAuMC4wIl0sWyJDaHJvbWl1bSIsIjE0NC4wLjc1NTkuMTMzIl0sWyJHb29nbGUgQ2hyb21lIiwiMTQ0LjAuNzU1OS4xMzMiXV0sMF0.&amp;abgtt=9&amp;dt=1770567394963&amp;bpp=2&amp;bdt=2534&amp;idt=2&amp;shv=r20260204&amp;mjsv=m202602030101&amp;ptt=9&amp;saldr=aa&amp;abxe=1&amp;cookie=ID%3D5014397cbd767514%3AT%3D1770567389%3ART%3D1770567389%3AS%3DALNI_MaYeYyacw-XyztGPGoa4cEo9JjFiw&amp;gpic=UID%3D000011f737fa35d0%3AT%3D1770567389%3ART%3D1770567389%3AS%3DALNI_MYS1MWqbUdykVV91pqY1bPPzbrQ3w&amp;eo_id_str=ID%3D3a6df921c2118e95%3AT%3D1770567389%3ART%3D1770567389%3AS%3DAA-Afjas_1YkMkW8UHF0ASnolm-s&amp;prev_fmts=264x600%2C0x0&amp;nras=2&amp;correlator=770909526587&amp;frm=20&amp;pv=1&amp;u_tz=330&amp;u_his=3&amp;u_h=768&amp;u_w=1366&amp;u_ah=728&amp;u_aw=1366&amp;u_cd=24&amp;u_sd=1&amp;dmc=8&amp;adx=176&amp;ady=1538&amp;biw=1351&amp;bih=641&amp;scr_x=0&amp;scr_y=500&amp;eid=95378429%2C95381033%2C95381248%2C95382604%2C95382733&amp;oid=2&amp;pvsid=6171203092094896&amp;tmod=1702498510&amp;uas=0&amp;nvt=1&amp;ref=https%3A%2F%2Fwww.google.com%2F&amp;fc=384&amp;brdim=0%2C0%2C0%2C0%2C1366%2C0%2C1366%2C728%2C1366%2C641&amp;vis=1&amp;rsz=%7C%7Cs%7C&amp;abl=NS&amp;fu=128&amp;bc=31&amp;bz=1&amp;pgls=CAEaBTYuOS4x~CAEQBBoHMS4xNzEuMA..&amp;num_ads=1&amp;ifi=3&amp;uci=a!3&amp;btvi=1&amp;fsb=1&amp;dtd=8\" tabindex=\"0\" title=\"Advertisement\" vspace=\"0\" width=\"700\"></iframe></ins></p>\r\n\r\n<p>টেক্সট জেনারেটরটির বাংলা নাম দিলাম &ldquo;রচনাযন্তর&rdquo;। ইংরেজি &lsquo;generator&rsquo; শব্দটির বাংলা দেখলাম &lsquo;উৎপাদক&rsquo;। নামটা কেমন জানি বিশ্রী শোনাচ্ছিলো আমার কানে। তাই আমি নাম দিলাম &ldquo;রচনাযন্ত্র&rdquo;, একটু সাবলীল করে করলাম &ldquo;রচনাযন্তর&rdquo;। কিন্তু রচনাযন্তরটিতে লক্ষ করলাম, মূল কবিতার বিভিন্ন hyphen &lsquo;শব্দ&rsquo; তৈরির সময় বিশ্রীভাবে শেষে দেখা দিচ্ছে। তাই তারও বিহীত করলাম।</p>\r\n\r\n<h3>দেখতে কেমন?</h3>\r\n\r\n<p>পেশায় ডিযাইনার হওয়ায় বেশ কয়েকবার ডিযাইন বদল করলাম। সবশেষে তিনটি tab-এ তিনটি ফিচার আলাদা করে মনে হলো, এবারে কিছুটা গোছানো হয়েছে কাজটা। তাই শেষ পর্যন্ত প্রকাশের সিদ্ধান্ত নিলাম&hellip;</p>\r\n\r\n<figure>\r\n<figcaption>বাংলা নমুনা লেখা তৈরির যন্ত্রটির দুটো পর্দাদৃশ্য</figcaption>\r\n</figure>\r\n\r\n<h3>কী কী করা যাবে?</h3>\r\n\r\n<p>এই যন্ত্রটি দিয়ে যে কাজগুলো করা যাবে:</p>\r\n\r\n<ol>\r\n	<li>রচনাযন্তর দিয়ে\r\n	<ul>\r\n		<li><strong>বাংলা অনুচ্ছেদ</strong>&nbsp;তৈরি করা যাবে (সর্বোচ্চ ১০০ অনুচ্ছেদ)</li>\r\n		<li><strong>বাংলা বাক্য</strong>&nbsp;তৈরি করা যাবে (সর্বোচ্চ ১০০ বাক্য)</li>\r\n		<li><strong>বাংলা শব্দ</strong>&nbsp;তৈরি করা যাবে (সর্বোচ্চ ১০০ শব্দ)</li>\r\n		<li>অনুচ্ছেদ, বাক্য, কিংবা শব্দ সম্পূর্ণটুকু&nbsp;<strong>এক ক্লিকে কপি</strong>&nbsp;করা যাবে</li>\r\n	</ul>\r\n	</li>\r\n	<li>নাম হিসেবে\r\n	<ul>\r\n		<li>ধর্মনির্বিশেষে&nbsp;<strong>পুরুষের নাম</strong>&nbsp;পাওয়া যাবে</li>\r\n		<li>ধর্মনির্বিশেষে&nbsp;<strong>নারীর নাম</strong>&nbsp;পাওয়া যাবে</li>\r\n		<li>তৈরিকৃত প্রতিটা নামের উপর ক্লিক করলে ঐ&nbsp;<strong>নামটি কপি</strong>&nbsp;হয়ে যাবে</li>\r\n		<li>তৈরিকৃত সকল নাম একত্রে&nbsp;<strong>এক ক্লিকে কপি</strong>&nbsp;করা যাবে</li>\r\n	</ul>\r\n	</li>\r\n	<li>একটি পূর্ণাঙ্গ নমুনা লেখা হিসেবে&nbsp;<strong>&ldquo;অর্থহীন লেখা&rdquo;</strong>&nbsp;পাওয়া যাবে\r\n	<ul>\r\n		<li>পূর্ণাঙ্গ লেখাটি&nbsp;<strong>এক ক্লিকে কপি</strong>&nbsp;করা যাবে</li>\r\n	</ul>\r\n	</li>\r\n</ol>\r\n\r\n<h3>কোথায় পাওয়া যাবে এই যন্ত্র?</h3>\r\n\r\n<p>যন্ত্রটি নিচের লিংক থেকে যে-কেউ&nbsp;<strong>বিনামূল্যে&nbsp;</strong>ব্যবহার করতে পারবেন। ভালো লাগলে&nbsp;&nbsp;Star দিয়ে ভালোবাসা প্রকাশও করতে পারবেন।</p>', 0, 1, '2026-02-08 16:20:15', '2026-02-08 16:23:10');
INSERT INTO `news_posts` (`id`, `headline`, `slug`, `author`, `sub_author_id`, `post_date_time`, `short_description`, `description`, `views`, `status`, `created_at`, `updated_at`) VALUES
(15, 'আচ্ছা সমুদ্রের বয়স কত', 'আচ্ছা-সমুদ্রের-বয়স-কত', 'admin', NULL, '2026-02-08 16:26:38', 'পৃথিবীতে এতো এতো মহাপন্ডিত থাকলেও বিজ্ঞানীরাই আমাদের এমন প্রশ্নের জবাব দিতে পারেন। তাও সব বিজ্ঞানী না, ভূবিজ্ঞানী কিংবা পানি বিজ্ঞানী। কিভাবে তাঁরা সেটা করবেন?', '<p>আচ্ছা, সমুদ্রের বয়স কত? পৃথিবীতে এতো এতো মহাপন্ডিত থাকলেও বিজ্ঞানীরাই আমাদের এমন প্রশ্নের জবাব দিতে পারেন। তাও সব বিজ্ঞানী না, ভূবিজ্ঞানী কিংবা পানি বিজ্ঞানী। কিভাবে তাঁরা সেটা করবেন?</p>\r\n\r\n<p><strong>পদ্ধতি ১:</strong>&nbsp;পৃথিবীর সমস্ত নদীতে কতখানি লবণ আছে তা মাপা হয়েছে। প্রতি বছর পৃথিবীর সমস্ত নদী থেকে কতখানি লবণ সমুদ্রে এসে পড়ছে, তাও মাপা হয়েছে। এই দ্বিতীয় সংখ্যা দিয়ে প্রথম সংখ্যাকে ভাগ করলে &lsquo;সমুদ্রের বয়স&rsquo; পাওয়া যায়।</p>\r\n\r\n<blockquote>\r\n<p><strong>সমুদ্রের বয়স = (পৃথিবীর সব নদীর লবণ) &divide; (এক বছরে সমুদ্রে পড়া লবণ)</strong></p>\r\n</blockquote>\r\n\r\n<p><strong>পদ্ধতি ২:</strong>&nbsp;পৃথিবীর সমস্ত নদী কতখানি মাটি বয়ে নিয়ে যায় তাও মাপা হয়েছে। এই মাটি ধীরে ধীরে সমুদ্রতলে তলানি হয়ে জমে শিলার রূপ নিয়েছে। একে বলা হয় &lsquo;পাললিক শিলা&rsquo;। এই পাললিক শিলার &lsquo;গভীরত্ব&rsquo; মেপে সেই সংখ্যাকে প্রতি বছর নদীবাহিত সমুদ্রগর্ভের মাটির পরিমাণের সংখ্যা দিয়ে ভাগ করলে সমুদ্রের বয়সের একটা ধারণা পাওয়া যায়।</p>\r\n\r\n<blockquote>\r\n<p><strong>সমুদ্রের বয়স = (পাললিক শিলার গভীরত্ব) &divide; (এক বছরে সমুদ্রে পড়া মাটি)</strong></p>\r\n</blockquote>\r\n\r\n<p>এতটুকু আমি জেনেছি বাংলাদেশের একটা পাঠ্যবই থেকে। কিন্তু মনে একটা প্রশ্ন আমার মনে হয় আপনাদেরও খচখচ করছে যে, ঐ বিজ্ঞানী ব্যাটারা পৃথিবীর এত এত নদীর ট্রিলিয়ন ট্রিলিয়ন পানির লবণ কিভাবে মাপলেন? এটা কি বাথরুমের বালতির পানি পেয়েছে নাকি? দুঃখের কথা হলো: উত্তরটা আমারও জানা নেই। যেদিন জানবো, সেদিন তাও ইনশাল্লাহ জানাবো। তবে এখন একটা ধারণা করতে পারি আমরা:</p>\r\n\r\n<p>যেমন আদমশুমারির লোকেরা বাংলাদেশের মানুষের মাথাপিছু আয় জানার জন্য সারা বাংলাদেশের স-ব লোককে গিয়ে ধরে ধরে জিজ্ঞাসা করেন না। তারাও অনেকের কাছে যেতে পারে না। তারপরও ওটাকে বাংলাদেশের মাথাপিছু আয় হিসেবে ধরা হয় (যদিও অনেকের আয় তাতে বাদ পড়েছে)। তেমনি নদীর লবণ হিসাব করার ক্ষেত্রে কিছু পরিমাণ লবণ বাদ পড়লে ক্ষতি নেই। ওটাকে পরিসংখ্যানের ভাষায়&nbsp;<em>স্ট্যান্ডার্ড এরর</em>&nbsp;(<em>পরিমিত ভ্রান্তি</em>?) হিসেবে মেনে নেয়া হয়।</p>\r\n\r\n<p><ins data-ad-client=\"ca-pub-3526212672565487\" data-ad-format=\"auto\" data-ad-status=\"unfilled\" data-adsbygoogle-status=\"done\"><iframe allow=\"attribution-reporting; run-ad-auction\" allowtransparency=\"true\" aria-label=\"Advertisement\" data-google-container-id=\"a!3\" data-google-query-id=\"CIeuv72nypIDFe-F6QUdjCI7IQ\" data-load-complete=\"true\" frameborder=\"0\" height=\"0\" hspace=\"0\" id=\"aswift_2\" marginheight=\"0\" marginwidth=\"0\" name=\"aswift_2\" sandbox=\"allow-forms allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts allow-top-navigation-by-user-activation\" scrolling=\"no\" src=\"https://googleads.g.doubleclick.net/pagead/ads?client=ca-pub-3526212672565487&amp;output=html&amp;h=280&amp;adk=4258928764&amp;adf=2695843237&amp;pi=t.aa~a.1376357989~i.13~rp.4&amp;w=700&amp;fwrn=4&amp;fwrnh=100&amp;lmt=1770549341&amp;rafmt=1&amp;armr=3&amp;sem=mc&amp;pwprc=1167521840&amp;ad_type=text_image&amp;format=700x280&amp;url=https%3A%2F%2Fnishachor.com%2Fage-of-the-sea-how-science-measures%2F&amp;host=ca-host-pub-2644536267352236&amp;fwr=0&amp;pra=3&amp;rh=175&amp;rw=699&amp;rpe=1&amp;resp_fmts=3&amp;aieuf=1&amp;aicrs=1&amp;fa=27&amp;uach=WyJXaW5kb3dzIiwiMTAuMC4wIiwieDg2IiwiIiwiMTQ0LjAuNzU1OS4xMzMiLG51bGwsMCxudWxsLCI2NCIsW1siTm90KEE6QnJhbmQiLCI4LjAuMC4wIl0sWyJDaHJvbWl1bSIsIjE0NC4wLjc1NTkuMTMzIl0sWyJHb29nbGUgQ2hyb21lIiwiMTQ0LjAuNzU1OS4xMzMiXV0sMF0.&amp;abgtt=9&amp;dt=1770567920223&amp;bpp=1&amp;bdt=586&amp;idt=-M&amp;shv=r20260204&amp;mjsv=m202602030101&amp;ptt=9&amp;saldr=aa&amp;abxe=1&amp;cookie=ID%3D5014397cbd767514%3AT%3D1770567389%3ART%3D1770567915%3AS%3DALNI_MaYeYyacw-XyztGPGoa4cEo9JjFiw&amp;gpic=UID%3D000011f737fa35d0%3AT%3D1770567389%3ART%3D1770567915%3AS%3DALNI_MYS1MWqbUdykVV91pqY1bPPzbrQ3w&amp;eo_id_str=ID%3D3a6df921c2118e95%3AT%3D1770567389%3ART%3D1770567915%3AS%3DAA-Afjas_1YkMkW8UHF0ASnolm-s&amp;prev_fmts=264x600%2C0x0&amp;nras=2&amp;correlator=3478649342468&amp;frm=20&amp;pv=1&amp;u_tz=330&amp;u_his=5&amp;u_h=768&amp;u_w=1366&amp;u_ah=728&amp;u_aw=1366&amp;u_cd=24&amp;u_sd=1&amp;dmc=8&amp;adx=176&amp;ady=1203&amp;biw=1351&amp;bih=641&amp;scr_x=0&amp;scr_y=13&amp;eid=95378429%2C95381032%2C95381247%2C95382066%2C95382074%2C95382339%2C95382730%2C95382845&amp;oid=2&amp;pvsid=8146435257585096&amp;tmod=1702498510&amp;uas=1&amp;nvt=1&amp;ref=https%3A%2F%2Fnishachor.com%2Fbangla-lorem-ipsum%2F&amp;fc=384&amp;brdim=0%2C0%2C0%2C0%2C1366%2C0%2C1366%2C728%2C1366%2C641&amp;vis=1&amp;rsz=%7C%7Cs%7C&amp;abl=NS&amp;fu=128&amp;bc=31&amp;bz=1&amp;pgls=CAEaBTYuOS4x~CAEQBBoHMS4xNzEuMA..&amp;num_ads=1&amp;ifi=3&amp;uci=a!3&amp;btvi=1&amp;fsb=1&amp;dtd=9\" tabindex=\"0\" title=\"Advertisement\" vspace=\"0\" width=\"700\"></iframe></ins></p>\r\n\r\n<p>এবারে ধরা যাক, বিজ্ঞানীরা পদ্মা নদীর লবণাক্ততা পরিমাপ করবেন। তাঁরা পদ্মা নদীর মুখে গিয়ে কিছু পরিমাণ (মানে একটা নির্দিষ্ট পরিমাণ, ধরা যাক এক লিটার) পানি নিবেন, আর তার লবণাক্ততা পরিমাপ করবেন। এবারে ধরা যাক আরো একশ মাইল দূরে এসে তাঁরা আরো কিছু পানি নিলেন এবং লবণাক্ততা পরিমাপ করলেন। এভাবে কয়েক&rsquo;শ মাইল পরপর পানির লবণাক্ততা পরিমাপ করা শেষে তাঁরা এতটুকু ড্যাটা&rsquo;র গড় (average) করবেন, যাকে পরিসংখ্যানের ভাষায়&nbsp;<em>মীন</em>&nbsp;(mean) বলে।</p>\r\n\r\n<p>আপাতত এই গড় বোঝাচ্ছে প্রতি একশ মাইল পরপর নদীর পানিতে লবণাক্ততা&nbsp;<em>এত</em>&nbsp;পরিমাণ বেড়ে যাচ্ছে। এবারে তাঁরা আরো কয়েক হাজার মাইল দূরে গিয়ে এভাবেই আরো কয়েক&rsquo;শ মাইলের লবণাক্ততার পরপর হিসাব নিবেন। ওখানকার হিসাবেরও মীন করা হবে। এই যে হাজার মাইল দূরে গেলেন তাঁরা, কেন গেলেন? কেন তাঁরা কয়েক লাখ মাইল দূরে গেলেন না? আসলে এটাও পরিসংখ্যানের একটা বিষয়, এটাকে বলা হয়&nbsp;<em>র&zwnj;্যান্ডম স্যাম্পলিং</em>&nbsp;(random sampling), বাংলায়&nbsp;<em>দৈব চয়ন</em>। আপনার ইচ্ছা হলে আপনি কয়েক লাখ মাইল দূরের স্যাম্পল সংগ্রহ করতে পারেন। তবে যদি তা করেন, তবে প্রত্যেকবারই তা-ই করতে হবে। তাহলে এটা তথ্যের সত্যনিষ্ঠতা বোঝাবে।</p>\r\n\r\n<p><ins data-ad-client=\"ca-pub-3526212672565487\" data-ad-format=\"auto\" data-ad-status=\"unfilled\" data-adsbygoogle-status=\"done\"><iframe allow=\"attribution-reporting; run-ad-auction\" allowtransparency=\"true\" aria-label=\"Advertisement\" data-google-container-id=\"a!4\" data-google-query-id=\"CPGtv72nypIDFaWf6QUdAO8WMg\" data-load-complete=\"true\" frameborder=\"0\" height=\"0\" hspace=\"0\" id=\"aswift_3\" marginheight=\"0\" marginwidth=\"0\" name=\"aswift_3\" sandbox=\"allow-forms allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts allow-top-navigation-by-user-activation\" scrolling=\"no\" src=\"https://googleads.g.doubleclick.net/pagead/ads?client=ca-pub-3526212672565487&amp;output=html&amp;h=250&amp;adk=4271553934&amp;adf=3562630264&amp;pi=t.aa~a.1376357989~i.17~rp.4&amp;w=700&amp;fwrn=4&amp;fwrnh=100&amp;lmt=1770549341&amp;rafmt=1&amp;armr=3&amp;sem=mc&amp;pwprc=1167521840&amp;ad_type=text_image&amp;format=700x250&amp;url=https%3A%2F%2Fnishachor.com%2Fage-of-the-sea-how-science-measures%2F&amp;host=ca-host-pub-2644536267352236&amp;fwr=0&amp;pra=3&amp;rh=175&amp;rw=699&amp;rpe=1&amp;resp_fmts=3&amp;aieuf=1&amp;aicrs=1&amp;fa=27&amp;uach=WyJXaW5kb3dzIiwiMTAuMC4wIiwieDg2IiwiIiwiMTQ0LjAuNzU1OS4xMzMiLG51bGwsMCxudWxsLCI2NCIsW1siTm90KEE6QnJhbmQiLCI4LjAuMC4wIl0sWyJDaHJvbWl1bSIsIjE0NC4wLjc1NTkuMTMzIl0sWyJHb29nbGUgQ2hyb21lIiwiMTQ0LjAuNzU1OS4xMzMiXV0sMF0.&amp;abgtt=9&amp;dt=1770567920223&amp;bpp=1&amp;bdt=585&amp;idt=1&amp;shv=r20260204&amp;mjsv=m202602030101&amp;ptt=9&amp;saldr=aa&amp;abxe=1&amp;cookie=ID%3D5014397cbd767514%3AT%3D1770567389%3ART%3D1770567915%3AS%3DALNI_MaYeYyacw-XyztGPGoa4cEo9JjFiw&amp;gpic=UID%3D000011f737fa35d0%3AT%3D1770567389%3ART%3D1770567915%3AS%3DALNI_MYS1MWqbUdykVV91pqY1bPPzbrQ3w&amp;eo_id_str=ID%3D3a6df921c2118e95%3AT%3D1770567389%3ART%3D1770567915%3AS%3DAA-Afjas_1YkMkW8UHF0ASnolm-s&amp;prev_fmts=264x600%2C0x0%2C700x280&amp;nras=3&amp;correlator=3478649342468&amp;frm=20&amp;pv=1&amp;u_tz=330&amp;u_his=5&amp;u_h=768&amp;u_w=1366&amp;u_ah=728&amp;u_aw=1366&amp;u_cd=24&amp;u_sd=1&amp;dmc=8&amp;adx=176&amp;ady=1809&amp;biw=1351&amp;bih=641&amp;scr_x=0&amp;scr_y=13&amp;eid=95378429%2C95381032%2C95381247%2C95382066%2C95382074%2C95382339%2C95382730%2C95382845&amp;oid=2&amp;pvsid=8146435257585096&amp;tmod=1702498510&amp;uas=1&amp;nvt=1&amp;ref=https%3A%2F%2Fnishachor.com%2Fbangla-lorem-ipsum%2F&amp;fc=384&amp;brdim=0%2C0%2C0%2C0%2C1366%2C0%2C1366%2C728%2C1366%2C641&amp;vis=1&amp;rsz=%7C%7Cs%7C&amp;abl=NS&amp;fu=128&amp;bc=31&amp;bz=1&amp;pgls=CAEaBTYuOS4x~CAEQBBoHMS4xNzEuMA..&amp;num_ads=1&amp;ifi=4&amp;uci=a!4&amp;btvi=2&amp;fsb=1&amp;dtd=10\" tabindex=\"0\" title=\"Advertisement\" vspace=\"0\" width=\"700\"></iframe></ins></p>\r\n\r\n<p>এভাবে সমুদ্রে যেখানে পদ্মা নদী গিয়ে মিশছে, সেখানকার কাছাকাছি কয়েকশ মাইলেরও লবণাক্ততার পরপর হিসাব নিয়ে ওটারও মীন বের করা হবে। এই যাবতীয় মীনগুলো নিয়ে বসা হবে। তারপর সেই মীনগুলোর আরেকটা মীন বের করা হবে। এই শেষে যে মীনটা বেরোল, এই মীনটাকে স্ট্যান্ডার্ড (standard, বাংলায় পরিমিত মান) ধরা হবে। এই স্ট্যান্ডার্ড মীন বোঝাচ্ছে: পদ্মা নদীর পানি প্রতি একশ মাইলে এতটুকু লবণ বাড়িয়ে নিয়েই এগিয়ে চলেছে। ব্যস, মূল কাজ শেষ।</p>\r\n\r\n<p>এবার পুরো পদ্মা নদীর মুখ থেকে সমুদ্রে মেশা পর্যন্ত দূরত্বটুকু পরিমাপ করা হবে, মানে পদ্মা নদীর দৈর্ঘ্য মাপা হবে। পুরো দৈর্ঘ্যকে ঐ একশ মাইলের লবণাক্ততার স্ট্যান্ডার্ড দিয়ে হিসেব করলে বেরিয়ে আসবে পদ্মা নদী কতটুকু লবণ বহন করে নিয়ে যায় সমুদ্রে।</p>\r\n\r\n<p>আমার মনে হয় এটা এক ধরণের পদ্ধতি হতে পারে, আমি জানি না। তবে বিজ্ঞান অনেক উন্নত। উন্নত বিজ্ঞানের কাছে বিশেষ অতিবেগুনি (ultra-violet) যন্ত্রপাতি আছে, তা দিয়ে নদীগুলোর ক্যামিক্যাল ডিটেলস বা রাসায়নিক বিস্তারের ছবি সংগ্রহ করা যাবে। ছবিতে একেক রং একেক রাসায়নিক পদার্থের ধারণা দেয়। এই পদ্ধতিতে&nbsp;<a href=\"https://nishachor.com/telescope-galileo-newton-hubble-james-webb-2/\" target=\"_blank\" title=\"দূরবীক্ষণ যন্ত্র: গ্যালিলিও, নিউটন, হাবল থেকে জেম্‌স ওয়েব (২)\">হাবল টেলিস্কোপ</a>&nbsp;মহাকাশের গ্যাসের ছবি সংগ্রহ করে অবশ্য। তারপর লবণের রাসায়নিক উপাদান (সোডিয়াম এবং ক্লোরিন) কোথায় কতটুকু আছে, তার হিসাব করে পুরো পদ্মা নদীর লবণাক্ততার পুঙ্খানুপুঙ্খ হিসাব বের করতে পারেন।</p>\r\n\r\n<p>বিজ্ঞান অনেক উন্নত, আমাদেরকে তার সাথে তাল মেলাতে বেশি বেশি জানতে হবে। আমরা যদি প্রেম নিয়ে আলাপে রত থাকি, আমরা যদি প্রফেশন নিয়ে আলাপে রত থাকি, আমরা যদি সার্টিফিকেশন নিয়ে আলাপে রত থাকি, তাহলে জানবো কী করে এসব? প্রেমের অতিআলোচন পৃথিবীতে মানুষকে মাতিয়ে রেখেছে, উপকার দেয়নি; প্রফেশনের অতিআলোচন লোভি করেছে, উপকার দেয়নি; সার্টিফিকেশন আর ডিগ্রী মানুষের পাশাপাশি অনেক গরুও বানায়, মানুষকে তোলেনি। কিন্তু বিজ্ঞান যেমন অতীত জানিয়েছে, ভবিষ্যতও জানাচ্ছে। তুমি যখনই বিজ্ঞান নিয়ে অতিআলোচনা করবে, তখনই আরেকজন আইনস্টাইনের জন্ম হবে, যে বুকে থাবা দিয়ে প্রচলিত &lsquo;আলো তরঙ্গ&rsquo; ধারণাকে ভুল প্রমাণ করে সত্য প্রতিষ্ঠা করবে &lsquo;আলো কণাও&rsquo;। আমরা এমন একটা শক্তিশালী জাতি চাই। প্রেমে টগবগ করা ভঙ্গুর জাতিরা উপরে ওঠেনি।</p>\r\n\r\n<p><strong>&ndash; মঈনুল ইসলাম</strong></p>', 3, 1, '2026-02-08 16:26:27', '2026-03-01 07:50:39'),
(16, 'আমি যেভাবে আমার LED বাল্বের আলো বাড়ালাম', 'আমি-যেভাবে-আমার-led-বাল্বের-আলো-বাড়ালাম', 'admin', NULL, '2026-02-08 16:28:26', 'আমি যেভাবে আমার LED বাল্বের আলো বাড়ালাম', '<p>এলইডি বাল্ব দিয়ে ঘরের আলোর চাহিদা পূরণের ধারণাটি যে অধুনা বেশ সামনে চলে এসেছে, তা জানতে পারি ন্যাশনাল জিওগ্রাফিক চ্যানেলের মাধ্যমে; তাও ভারতীয় নয়, ইউরোপীয়। ভারতীয় ন্যাশনাল জিওগ্রাফিক চ্যানেলে শ্রেফ ওয়াইল্ড লাইফ দিয়ে মানুষকে ভুলিয়ে রাখছে। ইউরোপীয় ন্যাশনাল জিওগ্রাফিক চ্যানেলে অনেক শিক্ষণীয় বিষয় দেখায়, যা আমরা বাঙালিরা দেখতে পারি না।</p>\r\n\r\n<p>যাই হোক, আমার বন্ধু নাকিবের বড় ভাই (নিসার ভাই) পুরোন ফেলে দেয়া এনার্জি সেভিং বাল্বের (CFL Bulb) খোলস ব্যবহার করে, তাতে অনেকগুলো এলইডি বাল্ব বসিয়ে তার আলোকশক্তি কাজে লাগাতে জানেন। আমি তাঁর সেই কাজকেই আরেকটু উন্নত করতে চাই। তাই আমি কিছু রিফ্লেক্টর বা প্রতিফলক ব্যবহার করে সেই স্বল্প আলোকেই দ্বিগুণ করার চিন্তা করি। যারা এলইডি বাল্ব কী জিনিস চিনতে পারছেন না, তাদের অবগতির জন্য বলছি, আপনার টিভির, মনিটরের ছোট্ট যে বাতিটা জ্বললে আপনি বুঝতে পারেন ঐ যন্ত্রে বিদ্যুত এসেছে, সেই ছোট্ট বাল্বগুলো হলো এলইডি বাল্ব, LED কথাটির ইলেবরেশান বা বিস্তৃত রূপ হলো: Light Emitting Diode। আপাতদৃষ্টিতে এই বাল্বগুলোর আলো খুব কম, তবে কয়েকটি সাদা এলইডি বাল্ব একত্র করলে তার আলো হয় যথেষ্ট। ন্যাশনাল জিওগ্রাফিক চ্যানেল (ইউরোপ)-এর মাধ্যমে জানি যে, এখন এলইডি টিউবলাইটও পাওয়া যায়। এলইডি বাল্ব তুলনামূলক যথেষ্ট কম বিদ্যুত ব্যবহার করেই অনেক আলো দিতে পারে, কারণ এই বাল্ব বিদ্যুতের সবটুকু দিয়েই আলো তৈরি করে, কোনো তাপ তৈরি করে না, তাই এলইডি বাল্ব নতুন প্রজন্মের আলোর চাহিদা পূরণে যথেষ্ট সহায়ক উপাদান।</p>\r\n\r\n<p><ins data-ad-client=\"ca-pub-3526212672565487\" data-ad-format=\"auto\" data-ad-status=\"unfilled\" data-adsbygoogle-status=\"done\"><iframe allow=\"attribution-reporting; run-ad-auction\" allowtransparency=\"true\" aria-label=\"Advertisement\" data-google-container-id=\"a!3\" data-google-query-id=\"CKrR-OenypIDFd_DFgUdzesqgA\" data-load-complete=\"true\" frameborder=\"0\" height=\"0\" hspace=\"0\" id=\"aswift_2\" marginheight=\"0\" marginwidth=\"0\" name=\"aswift_2\" sandbox=\"allow-forms allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts allow-top-navigation-by-user-activation\" scrolling=\"no\" src=\"https://googleads.g.doubleclick.net/pagead/ads?client=ca-pub-3526212672565487&amp;output=html&amp;h=280&amp;adk=910921214&amp;adf=3296623131&amp;pi=t.aa~a.1376357989~i.5~rp.4&amp;w=700&amp;fwrn=4&amp;fwrnh=100&amp;lmt=1770567919&amp;rafmt=1&amp;armr=3&amp;sem=mc&amp;pwprc=1167521840&amp;ad_type=text_image&amp;format=700x280&amp;url=https%3A%2F%2Fnishachor.com%2Fhow-i-multiplied-my-led-bulbs%2F&amp;host=ca-host-pub-2644536267352236&amp;fwr=0&amp;pra=3&amp;rh=175&amp;rw=699&amp;rpe=1&amp;resp_fmts=3&amp;aieuf=1&amp;aicrs=1&amp;fa=27&amp;uach=WyJXaW5kb3dzIiwiMTAuMC4wIiwieDg2IiwiIiwiMTQ0LjAuNzU1OS4xMzMiLG51bGwsMCxudWxsLCI2NCIsW1siTm90KEE6QnJhbmQiLCI4LjAuMC4wIl0sWyJDaHJvbWl1bSIsIjE0NC4wLjc1NTkuMTMzIl0sWyJHb29nbGUgQ2hyb21lIiwiMTQ0LjAuNzU1OS4xMzMiXV0sMF0.&amp;abgtt=9&amp;dt=1770568009250&amp;bpp=1&amp;bdt=502&amp;idt=1&amp;shv=r20260204&amp;mjsv=m202602030101&amp;ptt=9&amp;saldr=aa&amp;abxe=1&amp;cookie=ID%3D5014397cbd767514%3AT%3D1770567389%3ART%3D1770567915%3AS%3DALNI_MaYeYyacw-XyztGPGoa4cEo9JjFiw&amp;gpic=UID%3D000011f737fa35d0%3AT%3D1770567389%3ART%3D1770567915%3AS%3DALNI_MYS1MWqbUdykVV91pqY1bPPzbrQ3w&amp;eo_id_str=ID%3D3a6df921c2118e95%3AT%3D1770567389%3ART%3D1770567915%3AS%3DAA-Afjas_1YkMkW8UHF0ASnolm-s&amp;prev_fmts=264x600%2C0x0&amp;nras=2&amp;correlator=3711358763509&amp;frm=20&amp;pv=1&amp;u_tz=330&amp;u_his=6&amp;u_h=768&amp;u_w=1366&amp;u_ah=728&amp;u_aw=1366&amp;u_cd=24&amp;u_sd=1&amp;dmc=8&amp;adx=176&amp;ady=1420&amp;biw=1351&amp;bih=641&amp;scr_x=0&amp;scr_y=0&amp;eid=95378429%2C95381032%2C95381247%2C95382603%2C95382735%2C95381974&amp;oid=2&amp;pvsid=5862656191380097&amp;tmod=1702498510&amp;uas=1&amp;nvt=1&amp;ref=https%3A%2F%2Fnishachor.com%2Fage-of-the-sea-how-science-measures%2F&amp;fc=384&amp;brdim=0%2C0%2C0%2C0%2C1366%2C0%2C1366%2C728%2C1366%2C641&amp;vis=1&amp;rsz=%7C%7Cs%7C&amp;abl=NS&amp;fu=128&amp;bc=31&amp;bz=1&amp;pgls=CAEaBTYuOS4x~CAEQBBoHMS4xNzEuMA..&amp;num_ads=1&amp;ifi=3&amp;uci=a!3&amp;btvi=1&amp;fsb=1&amp;dtd=6\" tabindex=\"0\" title=\"Advertisement\" vspace=\"0\" width=\"700\"></iframe></ins></p>\r\n\r\n<p>যাহোক, নিসার ভাইয়ের এলইডি বাল্বগুলোর আলো বাড়িয়ে নেবার জন্য আমার ধারণাটি অনেকটা আয়নাঘরের মতন। আমি ছয়টি ষড়ভূজাকৃতির আয়না (চিত্রণ ক) ব্যবহার করে একটি রিং তৈরি করার চিন্তা করছি, যা এলইডি বাল্বগুলোর আলোকে প্রতিবিম্বিত করে কয়েকগুণ বাড়িয়ে দিবে। বাল্ব লাগানোর পরে আয়নাগুলোকে পেছন দিকে ছড়িয়ে দিতে হবে, এতে বাল্বটাকে দেখতেও বেশ সুন্দর লাগবে।</p>\r\n\r\n<figure><a href=\"https://nishachor.com/wp-content/uploads/2010/01/led-multiplier-soothtruthbd-1.jpg\"><img alt=\"চিত্রণ ক: প্রতিফলকের নকশা।\" decoding=\"async\" height=\"200\" src=\"https://nishachor.com/wp-content/uploads/2010/01/led-multiplier-soothtruthbd-1.jpg\" width=\"182\" /></a>\r\n\r\n<figcaption>চিত্রণ ক: প্রতিফলকের নকশা।</figcaption>\r\n</figure>\r\n\r\n<p>আমার নকশানুযায়ী বাল্বের সামনের অংশে, যে তলে এলইডিগুলো বসানো হবে, সেখানে একটি চকচকে প্রতিফলক বসানো যেতে পারে, অথবা পারদের প্রলেপ দেয়া যেতে পারে, এতে আলো প্রাথমিকভাবে বিবর্ধিত হবে। তারপর যে আলোর কণাগুলো চারপাশে চলে যেতে চাইবে, আমি সেই আলোগুলোকে বিবর্ধিত করবো আমার প্রতিফলক বেষ্টনী দিয়ে। বাল্ব লাগানোর পরে প্রতিফলকগুলোকে পিছন দিকে ছড়িয়ে দিতে হবে (চিত্রণ গ)।</p>\r\n\r\n<figure><a href=\"https://nishachor.com/wp-content/uploads/2010/01/led-multiplier-soothtruthbd-3.jpg\"><img alt=\"চিত্রণ গ: প্রতিফলক বসানোর জন্য পিছনে প্লাস্টিকের টুকরো।চিত্রণ গ: প্রতিফলক বসানোর জন্য পিছনে প্লাস্টিকের টুকরো।\" decoding=\"async\" height=\"100\" loading=\"lazy\" src=\"https://nishachor.com/wp-content/uploads/2010/01/led-multiplier-soothtruthbd-3.jpg\" width=\"200\" /></a>\r\n\r\n<figcaption>চিত্রণ গ: প্রতিফলক বসানোর জন্য পিছনে প্লাস্টিকের টুকরো।</figcaption>\r\n</figure>\r\n\r\n<p>চিত্রণ ক-তে স্বাভাবিকভাবে যে অবস্থা দেয়া আছে, তা দেখতে যতটা সুন্দর, বাস্তবে ততটা সুন্দর কাজ করে না। তবে ফুলের মতো বন্ধ করা, খুলে দেয়ার কাজটি আপাতত আমার নকশায় নেই। আমি স্থায়ীভাবে চিত্রণ খ-এর মতো ৪৫&deg; [ডিগ্রী] &nbsp;কৌণিক দূরত্বে বসিয়ে দেয়ার পথ বাতলে দিতে পারি। এজন্য চিত্রণ ক-তে &ndash; &ndash; &ndash; &ndash; &ndash; এরকম দাগ দিয়ে যে কৌণিক দূরত্ব দেখানো হয়েছে, সে অনুপাতে প্রতিফলক টুকরোগুলোকে কাটলে তা ফুলের মতো সামনে-পিছনে ৪৫&deg; [ডিগ্রী] &nbsp;কৌণিক দূরত্বে পৌঁছতে পারবে। পেছনদিকে ৪৫&deg; [ডিগ্রী] &nbsp;কোণে একটা করে প্লাস্টিকের টুকরো বসালে প্রতিফলকগুলো সহজে ঠেক দিয়ে বসতে পারবে (চিত্রণ গ)।</p>\r\n\r\n<p>চিত্রণ ক-তে লাল রং দিয়ে সম্ভাব্য জোড়া লাগানোর ক্ষেত্রগুলো দেখানো হয়েছে। স্বাভাবিক অবস্থায় ভেতরের ষড়ভূজাকার সার্কিট বোর্ডের সর্বকোণে জোড়া লাগাতে হবে। তারপর বাল্ব সকেটে বসিয়ে প্রতিফলককে প্লাস্টিকের টুকরোতে ঠেলে দিয়ে বাইরের লাল চিহ্নিত স্থানে জোড়া লাগাতে হবে।</p>\r\n\r\n<figure><a href=\"https://nishachor.com/wp-content/uploads/2010/01/led-multiplier-soothtruthbd-2.jpg\"><img alt=\"চিত্রণ খ: প্রতিফলক বেস্টনীসহ এলইডি বাল্ব, সকেটে লাগানো হলে যেরকমটা দেখাবে।\" decoding=\"async\" height=\"289\" loading=\"lazy\" sizes=\"auto, (max-width: 320px) 100vw, 320px\" src=\"https://nishachor.com/wp-content/uploads/2010/01/led-multiplier-soothtruthbd-2.jpg\" srcset=\"https://nishachor.com/wp-content/uploads/2010/01/led-multiplier-soothtruthbd-2.jpg 320w, https://nishachor.com/wp-content/uploads/2010/01/led-multiplier-soothtruthbd-2-300x271.jpg 300w\" width=\"320\" /></a>\r\n\r\n<figcaption>চিত্রণ খ: প্রতিফলক বেস্টনীসহ এলইডি বাল্ব, সকেটে লাগানো হলে যেরকমটা দেখাবে।</figcaption>\r\n</figure>\r\n\r\n<p>আর সম্পূর্ণ ব্যাপারটা আরো সহজ হয়ে যাবে, যদি প্রতিফলক বোর্ডে বাল্বগুলো বসানো হয়, আর প্রতিফলক আয়নাগুলো পেছনদিকে ৪৫&deg; [ডিগ্রী] বাঁকানো অবস্থায় একত্র করে বাজারে পাওয়া যায়। বাল্ব সকেটে লাগিয়ে গলায় মালা পরানোর মতো করে প্রতিফলক বেস্টনীকে ঢুকিয়ে দিতে হবে বাল্বের গলায়, যেন চিত্রণ খ-তে দেখানোমতে পুরো প্রতিফলক বেস্টনী বসে।</p>\r\n\r\n<figure><a href=\"https://nishachor.com/wp-content/uploads/2010/01/led-multiplier-soothtruthbd-4.jpg\"><img alt=\"চিত্র ঘ: কাগজ দিয়ে বানানো প্রতিফলক বেস্টনীর একটা রূপ\" decoding=\"async\" height=\"170\" loading=\"lazy\" src=\"https://nishachor.com/wp-content/uploads/2010/01/led-multiplier-soothtruthbd-4.jpg\" width=\"200\" /></a>\r\n\r\n<figcaption>চিত্র ঘ:&nbsp;কাগজ দিয়ে বানানো প্রতিফলক বেস্টনীর একটা রূপ</figcaption>\r\n</figure>\r\n\r\n<p>এই পুরো লেখনীটি শ্রেফ আমার ধারণা অনুযায়ী সত্যি। বাস্তবে এখনো কাজে লাগাইনি। তবে বাজারে এলইডি বাল্ব ব্যবহার করে যেসব ছোট্ট টেবিল ল্যাম্প পাওয়া যাচ্ছে, সেগুলোতে প্রতিফলক ব্যবহারের নানা পন্থা কাজে লাগানো হয়েছে। কারো মাথায় যদি এর চেয়ে ভালো কোনো পন্থা আসে, কিংবা এই পন্থার ফাঁক খুঁজে পান, দয়া করে মন্তব্য অংশে জানাবেন।</p>\r\n\r\n<p><strong>&ndash; মঈনুল ইসলাম</strong><br />\r\nসেপ্টেম্বর ১৯, ২০০৯ খ্রিস্টাব্দ</p>', 1, 1, '2026-02-08 16:28:10', '2026-02-16 07:25:24'),
(17, 'আচ্ছা, সবকিছুর নাম বাংলায় রাখলে কী হয়?', 'আচ্ছা-সবকিছুর-নাম-বাংলায়-রাখলে-কী-হয়', 'admin', NULL, '2026-02-08 16:30:27', 'সবকিছুর নাম বাংলায় রাখতে কোনো বাধা নেই', '<p>আচ্ছা, সবকিছুর নাম বাংলায় রাখলে কী হয়?</p>\r\n\r\n<p><em><strong>বাংলায় নাম!</strong></em></p>\r\n\r\n<p>অনেক অনেক সমস্যার কথা উঠে আসছে জানি, তবু আমি আজকে প্রমাণ করবো কেন আপনি বাংলায় সবকিছুর নাম রাখবেন, কেন তা রাখলে কোনোই অসুবিধা নেই, বরং তা সম্মানের।</p>\r\n\r\n<p>আমাদের বাংলাদেশের দুই নেত্রীর নামকরণ সংস্কৃতির সাথে আমরা সবাই পরিচিত: একজনের দেয়া নাম আরেকজন এসে পাল্টে দেন, আবার পরের মেয়াদে প্রথম জন এসে সেটা পুণরুজ্জীবিত করেন। সেখানে তাদের ব্যক্তিগত স্বার্থ যতটা আমরা দেখি, দেশের স্বার্থ ঠিক ততটাই ক্ষুন্ন হতে দেখি। অথচ আজ আমি এমন পথের কথা বলছি, যাতে ব্যক্তিস্বার্থ তো বটেই, বরং দেশ ও ভাষার স্বার্থও সমানভাবে রক্ষা পাবে।</p>\r\n\r\n<h3>বাংলায় নামকরণ প্রবণতা</h3>\r\n\r\n<p>আসুন, নামকরণের ব্যাপারে আমাদের অবস্থানগুলো একটু দেখে নেয়া যাক। নামকরণের ব্যাপারে আমাদের কিছু প্রবণতা আছে:</p>\r\n\r\n<h4><strong>ক. আমরা বাংলা নামে&nbsp;<em>ভাব</em>&nbsp;খুঁজে পাই না:</strong></h4>\r\n\r\n<p>আমরা বাংলা নামে আজকাল আর&nbsp;<em>ভাব</em>&nbsp;খুঁজে পাই না। তাই আমরা নামকরণের বেলায় ইংরেজি নাম পছন্দ করি খুব&nbsp;<em>ভাব</em>&nbsp;আছে মনে করে। এপ্রসঙ্গে একটা মজার ঘটনা বলি:</p>\r\n\r\n<p>খুব ছোটবেলায় আমি আর আমার মামাতো ভাই (রনি ভাই) নিজেদের বইপত্র একত্র করে একটা মিনি পাঠাগার তৈরি করলাম। আমরা দুজন মিলে সেই পাঠাগারের একটা নাম ঠিক করলাম। পাঠাগারের জন্য দান সংগ্রহের জন্য আইসক্রিমের বাটির উপরে কাগজ লাগিয়ে দানবাক্স বানালাম আর তার উপরে আমাদের পাঠাগারের নামের আদ্যক্ষর লিখলাম: TNFL। ছোটবেলায় দুজনই দাঙ্গা-হাঙ্গামামার্কা ছবি পছন্দ করতাম, তাই বলে পাঠাগারের নামের সাথে দাঙ্গা-হাঙ্গামা জুড়ে যাবে সেটা স্বপ্নেও ভাবিনি, বোধহয় ভেবেছিলাম ওটাতেই&nbsp;<em>ভাব</em>&nbsp;আছে। পাঠাগারের নামে দাঙ্গা-হাঙ্গামা জুড়ে কী নাম হয়েছে জানেন? &ldquo;The National Fighter Library&rdquo;, সংক্ষেপে TNFL।</p>\r\n\r\n<p><ins data-ad-client=\"ca-pub-3526212672565487\" data-ad-format=\"auto\" data-ad-status=\"unfilled\" data-adsbygoogle-status=\"done\"><iframe allow=\"attribution-reporting; run-ad-auction\" allowtransparency=\"true\" aria-label=\"Advertisement\" data-google-container-id=\"a!3\" data-google-query-id=\"COW2z52oypIDFR6B6QUdanEWnA\" data-load-complete=\"true\" frameborder=\"0\" height=\"0\" hspace=\"0\" id=\"aswift_2\" marginheight=\"0\" marginwidth=\"0\" name=\"aswift_2\" sandbox=\"allow-forms allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts allow-top-navigation-by-user-activation\" scrolling=\"no\" src=\"https://googleads.g.doubleclick.net/pagead/ads?client=ca-pub-3526212672565487&amp;output=html&amp;h=280&amp;adk=50218539&amp;adf=3480885867&amp;pi=t.aa~a.1376357989~i.17~rp.4&amp;w=700&amp;fwrn=4&amp;fwrnh=100&amp;lmt=1770568114&amp;rafmt=1&amp;armr=3&amp;sem=mc&amp;pwprc=1167521840&amp;ad_type=text_image&amp;format=700x280&amp;url=https%3A%2F%2Fnishachor.com%2Fnaming-culture%2F&amp;host=ca-host-pub-2644536267352236&amp;fwr=0&amp;pra=3&amp;rh=175&amp;rw=699&amp;rpe=1&amp;resp_fmts=3&amp;aieuf=1&amp;aicrs=1&amp;fa=27&amp;uach=WyJXaW5kb3dzIiwiMTAuMC4wIiwieDg2IiwiIiwiMTQ0LjAuNzU1OS4xMzMiLG51bGwsMCxudWxsLCI2NCIsW1siTm90KEE6QnJhbmQiLCI4LjAuMC4wIl0sWyJDaHJvbWl1bSIsIjE0NC4wLjc1NTkuMTMzIl0sWyJHb29nbGUgQ2hyb21lIiwiMTQ0LjAuNzU1OS4xMzMiXV0sMF0.&amp;abgtt=9&amp;dt=1770568121816&amp;bpp=2&amp;bdt=885&amp;idt=-M&amp;shv=r20260204&amp;mjsv=m202602030101&amp;ptt=9&amp;saldr=aa&amp;abxe=1&amp;cookie=ID%3D5014397cbd767514%3AT%3D1770567389%3ART%3D1770567915%3AS%3DALNI_MaYeYyacw-XyztGPGoa4cEo9JjFiw&amp;gpic=UID%3D000011f737fa35d0%3AT%3D1770567389%3ART%3D1770567915%3AS%3DALNI_MYS1MWqbUdykVV91pqY1bPPzbrQ3w&amp;eo_id_str=ID%3D3a6df921c2118e95%3AT%3D1770567389%3ART%3D1770567915%3AS%3DAA-Afjas_1YkMkW8UHF0ASnolm-s&amp;prev_fmts=264x600%2C0x0&amp;nras=2&amp;correlator=1109480744549&amp;frm=20&amp;pv=1&amp;u_tz=330&amp;u_his=7&amp;u_h=768&amp;u_w=1366&amp;u_ah=728&amp;u_aw=1366&amp;u_cd=24&amp;u_sd=1&amp;dmc=8&amp;adx=176&amp;ady=1167&amp;biw=1351&amp;bih=641&amp;scr_x=0&amp;scr_y=200&amp;eid=95378429%2C95381033%2C95381247%2C95382071%2C95382732&amp;oid=2&amp;pvsid=7448000108561806&amp;tmod=1702498510&amp;uas=1&amp;nvt=1&amp;ref=https%3A%2F%2Fnishachor.com%2Fhow-i-multiplied-my-led-bulbs%2F&amp;fc=384&amp;brdim=0%2C0%2C0%2C0%2C1366%2C0%2C1366%2C728%2C1366%2C641&amp;vis=1&amp;rsz=%7C%7Cs%7C&amp;abl=NS&amp;fu=128&amp;bc=31&amp;bz=1&amp;pgls=CAEaBTYuOS4x~CAEQBBoHMS4xNzEuMA..&amp;num_ads=1&amp;ifi=3&amp;uci=a!3&amp;btvi=1&amp;fsb=1&amp;dtd=18\" tabindex=\"0\" title=\"Advertisement\" vspace=\"0\" width=\"700\"></iframe></ins></p>\r\n\r\n<p>&hellip;নামটা মনে হলে আজও হাসি। যাহোক, নামের বেলায় আমাদের ইংরেজি-প্রীতির একটা কারণ আছে। কারণ আমরা বাংলা ভাষায় কথা বলি, ইংরেজি একটা&nbsp;<em>ফোরেন ল্যাংগুয়েজ</em>। নদীর এপার কহে ওপারে সুখ, ওপার কহে এপারে সুখ -এই কবিতাটা সবাই জানি। তাই বাংলাভাষী হয়ে দ্বিতীয় ভাষা হিসেবে ইংরেজিপ্রীতি যে আমাদের রন্ধ্রে রন্ধ্রে, তা আর বলতে হবে না আশা করি। মজার ব্যাপার হলো আমরা ইংরেজি ভাষায় কথা বলতে পেরে ঠিক যতটুকু মর্যাদাবান নিজেদেরকে ভাবি, ইংরেজ কিংবা আমেরিকানরা ইংরেজি বলতে নিজেদেরকে ঠিক ততটাই নীচ মনে করে। তাই তারাও নিজ ভাষা ইংরেজি ছেড়ে ঝুকছে অন্য কোনো বিদেশী ভাষায়- ফরাসি (French), কিংবা স্প্যানীয় (Spanish)। এজন্যই লক্ষ করবেন, আমেরিকানরা, নতুন আবিষ্কৃত সূর্য বা গ্রহের নামকরণে খুঁজে খুঁজে গ্রিক, রোমক কিংবা মিশরীয় পুরাণ থেকে নাম বের করে আনে। তারা মনে করে ঐসব নামের মধ্যে একটা&nbsp;<em>ভাব</em>&nbsp;আছে। আমাদের ইংরেজি-প্রীতির উদাহরণ ভুরি ভুরি, যেমন: একটা বাংলাদেশী ব্যান্ডের নাম বাংলায় &ldquo;ব্যতিক্রমী ছোঁয়া&rdquo; রাখার পরিবর্তে &ldquo;Different Touch&rdquo; রাখাটা যথেষ্ট ভাবের; &ldquo;কালো&rdquo; রাখার পরিবর্তে &ldquo;Black&rdquo; রাখাটা যথেষ্ট ভাবের; &ldquo;ফাঁদ&rdquo; রাখার পরিবর্তে &ldquo;The Trap&rdquo; রাখার মধ্যে একটা ভাব আছে&hellip; আরো কত কী! আমার বন্ধুও তার ব্যান্ডের নাম রাখতে গিয়ে শেষে ইংরেজিতে স্থিতু হয়েছে: Aimers।</p>\r\n\r\n<h4><strong>খ. বাংলা রাখলে এটা শুধু বাঙালিরা বুঝবে, তাই রাখি না:</strong></h4>\r\n\r\n<p>আমাদের সবারই ধারণা বাংলায় যদি কোনো কিছুর নাম রাখি, তাহলে সেটা শুধু বাঙালিরাই বুঝবে। তাই আমরা ঝুঁকি নেই না। যেমন: বাংলাদেশের বুয়েটের তিন গর্ব সাজেদুল হাসান, রাকিবুর রহমান এবং আহসানুল আদীব তাঁদের বিশ্ব-মাতানো আবিষ্কারটির নাম দেন: Design and Development of micro controller based solid state pre-payment energy meter, সংক্ষেপে Pre-paid Meter।<sup>[১]</sup>&nbsp;কারণ হয়তো তাঁদের মনে হয়েছে&nbsp;<em>আমরা আমেরিকাতে প্রতিযোগিতায় যাচ্ছি, সেখানে বাংলা নাম নিয়ে গেলে কেউ বুঝবে না।</em>&nbsp;তাই তাঁরা ইংরেজিতে নাম রেখেছেন তাঁদের আবিষ্কারের। আর এখন সেই ইংরেজি নামেই পরিচিতি পেয়েছে তাঁদের এই আবিষ্কার। সিলেটের উপশহর এলাকায় সরকার চালু করেছে এই প্রিপেইড বিদ্যুৎ মিটার। (শুনেছি ঢাকার উত্তরায়ও চালু হবে)</p>\r\n\r\n<h3><strong>সমাধান সমাধান</strong></h3>\r\n\r\n<p>এবারে আসুন দেখি, কিভাবে সব কিছুর নামই বাংলা রাখা যায়, কোনো ঝামেলা ছাড়াই, আর এর পিছনে যুক্তিগুলোইবা কী: বাংলা উইকিপিডিয়ান শাবাব মুস্তাফা একদিন মজার এক তথ্য জানালেন: কলকাতায় নাকি মোবাইল ফোনের বাংলা করা হয়েছে &ldquo;চলভাষ&rdquo; (উচ্চারণ: চলোভাষ্&zwnj;)। শুনে আমি আর তানভির [রহমান] হেসে বাঁচিনে। হ্যা, কলকাতার এই বাংলায়ন নিয়ে হয়তো একটু হাসিই পাচ্ছে আমাদের, কিন্তু সত্যি কথা হলো, কলকাতার লোকজন বাংলায় নামকরণে বেশ ওস্তাদ। আমরা যেখানে Navy Blue-কে নেভী-ব্লু লিখেই ক্ষান্ত দেই, কলকাতার সুচিত্রা ভট্টাচার্য তখন লিখছেন&nbsp;<strong>&ldquo;নাবিক নীল&rdquo;</strong>। আমার অন্তত এই বাংলায়নে হাসি পাচ্ছে না।</p>\r\n\r\n<p>আসলে হাসি পাবার ব্যাপারটা আপেক্ষিক। নতুন যেকোনো কিছুতেই হাসি পেতে পারে। কিন্তু প্রচলিত হয়ে যাবার পর সেটাতে আর হাসি পায় না। কখনও কি ভেবে দেখেছেন &ldquo;সিংহভাগ&rdquo; কথাটার মানে কী? অথচ এখন কথায় কথায় সিংহভাগ কথাটা ব্যবহার করছি আমরা দিব্যি, হাসি পাচ্ছে না। দিব্যি ব্যবহার করছি &ldquo;সংরক্ষণ&rdquo; শব্দটি, অথচ কখনও কি হেসেছি এই বলে যে,&nbsp;<em>রক্ষণ করবো, রক্ষা করবো, এর সাথে আবার &lsquo;সং&rsquo; ভংচং লাগানোর কী দরকার?</em>&nbsp;আসলে প্রচলিত হয়ে যাবার পর অনেক কিছুই আর হাসির বিষয় থাকে না। এখন আর কেউ লাক্স কিংবা লাইফবয় নাম দুটোকে প্রশ্ন করে বলে না এসব আবার কেমন নাম? LUX-এর কোনো মানে নেই, কিংবা অর্থবোধক Sunsilk নামটিকে নিয়ে হাসে না এই বলে যে,&nbsp;<em>হায়রে, সূর্যের সাথে সিল্ক কাপড়ের কী মিল, হা হা হা!</em></p>\r\n\r\n<p><ins data-ad-client=\"ca-pub-3526212672565487\" data-ad-format=\"auto\" data-ad-status=\"unfilled\" data-adsbygoogle-status=\"done\"><iframe allow=\"attribution-reporting; run-ad-auction\" allowtransparency=\"true\" aria-label=\"Advertisement\" data-google-container-id=\"a!4\" data-google-query-id=\"COjMzp2oypIDFfacrAIdAKEGMQ\" data-load-complete=\"true\" frameborder=\"0\" height=\"0\" hspace=\"0\" id=\"aswift_3\" marginheight=\"0\" marginwidth=\"0\" name=\"aswift_3\" sandbox=\"allow-forms allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts allow-top-navigation-by-user-activation\" scrolling=\"no\" src=\"https://googleads.g.doubleclick.net/pagead/ads?client=ca-pub-3526212672565487&amp;output=html&amp;h=280&amp;adk=50218539&amp;adf=2645917291&amp;pi=t.aa~a.1376357989~i.29~rp.4&amp;w=700&amp;fwrn=4&amp;fwrnh=100&amp;lmt=1770568114&amp;rafmt=1&amp;armr=3&amp;sem=mc&amp;pwprc=1167521840&amp;ad_type=text_image&amp;format=700x280&amp;url=https%3A%2F%2Fnishachor.com%2Fnaming-culture%2F&amp;host=ca-host-pub-2644536267352236&amp;fwr=0&amp;pra=3&amp;rh=175&amp;rw=699&amp;rpe=1&amp;resp_fmts=3&amp;aieuf=1&amp;aicrs=1&amp;fa=27&amp;uach=WyJXaW5kb3dzIiwiMTAuMC4wIiwieDg2IiwiIiwiMTQ0LjAuNzU1OS4xMzMiLG51bGwsMCxudWxsLCI2NCIsW1siTm90KEE6QnJhbmQiLCI4LjAuMC4wIl0sWyJDaHJvbWl1bSIsIjE0NC4wLjc1NTkuMTMzIl0sWyJHb29nbGUgQ2hyb21lIiwiMTQ0LjAuNzU1OS4xMzMiXV0sMF0.&amp;abgtt=9&amp;dt=1770568121816&amp;bpp=1&amp;bdt=884&amp;idt=1&amp;shv=r20260204&amp;mjsv=m202602030101&amp;ptt=9&amp;saldr=aa&amp;abxe=1&amp;cookie=ID%3D5014397cbd767514%3AT%3D1770567389%3ART%3D1770567915%3AS%3DALNI_MaYeYyacw-XyztGPGoa4cEo9JjFiw&amp;gpic=UID%3D000011f737fa35d0%3AT%3D1770567389%3ART%3D1770567915%3AS%3DALNI_MYS1MWqbUdykVV91pqY1bPPzbrQ3w&amp;eo_id_str=ID%3D3a6df921c2118e95%3AT%3D1770567389%3ART%3D1770567915%3AS%3DAA-Afjas_1YkMkW8UHF0ASnolm-s&amp;prev_fmts=264x600%2C0x0%2C700x280&amp;nras=3&amp;correlator=1109480744549&amp;frm=20&amp;pv=1&amp;u_tz=330&amp;u_his=7&amp;u_h=768&amp;u_w=1366&amp;u_ah=728&amp;u_aw=1366&amp;u_cd=24&amp;u_sd=1&amp;dmc=8&amp;adx=176&amp;ady=2507&amp;biw=1351&amp;bih=641&amp;scr_x=0&amp;scr_y=200&amp;eid=95378429%2C95381033%2C95381247%2C95382071%2C95382732&amp;oid=2&amp;pvsid=7448000108561806&amp;tmod=1702498510&amp;uas=1&amp;nvt=1&amp;ref=https%3A%2F%2Fnishachor.com%2Fhow-i-multiplied-my-led-bulbs%2F&amp;fc=384&amp;brdim=0%2C0%2C0%2C0%2C1366%2C0%2C1366%2C728%2C1366%2C641&amp;vis=1&amp;rsz=%7C%7Cs%7C&amp;abl=NS&amp;fu=128&amp;bc=31&amp;bz=1&amp;pgls=CAEaBTYuOS4x~CAEQBBoHMS4xNzEuMA..&amp;num_ads=1&amp;ifi=4&amp;uci=a!4&amp;btvi=2&amp;fsb=1&amp;dtd=20\" tabindex=\"0\" title=\"Advertisement\" vspace=\"0\" width=\"700\"></iframe></ins></p>\r\n\r\n<p>এবারে আসি বাস্তব উদাহরণে: কলকাতার&nbsp;<a href=\"https://bn.wikipedia.org/wiki/%E0%A6%B8%E0%A6%A4%E0%A7%8D%E0%A6%AF%E0%A6%9C%E0%A6%BF%E0%A7%8E_%E0%A6%B0%E0%A6%BE%E0%A6%AF%E0%A6%BC\" rel=\"nofollow\">সত্যজিৎ রায়^</a>কে কে না জানে? ঠিক তেমনি বাংলাদেশের&nbsp;<a href=\"https://bn.wikipedia.org/wiki/%E0%A6%AE%E0%A7%81%E0%A6%B9%E0%A6%AE%E0%A7%8D%E0%A6%AE%E0%A6%A6_%E0%A6%9C%E0%A6%BE%E0%A6%AB%E0%A6%B0_%E0%A6%87%E0%A6%95%E0%A6%AC%E0%A6%BE%E0%A6%B2\" rel=\"nofollow\">^</a>কেও চেনেন সবাই। এই দুজনের মধ্যেই একটা সহজ পার্থক্য টানা যাক: সত্যজিৎ রায় তাঁর অধিকাংশ বইয়ের নাম রেখেছেন বাংলা, যেখানে জাফর ইকবাল তাঁর কিছু কিছু বইয়ের নাম বাংলায় না রেখে বেছে নিয়েছেন বিদেশী নাম: যেগুলো শুনতে কিছুটা খটমটে লাগে, আর সেই তথাকথিত&nbsp;<em>ভাব</em>&nbsp;প্রকাশ করতে পারে। বাংলা উইকিপিডিয়ায় উল্লেখিত নিবন্ধ দুটোতে দুজনেরই লেখা বইয়ের নাম আপনারা পাবেন, মিলিয়ে দেখে নিতে পারেন। এই দুজনকে নিয়ে আলোচনা করার কারণটা হলো জাফর ইকবাল বাংলাদেশের এযুগের বিজ্ঞান কল্পকাহিনী লেখক, আর সত্যজিৎ রায় সেযুগে ভারতে বিজ্ঞান কল্পকাহিনী লিখে গেছেন। সত্যজিৎ রায়ের &nbsp;চরিত্রটি ছিল সেরকমই একটা চরিত্র। শঙ্কু আজব আজব সব যন্ত্র তৈরি করতেন আবার সেগুলোর নামকরণও করতেন। কিন্তু দেখার বিষয় হলো সত্যজিৎ রায় সেযুগে ঐসব আবিষ্কারের নামে কোথাও ইংরেজি নাম দিতেন না। হয়তো শ্রেফ একটা রোবট বানিয়েছেন শঙ্কু, কিন্তু সেটার নাম তিনি দিলেন &ldquo;বিধুশেখর&rdquo;। &hellip;আসলে এভাবে তুলনা করাটা সঠিক কোনো বিজ্ঞানসম্মত উপায় নয়। কারণ সত্যজিৎ রায়ও অনেক ইংরেজি শব্দ দিয়ে নামকরণ করেছেন। আমি কেবল এটা বোঝাতে চাচ্ছি যে, সাধারণ একটা রোবটের মতো বিষয়কে যেখানে ইংরেজি নামে জড়ানো যেত, সেখানে সত্যজিৎ বাংলাকে প্রাধান্য দিয়েছেন। তৃষ্ণা নিবারক ঔষধের নাম &ldquo;থ্রাস্ট পিল&rdquo; না রেখে রেখেছেন &ldquo;তৃষ্ণাশক বড়ি&rdquo;। &hellip;এতে লাভটা কোথায়?</p>\r\n\r\n<p>লাভটা হলো: বাংলাকে পরিচয় করিয়ে দেয়া।</p>\r\n\r\n<p>আচ্ছা, আপনার নাম কি আপনার বাবা-মা &ldquo;টাইগার উড্&zwnj;স&rdquo; রেখেছেন, নাকি রেখেছেন&nbsp;কিংবা &ldquo;উইলিয়াম শেক্সপিয়ার&rdquo; রেখেছেন, নাকি &ldquo;হুমায়ুন আহমেদ&rdquo;? মজার বিষয় হলো আপনার নামটি কিন্তু রাখা হয়েছে বাংলায় (বা আরবিতে)। কিন্তু আপনি যখন পরিচিতি পাচ্ছেন, তখন বলা হচ্ছে&nbsp;<strong>না</strong>&nbsp;<em>আচ্ছা আপনার নামের ইংরেজিটা কী?</em>&nbsp;কেউ কখনও হুমায়ুন আহমেদকে তাঁর নামের ইংরেজি বলতে বলেন না। অথচ তিনি বিশ্বখ্যাত হয়েছেন, তাঁর নামে বিশ্বের সর্ববৃহৎ পাঠাগার &ldquo;লাইব্রেরী অফ কংগ্রেস&rdquo;-এ আলাদা একটা লেখক-ভুক্তি তৈরি করা হয়েছে। &hellip;নাম &ldquo;নাম&rdquo;ই। এর ভাষান্তর হয় না (যদিও ওরা &ldquo;ঠাকুর&rdquo;-কে Tagore করে নিয়েছে)।</p>\r\n\r\n<p>আপনি যখনই একটা বাংলা নাম রাখবেন, তখনই সেটা একজন ভিনদেশী, ভিনভাষী মানুষের কাছে প্রশ্নের উদ্রেক করবে:&nbsp;<em>এর মানে কী</em>? হয়তো আপনি আপনার বইয়ের নাম রাখলেন &ldquo;অচেতন&rdquo;, তখন ঐ ভিনভাষী এর মানে জানতে চাইবেন। আপনি তখন গর্ব করে বলতে পারবেন,&nbsp;<em>ইট্&zwnj;স এ্যা বাংলা টার্ম।</em>&nbsp;বিদেশী তখন দাঁত-মুখ খিচড়ে বলবে,&nbsp;<em>হোয়াট!</em>&nbsp;আপনি তখন দ্বিগুণ আনন্দ নিয়ে বলতে পারবেন,&nbsp;<em>বাংলা ইয্ এ্যা ল্যাংগুয়েজ এ্যাচিভ্&zwnj;ড বাই ব্লাড। এ্যান্ড দ্যা টার্ম আ-চেতান মিন্&zwnj;স &ldquo;Unconcious&rdquo;।</em>&nbsp;তখন ঐ বিদেশী আপনার ভাষায় মুগ্ধ হবে, আপনার ভাষা সম্পর্কে জানবে আর দশজনকে গিয়ে বলে বেড়াবে,&nbsp;<em>আইয়্যাভ লার্ন্ট আ নিউ ল্যাংগুয়েজ: ইট্&zwnj;য ব্যাংলা, সেয়িং আ-চেতান ফর আনকনশাস।</em>&nbsp;সে তখন তার কোনো বইতে আনকনশাস বিষয়ে লিখতে গেলে উল্লেখ করবে এই বাংলা টার্মটিও -এব্যাপারে আমি দিব্যি দিয়ে বলতে পারি।</p>\r\n\r\n<p><ins data-ad-client=\"ca-pub-3526212672565487\" data-ad-format=\"auto\" data-ad-status=\"unfilled\" data-adsbygoogle-status=\"done\"><iframe allow=\"attribution-reporting; run-ad-auction\" allowtransparency=\"true\" aria-label=\"Advertisement\" data-google-container-id=\"a!5\" data-google-query-id=\"CLjX4qWoypIDFT-86QUd3vgDBQ\" data-load-complete=\"true\" frameborder=\"0\" height=\"0\" hspace=\"0\" id=\"aswift_4\" marginheight=\"0\" marginwidth=\"0\" name=\"aswift_4\" sandbox=\"allow-forms allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts allow-top-navigation-by-user-activation\" scrolling=\"no\" src=\"https://googleads.g.doubleclick.net/pagead/ads?client=ca-pub-3526212672565487&amp;output=html&amp;h=280&amp;adk=50218539&amp;adf=327258235&amp;pi=t.aa~a.1376357989~i.37~rp.4&amp;w=700&amp;fwrn=4&amp;fwrnh=100&amp;lmt=1770568114&amp;rafmt=1&amp;armr=3&amp;sem=mc&amp;pwprc=1167521840&amp;ad_type=text_image&amp;format=700x280&amp;url=https%3A%2F%2Fnishachor.com%2Fnaming-culture%2F&amp;host=ca-host-pub-2644536267352236&amp;fwr=0&amp;pra=3&amp;rh=175&amp;rw=699&amp;rpe=1&amp;resp_fmts=3&amp;aieuf=1&amp;aicrs=1&amp;fa=27&amp;uach=WyJXaW5kb3dzIiwiMTAuMC4wIiwieDg2IiwiIiwiMTQ0LjAuNzU1OS4xMzMiLG51bGwsMCxudWxsLCI2NCIsW1siTm90KEE6QnJhbmQiLCI4LjAuMC4wIl0sWyJDaHJvbWl1bSIsIjE0NC4wLjc1NTkuMTMzIl0sWyJHb29nbGUgQ2hyb21lIiwiMTQ0LjAuNzU1OS4xMzMiXV0sMF0.&amp;abgtt=9&amp;dt=1770568121820&amp;bpp=1&amp;bdt=888&amp;idt=1&amp;shv=r20260204&amp;mjsv=m202602030101&amp;ptt=9&amp;saldr=aa&amp;abxe=1&amp;cookie=ID%3D5014397cbd767514%3AT%3D1770567389%3ART%3D1770567915%3AS%3DALNI_MaYeYyacw-XyztGPGoa4cEo9JjFiw&amp;gpic=UID%3D000011f737fa35d0%3AT%3D1770567389%3ART%3D1770567915%3AS%3DALNI_MYS1MWqbUdykVV91pqY1bPPzbrQ3w&amp;eo_id_str=ID%3D3a6df921c2118e95%3AT%3D1770567389%3ART%3D1770567915%3AS%3DAA-Afjas_1YkMkW8UHF0ASnolm-s&amp;prev_fmts=264x600%2C0x0%2C700x280%2C700x280&amp;nras=4&amp;correlator=1109480744549&amp;frm=20&amp;pv=1&amp;u_tz=330&amp;u_his=7&amp;u_h=768&amp;u_w=1366&amp;u_ah=728&amp;u_aw=1366&amp;u_cd=24&amp;u_sd=1&amp;dmc=8&amp;adx=176&amp;ady=3083&amp;biw=1351&amp;bih=641&amp;scr_x=0&amp;scr_y=521&amp;eid=95378429%2C95381033%2C95381247%2C95382071%2C95382732&amp;oid=2&amp;pvsid=7448000108561806&amp;tmod=1702498510&amp;uas=3&amp;nvt=1&amp;ref=https%3A%2F%2Fnishachor.com%2Fhow-i-multiplied-my-led-bulbs%2F&amp;fc=384&amp;brdim=0%2C0%2C0%2C0%2C1366%2C0%2C1366%2C728%2C1366%2C641&amp;vis=1&amp;rsz=%7C%7Cs%7C&amp;abl=NS&amp;fu=128&amp;bc=31&amp;bz=1&amp;pgls=CAEaBTYuOS4x~CAEQBBoHMS4xNzEuMA..&amp;num_ads=1&amp;ifi=5&amp;uci=a!5&amp;btvi=3&amp;fsb=1&amp;dtd=17103\" tabindex=\"0\" title=\"Advertisement\" vspace=\"0\" width=\"700\"></iframe></ins></p>\r\n\r\n<p>কারণ আজ আমি দেখছি ক্রিকেটে যেভাবে জন্টি রোড&zwnj;্&zwnj;স ফিল্ডিং করতেন, সেটা আজ জন্টি রোড্&zwnj;স&rsquo; স্টাইল নামে পরিচিতি পেয়ে গেছে, যে বাংলাদেশী ভবন বিশ্বব্যাপী সমাদৃত হয়েছে, তা &ldquo;সংসদ ভবন&rdquo; নামেই হয়েছে &ldquo;পার্লামেন্ট হাউজ&rdquo; নামে হয়নি (পরিচয় করিয়ে দেয়ার স্বার্থে অবশ্য পার্লামেন্ট হাউজ বলা হয়)। নিজের পরিচিতির সাথে করে নিয়ে গেছে ভাষাকে।</p>\r\n\r\n<p>আরেকটা ধারা আছে, রোমান হরফে বাংলা লেখা: otobi, aarong, taaga, কিংবা drik gallery সবই কিন্তু বাংলা নাম।&nbsp;<strong>অটবি</strong>&nbsp;সংস্কৃতমূল বাংলা শব্দ (বৃক্ষ, অরণ্য);&nbsp;<strong>আড়ং</strong>&nbsp;ফারসিমূল বাংলা শব্দ (হাট, বাজার);&nbsp;<strong>তাগা</strong>&nbsp;প্রাকৃতমূল বাংলা শব্দ (হাতের বাহুতে বাঁধার সুতা);&nbsp;<strong>দৃক</strong>&nbsp;সংস্কৃতমূল বাংলা শব্দ (চোখ, দৃষ্টি)। যেভাবেই লেখা হোক না কেন, বাংলা তো। এগুলো থেকে&nbsp;<strong>mantra</strong>&nbsp;(মন্ত্র),&nbsp;<strong>yaatri</strong>&nbsp;(যাত্রী) কিছুটা ব্যতিক্রম, কারণ এগুলো মূল দেবনাগরী অর্থাৎ ভারতীয় লিপির উচ্চারণ-ধারায় লেখা। তবুও এগুলো বাংলার প্রতিনিধিত্ব করে।</p>\r\n\r\n<p>একবার চিন্তা করুন, আপনি একটি যুগান্তকারী রকেট আবিষ্কার করলেন, তার নাম আপনি তথাকথিত রকেট না রেখে রাখলেন &ldquo;ব্যোমযান&rdquo;, তখন স্বভাবতই একসময় রকেটের নামটি পাল্টে গিয়ে বিশ্বব্যাপী মানুষের কাছে পরিচিতি পাবে ব্যোমযান নামটি। নাসা সংবাদ সম্মেলন করে বলবে&nbsp;<em>উইয়্যাভ্&zwnj; মেড্&zwnj; আওয়ার নিউ ব্যোমযান, এ্যান্ড ইট্&zwnj;য পার্ফেক্টলি ওয়েলইকুইপ্&zwnj;ড।</em>&nbsp;ঠিক যেমন আজ নাসা হোয়াইট ডুয়ার্ফ বা শ্বেতবামনের (তারার জীবনচক্রের একটি পর্যায়ে একে এই নামে ডাকা হয়) নিরাপদ মৃত্যুকে বোঝাতে বুক ফুলিয়ে বলছে&nbsp;<em>ইট্&zwnj;য কাল্&zwnj;ড দ্যা চান্দ্রাশেখার লিমিট</em>। (ভারতীয় বিজ্ঞানী সুব্রামানিয়ান চন্দ্রশেখরের নামে এই গাণিতিক ফর্মুলার নাম করা হয়েছে)</p>\r\n\r\n<p>আসুন, নিজের আবিষ্কার, নিজের চিন্তা-চেতনা, নিজের লেখা বই, ফর্মুলা, গবেষণা-বস্তু ইত্যাদি সবকিছুর নামকরণ করি বাংলায়। তাহলে সেগুলো সারা বিশ্বে পরিচিতি পেলে বাংলাকে জানবে মানুষ।</p>\r\n\r\n<p>আর মনে রাখবেন,&nbsp;<strong>যে&nbsp;<em>ভাব</em>&nbsp;আপনি খুঁজে বেড়াচ্ছেন নিজের ভাষাকে বাদ দিয়ে ঐসব তথাকথিত ভাবমণ্ডিত ভাষায়, তারা কিন্তু ভাব খুঁজে বেড়াচ্ছে আপনার ভাষায়।</strong></p>\r\n\r\n<p>মুহম্মদ জাফর ইকবাল&nbsp;নিজের যন্ত্রের নাম &ldquo;টাইম প্রজেকশন চ্যাম্বার&rdquo;<sup>[২]</sup>&nbsp;না রেখে &ldquo;সময় অভিক্ষেপ প্রকোষ্ঠ&rdquo; রাখলে আজ হয়তো ক্যালটেকে বাংলা নামটি প্রচলিত হয়ে যেত। বুয়েটের বিজ্ঞানীরা &ldquo;প্রি-পেইড এনার্জি মিটার&rdquo; না রেখে যদি &ldquo;প্রাক-পরিশোধ মিটার&rdquo; রাখতেন, তাহলে আজ আমেরিকায় নামটি জনপ্রিয়তা পেত।</p>\r\n\r\n<p><ins data-ad-client=\"ca-pub-3526212672565487\" data-ad-format=\"auto\" data-ad-status=\"unfilled\" data-adsbygoogle-status=\"done\"><iframe allow=\"attribution-reporting; run-ad-auction\" allowtransparency=\"true\" aria-label=\"Advertisement\" data-google-container-id=\"a!6\" data-google-query-id=\"CK-kj6aoypIDFYG06QUdd0Azxw\" data-load-complete=\"true\" frameborder=\"0\" height=\"0\" hspace=\"0\" id=\"aswift_5\" marginheight=\"0\" marginwidth=\"0\" name=\"aswift_5\" sandbox=\"allow-forms allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts allow-top-navigation-by-user-activation\" scrolling=\"no\" src=\"https://googleads.g.doubleclick.net/pagead/ads?client=ca-pub-3526212672565487&amp;output=html&amp;h=280&amp;adk=50218539&amp;adf=2407321391&amp;pi=t.aa~a.1376357989~i.49~rp.4&amp;w=700&amp;fwrn=4&amp;fwrnh=100&amp;lmt=1770568114&amp;rafmt=1&amp;armr=3&amp;sem=mc&amp;pwprc=1167521840&amp;ad_type=text_image&amp;format=700x280&amp;url=https%3A%2F%2Fnishachor.com%2Fnaming-culture%2F&amp;host=ca-host-pub-2644536267352236&amp;fwr=0&amp;pra=3&amp;rh=175&amp;rw=699&amp;rpe=1&amp;resp_fmts=3&amp;aieuf=1&amp;aicrs=1&amp;fa=27&amp;uach=WyJXaW5kb3dzIiwiMTAuMC4wIiwieDg2IiwiIiwiMTQ0LjAuNzU1OS4xMzMiLG51bGwsMCxudWxsLCI2NCIsW1siTm90KEE6QnJhbmQiLCI4LjAuMC4wIl0sWyJDaHJvbWl1bSIsIjE0NC4wLjc1NTkuMTMzIl0sWyJHb29nbGUgQ2hyb21lIiwiMTQ0LjAuNzU1OS4xMzMiXV0sMF0.&amp;abgtt=9&amp;dt=1770568121824&amp;bpp=1&amp;bdt=892&amp;idt=1&amp;shv=r20260204&amp;mjsv=m202602030101&amp;ptt=9&amp;saldr=aa&amp;abxe=1&amp;cookie=ID%3D5014397cbd767514%3AT%3D1770567389%3ART%3D1770567915%3AS%3DALNI_MaYeYyacw-XyztGPGoa4cEo9JjFiw&amp;gpic=UID%3D000011f737fa35d0%3AT%3D1770567389%3ART%3D1770567915%3AS%3DALNI_MYS1MWqbUdykVV91pqY1bPPzbrQ3w&amp;eo_id_str=ID%3D3a6df921c2118e95%3AT%3D1770567389%3ART%3D1770567915%3AS%3DAA-Afjas_1YkMkW8UHF0ASnolm-s&amp;prev_fmts=264x600%2C0x0%2C700x280%2C700x280%2C700x280&amp;nras=5&amp;correlator=1109480744549&amp;frm=20&amp;pv=1&amp;u_tz=330&amp;u_his=7&amp;u_h=768&amp;u_w=1366&amp;u_ah=728&amp;u_aw=1366&amp;u_cd=24&amp;u_sd=1&amp;dmc=8&amp;adx=176&amp;ady=3780&amp;biw=1351&amp;bih=641&amp;scr_x=0&amp;scr_y=1217&amp;eid=95378429%2C95381033%2C95381247%2C95382071%2C95382732&amp;oid=2&amp;pvsid=7448000108561806&amp;tmod=1702498510&amp;uas=3&amp;nvt=1&amp;ref=https%3A%2F%2Fnishachor.com%2Fhow-i-multiplied-my-led-bulbs%2F&amp;fc=384&amp;brdim=0%2C0%2C0%2C0%2C1366%2C0%2C1366%2C728%2C1366%2C641&amp;vis=1&amp;rsz=%7C%7Cs%7C&amp;abl=NS&amp;fu=128&amp;bc=31&amp;bz=1&amp;pgls=CAEaBTYuOS4x~CAEQBBoHMS4xNzEuMA..&amp;num_ads=1&amp;ifi=6&amp;uci=a!6&amp;btvi=4&amp;fsb=1&amp;dtd=17816\" tabindex=\"0\" title=\"Advertisement\" vspace=\"0\" width=\"700\"></iframe></ins></p>\r\n\r\n<p>তাই আমার পাঠাগার, আমার বন্ধুদের সম্মিলিত সংঘ (<strong>নোঙর</strong>), আমার মতবাদ , আমার অন্তর্কথা&rsquo;র মতোই আপনিও আপনার যাবতীয় নামকরণে প্রাধান্য দিন বাংলাকে। চেয়ে থাকলাম সেই দিনের প্রতি, যেদিন আবারো কেউ বুক ফুলিয়ে জাতিসংঘের অধিবেশনে বাংলায় বক্তৃতা দিবে, কোনো বাঙালির আবিষ্কৃত মাইক্রোবায়োলজির বই বাংলা নামে পরিচিতি পাবে: ভিনভাষী শিক্ষার্থীরা বুক ফুলিয়ে বলবে&nbsp;<em>আয়্যাম এ্যা স্টুডেন্ট আফ আণুজীববিদ্যা।</em>&nbsp;আমার বিশ্বাস, সেদিন আর খুব বেশি দূরে নয়।</p>\r\n\r\n<p>অনেকেই জানেন, বাংলাদেশের বিভিন্ন ব্র্যান্ড বাংলা নামে এখন বিশ্বজুড়ে পরিচিত: সচলায়তন, মুক্তমনা তেমনি একেকটি ব্লগ সাইট। সচলায়তন-তো&nbsp;www.সচলায়তন.com&nbsp;দিয়ে ডোমেইনও কিনেছিল। বাংলার জনপ্রিয়তা টানছে সবাইকে: বাংলায় ওয়েবসাইট খুলছে বিবিসি, ডয়চে ভেলে। আরো আসছে, একটু অপেক্ষা করুন। &hellip;আর যদি অপেক্ষা ধাতে না সয়, তাহলে দায়িত্বটা কিন্তু আপনার। নিজেই শুরু করুন।</p>\r\n\r\n<blockquote>\r\n<p>যদি তোর ডাক শুনে কেউ না আসে, তবে একলা চলরে&hellip;!</p>\r\n</blockquote>', 0, 1, '2026-02-08 16:30:21', '2026-02-08 16:30:27'),
(18, 'পৃথিবীর নতুন একটা চাঁদ নাকি পাওয়া গেছে?', 'পৃথিবীর-নতুন-একটা-চাঁদ-নাকি-পাওয়া-গেছে', 'admin', NULL, '2026-02-08 16:44:21', 'সোশ‍্যাল মিডিয়াবাসী অনেকেই হয়তো জেনে গেছেন যে,\r\nপৃথিবীর নতুন একটা ছোট চাঁদ পাওয়া গেছে', '<p><strong>পৃথিবীর নতুন একটা চাঁদ নাকি পাওয়া গেছে?</strong></p>\r\n\r\n<p>সোশ&zwj;্যাল মিডিয়াবাসী অনেকেই হয়তো জেনে গেছেন যে,<br />\r\nপৃথিবীর নতুন একটা ছোট চাঁদ পাওয়া গেছে &mdash; নাম&nbsp;<strong>2025 PN<sub>7</sub></strong></p>\r\n\r\n<p>একে Earth&rsquo;s New Moon বলা হলেও বিষয়টা সেরকম না।<br />\r\nএটা আসলে আমাদের আসল চাঁদের মতো ঘোরে না,<br />\r\nবরং সূর্যকে ঘিরে পৃথিবীর পাশে পাশে চলে।</p>\r\n\r\n<p>ইংরেজিতে এদেরকে বলে&nbsp;<strong>Quasi Moon</strong>&nbsp;বা&nbsp;<strong>Quasi Satellite</strong>&mdash; আপাত চাঁদ।<br />\r\nএই যে&nbsp;<strong>2025 PN<sub>7</sub></strong>&mdash; এটা কিন্তু আসলে একটা&nbsp;<strong>গ্রহাণু</strong>&nbsp;(asteroid)।<br />\r\nসূর্যকে ঘিরে ঘুরতে ঘুরতে পৃথিবীর পাশ দিয়ে যাবার সময় পৃথিবীর মাধ্যাকর্ষণের টানে আটকা পড়ে গেছে। এই গ্রহাণুটি নাকি ২০৮৩ খ্রিষ্টাব্দ পর্যন্ত পৃথিবীর এই বাঁধন ছেড়ে বেরোতে পারবে না।</p>\r\n\r\n<p>তবে পৃথিবীর আপাত চাঁদ সে একা নয়&mdash; এপর্যন্ত সে বাদে আরো ৭টা আপাত চাঁদ আছে পৃথিবীর।<br />\r\n&hellip;সে একটু লাইমলাইট পেয়েছে বেশি আরকি।</p>', 1, 1, '2026-02-08 16:35:03', '2026-02-15 17:26:13'),
(19, 'পড়াশোনার ফাঁকে চা খেতে যাওয়াই কাল! ২ ডাক্তারি ছাত্রকে পিষে দিল বেপরোয়া ট্রাক', 'পড়াশোনার-ফাঁকে-চা-খেতে-যাওয়াই-কাল-২-ডাক্তারি-ছাত্রকে-পিষে-দিল-বেপরোয়া-ট্রাক', 'admin', NULL, '2026-02-09 06:25:19', 'দুর্ঘটনার সময় দু\'জনের মাথায় হেলমেট ছিল। কিন্তু ট্রাকের চাকার ধাক্কায় তাঁদের হেলমেট খুলে যায়। মারাত্মকভাবে থেঁতলে যায় দুই মেডিক্যাল পড়ুয়ার মাথা।', '<p>পড়াশোনার মাঝে রাতে বাইরে চা খেতে বেরতেই বিপত্তি। দক্ষিণ কলকাতার ঠাকুরপুকুরে বাইক দুর্ঘটনায় মৃত্যু হল দুই ডাক্তারি ছাত্রের। সূত্রের খবর, তাঁদের বাইক নিয়ন্ত্রণ হারিয়ে সামনে থাকা আরেকটি বাইককে ধাক্কা মেরে রাস্তায় পড়ে যায়। তখনই তাঁদের পিষে দেয় পিছন থেকে আসা একটি বেপরোয়া ট্রাকের চাকা।</p>\r\n\r\n<p>পুলিশের সূত্র জানিয়েছে, রবিবার ভোর সাড়ে ৩টা নাগাদ জেমস লং সরণি এবং পূর্ব পাড়া রোডের সংযোগস্থলে এই দুর্ঘটনাটি ঘটে। মৃতদের নাম আনন্দ প্রিয়দর্শী (২৩) এবং মহম্মদ ফায়াজ জামান মল্লিক (২৩)। তাঁরা জোকার ইএসআই মেডিক&zwnj;্যাল কলেজ ও হাসপাতালের তৃতীয় বর্ষের ছাত্র। প্রিয়দর্শী বাইকটি চালাচ্ছিলেন ও ফায়াজ জামান বসেছিলেন পিছনে। প্রিয়দর্শীর আসল বাড়ি পাটনায়। টালিগঞ্জের পঞ্চাননতলা এলাকার একটি ভাড়া ফ্ল্যাটে থাকতেন। সম্প্রতি তিনি ৪০০ সিসির রোডস্টার বাইক কেনেন। মহম্মদ ফায়াজ জামান মল্লিক ভাঙড়ের বাসিন্দা। দুর্ঘটনার সময় দু&rsquo;জনের মাথায় হেলমেট ছিল। কিন্তু ট্রাকের চাকার ধাক্কায় তাঁদের হেলমেট খুলে যায়। মারাত্মকভাবে থেঁতলে যায় দুই মেডিক্যাল পড়ুয়ার মাথা।</p>\r\n\r\n<p>পুলিশ জেনেছে, রাতে পড়াশোনার মাঝেই ৬ জন ডাক্তারি ছাত্র তিনটি বাইকে করে জোকা থেকে বের হন। বেহালায় গিয়ে চা খাওয়ার পরিকল্পনা করেছিলেন তাঁরা। সিসিটিভির ফুটেজ দেখে পুলিশ জেনেছে, প্রিয়দর্শীদের বাইকের সামনের বাইকটি হঠাৎ থেমে যায় ও ডানদিকে ঘোরার চেষ্টা করে। প্রিয়দর্শীদের বাইকটি সেটিকে ধাক্কা দেয়। দুজনই রাস্তায় পড়ে যান। পিছন থেকে ট্রাকটি এসে নিয়ন্ত্রণ হারিয়ে দু&rsquo;জনকে পিষ্ট করে দেয়। দুর্ঘটনার পর ট্রাকচালক গাড়ি নিয়ে ঘটনাস্থল থেকে পালিয়ে যায়। এলাকার বাসিন্দারা ও ছাত্রদের বন্ধুরা তাঁদের জোকার ইএসআই হাসপাতালে নিয়ে যান। সেখানেই তাঁদের মৃত বলে ঘোষণা করা হয়। ওই মেডিক&zwnj;্যাল কলেজের এক ছাত্র জানান, মৃত দুই ছাত্র প্রায়ই একসঙ্গে বাইকে করে বাইরে যেতেন। হেলমেট ছাড়া বের হতেন না। প্রিয়দর্শী সাবধানতার সঙ্গেই বাইক চালাতেন। ট্রাক চালকের সন্ধান চলছে বলে জানিয়েছে পুলিশ।</p>', 0, 1, '2026-02-09 06:25:02', '2026-02-09 06:25:19'),
(20, 'বিজেপি নেতার জন্য বিশেষ শুনানিকেন্দ্র! ‘হাই কোর্টের নির্দেশ’ সত্ত্বেও কমিশনের ভূমিকায় প্রশ্ন', 'বিজেপি-নেতার-জন্য-বিশেষ-শুনানিকেন্দ্র-হাই-কোর্টের-নির্দেশ-সত্ত্বেও-কমিশনের-ভূমিকায়-প্রশ্ন', 'admin', NULL, '2026-02-09 06:29:44', 'রবিবার বীজপুর বিধানসভা এলাকার হালিশহর রামপ্রসাদ বিদ্যাপীঠের শুনানিকেন্দ্রে এলেন মাত্র একজন ভোটারই, তিনি স্থানীয় বিজেপি নেতা সুদীপ্ত দাস।', '<p>সারাদিনে হাজির মাত্র একজন ভোটার। রবিবার তাঁরই জন্য দিনভর খোলা রইল শুনানিকেন্দ্র। এসআইআরের কাজে সময়সীমা বাড়তেই ভোটার অধিকার রক্ষায় নির্বাচন কমিশনের এই ভূমিকা প্রাথমিকভাবে নজির বলে মনে হলেও দেখা গেল, যাঁর জন্য এই শুনানিকেন্দ্র খোলা হল রবিবার, তিনি এলাকার বিজেপি নেতা। ফলে বিজেপি-কমিশন আঁতাঁত সংক্রান্ত তৃণমূলের অভিযোগ যে নেহাৎ ভিত্তিহীন নয়, তারও ইঙ্গিত মিলল। যদিও নেতার দাবি, হাই কোর্টের নির্দেশে তাঁর জন্য খোলা হয়েছে শুনানিকেন্দ্র।</p>\r\n\r\n<p>কলকাতা হাই কোর্টের নির্দেশে রবিবার হালিশহরের একটি স্কুলে বিশেষ শুনানিকেন্দ্র খোলা হয়। সেখানে হাজির হন হালিশহর পুরসভার ১৫ নম্বর ওয়ার্ডের বাসিন্দা তথা বিজেপি নেতা সুদীপ্ত দাস। শুধুমাত্র তাঁরই শুনানি হল হালিশহর রামপ্রসাদ বিদ্যাপীঠ স্কুলে। শুনানি শেষে হাসিমুখে বেরিয়ে আসেন তিনি। কিন্তু তাঁর জন্যই শুধু কেন খোলা হল শুনানিকেন্দ্র? সুদীপ্ত দাস জানান, &ldquo;আগে আমি কাঁচরাপাড়া পুরসভার ভোটার ছিলাম। পরে হালিশহরে বাড়ি করে বসবাস শুরু করি। কিন্তু ভোটার তালিকায় আমার নাম ছিল না। নতুন করে আবেদন করলেও আমাকে বীজপুর থানার কাঁচরাপাড়ায় হাজির হতে বলা হয়। অথচ হাই কোর্টের নির্দেশে বীজপুর থানা এলাকায় আমার প্রবেশ নিষিদ্ধ। বাধ্য হয়ে আমি আদালতের দ্বারস্থ হই। আদালত দ্রুত ব্যবস্থা নিয়ে আমাকে শুনানিতে ডাকেন। আমি তখন বাইরে ছিলাম, তাই আজ শুনানির জন্য হাজির হয়েছি।&rdquo;</p>\r\n\r\n<h3>সারাদিনে হাজির মাত্র একজন ভোটার। রবিবার তাঁরই জন্য দিনভর খোলা রইল শুনানিকেন্দ্র। এসআইআরের কাজে সময়সীমা বাড়তেই ভোটার অধিকার রক্ষায় নির্বাচন কমিশনের এই ভূমিকা প্রাথমিকভাবে নজির বলে মনে হলেও দেখা গেল, যাঁর জন্য এই শুনানিকেন্দ্র খোলা হল রবিবার, তিনি এলাকার বিজেপি নেতা। ফলে বিজেপি-কমিশন আঁতাঁত সংক্রান্ত তৃণমূলের অভিযোগ যে নেহাৎ ভিত্তিহীন নয়, তারও ইঙ্গিত মিলল।&nbsp;</h3>\r\n\r\n<p>রাজ্যে এসআইআর শুনানি শেষ হওয়ার কথা ছিল ৭ ফেব্রুয়ারি। কিন্তু কয়েকটি জেলায় শুনানির কাজ এখনও বেশ খানিকটা বাকি। তাই জেলাশাসকদের আবেদন মেনে আরও সাতদিন সময়সীমা বাড়িয়েছে নির্বাচন কমিশন। আগামী ১৪ ফেব্রুয়ারি পর্যন্ত শুনানির কাজ চলবে। তারপর চূড়ান্ত ভোটার তালিকা প্রকাশ হতে আরও দিন সাতেক সময় লাগবে। তারই মাঝে রবিবার বিজেপি নেতা সুদীপ্ত দাসের জন্য খোলা রইল শুনানিকেন্দ্রটি। যদিও উচ্চ আদালতের নির্দেশে বিশেষভাবে এই শুনানির আয়োজন করা হয় বলে দাবি তাঁর। কিন্তু এই ঘটনাকে কেন্দ্র করে নির্বাচন কমিশনের ভূমিকা নিয়ে নতুন করে চর্চা শুরু হয়েছে। বিশেষত বিজেপি-কমিশন আঁতাঁতের অভিযোগ আসছে ঘুরেফিরে।</p>', 0, 1, '2026-02-09 06:29:15', '2026-02-09 06:29:44');
INSERT INTO `news_posts` (`id`, `headline`, `slug`, `author`, `sub_author_id`, `post_date_time`, `short_description`, `description`, `views`, `status`, `created_at`, `updated_at`) VALUES
(21, 'সিভিক ভলান্টিয়ারের মৃত্যুতে ব্যাপক ভাঙচুর! কল্যাণী জেএনএম হাসপাতালে ধুন্ধুমার কাণ্ড', 'সিভিক-ভলান্টিয়ারের-মৃত্যুতে-ব্যাপক-ভাঙচুর-কল্যাণী-জেএনএম-হাসপাতালে-ধুন্ধুমার-কাণ্ড', 'admin', NULL, '2026-02-09 06:31:11', 'মৃতের পরিবারের সদস্যরা প্রথমে হাসপাতালে ভাঙচুর চালায়। পরে বীজপুর থানার অধীনে কর্মরত বহু সিভিক ভলান্টিয়ার সেখানে হাজির হন। তারাও হাসপাতাল ভাঙচুরে অংশ নেয় বলে অভিযোগ।', '<p>সিভিক ভলান্টিয়ারের মৃত্যুকে কেন্দ্র করে উত্তাল কল্যাণী JNM হাসপাতাল। হাসপাতালে ব্যাপক ভাঙচুরের অভিযোগ মৃতের পরিবারের বিরুদ্ধে। ঘটনাকে কেন্দ্র করে ধুন্ধুমার পরিস্থিতি তৈরি হয়। আতঙ্কে ছোটাছুটি শুরু করেন চিকিৎসক, নার্স, অন্যান্য রোগী এবং তাদের পরিবারের সদস্যরা। পরবর্তীতে পুলিশের উপস্থিতিতে আয়ত্তে আসে পরিস্থিতি।</p>\r\n\r\n<p>জানা গিয়েছে, মৃত সিভিক ভলান্টিয়ারের নাম তাপস সাহা। তাঁর বয়স ৩৬ বছর। উত্তর ২৪ পরগনার হালিশহরের বাগ মোড়ের বাসিন্দা তিনি। বারাকপুর কমিশনারেটের অন্তর্গত বীজপুর থানায় সিভিক ভলান্টিয়ার হিসেবে কর্মরত ছিলেন তাপস। শনিবার রাতে কাজ সেরে বাড়ি ফেরেন তিনি। তারপরই গুরুতর অসুস্থ হয়ে পড়েন। ভোর পাঁচটা নাগাদ তড়িঘড়ি তাকে নিয়ে যাওয়া হয় কল্যাণী জহরলাল নেহেরু মেমোরিয়াল হাসপাতালে। শুরু হয় চিকিৎসা। চিকিৎসা চলাকালীন চিকিৎসকরা জানান, গ্যাসের কারণে সুগার ফল করেছে। এরপর দুপুরে তাঁর মৃত্যু হয়।</p>\r\n\r\n<p>তাপসের মৃত্যুর খবর জানা মাত্রই ক্ষোভে ফেটে পড়েন পরিবারের সদস্যরা। মৃতের পরিবারের সদস্যরা পুরুষ মেডিসিন বিভাগের সিস্টারের ঘরে ব্যাপক ভাঙচুর চালায় বলে অভিযোগ। কিছুক্ষণের মধ্যে বীজপুর থানার অধীনে কর্মরত বহু সিভিক ভলান্টিয়ার সেখানে হাজির হন। তারাও হাসপাতাল ভাঙচুরে অংশ নেয় বলে অভিযোগ। বেশ কিছুক্ষণ পর পুলিশের উপস্থিতিতে আয়ত্তে আসে পরিস্থিতি। গোটা ঘটনায় প্রবল আতঙ্কে হাসপাতালের চিকিৎসক ও নার্সরা। চিকিৎসকদের কথায়, তাঁদের কোনও নিরাপত্তাই নেই। বারবার এহেন ঘটনা ঘটলেও কর্তৃপক্ষ কোনও ব্যবস্থা নিচ্ছে না বলেই অভিযোগ চিকিৎসকদের একাংশের। মৃতের পরিবারের তরফে এখনও কোনও প্রতিক্রিয়া মেলেনি।</p>', 5, 1, '2026-02-09 06:31:03', '2026-03-01 07:41:37'),
(22, 'মসজিদ নির্মাণ শুরুর পরদিন থেকেই ‘বাবরি যাত্রা’! রাজ্যে কী বার্তা দিতে চান হুমায়ুন?', 'মসজিদ-নির্মাণ-শুরুর-পরদিন-থেকেই-বাবরি-যাত্রা-রাজ্যে-কী-বার্তা-দিতে-চান-হুমায়ুন', 'admin', NULL, '2026-02-09 06:33:13', 'বাবরি মসজিসের নির্মাণকাজ শুরু হবে আগামী ১১ ফেব্রুয়ারি। তারপর দিনই \'বাবরি যাত্রা\' শুরু করছেন বিতর্কিত বিধায়ক হুমায়ুন কবীর। বাংলার উত্তর ও দক্ষিণকে জুড়ে এই যাত্রায় কী বার্তা দিতে চাইছেন হুমায়ুন কবীর?', '<p>বাবরি মসজিদের নির্মাণকাজ শুরু হবে আগামী ১১ ফেব্রুয়ারি। তারপর দিনই &lsquo;বাবরি যাত্রা&rsquo; শুরু করছেন তৃণমূলের বহিষ্কৃত বিধায়ক, জনতা উন্নয়ন পার্টির প্রতিষ্ঠাতা হুমায়ুন কবীর। রাজ্যের একাধিক জায়গায় এই বাবরি যাত্রা যাবে বলে খবর। প্রাথমিকভাবে নদিয়া থেকে উত্তর দিনাজপুর রুটে যাত্রা হবে। আজ, রবিবার এই বিষয়ে মুর্শিদাবাদেই সাংবাদিক সম্মেলন করে এই যাত্রার কথা জানানো হয়েছে। বাংলার উত্তর-দক্ষিণকে জুড়ে এই বাবরি যাত্রায় কী বার্তা দিতে চাইছেন হুমায়ুন কবীর?</p>\r\n\r\n<p>র্শিদাবাদের বেলডাঙায় বাবরি মসজিদ নির্মাণের কথা আগেই ঘোষণা করেছিলেন হুমায়ুন। রাজ্যের শাসকদল তৃণমূল কংগ্রেস থেকে বহিষ্কৃত হওয়ার পর তাদের হারাতে মরিয়া তিনি। সেই আবহে বাংলায় বাবরি মসজিদ নির্মাণ ভোটবাক্সে কতটা প্রভাব ফেলবে? সেই নিয়ে চর্চা চলছে। আগেই বাবরি মসজিদের ভিত্তিপ্রস্তর স্থাপন হয়েছিল। জানানো হয়েছিল, আগামী ১১ ফেব্রুয়ারি থেকে মসজিদ তৈরির কাজ শুরু হবে। সেই আবহে এবার বাবরি যাত্রার কথা ঘোষণা করেছেন হুমায়ুন।</p>\r\n\r\n<p>জানা গিয়েছে, আগামী ১১ তারিখ কোরান পাঠের পর শুরু হবে বাবরি মসজিদ নির্মাণের কাজ। পরদিন অর্থাৎ ১২ তারিখ শুরু হবে বাবরি যাত্রা। ১০০টি গাড়ি নিয়ে নদিয়ার পলাশি থেকে ওই যাত্রা শুরু হবে। প্রত্যেকটি গাড়িতে চালক-সহ ছ&rsquo;জন থাকবেন। অর্থাৎ মোট ৬০০ জন এই যাত্রায় সামিল হবেন। প্রথমে পলাশি থেকে উত্তর দিনাজপুরের ইটাহার পর্যন্ত মোট ২৬৫ কিমি যাত্রা হবে বলে খবর। কিন্তু এই বাবরি যাত্রার কারণ কী? হুমায়ুন জানিয়েছেন, বেশ কিছু মানুষ এই বাবরি মসজিদ নির্মাণ নিয়ে অপপ্রচার চালাচ্ছেন। সেই অপপ্রচারের বিরুদ্ধে ও মানুষকে এই নির্মাণ সম্পর্কে জানানোই এই যাত্রার লক্ষ্য। হুমায়ুনের কথায়, &ldquo;এর আগেও একজন অপপ্রচার করেছিলেন। কিন্তু তিনি ব্যর্থ হন। আবার করলে ব্যর্থ হবেন।&rdquo; উত্তরের সঙ্গে দক্ষিণকে জোড়ার পরিকল্পনার মাধ্যমে হুমায়ুন ভোটের প্রচারও শুরু করে দিচ্ছেন, এমনই মত ওয়াকিবহাল মহলের।</p>', 0, 1, '2026-02-09 06:32:59', '2026-02-09 06:38:14'),
(23, '‘কেন খেলবে না সেটাই বুঝতে পারছি না’, পাকিস্তানের ‘অদ্ভুত’ সিদ্ধান্ত নিয়ে মুখ খুললেন সৌরভ', 'কেন-খেলবে-না-সেটাই-বুঝতে-পারছি-না-পাকিস্তানের-অদ্ভুত-সিদ্ধান্ত-নিয়ে-মুখ-খুললেন-সৌরভ', 'admin', NULL, '2026-02-09 06:40:50', 'টি-টোয়েন্টিতে একই রকম আক্রমণাত্মক খেলার পরামর্শ দিয়েছেন তিনি। তাঁর মতে, এমন আগ্রাসী ঘরানার ক্রিকেটই খেলা উচিত ভারতের।', '<p>এবার পাকিস্তানের তুলোধোনায় প্রাক্তন অধিনায়ক সৌরভ গঙ্গোপাধ্যায়। ভারতের বিরুদ্ধে ম্যাচ বয়কটের হুমকি দিয়ে যেভাবে নাটক করে চলেছে পাকিস্তান, তাতে তিতিবিরক্ত মহারাজ। তাছাড়াও টি-টোয়েন্টিতে একই রকম আক্রমণাত্মক খেলার পরামর্শ দিয়েছেন তিনি। তাঁর মতে, এমন আগ্রাসী ঘরানার ক্রিকেটই খেলা উচিত ভারতের।&nbsp;</p>\r\n\r\n<p>স্রেফ দেখো আর মারো। ছিন্নভিন্ন করে দাও প্রতিপক্ষকে। গম্ভীর জমানায় এটাই ভারতীয় টি-২০ দলের দর্শন। কিন্তু সেই একরোখা ব্যাটিং যে যে কোনও দিন দলকে বিপদে ফেলে দিতে পারে তার জলজ্যান্ত উদাহরণ বিশ্বকাপের প্রথম ম্যাচ। আমেরিকার বিরুদ্ধে অভিযান শুরুতেই মহাবিপর্যয়ের মুখে ভারতীয় ব্যাটিং বিভাগ। অভিষেক শর্মা, ঈশান কিষান, তিলক বর্মা, রিঙ্কু সিং, হার্দিক পাণ্ডিয়া। ব্যাটিং অর্ডারের তাবড় তাবড় বড় নাম ব্যর্থ। তবে এটা নিয়ে খুব বিশেষ চিন্তত নন &lsquo;দাদা&rsquo;। তাঁর মতে, প্রতিযোগিতা যত গড়াবে, তত টিম ইন্ডিয়ার ধার বাড়বে।</p>\r\n\r\n<p>সৌরভ বলছেন, &ldquo;খুবই শক্তিশালী দল ভারত। ব্যাটিং, বোলিং, ফিল্ডিং সমস্ত বিভাগেই অসাধারণ ভারসাম্য রয়েছে। বিশ্বকাপ যত এগোবে, দল আরও ভালো খেলবে। ছন্দ ফিরে আসবে। ভারতই ট্রফি জেতার দাবিদার। এই দলকে হারানো কঠিন।&rdquo; বিশ্বকাপের প্রথম ম্যাচে দেখা গিয়েছে চালিয়ে খেলতে গিয়ে উইকেট দিয়ে আসছেন ব্যাটাররা। একটা সময় ৪৬ রানে ৪ উইকেট খুইয়ে চাপে পড়ে গিয়েছিল টিম ইন্ডিয়া। সেখান থেকে অধিনায়ক সূর্যকুমার যাদবের দুর্ধর্ষ ব্যাটিংয়ে কোনওক্রমে টিম ইন্ডিয়ার মানরক্ষা হয়। মহারাজের কথায়, &ldquo;টি-টোয়েন্টি তো এরকমই। আগ্রাসী হতেই হবে। ওরা প্রত্যেকে অসাধারণ ক্রিকেটার। অনেক দিন ধরেই এমন খেলছে। কিন্তু ওরা তো মানুষ। তাই এক-আধদিন ব্যর্থতা আসতেই পারে।&rdquo;</p>\r\n\r\n<p>পাকিস্তান প্রসঙ্গে সৌরভ বলেন, &ldquo;ওদের না খেলার তো কোনও কারণ নেই। কেন খেলবে না, সেটাই বুঝতে পারছি না। বিশ্বকাপে ওরা ভারতের বিরুদ্ধে শ্রীলঙ্কায় খেলবে। তাহলে সমস্যাটা কোথায়? এটা বিশ্বকাপ। তাই প্রতিটা পয়েন্ট গুরুত্বপূর্ণ। সেই কারণে পাকিস্তান না খেললেই আমি সবথেকে অবাক হয়ে যাব।&rdquo; উল্লেখ্য, একদিন আগেই ভবিষ্যতে যাতে এমন পরিস্থিতি না হয়, সেই ব্যাপারে আইসিসিকে পরামর্শ দিয়েছিলেন কিংবদন্তি ক্রিকেটার সুনীল গাভাসকর। তাছাড়াও দুই দেশের মধ্যে খেলাধুলা এবং সাংস্কৃতিক বিনিময়ের ক্ষেত্রে দীর্ঘদিনের ভারসাম্যহীনতাকে তুলে ধরেছেন। সাফ জানান, ভারতই সব সময় সাহায্যের হাত বাড়ায়। এবার সুর চড়ালেন সৌরভও।</p>', 0, 1, '2026-02-09 06:40:39', '2026-02-09 06:40:50'),
(24, 'ভারতের বিরুদ্ধে বিশ্বকাপে খেলতে রাজি পাকিস্তান, তবে রয়েছে তিনটি শর্ত! কবে চূড়ান্ত সিদ্ধান্ত?', 'ভারতের-বিরুদ্ধে-বিশ্বকাপে-খেলতে-রাজি-পাকিস্তান-তবে-রয়েছে-তিনটি-শর্ত-কবে-চূড়ান্ত-সিদ্ধান্ত', 'admin', NULL, '2026-02-09 06:42:31', 'উষ্মার বরফ গলে সম্ভাবনা বাড়ছে ভারত-পাক যুদ্ধের। বয়কট ভুলে টি-২০ বিশ্বকাপে ভারতের বিরুদ্ধে হয়তো মাঠে নামবে পাকিস্তান। আইসিসি\'র কাছে শাস্তির আশঙ্কা, ক্রিকেটদুনিয়ায় একঘরে হয়ে যাওয়ার মতো প্রবল চাপের কাছে শেষমেশ সুর নরম করেছে মহসিন নকভির পাকিস্তান।', '<p>উষ্মার বরফ গলে সম্ভাবনা বাড়ছে ভারত-পাক যুদ্ধের। বয়কট ভুলে টি-২০ বিশ্বকাপে ভারতের বিরুদ্ধে হয়তো মাঠে নামবে পাকিস্তান। আইসিসি&rsquo;র কাছে ৪৫০০ টাকা শাস্তির আশঙ্কা, ক্রিকেটদুনিয়ায় একঘরে হয়ে যাওয়ার মতো প্রবল চাপের কাছে শেষমেশ সুর নরম করেছে মহসিন নকভির পাকিস্তান। তবে সেক্ষেত্রে তিন শর্ত বেঁধে দেওয়া হয়েছে। জানা গিয়েছে, আগামী ২৪ ঘণ্টার মধ্যে এই বিষয়ে চূড়ান্ত সিদ্ধান্ত নেবে পিসিবি।&nbsp;</p>\r\n\r\n<p>১ ফেব্রুয়ারি পাকিস্তান সরকার ঘোষণা করেছিল, বিশ্বকাপে অংশ নিলেও ভারতের বিরুদ্ধে তারা মাঠে নামবে না। তবে এ ব্যাপারে এখনও পর্যন্ত আইসিসি&rsquo;কে লিখিতভাবে তারা কিছু জানায়নি। এই পরিস্থিতিতে শ্রীলঙ্কা ক্রিকেট বোর্ড পিসিবি&rsquo;কে কড়া চিঠিও লেখে পাকিস্তান। টিকিট বিক্রির কথাও তুলে ধরা হয়। তাছাড়াও আর্থিক, পর্যটন খাতে ক্ষতির সম্ভাবনার কথাও তুলে ধরা হয় গত শুক্রবার। কিন্তু পাকিস্তান সরকার অনুমতি দেয়নি বলে ভারতের বিরুদ্ধে খেলা যাবে না, এটাও পাক বোর্ডের অবস্থান ছিল। এতদিন এ ব্যাপারে কোনও রা না করলেও রবিবার এই ইস্যুতে সন্ধ্যা সাড়ে ৬টায় লাহোরে পিসিবি&rsquo;র দপ্তরে ম্যারাথন বৈঠকও হয়।</p>\r\n\r\n<p>আইসিসি&rsquo;র প্রতিনিধি হিসাবে লাহোরে গিয়েছিলেন ইমরান খোয়াজা এবং মোবাশির উসমানি। খোয়াজা হলেন আইসিসি চেয়ারম্যান জয় শাহের সহকারী। বৈঠকে ছিলেন পাক বোর্ডের প্রধান মহসিন নকভি। তাঁর পাশে থাকার জন্য লাহোরে যান বাংলাদেশ বোর্ডের প্রেসিডেন্ট আমিনুল ইসলাম বুলবুল। তিনিও ছিলেন বৈঠকে। আইসিসি&rsquo;র সিইও সংযোগ গুপ্তাও ভিডিও কনফারেন্সে ছিলেন। এবার এনডিটিভি সূত্রে জানা গিয়েছে, অনুযায়ী ভারতের বিরুদ্ধে খেলার জন্য তিনটি শর্ত রেখেছে পিসিবি।</p>\r\n\r\n<ol>\r\n	<li>বাংলাদেশ বিশ্বকাপ না খেললেও তাদের &lsquo;পার্টিসিপেশন ফি&rsquo; দিতে হবে।</li>\r\n	<li>আইসিসি&rsquo;কে নিশ্চিত করতে হবে ভবিষ্যতে যাতে বাংলাদেশে আইসিসি&rsquo;র বড় কোনও প্রতিযোগিতা হতে পারে।</li>\r\n	<li>আইসিসি&rsquo;র কাছ থেকে যে লভ্যাংশ পায় বাংলাদেশ, তা বাড়াতে হবে।</li>\r\n</ol>\r\n\r\n<p>আবার অন্য এক আন্তর্জাতিক ক্রিকেট ওয়েবসাইটের রিপোর্টের দাবি, বাংলাদেশের স্বার্থে নয়, পাকিস্তান তিনটি শর্ত রেখেছে কেবল নিজেদের স্বার্থের কথা ভেবে। সেই তিনটি শর্ত হল &ndash;</p>\r\n\r\n<ol>\r\n	<li>আইসিসি&rsquo;র কাছ থেকে যে লভ্যাংশ পায় পিসিবি, তা অবিলম্বে বাড়াতে হবে।</li>\r\n	<li>শেষবার ভারত-পাকিস্তানের মধ্যে দ্বিপাক্ষিক সিরিজ হয়েছিল ২০০৮ সালে। তা আবার চালু করতে হবে।</li>\r\n	<li>ভারতীয় ক্রিকেটারদের করমর্দনের বাধ্য করতে হবে।</li>\r\n</ol>\r\n\r\n<p>এনডিটিভি সূত্রে যে তিন শর্ত উদ্ধৃত হয়েছে, তা আইসিসি&rsquo;র মেনে নিতে কোনও সমস্যা নেই। কিন্তু অন্য তিন শর্তের মধ্যে লভ্যাংশের প্রসঙ্গ বাদে বাকি দুই শর্ত আইসিসি&rsquo;র পক্ষে মেনে নেওয়া কঠিন। কারণ দ্বিপাক্ষিক সিরিজ এবং করমর্দন ইস্যু নির্ভর করছে কেন্দ্রীয় সরকারের সিদ্ধান্তের উপর। সেখানে ক্রিকেটের নিয়ামক সংস্থা নাক গলাতে পারে না।</p>\r\n\r\n<p>তবে পাকিস্তান যে পিছু হটতে পারে, সেই আভাস আগেও পাওয়া গিয়েছিল। প্রথমত, আইসিসি&rsquo;কে পাকিস্তানের তরফে বৈঠক করার অনুরোধ করা হয়। কারণ পিসিবি ম্যাচ বয়কটের ব্যাপারটা পুরোপুরি পাকিস্তান সরকারের ঘাড়ে চাপায়। এরপরেই রবিবারের পঞ্চমুখী বৈঠক। জানা গিয়েছে, পিসিবি&rsquo;র কিছু কর্তাও চান, ম্যাচ হোক। পাক প্রধানমন্ত্রী শাহবাজ শরিফের সঙ্গে কথাও বলবেন পিসিবি প্রধান মহসিন নকভি। তাছাড়াও টি-টোয়েন্টি বিশ্বকাপের প্রথম ম্যাচে নেদারল্যান্ডসের বিপক্ষে সলমন আঘাদের পারফরম্যান্স আশাব্যঞ্জক নয়। তাই বিশ্বকাপের মতো মঞ্চে, যেখানে প্রতিটি পয়েন্ট গুরুত্বপূর্ণ, সেখানে ভারত ম্যাচ বয়কটের মতো আত্মঘাতী সিদ্ধান্ত তারা নিতে চায়নি।</p>\r\n\r\n<p>তাছাড়াও শ্রীলঙ্কা বোর্ডের চাপ তো ছিলই। কারণ ইতিমধ্যেই তারা ক্রিকেটারদের রাষ্ট্রপ্রধানদের সমান নিরাপত্তা দেওয়ার কথা ঘোষণা করেছিল। অর্থাৎ ম্যাচ আয়োজন নিয়ে দ্বীপরাষ্ট্রের তরফে যে কোনও ত্রুটি থাকবে না, সেই প্রতিশ্রুতিও তারা দিয়েছে। সুতরাং ভারতের বিরুদ্ধে ম্যাচ বয়কটের যে ধুয়ো পাকিস্তান তুলেছে, তার কোনও সরবত্তা নেই। যা ইতিমধ্যেই বুঝেছে তারা। নিজেদের পায়ে কুড়ুল না মেরে বয়কট নাটক ভুলে আগামী রবিবার (১৫ ফেব্রুয়ারি) টিম ইন্ডিয়ার বিরুদ্ধে কি নামবে পাক দল? জানা যাবে ২৪ ঘণ্টার মধ্যে।</p>', 1, 1, '2026-02-09 06:42:22', '2026-02-16 07:32:53'),
(25, 'চাপের মুখে দুরন্ত ডবল সেঞ্চুরি সুদীপের, রনজিতে সেমির স্বপ্নে বিভোর বাংলা', 'চাপের-মুখে-দুরন্ত-ডবল-সেঞ্চুরি-সুদীপের-রনজিতে-সেমির-স্বপ্নে-বিভোর-বাংলা', 'admin', NULL, '2026-02-09 06:44:56', 'বড় কোনও অঘটন না হলে ম্যাচ প্রথম ইনিংসে এগিয়ে থাকার সুবাদে ৩ পয়েন্ট নিয়ে সেমিফাইনালে পৌঁছানো এখন স্রেফ সময়ের অপেক্ষা। তবে এখান থেকে জিততেও পারে বাংলা। কারণ দলে রয়েছে মহম্মদ শামি, আকাশ দীপ, মুকেশ কুমার, শাহবাজ আহমেদের মতো আন্তর্জাতিক মানের বোলাররা।', '<p>একটা সময় দেওয়ালে পিঠ ঠেকে গিয়েছিল বাংলার। একটা সময় মনে হচ্ছিল, বড় লিড না পেয়ে যায় অন্ধ্র! তবে সেসব আশঙ্কা দূর করে সুদীপ ঘরামির লড়াকু ডবল সেঞ্চুরিতে ভর করে সেমির স্বপ্নে বিভোর বঙ্গ ব্রিগেড। তৃতীয় দিনের শেষে ইতিমধ্যেই ১২৩ রানে লিড নিয়েছে অভিমন্যু ঈশ্বরণের দল।</p>\r\n\r\n<p>২৬ বছরের এই ক্রিকেটার দ্বিতীয় দিন নট আউট ছিলেন ১১২ রানে। ২২ রানে তাঁর সঙ্গে অপরাজিত ছিলেন সুমন্ত গুপ্ত। তখনও ৯৬ রানে পিছিয়ে বাংলা। সুদীপ-সুমন্তর জুটির দিকে তাকিয়ে গোটা দল। তাঁরা মর্যাদা রাখলেন। প্রথম ইনিংসে অন্ধ্রপ্রদেশের ২৯৫ রানের জবাবে একটা সময় ১৫৩ রানে ৫ উইকেট খুইয়ে ধুঁকছিল বাংলা। সেখান থেকে তাঁদের জুটিতে উঠল ১৬৫ রান। তাঁদের সৌজন্যেই অন্ধ্রের রান পিছনে ফেলে বাংলা।</p>\r\n\r\n<p>৮১ রানের দুর্দান্ত ইনিংস খেলে যখন সাজঘরে ফিরছেন সুমন্ত, বাংলার স্কোর বোর্ডে তখন ৩১৮। কিন্তু কে জানত, পিকচার আভি বাকি হ্যায়! আটে নেমে জমে গেলেন উইকেটরক্ষক শাকির গান্ধী (৪৫*)। টলানো গেল না সুদীপের মজবুত ডিফেন্সকেও। দিনের শেষে ডবল সেঞ্চুরি করলেন সুদীপ কুমার ঘরামি। তিনি অপরাজিত ৪৫১ বলে ২১৬ রানে। যতবার দল বিপাকে পড়েছে ত্রাতার ভূমিকায় অবতীর্ণ হয়েছেন সুদীপ। চলতি মরশুমের রনজিতেও কথা বলেছে তাঁর ব্যাট। কোয়ার্টার ফাইনালেও এর ব্যতিক্রম হল না।</p>\r\n\r\n<p>যদিও সমর্থকদের মনে বাংলা দলকে নিয়ে একটা আশঙ্কা আছেই। নকআউটে গিয়ে প্রত্যাশার কাছে বারবার পর্যুদস্ত হয় তারা। দু&rsquo;টো মরশুম আগেও আশা জাগিয়ে সৌরাষ্ট্রর কাছে হেরে গিয়েছিল বাংলা। সেই স্মৃতি এখনও দগদগে। কিন্তু ন্যাড়া বারবার যে বেলতলা যেতে পারে না, সে কথাই ছেলেদের ঠারেঠোরে বুঝিয়ে দিয়েছেন কোচ লক্ষ্মীরতন শুক্লা। রনজিতে এখনও পর্যন্ত বাংলার যা পারফরম্যান্স, তাতে এই দলকে নিয়ে স্বপ্ন দেখাই যায়। তৃতীয় দিনের শেষে ১২৩ রানে এগিয়ে বঙ্গ ব্রিগেড। বড় কোনও অঘটন না হলে ম্যাচ প্রথম ইনিংসে এগিয়ে থাকার সুবাদে ৩ পয়েন্ট নিয়ে সেমিফাইনালে পৌঁছানো এখন স্রেফ সময়ের অপেক্ষা। তবে এখান থেকে জিততেও পারে বাংলা। কারণ দলে রয়েছে মহম্মদ শামি, আকাশ দীপ, মুকেশ কুমার, শাহবাজ আহমেদের মতো আন্তর্জাতিক মানের বোলাররা।</p>', 0, 1, '2026-02-09 06:44:01', '2026-02-09 06:44:56'),
(26, 'তাপমাত্রার হেরফেরে কমেছে উৎপাদন! সরস্বতী পুজোর আগেই মহার্ঘ গাঁদা', 'তাপমাত্রার-হেরফেরে-কমেছে-উৎপাদন-সরস্বতী-পুজোর-আগেই-মহার্ঘ-গাঁদা', 'admin', NULL, '2026-02-09 06:49:27', 'সরস্বতী পুজোয় গাঁদাফুলের চাহিদা বেড়ে যায়। তাছাড়া ২৩ জানুয়ারি নেতাজির জন্মদিন, ২৬ জানুয়ারি সাধারণতন্ত্র দিবস, এইসব দিনে গাঁদার চাহিদা থাকে।', '<p>সামনে সরস্বতী পুজো। বাগদেবীর আরাধনার আগেই অবশ্য মহার্ঘ গাঁদা। শীতের মরশুমে তাপমাত্রার হেরফেরের ফলেই ফুল উৎপাদন ব্যাহত হয়েছে বলে ফুল বিশেষজ্ঞ ও ফুলচাষিরা জানিয়েছেন।</p>\r\n\r\n<p>সরস্বতী পুজোয় গাঁদাফুলের চাহিদা বেড়ে যায়। তাছাড়া ২৩ জানুয়ারি নেতাজির জন্মদিন, ২৬ জানুয়ারি সাধারণতন্ত্র দিবস, এইসব দিনে গাঁদার চাহিদা থাকে। এবার সরস্বতী পুজো এগিয়ে এসেছে। শুক্রবার ২৩ জানুয়ারি। নেতাজির জন্মদিন ও সরস্বতী পুজো একই দিনে পড়েছে। তার আগেই ফুলবাজারে গাঁদার দাম একলাফে তিনগুণ দাম বেড়ে গিয়েছে। কোলাঘাট পাইকারি বাজার থেকে হাওড়া মল্লিকঘাটে ফুলবাজারে গাঁদা ঢুকতেই দাম আকাশছোঁয়া হয়ে যাচ্ছে।</p>\r\n\r\n<p>সাধারণত কমলা গাঁদার প্রতিকেজি দাম থাকে ১৫ থেকে ২০ টাকা। সেখানে এখন ৫০ থেকে ৬০ টাকা কেজি দরে বিক্রি হচ্ছে লাল গাঁদা (Flower Price Rise)। হলুদ গাঁদার চাহিদা সরস্বতী পুজোয় বেশি থাকে। সেখানে হলুদ গাঁদার দামও এখন প্রতি কেজি ৮০ থেকে ৯০ টাকা করে বিক্রি হচ্ছে। অথচ সাধারণ সময়ে এর দাম ৫০ থেকে ৬০ টাকার মধ্যে থাকে। গাঁদার পাশাপাশি চেরিরও মূল্যবৃদ্ধি হয়েছে।</p>\r\n\r\n<p>এবার বড় কোনও দুর্যোগ ছিল না। শীতে বৃষ্টিও হয়নি। ফলে ফুলচাষ এবার ভালো হয়েছে। বাজারে ফুলের জোগানও রয়েছে। তবু ফুলবাজারে মূল্যবৃদ্ধি ঠেকানো যাচ্ছে না। ২০-২৫ টাকা কেজি রজনীগন্ধা এখন বিক্রি হচ্ছে ৭০ থেকে ৮০ টাকা দরে। মল্লিকঘাট ফুলবাজার থেকে শহর ও শহরতলিতে ফুল সরবরাহ করা হয়। পাইকারি ফুলবাজারে অগ্নিমূল্যের আঁচ খুচরো বাজারেও এসে পড়েছে।</p>\r\n\r\n<p>চিনা গাঁদা, যার দাম ৩৫ থেকে ৪০ টাকার মধ্যে থাকে প্রতিকেজি। তার দাম এখন ৬০ থেকে ৭০ টাকা। সরস্বতী পুজোয় চেরি ফুলেরও চাহিদা থাকে। এক কেজি চেরি ফুলের দাম ৫০ টাকা। সেখানে ১২০ থেকে ১৫০ টাকা কেজি দরে বিক্রি হচ্ছে চেরি। ক্রেতাদের বক্তব্য, সরস্বতী পুজোর আগেই ফুলের দাম এতটাই বেড়ে গিয়েছে। পুজোর দিন তাহলে কী হবে? এবার সরস্বতী পুজো ও নেতাজির জন্মদিন একই দিনে পড়েছে। গাঁদাফুলের চাহিদা আরও বেশি থাকবে। স্বাভাবিকভাবে দাম আরও বেড়ে যাবে।</p>\r\n\r\n<p>সারা বাংলা ফুলচাষি ও ফুল ব্যবসায়ী সমিতির সাধারণ সম্পাদক নারায়ণ চন্দ্র নায়েক বলেন, &ldquo;এই সময় গাঁদাফুলের চাহিদাটা বেশি থাকে। তাই দাম একটু বেড়ে যায়। তার উপর বিয়ের মরশুমও শুরু হচ্ছে। এই সময় গোলাপ, রজনীগন্ধার দামও বেশি থাকে। তবে এবার ফুলের জোগান খুব ভালো থাকায় মূল্যবৃদ্ধি সেই হারে হবে না বলে আশা করা যাচ্ছে। যদিও খুচরো বিক্রেতারা মনে করছেন পুজোর দিনে এই দাম দ্বিগুণ হয়ে যাবে। ফলে এবার বাগদেবীর আরাধনায় পকেটে লক্ষ্মীর টান পড়তে পারে।</p>', 0, 1, '2026-02-09 06:49:17', '2026-02-09 06:49:27'),
(27, 'টাওয়ারের রেডিয়েশনে কমছে খেজুর রস! ভালো রসের আকাল, ক্ষতি ব্যবসায়ীদের', 'টাওয়ারের-রেডিয়েশনে-কমছে-খেজুর-রস-ভালো-রসের-আকাল-ক্ষতি-ব্যবসায়ীদের', 'admin', NULL, '2026-02-09 06:51:22', 'নলেন গুড় তৈরির ঐতিহ্য কি ক্রমশ লুপ্ত হয়ে যাবে?', '<p>কনকনে শীতের ভোরে খেজুর গাছে উঠে রস সংগ্রহ করে তা জাল দিয়ে চির চেনা বাংলার নলেন গুড় তৈরির ঐতিহ্য কি ক্রমশ লুপ্ত হয়ে যাবে? এমনই আশঙ্কা বসিরহাটের খেজুর গাছের মালিক, রস সংগ্রহকারী ও নলেন গুড় ব্যবসায়ীদের। তাঁদের আশঙ্কা, আতঙ্কের উৎস মোবাইল ফোনের টাওয়ারের রেডিয়েশন বা বিকিরণ! এহেন রেডিয়েশনে খেজুর গাছের রস কমে যাচ্ছে বলে দাবি তাঁদের। পর্যাপ্ত পরিমাণ রস না মেলায় নলেন গুড়ের মান ও উৎপাদন-দুই-ই মার খাচ্ছে বলে জানাচ্ছেন তাঁরা। বসিরহাটের ইটিন্ডা, মেরুদণ্ডী, গাছা, আখারপুর, প্রসন্নকাটি। স্বরূপনগরের কৈজুরী, বালতি, নিত্যানন্দকাটি, সগুনা, কাচদহ। বাদুড়িয়ার সফিরাবাদ, শায়েস্তানগর, যশাইকাটি ও যদুরহাটি-সর্বত্র একই আশঙ্কার সুর।</p>\r\n\r\n<p>বিভিন্ন গ্রামের খেজুর রস সংগ্রহকারীরা জানাচ্ছেন, আগের তুলনায় রসের পরিমাণ চোখে পড়ার মতো কমেছে। বহু গাছে রস নামছেই না, আবার কোথাও রসের স্বাদ ও ঘনত্ব আগের মতো থাকছে না। অভিজ্ঞ রস সংগ্রহকারী গোবিন্দ সাধু বলেন, &ldquo;আগে একটা গাছ থেকে যে পরিমাণ রস পাওয়া যেত, এখন তার অর্ধেকও মেলে না। অনেক গাছে খালি কলসি ফিরে আসে। আশেপাশে ব্যাঙের ছাতার মতো গজিয়ে ওঠা মোবাইল টাওয়ারের জন্যই এই সমস্যা বলে আমাদের ধারণা।&rdquo; উদ্বিগ্ন খেজুর গাছ মালিকরাও বলছেন, বছরের পর বছর পরিচর্যা করা গাছগুলি হঠাৎ যেন দুর্বল হয়ে পড়ছে। নতুন ডাল বেরনোর হার কমছে, গাছের প্রাণশক্তিও আগের মতো নেই।</p>\r\n\r\n<p>স্বরূপনগরের এক গাছ মালিকের বক্তব্য, &ldquo;খেজুর গাছ একদিনে বড় হয় না। বছরের পর বছর ধরে যত্ন নিতে হয়। এখন যদি গাছ রসই না দেয়, এই পেশা টিকবে কীভাবে?&rdquo; বসিরহাটের নলেন গুড়ের খ্যাতি রাজ্যের বাইরেও। কিন্তু এ বছর ব্যবসায়ীরা বলছেন, ভালো মানের গুড় তৈরি করাই বড় চ্যালেঞ্জ। পর্যাপ্ত রস না পাওয়ায় উৎপাদন কমেছে, বেড়েছে খরচ। অনেক ক্ষেত্রে রসের মান ঠিক না থাকায় গুড়ের রং ও স্বাদেও পরিবর্তন আসছে। বসিরহাট পুরাতন বাজারের এক নলেন গুড় ব্যবসায়ী বলেন, &ldquo;ক্রেতারা আগের মতো গুড় পাচ্ছেন না বলে অভিযোগ করছেন। রস কম হলে গুড় ভালো হয় না। এতে আমাদের সুনামও ক্ষতিগ্রস্ত হচ্ছে।&rdquo;</p>\r\n\r\n<p>পরিবেশবিদদের একাংশ মোবাইল ফোনের টাওয়ারের জন্য খেজুর রস কমে যাওয়ার অভিযোগ গুরুত্ব দিয়ে খতিয়ে দেখার কথা বলছে। তাঁদের মতে, মোবাইল টাওয়ার থেকে নির্গত তড়িৎচৌম্বকীয় তরঙ্গের দীর্ঘমেয়াদি প্রভাব নিয়ে এখনও পর্যাপ্ত গবেষণা প্রয়োজন। গাছপালা ও জীববৈচিত্রের উপর রেডিয়েশনের প্রভাব পুরোপুরি উড়িয়ে দেওয়া যায় না। এক পরিবেশবিদ বলেন, &ldquo;একদিনে এই সমস্যা তৈরি হয়নি। দীর্ঘদিন ধরে টাওয়ারের রেডিয়েশন গাছের স্বাভাবিক বৃদ্ধি ও রস উৎপাদনে প্রভাব ফেলতে পারে। বিষয়টি নিয়ে বৈজ্ঞানিক সমীক্ষা জরুরি।&rdquo; খেজুর রস, নলেন গুড় বসিরহাটের অর্থনীতির সঙ্গে অঙ্গাঙ্গীভাবে জড়িত। প্রত্যক্ষ বা পরোক্ষভাবে কয়েক লক্ষ মানুষ এর উপর নির্ভরশীল। উদ্বিগ্ন রস সংগ্রহকারী থেকে ব্যবসায়ী। দাবি, প্রশাসনিক স্তরে সমীক্ষা করে মোবাইল টাওয়ার বসানোর নীতি ও পরিবেশগত প্রভাব খতিয়ে দেখা হোক।</p>', 0, 1, '2026-02-09 06:50:18', '2026-02-09 06:51:22'),
(28, 'শিলাবৃষ্টি ও বানরের দৌরাত্ম্য, বড়সড় সংকটে কালিম্পংয়ের কমলালেবু চাষ', 'শিলাবৃষ্টি-ও-বানরের-দৌরাত্ম্য-বড়সড়-সংকটে-কালিম্পংয়ের-কমলালেবু-চাষ', 'admin', NULL, '2026-02-09 07:04:17', 'মাথায় হাত কৃষকদের।', '<p><strong>অরূপ বসাক, মালবাজার:</strong>&nbsp;কালিম্পংয়ের কমলালেবু চাষ এই বছর বড়সড় সংকটের মুখে। কোথাও লাগামছাড়া বানরের দৌরাত্ম্য, কোথাও আবার আচমকা শিলাবৃষ্টির ক্ষতি &ndash; সব মিলিয়ে জেলার বিস্তীর্ণ এলাকায় কমলাচাষিরা চরম অনিশ্চয়তার মধ্যে পড়েছেন। সামসিং ও সংলগ্ন লোয়ার ঘুমতি গাঁও, আপার ঘুমতি গাঁও, ভালুখোপ, তিনকাটারি, চিপলেদাড়া এবং খোলাগাঁও &ndash; এই এলাকাগুলি বহুদিন ধরেই উন্নত মানের কমলালেবু চাষের জন্য পরিচিত। কিন্তু গত কয়েক বছর ধরে পাহাড়ি সংলগ্ন জঙ্গল থেকে নেমে আসা বানরের দল বেঁধে হামলায় কার্যত ভেঙে পড়েছে এই অঞ্চলের কমলা বাগান। অভিযোগ, পাকা ফল খেয়ে নেওয়ার পাশাপাশি অসংখ্য ফল নষ্ট করে দিচ্ছে বানরেরা।</p>\r\n\r\n<p>স্থানীয়দের দাবি, বন দপ্তর ও হর্টিকালচার দপ্তরে একাধিকবার অভিযোগ জানানো হলেও এখনও পর্যন্ত কোনও কার্যকর ব্যবস্থা নেওয়া হয়নি। সামসিংয়ের প্রবীণ কমলা চাষি প্রবীন প্রধান, সুরোজ প্রধান-রা বলেন,বহু বছর ধরে আমরা কমলা চাষ করে আসছি। একসময় এখান থেকে ট্রাকে ট্রাকে কমলা ডুয়ার্স এবং তরাই এর বিভিন্ন বাজারে যেত। সেই আয়েই সারা বছরের সংসার চলত। এখন বানরের উৎপাতের কারণে সব শেষ হয়ে যাচ্ছে। বাধ্য হয়ে অনেকে কমলা চাষ ছেড়ে অন্য কাজ করছে।<br />\r\nএকই সুর শোনা যাচ্ছে দীপক ছেত্রী ও নবীন তামাংয়ের কণ্ঠেও। তাঁদের কথায়, প্রতিদিন বানরের আক্রমণ এতটাই বেড়েছে যে চাষিদের মধ্যে আর আগ্রহ বা আশা অবশিষ্ট নেই। ফলে গাছের পরিচর্যা, সার প্রয়োগ বা রোগ প্রতিরোধমূলক ব্যবস্থাও প্রায় বন্ধ হয়ে গিয়েছে। তবুও স্বাভাবিকভাবে যে সামান্য ফলন হচ্ছে এবং যা কোনওভাবে বানরের হাত এড়িয়ে বাঁচানো যাচ্ছে, সেটুকু বিক্রি করেই কোনওমতে দিন চলছে।</p>\r\n\r\n<p>অন্যদিকে, গরুবাথানের নিমবস্তী বস্তী এলাকায় বানরের সমস্যা তেমন না থাকলেও প্রাকৃতিক দুর্যোগ চাষিদের বিপাকে ফেলেছে। নভেম্বরের শুরুতে হওয়া শিলাবৃষ্টিতে উল্লেখযোগ্য ক্ষতি হয়েছে কমলা বাগানের। এলাকার কমলা চাষি বিকেক সোনার, স্বপন ছাত্রীরা জানান, আমাদের ৮০-৯০ টি কমলা গাছের বাগান রয়েছে। গত বছর এইসব কৃষকেরা প্রায় দেড় লক্ষ টাকা আয় করেছিলেন। এইসব এলাকার কমলার স্বাদ ও গন্ধ আলাদা। এই এলাকার কৃষকেরা সম্পূর্ণ জৈব পদ্ধতিতে কমলা চাষ করে, কোনও কীটনাশক ব্যবহার করে না। সেই কারণেই এইসব এলাকায় কমলার সুনাম রয়েছে। তবে এ বছর শিলাবৃষ্টিতে কিছুটা ক্ষতি হয়েছে।&rdquo; গরুবাথানের রাইগাঁও বস্তীর নির্জল রাই ও শুভরাজ থাপার বাগানের অনেক গাছই ৩০ থেকে ৪০ বছরের পুরনো। গত কয়েক বছর ধরে ফলন কমতে থাকায় তাঁরা পরীক্ষামূলকভাবে নতুন চারা রোপণ শুরু করেছেন। ফলন ভালো হলে ভবিষ্যতে আরও গাছ লাগানোর পরিকল্পনা রয়েছে বলে জানান নির্জল। তবে পুরো জেলায় হতাশার মধ্যেও আশার আলো রয়েছে। প্যারেন, তোদে-তাংতা, চুইখিমের ওপরে মুঙপেল গ্রামে এ বছর কমলার ফলন ও মান তুলনামূলকভাবে ভালো হওয়ায় স্থানীয় কৃষক কমল গিরি ও সুরজ লিম্বুদের মতো চাষিরা কিছুটা হলেও আশাবাদী।</p>\r\n\r\n<p>কমলালেবু চাষের ভবিষ্যৎ প্রসঙ্গে কালিম্পং জেলা হর্টিকালচার আধিকারিক সঞ্জয় দত্ত জানান, কালিম্পং জেলার পাহাড়ি অঞ্চলে কমলা চাষের জন্য প্রয়োজনীয় দোআঁশ বা বেলে দোআঁশ মাটি, উপযুক্ত অম্লতা, পর্যাপ্ত সূর্যালোক, বৃষ্টিপাত এবং সমুদ্রপৃষ্ঠ থেকে ৯০০ থেকে ১৮০০ মিটার উচ্চতা-সবই বিদ্যমান। তিনি আরও বলেন, &ldquo;বর্ষার শুরু ও শেষে গাছের সঠিক পরিচর্যা অত্যন্ত জরুরি। ছত্রাকজনিত &lsquo;ডাই ব্যাক&rsquo; রোগ প্রতিরোধে সতর্কতা প্রয়োজন। এই বিষয়ে নিয়মিত প্রশিক্ষণ শিবিরের মাধ্যমে চাষিদের সচেতন করা হচ্ছে। পাশাপাশি রোগ প্রতিরোধী নতুন প্রজাতির কমলার চারা বিতরণ, বানরের হাত থেকে ফসল রক্ষার উপায় এবং বিপণন ব্যবস্থার উন্নয়ন নিয়েও দপ্তর কাজ করছে।&rdquo;</p>\r\n\r\n<p>জেলা হর্টিকালচার দপ্তর সূত্রে জানা গিয়েছে, কালিম্পং জেলায় প্রায় ১৭০০ হেক্টর জমিতে কমলালেবু চাষ হয়। গত বছর প্রতি হেক্টরে গড়ে ৮ থেকে ১০ টন ফলন হয়েছিল। তবে চলতি বছরে সেই লক্ষ্যমাত্রা আদৌ পূরণ হবে কি না, তা নিয়ে উদ্বেগে রয়েছেন আধিকারিক থেকে শুরু করে চাষিরাও। একসময় কালিম্পং জেলার অর্থনীতির অন্যতম ভিত্তি ছিল কমলালেবু চাষ। বানরের উপদ্রব, প্রতিকূল আবহাওয়া ও প্রশাসনিক নিষ্ক্রিয়তার অভিযোগে সেই ঐতিহ্য ধীরে ধীরে হারিয়ে যেতে বসেছে-এমনটাই আশঙ্কা স্থানীয়দের।</p>', 0, 1, '2026-02-09 06:52:22', '2026-02-09 07:04:17'),
(29, 'মালয়েশিয়ায় সুভাষ-স্মরণ মোদির, দেখা করলেন নেতাজির সহযোদ্ধার সঙ্গে', 'মালয়েশিয়ায়-সুভাষস্মরণ-মোদির-দেখা-করলেন-নেতাজির-সহযোদ্ধার-সঙ্গে', 'admin', NULL, '2026-02-09 07:27:34', 'মালয়েশিয়ায় প্রায় ২৯ লক্ষ ভারতীয় বংশোদ্ভূত থাকেন। যা সংখ্যার বিচারে গোটা দুনিয়ায় তৃতীয় বৃহত্তম। আসিয়ান গোষ্ঠীতেও ভারতের গুরুত্বপূর্ণ শরিক মালয়েশিয়া। ভারতের ‘অ্যাক্ট ইস্ট’ পলিসিরও অন্যতম স্তম্ভ আনোয়ার ইব্রাহিমের দেশ।', '<p>দু&rsquo;দিনের মালয়েশিয়া সফরে গিয়েছিলেন প্রধানমন্ত্রী নরেন্দ্র মোদি। রবিবার ছিল তাঁর সফরের শেষ দিন। এদিন মালয়েশিয়ায় নেতাজি সুভাষ চন্দ্র বসুকে স্মরণ করলেন মোদি। পাশাপাশি, দেখা করলেন আজাদ হিন্দ ফৌজে নেতাজির সহযোদ্ধা জয়রাজ রাজা রাওয়ের সঙ্গে। এই সাক্ষাৎকে &lsquo;অনুপ্রেরণাদায়ক&rsquo; বলেও অভিহিত করেছেন প্রধানমন্ত্রী।</p>\r\n\r\n<p>নেতাজির ইন্ডিয়ান ন্যাশনাল আর্মি (আইএনএ) বা আজাদ হিন্দ ফৌজের অন্যতম সদস্য ছিলেন জয়রাজ। রবিবার তাঁর সঙ্গে দেখা করে স্বাধীনতা সংগ্রামে তাঁর নানা অভিজ্ঞতার কথা শোনেন মোদি। জয়রাজের সঙ্গে সাক্ষাতের একটি ছবি শেয়ার করে মোদি তাঁর এক্স হ্যান্ডলে লেখেন, &lsquo;আইএনএ-র প্রবীণ সৈনিক শ্রী জয়রাজ রাজা রাও-এর সঙ্গে দেখা করতে পারা সৌভাগ্যের। তাঁর জীবন অসীম সাহস এবং ত্যাগের প্রতীক। তাঁর জীবনের অভিজ্ঞতা শুনে আমি অনুপ্রাণিত হলাম।&rsquo; একইসঙ্গে প্রধানমন্ত্রী এদিন আজাদ হিন্দ বাহিনী এবং নেতাজির প্রতিও শ্রদ্ধাজ্ঞাপন করেন। তিনি লেখেন, &lsquo;নেতাজি সুভাষচন্দ্র বসু এবং আজাদ হিন্দ বাহিনীর সকল যোদ্ধাদের কাছে আমরা চির ঋণী। তাঁদের বীরত্ব এবং আত্মত্যাগ ভারত ভাগ্য গঠনে গুরুত্বপূর্ণ ভূমিকা রেখেছে।&rsquo;</p>\r\n\r\n<p><img alt=\"\" src=\"https://pbs.twimg.com/media/HAnVSqTacAMwm4O?format=jpg&amp;name=4096x4096\" style=\"width: 3088px; height: 4096px;\" /></p>\r\n\r\n<p>প্রসঙ্গত, মালয়েশিয়ায় প্রায় ২৯ লক্ষ ভারতীয় বংশোদ্ভূত থাকেন। যা সংখ্যার বিচারে গোটা দুনিয়ায় তৃতীয় বৃহত্তম। আসিয়ান গোষ্ঠীতেও ভারতের গুরুত্বপূর্ণ শরিক মালয়েশিয়া। ভারতের &lsquo;অ্যাক্ট ইস্ট&rsquo; পলিসিরও অন্যতম স্তম্ভ আনোয়ার ইব্রাহিমের দেশ। জানা গিয়েছে, মোদি তাঁর সফরে বাণিজ্য, প্রতিরক্ষা এবং দ্বিপাক্ষিক সহযোগীতা আরও মজবুত করার বার্তা দিয়েছেন। একইসঙ্গে সরব হয়েছেন সন্ত্রাসবাদ নিয়েও।</p>', 1, 1, '2026-02-09 07:27:17', '2026-02-16 07:28:45'),
(30, 'গালওয়ান সংঘর্ষের এক সপ্তাহ পর গোপনে পরমাণু বোমা পরীক্ষা চিনের! বিস্ফোরক দাবি আমেরিকার', 'গালওয়ান-সংঘর্ষের-এক-সপ্তাহ-পর-গোপনে-পরমাণু-বোমা-পরীক্ষা-চিনের-বিস্ফোরক-দাবি-আমেরিকার', 'admin', NULL, '2026-02-09 07:51:48', '২০২০ সালের ১৫ জুন গালওয়ান উপত্যকায়মুখোমুখি হয় ভারত ও চিনের ফৌজ। দু’পক্ষের জওয়ানরাই লোহার রড ও কাঁটাতার জড়ানো হাতিয়ার নিয়ে বেশ কয়েক ঘণ্টা লড়াই করে। রক্তক্ষয়ী সেই সংঘর্ষে ২০ জন ভারতীয় জওয়ান শহিদ হন। ১৯৭৫ সালে পর এই প্রথম প্রকৃত নিয়ন্ত্রণরেখায় প্রাণহানির ঘটনা ঘটে।', '<p>গালওয়ান সংঘর্ষের এক সপ্তাহ পর গোপনে পরমাণু বোমা পরীক্ষা করেছিল চিন! এমনই বিস্ফোরক দাবি করলেন আমেরিকার&nbsp;বিদেশ&nbsp;দপ্তরের&nbsp;আন্ডার&nbsp;সেক্রেটারি&nbsp;থমাস&nbsp;ডিনান্নো। শুধু তা-ই নয়, এই পরীক্ষায় একটি&nbsp;বিশেষ&nbsp;প্রযুক্তিও&nbsp;ব্যবহার&nbsp;করেছিল বেজিং, যাতে বিস্ফোরণের সময় সৃষ্ট&nbsp;কম্পন&nbsp;বা&nbsp;সিসমিক&nbsp;সিগন্যাল&nbsp;অনেকটাই&nbsp;দুর্বল&nbsp;হয়ে&nbsp;যায় এবং এই পরীক্ষা গোপন থাকে। এমটাও দাবি করেছেন ওই মার্কিন আধিকারিক।</p>\r\n\r\n<p>শুক্রবার জেনেভায় রাষ্ট্রসংঘের একটি সম্মেলনে যোগ দিয়েছিলেন ডিনান্নো। সেখানেই তিনি এই বিস্ফোরক দাবি করেন। তিনি তাঁর এক্স হ্যান্ডলে লেখেন, &lsquo;২০২০ সালের ২২ জুন গালওয়ান সংঘর্ষের আট দিনের মাথায় চিন পরমাণু বোমা পরীক্ষা করে। গোটা পরীক্ষাটি যাতে গোপন থাকে, সেই জন্য তারা ডিকাপলিং প্রযুক্তি ব্যবহার করে।&rsquo;</p>\r\n\r\n<h3>২০২০ সালের ২২ জুন গালওয়ান সংঘর্ষের আট দিনের মাথায় চিন পরমাণু বোমা পরীক্ষা করে। গোটা পরীক্ষাটি যাতে গোপন থাকে, সেই জন্য তারা ডিকাপলিং প্রযুক্তি ব্যবহার করে।</h3>\r\n\r\n<p>কিন্তু কী এই ডিকাপলিং প্রযুক্তি? এটি হল এমন একটি কৌশল, যেখানে কোনও বোমাকে মাটির অনেক গভীরে রেখে বিস্ফোরণ ঘটানো হয়। ফলে বিস্ফোরণের তরঙ্গ অনেকটাই দুর্বল হয়ে পড়ে এবং গোটা বিষয়টি গোপন থাকে। দীর্ঘদিন ধরেই এই কৌশলকে কাজে লাগিয়ে গোপনে পারমাণবিক পরীক্ষা সম্পন্ন করা হচ্ছে।</p>\r\n\r\n<p>বিশেষজ্ঞদের মতে, চিন যদি সত্যিই এই ধরনের কোনও পারমাণবিক পরীক্ষা করে থাকে, তাহলে সেটির নেপথ্যে দীর্ঘদিনের পরিকল্পনা ছিল। গালওয়ান সংঘর্ষের পর গোটা বিশ্বজুড়ে আলোড়ন পড়ে গিয়েছিল। এই সীমান্ত সংঘর্ষ চিনের জন্য ঢাল হিসাবে কাজ করেছে। কারণ, সেই সময়ে গোটা বিশ্বের সংবাদমাধ্যমের নজর ছিল গালওয়ানের উপরেই।</p>\r\n\r\n<h3>২০২০ সালের ১৫ জুন গালওয়ান উপত্যকায়মুখোমুখি হয় ভারত ও চিনের ফৌজ। দু&rsquo;পক্ষের জওয়ানরাই লোহার রড ও কাঁটাতার জড়ানো হাতিয়ার নিয়ে বেশ কয়েক ঘণ্টা লড়াই করে। রক্তক্ষয়ী সেই সংঘর্ষে ২০ জন ভারতীয় জওয়ান শহিদ হন।</h3>\r\n\r\n<p>উল্লেখ্য, ২০২০ সালের ১৫ জুন গালওয়ান উপত্যকায়মুখোমুখি হয় ভারত ও চিনের ফৌজ। দু&rsquo;পক্ষের জওয়ানরাই লোহার রড ও কাঁটাতার জড়ানো হাতিয়ার নিয়ে বেশ কয়েক ঘণ্টা লড়াই করে। রক্তক্ষয়ী সেই সংঘর্ষে ২০ জন ভারতীয় জওয়ান শহিদ হন। ১৯৭৫ সালে পর এই প্রথম প্রকৃত নিয়ন্ত্রণরেখায় প্রাণহানির ঘটনা ঘটে। সংঘর্ষের পরেই সীমান্তে কার্যত যুদ্ধের পরিস্থিতি তৈরি হয়। অবশেষে পরিস্থিতি শান্ত করতে কয়েক দফা আলোচনায় বসে দুই দেশের সেনাবাহিনী।</p>', 1, 1, '2026-02-09 07:50:01', '2026-02-16 07:27:36'),
(31, 'রাশিয়ায় ছুরির কোপ ৪ ভারতীয় পড়ুয়াকে! হামলাকারীর মুখে নাৎসি স্লোগান, দেওয়ালে রক্তের স্বস্তিকা', 'রাশিয়ায়-ছুরির-কোপ-৪-ভারতীয়-পড়ুয়াকে-হামলাকারীর-মুখে-নাৎসি-স্লোগান-দেওয়ালে-রক্তের-স্বস্তিকা', 'admin', NULL, '2026-02-09 07:53:18', 'দু\'জন পুলিশ কর্মীকে ছুরির কোপ মেরে নিজেকেও আঘাত করেছিল আততায়ী।', '<p>রুশ মেডিক্যাল কলেজে আক্রান্ত ৪ ভারতীয় পড়ুয়া। হামলাকারীকে আটকাতে গিয়ে আহত দুই পুলিশকর্মীও। ছুরিকাহত পড়ুয়াদের মধ্যে একজনের শারীরিক অবস্থা গুরুতর বলে জানা গিয়েছে। হামলাকারী এক বছর পনেরোর কিশোর বলে দাবি পুলিশের। সে নব্য নাৎসি গোষ্ঠী &lsquo;ন্যাশনাল সোশালিজম/ হোয়াইট পাওয়ার&rsquo;-এর সদস্য। এই গোষ্ঠীকে ২০২১ সালেই রুশ সুপ্রিম কোর্ট জঙ্গি গোষ্ঠীর তকমা দেয়।</p>\r\n\r\n<p>রাশিয়ার স্টেট মেডিক্যাল ইউনিভার্সিটির হস্টেলে হামলা চালিয়েছিল হামলাকারী। ওই হস্টেলে কেবল বিদেশি পড়ুয়ারাই পড়ে। হস্টেলের ভিতরে পুলিশ হলে আচমকা ঢুকে পড়ে ওই কিশোর। তার মুখে ছিল নাৎসি স্লোগান। এমনকী একটি দেওয়ালে এক আক্রান্তের রক্ত দিয়ে সে স্বস্তিকা চিহ্নও (যা নাৎসিরা ব্যবহার করত) এঁকেছে বলে জানা গিয়েছে। সব মিলিয়ে ঘটনাস্থলে রক্তধারার যে দৃশ্য দেখা গিয়েছে, তা ভয়ংকর বলেই দাবি প্রত্যক্ষদর্শীদের।</p>\r\n\r\n<p>শিয়ার স্বরাষ্ট্র মন্ত্রক জানিয়েছে, অভিযুক্ত কিশোর হস্টেলে ঢুকে পড়ে বেশ কয়েকজন শিক্ষার্থীকে ছুরি দিয়ে আঘাত করতে থাকে। এও জানা গিয়েছে, গ্রেপ্তারের সময় প্রতিরোধ করেছিল হামলাকারী। দু&rsquo;জন পুলিশ কর্মীকেও সে ছুরিকাঘাত করে। এমনকী আততায়ী নিজের শরীরেও আঘাত হানে! সোশাল মিডিয়ায় একটি ভিডিও ছড়িয়ে পড়েছে। সেই ভিডিওয় দেখা গিয়েছে, বরফে ঢাকা চারপাশ। পুলিশের হাতে বন্দি অভিযুক্ত। তাকে চ্যাংদোলা করে নিয়ে যাওয়া হচ্ছে।</p>\r\n\r\n<p>আহত ভারতীয় পড়ুয়াদের মধ্যে একজনের অবস্থা গুরুতর। বাকি তিনজনের অবস্থা স্থিতিশীল বলে জানানো হয়েছে। হামলাকারীকেও হাসপাতালে ভর্তি করা হয়েছে। স্থানীয় এক শিশু হাসপাতালে সে চিকিৎসাধীন। তার শারীরিক অবস্থাও গুরুতর।</p>', 0, 1, '2026-02-09 07:52:57', '2026-02-09 07:53:18'),
(32, 'ভারতে ঢুকতে প্রবল ভোগান্তি! বহু কাঠখড় পোড়ানো সেই ‘পাকিস্তানি’ জুটিতেই ধরাশায়ী অভিষেকরা', 'ভারতে-ঢুকতে-প্রবল-ভোগান্তি-বহু-কাঠখড়-পোড়ানো-সেই-পাকিস্তানি-জুটিতেই-ধরাশায়ী-অভিষেকরা', 'admin', NULL, '2026-02-09 07:58:06', 'এবার জন্মভূমি পাকিস্তানকেও গুঁড়িয়ে দেওয়ার হুঁশিয়ারি দিচ্ছে এই জুটি!', '<p>গতবার টি-২০ বিশ্বকাপে হইচই ফেলে দিয়েছিল মার্কিন যুক্তরাষ্ট্র। ঘরের মাঠে বিশ্বকাপ খেলতে নেমে তারা হারিয়েছিল শক্তিশালী পাকিস্তানকে। জায়গা করে নিয়েছিল বিশ্বকাপের সুপার এইটেও।</p>\r\n\r\n<p>২১২</p>\r\n\r\n<p><img alt=\"\" data-lazy-src=\"https://www.sangbadpratidin.in/wp-content/uploads/2026/02/3-31.jpg\" data-ll-status=\"loaded\" decoding=\"async\" height=\"800\" src=\"https://www.sangbadpratidin.in/wp-content/uploads/2026/02/3-31.jpg\" width=\"1200\" /></p>\r\n\r\n<p>সেই আমেরিকা এবার ভারতের মাটিতে টি-২০ বিশ্বকাপ খেলছে। প্রথম ম্যাচেই মোনাঙ্ক প্যাটেলরা খেলেছেন গতবারের চ্যাম্পিয়ন ভারতের বিরুদ্ধে। সেই ম্যাচে হারলেও মার্কিন যুক্তরাষ্ট্রের পারফরম্যান্স মুগ্ধ করেছে ক্রিকেটদুনিয়াক</p>\r\n\r\n<p><img alt=\"\" data-lazy-src=\"https://www.sangbadpratidin.in/wp-content/uploads/2026/02/1-31.jpg\" data-ll-status=\"loaded\" decoding=\"async\" height=\"800\" src=\"https://www.sangbadpratidin.in/wp-content/uploads/2026/02/1-31.jpg\" width=\"1200\" /></p>\r\n\r\n<p>ভারত বনাম আমেরিকা ম্যাচের একটা সময়ে মনে হচ্ছিল, হয়তো অঘটন ঘটে যাবে। হয়তো ম্যাচ হেরে যাবেন সূর্যকুমার যাদবরা। আর সেই আশঙ্কার নেপথ্যে রয়েছেন এমন দু&#39;জন, যাঁরা একটা সময়ে ভারতে প্রবেশের অনুমতিই পাচ্ছিলেন না।</p>\r\n\r\n<p><img alt=\"\" data-lazy-src=\"https://www.sangbadpratidin.in/wp-content/uploads/2026/02/ali-khan.jpg\" data-ll-status=\"loaded\" decoding=\"async\" height=\"800\" src=\"https://www.sangbadpratidin.in/wp-content/uploads/2026/02/ali-khan.jpg\" width=\"1200\" /></p>\r\n\r\n<p>একজনের নাম আলি খান। পাক বংশোদ্ভূত আমেরিকান পেসার। বিশ্বকাপ শুরুর আগে যখন গোটা মার্কিন স্কোয়াড ভারতের ভিসা পেয়ে গিয়েছে, তখনও আলির কপালে ভারতে প্রবেশের অনুমতি মেলেনি।</p>\r\n\r\n<p><img alt=\"\" data-lazy-src=\"https://www.sangbadpratidin.in/wp-content/uploads/2026/02/mohsin.jpg\" data-ll-status=\"loaded\" decoding=\"async\" height=\"800\" src=\"https://www.sangbadpratidin.in/wp-content/uploads/2026/02/mohsin.jpg\" width=\"1200\" /></p>\r\n\r\n<p>।শনিবারের ম্যাচে ভারতীয়দের মনে ভয় ধরানো আরেক ব্যক্তি মহম্মদ মহসিন। তিনি পাকিস্তানের জার্সিতে ২০২১ পর্যন্ত যুব ক্রিকেট খেলেছেন। হারিয়েছেন ভারতকেও। বর্তমানে আন্তর্জাতিক ক্রিকেট খেলেন আমেরিকার জার্সিতে।<img alt=\"\" data-lazy-src=\"https://www.sangbadpratidin.in/wp-content/uploads/2026/02/ali-4.jpg\" data-ll-status=\"loaded\" decoding=\"async\" height=\"800\" src=\"https://www.sangbadpratidin.in/wp-content/uploads/2026/02/ali-4.jpg\" width=\"1200\" /></p>\r\n\r\n<p>বিশ্বকাপ শুরুর আগে আলি নিজের ইনস্টাগ্রামে জানান, ভারতীয় ভিসার আবেদন করা সত্ত্বেও তিনি ভিসা পাননি। সেটার নেপথ্যে রয়েছে তাঁর পাক বংশোদ্ভূত পরিচয়। দাবি করেন, তাঁর দলের আরও তিন পাক বংশোদ্ভূত ক্রিকেটারেরও একই সমস্যা হয়েছে।</p>\r\n\r\n<p><img alt=\"\" data-lazy-src=\"https://www.sangbadpratidin.in/wp-content/uploads/2026/02/mohsin-3.jpg\" data-ll-status=\"loaded\" decoding=\"async\" height=\"800\" src=\"https://www.sangbadpratidin.in/wp-content/uploads/2026/02/mohsin-3.jpg\" width=\"1200\" /></p>\r\n\r\n<p>মহম্মদ মহসিনের ভিসাতেও একই সমস্যা হয়েছিল। পরে অবশ্য আইসিসি চেয়ারম্যান জয় শাহ নিজে ভিসা সমস্যা মেটাতে উদ্যোগী হন। দূতাবাসগুলিকে অনুরোধ করা হয়, পাক বংশোদ্ভূত হলেও ক্রিকেটারদের ভিসা যেন দ্রুত মঞ্জুর হয়।</p>\r\n\r\n<p><a href=\"https://www.sangbadpratidin.in/photo/t20-world-cup-pakistan-origin-cricketers-of-usa-made-trouble-for-india/\"><img alt=\"\" data-lazy-src=\"https://www.sangbadpratidin.in/wp-content/uploads/2026/02/2-33.jpg\" data-ll-status=\"loaded\" decoding=\"async\" height=\"800\" src=\"https://www.sangbadpratidin.in/wp-content/uploads/2026/02/2-33.jpg\" width=\"1200\" /></a></p>\r\n\r\n<p>যাবতীয় সমস্যা মিটিয়ে অবশেষে আলি-মহসিন দু&#39;জনেই ভারতের ভিসা পেয়েছেন। খেলতে নেমেছেন ভারতের বিরুদ্ধে। আর মাঠে নেমেই কাঁপুনি ধরিয়ে দিয়েছেন ভারতের টপ অর্ডারে।</p>\r\n\r\n<p><a href=\"https://www.sangbadpratidin.in/photo/t20-world-cup-pakistan-origin-cricketers-of-usa-made-trouble-for-india/\"><img alt=\"\" data-lazy-src=\"https://www.sangbadpratidin.in/wp-content/uploads/2026/02/ali-2.jpg\" data-ll-status=\"loaded\" decoding=\"async\" height=\"800\" src=\"https://www.sangbadpratidin.in/wp-content/uploads/2026/02/ali-2.jpg\" width=\"1200\" /></a></p>\r\n\r\n<p>শনিবার মাত্র দুই ওভার বল করেছেন আলি, তারপর চোটের জন্য মাঠ ছেড়ে বেরিয়ে যান। কিন্তু তার আগে তুলে নেন দুরন্ত ফর্মে থাকা অভিষেক শর্মার উইকেট। দুই ওভারে তিনি দিয়েছেন মাত্র ১৩ রান।</p>\r\n\r\n<p><a href=\"https://www.sangbadpratidin.in/photo/t20-world-cup-pakistan-origin-cricketers-of-usa-made-trouble-for-india/\"><img alt=\"\" data-lazy-src=\"https://www.sangbadpratidin.in/wp-content/uploads/2026/02/mohsin-4.jpg\" data-ll-status=\"loaded\" decoding=\"async\" height=\"800\" src=\"https://www.sangbadpratidin.in/wp-content/uploads/2026/02/mohsin-4.jpg\" width=\"1200\" /></a></p>\r\n\r\n<p>মহসিনের পরিসংখ্যান, চার ওভারে ১৬ রান দিয়ে রিঙ্কু সিংয়ের উইকেট। সেসময়ে মাত্র ৭২ রানের মধ্যে ৫ উইকেট হারিয়ে ধুঁকছে ভারতীয় ব্যাটিং। শেষ পর্যন্ত অবশ্য সূর্যর তেজে ম্যাচ জিতেছে মেন ইন ব্লু।</p>\r\n\r\n<p><a href=\"https://www.sangbadpratidin.in/photo/t20-world-cup-pakistan-origin-cricketers-of-usa-made-trouble-for-india/\"><img alt=\"\" data-lazy-src=\"https://www.sangbadpratidin.in/wp-content/uploads/2026/02/mohsin-2.jpg\" data-ll-status=\"loaded\" decoding=\"async\" height=\"800\" src=\"https://www.sangbadpratidin.in/wp-content/uploads/2026/02/mohsin-2.jpg\" width=\"1200\" /></a></p>\r\n\r\n<p>পরের ম্যাচেই পাকিস্তানের মুখোমুখি হবে আমেরিকা। &#39;জন্মভূমি&#39;র বিরুদ্ধে খেলতে মুখিয়ে রয়েছেন আলি-মহসিন দু&#39;জনেই। শুধু তাই নয়, মহসিনের হুঙ্কার, &quot;এবার পাকিস্তানকে গতবারের চেয়েও অনেক বড় ব্যবধানে হারাব।&quot;</p>\r\n\r\n<p><a href=\"https://www.sangbadpratidin.in/photo/t20-world-cup-pakistan-origin-cricketers-of-usa-made-trouble-for-india/\"><img alt=\"\" data-lazy-src=\"https://www.sangbadpratidin.in/wp-content/uploads/2026/02/ali-3.jpg\" data-ll-status=\"loaded\" decoding=\"async\" height=\"800\" src=\"https://www.sangbadpratidin.in/wp-content/uploads/2026/02/ali-3.jpg\" width=\"1200\" /></a></p>\r\n\r\n<p>প্রথমবার পাকিস্তানের বিরুদ্ধে খেলতে নামবেন আলি। জন্মভূমি স্বর্গাদপি গরিয়সী হলেও, পাকিস্তানকে হারিয়ে সুপার এইটে আমেরিকার জায়গা পাকা করাটাই আপাতত পেসারের লক্ষ্য।</p>', 2, 1, '2026-02-09 07:57:59', '2026-02-15 19:18:49'),
(33, 'তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে', 'youngboywecanthelpbutwonderwhyyoucameheretoday', 'admin', NULL, '2026-02-17 11:05:26', 'তরুণ কিশোর! তোমার জীবনে সবে এ ভোরের বেলা, ভোরের বাতাস ভোরের কুসুমে জুড়েছে রঙের খেলা। হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল। কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা! তরুণ কিশোর! তোমার জীবনে সবে এ ভোরের বেলা, ভোরের বাতাস ভোরের কুসুমে জুড়েছে রঙের খেলা।', '<p>তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? তরুণ কিশোর! তোমার জীবনে সবে এ ভোরের বেলা, ভোরের বাতাস ভোরের কুসুমে জুড়েছে রঙের খেলা। হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল। কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা! তরুণ কিশোর! তোমার জীবনে সবে এ ভোরের বেলা, ভোরের বাতাস ভোরের কুসুমে জুড়েছে রঙের খেলা।</p>\r\n\r\n<p>তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়! কে এলে তবে ভাই, সোনার গোকুল আঁধার করিয়া এই মথুরার ঠাই। তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি। শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন। হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার?</p>\r\n\r\n<p>আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। হায়রে করুণ হায়, এখনি যে সবে জাগিয়া উঠিবে প্রভাতের কিনারায়। ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি।</p>\r\n\r\n<p>শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন। বঁধুর কোলেতে বধুয়া ঘুমায়, খোলেনি বাহুর বাঁধ, দীঘির জলেতে নাহিয়া নাহিয়া মেটেনি তারার সাধ। ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি। এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি। আজো কানে গোঁজ শিরীষ কুসুম কিংশুক-মঞ্জরী, অলকে বাঁধিয়া পাটল ফুলেতে ভরে লও উত্তরী!</p>\r\n\r\n<p>শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন। ডাকে কেয়াবনে ফুল-মঞ্জরি ঘন-দেয়া সম্পাতে, মাটির বুকেতে তমাল তাহার ফুল-বাহুখানি পাতে। হায়রে করুণ হায়, এখনি যে সবে জাগিয়া উঠিবে প্রভাতের কিনারায়। ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি। হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার?</p>', 2, 1, '2026-02-17 10:41:38', '2026-02-18 10:09:39'),
(34, 'এখন হইবে লোক জানাজানি, মুখ চেনাচেনি আর, হিসাব নিকাশ হইবে এখন কতটুকু আছে কার', 'nowpeoplewillbeknownfaceswillbeunknownandanaccountingwillbemadeofhowmucheachpersonhas', 'admin', NULL, '2026-02-17 16:58:35', 'সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়! মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে। মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে। আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে', '<p>এখন হইবে লোক জানাজানি, মুখ চেনাচেনি আর, হিসাব নিকাশ হইবে এখন কতটুকু আছে কার। সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়! মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে। মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে। আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে</p>\r\n\r\n<p>শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন। বঁধুর কোলেতে বধুয়া ঘুমায়, খোলেনি বাহুর বাঁধ, দীঘির জলেতে নাহিয়া নাহিয়া মেটেনি তারার সাধ। হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল। বঁধুর কোলেতে বধুয়া ঘুমায়, খোলেনি বাহুর বাঁধ, দীঘির জলেতে নাহিয়া নাহিয়া মেটেনি তারার সাধ। আজো কানে গোঁজ শিরীষ কুসুম কিংশুক-মঞ্জরী, অলকে বাঁধিয়া পাটল ফুলেতে ভরে লও উত্তরী!</p>\r\n\r\n<p>হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন। তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়। এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে। হায়রে কিশোর হায়! ফুলের পরাণ বিকাতে এসেছ এই পাপ-মথুরায়।</p>\r\n\r\n<p>বিহগ ছাড়িয়া ভোরের ভজন আহারের সন্ধ্যানে, বাতাসে বাঁধিয়া পাখা-সেতু-বাঁধ ছুটিবে সুদুর-পানে। ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার? তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে।</p>\r\n\r\n<p>বঁধুর কোলেতে বধুয়া ঘুমায়, খোলেনি বাহুর বাঁধ, দীঘির জলেতে নাহিয়া নাহিয়া মেটেনি তারার সাধ। সখালী পাতাও সখাদের সাথে, বিনামূলে দাও প্রাণ, এপারে মোদের মথুরার মত নাই দান-প্রতিদান। ডাকে কেয়াবনে ফুল-মঞ্জরি ঘন-দেয়া সম্পাতে, মাটির বুকেতে তমাল তাহার ফুল-বাহুখানি পাতে। এখনো বসিয়া সেঁউতীর মালা গাঁথিছে ভোরের তারা, ঊষার রঙিন শাড়ীখানি তার বুনান হয়নি সারা। মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে।</p>', 1, 1, '2026-02-17 11:06:43', '2026-02-17 16:59:18'),
(35, 'আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে', 'eventodayyoucansellyourselfforthepriceofagarlandofflowers', 'admin', NULL, '2026-02-17 19:20:41', 'রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার? কে এলে তবে ভাই, সোনার গোকুল আঁধার করিয়া এই মথুরার ঠাই। সেথায় তোমার কিশোরী বধূটি মাটির প্রদীপ ধরি, তুলসীর মূলে প্রণাম যে আঁকে হয়ত তোমারে স্মরি। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল।', '<p>আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার? কে এলে তবে ভাই, সোনার গোকুল আঁধার করিয়া এই মথুরার ঠাই। সেথায় তোমার কিশোরী বধূটি মাটির প্রদীপ ধরি, তুলসীর মূলে প্রণাম যে আঁকে হয়ত তোমারে স্মরি। এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল।</p>\r\n\r\n<p>রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে। মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে। কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা! হেথা যৌবন যত কিছু এর খাতায় লিখিয়া লয়, পান হতে চুন খসেনাক-এমনি হিসাবময়। আজো কানে গোঁজ শিরীষ কুসুম কিংশুক-মঞ্জরী, অলকে বাঁধিয়া পাটল ফুলেতে ভরে লও উত্তরী!</p>\r\n\r\n<p>তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি। তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়! এখনো গোপন আঁধারের তলে আলোকের শতদল, মেঘে মেঘে লেগে বরণে বরণে করিতেছে টলমল। তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে।</p>\r\n\r\n<p>তরুণ কিশোর! তোমার জীবনে সবে এ ভোরের বেলা, ভোরের বাতাস ভোরের কুসুমে জুড়েছে রঙের খেলা। এখনো বসিয়া সেঁউতীর মালা গাঁথিছে ভোরের তারা, ঊষার রঙিন শাড়ীখানি তার বুনান হয়নি সারা। ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে। হায়রে করুণ হায়, এখনি যে সবে জাগিয়া উঠিবে প্রভাতের কিনারায়।</p>\r\n\r\n<p>হায়রে করুণ হায়, এখনি যে সবে জাগিয়া উঠিবে প্রভাতের কিনারায়। আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার। এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি। রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে। হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি।</p>', 0, 1, '2026-02-17 19:20:33', '2026-02-17 19:25:29'),
(36, 'হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার', 'maybethatgirldoesntevenknowthatshedoesntknowthevalueoftheyolk', 'admin', NULL, '2026-02-17 19:27:53', 'এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার? তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি। সখালী পাতাও সখাদের সাথে, বিনামূলে দাও প্রাণ, এপারে মোদের মথুরার মত নাই দান-প্রতিদান। আজো কানে গোঁজ শিরীষ কুসুম কিংশুক-মঞ্জরী, অলকে বাঁধিয়া পাটল ফুলেতে ভরে লও উত্তরী! তুমি যে কিশোর তোমার দেশেতে হিসাব নিকাশ নাই, যে আসে নিকটে তাহারেই লও আপন বলিয়া তাই।', '<p>হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার? তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি। সখালী পাতাও সখাদের সাথে, বিনামূলে দাও প্রাণ, এপারে মোদের মথুরার মত নাই দান-প্রতিদান। আজো কানে গোঁজ শিরীষ কুসুম কিংশুক-মঞ্জরী, অলকে বাঁধিয়া পাটল ফুলেতে ভরে লও উত্তরী! তুমি যে কিশোর তোমার দেশেতে হিসাব নিকাশ নাই, যে আসে নিকটে তাহারেই লও আপন বলিয়া তাই।</p>\r\n\r\n<p>তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়। ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি। বঁধুর কোলেতে বধুয়া ঘুমায়, খোলেনি বাহুর বাঁধ, দীঘির জলেতে নাহিয়া নাহিয়া মেটেনি তারার সাধ। তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি। কালিন্দী লতা গলায় জড়ায়ে সোনার গোকুল কাঁদে ব্রজের দুলাল বাঁধা নাহি পড়ে যেন মথুরার ফাঁদে।</p>\r\n\r\n<p>হায়রে করুণ হায়, এখনি যে সবে জাগিয়া উঠিবে প্রভাতের কিনারায়। আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার। এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি। আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে?</p>\r\n\r\n<p>তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি। হায়রে কিশোর হায়! ফুলের পরাণ বিকাতে এসেছ এই পাপ-মথুরায়। ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়! হায়রে করুণ হায়, এখনি যে সবে জাগিয়া উঠিবে প্রভাতের কিনারায়।</p>\r\n\r\n<p>হায়রে কিশোর হায়! ফুলের পরাণ বিকাতে এসেছ এই পাপ-মথুরায়। আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? তরুণ কিশোর! তোমার জীবনে সবে এ ভোরের বেলা, ভোরের বাতাস ভোরের কুসুমে জুড়েছে রঙের খেলা।</p>', 0, 1, '2026-02-17 19:27:45', '2026-02-17 20:39:09'),
(37, 'তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়', 'thedustofyourbrajiscoveredwithlove', 'admin', NULL, '2026-02-17 20:00:31', 'তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়। ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি। বঁধুর কোলেতে বধুয়া ঘুমায়, খোলেনি বাহুর বাঁধ, দীঘির জলেতে নাহিয়া নাহিয়া মেটেনি তারার সাধ। তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি। কালিন্দী লতা গলায় জড়ায়ে সোনার গোকুল কাঁদে ব্রজের দুলাল বাঁধা নাহি পড়ে যেন মথুরার ফাঁদে।', '<p>হায়রে করুণ হায়, এখনি যে সবে জাগিয়া উঠিবে প্রভাতের কিনারায়। আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার। এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি। আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে?</p>\r\n\r\n<p>তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি। হায়রে কিশোর হায়! ফুলের পরাণ বিকাতে এসেছ এই পাপ-মথুরায়। ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়! হায়রে করুণ হায়, এখনি যে সবে জাগিয়া উঠিবে প্রভাতের কিনারায়।</p>\r\n\r\n<p>হায়রে কিশোর হায়! ফুলের পরাণ বিকাতে এসেছ এই পাপ-মথুরায়। আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? তরুণ কিশোর! তোমার জীবনে সবে এ ভোরের বেলা, ভোরের বাতাস ভোরের কুসুমে জুড়েছে রঙের খেলা।</p>', 1, 1, '2026-02-17 20:00:15', '2026-02-17 20:01:05'),
(38, 'আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে', 'even-today-the-king-of-flutes-is-still-trapped-in-the-trap-of-the-vinedraper', 'admin', NULL, NULL, 'চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়। শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন। এখনো বসিয়া সেঁউতীর মালা গাঁথিছে ভোরের তারা, ঊষার রঙিন শাড়ীখানি তার বুনান হয়নি সারা। বিহগ ছাড়িয়া ভোরের ভজন আহারের সন্ধ্যানে, বাতাসে বাঁধিয়া পাখা-সেতু-বাঁধ ছুটিবে সুদুর-পানে।', '<p>আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে তোমাদের সেই ব্রজের ধূলায় প্রেমের বেলাতি হয়, সেথা কেউ তার মূল্য জানে না, এই বড় বিস্ময়। শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন। এখনো বসিয়া সেঁউতীর মালা গাঁথিছে ভোরের তারা, ঊষার রঙিন শাড়ীখানি তার বুনান হয়নি সারা। বিহগ ছাড়িয়া ভোরের ভজন আহারের সন্ধ্যানে, বাতাসে বাঁধিয়া পাখা-সেতু-বাঁধ ছুটিবে সুদুর-পানে।</p>\r\n\r\n<p>হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল। হায়রে কিশোর হায়! ফুলের পরাণ বিকাতে এসেছ এই পাপ-মথুরায়। তরুণ কিশোর! তোমার জীবনে সবে এ ভোরের বেলা, ভোরের বাতাস ভোরের কুসুমে জুড়েছে রঙের খেলা। তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়! বিহগ ছাড়িয়া ভোরের ভজন আহারের সন্ধ্যানে, বাতাসে বাঁধিয়া পাখা-সেতু-বাঁধ ছুটিবে সুদুর-পানে।</p>\r\n\r\n<p>তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি। এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে। ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার? মাধবীলতার দোলনা বাঁধিয়া কদম্ব-শাখে শাখে, কিশোর! তোমার কিশোর সখারা তোমারে যে ওই ডাকে।</p>\r\n\r\n<p>হায়রে কিশোর হায়! ফুলের পরাণ বিকাতে এসেছ এই পাপ-মথুরায়। এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি। কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা! আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। হেথা যৌবন মেলিয়া ধরিয়া জমা-খরচের খাতা, লাভ লেকাসান নিতেছে বুঝিয়া খুলিয়া পাতায় পাতা।</p>\r\n\r\n<p>সখালী পাতাও সখাদের সাথে, বিনামূলে দাও প্রাণ, এপারে মোদের মথুরার মত নাই দান-প্রতিদান। তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি। কে এলে তবে ভাই, সোনার গোকুল আঁধার করিয়া এই মথুরার ঠাই। তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি। কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা!</p>', 0, 0, '2026-02-18 09:36:06', '2026-02-18 09:36:06');
INSERT INTO `news_posts` (`id`, `headline`, `slug`, `author`, `sub_author_id`, `post_date_time`, `short_description`, `description`, `views`, `status`, `created_at`, `updated_at`) VALUES
(39, 'রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে', 'under-the-mist-of-colors-your-life-shines-like-a-childs-sun-in-the-dawn-sky', 'admin', NULL, NULL, 'রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে। তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি। মাধবীলতার দোলনা বাঁধিয়া কদম্ব-শাখে শাখে, কিশোর! তোমার কিশোর সখারা তোমারে যে ওই ডাকে। সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়! মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে।', '<p>রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে। তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি। মাধবীলতার দোলনা বাঁধিয়া কদম্ব-শাখে শাখে, কিশোর! তোমার কিশোর সখারা তোমারে যে ওই ডাকে। সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়! মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে।</p>\r\n\r\n<p>হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে। আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে।</p>\r\n\r\n<p>হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। বিহগ ছাড়িয়া ভোরের ভজন আহারের সন্ধ্যানে, বাতাসে বাঁধিয়া পাখা-সেতু-বাঁধ ছুটিবে সুদুর-পানে। কে এলে তবে ভাই, সোনার গোকুল আঁধার করিয়া এই মথুরার ঠাই। তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে।</p>\r\n\r\n<p>মাধবীলতার দোলনা বাঁধিয়া কদম্ব-শাখে শাখে, কিশোর! তোমার কিশোর সখারা তোমারে যে ওই ডাকে। তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি। ডাকে কেয়াবনে ফুল-মঞ্জরি ঘন-দেয়া সম্পাতে, মাটির বুকেতে তমাল তাহার ফুল-বাহুখানি পাতে। আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে। রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে।</p>\r\n\r\n<p>এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে। ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? মাধবীলতার দোলনা বাঁধিয়া কদম্ব-শাখে শাখে, কিশোর! তোমার কিশোর সখারা তোমারে যে ওই ডাকে। এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে। আজিও নিজেরে বিকাইতে পার ফুলের মালার দামে, রূপকথা শুনি তোমাদের দেশে রূপকথা-দেয়া নামে।</p>', 0, 0, '2026-02-18 09:40:56', '2026-02-18 09:40:56'),
(40, 'এখন হইবে লোক জানাজানি, মুখ চেনাচেনি আর, হিসাব নিকাশ হইবে এখন কতটুকু আছে কার', 'now-people-will-be-known-faces-will-be-unknown-and-an-accounting-will-be-made-of-how-much-each-person-has', 'admin', NULL, NULL, 'এখন হইবে লোক জানাজানি, মুখ চেনাচেনি আর, হিসাব নিকাশ হইবে এখন কতটুকু আছে কার। তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি। আজো কানে গোঁজ শিরীষ কুসুম কিংশুক-মঞ্জরী, অলকে বাঁধিয়া পাটল ফুলেতে ভরে লও উত্তরী! মাধবীলতার দোলনা বাঁধিয়া কদম্ব-শাখে শাখে, কিশোর! তোমার কিশোর সখারা তোমারে যে ওই ডাকে। হেথা যৌবন মেলিয়া ধরিয়া জমা-খরচের খাতা, লাভ লেকাসান নিতেছে বুঝিয়া খুলিয়া পাতায় পাতা।', '<p>এখন হইবে লোক জানাজানি, মুখ চেনাচেনি আর, হিসাব নিকাশ হইবে এখন কতটুকু আছে কার। তুমি ভাই সেই ব্রজের রাখাল, পাতার মুকুট পরি, তোমাদের রাজা আজো নাকি খেলে গেঁয়ো মাঠখানি ভরি। আজো কানে গোঁজ শিরীষ কুসুম কিংশুক-মঞ্জরী, অলকে বাঁধিয়া পাটল ফুলেতে ভরে লও উত্তরী! মাধবীলতার দোলনা বাঁধিয়া কদম্ব-শাখে শাখে, কিশোর! তোমার কিশোর সখারা তোমারে যে ওই ডাকে। হেথা যৌবন মেলিয়া ধরিয়া জমা-খরচের খাতা, লাভ লেকাসান নিতেছে বুঝিয়া খুলিয়া পাতায় পাতা।</p>\r\n\r\n<p>এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি। তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়! ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি? হায়রে করুণ হায়, এখনি যে সবে জাগিয়া উঠিবে প্রভাতের কিনারায়। সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়!</p>\r\n\r\n<p>তুমি যে কিশোর তোমার দেশেতে হিসাব নিকাশ নাই, যে আসে নিকটে তাহারেই লও আপন বলিয়া তাই। শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন। এখন হইবে লোক জানাজানি, মুখ চেনাচেনি আর, হিসাব নিকাশ হইবে এখন কতটুকু আছে কার। কালিন্দী লতা গলায় জড়ায়ে সোনার গোকুল কাঁদে ব্রজের দুলাল বাঁধা নাহি পড়ে যেন মথুরার ফাঁদে। হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল।</p>\r\n\r\n<p>তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। তুমি যে কিশোর তোমার দেশেতে হিসাব নিকাশ নাই, যে আসে নিকটে তাহারেই লও আপন বলিয়া তাই। তোমার গোকুল আজো শেখে নাই ভালবাসা বলে কারে, ভালবেসে তাই বুকে বেঁধে লয় আদরিয়া যারে তারে। বঁধুর কোলেতে বধুয়া ঘুমায়, খোলেনি বাহুর বাঁধ, দীঘির জলেতে নাহিয়া নাহিয়া মেটেনি তারার সাধ। আজো নাকি সেই বাঁশীর রাজাটি তমাল-লতার ফাঁদে, চরণ জড়ায়ে নূপুর হারায়ে পথের ধূলায় কাঁদে</p>\r\n\r\n<p>শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন। তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি। এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি। হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল। হেথা যৌবন যত কিছু এর খাতায় লিখিয়া লয়, পান হতে চুন খসেনাক-এমনি হিসাবময়।</p>', 0, 0, '2026-02-18 09:42:15', '2026-02-18 09:42:15'),
(41, 'আজিও চেননি সোনার আদর, চেননি মুক্তাহার', 'even-today-i-have-not-known-the-love-of-gold-nor-the-love-of-pearls', 'admin', 3, NULL, 'কালিন্দী লতা গলায় জড়ায়ে সোনার গোকুল কাঁদে ব্রজের দুলাল বাঁধা নাহি পড়ে যেন মথুরার ফাঁদে। আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার। তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি। শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন। ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি।', '<p>কালিন্দী লতা গলায় জড়ায়ে সোনার গোকুল কাঁদে ব্রজের দুলাল বাঁধা নাহি পড়ে যেন মথুরার ফাঁদে। আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার। তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি। শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন। ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি।</p>\r\n\r\n<p>মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে। হায়রে কিশোর হায়! ফুলের পরাণ বিকাতে এসেছ এই পাপ-মথুরায়। রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে। এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি। বিহগ ছাড়িয়া ভোরের ভজন আহারের সন্ধ্যানে, বাতাসে বাঁধিয়া পাখা-সেতু-বাঁধ ছুটিবে সুদুর-পানে।</p>\r\n\r\n<p>হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল। তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়! সেথায় তোমার কিশোরী বধূটি মাটির প্রদীপ ধরি, তুলসীর মূলে প্রণাম যে আঁকে হয়ত তোমারে স্মরি। হায়রে করুণ হায়, এখনি যে সবে জাগিয়া উঠিবে প্রভাতের কিনারায়। তুমি যে কিশোর তোমার দেশেতে হিসাব নিকাশ নাই, যে আসে নিকটে তাহারেই লও আপন বলিয়া তাই।</p>\r\n\r\n<p>হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? এখন হইবে লোক জানাজানি, মুখ চেনাচেনি আর, হিসাব নিকাশ হইবে এখন কতটুকু আছে কার। সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়! হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার?</p>\r\n\r\n<p>সেথায় তোমার কিশোরী বধূটি মাটির প্রদীপ ধরি, তুলসীর মূলে প্রণাম যে আঁকে হয়ত তোমারে স্মরি। সখালী পাতাও সখাদের সাথে, বিনামূলে দাও প্রাণ, এপারে মোদের মথুরার মত নাই দান-প্রতিদান। কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা! বঁধুর কোলেতে বধুয়া ঘুমায়, খোলেনি বাহুর বাঁধ, দীঘির জলেতে নাহিয়া নাহিয়া মেটেনি তারার সাধ। সেথায় তোমার কিশোরী বধূটি মাটির প্রদীপ ধরি, তুলসীর মূলে প্রণাম যে আঁকে হয়ত তোমারে স্মরি।</p>', 0, 0, '2026-02-18 09:47:00', '2026-02-18 09:47:00'),
(42, 'আজিও চেননি সোনার আদর, চেননি মুক্তাহার', 'even-today-i-have-not-known-the-love-of-gold-nor-the-love-of', 'admin', 3, '2026-02-18 09:54:17', 'কালিন্দী লতা গলায় জড়ায়ে সোনার গোকুল কাঁদে ব্রজের দুলাল বাঁধা নাহি পড়ে যেন মথুরার ফাঁদে। আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার। তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি। শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন। ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি।', '<p>কালিন্দী লতা গলায় জড়ায়ে সোনার গোকুল কাঁদে ব্রজের দুলাল বাঁধা নাহি পড়ে যেন মথুরার ফাঁদে। আজিও চেননি সোনার আদর, চেননি মুক্তাহার, হাসি মুখে তাই সোনা ঝরে পড়ে তোমাদের যারতার। তুমিও হয়ত জান না কিশোর, সেই কিশোরীর লাগি, মনে মনে কত দেউল গেঁথেছে কত না রজনী জাগি। শূন্য হাওয়ার শূন্য ভরিতে বুকখানি করি শুনো, ফুলের দেউল হবে না উজাড় আজিকে প্রভাতে পুন। ঘরে ফিরে যাও সোনার কিশোর! এ পাপমথুরাপুরী, তোমার সোনার অঙ্গেতে দেবে বিষবান ছুঁড়ি ছুঁড়ি।</p>\r\n\r\n<p>মোদের মথুরা টরমল করে পাপ-লালসার ভারে, ভোগের সমিধ জ্বালিয়া আমরা পুড়িতেছি বারে বারে। হায়রে কিশোর হায়! ফুলের পরাণ বিকাতে এসেছ এই পাপ-মথুরায়। রঙের কুহেলী তলে, তোমার জীবন ঊষার আকাশে শিশু রবি সম জ্বলে। এখনো আসেনি অলি, মধুর লোভেতে কোমল কুসুম দুপায়েতে দলি দলি। বিহগ ছাড়িয়া ভোরের ভজন আহারের সন্ধ্যানে, বাতাসে বাঁধিয়া পাখা-সেতু-বাঁধ ছুটিবে সুদুর-পানে।</p>\r\n\r\n<p>হয়ত তাহারি অলকে বাঁধিতে মাঠের কুসুম ফুল, কতদূর পথ ঘুরিয়া মরিছ কত পথ করি ভুল। তোমাদের প্রেম নিকষিত হেম কামনা নাহিক তায় যুগে যুগে কবি গড়িয়াছে ছবি কত ব্রজের গাঁয়! সেথায় তোমার কিশোরী বধূটি মাটির প্রদীপ ধরি, তুলসীর মূলে প্রণাম যে আঁকে হয়ত তোমারে স্মরি। হায়রে করুণ হায়, এখনি যে সবে জাগিয়া উঠিবে প্রভাতের কিনারায়। তুমি যে কিশোর তোমার দেশেতে হিসাব নিকাশ নাই, যে আসে নিকটে তাহারেই লও আপন বলিয়া তাই।</p>\r\n\r\n<p>হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। তরুণ কিশোর ছেলে, আমরা আজিকে ভাবিয়া না পাই তুমি হেথা কেন এলে? এখন হইবে লোক জানাজানি, মুখ চেনাচেনি আর, হিসাব নিকাশ হইবে এখন কতটুকু আছে কার। সেই ব্রজধূলি আজো ত মুছেনি তোমার সোনার গায়, কেন তবে ভাই, চরণ বাড়ালে যৌবন মথুরায়! হয়ত তাহাও জানে না সে মেয়ে জানে না কুসুম-হার, এত যে আদরে গাঁথিছে সে তাহা গলায় দোলাবে কার?</p>\r\n\r\n<p>সেথায় তোমার কিশোরী বধূটি মাটির প্রদীপ ধরি, তুলসীর মূলে প্রণাম যে আঁকে হয়ত তোমারে স্মরি। সখালী পাতাও সখাদের সাথে, বিনামূলে দাও প্রাণ, এপারে মোদের মথুরার মত নাই দান-প্রতিদান। কারে ভালবাস, কারে যে বাস না তোমরা শেখনি তাহা, আমাদের মত কামনার ফাঁদে চেননি উহু ও আহা! বঁধুর কোলেতে বধুয়া ঘুমায়, খোলেনি বাহুর বাঁধ, দীঘির জলেতে নাহিয়া নাহিয়া মেটেনি তারার সাধ। সেথায় তোমার কিশোরী বধূটি মাটির প্রদীপ ধরি, তুলসীর মূলে প্রণাম যে আঁকে হয়ত তোমারে স্মরি।</p>', 4, 1, '2026-02-18 09:47:16', '2026-03-01 07:57:40');

-- --------------------------------------------------------

--
-- Table structure for table `news_post_categories`
--

CREATE TABLE `news_post_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `news_post_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news_post_categories`
--

INSERT INTO `news_post_categories` (`id`, `news_post_id`, `category_id`) VALUES
(3, 1, 4),
(11, 2, 3),
(10, 2, 12),
(12, 2, 14),
(28, 3, 3),
(27, 3, 12),
(32, 8, 3),
(31, 8, 12),
(96, 11, 1),
(100, 11, 2),
(91, 11, 3),
(89, 11, 4),
(94, 11, 5),
(98, 11, 6),
(97, 11, 7),
(102, 11, 8),
(103, 11, 9),
(101, 11, 10),
(92, 11, 11),
(90, 11, 12),
(93, 11, 13),
(95, 11, 14),
(99, 11, 15),
(81, 12, 1),
(85, 12, 2),
(76, 12, 3),
(74, 12, 4),
(79, 12, 5),
(83, 12, 6),
(82, 12, 7),
(87, 12, 8),
(88, 12, 9),
(86, 12, 10),
(77, 12, 11),
(75, 12, 12),
(78, 12, 13),
(80, 12, 14),
(84, 12, 15),
(126, 13, 1),
(130, 13, 2),
(121, 13, 3),
(119, 13, 4),
(124, 13, 5),
(128, 13, 6),
(127, 13, 7),
(132, 13, 8),
(133, 13, 9),
(131, 13, 10),
(122, 13, 11),
(120, 13, 12),
(123, 13, 13),
(125, 13, 14),
(129, 13, 15),
(156, 14, 1),
(160, 14, 2),
(151, 14, 3),
(149, 14, 4),
(154, 14, 5),
(158, 14, 6),
(157, 14, 7),
(162, 14, 8),
(163, 14, 9),
(161, 14, 10),
(152, 14, 11),
(150, 14, 12),
(153, 14, 13),
(155, 14, 14),
(159, 14, 15),
(170, 15, 3),
(168, 15, 4),
(171, 15, 11),
(169, 15, 12),
(179, 16, 4),
(181, 16, 6),
(184, 16, 8),
(185, 16, 9),
(183, 16, 10),
(180, 16, 12),
(182, 16, 15),
(194, 17, 2),
(196, 17, 8),
(197, 17, 9),
(195, 17, 10),
(192, 17, 12),
(193, 17, 15),
(265, 18, 4),
(269, 18, 5),
(271, 18, 6),
(270, 18, 7),
(267, 18, 11),
(266, 18, 12),
(268, 18, 13),
(231, 19, 9),
(230, 19, 10),
(233, 20, 2),
(235, 21, 2),
(239, 22, 2),
(241, 23, 5),
(243, 24, 5),
(245, 25, 5),
(247, 26, 13),
(249, 27, 13),
(251, 28, 13),
(256, 29, 1),
(255, 29, 3),
(260, 30, 1),
(259, 30, 3),
(264, 31, 1),
(263, 31, 3),
(278, 32, 3),
(279, 32, 5),
(302, 33, 6),
(293, 34, 13),
(297, 35, 12),
(303, 36, 8),
(301, 37, 12),
(304, 38, 15),
(305, 39, 3),
(306, 40, 11),
(307, 41, 3),
(308, 42, 3);

-- --------------------------------------------------------

--
-- Table structure for table `news_post_comments`
--

CREATE TABLE `news_post_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `news_post_id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `guest_name` varchar(120) NOT NULL,
  `guest_email` varchar(150) NOT NULL,
  `comment` text NOT NULL,
  `is_admin_reply` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 = admin reply',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = pending, 1 = approved',
  `recaptcha_score` decimal(3,2) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news_post_comments`
--

INSERT INTO `news_post_comments` (`id`, `news_post_id`, `parent_id`, `guest_name`, `guest_email`, `comment`, `is_admin_reply`, `status`, `recaptcha_score`, `ip_address`, `user_agent`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 12, NULL, 'akash halder', 'akashhalder277@gmail.com', 'dsfafdafaf', 0, 1, 0.90, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-06 15:07:49', '2026-02-07 15:40:48', NULL),
(2, 12, NULL, 'akash halder', 'akashhalder277@gmail.com', 'এখনো পাখিরা উঠেনি জাগিয়া, শিশির রয়েছে ঘুমে, কলঙ্কী চাঁদ পশ্চিমে হেলি কৌমুদী-লতা চুমে। হাসিটি হেথায় বাজারে বিকায় গানের বেসাত করি, হেথাকার লোক সুরের পরাণ ধরে মানে লয় ভরি। কে এলে তবে ভাই, সোনার গোকুল আঁধার করিয়া এই মথুরার ঠাই। কালিন্দী লতা গলায় জড়ায়ে সোনার গোকুল কাঁদে ব্রজের দুলাল বাঁধা নাহি পড়ে যেন মথুরার ফাঁদে। ওপারে কিশোর, এপারে যুবক, রাজার দেউল বাড়ি, পাষাণের দেশে কেন এলে ভাই। রাখালের দেশ ছাড়ি?', 0, 0, 0.90, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-06 17:23:47', '2026-02-16 15:21:50', NULL),
(3, 12, NULL, 'akash halder', 'akashhalder277@gmail.com', 'jkgfdgoajgakg', 0, 1, 0.90, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-06 17:26:44', '2026-02-16 14:58:16', NULL),
(7, 12, 2, 'admin', 'admin@example.com', 'my name is akash', 1, 1, NULL, NULL, NULL, '2026-02-08 17:20:27', '2026-02-08 17:20:27', NULL),
(9, 2, NULL, 'sanjay natta', 'manoyop224@manupay.com', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc', 0, 1, 0.90, '103.251.54.190', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-13 15:39:26', '2026-02-13 15:41:23', NULL),
(10, 2, 9, 'admin', 'admin@example.com', 'ok saasdadad', 1, 1, NULL, NULL, NULL, '2026-02-13 15:46:27', '2026-02-13 15:46:27', NULL),
(11, 2, NULL, 'jems', 'jemedec772@deposin.com', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0, 1, 0.90, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-14 19:04:12', '2026-02-14 19:55:57', NULL),
(12, 16, NULL, 'jems', 'jemedec772@deposin.com', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 0, 1, 0.70, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-14 19:04:48', '2026-02-14 19:55:53', NULL),
(13, 13, NULL, 'lorem imsum', 'jemedec772@deposin.com', 'এলইডি বাল্ব এভাবে হয় আমি যানতাম না', 0, 1, 0.90, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-16 07:26:40', '2026-02-16 14:58:13', NULL),
(14, 30, NULL, 'সুভাস সাহা', 'jemedec772@deposin.com', 'ধংস হয়ে যাক চিন', 0, 1, 0.70, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-16 07:28:38', '2026-02-16 14:56:37', NULL),
(15, 29, NULL, 'সৈকত হাজরা', 'jemedec772@deposin.com', 'এতদিন পর পথে এসছে', 0, 1, 0.90, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-16 07:29:44', '2026-02-16 14:57:39', NULL),
(16, 15, NULL, 'টিয়া বৈদ্য', 'jemedec772@deposin.com', 'সমুদ্রে অনেক জল', 0, 1, 0.90, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-16 07:31:32', '2026-02-16 14:58:11', NULL),
(17, 13, NULL, 'লাইকা মুমু', 'jemedec772@deposin.com', 'আপুন বাংলা নেহি জানতা হে', 0, 1, 0.70, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-16 07:32:47', '2026-02-16 14:58:08', NULL),
(18, 24, NULL, 'তোমার রুপা', 'jemedec772@deposin.com', 'হেরে গেছে 😂😂😂😂', 0, 1, 0.70, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', '2026-02-16 07:33:38', '2026-02-16 14:57:56', NULL),
(19, 30, 14, 'admin', 'admin@example.com', 'hellow', 1, 1, NULL, NULL, NULL, '2026-02-16 14:57:03', '2026-02-16 14:57:03', NULL),
(20, 42, NULL, 'akash halder', 'akashhalder277@gmail.com', 'abcde', 0, 0, 0.90, '2409:40e1:4048:9b4b:dd82:c54b:815c:5908', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', '2026-02-27 15:12:02', '2026-02-27 15:12:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `news_post_sub_categories`
--

CREATE TABLE `news_post_sub_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `news_post_id` int(10) UNSIGNED NOT NULL,
  `sub_category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news_post_sub_categories`
--

INSERT INTO `news_post_sub_categories` (`id`, `news_post_id`, `sub_category_id`) VALUES
(7, 2, 7),
(8, 2, 8),
(9, 2, 9),
(19, 3, 9),
(22, 8, 7),
(23, 8, 8),
(26, 10, 9),
(90, 11, 1),
(91, 11, 2),
(92, 11, 3),
(93, 11, 4),
(94, 11, 5),
(95, 11, 6),
(96, 11, 7),
(97, 11, 8),
(98, 11, 9),
(99, 11, 10),
(100, 11, 11),
(101, 11, 12),
(102, 11, 13),
(103, 11, 14),
(104, 11, 15),
(105, 11, 16),
(106, 11, 17),
(107, 11, 18),
(72, 12, 1),
(73, 12, 2),
(74, 12, 3),
(75, 12, 4),
(76, 12, 5),
(77, 12, 6),
(78, 12, 7),
(79, 12, 8),
(80, 12, 9),
(81, 12, 10),
(82, 12, 11),
(83, 12, 12),
(84, 12, 13),
(85, 12, 14),
(86, 12, 15),
(87, 12, 16),
(88, 12, 17),
(89, 12, 18),
(126, 13, 1),
(127, 13, 2),
(128, 13, 3),
(129, 13, 4),
(130, 13, 5),
(131, 13, 6),
(132, 13, 7),
(133, 13, 8),
(134, 13, 9),
(135, 13, 10),
(136, 13, 11),
(137, 13, 12),
(138, 13, 13),
(139, 13, 14),
(140, 13, 15),
(141, 13, 16),
(142, 13, 17),
(143, 13, 18),
(162, 14, 1),
(163, 14, 2),
(164, 14, 3),
(165, 14, 4),
(166, 14, 5),
(167, 14, 6),
(168, 14, 7),
(169, 14, 8),
(170, 14, 9),
(171, 14, 10),
(172, 14, 11),
(173, 14, 12),
(174, 14, 13),
(175, 14, 14),
(176, 14, 15),
(177, 14, 16),
(178, 14, 17),
(179, 14, 18),
(183, 15, 7),
(184, 15, 8),
(185, 15, 9),
(189, 17, 4),
(190, 17, 5),
(191, 17, 6),
(262, 18, 10),
(263, 18, 11),
(264, 18, 12),
(265, 18, 13),
(266, 18, 14),
(222, 20, 4),
(223, 20, 6),
(226, 21, 4),
(227, 21, 6),
(237, 22, 4),
(238, 22, 5),
(239, 22, 6),
(241, 23, 10),
(243, 24, 10),
(245, 25, 10),
(249, 29, 7),
(252, 30, 7),
(253, 30, 9),
(258, 31, 1),
(259, 31, 2),
(260, 31, 7),
(261, 31, 9),
(270, 32, 10),
(273, 33, 15),
(274, 39, 8);

-- --------------------------------------------------------

--
-- Table structure for table `news_post_tags`
--

CREATE TABLE `news_post_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `news_post_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news_post_tags`
--

INSERT INTO `news_post_tags` (`id`, `news_post_id`, `tag_id`) VALUES
(12, 1, 1),
(13, 1, 2),
(14, 1, 5),
(15, 1, 9),
(16, 1, 11),
(17, 1, 13),
(29, 2, 1),
(30, 2, 2),
(31, 2, 3),
(32, 2, 5),
(33, 2, 10),
(34, 2, 11),
(35, 2, 12),
(36, 8, 1),
(37, 8, 2),
(38, 8, 10),
(39, 8, 11),
(40, 8, 12),
(120, 11, 1),
(121, 11, 2),
(122, 11, 3),
(123, 11, 4),
(124, 11, 5),
(125, 11, 6),
(117, 12, 1),
(118, 12, 2),
(119, 12, 3),
(138, 13, 1),
(139, 13, 2),
(140, 13, 3),
(141, 13, 4),
(142, 13, 5),
(143, 13, 6),
(144, 13, 7),
(145, 13, 8),
(146, 13, 9),
(147, 13, 10),
(148, 13, 11),
(149, 13, 12),
(163, 14, 14),
(164, 14, 19),
(165, 14, 20),
(166, 14, 21),
(167, 14, 22),
(168, 14, 23),
(169, 14, 24),
(170, 14, 25),
(171, 14, 26),
(172, 14, 27),
(173, 14, 28),
(174, 14, 29),
(175, 14, 30),
(181, 15, 7),
(182, 15, 8),
(183, 15, 9),
(184, 15, 21),
(185, 15, 30),
(188, 16, 1),
(189, 16, 2),
(194, 17, 9),
(195, 17, 22),
(196, 17, 23),
(197, 17, 25),
(248, 18, 2),
(249, 18, 4),
(250, 18, 16),
(251, 18, 17),
(252, 18, 19),
(253, 18, 20),
(211, 19, 17),
(214, 20, 3),
(215, 20, 29),
(217, 21, 3),
(233, 22, 2),
(234, 22, 3),
(235, 22, 10),
(236, 22, 29),
(237, 22, 30),
(240, 23, 4),
(241, 23, 5),
(243, 25, 4),
(247, 29, 9),
(290, 33, 2),
(291, 33, 3),
(292, 33, 16),
(282, 34, 22),
(283, 34, 30),
(287, 35, 1),
(293, 36, 9),
(294, 38, 20),
(295, 38, 29),
(296, 39, 4),
(297, 40, 4);

-- --------------------------------------------------------

--
-- Table structure for table `news_post_thumbnails`
--

CREATE TABLE `news_post_thumbnails` (
  `id` int(10) UNSIGNED NOT NULL,
  `news_post_id` int(10) UNSIGNED NOT NULL,
  `type` enum('link','image','media') NOT NULL,
  `thumbnail_url` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news_post_thumbnails`
--

INSERT INTO `news_post_thumbnails` (`id`, `news_post_id`, `type`, `thumbnail_url`, `created_at`, `updated_at`) VALUES
(1, 1, 'link', 'https://plus.unsplash.com/premium_photo-1707080369554-359143c6aa0b?fm=jpg&q=60&w=3000&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8bmV3cyUyMHdlYnNpdGV8ZW58MHx8MHx8fDA%3D', '2026-02-04 11:17:39', '2026-02-04 11:17:39'),
(2, 2, 'link', 'https://images.unsplash.com/photo-1761839258289-72f12b0de058?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '2026-02-04 14:06:48', '2026-02-04 14:06:48'),
(16, 12, 'link', 'https://images.unsplash.com/photo-1770065799102-f9a6996fd2a6?q=80&w=1032&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '2026-02-05 17:06:59', '2026-02-05 17:06:59'),
(17, 11, 'link', 'https://images.unsplash.com/photo-1770045232338-5eaac4a3b05b?q=80&w=871&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '2026-02-05 17:11:51', '2026-02-05 17:11:51'),
(19, 13, 'link', 'https://images.unsplash.com/photo-1770074051176-76dc5019be0a?q=80&w=871&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '2026-02-08 16:15:59', '2026-02-08 16:15:59'),
(21, 14, 'link', 'https://images.unsplash.com/photo-1770106678115-ec9aa241cdf6?q=80&w=871&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '2026-02-08 16:20:24', '2026-02-08 16:20:24'),
(24, 16, 'link', 'https://images.unsplash.com/photo-1770135878277-73e589248b43?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '2026-02-08 16:28:26', '2026-02-08 16:28:26'),
(26, 17, 'link', 'https://nishachor.com/wp-content/uploads/2011/04/bangla-in-everything-nishachor.jpg', '2026-02-08 16:30:27', '2026-02-08 16:30:27'),
(30, 19, 'link', 'https://www.sangbadpratidin.in/wp-content/uploads/2026/01/death-4.jpg', '2026-02-09 06:25:20', '2026-02-09 06:25:20'),
(32, 20, 'link', 'https://www.sangbadpratidin.in/wp-content/uploads/2026/02/SIR-centre-for-one-1.jpg', '2026-02-09 06:29:44', '2026-02-09 06:29:44'),
(34, 21, 'link', 'https://www.sangbadpratidin.in/wp-content/uploads/2026/02/JNM.jpg', '2026-02-09 06:31:11', '2026-02-09 06:31:11'),
(36, 22, 'link', 'https://www.sangbadpratidin.in/wp-content/uploads/2026/01/Humayun-Kabir-2-1.jpg', '2026-02-09 06:38:14', '2026-02-09 06:38:14'),
(38, 23, 'link', 'https://www.sangbadpratidin.in/wp-content/uploads/2026/02/Sourav-1.jpg', '2026-02-09 06:40:50', '2026-02-09 06:40:50'),
(40, 24, 'link', 'https://dev.puruliamirror.com/uploads/posts/thumbnails/02_26/img_20260209_064222_0bea2ae8b1.webp', '2026-02-09 06:42:31', '2026-02-09 06:42:31'),
(41, 25, 'link', 'https://dev.puruliamirror.com/uploads/posts/thumbnails/02_26/img_20260209_064456_82890e28c7.webp', '2026-02-09 06:44:56', '2026-02-09 06:44:56'),
(43, 26, 'link', 'https://www.sangbadpratidin.in/wp-content/uploads/2026/01/flower-market.jpg', '2026-02-09 06:49:27', '2026-02-09 06:49:27'),
(44, 27, 'link', 'https://www.sangbadpratidin.in/wp-content/uploads/2026/01/Khejur.jpg', '2026-02-09 06:51:22', '2026-02-09 06:51:22'),
(45, 28, 'link', 'https://www.sangbadpratidin.in/wp-content/uploads/2025/11/Oranges.jpg', '2026-02-09 07:04:17', '2026-02-09 07:04:17'),
(47, 29, 'link', 'https://pbs.twimg.com/media/HAnVSpbacAAAFXv?format=jpg&name=4096x4096', '2026-02-09 07:29:05', '2026-02-09 07:29:05'),
(48, 30, 'link', 'https://dev.puruliamirror.com/uploads/posts/thumbnails/02_26/img_20260209_075148_320982fa92.webp', '2026-02-09 07:51:49', '2026-02-09 07:51:49'),
(49, 31, 'link', 'https://www.sangbadpratidin.in/wp-content/uploads/2026/02/Russia-attack.jpg', '2026-02-09 07:53:18', '2026-02-09 07:53:18'),
(50, 18, 'link', 'https://images.unsplash.com/photo-1770199782220-486adbf69941?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', '2026-02-09 07:55:27', '2026-02-09 07:55:27'),
(54, 32, 'link', 'https://dev.puruliamirror.com/uploads/posts/thumbnails/02_26/img_20260209_075759_2d0894f54d.webp', '2026-02-09 18:22:59', '2026-02-09 18:22:59'),
(68, 34, 'media', 'uploads/posts/thumbnails/02_26/1771340905_e6fc0d450b7615dd55a8.jpg', '2026-02-17 16:59:18', '2026-02-17 16:59:18'),
(69, 35, 'image', 'uploads/posts/thumbnails/02_26/img_20260217_192529_feb88c7959.webp', '2026-02-17 19:25:29', '2026-02-17 19:25:29'),
(72, 37, 'image', 'uploads/posts/thumbnails/02_26/1771358431_720e8667e27fb42e3e29.jpg', '2026-02-17 20:00:31', '2026-02-17 20:00:31'),
(73, 33, 'media', 'uploads/posts/thumbnails/02_26/1771342223_ab0823cef9e2483a34b5.png', '2026-02-17 20:26:36', '2026-02-17 20:26:36'),
(74, 36, 'media', 'uploads/posts/thumbnails/02_26/1771340591_2106af59d74a1a6954a9.png', '2026-02-17 20:39:09', '2026-02-17 20:39:09'),
(75, 41, 'link', 'https://plus.unsplash.com/premium_photo-1707080369554-359143c6aa0b?fm=jpg&q=60&w=3000&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8bmV3cyUyMHdlYnNpdGV8ZW58MHx8MHx8fDA%3D', '2026-02-18 09:47:00', '2026-02-18 09:47:00'),
(76, 42, 'link', 'https://plus.unsplash.com/premium_photo-1707080369554-359143c6aa0b?fm=jpg&q=60&w=3000&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8bmV3cyUyMHdlYnNpdGV8ZW58MHx8MHx8fDA%3D', '2026-02-18 09:47:16', '2026-02-18 09:47:16');

-- --------------------------------------------------------

--
-- Table structure for table `post_views`
--

CREATE TABLE `post_views` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `viewed_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_views`
--

INSERT INTO `post_views` (`id`, `post_id`, `ip_address`, `viewed_at`) VALUES
(1, 12, '::1', '2026-02-14 22:54:25'),
(2, 32, '::1', '2026-02-14 22:54:40'),
(3, 2, '::1', '2026-02-15 01:28:00'),
(4, 18, '::1', '2026-02-15 22:56:13'),
(5, 2, '::1', '2026-02-16 00:48:48'),
(6, 32, '::1', '2026-02-16 00:48:49'),
(7, 21, '::1', '2026-02-16 01:03:33'),
(8, 2, '::1', '2026-02-16 11:08:52'),
(9, 16, '::1', '2026-02-16 12:55:24'),
(10, 30, '::1', '2026-02-16 12:57:36'),
(11, 29, '::1', '2026-02-16 12:58:45'),
(12, 15, '::1', '2026-02-16 13:00:05'),
(13, 13, '::1', '2026-02-16 13:01:43'),
(14, 24, '::1', '2026-02-16 13:02:53'),
(15, 21, '::1', '2026-02-16 13:38:06'),
(16, 2, '::1', '2026-02-16 20:24:39'),
(17, 13, '::1', '2026-02-16 20:24:43'),
(18, 21, '::1', '2026-02-16 20:24:45'),
(19, 8, '::1', '2026-02-16 21:01:10'),
(20, 12, '::1', '2026-02-16 21:49:36'),
(21, 33, '::1', '2026-02-17 16:35:35'),
(22, 34, '::1', '2026-02-17 16:52:52'),
(23, 37, '::1', '2026-02-18 01:31:05'),
(24, 42, '::1', '2026-02-18 15:24:43'),
(25, 33, '::1', '2026-02-18 15:39:39'),
(26, 42, '::1', '2026-02-20 23:29:13'),
(27, 42, '2409:40e1:4048:9b4b:dd82:c54b:815c:5908', '2026-02-27 15:07:46'),
(28, 15, '152.56.136.72', '2026-03-01 07:29:18'),
(29, 21, '152.56.136.72', '2026-03-01 07:29:30'),
(30, 21, '157.34.207.151', '2026-03-01 07:41:37'),
(31, 15, '2409:4088:9d93:b4d4:9d00:9716:a08f:b615', '2026-03-01 07:50:39'),
(32, 42, '157.34.203.196', '2026-03-01 07:57:40');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `class` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `type` varchar(31) NOT NULL DEFAULT 'string',
  `context` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_authors`
--

CREATE TABLE `sub_authors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_authors`
--

INSERT INTO `sub_authors` (`id`, `name`, `email`, `profile_image`, `created_at`, `updated_at`) VALUES
(3, 'akash halder', 'sagode4548@alibto.com', 'uploads/sub_authors/1771355328_f6af69e51c47cc690b7e.png', '2026-02-18 00:38:48', '2026-02-18 00:38:48'),
(4, 'beauty biswas', 'romenbiswas@gmail.com', 'uploads/sub_authors/1771364119_1e96ca0b17adb074f4fc.jpg', '2026-02-18 00:40:22', '2026-02-18 03:05:19');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sub_cat_name` varchar(100) NOT NULL,
  `sub_cat_slug` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `cat_id`, `sub_cat_name`, `sub_cat_slug`, `is_active`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'দুর্ঘটনা', 'দুর্ঘটনা', 1, 1, '2026-02-04 16:39:13', '2026-02-04 16:39:13'),
(2, 1, 'অপরাধ', 'অপরাধ', 1, 1, '2026-02-04 16:39:13', '2026-02-04 16:39:13'),
(3, 1, 'উন্নয়ন', 'উন্নয়ন', 1, 1, '2026-02-04 16:39:13', '2026-02-04 16:39:13'),
(4, 2, 'নির্বাচন', 'নির্বাচন', 1, 1, '2026-02-04 16:39:13', '2026-02-04 16:39:13'),
(5, 2, 'সংসদ', 'সংসদ', 1, 1, '2026-02-04 16:39:13', '2026-02-04 16:39:13'),
(6, 2, 'দলীয় রাজনীতি', 'দলীয়-রাজনীতি', 1, 1, '2026-02-04 16:39:13', '2026-02-04 16:39:13'),
(7, 3, 'বিশ্ব রাজনীতি', 'বিশ্ব-রাজনীতি', 1, 1, '2026-02-04 16:39:13', '2026-02-04 16:39:13'),
(8, 3, 'যুদ্ধ', 'যুদ্ধ', 1, 1, '2026-02-04 16:39:13', '2026-02-04 16:39:13'),
(9, 3, 'কূটনীতি', 'কূটনীতি', 1, 1, '2026-02-04 16:39:13', '2026-02-04 16:39:13'),
(10, 5, 'ক্রিকেট', 'ক্রিকেট', 1, 1, '2026-02-04 16:39:13', '2026-02-04 16:39:13'),
(11, 5, 'ফুটবল', 'ফুটবল', 1, 1, '2026-02-04 16:39:13', '2026-02-04 16:39:13'),
(12, 5, 'অলিম্পিক', 'অলিম্পিক', 1, 1, '2026-02-04 16:39:13', '2026-02-04 16:39:13'),
(13, 6, 'সিনেমা', 'সিনেমা', 1, 1, '2026-02-04 16:39:13', '2026-02-04 16:39:13'),
(14, 6, 'টেলিভিশন', 'টেলিভিশন', 1, 1, '2026-02-04 16:39:13', '2026-02-04 16:39:13'),
(15, 6, 'সেলিব্রিটি', 'সেলিব্রিটি', 1, 1, '2026-02-04 16:39:13', '2026-02-04 16:39:13'),
(16, 7, 'মোবাইল', 'মোবাইল', 1, 1, '2026-02-04 16:39:13', '2026-02-04 16:39:13'),
(17, 7, 'ইন্টারনেট', 'ইন্টারনেট', 1, 1, '2026-02-04 16:39:13', '2026-02-04 16:39:13'),
(18, 7, 'এআই', 'এআই', 1, 1, '2026-02-04 16:39:13', '2026-02-04 16:39:13');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(29, 'আইন-আদালত'),
(6, 'আইপিএল'),
(26, 'আবহাওয়া-আপডেট'),
(16, 'ইন্টারনেট'),
(14, 'এআই'),
(23, 'ওয়েব-সিরিজ'),
(18, 'করোনা'),
(4, 'ক্রিকেট'),
(27, 'ঘূর্ণিঝড়'),
(20, 'চাকরি-সংবাদ'),
(8, 'চ্যাম্পিয়নস-লিগ'),
(30, 'দুর্নীতি'),
(3, 'নির্বাচন-২০২6'),
(9, 'প্রধানমন্ত্রী'),
(22, 'ফলাফল'),
(7, 'ফুটবল'),
(24, 'বাংলা-সিনেমা'),
(1, 'বাংলাদেশ'),
(5, 'বিশ্বকাপ'),
(28, 'বৃষ্টি'),
(2, 'ভারত'),
(19, 'ভ্রমণ-গাইড'),
(11, 'মুদ্রাস্ফীতি'),
(10, 'রাষ্ট্রপতি'),
(21, 'শিক্ষা-বোর্ড'),
(12, 'শেয়ার-বাজার'),
(25, 'সেলিব্রিটি-গসিপ'),
(13, 'স্টার্টআপ'),
(17, 'স্বাস্থ্য-টিপস'),
(15, 'স্মার্টফোন');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `last_active` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `status`, `status_message`, `active`, `last_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', NULL, NULL, 0, NULL, '2026-01-11 20:36:36', '2026-01-11 20:36:36', NULL),
(2, 'user', NULL, NULL, 0, NULL, '2026-01-11 20:48:31', '2026-02-08 07:38:26', NULL),
(3, 'test@example', NULL, NULL, 0, NULL, '2026-02-08 05:33:12', '2026-02-08 05:33:12', NULL),
(4, 'test@test', NULL, NULL, 0, NULL, '2026-02-08 07:06:46', '2026-02-08 07:06:46', NULL),
(5, 'akashhalder277', NULL, NULL, 0, NULL, '2026-02-08 07:07:36', '2026-02-08 07:07:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `website_visits`
--

CREATE TABLE `website_visits` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `visit_date` date NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `website_visits`
--

INSERT INTO `website_visits` (`id`, `ip_address`, `visit_date`, `created_at`) VALUES
(1, '::1', '2026-02-28', NULL),
(2, '::1', '2026-03-01', NULL),
(3, '2409:40e1:404f:70:79c5:aabc:e42d:f765', '2026-03-01', NULL),
(4, '152.56.136.72', '2026-03-01', NULL),
(5, '157.34.203.196', '2026-03-01', NULL),
(6, '157.34.207.151', '2026-03-01', NULL),
(7, '2409:4088:9d93:b4d4:9d00:9716:a08f:b615', '2026-03-01', NULL),
(8, '2409:40e1:404f:70:2c62:1322:3ca6:7415', '2026-03-01', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `auth_identities`
--
ALTER TABLE `auth_identities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_secret` (`type`,`secret`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type_identifier` (`id_type`,`identifier`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_permissions_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `auth_remember_tokens_user_id_foreign` (`user_id`);

--
-- Indexes for table `auth_token_logins`
--
ALTER TABLE `auth_token_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type_identifier` (`id_type`,`identifier`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `file_type` (`file_type`),
  ADD KEY `folder` (`folder`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_posts`
--
ALTER TABLE `news_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `news_post_categories`
--
ALTER TABLE `news_post_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_post_categories_category_id_foreign` (`category_id`),
  ADD KEY `news_post_id_category_id` (`news_post_id`,`category_id`);

--
-- Indexes for table `news_post_comments`
--
ALTER TABLE `news_post_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_post_id` (`news_post_id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `news_post_sub_categories`
--
ALTER TABLE `news_post_sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_post_sub_categories_sub_category_id_foreign` (`sub_category_id`),
  ADD KEY `news_post_id_sub_category_id` (`news_post_id`,`sub_category_id`);

--
-- Indexes for table `news_post_tags`
--
ALTER TABLE `news_post_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_post_tags_tag_id_foreign` (`tag_id`),
  ADD KEY `news_post_id_tag_id` (`news_post_id`,`tag_id`);

--
-- Indexes for table `news_post_thumbnails`
--
ALTER TABLE `news_post_thumbnails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_post_thumbnails_news_post_id_foreign` (`news_post_id`);

--
-- Indexes for table `post_views`
--
ALTER TABLE `post_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `ip_address` (`ip_address`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_authors`
--
ALTER TABLE `sub_authors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sub_cat_slug` (`sub_cat_slug`),
  ADD KEY `sub_categories_cat_id_foreign` (`cat_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `website_visits`
--
ALTER TABLE `website_visits`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ip_address_visit_date` (`ip_address`,`visit_date`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `auth_identities`
--
ALTER TABLE `auth_identities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auth_token_logins`
--
ALTER TABLE `auth_token_logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `news_posts`
--
ALTER TABLE `news_posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `news_post_categories`
--
ALTER TABLE `news_post_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=311;

--
-- AUTO_INCREMENT for table `news_post_comments`
--
ALTER TABLE `news_post_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `news_post_sub_categories`
--
ALTER TABLE `news_post_sub_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=275;

--
-- AUTO_INCREMENT for table `news_post_tags`
--
ALTER TABLE `news_post_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=298;

--
-- AUTO_INCREMENT for table `news_post_thumbnails`
--
ALTER TABLE `news_post_thumbnails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `post_views`
--
ALTER TABLE `post_views`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_authors`
--
ALTER TABLE `sub_authors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `website_visits`
--
ALTER TABLE `website_visits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_identities`
--
ALTER TABLE `auth_identities`
  ADD CONSTRAINT `auth_identities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  ADD CONSTRAINT `auth_permissions_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  ADD CONSTRAINT `auth_remember_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

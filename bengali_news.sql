-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 31, 2026 at 03:46 PM
-- Server version: 8.4.7
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bengali_news`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

DROP TABLE IF EXISTS `auth_groups_users`;
CREATE TABLE IF NOT EXISTS `auth_groups_users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auth_groups_users_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`id`, `user_id`, `group`, `created_at`) VALUES
(1, 1, 'superadmin', '2026-01-11 20:36:36'),
(2, 1, 'admin', '2026-01-11 20:42:02'),
(3, 1, 'developer', '2026-01-11 20:42:18'),
(4, 1, 'user', '2026-01-11 20:42:53'),
(5, 2, 'user', '2026-01-11 20:48:32');

-- --------------------------------------------------------

--
-- Table structure for table `auth_identities`
--

DROP TABLE IF EXISTS `auth_identities`;
CREATE TABLE IF NOT EXISTS `auth_identities` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `secret` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `secret2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `extra` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `force_reset` tinyint(1) NOT NULL DEFAULT '0',
  `last_used_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `type_secret` (`type`,`secret`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth_identities`
--

INSERT INTO `auth_identities` (`id`, `user_id`, `type`, `name`, `secret`, `secret2`, `expires`, `extra`, `force_reset`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'email_password', NULL, 'admin@example.com', '$2y$12$bIYZGzeWYnILOHUkn4hDyubP7HKRTo6FLLgOTi.iW3TQ9hFonx5k.', NULL, NULL, 0, '2026-01-31 06:53:14', '2026-01-11 20:36:36', '2026-01-31 06:53:14'),
(2, 2, 'email_password', NULL, 'user@example.com', '$2y$12$/5MptMAuf/1OUYJKZsyccetiH/dmdA6d7Z6llcMjw0pw58nHTRn6S', NULL, NULL, 0, '2026-01-11 20:49:30', '2026-01-11 20:48:32', '2026-01-11 20:49:30');

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

DROP TABLE IF EXISTS `auth_logins`;
CREATE TABLE IF NOT EXISTS `auth_logins` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `identifier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_type_identifier` (`id_type`,`identifier`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(17, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-01-31 06:53:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions_users`
--

DROP TABLE IF EXISTS `auth_permissions_users`;
CREATE TABLE IF NOT EXISTS `auth_permissions_users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `permission` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auth_permissions_users_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_remember_tokens`
--

DROP TABLE IF EXISTS `auth_remember_tokens`;
CREATE TABLE IF NOT EXISTS `auth_remember_tokens` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `selector` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `hashedValidator` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `expires` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `selector` (`selector`),
  KEY `auth_remember_tokens_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auth_token_logins`
--

DROP TABLE IF EXISTS `auth_token_logins`;
CREATE TABLE IF NOT EXISTS `auth_token_logins` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `identifier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_type_identifier` (`id_type`,`identifier`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `cat` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat`, `slug`, `is_active`, `status`, `created_at`, `updated_at`) VALUES
(1, 'উৎসবের আলোয়', 'উৎসবের-আলোয়', 0, 1, '2026-01-30 07:44:48', '2026-01-30 07:44:48'),
(2, 'সাধারণ খবর', 'সাধারণ-খবর', 0, 1, '2026-01-30 07:44:54', '2026-01-30 07:44:54'),
(3, 'রাজনীতি', 'রাজনীতি', 0, 1, '2026-01-30 07:45:05', '2026-01-31 07:30:49'),
(4, 'ক্রাইম', 'ক্রাইম', 0, 1, '2026-01-30 07:45:11', '2026-01-30 07:45:11'),
(5, 'খেলা', 'খেলা', 1, 1, '2026-01-30 07:45:16', '2026-01-31 07:50:38'),
(6, 'সংস্কৃতি', 'সংস্কৃতি', 0, 1, '2026-01-30 07:45:25', '2026-01-30 07:45:25'),
(7, 'বিনোদন', 'বিনোদন', 0, 1, '2026-01-30 07:45:31', '2026-01-30 07:45:31'),
(8, 'লাইফস্টাইল', 'লাইফস্টাইল', 0, 1, '2026-01-30 07:45:36', '2026-01-30 07:45:36'),
(9, 'পর্যটন', 'পর্যটন', 0, 1, '2026-01-30 07:45:41', '2026-01-30 07:45:41'),
(10, 'চাষাবাদ', 'চাষাবাদ', 0, 1, '2026-01-30 07:45:47', '2026-01-30 07:45:47'),
(11, 'ধর্ম ও পুজোপাঠ', 'ধর্ম-ও-পুজোপাঠ', 0, 1, '2026-01-30 07:46:01', '2026-01-30 07:46:01'),
(12, 'অন্যান্য', 'অন্যান্য', 0, 1, '2026-01-30 07:46:07', '2026-01-30 07:46:07'),
(13, 'ফটো গ্যালারি', 'ফটো-গ্যালারি', 0, 1, '2026-01-30 07:46:11', '2026-01-30 07:46:11'),
(14, 'ভিডিও গ্যালারি', 'ভিডিও-গ্যালারি', 0, 1, '2026-01-30 07:46:17', '2026-01-30 07:46:17'),
(15, 'টুকরো খবর', 'টুকরো-খবর', 0, 1, '2026-01-30 07:46:22', '2026-01-31 07:42:00'),
(16, 'ব্লক', 'ব্লক', 0, 1, '2026-01-30 07:46:27', '2026-01-30 07:46:27'),
(17, 'শহর', 'শহর', 0, 1, '2026-01-30 07:46:33', '2026-01-30 17:27:48');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(11, '2026-01-26-144422', 'App\\Database\\Migrations\\CreateNewsPostThumbnailsTable', 'default', 'App', 1769488881, 2);

-- --------------------------------------------------------

--
-- Table structure for table `news_posts`
--

DROP TABLE IF EXISTS `news_posts`;
CREATE TABLE IF NOT EXISTS `news_posts` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `headline` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `author` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `post_date_time` datetime DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_general_ci,
  `description` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=published,0=draft',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news_posts`
--

INSERT INTO `news_posts` (`id`, `headline`, `slug`, `author`, `post_date_time`, `short_description`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'অহিংসা ও সম্প্রীতির বার্তায় শহীদ দিবস', 'অহিংসা-ও-সম্প্রীতির-বার্তায়-শহীদ-দিবস', '1', NULL, 'অহিংসা ও সম্প্রীতির বার্তায় শহীদ দিবস', '<h2 style=\"text-align: center;\"><strong>নিজস্ব প্রতিনিধি, পুরুলিয়া:</strong></h2>\r\n\r\n<p>অহিংসা, সত্য ও সর্বধর্ম সমন্বয়ের আদর্শকে সামনে রেখে শহীদ দিবসে মহাত্মা গান্ধীর প্রতি গভীর শ্রদ্ধা জানাল পুরুলিয়া জেলা প্রশাসন। সমাজে সম্প্রীতি ও মানবিক মূল্যবোধের বার্তা ছড়িয়ে দিতে শুক্রবার সকালে জেলা শাসকের কার্যালয় প্রাঙ্গণে আয়োজিত হয় বিশেষ প্রার্থনাসভা।</p>\r\n\r\n<p>শহীদ দিবস উপলক্ষে অনুষ্ঠিত এই কর্মসূচিতে প্রশাসনের পক্ষ থেকে স্পষ্টভাবে তুলে ধরা হয়, বর্তমান সময়ে গান্ধীর আদর্শ কতটা প্রাসঙ্গিক এবং সামাজিক সহাবস্থানের ক্ষেত্রে তাঁর চিন্তাধারা কতটা গুরুত্বপূর্ণ। ধর্ম, ভাষা ও মতের ভিন্নতার ঊর্ধ্বে উঠে শান্তির পথে এগিয়ে যাওয়ার আহ্বানই ছিল দিনের মূল বার্তা।</p>\r\n\r\n<p>প্রার্থনাসভায় পরিবেশিত হয় দেশাত্মবোধক সঙ্গীত ও রামধুন। সর্বধর্ম প্রার্থনার মাধ্যমে বিভিন্ন ধর্মগ্রন্থ থেকে পাঠ করা হয়, যা সম্প্রীতির আবহকে আরও দৃঢ় করে তোলে। অনুষ্ঠানে উপস্থিত আধিকারিক ও কর্মচারীদের মধ্যে দেখা যায় এক অনন্য সংযম ও শ্রদ্ধার পরিবেশ।</p>\r\n\r\n<p>এর আগে জেলা প্রশাসনের পক্ষ থেকে মহাত্মা গান্ধীর মর্মর মূর্তি, কার্গিল বেদী ও শহীদ বেদীতে মাল্যদান ও পুষ্পার্ঘ্য অর্পণ করা হয়। শ্রদ্ধা নিবেদন করেন পুরুলিয়া জেলার জেলাশাসক সুধীর কোন্থাম। তাঁর সঙ্গে উপস্থিত ছিলেন অতিরিক্ত জেলাশাসক (ভূমি ও ভূমি সংস্কার) পাটিল যোগেশ অশোকরাও, পুরুলিয়া সদর মহকুমাশাসক উৎপল কুমার ঘোষ, রঘুনাথপুরের মহকুমা তথ্য ও সংস্কৃতি আধিকারিক সায়ন ঘোষ সহ অন্যান্যরা।</p>\r\n\r\n<p>সমগ্র অনুষ্ঠানজুড়ে শহীদ দিবসের তাৎপর্য ও গান্ধীর জীবনদর্শনকে স্মরণ করে প্রশাসনের তরফে দেওয়া হয় শান্তি, সহনশীলতা ও মানবিকতার পথে এগিয়ে চলার আহ্বান।</p>', 1, '2026-01-30 14:43:03', '2026-01-31 08:39:41'),
(2, 'ফের কমবে তাপমাত্রা? কী বলছে পূর্বাভাস?', 'ফের-কমবে-তাপমাত্রা?-কী-বলছে-পূর্বাভাস?', '1', NULL, 'ফের কমবে তাপমাত্রা? কী বলছে পূর্বাভাস?', '<p style=\"text-align: center;\"><strong>নিজস্ব প্রতিনিধি, পুরুলিয়া :</strong></p>\r\n\r\n<p>জানুয়ারির শেষে পুরুলিয়ায় শীতের ছোঁয়া সামান্য বাড়তে পারে। যদিও মাঘের শীতের প্রত্যাবর্তনের কোনও ইঙ্গিত নেই। কৃষি দপ্তরের রিপোর্ট অনুযায়ী, বৃহস্পতিবার (২৯ জানুয়ারি) জেলায় বৃষ্টিপাত হয়নি। এ দিন সর্বোচ্চ তাপমাত্রা ছিল ২৭.৩ ডিগ্রি সেলসিয়াস এবং সর্বনিম্ন তাপমাত্রা ১৩.০ ডিগ্রি সেলসিয়াস।</p>\r\n\r\n<p>সকালে হালকা ঠান্ডা অনুভূত হলেও বেলা বাড়তেই রোদের তাপে শীতের আমেজ মিলিয়ে যাচ্ছে। আবহাওয়া বিশেষজ্ঞদের মতে, পশ্চিমী ঝঞ্ঝার প্রভাবে উত্তুরে হাওয়ার গতি কমে যাওয়াতেই রাতের ঠান্ডা আর জমতে পারছে না। ফলে জানুয়ারির শেষে এসেও পুরুলিয়ায় শীত কার্যত বিদায়ের পথে। তবে সপ্তাহান্তে রাতের তাপমাত্রা খানিক কমতে পারে।</p>', 0, '2026-01-30 15:08:59', '2026-01-30 15:09:06');

-- --------------------------------------------------------

--
-- Table structure for table `news_post_categories`
--

DROP TABLE IF EXISTS `news_post_categories`;
CREATE TABLE IF NOT EXISTS `news_post_categories` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `news_post_id` int UNSIGNED NOT NULL,
  `category_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `news_post_categories_category_id_foreign` (`category_id`),
  KEY `news_post_id_category_id` (`news_post_id`,`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news_post_categories`
--

INSERT INTO `news_post_categories` (`id`, `news_post_id`, `category_id`) VALUES
(5, 1, 12),
(4, 2, 15),
(6, 1, 4),
(7, 1, 5),
(8, 1, 15);

-- --------------------------------------------------------

--
-- Table structure for table `news_post_sub_categories`
--

DROP TABLE IF EXISTS `news_post_sub_categories`;
CREATE TABLE IF NOT EXISTS `news_post_sub_categories` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `news_post_id` int UNSIGNED NOT NULL,
  `sub_category_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `news_post_sub_categories_sub_category_id_foreign` (`sub_category_id`),
  KEY `news_post_id_sub_category_id` (`news_post_id`,`sub_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news_post_sub_categories`
--

INSERT INTO `news_post_sub_categories` (`id`, `news_post_id`, `sub_category_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `news_post_tags`
--

DROP TABLE IF EXISTS `news_post_tags`;
CREATE TABLE IF NOT EXISTS `news_post_tags` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `news_post_id` int UNSIGNED NOT NULL,
  `tag_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `news_post_tags_tag_id_foreign` (`tag_id`),
  KEY `news_post_id_tag_id` (`news_post_id`,`tag_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news_post_tags`
--

INSERT INTO `news_post_tags` (`id`, `news_post_id`, `tag_id`) VALUES
(9, 1, 1),
(10, 1, 2),
(8, 2, 4),
(7, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `news_post_thumbnails`
--

DROP TABLE IF EXISTS `news_post_thumbnails`;
CREATE TABLE IF NOT EXISTS `news_post_thumbnails` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `news_post_id` int UNSIGNED NOT NULL,
  `type` enum('link','image') COLLATE utf8mb4_general_ci NOT NULL,
  `thumbnail_url` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `news_post_thumbnails_news_post_id_foreign` (`news_post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news_post_thumbnails`
--

INSERT INTO `news_post_thumbnails` (`id`, `news_post_id`, `type`, `thumbnail_url`, `created_at`, `updated_at`) VALUES
(1, 1, 'link', 'https://puruliamirror.com/wp-content/uploads/2026/01/IMG-20260130-WA0008-1536x1152.jpg', '2026-01-30 14:43:03', '2026-01-30 14:43:03'),
(2, 2, 'image', 'http://localhost:8080/uploads/posts/thumbnails/01_26/1769785739_410d0bffb90a4c333984.webp', '2026-01-30 15:08:59', '2026-01-30 15:08:59');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `type` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'string',
  `context` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

DROP TABLE IF EXISTS `sub_categories`;
CREATE TABLE IF NOT EXISTS `sub_categories` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `cat_id` int NOT NULL,
  `sub_cat_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `sub_cat_slug` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sub_cat_slug` (`sub_cat_slug`),
  KEY `sub_categories_cat_id_foreign` (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `cat_id`, `sub_cat_name`, `sub_cat_slug`, `is_active`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 'ক্রিকেট', 'ক্রিকেট', 0, 1, '2026-01-30 07:49:33', '2026-01-31 07:52:20'),
(2, 5, 'ফুটবল', 'ফুটবল', 0, 1, '2026-01-30 07:49:58', '2026-01-31 07:52:15'),
(3, 5, 'অন্যান্য', 'অন্যান্য', 0, 1, '2026-01-30 07:50:15', '2026-01-31 07:52:13'),
(4, 7, 'বলিউড', 'বলিউড', 0, 1, '2026-01-30 07:51:29', '2026-01-30 07:51:29'),
(5, 7, 'টলিউড', 'টলিউড', 0, 1, '2026-01-30 07:51:44', '2026-01-30 07:51:44'),
(6, 7, 'হলিউড', 'হলিউড', 0, 1, '2026-01-30 07:51:56', '2026-01-30 07:51:56'),
(7, 3, 'রাজ্য রাজনীতি', 'রাজ্য-রাজনীতি', 0, 1, '2026-01-30 07:52:45', '2026-01-30 07:52:45'),
(8, 3, 'দেশের রাজনীতি', 'দেশের-রাজনীতি', 0, 1, '2026-01-30 07:53:01', '2026-01-30 07:53:01'),
(9, 3, 'ট্রাম্প', 'ট্রাম্প', 0, 1, '2026-01-30 07:53:15', '2026-01-31 07:37:39');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(1, 'শহীদ'),
(2, 'অহিংসা'),
(3, 'তাপমাত্রা'),
(4, 'শীত');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `last_active` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `status`, `status_message`, `active`, `last_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', NULL, NULL, 0, NULL, '2026-01-11 20:36:36', '2026-01-11 20:36:36', NULL),
(2, 'user', NULL, NULL, 0, NULL, '2026-01-11 20:48:31', '2026-01-11 20:48:31', NULL);

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

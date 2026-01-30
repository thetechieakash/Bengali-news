-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 30, 2026 at 07:31 AM
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
(1, 1, 'email_password', NULL, 'admin@example.com', '$2y$12$bIYZGzeWYnILOHUkn4hDyubP7HKRTo6FLLgOTi.iW3TQ9hFonx5k.', NULL, NULL, 0, '2026-01-30 06:38:37', '2026-01-11 20:36:36', '2026-01-30 06:38:37'),
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(15, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'email_password', 'admin@example.com', 1, '2026-01-30 06:38:38', 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat`, `slug`, `is_active`, `status`, `created_at`, `updated_at`) VALUES
(1, 'জাতীয়', 'জাতীয়', 1, 1, '2026-01-27 10:19:32', '2026-01-27 10:19:32'),
(2, 'আন্তর্জাতিক', 'আন্তর্জাতিক', 1, 1, '2026-01-27 10:19:32', '2026-01-27 10:19:32'),
(3, 'রাজনীতি', 'রাজনীতি', 1, 1, '2026-01-27 10:19:32', '2026-01-27 10:19:32'),
(4, 'অর্থনীতি', 'অর্থনীতি', 1, 1, '2026-01-27 10:19:32', '2026-01-27 10:19:32'),
(5, 'খেলা', 'খেলা', 1, 1, '2026-01-27 10:19:32', '2026-01-27 10:19:32'),
(6, 'বিনোদন', 'বিনোদন', 1, 1, '2026-01-27 10:19:32', '2026-01-27 10:19:32'),
(7, 'প্রযুক্তি', 'প্রযুক্তি', 1, 1, '2026-01-27 10:19:32', '2026-01-27 10:19:32'),
(8, 'স্বাস্থ্য', 'স্বাস্থ্য', 1, 1, '2026-01-27 10:19:32', '2026-01-27 10:19:32'),
(9, 'শিক্ষা', 'শিক্ষা', 1, 1, '2026-01-27 10:19:32', '2026-01-27 10:19:32');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `cat_id`, `sub_cat_name`, `sub_cat_slug`, `is_active`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'সারাদেশ', 'সারাদেশ', 1, 1, '2026-01-27 10:19:32', '2026-01-27 10:19:32'),
(2, 1, 'ঢাকা', 'ঢাকা', 1, 1, '2026-01-27 10:19:32', '2026-01-27 10:19:32'),
(3, 2, 'এশিয়া', 'এশিয়া', 1, 1, '2026-01-27 10:19:32', '2026-01-27 10:19:32'),
(4, 2, 'ইউরোপ', 'ইউরোপ', 1, 1, '2026-01-27 10:19:32', '2026-01-27 10:19:32'),
(5, 2, 'আমেরিকা', 'আমেরিকা', 1, 1, '2026-01-27 10:19:32', '2026-01-27 10:19:32'),
(6, 3, 'সরকার', 'সরকার', 1, 1, '2026-01-27 10:19:32', '2026-01-27 10:19:32'),
(7, 3, 'বিরোধী দল', 'দল', 1, 1, '2026-01-27 10:19:32', '2026-01-27 10:19:32'),
(8, 4, 'বাণিজ্য', 'বাণিজ্য', 1, 1, '2026-01-27 10:19:32', '2026-01-27 10:19:32'),
(9, 4, 'ব্যাংকিং', 'ব্যাংকিং', 1, 1, '2026-01-27 10:19:32', '2026-01-27 10:19:32'),
(10, 5, 'ক্রিকেট', 'ক্রিকেট', 1, 1, '2026-01-27 10:19:32', '2026-01-27 10:19:32'),
(11, 5, 'ফুটবল', 'ফুটবল', 1, 1, '2026-01-27 10:19:32', '2026-01-27 10:19:32'),
(12, 6, 'চলচ্চিত্র', 'চলচ্চিত্র', 1, 1, '2026-01-27 10:19:32', '2026-01-27 10:19:32'),
(13, 6, 'সঙ্গীত', 'সঙ্গীত', 1, 1, '2026-01-27 10:19:32', '2026-01-27 10:19:32'),
(14, 7, 'মোবাইল', 'মোবাইল', 1, 1, '2026-01-27 10:19:32', '2026-01-27 10:19:32'),
(15, 7, 'ইন্টারনেট', 'ইন্টারনেট', 1, 1, '2026-01-27 10:19:32', '2026-01-27 10:19:32'),
(16, 8, 'চিকিৎসা', 'চিকিৎসা', 1, 1, '2026-01-27 10:19:32', '2026-01-27 10:19:32'),
(17, 8, 'পুষ্টি', 'পুষ্টি', 1, 1, '2026-01-27 10:19:32', '2026-01-27 10:19:32'),
(18, 9, 'বিদ্যালয়', 'বিদ্যালয়', 1, 1, '2026-01-27 10:19:32', '2026-01-27 10:19:32'),
(19, 9, 'বিশ্ববিদ্যালয়', 'বিশ্ববিদ্যালয়', 1, 1, '2026-01-27 10:19:32', '2026-01-27 10:19:32');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

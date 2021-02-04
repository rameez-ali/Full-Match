-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 04, 2021 at 07:56 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `full_match_sq_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `abilities`
--

CREATE TABLE `abilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entity_id` bigint(20) UNSIGNED DEFAULT NULL,
  `entity_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `only_owned` tinyint(1) NOT NULL DEFAULT '0',
  `options` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `scope` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abilities`
--

INSERT INTO `abilities` (`id`, `name`, `title`, `entity_id`, `entity_type`, `only_owned`, `options`, `scope`, `created_at`, `updated_at`) VALUES
(1, 'view-dashboard', 'View Dashboard', NULL, NULL, 0, NULL, NULL, NULL, NULL),
(2, 'add-customer', 'Add Customer', NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3, 'edit-customer', 'Edit Customer', NULL, NULL, 0, NULL, NULL, NULL, NULL),
(4, 'view-customer', 'View Customer', NULL, NULL, 0, NULL, NULL, NULL, NULL),
(5, 'delete-customer', 'Delete Customer', NULL, NULL, 0, NULL, NULL, NULL, NULL),
(6, 'view-cmspage', 'View CMSpage', NULL, NULL, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `adv_banners`
--

CREATE TABLE `adv_banners` (
  `id` int(11) NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_ar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `genre_id` int(11) DEFAULT NULL,
  `homepage` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `adv_banner_videos`
--

CREATE TABLE `adv_banner_videos` (
  `id` int(11) NOT NULL,
  `video_id` int(11) DEFAULT NULL,
  `banner_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assigned_roles`
--

CREATE TABLE `assigned_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `entity_id` bigint(20) UNSIGNED NOT NULL,
  `entity_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `restricted_to_id` bigint(20) UNSIGNED DEFAULT NULL,
  `restricted_to_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scope` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assigned_roles`
--

INSERT INTO `assigned_roles` (`id`, `role_id`, `entity_id`, `entity_type`, `restricted_to_id`, `restricted_to_type`, `scope`) VALUES
(1, 4, 32, 'App\\User', NULL, NULL, NULL),
(2, 5, 34, 'App\\User', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_sorting` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name_en`, `name_ar`, `category_image`, `category_sorting`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'category 1', 'صنف 1', '1119856141.png', 1, '2021-01-25 12:47:52', '2021-01-25 12:47:52', NULL),
(3, 'category 2', 'صنف 2', '1901268373.png', 2, '2021-01-25 12:48:24', '2021-01-25 12:48:24', NULL),
(4, 'category 4', 'صنف 4', '1712318314.png', 4, '2021-01-25 12:49:05', '2021-01-25 12:50:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_genres`
--

CREATE TABLE `category_genres` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `genre_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_genres`
--

INSERT INTO `category_genres` (`id`, `category_id`, `genre_id`, `updated_at`, `created_at`) VALUES
(1, 1, 1, '2021-01-22 11:11:16', '2021-01-22 11:11:16'),
(2, 2, 2, '2021-01-22 11:11:32', '2021-01-22 11:11:32'),
(3, 3, 1, '2021-01-22 11:11:55', '2021-01-22 11:11:55'),
(4, 3, 2, '2021-01-22 11:11:55', '2021-01-22 11:11:55');

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `id` int(11) NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `club_banner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `club_logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `club_sorting` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`id`, `name_en`, `name_ar`, `club_banner`, `club_logo`, `description_en`, `description_ar`, `club_sorting`, `updated_at`, `created_at`, `deleted_at`) VALUES
(1, 'club 1', 'صنف 1', '1951322905.png', '1900466457.png', 'its club 1', 'صنف 1', 1, '2021-01-25 12:54:52', '2021-01-25 12:54:52', NULL),
(2, 'club 2', 'صنف 2', '1004740900.png', '162905907.png', 'its club 2', 'صنف 2', 2, '2021-01-25 12:55:36', '2021-01-25 12:55:36', NULL),
(3, 'club 4', 'صنف 4', '226278477.png', '553398990.png', 'its club 4', 'صنف 4', 4, '2021-01-25 12:57:42', '2021-01-25 12:56:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `response` int(11) NOT NULL DEFAULT '0',
  `response_message` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `message`, `status`, `response`, `response_message`, `created_at`, `updated_at`) VALUES
(1, 'rameez', 'rameez@gmail.com', 'hello', 1, 1, 'hey', '2021-01-12 06:32:23', '2021-01-21 02:35:18'),
(2, 'test1', 'test1@gmail.com', 'solved my issue', 1, 1, 'We will let you know', '2021-01-21 04:47:00', '2021-01-21 06:54:57'),
(3, 'saeed', 'abc@gmail.com', 'abc', 0, 0, NULL, '2021-01-22 07:34:52', '2021-01-22 07:34:52'),
(4, 'saeed', 'abc@gmail.com', 'abc', 0, 0, NULL, '2021-01-22 07:39:27', '2021-01-22 07:39:27'),
(5, 'name', 'phone', 'message', 0, 0, NULL, '2021-01-22 09:28:34', '2021-01-22 09:28:34'),
(6, 'name', 'phone', 'message', 0, 0, NULL, '2021-01-22 09:30:20', '2021-01-22 09:30:20'),
(7, 'name', 'phone', 'message', 0, 0, NULL, '2021-01-22 09:31:55', '2021-01-22 09:31:55'),
(8, 'name', 'phone', 'message', 0, 0, NULL, '2021-01-22 09:34:47', '2021-01-22 09:34:47'),
(9, 'name', 'phone', 'message', 0, 0, NULL, '2021-01-22 09:36:52', '2021-01-22 09:36:52'),
(10, 'name', 'phone', 'message', 0, 0, NULL, '2021-01-22 09:37:17', '2021-01-22 09:37:17'),
(11, 'name', 'phone', 'message', 0, 0, NULL, '2021-01-22 09:38:33', '2021-01-22 09:38:33'),
(12, 'name', 'phone', 'message', 0, 0, NULL, '2021-01-22 09:45:05', '2021-01-22 09:45:05'),
(13, 'name', 'phone', 'message', 0, 0, NULL, '2021-01-22 09:47:59', '2021-01-22 09:47:59'),
(14, 'name', 'phone', 'message', 0, 0, NULL, '2021-01-22 09:51:06', '2021-01-22 09:51:06'),
(15, 'saeed', 'abc@gmail.com', 'abc', 0, 0, NULL, '2021-01-22 10:10:08', '2021-01-22 10:10:08'),
(16, 'name', 'phone', 'message', 0, 0, NULL, '2021-01-22 10:51:30', '2021-01-22 10:51:30'),
(17, 'name', 'email', 'message', 0, 0, NULL, '2021-01-22 11:06:54', '2021-01-22 11:06:54'),
(18, 'name', 'email', 'message', 0, 0, NULL, '2021-01-22 11:13:53', '2021-01-22 11:13:53'),
(19, 'name', 'email', 'message', 0, 0, NULL, '2021-01-22 11:14:30', '2021-01-22 11:14:30'),
(20, 'saeed', 'abc@gmail.com', 'abc', 0, 0, NULL, '2021-01-22 11:39:53', '2021-01-22 11:39:53'),
(21, 'saeed', 'abc@gmail.com', 'abc', 0, 0, NULL, '2021-01-22 11:53:13', '2021-01-22 11:53:13'),
(22, 'saeed', 'abc@gmail.com', 'abc', 0, 0, NULL, '2021-01-22 11:56:41', '2021-01-22 11:56:41'),
(23, 'saeed', 'abc@gmail.com', 'abc', 0, 0, NULL, '2021-01-22 11:58:29', '2021-01-22 11:58:29'),
(24, 'hamza abilal', 'hamzabilal@gmail.com', 'hi hello', 0, 0, NULL, '2021-01-22 12:07:04', '2021-01-22 12:07:04'),
(25, 'hamxa', 'hamzabilalgaya.bilal@gmail.com', 'hello hi bye', 0, 0, NULL, '2021-01-22 12:25:59', '2021-01-22 12:25:59'),
(26, 'saeed', 'abc@gmail.com', 'abc', 0, 0, NULL, '2021-01-23 03:05:53', '2021-01-23 03:05:53'),
(27, 'saeed', 'abc@gmail.com', 'bc ikwwjkbw kj jw a', 0, 0, NULL, '2021-01-23 03:06:23', '2021-01-23 03:06:23'),
(28, 'saeed', 'abc@gmail.com', 'bc ikwwjkbw kj jw a', 0, 0, NULL, '2021-01-23 03:35:01', '2021-01-23 03:35:01'),
(29, 'saeed', 'abc@gmail.com', 'bc ikwwjkbw kj jw a', 0, 0, NULL, '2021-01-23 03:35:38', '2021-01-23 03:35:38'),
(30, 'saeed', 'abc@gmail.com', 'bc ikwwjkbw kj jw a', 0, 0, NULL, '2021-01-23 03:55:12', '2021-01-23 03:55:12');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` int(11) NOT NULL,
  `customer_email` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `read` tinyint(4) NOT NULL DEFAULT '1',
  `mesg_date` time NOT NULL,
  `lang` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` char(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notify_status` tinyint(2) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `user_image`, `user_id`, `notify_status`, `created_at`, `updated_at`) VALUES
(2, 'test 1', 'test1@test.com', NULL, '2', 1, '2020-12-22 03:51:46', '2020-12-22 03:51:46'),
(3, 'test 2ok', 'test2@test.com', NULL, '3', 1, '2020-12-22 04:47:55', '2020-12-28 03:59:02'),
(4, 'cust 2', 'cust2test@test.com', NULL, '6', 1, '2020-12-26 07:37:19', '2020-12-28 03:56:54'),
(5, 'cust 3 ok', 'cust3test@test.com', NULL, '7', 1, '2020-12-26 07:38:50', '2020-12-28 03:25:35'),
(6, 'cust 4', 'cust4test@test.com', 'avatarDp/PTBZipEbPPgzuSRkNYZoxJIS0Hx3AORQyAlw94TN.jpeg', '8', 1, '2020-12-28 03:43:13', '2021-01-05 03:19:12'),
(7, 'cust 5oo', 'cust5test@test.com', NULL, '9', 1, '2020-12-28 03:44:39', '2020-12-28 03:52:46'),
(8, 'ABC', 'abc@yopmail.com', NULL, '10', 1, '2021-01-09 10:19:15', '2021-01-09 10:19:15'),
(9, 'rameez', 'rameez@fullmatch.com', NULL, '11', 1, '2021-01-11 04:00:31', '2021-01-11 04:00:31'),
(10, 'Raza', 'test@yopmail.com', 'avatarDp/5SkfJL0PZv1gAhibYpLtr1nYfXtPGB4ImbirA0Ap.jpeg', '12', 1, '2021-01-12 07:32:10', '2021-01-13 08:01:32'),
(11, 'sofiarae', 'sajepet134@sofiarae.com', NULL, '13', 1, '2021-01-13 03:50:03', '2021-01-13 03:50:03'),
(12, 'googogo', 'hewodef460@majorsww.com', NULL, '14', 1, '2021-01-13 03:51:07', '2021-01-13 03:51:07'),
(13, 'Test', 'tset@yopmail.com', 'avatarDp/DrHbJMX7jOSNkKyuvRGmDs8MshYHf6CoiqfUb0it.png', '15', 1, '2021-01-18 08:42:34', '2021-01-19 10:16:15'),
(14, 'saeed', 'saeed@gmail.com', NULL, '16', 1, '2021-01-20 07:34:51', '2021-01-20 07:34:51'),
(15, 'saeed1', 'saeed1@gmail.com', NULL, '17', 1, '2021-01-20 07:36:00', '2021-01-20 07:36:00'),
(16, 'saeed okk', 'apitest8@gmail.com', 'storage/app/public/avatarDp/jg8b1SW6100NFar0kbRHj1CriEVGXLanpKQt7xha.png', '18', 0, '2021-01-20 07:39:38', '2021-01-27 01:09:33'),
(17, 'test 12', 'test12@test.com', 'storage/app/public/avatarDp/plgaZXd5PJAYmkEPhDDY7EvnyVoVF2EwGMoQjOtC.jpg', '19', 1, '2021-01-21 07:48:05', '2021-01-21 07:53:19'),
(18, 'mybot1', 'mybot1@gmail.com', NULL, '20', 1, '2021-01-22 08:55:44', '2021-01-22 08:55:44'),
(19, 'saeed', 'saeed12@gmail.com', NULL, '21', 1, '2021-01-22 10:04:35', '2021-01-22 10:04:35'),
(20, 'mybot1', 'mybot2@gmail.com', NULL, '22', 1, '2021-01-25 01:15:13', '2021-01-25 01:15:13'),
(21, 'mybot1', 'mybot3@gmail.com', NULL, '23', 1, '2021-01-25 01:15:55', '2021-01-25 01:15:55'),
(22, 'mybot4', 'mybot4@gmail.com', NULL, '24', 1, '2021-01-25 01:36:22', '2021-01-25 01:36:22'),
(23, 'mybot4', 'mybot5@gmail.com', NULL, '26', 1, '2021-01-25 05:37:13', '2021-01-25 05:37:13'),
(24, 'mybot4', 'mybot9@gmail.com', NULL, '30', 1, '2021-01-26 03:31:35', '2021-01-26 03:31:35'),
(25, 'khan', 'apitest88@gmail.com', NULL, '31', 1, '2021-02-01 07:41:43', '2021-02-01 07:41:43');

-- --------------------------------------------------------

--
-- Table structure for table `device_tokens`
--

CREATE TABLE `device_tokens` (
  `id` int(100) NOT NULL,
  `user_id` int(100) DEFAULT NULL,
  `device` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `device_tokens`
--

INSERT INTO `device_tokens` (`id`, `user_id`, `device`, `token`, `updated_at`) VALUES
(1, 3, 'android', 'dxuqnM-6R8yOpK-424kgqj:APA91bGuJBmsJOVRpvfEu8Z7iqhNhfKt1qMTA0gq5ifP9j2aYB18I_WfEoVswL_7k3Ig85iURAaFNsoa83C1NtF0L05hm_VqCQf2TVO0su3cob8uLFpGsi_8Y5GhPFdAbuQYDuJgzTAZ', '2021-01-13 19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fullmatchcontacts`
--

CREATE TABLE `fullmatchcontacts` (
  `id` int(11) NOT NULL,
  `call_us` text NOT NULL,
  `address_en` text NOT NULL,
  `address_ar` varchar(255) NOT NULL,
  `email_us` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `fullmatchcontacts`
--

INSERT INTO `fullmatchcontacts` (`id`, `call_us`, `address_en`, `address_ar`, `email_us`, `created_at`, `updated_at`) VALUES
(1, '768796897899', '119 main street kuwait en', '119 main street kuwait ar', 'fullmatch@fullmatch.com', '2021-01-29 12:40:06', '2021-01-29 07:45:09');

-- --------------------------------------------------------

--
-- Table structure for table `homepages`
--

CREATE TABLE `homepages` (
  `id` int(11) NOT NULL,
  `homepage` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homepages`
--

INSERT INTO `homepages` (`id`, `homepage`, `status`) VALUES
(1, 1, 'Yes'),
(2, 0, 'No');

-- --------------------------------------------------------

--
-- Table structure for table `home_page_managements`
--

CREATE TABLE `home_page_managements` (
  `id` int(11) NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home_page_managements`
--

INSERT INTO `home_page_managements` (`id`, `name`, `status`) VALUES
(1, 'test1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `home_pg_items`
--

CREATE TABLE `home_pg_items` (
  `id` int(11) NOT NULL,
  `section_id` int(200) NOT NULL,
  `item_name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `item_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home_pg_items`
--

INSERT INTO `home_pg_items` (`id`, `section_id`, `item_name`, `item_id`) VALUES
(47, 1, 'league', 1),
(48, 1, 'league', 2),
(49, 1, 'players', 1),
(50, 1, 'players', 2),
(51, 1, 'clubs', 2),
(52, 1, 'videos', 5),
(53, 1, 'videos', 7);

-- --------------------------------------------------------

--
-- Table structure for table `leaguecategories`
--

CREATE TABLE `leaguecategories` (
  `id` int(11) NOT NULL,
  `video_id` int(11) DEFAULT NULL,
  `league_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leagues`
--

CREATE TABLE `leagues` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `league_banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `league_promo_video` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `league_profile_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `league_sorting` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leagues`
--

INSERT INTO `leagues` (`id`, `category_id`, `name_en`, `name_ar`, `league_banner`, `league_promo_video`, `league_profile_image`, `description_en`, `description_ar`, `league_sorting`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'league 2', 'صنف 2', '1881829020.png', 'https://www.youtube.com/', '1779495054.png', 'its league 2', 'صنف 1', NULL, '2021-01-25 12:59:34', '2021-02-02 10:46:51', NULL),
(2, NULL, 'test3 en', 'test3 ar', '1234231363.jpg', 'https://www.youtube.com/', '848269815.jpg', 'asdf', 'asdf', NULL, '2021-02-02 12:17:06', '2021-02-02 12:17:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(100, '2014_10_12_000000_create_users_table', 1),
(101, '2014_10_12_100000_create_password_resets_table', 1),
(102, '2019_08_19_000000_create_failed_jobs_table', 1),
(103, '2020_10_12_131213_create_clubs_table', 1),
(104, '2020_10_12_133458_create_players_table', 1),
(105, '2020_10_12_133524_create_video_categories_table', 1),
(106, '2020_10_12_133606_create_banner_slides_table', 1),
(107, '2020_10_12_135934_create_video_genres_table', 1),
(108, '2020_10_12_140147_create_leagues_table', 1),
(109, '2020_10_12_140729_create_seasons_table', 1),
(110, '2020_10_12_142043_create_videos_table', 1),
(111, '2020_10_12_143129_create_subs_plans_table', 1),
(112, '2020_10_12_143916_create_adv_banners_table', 1),
(113, '2020_10_12_144303_create_notifications_table', 1),
(114, '2020_10_12_144818_create_contact_messages_table', 1),
(115, '2020_10_12_145207_create_my_wish_lists_table', 1),
(116, '2020_10_12_150141_create_promo_codes_table', 1),
(117, '2020_10_13_052441_create_user_roles_table', 1),
(118, '2020_12_15_063440_create_bouncer_tables', 1),
(119, '2020_12_18_135356_create_customers_table', 1),
(120, '2020_12_29_211153_add_deleted_at_to_projeccategories_table', 2),
(122, '2020_12_29_211823_add_deleted_at_to_clubs_table', 3),
(123, '2020_12_29_211839_add_deleted_at_to_players_table', 3),
(124, '2020_12_29_211904_add_deleted_at_to_videos_table', 3),
(125, '2020_12_29_211743_add_deleted_at_to_leagues_table', 4),
(130, '2020_12_29_215748_add_deleted_at_to_seasons_table', 5),
(131, '2016_06_01_000001_create_oauth_auth_codes_table', 6),
(132, '2016_06_01_000002_create_oauth_access_tokens_table', 6),
(133, '2016_06_01_000003_create_oauth_refresh_tokens_table', 6),
(134, '2016_06_01_000004_create_oauth_clients_table', 6),
(135, '2016_06_01_000005_create_oauth_personal_access_clients_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `my_wish_lists`
--

CREATE TABLE `my_wish_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `video_id` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `lang` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `my_wish_lists`
--

INSERT INTO `my_wish_lists` (`id`, `user_id`, `video_id`, `status`, `lang`, `created_at`, `updated_at`) VALUES
(1, 3, 5, 1, 'en', '2021-01-26 19:00:00', '2021-01-26 19:00:00'),
(5, 18, 6, 1, 'en', '2021-01-28 01:47:38', '2021-01-28 01:47:38'),
(6, 18, 7, 1, 'en', '2021-01-28 01:47:44', '2021-01-28 01:47:44');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `notify_title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notify_title_ar` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notify_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notify_text_ar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `notify_type` tinyint(4) NOT NULL,
  `notify_datetime` time DEFAULT NULL,
  `lang` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `notify_title`, `notify_title_ar`, `notify_text`, `notify_text_ar`, `notify_type`, `notify_datetime`, `lang`, `created_at`, `updated_at`) VALUES
(1, 'First notification', NULL, 'This is first notification', NULL, 2, NULL, 'en', '2021-01-12 19:00:00', '2021-01-21 08:39:22'),
(2, 'Test Notification', NULL, 'Hello Everyone!', NULL, 2, NULL, 'en', '2021-01-14 01:55:32', '2021-01-15 08:41:15'),
(3, 'dddd', NULL, 'asdsaddd', NULL, 1, NULL, 'en', '2021-01-14 02:33:44', '2021-01-14 02:33:44'),
(4, 'adsasd', NULL, 'asdasddd', NULL, 3, NULL, 'en', '2021-01-14 02:35:30', '2021-01-15 08:41:24'),
(5, 'title en ok', 'title ar ok', 'desc en ok', 'desc ar ok', 3, NULL, 'en', '2021-01-23 07:16:40', '2021-01-23 07:17:48');

-- --------------------------------------------------------

--
-- Table structure for table `notify_users`
--

CREATE TABLE `notify_users` (
  `id` int(11) NOT NULL,
  `notify_user` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notify_users`
--

INSERT INTO `notify_users` (`id`, `notify_user`, `status`) VALUES
(1, 1, 'Yes'),
(2, 0, 'No');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('19108d69aff279f4b701141309f781051b541630284b53b7d2c203bf9267743213f7da5264e075e9', 18, 1, 'Personal Access Token', '[]', 0, '2021-01-26 03:23:59', '2021-01-26 03:23:59', '2022-01-26 08:23:59'),
('2057d083730befe0131a70127ebdbc67e2787579e99a41892f667a1f68aefd4389008657ad31b580', 18, 1, 'Personal Access Token', '[]', 0, '2021-01-28 05:19:50', '2021-01-28 05:19:50', '2022-01-28 10:19:50'),
('4485c2c5041292f3318039cf588c0f03d45ec40a4b57f94d7e9a0b2df5d3d5af783f51aa2ee25e37', 31, 1, 'Personal Access Token', '[]', 0, '2021-02-01 07:41:43', '2021-02-01 07:41:43', '2022-02-01 12:41:43'),
('45c3681ee3617a1ca336b820bccf4f2ce01638418f5df25408b3c6975e2f8fc2d01d77bfb1f2d575', 18, 1, 'Personal Access Token', '[]', 0, '2021-01-28 05:15:48', '2021-01-28 05:15:48', '2022-01-28 10:15:48'),
('59c4043ad0076189fb0fc107c9f016acc21ccb8f07f3ca186b3749cdb623c7570163e43262595ec5', 18, 1, 'Personal Access Token', '[]', 0, '2021-01-27 01:08:10', '2021-01-27 01:08:10', '2022-01-27 06:08:10'),
('6c2b63e8094a145e67c75b86b3233f4e36b48298641b1568af85c61123292f192e81b2b582303456', 18, 1, 'Personal Access Token', '[]', 0, '2021-01-29 06:41:22', '2021-01-29 06:41:22', '2022-01-29 11:41:22'),
('7b7b2d67a166445ba388320ca66a81fed18e89c5e9a03252836cf700fed4497af262146834911874', 18, 1, 'Personal Access Token', '[]', 0, '2021-02-01 06:45:36', '2021-02-01 06:45:36', '2022-02-01 11:45:36'),
('86f57869e6eeb5f65de189c5531d843de105a04f6153fba8e5e8dc4a1d5ce3629d72f7cfda95cb01', 18, 1, 'Personal Access Token', '[]', 0, '2021-02-01 06:32:05', '2021-02-01 06:32:05', '2022-02-01 11:32:05'),
('8b5e957d0095c5ef50bdfbadf757cc760c13ed4d880841bb3b066e6a0c97d8695bf261e59841b048', 18, 1, 'Personal Access Token', '[]', 0, '2021-02-01 06:20:23', '2021-02-01 06:20:23', '2022-02-01 11:20:23'),
('b87eb1f4194d9fb1f7dadef49c1cb6309c1286f632b16550b074d658e256407fb4b9279c10478a59', 18, 1, 'Personal Access Token', '[]', 1, '2021-01-26 06:54:00', '2021-01-26 06:54:00', '2022-01-26 11:54:00'),
('bb9f2a4dd3894a37d82bd15c58877409799659d169d0825c3f90aba3d1f92ad01ef3d80d1987e8ed', 18, 1, 'Personal Access Token', '[]', 0, '2021-02-01 06:29:46', '2021-02-01 06:29:46', '2022-02-01 11:29:46'),
('c89b6e57a1224c3b600e0b5c0ac63a1b9b071e091827ae696be1b18a3de8d85fd99976538343c3d5', 18, 1, 'Personal Access Token', '[]', 0, '2021-01-26 03:22:14', '2021-01-26 03:22:14', '2022-01-26 08:22:14'),
('db4b8b2c31ff520ff57347418b68c3d4431dab003cd6e63c4e5b6181fe85d5a4ecb517f95e0e1996', 18, 1, 'Personal Access Token', '[]', 0, '2021-01-22 09:51:34', '2021-01-22 09:51:34', '2022-01-22 12:51:34'),
('df9f2767087c951f67351ab84e33743946438981b603ed9be286105737ba4ed8f4859d1edb6e8660', 18, 1, 'Personal Access Token', '[]', 0, '2021-01-26 03:24:23', '2021-01-26 03:24:23', '2022-01-26 08:24:23'),
('f708a8bdf1dba5fc4359390126b2a975089a42b46970c3100f31992ac19f70195a34ba36dcb49c15', 18, 1, 'Personal Access Token', '[]', 0, '2021-01-28 05:16:16', '2021-01-28 05:16:16', '2022-01-28 10:16:16'),
('fa7e99d96847598019ed8c960ec0d4a7f2159f7b9cb124201a95d0736ae1b1ac3793ee8c9dbba7f3', 18, 1, 'Personal Access Token', '[]', 0, '2021-01-26 03:13:34', '2021-01-26 03:13:34', '2022-01-26 08:13:34'),
('ff87190a4e1f22dd3f0161ce37665ae05c9781e24284bb3f37a8b904e33560995701db2e15af8f99', 18, 1, 'Personal Access Token', '[]', 0, '2021-01-26 03:17:37', '2021-01-26 03:17:37', '2022-01-26 08:17:37');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', '022qvIDa2orbyFS0hrXCi0XGMnmHR2V3UPOyclJS', NULL, 'http://localhost', 1, 0, 0, '2021-01-22 09:41:55', '2021-01-22 09:41:55'),
(2, NULL, 'Laravel Password Grant Client', 'DuINQJKyTu6ivdPRuZyrq5P733t4HCkeFhG4qKSa', 'users', 'http://localhost', 0, 1, 0, '2021-01-22 09:41:55', '2021-01-22 09:41:55');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-01-22 09:41:55', '2021-01-22 09:41:55');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `user_email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `user_mobile` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `subtotal` decimal(18,3) DEFAULT NULL,
  `total` decimal(18,3) DEFAULT NULL,
  `discount` decimal(18,3) DEFAULT NULL,
  `order_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `order_time` time DEFAULT NULL,
  `payment_reference` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  `tap_response` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_name`, `user_email`, `user_mobile`, `subtotal`, `total`, `discount`, `order_number`, `order_date`, `order_time`, `payment_reference`, `payment_status`, `code`, `discount_id`, `tap_response`) VALUES
(1, 'osama', 'osama@gmail.com', '12345678', '10.000', '10.000', '0.000', 'FM00001', '2021-01-01', '05:05:00', '1718201301114471415', 'Captured', NULL, NULL, 'response');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content_ar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `active` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `content`, `content_ar`, `active`) VALUES
(1, 'Privacy Policy', 'terms kk', 'privacyyyyyyyyyyyyyyy', NULL, 1),
(2, 'About FullMatch', 'about-fm', 'Full match Testing', 'Testing AR', 1),
(3, 'Terms and Conditions', 'slug 3', 'testinggggg', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('hewodef460@majorsww.com', '$2y$10$kyosJl.k38YV36n9q/7LE.KNf/amyJAJ/uwAskB4AZsq2fMXwCkmu', '2021-01-13 05:38:24'),
('test@yopmail.com', '$2y$10$gExfkjVnTi1SjXVrJAroneQlC/NhW/1xV3FVOVo03twqtwC.r7sdG', '2021-01-18 08:33:22'),
('apitest8@gmail.com', '$2y$10$EU9Z5QEn7s3p.2i4fWaHQua5v23MLqtJMGPjTIkrA7Sh.pTHRwMkq', '2021-01-21 05:29:29'),
('test12@test.com', '$2y$10$.ZTHDoIzHrarOLYK7zkuhOgk8Nfz1uZg8A50IJ71QOZPAdyuUlM5K', '2021-01-21 08:00:28'),
('tset@yopmail.com', '$2y$10$tA9iVuomUGtGHjE5OGQ0t.j3nfMEDu5SQxn/sjsXI0y1iCHTaluJK', '2021-01-21 08:00:37'),
('abc@yopmail.com', '$2y$10$3lKc.j85veta4qQz13M.ZeZcMc9WJDIL/.nT4HfaE4.aJDoNtKFdW', '2021-01-22 02:57:42'),
('test2@test.com', '$2y$10$TWr74Nmdkaq15O0f8L02POYLrJs48nN19mZDQYaxsQHvICx9hK/bS', '2021-01-29 05:06:10'),
('cust4test@test.com', '$2y$10$9l59yD3L3zhEoY9eQNgFw.j1fT/P506WoPvhn.Ovv0sStrFHbsun.', '2021-01-29 05:31:10');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ability_id` bigint(20) UNSIGNED NOT NULL,
  `entity_id` bigint(20) UNSIGNED DEFAULT NULL,
  `entity_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `forbidden` tinyint(1) NOT NULL DEFAULT '0',
  `scope` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `ability_id`, `entity_id`, `entity_type`, `forbidden`, `scope`) VALUES
(4, 1, 3, 'roles', 0, NULL),
(5, 2, 3, 'roles', 0, NULL),
(6, 4, 3, 'roles', 0, NULL),
(7, 1, 4, 'roles', 0, NULL),
(8, 2, 4, 'roles', 0, NULL),
(9, 3, 4, 'roles', 0, NULL),
(10, 4, 4, 'roles', 0, NULL),
(11, 5, 4, 'roles', 0, NULL),
(12, 1, 5, 'roles', 0, NULL),
(13, 2, 5, 'roles', 0, NULL),
(14, 3, 5, 'roles', 0, NULL),
(15, 4, 5, 'roles', 0, NULL),
(16, 5, 5, 'roles', 0, NULL),
(17, 6, 5, 'roles', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `player_banner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `player_profile_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `player_sorting` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `name_en`, `name_ar`, `player_banner`, `player_profile_image`, `description_en`, `description_ar`, `player_sorting`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'player 1', 'صنف 1', '1509325407.png', '1166920873.png', 'its player 1', 'صنف 1', 1, '2021-01-25 07:51:16', '2021-01-25 07:51:16', NULL),
(2, 'player 2', 'صنف 2', '1253714646.png', '297928324.png', 'its player 2', 'صنف 2', 2, '2021-01-25 07:51:53', '2021-01-25 07:51:53', NULL),
(3, 'player 4', 'صنف 4', '1906941773.png', '1166918968.png', 'its player 4', 'صنف 4', 4, '2021-01-25 07:52:48', '2021-01-25 07:54:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `popular_searches`
--

CREATE TABLE `popular_searches` (
  `id` int(11) NOT NULL,
  `popular_searches` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `popular_searches`
--

INSERT INTO `popular_searches` (`id`, `popular_searches`, `status`) VALUES
(1, 0, 'No'),
(2, 1, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `promo_codes`
--

CREATE TABLE `promo_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `num_usage` int(11) NOT NULL,
  `remain_usage` int(11) DEFAULT NULL,
  `per_user_can_use` int(11) DEFAULT NULL,
  `individual_user_can_use` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `lang` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promo_codes`
--

INSERT INTO `promo_codes` (`id`, `title`, `type`, `code`, `value`, `start_date`, `end_date`, `num_usage`, `remain_usage`, `per_user_can_use`, `individual_user_can_use`, `status`, `deleted_at`, `lang`, `created_at`, `updated_at`) VALUES
(1, 'Testt', 'fixed', 'NqWjZI5Q', 4, '2021-01-08', '2021-01-16', 3, 2, 3, 10, 1, NULL, 'en', '2021-01-05 19:00:00', '2021-01-21 09:23:25'),
(3, 'discount Title test 2', 'percentage', 'AzILhfeR', 12, '2021-01-08', '2021-01-09', 1, NULL, 2, 3, 0, '2021-01-08 06:01:02', 'en', '2021-01-08 02:49:20', '2021-01-08 06:01:02'),
(4, 'asdff', 'fixed', 'vjbOcau3', 1, '2021-01-08', '2021-01-09', 1, NULL, 1, 0, 1, NULL, 'en', '2021-01-08 06:17:11', '2021-01-08 08:34:42'),
(5, 'doneee', 'fixed', 'vjbOcau3', 1, '2021-01-08', '2021-01-09', 1, NULL, 1, 0, 1, NULL, 'en', '2021-01-08 06:17:41', '2021-01-08 08:34:51'),
(6, 'discount Title', 'fixed', 'Wyzua5k2', 0, '2021-01-08', '2021-01-09', 1, NULL, 1, 3, 1, '2021-01-08 08:34:57', 'en', '2021-01-08 08:27:11', '2021-01-08 08:34:57'),
(7, 'Promo-1', 'percentage', 'q3yshD0b', 10, '2021-01-16', '2021-01-31', 5, NULL, 1, 0, 1, NULL, 'en', '2021-01-15 08:56:08', '2021-01-15 08:56:08');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` int(10) UNSIGNED DEFAULT NULL,
  `scope` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `title`, `level`, `scope`, `created_at`, `updated_at`) VALUES
(3, 'test 3', 'title 3', NULL, NULL, '2021-02-03 06:04:27', '2021-02-03 06:04:27'),
(4, 'test 4', 'title 4', NULL, NULL, '2021-02-03 08:00:04', '2021-02-03 08:00:04'),
(5, 'Admin', 'Admin', NULL, NULL, '2021-02-04 01:59:29', '2021-02-04 01:59:29');

-- --------------------------------------------------------

--
-- Table structure for table `seasons`
--

CREATE TABLE `seasons` (
  `id` int(11) NOT NULL,
  `league_id` int(11) DEFAULT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seasons`
--

INSERT INTO `seasons` (`id`, `league_id`, `name_en`, `Video`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, 4, 'Season1', 'https://www.youtube.com/', '2021-01-26 06:31:04', '2021-01-26 06:31:04', NULL),
(13, 2, 'Season1', 'https://www.youtube.com/', '2021-02-02 12:17:06', '2021-02-02 12:17:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slider_sorting` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `category_id`, `name_en`, `name_ar`, `slider_sorting`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, NULL, 'slider home', 'slider home', 1, '2021-01-25 08:53:33', '2021-01-25 09:00:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `slidervideos`
--

CREATE TABLE `slidervideos` (
  `id` int(11) NOT NULL,
  `Video_id` int(11) DEFAULT NULL,
  `Slider_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'sindh', 1, NULL, NULL),
(2, 'balochistan', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subs_plans`
--

CREATE TABLE `subs_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plan_title` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_title_ar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_Description_ar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `plan_price` decimal(8,2) NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `duration_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration_value` int(50) DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `sort_by` bigint(20) NOT NULL,
  `notify` tinyint(4) NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `lang` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subs_plans`
--

INSERT INTO `subs_plans` (`id`, `plan_title`, `plan_title_ar`, `plan_Description`, `plan_Description_ar`, `plan_price`, `start_date`, `duration_type`, `duration_value`, `end_date`, `sort_by`, `notify`, `status`, `deleted_at`, `lang`, `created_at`, `updated_at`) VALUES
(1, 'plan title11', NULL, 'Description*', NULL, '123.00', '2020-12-29 00:00:00', 'week', 3, '2020-12-31 00:00:00', 1, 1, 1, NULL, 'en', '2020-12-30 01:05:24', '2021-01-22 03:41:56'),
(2, 'plan title ok', NULL, 'plan title ok', NULL, '333.00', '2020-12-29 00:00:00', NULL, NULL, '2020-12-31 00:00:00', 1, 1, 1, '2020-12-31 06:09:53', 'en', '2020-12-30 01:06:19', '2020-12-31 06:09:53'),
(3, 'plan title 2', NULL, 'plan title 2', NULL, '1222.00', '2020-12-29 00:00:00', NULL, NULL, '2020-12-31 00:00:00', 2, 1, 1, '2020-12-30 04:53:56', 'en', '2020-12-30 01:54:18', '2020-12-30 04:53:56'),
(4, 'plan title 3', NULL, 'des3', NULL, '332232.00', '2020-12-29 00:00:00', NULL, NULL, '2020-12-30 00:00:00', 1, 1, 1, '2020-12-30 07:03:09', 'en', '2020-12-30 06:53:04', '2020-12-30 07:03:09'),
(5, 'plan title', NULL, 'desc new', NULL, '2121.00', NULL, 'week', 2, NULL, 2, 1, 1, '2021-01-12 07:38:39', 'en', '2021-01-04 03:50:14', '2021-01-12 07:38:39'),
(6, 'Plan 2', NULL, 'testing plan', NULL, '25.00', NULL, 'day', 1, NULL, 20, 1, 1, NULL, 'en', '2021-01-12 07:38:07', '2021-01-12 07:38:07'),
(7, 'Subscription plan 1', NULL, 'dds', NULL, '20.00', NULL, 'week', 1, NULL, 4, 1, 1, '2021-01-18 08:54:11', 'en', '2021-01-18 08:54:05', '2021-01-18 08:54:11'),
(8, 'Plan-I', NULL, 'Plannnnnnnnn', NULL, '25.00', NULL, 'week', 22, NULL, 1, 1, 1, '2021-01-21 08:08:29', 'en', '2021-01-21 08:08:05', '2021-01-21 08:08:29'),
(9, 'hello', NULL, 'sbnnzx', NULL, '25.00', NULL, 'day', 2, NULL, 5, 1, 1, NULL, 'en', '2021-01-21 09:47:04', '2021-01-21 09:47:04'),
(10, 'fghjk', NULL, 'sdfbnbmhgh', NULL, '25.00', NULL, 'day', 25, NULL, 2, 1, 1, NULL, 'en', '2021-01-22 03:40:45', '2021-01-22 03:40:59'),
(11, 'title en', 'عندما يريد العالم أن ‪يتكلّم ‬ ، فهو يتحدّث بلغة ي', 'desc en', 'عندما يريد العالم أن ‪يتكلّم ‬ ، فهو يتحدّث بلغة يعندما يريد العالم أن ‪يتكلّم ‬ ، فهو يتحدّث بلغة ي', '20.00', NULL, 'week', 2, NULL, 3, 1, 1, NULL, 'en', '2021-01-23 05:56:49', '2021-01-23 06:01:53');

-- --------------------------------------------------------

--
-- Table structure for table `tagslist`
--

CREATE TABLE `tagslist` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `season` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tagslist`
--

INSERT INTO `tagslist` (`id`, `name`, `season`, `created_at`, `updated_at`) VALUES
(18, 'a', 'season1', '2020-12-30 02:30:33', '2020-12-30 02:30:33'),
(19, 'b', 'season2', '2020-12-30 02:30:33', '2020-12-30 02:30:33'),
(20, 'c', 'season3', '2020-12-30 02:30:33', '2020-12-30 02:30:33'),
(21, 'd', 'season4', '2020-12-30 02:30:33', '2020-12-30 02:30:33'),
(22, 'e', 'season5', '2020-12-30 02:30:33', '2020-12-30 02:30:33'),
(23, 'h', 'season1', '2020-12-30 02:43:04', '2020-12-30 02:43:04'),
(24, 'h', 'season1', '2020-12-30 02:43:40', '2020-12-30 02:43:40'),
(25, 'h', '0', '2020-12-30 03:02:55', '2020-12-30 03:02:55'),
(26, 'h', '0', '2020-12-30 03:05:31', '2020-12-30 03:05:31'),
(27, 'h', '0', '2020-12-30 03:06:14', '2020-12-30 03:06:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `provider_id` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '2',
  `is_customer` tinyint(4) NOT NULL DEFAULT '1',
  `user_role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `provider_id`, `status`, `is_customer`, `user_role`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'full match admin', 'admin@fullmatch.com', '65465456', '$2y$10$xgWG5nw3mCfwtTIrT6JhdOsu2x9FAI1Vd4KqdMJnOuZv2TYc364r2', NULL, 2, 2, NULL, NULL, 'UJIoMThPLXwLxLPH2q8ZEfpOVeQYKivwHFh7UC1gEsH4PnwPIIM6sKejgJBJ', '2020-12-22 03:49:53', '2021-02-03 05:58:50', NULL),
(2, 'test 1', 'test1@test.com', '12345678', '$2y$10$lXWP1lckfTTbZqQcHAfnTuOKLSRmX7w0GjBzRBmCdKmYmD7YxfOSa', NULL, 2, 1, NULL, NULL, NULL, '2020-12-22 03:51:46', '2020-12-30 21:47:38', NULL),
(3, 'test 2ok', 'test2@test.com', '32144321', '$2y$10$kGWa15ls4Fg621YO06tTNuP5y61KaRG1GCsW11AQfLDQxaE//95Ma', NULL, 2, 1, NULL, NULL, NULL, '2020-12-22 04:47:55', '2021-01-18 08:42:46', NULL),
(4, 'cust 1', 'cust1test@test.com', '321564', '$2y$10$qSstvLgCmZYj6SIjnXkH9.JfRZa5V8fbUVNEmbmGjtddVTCshFjqO', NULL, 2, 1, NULL, NULL, NULL, '2020-12-26 07:36:22', '2020-12-26 07:36:22', NULL),
(6, 'cust 2', 'cust2test@test.com', '111111111', '$2y$10$JOWJtWcGXdH5QbzslNXto.m/bYVlgk97S0GDoGjwIhqLxrdqMgtH.', NULL, 2, 1, NULL, NULL, NULL, '2020-12-26 07:37:19', '2020-12-30 21:47:55', '2020-12-30 21:47:55'),
(7, 'cust 3 ok', 'cust3test@test.com', '45645611', '$2y$10$otycOKchxjcsStQYWihY9.cEuPQXFfa9U1p.tmDMAJhfE1c1MMNP.', NULL, 2, 1, NULL, NULL, NULL, '2020-12-26 07:38:50', '2021-01-18 08:51:58', '2021-01-18 08:51:58'),
(8, 'cust 4', 'cust4test@test.com', '24545522', '$2y$10$MrdvqO0EL8d/q5vPOgd3w.NyxVLwDIyAb0v/azQm1UqOvlIAhQWu.', NULL, 2, 1, NULL, NULL, NULL, '2020-12-28 03:43:13', '2020-12-28 03:43:13', NULL),
(9, 'cust 5oo', 'cust5test@test.com', '45645611', '$2y$10$l40aDazrus/lbWQsX4qZPOvxairvyc85plVlNeRi.Wf.Iw/URphGe', NULL, 2, 1, NULL, NULL, NULL, '2020-12-28 03:44:39', '2020-12-28 04:46:28', '2020-12-28 04:46:28'),
(10, 'ABC', 'abc@yopmail.com', '58746321', '$2y$10$wp3tb37kTqmPsUb.srPKt.dqHh7NkSenoBq8EwB5f12ez4DS9.D4S', NULL, 2, 1, NULL, NULL, NULL, '2021-01-09 10:19:15', '2021-01-09 10:19:15', NULL),
(11, 'rameez', 'rameez@fullmatch.com', '12345678', '$2y$10$ZQcce8yFKtN2AEsGrt2DQeehT0xBv8DGJtpWodZHJzMpn91F9KnV2', NULL, 2, 1, NULL, NULL, NULL, '2021-01-11 04:00:31', '2021-01-11 04:00:31', NULL),
(12, 'Raza', 'test@yopmail.com', '5698423475', '$2y$10$Ny9uRgXa/VhlxxwOy4Q92ObfoaIXfpgCiK3Jb9t/atsam4u/w0nri', NULL, 2, 1, NULL, NULL, NULL, '2021-01-12 07:32:10', '2021-01-18 08:49:35', '2021-01-18 08:49:35'),
(13, 'sofiarae', 'sajepet134@sofiarae.com', '21321321', '$2y$10$qUVWVmKrsG3SOkvuwnq3IuIbq4RNnfgshQtlB5CiXZHKd8D72aHG6', NULL, 2, 1, NULL, NULL, NULL, '2021-01-13 03:50:03', '2021-01-13 03:50:27', '2021-01-13 03:50:27'),
(14, 'googogo', 'hewodef460@majorsww.com', '213213213', '$2y$10$Qwo6KKHlBaQ2wM/F5670yOcMnxjrlV1RfmVYPlg1QMj7Y8OXlDSBO', NULL, 2, 1, NULL, NULL, 'JTOa2kBlxUcy18ipZ6agwY8c47Wizdz3liiVvYlERI2ZK640WRnAyWCFA9xQ', '2021-01-13 03:51:07', '2021-01-13 05:39:29', '2021-01-13 05:39:29'),
(15, 'Test', 'tset@yopmail.com', '548456323', '$2y$10$PlEXea2WniZg3nMi9ATPQ.xQ7WTKfElrACzvvT2bcGFot3WHtuUWe', NULL, 2, 1, NULL, NULL, NULL, '2021-01-18 08:42:34', '2021-01-18 08:42:34', NULL),
(16, 'saeed', 'saeed@gmail.com', '03223344458', '$2y$10$j0qRAw0v6vqxGhUnLmc0g.VD3Fd1/lVnltxdAeROwnRTOW0/RqA82', NULL, 2, 1, NULL, NULL, NULL, '2021-01-20 07:34:51', '2021-01-20 07:34:51', NULL),
(17, 'saeed1', 'saeed1@gmail.com', '03223344458', '$2y$10$SClJbM3xpHltgPOLh.E9nOw0jHv2VsxdqN8Iu1s8ZFf7MgvmF7as2', NULL, 2, 1, NULL, NULL, NULL, '2021-01-20 07:36:00', '2021-01-20 07:36:00', NULL),
(18, 'saeed okk', 'apitest8@gmail.com', '123123434', '$2y$10$RPar4rJf4TJRNcoLwsZ0iuKXorHja0lVBWSelpT1ypH/X.DIrDPJm', NULL, 2, 1, NULL, NULL, NULL, '2021-01-20 07:39:38', '2021-01-22 10:01:28', NULL),
(19, 'test 12', 'test12@test.com', '12341234', '$2y$10$9G60yGO4f19yNoX8tnH95.R55CQ4vh6qHau5vtP1758YDULQHzCNC', NULL, 2, 1, NULL, NULL, NULL, '2021-01-21 07:48:05', '2021-01-21 08:04:47', '2021-01-21 08:04:47'),
(20, 'mybot1', 'mybot1@gmail.com', '123456780', '$2y$10$CNADKX5q5o0Bxar4CkrpM.CenWU2ZM9/cRDHNyEPIhY1TwqytExUu', NULL, 2, 1, NULL, NULL, NULL, '2021-01-22 08:55:44', '2021-01-22 08:55:44', NULL),
(21, 'saeed', 'saeed12@gmail.com', '03223344458', '$2y$10$az6gjM.s0vOp1y0jGYl57OiR8Rz7OtT6F/jdNxc0Fkzl.we3XCnpO', NULL, 2, 1, NULL, NULL, NULL, '2021-01-22 10:04:35', '2021-01-22 10:04:35', NULL),
(22, 'mybot1', 'mybot2@gmail.com', '123456780', '$2y$10$UFdz8OT9b3cf65dcOdRBq.5sUfs9W5tuEVdkDOZsratGaEr24wXRm', NULL, 2, 1, NULL, NULL, NULL, '2021-01-25 01:15:13', '2021-01-25 01:15:13', NULL),
(23, 'mybot1', 'mybot3@gmail.com', '123456780', '$2y$10$Oy1/.l4sh1uhWFB623rDIOmqewmAdw02fmwpVDN6mxtC1S9key2BW', NULL, 2, 1, NULL, NULL, NULL, '2021-01-25 01:15:55', '2021-01-25 01:15:55', NULL),
(24, 'mybot4', 'mybot4@gmail.com', '123456780', '$2y$10$IP164s6Rt4314xfooG5jgu.nFmYJq9XSqfjAhSwOqDy9Yg6IPdsma', NULL, 2, 1, NULL, NULL, NULL, '2021-01-25 01:36:22', '2021-01-25 01:36:22', NULL),
(26, 'mybot4', 'mybot5@gmail.com', '123456780', '$2y$10$RLLss5A4fcoc17nZoxVpkOSsC4EjOP0649CZiqiwLXTmlizwq1Ci2', NULL, 2, 1, NULL, NULL, NULL, '2021-01-25 05:37:13', '2021-01-25 05:37:13', NULL),
(30, 'mybot4', 'mybot9@gmail.com', '123456780', '$2y$10$Q0BYINsrUGDuCjjT5f8l5u8ZGOnOp4ffcspVl/34rfwd/NL69hCAa', NULL, 2, 1, NULL, NULL, NULL, '2021-01-26 03:31:35', '2021-01-26 03:31:35', NULL),
(31, 'khan', 'apitest88@gmail.com', '13245678', NULL, NULL, 2, 1, NULL, NULL, NULL, '2021-02-01 07:41:43', '2021-02-01 07:41:43', NULL),
(32, 'sub admin 1', 'subadmin@fullmatch.com', '112341234', '$2y$10$tDcIBExbtmBVCiG4etKNcOHMHvmzsosCTa7iNGQQxHurJpWoifdl2', NULL, 2, 3, NULL, NULL, NULL, '2021-02-03 02:17:00', '2021-02-03 02:27:28', NULL),
(33, 'sub admin 2 ok', 'subdmin2ok@fullmatch.com', '12341234', '$2y$10$pzuFQE2sOaK8.c50ZRpKQ.FMV7SDeRmP9T0phrrpMRXdxPHKVPoYG', NULL, 2, 3, NULL, NULL, NULL, '2021-02-03 03:24:10', '2021-02-03 03:40:22', '2021-02-03 03:40:22'),
(34, 'full match adminn', 'adminn@fullmatch.com', '12341234', '$2y$10$yuwGxXuiNQxkSHFX.ZprfeBm/QOTmx1GOQe8DzwInyeoXtn5VaPAu', NULL, 2, 3, NULL, NULL, NULL, '2021-02-04 02:06:14', '2021-02-04 02:06:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `videoclubs`
--

CREATE TABLE `videoclubs` (
  `ID` int(11) NOT NULL,
  `Club_id` int(11) DEFAULT NULL,
  `Video_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `videogenres`
--

CREATE TABLE `videogenres` (
  `id` int(11) NOT NULL,
  `video_id` int(11) DEFAULT NULL,
  `genre_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `videoplayers`
--

CREATE TABLE `videoplayers` (
  `ID` int(11) NOT NULL,
  `Player_id` int(11) DEFAULT NULL,
  `Video_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `season_id` int(11) DEFAULT NULL,
  `title_en` varchar(255) NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  `video_banner_img` varchar(255) DEFAULT NULL,
  `video_img` varchar(255) NOT NULL,
  `description_en` varchar(255) DEFAULT NULL,
  `description_ar` varchar(255) DEFAULT NULL,
  `video_link` varchar(255) NOT NULL,
  `hour` varchar(11) DEFAULT NULL,
  `minute` int(11) DEFAULT NULL,
  `second` int(11) DEFAULT NULL,
  `notify_user` varchar(255) NOT NULL,
  `popular_searches` int(11) DEFAULT NULL,
  `video_sorting` int(11) DEFAULT NULL,
  `video_promo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `video_genres`
--

CREATE TABLE `video_genres` (
  `id` int(11) NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre_sorting` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `video_genres`
--

INSERT INTO `video_genres` (`id`, `name_en`, `name_ar`, `genre_sorting`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'genre 1', 'صنف 1', 1, '2021-01-25 07:43:44', '2021-01-25 07:43:44', NULL),
(2, 'genre 2', 'صنف 2', 2, '2021-01-25 07:44:01', '2021-01-25 07:44:01', NULL),
(3, 'genre 4', 'صنف 4', 4, '2021-01-25 07:44:16', '2021-01-25 07:44:57', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abilities`
--
ALTER TABLE `abilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `abilities_scope_index` (`scope`);

--
-- Indexes for table `adv_banners`
--
ALTER TABLE `adv_banners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Indexes for table `adv_banner_videos`
--
ALTER TABLE `adv_banner_videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `video_id` (`video_id`),
  ADD KEY `banner_id` (`banner_id`);

--
-- Indexes for table `assigned_roles`
--
ALTER TABLE `assigned_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assigned_roles_entity_index` (`entity_id`,`entity_type`,`scope`),
  ADD KEY `assigned_roles_role_id_index` (`role_id`),
  ADD KEY `assigned_roles_scope_index` (`scope`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_genres`
--
ALTER TABLE `category_genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

--
-- Indexes for table `device_tokens`
--
ALTER TABLE `device_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fullmatchcontacts`
--
ALTER TABLE `fullmatchcontacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homepages`
--
ALTER TABLE `homepages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_page_managements`
--
ALTER TABLE `home_page_managements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_pg_items`
--
ALTER TABLE `home_pg_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaguecategories`
--
ALTER TABLE `leaguecategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leagues`
--
ALTER TABLE `leagues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `my_wish_lists`
--
ALTER TABLE `my_wish_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notify_users`
--
ALTER TABLE `notify_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_entity_index` (`entity_id`,`entity_type`,`scope`),
  ADD KEY `permissions_ability_id_index` (`ability_id`),
  ADD KEY `permissions_scope_index` (`scope`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `popular_searches`
--
ALTER TABLE `popular_searches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo_codes`
--
ALTER TABLE `promo_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`,`scope`),
  ADD KEY `roles_scope_index` (`scope`);

--
-- Indexes for table `seasons`
--
ALTER TABLE `seasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slidervideos`
--
ALTER TABLE `slidervideos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subs_plans`
--
ALTER TABLE `subs_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tagslist`
--
ALTER TABLE `tagslist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videoclubs`
--
ALTER TABLE `videoclubs`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `videogenres`
--
ALTER TABLE `videogenres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videoplayers`
--
ALTER TABLE `videoplayers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video_genres`
--
ALTER TABLE `video_genres`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abilities`
--
ALTER TABLE `abilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `adv_banners`
--
ALTER TABLE `adv_banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `adv_banner_videos`
--
ALTER TABLE `adv_banner_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assigned_roles`
--
ALTER TABLE `assigned_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category_genres`
--
ALTER TABLE `category_genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `device_tokens`
--
ALTER TABLE `device_tokens`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fullmatchcontacts`
--
ALTER TABLE `fullmatchcontacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `homepages`
--
ALTER TABLE `homepages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `home_page_managements`
--
ALTER TABLE `home_page_managements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `home_pg_items`
--
ALTER TABLE `home_pg_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `leaguecategories`
--
ALTER TABLE `leaguecategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leagues`
--
ALTER TABLE `leagues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `my_wish_lists`
--
ALTER TABLE `my_wish_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notify_users`
--
ALTER TABLE `notify_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `popular_searches`
--
ALTER TABLE `popular_searches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `promo_codes`
--
ALTER TABLE `promo_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `seasons`
--
ALTER TABLE `seasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `slidervideos`
--
ALTER TABLE `slidervideos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subs_plans`
--
ALTER TABLE `subs_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tagslist`
--
ALTER TABLE `tagslist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `videoclubs`
--
ALTER TABLE `videoclubs`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `videogenres`
--
ALTER TABLE `videogenres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `videoplayers`
--
ALTER TABLE `videoplayers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `video_genres`
--
ALTER TABLE `video_genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assigned_roles`
--
ALTER TABLE `assigned_roles`
  ADD CONSTRAINT `assigned_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_ability_id_foreign` FOREIGN KEY (`ability_id`) REFERENCES `abilities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

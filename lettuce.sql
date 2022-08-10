-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2022 at 11:54 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lettuce`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `banner_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_button` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  `banner_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `banner_type`, `banner_title`, `banner_button`, `category_id`, `discount_id`, `banner_slug`, `banner_image`, `status`, `created_at`, `updated_at`) VALUES
(36, 'hero', 'Maiores repudiandae', 'Quasi dicta qui ea n', 4, 9, 'eum-ut-minim-officia', 'banner_hero_36_165341134643.png', 0, '2022-05-24 10:55:46', '2022-05-27 13:27:30'),
(37, 'campaign', 'Est modi quidem exer', 'Vel dignissimos reic', 1, 8, 'ipsam-illum-exercit', 'banner_hero_37_165341171626.jpg', 1, '2022-05-24 11:01:56', '2022-05-29 10:49:04'),
(38, 'hero', 'Mollit Nam in debiti', 'Sed quo in minima re', 5, 5, 'pariatur-repudianda', 'banner_hero_38_165341172996.jpg', 0, '2022-05-24 11:02:09', '2022-05-27 13:27:28'),
(39, 'campaign', 'Voluptates ut aspern', 'Sint rerum aut ullam', 10, NULL, 'aliquid-aliquip-cons', 'banner_hero_39_165341174671.jpg', 1, '2022-05-24 11:02:26', '2022-05-29 10:48:18'),
(40, 'hero', 'Alias explicabo Et', 'Sunt ut vel Nam offi', 3, NULL, 'ea-in-iure-aliquid-c', 'banner_hero_40_165341176997.jpg', 0, '2022-05-24 11:02:49', '2022-05-29 10:47:09'),
(41, 'campaign', 'Fugiat quod exercit', 'Nam magnam est ex be', 9, 1, 'et-deserunt-dolores', 'banner_campaign_41_165384286347.png', 1, '2022-05-27 13:32:47', '2022-05-29 10:47:44');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 32, 1, '2022-06-05 08:07:47', NULL),
(2, 1, 79, 1, '2022-06-05 08:08:20', NULL),
(3, 1, 40, 1, '2022-06-05 08:09:03', NULL),
(42, 16, 56, 1, '2022-06-27 08:50:07', '2022-06-27 08:50:07'),
(43, 16, 31, 2, '2022-06-27 08:50:35', '2022-06-27 08:50:39');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_category` bigint(20) UNSIGNED DEFAULT NULL,
  `category_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_category`, `category_name`, `category_slug`, `category_photo`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'cooking', 'cooking', 'category_1_1652462470.png', 1, '2022-05-13 11:21:10', '2022-05-29 11:41:51'),
(2, 1, 'spices', 'spices', 'category_2_1652462517.png', 1, '2022-05-13 11:21:57', '2022-05-13 11:35:22'),
(3, NULL, 'fish and meat', 'fish-and-meat', 'category_3_1652462562.png', 1, '2022-05-13 11:22:42', '2022-05-13 11:30:52'),
(4, 3, 'fish', 'fish', 'category_4_1652462578.png', 1, '2022-05-13 11:22:58', '2022-05-13 11:29:52'),
(5, 3, 'meat', 'meat', 'category_5_1652462621.png', 1, '2022-05-13 11:23:41', '2022-05-13 11:32:55'),
(6, NULL, 'fruits and vegetables', 'fruits-and-vegetables', 'category_6_1652462686.png', 1, '2022-05-13 11:24:46', '2022-05-13 11:35:25'),
(7, 6, 'fruits', 'fruits', 'category_7_1652462711.png', 1, '2022-05-13 11:25:10', '2022-05-13 11:35:26'),
(8, 6, 'vegetables', 'vegetables', 'category_8_1652462727.png', 1, '2022-05-13 11:25:27', '2022-05-13 11:35:31'),
(9, NULL, 'dairy', 'dairy', 'category_9_1652462789.png', 1, '2022-05-13 11:26:29', '2022-05-13 11:35:14'),
(10, 9, 'milk', 'milk', 'category_10_1652462841.png', 1, '2022-05-13 11:27:21', '2022-05-13 11:35:23'),
(11, 9, 'eggs', 'eggs', 'category_11_1652462877.png', 1, '2022-05-13 11:27:56', '2022-05-25 09:16:27'),
(12, 1, 'oil', 'oil', 'category_12_1652524856.png', 1, '2022-05-14 04:40:56', '2022-05-25 09:18:50'),
(15, 1, 'rice', 'rice', 'category_15_1653487025.png', 1, '2022-05-25 07:57:05', '2022-05-25 09:18:44'),
(16, NULL, 'snacks', 'snacks', 'category_16_1654169030.png', 1, '2022-06-02 05:23:50', '2022-06-02 05:23:58');

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_product`
--

INSERT INTO `category_product` (`product_id`, `category_id`) VALUES
(20, 10),
(21, 9),
(22, 8),
(24, 5),
(25, 7),
(26, 1),
(27, 7),
(28, 3),
(31, 8),
(32, 10),
(33, 6),
(34, 9),
(35, 9),
(36, 7),
(37, 11),
(38, 9),
(39, 11),
(40, 8),
(41, 10),
(42, 1),
(43, 3),
(44, 6),
(45, 1),
(46, 2),
(47, 6),
(48, 7),
(49, 11),
(50, 4),
(51, 10),
(52, 4),
(53, 8),
(54, 3),
(55, 5),
(56, 2),
(57, 1),
(58, 2),
(59, 8),
(61, 5),
(62, 7),
(63, 2),
(64, 1),
(66, 2),
(67, 3),
(69, 10),
(70, 5),
(73, 8),
(75, 9),
(76, 4),
(77, 10),
(79, 7),
(80, 11),
(81, 9),
(83, 10),
(84, 9),
(85, 3),
(86, 2),
(87, 11),
(88, 6),
(89, 1),
(90, 9),
(91, 4),
(92, 5),
(93, 6),
(94, 3),
(96, 8),
(98, 10),
(99, 10),
(100, 7),
(101, 3),
(102, 8),
(23, 10),
(104, 7),
(109, 6),
(110, 11),
(111, 11),
(112, 16);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `city_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `country_id`, `city_name`, `created_at`, `updated_at`) VALUES
(1, 2, 'Dhaka', '2022-05-16 07:00:27', '2022-05-16 07:00:27'),
(2, 2, 'Rangpur', '2022-05-16 07:00:51', '2022-05-16 07:00:51'),
(3, 5, 'Ontario', '2022-05-16 07:01:21', '2022-05-16 07:01:21'),
(4, 5, 'Manitoba', '2022-05-16 07:01:44', '2022-05-16 07:01:44'),
(5, 6, 'Sydney', '2022-05-16 07:02:00', '2022-05-16 07:02:00'),
(6, 1, 'Istanbul', '2022-05-16 07:02:12', '2022-05-16 07:02:12'),
(7, 3, 'Buenos Aires', '2022-05-16 07:02:40', '2022-05-16 07:02:40'),
(8, 4, 'Brasilia', '2022-05-16 07:03:19', '2022-05-16 07:03:19');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_name`, `created_at`, `updated_at`) VALUES
(1, 'Turkey', '2022-05-16 06:59:30', '2022-05-16 06:59:30'),
(2, 'Bangladesh', '2022-05-16 06:59:38', '2022-05-16 06:59:38'),
(3, 'Argentina', '2022-05-16 06:59:47', '2022-05-16 06:59:47'),
(4, 'Brazil', '2022-05-16 06:59:52', '2022-05-16 06:59:52'),
(5, 'Canada', '2022-05-16 06:59:59', '2022-05-16 06:59:59'),
(6, 'Australia', '2022-05-16 07:00:05', '2022-05-16 07:00:05');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_value` int(11) NOT NULL,
  `coupon_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_validity` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon_code`, `coupon_value`, `coupon_type`, `coupon_validity`, `status`, `created_at`, `updated_at`) VALUES
(1, 'sam15', 15, 'percent', '2022-05-13 16:29:00', 0, '2022-05-13 08:00:51', '2022-05-14 06:24:25'),
(2, 'Expedita occaecat qu', 550, 'fixed', '2022-05-13 21:17:00', 1, '2022-05-13 09:59:40', '2022-05-14 06:24:25'),
(3, 'hg6', 23, 'percent', '2022-05-13 17:59:00', 0, '2022-05-13 10:00:36', '2022-05-14 06:24:24'),
(4, 'Molestiae vitae aper', 20, 'percent', '2022-05-13 20:03:00', 1, '2022-05-13 10:01:37', '2022-05-14 06:24:23'),
(5, 'as', 2333, 'fixed', '2022-05-16 12:26:00', 0, '2022-05-14 06:26:26', '2022-05-14 06:26:26'),
(6, 'gf5', 5, 'percent', '2022-05-18 12:27:00', 0, '2022-05-14 06:27:16', '2022-05-14 06:27:16'),
(7, 'gf3', 3000, 'fixed', '2022-05-19 12:29:00', 0, '2022-05-14 06:29:57', '2022-05-14 06:29:57'),
(8, 'bg5', 5, 'percent', '2022-05-14 12:33:00', 0, '2022-05-14 06:33:30', '2022-05-14 06:33:30'),
(9, 'fgdgf54', 540, 'fixed', '2022-05-28 12:35:00', 0, '2022-05-14 06:35:09', '2022-05-14 06:35:09'),
(10, 'kl6', 6, 'percent', '2022-05-20 12:37:00', 0, '2022-05-14 06:37:09', '2022-05-14 06:37:09'),
(11, 'mn10', 2000, 'fixed', '2022-05-20 12:41:00', 0, '2022-05-14 06:41:59', '2022-05-17 04:42:59'),
(12, 'vb', 6, 'percent', '2022-07-30 12:43:00', 1, '2022-05-14 06:43:33', '2022-06-08 03:12:13'),
(13, 'cc9', 9, 'percent', '2022-05-20 12:45:00', 0, '2022-05-14 06:45:22', '2022-05-14 06:45:22'),
(14, 'gfg', 66, 'percent', '2022-05-05 12:46:00', 0, '2022-05-14 06:46:51', '2022-05-14 06:46:51'),
(15, 'ghh', 655, 'fixed', '2022-05-18 13:00:00', 0, '2022-05-14 07:00:27', '2022-05-14 07:00:27'),
(16, 'mjhg', 876, 'fixed', '2022-05-27 13:01:00', 1, '2022-05-14 07:01:03', '2022-05-17 04:43:39'),
(17, 'rtgf', 43, 'percent', '2022-05-20 13:01:00', 0, '2022-05-14 07:01:59', '2022-05-14 07:01:59'),
(18, 'fgdgfdg', 5444, 'fixed', '2022-05-13 13:23:00', 0, '2022-05-14 07:23:04', '2022-05-14 07:23:04'),
(19, 'ghjg8', 800, 'fixed', '2022-05-26 13:57:00', 0, '2022-05-14 07:57:05', '2022-05-14 07:57:05'),
(20, 'nbv3', 3000, 'fixed', '2022-06-01 13:57:00', 0, '2022-05-14 07:57:47', '2022-06-08 03:16:17'),
(21, 'gbbh6', 600, 'fixed', '2022-06-02 13:58:00', 0, '2022-05-14 07:58:14', '2022-06-08 03:16:16'),
(22, 'fghfg7', 766, 'fixed', '2022-06-07 13:58:00', 0, '2022-05-14 07:58:41', '2022-06-08 03:16:13'),
(23, 'hgj', 8, 'percent', '2022-06-05 15:05:00', 0, '2022-05-14 08:05:53', '2022-06-08 03:16:12'),
(24, 'sdd', 322, 'fixed', '2022-06-25 17:00:00', 1, '2022-05-14 11:00:40', '2022-06-08 03:16:54'),
(25, 'saddwqd', 1000, 'fixed', '2022-05-17 10:50:00', 1, '2022-05-14 11:01:01', '2022-06-08 03:16:08');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `discount_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_value` int(11) NOT NULL,
  `discount_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_validity` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `discount_name`, `discount_type`, `discount_value`, `discount_slug`, `discount_validity`, `status`, `created_at`, `updated_at`) VALUES
(1, 'flash sale', 'fixed', 150, 'flash-sale', '2022-05-30 17:59:00', 0, '2022-05-12 13:59:55', '2022-05-30 12:33:03'),
(2, 'Hayfa Butler', 'percent', 27, 'Eligendi nostrum dol', '2022-05-13 20:38:00', 0, '2022-05-12 14:29:33', '2022-05-14 08:16:36'),
(3, 'Brittany Robbins', 'fixed', 210, 'Voluptatem itaque s', '2022-05-13 12:54:00', 0, '2022-05-12 14:35:46', '2022-05-14 08:16:36'),
(4, 'winter sale', 'percent', 35, 'winter-sale', '2022-06-16 14:50:00', 0, '2022-05-13 05:48:14', '2022-06-16 08:50:35'),
(5, 'summer sale', 'fixed', 125, 'summer-sale', '2022-10-26 14:05:00', 1, '2022-05-14 08:05:27', '2022-06-22 15:08:26'),
(6, 'Kevyn Dorsey', 'fixed', 94, 'Commodo molestiae qu', '1972-12-24 21:42:00', 0, '2022-05-14 08:16:38', '2022-05-14 08:16:38'),
(7, 'clearance sale', 'fixed', 265, 'clearance-sale', '2022-08-09 14:16:00', 0, '2022-05-14 08:17:00', '2022-08-09 09:02:34'),
(8, 'eid al adha sale', 'percent', 43, 'eid-al-adha-sale', '2022-07-28 14:00:00', 0, '2022-05-14 11:02:24', '2022-07-28 09:31:53'),
(9, 'eid al fitr sale', 'percent', 44, 'eid-al-fitr-sale', '2022-05-28 17:01:00', 0, '2022-05-14 11:02:49', '2022-05-28 11:01:21'),
(10, 'hkjshd sdf sdf', 'fixed', 200, 'hkjshd-sdf-sdf', '2022-05-20 10:09:00', 0, '2022-05-17 04:09:38', '2022-05-17 04:09:38'),
(11, 'dfg d ger er r', 'percent', 36, 'dfg-d-ger-er-r', '2022-06-04 17:37:00', 0, '2022-05-17 04:10:17', '2022-06-04 11:37:17');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faq_ques` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `faq_ans` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `faq_ques`, `faq_ans`, `is_active`, `created_at`, `updated_at`) VALUES
(63, 'Sunt hic inventore nobis minima incidunt ea dolorem.', 'Dolorem odit vel libero. Ullam impedit tempora et corrupti eius quod soluta. Qui et eum quod vero. Ut ullam error eveniet et cumque est aliquam. Id hic aut doloribus explicabo et autem adipisci.', 0, '2022-05-13 07:48:40', '2022-05-13 07:53:59'),
(64, 'Perspiciatis illum doloribus omnis.', 'Quo voluptatibus voluptatibus neque omnis. Fugiat rerum nam reiciendis. Molestiae earum fugit distinctio magnam facere dolore. Ad laboriosam expedita non excepturi qui quis.', 1, '2022-05-13 07:48:40', '2022-05-13 07:53:58'),
(65, 'Error asperiores id ullam sit doloremque qui.', 'Vero qui modi aut esse. Aut dolore asperiores quis. Minima esse dolorum delectus est dolor ad est.', 1, '2022-05-13 07:48:40', '2022-05-13 07:53:58'),
(66, 'Perspiciatis eos dolorum at.', 'Accusantium velit rerum adipisci ratione. Provident dolorem quos deserunt laboriosam. Blanditiis sed commodi vero et accusantium. Quos quaerat voluptas maiores voluptatibus neque debitis.', 0, '2022-05-13 07:48:40', '2022-05-13 07:53:58'),
(67, 'Fuga voluptatem quas qui et aut.', 'Magnam quod illum sed distinctio. Et aspernatur voluptas provident delectus sapiente et. Facilis ut eaque ipsam consequuntur et.', 0, '2022-05-13 07:48:40', '2022-05-13 07:53:58'),
(68, 'Perspiciatis non culpa tempora fuga odio.', 'Ut vero nostrum laudantium est quia et. Et vel est non expedita distinctio labore. Id aut provident non animi. Et placeat laudantium aperiam animi consequatur quo.', 0, '2022-05-13 07:48:40', NULL),
(69, 'Natus quod natus nihil dolor consectetur eum cum.', 'Autem nihil voluptatem ut repellat aut at. Illo nulla et consectetur aliquid. Facilis id sit aspernatur et.', 1, '2022-05-13 07:48:40', NULL),
(70, 'Neque nihil neque voluptatibus impedit architecto eligendi laudantium.', 'Maxime minus qui minima officiis omnis eius repellat. Corrupti quia iusto delectus. Quae ipsum suscipit voluptas officiis in iusto molestiae.', 0, '2022-05-13 07:48:40', NULL),
(71, 'Perspiciatis et facilis quia culpa earum.', 'Et id ex laudantium aut eum. Incidunt sint laborum est vel similique. Ea quaerat sit dignissimos sed. Unde voluptatem sint tempora error sint deleniti inventore similique.', 1, '2022-05-13 07:48:40', NULL),
(72, 'Eum aliquam assumenda vero dolores.', 'Alias fuga est repudiandae et non. Autem sunt cumque aut. Cumque quos vitae mollitia quia sit est.', 0, '2022-05-13 07:48:40', NULL),
(73, 'Corrupti id animi veritatis labore rem praesentium.', 'Labore est provident ea beatae. Qui tempore deserunt pariatur maiores iure officia. Rerum dolores non dolorem incidunt adipisci illum non eveniet. Aut laborum pariatur veritatis sint quaerat.', 1, '2022-05-13 07:50:31', NULL),
(74, 'Necessitatibus qui ut nihil aperiam non voluptas.', 'Aspernatur mollitia culpa enim odit inventore. Autem qui aut quia. Et voluptas nisi expedita dolorum.', 1, '2022-05-13 07:50:31', NULL),
(75, 'Non perspiciatis alias recusandae ipsum sunt.', 'Quasi quas autem fugit vel voluptatem distinctio. Qui nostrum cupiditate voluptates laborum et non. Placeat voluptatem et inventore ut quasi. Accusamus accusamus earum eum inventore.', 0, '2022-05-13 07:50:31', NULL),
(77, 'Ipsam distinctio consequatur aut.', 'Illum sunt quisquam dolores adipisci sed qui. Possimus numquam nihil quam explicabo tempore harum. Non ea dolores omnis eligendi voluptate. Occaecati aut sunt non est ut.', 1, '2022-05-13 07:50:31', NULL),
(78, 'Consequatur architecto culpa et qui.', 'Tempore quas ad architecto nisi maxime ipsam. Non libero vel quae sint omnis. Ea cupiditate omnis et quae nihil ratione est. Commodi ex eius iste.', 1, '2022-05-13 07:50:31', NULL),
(80, 'Dolor ad eveniet est sit.', 'Consectetur veniam optio laboriosam sed. Ratione autem quia quibusdam laboriosam consequatur. Pariatur consequatur maxime eos ea non.', 0, '2022-05-13 07:50:31', NULL),
(81, 'Praesentium suscipit vitae consectetur ratione.', 'Architecto recusandae sunt corporis iste amet. Doloremque ea ut maxime voluptatem. Eligendi ex nisi aut nihil corporis. Soluta et ipsa eaque inventore quae iste provident.', 1, '2022-05-13 07:50:31', NULL),
(82, 'Itaque fugiat rem quisquam adipisci.', 'Assumenda odio nesciunt neque minima. Rem sint fugiat voluptatem suscipit voluptatem quo. Eligendi temporibus est adipisci qui impedit harum.', 0, '2022-05-13 07:50:31', NULL),
(83, 'Dolorem eos et conse', 'Consequuntur consequ', 0, '2022-05-13 07:54:06', '2022-05-13 07:54:06');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2022_04_11_153257_create_discounts_table', 1),
(2, '2014_10_12_000000_create_users_table', 2),
(3, '2014_10_12_100000_create_password_resets_table', 2),
(4, '2019_08_19_000000_create_failed_jobs_table', 2),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(6, '2022_03_28_170119_create_faqs_table', 2),
(8, '2022_04_04_162541_create_user_details_table', 2),
(9, '2022_04_05_180024_create_countries_table', 2),
(10, '2022_04_05_180156_create_cities_table', 2),
(11, '2022_04_11_153455_create_coupons_table', 2),
(12, '2022_04_16_174727_create_categories_table', 2),
(13, '2022_04_22_040248_create_sizes_table', 2),
(14, '2022_04_28_091103_create_products_table', 2),
(15, '2022_04_28_091344_create_category_product_table', 2),
(16, '2022_04_28_093345_create_product_multiple_photos_table', 2),
(17, '2022_05_01_174206_create_product_product_size_table', 2),
(18, '2022_05_10_195002_create_discount_product_table', 2),
(19, '2022_05_11_065325_create_product_discounts_table', 2),
(20, '2022_04_03_174834_create_banners_table', 3),
(21, '2022_05_30_203542_create_product_views_table', 4),
(22, '2022_06_02_180133_create_wishlists_table', 5),
(23, '2022_06_04_184125_create_carts_table', 6),
(37, '2022_06_20_110917_create_orders_table', 7),
(38, '2022_06_20_111301_create_order_items_table', 7),
(40, '2022_06_22_134534_create_product_reviews_table', 8),
(43, '2022_07_24_215940_create_subscribers_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `billing_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_phone` bigint(20) NOT NULL,
  `billing_country` int(11) NOT NULL,
  `billing_city` int(11) NOT NULL,
  `billing_zipcode` bigint(20) NOT NULL,
  `billing_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_note` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon` tinyint(1) NOT NULL DEFAULT 0,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_amount` int(11) NOT NULL DEFAULT 0,
  `order_subtotal` int(11) NOT NULL,
  `order_total` int(11) NOT NULL,
  `order_shipping` int(11) NOT NULL,
  `order_vat` double(8,2) NOT NULL,
  `vat_value` int(11) NOT NULL DEFAULT 0,
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `billing_name`, `billing_email`, `billing_phone`, `billing_country`, `billing_city`, `billing_zipcode`, `billing_address`, `order_note`, `payment_method`, `payment_status`, `coupon`, `coupon_code`, `coupon_value`, `coupon_amount`, `order_subtotal`, `order_total`, `order_shipping`, `order_vat`, `vat_value`, `order_status`, `created_at`, `updated_at`) VALUES
(2, NULL, 'Ruth Floyd', 'nykopov@mailinator.com', 7145, 6, 5, 63598, 'Sunt neque voluptate', 'Et beatae repudianda', 'cod', 'pending', 0, NULL, NULL, 0, 896, 2030, 1000, 0.15, 134, 'pending', '2022-06-21 23:45:21', '2022-06-21 23:45:21'),
(3, NULL, 'Ralph Bradshaw', 'nolekytyg@mailinator.com', 82345345, 2, 1, 86547, 'Voluptas et exceptur', 'Quam nulla enim beat', 'cod', 'pending', 0, NULL, NULL, 0, 2384, 3742, 1000, 0.15, 358, 'pending', '2022-06-21 23:46:07', '2022-06-21 23:46:07'),
(4, NULL, 'Yoshio Madden', 'rocesipoca@mailinator.com', 8445, 3, 7, 60698, 'Voluptate vitae rem ', 'Architecto anim anim', 'cod', 'pending', 0, NULL, NULL, 0, 2384, 3742, 1000, 0.15, 358, 'pending', '2022-06-22 00:54:31', '2022-06-22 00:54:31'),
(6, NULL, 'Gray Crawford', 'doryjus@mailinator.com', 6446, 6, 5, 11892, 'Reprehenderit et qu', 'Sunt quam quia ut r', 'cod', 'pending', 0, NULL, NULL, 0, 582, 1669, 1000, 0.15, 87, 'pending', '2022-06-22 03:05:39', '2022-06-22 03:05:39'),
(8, NULL, 'Keith Garrett', 'fuwovi@mailinator.com', 89345, 6, 5, 87161, 'Est placeat aute ev', 'Voluptatem ex ea ut', 'cod', 'pending', 1, 'vb', '6%', 35, 547, 1629, 1000, 0.15, 82, 'pending', '2022-06-22 03:13:42', '2022-06-22 03:13:42'),
(9, NULL, 'Guy Solomon', 'qazoqe@mailinator.com', 2644, 6, 5, 88869, 'Debitis minim repudi', 'Non sit sint optio', 'cod', 'pending', 0, NULL, NULL, 0, 742, 1853, 1000, 0.15, 111, 'pending', '2022-06-22 03:18:10', '2022-06-22 03:18:10'),
(10, NULL, 'Aphrodite Lopez', 'hyqohopy@mailinator.com', 1745654, 6, 5, 17080, 'Suscipit sunt molest', 'Laboriosam quo eaqu', 'card', 'paid', 0, NULL, NULL, 0, 663, 1762, 1000, 0.15, 99, 'pending', '2022-06-22 03:19:26', '2022-06-22 03:19:26'),
(14, NULL, 'Vaughan Irwin', 'timybyfeke@mailinator.com', 463454, 6, 5, 15790, 'Laudantium mollit d', 'Sapiente iusto autem', 'card', 'paid', 1, 'vb', '6%', 37, 587, 1675, 1000, 0.15, 88, 'pending', '2022-06-22 03:37:31', '2022-06-22 03:37:31'),
(15, NULL, 'Elijah Gallagher', 'pidyf@mailinator.com', 11456, 6, 5, 46277, 'Lorem et laboris arc', 'Debitis est irure di', 'cod', 'pending', 0, NULL, NULL, 0, 100, 1115, 1000, 0.15, 15, 'pending', '2022-06-22 03:38:45', '2022-06-22 03:38:45'),
(16, NULL, 'Price Estes', 'dijuvohyby@mailinator.com', 20567, 3, 7, 13408, 'Dolorem placeat qui', 'Minim nisi enim nost', 'cod', 'pending', 0, NULL, NULL, 0, 221, 1254, 1000, 0.15, 33, 'pending', '2022-06-22 03:39:40', '2022-06-22 03:39:40'),
(17, NULL, 'Halee Little', 'laliqubel@mailinator.com', 75456, 6, 5, 60767, 'Deserunt quae magni ', 'Est esse illo labor', 'cod', 'pending', 1, 'vb', '6%', 36, 561, 1645, 1000, 0.15, 84, 'pending', '2022-06-22 03:42:58', '2022-06-22 03:42:58'),
(18, NULL, 'Ifeoma Buchanan', 'lufupox@mailinator.com', 38456, 3, 7, 23515, 'Doloremque velit fu', 'Voluptatem Aut hic ', 'cod', 'pending', 0, NULL, NULL, 0, 597, 1687, 1000, 0.15, 90, 'pending', '2022-06-22 03:58:00', '2022-06-22 03:58:00'),
(19, NULL, 'Daquan Wooten', 'lusyxyzi@mailinator.com', 35456, 3, 7, 13914, 'Aut id eaque omnis m', 'Cupiditate proident', 'card', 'paid', 0, NULL, NULL, 0, 896, 2030, 1000, 0.15, 134, 'pending', '2022-06-22 03:59:29', '2022-06-22 03:59:29'),
(20, NULL, 'Mona Martinez', 'sizyvi@mailinator.com', 89435, 3, 7, 86808, 'Aliqua Nihil nulla ', 'Nisi quibusdam sit ', 'card', 'paid', 0, NULL, NULL, 0, 620, 1713, 1000, 0.15, 93, 'pending', '2022-06-22 04:00:47', '2022-06-22 04:00:47'),
(21, NULL, 'Adena Williamson', 'ridaxo@mailinator.com', 15345, 6, 5, 32477, 'Quia sunt ullamco du', 'Nobis quasi deserunt', 'card', 'paid', 0, NULL, NULL, 0, 175, 1201, 1000, 0.15, 26, 'pending', '2022-06-22 04:02:47', '2022-06-22 04:02:47'),
(22, NULL, 'Britanni Middleton', 'qykujinip@mailinator.com', 98678, 6, 5, 10542, 'Ut sunt elit tempo', 'Reprehenderit aut m', 'cod', 'pending', 0, NULL, NULL, 0, 132, 1152, 1000, 0.15, 20, 'pending', '2022-06-22 04:05:02', '2022-06-22 04:05:02'),
(23, NULL, 'Nasim Durham', 'husiqe@mailinator.com', 4824, 3, 7, 21074, 'Consequatur officia', 'Aut eum enim dolor e', 'cod', 'pending', 0, NULL, NULL, 0, 395, 1454, 1000, 0.15, 59, 'pending', '2022-06-22 04:05:46', '2022-06-22 04:05:46'),
(24, NULL, 'Nicholas Clemons', 'pihute@mailinator.com', 36456, 3, 7, 97967, 'Laborum labore ut od', 'Voluptate iusto sit ', 'card', 'paid', 0, NULL, NULL, 0, 221, 1254, 1000, 0.15, 33, 'pending', '2022-06-22 04:06:48', '2022-06-22 04:06:48'),
(25, NULL, 'Bianca Robinson', 'duletyha@mailinator.com', 6745, 4, 8, 86470, 'Qui enim voluptate a', 'Nostrud corrupti ve', 'card', 'paid', 0, NULL, NULL, 0, 620, 1713, 1000, 0.15, 93, 'pending', '2022-06-22 04:07:47', '2022-06-22 04:07:47'),
(26, NULL, 'Meredith Boone', 'bynex@mailinator.com', 9647, 6, 5, 73020, 'Consectetur quos fu', 'Modi nulla voluptas ', 'cod', 'pending', 0, NULL, NULL, 0, 896, 2030, 1000, 0.15, 134, 'pending', '2022-06-22 04:09:04', '2022-06-22 04:09:04'),
(27, NULL, 'Alea Ball', 'sefapybej@mailinator.com', 77345, 6, 5, 45614, 'Laborum Repellendus', 'Ut soluta reprehende', 'cod', 'pending', 0, NULL, NULL, 0, 1869, 3149, 1000, 0.15, 280, 'pending', '2022-06-22 04:12:39', '2022-06-22 04:12:39'),
(28, NULL, 'Constance Sutton', 'canu@mailinator.com', 64345, 2, 1, 33674, 'Dolor eligendi sed e', 'Ut id ipsam aute qua', 'cod', 'pending', 0, NULL, NULL, 0, 200, 1230, 1000, 0.15, 30, 'pending', '2022-06-22 04:15:48', '2022-06-22 04:15:48'),
(29, NULL, 'Talon Frazier', 'puhehisujy@mailinator.com', 54456, 6, 5, 42427, 'Labore mollitia assu', 'Rerum perferendis in', 'cod', 'pending', 0, NULL, NULL, 0, 386, 1444, 1000, 0.15, 58, 'pending', '2022-06-22 04:16:44', '2022-06-22 04:16:44'),
(30, NULL, 'Deirdre Campos', 'qose@mailinator.com', 27345, 3, 7, 84126, 'Numquam molestiae su', 'Laudantium placeat', 'cod', 'pending', 0, NULL, NULL, 0, 10600, 12190, 0, 0.15, 1590, 'pending', '2022-06-22 04:21:59', '2022-06-22 04:21:59'),
(31, NULL, 'Geraldine Mcdowell', 'xoxokosi@mailinator.com', 42456, 6, 5, 89603, 'Dolore ut aut autem ', 'Velit in repudiandae', 'cod', 'pending', 0, NULL, NULL, 0, 386, 1444, 1000, 0.15, 58, 'pending', '2022-06-22 04:23:31', '2022-06-22 04:23:31'),
(32, NULL, 'Devin Lynch', 'tifikel@mailinator.com', 6356, 3, 7, 23458, 'Voluptatem accusanti', 'Reiciendis et est e', 'cod', 'pending', 0, NULL, NULL, 0, 10600, 12190, 0, 0.15, 1590, 'pending', '2022-06-22 04:24:47', '2022-06-22 04:24:47'),
(33, NULL, 'Raphael Mack', 'jebynib@mailinator.com', 5734, 3, 7, 86157, 'Animi aut sit dign', 'Ea qui numquam labor', 'cod', 'pending', 0, NULL, NULL, 0, 729, 1838, 1000, 0.15, 109, 'pending', '2022-06-22 04:26:42', '2022-06-22 04:26:42'),
(34, NULL, 'Cairo Mercer', 'giqijol@mailinator.com', 9745, 3, 7, 30006, 'In obcaecati nihil q', 'Unde vel facilis ali', 'cod', 'pending', 0, NULL, NULL, 0, 729, 1838, 1000, 0.15, 109, 'pending', '2022-06-22 04:27:51', '2022-06-22 04:27:51'),
(35, NULL, 'Barrett Rojas', 'zedivik@mailinator.com', 5245, 6, 5, 31672, 'Ipsa amet animi v', 'Consequatur atque e', 'cod', 'pending', 0, NULL, NULL, 0, 221, 1254, 1000, 0.15, 33, 'pending', '2022-06-22 04:28:43', '2022-06-22 04:28:43'),
(36, NULL, 'Echo Kline', 'cewebytip@mailinator.com', 6154, 6, 5, 78747, 'Quo corrupti dolori', 'Est quia pariatur S', 'cod', 'pending', 0, NULL, NULL, 0, 200, 1230, 1000, 0.15, 30, 'pending', '2022-06-22 04:29:40', '2022-06-22 04:29:40'),
(37, NULL, 'Ariana Barnett', 'jodo@mailinator.com', 7867, 2, 2, 56143, 'Asperiores incididun', 'Aliquip optio earum', 'cod', 'pending', 0, NULL, NULL, 0, 973, 2119, 1000, 0.15, 146, 'pending', '2022-06-22 04:36:16', '2022-06-22 04:36:16'),
(38, NULL, 'Deirdre Giles', 'mybeb@mailinator.com', 60456, 3, 7, 15031, 'Quisquam error tempo', 'Quia repudiandae sed', 'cod', 'pending', 0, NULL, NULL, 0, 175, 1201, 1000, 0.15, 26, 'pending', '2022-06-22 04:40:19', '2022-06-22 04:40:19'),
(39, NULL, 'Medge Shelton', 'cutynenen@mailinator.com', 14435, 6, 5, 48534, 'Deserunt eu nobis fa', 'Voluptatem ut non ne', 'cod', 'pending', 0, NULL, NULL, 0, 221, 1254, 1000, 0.15, 33, 'pending', '2022-06-22 04:45:27', '2022-06-22 04:45:27'),
(40, NULL, 'Howard Nixon', 'joqiwoje@mailinator.com', 5345, 3, 7, 65250, 'Alias nesciunt cons', 'Molestiae quia aut a', 'card', 'paid', 0, NULL, NULL, 0, 973, 2119, 1000, 0.15, 146, 'pending', '2022-06-22 04:46:00', '2022-06-22 04:46:00'),
(44, NULL, 'Noah Bray', 'pynasetiqe@mailinator.com', 29435345, 6, 5, 92631, 'Blanditiis eius est ', 'Enim earum voluptate', 'card', 'paid', 0, NULL, NULL, 0, 896, 2030, 1000, 0.15, 134, 'pending', '2022-06-22 04:47:39', '2022-06-22 04:47:39'),
(47, 2, 'smith', 'smith@gmail.com', 456546546, 6, 5, 56456, 'dfgh h h rt 57  456 fgh', '', 'cod', 'due', 0, NULL, NULL, 0, 10600, 12190, 0, 0.15, 1590, 'pending', '2022-07-03 13:08:40', '2022-07-03 13:08:40'),
(59, 2, 'smith', 'smith@gmail.com', 456546546, 6, 5, 6546, 'dfgh h h rt 57  456 fgh', 'sdfs sdf ', 'cod', 'due', 0, NULL, NULL, 0, 741, 1852, 1000, 0.15, 111, 'pending', '2022-07-23 13:45:42', '2022-07-23 13:45:42'),
(60, 2, 'smith', 'smith@gmail.com', 456546546, 6, 5, 33554, 'dfgh h h rt 57  456 fgh', ' gif qoi oiqwertfuower iwerut', 'cod', 'due', 0, NULL, NULL, 0, 2884, 4317, 1000, 0.15, 433, 'pending', '2022-07-23 13:50:22', '2022-07-23 13:50:22'),
(61, 2, 'smith', 'smith@gmail.com', 456546546, 6, 5, 4456, 'dfgh h h rt 57  456 fgh', '', 'cod', 'due', 1, 'vb', '6%', 678, 10626, 12220, 0, 0.15, 1594, 'pending', '2022-07-23 15:33:33', '2022-07-23 15:33:33');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 2, 56, 0, 1, '2022-06-21 23:45:21', '2022-06-21 23:45:21'),
(2, 3, 56, 0, 1, '2022-06-21 23:46:07', '2022-06-21 23:46:07'),
(3, 3, 31, 0, 1, '2022-06-21 23:46:07', '2022-06-21 23:46:07'),
(4, 3, 99, 0, 2, '2022-06-21 23:46:07', '2022-06-21 23:46:07'),
(5, 4, 56, 0, 1, '2022-06-22 00:54:31', '2022-06-22 00:54:31'),
(6, 4, 31, 0, 1, '2022-06-22 00:54:31', '2022-06-22 00:54:31'),
(7, 4, 99, 0, 2, '2022-06-22 00:54:31', '2022-06-22 00:54:31'),
(11, 6, 84, 0, 1, '2022-06-22 03:05:39', '2022-06-22 03:05:39'),
(13, 8, 84, 0, 1, '2022-06-22 03:13:42', '2022-06-22 03:13:42'),
(14, 9, 31, 0, 1, '2022-06-22 03:18:10', '2022-06-22 03:18:10'),
(15, 10, 75, 0, 3, '2022-06-22 03:19:26', '2022-06-22 03:19:26'),
(19, 14, 109, 0, 1, '2022-06-22 03:37:31', '2022-06-22 03:37:31'),
(20, 15, 111, 0, 1, '2022-06-22 03:38:45', '2022-06-22 03:38:45'),
(21, 16, 75, 0, 1, '2022-06-22 03:39:40', '2022-06-22 03:39:40'),
(22, 17, 40, 0, 1, '2022-06-22 03:42:59', '2022-06-22 03:42:59'),
(23, 18, 40, 0, 1, '2022-06-22 03:58:00', '2022-06-22 03:58:00'),
(24, 19, 56, 0, 1, '2022-06-22 03:59:29', '2022-06-22 03:59:29'),
(25, 20, 110, 0, 1, '2022-06-22 04:00:47', '2022-06-22 04:00:47'),
(26, 21, 62, 0, 1, '2022-06-22 04:02:47', '2022-06-22 04:02:47'),
(27, 22, 35, 0, 1, '2022-06-22 04:05:02', '2022-06-22 04:05:02'),
(28, 23, 91, 0, 1, '2022-06-22 04:05:46', '2022-06-22 04:05:46'),
(29, 24, 75, 0, 1, '2022-06-22 04:06:49', '2022-06-22 04:06:49'),
(30, 25, 110, 0, 1, '2022-06-22 04:07:47', '2022-06-22 04:07:47'),
(31, 26, 56, 0, 1, '2022-06-22 04:09:04', '2022-06-22 04:09:04'),
(32, 27, 56, 0, 1, '2022-06-22 04:12:39', '2022-06-22 04:12:39'),
(33, 27, 32, 0, 1, '2022-06-22 04:12:40', '2022-06-22 04:12:40'),
(34, 28, 98, 0, 1, '2022-06-22 04:15:48', '2022-06-22 04:15:48'),
(35, 29, 76, 0, 1, '2022-06-22 04:16:44', '2022-06-22 04:16:44'),
(36, 30, 112, 0, 1, '2022-06-22 04:21:59', '2022-06-22 04:21:59'),
(37, 31, 76, 0, 1, '2022-06-22 04:23:31', '2022-06-22 04:23:31'),
(38, 32, 112, 0, 1, '2022-06-22 04:24:47', '2022-06-22 04:24:47'),
(39, 33, 93, 0, 1, '2022-06-22 04:26:42', '2022-06-22 04:26:42'),
(40, 34, 93, 0, 1, '2022-06-22 04:27:51', '2022-06-22 04:27:51'),
(41, 35, 75, 0, 1, '2022-06-22 04:28:43', '2022-06-22 04:28:43'),
(42, 36, 98, 0, 1, '2022-06-22 04:29:40', '2022-06-22 04:29:40'),
(43, 37, 32, 0, 1, '2022-06-22 04:36:16', '2022-06-22 04:36:16'),
(44, 38, 62, 0, 1, '2022-06-22 04:40:19', '2022-06-22 04:40:19'),
(45, 39, 75, 0, 1, '2022-06-22 04:45:27', '2022-06-22 04:45:27'),
(46, 40, 32, 0, 1, '2022-06-22 04:46:00', '2022-06-22 04:46:00'),
(50, 44, 56, 0, 1, '2022-06-22 04:47:39', '2022-06-22 04:47:39'),
(51, NULL, 49, 0, 1, '2022-06-22 10:03:40', '2022-06-22 10:03:40'),
(52, NULL, 80, 0, 2, '2022-06-22 10:03:40', '2022-06-22 10:03:40'),
(53, NULL, 98, 0, 9, '2022-06-22 10:03:40', '2022-06-22 10:03:40'),
(54, NULL, 99, 0, 10, '2022-06-22 10:03:40', '2022-06-22 10:03:40'),
(55, NULL, 111, 0, 9, '2022-06-22 10:03:40', '2022-06-22 10:03:40'),
(56, NULL, 110, 0, 4, '2022-06-22 10:03:40', '2022-06-22 10:03:40'),
(57, NULL, 56, 0, 2, '2022-06-22 10:03:40', '2022-06-22 10:03:40'),
(58, NULL, 35, 0, 1, '2022-06-22 10:03:40', '2022-06-22 10:03:40'),
(59, NULL, 40, 0, 4, '2022-06-22 10:03:40', '2022-06-22 10:03:40'),
(60, NULL, 84, 0, 10, '2022-06-22 10:03:40', '2022-06-22 10:03:40'),
(61, NULL, 109, 0, 3, '2022-07-03 12:31:40', '2022-07-03 12:31:40'),
(62, NULL, 56, 0, 1, '2022-07-03 12:31:40', '2022-07-03 12:31:40'),
(63, NULL, 62, 0, 1, '2022-07-03 12:31:40', '2022-07-03 12:31:40'),
(64, 47, 112, 10600, 1, '2022-07-03 13:08:40', '2022-07-03 13:08:40'),
(71, 59, 75, 221, 1, '2022-07-23 13:45:42', '2022-07-23 13:45:42'),
(72, 59, 24, 520, 1, '2022-07-23 13:45:42', '2022-07-23 13:45:42'),
(73, 60, 99, 373, 1, '2022-07-23 13:50:22', '2022-07-23 13:50:22'),
(74, 60, 31, 617, 1, '2022-07-23 13:50:22', '2022-07-23 13:50:22'),
(75, 60, 40, 472, 1, '2022-07-23 13:50:22', '2022-07-23 13:50:22'),
(76, 60, 49, 711, 2, '2022-07-23 13:50:22', '2022-07-23 13:50:22'),
(77, 61, 111, 100, 1, '2022-07-23 15:33:33', '2022-07-23 15:33:33'),
(78, 61, 112, 10600, 1, '2022-07-23 15:33:33', '2022-07-23 15:33:33'),
(79, 61, 93, 604, 1, '2022-07-23 15:33:33', '2022-07-23 15:33:33');

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_desc` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `in_stock` int(11) NOT NULL DEFAULT 0,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `has_discount` tinyint(1) NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_desc`, `price`, `stock`, `in_stock`, `thumbnail`, `slug`, `has_discount`, `is_featured`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(20, 'Montana Joyner', 'Et amet necessitati', 691, 93, 93, 'product_20_1652529725.png', 'montana-joyner-1652529725', 0, 0, 0, '2022-05-14 06:02:05', '2022-06-21 16:16:26', '2022-06-21 16:16:26'),
(21, 'Piper Zimmerman', 'Qui minim et impedit', 264, 31, 31, 'product_21_1652529754.png', 'piper-zimmerman-1652529754', 0, 0, 0, '2022-05-14 06:02:34', '2022-05-14 06:02:34', NULL),
(22, 'Chaim Munoz', 'Vel provident ex vo', 359, 47, 47, 'product_22_1652530145.png', 'chaim-munoz-1652530145', 0, 0, 0, '2022-05-14 06:09:05', '2022-06-04 02:02:12', NULL),
(23, 'Yvette Moore frgedr', 'Et harum facere inci', 130, 75, 75, 'product_23_1652652336.png', 'yvette-moore-frgedr-2litre-1652656383', 0, 0, 1, '2022-05-14 06:09:21', '2022-06-04 02:03:57', '2022-06-04 02:03:57'),
(24, 'Porter Benjamin', 'Laboriosam alias ea', 520, 72, 71, 'product_24_1652530174.png', 'porter-benjamin-1652530174', 0, 0, 1, '2022-05-14 06:09:34', '2022-07-23 13:45:42', NULL),
(25, 'Hunter Long', 'Quo voluptatem Aut', 793, 18, 18, 'product_25_1652530184.png', 'hunter-long-1652530184', 0, 0, 0, '2022-05-14 06:09:44', '2022-06-04 02:02:29', NULL),
(26, 'Althea Chase', 'Unde culpa ad beatae', 908, 78, 78, 'product_26_1652530264.png', 'althea-chase-1652530264', 0, 0, 0, '2022-05-14 06:11:04', '2022-06-04 02:03:26', '2022-06-04 02:03:26'),
(27, 'Michelle Arnold', 'Nulla minima eiusmod', 868, 71, 71, 'product_27_1652530392.png', 'michelle-arnold-1652530392', 0, 0, 0, '2022-05-14 06:13:12', '2022-05-14 06:13:12', NULL),
(28, 'Laurel Blackwell', 'Commodi nihil eligen', 583, 75, 75, 'product_28_1652530941.png', 'laurel-blackwell-1652530941', 0, 0, 0, '2022-05-14 06:22:21', '2022-05-14 06:22:21', NULL),
(31, 'Nerea Miller', 'Ut laborum Nobis il', 742, 100, 98, 'product_31_1652532155.png', 'nerea-miller-1652532155', 1, 0, 1, '2022-05-14 06:42:35', '2022-07-23 13:50:22', NULL),
(32, 'Octavius Rodgers', 'Ad quia voluptatem t', 973, 39, 36, 'product_32_1652532445.png', 'octavius-rodgers-1652532445', 0, 0, 1, '2022-05-14 06:47:25', '2022-06-22 04:46:00', NULL),
(33, 'Ila Sanders', 'Exercitationem nostr', 881, 8, 8, 'product_33_1652532487.png', 'ila-sanders-1652532487', 0, 0, 0, '2022-05-14 06:48:07', '2022-06-04 02:02:29', NULL),
(34, 'Urielle Talley', 'Eu adipisci placeat', 416, 17, 17, 'product_34_1652532500.png', 'urielle-talley-1652532500', 0, 0, 0, '2022-05-14 06:48:20', '2022-06-04 02:03:57', '2022-06-04 02:03:57'),
(35, 'Josephine Acosta', 'Dolorum officiis qua', 132, 39, 37, 'product_35_1652532534.png', 'josephine-acosta-1652532534', 0, 0, 1, '2022-05-14 06:48:54', '2022-06-22 14:47:50', NULL),
(36, 'Shea Gilmore', 'Doloremque et labore', 114, 76, 76, 'product_36_1652532562.png', 'shea-gilmore-1652532562', 0, 0, 0, '2022-05-14 06:49:22', '2022-06-04 02:03:57', '2022-06-04 02:03:57'),
(37, 'Alden Newton', 'Reiciendis explicabo', 340, 5, 5, 'product_37_1652532573.png', 'alden-newton-1652532573', 1, 0, 0, '2022-05-14 06:49:33', '2022-06-04 02:02:12', NULL),
(38, 'Ashton Mendez', 'Non dolor ut repelle', 59, 48, 48, 'product_38_1652532602.png', 'ashton-mendez-1652532602', 0, 0, 0, '2022-05-14 06:50:02', '2022-06-04 02:02:12', NULL),
(39, 'Sebastian Rutledge', 'Veniam fugit adipi', 105, 47, 47, 'product_39_1652533365.png', 'sebastian-rutledge-1652533365', 0, 0, 0, '2022-05-14 07:02:45', '2022-05-14 07:02:45', NULL),
(40, 'Macaulay Valdez', 'Excepteur omnis enim', 597, 27, 18, 'product_40_1652533430.png', 'macaulay-valdez-1652533430', 1, 0, 1, '2022-05-14 07:03:50', '2022-07-23 13:50:23', NULL),
(41, 'Shelby Kennedy', 'Id magnam duis et n', 155, 85, 85, 'product_41_1652533837.png', 'shelby-kennedy-1652533837', 0, 0, 0, '2022-05-14 07:10:37', '2022-06-04 02:03:57', '2022-06-04 02:03:57'),
(42, 'Logan Pacheco', 'Qui alias aut explic', 270, 90, 90, 'product_42_1652533908.png', 'logan-pacheco-1652533908', 0, 0, 0, '2022-05-14 07:11:48', '2022-06-04 02:03:26', '2022-06-04 02:03:26'),
(43, 'Minerva Mills', 'Et quibusdam volupta', 548, 3, 3, 'product_43_1652533931.png', 'minerva-mills-1652533931', 0, 0, 0, '2022-05-14 07:12:11', '2022-05-14 07:12:11', NULL),
(44, 'Berk William', 'Quas accusantium tem', 23, 89, 89, 'product_44_1652534132.png', 'berk-william-1652534132', 0, 0, 0, '2022-05-14 07:15:32', '2022-06-04 02:02:12', NULL),
(45, 'Lucy Hampton', 'Sit quo recusandae', 323, 27, 27, 'product_45_1652534160.png', 'lucy-hampton-1652534160', 0, 0, 0, '2022-05-14 07:16:00', '2022-06-04 02:03:26', '2022-06-04 02:03:26'),
(46, 'Summer Noble', 'Corrupti et labore', 869, 6, 6, 'product_46_1652534236.png', 'summer-noble-1652534236', 0, 0, 0, '2022-05-14 07:17:16', '2022-06-04 02:03:57', '2022-06-04 02:03:57'),
(47, 'Bo Harmon', 'Sequi voluptas perfe', 828, 28, 28, 'product_47_1652534502.png', 'bo-harmon-1652534502', 0, 0, 0, '2022-05-14 07:21:42', '2022-06-04 02:02:12', NULL),
(48, 'Shaeleigh Sloan', 'Laboris dolor quaera', 431, 85, 85, 'product_48_1652535620.png', 'shaeleigh-sloan-1652535620', 0, 0, 0, '2022-05-14 07:40:20', '2022-05-14 07:40:20', NULL),
(49, 'Jared Sawyer', 'Optio cumque sequi', 711, 43, 39, 'product_49_1652535655.png', 'jared-sawyer-1652535655', 0, 0, 1, '2022-05-14 07:40:55', '2022-07-23 13:50:23', NULL),
(50, 'Hayes Newton', 'Voluptates facere ap', 665, 54, 54, 'product_50_1652535744.png', 'hayes-newton-1652535744', 0, 0, 0, '2022-05-14 07:42:24', '2022-06-04 02:02:29', NULL),
(51, 'Ivy Snyder', 'Dolor iusto et qui e', 856, 38, 38, 'product_51_1652536435.png', 'ivy-snyder-1652536435', 0, 0, 0, '2022-05-14 07:53:55', '2022-06-04 02:02:29', NULL),
(52, 'Raja Wiley', 'Exercitationem omnis', 170, 26, 26, 'product_52_1652536749.png', 'raja-wiley-1652536749', 0, 0, 0, '2022-05-14 07:59:09', '2022-05-14 07:59:09', NULL),
(53, 'Mercedes Acevedo', 'Ad repudiandae nihil', 65, 56, 56, 'product_53_1652536768.png', 'mercedes-acevedo-1652536768', 0, 0, 0, '2022-05-14 07:59:28', '2022-05-14 07:59:28', NULL),
(54, 'Marny Moran', 'Laudantium inventor', 175, 26, 26, 'product_54_1652536818.png', 'marny-moran-1652536818', 0, 0, 0, '2022-05-14 08:00:18', '2022-05-14 08:00:18', NULL),
(55, 'Xanthus Roberson', 'Quidem tempor eum su', 887, 4, 4, 'product_55_1652536837.png', 'xanthus-roberson-42litre-1652966833', 0, 0, 1, '2022-05-14 08:00:37', '2022-06-04 02:03:57', '2022-06-04 02:03:57'),
(56, 'Lenore Hurley', 'Qui laborum Volupta', 896, 23, 16, 'product_56_1652536880.png', 'lenore-hurley-1652536880', 0, 0, 1, '2022-05-14 08:01:20', '2022-07-03 12:31:40', NULL),
(57, 'Yael Le', 'Ea ea id aperiam mi', 598, 62, 62, 'product_57_1652536962.png', 'yael-le-1652536962', 0, 0, 0, '2022-05-14 08:02:42', '2022-06-04 02:03:26', '2022-06-04 02:03:26'),
(58, 'gfnfg f frgj fg', 'fghfghdf', 666, 55, 55, 'product_58_1652537051.png', 'gfnfg-f-frgj-fg-1652537051', 0, 0, 0, '2022-05-14 08:04:11', '2022-06-04 02:02:29', NULL),
(59, 'Rama Gutierrez', 'Dolor pariatur Fugi', 128, 59, 59, 'product_59_1652537442.png', 'rama-gutierrez-1652537442', 0, 0, 0, '2022-05-14 08:10:42', '2022-05-14 08:10:43', NULL),
(61, 'Scott Kent', 'Beatae laboris magna', 770, 38, 38, 'product_61_1652537591.png', 'scott-kent-1652537591', 0, 0, 0, '2022-05-14 08:13:11', '2022-05-14 08:13:12', NULL),
(62, 'MacKensie Little', 'Ullam facilis fugiat', 175, 41, 38, 'product_62_1652537619.png', 'mackensie-little-1652537619', 1, 0, 1, '2022-05-14 08:13:39', '2022-07-03 12:31:40', NULL),
(63, 'Howard Ruiz', 'Est non do laudantiu', 645, 45, 45, 'product_63_1652537633.png', 'howard-ruiz-1652537633', 0, 0, 0, '2022-05-14 08:13:53', '2022-06-04 02:02:29', NULL),
(64, 'Vladimir Middleton', 'Alias ullam optio n', 380, 54, 54, 'product_64_1652537645.png', 'vladimir-middleton-1652537645', 0, 0, 0, '2022-05-14 08:14:05', '2022-06-04 02:03:26', '2022-06-04 02:03:26'),
(66, 'Summer Rodriquez', 'Earum est et dolorem', 500, 16, 16, 'product_66_1652537699.png', 'summer-rodriquez-1652537699', 0, 0, 0, '2022-05-14 08:14:59', '2022-06-04 02:03:57', '2022-06-04 02:03:57'),
(67, 'Gregory Salas', 'Enim tempore sequi', 434, 100, 100, 'product_67_1652537711.png', 'gregory-salas-1652537711', 0, 0, 0, '2022-05-14 08:15:11', '2022-06-04 02:02:29', NULL),
(69, 'Chanda Stein', 'Blanditiis deleniti', 3, 63, 63, 'product_69_1652547297.png', 'chanda-stein-1652547297', 0, 0, 0, '2022-05-14 10:54:57', '2022-06-04 02:02:29', NULL),
(70, 'Fulton Nunez', 'Aut ut maxime ipsum', 684, 67, 67, 'product_70_1652547344.png', 'fulton-nunez-1652547344', 0, 0, 0, '2022-05-14 10:55:44', '2022-06-04 02:02:29', NULL),
(73, 'Tyler Anthony', 'Eiusmod numquam a el', 817, 81, 81, 'product_73_1652547567.png', 'tyler-anthony-1652547567', 0, 0, 0, '2022-05-14 10:59:27', '2022-06-04 02:03:57', '2022-06-04 02:03:57'),
(75, 'Jesse Bauer', 'Eum molestiae mollit', 221, 34, 26, 'product_75_1652547618.png', 'jesse-bauer-1652547618', 0, 0, 1, '2022-05-14 11:00:18', '2022-07-23 13:45:42', NULL),
(76, 'Keaton Hinton', 'Distinctio Non sequ', 386, 51, 49, 'product_76_1652547680.png', 'keaton-hinton-1652547680', 0, 0, 1, '2022-05-14 11:01:20', '2022-06-22 04:23:31', NULL),
(77, 'Jamal Roach', 'Et minus similique a', 142, 20, 20, 'product_77_1652547692.png', 'jamal-roach-1652547692', 0, 0, 0, '2022-05-14 11:01:32', '2022-06-04 02:02:29', NULL),
(79, 'Kiona Pearson', 'Est magna ut verita', 594, 50, 49, 'product_79_1652547826.png', 'kiona-pearson-1652547826', 1, 0, 1, '2022-05-14 11:03:46', '2022-07-23 13:36:48', NULL),
(80, 'Joan Good', 'Dolor vel culpa labo', 130, 79, 77, 'product_80_1652547875.png', 'joan-good-1652547875', 0, 0, 1, '2022-05-14 11:04:35', '2022-07-28 09:31:56', NULL),
(81, 'Leilani Love', 'Voluptate totam dolo', 44, 40, 40, 'product_81_1652547885.png', 'leilani-love-1652547885', 0, 0, 0, '2022-05-14 11:04:45', '2022-05-14 11:04:45', NULL),
(83, 'Harrison Wade', 'Tempore veniam ten', 220, 98, 98, 'product_83_1652547995.png', 'harrison-wade-1652547995', 0, 0, 0, '2022-05-14 11:06:35', '2022-06-04 02:02:29', NULL),
(84, 'Barry Landry', 'Nostrum praesentium', 582, 26, 14, 'product_84_1652548019.png', 'barry-landry-91piece-1652798450', 0, 1, 1, '2022-05-14 11:06:59', '2022-06-22 14:47:59', NULL),
(85, 'Ora Green', 'Sed veniam earum ip', 833, 12, 12, 'product_85_1652548031.png', 'ora-green-1652548031', 0, 0, 0, '2022-05-14 11:07:11', '2022-05-31 14:54:59', NULL),
(86, 'Dean Mcmillan', 'Nesciunt dolores qu', 284, 25, 25, 'product_86_1652548046.png', 'dean-mcmillan-1652548046', 0, 0, 0, '2022-05-14 11:07:26', '2022-06-04 02:02:29', NULL),
(87, 'Jaquelyn Noble', 'Ipsum at accusamus a', 938, 25, 25, 'product_87_1652548094.png', 'jaquelyn-noble-1652548094', 0, 0, 0, '2022-05-14 11:08:14', '2022-06-04 02:02:29', NULL),
(88, 'Nola Roth', 'Deleniti enim doloru', 74, 44, 44, 'product_88_1652548110.png', 'nola-roth-1652548110', 0, 0, 0, '2022-05-14 11:08:30', '2022-05-14 11:08:30', NULL),
(89, 'Ruby Weber', 'Pariatur Maxime nos', 956, 2, 2, 'product_89_1652548123.png', 'ruby-weber-1652548123', 0, 0, 0, '2022-05-14 11:08:43', '2022-06-04 02:03:26', '2022-06-04 02:03:26'),
(90, 'Hakeem Wiggins', 'Consequatur sed tene', 98, 40, 40, 'product_90_1652548177.png', 'hakeem-wiggins-1652548177', 0, 0, 0, '2022-05-14 11:09:37', '2022-06-04 02:02:29', NULL),
(91, 'Kylie Mayer', 'Exercitationem sint', 395, 52, 51, 'product_91_1652548196.png', 'kylie-mayer-1652548196', 0, 0, 1, '2022-05-14 11:09:56', '2022-06-22 15:03:58', NULL),
(92, 'Hedy Dean', 'Commodo reprehenderi', 73, 91, 91, 'product_92_1652548266.png', 'hedy-dean-1652548266', 0, 0, 0, '2022-05-14 11:11:06', '2022-06-04 02:02:29', NULL),
(93, 'Kaitlin Robertson', 'Ut quo atque debitis', 729, 77, 74, 'product_93_1652548339.png', 'kaitlin-robertson-31kg-1652901538', 1, 0, 1, '2022-05-14 11:12:19', '2022-07-23 15:33:33', NULL),
(94, 'Carol Wilder', 'Qui reiciendis volup', 914, 96, 96, 'product_94_1652548379.png', 'carol-wilder-1652548379', 0, 0, 0, '2022-05-14 11:12:59', '2022-06-04 02:02:12', NULL),
(96, 'Xandra Hubbard', 'Ut explicabo Duis a', 365, 50, 50, 'product_96_1652548422.png', 'xandra-hubbard-1652548422', 0, 0, 1, '2022-05-14 11:13:42', '2022-06-04 02:03:57', '2022-06-04 02:03:57'),
(98, 'Brenna Hernandez', 'Est nihil numquam qu', 200, 50, 39, 'product_98_1652797017.png', 'brenna-hernandez-250ml-1652797585', 0, 1, 1, '2022-05-14 11:16:01', '2022-06-22 15:03:58', NULL),
(99, 'Kermit Mathews', 'Totam sit at incidi', 373, 25, 14, 'product_99_1652548710.png', 'kermit-mathews-1652548710', 0, 0, 1, '2022-05-14 11:18:30', '2022-07-23 13:50:22', NULL),
(100, 'Germaine Bentley', 'Aliquam necessitatib', 290, 97, 97, 'product_100_1652548792.png', 'germaine-bentley-1652548792', 0, 0, 0, '2022-05-14 11:19:52', '2022-06-04 02:02:29', NULL),
(101, 'Hyacinth Frank', 'Molestias ullamco au', 775, 47, 47, 'product_101_1652548808.png', 'hyacinth-frank-94litre-1652788274', 0, 0, 0, '2022-05-14 11:20:08', '2022-06-04 02:02:29', NULL),
(102, 'Yvette Moore', 'Et harum facere inci', 78, 62, 62, 'product_102_1652625555.png', 'yvette-moore-1652625555', 0, 0, 0, '2022-05-15 08:39:15', '2022-06-04 02:03:57', NULL),
(104, 'Alana Graves', 'Aut velit sapiente d', 318, 73, 73, 'product_104_1652726083.png', 'alana-graves-96lb-1652796012', 1, 0, 0, '2022-05-16 12:34:43', '2022-06-04 02:02:12', NULL),
(109, 'McKenzie Pickett', 'Fugit non fugit oc', 624, 52, 47, 'product_109_1652726571.png', 'mckenzie-pickett-18lb-1652803704', 1, 1, 1, '2022-05-16 12:42:51', '2022-07-23 13:36:48', NULL),
(110, 'Jerome Cantu', NULL, 620, 65, 59, 'product_110_1652729929.png', 'jerome-cantu-62oz-1652729929', 0, 1, 1, '2022-05-16 13:38:49', '2022-06-22 15:03:58', NULL),
(111, 'Hilel Orr', 'Officiis distinctio', 100, 67, 55, 'product_111_1653862851.png', 'hilel-orr-45lb-1653862973', 0, 1, 1, '2022-05-29 16:20:51', '2022-07-23 15:33:33', NULL),
(112, 'Roanna Noble', 'Proident velit dolo', 10600, 51, 47, 'product_112_1654169138.png', 'roanna-noble-95piece-1654169356', 0, 0, 1, '2022-06-02 05:25:38', '2022-07-23 15:33:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_discounts`
--

CREATE TABLE `product_discounts` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `discount_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_discounts`
--

INSERT INTO `product_discounts` (`product_id`, `discount_id`) VALUES
(37, 1),
(104, 7),
(93, 5),
(109, 5),
(62, 5),
(79, 5),
(31, 5),
(40, 5);

-- --------------------------------------------------------

--
-- Table structure for table `product_multiple_photos`
--

CREATE TABLE `product_multiple_photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `multiple_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_multiple_photos`
--

INSERT INTO `product_multiple_photos` (`id`, `product_id`, `multiple_photo`, `created_at`, `updated_at`) VALUES
(35, 20, 'product_20_1652529725_1.png', '2022-05-14 06:02:05', '2022-05-14 06:02:05'),
(36, 21, 'product_21_1652529754_1.png', '2022-05-14 06:02:34', '2022-05-14 06:02:34'),
(37, 21, 'product_21_1652529754_2.png', '2022-05-14 06:02:34', '2022-05-14 06:02:34'),
(39, 26, 'product_26_1652530264_1.png', '2022-05-14 06:11:04', '2022-05-14 06:11:04'),
(40, 34, 'product_34_1652532500_1.png', '2022-05-14 06:48:20', '2022-05-14 06:48:20'),
(79, 104, 'product_104_165272608322_1.png', '2022-05-16 12:34:44', '2022-05-16 12:34:44'),
(80, 104, 'product_104_165272608477_2.png', '2022-05-16 12:34:44', '2022-05-16 12:34:44'),
(90, 109, 'product_109_165272657236_2.png', '2022-05-16 12:42:52', '2022-05-16 12:42:52'),
(91, 110, 'product_110_165272993096_1.png', '2022-05-16 13:38:50', '2022-05-16 13:38:50'),
(92, 110, 'product_110_165272993019_2.png', '2022-05-16 13:38:50', '2022-05-16 13:38:50'),
(95, 98, 'product_98_165279701794_1.png', '2022-05-17 08:16:57', '2022-05-17 08:16:57'),
(96, 98, 'product_98_165279701772_2.png', '2022-05-17 08:16:57', '2022-05-17 08:16:57'),
(98, 111, 'product_111_165386285279_1.png', '2022-05-29 16:20:52', '2022-05-29 16:20:52'),
(99, 111, 'product_111_165386285294_2.png', '2022-05-29 16:20:52', '2022-05-29 16:20:52'),
(100, 111, 'product_111_165386285237_3.png', '2022-05-29 16:20:52', '2022-05-29 16:20:52'),
(101, 112, 'product_112_165416913999_1.png', '2022-06-02 05:25:39', '2022-06-02 05:25:39'),
(102, 112, 'product_112_165416913988_2.png', '2022-06-02 05:25:39', '2022-06-02 05:25:39'),
(103, 112, 'product_112_165416913933_3.png', '2022-06-02 05:25:39', '2022-06-02 05:25:39');

-- --------------------------------------------------------

--
-- Table structure for table `product_product_size`
--

CREATE TABLE `product_product_size` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_size_id` bigint(20) UNSIGNED NOT NULL,
  `size_value` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_product_size`
--

INSERT INTO `product_product_size` (`product_id`, `product_size_id`, `size_value`) VALUES
(20, 5, 61),
(21, 2, 69),
(22, 8, 96),
(24, 8, 22),
(25, 1, 95),
(26, 1, 17),
(27, 2, 29),
(28, 5, 73),
(31, 8, 37),
(32, 2, 18),
(33, 7, 23),
(34, 3, 78),
(35, 8, 51),
(36, 8, 94),
(37, 3, 66),
(38, 8, 48),
(39, 7, 39),
(40, 1, 12),
(41, 8, 58),
(42, 3, 9),
(43, 7, 84),
(44, 6, 40),
(45, 2, 51),
(46, 6, 66),
(47, 8, 100),
(48, 5, 23),
(49, 8, 13),
(50, 1, 29),
(51, 3, 38),
(52, 2, 85),
(53, 6, 95),
(54, 2, 81),
(55, 5, 42),
(56, 1, 90),
(57, 8, 10),
(58, 3, 1),
(59, 5, 69),
(61, 2, 76),
(62, 1, 16),
(63, 7, 39),
(64, 7, 94),
(66, 7, 34),
(67, 3, 89),
(69, 6, 25),
(70, 2, 67),
(73, 1, 27),
(75, 7, 75),
(76, 3, 24),
(77, 5, 36),
(79, 5, 13),
(80, 3, 45),
(81, 1, 87),
(83, 2, 23),
(84, 7, 91),
(85, 7, 10),
(86, 1, 43),
(87, 8, 87),
(88, 5, 51),
(89, 2, 50),
(90, 3, 40),
(91, 7, 74),
(92, 6, 68),
(93, 3, 31),
(94, 2, 77),
(96, 6, 29),
(99, 5, 19),
(100, 2, 29),
(101, 5, 94),
(102, 1, 63),
(23, 5, 2),
(104, 8, 96),
(109, 8, 18),
(110, 6, 62),
(98, 1, 250),
(111, 8, 45),
(112, 7, 95);

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `review_rating` int(11) NOT NULL,
  `review_feedback` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `user_id`, `product_id`, `user_name`, `user_email`, `review_rating`, `review_feedback`, `created_at`, `updated_at`) VALUES
(1, 2, 80, 'smith', 'smith@gmail.com', 4, 'g rty rty rty rty rty rty rty', '2022-06-22 13:11:48', '2022-06-22 13:11:48'),
(2, 2, 111, 'smith', 'smith@gmail.com', 3, 'et ujrfgsdjfugsdufg ii saidfu isdfisadifisgdil is sidgfi sdifgi idg isad fsdf', '2022-06-22 13:56:17', '2022-06-22 13:56:17');

-- --------------------------------------------------------

--
-- Table structure for table `product_views`
--

CREATE TABLE `product_views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_views`
--

INSERT INTO `product_views` (`id`, `user_ip`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(4, '127.0.0.3', 1, 110, '2022-05-30 16:08:12', '2022-05-30 16:08:12'),
(5, '127.0.0.2', NULL, 110, '2022-05-30 16:26:31', '2022-05-30 16:26:31'),
(6, '127.0.0.5', NULL, 110, '2022-05-30 16:31:37', '2022-05-30 16:31:37'),
(7, '127.0.0.4', 2, 110, '2022-05-30 16:31:55', '2022-05-30 16:31:55'),
(8, '127.0.0.6', NULL, 110, '2022-05-30 16:35:29', '2022-05-30 16:35:29'),
(9, '127.0.0.1', NULL, 110, '2022-05-30 16:42:37', '2022-05-30 16:42:37'),
(10, '127.0.0.1', 1, 111, '2022-05-30 18:24:54', '2022-05-30 18:24:54'),
(11, '127.0.0.1', 1, 109, '2022-05-30 18:27:12', '2022-05-30 18:27:12'),
(12, '127.0.0.1', 1, 49, '2022-05-31 08:45:43', '2022-05-31 08:45:43'),
(13, '127.0.0.1', 1, 76, '2022-05-31 09:26:08', '2022-05-31 09:26:08'),
(14, '127.0.0.1', 1, 91, '2022-05-31 09:26:45', '2022-05-31 09:26:45'),
(15, '127.0.0.1', 1, 99, '2022-05-31 09:27:57', '2022-05-31 09:27:57'),
(16, '127.0.0.1', 1, 35, '2022-05-31 09:30:09', '2022-05-31 09:30:09'),
(17, '127.0.0.1', 1, 23, '2022-05-31 14:55:32', '2022-05-31 14:55:32'),
(18, '127.0.0.1', 1, 55, '2022-06-01 03:53:18', '2022-06-01 03:53:18'),
(19, '127.0.0.1', 1, 102, '2022-06-01 15:50:36', '2022-06-01 15:50:36'),
(20, '127.0.0.1', 1, 31, '2022-06-01 15:52:00', '2022-06-01 15:52:00'),
(21, '127.0.0.1', 1, 56, '2022-06-01 15:54:59', '2022-06-01 15:54:59'),
(22, '127.0.0.1', 1, 96, '2022-06-01 15:55:03', '2022-06-01 15:55:03'),
(23, '127.0.0.1', 1, 40, '2022-06-01 15:59:02', '2022-06-01 15:59:02'),
(24, '127.0.0.1', 1, 75, '2022-06-01 16:02:33', '2022-06-01 16:02:33'),
(25, '127.0.0.1', 1, 80, '2022-06-01 16:03:58', '2022-06-01 16:03:58'),
(26, '127.0.0.1', 1, 62, '2022-06-01 16:04:17', '2022-06-01 16:04:17'),
(27, '127.0.0.1', 1, 93, '2022-06-01 16:07:24', '2022-06-01 16:07:24'),
(28, '127.0.0.1', 1, 79, '2022-06-01 16:19:31', '2022-06-01 16:19:31'),
(29, '127.0.0.1', 1, 32, '2022-06-01 16:19:49', '2022-06-01 16:19:49'),
(30, '127.0.0.1', 1, 24, '2022-06-01 16:20:02', '2022-06-01 16:20:02'),
(31, '127.0.0.1', 1, 112, '2022-06-02 05:30:34', '2022-06-02 05:30:34'),
(32, '127.0.0.1', 1, 98, '2022-06-05 07:57:14', '2022-06-05 07:57:14'),
(33, '127.0.0.1', 2, 111, '2022-06-05 13:51:43', '2022-06-05 13:51:43'),
(34, '127.0.0.1', 3, 110, '2022-06-05 15:05:29', '2022-06-05 15:05:29'),
(35, '127.0.0.1', 2, 84, '2022-06-06 07:30:15', '2022-06-06 07:30:15'),
(36, '127.0.0.1', 2, 80, '2022-06-06 07:31:05', '2022-06-06 07:31:05'),
(37, '127.0.0.1', 2, 40, '2022-06-06 07:32:17', '2022-06-06 07:32:17'),
(38, '127.0.0.1', 2, 99, '2022-06-06 07:47:45', '2022-06-06 07:47:45'),
(39, '127.0.0.1', 2, 56, '2022-06-22 09:29:23', '2022-06-22 09:29:23'),
(40, '127.0.0.1', 2, 98, '2022-06-22 10:04:12', '2022-06-22 10:04:12'),
(41, '127.0.0.1', 2, 112, '2022-06-22 10:48:36', '2022-06-22 10:48:36'),
(42, '127.0.0.1', 2, 49, '2022-06-22 13:57:32', '2022-06-22 13:57:32'),
(43, '127.0.0.1', 2, 109, '2022-06-22 15:11:59', '2022-06-22 15:11:59'),
(44, '127.0.0.1', 16, 93, '2022-06-27 08:31:59', '2022-06-27 08:31:59');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `scale_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `scale_name`, `created_at`, `updated_at`) VALUES
(1, 'ml', '2022-05-13 11:37:02', '2022-05-13 11:37:02'),
(2, 'gm', '2022-05-13 11:37:08', '2022-05-13 11:37:08'),
(3, 'kg', '2022-05-13 11:37:12', '2022-05-13 11:37:12'),
(5, 'litre', '2022-05-13 11:37:37', '2022-05-13 11:37:47'),
(6, 'oz', '2022-05-13 11:37:59', '2022-05-13 11:37:59'),
(7, 'piece', '2022-05-13 11:38:08', '2022-05-13 11:38:08'),
(8, 'lb', '2022-05-13 11:38:56', '2022-05-13 11:38:56');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscriber_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscriber_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscribed` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `subscriber_id`, `subscriber_email`, `subscribed`, `created_at`, `updated_at`) VALUES
(1, '$2y$10$74MNS5QRw7ITjwLL56aaf.T8hlQdiDeHR8Lxg5W/Nqoeigqa5458i', 'sakdghf@gmail.com', 1, '2022-08-01 03:18:45', '2022-08-02 23:21:19'),
(2, '$2y$10$ixY8vG6C0yxc9ASTYaoDcOwpAvEe79UI3gPOqV/hbY9//lUlHuyOe', 'sdfakdghf@gmail.com', 0, '2022-08-02 23:21:49', '2022-08-02 23:22:12'),
(3, '$2y$10$f8SX2dCZFSj4BMrvzPcq6.NGsyIHdkYB40Y.d//A/sUlSK1Xv8pVu', 's@gmail.com', 0, '2022-08-03 01:27:57', '2022-08-03 01:28:11'),
(4, '$2y$10$7Ayx72uKckMMSSbtjX7fS.5BW0eFld4l62gqfbpvqF4IvXRQT5M/y', 'df@gmai.com', 1, '2022-08-03 03:13:29', '2022-08-03 03:13:29'),
(5, '$2y$10$0zgz1pMF4Ayi0cE21YuuV.mGE6FV1ez7S6xdT7vY7WaYwMoumI5rS', 'dfgdfg@gmail.com', 1, '2022-08-03 03:16:41', '2022-08-03 03:16:41'),
(6, '$2y$10$SFpxa10MHTsCH.mETFKo7OIgA7KPr1XI5AxP7AsEqvYUGKDedfkJS', 'df@gmail.com', 1, '2022-08-03 03:17:47', '2022-08-03 03:17:47'),
(7, '$2y$10$lzQBtBX1/S2.gVaH0ee4B.x.RShbl0I1XVsj4GT5KdaICyJHm63V2', 'sakdsdfsdfsdfsdghf@gmail.com', 1, '2022-08-03 03:19:24', '2022-08-03 03:19:24'),
(8, '$2y$10$XP5wyWH.H7Qc2qrHm0malOTi8NoAJr9BBc/7YyG/fQhdHrd2VHFmC', 'adf@gmai.com', 1, '2022-08-03 03:21:35', '2022-08-03 03:21:35'),
(9, '$2y$10$XGmYIHdumroixPwVou4nYOae6ksmSRoya1qeBOcA2nVWX56v/5lVW', 'saaaakdghf@gmail.com', 1, '2022-08-03 03:23:19', '2022-08-03 03:23:19'),
(10, '$2y$10$dtzH6qzTlHzfgkgJrlxE8.Auv3kRt23VMvTkjpYEgLm3.cyR.jIsq', 'aaadfgdfg@gmail.com', 1, '2022-08-03 03:33:10', '2022-08-03 03:33:10'),
(11, '$2y$10$gqxUpoc.Z7S02rdmi9iw/OvwkSenFR/ilwBenowB.4CvVgnkBsHRG', 'a@gmail.com', 0, '2022-08-03 03:36:08', '2022-08-03 03:40:01'),
(12, '$2y$10$Ev7PfPy.mv9YXEComd/b3O.vrkhbzVWm3/cFruDn82FoFMcs9rvf.', 'ff@gmail.com', 1, '2022-08-03 03:39:39', '2022-08-03 03:39:39'),
(13, '$2y$10$OVjoZLMZAWcuITH/tTJ/1OchxneFasmTEr3g2gkB28seN.lkX/ytO', 'adf@gmail.com', 1, '2022-08-03 09:02:49', '2022-08-03 09:02:49'),
(14, '$2y$10$xo75akobsU6MTg9ah4F1ueG8MOij1Pmmpf/jvh9KqgncQc8Py7MT2', 'ddddf@gmai.com', 1, '2022-08-03 09:03:52', '2022-08-03 09:03:52'),
(15, '$2y$10$H809z8XH3s6ZeQdpuzeQL.Ca1SMTtpvh.79Ok95wsszple/kqUI0.', 'dasasaf@gmai.com', 1, '2022-08-03 09:04:25', '2022-08-03 09:04:25'),
(16, '$2y$10$lphmV2ERx78pbhHd8tPmE.iZpdfmGD.SPMj/SKFv3lvFG.z2ts.RW', 'dfasd@gmai.com', 1, '2022-08-03 09:04:45', '2022-08-03 09:04:45'),
(17, '$2y$10$9Ghkr6Q/8BEwA/ZSVP3ZmOAIkzLfCkSfUFYZxjb7FsXBBJRdbFuk2', 'dffff@gmai.com', 1, '2022-08-03 09:06:34', '2022-08-03 09:06:34'),
(18, '$2y$10$kxIhwxYmpqlBTWBLJfHTLuitcLfWexl/ji0rLz.KYrb1KLC0NWRAa', 'dfs@gmai.com', 1, '2022-08-03 09:29:18', '2022-08-03 09:29:18'),
(19, '$2y$10$DikAk.yu3NkqI62zDh8eBuwEjVwmsAiZaUMUTwrmDn7TY2ubY5pZ6', 'fdgdfg@gmail.com', 1, '2022-08-03 09:33:20', '2022-08-03 09:33:20'),
(20, '$2y$10$2ze0IBdtCDm.ZhuKsQf4OuD3OFZo5EfKu3lcAQ0qGABr1q4gtPUSW', 'dfasa@gmai.com', 1, '2022-08-03 09:37:21', '2022-08-03 09:37:21'),
(21, '$2y$10$Rkh7t3w7nQh85v0SuG6ZGeC6YE7Gw8V2oBadjOyHYcS3Qet96613S', 'dfaaaaa@gmai.com', 1, '2022-08-03 09:39:10', '2022-08-03 09:39:10'),
(22, '$2y$10$uRcQcjOHFRvPZDJfhL2vGuI2byVXiV8vxc1uZTZwbD2PTt9hoMmn6', 'df@gmaidd.com', 1, '2022-08-03 09:40:38', '2022-08-03 09:40:38'),
(23, '$2y$10$IIytZ2Jn4L6c0kbQLuiyyeqvbBDASF0hx4xp80bwBEAMwRINXAYRC', 'daaaaf@gmai.com', 1, '2022-08-03 09:42:50', '2022-08-03 09:42:50'),
(24, '$2y$10$haQZ0YZXhMDHw7W3I5l54uvZAVu46mW6mAOxh6AqEpb8j9WsU1IPi', 'df@gmai.comm', 0, '2022-08-03 09:46:17', '2022-08-03 14:30:14'),
(25, '$2y$10$1t4ns0QbqpoRHerz1vjI.O8USGpeZvOEwSegfeMGmC5rVCY0O6wCK', 'dfaaaa@gmai.com', 0, '2022-08-04 02:53:32', '2022-08-04 02:57:47'),
(26, '$2y$10$EGkhHWjvfZcP0DGM0QCkTO79WgWQJrY1DSuD360Ghqy.PqFnTbOQ2', 'dddddf@gmai.com', 0, '2022-08-04 05:55:03', '2022-08-04 05:55:41'),
(27, '$2y$10$iY6YKraIrTpGr8NIHaimC.6GmzylMb3IK6E1uPjEOWLkbh/cviKsO', 'ssssssakdghf@gmail.com', 1, '2022-08-04 05:56:46', '2022-08-04 05:56:46'),
(28, '$2y$10$NiqLvbzsT4avv35Vnlh2sO6Ump1GaB4Z0V6GLXUk4.qeuCxuzz8Fi', 'sakdghsaasfafaf@gmail.com', 1, '2022-08-04 05:57:14', '2022-08-04 05:57:14'),
(29, '$2y$10$14oWOkHXMih6sMFP9FcVgODTLOhEsP/ZPf6hAzJEEoMzolRkBtyB.', 'dfasdasda@gmai.com', 1, '2022-08-04 06:00:40', '2022-08-04 06:00:40'),
(30, '$2y$10$9ayTXdP9ENWLIRdPLU1zpuQBNZpErWbUNTQkM0aJG17nJuu82Hq1S', 'sakdghassdf@gmail.com', 1, '2022-08-04 06:02:43', '2022-08-04 06:02:43'),
(31, '$2y$10$m4OzLAtkR5UKcWvKiRCxZuOhIcxcdiVnuqdi61cm/cS2qARDNOOvG', 'dasasasf@gmai.com', 0, '2022-08-04 06:03:42', '2022-08-07 10:04:58'),
(32, '$2y$10$jSaRv81QaKTO/xBF2fOh3ekknc5JmijiToMSqD2rIHxrz6LiunGYC', 'df@dfgmai.com', 1, '2022-08-04 11:10:41', '2022-08-04 11:10:41'),
(33, '$2y$10$WxVYWcwCvFj6Ty1SjV3z7ubQUp5ZiVEGC0QnOFyW1YAxzm9.CYGAu', 'sasdfsdfsdfsdfkdghf@gmail.com', 0, '2022-08-07 10:04:17', '2022-08-07 10:08:01'),
(34, '$2y$10$w74x24KDoA.SGd.PNMQEp.W9zXw8MTwsrvwWJuDZmWu3OFT9.s86O', 'dasdasdasdasdasdaf@gmai.com', 1, '2022-08-07 10:10:14', '2022-08-07 10:10:14'),
(35, '$2y$10$v5ZEVmdOhmaHVhWZaqcwpe0ocr3B5m4RR.d4GiTgkRf9v/m50hDt.', 'dfdf@gmai.com', 1, '2022-08-07 10:15:17', '2022-08-07 10:15:17'),
(36, '$2y$10$ChXuUqFzbtY53Tsrhfh2/usNaRcapRvrjFUSGMit7bAGx/mDnGmqy', 'dfdsfsdf@gmai.com', 0, '2022-08-07 10:16:46', '2022-08-07 10:17:46'),
(37, '$2y$10$JehK6uI.mBqe7YOlNXmPcuA9Inw9HH7/yyrBcGmajowJoIzHeQBSi', 'sarkdghf@gmail.com', 1, '2022-08-07 10:20:20', '2022-08-07 10:20:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'steve', 'steve@gmail.com', '2022-05-12 19:50:37', '$2y$10$bOQNjOS2HnkrRr34gx4DZeNz1TiifONcgo2.t.HM3ZmWBDS8Efx5K', 1, 'AR4cZZCLM1bldNuxXcA1K1ohu9US7mSrkiPYo53vjJiMsRUPlBoMeQaDYr12', '2022-05-12 13:49:15', '2022-05-12 13:49:15'),
(2, 'smith', 'smith@gmail.com', '2022-05-12 19:50:41', '$2y$10$c2ccFvm4O.JJqLbMherNle5dOw7fxUk2pMr0KyC1iFHLCI.iZZwOS', 0, 'UYeOfGdOiewRPPlnFZJyTN7UmW0VIGr45FbMHVdQXh6j1S71rn7g2ycrx38S', '2022-05-12 13:50:07', '2022-07-12 03:37:20'),
(3, 'jack', 'jack@gmail.com', '2022-05-12 14:27:35', '$2y$10$mLM3f1/pOIJelszyZHq1kuIVNz6ejS8r2piyO5dBL4/QmA/b83dsu', 1, NULL, '2022-05-12 14:27:20', '2022-05-12 14:27:35'),
(14, 'admin', 'admin@admin.com', '2022-06-03 15:39:18', '$2y$10$xIwp1Ouu6ZetjhtQv4n2TOBQX.1MPQUIuMrheZ3GcbffOd1EOZtuq', 1, NULL, NULL, NULL),
(16, 'customer', 'customer@gmail.com', '2022-06-04 19:28:10', '$2y$10$ucF1m2ad7tnFZiK4tFMfb.gesIUAO.rurLVHGePimdmkQgVyJy1M6', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `avatar`, `phone`, `city`, `country`, `address`, `created_at`, `updated_at`) VALUES
(1, 1, 'avatar11652450334.jpg', 4564567457, '3', '5', NULL, '2022-05-12 13:49:29', '2022-05-16 07:04:51'),
(2, 2, NULL, 456546546, '5', '6', 'dfgh h h rt 57  456 fgh', '2022-05-12 13:50:12', '2022-07-03 12:29:36'),
(3, 3, NULL, NULL, NULL, NULL, NULL, '2022-05-12 14:27:24', '2022-05-12 14:27:24'),
(4, 14, NULL, NULL, NULL, NULL, NULL, '2022-05-14 04:43:45', '2022-05-14 04:43:45'),
(6, 16, NULL, NULL, NULL, NULL, NULL, '2022-06-04 13:28:03', '2022-06-04 13:28:03');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 1, 96, '2022-06-02 12:36:38', '2022-06-02 12:36:38'),
(3, 3, 99, '2022-06-02 12:44:35', '2022-06-02 12:44:35'),
(7, 3, 24, '2022-06-02 17:30:32', '2022-06-02 17:30:32'),
(10, 3, 23, '2022-06-03 12:24:48', '2022-06-03 12:24:48'),
(23, 1, 102, '2022-06-04 07:53:37', '2022-06-04 07:53:37'),
(26, 1, 32, '2022-06-04 11:24:43', '2022-06-04 11:24:43'),
(49, 16, 56, '2022-06-04 13:40:57', '2022-06-04 13:40:57'),
(50, 1, 93, '2022-06-05 07:56:18', '2022-06-05 07:56:18'),
(51, 1, 98, '2022-06-05 07:57:10', '2022-06-05 07:57:10'),
(56, 3, 75, '2022-06-05 14:09:30', '2022-06-05 14:09:30'),
(57, 3, 62, '2022-06-05 14:09:41', '2022-06-05 14:09:41'),
(61, 3, 35, '2022-06-05 14:49:15', '2022-06-05 14:49:15'),
(71, 2, 99, '2022-06-06 06:30:25', '2022-06-06 06:30:25'),
(72, 2, 93, '2022-06-06 06:30:27', '2022-06-06 06:30:27'),
(78, 2, 112, '2022-06-13 02:30:58', '2022-06-13 02:30:58'),
(79, 2, 109, '2022-06-22 15:12:42', '2022-06-22 15:12:42'),
(80, 2, 40, '2022-06-24 09:35:26', '2022-06-24 09:35:26'),
(81, 2, 79, '2022-06-24 09:35:26', '2022-06-24 09:35:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_parent_category_foreign` (`parent_category`);

--
-- Indexes for table `category_product`
--
ALTER TABLE `category_product`
  ADD KEY `category_product_product_id_foreign` (`product_id`),
  ADD KEY `category_product_category_id_foreign` (`category_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_country_id_foreign` (`country_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_discounts`
--
ALTER TABLE `product_discounts`
  ADD KEY `product_discounts_product_id_foreign` (`product_id`),
  ADD KEY `product_discounts_discount_id_foreign` (`discount_id`);

--
-- Indexes for table `product_multiple_photos`
--
ALTER TABLE `product_multiple_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_multiple_photos_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_product_size`
--
ALTER TABLE `product_product_size`
  ADD KEY `product_product_size_product_id_foreign` (`product_id`),
  ADD KEY `product_product_size_product_size_id_foreign` (`product_size_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_reviews_user_id_foreign` (`user_id`),
  ADD KEY `product_reviews_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_views`
--
ALTER TABLE `product_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_views_user_id_foreign` (`user_id`),
  ADD KEY `product_views_product_id_foreign` (`product_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscribers_subscriber_id_unique` (`subscriber_id`),
  ADD UNIQUE KEY `subscribers_subscriber_email_unique` (`subscriber_email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_details_user_id_foreign` (`user_id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `product_multiple_photos`
--
ALTER TABLE `product_multiple_photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_views`
--
ALTER TABLE `product_views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_category_foreign` FOREIGN KEY (`parent_category`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `category_product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `product_discounts`
--
ALTER TABLE `product_discounts`
  ADD CONSTRAINT `product_discounts_discount_id_foreign` FOREIGN KEY (`discount_id`) REFERENCES `discounts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_discounts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_multiple_photos`
--
ALTER TABLE `product_multiple_photos`
  ADD CONSTRAINT `product_multiple_photos_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_product_size`
--
ALTER TABLE `product_product_size`
  ADD CONSTRAINT `product_product_size_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_product_size_product_size_id_foreign` FOREIGN KEY (`product_size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_views`
--
ALTER TABLE `product_views`
  ADD CONSTRAINT `product_views_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_views_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

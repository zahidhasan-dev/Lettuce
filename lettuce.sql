-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2023 at 12:31 AM
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
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `about_sub_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_desc_1` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_desc_2` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_author_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_author_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `about_sub_title`, `about_title`, `about_desc_1`, `about_desc_2`, `about_author_name`, `about_author_title`, `about_image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Alias alias est occaecati.', 'Aut ipsam distinctio ut.', 'Occaecati maxime quidem voluptatibus illum quas quia voluptatem. Temporibus dolore quas ea et eos enim ipsa. Non suscipit non amet ratione asperiores ipsum corporis ad. Necessitatibus repellat repudiandae sequi rerum ea nobis.', 'Voluptatem mollitia enim illum perferendis. Corrupti voluptas aliquid molestiae voluptatem vel vitae. Quia consectetur et porro velit. Hic illo omnis est neque sunt explicabo est inventore. Numquam animi veniam consequatur cupiditate.', 'Wanda Aufderhar PhD', 'CEO', 'about_1_166495009012.png', 1, '2023-07-16 20:52:23', NULL),
(2, 'Blanditiis nesciunt velit nesciunt.', 'Omnis voluptas cupiditate et.', 'Ullam tempore optio soluta aliquam repellendus. Sequi architecto aut et qui quo. Enim ad et necessitatibus quaerat. Sint optio rerum consequatur iste commodi atque et.', 'Assumenda aperiam rerum quae aut nihil laudantium corporis. Et error deserunt dolores nam voluptatibus. Asperiores non dolor quidem tenetur sunt labore fugit et.', 'Jody Rippin', 'CEO', 'about_2_166494832216.png', 0, '2023-07-16 20:52:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `banner_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_sub_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_button` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `banner_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `banner_type`, `banner_sub_title`, `banner_title`, `banner_button`, `discount_id`, `category_id`, `banner_slug`, `banner_image`, `status`, `url`, `created_at`, `updated_at`) VALUES
(1, 'hero', 'welcome to our shop', 'tasty & healthy organic food', 'shop now', NULL, NULL, NULL, 'banner_hero_1_166472469463.jpg', 1, '/shop', '2023-07-16 20:52:25', NULL),
(2, 'hero', 'Ipsum maiores aut incidunt.', 'Ad nihil placeat enim magnam.', 'shop now', NULL, 2, 'fruits-and-vegetables/fruits', 'banner_hero_2_166538758817.jpg', 1, '/shop/fruits-and-vegetables/fruits', '2023-07-16 20:52:25', NULL),
(3, 'campaign', NULL, NULL, NULL, NULL, 3, 'fruits-and-vegetables/vegetables', 'banner_campaign_3_166472433593.jpg', 1, '/shop/fruits-and-vegetables/vegetables', '2023-07-16 20:52:25', NULL),
(4, 'campaign', NULL, NULL, NULL, 1, 2, 'vegetables-summer-sale', 'banner_campaign_4_166469187820.jpg', 1, '/sale/vegetables-summer-sale', '2023-07-16 20:52:25', NULL),
(5, 'campaign', NULL, NULL, NULL, 2, NULL, 'clearance-sale', 'banner_campaign_5_166472496248.jpg', 1, '/sale/clearance-sale', '2023-07-16 20:52:25', NULL);

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
(1, NULL, 'fruits and vegetables', 'fruits-and-vegetables', 'category_1_1652462686.png', 1, '2023-07-16 20:52:23', NULL),
(2, 1, 'fruits', 'fruits', 'category_2_1652462711.png', 1, '2023-07-16 20:52:23', NULL),
(3, 1, 'vegetables', 'vegetables', 'category_3_1652462727.png', 1, '2023-07-16 20:52:23', NULL),
(4, NULL, 'fish and meat', 'fish-and-meat', 'category_4_1652462562.png', 1, '2023-07-16 20:52:23', NULL),
(5, 4, 'fish', 'fish', 'category_5_1652462578.png', 1, '2023-07-16 20:52:23', NULL),
(6, 4, 'meat', 'meat', 'category_6_1652462621.png', 1, '2023-07-16 20:52:23', NULL),
(7, NULL, 'cooking', 'cooking', 'category_7_1652462470.png', 1, '2023-07-16 20:52:23', NULL),
(8, 7, 'spices', 'spices', 'category_8_1652462517.png', 1, '2023-07-16 20:52:23', NULL),
(9, 7, 'oil', 'oil', 'category_9_1652524856.png', 1, '2023-07-16 20:52:23', NULL),
(10, 7, 'rice', 'rice', 'category_10_1653487025.png', 1, '2023-07-16 20:52:24', NULL),
(11, NULL, 'dairy', 'dairy', 'category_11_1652462789.png', 1, '2023-07-16 20:52:24', NULL),
(12, 11, 'milk', 'milk', 'category_12_1652462841.png', 1, '2023-07-16 20:52:24', NULL),
(13, 11, 'eggs', 'eggs', 'category_13_1652462877.png', 1, '2023-07-16 20:52:24', NULL),
(14, NULL, 'snacks', 'snacks', 'category_14_1654169030.png', 1, '2023-07-16 20:52:24', NULL),
(15, 14, 'chips', 'chips', 'category_15_1689203067.png', 1, '2023-07-16 20:52:24', NULL);

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
(1, 9),
(2, 6),
(3, 12),
(4, 3),
(5, 5),
(6, 3),
(7, 6),
(8, 12),
(9, 7),
(10, 1),
(11, 15),
(12, 3),
(13, 3),
(14, 2),
(15, 5);

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
(1, 1, 'melbourne', '2023-07-16 20:52:35', NULL),
(2, 1, 'sydney', '2023-07-16 20:52:35', NULL),
(3, 2, 'chittagong', '2023-07-16 20:52:36', NULL),
(4, 2, 'barisal', '2023-07-16 20:52:36', NULL),
(5, 2, 'dhaka', '2023-07-16 20:52:36', NULL),
(6, 2, 'khulna', '2023-07-16 20:52:36', NULL),
(7, 2, 'mymensingh', '2023-07-16 20:52:36', NULL),
(8, 2, 'rajshahi', '2023-07-16 20:52:36', NULL),
(9, 2, 'sylhet', '2023-07-16 20:52:36', NULL),
(10, 3, 'alberta', '2023-07-16 20:52:36', NULL),
(11, 3, 'british columbia', '2023-07-16 20:52:37', NULL),
(12, 3, 'ontario', '2023-07-16 20:52:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_addresses`
--

CREATE TABLE `contact_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_addresses`
--

INSERT INTO `contact_addresses` (`id`, `contact_address`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '11382 Immanuel Turnpike Suite 747\nFunkton, HI 01320', 1, '2023-07-16 20:52:24', NULL),
(2, '829 Kip Loop\nEast Aprilview, ND 14048-0062', 0, '2023-07-16 20:52:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_emails`
--

CREATE TABLE `contact_emails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_emails`
--

INSERT INTO `contact_emails` (`id`, `contact_email`, `is_primary`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'uschmitt@example.com', 1, 1, '2023-07-16 20:52:24', NULL),
(2, 'raina70@example.org', 0, 1, '2023-07-16 20:52:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_phones`
--

CREATE TABLE `contact_phones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_phones`
--

INSERT INTO `contact_phones` (`id`, `contact_phone`, `is_primary`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '724-224-9608', 1, 1, '2023-07-16 20:52:24', NULL),
(2, '+16059354810', 0, 1, '2023-07-16 20:52:24', NULL);

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
(1, 'australia', '2023-07-16 20:52:35', NULL),
(2, 'bangladesh', '2023-07-16 20:52:35', NULL),
(3, 'canada', '2023-07-16 20:52:36', NULL);

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
(1, 'LETTUCE10', 1000, 'fixed', '2023-07-27 02:52:24', 1, '2023-07-16 20:52:24', NULL),
(2, 'LETTUCE15', 15, 'percent', '2023-07-14 02:52:24', 0, '2023-07-16 20:52:24', NULL);

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
(1, 'summer sale', 'fixed', 150, 'summer-sale', '2023-07-27 02:52:25', 1, '2023-07-16 20:52:25', NULL),
(2, 'clearance sale', 'percent', 15, 'clearance-sale', '2023-07-24 02:52:25', 1, '2023-07-16 20:52:25', NULL),
(3, 'flash sale', 'percent', 20, 'flash-sale', '2023-07-20 02:52:25', 1, '2023-07-16 20:52:25', NULL),
(4, 'winter sale', 'fixed', 50, 'winter-sale', '2023-08-01 02:52:25', 0, '2023-07-16 20:52:25', NULL);

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
(1, 'Et iure illo et laborum.', 'Qui dolor error qui ut. Aut officiis iure eaque dolores ducimus modi ut. Non ullam ducimus mollitia ut amet ratione at. Quidem eos ex cum id laboriosam.', 0, '2023-07-16 20:52:25', NULL),
(2, 'Quis id repellendus aut quibusdam eos est.', 'Sed quo enim eveniet ut aut. Ad ducimus itaque ipsum est in consequatur impedit. Molestiae omnis aut dicta qui iure et.', 0, '2023-07-16 20:52:25', NULL),
(3, 'Magni fugit dolores molestias maiores et non quis.', 'Excepturi neque itaque sed repudiandae omnis quae. Consequuntur ut atque modi repellendus omnis impedit ut quae. Provident suscipit sed explicabo quae omnis.', 1, '2023-07-16 20:52:25', NULL),
(4, 'Sed quis modi in sit maiores qui velit rerum.', 'Ut voluptatem occaecati beatae esse voluptatibus voluptatem. Odit et harum consequatur dolor quidem. Commodi harum suscipit id accusantium.', 1, '2023-07-16 20:52:26', NULL),
(5, 'Molestiae eligendi dicta quisquam corrupti quis est.', 'Aut ut voluptas distinctio maxime vel iure sint. Dolorem eum non iure. Voluptas in sed numquam. Veritatis nisi a rerum quos.', 1, '2023-07-16 20:52:26', NULL),
(6, 'Qui et sit voluptatibus impedit recusandae quas quia.', 'Nihil laudantium quidem laborum voluptas. Voluptatem aliquam qui beatae dolor sit. Blanditiis deserunt ut non ut in non. Dolores et et dolores natus non omnis corporis.', 0, '2023-07-16 20:52:26', NULL),
(7, 'Rerum autem voluptas nam ut est illum.', 'Autem voluptatem dolor placeat ullam fuga quia. Dolor eligendi non rerum error a minima eveniet. Labore maiores commodi consectetur aut error earum tempora.', 1, '2023-07-16 20:52:26', NULL),
(8, 'Nostrum illo magnam nobis quis.', 'Omnis vel est odio sit id voluptas fugit sed. Animi placeat commodi eaque minus dolore quia.', 0, '2023-07-16 20:52:26', NULL),
(9, 'Eum fugiat officia incidunt eos cumque.', 'Ut alias maiores esse quia mollitia. Sit doloremque repudiandae rerum beatae. Earum et qui molestias voluptas vitae. Incidunt molestiae commodi numquam nobis alias possimus quia.', 1, '2023-07-16 20:52:26', NULL),
(10, 'Illo exercitationem ut voluptatem ea magni porro.', 'Minima dolorem temporibus maxime nihil repellendus. Perferendis assumenda impedit dicta minus repudiandae. Provident aliquid quisquam iure est est iure animi. Est numquam non maiores in in officia.', 1, '2023-07-16 20:52:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `feature_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feature_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `feature_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `feature_title`, `feature_desc`, `feature_image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Est sapiente dicta.', 'Nulla velit est voluptate autem. Vel cum unde rem mollitia nisi assumenda.', 'feature_1_166496940533.png', 1, '2023-07-16 20:52:26', NULL),
(2, 'Est incidunt ab.', 'Et beatae consequuntur modi rerum. Optio id dolore nihil temporibus et molestiae perspiciatis.', 'feature_2_166496943015.png', 1, '2023-07-16 20:52:26', NULL),
(3, 'A ut nam.', 'Et atque nulla ducimus eum amet itaque et. Id officia corporis asperiores.', 'feature_3_166496945794.png', 1, '2023-07-16 20:52:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logos`
--

CREATE TABLE `logos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logos`
--

INSERT INTO `logos` (`id`, `image`, `type`, `created_at`, `updated_at`) VALUES
(1, 'logo-light-1689249703.png', 'light', '2023-07-16 20:52:26', NULL),
(2, 'logo-dark-1689250089.png', 'dark', '2023-07-16 20:52:26', NULL),
(3, 'logo-mobile-1689241016.png', 'mobile', '2023-07-16 20:52:26', NULL),
(4, 'logo-favicon-1689273742.png', 'favicon', '2023-07-16 20:52:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mail_settings`
--

CREATE TABLE `mail_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mail_transport` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_host` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_port` int(11) NOT NULL,
  `mail_encryption` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_from_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_from_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message_id`, `name`, `email`, `message`, `is_read`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Melissa Rolfson', 'olindgren@example.net', 'Doloremque qui perferendis natus ea nisi. Accusamus aut ducimus accusamus consequatur omnis.', 0, '2023-07-16 20:52:27', '2023-07-16 20:52:27', NULL),
(2, NULL, 'Dr. Dandre Bogisich PhD', 'rath.karlie@example.org', 'Consectetur quibusdam nihil reiciendis qui et officia facere. Ea sed et ut. Laborum et quis in sit.', 0, '2023-07-16 20:52:27', '2023-07-16 20:52:27', NULL),
(3, NULL, 'Hortense Denesik', 'kali75@example.org', 'Beatae quas eius nesciunt. Dicta est sit illo dolores velit consequatur. Voluptas illum et quaerat minus. Nemo ducimus quia perferendis laudantium.', 1, '2023-07-16 20:52:27', '2023-07-16 20:52:27', NULL),
(4, NULL, 'Gina Grady II', 'mkemmer@example.net', 'Amet est eos tempora labore. Nihil quas animi possimus ipsam sunt. Vel sint debitis quia hic.', 1, '2023-07-16 20:52:27', '2023-07-16 20:52:27', NULL),
(5, NULL, 'Thelma Oberbrunner', 'ziemann.ricardo@example.net', 'Aut voluptas consequuntur aut quod. Voluptate non modi a quae. Nesciunt aliquid maxime sint est aut ab.', 0, '2023-07-16 20:52:27', '2023-07-16 20:52:27', NULL),
(6, NULL, 'Talon Keeling', 'kuhlman.camren@example.com', 'Quibusdam consequatur ad explicabo temporibus sed est eum. Consectetur omnis veniam dolorum perspiciatis. Ut ipsam ea soluta sit voluptatem.', 1, '2023-07-16 20:52:27', '2023-07-16 20:52:27', NULL),
(7, NULL, 'Mozelle Balistreri I', 'rvolkman@example.com', 'Et rerum eveniet ut aut vitae corporis unde. Quo aut cumque quis magni. Explicabo autem ea occaecati aut aut.', 1, '2023-07-16 20:52:27', '2023-07-16 20:52:27', NULL),
(8, NULL, 'Ally Willms I', 'roger.abshire@example.net', 'Officiis natus in possimus et et corporis. Praesentium sed sed pariatur illo dolorum recusandae consequatur dolor. Iure modi nesciunt sapiente dolores voluptates in quibusdam. Molestias iure vero cum quia.', 0, '2023-07-16 20:52:27', '2023-07-16 20:52:27', NULL),
(9, NULL, 'Marcus Batz', 'bell44@example.com', 'Optio labore distinctio iure possimus eos sapiente. Accusantium hic id et minima minima assumenda iusto. Molestiae est rem distinctio possimus expedita.', 0, '2023-07-16 20:52:27', '2023-07-16 20:52:27', NULL),
(10, NULL, 'Mrs. Lauren Trantow MD', 'alena72@example.com', 'Distinctio atque in deserunt molestiae ipsa totam aut harum. Debitis eum sint nemo cupiditate. Molestias minus et est temporibus doloremque.', 0, '2023-07-16 20:52:27', '2023-07-16 20:52:27', NULL),
(11, 10, 'Lettuce Support', 'support@lettuce.com', 'Molestiae doloremque dignissimos incidunt voluptatibus fuga et id voluptas. Hic cumque ipsam aspernatur. Pariatur et dicta aut. Rem eius rem officiis rem iure fugit. A aliquid quam rem est et repellat.', 1, '2023-07-16 20:52:27', NULL, NULL),
(12, 10, 'Lettuce Support', 'support@lettuce.com', 'Pariatur ipsa molestias et et molestiae. Occaecati ex eum commodi enim. Est aut quod dolore at autem.', 1, '2023-07-16 20:52:27', NULL, NULL);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_03_28_170119_create_faqs_table', 1),
(6, '2022_04_04_162541_create_user_details_table', 1),
(7, '2022_04_05_180024_create_countries_table', 1),
(8, '2022_04_05_180156_create_cities_table', 1),
(9, '2022_04_11_153257_create_discounts_table', 1),
(10, '2022_04_11_153455_create_coupons_table', 1),
(11, '2022_04_16_174727_create_categories_table', 1),
(12, '2022_04_22_040248_create_sizes_table', 1),
(13, '2022_04_28_091103_create_products_table', 1),
(14, '2022_04_28_091344_create_category_product_table', 1),
(15, '2022_04_28_093345_create_product_multiple_photos_table', 1),
(16, '2022_05_01_174206_create_product_product_size_table', 1),
(17, '2022_05_11_065325_create_product_discounts_table', 1),
(18, '2022_05_30_203542_create_product_views_table', 1),
(19, '2022_06_02_180133_create_wishlists_table', 1),
(20, '2022_06_04_184125_create_carts_table', 1),
(21, '2022_06_20_110917_create_orders_table', 1),
(22, '2022_06_20_111301_create_order_items_table', 1),
(23, '2022_06_22_134534_create_product_reviews_table', 1),
(24, '2022_07_24_215940_create_subscribers_table', 1),
(25, '2022_08_08_155634_create_newsletters_table', 1),
(26, '2022_09_25_035936_create_messages_table', 1),
(27, '2022_10_02_160646_create_abouts_table', 1),
(28, '2022_10_05_064644_create_features_table', 1),
(29, '2022_10_05_141817_create_contact_emails_table', 1),
(30, '2022_10_07_172850_create_contact_phones_table', 1),
(31, '2022_10_08_143441_create_contact_addresses_table', 1),
(32, '2022_10_13_122006_create_jobs_table', 1),
(33, '2022_10_30_140144_create_roles_table', 1),
(34, '2022_10_30_140341_create_permissions_table', 1),
(35, '2022_11_04_094923_create_permission_user_table', 1),
(36, '2022_11_04_095159_create_permission_role_table', 1),
(37, '2022_11_04_095307_create_role_user_table', 1),
(38, '2023_04_03_174834_create_banners_table', 1),
(39, '2023_05_23_072140_create_mail_settings_table', 1),
(40, '2023_07_11_031524_create_logos_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `newsletter_subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `newsletter_code` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'view-logo', '2023-07-16 20:52:08', NULL),
(2, 'create-logo', '2023-07-16 20:52:08', NULL),
(3, 'delete-logo', '2023-07-16 20:52:08', NULL),
(4, 'view-about', '2023-07-16 20:52:08', NULL),
(5, 'create-about', '2023-07-16 20:52:08', NULL),
(6, 'update-about', '2023-07-16 20:52:08', NULL),
(7, 'delete-about', '2023-07-16 20:52:08', NULL),
(8, 'view-banner', '2023-07-16 20:52:08', NULL),
(9, 'create-banner', '2023-07-16 20:52:08', NULL),
(10, 'update-banner', '2023-07-16 20:52:08', NULL),
(11, 'delete-banner', '2023-07-16 20:52:08', NULL),
(12, 'view-category', '2023-07-16 20:52:08', NULL),
(13, 'create-category', '2023-07-16 20:52:08', NULL),
(14, 'update-category', '2023-07-16 20:52:08', NULL),
(15, 'delete-category', '2023-07-16 20:52:08', NULL),
(16, 'view-city', '2023-07-16 20:52:08', NULL),
(17, 'create-city', '2023-07-16 20:52:08', NULL),
(18, 'update-city', '2023-07-16 20:52:08', NULL),
(19, 'delete-city', '2023-07-16 20:52:08', NULL),
(20, 'view-contact', '2023-07-16 20:52:08', NULL),
(21, 'create-contact', '2023-07-16 20:52:08', NULL),
(22, 'update-contact', '2023-07-16 20:52:08', NULL),
(23, 'delete-contact', '2023-07-16 20:52:08', NULL),
(24, 'view-country', '2023-07-16 20:52:08', NULL),
(25, 'create-country', '2023-07-16 20:52:08', NULL),
(26, 'update-country', '2023-07-16 20:52:08', NULL),
(27, 'delete-country', '2023-07-16 20:52:08', NULL),
(28, 'view-coupon', '2023-07-16 20:52:08', NULL),
(29, 'create-coupon', '2023-07-16 20:52:08', NULL),
(30, 'update-coupon', '2023-07-16 20:52:08', NULL),
(31, 'delete-coupon', '2023-07-16 20:52:08', NULL),
(32, 'view-discount', '2023-07-16 20:52:08', NULL),
(33, 'create-discount', '2023-07-16 20:52:08', NULL),
(34, 'update-discount', '2023-07-16 20:52:08', NULL),
(35, 'delete-discount', '2023-07-16 20:52:08', NULL),
(36, 'view-faq', '2023-07-16 20:52:08', NULL),
(37, 'create-faq', '2023-07-16 20:52:08', NULL),
(38, 'update-faq', '2023-07-16 20:52:08', NULL),
(39, 'delete-faq', '2023-07-16 20:52:08', NULL),
(40, 'view-feature', '2023-07-16 20:52:08', NULL),
(41, 'create-feature', '2023-07-16 20:52:08', NULL),
(42, 'update-feature', '2023-07-16 20:52:08', NULL),
(43, 'delete-feature', '2023-07-16 20:52:08', NULL),
(44, 'view-product', '2023-07-16 20:52:08', NULL),
(45, 'create-product', '2023-07-16 20:52:08', NULL),
(46, 'update-product', '2023-07-16 20:52:08', NULL),
(47, 'delete-product', '2023-07-16 20:52:08', NULL),
(48, 'create-product-discount', '2023-07-16 20:52:08', NULL),
(49, 'delete-product-discount', '2023-07-16 20:52:08', NULL),
(50, 'view-size', '2023-07-16 20:52:08', NULL),
(51, 'create-size', '2023-07-16 20:52:08', NULL),
(52, 'update-size', '2023-07-16 20:52:08', NULL),
(53, 'delete-size', '2023-07-16 20:52:08', NULL),
(54, 'view-permission', '2023-07-16 20:52:08', NULL),
(55, 'create-permission', '2023-07-16 20:52:08', NULL),
(56, 'update-permission', '2023-07-16 20:52:08', NULL),
(57, 'delete-permission', '2023-07-16 20:52:08', NULL),
(58, 'view-role', '2023-07-16 20:52:08', NULL),
(59, 'create-role', '2023-07-16 20:52:08', NULL),
(60, 'update-role', '2023-07-16 20:52:08', NULL),
(61, 'delete-role', '2023-07-16 20:52:08', NULL),
(62, 'view-user', '2023-07-16 20:52:08', NULL),
(63, 'create-user', '2023-07-16 20:52:08', NULL),
(64, 'update-user', '2023-07-16 20:52:08', NULL),
(65, 'delete-user', '2023-07-16 20:52:08', NULL),
(66, 'view-order', '2023-07-16 20:52:08', NULL),
(67, 'update-order', '2023-07-16 20:52:08', NULL),
(68, 'delete-order', '2023-07-16 20:52:08', NULL),
(69, 'view-subscriber', '2023-07-16 20:52:08', NULL),
(70, 'delete-subscriber', '2023-07-16 20:52:08', NULL),
(71, 'view-newsletter', '2023-07-16 20:52:08', NULL),
(72, 'create-newsletter', '2023-07-16 20:52:08', NULL),
(73, 'delete-newsletter', '2023-07-16 20:52:08', NULL),
(74, 'view-message', '2023-07-16 20:52:08', NULL),
(75, 'reply-message', '2023-07-16 20:52:08', NULL),
(76, 'delete-message', '2023-07-16 20:52:08', NULL),
(77, 'view-mail-settings', '2023-07-16 20:52:08', NULL),
(78, 'update-mail-settings', '2023-07-16 20:52:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(34, 2),
(35, 2),
(36, 2),
(37, 2),
(38, 2),
(39, 2),
(40, 2),
(41, 2),
(42, 2),
(43, 2),
(44, 2),
(45, 2),
(46, 2),
(47, 2),
(48, 2),
(49, 2),
(50, 2),
(51, 2),
(52, 2),
(53, 2),
(62, 2),
(63, 2),
(66, 2),
(67, 2),
(68, 2),
(69, 2),
(70, 2),
(71, 2),
(72, 2),
(73, 2),
(74, 2),
(75, 2),
(76, 2),
(77, 2),
(78, 2),
(1, 3),
(2, 3),
(4, 3),
(5, 3),
(6, 3),
(8, 3),
(9, 3),
(10, 3),
(12, 3),
(13, 3),
(14, 3),
(16, 3),
(17, 3),
(18, 3),
(20, 3),
(21, 3),
(22, 3),
(24, 3),
(25, 3),
(26, 3),
(28, 3),
(29, 3),
(30, 3),
(32, 3),
(33, 3),
(34, 3),
(36, 3),
(37, 3),
(38, 3),
(40, 3),
(41, 3),
(42, 3),
(44, 3),
(45, 3),
(46, 3),
(48, 3),
(50, 3),
(51, 3),
(52, 3),
(62, 3),
(66, 3),
(67, 3),
(69, 3),
(71, 3),
(72, 3),
(74, 3),
(75, 3);

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
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
(1, 'Quis dolore', 'In est et sapiente doloremque dolores', 1000, 100, 100, 'product_1.jpg', 'quis-dolore-12piece-1689540749', 1, 1, 0, '2023-07-16 20:52:29', '2023-07-16 20:52:29', NULL),
(2, 'Qui laudantium', 'Exercitationem nam ad dolores commodi sit', 600, 100, 100, 'product_2.jpg', 'qui-laudantium-155gm-1689540750', 1, 1, 1, '2023-07-16 20:52:30', '2023-07-16 20:52:30', NULL),
(3, 'Accusamus placeat', 'Non quod deleniti est vel quae', 300, 100, 100, 'product_3.jpg', 'accusamus-placeat-639ml-1689540751', 0, 0, 1, '2023-07-16 20:52:31', '2023-07-16 21:01:00', NULL),
(4, 'Voluptatem amet', 'Illum culpa et aperiam non doloremque', 800, 100, 100, 'product_4.jpg', 'voluptatem-amet-5litre-1689540751', 0, 1, 1, '2023-07-16 20:52:31', '2023-07-16 20:52:31', NULL),
(5, 'Veniam consequatur', 'Voluptatem ipsam dicta et sint delectus', 500, 100, 100, 'product_5.jpg', 'veniam-consequatur-13lb-1689540751', 1, 0, 1, '2023-07-16 20:52:31', '2023-07-16 20:52:32', NULL),
(6, 'Quas autem', 'Sunt quo accusamus rerum voluptas cumque', 800, 100, 100, 'product_6.jpg', 'quas-autem-15lb-1689540752', 1, 0, 0, '2023-07-16 20:52:32', '2023-07-16 20:52:32', NULL),
(7, 'Necessitatibus modi', 'Sint eos quis similique molestiae assumenda', 300, 100, 100, 'product_7.jpg', 'necessitatibus-modi-253gm-1689540752', 1, 0, 1, '2023-07-16 20:52:32', '2023-07-16 21:01:03', NULL),
(8, 'Eum suscipit', 'Ut voluptas reiciendis dicta voluptas ex', 400, 100, 100, 'product_8.jpg', 'eum-suscipit-729ml-1689540753', 1, 0, 1, '2023-07-16 20:52:33', '2023-07-16 21:01:02', NULL),
(9, 'Et est', 'Aperiam nostrum aut adipisci atque sequi', 500, 100, 100, 'product_9.jpg', 'et-est-6kg-1689540753', 0, 0, 0, '2023-07-16 20:52:33', '2023-07-16 20:52:33', NULL),
(10, 'Vero sed', 'Aut at culpa corporis iure labore', 400, 100, 100, 'product_10.jpg', 'vero-sed-919ml-1689540753', 1, 0, 1, '2023-07-16 20:52:33', '2023-07-16 20:52:33', NULL),
(11, 'Quae quia', 'Est id incidunt nihil cupiditate perferendis', 300, 100, 100, 'product_11.jpg', 'quae-quia-10litre-1689540754', 0, 1, 1, '2023-07-16 20:52:34', '2023-07-16 21:01:07', NULL),
(12, 'Voluptas voluptatem', 'Quia cumque sunt ut sint occaecati', 200, 100, 100, 'product_12.jpg', 'voluptas-voluptatem-3kg-1689540754', 1, 1, 0, '2023-07-16 20:52:34', '2023-07-16 20:52:34', NULL),
(13, 'Dolor excepturi', 'Amet voluptas magni voluptatum pariatur nam', 500, 100, 100, 'product_13.jpg', 'dolor-excepturi-3piece-1689540754', 1, 1, 1, '2023-07-16 20:52:34', '2023-07-16 21:01:00', NULL),
(14, 'Ut aut', 'Eos reprehenderit autem quis enim cum', 600, 100, 100, 'product_14.jpg', 'ut-aut-97ml-1689540755', 1, 0, 0, '2023-07-16 20:52:35', '2023-07-16 20:52:35', NULL),
(15, 'Maxime sint', 'Ratione sunt voluptas error aut nostrum', 600, 100, 100, 'product_15.jpg', 'maxime-sint-10piece-1689540755', 0, 1, 1, '2023-07-16 20:52:35', '2023-07-16 21:01:07', NULL);

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
(1, 1),
(2, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 3),
(10, 3),
(12, 1),
(13, 3),
(14, 1);

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
(1, 1, 'product_1_1.jpg', '2023-07-16 20:52:29', NULL),
(2, 2, 'product_2_1.jpg', '2023-07-16 20:52:30', NULL),
(3, 3, 'product_3_1.jpg', '2023-07-16 20:52:31', NULL),
(4, 4, 'product_4_1.jpg', '2023-07-16 20:52:31', NULL),
(5, 5, 'product_5_1.jpg', '2023-07-16 20:52:32', NULL),
(6, 6, 'product_6_1.jpg', '2023-07-16 20:52:32', NULL),
(7, 7, 'product_7_1.jpg', '2023-07-16 20:52:32', NULL),
(8, 8, 'product_8_1.jpg', '2023-07-16 20:52:33', NULL),
(9, 9, 'product_9_1.jpg', '2023-07-16 20:52:33', NULL),
(10, 10, 'product_10_1.jpg', '2023-07-16 20:52:33', NULL),
(11, 11, 'product_11_1.jpg', '2023-07-16 20:52:34', NULL),
(12, 12, 'product_12_1.jpg', '2023-07-16 20:52:34', NULL),
(13, 13, 'product_13_1.jpg', '2023-07-16 20:52:34', NULL),
(14, 14, 'product_14_1.jpg', '2023-07-16 20:52:35', NULL),
(15, 15, 'product_15_1.jpg', '2023-07-16 20:52:35', NULL);

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
(1, 6, 12),
(2, 3, 155),
(3, 1, 639),
(4, 2, 5),
(5, 5, 13),
(6, 5, 15),
(7, 3, 253),
(8, 1, 729),
(9, 4, 6),
(10, 1, 919),
(11, 2, 10),
(12, 4, 3),
(13, 6, 3),
(14, 1, 97),
(15, 6, 10);

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

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'super-admin', '2023-07-16 20:52:08', '2023-07-16 20:52:08'),
(2, 'admin', '2023-07-16 20:52:14', '2023-07-16 20:52:14'),
(3, 'manager', '2023-07-16 20:52:18', '2023-07-16 20:52:18');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`) VALUES
(1, 1),
(2, 2),
(3, 3);

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
(1, 'ml', '2023-07-16 20:52:27', '2023-07-16 20:52:27'),
(2, 'litre', '2023-07-16 20:52:27', '2023-07-16 20:52:27'),
(3, 'gm', '2023-07-16 20:52:28', '2023-07-16 20:52:28'),
(4, 'kg', '2023-07-16 20:52:28', '2023-07-16 20:52:28'),
(5, 'lb', '2023-07-16 20:52:28', '2023-07-16 20:52:28'),
(6, 'piece', '2023-07-16 20:52:29', '2023-07-16 20:52:29');

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
(1, 'cd1db7772933a7da4a242acee2c1a99222a5d98835215005aa6c28cfdd1aca53', 'dnitzsche@example.net', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:37'),
(2, '338b6639e02578dad88728f33936a3f8839da561b5706b2a4c4f28b609465799', 'albina61@example.com', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:37'),
(3, 'cca83f63ff34c6c512b7b02557ed7e41e2e502410ef249f2a30a402ac2b1bc35', 'curt.gutkowski@example.com', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:37'),
(4, '553f5d9cf52ff5584691e856cb72b173dd906ce4e61fd74066c213c63defb471', 'kautzer.ned@example.com', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:37'),
(5, '821d080641c32b880b5acf2bda8c862f3aa6addbd9ccab7525fa882f2f333bd2', 'janiya.schultz@example.net', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:37'),
(6, 'b2414d9a1fcdc98d0be8d87a5f691f0781f7b83a07e4bf7a19e3798033427d2f', 'welch.janiya@example.com', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:37'),
(7, '6ed9a0aca59a930ebaff16224b0524c6f08fccf88c9f1146aff9d1d43831bff2', 'hoeger.merritt@example.net', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:37'),
(8, '090ef61bfcdfa3ba92a872bea2336ea322ac0467a30992007961b8e6dd944577', 'kozey.cathy@example.net', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:37'),
(9, 'b3027e01a15e8e0e2e930789945e8e4b67c86d92512e5282c77cc251b476a815', 'lueilwitz.grant@example.org', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:37'),
(10, '3751f88c577aab64cc3f17ad4d8b57057db8592493e6d18879530bd8adc96d69', 'lgottlieb@example.net', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:37'),
(11, 'a423e529379ba92e8b0e10a979cb4a11ef1e4ecc47df8f29e21c50ef964dbae9', 'holden95@example.com', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:37'),
(12, 'f244e029ad64e22c78025ff54a2734524e60b73f11639594eaf1eaa1a7fdbc0d', 'rhianna47@example.com', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:37'),
(13, '1cc00fa18c4b990f46c1e1d9e1dfc67c2ffefca0cfa4880f09e2a62796ea5583', 'charlie50@example.com', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:37'),
(14, 'fb399b5c25e5e1b92f8c4bec381465c855c152c2eea6516264df175aec4adee9', 'hhermann@example.com', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:38'),
(15, '1b346f3bf88dc1f3e0fd03e615822a754e184bf56d1d18773386eaf55173a4b8', 'hlubowitz@example.com', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:38'),
(16, '8be58285bc84c8a0bc35fce9a1e5b50400b4cdc7fb5ad4a100c006a8082bfccb', 'kutch.raymond@example.com', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:38'),
(17, '95237c39a9753d07a29cb2cc1a0d1327ca0f819e99d2b12518bcdb6dc63983f1', 'mcdermott.abner@example.net', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:38'),
(18, '0765d8477d99cc55d52b253404815d32781d700f2560180b5d12621626024632', 'ervin.funk@example.org', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:38'),
(19, 'd25c3e463e4698c3da04687fa121b401fa645be47fc994e032edcaa8404dd4c5', 'madalyn43@example.com', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:38'),
(20, '4f25ff587aea33ea89bbe298562381fd7489c3976d8b8aa1ec1b48985b48e95c', 'wolf.beulah@example.com', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:38'),
(21, 'd357dd322b65c4c34a29bb3da8248d925c2e61446cc09cee0cf7b6ce37841a74', 'lebsack.trevor@example.net', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:38'),
(22, 'e7b3283bf4064a2e5eeccec4e21fe4014839f9622de91e57de422bbd7291f1a2', 'audrey21@example.org', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:38'),
(23, '4c86f1baf3dc23b5d24424745c2ec659ee6aa966041a4216cdbb8ec5534e4944', 'estel30@example.com', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:38'),
(24, '50f8af125cc802c04e3ce783804ad7273d5c2c7500eedfec576feb0a9eac25f2', 'mario36@example.org', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:38'),
(25, 'b710e62d538d2850366660f3d0c648bfeaaccb20cbc61350f1112482981f90a3', 'cartwright.maud@example.com', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:38'),
(26, 'ede99c02536f90ae0571e49923721bb4a8e0de4abf8efab3b7645da6e6d2a580', 'janet07@example.com', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:38'),
(27, '148bee5aefc6d0f4746b15e6f69e49adfd42d245f60178befef065ef8c996802', 'kathleen80@example.org', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:38'),
(28, '5d3279a2abda52dea2df16cf29c30048285b2a8bccfed017e75a23593eb0e292', 'arvilla.bednar@example.com', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:38'),
(29, 'f573059d5b540981f153dcb8f7d09c887474ddc12845fd94987eb87cb927710d', 'fgutmann@example.org', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:38'),
(30, '0d4b4efabcfebd9b8aa23c101d48c06831eb3c1226835ede8b9bf382eaca0ba7', 'adela.jacobs@example.org', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:38'),
(31, '1e9ac6b128b3678fff6ac83145eb2d31883f9d9740c3056df9e2c7f0b66854ba', 'qsenger@example.net', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:38'),
(32, 'b31c459f0e035835996ad8b5a54742114dc87756b9b0a5fbf1634bed798e3505', 'tmiller@example.com', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:38'),
(33, 'b59505ef14a2ce4a850b58906a56913ba8b07e87c811d1b89efe91c7d7794718', 'xcarter@example.org', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:38'),
(34, 'c541810617d4b5edf1a5660358ba317e84bc10d572efe97247d07e8c71f642b7', 'kreiger.daisha@example.org', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:39'),
(35, '3fed24b7844fa434d2e7cefd0453b56860470efe4e4625ccc71398d8d513e90f', 'bernhard.jakayla@example.com', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:39'),
(36, '0d1908c28b052a43e38ea4f5ef6ddb72af6946b5830cc3ad744ffbd817cd7463', 'rhoda87@example.org', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:39'),
(37, '80cf0e21dbbf7a29e4655a6f1cfa71b8e0ec0b3bd4132afe6ef8cc50e609494f', 'green.angelo@example.org', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:39'),
(38, '9d8b78b5f4b83454ddf2382d4ca4c1c6d6184425ec64cbce8992aa2887625476', 'asia.marquardt@example.net', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:39'),
(39, '444c55dc24f9c740944728ae988cf9763bdbd369498caf11848ad1a339ddbec2', 'eloisa01@example.net', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:39'),
(40, '965a36e38569bac81ad7dfe39330fdfa026fa025c2e2bfbb134c4428e326a407', 'giovanni.towne@example.org', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:39'),
(41, 'eacee43cd250e4a5824cbcc8df8c6dae43cd8abb27113137863b01111a55bea2', 'pinkie85@example.net', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:39'),
(42, 'b9178ce7cb3c3c768426591bde1c606c369e3adb2708f46c0f36c70f153d5632', 'elyse.collins@example.org', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:39'),
(43, '2160bdcb030d1d932af9de286556ae709eb9eeab8b6be0fa379735e0a79bf38d', 'ikulas@example.org', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:39'),
(44, 'bc2ca0f63f47f10e915bfe93916b24d880b719865d0006937b666342df03f2d2', 'fmurazik@example.org', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:39'),
(45, 'a5f81c59a6a4b6654fb2f498ebe23a46e3dbff95aa045a3b30b1a6363c34d6a9', 'jacobi.jeremy@example.org', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:39'),
(46, 'c43fa071355532ea2c96f4ddec4d6c66eb148e3221ac21a77613d2baf1fbc526', 'aracely92@example.com', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:39'),
(47, '433a5b3a9c98252f1c79a0094ac37117c6817d55eed7670f73d97b9c814a50a7', 'sauer.kendra@example.net', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:39'),
(48, 'c53e12f1b87e97bce10dbcef36ed48d099d0cdeae744f7738c19a46831b03014', 'clangworth@example.org', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:39'),
(49, '56c99c9f4207a8d11644771942da57bdccc0262acccaea8a85f2462efb4797d1', 'fatima.dooley@example.com', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:39'),
(50, '532716a94657468dde317d39b8c32fc82274204054e1b61f83abcd0987b2c490', 'bailey07@example.net', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:40'),
(51, 'b66438bd0ef5cb003ed71badd461104c9d43bf37b4bf36fd2ac1ad23691d63a9', 'dfarrell@example.net', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:40'),
(52, 'a82253ec542f3099718c7fd16cffdc42ec549090fea854f2cbd6d2856da8f03a', 'uweissnat@example.net', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:40'),
(53, 'a00950a265bdde489f428fbb5bc38e48412fed17116cc96e83c7d30f89fc6582', 'jboyer@example.com', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:40'),
(54, 'b42b0389fe8c881efe8931d0229a34a2d220ce2fa6df74e3f92d3e6ab0906f3c', 'gerlach.jamel@example.net', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:40'),
(55, '74658fd40da1fdafefc99278d14f3ead9f54b9e2baeb6ed3bad149c06f714eb0', 'zieme.meagan@example.com', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:40'),
(56, 'a28d44f425cbcab5181b34e3e2689b3c744e2c8ab86ac610c7fc814397724016', 'baumbach.sandy@example.net', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:40'),
(57, 'dc75742ce65af00e2e2643f5a4d1752b36fd277b6a894fd037d37d0aafafefe5', 'lenora32@example.com', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:40'),
(58, '2b9776aaa5e2cb8bd2bf339ab74bde12513d9bc1b07cfadc716a58d6a5be2950', 'vkohler@example.org', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:40'),
(59, 'a84f0757606d1457e4f2f3a200fa57b9c1593cab18b99e8692a4e2f33aca83f4', 'fannie.sauer@example.org', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:40'),
(60, '30aa72cdd29175f989cb259d885ac4457d24fb7103a01a326c49c174e7f80025', 'laverne.kub@example.org', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:40'),
(61, '4dc004125401333d5db7e7d854a1bf06b0d0cddaef4c1421e2e53621cd4c0031', 'robel.darrick@example.net', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:40'),
(62, 'c427e21632b2bf517a09eda356260e7c1a0c4d6d7b947917bcb661bfeda59f21', 'nola33@example.net', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:40'),
(63, '622941155f10343e3c60fea85505b6958e5f7ec0477e227cf041c4a9cc263afc', 'hubert.homenick@example.net', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:40'),
(64, 'ce2cb0c96d45d5d3e2c12352c584da2f653a54a2fe943a47c9c8f12d5b0b2119', 'uroberts@example.com', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:40'),
(65, '20c76e5e27b105e67d272cfb50817544066b8a2d092d80eec81a4c2fc4f60943', 'itzel.hagenes@example.net', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:40'),
(66, '386b0e8d03644cf176d73f7c14a37e3f898bd15283b88d17765c40fe43668c08', 'urban.dach@example.com', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:40'),
(67, 'd459b755d5bc4854a765f0f0183f7d678fb03a5e3708d4724320fe4cbac1bb80', 'arunte@example.org', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:40'),
(68, '02770d52eff113c26dfb82402e3c5df071606f0d57fa9569ea99aa78ab34a94a', 'lavada11@example.org', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:41'),
(69, '3152dd386f195e9442b926a730b2d90b60771392c50202bd1fefc05a55a85a91', 'fluettgen@example.org', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:41'),
(70, '2a6592895ec81bfd253ee434dfde82272854aabf629b0cef0e066c2a72e6320c', 'raynor.miller@example.org', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:41'),
(71, '9df6c80bf0e9b85c3b9f9d41470404949c8eadce765754c41fcba2be86708637', 'douglas.nader@example.org', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:41'),
(72, '2c54d43289526703793b8f5e3f2889efad2c4d593e081e46aade5c16a47e900f', 'dubuque.mozell@example.net', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:41'),
(73, 'e31887c4bed5886e00fcaaefb4842203dceb585321de1969e483c1983022781b', 'dullrich@example.net', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:41'),
(74, '62d5d1fc4ae58201b8ec943390600aebf365ba47c4f8c4d5d01b34633895697d', 'towne.gloria@example.org', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:41'),
(75, 'b0542fe84239382f85a46991843361e6a8015f82c0e8c444574a8c4fd4fa18b1', 'larson.dameon@example.org', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:41'),
(76, '25d2abde1704018633ae4fcf27cc78626c6bfe7c55ffc8a25f6078dc64a556df', 'frank61@example.org', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:41'),
(77, '8351ecd26149618643e970a5fa1c7af9bad60978528766cc71ce3491d3cf50b6', 'bernier.kyla@example.com', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:41'),
(78, '24bbf9d9b0a92ae31a3ec0f883d41dd0c53c71d7922dc0bb3b0e7bc48bc3adde', 'hintz.savannah@example.net', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:41'),
(79, 'c26c304d3d45c942eef0478136f32df728af85bd5d0af8259c5631095e523967', 'jadon.krajcik@example.com', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:41'),
(80, '64c497f9ac3963af08dc7ddd366c48f3d5adaedf5f69fae0855a92800ad16e6a', 'batz.hailie@example.net', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:41'),
(81, '2c7d6ebb699d105cbb0e20fbd26c57e5f7519d2061750a8209b1820222f7b565', 'hirthe.waldo@example.org', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:41'),
(82, '2d7be969cae9158062c255e84840eb7e1c7677498e60bbf2761cef3de246544f', 'marty.oconnell@example.com', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:42'),
(83, '573c6ae5b8b0ddeb66353115e597c0ee905c66d15c56dffc591cd938fd95de42', 'corbin.harvey@example.com', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:42'),
(84, '0296be2523e143cee78ac6d34d129fb20552a6417038f00113c9fe0080a3640d', 'qmedhurst@example.net', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:42'),
(85, 'f2e10ded93f7c8a9e15af3f4f77e51b0b51fafd8a548997e5d4e42927d9152bc', 'krystina97@example.org', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:42'),
(86, '2f3dee774cdd1b1f590b429644366a3b78d92ebbf02e4cb9a9888381dadd89be', 'schumm.leonard@example.net', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:42'),
(87, '07aa965281b1af99a8005d09ab41b8a00d6a605ee96370250fc4b51225f885a7', 'krajcik.elena@example.net', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:42'),
(88, 'b2e34bd80e8c767819e11a10864ffe6ba11991ef95180ce0f23660abaf23f3bc', 'heidenreich.dominic@example.org', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:42'),
(89, '07b994febb43be6978a4378e601ded463f129fe1c828b9657b2438c38e9c653e', 'mayert.rahul@example.net', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:42'),
(90, 'b53451a4b5188bd9369e508f6141edcfe28f8c043ad87fbb1e6dbdae3aedbf12', 'estamm@example.com', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:42'),
(91, 'c4d888a81ded1d17599d1642e44e1de27a2b9722720b1c599bb7b7fbcbd18fd8', 'dheller@example.org', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:42'),
(92, '31f42f44847c37b997342e2924e53a3d8b14b0debfe4ca27bb93e5eca389de78', 'thompson.muhammad@example.com', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:42'),
(93, '7833822b3f2e71bdd743fce666180e4e39d8222b557ff2eb5e6fb633274c51c7', 'dwolf@example.com', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:42'),
(94, 'bafbec0a75d58a0043e16b7099def1c353b440d009444359c782eabc466b0174', 'fisher.maggie@example.org', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:43'),
(95, 'a2bf93123c9465a3522d6603211f89a5486414a66b27f5df4e9ce33228a27d3e', 'qrau@example.com', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:43'),
(96, '3587f412ad0e7698c9448a7ec88e811e8c15158239808a092f43126ec1bdf527', 'daphnee.kuhic@example.net', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:43'),
(97, '48865f2944b8b89fa411fb0a5f69a1252a9dbfa4359f0fdf038b86b7541880b5', 'okeefe.marlee@example.net', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:43'),
(98, 'f63448925e2b50f670c6a8efdd3448b3112deb863b10187abc1de2cfcf901020', 'crunolfsdottir@example.org', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:43'),
(99, 'cde39d8915c87f21bfccfe6ab7ca7332924689fbb619b8e6ca4d073490f268ee', 'ehagenes@example.org', 1, '2023-07-16 20:52:37', '2023-07-16 20:52:43'),
(100, 'f7ff87f95974151075ca62edb8a6d22e5c9dea927d51d1b3fa30e7d3c154191f', 'zmarks@example.net', 0, '2023-07-16 20:52:37', '2023-07-16 20:52:43');

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
(1, 'Super-Admin', 'super-admin@lettuce.com', '2023-07-16 20:52:20', '$2y$10$5iPPI5elPgqlkbbn8OtQ9eO3Oy0vagAzwvmGOuzwE3lJvNYGEPyUS', 1, NULL, '2023-07-16 20:52:20', '2023-07-16 20:52:20'),
(2, 'Admin', 'admin@lettuce.com', '2023-07-16 20:52:21', '$2y$10$NZRWD8KAmmenr9TllY5YzONR9JKR2YmnmwCoXuSXJOxyIDFaM7USS', 1, NULL, '2023-07-16 20:52:21', '2023-07-16 20:52:21'),
(3, 'Manager', 'manager@lettuce.com', '2023-07-16 20:52:21', '$2y$10$j.p6CHOH4pReYNftdrFIWuqid.zshqneCYyITCmDYtIBtA1dlBeCO', 1, NULL, '2023-07-16 20:52:21', '2023-07-16 20:52:21'),
(4, 'Miss Emilia Dietrich Jr.', 'tremblay.elmira@example.org', '2023-07-16 20:52:22', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'lKtSmjqJK8', '2023-07-16 20:52:22', '2023-07-16 20:52:22'),
(5, 'Lilly Herman', 'nbrakus@example.com', '2023-07-16 20:52:22', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'l8YoHeVurO', '2023-07-16 20:52:22', '2023-07-16 20:52:22'),
(6, 'Estell Sporer', 'zbergnaum@example.com', '2023-07-16 20:52:22', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'NYOklHf3Tt', '2023-07-16 20:52:22', '2023-07-16 20:52:22'),
(7, 'Susana Hermann', 'guillermo.gerlach@example.net', '2023-07-16 20:52:22', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'KzdDpR2Ud3', '2023-07-16 20:52:22', '2023-07-16 20:52:22'),
(8, 'Verlie Kshlerin', 'aleen25@example.net', '2023-07-16 20:52:22', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'IToiKYEiRl', '2023-07-16 20:52:22', '2023-07-16 20:52:22'),
(9, 'Ms. Micaela Quitzon PhD', 'twaelchi@example.net', '2023-07-16 20:52:22', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'gi7UcuvhWv', '2023-07-16 20:52:22', '2023-07-16 20:52:22'),
(10, 'Freeman Prohaska', 'kassandra09@example.com', '2023-07-16 20:52:22', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'lVKFbdFSUW', '2023-07-16 20:52:22', '2023-07-16 20:52:22'),
(11, 'Kelvin Corkery', 'yrodriguez@example.org', '2023-07-16 20:52:22', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'Z8EOSG4ynk', '2023-07-16 20:52:22', '2023-07-16 20:52:22'),
(12, 'Dexter Erdman', 'nellie.bednar@example.org', '2023-07-16 20:52:22', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'UDMzxLwRbC', '2023-07-16 20:52:22', '2023-07-16 20:52:22'),
(13, 'Maryse Koss', 'vonrueden.bryana@example.net', '2023-07-16 20:52:22', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'x60EzyGn8H', '2023-07-16 20:52:22', '2023-07-16 20:52:22');

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
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `avatar`, `phone`, `city`, `country`, `address`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, '2023-07-16 20:52:20', '2023-07-16 20:52:20'),
(2, 2, NULL, NULL, NULL, NULL, NULL, '2023-07-16 20:52:21', '2023-07-16 20:52:21'),
(3, 3, NULL, NULL, NULL, NULL, NULL, '2023-07-16 20:52:21', '2023-07-16 20:52:21'),
(4, 4, NULL, NULL, NULL, NULL, NULL, '2023-07-16 20:52:22', '2023-07-16 20:52:22'),
(5, 5, NULL, NULL, NULL, NULL, NULL, '2023-07-16 20:52:22', '2023-07-16 20:52:22'),
(6, 6, NULL, NULL, NULL, NULL, NULL, '2023-07-16 20:52:22', '2023-07-16 20:52:22'),
(7, 7, NULL, NULL, NULL, NULL, NULL, '2023-07-16 20:52:23', '2023-07-16 20:52:23'),
(8, 8, NULL, NULL, NULL, NULL, NULL, '2023-07-16 20:52:23', '2023-07-16 20:52:23'),
(9, 9, NULL, NULL, NULL, NULL, NULL, '2023-07-16 20:52:23', '2023-07-16 20:52:23'),
(10, 10, NULL, NULL, NULL, NULL, NULL, '2023-07-16 20:52:23', '2023-07-16 20:52:23'),
(11, 11, NULL, NULL, NULL, NULL, NULL, '2023-07-16 20:52:23', '2023-07-16 20:52:23'),
(12, 12, NULL, NULL, NULL, NULL, NULL, '2023-07-16 20:52:23', '2023-07-16 20:52:23'),
(13, 13, NULL, NULL, NULL, NULL, NULL, '2023-07-16 20:52:23', '2023-07-16 20:52:23');

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
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banners_discount_id_foreign` (`discount_id`),
  ADD KEY `banners_category_id_foreign` (`category_id`);

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
  ADD UNIQUE KEY `categories_category_name_unique` (`category_name`),
  ADD UNIQUE KEY `categories_category_slug_unique` (`category_slug`),
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
-- Indexes for table `contact_addresses`
--
ALTER TABLE `contact_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_emails`
--
ALTER TABLE `contact_emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_phones`
--
ALTER TABLE `contact_phones`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `logos`
--
ALTER TABLE `logos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `logos_type_unique` (`type`);

--
-- Indexes for table `mail_settings`
--
ALTER TABLE `mail_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_message_id_foreign` (`message_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
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
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD KEY `permission_user_permission_id_foreign` (`permission_id`),
  ADD KEY `permission_user_user_id_foreign` (`user_id`);

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
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD KEY `role_user_role_id_foreign` (`role_id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contact_addresses`
--
ALTER TABLE `contact_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_emails`
--
ALTER TABLE `contact_emails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_phones`
--
ALTER TABLE `contact_phones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logos`
--
ALTER TABLE `logos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mail_settings`
--
ALTER TABLE `mail_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `product_multiple_photos`
--
ALTER TABLE `product_multiple_photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_views`
--
ALTER TABLE `product_views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `banners`
--
ALTER TABLE `banners`
  ADD CONSTRAINT `banners_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `banners_discount_id_foreign` FOREIGN KEY (`discount_id`) REFERENCES `discounts` (`id`) ON DELETE SET NULL;

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
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_message_id_foreign` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 26, 2025 at 11:07 AM
-- Server version: 10.10.2-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dvizh`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(55) DEFAULT '',
  `tmp_user_id` varchar(55) DEFAULT NULL,
  `created_time` int(11) NOT NULL,
  `updated_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `tmp_user_id` (`tmp_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `tmp_user_id`, `created_time`, `updated_time`) VALUES
(1, '4', NULL, 1763717537, 1763720718),
(2, '', '909169bb12d972b476210a7be7a51b9b', 1763984381, 1763984381),
(3, '', '8e0c542f54f6918e6cb0cb169bedaad0', 1764063286, 1764070705),
(4, '', '979ae579441863a893c13f56e917463e', 1764149410, 1764154205);

-- --------------------------------------------------------

--
-- Table structure for table `cart_element`
--

DROP TABLE IF EXISTS `cart_element`;
CREATE TABLE IF NOT EXISTS `cart_element` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(55) DEFAULT 0,
  `model` varchar(110) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `item_id` int(55) NOT NULL,
  `count` int(11) NOT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `hash` varchar(255) NOT NULL,
  `options` text DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_id` (`cart_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certificate_certificate`
--

DROP TABLE IF EXISTS `certificate_certificate`;
CREATE TABLE IF NOT EXISTS `certificate_certificate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `date_elapsed` datetime DEFAULT NULL,
  `employment` varchar(55) NOT NULL,
  `status` varchar(255) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `target_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certificate_certificate_to_item`
--

DROP TABLE IF EXISTS `certificate_certificate_to_item`;
CREATE TABLE IF NOT EXISTS `certificate_certificate_to_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `certificate_id` int(11) NOT NULL,
  `target_model` varchar(500) NOT NULL,
  `target_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certificate_use`
--

DROP TABLE IF EXISTS `certificate_use`;
CREATE TABLE IF NOT EXISTS `certificate_use` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `certificate_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `balance` decimal(12,2) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `field`
--

DROP TABLE IF EXISTS `field`;
CREATE TABLE IF NOT EXISTS `field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `type` text DEFAULT NULL,
  `options` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `relation_model` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `field`
--

INSERT INTO `field` (`id`, `name`, `slug`, `category_id`, `type`, `options`, `description`, `relation_model`) VALUES
(2, 'icon', 'icon', NULL, 'text', NULL, 'Иконка категории', 'dvizh\\shop\\models\\Category');

-- --------------------------------------------------------

--
-- Table structure for table `field_category`
--

DROP TABLE IF EXISTS `field_category`;
CREATE TABLE IF NOT EXISTS `field_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `field_value`
--

DROP TABLE IF EXISTS `field_value`;
CREATE TABLE IF NOT EXISTS `field_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `numeric_value` int(11) DEFAULT NULL,
  `model_name` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `field_id` (`field_id`),
  KEY `variant_id` (`variant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `field_variant`
--

DROP TABLE IF EXISTS `field_variant`;
CREATE TABLE IF NOT EXISTS `field_variant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `numeric_value` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_field` (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `filter`
--

DROP TABLE IF EXISTS `filter`;
CREATE TABLE IF NOT EXISTS `filter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(155) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `relation_field_name` varchar(55) DEFAULT NULL,
  `is_filter` enum('yes','no') DEFAULT 'no',
  `type` varchar(55) NOT NULL,
  `relation_field_value` text DEFAULT NULL COMMENT 'PHP serialize',
  `is_option` enum('yes','no') DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `filter`
--

INSERT INTO `filter` (`id`, `name`, `slug`, `sort`, `description`, `relation_field_name`, `is_filter`, `type`, `relation_field_value`, `is_option`) VALUES
(2, 'Color', 'color', NULL, '', 'category_id', 'no', 'radio', 'a:1:{i:0;s:2:\"10\";}', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `filter_relation_value`
--

DROP TABLE IF EXISTS `filter_relation_value`;
CREATE TABLE IF NOT EXISTS `filter_relation_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filter_id` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `filter_value`
--

DROP TABLE IF EXISTS `filter_value`;
CREATE TABLE IF NOT EXISTS `filter_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filter_id` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `variant_item` (`variant_id`,`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `filter_variant`
--

DROP TABLE IF EXISTS `filter_variant`;
CREATE TABLE IF NOT EXISTS `filter_variant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filter_id` int(11) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `numeric_value` int(11) NOT NULL,
  `latin_value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_filter` (`filter_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `filter_variant`
--

INSERT INTO `filter_variant` (`id`, `filter_id`, `value`, `numeric_value`, `latin_value`) VALUES
(1, 2, 'Blue', 0, 'blue'),
(2, 2, 'Red', 0, 'red');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `alt` varchar(255) DEFAULT NULL,
  `filePath` varchar(400) NOT NULL,
  `itemId` int(20) NOT NULL,
  `isMain` tinyint(1) DEFAULT NULL,
  `modelName` varchar(150) NOT NULL,
  `urlAlias` varchar(400) NOT NULL,
  `description` text DEFAULT NULL,
  `gallery_id` varchar(150) DEFAULT NULL,
  `sort` int(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `title`, `alt`, `filePath`, `itemId`, `isMain`, `modelName`, `urlAlias`, `description`, `gallery_id`, `sort`) VALUES
(3, NULL, NULL, 'Products/Product4/21843e.jpg', 4, NULL, 'Product', '95a81a5179-2', NULL, NULL, NULL),
(7, NULL, NULL, 'Producers/Producer1/36bb40.jpg', 1, NULL, 'Producer', '87fe729d95-2', NULL, NULL, NULL),
(8, NULL, NULL, 'Sliders/Slider2/27d5e6.png', 2, NULL, 'Slider', '6bd7ab6260-2', NULL, NULL, NULL),
(9, NULL, NULL, 'Sliders/Slider3/7d446b.png', 3, NULL, 'Slider', '846a243ced-2', NULL, NULL, NULL),
(10, NULL, NULL, 'Sliders/Slider4/977f52.png', 4, NULL, 'Slider', '582ddac56b-2', NULL, NULL, NULL),
(11, NULL, NULL, 'Producers/Producer2/c318f6.png', 2, NULL, 'Producer', '1d7246b509-2', NULL, NULL, NULL),
(12, NULL, NULL, 'Producers/Producer3/8d1ea8.png', 3, NULL, 'Producer', '02c69a66d0-2', NULL, NULL, NULL),
(14, NULL, NULL, 'Products/Product6/cb1c1f.jpg', 6, NULL, 'Product', 'ee4c188b14-2', NULL, NULL, NULL),
(15, NULL, NULL, 'Products/Product5/79036f.jpg', 5, NULL, 'Product', '6962ca764a-2', NULL, NULL, NULL),
(17, NULL, NULL, 'Products/Product6/982401.png', 6, NULL, 'Product', 'af1aef3b3f-3', NULL, NULL, NULL),
(21, NULL, NULL, 'Products/Product6/014b5f.png', 6, NULL, 'Product', '944be959ff-3', NULL, NULL, NULL),
(22, NULL, NULL, 'Products/Product6/72212d.png', 6, NULL, 'Product', 'f427f28349-4', NULL, NULL, NULL),
(27, NULL, NULL, 'FilterVariants/FilterVariant1/6e4bcc.png', 1, NULL, 'FilterVariant', 'c3514c3713-2', NULL, NULL, NULL),
(28, NULL, NULL, 'FilterVariants/FilterVariant2/349ee5.png', 2, NULL, 'FilterVariant', 'ba63b9d58d-2', NULL, NULL, NULL),
(30, NULL, NULL, 'Modifications/Modification6/5571b0.png', 6, NULL, 'Modification', '9a8d329b5d-2', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1763653207),
('m140209_132017_init', 1763653207),
('m140403_174025_create_account_table', 1763653207),
('m140504_113157_update_tables', 1763653208),
('m140504_130429_create_token_table', 1763653208),
('m140506_102106_rbac_init', 1763653207),
('m140618_045255_create_settings', 1763653215),
('m140622_111540_create_image_table', 1763653210),
('m140830_171933_fix_ip_field', 1763653208),
('m140830_172703_change_account_table_name', 1763653208),
('m141222_110026_update_ip_field', 1763653208),
('m141222_135246_alter_username_length', 1763653208),
('m150614_103145_update_social_account_table', 1763653208),
('m150623_212711_fix_username_notnull', 1763653208),
('m151126_091910_add_unique_index', 1763653215),
('m151218_234654_add_timezone_to_profile', 1763653208),
('m160506_062849_create_cart', 1763653209),
('m160513_051524_Mass', 1763653209),
('m160513_121415_Mass', 1763653209),
('m160518_123713_Mass', 1763653210),
('m160521_112619_Mass', 1763653208),
('m160613_134415_Mass', 1763653210),
('m160929_103127_add_last_login_at_to_user_table', 1763653208),
('m161110_050319_create_assigment_fields', 1763653209),
('m161110_050319_create_organization_fields', 1763653209),
('m161129_101511_promocode_to_item', 1763653210),
('m161212_124011_certificate_certificate', 1763653210),
('m161212_124011_certificate_certificate_to_item', 1763653210),
('m161212_124111_certificate_use', 1763653210),
('m170116_073411_altertable_promocode', 1763653210),
('m170116_073511_promocode_used', 1763653210),
('m170117_131738_altertable_promocode_type', 1763653210),
('m170118_075411_promocode_condition', 1763653210),
('m170118_075611_promocode_to_condition', 1763653210),
('m170303_071750_altertable_promocode_cumulative', 1763653210),
('m170311_230319_create_is_deleted_field', 1763653209),
('m170311_234119_create_element_name_field', 1763653209),
('m170418_170456_register_user', 1763653208),
('m170419_110711_model_name_field', 1763653210),
('m170425_115443_latin_value_field', 1763653209),
('m170425_150102_base_migration', 1763653208),
('m170426_105633_modif_type_field', 1763653208),
('m170426_174712_insert_user_role', 1763653208),
('m170603_130822_add_sku_fields', 1763653208),
('m170603_130826_add_barcode_fields', 1763653208),
('m170603_130911_modification_to_option_table', 1763653208),
('m170628_150322_is_option_field', 1763653209),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1763653207),
('m180523_151638_rbac_updates_indexes_without_prefix', 1763653207),
('m200409_110543_rbac_update_mssql_trigger', 1763653207),
('m230217_134711_altertable_promocode_used', 1763653210),
('m250813_095006_transactions', 1764151497),
('m260519_000708_alter_cart_table', 1763653209),
('m270920_074737_add_column_comment_to_cart_element_table', 1763653209),
('m270920_094737_add_default_value_to_cart_table', 1763653209),
('m314315_215216_create_seo_table', 1763653210);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `anons` varchar(300) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `status` varchar(55) DEFAULT NULL,
  `date` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `promocode` varchar(100) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `cost` decimal(11,2) DEFAULT NULL,
  `base_cost` decimal(11,2) DEFAULT NULL,
  `payment_type_id` int(11) DEFAULT NULL,
  `shipping_type_id` int(11) DEFAULT NULL,
  `delivery_time_date` date DEFAULT NULL,
  `delivery_time_hour` smallint(6) DEFAULT NULL,
  `delivery_time_min` smallint(6) DEFAULT NULL,
  `delivery_type` enum('fast','totime') DEFAULT NULL,
  `status` varchar(155) DEFAULT NULL,
  `order_info` text DEFAULT NULL COMMENT 'PHP serialize',
  `time` varchar(50) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `seller_user_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `payment` enum('yes','no') NOT NULL DEFAULT 'no',
  `timestamp` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `is_assigment` tinyint(1) DEFAULT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_order_payment` (`payment_type_id`),
  KEY `fk_order_shipping` (`shipping_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `client_name`, `phone`, `email`, `promocode`, `count`, `cost`, `base_cost`, `payment_type_id`, `shipping_type_id`, `delivery_time_date`, `delivery_time_hour`, `delivery_time_min`, `delivery_type`, `status`, `order_info`, `time`, `user_id`, `seller_user_id`, `date`, `payment`, `timestamp`, `comment`, `address`, `is_assigment`, `organization_id`, `is_deleted`) VALUES
(1, 'Toshpolatov', '+998 90 942 85 90', 'test@gmail.com', NULL, NULL, '1000.00', '1000.00', 2, 3, NULL, NULL, NULL, NULL, 'new', NULL, '09:38:07', 4, NULL, '2025-11-21 00:00:00', 'no', 1763717887, 'dwadw', NULL, NULL, NULL, 1),
(2, 'Toshpolatov', '+998 90 942 85 90', 'test@gmail.com', NULL, NULL, '0.00', '0.00', 2, 3, NULL, NULL, NULL, NULL, 'new', NULL, '09:39:27', 4, NULL, '2025-11-21 00:00:00', 'no', 1763717967, 'dwadw', NULL, NULL, NULL, 1),
(3, 'Toshpolatov', '+998 90 942 85 90', 'test@gmail.com', NULL, NULL, '0.00', '0.00', 2, 3, NULL, NULL, NULL, NULL, 'new', NULL, '09:39:44', 4, NULL, '2025-11-21 00:00:00', 'no', 1763717984, 'dwadw', NULL, NULL, NULL, 1),
(4, 'Toshpolatov', '+998 90 942 85 90', 'test@gmail.com', NULL, NULL, '0.00', '0.00', 2, 3, NULL, NULL, NULL, NULL, 'new', NULL, '09:42:51', 4, NULL, '2025-11-21 00:00:00', 'no', 1763718171, 'dwadw', NULL, NULL, NULL, 1),
(5, 'Toshpolatov', '+998 90 942 85 90', 'test@gmail.com', NULL, NULL, '0.00', '0.00', 1, 3, NULL, NULL, NULL, NULL, 'cancel', NULL, '10:25:31', 4, NULL, '2025-11-21 00:00:00', 'no', 1763720731, '', NULL, NULL, NULL, 1),
(6, 'Azizbek', '+998 90 942 85 90', '500aziz9@gmail.com', NULL, NULL, '749.00', '749.00', NULL, NULL, NULL, NULL, NULL, NULL, 'new', NULL, '13:35:58', NULL, NULL, '2025-11-25 00:00:00', 'no', 1764077758, '', NULL, NULL, NULL, 0),
(7, 'Azizbek', '+998 90 942 85 90', '500aziz9@gmail.com', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, NULL, NULL, 'new', NULL, '15:08:09', NULL, NULL, '2025-11-25 00:00:00', 'no', 1764083289, '', NULL, NULL, NULL, 0),
(8, 'Azizbek', '+998 90 942 85 90', '500aziz9@gmail.com', NULL, NULL, '1498.00', '1498.00', 3, 1, NULL, NULL, NULL, NULL, 'new', NULL, '09:43:57', NULL, NULL, '2025-11-26 00:00:00', 'no', 1764150237, '', NULL, NULL, NULL, 0),
(9, 'Azizbek', '+998 90 942 85 90', '500aziz9@gmail.com', NULL, NULL, '0.00', '0.00', 3, 1, NULL, NULL, NULL, NULL, 'new', NULL, '09:44:53', NULL, NULL, '2025-11-26 00:00:00', 'no', 1764150293, '', NULL, NULL, NULL, 0),
(10, 'Azizbek', '+998 90 942 85 90', '500aziz9@gmail.com', NULL, NULL, '1498.00', '1498.00', NULL, NULL, NULL, NULL, NULL, NULL, 'new', NULL, '09:59:55', NULL, NULL, '2025-11-26 00:00:00', 'no', 1764151195, '', NULL, NULL, NULL, 0),
(11, 'Azizbek', '+998 90 942 85 90', '500aziz9@gmail.com', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, NULL, NULL, 'new', NULL, '10:07:08', NULL, NULL, '2025-11-26 00:00:00', 'no', 1764151628, '', NULL, NULL, NULL, 0),
(12, 'Azizbek', '+998 90 942 85 90', '500aziz9@gmail.com', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, NULL, NULL, 'new', NULL, '10:07:11', NULL, NULL, '2025-11-26 00:00:00', 'no', 1764151631, '', NULL, NULL, NULL, 0),
(13, 'Azizbek', '+998 90 942 85 90', '500aziz9@gmail.com', NULL, NULL, '0.00', '0.00', 1, 1, NULL, NULL, NULL, NULL, 'new', NULL, '10:07:23', NULL, NULL, '2025-11-26 00:00:00', 'no', 1764151643, '', NULL, NULL, NULL, 0),
(14, 'Azizbek', '+998 90 942 85 90', '500aziz9@gmail.com', NULL, NULL, '0.00', '0.00', NULL, NULL, NULL, NULL, NULL, NULL, 'new', NULL, '10:08:27', NULL, NULL, '2025-11-26 00:00:00', 'no', 1764151707, '', NULL, NULL, NULL, 0),
(15, 'Azizbek', '+998 90 942 85 90', '500aziz9@gmail.com', NULL, NULL, '1498.00', '1498.00', NULL, NULL, NULL, NULL, NULL, NULL, 'new', NULL, '10:09:13', NULL, NULL, '2025-11-26 00:00:00', 'no', 1764151753, '231', NULL, NULL, NULL, 0),
(16, 'Azizbek', '+998 90 942 85 90', '500aziz9@gmail.com', NULL, NULL, '5997.00', '5997.00', NULL, NULL, NULL, NULL, NULL, NULL, 'new', NULL, '10:15:55', NULL, NULL, '2025-11-26 00:00:00', 'no', 1764152155, '', NULL, NULL, NULL, 0),
(17, 'Azizbek', '+998 90 942 85 90', '500aziz9@gmail.com', NULL, NULL, '6245.00', '6245.00', NULL, NULL, NULL, NULL, NULL, NULL, 'new', NULL, '10:25:40', NULL, NULL, '2025-11-26 00:00:00', 'no', 1764152740, '', NULL, NULL, NULL, 0),
(18, 'Azizbek', '+998 90 942 85 90', '500aziz9@gmail.com', NULL, NULL, '20486.00', '20486.00', NULL, NULL, NULL, NULL, NULL, NULL, 'new', NULL, '10:27:07', NULL, NULL, '2025-11-26 00:00:00', 'no', 1764152827, '', NULL, NULL, NULL, 0),
(19, 'Azizbek', '+998 90 942 85 90', '500aziz9@gmail.com', NULL, NULL, '15739.00', '15739.00', 1, 1, NULL, NULL, NULL, NULL, 'new', NULL, '10:30:22', NULL, NULL, '2025-11-26 00:00:00', 'no', 1764153022, '', NULL, NULL, NULL, 0),
(20, 'Azizbek', '+998 90 942 85 90', '500aziz9@gmail.com', NULL, NULL, '17237.00', '17237.00', 1, 1, NULL, NULL, NULL, NULL, 'new', NULL, '10:34:22', NULL, NULL, '2025-11-26 00:00:00', 'no', 1764153262, '2132', NULL, NULL, NULL, 0),
(21, 'Azizbek', '+998 90 942 85 90', '500aziz9@gmail.com', NULL, NULL, '11741.00', '11741.00', NULL, NULL, NULL, NULL, NULL, NULL, 'new', NULL, '10:35:18', NULL, NULL, '2025-11-26 00:00:00', 'no', 1764153318, '21321', NULL, NULL, NULL, 0),
(22, 'Azizbek', '+998 90 942 85 90', '500aziz9@gmail.com', NULL, NULL, '10992.00', '10992.00', NULL, NULL, NULL, NULL, NULL, NULL, 'new', NULL, '10:40:41', NULL, NULL, '2025-11-26 00:00:00', 'no', 1764153641, '321', NULL, NULL, NULL, 0),
(23, 'Azizbek', '+998 90 942 85 90', '500aziz9@gmail.com', NULL, NULL, '14489.00', '14489.00', 1, 2, NULL, NULL, NULL, NULL, 'new', NULL, '10:44:25', NULL, NULL, '2025-11-26 00:00:00', 'no', 1764153865, '', NULL, NULL, NULL, 0),
(24, 'Azizbek', '+998 90 942 85 90', '500aziz9@gmail.com', NULL, NULL, '0.00', '0.00', 1, 2, NULL, NULL, NULL, NULL, 'new', NULL, '10:44:25', NULL, NULL, '2025-11-26 00:00:00', 'no', 1764153865, '', NULL, NULL, NULL, 0),
(25, 'Azizbek', '+998 90 942 85 90', '500aziz9@gmail.com', NULL, NULL, '0.00', '0.00', 1, 2, NULL, NULL, NULL, NULL, 'new', NULL, '10:44:29', NULL, NULL, '2025-11-26 00:00:00', 'no', 1764153869, '', NULL, NULL, NULL, 0),
(26, 'Azizbek', '+998 90 942 85 90', '500aziz9@gmail.com', NULL, NULL, '0.00', '0.00', 1, 2, NULL, NULL, NULL, NULL, 'new', NULL, '10:44:57', NULL, NULL, '2025-11-26 00:00:00', 'no', 1764153897, '', NULL, NULL, NULL, 0),
(27, 'Azizbek', '+998 90 942 85 90', '500aziz9@gmail.com', NULL, NULL, '15238.00', '15238.00', NULL, NULL, NULL, NULL, NULL, NULL, 'new', NULL, '10:45:22', NULL, NULL, '2025-11-26 00:00:00', 'no', 1764153922, '1321', NULL, NULL, NULL, 0),
(28, 'Azizbek', '+998 90 942 85 90', '500aziz9@gmail.com', NULL, NULL, '10243.00', '10243.00', NULL, NULL, NULL, NULL, NULL, NULL, 'new', NULL, '10:50:12', NULL, NULL, '2025-11-26 00:00:00', 'no', 1764154212, 'wda', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_element`
--

DROP TABLE IF EXISTS `order_element`;
CREATE TABLE IF NOT EXISTS `order_element` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `base_price` decimal(11,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `options` text DEFAULT NULL,
  `is_assigment` tinyint(1) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_element_order` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `order_element`
--

INSERT INTO `order_element` (`id`, `model`, `order_id`, `item_id`, `count`, `price`, `base_price`, `description`, `options`, `is_assigment`, `is_deleted`, `name`) VALUES
(1, 'dvizh\\shop\\models\\Product', 1, 3, 1, '1000.00', '1000.00', '', '[]', NULL, 0, 'Nvidia RTX 5090 Ti'),
(2, 'dvizh\\shop\\models\\Product', 5, 4, 2, NULL, NULL, '', '[]', NULL, 0, 'Nvidia RTX 5090 Ti'),
(3, 'dvizh\\shop\\models\\Product', 6, 6, 1, '749.00', '749.00', '', '[]', NULL, 0, 'AirPods Max'),
(4, 'dvizh\\shop\\models\\Product', 8, 6, 2, '749.00', '749.00', '', '[]', NULL, 0, 'AirPods Max'),
(5, 'dvizh\\shop\\models\\Product', 10, 6, 2, '749.00', '749.00', '', '[]', NULL, 0, 'AirPods Max'),
(6, 'dvizh\\shop\\models\\Product', 15, 6, 2, '749.00', '749.00', '', '[]', NULL, 0, 'AirPods Max'),
(7, 'dvizh\\shop\\models\\Product', 16, 5, 3, '1999.00', '1999.00', '', '[]', NULL, 0, 'Nvidia RTX 5090 Ti'),
(8, 'dvizh\\shop\\models\\Product', 17, 5, 2, '1999.00', '1999.00', '', '[]', NULL, 0, 'Nvidia RTX 5090 Ti'),
(9, 'dvizh\\shop\\models\\Product', 17, 6, 3, '749.00', '749.00', '', '[]', NULL, 0, 'AirPods Max'),
(10, 'dvizh\\shop\\models\\Product', 18, 5, 8, '1999.00', '1999.00', '', '[]', NULL, 0, 'Nvidia RTX 5090 Ti'),
(11, 'dvizh\\shop\\models\\Product', 18, 6, 6, '749.00', '749.00', '', '[]', NULL, 0, 'AirPods Max'),
(12, 'dvizh\\shop\\models\\Product', 19, 6, 5, '749.00', '749.00', '', '[]', NULL, 0, 'AirPods Max'),
(13, 'dvizh\\shop\\models\\Product', 19, 5, 6, '1999.00', '1999.00', '', '[]', NULL, 0, 'Nvidia RTX 5090 Ti'),
(14, 'dvizh\\shop\\models\\Product', 20, 6, 7, '749.00', '749.00', '', '[]', NULL, 0, 'AirPods Max'),
(15, 'dvizh\\shop\\models\\Product', 20, 5, 6, '1999.00', '1999.00', '', '[]', NULL, 0, 'Nvidia RTX 5090 Ti'),
(16, 'dvizh\\shop\\models\\Product', 21, 6, 5, '749.00', '749.00', '', '[]', NULL, 0, 'AirPods Max'),
(17, 'dvizh\\shop\\models\\Product', 21, 5, 4, '1999.00', '1999.00', '', '[]', NULL, 0, 'Nvidia RTX 5090 Ti'),
(18, 'dvizh\\shop\\models\\Product', 22, 6, 4, '749.00', '749.00', '', '[]', NULL, 0, 'AirPods Max'),
(19, 'dvizh\\shop\\models\\Product', 22, 5, 4, '1999.00', '1999.00', '', '[]', NULL, 0, 'Nvidia RTX 5090 Ti'),
(20, 'dvizh\\shop\\models\\Product', 23, 6, 6, '749.00', '749.00', '', '[]', NULL, 0, 'AirPods Max'),
(21, 'dvizh\\shop\\models\\Product', 23, 5, 5, '1999.00', '1999.00', '', '[]', NULL, 0, 'Nvidia RTX 5090 Ti'),
(22, 'dvizh\\shop\\models\\Product', 27, 6, 7, '749.00', '749.00', '', '[]', NULL, 0, 'AirPods Max'),
(23, 'dvizh\\shop\\models\\Product', 27, 5, 5, '1999.00', '1999.00', '', '[]', NULL, 0, 'Nvidia RTX 5090 Ti'),
(24, 'dvizh\\shop\\models\\Product', 28, 5, 4, '1999.00', '1999.00', '', '[]', NULL, 0, 'Nvidia RTX 5090 Ti'),
(25, 'dvizh\\shop\\models\\Product', 28, 6, 3, '749.00', '749.00', '', '[]', NULL, 0, 'AirPods Max');

-- --------------------------------------------------------

--
-- Table structure for table `order_field`
--

DROP TABLE IF EXISTS `order_field`;
CREATE TABLE IF NOT EXISTS `order_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `required` enum('yes','no') NOT NULL DEFAULT 'no',
  `order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_field_type` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_field_type`
--

DROP TABLE IF EXISTS `order_field_type`;
CREATE TABLE IF NOT EXISTS `order_field_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `widget` varchar(255) DEFAULT NULL,
  `have_variants` enum('yes','no') DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `order_field_type`
--

INSERT INTO `order_field_type` (`id`, `name`, `widget`, `have_variants`) VALUES
(1, 'Input', 'dvizh\\order\\widgets\\field_type\\Input', 'no'),
(2, 'Textarea', 'dvizh\\order\\widgets\\field_type\\Textarea', 'no'),
(3, 'Select', 'dvizh\\order\\widgets\\field_type\\Select', 'yes'),
(4, 'Checkbox', 'dvizh\\order\\widgets\\field_type\\Checkbox', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `order_field_value`
--

DROP TABLE IF EXISTS `order_field_value`;
CREATE TABLE IF NOT EXISTS `order_field_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `value` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_field_order` (`order_id`),
  KEY `fk_value_field` (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_field_value_variant`
--

DROP TABLE IF EXISTS `order_field_value_variant`;
CREATE TABLE IF NOT EXISTS `order_field_value_variant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_variant_field` (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_payment`
--

DROP TABLE IF EXISTS `order_payment`;
CREATE TABLE IF NOT EXISTS `order_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `payment_type_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `ip` varchar(55) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_payment_order` (`order_id`),
  KEY `fk_payment_payment_type` (`payment_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `order_payment`
--

INSERT INTO `order_payment` (`id`, `order_id`, `payment_type_id`, `user_id`, `description`, `ip`, `amount`, `date`) VALUES
(1, 4, 2, 4, 'Order #4', '::1', '0.00', '2025-11-21 09:42:51'),
(2, 5, 1, 4, 'Order #5', '::1', '0.00', '2025-11-21 10:25:31'),
(3, 8, 3, NULL, 'Order #8', '::1', '1498.00', '2025-11-26 09:43:57'),
(4, 9, 3, NULL, 'Order #9', '::1', '0.00', '2025-11-26 09:44:53'),
(5, 13, 1, NULL, 'Order #13', '::1', '0.00', '2025-11-26 10:07:23'),
(6, 19, 1, NULL, 'Order #19', '::1', '15739.00', '2025-11-26 10:30:22'),
(7, 20, 1, NULL, 'Order #20', '::1', '17237.00', '2025-11-26 10:34:22'),
(8, 23, 1, NULL, 'Order #23', '::1', '14489.00', '2025-11-26 10:44:25'),
(9, 24, 1, NULL, 'Order #24', '::1', '0.00', '2025-11-26 10:44:25'),
(10, 25, 1, NULL, 'Order #25', '::1', '0.00', '2025-11-26 10:44:29'),
(11, 26, 1, NULL, 'Order #26', '::1', '0.00', '2025-11-26 10:44:57');

-- --------------------------------------------------------

--
-- Table structure for table `order_payment_type`
--

DROP TABLE IF EXISTS `order_payment_type`;
CREATE TABLE IF NOT EXISTS `order_payment_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `widget` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `order_payment_type`
--

INSERT INTO `order_payment_type` (`id`, `slug`, `name`, `widget`, `order`) VALUES
(1, '', 'Наличный расчет', '', NULL),
(2, '', 'Безналичный расчет', '', NULL),
(3, '', 'Онлайн', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_shipping_type`
--

DROP TABLE IF EXISTS `order_shipping_type`;
CREATE TABLE IF NOT EXISTS `order_shipping_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `cost` decimal(11,2) DEFAULT NULL,
  `free_cost_from` decimal(11,2) DEFAULT NULL,
  `order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `order_shipping_type`
--

INSERT INTO `order_shipping_type` (`id`, `name`, `description`, `cost`, `free_cost_from`, `order`) VALUES
(1, 'Самовывоз', '', '0.00', NULL, NULL),
(2, 'Доставка по Узбекистану', '', '0.00', NULL, NULL),
(3, 'Доставка курьером по Ташкенту', '', '0.00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `template` varchar(55) NOT NULL,
  `text` text DEFAULT NULL,
  `status` varchar(55) NOT NULL DEFAULT 'draft',
  `show_page` varchar(10) NOT NULL DEFAULT 'no',
  `title` varchar(512) DEFAULT NULL,
  `sort` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `public_email` varchar(255) DEFAULT NULL,
  `gravatar_email` varchar(255) DEFAULT NULL,
  `gravatar_id` varchar(32) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `timezone` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`user_id`, `name`, `public_email`, `gravatar_email`, `gravatar_id`, `location`, `website`, `bio`, `timezone`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `promocode`
--

DROP TABLE IF EXISTS `promocode`;
CREATE TABLE IF NOT EXISTS `promocode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `code` varchar(14) NOT NULL,
  `discount` int(2) NOT NULL,
  `status` int(1) NOT NULL,
  `date_elapsed` datetime DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `type` enum('percent','quantum','cumulative') NOT NULL DEFAULT 'percent',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promocode_condition`
--

DROP TABLE IF EXISTS `promocode_condition`;
CREATE TABLE IF NOT EXISTS `promocode_condition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sum_start` int(10) NOT NULL,
  `sum_stop` int(10) NOT NULL,
  `value` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promocode_to_condition`
--

DROP TABLE IF EXISTS `promocode_to_condition`;
CREATE TABLE IF NOT EXISTS `promocode_to_condition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promocode_id` int(11) NOT NULL,
  `condition_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promocode_to_item`
--

DROP TABLE IF EXISTS `promocode_to_item`;
CREATE TABLE IF NOT EXISTS `promocode_to_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promocode_id` int(11) NOT NULL,
  `item_model` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promocode_use`
--

DROP TABLE IF EXISTS `promocode_use`;
CREATE TABLE IF NOT EXISTS `promocode_use` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promocode_id` int(11) NOT NULL,
  `user_id` varchar(55) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_promocode` (`promocode_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promocode_used`
--

DROP TABLE IF EXISTS `promocode_used`;
CREATE TABLE IF NOT EXISTS `promocode_used` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promocode_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `user` int(11) DEFAULT NULL,
  `sum` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rbac_auth_assignment`
--

DROP TABLE IF EXISTS `rbac_auth_assignment`;
CREATE TABLE IF NOT EXISTS `rbac_auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `rbac_auth_assignment`
--

INSERT INTO `rbac_auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('superadmin', '1', 1492519516),
('superadmin', '4', 1492519516);

-- --------------------------------------------------------

--
-- Table structure for table `rbac_auth_item`
--

DROP TABLE IF EXISTS `rbac_auth_item`;
CREATE TABLE IF NOT EXISTS `rbac_auth_item` (
  `name` varchar(64) NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text DEFAULT NULL,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `rbac_auth_item`
--

INSERT INTO `rbac_auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('superadmin', 1, '', NULL, 0x31343932353139353030, 1492519500, 1492519500);

-- --------------------------------------------------------

--
-- Table structure for table `rbac_auth_item_child`
--

DROP TABLE IF EXISTS `rbac_auth_item_child`;
CREATE TABLE IF NOT EXISTS `rbac_auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rbac_auth_rule`
--

DROP TABLE IF EXISTS `rbac_auth_rule`;
CREATE TABLE IF NOT EXISTS `rbac_auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seo`
--

DROP TABLE IF EXISTS `seo`;
CREATE TABLE IF NOT EXISTS `seo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) DEFAULT NULL,
  `modelName` varchar(150) NOT NULL,
  `h1` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(522) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `meta_index` varchar(255) DEFAULT NULL,
  `redirect_301` varchar(522) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seo`
--

INSERT INTO `seo` (`id`, `item_id`, `modelName`, `h1`, `title`, `keywords`, `description`, `text`, `meta_index`, `redirect_301`) VALUES
(2, 2, 'Category', '', '', '', '', '', '', ''),
(3, 1, 'Producer', '', '', '', '', '', '', ''),
(7, 4, 'Product', '', '', '', '', '', '', ''),
(8, 2, 'Producer', '', '', '', '', '', '', ''),
(9, 3, 'Producer', '', '', '', '', '', '', ''),
(10, 3, 'Category', '', '', '', '', '', '', ''),
(11, 4, 'Category', '', '', '', '', '', '', ''),
(12, 5, 'Category', '', '', '', '', '', '', ''),
(13, 6, 'Category', '', '', '', '', '', '', ''),
(14, 7, 'Category', '', '', '', '', '', '', ''),
(15, 8, 'Category', '', '', '', '', '', '', ''),
(16, 9, 'Category', '', '', '', '', '', '', ''),
(17, 10, 'Category', '', '', '', '', '', '', ''),
(18, 11, 'Category', '', '', '', '', '', '', ''),
(19, 12, 'Category', '', '', '', '', '', '', ''),
(20, 13, 'Category', '', '', '', '', '', '', ''),
(21, 14, 'Category', '', '', '', '', '', '', ''),
(22, 15, 'Category', '', '', '', '', '', '', ''),
(23, 16, 'Category', '', '', '', '', '', '', ''),
(24, 17, 'Category', '', '', '', '', '', '', ''),
(25, 18, 'Category', '', '', '', '', '', '', ''),
(26, 19, 'Category', '', '', '', '', '', '', ''),
(27, 5, 'Product', '', '', '', '', '', '', ''),
(28, 6, 'Product', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_unique_key_section` (`section`,`key`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `type`, `section`, `key`, `value`, `active`, `created`, `modified`) VALUES
(1, 'string', 'General', 'currency', ' Сўм', 1, '2025-11-24 16:19:41', '2025-11-26 14:30:53'),
(2, 'integer', 'General', 'octoMerchatId', '42024', 1, '2025-11-25 20:33:05', NULL),
(3, 'string', 'General', 'octoSecret', '2891560f-5ed4-4e9b-aca0-17b2fc4fbd50', 1, '2025-11-25 20:33:44', NULL),
(6, 'string', 'General', 'octoUrl', 'https://secure.octo.uz', 1, '2025-11-25 20:39:03', NULL),
(7, 'string', 'General', 'telegramBotToken', '8449083412:AAG_W1k0lKsVzRcDSyDt5kk4_IbkdAvZJx8', 1, '2025-11-26 15:25:14', '2025-11-26 15:39:25');

-- --------------------------------------------------------

--
-- Table structure for table `shop_category`
--

DROP TABLE IF EXISTS `shop_category`;
CREATE TABLE IF NOT EXISTS `shop_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(55) NOT NULL,
  `code` varchar(155) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `shop_category`
--

INSERT INTO `shop_category` (`id`, `parent_id`, `name`, `code`, `slug`, `text`, `image`, `sort`) VALUES
(2, 1, 'Видеокарты', NULL, 'videokarty', '', NULL, NULL),
(3, NULL, 'Computers & Accessories', NULL, 'computers-accessories', '', NULL, NULL),
(4, NULL, 'Smartphones & Tablets', NULL, 'smartphones-tablets', '', NULL, NULL),
(5, NULL, 'TV, Video & Audio', NULL, 'tv-video-audio', '', NULL, NULL),
(6, NULL, 'Speakers & Home Music', NULL, 'speakers-home-music', '', NULL, NULL),
(7, NULL, 'Cameras, Photo & Video', NULL, 'cameras-photo-video', '', NULL, NULL),
(8, NULL, 'Printers & Ink', NULL, 'printers-ink', '', NULL, NULL),
(9, NULL, 'Charging Stations', NULL, 'charging-stations', '', NULL, NULL),
(10, NULL, 'Headphones', NULL, 'headphones', '', NULL, NULL),
(11, NULL, 'Wearable Electronics', NULL, 'wearable-electronics', '', NULL, NULL),
(12, NULL, 'Powerbanks', NULL, 'powerbanks', '', NULL, NULL),
(13, NULL, 'HDD/SSD Data Storage', NULL, 'hdd-ssd-data-storage', '', NULL, NULL),
(14, NULL, 'Video Games', NULL, 'video-games', '', NULL, NULL),
(15, 17, 'Laptops & Tablets', NULL, 'laptops-tablets', '', NULL, NULL),
(16, 17, 'Desktop Computers', NULL, 'desktop-computers', '', NULL, NULL),
(17, 3, 'Computers', NULL, 'computers', '', NULL, NULL),
(18, 3, 'Accessories', NULL, 'accessories', '', NULL, NULL),
(19, 18, 'Monitors', NULL, 'monitors', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_incoming`
--

DROP TABLE IF EXISTS `shop_incoming`;
CREATE TABLE IF NOT EXISTS `shop_incoming` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `content` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop_outcoming`
--

DROP TABLE IF EXISTS `shop_outcoming`;
CREATE TABLE IF NOT EXISTS `shop_outcoming` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop_price`
--

DROP TABLE IF EXISTS `shop_price`;
CREATE TABLE IF NOT EXISTS `shop_price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(155) DEFAULT NULL,
  `name` varchar(155) NOT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `price_old` decimal(11,2) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `available` enum('yes','no') DEFAULT 'yes',
  `type` char(1) DEFAULT 'p',
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `fk_type` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `shop_price`
--

INSERT INTO `shop_price` (`id`, `code`, `name`, `price`, `price_old`, `sort`, `amount`, `type_id`, `item_id`, `available`, `type`) VALUES
(5, '', 'Основная цена', '1999.00', '2199.00', NULL, 10, 1, 4, 'yes', 'p'),
(6, NULL, 'Основная цена', '1999.00', '21999.00', NULL, NULL, 1, 5, 'yes', 'p'),
(7, NULL, 'Основная цена', '749.00', NULL, NULL, NULL, 1, 6, 'yes', 'p');

-- --------------------------------------------------------

--
-- Table structure for table `shop_price_type`
--

DROP TABLE IF EXISTS `shop_price_type`;
CREATE TABLE IF NOT EXISTS `shop_price_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `condition` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `shop_price_type`
--

INSERT INTO `shop_price_type` (`id`, `name`, `sort`, `condition`) VALUES
(1, 'Основная цена', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_producer`
--

DROP TABLE IF EXISTS `shop_producer`;
CREATE TABLE IF NOT EXISTS `shop_producer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(155) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `image` text DEFAULT NULL,
  `text` text DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `shop_producer`
--

INSERT INTO `shop_producer` (`id`, `code`, `name`, `image`, `text`, `slug`) VALUES
(1, NULL, 'Nvidia', NULL, '', 'nvidia'),
(2, NULL, 'Apple', NULL, '', 'apple'),
(3, NULL, 'Logitech', NULL, '', 'logitech');

-- --------------------------------------------------------

--
-- Table structure for table `shop_product`
--

DROP TABLE IF EXISTS `shop_product`;
CREATE TABLE IF NOT EXISTS `shop_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(10) DEFAULT NULL,
  `producer_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `related_products` text DEFAULT NULL COMMENT 'PHP serialize',
  `name` varchar(200) NOT NULL,
  `code` varchar(155) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `short_text` varchar(255) DEFAULT NULL,
  `is_new` enum('yes','no') DEFAULT 'no',
  `is_popular` enum('yes','no') DEFAULT 'no',
  `is_promo` enum('yes','no') DEFAULT 'no',
  `images` text DEFAULT NULL,
  `available` enum('yes','no') DEFAULT 'yes',
  `sort` int(11) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `related_ids` text DEFAULT NULL,
  `sku` varchar(55) DEFAULT NULL,
  `barcode` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `producer_id` (`producer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `shop_product`
--

INSERT INTO `shop_product` (`id`, `category_id`, `producer_id`, `amount`, `related_products`, `name`, `code`, `text`, `short_text`, `is_new`, `is_popular`, `is_promo`, `images`, `available`, `sort`, `slug`, `related_ids`, `sku`, `barcode`) VALUES
(5, 18, 1, 10, NULL, 'Nvidia RTX 5090 Ti', 'rtx-5090ti', '', '', 'yes', 'yes', 'yes', NULL, 'yes', NULL, 'nvidia-rtx-5090-ti', 'a:0:{}', '5090', ''),
(6, 10, 2, 10, NULL, 'AirPods Max', 'airpods-max', '', '', 'yes', 'yes', 'yes', NULL, 'yes', NULL, 'airpods-max', 'a:0:{}', '11111', '');

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_modification`
--

DROP TABLE IF EXISTS `shop_product_modification`;
CREATE TABLE IF NOT EXISTS `shop_product_modification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `code` varchar(155) DEFAULT NULL,
  `images` text DEFAULT NULL,
  `available` enum('yes','no') DEFAULT 'yes',
  `sort` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `filter_values` text DEFAULT NULL,
  `sku` varchar(55) DEFAULT NULL,
  `barcode` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `shop_product_modification`
--

INSERT INTO `shop_product_modification` (`id`, `amount`, `product_id`, `name`, `slug`, `code`, `images`, `available`, `sort`, `create_time`, `update_time`, `filter_values`, `sku`, `barcode`) VALUES
(6, NULL, 6, ' Blue', 'blue', '', NULL, 'yes', NULL, '2025-11-24 16:15:49', '2025-11-24 16:16:27', NULL, '', ''),
(7, NULL, 6, ' Red', 'red', '', NULL, 'yes', NULL, '2025-11-24 16:16:10', '2025-11-24 16:16:10', NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_modification_to_option`
--

DROP TABLE IF EXISTS `shop_product_modification_to_option`;
CREATE TABLE IF NOT EXISTS `shop_product_modification_to_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modification_id` int(10) DEFAULT NULL,
  `option_id` int(11) DEFAULT NULL,
  `variant_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_to_category`
--

DROP TABLE IF EXISTS `shop_product_to_category`;
CREATE TABLE IF NOT EXISTS `shop_product_to_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cat_to_product` (`product_id`),
  KEY `fk_cat_to_product_2` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `shop_product_to_category`
--

INSERT INTO `shop_product_to_category` (`id`, `product_id`, `category_id`) VALUES
(13, 5, 18),
(15, 6, 10);

-- --------------------------------------------------------

--
-- Table structure for table `shop_stock`
--

DROP TABLE IF EXISTS `shop_stock`;
CREATE TABLE IF NOT EXISTS `shop_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `text` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop_stock_to_product`
--

DROP TABLE IF EXISTS `shop_stock_to_product`;
CREATE TABLE IF NOT EXISTS `shop_stock_to_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop_stock_to_user`
--

DROP TABLE IF EXISTS `shop_stock_to_user`;
CREATE TABLE IF NOT EXISTS `shop_stock_to_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_stock` (`stock_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

DROP TABLE IF EXISTS `slider`;
CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `short_text` text DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `name`, `url`, `slug`, `short_text`, `sort`) VALUES
(2, 'Airpods Max', '#', NULL, '<p>Feel the real quality sound</p>', NULL),
(3, 'Experience New Reality', '#', NULL, '<p>Virtual reality glasses</p>', NULL),
(4, 'Powerful iPad Pro M2', '#', NULL, '<p>Deal of the week</p>', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `social_account`
--

DROP TABLE IF EXISTS `social_account`;
CREATE TABLE IF NOT EXISTS `social_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `data` text DEFAULT NULL,
  `code` varchar(32) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_unique` (`provider`,`client_id`),
  UNIQUE KEY `account_unique_code` (`code`),
  KEY `fk_user_account` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

DROP TABLE IF EXISTS `token`;
CREATE TABLE IF NOT EXISTS `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  UNIQUE KEY `token_unique` (`user_id`,`code`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` varchar(64) DEFAULT NULL,
  `octo_uuid` varchar(64) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `sum` int(11) DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `status` varchar(64) DEFAULT NULL,
  `signature` varchar(128) DEFAULT NULL,
  `hash_key` varchar(128) DEFAULT NULL,
  `total_sum` decimal(10,0) DEFAULT NULL,
  `transfer_sum` decimal(10,0) DEFAULT NULL,
  `refunded_sum` decimal(10,0) DEFAULT NULL,
  `card_country` varchar(255) DEFAULT NULL,
  `maskedPan` varchar(64) DEFAULT NULL,
  `rrn` varchar(64) DEFAULT NULL,
  `payed_time` varchar(64) DEFAULT NULL,
  `card_type` varchar(64) DEFAULT NULL,
  `is_physical_card` varchar(64) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions-order` (`order_id`),
  KEY `transactions-creator` (`created_by`),
  KEY `transactions-updated` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_id`, `octo_uuid`, `order_id`, `sum`, `currency`, `description`, `status`, `signature`, `hash_key`, `total_sum`, `transfer_sum`, `refunded_sum`, `card_country`, `maskedPan`, `rrn`, `payed_time`, `card_type`, `is_physical_card`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'XQr-Xq7ZjR6klW8ByMqlgeu9', NULL, 22, 10992, 'UZS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1764153805, 4, NULL, NULL),
(2, 'g1k-3jvRSPc_hHMcRcicUEaa', 'f0c8eea8-dd25-4778-8f65-b26dc7dcc967', 22, 10992, 'UZS', NULL, 'created', NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 1764153819, 4, NULL, NULL),
(3, 'RBNJ5JzyBzViHmZGHEzVtTfh', '90a3301f-d3a9-42f0-97bd-4cafa10eb740', 23, 14489, 'UZS', NULL, 'created', NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 1764153865, 4, NULL, NULL),
(4, 'eJfcGbhyKILSzCpHKC58KtoE', NULL, 24, 0, 'UZS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1764153865, 4, NULL, NULL),
(5, 'DZaE-b-WELAfXzd2ZghPCnjo', NULL, 25, 0, 'UZS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1764153869, 4, NULL, NULL),
(6, 'sBeBPr3w_z0KtIqARtD2R6Xs', NULL, 26, 0, 'UZS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1764153897, 4, NULL, NULL),
(7, 'Z65Anuwo43_ONLxNtIxGgWhp', '123d8c36-aae4-46ea-b88c-eb9cbe7621a1', 27, 15238, 'UZS', NULL, 'created', NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 1764153922, 4, NULL, NULL),
(8, 'Vxo-vlE5lYAeB3-YTtlJxs20', 'a787550c-56d0-4b18-9213-b02aadfa995d', 28, 10243, 'UZS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1764154212, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT 0,
  `last_login_at` int(11) DEFAULT NULL,
  `phone` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique_username` (`username`),
  UNIQUE KEY `user_unique_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `auth_key`, `confirmed_at`, `unconfirmed_email`, `blocked_at`, `registration_ip`, `created_at`, `updated_at`, `flags`, `last_login_at`, `phone`) VALUES
(1, 'administrator', 'administrator@localhost.lc', '$2y$10$Z.VEdUOWsWNL0OOgubnqzuhqsgTLz6cC7EMXjzqQkSFok3wNNeasy', 'qI8YZpXSQF1dujgB0GH9361xDfcB8Qwl', 1492070371, NULL, NULL, '127.0.0.1', 1492070371, 1492070371, 0, 1763716347, NULL),
(3, 'administrator2', '', '$2y$10$C5nrtr7JOXXz0CZ/5aymjOu3Vx3iTOm9HcqpPs3D7ZiCXoVOFKAn.', 'qI8YZpXSQF1dujgB0GH9361xDfcB8Qwl', 1492070371, NULL, NULL, '127.0.0.1', 1492070371, 1492070371, 0, 1763655461, NULL),
(4, 'hello', 'test@gmail.com', '$2y$10$Z.VEdUOWsWNL0OOgubnqzuhqsgTLz6cC7EMXjzqQkSFok3wNNeasy', 'ARqbPWob3E5Dh2jZ_X84-ARJQCzjKR0S', 1763657012, NULL, NULL, '127.0.0.1', 1763656091, 1763656091, 0, 1764149424, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_element`
--
ALTER TABLE `cart_element`
  ADD CONSTRAINT `elem_to_cart` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `field`
--
ALTER TABLE `field`
  ADD CONSTRAINT `fk_field_category_id` FOREIGN KEY (`category_id`) REFERENCES `field_category` (`id`);

--
-- Constraints for table `field_value`
--
ALTER TABLE `field_value`
  ADD CONSTRAINT `fk_field_value_field_id` FOREIGN KEY (`field_id`) REFERENCES `field` (`id`);

--
-- Constraints for table `field_variant`
--
ALTER TABLE `field_variant`
  ADD CONSTRAINT `fk_field_variant_field_id` FOREIGN KEY (`field_id`) REFERENCES `field` (`id`);

--
-- Constraints for table `filter_value`
--
ALTER TABLE `filter_value`
  ADD CONSTRAINT `fk_variant` FOREIGN KEY (`variant_id`) REFERENCES `filter_variant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `filter_variant`
--
ALTER TABLE `filter_variant`
  ADD CONSTRAINT `fk_filter` FOREIGN KEY (`filter_id`) REFERENCES `filter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_payment` FOREIGN KEY (`payment_type_id`) REFERENCES `order_payment_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_shipping` FOREIGN KEY (`shipping_type_id`) REFERENCES `order_shipping_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_element`
--
ALTER TABLE `order_element`
  ADD CONSTRAINT `fk_element_order` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_field`
--
ALTER TABLE `order_field`
  ADD CONSTRAINT `fk_field_type` FOREIGN KEY (`type_id`) REFERENCES `order_field_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_field_value`
--
ALTER TABLE `order_field_value`
  ADD CONSTRAINT `fk_field_order` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_value_field` FOREIGN KEY (`field_id`) REFERENCES `order_field` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_field_value_variant`
--
ALTER TABLE `order_field_value_variant`
  ADD CONSTRAINT `fk_variant_field` FOREIGN KEY (`field_id`) REFERENCES `order_field` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_payment`
--
ALTER TABLE `order_payment`
  ADD CONSTRAINT `fk_payment_order` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_payment_payment_type` FOREIGN KEY (`payment_type_id`) REFERENCES `order_payment_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `promocode_use`
--
ALTER TABLE `promocode_use`
  ADD CONSTRAINT `fk_promocode` FOREIGN KEY (`promocode_id`) REFERENCES `promocode` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rbac_auth_assignment`
--
ALTER TABLE `rbac_auth_assignment`
  ADD CONSTRAINT `rbac_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rbac_auth_item`
--
ALTER TABLE `rbac_auth_item`
  ADD CONSTRAINT `rbac_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `rbac_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `rbac_auth_item_child`
--
ALTER TABLE `rbac_auth_item_child`
  ADD CONSTRAINT `rbac_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rbac_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shop_price`
--
ALTER TABLE `shop_price`
  ADD CONSTRAINT `fk_type` FOREIGN KEY (`type_id`) REFERENCES `shop_price_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shop_product`
--
ALTER TABLE `shop_product`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `shop_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_producer` FOREIGN KEY (`producer_id`) REFERENCES `shop_producer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shop_product_modification`
--
ALTER TABLE `shop_product_modification`
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`product_id`) REFERENCES `shop_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shop_product_to_category`
--
ALTER TABLE `shop_product_to_category`
  ADD CONSTRAINT `fk_cat_to_product` FOREIGN KEY (`product_id`) REFERENCES `shop_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cat_to_product_2` FOREIGN KEY (`category_id`) REFERENCES `shop_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shop_stock_to_user`
--
ALTER TABLE `shop_stock_to_user`
  ADD CONSTRAINT `fk_stock` FOREIGN KEY (`stock_id`) REFERENCES `shop_stock` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `social_account`
--
ALTER TABLE `social_account`
  ADD CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions-creator` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `transactions-order` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
  ADD CONSTRAINT `transactions-updated` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

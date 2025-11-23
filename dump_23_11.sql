-- MariaDB dump 10.19  Distrib 10.10.2-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: dvizh
-- ------------------------------------------------------
-- Server version	10.10.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(55) DEFAULT '',
  `tmp_user_id` varchar(55) DEFAULT NULL,
  `created_time` int(11) NOT NULL,
  `updated_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `tmp_user_id` (`tmp_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES
(1,'4',NULL,1763717537,1763720718);
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart_element`
--

DROP TABLE IF EXISTS `cart_element`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart_element` (
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
  KEY `cart_id` (`cart_id`),
  CONSTRAINT `elem_to_cart` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart_element`
--

LOCK TABLES `cart_element` WRITE;
/*!40000 ALTER TABLE `cart_element` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart_element` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `certificate_certificate`
--

DROP TABLE IF EXISTS `certificate_certificate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `certificate_certificate` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `certificate_certificate`
--

LOCK TABLES `certificate_certificate` WRITE;
/*!40000 ALTER TABLE `certificate_certificate` DISABLE KEYS */;
/*!40000 ALTER TABLE `certificate_certificate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `certificate_certificate_to_item`
--

DROP TABLE IF EXISTS `certificate_certificate_to_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `certificate_certificate_to_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `certificate_id` int(11) NOT NULL,
  `target_model` varchar(500) NOT NULL,
  `target_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `certificate_certificate_to_item`
--

LOCK TABLES `certificate_certificate_to_item` WRITE;
/*!40000 ALTER TABLE `certificate_certificate_to_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `certificate_certificate_to_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `certificate_use`
--

DROP TABLE IF EXISTS `certificate_use`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `certificate_use` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `certificate_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `balance` decimal(12,2) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `certificate_use`
--

LOCK TABLES `certificate_use` WRITE;
/*!40000 ALTER TABLE `certificate_use` DISABLE KEYS */;
/*!40000 ALTER TABLE `certificate_use` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `field`
--

DROP TABLE IF EXISTS `field`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `type` text DEFAULT NULL,
  `options` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `relation_model` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `fk_field_category_id` FOREIGN KEY (`category_id`) REFERENCES `field_category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `field`
--

LOCK TABLES `field` WRITE;
/*!40000 ALTER TABLE `field` DISABLE KEYS */;
INSERT INTO `field` VALUES
(2,'icon','icon',NULL,'text',NULL,'Иконка категории','dvizh\\shop\\models\\Category');
/*!40000 ALTER TABLE `field` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `field_category`
--

DROP TABLE IF EXISTS `field_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `field_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `field_category`
--

LOCK TABLES `field_category` WRITE;
/*!40000 ALTER TABLE `field_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `field_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `field_value`
--

DROP TABLE IF EXISTS `field_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `field_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `numeric_value` int(11) DEFAULT NULL,
  `model_name` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `field_id` (`field_id`),
  KEY `variant_id` (`variant_id`),
  CONSTRAINT `fk_field_value_field_id` FOREIGN KEY (`field_id`) REFERENCES `field` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `field_value`
--

LOCK TABLES `field_value` WRITE;
/*!40000 ALTER TABLE `field_value` DISABLE KEYS */;
/*!40000 ALTER TABLE `field_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `field_variant`
--

DROP TABLE IF EXISTS `field_variant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `field_variant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `numeric_value` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_field` (`field_id`),
  CONSTRAINT `fk_field_variant_field_id` FOREIGN KEY (`field_id`) REFERENCES `field` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `field_variant`
--

LOCK TABLES `field_variant` WRITE;
/*!40000 ALTER TABLE `field_variant` DISABLE KEYS */;
/*!40000 ALTER TABLE `field_variant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `filter`
--

DROP TABLE IF EXISTS `filter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `filter` (
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filter`
--

LOCK TABLES `filter` WRITE;
/*!40000 ALTER TABLE `filter` DISABLE KEYS */;
/*!40000 ALTER TABLE `filter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `filter_relation_value`
--

DROP TABLE IF EXISTS `filter_relation_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `filter_relation_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filter_id` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filter_relation_value`
--

LOCK TABLES `filter_relation_value` WRITE;
/*!40000 ALTER TABLE `filter_relation_value` DISABLE KEYS */;
/*!40000 ALTER TABLE `filter_relation_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `filter_value`
--

DROP TABLE IF EXISTS `filter_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `filter_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filter_id` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `variant_item` (`variant_id`,`item_id`),
  CONSTRAINT `fk_variant` FOREIGN KEY (`variant_id`) REFERENCES `filter_variant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filter_value`
--

LOCK TABLES `filter_value` WRITE;
/*!40000 ALTER TABLE `filter_value` DISABLE KEYS */;
/*!40000 ALTER TABLE `filter_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `filter_variant`
--

DROP TABLE IF EXISTS `filter_variant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `filter_variant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filter_id` int(11) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `numeric_value` int(11) NOT NULL,
  `latin_value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_filter` (`filter_id`),
  CONSTRAINT `fk_filter` FOREIGN KEY (`filter_id`) REFERENCES `filter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filter_variant`
--

LOCK TABLES `filter_variant` WRITE;
/*!40000 ALTER TABLE `filter_variant` DISABLE KEYS */;
/*!40000 ALTER TABLE `filter_variant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image` (
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image`
--

LOCK TABLES `image` WRITE;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
INSERT INTO `image` VALUES
(3,NULL,NULL,'Products/Product4/21843e.jpg',4,NULL,'Product','95a81a5179-2',NULL,NULL,NULL),
(7,NULL,NULL,'Producers/Producer1/36bb40.jpg',1,NULL,'Producer','87fe729d95-2',NULL,NULL,NULL),
(8,NULL,NULL,'Sliders/Slider2/27d5e6.png',2,NULL,'Slider','6bd7ab6260-2',NULL,NULL,NULL),
(9,NULL,NULL,'Sliders/Slider3/7d446b.png',3,NULL,'Slider','846a243ced-2',NULL,NULL,NULL),
(10,NULL,NULL,'Sliders/Slider4/977f52.png',4,NULL,'Slider','582ddac56b-2',NULL,NULL,NULL),
(11,NULL,NULL,'Producers/Producer2/c318f6.png',2,NULL,'Producer','1d7246b509-2',NULL,NULL,NULL),
(12,NULL,NULL,'Producers/Producer3/8d1ea8.png',3,NULL,'Producer','02c69a66d0-2',NULL,NULL,NULL),
(14,NULL,NULL,'Products/Product6/cb1c1f.jpg',6,NULL,'Product','ee4c188b14-2',NULL,NULL,NULL),
(15,NULL,NULL,'Products/Product5/79036f.jpg',5,NULL,'Product','6962ca764a-2',NULL,NULL,NULL);
/*!40000 ALTER TABLE `image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES
('m000000_000000_base',1763653207),
('m140209_132017_init',1763653207),
('m140403_174025_create_account_table',1763653207),
('m140504_113157_update_tables',1763653208),
('m140504_130429_create_token_table',1763653208),
('m140506_102106_rbac_init',1763653207),
('m140618_045255_create_settings',1763653215),
('m140622_111540_create_image_table',1763653210),
('m140830_171933_fix_ip_field',1763653208),
('m140830_172703_change_account_table_name',1763653208),
('m141222_110026_update_ip_field',1763653208),
('m141222_135246_alter_username_length',1763653208),
('m150614_103145_update_social_account_table',1763653208),
('m150623_212711_fix_username_notnull',1763653208),
('m151126_091910_add_unique_index',1763653215),
('m151218_234654_add_timezone_to_profile',1763653208),
('m160506_062849_create_cart',1763653209),
('m160513_051524_Mass',1763653209),
('m160513_121415_Mass',1763653209),
('m160518_123713_Mass',1763653210),
('m160521_112619_Mass',1763653208),
('m160613_134415_Mass',1763653210),
('m160929_103127_add_last_login_at_to_user_table',1763653208),
('m161110_050319_create_assigment_fields',1763653209),
('m161110_050319_create_organization_fields',1763653209),
('m161129_101511_promocode_to_item',1763653210),
('m161212_124011_certificate_certificate',1763653210),
('m161212_124011_certificate_certificate_to_item',1763653210),
('m161212_124111_certificate_use',1763653210),
('m170116_073411_altertable_promocode',1763653210),
('m170116_073511_promocode_used',1763653210),
('m170117_131738_altertable_promocode_type',1763653210),
('m170118_075411_promocode_condition',1763653210),
('m170118_075611_promocode_to_condition',1763653210),
('m170303_071750_altertable_promocode_cumulative',1763653210),
('m170311_230319_create_is_deleted_field',1763653209),
('m170311_234119_create_element_name_field',1763653209),
('m170418_170456_register_user',1763653208),
('m170419_110711_model_name_field',1763653210),
('m170425_115443_latin_value_field',1763653209),
('m170425_150102_base_migration',1763653208),
('m170426_105633_modif_type_field',1763653208),
('m170426_174712_insert_user_role',1763653208),
('m170603_130822_add_sku_fields',1763653208),
('m170603_130826_add_barcode_fields',1763653208),
('m170603_130911_modification_to_option_table',1763653208),
('m170628_150322_is_option_field',1763653209),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id',1763653207),
('m180523_151638_rbac_updates_indexes_without_prefix',1763653207),
('m200409_110543_rbac_update_mssql_trigger',1763653207),
('m230217_134711_altertable_promocode_used',1763653210),
('m260519_000708_alter_cart_table',1763653209),
('m270920_074737_add_column_comment_to_cart_element_table',1763653209),
('m270920_094737_add_default_value_to_cart_table',1763653209),
('m314315_215216_create_seo_table',1763653210);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `anons` varchar(300) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `status` varchar(55) DEFAULT NULL,
  `date` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
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
  KEY `fk_order_shipping` (`shipping_type_id`),
  CONSTRAINT `fk_order_payment` FOREIGN KEY (`payment_type_id`) REFERENCES `order_payment_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_order_shipping` FOREIGN KEY (`shipping_type_id`) REFERENCES `order_shipping_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES
(1,'Toshpolatov','+998 90 942 85 90','test@gmail.com',NULL,NULL,1000.00,1000.00,2,3,NULL,NULL,NULL,NULL,'new',NULL,'09:38:07',4,NULL,'2025-11-21 00:00:00','no',1763717887,'dwadw',NULL,NULL,NULL,1),
(2,'Toshpolatov','+998 90 942 85 90','test@gmail.com',NULL,NULL,0.00,0.00,2,3,NULL,NULL,NULL,NULL,'new',NULL,'09:39:27',4,NULL,'2025-11-21 00:00:00','no',1763717967,'dwadw',NULL,NULL,NULL,1),
(3,'Toshpolatov','+998 90 942 85 90','test@gmail.com',NULL,NULL,0.00,0.00,2,3,NULL,NULL,NULL,NULL,'new',NULL,'09:39:44',4,NULL,'2025-11-21 00:00:00','no',1763717984,'dwadw',NULL,NULL,NULL,1),
(4,'Toshpolatov','+998 90 942 85 90','test@gmail.com',NULL,NULL,0.00,0.00,2,3,NULL,NULL,NULL,NULL,'new',NULL,'09:42:51',4,NULL,'2025-11-21 00:00:00','no',1763718171,'dwadw',NULL,NULL,NULL,1),
(5,'Toshpolatov','+998 90 942 85 90','test@gmail.com',NULL,NULL,0.00,0.00,1,3,NULL,NULL,NULL,NULL,'cancel',NULL,'10:25:31',4,NULL,'2025-11-21 00:00:00','no',1763720731,'',NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_element`
--

DROP TABLE IF EXISTS `order_element`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_element` (
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
  KEY `fk_element_order` (`order_id`),
  CONSTRAINT `fk_element_order` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_element`
--

LOCK TABLES `order_element` WRITE;
/*!40000 ALTER TABLE `order_element` DISABLE KEYS */;
INSERT INTO `order_element` VALUES
(1,'dvizh\\shop\\models\\Product',1,3,1,1000.00,1000.00,'','[]',NULL,0,'Nvidia RTX 5090 Ti'),
(2,'dvizh\\shop\\models\\Product',5,4,2,NULL,NULL,'','[]',NULL,0,'Nvidia RTX 5090 Ti');
/*!40000 ALTER TABLE `order_element` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_field`
--

DROP TABLE IF EXISTS `order_field`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `required` enum('yes','no') NOT NULL DEFAULT 'no',
  `order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `fk_field_type` (`type_id`),
  CONSTRAINT `fk_field_type` FOREIGN KEY (`type_id`) REFERENCES `order_field_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_field`
--

LOCK TABLES `order_field` WRITE;
/*!40000 ALTER TABLE `order_field` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_field` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_field_type`
--

DROP TABLE IF EXISTS `order_field_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_field_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `widget` varchar(255) DEFAULT NULL,
  `have_variants` enum('yes','no') DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_field_type`
--

LOCK TABLES `order_field_type` WRITE;
/*!40000 ALTER TABLE `order_field_type` DISABLE KEYS */;
INSERT INTO `order_field_type` VALUES
(1,'Input','dvizh\\order\\widgets\\field_type\\Input','no'),
(2,'Textarea','dvizh\\order\\widgets\\field_type\\Textarea','no'),
(3,'Select','dvizh\\order\\widgets\\field_type\\Select','yes'),
(4,'Checkbox','dvizh\\order\\widgets\\field_type\\Checkbox','yes');
/*!40000 ALTER TABLE `order_field_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_field_value`
--

DROP TABLE IF EXISTS `order_field_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_field_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `value` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_field_order` (`order_id`),
  KEY `fk_value_field` (`field_id`),
  CONSTRAINT `fk_field_order` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_value_field` FOREIGN KEY (`field_id`) REFERENCES `order_field` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_field_value`
--

LOCK TABLES `order_field_value` WRITE;
/*!40000 ALTER TABLE `order_field_value` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_field_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_field_value_variant`
--

DROP TABLE IF EXISTS `order_field_value_variant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_field_value_variant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_variant_field` (`field_id`),
  CONSTRAINT `fk_variant_field` FOREIGN KEY (`field_id`) REFERENCES `order_field` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_field_value_variant`
--

LOCK TABLES `order_field_value_variant` WRITE;
/*!40000 ALTER TABLE `order_field_value_variant` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_field_value_variant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_payment`
--

DROP TABLE IF EXISTS `order_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_payment` (
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
  KEY `fk_payment_payment_type` (`payment_type_id`),
  CONSTRAINT `fk_payment_order` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_payment_payment_type` FOREIGN KEY (`payment_type_id`) REFERENCES `order_payment_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_payment`
--

LOCK TABLES `order_payment` WRITE;
/*!40000 ALTER TABLE `order_payment` DISABLE KEYS */;
INSERT INTO `order_payment` VALUES
(1,4,2,4,'Order #4','::1',0.00,'2025-11-21 09:42:51'),
(2,5,1,4,'Order #5','::1',0.00,'2025-11-21 10:25:31');
/*!40000 ALTER TABLE `order_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_payment_type`
--

DROP TABLE IF EXISTS `order_payment_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_payment_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `widget` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_payment_type`
--

LOCK TABLES `order_payment_type` WRITE;
/*!40000 ALTER TABLE `order_payment_type` DISABLE KEYS */;
INSERT INTO `order_payment_type` VALUES
(1,'','Наличный расчет','',NULL),
(2,'','Безналичный расчет','',NULL),
(3,'','Онлайн','',NULL);
/*!40000 ALTER TABLE `order_payment_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_shipping_type`
--

DROP TABLE IF EXISTS `order_shipping_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_shipping_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `cost` decimal(11,2) DEFAULT NULL,
  `free_cost_from` decimal(11,2) DEFAULT NULL,
  `order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_shipping_type`
--

LOCK TABLES `order_shipping_type` WRITE;
/*!40000 ALTER TABLE `order_shipping_type` DISABLE KEYS */;
INSERT INTO `order_shipping_type` VALUES
(1,'Самовывоз','',0.00,NULL,NULL),
(2,'Доставка по России','',0.00,NULL,NULL),
(3,'Доставка курьером по городу','',0.00,NULL,NULL);
/*!40000 ALTER TABLE `order_shipping_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page`
--

LOCK TABLES `page` WRITE;
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
/*!40000 ALTER TABLE `page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `public_email` varchar(255) DEFAULT NULL,
  `gravatar_email` varchar(255) DEFAULT NULL,
  `gravatar_id` varchar(32) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `timezone` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES
(1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promocode`
--

DROP TABLE IF EXISTS `promocode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promocode` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promocode`
--

LOCK TABLES `promocode` WRITE;
/*!40000 ALTER TABLE `promocode` DISABLE KEYS */;
/*!40000 ALTER TABLE `promocode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promocode_condition`
--

DROP TABLE IF EXISTS `promocode_condition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promocode_condition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sum_start` int(10) NOT NULL,
  `sum_stop` int(10) NOT NULL,
  `value` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promocode_condition`
--

LOCK TABLES `promocode_condition` WRITE;
/*!40000 ALTER TABLE `promocode_condition` DISABLE KEYS */;
/*!40000 ALTER TABLE `promocode_condition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promocode_to_condition`
--

DROP TABLE IF EXISTS `promocode_to_condition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promocode_to_condition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promocode_id` int(11) NOT NULL,
  `condition_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promocode_to_condition`
--

LOCK TABLES `promocode_to_condition` WRITE;
/*!40000 ALTER TABLE `promocode_to_condition` DISABLE KEYS */;
/*!40000 ALTER TABLE `promocode_to_condition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promocode_to_item`
--

DROP TABLE IF EXISTS `promocode_to_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promocode_to_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promocode_id` int(11) NOT NULL,
  `item_model` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promocode_to_item`
--

LOCK TABLES `promocode_to_item` WRITE;
/*!40000 ALTER TABLE `promocode_to_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `promocode_to_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promocode_use`
--

DROP TABLE IF EXISTS `promocode_use`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promocode_use` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promocode_id` int(11) NOT NULL,
  `user_id` varchar(55) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_promocode` (`promocode_id`),
  CONSTRAINT `fk_promocode` FOREIGN KEY (`promocode_id`) REFERENCES `promocode` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promocode_use`
--

LOCK TABLES `promocode_use` WRITE;
/*!40000 ALTER TABLE `promocode_use` DISABLE KEYS */;
/*!40000 ALTER TABLE `promocode_use` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promocode_used`
--

DROP TABLE IF EXISTS `promocode_used`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promocode_used` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `promocode_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `user` int(11) DEFAULT NULL,
  `sum` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promocode_used`
--

LOCK TABLES `promocode_used` WRITE;
/*!40000 ALTER TABLE `promocode_used` DISABLE KEYS */;
/*!40000 ALTER TABLE `promocode_used` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rbac_auth_assignment`
--

DROP TABLE IF EXISTS `rbac_auth_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rbac_auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`),
  CONSTRAINT `rbac_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rbac_auth_assignment`
--

LOCK TABLES `rbac_auth_assignment` WRITE;
/*!40000 ALTER TABLE `rbac_auth_assignment` DISABLE KEYS */;
INSERT INTO `rbac_auth_assignment` VALUES
('superadmin','1',1492519516),
('superadmin','4',1492519516);
/*!40000 ALTER TABLE `rbac_auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rbac_auth_item`
--

DROP TABLE IF EXISTS `rbac_auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rbac_auth_item` (
  `name` varchar(64) NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text DEFAULT NULL,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `rbac_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `rbac_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rbac_auth_item`
--

LOCK TABLES `rbac_auth_item` WRITE;
/*!40000 ALTER TABLE `rbac_auth_item` DISABLE KEYS */;
INSERT INTO `rbac_auth_item` VALUES
('superadmin',1,'',NULL,'1492519500',1492519500,1492519500);
/*!40000 ALTER TABLE `rbac_auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rbac_auth_item_child`
--

DROP TABLE IF EXISTS `rbac_auth_item_child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rbac_auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `rbac_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rbac_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rbac_auth_item_child`
--

LOCK TABLES `rbac_auth_item_child` WRITE;
/*!40000 ALTER TABLE `rbac_auth_item_child` DISABLE KEYS */;
/*!40000 ALTER TABLE `rbac_auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rbac_auth_rule`
--

DROP TABLE IF EXISTS `rbac_auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rbac_auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rbac_auth_rule`
--

LOCK TABLES `rbac_auth_rule` WRITE;
/*!40000 ALTER TABLE `rbac_auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `rbac_auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seo`
--

DROP TABLE IF EXISTS `seo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seo` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seo`
--

LOCK TABLES `seo` WRITE;
/*!40000 ALTER TABLE `seo` DISABLE KEYS */;
INSERT INTO `seo` VALUES
(2,2,'Category','','','','','','',''),
(3,1,'Producer','','','','','','',''),
(7,4,'Product','','','','','','',''),
(8,2,'Producer','','','','','','',''),
(9,3,'Producer','','','','','','',''),
(10,3,'Category','','','','','','',''),
(11,4,'Category','','','','','','',''),
(12,5,'Category','','','','','','',''),
(13,6,'Category','','','','','','',''),
(14,7,'Category','','','','','','',''),
(15,8,'Category','','','','','','',''),
(16,9,'Category','','','','','','',''),
(17,10,'Category','','','','','','',''),
(18,11,'Category','','','','','','',''),
(19,12,'Category','','','','','','',''),
(20,13,'Category','','','','','','',''),
(21,14,'Category','','','','','','',''),
(22,15,'Category','','','','','','',''),
(23,16,'Category','','','','','','',''),
(24,17,'Category','','','','','','',''),
(25,18,'Category','','','','','','',''),
(26,19,'Category','','','','','','',''),
(27,5,'Product','','','','','','',''),
(28,6,'Product','','','','','','','');
/*!40000 ALTER TABLE `seo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_category`
--

DROP TABLE IF EXISTS `shop_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_category` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_category`
--

LOCK TABLES `shop_category` WRITE;
/*!40000 ALTER TABLE `shop_category` DISABLE KEYS */;
INSERT INTO `shop_category` VALUES
(2,1,'Видеокарты',NULL,'videokarty','',NULL,NULL),
(3,NULL,'Computers & Accessories',NULL,'computers-accessories','',NULL,NULL),
(4,NULL,'Smartphones & Tablets',NULL,'smartphones-tablets','',NULL,NULL),
(5,NULL,'TV, Video & Audio',NULL,'tv-video-audio','',NULL,NULL),
(6,NULL,'Speakers & Home Music',NULL,'speakers-home-music','',NULL,NULL),
(7,NULL,'Cameras, Photo & Video',NULL,'cameras-photo-video','',NULL,NULL),
(8,NULL,'Printers & Ink',NULL,'printers-ink','',NULL,NULL),
(9,NULL,'Charging Stations',NULL,'charging-stations','',NULL,NULL),
(10,NULL,'Headphones',NULL,'headphones','',NULL,NULL),
(11,NULL,'Wearable Electronics',NULL,'wearable-electronics','',NULL,NULL),
(12,NULL,'Powerbanks',NULL,'powerbanks','',NULL,NULL),
(13,NULL,'HDD/SSD Data Storage',NULL,'hdd-ssd-data-storage','',NULL,NULL),
(14,NULL,'Video Games',NULL,'video-games','',NULL,NULL),
(15,17,'Laptops & Tablets',NULL,'laptops-tablets','',NULL,NULL),
(16,17,'Desktop Computers',NULL,'desktop-computers','',NULL,NULL),
(17,3,'Computers',NULL,'computers','',NULL,NULL),
(18,3,'Accessories',NULL,'accessories','',NULL,NULL),
(19,18,'Monitors',NULL,'monitors','',NULL,NULL);
/*!40000 ALTER TABLE `shop_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_incoming`
--

DROP TABLE IF EXISTS `shop_incoming`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_incoming` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `content` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_incoming`
--

LOCK TABLES `shop_incoming` WRITE;
/*!40000 ALTER TABLE `shop_incoming` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_incoming` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_outcoming`
--

DROP TABLE IF EXISTS `shop_outcoming`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_outcoming` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_outcoming`
--

LOCK TABLES `shop_outcoming` WRITE;
/*!40000 ALTER TABLE `shop_outcoming` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_outcoming` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_price`
--

DROP TABLE IF EXISTS `shop_price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_price` (
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
  KEY `fk_type` (`type_id`),
  CONSTRAINT `fk_type` FOREIGN KEY (`type_id`) REFERENCES `shop_price_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_price`
--

LOCK TABLES `shop_price` WRITE;
/*!40000 ALTER TABLE `shop_price` DISABLE KEYS */;
INSERT INTO `shop_price` VALUES
(5,'','Основная цена',1999.00,2199.00,NULL,10,1,4,'yes','p'),
(6,NULL,'Основная цена',1999.00,21999.00,NULL,NULL,1,5,'yes','p'),
(7,NULL,'Основная цена',749.00,NULL,NULL,NULL,1,6,'yes','p');
/*!40000 ALTER TABLE `shop_price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_price_type`
--

DROP TABLE IF EXISTS `shop_price_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_price_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `condition` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_price_type`
--

LOCK TABLES `shop_price_type` WRITE;
/*!40000 ALTER TABLE `shop_price_type` DISABLE KEYS */;
INSERT INTO `shop_price_type` VALUES
(1,'Основная цена',NULL,NULL);
/*!40000 ALTER TABLE `shop_price_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_producer`
--

DROP TABLE IF EXISTS `shop_producer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_producer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(155) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `image` text DEFAULT NULL,
  `text` text DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_producer`
--

LOCK TABLES `shop_producer` WRITE;
/*!40000 ALTER TABLE `shop_producer` DISABLE KEYS */;
INSERT INTO `shop_producer` VALUES
(1,NULL,'Nvidia',NULL,'','nvidia'),
(2,NULL,'Apple',NULL,'','apple'),
(3,NULL,'Logitech',NULL,'','logitech');
/*!40000 ALTER TABLE `shop_producer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_product`
--

DROP TABLE IF EXISTS `shop_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_product` (
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
  KEY `producer_id` (`producer_id`),
  CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `shop_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_producer` FOREIGN KEY (`producer_id`) REFERENCES `shop_producer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_product`
--

LOCK TABLES `shop_product` WRITE;
/*!40000 ALTER TABLE `shop_product` DISABLE KEYS */;
INSERT INTO `shop_product` VALUES
(5,18,1,10,NULL,'Nvidia RTX 5090 Ti','rtx-5090ti','','','yes','yes','yes',NULL,'yes',NULL,'nvidia-rtx-5090-ti','a:0:{}','5090',''),
(6,10,2,10,NULL,'AirPods Max','airpods-max','','','yes','yes','yes',NULL,'yes',NULL,'airpods-max','a:0:{}','11111','');
/*!40000 ALTER TABLE `shop_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_product_modification`
--

DROP TABLE IF EXISTS `shop_product_modification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_product_modification` (
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
  KEY `fk_product` (`product_id`),
  CONSTRAINT `fk_product` FOREIGN KEY (`product_id`) REFERENCES `shop_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_product_modification`
--

LOCK TABLES `shop_product_modification` WRITE;
/*!40000 ALTER TABLE `shop_product_modification` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_product_modification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_product_modification_to_option`
--

DROP TABLE IF EXISTS `shop_product_modification_to_option`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_product_modification_to_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modification_id` int(10) DEFAULT NULL,
  `option_id` int(11) DEFAULT NULL,
  `variant_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_product_modification_to_option`
--

LOCK TABLES `shop_product_modification_to_option` WRITE;
/*!40000 ALTER TABLE `shop_product_modification_to_option` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_product_modification_to_option` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_product_to_category`
--

DROP TABLE IF EXISTS `shop_product_to_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_product_to_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cat_to_product` (`product_id`),
  KEY `fk_cat_to_product_2` (`category_id`),
  CONSTRAINT `fk_cat_to_product` FOREIGN KEY (`product_id`) REFERENCES `shop_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_cat_to_product_2` FOREIGN KEY (`category_id`) REFERENCES `shop_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_product_to_category`
--

LOCK TABLES `shop_product_to_category` WRITE;
/*!40000 ALTER TABLE `shop_product_to_category` DISABLE KEYS */;
INSERT INTO `shop_product_to_category` VALUES
(13,5,18),
(15,6,10);
/*!40000 ALTER TABLE `shop_product_to_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_stock`
--

DROP TABLE IF EXISTS `shop_stock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `text` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_stock`
--

LOCK TABLES `shop_stock` WRITE;
/*!40000 ALTER TABLE `shop_stock` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_stock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_stock_to_product`
--

DROP TABLE IF EXISTS `shop_stock_to_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_stock_to_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_stock_to_product`
--

LOCK TABLES `shop_stock_to_product` WRITE;
/*!40000 ALTER TABLE `shop_stock_to_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_stock_to_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_stock_to_user`
--

DROP TABLE IF EXISTS `shop_stock_to_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_stock_to_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_stock` (`stock_id`),
  CONSTRAINT `fk_stock` FOREIGN KEY (`stock_id`) REFERENCES `shop_stock` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_stock_to_user`
--

LOCK TABLES `shop_stock_to_user` WRITE;
/*!40000 ALTER TABLE `shop_stock_to_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_stock_to_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slider`
--

DROP TABLE IF EXISTS `slider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `short_text` text DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slider`
--

LOCK TABLES `slider` WRITE;
/*!40000 ALTER TABLE `slider` DISABLE KEYS */;
INSERT INTO `slider` VALUES
(2,'Airpods Max','#',NULL,'<p>Feel the real quality sound</p>',NULL),
(3,'Experience New Reality','#',NULL,'<p>Virtual reality glasses</p>',NULL),
(4,'Powerful iPad Pro M2','#',NULL,'<p>Deal of the week</p>',NULL);
/*!40000 ALTER TABLE `slider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `social_account`
--

DROP TABLE IF EXISTS `social_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `social_account` (
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
  KEY `fk_user_account` (`user_id`),
  CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `social_account`
--

LOCK TABLES `social_account` WRITE;
/*!40000 ALTER TABLE `social_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `social_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `token`
--

DROP TABLE IF EXISTS `token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  UNIQUE KEY `token_unique` (`user_id`,`code`,`type`),
  CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `token`
--

LOCK TABLES `token` WRITE;
/*!40000 ALTER TABLE `token` DISABLE KEYS */;
/*!40000 ALTER TABLE `token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique_username` (`username`),
  UNIQUE KEY `user_unique_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES
(1,'administrator','administrator@localhost.lc','$2y$10$Z.VEdUOWsWNL0OOgubnqzuhqsgTLz6cC7EMXjzqQkSFok3wNNeasy','qI8YZpXSQF1dujgB0GH9361xDfcB8Qwl',1492070371,NULL,NULL,'127.0.0.1',1492070371,1492070371,0,1763716347),
(3,'administrator2','','$2y$10$C5nrtr7JOXXz0CZ/5aymjOu3Vx3iTOm9HcqpPs3D7ZiCXoVOFKAn.','qI8YZpXSQF1dujgB0GH9361xDfcB8Qwl',1492070371,NULL,NULL,'127.0.0.1',1492070371,1492070371,0,1763655461),
(4,'hello','test@gmail.com','$2y$10$Z.VEdUOWsWNL0OOgubnqzuhqsgTLz6cC7EMXjzqQkSFok3wNNeasy','ARqbPWob3E5Dh2jZ_X84-ARJQCzjKR0S',1763657012,NULL,NULL,'127.0.0.1',1763656091,1763656091,0,1763813155);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-23 16:28:13

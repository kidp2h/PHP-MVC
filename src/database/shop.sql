-- Adminer 4.8.1 MySQL 8.0.31 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `shop`;
CREATE DATABASE `shop` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `shop`;

DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner` (
  `images` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

INSERT INTO `banner` (`images`) VALUES
('[\"/public/images/banners/banner-img-1.jpg\",\"/public/images/banners/banner-img-2.jpg\",\"/public/images/banners/banner-img-3.jpg\",\"/public/images/banners/banner-img-4.jpg\"]')
ON DUPLICATE KEY UPDATE `images` = VALUES(`images`);

DROP TABLE IF EXISTS `cart_item`;
CREATE TABLE `cart_item` (
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`user_id`,`product_id`),
  KEY `cart_item_fk_2` (`product_id`),
  CONSTRAINT `cart_item_fk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `cart_item_fk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

INSERT INTO `cart_item` (`user_id`, `product_id`, `quantity`) VALUES
(25,	6,	1),
(25,	8,	1),
(25,	16,	2),
(25,	17,	8)
ON DUPLICATE KEY UPDATE `user_id` = VALUES(`user_id`), `product_id` = VALUES(`product_id`), `quantity` = VALUES(`quantity`);

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `updated_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `deleted_at` timestamp(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

INSERT INTO `category` (`id`, `title`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(0,	'CHƯA CÓ LOẠI',	'/public/images/products/product.jpg',	'2022-05-25 00:02:36.252961',	'2022-05-25 00:02:36.252961',	NULL),
(1,	'LAPTOP',	'/public/images/categories/cd7fdddd-081a-4b46-931c-67d5e9923a1d.jpg',	'2022-05-08 18:17:50.930563',	'2022-05-08 18:17:50.930563',	'2022-05-25 07:00:41.000000'),
(2,	'WATCH',	'/public/images/categories/468086cb-a907-4d89-8e21-3504c283f0c6.png',	'2022-05-08 18:17:50.930563',	'2022-05-08 18:17:50.930563',	NULL),
(3,	'KEYBOARD',	'/public/images/categories/574c3faf-a00b-4ae7-bdb7-7e2b2c7c6ff6.png',	'2022-05-08 18:17:50.930563',	'2022-05-08 18:17:50.930563',	NULL),
(4,	'HEADPHONE',	'/public/images/categories/category-img-4.jpg',	'2022-05-08 18:17:50.930563',	'2022-05-08 18:17:50.930563',	NULL),
(5,	'CAMERA',	'/public/images/categories/category-img-5.jpg',	'2022-05-08 18:17:50.930563',	'2022-05-08 18:17:50.930563',	NULL),
(6,	'PHONE',	'/public/images/categories/category-img-6.jpg',	'2022-05-08 18:17:50.930563',	'2022-05-08 18:17:50.930563',	'2022-05-25 07:13:09.000000')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `title` = VALUES(`title`), `image` = VALUES(`image`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details` (
  `order_id` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `product_id` int NOT NULL,
  `price` int NOT NULL,
  `quantity` int NOT NULL,
  `total` int DEFAULT NULL,
  PRIMARY KEY (`order_id`,`product_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

INSERT INTO `order_details` (`order_id`, `product_id`, `price`, `quantity`, `total`) VALUES
('04AE1590B1',	10,	3876,	1,	3876),
('15CAE523B3',	8,	5508,	1,	5508),
('15CAE523B3',	16,	498,	1,	498),
('15CAE523B3',	17,	737,	6,	4422),
('15CAE523B3',	22,	600,	1,	600),
('15CAE523B3',	23,	1779,	1,	1779),
('15CAE523B3',	30,	1797,	1,	1797),
('1856CA49BD',	18,	160,	1,	160),
('1856CA49BD',	19,	181,	1,	181),
('1856CA49BD',	22,	1599,	1,	1599),
('1F81971EB7',	10,	3876,	15,	58140),
('1F81971EB7',	12,	3112,	5,	15560),
('1F81971EB7',	13,	4381,	5,	21905),
('1F81971EB7',	30,	4792,	15,	71880),
('2AD81D08EE',	7,	46,	1,	46),
('2AD81D08EE',	18,	160,	1,	160),
('2AD81D08EE',	19,	181,	1,	181),
('2AD81D08EE',	20,	49,	1,	49),
('2AD81D08EE',	22,	1599,	1,	1599),
('2AD81D08EE',	30,	4792,	1,	4792),
('384F47EDF2',	19,	181,	10,	1810),
('384F47EDF2',	20,	49,	2,	98),
('384F47EDF2',	22,	1599,	4,	6396),
('384F47EDF2',	30,	4792,	1,	4792),
('3CC630639F',	1,	150,	2,	300),
('3CC630639F',	5,	142,	5,	710),
('3CC630639F',	21,	74,	3,	222),
('3CC630639F',	27,	441,	8,	3528),
('42C1297584',	7,	46,	1,	46),
('42C1297584',	22,	1599,	1,	1599),
('42C1297584',	30,	4792,	1,	4792),
('65880ECF48',	8,	5508,	1,	5508),
('65880ECF48',	16,	498,	1,	498),
('65880ECF48',	17,	737,	1,	737),
('685875C238',	8,	3672,	3,	11016),
('685875C238',	20,	172,	4,	686),
('685875C238',	21,	74,	6,	441),
('6867657F17',	19,	181,	9,	1629),
('6867657F17',	20,	49,	3,	147),
('773A738A79',	30,	4792,	75,	359400),
('849E068628',	22,	1599,	1,	1599),
('849E068628',	30,	4792,	1,	4792),
('993835174D',	7,	46,	1,	46),
('993835174D',	22,	1599,	1,	1599),
('A2B2834230',	7,	92,	1,	92),
('A2B2834230',	20,	172,	1,	172),
('A2B2834230',	21,	74,	1,	74),
('AE0123FB81',	21,	74,	6,	444),
('BBFEDE011D',	4,	184,	5,	920),
('BBFEDE011D',	10,	3876,	4,	15504),
('BBFEDE011D',	12,	3112,	2,	6224),
('BBFEDE011D',	30,	4792,	3,	14376),
('BF7A79C2AF',	18,	160,	5,	800),
('BF7A79C2AF',	19,	181,	2,	362),
('BF7A79C2AF',	20,	49,	4,	196),
('C49F30B977',	20,	172,	1,	172),
('C49F30B977',	21,	74,	1,	74),
('C49F30B977',	22,	600,	8,	4800),
('CA41FFCE33',	18,	160,	4,	638),
('CA41FFCE33',	19,	181,	5,	905),
('CA41FFCE33',	30,	4792,	11,	52712),
('D8C6DA1BDA',	7,	46,	1,	46),
('D8C6DA1BDA',	22,	1599,	1,	1599),
('D8C6DA1BDA',	30,	4792,	1,	4792),
('E6A75E7907',	20,	49,	1,	49),
('E6A75E7907',	22,	1599,	1,	1599),
('F72ECEB9BA',	7,	46,	1,	46),
('F72ECEB9BA',	22,	1599,	1,	1599),
('F72ECEB9BA',	30,	4792,	1,	4792),
('FF3C083785',	4,	184,	2,	368),
('FF3C083785',	10,	3876,	1,	3876),
('FF3C083785',	13,	4381,	5,	21905),
('FF3C083785',	30,	4792,	8,	38336),
('FFDC6F02C0',	18,	160,	1,	160),
('FFDC6F02C0',	19,	181,	1,	181),
('FFDC6F02C0',	30,	4792,	1,	4792)
ON DUPLICATE KEY UPDATE `order_id` = VALUES(`order_id`), `product_id` = VALUES(`product_id`), `price` = VALUES(`price`), `quantity` = VALUES(`quantity`), `total` = VALUES(`total`);

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `user_id` int NOT NULL,
  `store_id` int NOT NULL,
  `total` int NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

INSERT INTO `orders` (`id`, `user_id`, `store_id`, `total`, `status`, `created_at`, `updated_at`) VALUES
('04AE1590B1',	25,	1,	3876,	1,	'2022-05-25 01:36:28',	'2022-05-25 01:36:28'),
('15CAE523B3',	25,	3,	14604,	1,	'2022-05-23 21:45:14',	'2022-05-23 21:45:14'),
('1856CA49BD',	25,	1,	1940,	2,	'2022-05-24 22:32:41',	'2022-05-24 22:32:41'),
('1F81971EB7',	25,	1,	167485,	2,	'2022-05-25 01:35:54',	'2022-05-25 01:35:54'),
('2AD81D08EE',	25,	1,	6827,	2,	'2022-05-22 22:40:13',	'2022-05-22 22:40:13'),
('384F47EDF2',	25,	1,	13096,	2,	'2022-05-24 22:16:52',	'2022-05-24 22:16:52'),
('3CC630639F',	25,	2,	4460,	2,	'2022-05-24 22:16:53',	'2022-05-24 22:16:53'),
('42C1297584',	25,	1,	6437,	1,	'2022-05-23 09:18:11',	'2022-05-23 09:18:11'),
('65880ECF48',	25,	3,	6743,	1,	'2022-05-24 22:33:20',	'2022-05-24 22:33:20'),
('685875C238',	25,	2,	12148,	2,	'2022-05-24 22:45:22',	'2022-05-24 22:45:22'),
('6867657F17',	25,	1,	1776,	2,	'2022-05-22 22:38:30',	'2022-05-22 22:38:30'),
('773A738A79',	25,	1,	359400,	1,	'2022-05-24 02:57:31',	'2022-05-24 02:57:31'),
('849E068628',	25,	1,	6391,	1,	'2022-05-24 22:29:58',	'2022-05-24 22:29:58'),
('993835174D',	25,	1,	1645,	1,	'2022-05-23 07:31:15',	'2022-05-23 07:31:15'),
('A2B2834230',	25,	2,	338,	2,	'2022-05-23 09:18:12',	'2022-05-23 09:18:12'),
('AE0123FB81',	25,	2,	444,	1,	'2022-05-24 22:57:09',	'2022-05-24 22:57:09'),
('BBFEDE011D',	25,	1,	37024,	1,	'2022-05-25 02:16:35',	'2022-05-25 02:16:35'),
('BF7A79C2AF',	25,	1,	1358,	1,	'2022-05-24 22:25:09',	'2022-05-24 22:25:09'),
('C49F30B977',	25,	2,	5046,	1,	'2022-05-22 22:41:03',	'2022-05-22 22:41:03'),
('CA41FFCE33',	25,	1,	54257,	1,	'2022-05-24 22:35:20',	'2022-05-24 22:35:20'),
('D8C6DA1BDA',	25,	1,	6437,	2,	'2022-05-24 22:22:30',	'2022-05-24 22:22:30'),
('E6A75E7907',	25,	1,	1648,	2,	'2022-05-22 22:41:02',	'2022-05-22 22:41:02'),
('F72ECEB9BA',	25,	1,	6437,	2,	'2022-05-23 10:08:28',	'2022-05-23 10:08:28'),
('FF3C083785',	25,	1,	64485,	2,	'2022-05-25 02:59:47',	'2022-05-25 02:59:47'),
('FFDC6F02C0',	25,	1,	5133,	1,	'2022-05-24 22:34:28',	'2022-05-24 22:34:28')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `user_id` = VALUES(`user_id`), `store_id` = VALUES(`store_id`), `total` = VALUES(`total`), `status` = VALUES(`status`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`);

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `price` int NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci,
  `category_id` int DEFAULT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `updated_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `deleted_at` timestamp(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `FK_P_C` (`category_id`),
  CONSTRAINT `FK_P_C` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

INSERT INTO `product` (`id`, `name`, `price`, `description`, `image`, `category_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'MASTER HEADPsadsadHONE',	189,	'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti minus tenetur facere voluptates, minima necessitatibus quod et praesentium dolores velit. Voluptas voluptatum repellendus mollitia.',	'[\"/public/images/products/4c572f24-899a-404a-9556-44072248fa21.png\"]',	5,	'2022-05-08 18:46:59.456545',	'2022-05-08 18:46:59.456545',	'2022-05-25 03:23:03.000000'),
(2,	'SUPER SINGLE CAMERA',	1542322223,	'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti minus tenetur facere voluptates, minima necessitatibus quod et praesentium dolores velit. Voluptas voluptatum repellendus mollitia.',	'[\"/public/images/products/95fbd421-0ad6-4ba4-9f07-64f118c61bff.png\",\"/public/images/products/6ef86b3a-945c-47af-b5cd-038da904cf5c.png\",\"/public/images/products/47ba3918-d50b-4495-bda3-4ed48361d8b5.png\"]',	1,	'2022-05-08 18:46:59.456545',	'2022-05-08 18:46:59.456545',	NULL),
(3,	'GOOGLE HOME',	213,	'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti minus tenetur facere voluptates, minima necessitatibus quod et praesentium dolores velit. Voluptas voluptatum repellendus mollitia.',	'[\"/public/images/products/product-3-img-1.jpg\",\"/public/images/products/product-3-img-2.jpg\",\"/public/images/products/product-3-img-3.jpg\",\"/public/images/products/product-3-img-4.jpg\"]',	NULL,	'2022-05-08 18:46:59.456545',	'2022-05-08 18:46:59.456545',	NULL),
(4,	'IPHONE 11',	612,	'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti minus tenetur facere voluptates, minima necessitatibus quod et praesentium dolores velit. Voluptas voluptatum repellendus mollitia.',	'[\"/public/images/products/product-4-img-1.jpg\",\"/public/images/products/product-4-img-2.jpg\",\"/public/images/products/product-4-img-3.jpg\"]',	NULL,	'2022-05-08 18:46:59.456545',	'2022-05-08 18:46:59.456545',	NULL),
(5,	'POLAROID CAMERA',	178,	'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti minus tenetur facere voluptates, minima necessitatibus quod et praesentium dolores velit. Voluptas voluptatum repellendus mollitia.',	'[\"/public/images/products/product-5-img-1.jpg\",\"/public/images/products/product-5-img-3.jpg\",\"/public/images/products/product-5-img-2.jpg\",\"/public/images/products/product-5-img-4.jpg\"]',	5,	'2022-05-08 18:46:59.456545',	'2022-05-08 18:46:59.456545',	NULL),
(6,	'BLUETOOTH PINK',	112,	'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti minus tenetur facere voluptates, minima necessitatibus quod et praesentium dolores velit. Voluptas voluptatum repellendus mollitia.',	'[\"/public/images/products/product-6-img-1.jpg\",\"/public/images/products/product-6-img-2.jpg\",\"/public/images/products/product-6-img-3.jpg\"]',	4,	'2022-05-08 18:46:59.456545',	'2022-05-08 18:46:59.456545',	NULL),
(7,	'KEYBORD AKO',	230,	'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti minus tenetur facere voluptates, minima necessitatibus quod et praesentium dolores velit. Voluptas voluptatum repellendus mollitia.',	'[\"/public/images/products/product-7-img-1.jpg\",\"/public/images/products/product-7-img-2.jpg\",\"/public/images/products/product-7-img-3.jpg\",\"/public/images/products/product-7-img-4.jpg\"]',	3,	'2022-05-08 18:46:59.456545',	'2022-05-08 18:46:59.456545',	NULL),
(8,	'ACER NITRO 5',	6120,	'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti minus tenetur facere voluptates, minima necessitatibus quod et praesentium dolores velit. Voluptas voluptatum repellendus mollitia.',	'[\"/public/images/products/product-8-img-1.jpg\",\"/public/images/products/product-8-img-2.jpg\",\"/public/images/products/product-8-img-3.jpg\",\"/public/images/products/product-8-img-4.jpg\"]',	1,	'2022-05-08 18:46:59.456545',	'2022-05-08 18:46:59.456545',	NULL),
(9,	'Sony Alpha ILCE-7CL',	1941,	'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti minus tenetur facere voluptates, minima necessitatibus quod et praesentium dolores velit. Voluptas voluptatum repellendus mollitia.',	'[\"/public/images/products/product-9-img-1.jpg\",\"/public/images/products/product-9-img-2.jpg\",\"/public/images/products/product-9-img-3.jpg\"]',	5,	'2022-05-08 18:46:59.456545',	'2022-05-08 18:46:59.456545',	NULL),
(10,	'Galaxy Z Flip 3',	4845,	'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti minus tenetur facere voluptates, minima necessitatibus quod et praesentium dolores velit. Voluptas voluptatum repellendus mollitia.',	'[\"/public/images/products/product-10-img-1.jpg\",\"/public/images/products/product-10-img-2.jpg\",\"/public/images/products/product-10-img-3.jpg\",\"/public/images/products/product-10-img-4.jpg\"]',	NULL,	'2022-05-08 18:46:59.456545',	'2022-05-08 18:46:59.456545',	NULL),
(11,	'OPPO Reno6 Pro',	3678,	'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti minus tenetur facere voluptates, minima necessitatibus quod et praesentium dolores velit. Voluptas voluptatum repellendus mollitia.',	'[\"/public/images/products/product-11-img-1.jpg\",\"/public/images/products/product-11-img-2.jpg\"]',	NULL,	'2022-05-08 18:46:59.456545',	'2022-05-08 18:46:59.456545',	NULL),
(12,	'IPHONE 13',	3458,	'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti minus tenetur facere voluptates, minima necessitatibus quod et praesentium dolores velit. Voluptas voluptatum repellendus mollitia.',	'[\"/public/images/products/product-12-img-1.jpg\",\"/public/images/products/product-12-img-2.jpg\",\"/public/images/products/product-12-img-3.jpg\",\"/public/images/products/product-12-img-4.jpg\"]',	NULL,	'2022-05-08 18:46:59.456545',	'2022-05-08 18:46:59.456545',	NULL),
(13,	'Galaxy Z Fold 3',	4868,	'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti minus tenetur facere voluptates, minima necessitatibus quod et praesentium dolores velit. Voluptas voluptatum repellendus mollitia.',	'[\"/public/images/products/product-13-img-1.jpg\",\"/public/images/products/product-13-img-2.jpg\"]',	NULL,	'2022-05-08 18:46:59.456545',	'2022-05-08 18:46:59.456545',	NULL),
(14,	'Fujifilm Instax Mini 11',	536,	'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti minus tenetur facere voluptates, minima necessitatibus quod et praesentium dolores velit. Voluptas voluptatum repellendus mollitia.',	'[\"/public/images/products/product-14-img-1.jpg\",\"/public/images/products/product-14-img-2.jpg\",\"/public/images/products/product-14-img-3.jpg\"]',	5,	'2022-05-08 18:46:59.456545',	'2022-05-08 18:46:59.456545',	NULL),
(15,	'GOOGLE HOME1',	245,	'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti minus tenetur facere voluptates, minima necessitatibus quod et praesentium dolores velit. Voluptas voluptatum repellendus mollitia.',	'[\"/public/images/products/product.jpg\",\"/public/images/products/product.jpg\",\"/public/images/products/product.jpg\",\"/public/images/products/product.jpg\"]',	NULL,	'2022-05-08 18:46:59.456545',	'2022-05-08 18:46:59.456545',	NULL),
(16,	'MSI Gaming GF65',	2490,	'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti minus tenetur facere voluptates, minima necessitatibus quod et praesentium dolores velit. Voluptas voluptatum repellendus mollitia.',	'[\"/public/images/products/product-16-img-1.jpg\",\"/public/images/products/product-16-img-2.jpg\",\"/public/images/products/product-16-img-3.jpg\"]',	1,	'2022-05-08 18:46:59.456545',	'2022-05-08 18:46:59.456545',	NULL),
(17,	'Lenovo Ideapad 5 Pro',	3687,	'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti minus tenetur facere voluptates, minima necessitatibus quod et praesentium dolores velit. Voluptas voluptatum repellendus mollitia.',	'[\"/public/images/products/product-17-img-1.jpg\",\"/public/images/products/product-17-img-2.jpg\"]',	1,	'2022-05-08 18:46:59.456545',	'2022-05-08 18:46:59.456545',	NULL),
(18,	'Asus ROG Strix Scope TKL Electro Punk',	399,	'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti minus tenetur facere voluptates, minima necessitatibus quod et praesentium dolores velit. Voluptas voluptatum repellendus mollitia.',	'[\"/public/images/products/product-18-img-1.jpg\",\"/public/images/products/product-18-img-2.jpg\",\"/public/images/products/product-18-img-3.jpg\"]',	3,	'2022-05-08 18:46:59.456545',	'2022-05-08 18:46:59.456545',	NULL),
(19,	'Cooler Master CK530 V2',	201,	'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti minus tenetur facere voluptates, minima necessitatibus quod et praesentium dolores velit. Voluptas voluptatum repellendus mollitia.',	'[\"/public/images/products/product-19-img-1.jpg\",\"/public/images/products/product-19-img-2.jpg\",\"/public/images/products/product-19-img-3.jpg\"]',	3,	'2022-05-08 18:46:59.456545',	'2022-05-08 18:46:59.456545',	NULL),
(20,	'Razer BlackWidow V3 HALO Infinite Green',	245,	'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti minus tenetur facere voluptates, minima necessitatibus quod et praesentium dolores velit. Voluptas voluptatum repellendus mollitia.',	'[\"/public/images/products/product-20-img-1.jpg\",\"/public/images/products/product-20-img-2.jpg\",\"/public/images/products/product-20-img-3.jpg\"]',	3,	'2022-05-08 18:46:59.456545',	'2022-05-08 18:46:59.456545',	NULL),
(21,	'Leopold FC660MPD Blue Star',	245,	'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti minus tenetur facere voluptates, minima necessitatibus quod et praesentium dolores velit. Voluptas voluptatum repellendus mollitia.',	'[\"/public/images/products/product-21-img-1.jpg\",\"/public/images/products/product-21-img-2.jpg\",\"/public/images/products/product-21-img-3.jpg\"]',	3,	'2022-05-08 18:46:59.456545',	'2022-05-08 18:46:59.456545',	NULL),
(22,	'Apple Watch s6',	1999,	'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti minus tenetur facere voluptates, minima necessitatibus quod et praesentium dolores velit. Voluptas voluptatum repellendus mollitia.',	'[\"/public/images/products/product-22-img-1.jpg\",\"/public/images/products/product-22-img-2.jpg\",\"/public/images/products/product-22-img-3.jpg\",\"/public/images/products/product-22-img-4.jpg\"]',	2,	'2022-05-08 18:46:59.456545',	'2022-05-08 18:46:59.456545',	NULL),
(23,	'Oppo Watch 41mm',	2541,	'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti minus tenetur facere voluptates, minima necessitatibus quod et praesentium dolores velit. Voluptas voluptatum repellendus mollitia.',	'[\"/public/images/products/product-23-img-1.jpg\",\"/public/images/products/product-23-img-2.jpg\",\"/public/images/products/product-23-img-3.jpg\"]',	2,	'2022-05-08 18:46:59.456545',	'2022-05-08 18:46:59.456545',	NULL),
(24,	'Galaxy Watch 4 Ite',	2315,	'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti minus tenetur facere voluptates, minima necessitatibus quod et praesentium dolores velit. Voluptas voluptatum repellendus mollitia.',	'[\"/public/images/products/product-24-img-1.jpg\",\"/public/images/products/product-24-img-2.jpg\",\"/public/images/products/product-24-img-3.jpg\",\"/public/images/products/product-24-img-4.jpg\"]',	2,	'2022-05-08 18:46:59.456545',	'2022-05-08 18:46:59.456545',	NULL),
(25,	'Garmin Forerunner 45',	1490,	'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti minus tenetur facere voluptates, minima necessitatibus quod et praesentium dolores velit. Voluptas voluptatum repellendus mollitia.',	'[\"/public/images/products/product-25-img-1.jpg\",\"/public/images/products/product-25-img-2.jpg\",\"/public/images/products/product-25-img-3.jpg\",\"/public/images/products/product-25-img-4.jpg\",\"/public/images/products/product-25-img-5.jpg\"]',	2,	'2022-05-08 18:46:59.456545',	'2022-05-08 18:46:59.456545',	NULL),
(26,	'Corsair HS50 PRO',	568,	'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti minus tenetur facere voluptates, minima necessitatibus quod et praesentium dolores velit. Voluptas voluptatum repellendus mollitia.',	'[\"/public/images/products/product-26-img-1.jpg\",\"/public/images/products/product-26-img-2.jpg\",\"/public/images/products/product-26-img-3.jpg\"]',	4,	'2022-05-08 18:46:59.456545',	'2022-05-08 18:46:59.456545',	NULL),
(27,	'Asus ROG THETA 7.1',	490,	'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti minus tenetur facere voluptates, minima necessitatibus quod et praesentium dolores velit. Voluptas voluptatum repellendus mollitia.',	'[\"/public/images/products/product-27-img-1.jpg\",\"/public/images/products/product-27-img-2.jpg\",\"/public/images/products/product-27-img-3.jpg\"]',	4,	'2022-05-08 18:46:59.456545',	'2022-05-08 18:46:59.456545',	NULL),
(28,	'SteelSeries Arctis Pro 61486',	785,	'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti minus tenetur facere voluptates, minima necessitatibus quod et praesentium dolores velit. Voluptas voluptatum repellendus mollitia.',	'[\"/public/images/products/product-28-img-1.jpg\",\"/public/images/products/product-28-img-2.jpg\"]',	4,	'2022-05-08 18:46:59.456545',	'2022-05-08 18:46:59.456545',	NULL),
(29,	'Kingston HyperX Cloud Alpha Gold - Limited Editio',	72323,	'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti minus tenetur facere voluptates, minima necessitatibus quod et praesentium dolores velit. Voluptas voluptatum repellendus mollitia.',	'[\"/public/images/products/product-29-img-1.jpg\",\"/public/images/products/product-29-img-2.jpg\",\"/public/images/products/product-29-img-3.jpg\",\"/public/images/products/0f1ec9cb-74dc-4bfe-8e49-8a891505f9e1.jpg\",\"/public/images/products/8b4bb5e6-3799-4c53-8ca4-0b65929d505e.png\",\"/public/images/products/20ccff3c-e21d-4b0c-b2b2-7065cd0a1cd5.png\"]',	NULL,	'2022-05-08 18:46:59.456545',	'2022-05-08 18:46:59.456545',	NULL),
(30,	'ROG Zephyrus G14',	5990,	'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti minus tenetur facere voluptates, minima necessitatibus quod et praesentium dolores velit. Voluptas voluptatum repellendus mollitia.',	'[\"/public/images/products/product-15-img-1.jpg\",\"/public/images/products/product-15-img-2.jpg\",\"/public/images/products/product-15-img-3.jpg\"]',	1,	'2022-05-08 18:46:59.456545',	'2022-05-08 18:46:59.456545',	'2022-05-25 04:41:32.000000')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `name` = VALUES(`name`), `price` = VALUES(`price`), `description` = VALUES(`description`), `image` = VALUES(`image`), `category_id` = VALUES(`category_id`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

DROP TABLE IF EXISTS `product_details`;
CREATE TABLE `product_details` (
  `product_id` int NOT NULL,
  `quantity` int DEFAULT NULL,
  `discount` int DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  CONSTRAINT `fk_pd_p` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

INSERT INTO `product_details` (`product_id`, `quantity`, `discount`) VALUES
(1,	395,	70),
(2,	50,	2),
(3,	344,	60),
(4,	82,	70),
(5,	34,	20),
(6,	415,	20),
(7,	27,	80),
(8,	111,	40),
(9,	37,	40),
(10,	317,	20),
(11,	398,	50),
(12,	496,	70),
(13,	77,	50),
(14,	216,	60),
(15,	474,	80),
(16,	476,	80),
(17,	180,	20),
(18,	262,	60),
(19,	176,	10),
(20,	411,	80),
(21,	426,	80),
(22,	306,	20),
(23,	304,	30),
(24,	211,	10),
(25,	488,	10),
(26,	293,	10),
(27,	384,	70),
(28,	419,	30),
(29,	438,	50),
(30,	259,	20)
ON DUPLICATE KEY UPDATE `product_id` = VALUES(`product_id`), `quantity` = VALUES(`quantity`), `discount` = VALUES(`discount`);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `fullName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `phoneNumber` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `isActivePhone` tinyint(1) NOT NULL DEFAULT '0',
  `address` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `isVerified` tinyint(1) NOT NULL DEFAULT '0',
  `tokenVerify` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `refreshToken` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci DEFAULT NULL,
  `permission` int NOT NULL DEFAULT '-1',
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL DEFAULT 'local',
  `createdAt` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `updatedAt` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`id`),
  UNIQUE KEY `EMAIL_UNIQUE` (`email`),
  UNIQUE KEY `USERNAME_UNIQUE` (`username`),
  UNIQUE KEY `REFRESH_TOKEN_UNIQUE` (`refreshToken`),
  UNIQUE KEY `TOKEN_VERIFY_UNIQUE` (`tokenVerify`),
  UNIQUE KEY `PHONE_UNIQUE` (`phoneNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

INSERT INTO `user` (`id`, `username`, `password`, `email`, `fullName`, `phoneNumber`, `isActivePhone`, `address`, `isVerified`, `tokenVerify`, `refreshToken`, `permission`, `type`, `createdAt`, `updatedAt`) VALUES
(25,	'admin',	'$2y$10$qAwb/vul7pgbZ0hXTA1NA.7muSsdoolxTB89eS5TOC3BWnHeSf/Ca',	'kidph@gmail.com',	'Nguyen Phuc Thinh',	'896359374',	0,	'kec',	1,	'934fe853-605f-487e-b105-bfeb5ac3b3e6',	'bda12e3d71e9afb7cea0531dfc32699aae184084aae09e651b8d40d48cea8ad3.&$@1671154823.&$@25.&$@$2y$10$nNBn9n0DrDf9AIcHFWY1kOvuWdyts56yjrJo9fEVoCHhAspmku9JG',	2,	'local',	'2022-05-20 12:01:34.903843',	'2022-05-20 12:01:34.903843'),
(29,	'thjnhsoajca',	'$2y$10$aP9ygm/lAiJOkrxf7DdUBOzn3RZCU/aqzrcBYreNRDzbPd8x72kOW',	'thjnhsoajca@gmail.com',	'Nguyen Phuc Thinh',	NULL,	0,	NULL,	1,	'b6d28636-eef8-4e82-9991-4560a3a4fd67',	'fc6d05ebad92f31449d0b0c529d452d634a9df15518ff75537d4f674f76635ee.&$@1655875442.&$@29.&$@$2y$10$OLK4HKEcFMjV5/X4g2OsR.iKi5HrWm6uEyIjdZyoao2HwfxKOt.yK',	0,	'local',	'2022-05-20 22:22:09.131326',	'2022-05-20 22:22:09.131326'),
(55,	'1346573135844289',	'$2y$10$NhwAk15L15mXXEPz2DqDqOVLPYW.0NgOVEteqrudOwyNXks0MwFmu',	'kidp2h@outlook.com',	'Nguyễn Phúc Thịnh',	NULL,	0,	NULL,	1,	'b6d28636-eef8-4e82-9991-4560a3a4ef67',	'9f046fdbffe49ef5537cc6be12559f729ead36401a469f9b7ca16b94788b5af6.&$@1656155654.&$@55.&$@$2y$10$p8vN6FSyDutvEIVflGOQXeFjRCbnIMI0qhS9HKrapoes0Cd35qx0C',	0,	'facebook',	'2022-05-21 23:03:17.533334',	'2022-05-21 23:03:17.533334'),
(56,	'100864461323288714004',	'$2y$10$l5PAQTw0WTAaaKtl9P3z1egLVpJ4FzI95vBpyhXMiZ2CnZ5bc8fo2',	'0x4b68@gmail.com',	'Thinh Nguyen',	NULL,	0,	NULL,	1,	'b6d28636-eef8-4e82-9991-4340a3a4fd42',	'77f1743137f5b1c3f640e9c9d7a7d78d5c092ef356f2fa18ae4d0053418c96e9.&$@1656067509.&$@56.&$@$2y$10$dE8BgbT0H4oRaRhBJjQhgeVpLxz.HvN/j0FJSBSvy28uDQ4ZdJgV6',	0,	'google',	'2022-05-21 23:03:31.742260',	'2022-05-21 23:03:31.742260'),
(59,	'user1',	'$2y$10$8o3C2ii7QH.zJpVRY2RfxeNyoZFUPKY8Tjdr82O/mwgVUrBoScZq2',	'kidp2adfdfh@gmail.com',	'Nguyen Phuc Thinh',	NULL,	0,	NULL,	0,	'77c99182-c2c8-478c-b3c3-04b200b537a2',	NULL,	0,	'local',	'2022-05-23 10:40:15.652200',	'2022-05-23 10:40:15.652200'),
(60,	'user123',	'$2y$10$G7kH7rTKjFhu53zHiMuc.u/Mc/gVqw8e3uaxVvnV3XNa08luaxCYO',	'phuthinh5322@gmail.com',	'Chau Phu Thinh',	NULL,	0,	NULL,	1,	'7fb143ba-7f13-4c63-b3a0-d6f9394f694b',	'2f50e360262520522a4960c9e6ddb6f49dc0ee0dbe48cfc074e29d50b0ad0183.&$@1656006558.&$@60.&$@$2y$10$qXJl6Oe1XWaBrkt5wHagQOu.ZHau39wemjFyqgZnuTqFICJEJj94a',	0,	'local',	'2022-05-23 10:42:07.931684',	'2022-05-23 10:42:07.931684'),
(63,	'usertest',	'$2a$12$Wuv.KY8PhystsQY5Ia3Ca.Yug.FOi91OpkNY0WwLWyt3UxMzuFXgK',	'Email address',	'keckec',	'045848954',	1,	'kec',	1,	'feb93702-c056-445d-b658-8bfbe0fa5e9a',	'374f2a4ac66d2a788a0f53a0bd7ad5a1e306af3aa30135281727431aede592f1.&$@1656152775.&$@63.&$@$2y$10$zvDLtcBx2fFQGcNWZEx1I.jxeXZNtvoGHTEZsRKYWP36r9B0N1eam',	-1,	'local',	'2022-05-25 01:57:47.198137',	'2022-05-25 01:57:47.198137'),
(65,	'thjs',	'$2y$10$G4gTIsxqxWaDOJH9tgWGh.n8vTlZzKaxm2Qp4kw8roigQ18xkPjye',	'34453',	'thjs',	'0893462',	1,	'3434',	1,	'0020f66d-bfd8-4a22-8cf8-f972cf3c733c',	NULL,	3,	'local',	'2022-05-25 02:01:40.716514',	'2022-05-25 02:01:40.716514'),
(66,	'kidp2h',	'$2y$10$FubP2GWo4iTL.cmDtj4jjOAD1c5i6MzrpzsfgLwjsONgMz0Aw5gHS',	'kidp2h@gmail.com',	'Nguyen Phuc Thinh',	NULL,	0,	NULL,	1,	'5c9d7079-b9eb-491d-b36f-309b46fb4a1b',	'da9c8dee540bc857589b1b74dc0a6f8ad67e29cff63b262e4b5d2dd62e9805fe.&$@1656155635.&$@66.&$@$2y$10$KCMNa4mIyjWzBAIh16uphePo8mtxnBBBX4LsTfIiOxYt1H/yTZY/6',	1,	'local',	'2022-05-25 04:03:22.276437',	'2022-05-25 04:03:22.276437'),
(69,	'kingeagles2604',	'$2y$10$/PBrR/6miY3ORQPRW6ICBuZ20HczWj41vgwSwVbZlmQSZcAvLyFDy',	'kidp2hsdsdasd@gmail.com',	'Nguyen Phuc Thinh',	NULL,	0,	NULL,	0,	'10b19675-29ac-4cb2-bbfe-658289789dc0',	NULL,	-1,	'local',	'2022-11-14 11:01:17.187899',	'2022-11-14 11:01:17.187899')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `username` = VALUES(`username`), `password` = VALUES(`password`), `email` = VALUES(`email`), `fullName` = VALUES(`fullName`), `phoneNumber` = VALUES(`phoneNumber`), `isActivePhone` = VALUES(`isActivePhone`), `address` = VALUES(`address`), `isVerified` = VALUES(`isVerified`), `tokenVerify` = VALUES(`tokenVerify`), `refreshToken` = VALUES(`refreshToken`), `permission` = VALUES(`permission`), `type` = VALUES(`type`), `createdAt` = VALUES(`createdAt`), `updatedAt` = VALUES(`updatedAt`);

-- 2022-11-15 02:28:08

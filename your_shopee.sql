/*
 Navicat Premium Data Transfer

 Source Server         : Local
 Source Server Type    : MySQL
 Source Server Version : 100414
 Source Host           : localhost:3306
 Source Schema         : your_shopee

 Target Server Type    : MySQL
 Target Server Version : 100414
 File Encoding         : 65001

 Date: 25/01/2022 08:46:27
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for api_response_orders
-- ----------------------------
DROP TABLE IF EXISTS `api_response_orders`;
CREATE TABLE `api_response_orders`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `request_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `process_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `api_response_orders_order_id_index`(`order_id`) USING BTREE,
  CONSTRAINT `api_response_orders_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of api_response_orders
-- ----------------------------
INSERT INTO `api_response_orders` VALUES (1, 2, '46840', 'https://checkout-co.placetopay.dev/session/46840/aa96b0334e0a31c0e3a1a48c4029e4c6', 'REJECTED', '2021-11-29 05:00:06', '2021-11-29 05:00:06');
INSERT INTO `api_response_orders` VALUES (2, 2, '46841', 'https://checkout-co.placetopay.dev/session/46841/247662c29ec205740cd09dc9b222c4bb', 'REJECTED', '2021-11-29 05:40:14', '2021-11-29 05:49:59');
INSERT INTO `api_response_orders` VALUES (3, 2, '46842', 'https://checkout-co.placetopay.dev/session/46842/a4cf07ce2e2a71badefc96a0f86ba645', 'REJECTED', '2021-11-29 05:50:12', '2021-11-29 05:51:22');
INSERT INTO `api_response_orders` VALUES (4, 2, '46843', 'https://checkout-co.placetopay.dev/session/46843/999eb0e4770b98edd5007580f33cafd0', 'REJECTED', '2021-11-29 05:52:25', '2021-11-29 05:56:45');
INSERT INTO `api_response_orders` VALUES (5, 2, '46844', 'https://checkout-co.placetopay.dev/session/46844/daff391045ccd2f07b47d7931aa84801', 'PENDING', '2021-11-29 05:58:39', '2021-11-29 05:58:39');
INSERT INTO `api_response_orders` VALUES (6, 3, '46882', 'https://checkout-co.placetopay.dev/session/46882/916b7ce9bc781099dbad4a57050e115c', 'REJECTED', '2021-12-01 01:04:02', '2021-12-01 01:05:00');

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  UNIQUE INDEX `cache_key_unique`(`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache
-- ----------------------------

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (1, 'Computadores de Escritorio', 'Equipos para oficina, uso personal, para jugar, multimedia personal y uso general de computadoras en el hogar.', NULL, '2021-11-24 21:13:04', '2021-11-24 21:13:04');
INSERT INTO `categories` VALUES (2, 'Laptops', 'Computadoras portátiles o (PC) pequeñas con pantallas integradas y un teclados alfanuméricos. Las computadoras portátiles se utilizan en una variedad de entornos, como en el trabajo, en la educación, para jugar, navegar por la web, para multimedia personal y uso general de computadoras en el hogar.', NULL, '2021-11-24 21:13:04', '2021-11-24 21:13:04');
INSERT INTO `categories` VALUES (3, 'Accesorios', 'Elementos que forman parte de tu equipo o sistema personal o de trabajo, manipulables con una conexiones electrónicas, USB, etc...', NULL, '2021-11-24 21:13:04', '2021-11-24 21:13:04');
INSERT INTO `categories` VALUES (4, 'Tablets', 'Dispositivos informáticos móviles que tiene una forma plana y rectangular como la de una revista o un bloc de papel, que generalmente se controla mediante una pantalla táctil y que se usa típicamente para acceder a Internet, ver vídeos, jugar juegos, leer libros electrónicos etc.', NULL, '2021-11-24 21:13:04', '2021-11-24 21:13:04');
INSERT INTO `categories` VALUES (5, 'Smartphone', 'Teléfonos móviles que realizan muchas de las funciones de una computadora, por lo general tiene una interfaz de pantalla táctil, acceso a Internet y un sistema operativo capaz de ejecutar aplicaciones descargadas.', NULL, '2021-11-24 21:13:04', '2021-11-24 21:13:04');
INSERT INTO `categories` VALUES (6, 'Barra de Sonidos', 'Altavoces que proyectan audio desde un recinto amplio. Es mucho más ancho que alto, en parte por razones acústicas y en parte para que pueda montarse encima o debajo de un dispositivo de visualización.', NULL, '2021-11-24 21:13:04', '2021-11-24 21:13:04');
INSERT INTO `categories` VALUES (7, 'Parlantes', 'Transductor electroacústicos o dispositivos que convierten una señal eléctrica de audio en ondas mecánicas de sonido.', NULL, '2021-11-24 21:13:04', '2021-11-24 21:13:04');
INSERT INTO `categories` VALUES (8, 'Consolas', 'consolas de videojuegos o videoconsola, dispositivos que ejecutan juegos electrónicos contenidos en discos compactos, cartuchos, tarjetas de memoria u otros formatos.', NULL, '2021-11-24 21:13:04', '2021-11-24 21:13:04');

-- ----------------------------
-- Table structure for category_product
-- ----------------------------
DROP TABLE IF EXISTS `category_product`;
CREATE TABLE `category_product`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `category_product_category_id_index`(`category_id`) USING BTREE,
  INDEX `category_product_product_id_index`(`product_id`) USING BTREE,
  CONSTRAINT `category_product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `category_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of category_product
-- ----------------------------
INSERT INTO `category_product` VALUES (1, 2, 2);
INSERT INTO `category_product` VALUES (2, 2, 1);
INSERT INTO `category_product` VALUES (3, 1, 3);
INSERT INTO `category_product` VALUES (4, 4, 4);
INSERT INTO `category_product` VALUES (5, 7, 5);
INSERT INTO `category_product` VALUES (6, 7, 6);
INSERT INTO `category_product` VALUES (7, 7, 7);
INSERT INTO `category_product` VALUES (8, 5, 8);
INSERT INTO `category_product` VALUES (9, 5, 9);
INSERT INTO `category_product` VALUES (10, 5, 10);

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (6, '2019_12_14_000001_create_personal_access_tokens_table', 2);
INSERT INTO `migrations` VALUES (7, '2021_11_23_221158_add_gender_to_users', 2);
INSERT INTO `migrations` VALUES (8, '2021_11_24_011023_add_field_to_users', 3);
INSERT INTO `migrations` VALUES (9, '2021_11_24_032818_add_role_to_users', 4);
INSERT INTO `migrations` VALUES (10, '2021_11_24_153034_add_deleted_to_users', 5);
INSERT INTO `migrations` VALUES (11, '2021_11_24_163512_create_categories_table', 6);
INSERT INTO `migrations` VALUES (12, '2021_11_24_225811_create_products_table', 7);
INSERT INTO `migrations` VALUES (14, '2021_11_24_231445_create_category_product_table', 8);
INSERT INTO `migrations` VALUES (15, '2021_11_26_155513_create_cache_table', 9);
INSERT INTO `migrations` VALUES (16, '2021_11_28_204717_create_orders_table', 10);
INSERT INTO `migrations` VALUES (17, '2021_11_28_210421_create_order_details_table', 10);
INSERT INTO `migrations` VALUES (20, '2021_11_29_035434_create_api_response_orders_table', 11);

-- ----------------------------
-- Table structure for order_details
-- ----------------------------
DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sku` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `price` decimal(10, 2) NOT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `order_details_order_id_index`(`order_id`) USING BTREE,
  CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_details
-- ----------------------------
INSERT INTO `order_details` VALUES (1, '81UV009YLM', 1, 2500000.00, 18, 1, NULL, '2021-11-29 00:29:17', '2021-11-29 00:29:17');
INSERT INTO `order_details` VALUES (2, 'JBL-PLU: 100420619', 1, 408500.00, 21, 1, NULL, '2021-11-29 00:29:17', '2021-11-29 00:29:17');
INSERT INTO `order_details` VALUES (3, '81UV009YLM', 1, 2500000.00, 18, 2, NULL, '2021-11-29 02:11:13', '2021-11-29 02:11:13');
INSERT INTO `order_details` VALUES (4, 'ASUS-PLU: 3057996', 1, 2378040.00, 24, 2, NULL, '2021-11-29 02:11:13', '2021-11-29 02:11:13');
INSERT INTO `order_details` VALUES (5, 'LENOVO-PLU: 3057718', 1, 1639180.00, 18, 3, NULL, '2021-12-01 01:03:41', '2021-12-01 01:03:41');
INSERT INTO `order_details` VALUES (6, 'JBL-PLU: 100420619', 1, 408500.00, 21, 3, NULL, '2021-12-01 01:03:41', '2021-12-01 01:03:41');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_mobile` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('CREATED','PAYED','REJECTED') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES (1, 'Jheyson Herrera', 'herrerajheyson@gmail.com', '3012515659', 'CREATED', NULL, '2021-11-29 00:29:17', '2021-11-29 00:29:17');
INSERT INTO `orders` VALUES (2, 'Sara Herrera', 'sara@gmail.com', '3456789023', 'CREATED', NULL, '2021-11-29 02:11:13', '2021-11-29 02:11:13');
INSERT INTO `orders` VALUES (3, 'Sara Herrera', 'herrerajheyson@gmail.com', '3456789023', 'CREATED', NULL, '2021-12-01 01:03:41', '2021-12-01 01:03:41');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sku` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10, 2) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT 0,
  `discount` int(11) NOT NULL DEFAULT 0,
  `reference` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, '81UV009YLM', 'Laptop Portátil LENOVO', 'LENOVO', 2500000.00, 20, 18, '81UV009YLM', '1637865823.jpg', 'Laptop Portátil LENOVO RYZEN_5_3500U_2.1G_4C_MB 14 Pulgadas 12 GB 512 GB SSD', NULL, '2021-11-25 00:19:56', '2021-11-25 18:43:42');
INSERT INTO `products` VALUES (2, 'ASUS-PLU: 3057996', 'Portátil ASUS Intel Core i5', 'ASUS', 2378040.00, 5, 24, 'X415JA-EB1079T', '1637868342.webp', 'Portátil ASUS Intel Core i5-1035G1 14 Pulgadas 8 GB 256 GB SSD X415JA-EB1079T', NULL, '2021-11-25 15:20:24', '2021-11-25 19:25:42');
INSERT INTO `products` VALUES (3, 'AMD-PLU: 101515406', 'Computador Pc De Escritorio Torre Gamer', 'AMD', 3894900.00, 15, 5, 'AMD-PLU: 101515406', '1637868677.jpg', 'Computador Pc De Escritorio Torre Gamer Amd Ryzen 5 3600Ssd 480Gb + Hdd 1Tb Ram 16Gb Led 22 Full Hd Nvidia 1030', NULL, '2021-11-25 19:31:17', '2021-11-25 19:31:17');
INSERT INTO `products` VALUES (4, 'LENOVO-PLU: 3057718', 'Tab P11', 'LENOVO', 1639180.00, 8, 18, 'LENOVO-PLU: 3057718', '1637868960.jpg', 'Tab P11 Wifi 6Gb + 128Gb LENOVO TB-J606F', NULL, '2021-11-25 19:36:00', '2021-11-25 19:36:00');
INSERT INTO `products` VALUES (5, 'JBL-PLU: 100420619', 'Parlante Bluetooth', 'JBL', 408500.00, 7, 21, 'JBL-PLU: 100420619', '1637868961.jpg', 'Parlante Bluetooth Jbl Flip 5 Negro', NULL, '2021-11-25 20:59:55', '2021-11-25 20:59:55');
INSERT INTO `products` VALUES (6, 'BOSE-PLU: 100121462', 'Parlante Inalambrico Bose', 'BOSE', 1741900.00, 6, 37, 'BOSE-PLU: 100121462', '1637868962.jpg', 'Parlante Inalambrico Bose Home Speaker 500 Plateado', NULL, '2021-11-25 20:59:55', '2021-11-25 20:59:55');
INSERT INTO `products` VALUES (7, 'LG-PLU: 100704843', 'Torre De Sonido Lg', 'LG', 999999.00, 10, 41, 'LG-PLU: 100704843', '1637868963.jpg', 'Torre De Sonido Lg Xboom Rn7 1000W Rms', NULL, '2021-11-25 20:59:55', '2021-11-25 20:59:55');
INSERT INTO `products` VALUES (8, 'XIAOMI-PLU: 101422619', 'Celular Xiaomi Poco X3', 'XIAOMI', 1120250.00, 14, 43, 'XIAOMI-PLU: 101422619', '1637868964.jpg', 'Celular Xiaomi Poco X3 Pro 256Gb Negro 8Gb Ram', NULL, '2021-11-25 20:59:55', '2021-11-25 20:59:55');
INSERT INTO `products` VALUES (9, 'MOTOROLA-PLU: 3021246', 'Celular Motorola Moto G30', 'MOTOROLA', 797900.00, 9, 33, 'MOTOROLA-PLU: 3021246', '1637868965.jpg', 'Celular Motorola Moto G30 128GB Lila', NULL, '2021-11-25 20:59:55', '2021-11-25 20:59:55');
INSERT INTO `products` VALUES (10, 'asdfgw6', 'Celuar', 'ASUS', 1200000.00, 4, 12, 'asdfgw6', '1638321011.png', NULL, NULL, '2021-12-01 01:10:11', '2021-12-01 01:10:11');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `gender` enum('F','M','NA') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `role` enum('admin','guest') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'guest',
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Admin Admin', 'admin@argon.com', '2021-11-23 16:55:16', '$2y$10$rE8aI98rR6GO/RRqZrxa8eMiyzx14RuW8tzSUZVqBZ7GR.hTjVtDa', NULL, 'M', '2021-11-23 16:55:16', '2021-11-23 16:55:16', NULL, NULL, 'guest', NULL);
INSERT INTO `users` VALUES (2, 'Jheyson Herrera', 'herrerajheyson@gmail.com', NULL, '$2y$10$uWNqTaS6W4n.wWBW44Z2kuXqbv7bD.YztzbcFOIo9DXaYtyk5.SvG', NULL, 'M', '2021-11-23 21:57:55', '2021-11-24 03:45:07', 'Cll 46B No 65-6, Parques de Bolívar 3, Santa Marta - Colombia', '3012515659', 'admin', NULL);
INSERT INTO `users` VALUES (4, 'Leonela Ruda', 'lruda30@gmail.com', NULL, '$2y$10$RdEOvqlToFgyTxPT6KIBVOWVQLlhr0tD1ApUW/UhmBBDfFu6CJeVu', NULL, 'F', '2021-11-23 22:28:10', '2021-11-24 16:07:50', 'Parques de Bolívar Etapa 3, Torre 25 Apto 103 - Santa Marta, Colombia', '3008525430', 'guest', '2021-11-24 16:07:50');
INSERT INTO `users` VALUES (5, 'Adalberto Ávila', 'aavila@gmail.com', NULL, '$2y$10$M3CTfzJXgleYJKloNort6eYgc3NY91vFPP0mxrFu/iHCtP9xOMbRe', NULL, 'M', '2021-11-24 14:56:36', '2021-11-24 18:22:21', 'El Pando, Santa Marta - Colombia', '3456789023', 'guest', NULL);
INSERT INTO `users` VALUES (6, 'Marcelino Mejia', 'mmejia@gmail.com', NULL, '$2y$10$Rvl2N7c3CVievrxKlzIzQu07VGjt2CDCPDJ84O3ZhSoUirmuG83G.', NULL, 'M', '2021-11-26 15:18:22', '2021-11-26 15:19:53', NULL, '3215647896', 'guest', NULL);
INSERT INTO `users` VALUES (7, 'Samantha Gretel', 'samantha@gmail.com', NULL, '$2y$10$O7OGlhLU/3pllgbFrbFpMehGPtEhacCUmxqYh8aNAZTct/CBlbXmC', NULL, 'F', '2021-11-29 01:31:45', '2021-11-29 01:31:45', NULL, '3109876543', 'guest', NULL);
INSERT INTO `users` VALUES (9, 'Sara Herrera', 'sara@gmail.com', NULL, '$2y$10$oRjyn7.Qj3c2x0JOktMZn.cShoLGI43MqM8DjkR2MFSSdOUnyN9aC', NULL, NULL, '2021-11-29 02:06:56', '2021-11-29 02:06:56', NULL, '3456789023', 'guest', NULL);

SET FOREIGN_KEY_CHECKS = 1;

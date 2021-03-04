-- --------------------------------------------------------
-- Host:                         10.90.199.113
-- Server version:               8.0.23 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for vnptpayc
CREATE DATABASE IF NOT EXISTS `vnptpayc` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `vnptpayc`;

-- Dumping structure for table vnptpayc.admin_rule
CREATE TABLE IF NOT EXISTS `admin_rule` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int unsigned NOT NULL,
  `resource_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `admin_rule_role_id_foreign` (`role_id`),
  KEY `admin_rule_resource_id_foreign` (`resource_id`),
  CONSTRAINT `admin_rule_resource_id_foreign` FOREIGN KEY (`resource_id`) REFERENCES `admin_resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `admin_rule_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `admin_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.admin_rule: ~42 rows (approximately)
/*!40000 ALTER TABLE `admin_rule` DISABLE KEYS */;
INSERT INTO `admin_rule` (`id`, `role_id`, `resource_id`, `created_at`, `updated_at`) VALUES
	(117, 1, 666, '2021-02-11 13:20:09', '2021-02-11 13:20:09'),
	(121, 2, 662, '2021-02-11 13:20:17', '2021-02-11 13:20:17'),
	(122, 2, 666, '2021-02-11 13:20:19', '2021-02-11 13:20:19'),
	(123, 2, 661, '2021-02-11 13:20:20', '2021-02-11 13:20:20'),
	(124, 2, 663, '2021-02-11 13:20:20', '2021-02-11 13:20:20'),
	(125, 2, 653, '2021-02-11 13:20:21', '2021-02-11 13:20:21'),
	(126, 2, 643, '2021-02-11 13:20:21', '2021-02-11 13:20:21'),
	(127, 2, 644, '2021-02-11 13:20:22', '2021-02-11 13:20:22'),
	(128, 2, 645, '2021-02-11 13:20:22', '2021-02-11 13:20:22'),
	(129, 2, 647, '2021-02-11 13:20:22', '2021-02-11 13:20:22'),
	(130, 2, 648, '2021-02-11 13:20:22', '2021-02-11 13:20:22'),
	(131, 2, 652, '2021-02-11 13:20:22', '2021-02-11 13:20:22'),
	(132, 2, 614, '2021-02-11 13:20:23', '2021-02-11 13:20:23'),
	(133, 2, 615, '2021-02-11 13:20:23', '2021-02-11 13:20:23'),
	(134, 2, 612, '2021-02-11 13:20:24', '2021-02-11 13:20:24'),
	(135, 2, 613, '2021-02-11 13:20:24', '2021-02-11 13:20:24'),
	(136, 2, 617, '2021-02-11 13:20:26', '2021-02-11 13:20:26'),
	(137, 2, 631, '2021-02-11 13:20:26', '2021-02-11 13:20:26'),
	(138, 2, 632, '2021-02-11 13:20:26', '2021-02-11 13:20:26'),
	(139, 2, 633, '2021-02-11 13:20:26', '2021-02-11 13:20:26'),
	(140, 2, 618, '2021-02-11 13:20:28', '2021-02-11 13:20:28'),
	(141, 2, 620, '2021-02-11 13:20:28', '2021-02-11 13:20:28'),
	(142, 2, 621, '2021-02-11 13:20:28', '2021-02-11 13:20:28'),
	(143, 2, 623, '2021-02-11 13:20:28', '2021-02-11 13:20:28'),
	(144, 2, 624, '2021-02-11 13:20:28', '2021-02-11 13:20:28'),
	(145, 2, 664, '2021-02-11 13:20:28', '2021-02-11 13:20:28'),
	(146, 2, 665, '2021-02-11 13:20:28', '2021-02-11 13:20:28'),
	(147, 2, 636, '2021-02-11 13:20:29', '2021-02-11 13:20:29'),
	(148, 2, 637, '2021-02-11 13:20:29', '2021-02-11 13:20:29'),
	(149, 2, 638, '2021-02-11 13:20:29', '2021-02-11 13:20:29'),
	(150, 2, 640, '2021-02-11 13:20:29', '2021-02-11 13:20:29'),
	(151, 2, 641, '2021-02-11 13:20:29', '2021-02-11 13:20:29'),
	(152, 2, 642, '2021-02-11 13:20:29', '2021-02-11 13:20:29'),
	(153, 2, 616, '2021-02-11 13:20:31', '2021-02-11 13:20:31'),
	(154, 2, 626, '2021-02-11 13:20:31', '2021-02-11 13:20:31'),
	(155, 2, 627, '2021-02-11 13:20:31', '2021-02-11 13:20:31'),
	(156, 2, 629, '2021-02-11 13:20:31', '2021-02-11 13:20:31'),
	(157, 2, 630, '2021-02-11 13:20:31', '2021-02-11 13:20:31'),
	(158, 2, 651, '2021-02-11 13:20:31', '2021-02-11 13:20:31'),
	(159, 1, 661, '2021-02-11 13:45:37', '2021-02-11 13:45:37'),
	(160, 1, 663, '2021-02-11 13:45:37', '2021-02-11 13:45:37'),
	(161, 1, 662, '2021-02-11 13:45:39', '2021-02-11 13:45:39');
/*!40000 ALTER TABLE `admin_rule` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

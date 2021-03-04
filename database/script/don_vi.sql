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

-- Dumping structure for table vnptpayc.don_vi
CREATE TABLE IF NOT EXISTS `don_vi` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_users` int unsigned NOT NULL DEFAULT '1' COMMENT 'id người tạo',
  `ten_don_vi` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dia_chi` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `co_dinh` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `di_dong` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int unsigned DEFAULT NULL,
  `order` int NOT NULL DEFAULT '1',
  `state` int NOT NULL DEFAULT '1' COMMENT '0: không hoạt động; 1: hoạt động',
  PRIMARY KEY (`id`),
  KEY `FK_don_vi_don_vi` (`parent_id`),
  KEY `order` (`order`),
  KEY `FK_don_vi_users` (`id_users`),
  CONSTRAINT `FK_don_vi_don_vi` FOREIGN KEY (`parent_id`) REFERENCES `don_vi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.don_vi: ~2 rows (approximately)
/*!40000 ALTER TABLE `don_vi` DISABLE KEYS */;
INSERT INTO `don_vi` (`id`, `id_users`, `ten_don_vi`, `dia_chi`, `email`, `co_dinh`, `di_dong`, `fax`, `parent_id`, `order`, `state`) VALUES
	(1, 1, 'Vãng lai (Không được xóa)', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
	(2, 1, 'Tỉnh Trà Vinh (Không được xóa)', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1);
/*!40000 ALTER TABLE `don_vi` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

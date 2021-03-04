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

-- Dumping structure for table vnptpayc.users_don_vi
CREATE TABLE IF NOT EXISTS `users_don_vi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_don_vi` int unsigned NOT NULL,
  `id_users` int unsigned NOT NULL,
  `id_chuc_danh` int unsigned NOT NULL DEFAULT '1',
  `id_chuc_vu` int unsigned NOT NULL DEFAULT '1',
  `ngay_bat_dau_cong_tac` datetime DEFAULT CURRENT_TIMESTAMP,
  `ngay_ket_thuc_cong_tac` datetime DEFAULT NULL,
  `state` int unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_users_don_vi_users` (`id_users`),
  KEY `FK_users_don_vi_don_vi` (`id_don_vi`),
  KEY `FK_users_don_vi_chuc_danh` (`id_chuc_danh`),
  KEY `FK_users_don_vi_chuc_vu` (`id_chuc_vu`),
  CONSTRAINT `FK_users_don_vi_chuc_danh` FOREIGN KEY (`id_chuc_danh`) REFERENCES `nhom_chuc_vu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_users_don_vi_chuc_vu` FOREIGN KEY (`id_chuc_vu`) REFERENCES `chuc_vu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_users_don_vi_don_vi` FOREIGN KEY (`id_don_vi`) REFERENCES `don_vi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_users_don_vi_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.users_don_vi: ~0 rows (approximately)
/*!40000 ALTER TABLE `users_don_vi` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_don_vi` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

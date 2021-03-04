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

-- Dumping structure for table vnptpayc.to_do
CREATE TABLE IF NOT EXISTS `to_do` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int unsigned NOT NULL,
  `noi_dung` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `file` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `ngay_tao` datetime DEFAULT CURRENT_TIMESTAMP,
  `ngay_giao` datetime DEFAULT CURRENT_TIMESTAMP,
  `han_xu_ly` datetime DEFAULT NULL,
  `ngay_hoan_thanh` datetime DEFAULT NULL,
  `sap_xep` int NOT NULL DEFAULT '0',
  `trang_thai` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_to_do_users` (`id_user`),
  CONSTRAINT `FK_to_do_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.to_do: ~0 rows (approximately)
/*!40000 ALTER TABLE `to_do` DISABLE KEYS */;
INSERT INTO `to_do` (`id`, `id_user`, `noi_dung`, `file`, `ngay_tao`, `ngay_giao`, `han_xu_ly`, `ngay_hoan_thanh`, `sap_xep`, `trang_thai`) VALUES
	(1, 2, 'test2', NULL, '2021-02-04 14:43:11', '2021-02-04 14:43:11', '2021-02-04 10:00:01', NULL, 0, 1),
	(3, 1, 'Công việc 1', NULL, '2021-02-18 08:07:39', '2021-02-18 08:07:39', '2021-03-01 10:00:00', '2021-02-19 16:16:34', 1, 0),
	(4, 1, 'Công việc 2', NULL, '2021-02-18 08:07:45', '2021-02-18 08:07:45', '2021-03-01 10:00:00', NULL, 6, 0),
	(5, 1, 'Công việc 3', NULL, '2021-02-18 08:07:51', '2021-02-18 08:07:51', '2021-03-01 10:00:00', '2021-02-22 10:06:35', 3, 1),
	(6, 1, 'Công việc 4', NULL, '2021-02-18 08:07:57', '2021-02-18 08:07:57', '2021-03-01 10:00:00', NULL, 7, 0),
	(7, 1, 'Công việc 5', NULL, '2021-02-18 08:08:06', '2021-02-18 08:08:06', '2021-03-01 10:00:00', NULL, 5, 0),
	(8, 1, 'Công việc 6', NULL, '2021-02-18 16:31:46', '2021-02-18 16:31:46', '2021-02-20 10:00:00', NULL, 2, 1),
	(9, 1, 'Công việc 7', NULL, '2021-02-18 16:32:31', '2021-02-18 16:32:31', NULL, NULL, 4, 1),
	(10, 1, 'Công việc 8', NULL, '2021-02-18 16:37:53', '2021-02-18 16:37:53', '2021-02-20 10:00:00', '2021-02-22 10:05:47', 8, 1),
	(12, 2, 'test', NULL, '2021-02-19 10:29:44', '2021-02-19 10:29:44', '2021-02-20 10:00:00', '2021-02-22 10:32:16', 9, 1);
/*!40000 ALTER TABLE `to_do` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

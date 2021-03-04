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

-- Dumping structure for table vnptpayc.nhom_chuc_vu
CREATE TABLE IF NOT EXISTS `nhom_chuc_vu` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ten_nhom_chuc_vu` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `loai_nhom_chuc_vu` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `state` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `loai_nhom_chuc_vu` (`loai_nhom_chuc_vu`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.nhom_chuc_vu: ~4 rows (approximately)
/*!40000 ALTER TABLE `nhom_chuc_vu` DISABLE KEYS */;
INSERT INTO `nhom_chuc_vu` (`id`, `ten_nhom_chuc_vu`, `loai_nhom_chuc_vu`, `state`) VALUES
	(1, 'Khách hàng', 'KHACH_HANG', 1),
	(2, 'Lãnh đạo', 'LANH_DAO', 1),
	(3, 'Chuyên viên tiếp nhận', 'CHUYEN_VIEN_TIEP_NHAN', 1),
	(4, 'Chuyên viên xử lý', 'CHUYEN_VIEN_XU_LY', 1);
/*!40000 ALTER TABLE `nhom_chuc_vu` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

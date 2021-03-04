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

-- Dumping structure for table vnptpayc.dich_vu
CREATE TABLE IF NOT EXISTS `dich_vu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_nhom_dich_vu` int DEFAULT NULL,
  `ten_dich_vu` varchar(50) DEFAULT NULL,
  `state` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_dich_vu_nhom_dich_vu` (`id_nhom_dich_vu`),
  CONSTRAINT `FK_dich_vu_nhom_dich_vu` FOREIGN KEY (`id_nhom_dich_vu`) REFERENCES `nhom_dich_vu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.dich_vu: ~3 rows (approximately)
/*!40000 ALTER TABLE `dich_vu` DISABLE KEYS */;
INSERT INTO `dich_vu` (`id`, `id_nhom_dich_vu`, `ten_dich_vu`, `state`) VALUES
	(1, 1, 'VNPT-HIS', 1),
	(2, 1, 'VNPT-IGATE', 1),
	(3, 1, 'VNPT-IOFFICE', 1);
/*!40000 ALTER TABLE `dich_vu` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

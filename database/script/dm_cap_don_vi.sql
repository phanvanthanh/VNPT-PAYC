-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.17-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for vnptpayc
CREATE DATABASE IF NOT EXISTS `vnptpayc` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `vnptpayc`;

-- Dumping structure for table vnptpayc.dm_cap_don_vi
CREATE TABLE IF NOT EXISTS `dm_cap_don_vi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ma_cap` varchar(50) DEFAULT NULL,
  `ten_cap` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.dm_cap_don_vi: ~8 rows (approximately)
/*!40000 ALTER TABLE `dm_cap_don_vi` DISABLE KEYS */;
INSERT INTO `dm_cap_don_vi` (`id`, `ma_cap`, `ten_cap`) VALUES
	(1, 'UBT', 'UBND Tỉnh'),
	(2, 'VTT', 'VIỄN THÔNG TỈNH TRÀ VINH'),
	(3, 'TTCNTT', 'Trung tâm công nghệ thông tin'),
	(4, 'TTDHTT', 'Trung tâm Điều hành thông tin'),
	(5, 'TTKDTT', 'Trung tâm Kinh doanh thông tin'),
	(6, 'TTVT', 'Trung tâm Viễn thông'),
	(7, 'HUYEN', 'Viễn thông cấp huyện'),
	(8, 'XA', 'Viễn thông cấp huyện');
/*!40000 ALTER TABLE `dm_cap_don_vi` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

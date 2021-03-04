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

-- Dumping structure for table vnptpayc.dm_quanhuyen
CREATE TABLE IF NOT EXISTS `dm_quanhuyen` (
  `MA_QUAN_HUYEN` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `TEN_QUAN_HUYEN` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `MA_TINH` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `LOAI` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.dm_quanhuyen: ~9 rows (approximately)
/*!40000 ALTER TABLE `dm_quanhuyen` DISABLE KEYS */;
INSERT INTO `dm_quanhuyen` (`MA_QUAN_HUYEN`, `TEN_QUAN_HUYEN`, `MA_TINH`, `LOAI`, `updated_at`, `created_at`) VALUES
	('842', 'Thành phố Trà Vinh', '84', 'TP', '2020-08-13 02:00:55', '2020-08-13 02:00:55'),
	('844', 'Huyện Càng Long', '84', 'Huyen', '2020-08-13 02:00:55', '2020-08-13 02:00:55'),
	('845', 'Huyện Cầu Kè', '84', 'Huyen', '2020-08-13 02:00:55', '2020-08-13 02:00:55'),
	('846', 'Huyện Tiểu Cần', '84', 'Huyen', '2020-08-13 02:00:55', '2020-08-13 02:00:55'),
	('847', 'Huyện Châu Thành', '84', 'Huyen', '2020-08-13 02:00:55', '2020-08-13 02:00:55'),
	('848', 'Huyện Cầu Ngang', '84', 'Huyen', '2020-08-13 02:00:55', '2020-08-13 02:00:55'),
	('849', 'Huyện Trà Cú', '84', 'Huyen', '2020-08-13 02:00:55', '2020-08-13 02:00:55'),
	('851', 'Thị xã Duyên Hải', '84', 'TX', '2020-08-13 02:00:55', '2020-08-13 02:00:55'),
	('850', 'Huyện Duyên Hải', '84', 'Huyen', '2020-08-13 02:00:55', '2020-08-13 02:00:55');
/*!40000 ALTER TABLE `dm_quanhuyen` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

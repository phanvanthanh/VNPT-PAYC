-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.30-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
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

-- Dumping structure for table vnptpayc.admin_resource
CREATE TABLE IF NOT EXISTS `admin_resource` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ten_hien_thi` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resource` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameter_value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `uri` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `show_menu` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `icon` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_resource_parent_foreign` (`parent_id`),
  CONSTRAINT `admin_resource_parent_foreign` FOREIGN KEY (`parent_id`) REFERENCES `admin_resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=653 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.admin_resource: ~46 rows (approximately)
/*!40000 ALTER TABLE `admin_resource` DISABLE KEYS */;
INSERT INTO `admin_resource` (`id`, `ten_hien_thi`, `resource`, `method`, `action`, `parameter`, `parameter_value`, `parent_id`, `created_at`, `updated_at`, `uri`, `status`, `show_menu`, `order`, `icon`) VALUES
	(1, 'Root', 'Root', 'GET', '#', '#', '#', NULL, '2021-02-01 09:49:23', '2021-02-02 08:33:17', '#', 1, 1, 0, NULL),
	(601, 'Đăng nhập', 'GET | App\\Http\\Controllers\\Auth\\LoginController@showLoginForm', 'GET', 'App\\Http\\Controllers\\Auth\\LoginController@showLoginForm', '', '', 1, '2021-02-01 09:49:23', '2021-02-04 14:32:48', 'login', 1, 2, 1000, '<i class="icon-login"></i>'),
	(602, 'Nút đăng nhập', 'POST | App\\Http\\Controllers\\Auth\\LoginController@login', 'POST', 'App\\Http\\Controllers\\Auth\\LoginController@login', '', '', 601, '2021-02-01 09:49:23', '2021-02-04 14:32:48', 'login', 1, 2, 1000, NULL),
	(603, 'Đăng xuất', 'POST | App\\Http\\Controllers\\Auth\\LoginController@logout', 'POST', 'App\\Http\\Controllers\\Auth\\LoginController@logout', '', '', 1, '2021-02-01 09:49:23', '2021-02-04 14:32:48', 'logout', 1, 2, 1000, '<i class="icon-logout"></i>'),
	(604, 'Đăng ký', 'GET | App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm', 'GET', 'App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm', '', '', 1, '2021-02-01 09:49:23', '2021-02-04 14:32:48', 'register', 1, 2, 1000, '<i class="icon-user-following mx-0"></i>'),
	(605, 'Nút đăng ký', 'POST | App\\Http\\Controllers\\Auth\\RegisterController@register', 'POST', 'App\\Http\\Controllers\\Auth\\RegisterController@register', '', '', 604, '2021-02-01 09:49:23', '2021-02-04 14:32:48', 'register', 1, 2, 1000, NULL),
	(606, 'Reset mật khẩu', 'GET | App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm', 'GET', 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm', '', '', 1, '2021-02-01 09:49:23', '2021-02-04 14:32:48', 'password/reset', 1, 2, 1000, '<i class="icon-key mx-0"></i>'),
	(607, 'Xác thực email', 'POST | App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail', 'POST', 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail', '', '', 606, '2021-02-01 09:49:23', '2021-02-04 14:32:48', 'password/email', 1, 2, 1000, NULL),
	(608, 'Lấy token reset mật khẩu', 'GET | App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm', 'GET', 'App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm', '', '', 606, '2021-02-01 09:49:23', '2021-02-04 14:32:48', 'password/reset/{token}', 1, 2, 1000, NULL),
	(609, 'Reset lại mật khẩu', 'POST | App\\Http\\Controllers\\Auth\\ResetPasswordController@reset', 'POST', 'App\\Http\\Controllers\\Auth\\ResetPasswordController@reset', '', '', 606, '2021-02-01 09:49:23', '2021-02-04 14:32:48', 'password/reset', 1, 2, 1000, NULL),
	(610, 'Xác nhận lại mật khẩu', 'GET | App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm', 'GET', 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm', '', '', 606, '2021-02-01 09:49:23', '2021-02-04 14:32:48', 'password/confirm', 1, 2, 1000, NULL),
	(611, 'Xác nhận lại mật khẩu lần 2', 'POST | App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm', 'POST', 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm', '', '', 606, '2021-02-01 09:49:23', '2021-02-04 14:32:48', 'password/confirm', 1, 2, 1000, NULL),
	(612, 'Danh mục quận huyện', 'GET | App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyen', 'GET', 'App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyen', '', '', 1, '2021-02-01 09:49:23', '2021-02-04 14:32:48', 'dm-quan-huyen', 1, 1, 5, '<i class="menu-icon icon-location-pin"></i>'),
	(613, 'Nút import danh mục quận huyện', 'POST | App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyenAndImport', 'POST', 'App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyenAndImport', '', '', 612, '2021-02-01 09:49:23', '2021-02-04 14:32:48', 'dm-quan-huyen/import', 1, 2, 1000, NULL),
	(614, 'Danh mục phường xã', 'GET | App\\Modules\\DmXaPhuong\\Controllers\\DmXaPhuongController@dmXaPhuong', 'GET', 'App\\Modules\\DmXaPhuong\\Controllers\\DmXaPhuongController@dmXaPhuong', '', '', 1, '2021-02-01 09:49:23', '2021-02-04 14:32:48', 'dm-xa-phuong', 1, 1, 6, '<i class="menu-icon icon-location-pin"></i>'),
	(615, 'Nút import danh mục phường xã', 'POST | App\\Modules\\DmXaPhuong\\Controllers\\DmXaPhuongController@dmXaPhuongAndImport', 'POST', 'App\\Modules\\DmXaPhuong\\Controllers\\DmXaPhuongController@dmXaPhuongAndImport', '', '', 614, '2021-02-01 09:49:23', '2021-02-04 14:32:48', 'dm-xa-phuong/import', 1, 2, 1000, NULL),
	(616, 'Nhóm quyền', 'GET | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@nhomQuyen', 'GET', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@nhomQuyen', '', '', 1, '2021-02-01 09:49:23', '2021-02-04 14:32:48', 'nhom-quyen', 1, 1, 3, '<i class="menu-icon icon-people"></i>'),
	(617, 'Phân quyền', 'GET | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyen', 'GET', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyen', '', '', 1, '2021-02-01 09:49:23', '2021-02-04 14:32:48', 'phan-quyen', 1, 1, 4, '<i class="menu-icon fa fa-sitemap"></i>'),
	(618, 'Danh sách chức năng', 'GET | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyen', 'GET', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyen', '', '', 1, '2021-02-01 09:49:23', '2021-02-04 14:32:48', 'tai-nguyen', 1, 1, 2, '<i class="menu-icon icon-list"></i>'),
	(619, 'Xem tất cả tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyenAll', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyenAll', '', '', 618, '2021-02-01 09:49:23', '2021-02-04 14:32:48', 'tai-nguyen-all', 1, 2, 1000, NULL),
	(620, 'Quét tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@quetTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@quetTaiNguyen', '', '', 618, '2021-02-01 09:49:23', '2021-02-04 14:32:48', 'quet-tai-nguyen', 1, 2, 1000, NULL),
	(621, 'Thêm một tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@themTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@themTaiNguyen', '', '', 618, '2021-02-01 09:49:23', '2021-02-04 14:32:48', 'them-tai-nguyen', 1, 2, 1000, NULL),
	(622, 'Lấy thông tin một tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@layTaiNguyenTheoId', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@layTaiNguyenTheoId', '', '', 618, '2021-02-01 09:49:23', '2021-02-04 14:32:48', 'lay-tai-nguyen-theo-id', 1, 2, 1000, NULL),
	(623, 'Sửa tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@capNhatTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@capNhatTaiNguyen', '', '', 618, '2021-02-01 09:49:23', '2021-02-04 14:32:48', 'cap-nhat-tai-nguyen', 1, 2, 1000, NULL),
	(624, 'Xóa tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@xoaTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@xoaTaiNguyen', '', '', 618, '2021-02-01 09:49:23', '2021-02-04 14:32:48', 'xoa-tai-nguyen', 1, 2, 1000, NULL),
	(626, 'Xem danh sách quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@danhSachNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@danhSachNhomQuyen', '', '', 616, '2021-02-02 07:59:22', '2021-02-04 14:32:48', 'danh-sach-nhom-quyen', 1, 2, 1000, NULL),
	(627, 'Thêm nhóm quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@themNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@themNhomQuyen', '', '', 616, '2021-02-02 07:59:22', '2021-02-04 14:32:48', 'them-nhom-quyen', 1, 2, 1000, NULL),
	(629, 'Cập nhật nhóm quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@capNhatNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@capNhatNhomQuyen', '', '', 616, '2021-02-02 07:59:22', '2021-02-04 14:32:48', 'cap-nhat-nhom-quyen', 1, 2, 1000, NULL),
	(630, 'Xóa nhóm quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@xoaNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@xoaNhomQuyen', '', '', 616, '2021-02-02 07:59:22', '2021-02-04 14:32:48', 'xoa-nhom-quyen', 1, 2, 1000, NULL),
	(631, 'Phân quyền', 'POST | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenPost', 'POST', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenPost', '', '', 617, '2021-02-02 07:59:22', '2021-02-04 14:32:48', 'phan-quyen-post', 1, 2, 1000, NULL),
	(632, 'Danh sách nhóm quyền (Phân quyền)', 'POST | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachNhomQuyen', 'POST', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachNhomQuyen', '', '', 617, '2021-02-02 07:59:22', '2021-02-04 14:32:48', 'phan-quyen/danh-sach-nhom-quyen', 1, 2, 1000, NULL),
	(633, 'Danh sách quyền theo nhóm quyền (Phân quyền)', 'POST | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachQuyenTheoNhomQuyenId', 'POST', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachQuyenTheoNhomQuyenId', '', '', 617, '2021-02-02 07:59:22', '2021-02-04 14:32:48', 'phan-quyen/danh-sach-quyen-theo-nhom-quyen-id', 1, 2, 1000, NULL),
	(635, 'Trang chủ', 'GET | App\\Modules\\TrangChu\\Controllers\\TrangChuController@trangChu', 'GET', 'App\\Modules\\TrangChu\\Controllers\\TrangChuController@trangChu', '', '', 1, '2021-02-02 09:08:36', '2021-02-04 14:32:48', '/', 1, 1, 1, '<i class="menu-icon icon-home"></i>'),
	(636, 'Danh mục đơn vị', 'GET | App\\Modules\\DonVi\\Controllers\\DonViController@donVi', 'GET', 'App\\Modules\\DonVi\\Controllers\\DonViController@donVi', '', '', 1, '2021-02-02 15:38:41', '2021-02-04 14:32:48', 'don-vi', 1, 1, 2, '<i class="menu-icon fa fa-cubes"></i>'),
	(637, 'Xem danh sách đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@danhSachDonVi', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@danhSachDonVi', '', '', 636, '2021-02-02 15:38:41', '2021-02-04 14:32:48', 'danh-sach-don-vi', 1, 2, 1000, NULL),
	(638, 'Thêm đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@themDonVi', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@themDonVi', '', '', 636, '2021-02-02 15:38:41', '2021-02-04 14:32:48', 'them-don-vi', 1, 2, 1000, NULL),
	(640, 'Cập nhật đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@capNhatDonVi', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@capNhatDonVi', '', '', 636, '2021-02-02 15:38:41', '2021-02-04 14:32:48', 'cap-nhat-don-vi', 1, 2, 1000, NULL),
	(641, 'Xóa đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@xoaDonVi', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@xoaDonVi', '', '', 636, '2021-02-02 15:38:41', '2021-02-04 14:32:48', 'xoa-don-vi', 1, 2, 1000, NULL),
	(642, 'Đơn vị single', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@donViSingle', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@donViSingle', '', '', 636, '2021-02-04 13:30:50', '2021-02-04 14:32:48', 'don-vi-single', 1, 2, 1000, NULL),
	(643, 'To do', 'GET | App\\Modules\\ToDo\\Controllers\\ToDoController@toDo', 'GET', 'App\\Modules\\ToDo\\Controllers\\ToDoController@toDo', '', '', 1, '2021-02-04 13:30:50', '2021-02-04 14:34:05', 'to-do', 1, 1, 7, '<i class="icon-clock menu-icon"></i>'),
	(644, 'Danh sách to do', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@danhSachToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@danhSachToDo', '', '', 643, '2021-02-04 13:30:50', '2021-02-07 08:01:42', 'danh-sach-to-do', 1, 1, 1000, NULL),
	(645, 'Thêm to do', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@themToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@themToDo', '', '', 643, '2021-02-04 13:30:50', '2021-02-04 14:32:48', 'them-to-do', 1, 2, 1000, NULL),
	(647, 'Cập nhật to do', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@capNhatToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@capNhatToDo', '', '', 643, '2021-02-04 13:30:50', '2021-02-04 14:32:48', 'cap-nhat-to-do', 1, 2, 1000, NULL),
	(648, 'Xóa to do', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@xoaToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@xoaToDo', '', '', 643, '2021-02-04 13:30:50', '2021-02-04 14:32:48', 'xoa-to-do', 1, 2, 1000, NULL),
	(651, 'Nhóm quyền single', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@nhomQuyenSingle', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@nhomQuyenSingle', '', '', 616, '2021-02-04 14:32:48', '2021-02-04 14:33:17', 'nhom-quyen-single', 1, 2, 1000, NULL),
	(652, 'To do single', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@toDoSingle', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@toDoSingle', '', '', 643, '2021-02-04 14:32:48', '2021-02-04 14:33:33', 'to-do-single', 1, 2, 1000, NULL);
/*!40000 ALTER TABLE `admin_resource` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.admin_role
CREATE TABLE IF NOT EXISTS `admin_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_don_vi` int(11) unsigned NOT NULL COMMENT 'id đơn vị cha có level = 0',
  `state` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '0: ngừng hoạt động; 1: hoạt động',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_admin_role_don_vi` (`id_don_vi`),
  CONSTRAINT `FK_admin_role_don_vi` FOREIGN KEY (`id_don_vi`) REFERENCES `don_vi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.admin_role: ~2 rows (approximately)
/*!40000 ALTER TABLE `admin_role` DISABLE KEYS */;
INSERT INTO `admin_role` (`id`, `role_name`, `id_don_vi`, `state`, `created_at`, `updated_at`) VALUES
	(1, 'Vãng lai (Không được xóa)', 1, 1, NULL, NULL),
	(2, 'ADMIN (Không được xóa)', 2, 1, NULL, NULL);
/*!40000 ALTER TABLE `admin_role` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.admin_rule
CREATE TABLE IF NOT EXISTS `admin_rule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `resource_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `admin_rule_role_id_foreign` (`role_id`),
  KEY `admin_rule_resource_id_foreign` (`resource_id`),
  CONSTRAINT `admin_rule_resource_id_foreign` FOREIGN KEY (`resource_id`) REFERENCES `admin_resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `admin_rule_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `admin_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.admin_rule: ~21 rows (approximately)
/*!40000 ALTER TABLE `admin_rule` DISABLE KEYS */;
INSERT INTO `admin_rule` (`id`, `role_id`, `resource_id`, `created_at`, `updated_at`) VALUES
	(51, 1, 618, '2021-02-02 08:40:31', NULL),
	(52, 1, 619, '2021-02-02 08:40:31', NULL),
	(53, 1, 620, '2021-02-02 08:40:31', NULL),
	(54, 1, 621, '2021-02-02 08:40:31', NULL),
	(55, 1, 622, '2021-02-02 08:40:31', NULL),
	(56, 1, 623, '2021-02-02 08:40:31', NULL),
	(57, 1, 624, '2021-02-02 08:40:31', NULL),
	(58, 1, 616, '2021-02-02 08:40:32', NULL),
	(59, 1, 626, '2021-02-02 08:40:32', NULL),
	(60, 1, 627, '2021-02-02 08:40:32', NULL),
	(62, 1, 629, '2021-02-02 08:40:32', NULL),
	(63, 1, 630, '2021-02-02 08:40:32', NULL),
	(64, 1, 617, '2021-02-02 08:40:33', NULL),
	(65, 1, 631, '2021-02-02 08:40:33', NULL),
	(66, 1, 632, '2021-02-02 08:40:33', NULL),
	(67, 1, 633, '2021-02-02 08:40:33', NULL),
	(68, 1, 612, '2021-02-02 08:40:34', NULL),
	(69, 1, 613, '2021-02-02 08:40:34', NULL),
	(72, 1, 614, '2021-02-02 08:53:36', NULL),
	(73, 1, 615, '2021-02-02 08:53:36', NULL),
	(74, 1, 635, '2021-02-02 15:15:22', NULL);
/*!40000 ALTER TABLE `admin_rule` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.chuc_danh
CREATE TABLE IF NOT EXISTS `chuc_danh` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten_chuc_danh` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_loai_chuc_danh` int(11) unsigned NOT NULL,
  `state` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_users_chuc_danh_user_loai_chuc_danh` (`id_loai_chuc_danh`),
  CONSTRAINT `FK_users_chuc_danh_user_loai_chuc_danh` FOREIGN KEY (`id_loai_chuc_danh`) REFERENCES `users_loai_chuc_danh` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.chuc_danh: ~5 rows (approximately)
/*!40000 ALTER TABLE `chuc_danh` DISABLE KEYS */;
INSERT INTO `chuc_danh` (`id`, `ten_chuc_danh`, `id_loai_chuc_danh`, `state`) VALUES
	(1, 'Lãnh đạo phòng', 1, 1),
	(2, 'Lãnh đạo Trung tâm', 1, 1),
	(3, 'Lãnh đạo Sở/Ban/Ngành', 1, 1),
	(4, 'Lãnh đạo Tỉnh', 1, 1),
	(5, 'Chuyên viên phòng', 2, 1);
/*!40000 ALTER TABLE `chuc_danh` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.chuc_vu
CREATE TABLE IF NOT EXISTS `chuc_vu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten_chuc_vu` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` int(11) DEFAULT '1' COMMENT '0 nghỉ sử dụng; 1 còn sử dụng',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.chuc_vu: ~11 rows (approximately)
/*!40000 ALTER TABLE `chuc_vu` DISABLE KEYS */;
INSERT INTO `chuc_vu` (`id`, `ten_chuc_vu`, `state`) VALUES
	(1, 'Chuyên viên IT', 1),
	(2, 'Chuyên viên', 1),
	(3, 'Giám đốc', 1),
	(4, 'Phó Giám đốc', 1),
	(5, 'Trưởng phòng', 1),
	(6, 'Phó Trưởng phòng', 1),
	(7, 'Lãnh đạo', 1),
	(8, 'Nhân viên', 1),
	(9, 'Chủ tịch', 1),
	(10, 'Phó Chủ tịch', 1),
	(11, 'Cán bộ', 1);
/*!40000 ALTER TABLE `chuc_vu` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.dich_vu
CREATE TABLE IF NOT EXISTS `dich_vu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_nhom_dich_vu` int(11) DEFAULT NULL,
  `ten_dich_vu` varchar(50) DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
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

-- Dumping structure for table vnptpayc.dm_quanhuyen
CREATE TABLE IF NOT EXISTS `dm_quanhuyen` (
  `MA_QUAN_HUYEN` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TEN_QUAN_HUYEN` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MA_TINH` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LOAI` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
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

-- Dumping structure for table vnptpayc.dm_xaphuong
CREATE TABLE IF NOT EXISTS `dm_xaphuong` (
  `MA_PHUONG_XA` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TEN_PHUONG_XA` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LOAI` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MA_QUAN_HUYEN` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.dm_xaphuong: ~106 rows (approximately)
/*!40000 ALTER TABLE `dm_xaphuong` DISABLE KEYS */;
INSERT INTO `dm_xaphuong` (`MA_PHUONG_XA`, `TEN_PHUONG_XA`, `LOAI`, `MA_QUAN_HUYEN`, `created_at`, `updated_at`) VALUES
	('29236', 'Phường 4', 'Phuong', '842', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29239', 'Phường 1', 'Phuong', '842', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29242', 'Phường 3', 'Phuong', '842', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29245', 'Phường 2', 'Phuong', '842', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29248', 'Phường 5', 'Phuong', '842', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29251', 'Phường 6', 'Phuong', '842', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29254', 'Phường 7', 'Phuong', '842', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29257', 'Phường 8', 'Phuong', '842', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29260', 'Phường 9', 'Phuong', '842', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29263', 'Xã Long Đức', 'Xa', '842', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29266', 'Thị trấn Càng Long', 'TT', '844', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29269', 'Xã Mỹ Cẩm', 'Xa', '844', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29272', 'Xã An Trường A', 'Xa', '844', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29275', 'Xã An Trường', 'Xa', '844', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29278', 'Xã Huyền Hội', 'Xa', '844', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29281', 'Xã Tân An', 'Xa', '844', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29284', 'Xã Tân Bình', 'Xa', '844', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29287', 'Xã Bình Phú', 'Xa', '844', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29290', 'Xã Phương Thạnh', 'Xa', '844', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29293', 'Xã Đại Phúc', 'Xa', '844', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29296', 'Xã Đại Phước', 'Xa', '844', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29299', 'Xã Nhị Long Phú', 'Xa', '844', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29302', 'Xã Nhị Long', 'Xa', '844', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29305', 'Xã Đức Mỹ', 'Xa', '844', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29308', 'Thị trấn Cầu Kè', 'TT', '845', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29311', 'Xã Hòa Ân', 'Xa', '845', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29314', 'Xã Châu Điền', 'Xa', '845', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29317', 'Xã An Phú Tân', 'Xa', '845', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29320', 'Xã Hoà Tân', 'Xa', '845', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29323', 'Xã Ninh Thới', 'Xa', '845', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29326', 'Xã Phong Phú', 'Xa', '845', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29329', 'Xã Phong Thạnh', 'Xa', '845', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29332', 'Xã Tam Ngãi', 'Xa', '845', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29335', 'Xã Thông Hòa', 'Xa', '845', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29338', 'Xã Thạnh Phú', 'Xa', '845', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29341', 'Thị trấn Tiểu Cần', 'TT', '846', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29344', 'Thị trấn Cầu Quan', 'TT', '846', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29347', 'Xã Phú Cần', 'Xa', '846', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29350', 'Xã Hiếu Tử', 'Xa', '846', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29353', 'Xã Hiếu Trung', 'Xa', '846', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29356', 'Xã Long Thới', 'Xa', '846', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29359', 'Xã Hùng Hòa', 'Xa', '846', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29362', 'Xã Tân Hùng', 'Xa', '846', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29365', 'Xã Tập Ngãi', 'Xa', '846', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29368', 'Xã Ngãi Hùng', 'Xa', '846', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29371', 'Xã Tân Hòa', 'Xa', '846', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29374', 'Thị trấn Châu Thành', 'TT', '847', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29377', 'Xã Đa Lộc', 'Xa', '847', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29380', 'Xã Mỹ Chánh', 'Xa', '847', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29383', 'Xã Thanh Mỹ', 'Xa', '847', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29386', 'Xã Lương Hoà A', 'Xa', '847', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29389', 'Xã Lương Hòa', 'Xa', '847', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29392', 'Xã Song Lộc', 'Xa', '847', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29395', 'Xã Nguyệt Hóa', 'Xa', '847', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29398', 'Xã Hòa Thuận', 'Xa', '847', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29401', 'Xã Hòa Lợi', 'Xa', '847', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29404', 'Xã Phước Hảo', 'Xa', '847', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29407', 'Xã Hưng Mỹ', 'Xa', '847', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29410', 'Xã Hòa Minh', 'Xa', '847', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29413', 'Xã Long Hòa', 'Xa', '847', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29416', 'Thị trấn Cầu Ngang', 'TT', '848', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29419', 'Thị trấn Mỹ Long', 'TT', '848', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29422', 'Xã Mỹ Long Bắc', 'Xa', '848', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29425', 'Xã Mỹ Long Nam', 'Xa', '848', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29428', 'Xã Mỹ Hòa', 'Xa', '848', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29431', 'Xã Vĩnh Kim', 'Xa', '848', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29434', 'Xã Kim Hòa', 'Xa', '848', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29437', 'Xã Hiệp Hòa', 'Xa', '848', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29440', 'Xã Thuận Hòa', 'Xa', '848', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29443', 'Xã Long Sơn', 'Xa', '848', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29446', 'Xã Nhị Trường', 'Xa', '848', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29449', 'Xã Trường Thọ', 'Xa', '848', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29452', 'Xã Hiệp Mỹ Đông', 'Xa', '848', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29455', 'Xã Hiệp Mỹ Tây', 'Xa', '848', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29458', 'Xã Thạnh Hòa Sơn', 'Xa', '848', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29461', 'Thị trấn Trà Cú', 'TT', '849', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29462', 'Thị trấn Định An', 'TT', '849', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29464', 'Xã Phước Hưng', 'Xa', '849', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29467', 'Xã Tập Sơn', 'Xa', '849', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29470', 'Xã Tân Sơn', 'Xa', '849', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29473', 'Xã An Quảng Hữu', 'Xa', '849', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29476', 'Xã Lưu Nghiệp Anh', 'Xa', '849', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29479', 'Xã Ngãi Xuyên', 'Xa', '849', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29482', 'Xã Kim Sơn', 'Xa', '849', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29485', 'Xã Thanh Sơn', 'Xa', '849', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29488', 'Xã Hàm Giang', 'Xa', '849', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29489', 'Xã Hàm Tân', 'Xa', '849', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29491', 'Xã Đại An', 'Xa', '849', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29494', 'Thị trấn Định An', 'TT', '849', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29503', 'Xã Ngọc Biên', 'Xa', '849', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29506', 'Xã Long Hiệp', 'Xa', '849', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29509', 'Xã Tân Hiệp', 'Xa', '849', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29497', 'Xã Đôn Xuân', 'Xa', '850', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29500', 'Xã Đôn Châu', 'Xa', '850', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29513', 'Thị trấn Long Thành', 'TT', '850', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29521', 'Xã Long Khánh', 'Xa', '850', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29530', 'Xã Ngũ Lạc', 'Xa', '850', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29533', 'Xã Long Vĩnh', 'Xa', '850', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29536', 'Xã Đông Hải', 'Xa', '850', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29512', 'Phường 1', 'Phuong', '851', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29515', 'Xã Long Toàn', 'Xa', '851', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29516', 'Phường 2', 'Phuong', '851', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29518', 'Xã Long Hữu', 'Xa', '851', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29524', 'Xã Dân Thành', 'Xa', '851', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29527', 'Xã Trường Long Hòa', 'Xa', '851', '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	('29539', 'Xã Hiệp Thạnh', 'Xa', '851', '2020-08-13 02:48:54', '2020-08-13 02:48:54');
/*!40000 ALTER TABLE `dm_xaphuong` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.don_vi
CREATE TABLE IF NOT EXISTS `don_vi` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_users` int(11) unsigned NOT NULL DEFAULT '1' COMMENT 'id người tạo',
  `ten_don_vi` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `dia_chi` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `co_dinh` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `di_dong` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) unsigned DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `state` int(11) NOT NULL DEFAULT '1' COMMENT '0: không hoạt động; 1: hoạt động',
  PRIMARY KEY (`id`),
  KEY `FK_don_vi_don_vi` (`parent_id`),
  KEY `order` (`order`),
  KEY `FK_don_vi_users` (`id_users`),
  CONSTRAINT `FK_don_vi_don_vi` FOREIGN KEY (`parent_id`) REFERENCES `don_vi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.don_vi: ~2 rows (approximately)
/*!40000 ALTER TABLE `don_vi` DISABLE KEYS */;
INSERT INTO `don_vi` (`id`, `id_users`, `ten_don_vi`, `dia_chi`, `email`, `co_dinh`, `di_dong`, `fax`, `parent_id`, `order`, `state`) VALUES
	(1, 1, 'Vãng lai (Không được xóa)', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
	(2, 1, 'Tỉnh Trà Vinh (Không được xóa)', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1);
/*!40000 ALTER TABLE `don_vi` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.nhom_dich_vu
CREATE TABLE IF NOT EXISTS `nhom_dich_vu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten_nhom_dich_vu` varchar(200) DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.nhom_dich_vu: ~2 rows (approximately)
/*!40000 ALTER TABLE `nhom_dich_vu` DISABLE KEYS */;
INSERT INTO `nhom_dich_vu` (`id`, `ten_nhom_dich_vu`, `state`) VALUES
	(1, 'Dịch vụ CNTT', 1),
	(2, 'Dịch vụ Internet', 1);
/*!40000 ALTER TABLE `nhom_dich_vu` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
	('thanhpv.tvh', '$2y$10$GeJq5nbaNzdeY8UqlCnDIOIh6uSHYw5iZcRhpKuPxDrBtqBT4qAG.', '2019-06-20 02:17:07');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.payc
CREATE TABLE IF NOT EXISTS `payc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_tao` int(11) unsigned NOT NULL,
  `id_dich_vu` int(11) NOT NULL,
  `tieu_de` varchar(200) DEFAULT NULL,
  `noi_dung` longtext,
  `file_payc` text,
  `ngay_tao` datetime DEFAULT NULL,
  `han_xu_ly_mong_muon` datetime DEFAULT NULL,
  `han_xu_ly_duoc_giao` datetime DEFAULT NULL,
  `ngay_hoan_tat` datetime DEFAULT NULL,
  `trang_thai` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_payc_users` (`id_user_tao`),
  KEY `FK_payc_dich_vu` (`id_dich_vu`),
  CONSTRAINT `FK_payc_dich_vu` FOREIGN KEY (`id_dich_vu`) REFERENCES `dich_vu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payc_users` FOREIGN KEY (`id_user_tao`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.payc: ~0 rows (approximately)
/*!40000 ALTER TABLE `payc` DISABLE KEYS */;
INSERT INTO `payc` (`id`, `id_user_tao`, `id_dich_vu`, `tieu_de`, `noi_dung`, `file_payc`, `ngay_tao`, `han_xu_ly_mong_muon`, `han_xu_ly_duoc_giao`, `ngay_hoan_tat`, `trang_thai`) VALUES
	(1, 1, 1, NULL, NULL, NULL, '2020-02-04 10:00:00', NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `payc` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.payc_canbo_xuly_yeucau
CREATE TABLE IF NOT EXISTS `payc_canbo_xuly_yeucau` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_payc` int(11) NOT NULL,
  `id_user_xu_ly` int(11) NOT NULL,
  `id_xu_ly` int(11) NOT NULL,
  `noi_dung_xu_ly` longtext,
  `file_xu_ly` text,
  `ngay_xu_ly` datetime DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.payc_canbo_xuly_yeucau: ~3 rows (approximately)
/*!40000 ALTER TABLE `payc_canbo_xuly_yeucau` DISABLE KEYS */;
INSERT INTO `payc_canbo_xuly_yeucau` (`id`, `id_payc`, `id_user_xu_ly`, `id_xu_ly`, `noi_dung_xu_ly`, `file_xu_ly`, `ngay_xu_ly`, `state`) VALUES
	(1, 1, 1, 1, NULL, NULL, '2021-02-04 10:55:12', 1),
	(2, 1, 2, 1, NULL, NULL, '2021-02-04 10:55:12', 1),
	(3, 2, 3, 1, NULL, NULL, '2021-02-04 10:55:12', 1);
/*!40000 ALTER TABLE `payc_canbo_xuly_yeucau` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.payc_xu_ly
CREATE TABLE IF NOT EXISTS `payc_xu_ly` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten_xu_ly` varchar(200) DEFAULT NULL,
  `mo_ta` varchar(250) DEFAULT NULL,
  `trang_thai` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.payc_xu_ly: ~15 rows (approximately)
/*!40000 ALTER TABLE `payc_xu_ly` DISABLE KEYS */;
INSERT INTO `payc_xu_ly` (`id`, `ten_xu_ly`, `mo_ta`, `trang_thai`) VALUES
	(1, 'Tạo PAYC', 'Khách hàng hoặc cán bộ tạo PAYC', 1),
	(2, 'Tiếp nhận', 'Cán bộ tiếp nhận PAYC', 1),
	(3, 'Hoàn tất', 'Hoàn tất xử lý PAYC', 1),
	(4, 'Từ chối', 'Từ chối PAYC', 1),
	(5, 'Chuyển xử lý', 'Chuyển bộ phận xử lý PAYC', 1),
	(6, 'Xử lý', 'Cán bộ đang xử lý PAYC', 1),
	(7, 'Chuyển lãnh đạo', 'Chuyển lãnh đạo xử lý hoặc xin ý kiến lãnh đạo', 1),
	(8, 'Chuyển lãnh đạo khác', 'Chuyển lãnh đạo khác xử lý hoặc xin ý kiến lãnh đạo khác', 1),
	(9, 'Duyệt', 'Lãnh đạo duyệt PAYC', 1),
	(10, 'Trả lại cán bộ tiếp nhận', 'Trả lại cán bộ tiếp nhận do sai thông tin hoặc không hiểu thông tin PAYC', 1),
	(11, 'Trả lại cán bộ xử lý', 'Trả lại cán bộ xử lý do chưa đáp ứng nội dung PAYC', 1),
	(12, 'Hủy', 'Hủy PAYC do khách hàng đã xử lý được hoặc không muốn yêu cầu tiếp', 1),
	(13, 'KH đánh giá', 'Khách hàng đánh giá phản ánh yêu cầu', 1),
	(14, 'LĐ đánh giá', 'Khách hàng đánh giá phản ánh yêu cầu', 1),
	(15, 'CB đánh giá', 'Khách hàng đánh giá phản ánh yêu cầu', 1);
/*!40000 ALTER TABLE `payc_xu_ly` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.to_do
CREATE TABLE IF NOT EXISTS `to_do` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(10) unsigned NOT NULL,
  `noi_dung` longtext COLLATE utf8_unicode_ci,
  `file` longtext COLLATE utf8_unicode_ci,
  `ngay_tao` datetime DEFAULT NULL,
  `ngay_giao` datetime DEFAULT NULL,
  `han_xu_ly` datetime DEFAULT NULL,
  `ngay_hoan_thanh` datetime DEFAULT NULL,
  `sap_xep` int(11) NOT NULL DEFAULT '0',
  `trang_thai` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_to_do_users` (`id_user`),
  CONSTRAINT `FK_to_do_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.to_do: ~0 rows (approximately)
/*!40000 ALTER TABLE `to_do` DISABLE KEYS */;
INSERT INTO `to_do` (`id`, `id_user`, `noi_dung`, `file`, `ngay_tao`, `ngay_giao`, `han_xu_ly`, `ngay_hoan_thanh`, `sap_xep`, `trang_thai`) VALUES
	(1, 2, 'test2', NULL, '2021-02-04 14:43:11', '2021-02-04 14:43:11', '2021-02-04 10:00:01', NULL, 0, 0);
/*!40000 ALTER TABLE `to_do` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hinh_anh` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '/user.png',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `di_dong` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `hinh_anh`, `remember_token`, `created_at`, `updated_at`, `di_dong`, `state`) VALUES
	(1, 'guest@gmail.com', 'guest', '$2y$10$VZI0siYq7lRPvqt8e.QbXOWDBelj91YwJoLsEKx4GxbWH5XQb87xO', '/user.png', '35xOWSUdceM6lRhePiHS9Y3xwvvLupgJWeYIzh2FMjMl22RuUJURMmX7oElG', NULL, '2019-08-19 14:44:56', '0941138484', 1),
	(2, 'admin@gmail.com', 'admin', '$2y$10$VZI0siYq7lRPvqt8e.QbXOWDBelj91YwJoLsEKx4GxbWH5XQb87xO', '/user.png', 'VeIfzdiQRnJJ9oQkrQWufa1Xigg6ogkis3tJXMTxiH5cWbXrzaz2soMCnfTk', NULL, '2019-08-19 14:44:56', '0941138484', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.users_don_vi
CREATE TABLE IF NOT EXISTS `users_don_vi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_don_vi` int(11) unsigned NOT NULL,
  `id_users` int(11) unsigned NOT NULL,
  `id_chuc_danh` int(11) unsigned NOT NULL DEFAULT '1',
  `id_chuc_vu` int(11) unsigned NOT NULL,
  `ngay_bat_dau_cong_tac` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ngay_ket_thuc_cong_tac` datetime DEFAULT NULL,
  `state` int(11) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_users_don_vi_users` (`id_users`),
  KEY `FK_users_don_vi_don_vi` (`id_don_vi`),
  KEY `FK_users_don_vi_chuc_danh` (`id_chuc_danh`),
  KEY `FK_users_don_vi_chuc_vu` (`id_chuc_vu`),
  CONSTRAINT `FK_users_don_vi_chuc_danh` FOREIGN KEY (`id_chuc_danh`) REFERENCES `chuc_danh` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_users_don_vi_chuc_vu` FOREIGN KEY (`id_chuc_vu`) REFERENCES `chuc_vu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_users_don_vi_don_vi` FOREIGN KEY (`id_don_vi`) REFERENCES `don_vi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_users_don_vi_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.users_don_vi: ~0 rows (approximately)
/*!40000 ALTER TABLE `users_don_vi` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_don_vi` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

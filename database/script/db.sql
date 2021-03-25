-- --------------------------------------------------------
-- Host:                         10.90.199.89
-- Server version:               8.0.23 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for vnptpayc
CREATE DATABASE IF NOT EXISTS `vnptpayc` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `vnptpayc`;

-- Dumping structure for table vnptpayc.admin_resource
CREATE TABLE IF NOT EXISTS `admin_resource` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ten_hien_thi` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resource` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameter` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameter_value` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int unsigned DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `uri` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT '1',
  `show_menu` int DEFAULT NULL,
  `order` int DEFAULT NULL,
  `icon` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_resource_parent_foreign` (`parent_id`),
  CONSTRAINT `admin_resource_parent_foreign` FOREIGN KEY (`parent_id`) REFERENCES `admin_resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1010 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.admin_resource: ~89 rows (approximately)
/*!40000 ALTER TABLE `admin_resource` DISABLE KEYS */;
INSERT INTO `admin_resource` (`id`, `ten_hien_thi`, `resource`, `method`, `action`, `parameter`, `parameter_value`, `parent_id`, `created_at`, `updated_at`, `uri`, `status`, `show_menu`, `order`, `icon`) VALUES
	(1, 'Root', 'Root', 'GET', '#', '#', '#', NULL, '2021-02-01 09:49:23', '2021-02-02 08:33:17', '#', 1, 1, 0, NULL),
	(872, 'Đăng nhập', 'GET | App\\Http\\Controllers\\Auth\\LoginController@showLoginForm', 'GET', 'App\\Http\\Controllers\\Auth\\LoginController@showLoginForm', '', '', 1, '2021-03-12 16:43:45', '2021-03-17 10:27:31', 'login', 1, 1, 1000, '<i class="fa fa-lock menu-icon"></i>'),
	(873, 'Nút đăng nhập', 'POST | App\\Http\\Controllers\\Auth\\LoginController@login', 'POST', 'App\\Http\\Controllers\\Auth\\LoginController@login', '', '', 872, '2021-03-12 16:43:45', '2021-03-17 10:27:31', 'login', 1, 2, 1000, NULL),
	(874, 'Đăng xuất', 'POST | App\\Http\\Controllers\\Auth\\LoginController@logout', 'POST', 'App\\Http\\Controllers\\Auth\\LoginController@logout', '', '', 1, '2021-03-12 16:43:45', '2021-03-17 10:27:31', 'logout', 1, 2, 1000, '<i class="fa fa-unlock menu-icon"></i>'),
	(875, 'Đăng ký', 'GET | App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm', 'GET', 'App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm', '', '', 1, '2021-03-12 16:43:45', '2021-03-17 10:27:31', 'register', 1, 1, 1000, '<i class="fa fa-vcard-o menu-icon"></i>'),
	(876, 'Nút đăng ký', 'POST | App\\Http\\Controllers\\Auth\\RegisterController@register', 'POST', 'App\\Http\\Controllers\\Auth\\RegisterController@register', '', '', 875, '2021-03-12 16:43:45', '2021-03-17 10:27:31', 'register', 1, 2, 1000, NULL),
	(877, 'Reset mật khẩu', 'GET | App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm', 'GET', 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm', '', '', 1, '2021-03-12 16:43:45', '2021-03-17 10:27:31', 'password/reset', 1, 1, 1000, '<i class="fa fa-refresh menu-icon"></i>'),
	(878, 'password/email', 'POST | App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail', 'POST', 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail', '', '', 877, '2021-03-12 16:43:45', '2021-03-17 10:27:31', 'password/email', 1, 2, 1000, NULL),
	(879, 'Lấy token reset mật khẩu', 'GET | App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm', 'GET', 'App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm', '', '', 877, '2021-03-12 16:43:45', '2021-03-17 15:51:32', 'password/reset/{token}', 1, 2, 1000, NULL),
	(880, 'password/reset', 'POST | App\\Http\\Controllers\\Auth\\ResetPasswordController@reset', 'POST', 'App\\Http\\Controllers\\Auth\\ResetPasswordController@reset', '', '', 877, '2021-03-12 16:43:45', '2021-03-17 10:27:31', 'password/reset', 1, 2, 1000, NULL),
	(881, 'Xác nhận lại mật khẩu', 'GET | App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm', 'GET', 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm', '', '', 877, '2021-03-12 16:43:45', '2021-03-17 15:51:42', 'password/confirm', 1, 2, 1000, NULL),
	(882, 'password/confirm', 'POST | App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm', 'POST', 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm', '', '', 877, '2021-03-12 16:43:45', '2021-03-17 10:27:31', 'password/confirm', 1, 2, 1000, NULL),
	(883, 'Danh mục phường xã', 'GET | App\\Modules\\DmPhuongXa\\Controllers\\DmPhuongXaController@dmPhuongXa', 'GET', 'App\\Modules\\DmPhuongXa\\Controllers\\DmPhuongXaController@dmPhuongXa', '', '', 1, '2021-03-12 16:43:45', '2021-03-17 10:27:31', 'dm-phuong-xa', 1, 1, 18, '<i class="menu-icon icon-location-pin"></i>'),
	(884, 'Import danh mục phường xã', 'POST | App\\Modules\\DmPhuongXa\\Controllers\\DmPhuongXaController@dmPhuongXaAndImport', 'POST', 'App\\Modules\\DmPhuongXa\\Controllers\\DmPhuongXaController@dmPhuongXaAndImport', '', '', 883, '2021-03-12 16:43:45', '2021-03-17 10:27:31', 'dm-phuong-xa/import', 1, 2, 1000, NULL),
	(885, 'Danh mục quận huyện', 'GET | App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyen', 'GET', 'App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyen', '', '', 1, '2021-03-12 16:43:45', '2021-03-17 10:27:31', 'dm-quan-huyen', 1, 1, 17, '<i class="menu-icon icon-location-pin"></i>'),
	(886, 'Import danh mục quận/huyện', 'POST | App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyenAndImport', 'POST', 'App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyenAndImport', '', '', 885, '2021-03-12 16:43:45', '2021-03-17 10:27:31', 'dm-quan-huyen/import', 1, 2, 1000, NULL),
	(887, 'Đơn vị', 'GET | App\\Modules\\DonVi\\Controllers\\DonViController@donVi', 'GET', 'App\\Modules\\DonVi\\Controllers\\DonViController@donVi', '', '', 1, '2021-03-12 16:43:45', '2021-03-17 10:27:31', 'don-vi', 1, 1, 16, '<i class="fa fa-university menu-icon"></i>'),
	(888, 'Xem danh sách đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@danhSachDonVi', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@danhSachDonVi', '', '', 887, '2021-03-12 16:43:45', '2021-03-17 10:27:31', 'danh-sach-don-vi', 1, 2, 1000, NULL),
	(889, 'Thêm đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@themDonVi', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@themDonVi', '', '', 887, '2021-03-12 16:43:45', '2021-03-17 10:27:31', 'them-don-vi', 1, 2, 1000, NULL),
	(890, 'Load thông tin đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@donViSingle', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@donViSingle', '', '', 887, '2021-03-12 16:43:45', '2021-03-17 10:27:31', 'don-vi-single', 1, 2, 1000, NULL),
	(891, 'Cập nhật đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@capNhatDonVi', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@capNhatDonVi', '', '', 887, '2021-03-12 16:43:45', '2021-03-17 10:27:31', 'cap-nhat-don-vi', 1, 2, 1000, NULL),
	(892, 'Xóa đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@xoaDonVi', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@xoaDonVi', '', '', 887, '2021-03-12 16:43:45', '2021-03-17 10:27:31', 'xoa-don-vi', 1, 2, 1000, NULL),
	(893, 'Nhóm quyền', 'GET | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@nhomQuyen', 'GET', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@nhomQuyen', '', '', 1, '2021-03-12 16:43:45', '2021-03-17 10:27:31', 'nhom-quyen', 1, 1, 13, '<i class="fa fa-database menu-icon"></i>'),
	(894, 'Xem danh sách nhóm quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@danhSachNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@danhSachNhomQuyen', '', '', 893, '2021-03-12 16:43:45', '2021-03-17 10:27:31', 'danh-sach-nhom-quyen', 1, 2, 1000, NULL),
	(895, 'Thêm nhóm quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@themNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@themNhomQuyen', '', '', 893, '2021-03-12 16:43:45', '2021-03-17 10:27:31', 'them-nhom-quyen', 1, 2, 1000, NULL),
	(896, 'Load thông tin nhóm quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@nhomQuyenSingle', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@nhomQuyenSingle', '', '', 893, '2021-03-12 16:43:45', '2021-03-17 10:27:32', 'nhom-quyen-single', 1, 2, 1000, NULL),
	(897, 'Cập nhật nhóm quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@capNhatNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@capNhatNhomQuyen', '', '', 893, '2021-03-12 16:43:45', '2021-03-17 10:27:32', 'cap-nhat-nhom-quyen', 1, 2, 1000, NULL),
	(898, 'Xóa nhóm quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@xoaNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@xoaNhomQuyen', '', '', 893, '2021-03-12 16:43:45', '2021-03-17 10:27:32', 'xoa-nhom-quyen', 1, 2, 1000, NULL),
	(899, 'Phân quyền', 'GET | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyen', 'GET', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyen', '', '', 1, '2021-03-12 16:43:45', '2021-03-17 10:27:32', 'phan-quyen', 1, 1, 14, '<i class="fa fa-cogs menu-icon"></i>'),
	(900, 'Lưu thông tin quyền', 'POST | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenPost', 'POST', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenPost', '', '', 899, '2021-03-12 16:43:45', '2021-03-17 10:27:32', 'phan-quyen-post', 1, 2, 1000, NULL),
	(901, 'Load danh sách nhóm quyền', 'POST | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachNhomQuyen', 'POST', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachNhomQuyen', '', '', 899, '2021-03-12 16:43:45', '2021-03-17 10:27:32', 'phan-quyen/danh-sach-nhom-quyen', 1, 2, 1000, NULL),
	(902, 'Load danh sách quyền', 'POST | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachQuyenTheoNhomQuyenId', 'POST', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachQuyenTheoNhomQuyenId', '', '', 899, '2021-03-12 16:43:45', '2021-03-17 10:27:32', 'phan-quyen/danh-sach-quyen-theo-nhom-quyen-id', 1, 2, 1000, NULL),
	(903, 'Danh mục chức năng', 'GET | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyen', 'GET', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyen', '', '', 1, '2021-03-12 16:43:45', '2021-03-17 10:27:32', 'tai-nguyen', 1, 1, 15, '<i class="menu-icon icon-list"></i>'),
	(904, 'Xem danh sách tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@danhSachTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@danhSachTaiNguyen', '', '', 903, '2021-03-12 16:43:45', '2021-03-17 10:27:32', 'danh-sach-tai-nguyen', 1, 2, 1000, NULL),
	(905, 'Quét tài nguyên hệ thống', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@quetTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@quetTaiNguyen', '', '', 903, '2021-03-12 16:43:45', '2021-03-17 10:27:32', 'quet-tai-nguyen', 1, 2, 1000, NULL),
	(906, 'Thêm tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@themTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@themTaiNguyen', '', '', 903, '2021-03-12 16:43:45', '2021-03-17 10:27:32', 'them-tai-nguyen', 1, 2, 1000, NULL),
	(907, 'Load thông tin tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyenSingle', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyenSingle', '', '', 903, '2021-03-12 16:43:45', '2021-03-17 10:27:32', 'tai-nguyen-single', 1, 2, 1000, NULL),
	(908, 'Cập nhật tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@capNhatTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@capNhatTaiNguyen', '', '', 903, '2021-03-12 16:43:45', '2021-03-17 10:27:33', 'cap-nhat-tai-nguyen', 1, 2, 1000, NULL),
	(909, 'Xóa tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@xoaTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@xoaTaiNguyen', '', '', 903, '2021-03-12 16:43:45', '2021-03-17 10:27:33', 'xoa-tai-nguyen', 1, 2, 1000, NULL),
	(910, 'Trang chủ', 'GET | App\\Modules\\TrangChu\\Controllers\\TrangChuController@home', 'GET', 'App\\Modules\\TrangChu\\Controllers\\TrangChuController@home', '', '', 1, '2021-03-12 16:43:45', '2021-03-17 10:27:33', '/', 1, 1, 1, '<i class="fa fa-home menu-icon"></i>'),
	(911, 'Tài khoản', 'GET | App\\Modules\\User\\Controllers\\UserController@user', 'GET', 'App\\Modules\\User\\Controllers\\UserController@user', '', '', 1, '2021-03-12 16:43:45', '2021-03-17 10:27:33', 'user', 1, 1, 12, '<i class="fa fa-address-book menu-icon"></i>'),
	(912, 'Xem danh sách tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@danhSachUser', 'POST', 'App\\Modules\\User\\Controllers\\UserController@danhSachUser', '', '', 911, '2021-03-12 16:43:45', '2021-03-17 10:27:33', 'danh-sach-user', 1, 2, 1000, NULL),
	(913, 'Tạo tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@themUser', 'POST', 'App\\Modules\\User\\Controllers\\UserController@themUser', '', '', 911, '2021-03-12 16:43:45', '2021-03-17 10:27:33', 'them-user', 1, 2, 1000, NULL),
	(914, 'Load thông tin tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@userSingle', 'POST', 'App\\Modules\\User\\Controllers\\UserController@userSingle', '', '', 911, '2021-03-12 16:43:45', '2021-03-17 10:27:33', 'user-single', 1, 2, 1000, NULL),
	(915, 'Cập nhật tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@capNhatUser', 'POST', 'App\\Modules\\User\\Controllers\\UserController@capNhatUser', '', '', 911, '2021-03-12 16:43:45', '2021-03-17 10:27:33', 'cap-nhat-user', 1, 2, 1000, NULL),
	(916, 'Xóa tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@xoaUser', 'POST', 'App\\Modules\\User\\Controllers\\UserController@xoaUser', '', '', 911, '2021-03-12 16:43:45', '2021-03-17 10:27:33', 'xoa-user', 1, 2, 1000, NULL),
	(964, 'Gửi PAKN', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@payc', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@payc', '', '', 1, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'payc', 1, 1, 1000, '<i class="fa fa-paper-plane menu-icon"></i>'),
	(965, 'PAKN của tôi', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycCuaToi', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycCuaToi', '', '', 1, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'danh-sach-payc-cua-toi', 1, 1, 1000, '<i class="fa fa-shield menu-icon"></i>'),
	(966, 'PAKN chờ tiếp nhận', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoTiepNhan', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoTiepNhan', '', '', 1006, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'danh-sach-payc-cho-tiep-nhan', 1, 1, 1000, NULL),
	(967, 'Form tiếp nhận và chuyển xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmTiepNhanVaChuyenXuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmTiepNhanVaChuyenXuLy', '', '', 1006, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'frm-tiep-nhan-va-chuyen-xu-ly', 1, 2, 1000, NULL),
	(968, 'Tiếp nhận và chuyển xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@tiepNhanVaChuyenXuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@tiepNhanVaChuyenXuLy', '', '', 967, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'tiep-nhan-va-chuyen-xu-ly', 1, 2, 1000, NULL),
	(969, 'PAKN chờ xử lý', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoXuLy', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoXuLy', '', '', 1006, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'danh-sach-payc-cho-xu-ly', 1, 1, 1000, NULL),
	(970, 'Form xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmXuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmXuLy', '', '', 1006, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'frm-xu-ly', 1, 2, 1000, NULL),
	(971, 'Xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@xuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@xuLy', '', '', 970, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'xu-ly', 1, 2, 1000, NULL),
	(972, 'PAKN chờ duyệt', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoDuyet', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoDuyet', '', '', 1006, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'danh-sach-payc-cho-duyet', 1, 1, 1000, NULL),
	(973, 'Frm duyệt', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmDuyet', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmDuyet', '', '', 1006, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'frm-duyet', 1, 2, 1000, NULL),
	(974, 'Duyệt', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@duyet', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@duyet', '', '', 973, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'duyet', 1, 2, 1000, NULL),
	(975, 'Form chuyển bộ phận tiếp nhận & xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmChuyenBoPhanTiepNhanVaXuLyPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmChuyenBoPhanTiepNhanVaXuLyPayc', '', '', 1006, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'frm-chuyen-bo-phan-tiep-nhan-va-xu-ly-payc', 1, 2, 1000, NULL),
	(976, 'Chuyển bộ phận tiếp nhận & xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@chuyenBoPhanTiepNhanVaXuLyPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@chuyenBoPhanTiepNhanVaXuLyPayc', '', '', 975, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'chuyen-bo-phan-tiep-nhan-va-xu-ly-payc', 1, 2, 1000, NULL),
	(977, 'Form chuyển lãnh đạo', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmChuyenLanhDao', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmChuyenLanhDao', '', '', 1006, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'frm-chuyen-lanh-dao', 1, 2, 1000, NULL),
	(978, 'Chuyển lãnh đạo', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@chuyenLanhDao', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@chuyenLanhDao', '', '', 977, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'chuyen-lanh-dao', 1, 2, 1000, NULL),
	(979, 'Form chuyển cấp trên', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmChuyenCapTren', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmChuyenCapTren', '', '', 1006, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'frm-chuyen-cap-tren', 1, 2, 1000, NULL),
	(980, 'Chuyển cấp trên', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@chuyenCapTren', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@chuyenCapTren', '', '', 979, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'chuyen-cap-tren', 1, 2, 1000, NULL),
	(981, 'Form hoàn tất xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmHoanTat', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmHoanTat', '', '', 1006, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'frm-hoan-tat', 1, 2, 1000, NULL),
	(982, 'Hoàn tất xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@hoanTat', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@hoanTat', '', '', 981, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'hoan-tat', 1, 2, 1000, NULL),
	(983, 'From trả PAKN lại (Không xử lý)', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmTraLaiKhongXuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmTraLaiKhongXuLy', '', '', 1006, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'frm-tra-lai-khong-xu-ly', 1, 2, 1000, NULL),
	(984, 'Trả lại PAKN không xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@traLaiKhongXuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@traLaiKhongXuLy', '', '', 983, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'tra-lai-khong-xu-ly', 1, 2, 1000, NULL),
	(985, 'Form hủy PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmHuy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmHuy', '', '', 1006, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'frm-huy', 1, 2, 1000, NULL),
	(986, 'Hủy PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@huy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@huy', '', '', 985, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'huy', 1, 2, 1000, NULL),
	(987, 'Form cập nhật PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmCapNhatPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmCapNhatPayc', '', '', 1006, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'frm-cap-nhat-payc', 1, 2, 1000, NULL),
	(988, 'Cập nhật PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@capNhatPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@capNhatPayc', '', '', 987, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'cap-nhat-payc', 1, 2, 1000, NULL),
	(989, 'PAKN đã hoàn tất xử lý', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycDaHoanTat', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycDaHoanTat', '', '', 1006, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'danh-sach-payc-da-hoan-tat', 1, 1, 1000, NULL),
	(990, 'Chuyển khách hàng đánh giá', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@chuyenKHDanhGia', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@chuyenKHDanhGia', '', '', 1006, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'chuyen-kh-danh-gia', 1, 2, 1000, NULL),
	(991, 'Đánh giá PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@danhGia', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@danhGia', '', '', 1006, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'danh-gia', 1, 2, 1000, NULL),
	(992, 'Quá trình xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@qtxl', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@qtxl', '', '', 1006, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'qtxl', 1, 2, 1000, NULL),
	(993, 'Thêm PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@themPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@themPayc', '', '', 964, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'them-payc', 1, 2, 1000, NULL),
	(994, 'Tra cứu PAKN theo tài khoản', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycTheoTaiKhoan', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycTheoTaiKhoan', '', '', 1006, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'danh-sach-payc-theo-tai-khoan', 1, 1, 1000, NULL),
	(995, 'PAKN đã chuyển nhưng chưa có cán bộ nhận', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChuaCoCanBoNhan', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChuaCoCanBoNhan', '', '', 1006, '2021-03-17 08:35:39', '2021-03-17 10:27:32', 'danh-sach-payc-chua-co-can-bo-nhan', 1, 1, 1000, NULL),
	(996, 'Ghi chú công việc (To do)', 'GET | App\\Modules\\ToDo\\Controllers\\ToDoController@toDo', 'GET', 'App\\Modules\\ToDo\\Controllers\\ToDoController@toDo', '', '', 1, '2021-03-17 08:35:40', '2021-03-17 10:27:33', 'to-do', 1, 1, 1000, '<i class="fa fa-clock-o menu-icon"></i>'),
	(997, 'Xem danh sách ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@danhSachToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@danhSachToDo', '', '', 996, '2021-03-17 08:35:40', '2021-03-17 10:27:33', 'danh-sach-to-do', 1, 2, 1000, NULL),
	(998, 'Thêm ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@themToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@themToDo', '', '', 996, '2021-03-17 08:35:40', '2021-03-17 10:27:33', 'them-to-do', 1, 2, 1000, NULL),
	(999, 'Load thông tin ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@toDoSingle', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@toDoSingle', '', '', 996, '2021-03-17 08:35:40', '2021-03-17 10:27:33', 'to-do-single', 1, 2, 1000, NULL),
	(1000, 'Cập nhật ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@capNhatToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@capNhatToDo', '', '', 996, '2021-03-17 08:35:40', '2021-03-17 10:27:33', 'cap-nhat-to-do', 1, 2, 1000, NULL),
	(1001, 'Xóa ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@xoaToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@xoaToDo', '', '', 996, '2021-03-17 08:35:40', '2021-03-17 10:27:33', 'xoa-to-do', 1, 2, 1000, NULL),
	(1002, 'xu-ly-to-do', 'GET | App\\Modules\\ToDo\\Controllers\\ToDoController@xuLyToDo', 'GET', 'App\\Modules\\ToDo\\Controllers\\ToDoController@xuLyToDo', '', '', 1, '2021-03-17 08:35:40', '2021-03-17 10:27:33', 'xu-ly-to-do', 1, 1, 1000, NULL),
	(1003, 'Gạch ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@checkToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@checkToDo', '', '', 996, '2021-03-17 08:35:40', '2021-03-17 10:27:33', 'check-to-do', 1, 2, 1000, NULL),
	(1004, 'Bỏ gạch ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@uncheckToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@uncheckToDo', '', '', 996, '2021-03-17 08:35:40', '2021-03-17 10:27:33', 'uncheck-to-do', 1, 2, 1000, NULL),
	(1005, 'Sắp xếp lại ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@sortToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@sortToDo', '', '', 996, '2021-03-17 08:35:40', '2021-03-17 10:27:33', 'sort-to-do', 1, 2, 1000, NULL),
	(1006, 'Xử lý PAKN', NULL, 'GET', NULL, NULL, NULL, 1, '2021-03-17 08:52:37', '2021-03-17 08:52:37', NULL, 1, 1, NULL, '<i class="fa fa-keyboard-o menu-icon"></i>');
/*!40000 ALTER TABLE `admin_resource` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.admin_role
CREATE TABLE IF NOT EXISTS `admin_role` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_don_vi` int unsigned NOT NULL COMMENT 'id đơn vị cha có level = 0',
  `state` int unsigned NOT NULL DEFAULT '1' COMMENT '0: ngừng hoạt động; 1: hoạt động',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_admin_role_don_vi` (`id_don_vi`),
  CONSTRAINT `FK_admin_role_don_vi` FOREIGN KEY (`id_don_vi`) REFERENCES `don_vi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.admin_role: ~2 rows (approximately)
/*!40000 ALTER TABLE `admin_role` DISABLE KEYS */;
INSERT INTO `admin_role` (`id`, `role_name`, `id_don_vi`, `state`, `created_at`, `updated_at`) VALUES
	(1, 'Vãng lai', 1, 1, '2021-03-15 15:49:58', '2021-03-15 15:50:09'),
	(2, 'ADMIN', 1, 1, NULL, '2021-03-15 15:50:19');
/*!40000 ALTER TABLE `admin_role` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=445 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.admin_rule: ~89 rows (approximately)
/*!40000 ALTER TABLE `admin_rule` DISABLE KEYS */;
INSERT INTO `admin_rule` (`id`, `role_id`, `resource_id`, `created_at`, `updated_at`) VALUES
	(324, 1, 964, '2021-03-17 13:44:35', '2021-03-17 13:44:35'),
	(325, 1, 964, '2021-03-17 13:44:35', '2021-03-17 13:44:35'),
	(357, 2, 1006, '2021-03-17 15:40:46', '2021-03-17 15:40:46'),
	(358, 2, 1006, '2021-03-17 15:40:46', '2021-03-17 15:40:46'),
	(359, 2, 1006, '2021-03-17 15:40:46', '2021-03-17 15:40:46'),
	(360, 2, 967, '2021-03-17 15:40:46', '2021-03-17 15:40:46'),
	(361, 2, 1006, '2021-03-17 15:40:46', '2021-03-17 15:40:46'),
	(362, 2, 1006, '2021-03-17 15:40:46', '2021-03-17 15:40:46'),
	(363, 2, 970, '2021-03-17 15:40:46', '2021-03-17 15:40:46'),
	(364, 2, 1006, '2021-03-17 15:40:46', '2021-03-17 15:40:46'),
	(365, 2, 1006, '2021-03-17 15:40:46', '2021-03-17 15:40:46'),
	(366, 2, 973, '2021-03-17 15:40:46', '2021-03-17 15:40:46'),
	(367, 2, 1006, '2021-03-17 15:40:47', '2021-03-17 15:40:47'),
	(368, 2, 975, '2021-03-17 15:40:47', '2021-03-17 15:40:47'),
	(369, 2, 1006, '2021-03-17 15:40:47', '2021-03-17 15:40:47'),
	(370, 2, 977, '2021-03-17 15:40:47', '2021-03-17 15:40:47'),
	(371, 2, 1006, '2021-03-17 15:40:47', '2021-03-17 15:40:47'),
	(372, 2, 979, '2021-03-17 15:40:47', '2021-03-17 15:40:47'),
	(373, 2, 1006, '2021-03-17 15:40:47', '2021-03-17 15:40:47'),
	(374, 2, 981, '2021-03-17 15:40:47', '2021-03-17 15:40:47'),
	(375, 2, 1006, '2021-03-17 15:40:47', '2021-03-17 15:40:47'),
	(376, 2, 983, '2021-03-17 15:40:47', '2021-03-17 15:40:47'),
	(377, 2, 1006, '2021-03-17 15:40:47', '2021-03-17 15:40:47'),
	(378, 2, 985, '2021-03-17 15:40:47', '2021-03-17 15:40:47'),
	(379, 2, 1006, '2021-03-17 15:40:47', '2021-03-17 15:40:47'),
	(380, 2, 987, '2021-03-17 15:40:47', '2021-03-17 15:40:47'),
	(381, 2, 1006, '2021-03-17 15:40:47', '2021-03-17 15:40:47'),
	(382, 2, 1006, '2021-03-17 15:40:47', '2021-03-17 15:40:47'),
	(383, 2, 1006, '2021-03-17 15:40:47', '2021-03-17 15:40:47'),
	(384, 2, 1006, '2021-03-17 15:40:47', '2021-03-17 15:40:47'),
	(385, 2, 1006, '2021-03-17 15:40:47', '2021-03-17 15:40:47'),
	(386, 2, 1006, '2021-03-17 15:40:47', '2021-03-17 15:40:47'),
	(387, 2, 910, '2021-03-17 15:40:48', '2021-03-17 15:40:48'),
	(388, 2, 911, '2021-03-17 15:40:49', '2021-03-17 15:40:49'),
	(389, 2, 911, '2021-03-17 15:40:49', '2021-03-17 15:40:49'),
	(390, 2, 911, '2021-03-17 15:40:49', '2021-03-17 15:40:49'),
	(391, 2, 911, '2021-03-17 15:40:49', '2021-03-17 15:40:49'),
	(392, 2, 911, '2021-03-17 15:40:49', '2021-03-17 15:40:49'),
	(393, 2, 911, '2021-03-17 15:40:49', '2021-03-17 15:40:49'),
	(394, 2, 893, '2021-03-17 15:40:50', '2021-03-17 15:40:50'),
	(395, 2, 893, '2021-03-17 15:40:50', '2021-03-17 15:40:50'),
	(396, 2, 893, '2021-03-17 15:40:50', '2021-03-17 15:40:50'),
	(397, 2, 893, '2021-03-17 15:40:50', '2021-03-17 15:40:50'),
	(398, 2, 893, '2021-03-17 15:40:50', '2021-03-17 15:40:50'),
	(399, 2, 893, '2021-03-17 15:40:50', '2021-03-17 15:40:50'),
	(400, 2, 899, '2021-03-17 15:42:26', '2021-03-17 15:42:26'),
	(401, 2, 899, '2021-03-17 15:42:26', '2021-03-17 15:42:26'),
	(402, 2, 899, '2021-03-17 15:42:26', '2021-03-17 15:42:26'),
	(403, 2, 899, '2021-03-17 15:42:26', '2021-03-17 15:42:26'),
	(404, 2, 903, '2021-03-17 15:42:27', '2021-03-17 15:42:27'),
	(405, 2, 903, '2021-03-17 15:42:27', '2021-03-17 15:42:27'),
	(406, 2, 903, '2021-03-17 15:42:27', '2021-03-17 15:42:27'),
	(407, 2, 903, '2021-03-17 15:42:27', '2021-03-17 15:42:27'),
	(408, 2, 903, '2021-03-17 15:42:27', '2021-03-17 15:42:27'),
	(409, 2, 903, '2021-03-17 15:42:27', '2021-03-17 15:42:27'),
	(410, 2, 903, '2021-03-17 15:42:27', '2021-03-17 15:42:27'),
	(411, 2, 887, '2021-03-17 15:42:28', '2021-03-17 15:42:28'),
	(412, 2, 887, '2021-03-17 15:42:28', '2021-03-17 15:42:28'),
	(413, 2, 887, '2021-03-17 15:42:28', '2021-03-17 15:42:28'),
	(414, 2, 887, '2021-03-17 15:42:28', '2021-03-17 15:42:28'),
	(415, 2, 887, '2021-03-17 15:42:28', '2021-03-17 15:42:28'),
	(416, 2, 887, '2021-03-17 15:42:28', '2021-03-17 15:42:28'),
	(417, 2, 885, '2021-03-17 15:42:29', '2021-03-17 15:42:29'),
	(418, 2, 885, '2021-03-17 15:42:29', '2021-03-17 15:42:29'),
	(419, 2, 883, '2021-03-17 15:42:29', '2021-03-17 15:42:29'),
	(420, 2, 883, '2021-03-17 15:42:29', '2021-03-17 15:42:29'),
	(421, 2, 872, '2021-03-17 15:42:30', '2021-03-17 15:42:30'),
	(422, 2, 872, '2021-03-17 15:42:30', '2021-03-17 15:42:30'),
	(423, 2, 875, '2021-03-17 15:42:31', '2021-03-17 15:42:31'),
	(424, 2, 875, '2021-03-17 15:42:31', '2021-03-17 15:42:31'),
	(425, 2, 877, '2021-03-17 15:42:32', '2021-03-17 15:42:32'),
	(426, 2, 877, '2021-03-17 15:42:32', '2021-03-17 15:42:32'),
	(427, 2, 877, '2021-03-17 15:42:32', '2021-03-17 15:42:32'),
	(428, 2, 877, '2021-03-17 15:42:32', '2021-03-17 15:42:32'),
	(429, 2, 877, '2021-03-17 15:42:32', '2021-03-17 15:42:32'),
	(430, 2, 877, '2021-03-17 15:42:32', '2021-03-17 15:42:32'),
	(431, 2, 964, '2021-03-17 15:42:34', '2021-03-17 15:42:34'),
	(432, 2, 964, '2021-03-17 15:42:34', '2021-03-17 15:42:34'),
	(433, 2, 965, '2021-03-17 15:42:35', '2021-03-17 15:42:35'),
	(434, 2, 996, '2021-03-17 15:42:36', '2021-03-17 15:42:36'),
	(435, 2, 996, '2021-03-17 15:42:36', '2021-03-17 15:42:36'),
	(436, 2, 996, '2021-03-17 15:42:36', '2021-03-17 15:42:36'),
	(437, 2, 996, '2021-03-17 15:42:36', '2021-03-17 15:42:36'),
	(438, 2, 996, '2021-03-17 15:42:36', '2021-03-17 15:42:36'),
	(439, 2, 996, '2021-03-17 15:42:36', '2021-03-17 15:42:36'),
	(440, 2, 996, '2021-03-17 15:42:36', '2021-03-17 15:42:36'),
	(441, 2, 996, '2021-03-17 15:42:36', '2021-03-17 15:42:36'),
	(442, 2, 996, '2021-03-17 15:42:36', '2021-03-17 15:42:36'),
	(444, 1, 965, '2021-03-17 15:43:22', '2021-03-17 15:43:22');
/*!40000 ALTER TABLE `admin_rule` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.chuc_danh
CREATE TABLE IF NOT EXISTS `chuc_danh` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ten_chuc_danh` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.chuc_danh: ~2 rows (approximately)
/*!40000 ALTER TABLE `chuc_danh` DISABLE KEYS */;
INSERT INTO `chuc_danh` (`id`, `ten_chuc_danh`, `state`) VALUES
	(1, 'Kỹ sư', 1),
	(2, 'Thạc sỹ', 1);
/*!40000 ALTER TABLE `chuc_danh` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.chuc_vu
CREATE TABLE IF NOT EXISTS `chuc_vu` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_nhom_chuc_vu` int unsigned NOT NULL DEFAULT '1',
  `ten_chuc_vu` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` int DEFAULT '1' COMMENT '0 nghỉ sử dụng; 1 còn sử dụng',
  PRIMARY KEY (`id`),
  KEY `FK_chuc_vu_nhom_chuc_vu` (`id_nhom_chuc_vu`),
  CONSTRAINT `FK_chuc_vu_nhom_chuc_vu` FOREIGN KEY (`id_nhom_chuc_vu`) REFERENCES `nhom_chuc_vu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.chuc_vu: ~4 rows (approximately)
/*!40000 ALTER TABLE `chuc_vu` DISABLE KEYS */;
INSERT INTO `chuc_vu` (`id`, `id_nhom_chuc_vu`, `ten_chuc_vu`, `state`) VALUES
	(1, 1, 'Khách hàng', 1),
	(2, 2, 'Lãnh đạo', 1),
	(3, 3, 'Chuyên viên tiếp nhận', 1),
	(4, 4, 'Chuyên viên xử lý', 1);
/*!40000 ALTER TABLE `chuc_vu` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.dich_vu
CREATE TABLE IF NOT EXISTS `dich_vu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_nhom_dich_vu` int DEFAULT NULL,
  `ten_dich_vu` varchar(50) DEFAULT NULL,
  `state` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_dich_vu_nhom_dich_vu` (`id_nhom_dich_vu`),
  CONSTRAINT `FK_dich_vu_nhom_dich_vu` FOREIGN KEY (`id_nhom_dich_vu`) REFERENCES `nhom_dich_vu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.dich_vu: ~0 rows (approximately)
/*!40000 ALTER TABLE `dich_vu` DISABLE KEYS */;
INSERT INTO `dich_vu` (`id`, `id_nhom_dich_vu`, `ten_dich_vu`, `state`) VALUES
	(1, 1, 'Dịch vụ viễn thông', 1);
/*!40000 ALTER TABLE `dich_vu` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.dm_cap_don_vi
CREATE TABLE IF NOT EXISTS `dm_cap_don_vi` (
  `id` int NOT NULL AUTO_INCREMENT,
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

-- Dumping structure for table vnptpayc.dm_phuong_xa
CREATE TABLE IF NOT EXISTS `dm_phuong_xa` (
  `ma_phuong_xa` int unsigned NOT NULL,
  `ten_phuong_xa` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `loai` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ma_quan_huyen` int unsigned NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ma_phuong_xa`),
  KEY `FK_dm_xaphuong_DM_quanhuyen` (`ma_quan_huyen`),
  CONSTRAINT `FK_dm_xaphuong_DM_quanhuyen` FOREIGN KEY (`ma_quan_huyen`) REFERENCES `dm_quan_huyen` (`ma_quan_huyen`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.dm_phuong_xa: ~106 rows (approximately)
/*!40000 ALTER TABLE `dm_phuong_xa` DISABLE KEYS */;
INSERT INTO `dm_phuong_xa` (`ma_phuong_xa`, `ten_phuong_xa`, `loai`, `ma_quan_huyen`, `created_at`, `updated_at`) VALUES
	(29236, 'Phường 4', 'Phuong', 842, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29239, 'Phường 1', 'Phuong', 842, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29242, 'Phường 3', 'Phuong', 842, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29245, 'Phường 2', 'Phuong', 842, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29248, 'Phường 5', 'Phuong', 842, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29251, 'Phường 6', 'Phuong', 842, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29254, 'Phường 7', 'Phuong', 842, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29257, 'Phường 8', 'Phuong', 842, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29260, 'Phường 9', 'Phuong', 842, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29263, 'Xã Long Đức', 'Xa', 842, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29266, 'Thị trấn Càng Long', 'TT', 844, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29269, 'Xã Mỹ Cẩm', 'Xa', 844, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29272, 'Xã An Trường A', 'Xa', 844, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29275, 'Xã An Trường', 'Xa', 844, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29278, 'Xã Huyền Hội', 'Xa', 844, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29281, 'Xã Tân An', 'Xa', 844, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29284, 'Xã Tân Bình', 'Xa', 844, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29287, 'Xã Bình Phú', 'Xa', 844, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29290, 'Xã Phương Thạnh', 'Xa', 844, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29293, 'Xã Đại Phúc', 'Xa', 844, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29296, 'Xã Đại Phước', 'Xa', 844, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29299, 'Xã Nhị Long Phú', 'Xa', 844, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29302, 'Xã Nhị Long', 'Xa', 844, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29305, 'Xã Đức Mỹ', 'Xa', 844, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29308, 'Thị trấn Cầu Kè', 'TT', 845, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29311, 'Xã Hòa Ân', 'Xa', 845, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29314, 'Xã Châu Điền', 'Xa', 845, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29317, 'Xã An Phú Tân', 'Xa', 845, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29320, 'Xã Hoà Tân', 'Xa', 845, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29323, 'Xã Ninh Thới', 'Xa', 845, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29326, 'Xã Phong Phú', 'Xa', 845, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29329, 'Xã Phong Thạnh', 'Xa', 845, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29332, 'Xã Tam Ngãi', 'Xa', 845, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29335, 'Xã Thông Hòa', 'Xa', 845, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29338, 'Xã Thạnh Phú', 'Xa', 845, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29341, 'Thị trấn Tiểu Cần', 'TT', 846, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29344, 'Thị trấn Cầu Quan', 'TT', 846, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29347, 'Xã Phú Cần', 'Xa', 846, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29350, 'Xã Hiếu Tử', 'Xa', 846, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29353, 'Xã Hiếu Trung', 'Xa', 846, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29356, 'Xã Long Thới', 'Xa', 846, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29359, 'Xã Hùng Hòa', 'Xa', 846, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29362, 'Xã Tân Hùng', 'Xa', 846, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29365, 'Xã Tập Ngãi', 'Xa', 846, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29368, 'Xã Ngãi Hùng', 'Xa', 846, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29371, 'Xã Tân Hòa', 'Xa', 846, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29374, 'Thị trấn Châu Thành', 'TT', 847, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29377, 'Xã Đa Lộc', 'Xa', 847, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29380, 'Xã Mỹ Chánh', 'Xa', 847, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29383, 'Xã Thanh Mỹ', 'Xa', 847, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29386, 'Xã Lương Hoà A', 'Xa', 847, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29389, 'Xã Lương Hòa', 'Xa', 847, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29392, 'Xã Song Lộc', 'Xa', 847, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29395, 'Xã Nguyệt Hóa', 'Xa', 847, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29398, 'Xã Hòa Thuận', 'Xa', 847, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29401, 'Xã Hòa Lợi', 'Xa', 847, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29404, 'Xã Phước Hảo', 'Xa', 847, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29407, 'Xã Hưng Mỹ', 'Xa', 847, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29410, 'Xã Hòa Minh', 'Xa', 847, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29413, 'Xã Long Hòa', 'Xa', 847, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29416, 'Thị trấn Cầu Ngang', 'TT', 848, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29419, 'Thị trấn Mỹ Long', 'TT', 848, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29422, 'Xã Mỹ Long Bắc', 'Xa', 848, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29425, 'Xã Mỹ Long Nam', 'Xa', 848, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29428, 'Xã Mỹ Hòa', 'Xa', 848, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29431, 'Xã Vĩnh Kim', 'Xa', 848, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29434, 'Xã Kim Hòa', 'Xa', 848, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29437, 'Xã Hiệp Hòa', 'Xa', 848, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29440, 'Xã Thuận Hòa', 'Xa', 848, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29443, 'Xã Long Sơn', 'Xa', 848, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29446, 'Xã Nhị Trường', 'Xa', 848, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29449, 'Xã Trường Thọ', 'Xa', 848, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29452, 'Xã Hiệp Mỹ Đông', 'Xa', 848, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29455, 'Xã Hiệp Mỹ Tây', 'Xa', 848, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29458, 'Xã Thạnh Hòa Sơn', 'Xa', 848, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29461, 'Thị trấn Trà Cú', 'TT', 849, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29462, 'Thị trấn Định An', 'TT', 849, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29464, 'Xã Phước Hưng', 'Xa', 849, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29467, 'Xã Tập Sơn', 'Xa', 849, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29470, 'Xã Tân Sơn', 'Xa', 849, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29473, 'Xã An Quảng Hữu', 'Xa', 849, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29476, 'Xã Lưu Nghiệp Anh', 'Xa', 849, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29479, 'Xã Ngãi Xuyên', 'Xa', 849, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29482, 'Xã Kim Sơn', 'Xa', 849, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29485, 'Xã Thanh Sơn', 'Xa', 849, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29488, 'Xã Hàm Giang', 'Xa', 849, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29489, 'Xã Hàm Tân', 'Xa', 849, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29491, 'Xã Đại An', 'Xa', 849, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29494, 'Thị trấn Định An', 'TT', 849, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29497, 'Xã Đôn Xuân', 'Xa', 850, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29500, 'Xã Đôn Châu', 'Xa', 850, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29503, 'Xã Ngọc Biên', 'Xa', 849, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29506, 'Xã Long Hiệp', 'Xa', 849, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29509, 'Xã Tân Hiệp', 'Xa', 849, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29512, 'Phường 1', 'Phuong', 851, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29513, 'Thị trấn Long Thành', 'TT', 850, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29515, 'Xã Long Toàn', 'Xa', 851, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29516, 'Phường 2', 'Phuong', 851, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29518, 'Xã Long Hữu', 'Xa', 851, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29521, 'Xã Long Khánh', 'Xa', 850, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29524, 'Xã Dân Thành', 'Xa', 851, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29527, 'Xã Trường Long Hòa', 'Xa', 851, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29530, 'Xã Ngũ Lạc', 'Xa', 850, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29533, 'Xã Long Vĩnh', 'Xa', 850, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29536, 'Xã Đông Hải', 'Xa', 850, '2020-08-13 02:48:54', '2020-08-13 02:48:54'),
	(29539, 'Xã Hiệp Thạnh', 'Xa', 851, '2020-08-13 02:48:54', '2020-08-13 02:48:54');
/*!40000 ALTER TABLE `dm_phuong_xa` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.dm_quan_huyen
CREATE TABLE IF NOT EXISTS `dm_quan_huyen` (
  `ma_quan_huyen` int unsigned NOT NULL,
  `ten_quan_huyen` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ma_tinh` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `loai` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ma_quan_huyen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.dm_quan_huyen: ~9 rows (approximately)
/*!40000 ALTER TABLE `dm_quan_huyen` DISABLE KEYS */;
INSERT INTO `dm_quan_huyen` (`ma_quan_huyen`, `ten_quan_huyen`, `ma_tinh`, `loai`, `updated_at`, `created_at`) VALUES
	(842, 'Thành phố Trà Vinh', '84', 'TP', '2020-08-13 02:00:55', '2020-08-13 02:00:55'),
	(844, 'Huyện Càng Long', '84', 'Huyen', '2020-08-13 02:00:55', '2020-08-13 02:00:55'),
	(845, 'Huyện Cầu Kè', '84', 'Huyen', '2020-08-13 02:00:55', '2020-08-13 02:00:55'),
	(846, 'Huyện Tiểu Cần', '84', 'Huyen', '2020-08-13 02:00:55', '2020-08-13 02:00:55'),
	(847, 'Huyện Châu Thành', '84', 'Huyen', '2020-08-13 02:00:55', '2020-08-13 02:00:55'),
	(848, 'Huyện Cầu Ngang', '84', 'Huyen', '2020-08-13 02:00:55', '2020-08-13 02:00:55'),
	(849, 'Huyện Trà Cú', '84', 'Huyen', '2020-08-13 02:00:55', '2020-08-13 02:00:55'),
	(850, 'Huyện Duyên Hải', '84', 'Huyen', '2020-08-13 02:00:55', '2020-08-13 02:00:55'),
	(851, 'Thị xã Duyên Hải', '84', 'TX', '2020-08-13 02:00:55', '2020-08-13 02:00:55');
/*!40000 ALTER TABLE `dm_quan_huyen` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.dm_tham_so_he_thong
CREATE TABLE IF NOT EXISTS `dm_tham_so_he_thong` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ma_tham_so` varchar(250) DEFAULT NULL,
  `ten_tham_so` varchar(250) DEFAULT NULL,
  `loai_tham_so` varchar(250) DEFAULT NULL,
  `gia_tri_tham_so` varchar(250) DEFAULT NULL,
  `mo_ta_tham_so` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.dm_tham_so_he_thong: ~3 rows (approximately)
/*!40000 ALTER TABLE `dm_tham_so_he_thong` DISABLE KEYS */;
INSERT INTO `dm_tham_so_he_thong` (`id`, `ma_tham_so`, `ten_tham_so`, `loai_tham_so`, `gia_tri_tham_so`, `mo_ta_tham_so`) VALUES
	(1, 'CAP_TIEP_NHAN_MAC_DINH', 'Cấp tiếp nhận yêu cầu mặc định', 'Nvarchar2', 'HUYEN', 'XA cấp xã; HUYEN cấp huyện; TTVT cấp Trung tâm viễn thông; TTCNTT cấp trung tâm CNTT; TTDHTT cấp Trung tâm DHTT; TTKD cấp Trung tâm kinh doanh; VTT cấp viễn thông tỉnh; UBT cấp Ủy ban tỉnh'),
	(2, 'MA_NHOM_CHUC_VU_NHAN_PAKN', 'Nhóm chức vụ nhận PAKN', 'Nvarchar2', 'TIEP_NHAN', 'LANH_DAO là lãnh đạo nhận PAKN, XU_LY là chuyên viên xử lý sẽ nhận PAKN; ngược lại là nhóm tiếp nhận'),
	(3, 'SECRET_KEY_API_TAO_TAI_KHOAN', 'Khóa bảo mật khi gọi API tạo tài khoản', 'Nvarchar2', 'GDMpLecTjBD1USC5qkPFdiRu7nNtgHuK7JIMXZOi', 'Là khóa bảo mật truyền vào khi gọi API tạo tài khoản');
/*!40000 ALTER TABLE `dm_tham_so_he_thong` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.don_vi
CREATE TABLE IF NOT EXISTS `don_vi` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ma_don_vi` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_don_vi` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ma_phuong_xa` int unsigned NOT NULL,
  `ma_cap` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ma_dinh_danh` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `co_dinh` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `di_dong` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int unsigned DEFAULT NULL,
  `order` int NOT NULL DEFAULT '1',
  `la_don_vi_xu_ly` int NOT NULL DEFAULT '0',
  `state` int NOT NULL DEFAULT '1' COMMENT '0: không hoạt động; 1: hoạt động',
  PRIMARY KEY (`id`),
  KEY `FK_don_vi_don_vi` (`parent_id`),
  KEY `order` (`order`),
  KEY `FK_don_vi_dm_phuong_xa` (`ma_phuong_xa`),
  CONSTRAINT `FK_don_vi_dm_phuong_xa` FOREIGN KEY (`ma_phuong_xa`) REFERENCES `dm_phuong_xa` (`ma_phuong_xa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_don_vi_don_vi` FOREIGN KEY (`parent_id`) REFERENCES `don_vi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.don_vi: ~25 rows (approximately)
/*!40000 ALTER TABLE `don_vi` DISABLE KEYS */;
INSERT INTO `don_vi` (`id`, `ma_don_vi`, `ten_don_vi`, `ma_phuong_xa`, `ma_cap`, `ma_dinh_danh`, `email`, `co_dinh`, `di_dong`, `fax`, `parent_id`, `order`, `la_don_vi_xu_ly`, `state`) VALUES
	(1, NULL, 'Tỉnh Trà Vinh', 29239, 'UBT', '000.00.00.H59', NULL, NULL, NULL, NULL, NULL, 0, 0, 1),
	(2, NULL, 'VNPT Trà Vinh', 29236, 'VTT', '000.00.01.H59', NULL, NULL, NULL, NULL, 1, 1, 0, 1),
	(12, NULL, 'Trung tâm Công nghệ Thông tin', 29236, 'TTCNTT', '000.01.01.H59', NULL, NULL, NULL, NULL, 2, 1, 0, 1),
	(13, NULL, 'Trung tâm Viễn Thông I', 29236, 'TTVT', '000.02.01.H59', NULL, NULL, NULL, NULL, 2, 1, 0, 1),
	(14, NULL, 'Trung tâm Viễn Thông II', 29236, 'TTVT', '000.03.01.H59', NULL, NULL, NULL, NULL, 2, 1, 0, 1),
	(15, NULL, 'Trung tâm Viễn Thông III', 29236, 'TTVT', '000.04.01.H59', NULL, NULL, NULL, NULL, 2, 1, 0, 1),
	(16, NULL, 'Viễn Thông TP.Trà Vinh', 29239, 'HUYEN', '001.02.01.H59', NULL, NULL, NULL, NULL, 13, 1, 0, 1),
	(17, NULL, 'Viễn Thông Châu Thành', 29374, 'HUYEN', '001.03.01.H59', NULL, NULL, NULL, NULL, 13, 1, 0, 1),
	(18, NULL, 'Phòng giải pháp', 29236, NULL, NULL, NULL, NULL, NULL, NULL, 12, 1, 0, 1),
	(19, NULL, 'Phòng tổng hợp', 29236, NULL, NULL, NULL, NULL, NULL, NULL, 12, 1, 0, 1),
	(20, NULL, 'Viễn Thông Cầu Kè', 29308, 'HUYEN', '001.03.01.H59', NULL, NULL, NULL, NULL, 14, 1, 0, 1),
	(21, NULL, 'Viễn Thông Càng Long', 29266, 'HUYEN', '001.03.01.H59', NULL, NULL, NULL, NULL, 14, 1, 0, 1),
	(22, NULL, 'Viễn Thông Trà Cú', 29461, 'HUYEN', '001.03.01.H59', NULL, NULL, NULL, NULL, 15, 1, 0, 1),
	(23, NULL, 'Viễn Thông Tiểu Cần', 29341, 'HUYEN', '001.03.01.H59', NULL, NULL, NULL, NULL, 15, 1, 0, 1),
	(24, NULL, 'Viễn Thông Cầu Ngang', 29416, 'HUYEN', '001.03.01.H59', NULL, NULL, NULL, NULL, 15, 1, 0, 1),
	(25, NULL, 'Viễn Thông huyện Duyên Hải', 29497, 'HUYEN', '001.03.01.H59', NULL, NULL, NULL, NULL, 15, 1, 0, 1),
	(26, NULL, 'Viễn Thông thị xã Duyên Hải', 29512, 'HUYEN', '001.03.01.H59', NULL, NULL, NULL, NULL, 15, 1, 0, 1),
	(27, NULL, 'Phòng 001', 29512, NULL, NULL, NULL, NULL, NULL, NULL, 16, 1, 0, 1),
	(28, NULL, 'Phòng 002', 29512, NULL, NULL, NULL, NULL, NULL, NULL, 16, 1, 0, 1),
	(29, NULL, 'Phòng 003', 29512, NULL, NULL, NULL, NULL, NULL, NULL, 16, 1, 0, 1),
	(31, NULL, 'Tổ tiếp nhận - TTVT 1', 29236, NULL, NULL, NULL, NULL, NULL, NULL, 13, 1, 0, 1),
	(32, NULL, 'Tổ xử lý - TTVT 1', 29236, NULL, NULL, NULL, NULL, NULL, NULL, 13, 1, 0, 1),
	(33, NULL, 'Tổ lãnh đạo - TTVT 1', 29236, NULL, NULL, NULL, NULL, NULL, NULL, 13, 1, 0, 1),
	(34, NULL, 'Ban giám đốc', 29236, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, 0, 1),
	(35, NULL, 'Tthị xã Duyên Hải', 29512, 'Xa', '001.03.01.H59', NULL, NULL, NULL, NULL, 26, 1, 0, 1);
/*!40000 ALTER TABLE `don_vi` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.migrations: ~5 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
	(2, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
	(3, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
	(4, '2016_06_01_000004_create_oauth_clients_table', 1),
	(5, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.nhom_chuc_vu
CREATE TABLE IF NOT EXISTS `nhom_chuc_vu` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ten_nhom_chuc_vu` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ma_nhom_chuc_vu` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `state` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `loai_nhom_chuc_vu` (`ma_nhom_chuc_vu`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.nhom_chuc_vu: ~4 rows (approximately)
/*!40000 ALTER TABLE `nhom_chuc_vu` DISABLE KEYS */;
INSERT INTO `nhom_chuc_vu` (`id`, `ten_nhom_chuc_vu`, `ma_nhom_chuc_vu`, `state`) VALUES
	(1, 'Khách hàng', 'KHACH_HANG', 1),
	(2, 'Lãnh đạo', 'LANH_DAO', 1),
	(3, 'Chuyên viên tiếp nhận', 'TIEP_NHAN', 1),
	(4, 'Chuyên viên xử lý', 'XU_LY', 1);
/*!40000 ALTER TABLE `nhom_chuc_vu` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.nhom_dich_vu
CREATE TABLE IF NOT EXISTS `nhom_dich_vu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ma_nhom_dich_vu` varchar(200) DEFAULT NULL,
  `ten_nhom_dich_vu` varchar(200) DEFAULT NULL,
  `state` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.nhom_dich_vu: ~2 rows (approximately)
/*!40000 ALTER TABLE `nhom_dich_vu` DISABLE KEYS */;
INSERT INTO `nhom_dich_vu` (`id`, `ma_nhom_dich_vu`, `ten_nhom_dich_vu`, `state`) VALUES
	(1, 'DV_VT', 'Dịch vụ Viễn Thông', 1),
	(2, 'DV_CNTT', 'Dịch vụ CNTT', 1);
/*!40000 ALTER TABLE `nhom_dich_vu` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.oauth_access_tokens
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `client_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.oauth_access_tokens: ~9 rows (approximately)
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
	('0722aea24ad957fb1448fc6528ba3013f2ed4efb44bfc1caf5c8c4e82251804bd0950c286db29ee5', 11, 1, 'Personal Access Token', '[]', 0, '2021-03-19 11:07:08', '2021-03-19 11:07:08', '2021-03-26 11:07:08'),
	('22edd3437e1d05ad0901b01237b7df55215bb93089bdea70eafe72a7b8f953da171bd651d193e64e', 11, 1, 'Personal Access Token', '[]', 0, '2021-03-23 16:13:30', '2021-03-23 16:13:30', '2021-03-30 16:13:30'),
	('5686828bc20556864bd052738a401e2d0e895e00e16ab87c3f0705219f58b6ca00b5b08fbdc9d942', 9, 1, 'Personal Access Token', '[]', 0, '2021-03-18 10:33:58', '2021-03-18 10:33:58', '2022-03-18 10:33:58'),
	('77ce018aaa53c802abf194d4d6704745be07c3406ffbbc00e95a9b9e1360f95a3c9e58d53f21c88d', 11, 1, 'Personal Access Token', '[]', 0, '2021-03-19 10:40:12', '2021-03-19 10:40:12', '2021-03-26 10:40:12'),
	('877cd02f5c4acd58baf85ac200d38c0535df43c5a7625cef75e25809176b7fb79cc3dbe33f44b8a3', 11, 1, 'Personal Access Token', '[]', 0, '2021-03-19 08:12:07', '2021-03-19 08:12:07', '2021-03-26 08:12:07'),
	('990c04b07a5843586c46fff54f46e7f2b6392cd42406a3b8840a7ce7bdfd3ca82cfe0a237df0b890', 11, 1, 'Personal Access Token', '[]', 0, '2021-03-23 16:10:19', '2021-03-23 16:10:19', '2021-03-30 16:10:19'),
	('9a29965f5024c73e086468fabdac6492b1c962a3803ab63f8922affdee4188aa0b83fc1c377040bd', 9, 1, 'Personal Access Token', '[]', 0, '2021-03-18 10:38:56', '2021-03-18 10:38:56', '2021-03-25 10:38:56'),
	('9ae100e46799c468a32d34bc57c61132d7590f22c0cb5007f02800aa8e13e3eb1d30a151bbe9e019', 11, 1, 'Personal Access Token', '[]', 1, '2021-03-19 08:34:02', '2021-03-19 08:34:02', '2021-03-26 08:34:02'),
	('aed24f6ecdec3a557c88aba2391958e580c4234115ff42b515ac5a84975def5865007c262af1ac0b', 10, 1, 'Personal Access Token', '[]', 0, '2021-03-18 10:44:37', '2021-03-18 10:44:37', '2021-03-25 10:44:37'),
	('c52ef8cbb9514919cb23ec7daca21f57ba072c58ae8e4285ff35918704402c037861cdb7fb72d65d', 11, 1, 'Personal Access Token', '[]', 0, '2021-03-23 16:15:45', '2021-03-23 16:15:45', '2021-03-30 16:15:45'),
	('e6a8b06ea0708cfd9552f270ff0346770a7d7a316df726255c995cf926e75db998bb34ee6502ec44', 9, 1, 'Personal Access Token', '[]', 1, '2021-03-18 10:37:52', '2021-03-18 10:37:52', '2021-03-25 10:37:52'),
	('ebf8f8380fa13a3405ea1145ecfc7731120c14b78ca0c928ef29a2db8153411f871beaa48a90ee89', 10, 1, 'Personal Access Token', '[]', 0, '2021-03-18 15:58:51', '2021-03-18 15:58:51', '2021-03-25 15:58:51');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.oauth_auth_codes
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `client_id` bigint unsigned NOT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.oauth_auth_codes: ~0 rows (approximately)
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.oauth_clients
CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.oauth_clients: ~2 rows (approximately)
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
	(1, NULL, 'Laravel Personal Access Client', 'GDMpLecTjBD1USC5qkPFdiRu7nNtgHuK7JIMXZOi', NULL, 'http://localhost', 1, 0, 0, '2021-03-18 09:02:45', '2021-03-18 09:02:45'),
	(2, NULL, 'Laravel Password Grant Client', '6eMBRuGn8LVJ2GIm5MrNGSZgLke36jBY5eq5uBHL', 'users', 'http://localhost', 0, 1, 0, '2021-03-18 09:02:45', '2021-03-18 09:02:45');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.oauth_personal_access_clients
CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.oauth_personal_access_clients: ~0 rows (approximately)
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
	(1, 1, '2021-03-18 09:02:45', '2021-03-18 09:02:45');
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.oauth_refresh_tokens
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.oauth_refresh_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user_tao` int unsigned NOT NULL,
  `id_dich_vu` int DEFAULT NULL,
  `so_phieu` varchar(200) DEFAULT NULL,
  `tieu_de` varchar(200) NOT NULL,
  `noi_dung` longtext,
  `file_payc` text,
  `ma_phuong_xa` int unsigned DEFAULT NULL,
  `vi_do` varchar(250) DEFAULT NULL,
  `kinh_do` varchar(250) DEFAULT NULL,
  `ngay_tao` datetime DEFAULT CURRENT_TIMESTAMP,
  `han_xu_ly_mong_muon` datetime DEFAULT NULL,
  `han_xu_ly_duoc_giao` datetime DEFAULT NULL,
  `ngay_hoan_tat` datetime DEFAULT NULL,
  `trang_thai` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_payc_users` (`id_user_tao`),
  KEY `FK_payc_dich_vu` (`id_dich_vu`),
  KEY `FK_payc_dm_phuong_xa` (`ma_phuong_xa`),
  CONSTRAINT `FK_payc_dich_vu` FOREIGN KEY (`id_dich_vu`) REFERENCES `dich_vu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payc_dm_phuong_xa` FOREIGN KEY (`ma_phuong_xa`) REFERENCES `dm_phuong_xa` (`ma_phuong_xa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payc_users` FOREIGN KEY (`id_user_tao`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.payc: ~16 rows (approximately)
/*!40000 ALTER TABLE `payc` DISABLE KEYS */;
INSERT INTO `payc` (`id`, `id_user_tao`, `id_dich_vu`, `so_phieu`, `tieu_de`, `noi_dung`, `file_payc`, `ma_phuong_xa`, `vi_do`, `kinh_do`, `ngay_tao`, `han_xu_ly_mong_muon`, `han_xu_ly_duoc_giao`, `ngay_hoan_tat`, `trang_thai`) VALUES
	(24, 2, 1, '150321-00011', 'Test 00111', '<p>1</p>', NULL, 29236, NULL, NULL, '2021-03-15 13:56:58', '2021-03-15 17:00:00', NULL, NULL, 1),
	(25, 2, 1, '150321-0025', 'Test 2', '<p><br></p>', NULL, 29236, NULL, NULL, '2021-03-15 14:56:51', '2021-03-15 17:00:00', NULL, NULL, 1),
	(26, 2, 1, '150321-0026', 'Test 2', '<p><br></p>', NULL, 29236, NULL, NULL, '2021-03-15 14:57:05', '2021-03-15 17:00:00', NULL, NULL, 1),
	(27, 2, 1, '150321-0027', 'Test 2', '<p><br></p>', NULL, 29236, NULL, NULL, '2021-03-15 14:57:11', '2021-03-15 17:00:00', NULL, NULL, 1),
	(28, 1, 1, '150321-0028', 'Test 2', '<p><br></p>', NULL, 29236, NULL, NULL, '2021-03-15 14:57:53', '2021-03-15 17:00:00', NULL, NULL, 1),
	(29, 6, 1, '150321-0029', 'Test 01', '<p><br></p>', NULL, 29512, NULL, NULL, '2021-03-15 16:30:46', '2021-03-15 17:00:00', NULL, NULL, 1),
	(30, 6, 1, '150321-0030', 'Test 01', '<p><br></p>', NULL, 29236, NULL, NULL, '2021-03-15 16:32:50', '2021-03-15 17:00:00', NULL, NULL, 1),
	(31, 10, 1, '190321-0008', 'Phan Văn Thanh test api', 'Test api chơi được không bạn', '29236', 29236, NULL, NULL, '2021-03-15 16:01:02', '2021-03-15 16:01:02', NULL, NULL, 1),
	(32, 10, 1, '190321-0009', 'Phan Văn Thanh test api', 'Test api chơi được không bạn', '', 29236, NULL, NULL, '2021-03-19 09:38:56', '2021-03-15 16:01:02', NULL, NULL, 1),
	(33, 1, 1, '190321-0010', 'Phan Văn Thanh test api', 'Test api chơi được không bạn', '', 29236, NULL, NULL, '2021-03-19 09:39:49', '2021-03-15 16:01:02', NULL, NULL, 1),
	(34, 10, 1, '190321-0011', 'Phan Văn Thanh test api', 'Test api chơi được không bạn', '', 29236, NULL, NULL, '2021-03-19 09:41:07', '2021-03-15 16:01:02', NULL, NULL, 1),
	(35, 1, 1, '190321-0012', 'Phan Văn Thanh test api', 'Test api chơi được không bạn', '', 29236, NULL, NULL, '2021-03-19 09:41:44', '2021-03-15 16:01:02', NULL, NULL, 1),
	(36, 1, 1, '190321-0013', 'Phan Văn Thanh test api', 'Test api chơi được không bạn', '', 29236, NULL, NULL, '2021-03-19 10:24:52', '2021-03-15 16:01:02', NULL, NULL, 1),
	(37, 1, 1, '190321-0014', 'Phan Văn Thanh test api', 'Test api chơi được không bạn', '', 29236, NULL, NULL, '2021-03-19 10:25:38', '2021-03-15 16:01:02', NULL, NULL, 1),
	(38, 1, 1, '190321-0015', 'Phan Văn Thanh test api', 'Test api chơi được không bạn', '', 29236, NULL, NULL, '2021-03-19 10:26:12', '2021-03-15 16:01:02', NULL, NULL, 1),
	(39, 1, 1, '190321-0016', 'Phan Văn Thanh test api', 'Test api chơi được không bạn', '', 29236, NULL, NULL, '2021-03-19 10:32:32', '2021-03-15 16:01:02', NULL, NULL, 1);
/*!40000 ALTER TABLE `payc` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.payc_can_bo_nhan
CREATE TABLE IF NOT EXISTS `payc_can_bo_nhan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_xu_ly_yeu_cau` int NOT NULL,
  `id_user_nhan` int unsigned NOT NULL,
  `ngay_nhan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `trang_thai` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_payc_can_bo_nhan_payc_canbo_xuly_yeucau` (`id_xu_ly_yeu_cau`),
  KEY `FK_payc_can_bo_nhan_users` (`id_user_nhan`),
  CONSTRAINT `FK_payc_can_bo_nhan_payc_canbo_xuly_yeucau` FOREIGN KEY (`id_xu_ly_yeu_cau`) REFERENCES `payc_xu_ly` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payc_can_bo_nhan_users` FOREIGN KEY (`id_user_nhan`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.payc_can_bo_nhan: ~31 rows (approximately)
/*!40000 ALTER TABLE `payc_can_bo_nhan` DISABLE KEYS */;
INSERT INTO `payc_can_bo_nhan` (`id`, `id_xu_ly_yeu_cau`, `id_user_nhan`, `ngay_nhan`, `trang_thai`) VALUES
	(4, 159, 6, '2021-03-15 13:56:58', 0),
	(5, 160, 3, '2021-03-15 14:24:03', 0),
	(6, 162, 3, '2021-03-15 14:46:01', 0),
	(7, 163, 3, '2021-03-15 14:47:19', 0),
	(8, 163, 6, '2021-03-15 14:47:19', 0),
	(9, 167, 6, '2021-03-15 14:57:53', 0),
	(10, 168, 3, '2021-03-15 15:01:05', 0),
	(11, 168, 6, '2021-03-15 15:01:05', 0),
	(12, 169, 3, '2021-03-15 15:01:57', 0),
	(13, 170, 7, '2021-03-15 15:06:46', 0),
	(14, 171, 7, '2021-03-15 15:06:56', 0),
	(20, 177, 7, '2021-03-15 15:33:33', 0),
	(21, 178, 7, '2021-03-15 15:36:27', 0),
	(22, 179, 6, '2021-03-15 15:36:42', 0),
	(23, 179, 3, '2021-03-15 15:36:42', 0),
	(24, 180, 7, '2021-03-15 15:42:41', 0),
	(25, 181, 7, '2021-03-15 15:45:43', 0),
	(26, 184, 6, '2021-03-15 16:32:50', 0),
	(27, 185, 7, '2021-03-15 16:33:02', 0),
	(28, 187, 6, '2021-03-15 16:49:21', 0),
	(29, 187, 3, '2021-03-15 16:49:21', 0),
	(30, 187, 6, '2021-03-15 16:49:21', 0),
	(31, 188, 6, '2021-03-19 09:36:37', 0),
	(32, 189, 6, '2021-03-19 09:38:55', 0),
	(33, 190, 6, '2021-03-19 09:39:48', 0),
	(34, 191, 6, '2021-03-19 09:41:07', 0),
	(35, 192, 6, '2021-03-19 09:41:43', 0),
	(36, 193, 6, '2021-03-19 10:24:52', 0),
	(37, 194, 6, '2021-03-19 10:25:37', 0),
	(38, 195, 6, '2021-03-19 10:26:11', 0),
	(39, 196, 6, '2021-03-19 10:32:32', 0);
/*!40000 ALTER TABLE `payc_can_bo_nhan` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.payc_trang_thai_xu_ly
CREATE TABLE IF NOT EXISTS `payc_trang_thai_xu_ly` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ma_trang_thai` varchar(200) DEFAULT NULL,
  `ten_trang_thai_xu_ly` varchar(200) DEFAULT NULL,
  `mo_ta` varchar(250) DEFAULT NULL,
  `order` int NOT NULL DEFAULT '1',
  `trang_thai` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ten_xu_ly` (`ten_trang_thai_xu_ly`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.payc_trang_thai_xu_ly: ~13 rows (approximately)
/*!40000 ALTER TABLE `payc_trang_thai_xu_ly` DISABLE KEYS */;
INSERT INTO `payc_trang_thai_xu_ly` (`id`, `ma_trang_thai`, `ten_trang_thai_xu_ly`, `mo_ta`, `order`, `trang_thai`) VALUES
	(1, 'TAO_MOI', 'Tạo mới PAYC', 'Khách hàng hoặc cán bộ tạo PAYC', 1, 1),
	(2, 'TIEP_NHAN', 'Tiếp nhận', 'Cán bộ tiếp nhận PAYC', 1, 1),
	(3, 'HOAN_TAT', 'Hoàn tất', 'Hoàn tất xử lý PAYC', 1, 1),
	(4, 'TRA_LAI_NGUOI_TAO', 'Trả lại khách hàng hoặc từ chối xử lý', 'Trả lại khách hàng hoặc từ chối xử lý', 1, 1),
	(5, 'CHUYEN_XU_LY', 'Chuyển xử lý', 'Chuyển bộ phận xử lý PAYC', 1, 1),
	(6, 'XU_LY', 'Xử lý', 'Cán bộ đang xử lý PAYC', 1, 1),
	(7, 'CHUYEN_LANH_DAO', 'Chuyển lãnh đạo', 'Chuyển lãnh đạo xử lý hoặc xin ý kiến lãnh đạo', 1, 1),
	(8, 'DUYET', 'Duyệt', 'Lãnh đạo duyệt PAYC', 1, 1),
	(9, 'CHUYEN_CAN_BO', 'Chuyển lại bộ phận tiếp nhận & xử lý yêu cầu', 'Chuyển lại cán bộ xử lý để xử lý lại hoặc chuyển lại cán bộ tiếp nhận để cập nhật thông tin', 1, 1),
	(10, 'HUY', 'Hủy', 'Hủy PAYC do khách hàng đã xử lý được hoặc không muốn yêu cầu tiếp', 1, 1),
	(11, 'KH_DANH_GIA', 'KH đánh giá', 'Khách hàng đánh giá phản ánh yêu cầu', 1, 1),
	(12, 'LD_DANH_GIA', 'LĐ đánh giá', 'Khách hàng đánh giá phản ánh yêu cầu', 1, 1),
	(13, 'CAP_NHAT', 'Cập nhật nội dung task', 'Cập nhật nội dung task', 1, 1);
/*!40000 ALTER TABLE `payc_trang_thai_xu_ly` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.payc_xu_ly
CREATE TABLE IF NOT EXISTS `payc_xu_ly` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_payc` int NOT NULL,
  `id_user_xu_ly` int unsigned NOT NULL,
  `id_xu_ly` int NOT NULL,
  `noi_dung_xu_ly` longtext,
  `file_xu_ly` text,
  `ngay_xu_ly` datetime DEFAULT CURRENT_TIMESTAMP,
  `state` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_payc_canbo_xuly_yeucau_payc` (`id_payc`),
  KEY `FK_payc_canbo_xuly_yeucau_users` (`id_user_xu_ly`),
  KEY `FK_payc_canbo_xuly_yeucau_payc_xu_ly` (`id_xu_ly`),
  CONSTRAINT `FK_payc_canbo_xuly_yeucau_payc` FOREIGN KEY (`id_payc`) REFERENCES `payc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payc_canbo_xuly_yeucau_payc_xu_ly` FOREIGN KEY (`id_xu_ly`) REFERENCES `payc_trang_thai_xu_ly` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payc_canbo_xuly_yeucau_users` FOREIGN KEY (`id_user_xu_ly`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.payc_xu_ly: ~32 rows (approximately)
/*!40000 ALTER TABLE `payc_xu_ly` DISABLE KEYS */;
INSERT INTO `payc_xu_ly` (`id`, `id_payc`, `id_user_xu_ly`, `id_xu_ly`, `noi_dung_xu_ly`, `file_xu_ly`, `ngay_xu_ly`, `state`) VALUES
	(159, 24, 2, 1, '', '', '2021-03-15 13:56:58', 0),
	(160, 24, 6, 5, NULL, NULL, '2021-03-15 14:24:03', 0),
	(161, 24, 3, 13, '<p><br></p>', '', '2021-03-15 14:33:11', 0),
	(162, 24, 3, 6, NULL, NULL, '2021-03-15 14:46:01', 0),
	(163, 24, 3, 6, NULL, NULL, '2021-03-15 14:47:19', 0),
	(164, 25, 2, 1, '', '', '2021-03-15 14:56:51', 0),
	(165, 26, 2, 1, '', '', '2021-03-15 14:57:05', 0),
	(166, 27, 2, 1, '', '', '2021-03-15 14:57:12', 0),
	(167, 28, 2, 1, '', '', '2021-03-15 14:57:53', 0),
	(168, 28, 6, 5, NULL, NULL, '2021-03-15 15:01:05', 0),
	(169, 28, 3, 6, NULL, NULL, '2021-03-15 15:01:57', 0),
	(170, 28, 3, 7, NULL, NULL, '2021-03-15 15:06:46', 0),
	(171, 24, 3, 7, NULL, NULL, '2021-03-15 15:06:56', 0),
	(177, 24, 7, 13, '<p>1</p>', '', '2021-03-15 15:33:33', 0),
	(178, 24, 7, 8, NULL, NULL, '2021-03-15 15:36:27', 0),
	(179, 24, 7, 8, NULL, NULL, '2021-03-15 15:36:42', 0),
	(180, 28, 7, 8, 'duyệt', NULL, '2021-03-15 15:42:41', 0),
	(181, 28, 7, 8, NULL, NULL, '2021-03-15 15:45:43', 0),
	(182, 28, 7, 9, NULL, NULL, '2021-03-15 15:48:02', 0),
	(183, 29, 6, 1, '', '', '2021-03-15 16:30:46', 0),
	(184, 30, 6, 1, '', '', '2021-03-15 16:32:50', 0),
	(185, 30, 6, 7, NULL, NULL, '2021-03-15 16:33:02', 0),
	(187, 30, 7, 9, NULL, NULL, '2021-03-15 16:49:21', 0),
	(188, 31, 10, 1, '', '', '2021-03-19 09:36:37', 0),
	(189, 32, 10, 1, '', '', '2021-03-19 09:38:55', 0),
	(190, 33, 1, 1, '', '', '2021-03-19 09:39:48', 0),
	(191, 34, 10, 1, '', '', '2021-03-19 09:41:06', 0),
	(192, 35, 1, 1, '', '', '2021-03-19 09:41:43', 0),
	(193, 36, 1, 1, '', '', '2021-03-19 10:24:51', 0),
	(194, 37, 1, 1, '', '', '2021-03-19 10:25:37', 0),
	(195, 38, 1, 1, '', '', '2021-03-19 10:26:11', 0),
	(196, 39, 1, 1, '', '', '2021-03-19 10:32:31', 0);
/*!40000 ALTER TABLE `payc_xu_ly` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.to_do: ~13 rows (approximately)
/*!40000 ALTER TABLE `to_do` DISABLE KEYS */;
INSERT INTO `to_do` (`id`, `id_user`, `noi_dung`, `file`, `ngay_tao`, `ngay_giao`, `han_xu_ly`, `ngay_hoan_thanh`, `sap_xep`, `trang_thai`) VALUES
	(1, 2, 'test2', NULL, '2021-02-04 14:43:11', '2021-02-04 14:43:11', '2021-02-04 10:00:01', NULL, 8, 1),
	(3, 1, 'Công việc 1', NULL, '2021-02-18 08:07:39', '2021-02-18 08:07:39', '2021-03-01 10:10:00', '2021-02-19 16:16:34', 1, 0),
	(5, 1, 'Công việc 3', NULL, '2021-02-18 08:07:51', '2021-02-18 08:07:51', '2021-03-01 22:00:00', NULL, 4, 1),
	(6, 1, 'Công việc 4', NULL, '2021-02-18 08:07:57', '2021-02-18 08:07:57', '2021-03-01 10:05:00', '2021-03-04 14:35:57', 5, 0),
	(7, 1, 'Công việc 5', NULL, '2021-02-18 08:08:06', '2021-02-18 08:08:06', '2021-03-01 10:00:00', NULL, 6, 0),
	(8, 1, 'Công việc 6', NULL, '2021-02-18 16:31:46', '2021-02-18 16:31:46', '2021-02-20 10:00:00', '2021-03-05 14:10:14', 7, 1),
	(9, 1, 'Công việc 7', NULL, '2021-02-18 16:32:31', '2021-02-18 16:32:31', NULL, NULL, 9, 1),
	(10, 1, 'Công việc 8', NULL, '2021-02-18 16:37:53', '2021-02-18 16:37:53', '2021-02-20 10:00:00', '2021-02-22 10:05:47', 10, 1),
	(12, 2, 'test', NULL, '2021-02-19 10:29:44', '2021-02-19 10:29:44', '2021-02-20 10:00:00', '2021-02-22 10:32:16', 11, 1),
	(14, 1, 'test3', NULL, '2021-03-08 14:51:11', '2021-03-08 14:51:11', '2021-03-09 13:51:00', '2021-03-08 16:07:34', 2, 1),
	(17, 1, 'eaaaa', NULL, '2021-03-08 16:10:34', '2021-03-08 16:10:34', '2021-03-11 16:10:00', '2021-03-08 16:16:20', 3, 1),
	(18, 2, 'Thanh test', NULL, '2021-03-08 16:17:49', '2021-03-08 16:17:49', '2021-03-08 16:17:00', '2021-03-08 16:40:30', 0, 1),
	(23, 2, 'test', NULL, '2021-03-08 16:25:54', '2021-03-08 16:25:54', '2021-03-08 16:25:00', NULL, 0, 1);
/*!40000 ALTER TABLE `to_do` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hinh_anh` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '/user.png',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `di_dong` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` int DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.users: ~10 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `hinh_anh`, `remember_token`, `created_at`, `updated_at`, `di_dong`, `state`) VALUES
	(1, 'Chế độ ẩn danh', 'guest', '$2y$10$VZI0siYq7lRPvqt8e.QbXOWDBelj91YwJoLsEKx4GxbWH5XQb87xO', '/user.png', '35xOWSUdceM6lRhePiHS9Y3xwvvLupgJWeYIzh2FMjMl22RuUJURMmX7oElG', NULL, '2021-03-03 13:42:55', '0941138484', 1),
	(2, 'Quản trị hệ thống', 'admin', '$2y$10$VZI0siYq7lRPvqt8e.QbXOWDBelj91YwJoLsEKx4GxbWH5XQb87xO', '/user.png', 'h0MGlflucDADDWUTxBhZKoSzbL4AtIlBnVZiLB2SJ4oAq6eqgEMqh5SY1qJZ', NULL, '2021-03-15 15:36:50', '0941138484', 1),
	(3, 'Trần Thị Thanh Mỹ', 'tttmy.tvh', '$2y$10$VZI0siYq7lRPvqt8e.QbXOWDBelj91YwJoLsEKx4GxbWH5XQb87xO', '/user.png', '2VL7V5IJ5oyynFEszYPlIcjBgSqtNL9x9glcRe4JRHHtkweEMeePq0gk6nrx', NULL, '2021-03-15 15:06:59', '0941138484', 1),
	(6, 'Phan Văn Thanh', 'thanhpv.tvh', '$2y$10$VZI0siYq7lRPvqt8e.QbXOWDBelj91YwJoLsEKx4GxbWH5XQb87xO', '/user.png', NULL, '2021-03-15 10:52:12', '2021-03-15 13:38:20', '0911123234', 1),
	(7, 'Nguyễn Chí Thanh', 'thanhnc.tvh', '$2y$10$VZI0siYq7lRPvqt8e.QbXOWDBelj91YwJoLsEKx4GxbWH5XQb87xO', '/user.png', NULL, '2021-03-15 10:52:12', '2021-03-15 15:07:27', '0911123234', 1),
	(8, 'Phạm Kim Tín', 'tinpk.tvh', '$2y$10$ZFnG0PHNMukCTzFoSJpzGOzK1o9K8fMZOtFMtYWecdULn6tbbvALe', '/user.png', NULL, '2021-03-16 08:35:21', '2021-03-16 08:35:21', '0944564033', 1),
	(9, 'Phan Văn Thanh', 'p.thanhit@gmail.com', '$2y$10$MfNiHOroU.Qf08k9MFc8D.amoOVSAoaRhc5s/Q4w0WivVeObNhMQW', '/user.png', NULL, '2021-03-18 10:28:58', '2021-03-18 10:28:58', NULL, 1),
	(10, 'Phan Văn Thanh', 'ngochtb.tvh', '$2y$10$mB/AcU8GPxu2csmglNmE1uec4ad.mSuNvG7QSvqr8SGtAS.uSl8lC', '/user.png', NULL, '2021-03-18 10:42:13', '2021-03-18 10:42:13', NULL, 1),
	(11, 'Phan Văn Thanh', 'minhbn.tvh', '$2y$10$q2z32V6ff3QLNZyJFWB3pejgSVj.8LLHWXnXOzUof9Yp5.lD9dtSm', '/user.png', NULL, '2021-03-18 10:49:47', '2021-03-18 10:49:47', NULL, 1),
	(12, 'Test 2', 'test2', '$2y$10$yREo9qvK6EXDoYAADuN3GuOOUfXFbJdSjoAzV8L9IsTYCkzmBpxL6', '/user.png', NULL, '2021-03-22 10:26:08', '2021-03-22 10:26:08', '0944564033', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.users_dich_vu
CREATE TABLE IF NOT EXISTS `users_dich_vu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int unsigned NOT NULL,
  `id_dich_vu` int DEFAULT NULL,
  `tu_ngay` date DEFAULT NULL,
  `den_ngay` date DEFAULT NULL,
  `state` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_users_dich_vu_users` (`id_user`),
  KEY `FK_users_dich_vu_dich_vu` (`id_dich_vu`),
  CONSTRAINT `FK_users_dich_vu_dich_vu` FOREIGN KEY (`id_dich_vu`) REFERENCES `dich_vu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_users_dich_vu_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.users_dich_vu: ~3 rows (approximately)
/*!40000 ALTER TABLE `users_dich_vu` DISABLE KEYS */;
INSERT INTO `users_dich_vu` (`id`, `id_user`, `id_dich_vu`, `tu_ngay`, `den_ngay`, `state`) VALUES
	(13, 3, 1, NULL, NULL, 1),
	(16, 6, 1, NULL, NULL, 1),
	(17, 7, 1, NULL, NULL, 1);
/*!40000 ALTER TABLE `users_dich_vu` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.users_don_vi
CREATE TABLE IF NOT EXISTS `users_don_vi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_don_vi` int unsigned NOT NULL,
  `id_user` int unsigned NOT NULL,
  `id_chuc_danh` int unsigned NOT NULL DEFAULT '1',
  `id_chuc_vu` int unsigned NOT NULL DEFAULT '1',
  `cap` int DEFAULT '2' COMMENT '1 cấp tỉnh; 2 cấp huyện; 3 cấp xã',
  `ngay_bat_dau_cong_tac` datetime DEFAULT CURRENT_TIMESTAMP,
  `ngay_ket_thuc_cong_tac` datetime DEFAULT NULL,
  `state` int unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_users_don_vi_users` (`id_user`),
  KEY `FK_users_don_vi_don_vi` (`id_don_vi`),
  KEY `FK_users_don_vi_chuc_danh` (`id_chuc_danh`),
  KEY `FK_users_don_vi_chuc_vu` (`id_chuc_vu`),
  CONSTRAINT `FK_users_don_vi_chuc_danh` FOREIGN KEY (`id_chuc_danh`) REFERENCES `chuc_danh` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_users_don_vi_chuc_vu` FOREIGN KEY (`id_chuc_vu`) REFERENCES `chuc_vu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_users_don_vi_don_vi` FOREIGN KEY (`id_don_vi`) REFERENCES `don_vi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_users_don_vi_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.users_don_vi: ~7 rows (approximately)
/*!40000 ALTER TABLE `users_don_vi` DISABLE KEYS */;
INSERT INTO `users_don_vi` (`id`, `id_don_vi`, `id_user`, `id_chuc_danh`, `id_chuc_vu`, `cap`, `ngay_bat_dau_cong_tac`, `ngay_ket_thuc_cong_tac`, `state`) VALUES
	(14, 27, 6, 1, 3, 2, '2021-03-15 13:27:35', NULL, 1),
	(15, 27, 7, 1, 2, 2, '2021-03-15 13:27:35', NULL, 1),
	(16, 27, 3, 1, 4, 2, '2021-03-15 13:27:35', NULL, 1),
	(17, 27, 6, 1, 4, 2, '2021-03-15 13:27:35', NULL, 1),
	(18, 18, 8, 2, 3, 1, '2021-03-01 00:00:00', '2021-03-19 00:00:00', 1),
	(19, 19, 8, 1, 3, 0, '2021-03-01 00:00:00', '2021-03-22 00:00:00', 1),
	(20, 31, 12, 1, 4, 3, '2021-03-01 00:00:00', '2021-03-22 00:00:00', 1);
/*!40000 ALTER TABLE `users_don_vi` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.users_role
CREATE TABLE IF NOT EXISTS `users_role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `role_id` int unsigned NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_role_id` (`user_id`,`role_id`),
  KEY `FK_users_role_admin_role` (`role_id`),
  CONSTRAINT `FK_users_role_admin_role` FOREIGN KEY (`role_id`) REFERENCES `admin_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_users_role_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.users_role: ~2 rows (approximately)
/*!40000 ALTER TABLE `users_role` DISABLE KEYS */;
INSERT INTO `users_role` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '2021-03-17 11:02:46', '2021-03-17 11:02:47'),
	(2, 2, 2, '2021-03-17 11:02:46', '2021-03-17 15:42:16');
/*!40000 ALTER TABLE `users_role` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

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
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `uri` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `show_menu` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `icon` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_resource_parent_foreign` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1065 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.admin_resource: ~125 rows (approximately)
/*!40000 ALTER TABLE `admin_resource` DISABLE KEYS */;
INSERT INTO `admin_resource` (`id`, `ten_hien_thi`, `resource`, `method`, `action`, `parameter`, `parameter_value`, `parent_id`, `created_at`, `updated_at`, `uri`, `status`, `show_menu`, `order`, `icon`) VALUES
	(1, 'Root', 'Root', 'GET', '#', '#', '#', NULL, '2021-02-01 09:49:23', '2021-02-02 08:33:17', '#', 1, 1, 0, NULL),
	(872, 'Đăng nhập', 'GET | App\\Http\\Controllers\\Auth\\LoginController@showLoginForm', 'GET', 'App\\Http\\Controllers\\Auth\\LoginController@showLoginForm', '', '', 1, '2021-03-12 16:43:45', '2021-04-19 14:43:12', 'login', 1, 2, 19, '<i class="fa fa-lock menu-icon"></i>'),
	(873, 'Nút đăng nhập', 'POST | App\\Http\\Controllers\\Auth\\LoginController@login', 'POST', 'App\\Http\\Controllers\\Auth\\LoginController@login', '', '', 872, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'login', 1, 2, 1000, NULL),
	(874, 'Đăng xuất', 'POST | App\\Http\\Controllers\\Auth\\LoginController@logout', 'POST', 'App\\Http\\Controllers\\Auth\\LoginController@logout', '', '', 1, '2021-03-12 16:43:45', '2021-04-09 17:11:14', 'logout', 1, 2, 20, '<i class="fa fa-unlock menu-icon"></i>'),
	(875, 'Đăng ký', 'GET | App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm', 'GET', 'App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm', '', '', 1, '2021-03-12 16:43:45', '2021-04-19 14:43:19', 'register', 1, 2, 19, '<i class="fa fa-vcard-o menu-icon"></i>'),
	(876, 'Nút đăng ký', 'POST | App\\Http\\Controllers\\Auth\\RegisterController@register', 'POST', 'App\\Http\\Controllers\\Auth\\RegisterController@register', '', '', 875, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'register', 1, 2, 1000, NULL),
	(877, 'Reset mật khẩu', 'GET | App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm', 'GET', 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm', '', '', 1, '2021-03-12 16:43:45', '2021-04-19 14:43:38', 'password/reset', 1, 2, 21, '<i class="fa fa-refresh menu-icon"></i>'),
	(878, 'password/email', 'POST | App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail', 'POST', 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail', '', '', 877, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'password/email', 1, 2, 1000, NULL),
	(879, 'Lấy token reset mật khẩu', 'GET | App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm', 'GET', 'App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm', '', '', 877, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'password/reset/{token}', 1, 2, 1000, NULL),
	(880, 'password/reset', 'POST | App\\Http\\Controllers\\Auth\\ResetPasswordController@reset', 'POST', 'App\\Http\\Controllers\\Auth\\ResetPasswordController@reset', '', '', 877, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'password/reset', 1, 2, 1000, NULL),
	(881, 'Xác nhận lại mật khẩu', 'GET | App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm', 'GET', 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm', '', '', 877, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'password/confirm', 1, 2, 1000, NULL),
	(882, 'password/confirm', 'POST | App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm', 'POST', 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm', '', '', 877, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'password/confirm', 1, 2, 1000, NULL),
	(883, 'Danh mục phường xã', 'GET | App\\Modules\\DmPhuongXa\\Controllers\\DmPhuongXaController@dmPhuongXa', 'GET', 'App\\Modules\\DmPhuongXa\\Controllers\\DmPhuongXaController@dmPhuongXa', '', '', 1, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'dm-phuong-xa', 1, 1, 18, '<i class="menu-icon icon-location-pin"></i>'),
	(884, 'Import danh mục phường xã', 'POST | App\\Modules\\DmPhuongXa\\Controllers\\DmPhuongXaController@dmPhuongXaAndImport', 'POST', 'App\\Modules\\DmPhuongXa\\Controllers\\DmPhuongXaController@dmPhuongXaAndImport', '', '', 883, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'dm-phuong-xa/import', 1, 2, 1000, NULL),
	(885, 'Danh mục quận huyện', 'GET | App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyen', 'GET', 'App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyen', '', '', 1, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'dm-quan-huyen', 1, 1, 17, '<i class="menu-icon icon-location-pin"></i>'),
	(886, 'Import danh mục quận/huyện', 'POST | App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyenAndImport', 'POST', 'App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyenAndImport', '', '', 885, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'dm-quan-huyen/import', 1, 2, 1000, NULL),
	(887, 'Đơn vị', 'GET | App\\Modules\\DonVi\\Controllers\\DonViController@donVi', 'GET', 'App\\Modules\\DonVi\\Controllers\\DonViController@donVi', '', '', 1, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'don-vi', 1, 1, 15, '<i class="fa fa-university menu-icon"></i>'),
	(888, 'Xem danh sách đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@danhSachDonVi', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@danhSachDonVi', '', '', 887, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'danh-sach-don-vi', 1, 2, 1000, NULL),
	(889, 'Thêm đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@themDonVi', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@themDonVi', '', '', 887, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'them-don-vi', 1, 2, 1000, NULL),
	(890, 'Load thông tin đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@donViSingle', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@donViSingle', '', '', 887, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'don-vi-single', 1, 2, 1000, NULL),
	(891, 'Cập nhật đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@capNhatDonVi', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@capNhatDonVi', '', '', 887, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'cap-nhat-don-vi', 1, 2, 1000, NULL),
	(892, 'Xóa đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@xoaDonVi', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@xoaDonVi', '', '', 887, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'xoa-don-vi', 1, 2, 1000, NULL),
	(893, 'Nhóm quyền', 'GET | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@nhomQuyen', 'GET', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@nhomQuyen', '', '', 1, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'nhom-quyen', 1, 1, 13, '<i class="fa fa-database menu-icon"></i>'),
	(894, 'Xem danh sách nhóm quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@danhSachNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@danhSachNhomQuyen', '', '', 893, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'danh-sach-nhom-quyen', 1, 2, 1000, NULL),
	(895, 'Thêm nhóm quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@themNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@themNhomQuyen', '', '', 893, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'them-nhom-quyen', 1, 2, 1000, NULL),
	(896, 'Load thông tin nhóm quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@nhomQuyenSingle', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@nhomQuyenSingle', '', '', 893, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'nhom-quyen-single', 1, 2, 1000, NULL),
	(897, 'Cập nhật nhóm quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@capNhatNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@capNhatNhomQuyen', '', '', 893, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'cap-nhat-nhom-quyen', 1, 2, 1000, NULL),
	(898, 'Xóa nhóm quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@xoaNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@xoaNhomQuyen', '', '', 893, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'xoa-nhom-quyen', 1, 2, 1000, NULL),
	(899, 'Phân quyền', 'GET | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyen', 'GET', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyen', '', '', 1, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'phan-quyen', 1, 1, 14, '<i class="fa fa-cogs menu-icon"></i>'),
	(900, 'Lưu thông tin quyền', 'POST | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenPost', 'POST', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenPost', '', '', 899, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'phan-quyen-post', 1, 2, 1000, NULL),
	(901, 'Load danh sách nhóm quyền', 'POST | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachNhomQuyen', 'POST', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachNhomQuyen', '', '', 899, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'phan-quyen/danh-sach-nhom-quyen', 1, 2, 1000, NULL),
	(902, 'Load danh sách quyền', 'POST | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachQuyenTheoNhomQuyenId', 'POST', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachQuyenTheoNhomQuyenId', '', '', 899, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'phan-quyen/danh-sach-quyen-theo-nhom-quyen-id', 1, 2, 1000, NULL),
	(903, 'Danh mục chức năng', 'GET | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyen', 'GET', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyen', '', '', 1, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'tai-nguyen', 1, 1, 16, '<i class="menu-icon icon-list"></i>'),
	(904, 'Xem danh sách tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@danhSachTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@danhSachTaiNguyen', '', '', 903, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'danh-sach-tai-nguyen', 1, 2, 1000, NULL),
	(905, 'Quét tài nguyên hệ thống', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@quetTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@quetTaiNguyen', '', '', 903, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'quet-tai-nguyen', 1, 2, 1000, NULL),
	(906, 'Thêm tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@themTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@themTaiNguyen', '', '', 903, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'them-tai-nguyen', 1, 2, 1000, NULL),
	(907, 'Load thông tin tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyenSingle', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyenSingle', '', '', 903, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'tai-nguyen-single', 1, 2, 1000, NULL),
	(908, 'Cập nhật tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@capNhatTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@capNhatTaiNguyen', '', '', 903, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'cap-nhat-tai-nguyen', 1, 2, 1000, NULL),
	(909, 'Xóa tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@xoaTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@xoaTaiNguyen', '', '', 903, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'xoa-tai-nguyen', 1, 2, 1000, NULL),
	(910, 'Trang chủ', 'GET | App\\Modules\\TrangChu\\Controllers\\TrangChuController@home', 'GET', 'App\\Modules\\TrangChu\\Controllers\\TrangChuController@home', '', '', 1, '2021-03-12 16:43:45', '2021-04-09 17:09:00', '/', 1, 1, 1, '<i class="fa fa-home menu-icon"></i>'),
	(912, 'Xem danh sách tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@danhSachUser', 'POST', 'App\\Modules\\User\\Controllers\\UserController@danhSachUser', '', '', 911, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'danh-sach-user', 1, 2, 1000, NULL),
	(913, 'Tạo tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@themUser', 'POST', 'App\\Modules\\User\\Controllers\\UserController@themUser', '', '', 911, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'them-user', 1, 2, 1000, NULL),
	(914, 'Load thông tin tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@userSingle', 'POST', 'App\\Modules\\User\\Controllers\\UserController@userSingle', '', '', 911, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'user-single', 1, 2, 1000, NULL),
	(915, 'Cập nhật tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@capNhatUser', 'POST', 'App\\Modules\\User\\Controllers\\UserController@capNhatUser', '', '', 911, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'cap-nhat-user', 1, 2, 1000, NULL),
	(916, 'Xóa tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@xoaUser', 'POST', 'App\\Modules\\User\\Controllers\\UserController@xoaUser', '', '', 911, '2021-03-12 16:43:45', '2021-04-09 17:09:00', 'xoa-user', 1, 2, 1000, NULL),
	(964, 'Gửi PAKN', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@payc', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@payc', '', '', 1, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'payc', 1, 1, 2, '<i class="fa fa-paper-plane menu-icon"></i>'),
	(965, 'PAKN của tôi', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycCuaToi', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycCuaToi', '', '', 1, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'danh-sach-payc-cua-toi', 1, 1, 4, '<i class="fa fa-shield menu-icon"></i>'),
	(966, 'PAKN chờ tiếp nhận', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoTiepNhan', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoTiepNhan', '', '', 1006, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'danh-sach-payc-cho-tiep-nhan', 1, 1, 1000, NULL),
	(967, 'Form tiếp nhận và chuyển xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmTiepNhanVaChuyenXuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmTiepNhanVaChuyenXuLy', '', '', 1006, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'frm-tiep-nhan-va-chuyen-xu-ly', 1, 2, 1000, NULL),
	(968, 'Tiếp nhận và chuyển xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@tiepNhanVaChuyenXuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@tiepNhanVaChuyenXuLy', '', '', 967, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'tiep-nhan-va-chuyen-xu-ly', 1, 2, 1000, NULL),
	(969, 'PAKN chờ xử lý', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoXuLy', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoXuLy', '', '', 1006, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'danh-sach-payc-cho-xu-ly', 1, 1, 1000, NULL),
	(970, 'Form xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmXuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmXuLy', '', '', 1006, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'frm-xu-ly', 1, 2, 1000, NULL),
	(971, 'Xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@xuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@xuLy', '', '', 970, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'xu-ly', 1, 2, 1000, NULL),
	(972, 'PAKN chờ duyệt', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoDuyet', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoDuyet', '', '', 1006, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'danh-sach-payc-cho-duyet', 1, 1, 1000, NULL),
	(973, 'Frm duyệt', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmDuyet', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmDuyet', '', '', 1006, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'frm-duyet', 1, 2, 1000, NULL),
	(974, 'Duyệt', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@duyet', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@duyet', '', '', 973, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'duyet', 1, 2, 1000, NULL),
	(975, 'Form chuyển bộ phận tiếp nhận & xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmChuyenBoPhanTiepNhanVaXuLyPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmChuyenBoPhanTiepNhanVaXuLyPayc', '', '', 1006, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'frm-chuyen-bo-phan-tiep-nhan-va-xu-ly-payc', 1, 2, 1000, NULL),
	(976, 'Chuyển bộ phận tiếp nhận & xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@chuyenBoPhanTiepNhanVaXuLyPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@chuyenBoPhanTiepNhanVaXuLyPayc', '', '', 975, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'chuyen-bo-phan-tiep-nhan-va-xu-ly-payc', 1, 2, 1000, NULL),
	(977, 'Form chuyển lãnh đạo', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmChuyenLanhDao', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmChuyenLanhDao', '', '', 1006, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'frm-chuyen-lanh-dao', 1, 2, 1000, NULL),
	(978, 'Chuyển lãnh đạo', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@chuyenLanhDao', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@chuyenLanhDao', '', '', 977, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'chuyen-lanh-dao', 1, 2, 1000, NULL),
	(979, 'Form chuyển cấp trên', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmChuyenCapTren', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmChuyenCapTren', '', '', 1006, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'frm-chuyen-cap-tren', 1, 2, 1000, NULL),
	(980, 'Chuyển cấp trên', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@chuyenCapTren', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@chuyenCapTren', '', '', 979, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'chuyen-cap-tren', 1, 2, 1000, NULL),
	(981, 'Form hoàn tất xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmHoanTat', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmHoanTat', '', '', 1006, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'frm-hoan-tat', 1, 2, 1000, NULL),
	(982, 'Hoàn tất xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@hoanTat', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@hoanTat', '', '', 981, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'hoan-tat', 1, 2, 1000, NULL),
	(983, 'From trả PAKN lại (Không xử lý)', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmTraLaiKhongXuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmTraLaiKhongXuLy', '', '', 1006, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'frm-tra-lai-khong-xu-ly', 1, 2, 1000, NULL),
	(984, 'Trả lại PAKN không xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@traLaiKhongXuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@traLaiKhongXuLy', '', '', 983, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'tra-lai-khong-xu-ly', 1, 2, 1000, NULL),
	(985, 'Form hủy PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmHuy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmHuy', '', '', 1006, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'frm-huy', 1, 2, 1000, NULL),
	(986, 'Hủy PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@huy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@huy', '', '', 985, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'huy', 1, 2, 1000, NULL),
	(987, 'Form cập nhật PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmCapNhatPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmCapNhatPayc', '', '', 1006, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'frm-cap-nhat-payc', 1, 2, 1000, NULL),
	(988, 'Cập nhật PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@capNhatPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@capNhatPayc', '', '', 987, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'cap-nhat-payc', 1, 2, 1000, NULL),
	(989, 'PAKN đã hoàn tất xử lý', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycDaHoanTat', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycDaHoanTat', '', '', 1006, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'danh-sach-payc-da-hoan-tat', 1, 1, 1000, NULL),
	(990, 'Chuyển khách hàng đánh giá', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@chuyenKHDanhGia', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@chuyenKHDanhGia', '', '', 1006, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'chuyen-kh-danh-gia', 1, 2, 1000, NULL),
	(991, 'Đánh giá PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@danhGia', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@danhGia', '', '', 1006, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'danh-gia', 1, 2, 1000, NULL),
	(992, 'Quá trình xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@qtxl', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@qtxl', '', '', 1006, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'qtxl', 1, 2, 1000, NULL),
	(993, 'Thêm PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@themPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@themPayc', '', '', 964, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'them-payc', 1, 2, 1000, NULL),
	(994, 'PAKN theo tài khoản', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycTheoTaiKhoan', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycTheoTaiKhoan', '', '', 1006, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'danh-sach-payc-theo-tai-khoan', 1, 1, 1000, NULL),
	(995, 'PAKN chưa thụ lý', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChuaCoCanBoNhan', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChuaCoCanBoNhan', '', '', 1006, '2021-03-17 08:35:39', '2021-04-09 17:09:00', 'danh-sach-payc-chua-co-can-bo-nhan', 1, 1, 1000, NULL),
	(996, 'Ghi chú công việc (To do)', 'GET | App\\Modules\\ToDo\\Controllers\\ToDoController@toDo', 'GET', 'App\\Modules\\ToDo\\Controllers\\ToDoController@toDo', '', '', 1, '2021-03-17 08:35:40', '2021-04-09 17:09:00', 'to-do', 1, 1, 6, '<i class="fa fa-clock-o menu-icon"></i>'),
	(997, 'Xem danh sách ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@danhSachToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@danhSachToDo', '', '', 996, '2021-03-17 08:35:40', '2021-04-09 17:09:00', 'danh-sach-to-do', 1, 2, 1000, NULL),
	(998, 'Thêm ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@themToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@themToDo', '', '', 996, '2021-03-17 08:35:40', '2021-04-09 17:09:00', 'them-to-do', 1, 2, 1000, NULL),
	(999, 'Load thông tin ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@toDoSingle', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@toDoSingle', '', '', 996, '2021-03-17 08:35:40', '2021-04-09 17:09:00', 'to-do-single', 1, 2, 1000, NULL),
	(1000, 'Cập nhật ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@capNhatToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@capNhatToDo', '', '', 996, '2021-03-17 08:35:40', '2021-04-09 17:09:00', 'cap-nhat-to-do', 1, 2, 1000, NULL),
	(1001, 'Xóa ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@xoaToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@xoaToDo', '', '', 996, '2021-03-17 08:35:40', '2021-04-09 17:09:00', 'xoa-to-do', 1, 2, 1000, NULL),
	(1003, 'Gạch ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@checkToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@checkToDo', '', '', 996, '2021-03-17 08:35:40', '2021-04-09 17:09:00', 'check-to-do', 1, 2, 1000, NULL),
	(1004, 'Bỏ gạch ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@uncheckToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@uncheckToDo', '', '', 996, '2021-03-17 08:35:40', '2021-04-09 17:09:00', 'uncheck-to-do', 1, 2, 1000, NULL),
	(1005, 'Sắp xếp lại ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@sortToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@sortToDo', '', '', 996, '2021-03-17 08:35:40', '2021-04-09 17:09:00', 'sort-to-do', 1, 2, 1000, NULL),
	(1006, 'Xử lý PAKN', NULL, 'GET', NULL, NULL, NULL, 1, '2021-03-17 08:52:37', '2021-04-09 16:38:54', NULL, 1, 1, 3, '<i class="fa fa-keyboard-o menu-icon"></i>'),
	(1025, 'API đăng nhập', 'POST | App\\Modules\\API\\Controllers\\PassportAuthController@apiDangNhap', 'POST', 'App\\Modules\\API\\Controllers\\PassportAuthController@apiDangNhap', '', '', 1064, '2021-03-25 10:19:24', '2021-04-19 14:45:43', 'api/auth/api-dang-nhap', 1, 1, 1000, NULL),
	(1026, 'API tạo tài khoản', 'POST | App\\Modules\\API\\Controllers\\PassportAuthController@apiTaoTaiKhoan', 'POST', 'App\\Modules\\API\\Controllers\\PassportAuthController@apiTaoTaiKhoan', '', '', 1064, '2021-03-25 10:19:24', '2021-04-19 14:45:50', 'api/auth/api-tao-tai-khoan', 1, 1, 1000, NULL),
	(1027, 'API đăng xuất', 'GET | App\\Modules\\API\\Controllers\\PassportAuthController@apiDangXuat', 'GET', 'App\\Modules\\API\\Controllers\\PassportAuthController@apiDangXuat', '', '', 1064, '2021-03-25 10:19:24', '2021-04-19 14:45:31', 'api/auth/api-dang-xuat', 1, 1, 1000, NULL),
	(1028, 'API lấy thông tin tài khoản', 'GET | App\\Modules\\API\\Controllers\\PassportAuthController@apiGetUser', 'GET', 'App\\Modules\\API\\Controllers\\PassportAuthController@apiGetUser', '', '', 1064, '2021-03-25 10:19:24', '2021-04-19 14:46:33', 'api/auth/api-get-user', 1, 1, 1000, NULL),
	(1030, 'API gửi PAKN', 'POST | App\\Modules\\API\\Controllers\\ApiPaycController@apiGuiPakn', 'POST', 'App\\Modules\\API\\Controllers\\ApiPaycController@apiGuiPakn', '', '', 1064, '2021-03-25 10:19:24', '2021-04-19 14:46:50', 'api/api-gui-pakn', 1, 1, 1000, NULL),
	(1031, 'API lấy danh mục dịch vụ', 'GET | App\\Modules\\API\\Controllers\\ApiDichVuController@layDanhMucDichVu', 'GET', 'App\\Modules\\API\\Controllers\\ApiDichVuController@layDanhMucDichVu', '', '', 1064, '2021-03-25 10:19:25', '2021-04-19 14:47:12', 'api/api-lay-danh-muc-dich-vu', 1, 1, 1000, NULL),
	(1032, 'API lấy danh mục quận/huyện', 'GET | App\\Modules\\API\\Controllers\\ApiDmQuanHuyenController@layDanhMucQuanHuyen', 'GET', 'App\\Modules\\API\\Controllers\\ApiDmQuanHuyenController@layDanhMucQuanHuyen', '', '', 1064, '2021-03-25 10:19:25', '2021-04-19 14:47:37', 'api/api-lay-danh-muc-quan-huyen', 1, 1, 1000, NULL),
	(1033, 'API lấy danh mục phường/xã', 'GET | App\\Modules\\API\\Controllers\\ApiDmPhuongXaController@layDanhMucPhuongXa', 'GET', 'App\\Modules\\API\\Controllers\\ApiDmPhuongXaController@layDanhMucPhuongXa', '', '', 1064, '2021-03-25 10:19:25', '2021-04-19 14:47:57', 'api/api-lay-danh-muc-phuong-xa', 1, 1, 1000, NULL),
	(1034, 'API lấy danh mục phường/xã theo quận/huyện', 'GET | App\\Modules\\API\\Controllers\\ApiDmPhuongXaController@layDanhMucPhuongXaTheoMaQuanHuyen', 'GET', 'App\\Modules\\API\\Controllers\\ApiDmPhuongXaController@layDanhMucPhuongXaTheoMaQuanHuyen', '', '', 1064, '2021-03-25 10:19:25', '2021-04-19 14:49:32', 'api/api-lay-danh-muc-phuong-xa-theo-ma-quan-huyen', 1, 1, 1000, NULL),
	(1035, 'Đăng ký PAKN', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@dangKyPayc', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@dangKyPayc', '', '', 1006, '2021-03-25 10:19:27', '2021-04-09 17:09:00', 'dang-ky-payc', 1, 1, 1000, NULL),
	(1036, 'Lưu đăng ký PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@luuDangKyPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@luuDangKyPayc', '', '', 1035, '2021-03-25 10:19:27', '2021-04-09 17:09:00', 'luu-dang-ky-payc', 1, 2, 1000, NULL),
	(1038, 'Lưu thông tin đơn vị cho user', 'POST | App\\Modules\\User\\Controllers\\UserController@luuUserDonVi', 'POST', 'App\\Modules\\User\\Controllers\\UserController@luuUserDonVi', '', '', 1037, '2021-03-25 10:19:29', '2021-04-09 17:09:00', 'luu-user-dv', 1, 2, 1000, NULL),
	(1039, 'Load danh sách đơn vị theo User', 'POST | App\\Modules\\User\\Controllers\\UserController@loadDsUserDonvi', 'POST', 'App\\Modules\\User\\Controllers\\UserController@loadDsUserDonvi', '', '', 1037, '2021-03-25 10:19:29', '2021-04-09 17:09:00', 'load-danh-sach-user-donvi', 1, 2, 1000, NULL),
	(1040, 'Xóa đơn vị theo User', 'POST | App\\Modules\\User\\Controllers\\UserController@xoaUserDonVi', 'POST', 'App\\Modules\\User\\Controllers\\UserController@xoaUserDonVi', '', '', 1037, '2021-03-25 10:19:29', '2021-04-09 17:09:00', 'xoa-user-donvi', 1, 2, 1000, NULL),
	(1041, 'API xem danh sách PAKN đã gửi', 'POST | App\\Modules\\API\\Controllers\\ApiPaycController@layPaycCuaToi', 'POST', 'App\\Modules\\API\\Controllers\\ApiPaycController@layPaycCuaToi', '', '', 1064, '2021-04-09 16:27:21', '2021-04-19 14:51:52', 'api/api-payc-cua-toi', 1, 1, 1000, NULL),
	(1042, 'Frm duyệt và chuyển xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmDuyetVaChuyenXuLyPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmDuyetVaChuyenXuLyPayc', '', '', 1006, '2021-04-09 16:27:21', '2021-04-09 17:09:00', 'frm-duyet-va-chuyen-xu-ly-payc', 1, 2, 1000, NULL),
	(1043, 'Duyệt và chuyển xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@duyetVaChuyenXuLyPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@duyetVaChuyenXuLyPayc', '', '', 1042, '2021-04-09 16:27:21', '2021-04-09 17:09:00', 'duyet-va-chuyen-xu-ly-payc', 1, 2, 1000, NULL),
	(1044, 'Frm xử lý và chuyển lạnh đạo', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmXuLyVaChuyenLanhDao', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmXuLyVaChuyenLanhDao', '', '', 1006, '2021-04-09 16:27:21', '2021-04-09 17:09:00', 'frm-xu-ly-va-chuyen-lanh-dao', 1, 2, 1000, NULL),
	(1045, 'Xử lý và chuyển lãnh đạo', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@xuLyVaChuyenLanhDao', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@xuLyVaChuyenLanhDao', '', '', 1044, '2021-04-09 16:27:21', '2021-04-09 17:09:00', 'xu-ly-va-chuyen-lanh-dao', 1, 2, 1000, NULL),
	(1046, 'Frm duyệt và hoàn tất xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmDuyetVaHoanTatXuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmDuyetVaHoanTatXuLy', '', '', 1006, '2021-04-09 16:27:21', '2021-04-09 17:09:00', 'frm-duyet-va-hoan-tat-xu-ly', 1, 2, 1000, NULL),
	(1047, 'Duyệt và hoàn tất xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@duyetVahoanTatXuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@duyetVahoanTatXuLy', '', '', 1046, '2021-04-09 16:27:21', '2021-04-09 17:09:00', 'duyet-va-hoan-tat-xu-ly', 1, 2, 1000, NULL),
	(1048, 'Xem chi tiết PAKN', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@chiTietPayc', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@chiTietPayc', '', '', 1, '2021-04-09 16:27:21', '2021-04-09 17:10:00', 'chi-tiet-payc', 1, 1, 4, '<i class="fa fa-eye menu-icon"></i>'),
	(1049, 'Xem chi tiết nội dung PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@chiTietPaycNoiDungSingle', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@chiTietPaycNoiDungSingle', '', '', 1048, '2021-04-09 16:27:21', '2021-04-09 17:09:00', 'chi-tiet-payc-noi-dung-single', 1, 2, 1000, NULL),
	(1050, 'Bình luận PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@chiTietPaycFrmBinhLuanSingle', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@chiTietPaycFrmBinhLuanSingle', '', '', 1048, '2021-04-09 16:27:21', '2021-04-09 17:09:00', 'chi-tiet-payc-frm-binh-luan-single', 1, 2, 1000, NULL),
	(1051, 'Gửi bình luận', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@guiBinhLuan', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@guiBinhLuan', '', '', 1050, '2021-04-09 16:27:21', '2021-04-09 17:09:00', 'gui-binh-luan', 1, 2, 1000, NULL),
	(1052, 'Danh sách bình luận', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@danhSachBinhLuan', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachBinhLuan', '', '', 1048, '2021-04-09 16:27:21', '2021-04-09 17:09:00', 'danh-sach-binh-luan', 1, 2, 1000, NULL),
	(1053, 'Đánh giá hài lòng', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@haiLong', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@haiLong', '', '', 1052, '2021-04-09 16:27:21', '2021-04-09 17:09:00', 'hai-long', 1, 2, 1000, NULL),
	(1054, 'Không hài lòng', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@khongHaiLong', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@khongHaiLong', '', '', 1052, '2021-04-09 16:27:21', '2021-04-09 17:09:00', 'khong-hai-long', 1, 2, 1000, NULL),
	(1055, 'Frm phản hồi bình luận', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@chiTietPaycFrmCanBoPhanHoiBinhLuanSingle', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@chiTietPaycFrmCanBoPhanHoiBinhLuanSingle', '', '', 1006, '2021-04-09 16:27:21', '2021-04-09 17:09:00', 'chi-tiet-payc-frm-can-bo-phan-hoi-binh-luan-single', 1, 2, 1000, NULL),
	(1056, 'Phản hồi bình luận', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@traLoiBinhLuan', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@traLoiBinhLuan', '', '', 1055, '2021-04-09 16:27:21', '2021-04-09 17:09:00', 'tra-loi-binh-luan', 1, 2, 1000, NULL),
	(1057, 'Đánh dấu đã xem bình luận', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@danhDauDaXem', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@danhDauDaXem', '', '', 1048, '2021-04-09 16:27:21', '2021-04-09 17:09:00', 'danh-dau-da-xem', 1, 2, 1000, NULL),
	(1058, 'Tài khoản', 'GET | App\\Modules\\User\\Controllers\\UserController@user', 'GET', 'App\\Modules\\User\\Controllers\\UserController@user', '', '', 1, '2021-04-09 16:27:21', '2021-04-09 17:09:00', 'tai-khoan', 1, 1, 5, '<i class="fa fa-address-book menu-icon"></i>'),
	(1059, 'Load thông tin đơn vị theo tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@userDonViSingle', 'POST', 'App\\Modules\\User\\Controllers\\UserController@userDonViSingle', '', '', 1058, '2021-04-09 16:27:21', '2021-04-09 17:09:00', 'user-don-vi-single', 1, 2, 1000, NULL),
	(1060, 'Load thông tin nhóm quyền theo tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@userRoleSingle', 'POST', 'App\\Modules\\User\\Controllers\\UserController@userRoleSingle', '', '', 1058, '2021-04-09 16:27:21', '2021-04-09 17:09:00', 'user-role-single', 1, 2, 1000, NULL),
	(1061, 'Phân nhóm quyền cho tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@phanQuyenUserRole', 'POST', 'App\\Modules\\User\\Controllers\\UserController@phanQuyenUserRole', '', '', 1058, '2021-04-09 16:27:21', '2021-04-09 17:09:00', 'phan-quyen-user-role', 1, 2, 1000, NULL),
	(1062, 'Xem thông tin cá nhân', 'GET | App\\Modules\\User\\Controllers\\UserController@thongTinCaNhan', 'GET', 'App\\Modules\\User\\Controllers\\UserController@thongTinCaNhan', '', '', 1058, '2021-04-09 16:27:21', '2021-04-09 17:09:00', 'thong-tin-ca-nhan', 1, 2, 1000, NULL),
	(1063, 'Cập nhật thông tin cá nhân', 'POST | App\\Modules\\User\\Controllers\\UserController@capNhatThongTinCaNhan', 'POST', 'App\\Modules\\User\\Controllers\\UserController@capNhatThongTinCaNhan', '', '', 1058, '2021-04-09 16:27:21', '2021-04-09 17:09:00', 'cap-nhat-thong-tin-ca-nhan', 1, 2, 1000, NULL),
	(1064, 'API', '#', 'GET', NULL, NULL, NULL, 1, '2021-04-09 16:45:39', '2021-04-09 17:11:05', NULL, 1, 1, 22, '<i class="fa fa-globe menu-icon"></i>');
/*!40000 ALTER TABLE `admin_resource` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.admin_role
CREATE TABLE IF NOT EXISTS `admin_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_don_vi` int(10) unsigned NOT NULL COMMENT 'id đơn vị cha có level = 0',
  `state` int(10) unsigned NOT NULL DEFAULT 1 COMMENT '0: ngừng hoạt động; 1: hoạt động',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `resource_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `admin_rule_role_id_foreign` (`role_id`),
  KEY `admin_rule_resource_id_foreign` (`resource_id`),
  CONSTRAINT `admin_rule_resource_id_foreign` FOREIGN KEY (`resource_id`) REFERENCES `admin_resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `admin_rule_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `admin_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=677 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.admin_rule: ~107 rows (approximately)
/*!40000 ALTER TABLE `admin_rule` DISABLE KEYS */;
INSERT INTO `admin_rule` (`id`, `role_id`, `resource_id`, `created_at`, `updated_at`) VALUES
	(446, 1, 964, '2021-03-25 10:41:49', '2021-03-25 10:41:49'),
	(447, 1, 993, '2021-03-25 10:41:49', '2021-03-25 10:41:49'),
	(448, 1, 965, '2021-03-25 10:41:50', '2021-03-25 10:41:50'),
	(498, 2, 899, '2021-03-25 10:42:01', '2021-03-25 10:42:01'),
	(499, 2, 900, '2021-03-25 10:42:01', '2021-03-25 10:42:01'),
	(500, 2, 901, '2021-03-25 10:42:01', '2021-03-25 10:42:01'),
	(501, 2, 902, '2021-03-25 10:42:01', '2021-03-25 10:42:01'),
	(542, 2, 1006, '2021-04-06 10:53:45', '2021-04-06 10:53:45'),
	(544, 2, 967, '2021-04-06 10:53:45', '2021-04-06 10:53:45'),
	(545, 2, 968, '2021-04-06 10:53:45', '2021-04-06 10:53:45'),
	(547, 2, 970, '2021-04-06 10:53:45', '2021-04-06 10:53:45'),
	(548, 2, 971, '2021-04-06 10:53:45', '2021-04-06 10:53:45'),
	(550, 2, 973, '2021-04-06 10:53:45', '2021-04-06 10:53:45'),
	(551, 2, 974, '2021-04-06 10:53:45', '2021-04-06 10:53:45'),
	(552, 2, 975, '2021-04-06 10:53:45', '2021-04-06 10:53:45'),
	(553, 2, 976, '2021-04-06 10:53:45', '2021-04-06 10:53:45'),
	(554, 2, 977, '2021-04-06 10:53:45', '2021-04-06 10:53:45'),
	(555, 2, 978, '2021-04-06 10:53:45', '2021-04-06 10:53:45'),
	(556, 2, 979, '2021-04-06 10:53:45', '2021-04-06 10:53:45'),
	(557, 2, 980, '2021-04-06 10:53:45', '2021-04-06 10:53:45'),
	(558, 2, 981, '2021-04-06 10:53:45', '2021-04-06 10:53:45'),
	(559, 2, 982, '2021-04-06 10:53:45', '2021-04-06 10:53:45'),
	(560, 2, 983, '2021-04-06 10:53:45', '2021-04-06 10:53:45'),
	(561, 2, 984, '2021-04-06 10:53:45', '2021-04-06 10:53:45'),
	(562, 2, 985, '2021-04-06 10:53:45', '2021-04-06 10:53:45'),
	(563, 2, 986, '2021-04-06 10:53:45', '2021-04-06 10:53:45'),
	(564, 2, 987, '2021-04-06 10:53:45', '2021-04-06 10:53:45'),
	(565, 2, 988, '2021-04-06 10:53:45', '2021-04-06 10:53:45'),
	(566, 2, 989, '2021-04-06 10:53:45', '2021-04-06 10:53:45'),
	(567, 2, 990, '2021-04-06 10:53:45', '2021-04-06 10:53:45'),
	(568, 2, 991, '2021-04-06 10:53:45', '2021-04-06 10:53:45'),
	(569, 2, 992, '2021-04-06 10:53:45', '2021-04-06 10:53:45'),
	(570, 2, 994, '2021-04-06 10:53:45', '2021-04-06 10:53:45'),
	(571, 2, 995, '2021-04-06 10:53:45', '2021-04-06 10:53:45'),
	(572, 2, 1035, '2021-04-06 10:53:45', '2021-04-06 10:53:45'),
	(573, 2, 1036, '2021-04-06 10:53:45', '2021-04-06 10:53:45'),
	(575, 2, 912, '2021-04-06 10:53:47', '2021-04-06 10:53:47'),
	(576, 2, 913, '2021-04-06 10:53:47', '2021-04-06 10:53:47'),
	(577, 2, 914, '2021-04-06 10:53:47', '2021-04-06 10:53:47'),
	(578, 2, 915, '2021-04-06 10:53:47', '2021-04-06 10:53:47'),
	(579, 2, 916, '2021-04-06 10:53:47', '2021-04-06 10:53:47'),
	(581, 2, 1038, '2021-04-06 10:53:47', '2021-04-06 10:53:47'),
	(582, 2, 1039, '2021-04-06 10:53:47', '2021-04-06 10:53:47'),
	(583, 2, 1040, '2021-04-06 10:53:47', '2021-04-06 10:53:47'),
	(584, 2, 893, '2021-04-06 10:53:49', '2021-04-06 10:53:49'),
	(585, 2, 894, '2021-04-06 10:53:49', '2021-04-06 10:53:49'),
	(586, 2, 895, '2021-04-06 10:53:49', '2021-04-06 10:53:49'),
	(587, 2, 896, '2021-04-06 10:53:49', '2021-04-06 10:53:49'),
	(588, 2, 897, '2021-04-06 10:53:49', '2021-04-06 10:53:49'),
	(589, 2, 898, '2021-04-06 10:53:49', '2021-04-06 10:53:49'),
	(590, 2, 903, '2021-04-06 10:54:00', '2021-04-06 10:54:00'),
	(591, 2, 904, '2021-04-06 10:54:00', '2021-04-06 10:54:00'),
	(592, 2, 905, '2021-04-06 10:54:00', '2021-04-06 10:54:00'),
	(593, 2, 906, '2021-04-06 10:54:00', '2021-04-06 10:54:00'),
	(594, 2, 907, '2021-04-06 10:54:00', '2021-04-06 10:54:00'),
	(595, 2, 908, '2021-04-06 10:54:00', '2021-04-06 10:54:00'),
	(596, 2, 909, '2021-04-06 10:54:00', '2021-04-06 10:54:00'),
	(597, 2, 887, '2021-04-06 10:54:03', '2021-04-06 10:54:03'),
	(598, 2, 888, '2021-04-06 10:54:03', '2021-04-06 10:54:03'),
	(599, 2, 889, '2021-04-06 10:54:03', '2021-04-06 10:54:03'),
	(600, 2, 890, '2021-04-06 10:54:03', '2021-04-06 10:54:03'),
	(601, 2, 891, '2021-04-06 10:54:03', '2021-04-06 10:54:03'),
	(602, 2, 892, '2021-04-06 10:54:03', '2021-04-06 10:54:03'),
	(603, 2, 885, '2021-04-06 10:54:04', '2021-04-06 10:54:04'),
	(604, 2, 886, '2021-04-06 10:54:04', '2021-04-06 10:54:04'),
	(605, 2, 883, '2021-04-06 10:54:06', '2021-04-06 10:54:06'),
	(606, 2, 884, '2021-04-06 10:54:06', '2021-04-06 10:54:06'),
	(607, 2, 996, '2021-04-06 10:54:13', '2021-04-06 10:54:13'),
	(608, 2, 997, '2021-04-06 10:54:13', '2021-04-06 10:54:13'),
	(609, 2, 998, '2021-04-06 10:54:13', '2021-04-06 10:54:13'),
	(610, 2, 999, '2021-04-06 10:54:13', '2021-04-06 10:54:13'),
	(611, 2, 1000, '2021-04-06 10:54:13', '2021-04-06 10:54:13'),
	(612, 2, 1001, '2021-04-06 10:54:13', '2021-04-06 10:54:13'),
	(613, 2, 1003, '2021-04-06 10:54:13', '2021-04-06 10:54:13'),
	(614, 2, 1004, '2021-04-06 10:54:13', '2021-04-06 10:54:13'),
	(615, 2, 1005, '2021-04-06 10:54:13', '2021-04-06 10:54:13'),
	(626, 2, 965, '2021-04-09 15:31:30', '2021-04-09 15:31:30'),
	(630, 2, 1058, '2021-04-09 16:28:10', '2021-04-09 16:28:10'),
	(631, 2, 910, '2021-04-09 16:37:50', '2021-04-09 16:37:50'),
	(632, 2, 966, '2021-04-09 16:37:51', '2021-04-09 16:37:51'),
	(633, 2, 969, '2021-04-09 16:37:52', '2021-04-09 16:37:52'),
	(634, 2, 972, '2021-04-09 16:37:53', '2021-04-09 16:37:53'),
	(635, 2, 964, '2021-04-09 16:37:55', '2021-04-09 16:37:55'),
	(636, 2, 993, '2021-04-09 16:37:55', '2021-04-09 16:37:55'),
	(643, 2, 1048, '2021-04-09 16:38:02', '2021-04-09 16:38:02'),
	(644, 2, 1062, '2021-04-09 16:38:03', '2021-04-09 16:38:03'),
	(645, 2, 872, '2021-04-09 16:38:04', '2021-04-09 16:38:04'),
	(646, 2, 873, '2021-04-09 16:38:04', '2021-04-09 16:38:04'),
	(647, 2, 875, '2021-04-09 16:38:05', '2021-04-09 16:38:05'),
	(648, 2, 876, '2021-04-09 16:38:05', '2021-04-09 16:38:05'),
	(649, 2, 877, '2021-04-09 16:38:05', '2021-04-09 16:38:05'),
	(650, 2, 878, '2021-04-09 16:38:05', '2021-04-09 16:38:05'),
	(651, 2, 879, '2021-04-09 16:38:05', '2021-04-09 16:38:05'),
	(652, 2, 880, '2021-04-09 16:38:05', '2021-04-09 16:38:05'),
	(653, 2, 881, '2021-04-09 16:38:05', '2021-04-09 16:38:05'),
	(654, 2, 882, '2021-04-09 16:38:05', '2021-04-09 16:38:05'),
	(666, 2, 1064, '2021-04-19 15:11:12', '2021-04-19 15:11:12'),
	(667, 2, 1025, '2021-04-19 15:11:12', '2021-04-19 15:11:12'),
	(668, 2, 1026, '2021-04-19 15:11:12', '2021-04-19 15:11:12'),
	(669, 2, 1027, '2021-04-19 15:11:12', '2021-04-19 15:11:12'),
	(670, 2, 1028, '2021-04-19 15:11:12', '2021-04-19 15:11:12'),
	(671, 2, 1030, '2021-04-19 15:11:12', '2021-04-19 15:11:12'),
	(672, 2, 1031, '2021-04-19 15:11:12', '2021-04-19 15:11:12'),
	(673, 2, 1032, '2021-04-19 15:11:12', '2021-04-19 15:11:12'),
	(674, 2, 1033, '2021-04-19 15:11:12', '2021-04-19 15:11:12'),
	(675, 2, 1034, '2021-04-19 15:11:12', '2021-04-19 15:11:12'),
	(676, 2, 1041, '2021-04-19 15:11:12', '2021-04-19 15:11:12');
/*!40000 ALTER TABLE `admin_rule` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.chuc_danh
CREATE TABLE IF NOT EXISTS `chuc_danh` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ten_chuc_danh` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT 1,
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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_nhom_chuc_vu` int(10) unsigned NOT NULL DEFAULT 1,
  `ten_chuc_vu` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` int(11) DEFAULT 1 COMMENT '0 nghỉ sử dụng; 1 còn sử dụng',
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_nhom_dich_vu` int(11) DEFAULT NULL,
  `ten_dich_vu` varchar(50) DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `FK_dich_vu_nhom_dich_vu` (`id_nhom_dich_vu`),
  CONSTRAINT `FK_dich_vu_nhom_dich_vu` FOREIGN KEY (`id_nhom_dich_vu`) REFERENCES `nhom_dich_vu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.dich_vu: ~0 rows (approximately)
/*!40000 ALTER TABLE `dich_vu` DISABLE KEYS */;
INSERT INTO `dich_vu` (`id`, `id_nhom_dich_vu`, `ten_dich_vu`, `state`) VALUES
	(1, 1, 'Dịch vụ viễn thông', 1),
	(5, 7, 'Dịch vụ CNTT', 1);
/*!40000 ALTER TABLE `dich_vu` ENABLE KEYS */;

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

-- Dumping structure for table vnptpayc.dm_phuong_xa
CREATE TABLE IF NOT EXISTS `dm_phuong_xa` (
  `ma_phuong_xa` int(10) unsigned NOT NULL,
  `ten_phuong_xa` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loai` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ma_quan_huyen` int(10) unsigned NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
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
  `ma_quan_huyen` int(10) unsigned NOT NULL,
  `ten_quan_huyen` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ma_tinh` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loai` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ma_tham_so` varchar(250) DEFAULT NULL,
  `ten_tham_so` varchar(250) DEFAULT NULL,
  `loai_tham_so` varchar(250) DEFAULT NULL,
  `gia_tri_tham_so` varchar(250) DEFAULT NULL,
  `mo_ta_tham_so` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.dm_tham_so_he_thong: ~9 rows (approximately)
/*!40000 ALTER TABLE `dm_tham_so_he_thong` DISABLE KEYS */;
INSERT INTO `dm_tham_so_he_thong` (`id`, `ma_tham_so`, `ten_tham_so`, `loai_tham_so`, `gia_tri_tham_so`, `mo_ta_tham_so`) VALUES
	(1, 'CAP_TIEP_NHAN_MAC_DINH', 'Cấp tiếp nhận yêu cầu mặc định', 'Nvarchar2', 'HUYEN', 'XA cấp xã; HUYEN cấp huyện; TTVT cấp Trung tâm viễn thông; TTCNTT cấp trung tâm CNTT; TTDHTT cấp Trung tâm DHTT; TTKD cấp Trung tâm kinh doanh; VTT cấp viễn thông tỉnh; UBT cấp Ủy ban tỉnh'),
	(2, 'MA_NHOM_CHUC_VU_NHAN_PAKN', 'Nhóm chức vụ nhận PAKN', 'Nvarchar2', 'TIEP_NHAN', 'LANH_DAO là lãnh đạo nhận PAKN, XU_LY là chuyên viên xử lý sẽ nhận PAKN; ngược lại là nhóm tiếp nhận'),
	(3, 'SECRET_KEY_API_TAO_TAI_KHOAN', 'Khóa bảo mật khi gọi API tạo tài khoản', 'Nvarchar2', 'GDMpLecTjBD1USC5qkPFdiRu7nNtgHuK7JIMXZOi', 'Là khóa bảo mật truyền vào khi gọi API tạo tài khoản'),
	(4, 'MA_NHOM_CHUC_VU_DUYET_DANG_KY_PAKN', 'Mã nhóm chức vụ duyệt các phản ánh, yêu cầu do cán bộ đăng ký', 'Nvarchar2', 'LANH_DAO', 'Mã nhóm chức vụ duyệt các phản ánh, yêu cầu do cán bộ đăng ký'),
	(5, 'TRA_LOI_KHI_HOAN_TAT', 'Cho phép hệ thống tự gửi nội dung hoàn tất vào mục trả lời yêu cầu', 'Nvarchar2', '1', '1 cho phép; 0 không cho phép'),
	(7, 'CHO_PHEP_TRA_LAI_KH_KHI_TIEP_NHAN', 'Cho phép cán bộ trả yêu cầu lại cho khách hàng khi tiếp nhận hồ sơ', 'Nvarchar2', '1', '1 cho phép; 0 không cho phép'),
	(8, 'CHO_PHEP_TRA_LAI_KH_KHI_LANH_DAO_DUYET', 'Cho phép trả lại người dân trong chức năng danh sách chờ lãnh đạo duyệt', 'Nvarchar2', '1', '1 cho phép; 0 không cho phép'),
	(9, 'CHO_PHEP_HUY_YC_KHI_TIEP_NHAN', 'Cho phép cán bộ tiếp nhận hủy yêu cầu  khi tiếp nhận hồ sơ', 'Nvarchar2', '1', '1 cho phép; 0 không cho phép'),
	(10, 'CHO_PHEP_HUY_YC_KHI_LANH_DAO_DUYET', 'Cho phép cán bộ tiếp nhận hủy yêu cầu  khi tiếp nhận hồ sơ', 'Nvarchar2', '1', '1 cho phép; 0 không cho phép');
/*!40000 ALTER TABLE `dm_tham_so_he_thong` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.don_vi
CREATE TABLE IF NOT EXISTS `don_vi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ma_don_vi` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_don_vi` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `ma_phuong_xa` int(10) unsigned NOT NULL,
  `ma_cap` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ma_dinh_danh` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `co_dinh` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `di_dong` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `la_don_vi_xu_ly` int(11) NOT NULL DEFAULT 0,
  `state` int(11) NOT NULL DEFAULT 1 COMMENT '0: không hoạt động; 1: hoạt động',
  PRIMARY KEY (`id`),
  KEY `FK_don_vi_don_vi` (`parent_id`),
  KEY `order` (`order`),
  KEY `FK_don_vi_dm_phuong_xa` (`ma_phuong_xa`),
  CONSTRAINT `FK_don_vi_dm_phuong_xa` FOREIGN KEY (`ma_phuong_xa`) REFERENCES `dm_phuong_xa` (`ma_phuong_xa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_don_vi_don_vi` FOREIGN KEY (`parent_id`) REFERENCES `don_vi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.don_vi: ~25 rows (approximately)
/*!40000 ALTER TABLE `don_vi` DISABLE KEYS */;
INSERT INTO `don_vi` (`id`, `ma_don_vi`, `ten_don_vi`, `ma_phuong_xa`, `ma_cap`, `ma_dinh_danh`, `email`, `co_dinh`, `di_dong`, `fax`, `parent_id`, `order`, `la_don_vi_xu_ly`, `state`) VALUES
	(1, NULL, 'Tỉnh Trà Vinh', 29239, 'UBT', '000.00.00.H59', NULL, NULL, NULL, NULL, NULL, 0, 1, 1),
	(2, NULL, 'VNPT Trà Vinh', 29236, 'VTT', '000.00.01.H59', NULL, NULL, NULL, NULL, 1, 1, 1, 1),
	(12, NULL, 'Trung tâm Công nghệ Thông tin', 29236, 'TTCNTT', '000.01.01.H59', NULL, NULL, NULL, NULL, 2, 1, 1, 1),
	(13, NULL, 'Trung tâm Viễn Thông I', 29236, 'TTVT', '000.02.01.H59', NULL, NULL, NULL, NULL, 2, 1, 1, 1),
	(14, NULL, 'Trung tâm Viễn Thông II', 29236, 'TTVT', '000.03.01.H59', NULL, NULL, NULL, NULL, 2, 1, 1, 1),
	(15, NULL, 'Trung tâm Viễn Thông III', 29236, 'TTVT', '000.04.01.H59', NULL, NULL, NULL, NULL, 2, 1, 1, 1),
	(16, NULL, 'Viễn Thông TP.Trà Vinh', 29239, 'HUYEN', '001.02.01.H59', NULL, NULL, NULL, NULL, 13, 1, 1, 1),
	(17, NULL, 'Viễn Thông Châu Thành', 29374, 'HUYEN', '001.03.01.H59', NULL, NULL, NULL, NULL, 13, 1, 1, 1),
	(18, NULL, 'Phòng giải pháp', 29236, NULL, NULL, NULL, NULL, NULL, NULL, 12, 1, 1, 1),
	(19, NULL, 'Phòng tổng hợp', 29236, NULL, NULL, NULL, NULL, NULL, NULL, 12, 1, 1, 1),
	(20, NULL, 'Viễn Thông Cầu Kè', 29308, 'HUYEN', '001.03.01.H59', NULL, NULL, NULL, NULL, 14, 1, 1, 1),
	(21, NULL, 'Viễn Thông Càng Long', 29266, 'HUYEN', '001.03.01.H59', NULL, NULL, NULL, NULL, 14, 1, 1, 1),
	(22, NULL, 'Viễn Thông Trà Cú', 29461, 'HUYEN', '001.03.01.H59', NULL, NULL, NULL, NULL, 15, 1, 1, 1),
	(23, NULL, 'Viễn Thông Tiểu Cần', 29341, 'HUYEN', '001.03.01.H59', NULL, NULL, NULL, NULL, 15, 1, 1, 1),
	(24, NULL, 'Viễn Thông Cầu Ngang', 29416, 'HUYEN', '001.03.01.H59', NULL, NULL, NULL, NULL, 15, 1, 1, 1),
	(25, NULL, 'Viễn Thông huyện Duyên Hải', 29497, 'HUYEN', '001.03.01.H59', NULL, NULL, NULL, NULL, 15, 1, 1, 1),
	(26, NULL, 'Viễn Thông thị xã Duyên Hải', 29512, 'HUYEN', '001.03.01.H59', NULL, NULL, NULL, NULL, 15, 1, 1, 1),
	(27, NULL, 'Phòng 001', 29512, NULL, NULL, NULL, NULL, NULL, NULL, 16, 1, 1, 1),
	(28, NULL, 'Phòng 002', 29512, NULL, NULL, NULL, NULL, NULL, NULL, 16, 1, 1, 1),
	(29, NULL, 'Phòng 003', 29512, NULL, NULL, NULL, NULL, NULL, NULL, 16, 1, 1, 1),
	(31, NULL, 'Tổ tiếp nhận - TTVT 1', 29236, NULL, NULL, NULL, NULL, NULL, NULL, 13, 1, 1, 1),
	(32, NULL, 'Tổ xử lý - TTVT 1', 29236, NULL, NULL, NULL, NULL, NULL, NULL, 13, 1, 1, 1),
	(33, NULL, 'Tổ lãnh đạo - TTVT 1', 29236, NULL, NULL, NULL, NULL, NULL, NULL, 13, 1, 1, 1),
	(34, NULL, 'Ban giám đốc', 29236, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, 1, 1),
	(35, NULL, 'Tthị xã Duyên Hải', 29512, 'Xa', '001.03.01.H59', NULL, NULL, NULL, NULL, 26, 1, 1, 1),
	(37, NULL, 'Trung tâm Kinh doanh', 29236, 'TTKD', '000.01.01.H59', NULL, NULL, NULL, NULL, 2, 1, 1, 1),
	(38, NULL, 'Trung tâm Điều hành Thông tin', 29236, 'TTDHTT', '000.01.01.H59', NULL, NULL, NULL, NULL, 2, 1, 1, 1);
/*!40000 ALTER TABLE `don_vi` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ten_nhom_chuc_vu` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ma_nhom_chuc_vu` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `state` int(11) NOT NULL DEFAULT 1,
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ma_nhom_dich_vu` varchar(200) DEFAULT NULL,
  `ten_nhom_dich_vu` varchar(200) DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.nhom_dich_vu: ~7 rows (approximately)
/*!40000 ALTER TABLE `nhom_dich_vu` DISABLE KEYS */;
INSERT INTO `nhom_dich_vu` (`id`, `ma_nhom_dich_vu`, `ten_nhom_dich_vu`, `state`) VALUES
	(1, 'DV_VT', 'Dịch vụ Viễn Thông', 1),
	(2, 'DV_HUYEN', 'Dịch vụ cấp huyện', 1),
	(3, 'DV_XA', 'Dịch vụ cấp xã', 1),
	(4, 'DV_TTVT', 'Dịch vụ cấp TTVT', 1),
	(5, 'DV_DHTT', 'Dịch vụ ĐHTT', 1),
	(6, 'DV_KD', 'Dịch vụ hỗ trợ kinh doanh', 1),
	(7, 'DV_CNTT', 'Dịch vụ CNTT', 1);
/*!40000 ALTER TABLE `nhom_dich_vu` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.oauth_access_tokens
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.oauth_access_tokens: ~21 rows (approximately)
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
	('0722aea24ad957fb1448fc6528ba3013f2ed4efb44bfc1caf5c8c4e82251804bd0950c286db29ee5', 11, 1, 'Personal Access Token', '[]', 0, '2021-03-19 11:07:08', '2021-03-19 11:07:08', '2021-03-26 11:07:08'),
	('176f111c2ce30d7486a9d9057920153c90bb82ef2faf069b4e4c1c7060327dfb5b21490541760be8', 11, 1, 'Personal Access Token', '[]', 0, '2021-03-25 16:41:41', '2021-03-25 16:41:41', '2022-03-25 16:41:41'),
	('22edd3437e1d05ad0901b01237b7df55215bb93089bdea70eafe72a7b8f953da171bd651d193e64e', 11, 1, 'Personal Access Token', '[]', 0, '2021-03-23 16:13:30', '2021-03-23 16:13:30', '2021-03-30 16:13:30'),
	('284251f273d739d53ca0fe403f9404827b04da62e45bddfcc7d06cc0280aebe6cb319d520fdd733f', 11, 1, 'Personal Access Token', '[]', 0, '2021-03-24 09:04:51', '2021-03-24 09:04:51', '2021-03-31 09:04:51'),
	('3ee132edacb1e1f27e0cbc4dd3691cf037fdc1701a31fdf42c4292efd46e4355623bc0cb46851f1f', 11, 1, 'Personal Access Token', '[]', 0, '2021-03-24 09:34:03', '2021-03-24 09:34:03', '2021-03-31 09:34:03'),
	('444a3e10ad367e6f3fb95dc59f3237638696314ead9c71a178db8c6e9423847f577ceb94fceb2227', 11, 1, 'Personal Access Token', '[]', 0, '2021-03-24 16:41:31', '2021-03-24 16:41:31', '2021-03-31 16:41:31'),
	('48aab5f6ec6fc6fd0614d04164a2443ce12da7edf0f1e953ec356fe7d9a502ddbf58e1c955a7701d', 11, 1, 'Personal Access Token', '[]', 0, '2021-03-25 16:37:51', '2021-03-25 16:37:51', '2021-04-01 16:37:51'),
	('50ba85eb0affab0aaa3fb06d92476fe840a70ee1b309066058db6ffbc1be53e80cde4476839889a4', 11, 1, 'Personal Access Token', '[]', 0, '2021-03-25 16:36:34', '2021-03-25 16:36:34', '2022-03-25 16:36:34'),
	('5686828bc20556864bd052738a401e2d0e895e00e16ab87c3f0705219f58b6ca00b5b08fbdc9d942', 9, 1, 'Personal Access Token', '[]', 0, '2021-03-18 10:33:58', '2021-03-18 10:33:58', '2022-03-18 10:33:58'),
	('77ce018aaa53c802abf194d4d6704745be07c3406ffbbc00e95a9b9e1360f95a3c9e58d53f21c88d', 11, 1, 'Personal Access Token', '[]', 0, '2021-03-19 10:40:12', '2021-03-19 10:40:12', '2021-03-26 10:40:12'),
	('877cd02f5c4acd58baf85ac200d38c0535df43c5a7625cef75e25809176b7fb79cc3dbe33f44b8a3', 11, 1, 'Personal Access Token', '[]', 0, '2021-03-19 08:12:07', '2021-03-19 08:12:07', '2021-03-26 08:12:07'),
	('990c04b07a5843586c46fff54f46e7f2b6392cd42406a3b8840a7ce7bdfd3ca82cfe0a237df0b890', 11, 1, 'Personal Access Token', '[]', 0, '2021-03-23 16:10:19', '2021-03-23 16:10:19', '2021-03-30 16:10:19'),
	('9a29965f5024c73e086468fabdac6492b1c962a3803ab63f8922affdee4188aa0b83fc1c377040bd', 9, 1, 'Personal Access Token', '[]', 0, '2021-03-18 10:38:56', '2021-03-18 10:38:56', '2021-03-25 10:38:56'),
	('9ae100e46799c468a32d34bc57c61132d7590f22c0cb5007f02800aa8e13e3eb1d30a151bbe9e019', 11, 1, 'Personal Access Token', '[]', 1, '2021-03-19 08:34:02', '2021-03-19 08:34:02', '2021-03-26 08:34:02'),
	('ab6891a4beea688382369a90b1c08fb585964434c73f49aecd4e3d146b5cf3b2f5a7d70b48c0bd6c', 11, 1, 'Personal Access Token', '[]', 0, '2021-03-26 08:34:11', '2021-03-26 08:34:11', '2022-03-26 08:34:11'),
	('aed24f6ecdec3a557c88aba2391958e580c4234115ff42b515ac5a84975def5865007c262af1ac0b', 10, 1, 'Personal Access Token', '[]', 0, '2021-03-18 10:44:37', '2021-03-18 10:44:37', '2021-03-25 10:44:37'),
	('c52ef8cbb9514919cb23ec7daca21f57ba072c58ae8e4285ff35918704402c037861cdb7fb72d65d', 11, 1, 'Personal Access Token', '[]', 0, '2021-03-23 16:15:45', '2021-03-23 16:15:45', '2021-03-30 16:15:45'),
	('d1a1abd1b97ad4037e4094d86e7e27c0b1675928d7fa4a2e2e04a8aa96ac4e8d543f9bdbdb9f54be', 11, 1, 'Personal Access Token', '[]', 0, '2021-03-25 16:38:55', '2021-03-25 16:38:55', '2022-03-25 16:38:55'),
	('e6a8b06ea0708cfd9552f270ff0346770a7d7a316df726255c995cf926e75db998bb34ee6502ec44', 9, 1, 'Personal Access Token', '[]', 1, '2021-03-18 10:37:52', '2021-03-18 10:37:52', '2021-03-25 10:37:52'),
	('ebf8f8380fa13a3405ea1145ecfc7731120c14b78ca0c928ef29a2db8153411f871beaa48a90ee89', 10, 1, 'Personal Access Token', '[]', 0, '2021-03-18 15:58:51', '2021-03-18 15:58:51', '2021-03-25 15:58:51'),
	('f328932f9379a5aa0bfca3b974dbbdd4f00a0f7e1c6340a9c701fad9c3266ae88628e4a013a1c282', 11, 1, 'Personal Access Token', '[]', 0, '2021-03-25 16:37:41', '2021-03-25 16:37:41', '2022-03-25 16:37:41');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.oauth_auth_codes
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
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
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.password_resets: ~1 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
	('thanhpv.tvh', '$2y$10$GeJq5nbaNzdeY8UqlCnDIOIh6uSHYw5iZcRhpKuPxDrBtqBT4qAG.', '2019-06-20 02:17:07'),
	('p.thanhit@gmail.com', '$2y$10$Wfx0JhILSAPlPh3cft0SI.URV3epGiCzhxsZLostXaPcvYo2uwDE2', '2021-04-08 08:44:50');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.payc
CREATE TABLE IF NOT EXISTS `payc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_tao` int(10) unsigned NOT NULL,
  `id_dich_vu` int(11) DEFAULT NULL,
  `so_phieu` varchar(200) DEFAULT NULL,
  `tieu_de` varchar(200) NOT NULL,
  `noi_dung` longtext DEFAULT NULL,
  `file_payc` text DEFAULT NULL,
  `ma_phuong_xa` int(10) unsigned DEFAULT NULL,
  `vi_do` varchar(250) DEFAULT NULL,
  `kinh_do` varchar(250) DEFAULT NULL,
  `ngay_tao` datetime DEFAULT current_timestamp(),
  `han_xu_ly_mong_muon` datetime DEFAULT NULL,
  `han_xu_ly_duoc_giao` datetime DEFAULT NULL,
  `ngay_hoan_tat` datetime DEFAULT NULL,
  `trang_thai` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `FK_payc_users` (`id_user_tao`),
  KEY `FK_payc_dich_vu` (`id_dich_vu`),
  KEY `FK_payc_dm_phuong_xa` (`ma_phuong_xa`),
  CONSTRAINT `FK_payc_dich_vu` FOREIGN KEY (`id_dich_vu`) REFERENCES `dich_vu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payc_dm_phuong_xa` FOREIGN KEY (`ma_phuong_xa`) REFERENCES `dm_phuong_xa` (`ma_phuong_xa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payc_users` FOREIGN KEY (`id_user_tao`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.payc: ~6 rows (approximately)
/*!40000 ALTER TABLE `payc` DISABLE KEYS */;
INSERT INTO `payc` (`id`, `id_user_tao`, `id_dich_vu`, `so_phieu`, `tieu_de`, `noi_dung`, `file_payc`, `ma_phuong_xa`, `vi_do`, `kinh_do`, `ngay_tao`, `han_xu_ly_mong_muon`, `han_xu_ly_duoc_giao`, `ngay_hoan_tat`, `trang_thai`) VALUES
	(74, 6, 5, '190521-0001', 'Phan Văn Thanh test phản ánh kiến nghị lần 1', '<p><br></p>', '176566833_23847359228720477_5838744416113785765_n_16213907020.jpg;181550071_180764673904248_5605939069989805932_n_16213907021.jpg;', 29236, NULL, NULL, '2021-05-19 09:18:22', '2021-05-19 17:00:00', NULL, NULL, 1),
	(75, 6, 5, '190521-0002', 'Phan Văn Thanh test phản ánh kiến nghị lần 2', '<p><br></p>', '176566833_23847359228720477_5838744416113785765_n_16213947550.jpg;181550071_180764673904248_5605939069989805932_n_16213947551.jpg;', 29236, NULL, NULL, '2021-05-19 10:25:55', '2021-05-19 17:00:00', NULL, NULL, 1),
	(76, 7, 5, '240521-0001', 'test', '<p><br></p>', NULL, 29236, NULL, NULL, '2021-05-24 08:54:23', '2021-05-24 17:00:00', NULL, NULL, 1),
	(77, 7, 5, '240521-0002', 'đang ký 1', '<p><br></p>', NULL, 29236, NULL, NULL, '2021-05-24 09:10:55', '2021-05-24 17:00:00', NULL, NULL, 1),
	(78, 7, 5, '240521-0003', 'test luôn 3', '<p>test luôn nè</p>', NULL, 29236, NULL, NULL, '2021-05-24 09:42:59', '2021-05-24 17:00:00', NULL, NULL, 1),
	(79, 7, 5, '240521-0004', 'test luôn 1', '<p><br></p>', NULL, 29236, NULL, NULL, '2021-05-24 09:45:44', '2021-05-24 17:00:00', NULL, NULL, 1);
/*!40000 ALTER TABLE `payc` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.payc_binh_luan
CREATE TABLE IF NOT EXISTS `payc_binh_luan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_payc` int(11) NOT NULL DEFAULT 1,
  `id_user` int(10) unsigned DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `file` varchar(250) DEFAULT NULL,
  `ma_loai` varchar(50) NOT NULL DEFAULT 'BINH_LUAN' COMMENT 'BINH_LUAN; TRA_LOI',
  `ho_ten` varchar(250) DEFAULT NULL,
  `noi_dung` longtext DEFAULT NULL,
  `hai_long` int(11) NOT NULL DEFAULT 0,
  `khong_hai_long` int(11) NOT NULL DEFAULT 0,
  `trang_thai` int(11) NOT NULL DEFAULT 0,
  `ngay_binh_luan` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `FK_payc_binh_luan_payc` (`id_payc`),
  KEY `FK_payc_binh_luan_users` (`id_user`),
  KEY `FK_payc_binh_luan_payc_binh_luan` (`parent_id`),
  CONSTRAINT `FK_payc_binh_luan_payc` FOREIGN KEY (`id_payc`) REFERENCES `payc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payc_binh_luan_payc_binh_luan` FOREIGN KEY (`parent_id`) REFERENCES `payc_binh_luan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payc_binh_luan_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.payc_binh_luan: ~6 rows (approximately)
/*!40000 ALTER TABLE `payc_binh_luan` DISABLE KEYS */;
INSERT INTO `payc_binh_luan` (`id`, `id_payc`, `id_user`, `parent_id`, `file`, `ma_loai`, `ho_ten`, `noi_dung`, `hai_long`, `khong_hai_long`, `trang_thai`, `ngay_binh_luan`) VALUES
	(69, 74, 7, NULL, '176566833_23847359228720477_5838744416113785765_n_16213946640.jpg;181550071_180764673904248_5605939069989805932_n_16213946641.jpg;', 'TRA_LOI', 'Nguyễn Chí Thanh', 'Đã hoàn tất xử lý', 0, 0, 1, '2021-05-19 10:24:24'),
	(70, 75, 9, NULL, '176566833_23847359228720477_5838744416113785765_n_16213958680.jpg;', 'TRA_LOI', 'p.thanhit@gmail.com', 'Hoàn tất rồi nha sếp ơi', 0, 0, 0, '2021-05-19 10:44:28'),
	(71, 77, 7, NULL, '1_16218240190.jpg;1bf7cf1a1972ec2cb563_16218240191.jpg;2_16218240192.jpg;5ffe2630f05805065c49_16218240193.jpg;6ea630abe5c3109d49d2_16218240194.jpg;9e5b6b70be184b461209_16218240195.jpg;', 'TRA_LOI', 'Nguyễn Chí Thanh', 'Trả lại hok xử lý đó chịu hok', 0, 0, 0, '2021-05-24 09:40:19'),
	(72, 76, 7, NULL, '1_16218241070.jpg;1bf7cf1a1972ec2cb563_16218241071.jpg;', 'TRA_LOI', 'Nguyễn Chí Thanh', 'test', 0, 0, 0, '2021-05-24 09:41:47'),
	(73, 78, 7, NULL, '5ffe2630f05805065c49_16218242000.jpg;', 'TRA_LOI', 'Nguyễn Chí Thanh', 'Không xử lý chuyện của thế giới', 0, 0, 0, '2021-05-24 09:43:20'),
	(74, 79, 7, NULL, '9e5b6b70be184b461209_16218245790.jpg;', 'TRA_LOI', 'Nguyễn Chí Thanh', 'test', 0, 0, 0, '2021-05-24 09:49:39');
/*!40000 ALTER TABLE `payc_binh_luan` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.payc_can_bo_nhan
CREATE TABLE IF NOT EXISTS `payc_can_bo_nhan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_xu_ly_yeu_cau` int(11) NOT NULL,
  `id_user_nhan` int(10) unsigned NOT NULL,
  `ngay_nhan` datetime NOT NULL DEFAULT current_timestamp(),
  `han_xu_ly` datetime DEFAULT NULL,
  `ngay_hoan_tat` datetime DEFAULT NULL,
  `vai_tro` int(11) NOT NULL DEFAULT 0,
  `trang_thai` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_payc_can_bo_nhan_payc_canbo_xuly_yeucau` (`id_xu_ly_yeu_cau`),
  KEY `FK_payc_can_bo_nhan_users` (`id_user_nhan`),
  CONSTRAINT `FK_payc_can_bo_nhan_payc_canbo_xuly_yeucau` FOREIGN KEY (`id_xu_ly_yeu_cau`) REFERENCES `payc_xu_ly` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payc_can_bo_nhan_users` FOREIGN KEY (`id_user_nhan`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=186 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.payc_can_bo_nhan: ~22 rows (approximately)
/*!40000 ALTER TABLE `payc_can_bo_nhan` DISABLE KEYS */;
INSERT INTO `payc_can_bo_nhan` (`id`, `id_xu_ly_yeu_cau`, `id_user_nhan`, `ngay_nhan`, `han_xu_ly`, `ngay_hoan_tat`, `vai_tro`, `trang_thai`) VALUES
	(153, 305, 7, '2021-05-19 09:18:22', NULL, '2021-05-19 09:19:13', 0, 2),
	(154, 305, 2, '2021-05-19 09:18:22', NULL, NULL, 0, 1),
	(155, 306, 8, '2021-05-19 09:19:13', NULL, '2021-05-19 09:36:02', 2, 2),
	(156, 306, 6, '2021-05-19 09:19:13', NULL, '2021-05-19 09:39:19', 1, 2),
	(159, 308, 7, '2021-05-19 09:39:19', NULL, '2021-05-19 10:09:32', 0, 2),
	(162, 311, 6, '2021-05-19 10:24:24', NULL, NULL, 0, 1),
	(163, 313, 7, '2021-05-19 10:25:55', NULL, '2021-05-19 10:27:05', 0, 2),
	(164, 313, 2, '2021-05-19 10:25:55', NULL, NULL, 0, 0),
	(165, 314, 2, '2021-05-19 10:27:05', NULL, '2021-05-19 10:27:38', 0, 2),
	(166, 315, 7, '2021-05-19 10:27:38', NULL, '2021-05-19 10:37:40', 0, 2),
	(167, 317, 9, '2021-05-19 10:40:09', NULL, '2021-05-19 10:44:28', 0, 1),
	(168, 318, 6, '2021-05-19 10:44:28', NULL, NULL, 0, 0),
	(169, 320, 7, '2021-05-24 08:54:23', NULL, '2021-05-24 08:54:34', 0, 1),
	(170, 320, 2, '2021-05-24 08:54:23', NULL, NULL, 0, 0),
	(174, 325, 7, '2021-05-24 09:10:55', NULL, NULL, 0, 1),
	(175, 325, 2, '2021-05-24 09:10:55', NULL, NULL, 0, 0),
	(178, 328, 7, '2021-05-24 09:40:19', NULL, '2021-05-24 09:40:19', 0, 1),
	(179, 329, 7, '2021-05-24 09:41:47', NULL, '2021-05-24 09:41:47', 0, 1),
	(180, 331, 7, '2021-05-24 09:42:59', NULL, NULL, 0, 1),
	(181, 331, 2, '2021-05-24 09:42:59', NULL, NULL, 0, 0),
	(182, 332, 7, '2021-05-24 09:43:20', NULL, '2021-05-24 09:43:20', 0, 1),
	(183, 334, 7, '2021-05-24 09:45:44', NULL, NULL, 0, 1),
	(184, 334, 2, '2021-05-24 09:45:44', NULL, NULL, 0, 0),
	(185, 335, 7, '2021-05-24 09:49:39', NULL, '2021-05-24 09:49:39', 0, 1);
/*!40000 ALTER TABLE `payc_can_bo_nhan` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.payc_trang_thai_xu_ly
CREATE TABLE IF NOT EXISTS `payc_trang_thai_xu_ly` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ma_trang_thai` varchar(200) DEFAULT NULL,
  `ten_trang_thai_xu_ly` varchar(200) DEFAULT NULL,
  `mo_ta` varchar(250) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `trang_thai` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ten_xu_ly` (`ten_trang_thai_xu_ly`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.payc_trang_thai_xu_ly: ~17 rows (approximately)
/*!40000 ALTER TABLE `payc_trang_thai_xu_ly` DISABLE KEYS */;
INSERT INTO `payc_trang_thai_xu_ly` (`id`, `ma_trang_thai`, `ten_trang_thai_xu_ly`, `mo_ta`, `order`, `trang_thai`) VALUES
	(1, 'TAO_MOI', 'Tạo mới PAKN', 'Khách hàng hoặc cán bộ tạo PAYC', 1, 1),
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
	(13, 'CAP_NHAT', 'Cập nhật nội dung phản ánh, yêu cầu', 'Cập nhật nội dung task', 1, 1),
	(19, 'DANG_KY_PAYC', 'Cán bộ đăng ký nhận xử lý, hỗ trợ phản ánh, yêu cầu', 'Cán bộ đăng ký nhận xử lý, hỗ trợ phản ánh, yêu cầu', 1, 1),
	(20, 'DUYET_CHUYEN_XU_LY', 'Duyệt và chuyển xử lý', 'Duyệt và chuyển xử lý', 1, 1),
	(21, 'DUYET_HOAT_TAT', 'Duyệt và hoàn tất xử lý phản ánh, yêu cầu', 'Duyệt và hoàn tất xử lý phản ánh, yêu cầu', 1, 1),
	(22, 'XU_LY_VA_CHUYEN_LANH_DAO', 'Xử lý và chuyển lãnh đạo duyệt', 'Xử lý và chuyển lãnh đạo duyệt', 1, 1),
	(24, 'CHUYEN_DON_VI_CAP_TREN', 'Chuyển cấp trên', 'Chuyển cấp trên', 1, 1);
/*!40000 ALTER TABLE `payc_trang_thai_xu_ly` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.payc_xu_ly
CREATE TABLE IF NOT EXISTS `payc_xu_ly` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_payc` int(11) NOT NULL,
  `id_user_xu_ly` int(10) unsigned NOT NULL,
  `id_xu_ly` int(11) NOT NULL,
  `noi_dung_xu_ly` longtext DEFAULT NULL,
  `file_xu_ly` text DEFAULT NULL,
  `ngay_xu_ly` datetime DEFAULT current_timestamp(),
  `state` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_payc_canbo_xuly_yeucau_payc` (`id_payc`),
  KEY `FK_payc_canbo_xuly_yeucau_users` (`id_user_xu_ly`),
  KEY `FK_payc_canbo_xuly_yeucau_payc_xu_ly` (`id_xu_ly`),
  CONSTRAINT `FK_payc_canbo_xuly_yeucau_payc` FOREIGN KEY (`id_payc`) REFERENCES `payc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payc_canbo_xuly_yeucau_payc_xu_ly` FOREIGN KEY (`id_xu_ly`) REFERENCES `payc_trang_thai_xu_ly` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payc_canbo_xuly_yeucau_users` FOREIGN KEY (`id_user_xu_ly`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=336 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.payc_xu_ly: ~23 rows (approximately)
/*!40000 ALTER TABLE `payc_xu_ly` DISABLE KEYS */;
INSERT INTO `payc_xu_ly` (`id`, `id_payc`, `id_user_xu_ly`, `id_xu_ly`, `noi_dung_xu_ly`, `file_xu_ly`, `ngay_xu_ly`, `state`) VALUES
	(304, 74, 6, 19, '', '', '2021-05-19 09:18:22', 0),
	(305, 74, 6, 7, '', '', '2021-05-19 09:18:22', 0),
	(306, 74, 7, 20, 'Thanh xử lý giúp anh nha', NULL, '2021-05-19 09:19:13', 0),
	(308, 74, 6, 22, 'Em đã xử lý xong, gửi anh hình gái đẹp coi chơi nha', '176566833_23847359228720477_5838744416113785765_n_16213919590.jpg;', '2021-05-19 09:39:19', 0),
	(311, 74, 7, 21, 'Đã hoàn tất xử lý', '176566833_23847359228720477_5838744416113785765_n_16213946640.jpg;181550071_180764673904248_5605939069989805932_n_16213946641.jpg;', '2021-05-19 10:24:24', 0),
	(312, 75, 6, 19, '', '', '2021-05-19 10:25:55', 0),
	(313, 75, 6, 7, '', '', '2021-05-19 10:25:55', 0),
	(314, 75, 7, 7, NULL, NULL, '2021-05-19 10:27:05', 0),
	(315, 75, 2, 7, NULL, NULL, '2021-05-19 10:27:38', 0),
	(317, 75, 7, 24, 'Gửi sếp hình gái đẹp coi chơi ạ', '176566833_23847359228720477_5838744416113785765_n_16213956090.jpg;', '2021-05-19 10:40:09', 0),
	(318, 75, 9, 21, 'Hoàn tất rồi nha sếp ơi', '176566833_23847359228720477_5838744416113785765_n_16213958680.jpg;', '2021-05-19 10:44:28', 0),
	(319, 76, 7, 19, '', '', '2021-05-24 08:54:23', 0),
	(320, 76, 7, 7, '', '', '2021-05-24 08:54:23', 0),
	(324, 77, 7, 19, '', '', '2021-05-24 09:10:55', 0),
	(325, 77, 7, 7, '', '', '2021-05-24 09:10:55', 0),
	(328, 77, 7, 4, 'Trả lại hok xử lý đó chịu hok', '1_16218240190.jpg;1bf7cf1a1972ec2cb563_16218240191.jpg;2_16218240192.jpg;5ffe2630f05805065c49_16218240193.jpg;6ea630abe5c3109d49d2_16218240194.jpg;9e5b6b70be184b461209_16218240195.jpg;', '2021-05-24 09:40:19', 0),
	(329, 76, 7, 10, 'test', '1_16218241070.jpg;1bf7cf1a1972ec2cb563_16218241071.jpg;', '2021-05-24 09:41:47', 0),
	(330, 78, 7, 19, '', '', '2021-05-24 09:42:59', 0),
	(331, 78, 7, 7, '', '', '2021-05-24 09:42:59', 0),
	(332, 78, 7, 4, 'Không xử lý chuyện của thế giới', '5ffe2630f05805065c49_16218242000.jpg;', '2021-05-24 09:43:20', 0),
	(333, 79, 7, 19, '', '', '2021-05-24 09:45:44', 0),
	(334, 79, 7, 7, '', '', '2021-05-24 09:45:44', 0),
	(335, 79, 7, 4, 'test', '9e5b6b70be184b461209_16218245790.jpg;', '2021-05-24 09:49:39', 0);
/*!40000 ALTER TABLE `payc_xu_ly` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.to_do
CREATE TABLE IF NOT EXISTS `to_do` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(10) unsigned NOT NULL,
  `noi_dung` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `file` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_tao` datetime DEFAULT current_timestamp(),
  `ngay_giao` datetime DEFAULT current_timestamp(),
  `han_xu_ly` datetime DEFAULT NULL,
  `ngay_hoan_thanh` datetime DEFAULT NULL,
  `sap_xep` int(11) NOT NULL DEFAULT 0,
  `trang_thai` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_to_do_users` (`id_user`),
  CONSTRAINT `FK_to_do_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.to_do: ~3 rows (approximately)
/*!40000 ALTER TABLE `to_do` DISABLE KEYS */;
INSERT INTO `to_do` (`id`, `id_user`, `noi_dung`, `file`, `ngay_tao`, `ngay_giao`, `han_xu_ly`, `ngay_hoan_thanh`, `sap_xep`, `trang_thai`) VALUES
	(28, 2, 'Thêm chức năng hoàn tất phối hợp xử lý.', NULL, '2021-05-17 13:38:27', '2021-05-17 13:38:27', '2021-05-17 13:38:00', '2021-05-19 10:08:13', 1, 1),
	(29, 2, 'Kiểm tra và xử lý lại chức năng hoàn tất xử lý và chuyển lãnh đạo duyệt: cập nhật lại trạng thái = 2, kiểm tra những người phối hợp đã hoàn tất hết chưa', NULL, '2021-05-17 13:51:05', '2021-05-17 13:51:05', '2021-05-17 13:51:00', '2021-05-19 10:08:26', 2, 1),
	(30, 2, 'Kiểm tra lại chức năng chờ duyệt: chuyển lãnh đạo khác, chuyển cấp trên', NULL, '2021-05-17 13:52:46', '2021-05-17 13:52:46', '2021-05-17 13:52:00', NULL, 4, 1),
	(31, 2, 'Kiểm tra và xử lý lại chức năng: duyệt hoàn tất', NULL, '2021-05-17 13:53:14', '2021-05-17 13:53:14', '2021-05-17 13:53:00', '2021-05-19 10:25:07', 3, 1);
/*!40000 ALTER TABLE `to_do` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hinh_anh` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '/user.png',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `di_dong` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loai_tai_khoan` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT 'KHACH_HANG' COMMENT 'KHACH_HANG; CAN_BO',
  `state` int(11) DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.users: ~9 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `hinh_anh`, `remember_token`, `created_at`, `updated_at`, `di_dong`, `loai_tai_khoan`, `state`) VALUES
	(1, 'Chế độ ẩn danh', 'guest', '$2y$10$VZI0siYq7lRPvqt8e.QbXOWDBelj91YwJoLsEKx4GxbWH5XQb87xO', 'photo_2019-10-21_18-00-43_16177906110.jpg', '35xOWSUdceM6lRhePiHS9Y3xwvvLupgJWeYIzh2FMjMl22RuUJURMmX7oElG', NULL, '2021-04-08 15:52:25', '0941138484', 'KHACH_HANG', 1),
	(2, 'Quản trị hệ thống', 'admin', '$2y$10$OcK0kyfMtKmByQ2ZmToC/uf.8ekeOk.Snc4LqXXDrnZrHO8oencTC', 'photo_2019-10-21_18-00-43_16177906110.jpg', 'tvkFOhJz7kCsUkwCCLUT61sqLlLEe8OYXf40oBKeaaxAJd1oNmVc2SAxiYAa', NULL, '2021-05-19 10:43:46', '0941138484', 'CAN_BO', 1),
	(3, 'Trần Thị Thanh Mỹ', 'tttmy.tvh@vnpt.vn', '$2y$10$T6oMLYkByOKm3nLHyAkeAenmtzHfvjjsNozFYWPtYUBxbbV7dJ1aC', 'photo_2019-10-21_18-00-43_16177906110.jpg', '2VL7V5IJ5oyynFEszYPlIcjBgSqtNL9x9glcRe4JRHHtkweEMeePq0gk6nrx', NULL, '2021-04-19 15:13:26', '0941138484', 'CAN_BO', 1),
	(6, 'Phan Văn Thanh', 'thanhpv.tvh@vnpt.vn', '$2y$10$qpIX1fE7c9SqxwJMoX8dNOY1aeC49d2S2cO9E1VITB6CLtJp9Iknu', 'photo_2019-10-21_18-00-43_16179400910.jpg', NULL, '2021-03-15 10:52:12', '2021-04-19 15:12:36', '0911123234', 'CAN_BO', 1),
	(7, 'Nguyễn Chí Thanh', 'thanhnc.tvh@vnpt.vn', '$2y$10$h/50VWDGfEnvn5zwWMldu.kfBaozVyn62E6KVGXgmm3K/DX5w7/FC', 'photo_2019-10-21_18-00-43_16177906110.jpg', NULL, '2021-03-15 10:52:12', '2021-04-19 15:12:57', '0911123234', 'CAN_BO', 1),
	(8, 'Phạm Kim Tín', 'tinpk.tvh@vnpt.vn', '$2y$10$PxIp72KgGM2IqolggnO1e.kYL/1ERinuk54U8G4fliQ621yTtuU1C', 'photo_2019-10-21_18-00-43_16177906110.jpg', NULL, '2021-03-16 08:35:21', '2021-04-19 15:13:11', '0944564033', 'CAN_BO', 1),
	(9, 'p.thanhit@gmail.com', 'p.thanhit@gmail.com', '$2y$10$AZn5MGZQ5hoFJizpG/PrYunmTmxzDcKFVW3qcMxjLcOjgM5au8IkS', 'photo_2019-10-21_18-00-43_16177906110.jpg', NULL, '2021-03-18 10:28:58', '2021-05-19 10:41:15', NULL, 'CAN_BO', 1),
	(10, 'ngochtb.tvh', 'ngochtb.tvh', '$2y$10$JRtnv/wu7mdGtuwfU5BRJuzjIZdBSL/JpRVQaOqkLxm0fPpd3OlYq', 'photo_2019-10-21_18-00-43_16177906110.jpg', NULL, '2021-03-18 10:42:13', '2021-05-19 10:29:21', NULL, 'CAN_BO', 1),
	(11, 'minhbn.tvh', 'minhbn.tvh', '$2y$10$G1H51oZERlY6.Z43IABE3OYSdMOY96FGPOqsrDkdsJZ0Eb76YNjvS', 'photo_2019-10-21_18-00-43_16177906110.jpg', NULL, '2021-03-18 10:49:47', '2021-05-19 10:29:31', NULL, 'CAN_BO', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.users_dich_vu
CREATE TABLE IF NOT EXISTS `users_dich_vu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(10) unsigned NOT NULL,
  `id_dich_vu` int(11) DEFAULT NULL,
  `tu_ngay` date DEFAULT NULL,
  `den_ngay` date DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `FK_users_dich_vu_users` (`id_user`),
  KEY `FK_users_dich_vu_dich_vu` (`id_dich_vu`),
  CONSTRAINT `FK_users_dich_vu_dich_vu` FOREIGN KEY (`id_dich_vu`) REFERENCES `dich_vu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_users_dich_vu_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.users_dich_vu: ~6 rows (approximately)
/*!40000 ALTER TABLE `users_dich_vu` DISABLE KEYS */;
INSERT INTO `users_dich_vu` (`id`, `id_user`, `id_dich_vu`, `tu_ngay`, `den_ngay`, `state`) VALUES
	(13, 3, 1, NULL, NULL, 1),
	(17, 7, 1, NULL, NULL, 1),
	(18, 8, 5, NULL, NULL, 1),
	(20, 7, 5, NULL, NULL, 1),
	(36, 2, 5, NULL, NULL, 1),
	(37, 9, 5, NULL, NULL, 1);
/*!40000 ALTER TABLE `users_dich_vu` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.users_don_vi
CREATE TABLE IF NOT EXISTS `users_don_vi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_don_vi` int(10) unsigned NOT NULL,
  `id_user` int(10) unsigned NOT NULL,
  `id_chuc_danh` int(10) unsigned NOT NULL DEFAULT 1,
  `id_chuc_vu` int(10) unsigned NOT NULL DEFAULT 1,
  `ngay_bat_dau_cong_tac` datetime DEFAULT current_timestamp(),
  `ngay_ket_thuc_cong_tac` datetime DEFAULT NULL,
  `state` int(10) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `FK_users_don_vi_users` (`id_user`),
  KEY `FK_users_don_vi_don_vi` (`id_don_vi`),
  KEY `FK_users_don_vi_chuc_danh` (`id_chuc_danh`),
  KEY `FK_users_don_vi_chuc_vu` (`id_chuc_vu`),
  CONSTRAINT `FK_users_don_vi_chuc_danh` FOREIGN KEY (`id_chuc_danh`) REFERENCES `chuc_danh` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_users_don_vi_chuc_vu` FOREIGN KEY (`id_chuc_vu`) REFERENCES `chuc_vu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_users_don_vi_don_vi` FOREIGN KEY (`id_don_vi`) REFERENCES `don_vi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_users_don_vi_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.users_don_vi: ~8 rows (approximately)
/*!40000 ALTER TABLE `users_don_vi` DISABLE KEYS */;
INSERT INTO `users_don_vi` (`id`, `id_don_vi`, `id_user`, `id_chuc_danh`, `id_chuc_vu`, `ngay_bat_dau_cong_tac`, `ngay_ket_thuc_cong_tac`, `state`) VALUES
	(19, 19, 8, 1, 3, '2021-03-01 00:00:00', '2021-03-22 00:00:00', 1),
	(60, 31, 11, 1, 2, NULL, NULL, 1),
	(61, 33, 11, 2, 2, NULL, NULL, 1),
	(63, 19, 7, 1, 2, '2021-03-01 00:00:00', '2021-03-22 00:00:00', 1),
	(64, 19, 6, 1, 4, '2021-03-01 00:00:00', '2021-03-22 00:00:00', 1),
	(68, 19, 2, 1, 2, NULL, NULL, 1),
	(69, 34, 9, 2, 2, NULL, NULL, 1),
	(70, 34, 9, 2, 3, NULL, NULL, 1);
/*!40000 ALTER TABLE `users_don_vi` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.users_role
CREATE TABLE IF NOT EXISTS `users_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_role_id` (`user_id`,`role_id`),
  KEY `FK_users_role_admin_role` (`role_id`),
  CONSTRAINT `FK_users_role_admin_role` FOREIGN KEY (`role_id`) REFERENCES `admin_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_users_role_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.users_role: ~6 rows (approximately)
/*!40000 ALTER TABLE `users_role` DISABLE KEYS */;
INSERT INTO `users_role` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '2021-03-17 11:02:46', '2021-03-17 11:02:47'),
	(3, 3, 2, '2021-03-17 11:02:46', '2021-03-17 15:42:16'),
	(7, 6, 2, '2021-03-17 11:02:46', '2021-03-17 15:42:16'),
	(8, 7, 2, '2021-03-17 11:02:46', '2021-03-17 15:42:16'),
	(32, 2, 2, '2021-04-09 16:10:46', '2021-04-09 16:10:46'),
	(33, 8, 2, '2021-04-12 09:44:23', '2021-04-12 09:44:23'),
	(36, 9, 2, '2021-05-19 10:41:39', '2021-05-19 10:41:39');
/*!40000 ALTER TABLE `users_role` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

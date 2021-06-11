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
) ENGINE=InnoDB AUTO_INCREMENT=1180 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.admin_resource: ~217 rows (approximately)
/*!40000 ALTER TABLE `admin_resource` DISABLE KEYS */;
INSERT INTO `admin_resource` (`id`, `ten_hien_thi`, `resource`, `method`, `action`, `parameter`, `parameter_value`, `parent_id`, `created_at`, `updated_at`, `uri`, `status`, `show_menu`, `order`, `icon`) VALUES
	(1, 'Root', 'Root', 'GET', '#', '#', '#', NULL, '2021-02-01 09:49:23', '2021-02-02 08:33:17', '#', 1, 1, 0, NULL),
	(872, 'Đăng nhập', 'GET | App\\Http\\Controllers\\Auth\\LoginController@showLoginForm', 'GET', 'App\\Http\\Controllers\\Auth\\LoginController@showLoginForm', '', '', 1, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'login', 1, 2, 999, '<i class="fa fa-lock menu-icon"></i>'),
	(873, 'Nút đăng nhập', 'POST | App\\Http\\Controllers\\Auth\\LoginController@login', 'POST', 'App\\Http\\Controllers\\Auth\\LoginController@login', '', '', 872, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'login', 1, 2, 1000, NULL),
	(874, 'Đăng xuất', 'POST | App\\Http\\Controllers\\Auth\\LoginController@logout', 'POST', 'App\\Http\\Controllers\\Auth\\LoginController@logout', '', '', 1, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'logout', 1, 2, 999, '<i class="fa fa-unlock menu-icon"></i>'),
	(875, 'Đăng ký', 'GET | App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm', 'GET', 'App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm', '', '', 1, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'register', 1, 2, 999, '<i class="fa fa-vcard-o menu-icon"></i>'),
	(876, 'Nút đăng ký', 'POST | App\\Http\\Controllers\\Auth\\RegisterController@register', 'POST', 'App\\Http\\Controllers\\Auth\\RegisterController@register', '', '', 875, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'register', 1, 2, 1000, NULL),
	(877, 'Reset mật khẩu', 'GET | App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm', 'GET', 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm', '', '', 1, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'password/reset', 1, 2, 999, '<i class="fa fa-refresh menu-icon"></i>'),
	(878, 'password/email', 'POST | App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail', 'POST', 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail', '', '', 877, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'password/email', 1, 2, 1000, NULL),
	(879, 'Lấy token reset mật khẩu', 'GET | App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm', 'GET', 'App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm', '', '', 877, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'password/reset/{token}', 1, 2, 1000, NULL),
	(880, 'password/reset', 'POST | App\\Http\\Controllers\\Auth\\ResetPasswordController@reset', 'POST', 'App\\Http\\Controllers\\Auth\\ResetPasswordController@reset', '', '', 877, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'password/reset', 1, 2, 1000, NULL),
	(881, 'Xác nhận lại mật khẩu', 'GET | App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm', 'GET', 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm', '', '', 877, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'password/confirm', 1, 2, 1000, NULL),
	(882, 'password/confirm', 'POST | App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm', 'POST', 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm', '', '', 877, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'password/confirm', 1, 2, 1000, NULL),
	(883, 'Danh mục phường xã', 'GET | App\\Modules\\DmPhuongXa\\Controllers\\DmPhuongXaController@dmPhuongXa', 'GET', 'App\\Modules\\DmPhuongXa\\Controllers\\DmPhuongXaController@dmPhuongXa', '', '', 1, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'dm-phuong-xa', 1, 1, 18, '<i class="menu-icon icon-location-pin"></i>'),
	(884, 'Import danh mục phường xã', 'POST | App\\Modules\\DmPhuongXa\\Controllers\\DmPhuongXaController@dmPhuongXaAndImport', 'POST', 'App\\Modules\\DmPhuongXa\\Controllers\\DmPhuongXaController@dmPhuongXaAndImport', '', '', 883, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'dm-phuong-xa/import', 1, 2, 1000, NULL),
	(885, 'Danh mục quận huyện', 'GET | App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyen', 'GET', 'App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyen', '', '', 1, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'dm-quan-huyen', 1, 1, 17, '<i class="menu-icon icon-location-pin"></i>'),
	(886, 'Import danh mục quận/huyện', 'POST | App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyenAndImport', 'POST', 'App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyenAndImport', '', '', 885, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'dm-quan-huyen/import', 1, 2, 1000, NULL),
	(887, 'Đơn vị', 'GET | App\\Modules\\DonVi\\Controllers\\DonViController@donVi', 'GET', 'App\\Modules\\DonVi\\Controllers\\DonViController@donVi', '', '', 1, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'don-vi', 1, 1, 15, '<i class="fa fa-university menu-icon"></i>'),
	(888, 'Xem danh sách đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@danhSachDonVi', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@danhSachDonVi', '', '', 887, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'danh-sach-don-vi', 1, 2, 1000, NULL),
	(889, 'Thêm đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@themDonVi', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@themDonVi', '', '', 887, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'them-don-vi', 1, 2, 1000, NULL),
	(890, 'Load thông tin đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@donViSingle', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@donViSingle', '', '', 887, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'don-vi-single', 1, 2, 1000, NULL),
	(891, 'Cập nhật đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@capNhatDonVi', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@capNhatDonVi', '', '', 887, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'cap-nhat-don-vi', 1, 2, 1000, NULL),
	(892, 'Xóa đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@xoaDonVi', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@xoaDonVi', '', '', 887, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'xoa-don-vi', 1, 2, 1000, NULL),
	(893, 'Nhóm quyền', 'GET | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@nhomQuyen', 'GET', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@nhomQuyen', '', '', 1, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'nhom-quyen', 1, 1, 13, '<i class="fa fa-database menu-icon"></i>'),
	(894, 'Xem danh sách nhóm quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@danhSachNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@danhSachNhomQuyen', '', '', 893, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'danh-sach-nhom-quyen', 1, 2, 1000, NULL),
	(895, 'Thêm nhóm quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@themNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@themNhomQuyen', '', '', 893, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'them-nhom-quyen', 1, 2, 1000, NULL),
	(896, 'Load thông tin nhóm quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@nhomQuyenSingle', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@nhomQuyenSingle', '', '', 893, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'nhom-quyen-single', 1, 2, 1000, NULL),
	(897, 'Cập nhật nhóm quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@capNhatNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@capNhatNhomQuyen', '', '', 893, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'cap-nhat-nhom-quyen', 1, 2, 1000, NULL),
	(898, 'Xóa nhóm quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@xoaNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@xoaNhomQuyen', '', '', 893, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'xoa-nhom-quyen', 1, 2, 1000, NULL),
	(899, 'Phân quyền', 'GET | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyen', 'GET', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyen', '', '', 1, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'phan-quyen', 1, 1, 14, '<i class="fa fa-cogs menu-icon"></i>'),
	(900, 'Lưu thông tin quyền', 'POST | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenPost', 'POST', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenPost', '', '', 899, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'phan-quyen-post', 1, 2, 1000, NULL),
	(901, 'Load danh sách nhóm quyền', 'POST | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachNhomQuyen', 'POST', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachNhomQuyen', '', '', 899, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'phan-quyen/danh-sach-nhom-quyen', 1, 2, 1000, NULL),
	(902, 'Load danh sách quyền', 'POST | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachQuyenTheoNhomQuyenId', 'POST', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachQuyenTheoNhomQuyenId', '', '', 899, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'phan-quyen/danh-sach-quyen-theo-nhom-quyen-id', 1, 2, 1000, NULL),
	(903, 'Danh mục chức năng', 'GET | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyen', 'GET', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyen', '', '', 1, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'tai-nguyen', 1, 1, 16, '<i class="menu-icon icon-list"></i>'),
	(904, 'Xem danh sách tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@danhSachTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@danhSachTaiNguyen', '', '', 903, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'danh-sach-tai-nguyen', 1, 2, 1000, NULL),
	(905, 'Quét tài nguyên hệ thống', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@quetTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@quetTaiNguyen', '', '', 903, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'quet-tai-nguyen', 1, 2, 1000, NULL),
	(906, 'Thêm tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@themTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@themTaiNguyen', '', '', 903, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'them-tai-nguyen', 1, 2, 1000, NULL),
	(907, 'Load thông tin tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyenSingle', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyenSingle', '', '', 903, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'tai-nguyen-single', 1, 2, 1000, NULL),
	(908, 'Cập nhật tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@capNhatTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@capNhatTaiNguyen', '', '', 903, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'cap-nhat-tai-nguyen', 1, 2, 1000, NULL),
	(909, 'Xóa tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@xoaTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@xoaTaiNguyen', '', '', 903, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'xoa-tai-nguyen', 1, 2, 1000, NULL),
	(910, 'Trang chủ', 'GET | App\\Modules\\TrangChu\\Controllers\\TrangChuController@home', 'GET', 'App\\Modules\\TrangChu\\Controllers\\TrangChuController@home', '', '', 1, '2021-03-12 16:43:45', '2021-06-04 14:03:53', '/', 1, 2, 1, '<i class="fa fa-home menu-icon"></i>'),
	(912, 'Xem danh sách tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@danhSachUser', 'POST', 'App\\Modules\\User\\Controllers\\UserController@danhSachUser', '', '', 911, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'danh-sach-user', 1, 2, 1000, NULL),
	(913, 'Tạo tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@themUser', 'POST', 'App\\Modules\\User\\Controllers\\UserController@themUser', '', '', 911, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'them-user', 1, 2, 1000, NULL),
	(914, 'Load thông tin tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@userSingle', 'POST', 'App\\Modules\\User\\Controllers\\UserController@userSingle', '', '', 911, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'user-single', 1, 2, 1000, NULL),
	(915, 'Cập nhật tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@capNhatUser', 'POST', 'App\\Modules\\User\\Controllers\\UserController@capNhatUser', '', '', 911, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'cap-nhat-user', 1, 2, 1000, NULL),
	(916, 'Xóa tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@xoaUser', 'POST', 'App\\Modules\\User\\Controllers\\UserController@xoaUser', '', '', 911, '2021-03-12 16:43:45', '2021-06-04 14:03:53', 'xoa-user', 1, 2, 1000, NULL),
	(964, 'Gửi PAKN', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@payc', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@payc', '', '', 1, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'payc', 1, 1, 2, '<i class="fa fa-paper-plane menu-icon"></i>'),
	(965, 'PAKN của tôi', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycCuaToi', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycCuaToi', '', '', 1, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'danh-sach-payc-cua-toi', 1, 1, 4, '<i class="fa fa-shield menu-icon"></i>'),
	(966, 'PAKN chờ tiếp nhận', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoTiepNhan', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoTiepNhan', '', '', 1006, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'danh-sach-payc-cho-tiep-nhan', 1, 1, 1000, NULL),
	(967, 'Form tiếp nhận và chuyển xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmTiepNhanVaChuyenXuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmTiepNhanVaChuyenXuLy', '', '', 1006, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'frm-tiep-nhan-va-chuyen-xu-ly', 1, 2, 1000, NULL),
	(968, 'Tiếp nhận và chuyển xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@tiepNhanVaChuyenXuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@tiepNhanVaChuyenXuLy', '', '', 967, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'tiep-nhan-va-chuyen-xu-ly', 1, 2, 1000, NULL),
	(969, 'PAKN chờ xử lý', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoXuLy', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoXuLy', '', '', 1006, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'danh-sach-payc-cho-xu-ly', 1, 1, 1000, NULL),
	(970, 'Form xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmXuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmXuLy', '', '', 1006, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'frm-xu-ly', 1, 2, 1000, NULL),
	(971, 'Xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@xuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@xuLy', '', '', 970, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'xu-ly', 1, 2, 1000, NULL),
	(972, 'PAKN chờ duyệt', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoDuyet', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoDuyet', '', '', 1006, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'danh-sach-payc-cho-duyet', 1, 1, 1000, NULL),
	(973, 'Frm duyệt', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmDuyet', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmDuyet', '', '', 1006, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'frm-duyet', 1, 2, 1000, NULL),
	(974, 'Duyệt', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@duyet', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@duyet', '', '', 973, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'duyet', 1, 2, 1000, NULL),
	(975, 'Form chuyển bộ phận tiếp nhận & xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmChuyenBoPhanTiepNhanVaXuLyPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmChuyenBoPhanTiepNhanVaXuLyPayc', '', '', 1006, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'frm-chuyen-bo-phan-tiep-nhan-va-xu-ly-payc', 1, 2, 1000, NULL),
	(976, 'Chuyển bộ phận tiếp nhận & xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@chuyenBoPhanTiepNhanVaXuLyPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@chuyenBoPhanTiepNhanVaXuLyPayc', '', '', 975, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'chuyen-bo-phan-tiep-nhan-va-xu-ly-payc', 1, 2, 1000, NULL),
	(977, 'Form chuyển lãnh đạo', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmChuyenLanhDao', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmChuyenLanhDao', '', '', 1006, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'frm-chuyen-lanh-dao', 1, 2, 1000, NULL),
	(978, 'Chuyển lãnh đạo', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@chuyenLanhDao', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@chuyenLanhDao', '', '', 977, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'chuyen-lanh-dao', 1, 2, 1000, NULL),
	(979, 'Form chuyển cấp trên', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmChuyenCapTren', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmChuyenCapTren', '', '', 1006, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'frm-chuyen-cap-tren', 1, 2, 1000, NULL),
	(980, 'Chuyển cấp trên', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@chuyenCapTren', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@chuyenCapTren', '', '', 979, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'chuyen-cap-tren', 1, 2, 1000, NULL),
	(981, 'Form hoàn tất xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmHoanTat', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmHoanTat', '', '', 1006, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'frm-hoan-tat', 1, 2, 1000, NULL),
	(982, 'Hoàn tất xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@hoanTat', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@hoanTat', '', '', 981, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'hoan-tat', 1, 2, 1000, NULL),
	(983, 'From trả PAKN lại (Không xử lý)', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmTraLaiKhongXuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmTraLaiKhongXuLy', '', '', 1006, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'frm-tra-lai-khong-xu-ly', 1, 2, 1000, NULL),
	(984, 'Trả lại PAKN không xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@traLaiKhongXuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@traLaiKhongXuLy', '', '', 983, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'tra-lai-khong-xu-ly', 1, 2, 1000, NULL),
	(985, 'Form hủy PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmHuy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmHuy', '', '', 1006, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'frm-huy', 1, 2, 1000, NULL),
	(986, 'Hủy PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@huy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@huy', '', '', 985, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'huy', 1, 2, 1000, NULL),
	(987, 'Form cập nhật PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmCapNhatPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmCapNhatPayc', '', '', 1006, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'frm-cap-nhat-payc', 1, 2, 1000, NULL),
	(988, 'Cập nhật PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@capNhatPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@capNhatPayc', '', '', 987, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'cap-nhat-payc', 1, 2, 1000, NULL),
	(989, 'PAKN đã hoàn tất xử lý', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycDaHoanTat', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycDaHoanTat', '', '', 1006, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'danh-sach-payc-da-hoan-tat', 1, 1, 1000, NULL),
	(990, 'Chuyển khách hàng đánh giá', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@chuyenKHDanhGia', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@chuyenKHDanhGia', '', '', 1006, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'chuyen-kh-danh-gia', 1, 2, 1000, NULL),
	(991, 'Đánh giá PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@danhGia', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@danhGia', '', '', 1006, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'danh-gia', 1, 2, 1000, NULL),
	(992, 'Quá trình xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@qtxl', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@qtxl', '', '', 1006, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'qtxl', 1, 2, 1000, NULL),
	(993, 'Thêm PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@themPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@themPayc', '', '', 964, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'them-payc', 1, 2, 1000, NULL),
	(994, 'PAKN theo tài khoản', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycTheoTaiKhoan', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycTheoTaiKhoan', '', '', 1006, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'danh-sach-payc-theo-tai-khoan', 1, 1, 1000, NULL),
	(995, 'PAKN chưa thụ lý', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChuaCoCanBoNhan', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChuaCoCanBoNhan', '', '', 1006, '2021-03-17 08:35:39', '2021-06-04 14:03:53', 'danh-sach-payc-chua-co-can-bo-nhan', 1, 1, 1000, NULL),
	(996, 'To do', 'GET | App\\Modules\\ToDo\\Controllers\\ToDoController@toDo', 'GET', 'App\\Modules\\ToDo\\Controllers\\ToDoController@toDo', '', '', 1, '2021-03-17 08:35:40', '2021-06-04 14:03:53', 'to-do', 1, 1, 6, '<i class="fa fa-clock-o menu-icon"></i>'),
	(997, 'Xem danh sách ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@danhSachToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@danhSachToDo', '', '', 996, '2021-03-17 08:35:40', '2021-06-04 14:03:53', 'danh-sach-to-do', 1, 2, 1000, NULL),
	(998, 'Thêm ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@themToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@themToDo', '', '', 996, '2021-03-17 08:35:40', '2021-06-04 14:03:53', 'them-to-do', 1, 2, 1000, NULL),
	(999, 'Load thông tin ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@toDoSingle', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@toDoSingle', '', '', 996, '2021-03-17 08:35:40', '2021-06-04 14:03:53', 'to-do-single', 1, 2, 1000, NULL),
	(1000, 'Cập nhật ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@capNhatToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@capNhatToDo', '', '', 996, '2021-03-17 08:35:40', '2021-06-04 14:03:53', 'cap-nhat-to-do', 1, 2, 1000, NULL),
	(1001, 'Xóa ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@xoaToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@xoaToDo', '', '', 996, '2021-03-17 08:35:40', '2021-06-04 14:03:53', 'xoa-to-do', 1, 2, 1000, NULL),
	(1003, 'Gạch ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@checkToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@checkToDo', '', '', 996, '2021-03-17 08:35:40', '2021-06-04 14:03:53', 'check-to-do', 1, 2, 1000, NULL),
	(1004, 'Bỏ gạch ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@uncheckToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@uncheckToDo', '', '', 996, '2021-03-17 08:35:40', '2021-06-04 14:03:53', 'uncheck-to-do', 1, 2, 1000, NULL),
	(1005, 'Sắp xếp lại ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@sortToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@sortToDo', '', '', 996, '2021-03-17 08:35:40', '2021-06-04 14:03:53', 'sort-to-do', 1, 2, 1000, NULL),
	(1006, 'Xử lý PAKN', NULL, 'GET', NULL, NULL, NULL, 1, '2021-03-17 08:52:37', '2021-04-09 16:38:54', NULL, 1, 1, 3, '<i class="fa fa-keyboard-o menu-icon"></i>'),
	(1025, 'API đăng nhập', 'POST | App\\Modules\\API\\Controllers\\PassportAuthController@apiDangNhap', 'POST', 'App\\Modules\\API\\Controllers\\PassportAuthController@apiDangNhap', '', '', 1064, '2021-03-25 10:19:24', '2021-06-04 14:03:53', 'api/auth/api-dang-nhap', 1, 1, 1000, NULL),
	(1026, 'API tạo tài khoản', 'POST | App\\Modules\\API\\Controllers\\PassportAuthController@apiTaoTaiKhoan', 'POST', 'App\\Modules\\API\\Controllers\\PassportAuthController@apiTaoTaiKhoan', '', '', 1064, '2021-03-25 10:19:24', '2021-06-04 14:03:53', 'api/auth/api-tao-tai-khoan', 1, 1, 1000, NULL),
	(1027, 'API đăng xuất', 'GET | App\\Modules\\API\\Controllers\\PassportAuthController@apiDangXuat', 'GET', 'App\\Modules\\API\\Controllers\\PassportAuthController@apiDangXuat', '', '', 1064, '2021-03-25 10:19:24', '2021-06-04 14:03:53', 'api/auth/api-dang-xuat', 1, 1, 1000, NULL),
	(1028, 'API lấy thông tin tài khoản', 'GET | App\\Modules\\API\\Controllers\\PassportAuthController@apiGetUser', 'GET', 'App\\Modules\\API\\Controllers\\PassportAuthController@apiGetUser', '', '', 1064, '2021-03-25 10:19:24', '2021-06-04 14:03:53', 'api/auth/api-get-user', 1, 1, 1000, NULL),
	(1030, 'API gửi PAKN', 'POST | App\\Modules\\API\\Controllers\\ApiPaycController@apiGuiPakn', 'POST', 'App\\Modules\\API\\Controllers\\ApiPaycController@apiGuiPakn', '', '', 1064, '2021-03-25 10:19:24', '2021-06-04 14:03:53', 'api/api-gui-pakn', 1, 1, 1000, NULL),
	(1031, 'API lấy danh mục dịch vụ', 'GET | App\\Modules\\API\\Controllers\\ApiDichVuController@layDanhMucDichVu', 'GET', 'App\\Modules\\API\\Controllers\\ApiDichVuController@layDanhMucDichVu', '', '', 1064, '2021-03-25 10:19:25', '2021-06-04 14:03:53', 'api/api-lay-danh-muc-dich-vu', 1, 1, 1000, NULL),
	(1032, 'API lấy danh mục quận/huyện', 'GET | App\\Modules\\API\\Controllers\\ApiDmQuanHuyenController@layDanhMucQuanHuyen', 'GET', 'App\\Modules\\API\\Controllers\\ApiDmQuanHuyenController@layDanhMucQuanHuyen', '', '', 1064, '2021-03-25 10:19:25', '2021-06-04 14:03:53', 'api/api-lay-danh-muc-quan-huyen', 1, 1, 1000, NULL),
	(1033, 'API lấy danh mục phường/xã', 'GET | App\\Modules\\API\\Controllers\\ApiDmPhuongXaController@layDanhMucPhuongXa', 'GET', 'App\\Modules\\API\\Controllers\\ApiDmPhuongXaController@layDanhMucPhuongXa', '', '', 1064, '2021-03-25 10:19:25', '2021-06-04 14:03:53', 'api/api-lay-danh-muc-phuong-xa', 1, 1, 1000, NULL),
	(1034, 'API lấy danh mục phường/xã theo quận/huyện', 'GET | App\\Modules\\API\\Controllers\\ApiDmPhuongXaController@layDanhMucPhuongXaTheoMaQuanHuyen', 'GET', 'App\\Modules\\API\\Controllers\\ApiDmPhuongXaController@layDanhMucPhuongXaTheoMaQuanHuyen', '', '', 1064, '2021-03-25 10:19:25', '2021-06-04 14:03:53', 'api/api-lay-danh-muc-phuong-xa-theo-ma-quan-huyen', 1, 1, 1000, NULL),
	(1035, 'Đăng ký PAKN', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@dangKyPayc', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@dangKyPayc', '', '', 1006, '2021-03-25 10:19:27', '2021-06-04 14:03:53', 'dang-ky-payc', 1, 1, 1000, NULL),
	(1036, 'Lưu đăng ký PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@luuDangKyPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@luuDangKyPayc', '', '', 1035, '2021-03-25 10:19:27', '2021-06-04 14:03:53', 'luu-dang-ky-payc', 1, 2, 1000, NULL),
	(1038, 'Lưu thông tin đơn vị cho user', 'POST | App\\Modules\\User\\Controllers\\UserController@luuUserDonVi', 'POST', 'App\\Modules\\User\\Controllers\\UserController@luuUserDonVi', '', '', 1037, '2021-03-25 10:19:29', '2021-06-04 14:03:53', 'luu-user-dv', 1, 2, 1000, NULL),
	(1039, 'Load danh sách đơn vị theo User', 'POST | App\\Modules\\User\\Controllers\\UserController@loadDsUserDonvi', 'POST', 'App\\Modules\\User\\Controllers\\UserController@loadDsUserDonvi', '', '', 1037, '2021-03-25 10:19:29', '2021-06-04 14:03:53', 'load-danh-sach-user-donvi', 1, 2, 1000, NULL),
	(1040, 'Xóa đơn vị theo User', 'POST | App\\Modules\\User\\Controllers\\UserController@xoaUserDonVi', 'POST', 'App\\Modules\\User\\Controllers\\UserController@xoaUserDonVi', '', '', 1037, '2021-03-25 10:19:29', '2021-06-04 14:03:53', 'xoa-user-donvi', 1, 2, 1000, NULL),
	(1041, 'API xem danh sách PAKN đã gửi', 'POST | App\\Modules\\API\\Controllers\\ApiPaycController@layPaycCuaToi', 'POST', 'App\\Modules\\API\\Controllers\\ApiPaycController@layPaycCuaToi', '', '', 1064, '2021-04-09 16:27:21', '2021-06-04 14:03:53', 'api/api-payc-cua-toi', 1, 1, 1000, NULL),
	(1042, 'Frm duyệt và chuyển xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmDuyetVaChuyenXuLyPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmDuyetVaChuyenXuLyPayc', '', '', 1006, '2021-04-09 16:27:21', '2021-06-04 14:03:53', 'frm-duyet-va-chuyen-xu-ly-payc', 1, 2, 1000, NULL),
	(1043, 'Duyệt và chuyển xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@duyetVaChuyenXuLyPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@duyetVaChuyenXuLyPayc', '', '', 1042, '2021-04-09 16:27:21', '2021-06-04 14:03:53', 'duyet-va-chuyen-xu-ly-payc', 1, 2, 1000, NULL),
	(1044, 'Frm xử lý và chuyển lạnh đạo', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmXuLyVaChuyenLanhDao', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmXuLyVaChuyenLanhDao', '', '', 1006, '2021-04-09 16:27:21', '2021-06-04 14:03:53', 'frm-xu-ly-va-chuyen-lanh-dao', 1, 2, 1000, NULL),
	(1045, 'Xử lý và chuyển lãnh đạo', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@xuLyVaChuyenLanhDao', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@xuLyVaChuyenLanhDao', '', '', 1044, '2021-04-09 16:27:21', '2021-06-04 14:03:53', 'xu-ly-va-chuyen-lanh-dao', 1, 2, 1000, NULL),
	(1046, 'Frm duyệt và hoàn tất xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmDuyetVaHoanTatXuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmDuyetVaHoanTatXuLy', '', '', 1006, '2021-04-09 16:27:21', '2021-06-04 14:03:53', 'frm-duyet-va-hoan-tat-xu-ly', 1, 2, 1000, NULL),
	(1047, 'Duyệt và hoàn tất xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@duyetVahoanTatXuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@duyetVahoanTatXuLy', '', '', 1046, '2021-04-09 16:27:21', '2021-06-04 14:03:53', 'duyet-va-hoan-tat-xu-ly', 1, 2, 1000, NULL),
	(1048, 'Xem chi tiết PAKN', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@chiTietPayc', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@chiTietPayc', '', '', 1, '2021-04-09 16:27:21', '2021-06-04 14:03:53', 'chi-tiet-payc', 1, 1, 4, '<i class="fa fa-eye menu-icon"></i>'),
	(1049, 'Xem chi tiết nội dung PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@chiTietPaycNoiDungSingle', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@chiTietPaycNoiDungSingle', '', '', 1048, '2021-04-09 16:27:21', '2021-06-04 14:03:53', 'chi-tiet-payc-noi-dung-single', 1, 2, 1000, NULL),
	(1050, 'Bình luận PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@chiTietPaycFrmBinhLuanSingle', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@chiTietPaycFrmBinhLuanSingle', '', '', 1048, '2021-04-09 16:27:21', '2021-06-04 14:03:53', 'chi-tiet-payc-frm-binh-luan-single', 1, 2, 1000, NULL),
	(1051, 'Gửi bình luận', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@guiBinhLuan', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@guiBinhLuan', '', '', 1050, '2021-04-09 16:27:21', '2021-06-04 14:03:53', 'gui-binh-luan', 1, 2, 1000, NULL),
	(1052, 'Danh sách bình luận', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@danhSachBinhLuan', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachBinhLuan', '', '', 1048, '2021-04-09 16:27:21', '2021-06-04 14:03:53', 'danh-sach-binh-luan', 1, 2, 1000, NULL),
	(1053, 'Đánh giá hài lòng', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@haiLong', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@haiLong', '', '', 1052, '2021-04-09 16:27:21', '2021-06-04 14:03:53', 'hai-long', 1, 2, 1000, NULL),
	(1054, 'Không hài lòng', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@khongHaiLong', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@khongHaiLong', '', '', 1052, '2021-04-09 16:27:21', '2021-06-04 14:03:53', 'khong-hai-long', 1, 2, 1000, NULL),
	(1055, 'Frm phản hồi bình luận', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@chiTietPaycFrmCanBoPhanHoiBinhLuanSingle', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@chiTietPaycFrmCanBoPhanHoiBinhLuanSingle', '', '', 1006, '2021-04-09 16:27:21', '2021-06-04 14:03:53', 'chi-tiet-payc-frm-can-bo-phan-hoi-binh-luan-single', 1, 2, 1000, NULL),
	(1056, 'Phản hồi bình luận', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@traLoiBinhLuan', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@traLoiBinhLuan', '', '', 1055, '2021-04-09 16:27:21', '2021-06-04 14:03:53', 'tra-loi-binh-luan', 1, 2, 1000, NULL),
	(1058, 'Tài khoản', 'GET | App\\Modules\\User\\Controllers\\UserController@user', 'GET', 'App\\Modules\\User\\Controllers\\UserController@user', '', '', 1, '2021-04-09 16:27:21', '2021-06-04 14:03:53', 'tai-khoan', 1, 1, 5, '<i class="fa fa-address-book menu-icon"></i>'),
	(1059, 'Load thông tin đơn vị theo tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@userDonViSingle', 'POST', 'App\\Modules\\User\\Controllers\\UserController@userDonViSingle', '', '', 1058, '2021-04-09 16:27:21', '2021-06-04 14:03:53', 'user-don-vi-single', 1, 2, 1000, NULL),
	(1060, 'Load thông tin nhóm quyền theo tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@userRoleSingle', 'POST', 'App\\Modules\\User\\Controllers\\UserController@userRoleSingle', '', '', 1058, '2021-04-09 16:27:21', '2021-06-04 14:03:53', 'user-role-single', 1, 2, 1000, NULL),
	(1061, 'Phân nhóm quyền cho tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@phanQuyenUserRole', 'POST', 'App\\Modules\\User\\Controllers\\UserController@phanQuyenUserRole', '', '', 1058, '2021-04-09 16:27:21', '2021-06-04 14:03:53', 'phan-quyen-user-role', 1, 2, 1000, NULL),
	(1062, 'Xem thông tin cá nhân', 'GET | App\\Modules\\User\\Controllers\\UserController@thongTinCaNhan', 'GET', 'App\\Modules\\User\\Controllers\\UserController@thongTinCaNhan', '', '', 1058, '2021-04-09 16:27:21', '2021-06-04 14:03:53', 'thong-tin-ca-nhan', 1, 2, 1000, NULL),
	(1063, 'Cập nhật thông tin cá nhân', 'POST | App\\Modules\\User\\Controllers\\UserController@capNhatThongTinCaNhan', 'POST', 'App\\Modules\\User\\Controllers\\UserController@capNhatThongTinCaNhan', '', '', 1058, '2021-04-09 16:27:21', '2021-06-04 14:03:53', 'cap-nhat-thong-tin-ca-nhan', 1, 2, 1000, NULL),
	(1064, 'API', '#', 'GET', NULL, NULL, NULL, 1, '2021-04-09 16:45:39', '2021-05-28 09:23:48', NULL, 1, 1, 25, '<i class="fa fa-globe menu-icon"></i>'),
	(1065, 'Danh mục dịch vụ', 'GET | App\\Modules\\DichVu\\Controllers\\DichVuController@dichVu', 'GET', 'App\\Modules\\DichVu\\Controllers\\DichVuController@dichVu', '', '', 1, '2021-05-26 15:35:27', '2021-06-04 14:03:53', 'dich-vu', 1, 1, 19, '<i class="menu-icon icon-list"></i>'),
	(1066, 'Xem danh sách dịch vụ', 'POST | App\\Modules\\DichVu\\Controllers\\DichVuController@danhSachDichVu', 'POST', 'App\\Modules\\DichVu\\Controllers\\DichVuController@danhSachDichVu', '', '', 1065, '2021-05-26 15:35:27', '2021-06-04 14:03:53', 'danh-sach-dich-vu', 1, 2, 1000, NULL),
	(1067, 'Thêm mới danh mục dịch vụ', 'POST | App\\Modules\\DichVu\\Controllers\\DichVuController@themDichVu', 'POST', 'App\\Modules\\DichVu\\Controllers\\DichVuController@themDichVu', '', '', 1065, '2021-05-26 15:35:27', '2021-06-04 14:03:53', 'them-dich-vu', 1, 2, 1000, NULL),
	(1068, 'Load chi tiết danh mục dịch vụ', 'POST | App\\Modules\\DichVu\\Controllers\\DichVuController@dichVuSingle', 'POST', 'App\\Modules\\DichVu\\Controllers\\DichVuController@dichVuSingle', '', '', 1065, '2021-05-26 15:35:27', '2021-06-04 14:03:53', 'dich-vu-single', 1, 2, 1000, NULL),
	(1069, 'Cập nhật danh mục dịch vụ', 'POST | App\\Modules\\DichVu\\Controllers\\DichVuController@capNhatDichVu', 'POST', 'App\\Modules\\DichVu\\Controllers\\DichVuController@capNhatDichVu', '', '', 1065, '2021-05-26 15:35:27', '2021-06-04 14:03:53', 'cap-nhat-dich-vu', 1, 2, 1000, NULL),
	(1070, 'Xóa danh mục dịch vụ', 'POST | App\\Modules\\DichVu\\Controllers\\DichVuController@xoaDichVu', 'POST', 'App\\Modules\\DichVu\\Controllers\\DichVuController@xoaDichVu', '', '', 1065, '2021-05-26 15:35:27', '2021-06-04 14:03:53', 'xoa-dich-vu', 1, 2, 1000, NULL),
	(1071, 'Hoàn tất đã xem', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@hoanTatDaXem', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@hoanTatDaXem', '', '', 969, '2021-05-26 15:35:27', '2021-06-04 14:03:53', 'hoan-tat-da-xem', 1, 2, 1000, NULL),
	(1072, 'Hoàn tất phối hợp xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@hoanTatPhoiHop', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@hoanTatPhoiHop', '', '', 969, '2021-05-26 15:35:27', '2021-06-04 14:03:53', 'hoan-tat-phoi-hop', 1, 2, 1000, NULL),
	(1073, 'Đánh dấu đã xem bình luận', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@danhDauDaXemBinhLuan', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@danhDauDaXemBinhLuan', '', '', 1052, '2021-05-26 15:35:27', '2021-06-04 14:03:53', 'danh-dau-da-xem-binh-luan', 1, 2, 1000, NULL),
	(1074, 'Đánh dấu đã xem PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@danhDauDaXemPakn', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@danhDauDaXemPakn', '', '', 1049, '2021-05-26 15:35:27', '2021-06-04 14:03:53', 'danh-dau-da-xem-pakn', 1, 2, 1000, NULL),
	(1075, 'Xem chi tiết dịch vụ từng tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@userDichVuSingle', 'POST', 'App\\Modules\\User\\Controllers\\UserController@userDichVuSingle', '', '', 1058, '2021-05-26 15:35:27', '2021-06-04 14:03:53', 'user-dich-vu-single', 1, 2, 1000, NULL),
	(1076, 'Danh sách dịch vụ từng tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@danhSachDichVuTheoTaiKhoan', 'POST', 'App\\Modules\\User\\Controllers\\UserController@danhSachDichVuTheoTaiKhoan', '', '', 1058, '2021-05-26 15:35:27', '2021-06-04 14:03:53', 'danh-sach-dich-vu-theo-tai-khoan', 1, 2, 1000, NULL),
	(1077, 'Phân dịch vụ cho tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@themUserDichVu', 'POST', 'App\\Modules\\User\\Controllers\\UserController@themUserDichVu', '', '', 1058, '2021-05-26 15:35:27', '2021-06-04 14:03:53', 'them-user-dich-vu', 1, 2, 1000, NULL),
	(1078, 'Xóa dịch vụ theo tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@xoaUserDichVu', 'POST', 'App\\Modules\\User\\Controllers\\UserController@xoaUserDichVu', '', '', 1058, '2021-05-26 15:35:27', '2021-06-04 14:03:53', 'xoa-user-dich-vu', 1, 2, 1000, NULL),
	(1079, 'Nhóm dịch vụ', 'GET | App\\Modules\\NhomDichVu\\Controllers\\NhomDichVuController@nhomDichVu', 'GET', 'App\\Modules\\NhomDichVu\\Controllers\\NhomDichVuController@nhomDichVu', '', '', 1, '2021-05-26 16:03:56', '2021-06-04 14:03:53', 'nhom-dich-vu', 1, 1, 20, '<i class="menu-icon icon-list"></i>'),
	(1080, 'Xem danh sách nhóm dịch vu', 'POST | App\\Modules\\NhomDichVu\\Controllers\\NhomDichVuController@danhSachNhomDichVu', 'POST', 'App\\Modules\\NhomDichVu\\Controllers\\NhomDichVuController@danhSachNhomDichVu', '', '', 1079, '2021-05-26 16:03:56', '2021-06-04 14:03:53', 'danh-sach-nhom-dich-vu', 1, 2, 1000, NULL),
	(1081, 'Thêm nhóm dịch vụ', 'POST | App\\Modules\\NhomDichVu\\Controllers\\NhomDichVuController@themNhomDichVu', 'POST', 'App\\Modules\\NhomDichVu\\Controllers\\NhomDichVuController@themNhomDichVu', '', '', 1079, '2021-05-26 16:03:56', '2021-06-04 14:03:53', 'them-nhom-dich-vu', 1, 2, 1000, NULL),
	(1082, 'Chi tiết nhóm dịch vụ', 'POST | App\\Modules\\NhomDichVu\\Controllers\\NhomDichVuController@nhomDichVuSingle', 'POST', 'App\\Modules\\NhomDichVu\\Controllers\\NhomDichVuController@nhomDichVuSingle', '', '', 1079, '2021-05-26 16:03:56', '2021-06-04 14:03:53', 'nhom-dich-vu-single', 1, 2, 1000, NULL),
	(1083, 'Cập nhật nhóm dịch vu', 'POST | App\\Modules\\NhomDichVu\\Controllers\\NhomDichVuController@capNhatNhomDichVu', 'POST', 'App\\Modules\\NhomDichVu\\Controllers\\NhomDichVuController@capNhatNhomDichVu', '', '', 1079, '2021-05-26 16:03:56', '2021-06-04 14:03:53', 'cap-nhat-nhom-dich-vu', 1, 2, 1000, NULL),
	(1084, 'Xóa nhóm dịch vụ', 'POST | App\\Modules\\NhomDichVu\\Controllers\\NhomDichVuController@xoaNhomDichVu', 'POST', 'App\\Modules\\NhomDichVu\\Controllers\\NhomDichVuController@xoaNhomDichVu', '', '', 1079, '2021-05-26 16:03:56', '2021-06-04 14:03:53', 'xoa-nhom-dich-vu', 1, 2, 1000, NULL),
	(1085, 'Danh mục chức danh', 'GET | App\\Modules\\ChucDanh\\Controllers\\ChucDanhController@chucDanh', 'GET', 'App\\Modules\\ChucDanh\\Controllers\\ChucDanhController@chucDanh', '', '', 1, '2021-05-26 17:04:22', '2021-06-04 14:03:53', 'chuc-danh', 1, 1, 21, '<i class="menu-icon icon-list"></i>'),
	(1086, 'Xem danh sách chức danh', 'POST | App\\Modules\\ChucDanh\\Controllers\\ChucDanhController@danhSachChucDanh', 'POST', 'App\\Modules\\ChucDanh\\Controllers\\ChucDanhController@danhSachChucDanh', '', '', 1085, '2021-05-26 17:04:22', '2021-06-04 14:03:53', 'danh-sach-chuc-danh', 1, 2, 1000, NULL),
	(1087, 'Thêm chức danh', 'POST | App\\Modules\\ChucDanh\\Controllers\\ChucDanhController@themChucDanh', 'POST', 'App\\Modules\\ChucDanh\\Controllers\\ChucDanhController@themChucDanh', '', '', 1085, '2021-05-26 17:04:22', '2021-06-04 14:03:53', 'them-chuc-danh', 1, 2, 1000, NULL),
	(1088, 'Xem chi tiết chức danh', 'POST | App\\Modules\\ChucDanh\\Controllers\\ChucDanhController@chucDanhSingle', 'POST', 'App\\Modules\\ChucDanh\\Controllers\\ChucDanhController@chucDanhSingle', '', '', 1085, '2021-05-26 17:04:22', '2021-06-04 14:03:53', 'chuc-danh-single', 1, 2, 1000, NULL),
	(1089, 'Cập nhật chức danh', 'POST | App\\Modules\\ChucDanh\\Controllers\\ChucDanhController@capNhatChucDanh', 'POST', 'App\\Modules\\ChucDanh\\Controllers\\ChucDanhController@capNhatChucDanh', '', '', 1085, '2021-05-26 17:04:22', '2021-06-04 14:03:53', 'cap-nhat-chuc-danh', 1, 2, 1000, NULL),
	(1090, 'Xóa chức danh', 'POST | App\\Modules\\ChucDanh\\Controllers\\ChucDanhController@xoaChucDanh', 'POST', 'App\\Modules\\ChucDanh\\Controllers\\ChucDanhController@xoaChucDanh', '', '', 1085, '2021-05-26 17:04:22', '2021-06-04 14:03:53', 'xoa-chuc-danh', 1, 2, 1000, NULL),
	(1091, 'Danh mục chức vụ', 'GET | App\\Modules\\ChucVu\\Controllers\\ChucVuController@chucVu', 'GET', 'App\\Modules\\ChucVu\\Controllers\\ChucVuController@chucVu', '', '', 1, '2021-05-26 17:04:22', '2021-06-04 14:03:53', 'chuc-vu', 1, 1, 22, '<i class="menu-icon icon-list"></i>'),
	(1092, 'Xem danh sách chức vụ', 'POST | App\\Modules\\ChucVu\\Controllers\\ChucVuController@danhSachChucVu', 'POST', 'App\\Modules\\ChucVu\\Controllers\\ChucVuController@danhSachChucVu', '', '', 1091, '2021-05-26 17:04:22', '2021-06-04 14:03:53', 'danh-sach-chuc-vu', 1, 2, 1000, NULL),
	(1093, 'Thêm chức vụ', 'POST | App\\Modules\\ChucVu\\Controllers\\ChucVuController@themChucVu', 'POST', 'App\\Modules\\ChucVu\\Controllers\\ChucVuController@themChucVu', '', '', 1091, '2021-05-26 17:04:22', '2021-06-04 14:03:53', 'them-chuc-vu', 1, 2, 1000, NULL),
	(1094, 'Xem chi tiết chức vụ', 'POST | App\\Modules\\ChucVu\\Controllers\\ChucVuController@chucVuSingle', 'POST', 'App\\Modules\\ChucVu\\Controllers\\ChucVuController@chucVuSingle', '', '', 1091, '2021-05-26 17:04:22', '2021-06-04 14:03:53', 'chuc-vu-single', 1, 2, 1000, NULL),
	(1095, 'Cập nhật chức vụ', 'POST | App\\Modules\\ChucVu\\Controllers\\ChucVuController@capNhatChucVu', 'POST', 'App\\Modules\\ChucVu\\Controllers\\ChucVuController@capNhatChucVu', '', '', 1091, '2021-05-26 17:04:22', '2021-06-04 14:03:53', 'cap-nhat-chuc-vu', 1, 2, 1000, NULL),
	(1096, 'Xóa chức vụ', 'POST | App\\Modules\\ChucVu\\Controllers\\ChucVuController@xoaChucVu', 'POST', 'App\\Modules\\ChucVu\\Controllers\\ChucVuController@xoaChucVu', '', '', 1091, '2021-05-26 17:04:22', '2021-06-04 14:03:53', 'xoa-chuc-vu', 1, 2, 1000, NULL),
	(1097, 'Nhóm chức vụ', 'GET | App\\Modules\\NhomChucVu\\Controllers\\NhomChucVuController@nhomChucVu', 'GET', 'App\\Modules\\NhomChucVu\\Controllers\\NhomChucVuController@nhomChucVu', '', '', 1, '2021-05-26 17:04:22', '2021-06-04 14:03:53', 'nhom-chuc-vu', 1, 1, 23, '<i class="menu-icon icon-list"></i>'),
	(1098, 'Xem danh sách nhóm chức vụ', 'POST | App\\Modules\\NhomChucVu\\Controllers\\NhomChucVuController@danhSachNhomChucVu', 'POST', 'App\\Modules\\NhomChucVu\\Controllers\\NhomChucVuController@danhSachNhomChucVu', '', '', 1097, '2021-05-26 17:04:22', '2021-06-04 14:03:53', 'danh-sach-nhom-chuc-vu', 1, 2, 1000, NULL),
	(1099, 'Thêm nhóm chức vụ', 'POST | App\\Modules\\NhomChucVu\\Controllers\\NhomChucVuController@themNhomChucVu', 'POST', 'App\\Modules\\NhomChucVu\\Controllers\\NhomChucVuController@themNhomChucVu', '', '', 1097, '2021-05-26 17:04:22', '2021-06-04 14:03:53', 'them-nhom-chuc-vu', 1, 2, 1000, NULL),
	(1100, 'Xem chi tiết nhóm chức vụ', 'POST | App\\Modules\\NhomChucVu\\Controllers\\NhomChucVuController@nhomChucVuSingle', 'POST', 'App\\Modules\\NhomChucVu\\Controllers\\NhomChucVuController@nhomChucVuSingle', '', '', 1097, '2021-05-26 17:04:22', '2021-06-04 14:03:53', 'nhom-chuc-vu-single', 1, 2, 1000, NULL),
	(1101, 'Cập nhật nhóm chức vụ', 'POST | App\\Modules\\NhomChucVu\\Controllers\\NhomChucVuController@capNhatNhomChucVu', 'POST', 'App\\Modules\\NhomChucVu\\Controllers\\NhomChucVuController@capNhatNhomChucVu', '', '', 1097, '2021-05-26 17:04:22', '2021-06-04 14:03:53', 'cap-nhat-nhom-chuc-vu', 1, 2, 1000, NULL),
	(1102, 'Xóa nhóm chức vụ', 'POST | App\\Modules\\NhomChucVu\\Controllers\\NhomChucVuController@xoaNhomChucVu', 'POST', 'App\\Modules\\NhomChucVu\\Controllers\\NhomChucVuController@xoaNhomChucVu', '', '', 1097, '2021-05-26 17:04:22', '2021-06-04 14:03:53', 'xoa-nhom-chuc-vu', 1, 2, 1000, NULL),
	(1103, 'Danh mục tham số hệ thống', 'GET | App\\Modules\\DmThamSoHeThong\\Controllers\\DmThamSoHeThongController@dmThamSoHeThong', 'GET', 'App\\Modules\\DmThamSoHeThong\\Controllers\\DmThamSoHeThongController@dmThamSoHeThong', '', '', 1, '2021-05-28 08:34:03', '2021-06-04 14:03:53', 'dm-tham-so-he-thong', 1, 1, 24, '<i class="menu-icon icon-list"></i>'),
	(1104, 'danh-sach-dm-tham-so-he-thong', 'POST | App\\Modules\\DmThamSoHeThong\\Controllers\\DmThamSoHeThongController@danhSachDmThamSoHeThong', 'POST', 'App\\Modules\\DmThamSoHeThong\\Controllers\\DmThamSoHeThongController@danhSachDmThamSoHeThong', '', '', 1103, '2021-05-28 08:34:03', '2021-06-04 14:03:53', 'danh-sach-dm-tham-so-he-thong', 1, 2, 1000, NULL),
	(1105, 'Thêm danh mục tham số hệ thống', 'POST | App\\Modules\\DmThamSoHeThong\\Controllers\\DmThamSoHeThongController@themDmThamSoHeThong', 'POST', 'App\\Modules\\DmThamSoHeThong\\Controllers\\DmThamSoHeThongController@themDmThamSoHeThong', '', '', 1103, '2021-05-28 08:34:03', '2021-06-04 14:03:53', 'them-dm-tham-so-he-thong', 1, 2, 1000, NULL),
	(1106, 'Xem chi tiết dm tham số hệ thống', 'POST | App\\Modules\\DmThamSoHeThong\\Controllers\\DmThamSoHeThongController@dmThamSoHeThongSingle', 'POST', 'App\\Modules\\DmThamSoHeThong\\Controllers\\DmThamSoHeThongController@dmThamSoHeThongSingle', '', '', 1103, '2021-05-28 08:34:03', '2021-06-04 14:03:53', 'dm-tham-so-he-thong-single', 1, 2, 1000, NULL),
	(1107, 'Cập nhật dm tham số hệ thống', 'POST | App\\Modules\\DmThamSoHeThong\\Controllers\\DmThamSoHeThongController@capNhatDmThamSoHeThong', 'POST', 'App\\Modules\\DmThamSoHeThong\\Controllers\\DmThamSoHeThongController@capNhatDmThamSoHeThong', '', '', 1103, '2021-05-28 08:34:03', '2021-06-04 14:03:53', 'cap-nhat-dm-tham-so-he-thong', 1, 2, 1000, NULL),
	(1108, 'Xóa dm tham số hệ thống', 'POST | App\\Modules\\DmThamSoHeThong\\Controllers\\DmThamSoHeThongController@xoaDmThamSoHeThong', 'POST', 'App\\Modules\\DmThamSoHeThong\\Controllers\\DmThamSoHeThongController@xoaDmThamSoHeThong', '', '', 1103, '2021-05-28 08:34:03', '2021-06-04 14:03:53', 'xoa-dm-tham-so-he-thong', 1, 2, 1000, NULL),
	(1109, 'Báo cáo tuần', '#', 'GET', '#', NULL, NULL, 1, '2021-05-28 09:42:49', '2021-05-28 09:46:30', '#', 1, 1, 5, '<i class="fa fa-bar-chart-o menu-icon"></i>'),
	(1122, 'Viễn thông huyện', 'GET | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@baoCaoTuanVienThongHuyen', 'GET', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@baoCaoTuanVienThongHuyen', '', '', 1109, '2021-06-03 14:00:10', '2021-06-04 14:03:53', 'bao-cao-tuan/vien-thong-huyen', 1, 1, 1000, NULL),
	(1123, 'bao-cao-tuan/vien-thong-huyen/bao-cao-tuan-vien-thong-huyen-chot-so-lieu', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@baoCaoTuanVienThongHuyenChotSoLieu', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@baoCaoTuanVienThongHuyenChotSoLieu', '', '', 1, '2021-06-03 14:00:10', '2021-06-04 14:03:53', 'bao-cao-tuan/vien-thong-huyen/bao-cao-tuan-vien-thong-huyen-chot-so-lieu', 1, 2, 1000, NULL),
	(1124, 'bao-cao-tuan/vien-thong-huyen/danh-sach-bao-cao-tuan-hien-tai', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@danhSachBaoCaoTuanHienTai', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@danhSachBaoCaoTuanHienTai', '', '', 1, '2021-06-03 14:00:10', '2021-06-04 14:03:53', 'bao-cao-tuan/vien-thong-huyen/danh-sach-bao-cao-tuan-hien-tai', 1, 2, 1000, NULL),
	(1125, 'bao-cao-tuan/vien-thong-huyen/them-bao-cao-tuan-hien-tai', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@themBaoCaoTuanHienTai', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@themBaoCaoTuanHienTai', '', '', 1, '2021-06-03 14:00:10', '2021-06-04 14:03:53', 'bao-cao-tuan/vien-thong-huyen/them-bao-cao-tuan-hien-tai', 1, 2, 1000, NULL),
	(1126, 'bao-cao-tuan/vien-thong-huyen/xoa-bao-cao-tuan-hien-tai', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@xoaBaoCaoTuanHienTai', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@xoaBaoCaoTuanHienTai', '', '', 1, '2021-06-03 14:00:10', '2021-06-04 14:03:53', 'bao-cao-tuan/vien-thong-huyen/xoa-bao-cao-tuan-hien-tai', 1, 2, 1000, NULL),
	(1127, 'bao-cao-tuan/vien-thong-huyen/bc-is-group-tuan-hien-tai', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@bcIsGroupTuanHienTai', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@bcIsGroupTuanHienTai', '', '', 1, '2021-06-03 14:00:10', '2021-06-04 14:03:53', 'bao-cao-tuan/vien-thong-huyen/bc-is-group-tuan-hien-tai', 1, 2, 1000, NULL),
	(1128, 'bao-cao-tuan/vien-thong-huyen/danh-sach-bao-cao-ke-hoach-tuan', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@danhSachBaoCaoKeHoachTuan', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@danhSachBaoCaoKeHoachTuan', '', '', 1, '2021-06-03 14:00:10', '2021-06-04 14:03:53', 'bao-cao-tuan/vien-thong-huyen/danh-sach-bao-cao-ke-hoach-tuan', 1, 2, 1000, NULL),
	(1129, 'bao-cao-tuan/vien-thong-huyen/them-bao-cao-ke-hoach-tuan', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@themBaoCaoKeHoachTuan', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@themBaoCaoKeHoachTuan', '', '', 1, '2021-06-03 14:00:10', '2021-06-04 14:03:53', 'bao-cao-tuan/vien-thong-huyen/them-bao-cao-ke-hoach-tuan', 1, 2, 1000, NULL),
	(1130, 'bao-cao-tuan/vien-thong-huyen/xoa-bao-cao-ke-hoach-tuan', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@xoaBaoCaoKeHoachTuan', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@xoaBaoCaoKeHoachTuan', '', '', 1, '2021-06-03 14:00:10', '2021-06-04 14:03:53', 'bao-cao-tuan/vien-thong-huyen/xoa-bao-cao-ke-hoach-tuan', 1, 2, 1000, NULL),
	(1131, 'bao-cao-tuan/vien-thong-huyen/bc-is-group-ke-hoach-tuan', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@bcIsGroupKeHoachTuan', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@bcIsGroupKeHoachTuan', '', '', 1, '2021-06-03 14:00:10', '2021-06-04 14:03:53', 'bao-cao-tuan/vien-thong-huyen/bc-is-group-ke-hoach-tuan', 1, 2, 1000, NULL),
	(1132, 'bao-cao-tuan/vien-thong-huyen/danh-sach-bao-cao-tong-hop', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@danhSachBaoCaoTongHop', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@danhSachBaoCaoTongHop', '', '', 1, '2021-06-03 14:00:10', '2021-06-04 14:03:53', 'bao-cao-tuan/vien-thong-huyen/danh-sach-bao-cao-tong-hop', 1, 2, 1000, NULL),
	(1133, 'Phòng ban/Trung tâm', 'GET | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@baoCaoTuanVienThongHuyen', 'GET', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@baoCaoTuanVienThongHuyen', '', '', 1109, '2021-06-03 14:00:10', '2021-06-04 14:03:53', 'bao-cao-tuan/don-vi-truc-thuoc-khac', 1, 1, 1000, NULL),
	(1144, 'Danh mục chỉ số ĐHSXKD', 'GET | App\\Modules\\DmChiSo\\Controllers\\DmChiSoController@dmChiSo', 'GET', 'App\\Modules\\DmChiSo\\Controllers\\DmChiSoController@dmChiSo', '', '', 1, '2021-06-03 14:00:10', '2021-06-04 14:06:06', 'dm-chi-so-dhsxkd', 1, 1, 24, '<i class="menu-icon icon-list"></i>'),
	(1145, 'Xem danh sách chỉ số', 'POST | App\\Modules\\DmChiSo\\Controllers\\DmChiSoController@danhSachDmChiSo', 'POST', 'App\\Modules\\DmChiSo\\Controllers\\DmChiSoController@danhSachDmChiSo', '', '', 1144, '2021-06-03 14:00:10', '2021-06-04 14:06:36', 'danh-sach-dm-chi-so', 1, 2, 1000, NULL),
	(1146, 'Thêm chỉ số', 'POST | App\\Modules\\DmChiSo\\Controllers\\DmChiSoController@themDmChiSo', 'POST', 'App\\Modules\\DmChiSo\\Controllers\\DmChiSoController@themDmChiSo', '', '', 1144, '2021-06-03 14:00:10', '2021-06-04 14:06:52', 'them-dm-chi-so', 1, 2, 1000, NULL),
	(1147, 'Chi tiết chỉ số', 'POST | App\\Modules\\DmChiSo\\Controllers\\DmChiSoController@dmChiSoSingle', 'POST', 'App\\Modules\\DmChiSo\\Controllers\\DmChiSoController@dmChiSoSingle', '', '', 1144, '2021-06-03 14:00:10', '2021-06-04 14:07:10', 'dm-chi-so-single', 1, 2, 1000, NULL),
	(1148, 'Cập nhật danh mục chỉ số', 'POST | App\\Modules\\DmChiSo\\Controllers\\DmChiSoController@capNhatDmChiSo', 'POST', 'App\\Modules\\DmChiSo\\Controllers\\DmChiSoController@capNhatDmChiSo', '', '', 1144, '2021-06-03 14:00:10', '2021-06-04 14:07:32', 'cap-nhat-dm-chi-so', 1, 2, 1000, NULL),
	(1149, 'Xóa danh mục chỉ số', 'POST | App\\Modules\\DmChiSo\\Controllers\\DmChiSoController@xoaDmChiSo', 'POST', 'App\\Modules\\DmChiSo\\Controllers\\DmChiSoController@xoaDmChiSo', '', '', 1144, '2021-06-03 14:00:10', '2021-06-04 14:07:55', 'xoa-dm-chi-so', 1, 2, 1000, NULL),
	(1150, 'bao-cao-tuan/vien-thong-huyen/danh-sach-bao-cao-dhsxkd', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@danhSachBaoCaoDhsxkd', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@danhSachBaoCaoDhsxkd', '', '', 1, '2021-06-04 14:03:53', '2021-06-04 14:03:53', 'bao-cao-tuan/vien-thong-huyen/danh-sach-bao-cao-dhsxkd', 1, 2, 1000, NULL),
	(1151, 'bao-cao-tuan/vien-thong-huyen/vien-thong-huyen-cap-nhat-ghi-chu-bao-cao-dhsxkd', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@capNhatGhiChuBaoCaoDhsxkd', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@capNhatGhiChuBaoCaoDhsxkd', '', '', 1, '2021-06-04 14:03:53', '2021-06-04 14:03:53', 'bao-cao-tuan/vien-thong-huyen/vien-thong-huyen-cap-nhat-ghi-chu-bao-cao-dhsxkd', 1, 2, 1000, NULL),
	(1152, 'bao-cao-tuan/vien-thong-huyen/vien-thong-huyen-lay-so-lieu-bao-cao-dhsxkd', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@laySoLieuBaoCaoDhsxkd', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@laySoLieuBaoCaoDhsxkd', '', '', 1, '2021-06-04 14:03:53', '2021-06-04 14:03:53', 'bao-cao-tuan/vien-thong-huyen/vien-thong-huyen-lay-so-lieu-bao-cao-dhsxkd', 1, 2, 1000, NULL),
	(1153, 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-bao-cao-tuan-chot-so-lieu', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@baoCaoTuanChotSoLieu', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@baoCaoTuanChotSoLieu', '', '', 1, '2021-06-04 14:03:53', '2021-06-04 14:03:53', 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-bao-cao-tuan-chot-so-lieu', 1, 2, 1000, NULL),
	(1154, 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-danh-sach-bao-cao-tuan-hien-tai', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@danhSachBaoCaoTuanHienTai', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@danhSachBaoCaoTuanHienTai', '', '', 1, '2021-06-04 14:03:53', '2021-06-04 14:03:53', 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-danh-sach-bao-cao-tuan-hien-tai', 1, 2, 1000, NULL),
	(1155, 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-them-bao-cao-tuan-hien-tai', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@themBaoCaoTuanHienTai', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@themBaoCaoTuanHienTai', '', '', 1, '2021-06-04 14:03:53', '2021-06-04 14:03:53', 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-them-bao-cao-tuan-hien-tai', 1, 2, 1000, NULL),
	(1156, 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-xoa-bao-cao-tuan-hien-tai', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@xoaBaoCaoTuanHienTai', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@xoaBaoCaoTuanHienTai', '', '', 1, '2021-06-04 14:03:53', '2021-06-04 14:03:53', 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-xoa-bao-cao-tuan-hien-tai', 1, 2, 1000, NULL),
	(1157, 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-bc-is-group-tuan-hien-tai', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@bcIsGroupTuanHienTai', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@bcIsGroupTuanHienTai', '', '', 1, '2021-06-04 14:03:53', '2021-06-04 14:03:53', 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-bc-is-group-tuan-hien-tai', 1, 2, 1000, NULL),
	(1158, 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-danh-sach-bao-cao-ke-hoach-tuan', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@danhSachBaoCaoKeHoachTuan', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@danhSachBaoCaoKeHoachTuan', '', '', 1, '2021-06-04 14:03:53', '2021-06-04 14:03:53', 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-danh-sach-bao-cao-ke-hoach-tuan', 1, 2, 1000, NULL),
	(1159, 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-them-bao-cao-ke-hoach-tuan', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@themBaoCaoKeHoachTuan', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@themBaoCaoKeHoachTuan', '', '', 1, '2021-06-04 14:03:53', '2021-06-04 14:03:53', 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-them-bao-cao-ke-hoach-tuan', 1, 2, 1000, NULL),
	(1160, 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-xoa-bao-cao-ke-hoach-tuan', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@xoaBaoCaoKeHoachTuan', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@xoaBaoCaoKeHoachTuan', '', '', 1, '2021-06-04 14:03:53', '2021-06-04 14:03:53', 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-xoa-bao-cao-ke-hoach-tuan', 1, 2, 1000, NULL),
	(1161, 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-bc-is-group-ke-hoach-tuan', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@bcIsGroupKeHoachTuan', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@bcIsGroupKeHoachTuan', '', '', 1, '2021-06-04 14:03:53', '2021-06-04 14:03:53', 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-bc-is-group-ke-hoach-tuan', 1, 2, 1000, NULL),
	(1162, 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-danh-sach-bao-cao-dhsxkd', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@danhSachBaoCaoDhsxkd', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@danhSachBaoCaoDhsxkd', '', '', 1, '2021-06-04 14:03:53', '2021-06-04 14:03:53', 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-danh-sach-bao-cao-dhsxkd', 1, 2, 1000, NULL),
	(1163, 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-cap-nhat-ghi-chu-bao-cao-dhsxkd', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@capNhatGhiChuBaoCaoDhsxkd', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@capNhatGhiChuBaoCaoDhsxkd', '', '', 1, '2021-06-04 14:03:53', '2021-06-04 14:03:53', 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-cap-nhat-ghi-chu-bao-cao-dhsxkd', 1, 2, 1000, NULL),
	(1164, 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-lay-so-lieu-bao-cao-dhsxkd', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@laySoLieuBaoCaoDhsxkd', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@laySoLieuBaoCaoDhsxkd', '', '', 1, '2021-06-04 14:03:53', '2021-06-04 14:03:53', 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-lay-so-lieu-bao-cao-dhsxkd', 1, 2, 1000, NULL),
	(1165, 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-danh-sach-bao-cao-tong-hop', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@danhSachBaoCaoTongHop', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@danhSachBaoCaoTongHop', '', '', 1, '2021-06-04 14:03:53', '2021-06-04 14:03:53', 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-danh-sach-bao-cao-tong-hop', 1, 2, 1000, NULL),
	(1166, 'Trung tâm Viễn Thông', 'GET | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@baoCaoTuan', 'GET', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@baoCaoTuan', '', '', 1109, '2021-06-04 14:03:53', '2021-06-04 14:04:27', 'bao-cao-tuan/trung-tam-vien-thong', 1, 1, 1000, NULL),
	(1167, 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-bao-cao-tuan-chot-so-lieu', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@baoCaoTuanChotSoLieu', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@baoCaoTuanChotSoLieu', '', '', 1, '2021-06-04 14:03:53', '2021-06-04 14:03:53', 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-bao-cao-tuan-chot-so-lieu', 1, 2, 1000, NULL),
	(1168, 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-danh-sach-bao-cao-tuan-hien-tai', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@danhSachBaoCaoTuanHienTai', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@danhSachBaoCaoTuanHienTai', '', '', 1, '2021-06-04 14:03:53', '2021-06-04 14:03:53', 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-danh-sach-bao-cao-tuan-hien-tai', 1, 2, 1000, NULL),
	(1169, 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-them-bao-cao-tuan-hien-tai', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@themBaoCaoTuanHienTai', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@themBaoCaoTuanHienTai', '', '', 1, '2021-06-04 14:03:53', '2021-06-04 14:03:53', 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-them-bao-cao-tuan-hien-tai', 1, 2, 1000, NULL),
	(1170, 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-xoa-bao-cao-tuan-hien-tai', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@xoaBaoCaoTuanHienTai', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@xoaBaoCaoTuanHienTai', '', '', 1, '2021-06-04 14:03:53', '2021-06-04 14:03:53', 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-xoa-bao-cao-tuan-hien-tai', 1, 2, 1000, NULL),
	(1171, 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-bc-is-group-tuan-hien-tai', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@bcIsGroupTuanHienTai', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@bcIsGroupTuanHienTai', '', '', 1, '2021-06-04 14:03:53', '2021-06-04 14:03:53', 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-bc-is-group-tuan-hien-tai', 1, 2, 1000, NULL),
	(1172, 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-danh-sach-bao-cao-ke-hoach-tuan', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@danhSachBaoCaoKeHoachTuan', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@danhSachBaoCaoKeHoachTuan', '', '', 1, '2021-06-04 14:03:53', '2021-06-04 14:03:53', 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-danh-sach-bao-cao-ke-hoach-tuan', 1, 2, 1000, NULL),
	(1173, 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-them-bao-cao-ke-hoach-tuan', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@themBaoCaoKeHoachTuan', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@themBaoCaoKeHoachTuan', '', '', 1, '2021-06-04 14:03:53', '2021-06-04 14:03:53', 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-them-bao-cao-ke-hoach-tuan', 1, 2, 1000, NULL),
	(1174, 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-xoa-bao-cao-ke-hoach-tuan', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@xoaBaoCaoKeHoachTuan', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@xoaBaoCaoKeHoachTuan', '', '', 1, '2021-06-04 14:03:53', '2021-06-04 14:03:53', 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-xoa-bao-cao-ke-hoach-tuan', 1, 2, 1000, NULL),
	(1175, 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-bc-is-group-ke-hoach-tuan', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@bcIsGroupKeHoachTuan', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@bcIsGroupKeHoachTuan', '', '', 1, '2021-06-04 14:03:53', '2021-06-04 14:03:53', 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-bc-is-group-ke-hoach-tuan', 1, 2, 1000, NULL),
	(1176, 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-danh-sach-bao-cao-dhsxkd', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@danhSachBaoCaoDhsxkd', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@danhSachBaoCaoDhsxkd', '', '', 1, '2021-06-04 14:03:53', '2021-06-04 14:03:53', 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-danh-sach-bao-cao-dhsxkd', 1, 2, 1000, NULL),
	(1177, 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-cap-nhat-ghi-chu-bao-cao-dhsxkd', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@capNhatGhiChuBaoCaoDhsxkd', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@capNhatGhiChuBaoCaoDhsxkd', '', '', 1, '2021-06-04 14:03:53', '2021-06-04 14:03:53', 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-cap-nhat-ghi-chu-bao-cao-dhsxkd', 1, 2, 1000, NULL),
	(1178, 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-lay-so-lieu-bao-cao-dhsxkd', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@laySoLieuBaoCaoDhsxkd', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@laySoLieuBaoCaoDhsxkd', '', '', 1, '2021-06-04 14:03:53', '2021-06-04 14:03:53', 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-lay-so-lieu-bao-cao-dhsxkd', 1, 2, 1000, NULL),
	(1179, 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-danh-sach-bao-cao-tong-hop', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@danhSachBaoCaoTongHop', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@danhSachBaoCaoTongHop', '', '', 1, '2021-06-04 14:03:53', '2021-06-04 14:03:53', 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-danh-sach-bao-cao-tong-hop', 1, 2, 1000, NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=791 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.admin_rule: ~153 rows (approximately)
/*!40000 ALTER TABLE `admin_rule` DISABLE KEYS */;
INSERT INTO `admin_rule` (`id`, `role_id`, `resource_id`, `created_at`, `updated_at`) VALUES
	(446, 1, 964, '2021-03-25 10:41:49', '2021-03-25 10:41:49'),
	(447, 1, 993, '2021-03-25 10:41:49', '2021-03-25 10:41:49'),
	(448, 1, 965, '2021-03-25 10:41:50', '2021-03-25 10:41:50'),
	(498, 2, 899, '2021-03-25 10:42:01', '2021-03-25 10:42:01'),
	(499, 2, 900, '2021-03-25 10:42:01', '2021-03-25 10:42:01'),
	(500, 2, 901, '2021-03-25 10:42:01', '2021-03-25 10:42:01'),
	(501, 2, 902, '2021-03-25 10:42:01', '2021-03-25 10:42:01'),
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
	(631, 2, 910, '2021-04-09 16:37:50', '2021-04-09 16:37:50'),
	(635, 2, 964, '2021-04-09 16:37:55', '2021-04-09 16:37:55'),
	(636, 2, 993, '2021-04-09 16:37:55', '2021-04-09 16:37:55'),
	(643, 2, 1048, '2021-04-09 16:38:02', '2021-04-09 16:38:02'),
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
	(676, 2, 1041, '2021-04-19 15:11:12', '2021-04-19 15:11:12'),
	(677, 2, 1058, '2021-05-26 15:47:55', '2021-05-26 15:47:55'),
	(678, 2, 1059, '2021-05-26 15:47:55', '2021-05-26 15:47:55'),
	(679, 2, 1060, '2021-05-26 15:47:55', '2021-05-26 15:47:55'),
	(680, 2, 1061, '2021-05-26 15:47:55', '2021-05-26 15:47:55'),
	(681, 2, 1062, '2021-05-26 15:47:55', '2021-05-26 15:47:55'),
	(682, 2, 1063, '2021-05-26 15:47:55', '2021-05-26 15:47:55'),
	(683, 2, 1075, '2021-05-26 15:47:55', '2021-05-26 15:47:55'),
	(684, 2, 1076, '2021-05-26 15:47:55', '2021-05-26 15:47:55'),
	(685, 2, 1077, '2021-05-26 15:47:55', '2021-05-26 15:47:55'),
	(686, 2, 1078, '2021-05-26 15:47:55', '2021-05-26 15:47:55'),
	(697, 2, 1006, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(698, 2, 966, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(699, 2, 967, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(700, 2, 968, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(701, 2, 969, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(702, 2, 1071, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(703, 2, 1072, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(704, 2, 970, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(705, 2, 971, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(706, 2, 972, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(707, 2, 973, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(708, 2, 974, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(709, 2, 975, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(710, 2, 976, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(711, 2, 977, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(712, 2, 978, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(713, 2, 979, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(714, 2, 980, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(715, 2, 981, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(716, 2, 982, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(717, 2, 983, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(718, 2, 984, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(719, 2, 985, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(720, 2, 986, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(721, 2, 987, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(722, 2, 988, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(723, 2, 989, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(724, 2, 990, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(725, 2, 991, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(726, 2, 992, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(727, 2, 994, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(728, 2, 995, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(729, 2, 1035, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(730, 2, 1036, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(731, 2, 1042, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(732, 2, 1043, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(733, 2, 1044, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(734, 2, 1045, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(735, 2, 1046, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(736, 2, 1047, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(737, 2, 1055, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(738, 2, 1056, '2021-05-26 15:48:15', '2021-05-26 15:48:15'),
	(739, 2, 1065, '2021-05-26 15:49:34', '2021-05-26 15:49:34'),
	(740, 2, 1066, '2021-05-26 15:49:34', '2021-05-26 15:49:34'),
	(741, 2, 1067, '2021-05-26 15:49:34', '2021-05-26 15:49:34'),
	(742, 2, 1068, '2021-05-26 15:49:34', '2021-05-26 15:49:34'),
	(743, 2, 1069, '2021-05-26 15:49:34', '2021-05-26 15:49:34'),
	(744, 2, 1070, '2021-05-26 15:49:34', '2021-05-26 15:49:34'),
	(745, 2, 1079, '2021-05-26 16:08:03', '2021-05-26 16:08:03'),
	(746, 2, 1080, '2021-05-26 16:08:03', '2021-05-26 16:08:03'),
	(747, 2, 1081, '2021-05-26 16:08:03', '2021-05-26 16:08:03'),
	(748, 2, 1082, '2021-05-26 16:08:03', '2021-05-26 16:08:03'),
	(749, 2, 1083, '2021-05-26 16:08:03', '2021-05-26 16:08:03'),
	(750, 2, 1084, '2021-05-26 16:08:03', '2021-05-26 16:08:03'),
	(751, 2, 1085, '2021-05-28 08:48:21', '2021-05-28 08:48:21'),
	(752, 2, 1086, '2021-05-28 08:48:21', '2021-05-28 08:48:21'),
	(753, 2, 1087, '2021-05-28 08:48:21', '2021-05-28 08:48:21'),
	(754, 2, 1088, '2021-05-28 08:48:21', '2021-05-28 08:48:21'),
	(755, 2, 1089, '2021-05-28 08:48:21', '2021-05-28 08:48:21'),
	(756, 2, 1090, '2021-05-28 08:48:21', '2021-05-28 08:48:21'),
	(757, 2, 1091, '2021-05-28 08:48:22', '2021-05-28 08:48:22'),
	(758, 2, 1092, '2021-05-28 08:48:22', '2021-05-28 08:48:22'),
	(759, 2, 1093, '2021-05-28 08:48:22', '2021-05-28 08:48:22'),
	(760, 2, 1094, '2021-05-28 08:48:22', '2021-05-28 08:48:22'),
	(761, 2, 1095, '2021-05-28 08:48:22', '2021-05-28 08:48:22'),
	(762, 2, 1096, '2021-05-28 08:48:22', '2021-05-28 08:48:22'),
	(763, 2, 1097, '2021-05-28 08:48:23', '2021-05-28 08:48:23'),
	(764, 2, 1098, '2021-05-28 08:48:23', '2021-05-28 08:48:23'),
	(765, 2, 1099, '2021-05-28 08:48:23', '2021-05-28 08:48:23'),
	(766, 2, 1100, '2021-05-28 08:48:23', '2021-05-28 08:48:23'),
	(767, 2, 1101, '2021-05-28 08:48:23', '2021-05-28 08:48:23'),
	(768, 2, 1102, '2021-05-28 08:48:23', '2021-05-28 08:48:23'),
	(769, 2, 1103, '2021-05-28 08:48:24', '2021-05-28 08:48:24'),
	(770, 2, 1104, '2021-05-28 08:48:24', '2021-05-28 08:48:24'),
	(771, 2, 1105, '2021-05-28 08:48:24', '2021-05-28 08:48:24'),
	(772, 2, 1106, '2021-05-28 08:48:24', '2021-05-28 08:48:24'),
	(773, 2, 1107, '2021-05-28 08:48:24', '2021-05-28 08:48:24'),
	(774, 2, 1108, '2021-05-28 08:48:24', '2021-05-28 08:48:24'),
	(781, 2, 1109, '2021-06-04 14:04:46', '2021-06-04 14:04:46'),
	(782, 2, 1122, '2021-06-04 14:04:46', '2021-06-04 14:04:46'),
	(783, 2, 1133, '2021-06-04 14:04:46', '2021-06-04 14:04:46'),
	(784, 2, 1166, '2021-06-04 14:04:46', '2021-06-04 14:04:46'),
	(785, 2, 1144, '2021-06-04 14:08:04', '2021-06-04 14:08:04'),
	(786, 2, 1145, '2021-06-04 14:08:04', '2021-06-04 14:08:04'),
	(787, 2, 1146, '2021-06-04 14:08:04', '2021-06-04 14:08:04'),
	(788, 2, 1147, '2021-06-04 14:08:04', '2021-06-04 14:08:04'),
	(789, 2, 1148, '2021-06-04 14:08:04', '2021-06-04 14:08:04'),
	(790, 2, 1149, '2021-06-04 14:08:04', '2021-06-04 14:08:04');
/*!40000 ALTER TABLE `admin_rule` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.bc_dhsxkd
CREATE TABLE IF NOT EXISTS `bc_dhsxkd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ma_don_vi` varchar(50) DEFAULT NULL,
  `ma_dinh_danh` varchar(50) DEFAULT NULL,
  `id_thoigian_baocao` int(11) NOT NULL,
  `id_user_bao_cao` int(10) unsigned NOT NULL,
  `chi_so` varchar(250) DEFAULT NULL,
  `gia_tri` varchar(50) DEFAULT NULL,
  `is_group` int(11) NOT NULL COMMENT '0 là không phải group; 1 là group',
  `ghi_chu` varchar(50) DEFAULT NULL,
  `loai_chi_so` varchar(250) DEFAULT 'PHAT_TRIEN_MOI' COMMENT 'PHAT_TRIEN_MOI, XU_LY_SUY_HAO, PAKN,...',
  `suy_hao` varchar(50) DEFAULT NULL,
  `suy_hao_con_lai` varchar(50) DEFAULT NULL,
  `trang_thai` int(11) NOT NULL COMMENT '0 chưa chốt; 1 đã chốt',
  `sap_xep` int(11) NOT NULL COMMENT 'Sắp xếp theo tuần',
  PRIMARY KEY (`id`),
  KEY `FK_bc_dhsxkd_bc_dm_thoigian_baocao` (`id_thoigian_baocao`),
  KEY `FK_bc_dhsxkd_users` (`id_user_bao_cao`),
  CONSTRAINT `FK_bc_dhsxkd_bc_dm_thoigian_baocao` FOREIGN KEY (`id_thoigian_baocao`) REFERENCES `bc_dm_thoi_gian_bao_cao` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_bc_dhsxkd_users` FOREIGN KEY (`id_user_bao_cao`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=265 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.bc_dhsxkd: ~11 rows (approximately)
/*!40000 ALTER TABLE `bc_dhsxkd` DISABLE KEYS */;
INSERT INTO `bc_dhsxkd` (`id`, `ma_don_vi`, `ma_dinh_danh`, `id_thoigian_baocao`, `id_user_bao_cao`, `chi_so`, `gia_tri`, `is_group`, `ghi_chu`, `loai_chi_so`, `suy_hao`, `suy_hao_con_lai`, `trang_thai`, `sap_xep`) VALUES
	(254, 'TTCNTT', '000.01.01.H59', 16, 39, 'XU_LY_PAKN', '10', 0, '', 'PAKN', NULL, NULL, 0, 0),
	(255, 'TTCNTT', '000.01.01.H59', 16, 39, 'PAKN_CHUA_XU_LY', '11', 0, '', 'PAKN', NULL, NULL, 0, 0),
	(256, 'TTCNTT', '000.01.01.H59', 16, 39, 'PAKN_DANG_XU_LY', '11', 0, '', 'PAKN', NULL, NULL, 0, 0),
	(257, 'TTCNTT', '000.01.01.H59', 16, 39, 'PAKN_DA_XU_LY', '11', 0, '', 'PAKN', NULL, NULL, 0, 0),
	(258, 'VT_TPO', '001.02.01.H59', 17, 41, 'MyTV', '10', 0, '', 'PHAT_TRIEN_MOI', NULL, NULL, 0, 0),
	(259, 'VT_TPO', '001.02.01.H59', 17, 41, 'G0', '11', 0, '', 'PHAT_TRIEN_MOI', NULL, NULL, 0, 0),
	(260, 'VT_TPO', '001.02.01.H59', 17, 41, 'G1', '14', 0, '', 'PHAT_TRIEN_MOI', NULL, NULL, 0, 0),
	(261, 'VT_TPO', '001.02.01.H59', 17, 41, 'G2', '13', 0, '', 'PHAT_TRIEN_MOI', NULL, NULL, 0, 0),
	(262, 'VT_TPO', '001.02.01.H59', 17, 41, 'Phan Văn Thanh', '0', 0, '', 'XU_LY_SUY_HAO', '10', '12', 0, 0),
	(263, 'VT_TPO', '001.02.01.H59', 17, 41, 'Nguyễn Minh Vương', '14', 0, '', 'XU_LY_SUY_HAO', '10', '12', 0, 0),
	(264, 'VT_TPO', '001.02.01.H59', 17, 41, 'Nguyễn Thanh Tùng', '13', 0, '', 'XU_LY_SUY_HAO', '10', '12', 0, 0);
/*!40000 ALTER TABLE `bc_dhsxkd` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.bc_dm_chi_so
CREATE TABLE IF NOT EXISTS `bc_dm_chi_so` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chi_so` varchar(250) NOT NULL,
  `mo_ta` varchar(250) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `ngay_cap_nhat` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `chi_so` (`chi_so`),
  KEY `FK_bc_dm_chi_so_bc_dm_chi_so` (`parent_id`),
  CONSTRAINT `FK_bc_dm_chi_so_bc_dm_chi_so` FOREIGN KEY (`parent_id`) REFERENCES `bc_dm_chi_so` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.bc_dm_chi_so: ~4 rows (approximately)
/*!40000 ALTER TABLE `bc_dm_chi_so` DISABLE KEYS */;
INSERT INTO `bc_dm_chi_so` (`id`, `chi_so`, `mo_ta`, `parent_id`, `ngay_cap_nhat`) VALUES
	(1, 'MyTV', 'MyTV', NULL, '2021-06-03 16:24:56'),
	(2, 'G0', 'Gia đình 0', NULL, '2021-06-04 14:08:28'),
	(3, 'G1', 'Gia đình 1', NULL, '2021-06-04 14:08:33'),
	(5, 'Xu_LY_PAKN', 'Xử lý phản ánh kiến nghị', NULL, '2021-06-04 08:16:18');
/*!40000 ALTER TABLE `bc_dm_chi_so` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.bc_dm_thoi_gian_bao_cao
CREATE TABLE IF NOT EXISTS `bc_dm_thoi_gian_bao_cao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ma_don_vi` varchar(50) DEFAULT NULL,
  `ma_dinh_danh` varchar(50) DEFAULT NULL,
  `id_tuan` int(11) DEFAULT NULL,
  `thoi_gian_lay_so_lieu` datetime DEFAULT NULL,
  `thoi_gian_chot_so_lieu` datetime DEFAULT NULL,
  `ghi_chu` varchar(250) DEFAULT NULL,
  `trang_thai` int(11) NOT NULL COMMENT '0 chưa chốt; 1 đã chốt',
  PRIMARY KEY (`id`),
  KEY `FK_bc_thoigian_bc_donvi_bc_dm_tuan` (`id_tuan`),
  CONSTRAINT `FK_bc_thoigian_bc_donvi_bc_dm_tuan` FOREIGN KEY (`id_tuan`) REFERENCES `bc_dm_tuan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.bc_dm_thoi_gian_bao_cao: ~3 rows (approximately)
/*!40000 ALTER TABLE `bc_dm_thoi_gian_bao_cao` DISABLE KEYS */;
INSERT INTO `bc_dm_thoi_gian_bao_cao` (`id`, `ma_don_vi`, `ma_dinh_danh`, `id_tuan`, `thoi_gian_lay_so_lieu`, `thoi_gian_chot_so_lieu`, `ghi_chu`, `trang_thai`) VALUES
	(16, 'TTCNTT', '000.01.01.H59', 23, '2021-06-10 16:40:38', NULL, NULL, 0),
	(17, 'VT_TPO', '001.02.01.H59', 23, '2021-06-10 16:45:24', NULL, NULL, 0),
	(18, 'TTVT1', '000.02.01.H59', 23, '2021-06-10 16:50:27', NULL, NULL, 0);
/*!40000 ALTER TABLE `bc_dm_thoi_gian_bao_cao` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.bc_dm_tuan
CREATE TABLE IF NOT EXISTS `bc_dm_tuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nam` int(11) DEFAULT NULL,
  `thang` int(11) DEFAULT NULL,
  `tuan` int(11) DEFAULT NULL,
  `tu_ngay` date DEFAULT NULL,
  `den_ngay` date DEFAULT NULL,
  `trang_thai` int(11) NOT NULL COMMENT '0 không hoạt động; 1 hoạt động',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.bc_dm_tuan: ~4 rows (approximately)
/*!40000 ALTER TABLE `bc_dm_tuan` DISABLE KEYS */;
INSERT INTO `bc_dm_tuan` (`id`, `nam`, `thang`, `tuan`, `tu_ngay`, `den_ngay`, `trang_thai`) VALUES
	(20, 2021, 5, 20, '2021-05-17', '2021-05-21', 1),
	(21, 2021, 5, 21, '2021-05-24', '2021-05-28', 1),
	(22, 2021, 6, 22, '2021-05-31', '2021-06-04', 1),
	(23, 2021, 6, 23, '2021-06-07', '2021-06-11', 1);
/*!40000 ALTER TABLE `bc_dm_tuan` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.bc_ke_hoach_tuan
CREATE TABLE IF NOT EXISTS `bc_ke_hoach_tuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ma_don_vi` varchar(50) DEFAULT NULL,
  `ma_dinh_danh` varchar(50) DEFAULT NULL,
  `id_tuan` int(11) DEFAULT NULL,
  `id_user_bao_cao` int(10) unsigned NOT NULL,
  `noi_dung` longtext DEFAULT NULL,
  `ghi_chu` varchar(250) DEFAULT NULL,
  `thoi_gian_bao_cao` datetime NOT NULL DEFAULT current_timestamp(),
  `is_group` int(11) NOT NULL COMMENT '0 không phải là group; 1 là group',
  `trang_thai` int(11) NOT NULL COMMENT '0 chưa chốt; 1 đã chốt',
  `sap_xep` int(11) NOT NULL COMMENT 'Sắp xếp theo tuần',
  PRIMARY KEY (`id`),
  KEY `FK_bc_ke_hoach_tuan_bc_dm_tuan` (`id_tuan`),
  KEY `FK_bc_ke_hoach_tuan_users` (`id_user_bao_cao`),
  CONSTRAINT `FK_bc_ke_hoach_tuan_bc_dm_tuan` FOREIGN KEY (`id_tuan`) REFERENCES `bc_dm_tuan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_bc_ke_hoach_tuan_users` FOREIGN KEY (`id_user_bao_cao`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=268 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.bc_ke_hoach_tuan: ~17 rows (approximately)
/*!40000 ALTER TABLE `bc_ke_hoach_tuan` DISABLE KEYS */;
INSERT INTO `bc_ke_hoach_tuan` (`id`, `ma_don_vi`, `ma_dinh_danh`, `id_tuan`, `id_user_bao_cao`, `noi_dung`, `ghi_chu`, `thoi_gian_bao_cao`, `is_group`, `trang_thai`, `sap_xep`) VALUES
	(247, 'TTCNTT', '000.01.01.H59', 23, 39, 'Triển khai phần mềm ĐHSXKD tập trung:', NULL, '2021-06-10 15:39:52', 2, 0, 0),
	(251, 'TTCNTT', '000.01.01.H59', 23, 39, 'Xây dựng api các module ATVSLĐ, 5S, sửa chữa TBĐC, QLTS và tích hợp vào app VNPT-TVH-CO;', NULL, '2021-06-10 15:44:59', 1, 0, 0),
	(252, 'TTCNTT', '000.01.01.H59', 23, 39, 'Hỗ trợ cập nhật thông tin địa bàn do luân chuyển nhân sự Lê Vũ Phong từ TTVT3 sang TTVT2 tiếp nhận địa bàn mới.', NULL, '2021-06-10 15:45:08', 1, 0, 0),
	(253, 'TTCNTT', '000.01.01.H59', 23, 39, 'Hỗ trợ tổng hợp các số liệu tính BSC, lương tháng 3/2021;', NULL, '2021-06-10 15:45:34', 1, 0, 0),
	(254, 'TTCNTT', '000.01.01.H59', 23, 39, 'Phần mềm VNPT-HIS:', NULL, '2021-06-10 15:45:46', 2, 0, 0),
	(255, 'TTCNTT', '000.01.01.H59', 23, 39, 'TTYT huyện Duyên Hải: Triển khai chính thức VNPT - HIS, sau khi đơn vị có thuốc; 2', NULL, '2021-06-10 15:46:00', 0, 0, 0),
	(256, 'TTCNTT', '000.01.01.H59', 23, 39, 'Kiểm tra lại các dịch vụ VNPT - HIS/LIS/PACS/HMIS sau khi VNPT - IT cập nhật;', NULL, '2021-06-10 15:46:08', 0, 0, 0),
	(257, 'TTCNTT', '000.01.01.H59', 23, 39, 'Tiếp nhận các y/c bổ sung, chỉnh sửa từ các đơn vị sử dụng', NULL, '2021-06-10 15:46:16', 0, 0, 0),
	(258, 'VT_TPO', '001.02.01.H59', 23, 41, 'Phối hợp phòng bán hàng triển khai kế hoạch bán hàng ở các địa bàn. Thực hiện chuyển  từ đồng sang quang:Dự kiến phát triển Home mới: 20 TB, chuyển đồng sang quang 7 TB.', NULL, '2021-06-10 16:34:55', 2, 0, 0),
	(259, 'VT_TPO', '001.02.01.H59', 23, 41, 'Các địa bàn căn cứ kế hoạch tháng, tiếp tục xử lý suy hao sau Sliptter.', NULL, '2021-06-10 16:35:05', 1, 0, 0),
	(260, 'VT_TPO', '001.02.01.H59', 23, 41, 'Các địa bàn tiếp tục lắp splitter mới để phục vụ phát triển máy mới và chuyển đồng sang quang.', NULL, '2021-06-10 16:35:14', 0, 0, 0),
	(261, 'VT_TPO', '001.02.01.H59', 23, 41, 'Tiếp tục thực hiện B2A.', NULL, '2021-06-10 16:35:21', 0, 0, 0),
	(262, 'VT_TPO', '001.02.01.H59', 23, 41, 'Tiếp tục vận động  khách hàng chuyển đồng sang quang 3', NULL, '2021-06-10 16:35:30', 1, 0, 0),
	(263, 'VT_TPO', '001.02.01.H59', 23, 41, 'Tiếp tục dời  dây làm đường tuyến chợ phường 3 .', NULL, '2021-06-10 16:35:38', 0, 0, 0),
	(265, 'VT_TPO', '001.02.01.H59', 23, 41, 'Lấy số liệu khách hàng ĐTCĐ khảo sát dịch vụ các DLU còn lại', NULL, '2021-06-10 16:36:04', 0, 0, 0),
	(266, 'TTCNTT', '000.01.01.H59', 23, 39, 'test', NULL, '2021-06-10 16:39:30', 0, 0, 0);
/*!40000 ALTER TABLE `bc_ke_hoach_tuan` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.bc_tuan_hien_tai
CREATE TABLE IF NOT EXISTS `bc_tuan_hien_tai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ma_don_vi` varchar(50) DEFAULT NULL,
  `ma_dinh_danh` varchar(50) DEFAULT NULL,
  `id_tuan` int(11) DEFAULT NULL,
  `id_user_bao_cao` int(10) unsigned NOT NULL,
  `noi_dung` longtext DEFAULT NULL,
  `ghi_chu` varchar(250) DEFAULT NULL,
  `thoi_gian_bao_cao` datetime NOT NULL DEFAULT current_timestamp(),
  `is_group` int(11) NOT NULL COMMENT '0 là không phải group; 1 là group',
  `trang_thai` int(11) NOT NULL COMMENT '0 chưa chốt; 1 đã chốt',
  `sap_xep` int(11) NOT NULL COMMENT 'Sắp xếp theo tuần',
  PRIMARY KEY (`id`),
  KEY `FK_bc_tuan_hien_tai_bc_dm_tuan` (`id_tuan`),
  KEY `FK_bc_tuan_hien_tai_users` (`id_user_bao_cao`),
  CONSTRAINT `FK_bc_tuan_hien_tai_bc_dm_tuan` FOREIGN KEY (`id_tuan`) REFERENCES `bc_dm_tuan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_bc_tuan_hien_tai_users` FOREIGN KEY (`id_user_bao_cao`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=425 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.bc_tuan_hien_tai: ~31 rows (approximately)
/*!40000 ALTER TABLE `bc_tuan_hien_tai` DISABLE KEYS */;
INSERT INTO `bc_tuan_hien_tai` (`id`, `ma_don_vi`, `ma_dinh_danh`, `id_tuan`, `id_user_bao_cao`, `noi_dung`, `ghi_chu`, `thoi_gian_bao_cao`, `is_group`, `trang_thai`, `sap_xep`) VALUES
	(146, 'TTCNTT', '000.01.01.H59', 23, 39, 'Phần mềm ĐHSXKD tập trung:', NULL, '2021-06-10 10:38:36', 2, 0, 0),
	(147, 'TTCNTT', '000.01.01.H59', 23, 39, 'Cơ bản hoàn thành lương online; bổ sung lương khuyến khích phiếu B2A, vận động đóng cước trước; bổ sung lương P3 online tổng hợp từ các chỉ tiêu BSC (cần hoàn thiện thêm: lương khuyến khích thu hồi TBĐC và hàn nối splitter chưa lấy online được, lương P3 chỉ tiêu độ khả dụng qua tuần sau tiếp tục hoàn thành do còn thiếu dữ liệu lưu lượng các trạm BTS lũy kế trong tháng); 2', NULL, '2021-06-10 10:38:52', 1, 0, 0),
	(148, 'TTCNTT', '000.01.01.H59', 23, 39, 'Xây dựng api các module ATVSLĐ, 5S, sửa chữa TBĐC, QLTS và tích hợp vào app VNPT-TVH-CO; 2', NULL, '2021-06-10 10:39:03', 0, 0, 0),
	(149, 'TTCNTT', '000.01.01.H59', 23, 39, 'Hoàn thành chương trình BSC Trung tâm Kinh doanh;', NULL, '2021-06-10 10:39:26', 0, 0, 0),
	(150, 'TTCNTT', '000.01.01.H59', 23, 39, 'Hỗ trợ gán nhân viên Trung tâm ĐHTT cho các trạm mới hỗ trợ chấm ATVSLĐ;', NULL, '2021-06-10 10:39:37', 0, 0, 0),
	(151, 'TTCNTT', '000.01.01.H59', 23, 39, 'Sửa lỗi chương trình B2A khi triển khai SSL cho cổng đăng nhập tập trung;', NULL, '2021-06-10 10:39:45', 0, 0, 0),
	(152, 'TTCNTT', '000.01.01.H59', 23, 39, 'Hỗ trợ thêm/xóa đợt bảo trì bảo dưỡng CSHT theo yêu cầu;', NULL, '2021-06-10 10:39:52', 1, 0, 0),
	(153, 'TTCNTT', '000.01.01.H59', 23, 39, 'Thực hiện tiền xử lý dữ liệu để cải thiện tốc độ khi truy xuất dữ liệu trên dashboard, đã cơ bản hoàn thành các xử lý kỹ thuật, tuần sau liên kết lên giao diện người dùng;', NULL, '2021-06-10 10:40:00', 0, 0, 0),
	(154, 'TTCNTT', '000.01.01.H59', 23, 39, 'Thực hiện chỉnh sửa một số biểu mẫu và biểu đồ trên dashboard theo yêu cầu của lãnh đạo VTT;', NULL, '2021-06-10 10:40:09', 0, 0, 0),
	(155, 'TTCNTT', '000.01.01.H59', 23, 39, 'Phân quyền và hỗ trợ các TTVT khóa phiếu “Xử lý khiếu nại” trên ĐHSXKD;', NULL, '2021-06-10 10:40:18', 0, 0, 0),
	(156, 'TTCNTT', '000.01.01.H59', 23, 39, 'Tạo và kiểm tra các yêu cầu IT360 gửi ERP xử lý các lỗi phát sinh trong quá trình khai thác (lỗi không thấy phiếu quyết toán vật tư, lỗi thời gian khi nhập phiếu sự cố trên vnpt cab, hủy gói đa dịch vụ, xóa phiếu báo hỏng do thuê bao đã thanh lý...);', NULL, '2021-06-10 10:40:27', 0, 0, 0),
	(157, 'TTCNTT', '000.01.01.H59', 23, 39, 'Hỗ trợ đổi cổng thuê bao khu vực TCN;', NULL, '2021-06-10 10:40:39', 0, 0, 0),
	(158, 'TTCNTT', '000.01.01.H59', 23, 39, 'Hỗ trợ cập nhật thông tin địa bàn do luân chuyển nhân sự Lê Vũ Phong từ TTVT3 sang TTVT2 tiếp nhận địa bàn mới 001', NULL, '2021-06-10 10:40:49', 0, 0, 0),
	(403, 'TTCNTT', '000.01.01.H59', 23, 39, 'Phần mềm VNPT-HIS:', NULL, '2021-06-10 10:54:08', 2, 0, 0),
	(404, 'TTCNTT', '000.01.01.H59', 23, 39, 'BV, TTYT, PK:', NULL, '2021-06-10 10:54:18', 1, 0, 0),
	(405, 'TTCNTT', '000.01.01.H59', 23, 39, 'BV trường ĐHTV: Cập nhật tên vật tư theo thầu mới; Thêm VTYT mới vào DM Sở; Kiểm tra lỗi không tạo dự trù cơ số; Kiểm tra lỗi xuất toán hồ sơ; Tiếp nhận yêu cầu chỉnh định dạng mẫu báo cáo thống kê bệnh tật ICD10; Kiểm tra lỗi không chuyển BN từ KBH sang có BH; Kiểm tra lỗi không cấp được toa thuốc BANT; Hướng dẫn check sai sót bệnh nhân KBH; Tiếp nhận yêu cầu báo cáo ICD 10 không khớp báo cáo theo nhiều tiêu chí; Kiểm tra báo cáo xét nghiệm chưa khớp giữa LIS và HIS;', NULL, '2021-06-10 10:57:45', 0, 0, 0),
	(406, 'TTCNTT', '000.01.01.H59', 23, 39, 'BV Quân Dân Y: Kiểm tra lỗi không có ngày hoàn tất khám BN; Hướng dẫn nhập y lệnh giường;', NULL, '2021-06-10 10:57:57', 0, 0, 0),
	(407, 'TTCNTT', '000.01.01.H59', 23, 39, 'VNPT iOffice/eOffice:', NULL, '2021-06-10 10:58:07', 2, 0, 0),
	(408, 'TTCNTT', '000.01.01.H59', 23, 39, 'Hỗ trợ từ xa các đơn vị: Ban Dân tộc, Sở NN&PTNT, Sở Nội vụ, Ban Tôn giáo, Trung tâm HCC, Sở Y tế, Bệnh viện Đa khoa tỉnh, Bệnh viện Y dược cổ truyền, Sở Giáo dục và Đào tạo, UBND TP Trà Vinh, UBND Phường 3, UBND Phường 4, UBND huyện Duyên Hải, UBND xã Hiệp Thạnh, Trường MG Phước Hưng, Trường Mầm non Mỹ Việt, Cty CP Cấp thoát nước; Các công việc hỗ trợ bao gồm: Cài đặt chữ ký số, tạo tài khoản, điều chuyển công tác, reset mật khẩu, hướng dẫn tìm kiếm, xử lý văn bản, hỗ trợ đăng nhập, kiểm tra luồng văn bản, tiếp nhận các yêu cầu, kiểm tra lỗi phát sinh trong quá trình sử dụng, giải đáp thắc mắc;', NULL, '2021-06-10 10:58:17', 0, 0, 0),
	(409, 'TTCNTT', '000.01.01.H59', 23, 39, 'Hỗ trợ trực tiếp: Sở GD&ĐT: hướng dẫn cán bộ cách tìm kiếm văn bản;', NULL, '2021-06-10 10:59:00', 0, 0, 0),
	(410, 'VT_TPO', '001.02.01.H59', 23, 41, 'Phối hợp với Phòng bán hàng phát triển Home mới: 22 TB, chuyển đồng sang quang 0TB; Khôi phục 04TB.', NULL, '2021-06-10 16:15:14', 2, 0, 0),
	(411, 'VT_TPO', '001.02.01.H59', 23, 41, 'HomeTV phát triển mới 21 TB.', NULL, '2021-06-10 16:16:11', 1, 0, 0),
	(412, 'VT_TPO', '001.02.01.H59', 23, 41, 'Thực Hiện B2A.(Tháng 04/2021)', NULL, '2021-06-10 16:16:25', 0, 0, 0),
	(413, 'VT_TPO', '001.02.01.H59', 23, 41, 'Phiếu RE1:0, Lũy kế:0', NULL, '2021-06-10 16:30:36', 0, 0, 0),
	(414, 'VT_TPO', '001.02.01.H59', 23, 41, 'Phiếu RE3:0 , Lũy Kế:0', NULL, '2021-06-10 16:30:45', 1, 0, 0),
	(415, 'VT_TPO', '001.02.01.H59', 23, 41, 'Phiếu RE4:0 , Lũy Kế: 0', NULL, '2021-06-10 16:30:53', 0, 0, 0),
	(416, 'VT_TPO', '001.02.01.H59', 23, 41, 'Phiếu RE4:0 , Lũy Kế: 0', NULL, '2021-06-10 16:31:06', 0, 0, 0),
	(419, 'TTVT1', '000.02.01.H59', 23, 41, 'Báo cáo về mạng lưới của đơn vị:', NULL, '2021-06-10 16:47:48', 0, 0, 0),
	(420, 'TTVT1', '000.02.01.H59', 23, 41, 'Các địa bàn tiếp tục lắp splitter mới để phục vụ phát triển máy mới .', NULL, '2021-06-10 16:47:59', 0, 0, 0),
	(421, 'TTVT1', '000.02.01.H59', 23, 41, 'Tiếp tục thực hiện B2A.', NULL, '2021-06-10 16:48:08', 0, 0, 0),
	(422, 'TTVT1', '000.02.01.H59', 23, 41, 'Lấy số liệu thuê bao cố định Trạm Hòa Minh, Song Lộc, Mỹ Chánh, Hưng Mỹ.', NULL, '2021-06-10 16:48:19', 0, 0, 0),
	(423, 'TTVT1', '000.02.01.H59', 23, 41, 'Báo cáo số liệu bình phòng cháy chữa cháy.', NULL, '2021-06-10 16:48:28', 0, 0, 0),
	(424, 'TTVT1', '000.02.01.H59', 23, 41, 'Báo cáo chốt số liệu kế hoạch mạng cáp quang năm 2021.', NULL, '2021-06-10 16:48:38', 0, 0, 0);
/*!40000 ALTER TABLE `bc_tuan_hien_tai` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.chuc_danh
CREATE TABLE IF NOT EXISTS `chuc_danh` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ten_chuc_danh` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.chuc_danh: ~4 rows (approximately)
/*!40000 ALTER TABLE `chuc_danh` DISABLE KEYS */;
INSERT INTO `chuc_danh` (`id`, `ten_chuc_danh`, `state`) VALUES
	(1, 'Kỹ sư', 1),
	(2, 'Thạc sỹ', 1),
	(6, 'Tiến sỹ', 1);
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.chuc_vu: ~5 rows (approximately)
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.dich_vu: ~3 rows (approximately)
/*!40000 ALTER TABLE `dich_vu` DISABLE KEYS */;
INSERT INTO `dich_vu` (`id`, `id_nhom_dich_vu`, `ten_dich_vu`, `state`) VALUES
	(1, 1, 'Dịch vụ viễn thông', 1),
	(2, 7, 'Dịch vụ CNTT', 1);
/*!40000 ALTER TABLE `dich_vu` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.dm_cap_don_vi
CREATE TABLE IF NOT EXISTS `dm_cap_don_vi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ma_cap` varchar(50) DEFAULT NULL,
  `ten_cap` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.dm_cap_don_vi: ~9 rows (approximately)
/*!40000 ALTER TABLE `dm_cap_don_vi` DISABLE KEYS */;
INSERT INTO `dm_cap_don_vi` (`id`, `ma_cap`, `ten_cap`) VALUES
	(1, 'UBT', 'UBND Tỉnh'),
	(2, 'VTT', 'VIỄN THÔNG TỈNH TRÀ VINH'),
	(3, 'TTCNTT', 'Trung tâm công nghệ thông tin'),
	(4, 'TTDHTT', 'Trung tâm Điều hành thông tin'),
	(5, 'TTKDTT', 'Trung tâm Kinh doanh thông tin'),
	(6, 'TTVT', 'Trung tâm Viễn thông'),
	(7, 'HUYEN', 'Viễn thông cấp huyện'),
	(8, 'XA', 'Viễn thông cấp xã'),
	(9, 'PHONG', 'Phòng trực thuộc Viễn Thông Trà Vinh - TVH');
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.dm_tham_so_he_thong: ~11 rows (approximately)
/*!40000 ALTER TABLE `dm_tham_so_he_thong` DISABLE KEYS */;
INSERT INTO `dm_tham_so_he_thong` (`id`, `ma_tham_so`, `ten_tham_so`, `loai_tham_so`, `gia_tri_tham_so`, `mo_ta_tham_so`) VALUES
	(1, 'CAP_TIEP_NHAN_MAC_DINH', 'Cấp tiếp nhận yêu cầu mặc định', 'Nvarchar2', 'HUYEN', 'XA cấp xã; \r\nHUYEN cấp huyện;\r\n TTVT cấp Trung tâm viễn thông; \r\nTTCNTT cấp trung tâm CNTT; \r\nTTDHTT cấp Trung tâm DHTT; \r\nTTKD cấp Trung tâm kinh doanh; \r\nVTT cấp viễn thông tỉnh; \r\nUBT cấp Ủy ban tỉnh'),
	(2, 'MA_NHOM_CHUC_VU_NHAN_PAKN', 'Nhóm chức vụ nhận PAKN', 'Nvarchar2', 'TIEP_NHAN', 'LANH_DAO là lãnh đạo nhận PAKN, XU_LY là chuyên viên xử lý sẽ nhận PAKN; ngược lại là nhóm tiếp nhận'),
	(3, 'SECRET_KEY_API_TAO_TAI_KHOAN', 'Khóa bảo mật khi gọi API tạo tài khoản', 'Nvarchar2', 'GDMpLecTjBD1USC5qkPFdiRu7nNtgHuK7JIMXZOi', 'Là khóa bảo mật truyền vào khi gọi API tạo tài khoản'),
	(4, 'MA_NHOM_CHUC_VU_DUYET_DANG_KY_PAKN', 'Mã nhóm chức vụ duyệt các phản ánh, yêu cầu do cán bộ đăng ký', 'Nvarchar2', 'LANH_DAO', 'Mã nhóm chức vụ duyệt các phản ánh, yêu cầu do cán bộ đăng ký'),
	(5, 'TRA_LOI_KHI_HOAN_TAT', 'Cho phép hệ thống tự gửi nội dung hoàn tất vào mục trả lời yêu cầu', 'Nvarchar2', '1', '1 cho phép; 0 không cho phép'),
	(7, 'CHO_PHEP_TRA_LAI_KH_KHI_TIEP_NHAN', 'Cho phép cán bộ trả yêu cầu lại cho khách hàng khi tiếp nhận hồ sơ', 'Nvarchar2', '1', '1 cho phép; 0 không cho phép'),
	(8, 'CHO_PHEP_TRA_LAI_KH_KHI_LANH_DAO_DUYET', 'Cho phép trả lại người dân trong chức năng danh sách chờ lãnh đạo duyệt', 'Nvarchar2', '1', '1 cho phép; 0 không cho phép'),
	(9, 'CHO_PHEP_HUY_YC_KHI_TIEP_NHAN', 'Cho phép cán bộ tiếp nhận hủy yêu cầu  khi tiếp nhận hồ sơ', 'Nvarchar2', '1', '1 cho phép; 0 không cho phép'),
	(10, 'CHO_PHEP_HUY_YC_KHI_LANH_DAO_DUYET', 'Cho phép cán bộ tiếp nhận hủy yêu cầu  khi tiếp nhận hồ sơ', 'Nvarchar2', '1', '1 cho phép; 0 không cho phép'),
	(13, 'BC_BAO_CAO_THEO_MA_DINH_DANH', 'Báo cáo số liệu theo mã định danh', 'Nvarchar2', '0', 'Trong đơn vị có 2 mã: Mã đơn vị và Mã định danh.\r\n- Nếu chưa có mã định danh cho Viễn thông thì giá trị tham số là 0\r\n- Nếu đã có mã định danh thì giá trị tham số là 1\r\n<b>*** Chú ý*** </b>Mặc định là <B>0</B> (Sử dụng cột mã đơn vị)'),
	(14, 'BC_THOI_GIAN_CHOT_BAO_CAO', 'Báo cáo số liệu theo mã định danh', 'Nvarchar2', '16:30:00', 'Thời gian chốt báo cáo H:i:s'),
	(15, 'BC_DM_MA_CAP_DON_VI_TRUC_THUOC_KHAC', 'Danh sách các mã cấp trực thuộc viễn thông tỉnh', 'Nvarchar2', 'TTCNTT,TTDHTT,TTKD,PHONG', 'Danh sách các mã cấp trực thuộc viễn thông tỉnh\r\nLà các đơn vị khác các đơn vị sau: TTYT, Viễn thông huyện, thành phố, thị xã, VTT\r\nCách nhau bởi dấu ,');
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
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.don_vi: ~29 rows (approximately)
/*!40000 ALTER TABLE `don_vi` DISABLE KEYS */;
INSERT INTO `don_vi` (`id`, `ma_don_vi`, `ten_don_vi`, `ma_phuong_xa`, `ma_cap`, `ma_dinh_danh`, `email`, `co_dinh`, `di_dong`, `fax`, `parent_id`, `order`, `la_don_vi_xu_ly`, `state`) VALUES
	(1, NULL, 'Tỉnh Trà Vinh', 29239, 'UBT', '000.00.00.H59', NULL, NULL, NULL, NULL, NULL, 0, 1, 1),
	(2, 'VTT', 'Viễn thông Trà Vinh', 29236, 'VTT', '000.00.01.H59', NULL, NULL, NULL, NULL, 1, 1, 1, 1),
	(12, 'TTCNTT', 'Trung tâm Công nghệ Thông tin', 29236, 'TTCNTT', '000.01.01.H59', NULL, NULL, NULL, NULL, 2, 1, 1, 1),
	(13, 'TTVT1', 'Trung tâm Viễn Thông 1 - TVH', 29236, 'TTVT', '000.02.01.H59', NULL, NULL, NULL, NULL, 2, 1, 1, 1),
	(14, 'TTVT2', 'Trung tâm Viễn Thông 2 - TVH', 29236, 'TTVT', '000.03.01.H59', NULL, NULL, NULL, NULL, 2, 1, 1, 1),
	(15, 'TTVT3', 'Trung tâm Viễn Thông 3 - TVH', 29236, 'TTVT', '000.04.01.H59', NULL, NULL, NULL, NULL, 2, 1, 1, 1),
	(16, 'VT_TPO', 'Khu vực Thành phố Trà Vinh', 29239, 'HUYEN', '001.02.01.H59', NULL, NULL, NULL, NULL, 13, 1, 1, 1),
	(17, 'VT_CTH', 'Khu vực Châu Thành - TVH', 29374, 'HUYEN', '001.03.01.H59', NULL, NULL, NULL, NULL, 13, 1, 1, 1),
	(18, NULL, 'Phòng giải pháp', 29236, NULL, NULL, NULL, NULL, NULL, NULL, 12, 1, 1, 1),
	(19, NULL, 'Phòng tổng hợp', 29236, NULL, NULL, NULL, NULL, NULL, NULL, 12, 1, 1, 1),
	(20, 'VT_CKE', 'Khu vực Cầu Kè', 29308, 'HUYEN', '001.03.01.H59', NULL, NULL, NULL, NULL, 14, 1, 1, 1),
	(21, 'VT_CLG', 'Khu vực Càng Long', 29266, 'HUYEN', '001.03.01.H59', NULL, NULL, NULL, NULL, 14, 1, 1, 1),
	(22, 'VT_TCU', 'Khu vực Trà Cú', 29461, 'HUYEN', '001.03.01.H59', NULL, NULL, NULL, NULL, 15, 1, 1, 1),
	(24, 'VT_CNG', 'Khu vực Cầu Ngang', 29416, 'HUYEN', '001.03.01.H59', NULL, NULL, NULL, NULL, 15, 1, 1, 1),
	(25, 'VT_DHI', 'Khu vực huyện Duyên Hải', 29497, 'HUYEN', '001.03.01.H59', NULL, NULL, NULL, NULL, 15, 1, 1, 1),
	(26, 'VT_TXDHI', 'Khu vực thị xã Duyên Hải', 29512, 'HUYEN', '001.03.01.H59', NULL, NULL, NULL, NULL, 15, 1, 1, 1),
	(33, NULL, 'Ban giám đốc', 29236, NULL, NULL, NULL, NULL, NULL, NULL, 13, 1, 1, 1),
	(34, NULL, 'Ban giám đốc - TVH', 29236, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, 1, 1),
	(37, 'TTKD', 'Trung tâm Kinh doanh', 29236, 'TTKD', '000.01.01.H59', NULL, NULL, NULL, NULL, 2, 1, 1, 1),
	(38, 'TTDHTT', 'Trung tâm Điều hành Thông tin', 29236, 'TTDHTT', '000.01.01.H59', NULL, NULL, NULL, NULL, 2, 1, 1, 1),
	(39, 'NSTH', 'Phòng Nhân sự - Tổng hợp - TVH', 29236, 'PHONG', NULL, NULL, NULL, NULL, NULL, 2, 1, 0, 1),
	(40, 'KTDT', 'Phòng Kỹ thuật - Đầu tư - TVH', 29236, 'PHONG', NULL, NULL, NULL, NULL, NULL, 2, 1, 0, 1),
	(41, 'KHKT', 'Phòng Kế hoạch - Kế toán - TVH', 29236, 'PHONG', NULL, NULL, NULL, NULL, NULL, 2, 1, 0, 1),
	(42, 'KCTD', 'Khối chuyên trách đảng - TVH', 29236, 'PHONG', NULL, NULL, NULL, NULL, NULL, 2, 1, 0, 1),
	(43, 'CD', 'Công đoàn VNPT Trà Vinh - TVH', 29236, 'PHONG', NULL, NULL, NULL, NULL, NULL, 2, 1, 0, 1),
	(44, '', 'Ban giám đốc', 29236, NULL, NULL, NULL, NULL, NULL, NULL, 12, 1, 0, 1),
	(45, 'DTN', 'Đoàn thanh niên viễn thông Trà Vinh - TVH', 29236, 'PHONG', NULL, NULL, NULL, NULL, NULL, 2, 1, 0, 1),
	(46, 'VT_TCN', 'Khu vực Tiểu Cần', 29341, 'HUYEN', NULL, NULL, NULL, NULL, NULL, 14, 1, 1, 1);
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.nhom_chuc_vu: ~5 rows (approximately)
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

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

-- Dumping data for table vnptpayc.oauth_access_tokens: ~23 rows (approximately)
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
	('0722aea24ad957fb1448fc6528ba3013f2ed4efb44bfc1caf5c8c4e82251804bd0950c286db29ee5', 11, 1, 'Personal Access Token', '[]', 0, '2021-03-19 11:07:08', '2021-03-19 11:07:08', '2021-03-26 11:07:08'),
	('176f111c2ce30d7486a9d9057920153c90bb82ef2faf069b4e4c1c7060327dfb5b21490541760be8', 11, 1, 'Personal Access Token', '[]', 0, '2021-03-25 16:41:41', '2021-03-25 16:41:41', '2022-03-25 16:41:41'),
	('22edd3437e1d05ad0901b01237b7df55215bb93089bdea70eafe72a7b8f953da171bd651d193e64e', 11, 1, 'Personal Access Token', '[]', 0, '2021-03-23 16:13:30', '2021-03-23 16:13:30', '2021-03-30 16:13:30'),
	('284251f273d739d53ca0fe403f9404827b04da62e45bddfcc7d06cc0280aebe6cb319d520fdd733f', 11, 1, 'Personal Access Token', '[]', 0, '2021-03-24 09:04:51', '2021-03-24 09:04:51', '2021-03-31 09:04:51'),
	('3ee132edacb1e1f27e0cbc4dd3691cf037fdc1701a31fdf42c4292efd46e4355623bc0cb46851f1f', 11, 1, 'Personal Access Token', '[]', 0, '2021-03-24 09:34:03', '2021-03-24 09:34:03', '2021-03-31 09:34:03'),
	('413b2bf7c2aa47445ba2db00c8edaac3073592066f4faf51c2724d691f358e069d46c59a82178e60', 35, 1, 'Personal Access Token', '[]', 0, '2021-05-27 10:16:00', '2021-05-27 10:16:00', '2021-06-03 10:16:00'),
	('444a3e10ad367e6f3fb95dc59f3237638696314ead9c71a178db8c6e9423847f577ceb94fceb2227', 11, 1, 'Personal Access Token', '[]', 0, '2021-03-24 16:41:31', '2021-03-24 16:41:31', '2021-03-31 16:41:31'),
	('48aab5f6ec6fc6fd0614d04164a2443ce12da7edf0f1e953ec356fe7d9a502ddbf58e1c955a7701d', 11, 1, 'Personal Access Token', '[]', 0, '2021-03-25 16:37:51', '2021-03-25 16:37:51', '2021-04-01 16:37:51'),
	('50ba85eb0affab0aaa3fb06d92476fe840a70ee1b309066058db6ffbc1be53e80cde4476839889a4', 11, 1, 'Personal Access Token', '[]', 0, '2021-03-25 16:36:34', '2021-03-25 16:36:34', '2022-03-25 16:36:34'),
	('5686828bc20556864bd052738a401e2d0e895e00e16ab87c3f0705219f58b6ca00b5b08fbdc9d942', 9, 1, 'Personal Access Token', '[]', 0, '2021-03-18 10:33:58', '2021-03-18 10:33:58', '2022-03-18 10:33:58'),
	('5b86734b7c13af207eb1db1119d4a44d17056607197ddffe361912495b904263548dc3a2b0208b59', 36, 1, 'Personal Access Token', '[]', 0, '2021-05-27 10:15:52', '2021-05-27 10:15:52', '2021-06-03 10:15:52'),
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
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.payc: ~3 rows (approximately)
/*!40000 ALTER TABLE `payc` DISABLE KEYS */;
INSERT INTO `payc` (`id`, `id_user_tao`, `id_dich_vu`, `so_phieu`, `tieu_de`, `noi_dung`, `file_payc`, `ma_phuong_xa`, `vi_do`, `kinh_do`, `ngay_tao`, `han_xu_ly_mong_muon`, `han_xu_ly_duoc_giao`, `ngay_hoan_tat`, `trang_thai`) VALUES
	(80, 2, 2, '250521-0001', 'test', '<p><br></p>', NULL, 29236, NULL, NULL, '2021-05-25 15:50:19', '2021-05-25 17:00:00', NULL, NULL, 1),
	(81, 2, 2, '260521-0001', 'test', '<p><br></p>', NULL, 29236, NULL, NULL, '2021-05-26 09:49:04', '2021-05-26 17:00:00', NULL, NULL, 1),
	(83, 2, 2, '280521-0001', 'test', '<p><br></p>', NULL, 29236, NULL, NULL, '2021-05-28 10:12:18', '2021-05-28 17:00:00', NULL, NULL, 1);
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
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.payc_binh_luan: ~1 rows (approximately)
/*!40000 ALTER TABLE `payc_binh_luan` DISABLE KEYS */;
INSERT INTO `payc_binh_luan` (`id`, `id_payc`, `id_user`, `parent_id`, `file`, `ma_loai`, `ho_ten`, `noi_dung`, `hai_long`, `khong_hai_long`, `trang_thai`, `ngay_binh_luan`) VALUES
	(75, 81, NULL, NULL, NULL, 'TRA_LOI', 'Nguyễn Chí Thanh', NULL, 0, 0, 0, '2021-05-26 10:31:16');
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
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.payc_can_bo_nhan: ~1 rows (approximately)
/*!40000 ALTER TABLE `payc_can_bo_nhan` DISABLE KEYS */;
INSERT INTO `payc_can_bo_nhan` (`id`, `id_xu_ly_yeu_cau`, `id_user_nhan`, `ngay_nhan`, `han_xu_ly`, `ngay_hoan_tat`, `vai_tro`, `trang_thai`) VALUES
	(195, 349, 2, '2021-05-28 10:12:18', NULL, '2021-05-28 10:12:48', 0, 2);
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
) ENGINE=InnoDB AUTO_INCREMENT=352 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.payc_xu_ly: ~6 rows (approximately)
/*!40000 ALTER TABLE `payc_xu_ly` DISABLE KEYS */;
INSERT INTO `payc_xu_ly` (`id`, `id_payc`, `id_user_xu_ly`, `id_xu_ly`, `noi_dung_xu_ly`, `file_xu_ly`, `ngay_xu_ly`, `state`) VALUES
	(336, 80, 2, 1, '', '', '2021-05-25 15:50:19', 0),
	(337, 81, 2, 1, '', '', '2021-05-26 09:49:04', 0),
	(348, 83, 2, 19, '', '', '2021-05-28 10:12:18', 0),
	(349, 83, 2, 7, '', '', '2021-05-28 10:12:18', 0),
	(350, 83, 2, 24, NULL, NULL, '2021-05-28 10:12:48', 0),
	(351, 83, 2, 20, NULL, NULL, '2021-05-28 10:12:48', 0);
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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.to_do: ~0 rows (approximately)
/*!40000 ALTER TABLE `to_do` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.users: ~9 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `hinh_anh`, `remember_token`, `created_at`, `updated_at`, `di_dong`, `loai_tai_khoan`, `state`) VALUES
	(1, 'Chế độ ẩn danh', 'guest@vnpt.vn', '$2y$10$VZI0siYq7lRPvqt8e.QbXOWDBelj91YwJoLsEKx4GxbWH5XQb87xO', 'photo_2019-10-21_18-00-43_16177906110.jpg', '35xOWSUdceM6lRhePiHS9Y3xwvvLupgJWeYIzh2FMjMl22RuUJURMmX7oElG', NULL, '2021-06-10 10:09:36', '0941138484', 'KHACH_HANG', 1),
	(2, 'Quản trị hệ thống', 'admin@vnpt.vn', '$2y$10$OcK0kyfMtKmByQ2ZmToC/uf.8ekeOk.Snc4LqXXDrnZrHO8oencTC', 'photo_2019-10-21_18-00-43_16177906110.jpg', 'OmSm00xOurJGFIQcKwvtz2CUfdbJvVsyuMCBJ8ETpY0PgrydXQLhUo541gcF', NULL, '2021-06-10 10:09:46', '0941138484', 'CAN_BO', 1),
	(35, 'API', 'api.tvh@vnpt.vn', '$2y$10$7XXsD688amtqziOa0CJb6er2R6hvpBj0jWMeNFSOGuhxow2Z13ZMy', '/user.png', NULL, '2021-05-27 10:15:36', '2021-05-27 10:15:36', NULL, 'API', 1),
	(37, 'Nguyễn Chí Thanh', 'thanhnc.tvh@vnpt.vn', '$2y$10$fHF7exTXOKmfCqXsNMyK/uEb7tIdBLvUk1anLRz0PIaaQSlThXtxy', '/user.png', NULL, '2021-06-10 10:11:50', '2021-06-10 10:11:50', '0913658639', 'CAN_BO', 1),
	(38, 'Nguyễn Hữu Quang', 'quangnh.tvh@vnpt.vn', '$2y$10$9Cfj4KpHnLfa87vjlqcIjen6vE0D2ARCEFOx5gOcNQ1SHjn8goYze', '/user.png', NULL, '2021-06-10 10:12:28', '2021-06-10 10:12:28', '0913981014', 'CAN_BO', 1),
	(39, 'Nguyễn Văn Nam', 'namnv.tvh@vnpt.vn', '$2y$10$kg3FV0O.KAGTSVLv/Wo5qeoXDT7O5hbR08uiqnASSP3kZ2bgJNR92', '/user.png', NULL, '2021-06-10 10:13:08', '2021-06-10 10:13:08', '0919363999', 'CAN_BO', 1),
	(40, 'Hồ Thanh Cao', 'caoht.tvh@vnpt.vn', '$2y$10$Wfkw.2H.KHQp8sw1e70tVu5F.EuPb8srhogB1uJ6RE3BNqp.HZVjG', '/user.png', NULL, '2021-06-10 10:17:04', '2021-06-10 10:17:04', '0913890084', 'CAN_BO', 1),
	(41, 'Đặng Văn Nghĩa', 'nghiadv.tvh@vnpt.vn', '$2y$10$JvUZrBgsWVeqp1kTzp9YH.vBXmDVeAbu85xgqoZA.r5.wbp/dPnXG', '/user.png', NULL, '2021-06-10 10:21:04', '2021-06-10 10:21:04', '0919329629', 'CAN_BO', 1),
	(42, 'Nguyễn Văn Ngon', 'ngonnv.tvh@vnpt.vn', '$2y$10$sX/p/FdLQAR2gqdroit9uO7i0//HyGCX6cnQzsFIhkT2OymqU.Tua', '/user.png', NULL, '2021-06-10 10:22:13', '2021-06-10 10:22:13', '0918136456', 'CAN_BO', 1);
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

-- Dumping data for table vnptpayc.users_dich_vu: ~1 rows (approximately)
/*!40000 ALTER TABLE `users_dich_vu` DISABLE KEYS */;
INSERT INTO `users_dich_vu` (`id`, `id_user`, `id_dich_vu`, `tu_ngay`, `den_ngay`, `state`) VALUES
	(36, 2, 2, NULL, NULL, 1);
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
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.users_don_vi: ~7 rows (approximately)
/*!40000 ALTER TABLE `users_don_vi` DISABLE KEYS */;
INSERT INTO `users_don_vi` (`id`, `id_don_vi`, `id_user`, `id_chuc_danh`, `id_chuc_vu`, `ngay_bat_dau_cong_tac`, `ngay_ket_thuc_cong_tac`, `state`) VALUES
	(72, 18, 2, 1, 2, NULL, NULL, 1),
	(73, 18, 37, 1, 2, NULL, NULL, 1),
	(74, 44, 38, 1, 2, NULL, NULL, 1),
	(76, 44, 39, 2, 2, NULL, NULL, 1),
	(77, 34, 40, 6, 2, NULL, NULL, 1),
	(78, 16, 41, 1, 2, NULL, NULL, 1),
	(79, 17, 42, 1, 2, NULL, NULL, 1);
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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.users_role: ~8 rows (approximately)
/*!40000 ALTER TABLE `users_role` DISABLE KEYS */;
INSERT INTO `users_role` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '2021-03-17 11:02:46', '2021-03-17 11:02:47'),
	(32, 2, 2, '2021-04-09 16:10:46', '2021-04-09 16:10:46'),
	(38, 37, 2, '2021-06-10 10:34:14', '2021-06-10 10:34:14'),
	(39, 38, 2, '2021-06-10 10:34:21', '2021-06-10 10:34:21'),
	(40, 39, 2, '2021-06-10 10:34:26', '2021-06-10 10:34:26'),
	(41, 40, 2, '2021-06-10 10:34:31', '2021-06-10 10:34:31'),
	(42, 41, 2, '2021-06-10 10:34:38', '2021-06-10 10:34:38'),
	(43, 42, 2, '2021-06-10 10:34:55', '2021-06-10 10:34:55');
/*!40000 ALTER TABLE `users_role` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

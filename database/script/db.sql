-- --------------------------------------------------------
-- Host:                         10.90.199.89
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
  KEY `admin_resource_parent_foreign` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1214 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.admin_resource: ~251 rows (approximately)
/*!40000 ALTER TABLE `admin_resource` DISABLE KEYS */;
INSERT INTO `admin_resource` (`id`, `ten_hien_thi`, `resource`, `method`, `action`, `parameter`, `parameter_value`, `parent_id`, `created_at`, `updated_at`, `uri`, `status`, `show_menu`, `order`, `icon`) VALUES
	(0, 'Đơn vị trực thuộc khác/don-vi-truc-thuoc-khac-lay-so-lieu-bao-cao-dhsxkd', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@laySoLieuBaoCaoDhsxkd', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@laySoLieuBaoCaoDhsxkd', '', '', 11133, '2021-06-04 14:03:53', '2021-06-23 16:52:20', 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-lay-so-lieu-bao-cao-dhsxkd', 1, 2, 1000, NULL),
	(1, 'Root', 'Root', 'GET', '#', '#', '#', NULL, '2021-02-01 09:49:23', '2021-02-02 08:33:17', '#', 1, 1, 0, NULL),
	(872, 'Đăng nhập', 'GET | App\\Http\\Controllers\\Auth\\LoginController@showLoginForm', 'GET', 'App\\Http\\Controllers\\Auth\\LoginController@showLoginForm', '', '', 1, '2021-03-12 16:43:45', '2021-06-23 16:52:19', 'login', 1, 2, 999, '<i class="fa fa-lock menu-icon"></i>'),
	(873, 'Nút đăng nhập', 'POST | App\\Http\\Controllers\\Auth\\LoginController@login', 'POST', 'App\\Http\\Controllers\\Auth\\LoginController@login', '', '', 872, '2021-03-12 16:43:45', '2021-06-23 16:52:19', 'login', 1, 2, 1000, NULL),
	(874, 'Đăng xuất', 'POST | App\\Http\\Controllers\\Auth\\LoginController@logout', 'POST', 'App\\Http\\Controllers\\Auth\\LoginController@logout', '', '', 1, '2021-03-12 16:43:45', '2021-06-23 16:52:19', 'logout', 1, 2, 999, '<i class="fa fa-unlock menu-icon"></i>'),
	(875, 'Đăng ký', 'GET | App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm', 'GET', 'App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm', '', '', 1, '2021-03-12 16:43:45', '2021-06-23 16:52:19', 'register', 1, 2, 999, '<i class="fa fa-vcard-o menu-icon"></i>'),
	(876, 'Nút đăng ký', 'POST | App\\Http\\Controllers\\Auth\\RegisterController@register', 'POST', 'App\\Http\\Controllers\\Auth\\RegisterController@register', '', '', 875, '2021-03-12 16:43:45', '2021-06-23 16:52:19', 'register', 1, 2, 1000, NULL),
	(877, 'Reset mật khẩu', 'GET | App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm', 'GET', 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm', '', '', 1, '2021-03-12 16:43:45', '2021-06-23 16:52:19', 'password/reset', 1, 2, 999, '<i class="fa fa-refresh menu-icon"></i>'),
	(878, 'password/email', 'POST | App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail', 'POST', 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail', '', '', 877, '2021-03-12 16:43:45', '2021-06-23 16:52:19', 'password/email', 1, 2, 1000, NULL),
	(879, 'Lấy token reset mật khẩu', 'GET | App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm', 'GET', 'App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm', '', '', 877, '2021-03-12 16:43:45', '2021-06-23 16:52:19', 'password/reset/{token}', 1, 2, 1000, NULL),
	(880, 'password/reset', 'POST | App\\Http\\Controllers\\Auth\\ResetPasswordController@reset', 'POST', 'App\\Http\\Controllers\\Auth\\ResetPasswordController@reset', '', '', 877, '2021-03-12 16:43:45', '2021-06-23 16:52:19', 'password/reset', 1, 2, 1000, NULL),
	(881, 'Xác nhận lại mật khẩu', 'GET | App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm', 'GET', 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm', '', '', 877, '2021-03-12 16:43:45', '2021-06-23 16:52:19', 'password/confirm', 1, 2, 1000, NULL),
	(882, 'password/confirm', 'POST | App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm', 'POST', 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm', '', '', 877, '2021-03-12 16:43:45', '2021-06-23 16:52:19', 'password/confirm', 1, 2, 1000, NULL),
	(883, 'Danh mục phường xã', 'GET | App\\Modules\\DmPhuongXa\\Controllers\\DmPhuongXaController@dmPhuongXa', 'GET', 'App\\Modules\\DmPhuongXa\\Controllers\\DmPhuongXaController@dmPhuongXa', '', '', 1, '2021-03-12 16:43:45', '2021-06-23 16:52:20', 'dm-phuong-xa', 1, 1, 18, '<i class="menu-icon icon-location-pin"></i>'),
	(884, 'Import danh mục phường xã', 'POST | App\\Modules\\DmPhuongXa\\Controllers\\DmPhuongXaController@dmPhuongXaAndImport', 'POST', 'App\\Modules\\DmPhuongXa\\Controllers\\DmPhuongXaController@dmPhuongXaAndImport', '', '', 883, '2021-03-12 16:43:45', '2021-06-23 16:52:20', 'dm-phuong-xa/import', 1, 2, 1000, NULL),
	(885, 'Danh mục quận huyện', 'GET | App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyen', 'GET', 'App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyen', '', '', 1, '2021-03-12 16:43:45', '2021-06-23 16:52:20', 'dm-quan-huyen', 1, 1, 17, '<i class="menu-icon icon-location-pin"></i>'),
	(886, 'Import danh mục quận/huyện', 'POST | App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyenAndImport', 'POST', 'App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyenAndImport', '', '', 885, '2021-03-12 16:43:45', '2021-06-23 16:52:20', 'dm-quan-huyen/import', 1, 2, 1000, NULL),
	(887, 'Đơn vị', 'GET | App\\Modules\\DonVi\\Controllers\\DonViController@donVi', 'GET', 'App\\Modules\\DonVi\\Controllers\\DonViController@donVi', '', '', 1, '2021-03-12 16:43:45', '2021-06-23 16:52:20', 'don-vi', 1, 1, 15, '<i class="fa fa-university menu-icon"></i>'),
	(888, 'Xem danh sách đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@danhSachDonVi', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@danhSachDonVi', '', '', 887, '2021-03-12 16:43:45', '2021-06-23 16:52:20', 'danh-sach-don-vi', 1, 2, 1000, NULL),
	(889, 'Thêm đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@themDonVi', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@themDonVi', '', '', 887, '2021-03-12 16:43:45', '2021-06-23 16:52:20', 'them-don-vi', 1, 2, 1000, NULL),
	(890, 'Load thông tin đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@donViSingle', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@donViSingle', '', '', 887, '2021-03-12 16:43:45', '2021-06-23 16:52:20', 'don-vi-single', 1, 2, 1000, NULL),
	(891, 'Cập nhật đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@capNhatDonVi', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@capNhatDonVi', '', '', 887, '2021-03-12 16:43:45', '2021-06-23 16:52:20', 'cap-nhat-don-vi', 1, 2, 1000, NULL),
	(892, 'Xóa đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@xoaDonVi', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@xoaDonVi', '', '', 887, '2021-03-12 16:43:45', '2021-06-23 16:52:20', 'xoa-don-vi', 1, 2, 1000, NULL),
	(893, 'Nhóm quyền', 'GET | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@nhomQuyen', 'GET', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@nhomQuyen', '', '', 1, '2021-03-12 16:43:45', '2021-06-23 16:52:20', 'nhom-quyen', 1, 1, 13, '<i class="fa fa-database menu-icon"></i>'),
	(894, 'Xem danh sách nhóm quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@danhSachNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@danhSachNhomQuyen', '', '', 893, '2021-03-12 16:43:45', '2021-06-23 16:52:20', 'danh-sach-nhom-quyen', 1, 2, 1000, NULL),
	(895, 'Thêm nhóm quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@themNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@themNhomQuyen', '', '', 893, '2021-03-12 16:43:45', '2021-06-23 16:52:20', 'them-nhom-quyen', 1, 2, 1000, NULL),
	(896, 'Load thông tin nhóm quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@nhomQuyenSingle', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@nhomQuyenSingle', '', '', 893, '2021-03-12 16:43:45', '2021-06-23 16:52:20', 'nhom-quyen-single', 1, 2, 1000, NULL),
	(897, 'Cập nhật nhóm quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@capNhatNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@capNhatNhomQuyen', '', '', 893, '2021-03-12 16:43:45', '2021-06-23 16:52:20', 'cap-nhat-nhom-quyen', 1, 2, 1000, NULL),
	(898, 'Xóa nhóm quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@xoaNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@xoaNhomQuyen', '', '', 893, '2021-03-12 16:43:45', '2021-06-23 16:52:20', 'xoa-nhom-quyen', 1, 2, 1000, NULL),
	(899, 'Phân quyền', 'GET | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyen', 'GET', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyen', '', '', 1, '2021-03-12 16:43:45', '2021-06-23 16:52:20', 'phan-quyen', 1, 1, 14, '<i class="fa fa-cogs menu-icon"></i>'),
	(900, 'Lưu thông tin quyền', 'POST | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenPost', 'POST', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenPost', '', '', 899, '2021-03-12 16:43:45', '2021-06-23 16:52:20', 'phan-quyen-post', 1, 2, 1000, NULL),
	(901, 'Load danh sách nhóm quyền', 'POST | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachNhomQuyen', 'POST', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachNhomQuyen', '', '', 899, '2021-03-12 16:43:45', '2021-06-23 16:52:20', 'phan-quyen/danh-sach-nhom-quyen', 1, 2, 1000, NULL),
	(902, 'Load danh sách quyền', 'POST | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachQuyenTheoNhomQuyenId', 'POST', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachQuyenTheoNhomQuyenId', '', '', 899, '2021-03-12 16:43:45', '2021-06-23 16:52:20', 'phan-quyen/danh-sach-quyen-theo-nhom-quyen-id', 1, 2, 1000, NULL),
	(903, 'Danh mục chức năng', 'GET | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyen', 'GET', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyen', '', '', 1, '2021-03-12 16:43:45', '2021-06-23 16:52:20', 'tai-nguyen', 1, 1, 16, '<i class="menu-icon icon-list"></i>'),
	(904, 'Xem danh sách tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@danhSachTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@danhSachTaiNguyen', '', '', 903, '2021-03-12 16:43:45', '2021-06-23 16:52:20', 'danh-sach-tai-nguyen', 1, 2, 1000, NULL),
	(905, 'Quét tài nguyên hệ thống', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@quetTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@quetTaiNguyen', '', '', 903, '2021-03-12 16:43:45', '2021-06-23 16:52:20', 'quet-tai-nguyen', 1, 2, 1000, NULL),
	(906, 'Thêm tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@themTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@themTaiNguyen', '', '', 903, '2021-03-12 16:43:45', '2021-06-23 16:52:20', 'them-tai-nguyen', 1, 2, 1000, NULL),
	(907, 'Load thông tin tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyenSingle', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyenSingle', '', '', 903, '2021-03-12 16:43:45', '2021-06-23 16:52:20', 'tai-nguyen-single', 1, 2, 1000, NULL),
	(908, 'Cập nhật tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@capNhatTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@capNhatTaiNguyen', '', '', 903, '2021-03-12 16:43:45', '2021-06-23 16:52:20', 'cap-nhat-tai-nguyen', 1, 2, 1000, NULL),
	(909, 'Xóa tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@xoaTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@xoaTaiNguyen', '', '', 903, '2021-03-12 16:43:45', '2021-06-23 16:52:20', 'xoa-tai-nguyen', 1, 2, 1000, NULL),
	(910, 'Trang chủ', 'GET | App\\Modules\\TrangChu\\Controllers\\TrangChuController@home', 'GET', 'App\\Modules\\TrangChu\\Controllers\\TrangChuController@home', '', '', 1, '2021-03-12 16:43:45', '2021-06-23 16:52:21', '/', 1, 2, 1, '<i class="fa fa-home menu-icon"></i>'),
	(912, 'Xem danh sách tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@danhSachUser', 'POST', 'App\\Modules\\User\\Controllers\\UserController@danhSachUser', '', '', 911, '2021-03-12 16:43:45', '2021-06-23 16:52:21', 'danh-sach-user', 1, 2, 1000, NULL),
	(913, 'Tạo tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@themUser', 'POST', 'App\\Modules\\User\\Controllers\\UserController@themUser', '', '', 911, '2021-03-12 16:43:45', '2021-06-23 16:52:21', 'them-user', 1, 2, 1000, NULL),
	(914, 'Load thông tin tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@userSingle', 'POST', 'App\\Modules\\User\\Controllers\\UserController@userSingle', '', '', 911, '2021-03-12 16:43:45', '2021-06-23 16:52:21', 'user-single', 1, 2, 1000, NULL),
	(915, 'Cập nhật tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@capNhatUser', 'POST', 'App\\Modules\\User\\Controllers\\UserController@capNhatUser', '', '', 911, '2021-03-12 16:43:45', '2021-06-23 16:52:21', 'cap-nhat-user', 1, 2, 1000, NULL),
	(916, 'Xóa tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@xoaUser', 'POST', 'App\\Modules\\User\\Controllers\\UserController@xoaUser', '', '', 911, '2021-03-12 16:43:45', '2021-06-23 16:52:21', 'xoa-user', 1, 2, 1000, NULL),
	(964, 'Gửi PAKN', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@payc', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@payc', '', '', 1, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'payc', 1, 1, 2, '<i class="fa fa-paper-plane menu-icon"></i>'),
	(965, 'PAKN của tôi', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycCuaToi', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycCuaToi', '', '', 1, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'danh-sach-payc-cua-toi', 1, 1, 3, '<i class="fa fa-shield menu-icon"></i>'),
	(966, 'PAKN chờ tiếp nhận', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoTiepNhan', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoTiepNhan', '', '', 1006, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'danh-sach-payc-cho-tiep-nhan', 1, 1, 1000, NULL),
	(967, 'Form tiếp nhận và chuyển xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmTiepNhanVaChuyenXuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmTiepNhanVaChuyenXuLy', '', '', 1006, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'frm-tiep-nhan-va-chuyen-xu-ly', 1, 2, 1000, NULL),
	(968, 'Tiếp nhận và chuyển xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@tiepNhanVaChuyenXuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@tiepNhanVaChuyenXuLy', '', '', 967, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'tiep-nhan-va-chuyen-xu-ly', 1, 2, 1000, NULL),
	(969, 'PAKN chờ xử lý', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoXuLy', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoXuLy', '', '', 1006, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'danh-sach-payc-cho-xu-ly', 1, 1, 1000, NULL),
	(970, 'Form xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmXuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmXuLy', '', '', 1006, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'frm-xu-ly', 1, 2, 1000, NULL),
	(971, 'Xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@xuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@xuLy', '', '', 970, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'xu-ly', 1, 2, 1000, NULL),
	(972, 'PAKN chờ duyệt', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoDuyet', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoDuyet', '', '', 1006, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'danh-sach-payc-cho-duyet', 1, 1, 1000, NULL),
	(973, 'Frm duyệt', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmDuyet', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmDuyet', '', '', 1006, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'frm-duyet', 1, 2, 1000, NULL),
	(974, 'Duyệt', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@duyet', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@duyet', '', '', 973, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'duyet', 1, 2, 1000, NULL),
	(975, 'Form chuyển bộ phận tiếp nhận & xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmChuyenBoPhanTiepNhanVaXuLyPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmChuyenBoPhanTiepNhanVaXuLyPayc', '', '', 1006, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'frm-chuyen-bo-phan-tiep-nhan-va-xu-ly-payc', 1, 2, 1000, NULL),
	(976, 'Chuyển bộ phận tiếp nhận & xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@chuyenBoPhanTiepNhanVaXuLyPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@chuyenBoPhanTiepNhanVaXuLyPayc', '', '', 975, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'chuyen-bo-phan-tiep-nhan-va-xu-ly-payc', 1, 2, 1000, NULL),
	(977, 'Form chuyển lãnh đạo', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmChuyenLanhDao', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmChuyenLanhDao', '', '', 1006, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'frm-chuyen-lanh-dao', 1, 2, 1000, NULL),
	(978, 'Chuyển lãnh đạo', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@chuyenLanhDao', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@chuyenLanhDao', '', '', 977, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'chuyen-lanh-dao', 1, 2, 1000, NULL),
	(979, 'Form chuyển cấp trên', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmChuyenCapTren', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmChuyenCapTren', '', '', 1006, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'frm-chuyen-cap-tren', 1, 2, 1000, NULL),
	(980, 'Chuyển cấp trên', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@chuyenCapTren', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@chuyenCapTren', '', '', 979, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'chuyen-cap-tren', 1, 2, 1000, NULL),
	(981, 'Form hoàn tất xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmHoanTat', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmHoanTat', '', '', 1006, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'frm-hoan-tat', 1, 2, 1000, NULL),
	(982, 'Hoàn tất xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@hoanTat', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@hoanTat', '', '', 981, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'hoan-tat', 1, 2, 1000, NULL),
	(983, 'From trả PAKN lại (Không xử lý)', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmTraLaiKhongXuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmTraLaiKhongXuLy', '', '', 1006, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'frm-tra-lai-khong-xu-ly', 1, 2, 1000, NULL),
	(984, 'Trả lại PAKN không xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@traLaiKhongXuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@traLaiKhongXuLy', '', '', 983, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'tra-lai-khong-xu-ly', 1, 2, 1000, NULL),
	(985, 'Form hủy PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmHuy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmHuy', '', '', 1006, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'frm-huy', 1, 2, 1000, NULL),
	(986, 'Hủy PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@huy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@huy', '', '', 985, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'huy', 1, 2, 1000, NULL),
	(987, 'Form cập nhật PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmCapNhatPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmCapNhatPayc', '', '', 1006, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'frm-cap-nhat-payc', 1, 2, 1000, NULL),
	(988, 'Cập nhật PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@capNhatPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@capNhatPayc', '', '', 987, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'cap-nhat-payc', 1, 2, 1000, NULL),
	(989, 'PAKN đã hoàn tất xử lý', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycDaHoanTat', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycDaHoanTat', '', '', 1006, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'danh-sach-payc-da-hoan-tat', 1, 1, 1000, NULL),
	(990, 'Chuyển khách hàng đánh giá', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@chuyenKHDanhGia', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@chuyenKHDanhGia', '', '', 1006, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'chuyen-kh-danh-gia', 1, 2, 1000, NULL),
	(991, 'Đánh giá PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@danhGia', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@danhGia', '', '', 1006, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'danh-gia', 1, 2, 1000, NULL),
	(992, 'Quá trình xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@qtxl', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@qtxl', '', '', 1006, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'qtxl', 1, 2, 1000, NULL),
	(993, 'Thêm PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@themPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@themPayc', '', '', 964, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'them-payc', 1, 2, 1000, NULL),
	(994, 'PAKN theo tài khoản', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycTheoTaiKhoan', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycTheoTaiKhoan', '', '', 1006, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'danh-sach-payc-theo-tai-khoan', 1, 1, 1000, NULL),
	(995, 'PAKN chưa thụ lý', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChuaCoCanBoNhan', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChuaCoCanBoNhan', '', '', 1006, '2021-03-17 08:35:39', '2021-06-23 16:52:20', 'danh-sach-payc-chua-co-can-bo-nhan', 1, 1, 1000, NULL),
	(996, 'To do list', 'GET | App\\Modules\\ToDo\\Controllers\\ToDoController@toDo', 'GET', 'App\\Modules\\ToDo\\Controllers\\ToDoController@toDo', '', '', 1, '2021-03-17 08:35:40', '2021-06-23 16:52:20', 'to-do', 1, 1, 6, '<i class="fa fa-clock-o menu-icon"></i>'),
	(997, 'Xem danh sách ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@danhSachToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@danhSachToDo', '', '', 996, '2021-03-17 08:35:40', '2021-06-23 16:52:20', 'danh-sach-to-do', 1, 2, 1000, NULL),
	(998, 'Thêm ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@themToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@themToDo', '', '', 996, '2021-03-17 08:35:40', '2021-06-23 16:52:20', 'them-to-do', 1, 2, 1000, NULL),
	(999, 'Load thông tin ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@toDoSingle', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@toDoSingle', '', '', 996, '2021-03-17 08:35:40', '2021-06-23 16:52:20', 'to-do-single', 1, 2, 1000, NULL),
	(1000, 'Cập nhật ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@capNhatToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@capNhatToDo', '', '', 996, '2021-03-17 08:35:40', '2021-06-23 16:52:20', 'cap-nhat-to-do', 1, 2, 1000, NULL),
	(1001, 'Xóa ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@xoaToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@xoaToDo', '', '', 996, '2021-03-17 08:35:40', '2021-06-23 16:52:20', 'xoa-to-do', 1, 2, 1000, NULL),
	(1003, 'Gạch ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@checkToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@checkToDo', '', '', 996, '2021-03-17 08:35:40', '2021-06-23 16:52:20', 'check-to-do', 1, 2, 1000, NULL),
	(1004, 'Bỏ gạch ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@uncheckToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@uncheckToDo', '', '', 996, '2021-03-17 08:35:40', '2021-06-23 16:52:21', 'uncheck-to-do', 1, 2, 1000, NULL),
	(1005, 'Sắp xếp lại ghi chú', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@sortToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@sortToDo', '', '', 996, '2021-03-17 08:35:40', '2021-06-23 16:52:21', 'sort-to-do', 1, 2, 1000, NULL),
	(1006, 'Xử lý PAKN', NULL, 'GET', NULL, NULL, NULL, 1, '2021-03-17 08:52:37', '2021-04-09 16:38:54', NULL, 1, 1, 3, '<i class="fa fa-keyboard-o menu-icon"></i>'),
	(1025, 'API đăng nhập', 'POST | App\\Modules\\API\\Controllers\\PassportAuthController@apiDangNhap', 'POST', 'App\\Modules\\API\\Controllers\\PassportAuthController@apiDangNhap', '', '', 1064, '2021-03-25 10:19:24', '2021-06-23 16:52:19', 'api/auth/api-dang-nhap', 1, 1, 1000, NULL),
	(1026, 'API tạo tài khoản', 'POST | App\\Modules\\API\\Controllers\\PassportAuthController@apiTaoTaiKhoan', 'POST', 'App\\Modules\\API\\Controllers\\PassportAuthController@apiTaoTaiKhoan', '', '', 1064, '2021-03-25 10:19:24', '2021-06-23 16:52:19', 'api/auth/api-tao-tai-khoan', 1, 1, 1000, NULL),
	(1027, 'API đăng xuất', 'GET | App\\Modules\\API\\Controllers\\PassportAuthController@apiDangXuat', 'GET', 'App\\Modules\\API\\Controllers\\PassportAuthController@apiDangXuat', '', '', 1064, '2021-03-25 10:19:24', '2021-06-23 16:52:19', 'api/auth/api-dang-xuat', 1, 1, 1000, NULL),
	(1028, 'API lấy thông tin tài khoản', 'GET | App\\Modules\\API\\Controllers\\PassportAuthController@apiGetUser', 'GET', 'App\\Modules\\API\\Controllers\\PassportAuthController@apiGetUser', '', '', 1064, '2021-03-25 10:19:24', '2021-06-23 16:52:19', 'api/auth/api-get-user', 1, 1, 1000, NULL),
	(1030, 'API gửi PAKN', 'POST | App\\Modules\\API\\Controllers\\ApiPaycController@apiGuiPakn', 'POST', 'App\\Modules\\API\\Controllers\\ApiPaycController@apiGuiPakn', '', '', 1064, '2021-03-25 10:19:24', '2021-06-23 16:52:19', 'api/api-gui-pakn', 1, 1, 1000, NULL),
	(1031, 'API lấy danh mục dịch vụ', 'GET | App\\Modules\\API\\Controllers\\ApiDichVuController@layDanhMucDichVu', 'GET', 'App\\Modules\\API\\Controllers\\ApiDichVuController@layDanhMucDichVu', '', '', 1064, '2021-03-25 10:19:25', '2021-06-23 16:52:19', 'api/api-lay-danh-muc-dich-vu', 1, 1, 1000, NULL),
	(1032, 'API lấy danh mục quận/huyện', 'GET | App\\Modules\\API\\Controllers\\ApiDmQuanHuyenController@layDanhMucQuanHuyen', 'GET', 'App\\Modules\\API\\Controllers\\ApiDmQuanHuyenController@layDanhMucQuanHuyen', '', '', 1064, '2021-03-25 10:19:25', '2021-06-23 16:52:19', 'api/api-lay-danh-muc-quan-huyen', 1, 1, 1000, NULL),
	(1033, 'API lấy danh mục phường/xã', 'GET | App\\Modules\\API\\Controllers\\ApiDmPhuongXaController@layDanhMucPhuongXa', 'GET', 'App\\Modules\\API\\Controllers\\ApiDmPhuongXaController@layDanhMucPhuongXa', '', '', 1064, '2021-03-25 10:19:25', '2021-06-23 16:52:19', 'api/api-lay-danh-muc-phuong-xa', 1, 1, 1000, NULL),
	(1034, 'API lấy danh mục phường/xã theo quận/huyện', 'GET | App\\Modules\\API\\Controllers\\ApiDmPhuongXaController@layDanhMucPhuongXaTheoMaQuanHuyen', 'GET', 'App\\Modules\\API\\Controllers\\ApiDmPhuongXaController@layDanhMucPhuongXaTheoMaQuanHuyen', '', '', 1064, '2021-03-25 10:19:25', '2021-06-23 16:52:19', 'api/api-lay-danh-muc-phuong-xa-theo-ma-quan-huyen', 1, 1, 1000, NULL),
	(1035, 'Đăng ký PAKN', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@dangKyPayc', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@dangKyPayc', '', '', 1006, '2021-03-25 10:19:27', '2021-06-23 16:52:20', 'dang-ky-payc', 1, 1, 1000, NULL),
	(1036, 'Lưu đăng ký PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@luuDangKyPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@luuDangKyPayc', '', '', 1035, '2021-03-25 10:19:27', '2021-06-23 16:52:20', 'luu-dang-ky-payc', 1, 2, 1000, NULL),
	(1038, 'Lưu thông tin đơn vị cho user', 'POST | App\\Modules\\User\\Controllers\\UserController@luuUserDonVi', 'POST', 'App\\Modules\\User\\Controllers\\UserController@luuUserDonVi', '', '', 1037, '2021-03-25 10:19:29', '2021-06-23 16:52:21', 'luu-user-dv', 1, 2, 1000, NULL),
	(1039, 'Load danh sách đơn vị theo User', 'POST | App\\Modules\\User\\Controllers\\UserController@loadDsUserDonvi', 'POST', 'App\\Modules\\User\\Controllers\\UserController@loadDsUserDonvi', '', '', 1037, '2021-03-25 10:19:29', '2021-06-23 16:52:21', 'load-danh-sach-user-donvi', 1, 2, 1000, NULL),
	(1040, 'Xóa đơn vị theo User', 'POST | App\\Modules\\User\\Controllers\\UserController@xoaUserDonVi', 'POST', 'App\\Modules\\User\\Controllers\\UserController@xoaUserDonVi', '', '', 1037, '2021-03-25 10:19:29', '2021-06-23 16:52:21', 'xoa-user-donvi', 1, 2, 1000, NULL),
	(1041, 'API xem danh sách PAKN đã gửi', 'POST | App\\Modules\\API\\Controllers\\ApiPaycController@layPaycCuaToi', 'POST', 'App\\Modules\\API\\Controllers\\ApiPaycController@layPaycCuaToi', '', '', 1064, '2021-04-09 16:27:21', '2021-06-23 16:52:19', 'api/api-payc-cua-toi', 1, 1, 1000, NULL),
	(1042, 'Frm duyệt và chuyển xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmDuyetVaChuyenXuLyPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmDuyetVaChuyenXuLyPayc', '', '', 1006, '2021-04-09 16:27:21', '2021-06-23 16:52:20', 'frm-duyet-va-chuyen-xu-ly-payc', 1, 2, 1000, NULL),
	(1043, 'Duyệt và chuyển xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@duyetVaChuyenXuLyPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@duyetVaChuyenXuLyPayc', '', '', 1042, '2021-04-09 16:27:21', '2021-06-23 16:52:20', 'duyet-va-chuyen-xu-ly-payc', 1, 2, 1000, NULL),
	(1044, 'Frm xử lý và chuyển lạnh đạo', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmXuLyVaChuyenLanhDao', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmXuLyVaChuyenLanhDao', '', '', 1006, '2021-04-09 16:27:21', '2021-06-23 16:52:20', 'frm-xu-ly-va-chuyen-lanh-dao', 1, 2, 1000, NULL),
	(1045, 'Xử lý và chuyển lãnh đạo', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@xuLyVaChuyenLanhDao', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@xuLyVaChuyenLanhDao', '', '', 1044, '2021-04-09 16:27:21', '2021-06-23 16:52:20', 'xu-ly-va-chuyen-lanh-dao', 1, 2, 1000, NULL),
	(1046, 'Frm duyệt và hoàn tất xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmDuyetVaHoanTatXuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmDuyetVaHoanTatXuLy', '', '', 1006, '2021-04-09 16:27:21', '2021-06-23 16:52:20', 'frm-duyet-va-hoan-tat-xu-ly', 1, 2, 1000, NULL),
	(1047, 'Duyệt và hoàn tất xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@duyetVahoanTatXuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@duyetVahoanTatXuLy', '', '', 1046, '2021-04-09 16:27:21', '2021-06-23 16:52:20', 'duyet-va-hoan-tat-xu-ly', 1, 2, 1000, NULL),
	(1048, 'Xem chi tiết PAKN', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@chiTietPayc', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@chiTietPayc', '', '', 964, '2021-04-09 16:27:21', '2021-06-23 16:52:20', 'chi-tiet-payc', 1, 2, 4, '<i class="fa fa-eye menu-icon"></i>'),
	(1049, 'Xem chi tiết nội dung PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@chiTietPaycNoiDungSingle', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@chiTietPaycNoiDungSingle', '', '', 1048, '2021-04-09 16:27:21', '2021-06-23 16:52:20', 'chi-tiet-payc-noi-dung-single', 1, 2, 1000, NULL),
	(1050, 'Bình luận PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@chiTietPaycFrmBinhLuanSingle', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@chiTietPaycFrmBinhLuanSingle', '', '', 1048, '2021-04-09 16:27:21', '2021-06-23 16:52:20', 'chi-tiet-payc-frm-binh-luan-single', 1, 2, 1000, NULL),
	(1051, 'Gửi bình luận', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@guiBinhLuan', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@guiBinhLuan', '', '', 1050, '2021-04-09 16:27:21', '2021-06-23 16:52:20', 'gui-binh-luan', 1, 2, 1000, NULL),
	(1052, 'Danh sách bình luận', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@danhSachBinhLuan', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachBinhLuan', '', '', 1048, '2021-04-09 16:27:21', '2021-06-23 16:52:20', 'danh-sach-binh-luan', 1, 2, 1000, NULL),
	(1053, 'Đánh giá hài lòng', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@haiLong', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@haiLong', '', '', 1052, '2021-04-09 16:27:21', '2021-06-23 16:52:20', 'hai-long', 1, 2, 1000, NULL),
	(1054, 'Không hài lòng', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@khongHaiLong', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@khongHaiLong', '', '', 1052, '2021-04-09 16:27:21', '2021-06-23 16:52:20', 'khong-hai-long', 1, 2, 1000, NULL),
	(1055, 'Frm phản hồi bình luận', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@chiTietPaycFrmCanBoPhanHoiBinhLuanSingle', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@chiTietPaycFrmCanBoPhanHoiBinhLuanSingle', '', '', 1006, '2021-04-09 16:27:21', '2021-06-23 16:52:20', 'chi-tiet-payc-frm-can-bo-phan-hoi-binh-luan-single', 1, 2, 1000, NULL),
	(1056, 'Phản hồi bình luận', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@traLoiBinhLuan', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@traLoiBinhLuan', '', '', 1055, '2021-04-09 16:27:21', '2021-06-23 16:52:20', 'tra-loi-binh-luan', 1, 2, 1000, NULL),
	(1058, 'Tài khoản', 'GET | App\\Modules\\User\\Controllers\\UserController@user', 'GET', 'App\\Modules\\User\\Controllers\\UserController@user', '', '', 1, '2021-04-09 16:27:21', '2021-06-23 16:52:21', 'tai-khoan', 1, 1, 5, '<i class="fa fa-address-book menu-icon"></i>'),
	(1059, 'Load thông tin đơn vị theo tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@userDonViSingle', 'POST', 'App\\Modules\\User\\Controllers\\UserController@userDonViSingle', '', '', 1058, '2021-04-09 16:27:21', '2021-06-23 16:52:21', 'user-don-vi-single', 1, 2, 1000, NULL),
	(1060, 'Load thông tin nhóm quyền theo tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@userRoleSingle', 'POST', 'App\\Modules\\User\\Controllers\\UserController@userRoleSingle', '', '', 1058, '2021-04-09 16:27:21', '2021-06-23 16:52:21', 'user-role-single', 1, 2, 1000, NULL),
	(1061, 'Phân nhóm quyền cho tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@phanQuyenUserRole', 'POST', 'App\\Modules\\User\\Controllers\\UserController@phanQuyenUserRole', '', '', 1058, '2021-04-09 16:27:21', '2021-06-23 16:52:21', 'phan-quyen-user-role', 1, 2, 1000, NULL),
	(1062, 'Xem thông tin cá nhân', 'GET | App\\Modules\\User\\Controllers\\UserController@thongTinCaNhan', 'GET', 'App\\Modules\\User\\Controllers\\UserController@thongTinCaNhan', '', '', 1058, '2021-04-09 16:27:21', '2021-06-23 16:52:21', 'thong-tin-ca-nhan', 1, 2, 1000, NULL),
	(1063, 'Cập nhật thông tin cá nhân', 'POST | App\\Modules\\User\\Controllers\\UserController@capNhatThongTinCaNhan', 'POST', 'App\\Modules\\User\\Controllers\\UserController@capNhatThongTinCaNhan', '', '', 1058, '2021-04-09 16:27:21', '2021-06-23 16:52:21', 'cap-nhat-thong-tin-ca-nhan', 1, 2, 1000, NULL),
	(1064, 'API', '#', 'GET', NULL, NULL, NULL, 1, '2021-04-09 16:45:39', '2021-06-17 08:13:20', NULL, 1, 1, 50, '<i class="fa fa-globe menu-icon"></i>'),
	(1065, 'Danh mục dịch vụ', 'GET | App\\Modules\\DichVu\\Controllers\\DichVuController@dichVu', 'GET', 'App\\Modules\\DichVu\\Controllers\\DichVuController@dichVu', '', '', 1, '2021-05-26 15:35:27', '2021-06-23 16:52:20', 'dich-vu', 1, 1, 19, '<i class="menu-icon icon-list"></i>'),
	(1066, 'Xem danh sách dịch vụ', 'POST | App\\Modules\\DichVu\\Controllers\\DichVuController@danhSachDichVu', 'POST', 'App\\Modules\\DichVu\\Controllers\\DichVuController@danhSachDichVu', '', '', 1065, '2021-05-26 15:35:27', '2021-06-23 16:52:20', 'danh-sach-dich-vu', 1, 2, 1000, NULL),
	(1067, 'Thêm mới danh mục dịch vụ', 'POST | App\\Modules\\DichVu\\Controllers\\DichVuController@themDichVu', 'POST', 'App\\Modules\\DichVu\\Controllers\\DichVuController@themDichVu', '', '', 1065, '2021-05-26 15:35:27', '2021-06-23 16:52:20', 'them-dich-vu', 1, 2, 1000, NULL),
	(1068, 'Load chi tiết danh mục dịch vụ', 'POST | App\\Modules\\DichVu\\Controllers\\DichVuController@dichVuSingle', 'POST', 'App\\Modules\\DichVu\\Controllers\\DichVuController@dichVuSingle', '', '', 1065, '2021-05-26 15:35:27', '2021-06-23 16:52:20', 'dich-vu-single', 1, 2, 1000, NULL),
	(1069, 'Cập nhật danh mục dịch vụ', 'POST | App\\Modules\\DichVu\\Controllers\\DichVuController@capNhatDichVu', 'POST', 'App\\Modules\\DichVu\\Controllers\\DichVuController@capNhatDichVu', '', '', 1065, '2021-05-26 15:35:27', '2021-06-23 16:52:20', 'cap-nhat-dich-vu', 1, 2, 1000, NULL),
	(1070, 'Xóa danh mục dịch vụ', 'POST | App\\Modules\\DichVu\\Controllers\\DichVuController@xoaDichVu', 'POST', 'App\\Modules\\DichVu\\Controllers\\DichVuController@xoaDichVu', '', '', 1065, '2021-05-26 15:35:27', '2021-06-23 16:52:20', 'xoa-dich-vu', 1, 2, 1000, NULL),
	(1071, 'Hoàn tất đã xem', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@hoanTatDaXem', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@hoanTatDaXem', '', '', 969, '2021-05-26 15:35:27', '2021-06-23 16:52:20', 'hoan-tat-da-xem', 1, 2, 1000, NULL),
	(1072, 'Hoàn tất phối hợp xử lý', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@hoanTatPhoiHop', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@hoanTatPhoiHop', '', '', 969, '2021-05-26 15:35:27', '2021-06-23 16:52:20', 'hoan-tat-phoi-hop', 1, 2, 1000, NULL),
	(1073, 'Đánh dấu đã xem bình luận', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@danhDauDaXemBinhLuan', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@danhDauDaXemBinhLuan', '', '', 1052, '2021-05-26 15:35:27', '2021-06-23 16:52:20', 'danh-dau-da-xem-binh-luan', 1, 2, 1000, NULL),
	(1074, 'Đánh dấu đã xem PAKN', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@danhDauDaXemPakn', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@danhDauDaXemPakn', '', '', 1049, '2021-05-26 15:35:27', '2021-06-23 16:52:20', 'danh-dau-da-xem-pakn', 1, 2, 1000, NULL),
	(1075, 'Xem chi tiết dịch vụ từng tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@userDichVuSingle', 'POST', 'App\\Modules\\User\\Controllers\\UserController@userDichVuSingle', '', '', 1058, '2021-05-26 15:35:27', '2021-06-23 16:52:21', 'user-dich-vu-single', 1, 2, 1000, NULL),
	(1076, 'Danh sách dịch vụ từng tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@danhSachDichVuTheoTaiKhoan', 'POST', 'App\\Modules\\User\\Controllers\\UserController@danhSachDichVuTheoTaiKhoan', '', '', 1058, '2021-05-26 15:35:27', '2021-06-23 16:52:21', 'danh-sach-dich-vu-theo-tai-khoan', 1, 2, 1000, NULL),
	(1077, 'Phân dịch vụ cho tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@themUserDichVu', 'POST', 'App\\Modules\\User\\Controllers\\UserController@themUserDichVu', '', '', 1058, '2021-05-26 15:35:27', '2021-06-23 16:52:21', 'them-user-dich-vu', 1, 2, 1000, NULL),
	(1078, 'Xóa dịch vụ theo tài khoản', 'POST | App\\Modules\\User\\Controllers\\UserController@xoaUserDichVu', 'POST', 'App\\Modules\\User\\Controllers\\UserController@xoaUserDichVu', '', '', 1058, '2021-05-26 15:35:27', '2021-06-23 16:52:21', 'xoa-user-dich-vu', 1, 2, 1000, NULL),
	(1079, 'Nhóm dịch vụ', 'GET | App\\Modules\\NhomDichVu\\Controllers\\NhomDichVuController@nhomDichVu', 'GET', 'App\\Modules\\NhomDichVu\\Controllers\\NhomDichVuController@nhomDichVu', '', '', 1, '2021-05-26 16:03:56', '2021-06-23 16:52:20', 'nhom-dich-vu', 1, 1, 20, '<i class="menu-icon icon-list"></i>'),
	(1080, 'Xem danh sách nhóm dịch vu', 'POST | App\\Modules\\NhomDichVu\\Controllers\\NhomDichVuController@danhSachNhomDichVu', 'POST', 'App\\Modules\\NhomDichVu\\Controllers\\NhomDichVuController@danhSachNhomDichVu', '', '', 1079, '2021-05-26 16:03:56', '2021-06-23 16:52:20', 'danh-sach-nhom-dich-vu', 1, 2, 1000, NULL),
	(1081, 'Thêm nhóm dịch vụ', 'POST | App\\Modules\\NhomDichVu\\Controllers\\NhomDichVuController@themNhomDichVu', 'POST', 'App\\Modules\\NhomDichVu\\Controllers\\NhomDichVuController@themNhomDichVu', '', '', 1079, '2021-05-26 16:03:56', '2021-06-23 16:52:20', 'them-nhom-dich-vu', 1, 2, 1000, NULL),
	(1082, 'Chi tiết nhóm dịch vụ', 'POST | App\\Modules\\NhomDichVu\\Controllers\\NhomDichVuController@nhomDichVuSingle', 'POST', 'App\\Modules\\NhomDichVu\\Controllers\\NhomDichVuController@nhomDichVuSingle', '', '', 1079, '2021-05-26 16:03:56', '2021-06-23 16:52:20', 'nhom-dich-vu-single', 1, 2, 1000, NULL),
	(1083, 'Cập nhật nhóm dịch vu', 'POST | App\\Modules\\NhomDichVu\\Controllers\\NhomDichVuController@capNhatNhomDichVu', 'POST', 'App\\Modules\\NhomDichVu\\Controllers\\NhomDichVuController@capNhatNhomDichVu', '', '', 1079, '2021-05-26 16:03:56', '2021-06-23 16:52:20', 'cap-nhat-nhom-dich-vu', 1, 2, 1000, NULL),
	(1084, 'Xóa nhóm dịch vụ', 'POST | App\\Modules\\NhomDichVu\\Controllers\\NhomDichVuController@xoaNhomDichVu', 'POST', 'App\\Modules\\NhomDichVu\\Controllers\\NhomDichVuController@xoaNhomDichVu', '', '', 1079, '2021-05-26 16:03:56', '2021-06-23 16:52:20', 'xoa-nhom-dich-vu', 1, 2, 1000, NULL),
	(1085, 'Danh mục chức danh', 'GET | App\\Modules\\ChucDanh\\Controllers\\ChucDanhController@chucDanh', 'GET', 'App\\Modules\\ChucDanh\\Controllers\\ChucDanhController@chucDanh', '', '', 1, '2021-05-26 17:04:22', '2021-06-23 16:52:20', 'chuc-danh', 1, 1, 21, '<i class="menu-icon icon-list"></i>'),
	(1086, 'Xem danh sách chức danh', 'POST | App\\Modules\\ChucDanh\\Controllers\\ChucDanhController@danhSachChucDanh', 'POST', 'App\\Modules\\ChucDanh\\Controllers\\ChucDanhController@danhSachChucDanh', '', '', 1085, '2021-05-26 17:04:22', '2021-06-23 16:52:20', 'danh-sach-chuc-danh', 1, 2, 1000, NULL),
	(1087, 'Thêm chức danh', 'POST | App\\Modules\\ChucDanh\\Controllers\\ChucDanhController@themChucDanh', 'POST', 'App\\Modules\\ChucDanh\\Controllers\\ChucDanhController@themChucDanh', '', '', 1085, '2021-05-26 17:04:22', '2021-06-23 16:52:20', 'them-chuc-danh', 1, 2, 1000, NULL),
	(1088, 'Xem chi tiết chức danh', 'POST | App\\Modules\\ChucDanh\\Controllers\\ChucDanhController@chucDanhSingle', 'POST', 'App\\Modules\\ChucDanh\\Controllers\\ChucDanhController@chucDanhSingle', '', '', 1085, '2021-05-26 17:04:22', '2021-06-23 16:52:20', 'chuc-danh-single', 1, 2, 1000, NULL),
	(1089, 'Cập nhật chức danh', 'POST | App\\Modules\\ChucDanh\\Controllers\\ChucDanhController@capNhatChucDanh', 'POST', 'App\\Modules\\ChucDanh\\Controllers\\ChucDanhController@capNhatChucDanh', '', '', 1085, '2021-05-26 17:04:22', '2021-06-23 16:52:20', 'cap-nhat-chuc-danh', 1, 2, 1000, NULL),
	(1090, 'Xóa chức danh', 'POST | App\\Modules\\ChucDanh\\Controllers\\ChucDanhController@xoaChucDanh', 'POST', 'App\\Modules\\ChucDanh\\Controllers\\ChucDanhController@xoaChucDanh', '', '', 1085, '2021-05-26 17:04:22', '2021-06-23 16:52:20', 'xoa-chuc-danh', 1, 2, 1000, NULL),
	(1091, 'Danh mục chức vụ', 'GET | App\\Modules\\ChucVu\\Controllers\\ChucVuController@chucVu', 'GET', 'App\\Modules\\ChucVu\\Controllers\\ChucVuController@chucVu', '', '', 1, '2021-05-26 17:04:22', '2021-06-23 16:52:20', 'chuc-vu', 1, 1, 22, '<i class="menu-icon icon-list"></i>'),
	(1092, 'Xem danh sách chức vụ', 'POST | App\\Modules\\ChucVu\\Controllers\\ChucVuController@danhSachChucVu', 'POST', 'App\\Modules\\ChucVu\\Controllers\\ChucVuController@danhSachChucVu', '', '', 1091, '2021-05-26 17:04:22', '2021-06-23 16:52:20', 'danh-sach-chuc-vu', 1, 2, 1000, NULL),
	(1093, 'Thêm chức vụ', 'POST | App\\Modules\\ChucVu\\Controllers\\ChucVuController@themChucVu', 'POST', 'App\\Modules\\ChucVu\\Controllers\\ChucVuController@themChucVu', '', '', 1091, '2021-05-26 17:04:22', '2021-06-23 16:52:20', 'them-chuc-vu', 1, 2, 1000, NULL),
	(1094, 'Xem chi tiết chức vụ', 'POST | App\\Modules\\ChucVu\\Controllers\\ChucVuController@chucVuSingle', 'POST', 'App\\Modules\\ChucVu\\Controllers\\ChucVuController@chucVuSingle', '', '', 1091, '2021-05-26 17:04:22', '2021-06-23 16:52:20', 'chuc-vu-single', 1, 2, 1000, NULL),
	(1095, 'Cập nhật chức vụ', 'POST | App\\Modules\\ChucVu\\Controllers\\ChucVuController@capNhatChucVu', 'POST', 'App\\Modules\\ChucVu\\Controllers\\ChucVuController@capNhatChucVu', '', '', 1091, '2021-05-26 17:04:22', '2021-06-23 16:52:20', 'cap-nhat-chuc-vu', 1, 2, 1000, NULL),
	(1096, 'Xóa chức vụ', 'POST | App\\Modules\\ChucVu\\Controllers\\ChucVuController@xoaChucVu', 'POST', 'App\\Modules\\ChucVu\\Controllers\\ChucVuController@xoaChucVu', '', '', 1091, '2021-05-26 17:04:22', '2021-06-23 16:52:20', 'xoa-chuc-vu', 1, 2, 1000, NULL),
	(1097, 'Nhóm chức vụ', 'GET | App\\Modules\\NhomChucVu\\Controllers\\NhomChucVuController@nhomChucVu', 'GET', 'App\\Modules\\NhomChucVu\\Controllers\\NhomChucVuController@nhomChucVu', '', '', 1, '2021-05-26 17:04:22', '2021-06-23 16:52:20', 'nhom-chuc-vu', 1, 1, 23, '<i class="menu-icon icon-list"></i>'),
	(1098, 'Xem danh sách nhóm chức vụ', 'POST | App\\Modules\\NhomChucVu\\Controllers\\NhomChucVuController@danhSachNhomChucVu', 'POST', 'App\\Modules\\NhomChucVu\\Controllers\\NhomChucVuController@danhSachNhomChucVu', '', '', 1097, '2021-05-26 17:04:22', '2021-06-23 16:52:20', 'danh-sach-nhom-chuc-vu', 1, 2, 1000, NULL),
	(1099, 'Thêm nhóm chức vụ', 'POST | App\\Modules\\NhomChucVu\\Controllers\\NhomChucVuController@themNhomChucVu', 'POST', 'App\\Modules\\NhomChucVu\\Controllers\\NhomChucVuController@themNhomChucVu', '', '', 1097, '2021-05-26 17:04:22', '2021-06-23 16:52:20', 'them-nhom-chuc-vu', 1, 2, 1000, NULL),
	(1100, 'Xem chi tiết nhóm chức vụ', 'POST | App\\Modules\\NhomChucVu\\Controllers\\NhomChucVuController@nhomChucVuSingle', 'POST', 'App\\Modules\\NhomChucVu\\Controllers\\NhomChucVuController@nhomChucVuSingle', '', '', 1097, '2021-05-26 17:04:22', '2021-06-23 16:52:20', 'nhom-chuc-vu-single', 1, 2, 1000, NULL),
	(1101, 'Cập nhật nhóm chức vụ', 'POST | App\\Modules\\NhomChucVu\\Controllers\\NhomChucVuController@capNhatNhomChucVu', 'POST', 'App\\Modules\\NhomChucVu\\Controllers\\NhomChucVuController@capNhatNhomChucVu', '', '', 1097, '2021-05-26 17:04:22', '2021-06-23 16:52:20', 'cap-nhat-nhom-chuc-vu', 1, 2, 1000, NULL),
	(1102, 'Xóa nhóm chức vụ', 'POST | App\\Modules\\NhomChucVu\\Controllers\\NhomChucVuController@xoaNhomChucVu', 'POST', 'App\\Modules\\NhomChucVu\\Controllers\\NhomChucVuController@xoaNhomChucVu', '', '', 1097, '2021-05-26 17:04:22', '2021-06-23 16:52:20', 'xoa-nhom-chuc-vu', 1, 2, 1000, NULL),
	(1103, 'Danh mục tham số hệ thống', 'GET | App\\Modules\\DmThamSoHeThong\\Controllers\\DmThamSoHeThongController@dmThamSoHeThong', 'GET', 'App\\Modules\\DmThamSoHeThong\\Controllers\\DmThamSoHeThongController@dmThamSoHeThong', '', '', 1, '2021-05-28 08:34:03', '2021-06-23 16:52:20', 'dm-tham-so-he-thong', 1, 1, 24, '<i class="menu-icon icon-list"></i>'),
	(1104, 'Danh sách tham số hệ thống', 'POST | App\\Modules\\DmThamSoHeThong\\Controllers\\DmThamSoHeThongController@danhSachDmThamSoHeThong', 'POST', 'App\\Modules\\DmThamSoHeThong\\Controllers\\DmThamSoHeThongController@danhSachDmThamSoHeThong', '', '', 1103, '2021-05-28 08:34:03', '2021-06-23 16:52:20', 'danh-sach-dm-tham-so-he-thong', 1, 2, 1000, NULL),
	(1105, 'Thêm danh mục tham số hệ thống', 'POST | App\\Modules\\DmThamSoHeThong\\Controllers\\DmThamSoHeThongController@themDmThamSoHeThong', 'POST', 'App\\Modules\\DmThamSoHeThong\\Controllers\\DmThamSoHeThongController@themDmThamSoHeThong', '', '', 1103, '2021-05-28 08:34:03', '2021-06-23 16:52:20', 'them-dm-tham-so-he-thong', 1, 2, 1000, NULL),
	(1106, 'Xem chi tiết dm tham số hệ thống', 'POST | App\\Modules\\DmThamSoHeThong\\Controllers\\DmThamSoHeThongController@dmThamSoHeThongSingle', 'POST', 'App\\Modules\\DmThamSoHeThong\\Controllers\\DmThamSoHeThongController@dmThamSoHeThongSingle', '', '', 1103, '2021-05-28 08:34:03', '2021-06-23 16:52:20', 'dm-tham-so-he-thong-single', 1, 2, 1000, NULL),
	(1107, 'Cập nhật dm tham số hệ thống', 'POST | App\\Modules\\DmThamSoHeThong\\Controllers\\DmThamSoHeThongController@capNhatDmThamSoHeThong', 'POST', 'App\\Modules\\DmThamSoHeThong\\Controllers\\DmThamSoHeThongController@capNhatDmThamSoHeThong', '', '', 1103, '2021-05-28 08:34:03', '2021-06-23 16:52:20', 'cap-nhat-dm-tham-so-he-thong', 1, 2, 1000, NULL),
	(1108, 'Xóa dm tham số hệ thống', 'POST | App\\Modules\\DmThamSoHeThong\\Controllers\\DmThamSoHeThongController@xoaDmThamSoHeThong', 'POST', 'App\\Modules\\DmThamSoHeThong\\Controllers\\DmThamSoHeThongController@xoaDmThamSoHeThong', '', '', 1103, '2021-05-28 08:34:03', '2021-06-23 16:52:20', 'xoa-dm-tham-so-he-thong', 1, 2, 1000, NULL),
	(1109, 'Báo cáo tuần', '#', 'GET', '#', NULL, NULL, 1, '2021-05-28 09:42:49', '2021-06-17 08:10:29', '#', 1, 1, 4, '<i class="fa fa-bar-chart-o menu-icon"></i>'),
	(1122, 'Tổ kỹ thuật', 'GET | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@baoCaoTuanVienThongHuyen', 'GET', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@baoCaoTuanVienThongHuyen', '', '', 1109, '2021-06-03 14:00:10', '2021-06-23 16:52:19', 'bao-cao-tuan/vien-thong-huyen', 1, 1, 1000, NULL),
	(1123, 'Tổ kỹ thuật/bao-cao-tuan-vien-thong-huyen-chot-so-lieu', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@baoCaoTuanVienThongHuyenChotSoLieu', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@baoCaoTuanVienThongHuyenChotSoLieu', '', '', 1122, '2021-06-03 14:00:10', '2021-06-23 16:52:19', 'bao-cao-tuan/vien-thong-huyen/bao-cao-tuan-vien-thong-huyen-chot-so-lieu', 1, 2, 1000, NULL),
	(1124, 'Tổ kỹ thuật/danh-sach-bao-cao-tuan-hien-tai', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@danhSachBaoCaoTuanHienTai', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@danhSachBaoCaoTuanHienTai', '', '', 1122, '2021-06-03 14:00:10', '2021-06-23 16:52:19', 'bao-cao-tuan/vien-thong-huyen/danh-sach-bao-cao-tuan-hien-tai', 1, 2, 1000, NULL),
	(1125, 'Tổ kỹ thuật/them-bao-cao-tuan-hien-tai', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@themBaoCaoTuanHienTai', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@themBaoCaoTuanHienTai', '', '', 1122, '2021-06-03 14:00:10', '2021-06-23 16:52:19', 'bao-cao-tuan/vien-thong-huyen/them-bao-cao-tuan-hien-tai', 1, 2, 1000, NULL),
	(1126, 'Tổ kỹ thuật/xoa-bao-cao-tuan-hien-tai', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@xoaBaoCaoTuanHienTai', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@xoaBaoCaoTuanHienTai', '', '', 1122, '2021-06-03 14:00:10', '2021-06-23 16:52:19', 'bao-cao-tuan/vien-thong-huyen/xoa-bao-cao-tuan-hien-tai', 1, 2, 1000, NULL),
	(1127, 'Tổ kỹ thuật/bc-is-group-tuan-hien-tai', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@bcIsGroupTuanHienTai', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@bcIsGroupTuanHienTai', '', '', 1122, '2021-06-03 14:00:10', '2021-06-23 16:52:19', 'bao-cao-tuan/vien-thong-huyen/bc-is-group-tuan-hien-tai', 1, 2, 1000, NULL),
	(1128, 'Tổ kỹ thuật/danh-sach-bao-cao-ke-hoach-tuan', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@danhSachBaoCaoKeHoachTuan', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@danhSachBaoCaoKeHoachTuan', '', '', 1122, '2021-06-03 14:00:10', '2021-06-23 16:52:19', 'bao-cao-tuan/vien-thong-huyen/danh-sach-bao-cao-ke-hoach-tuan', 1, 2, 1000, NULL),
	(1129, 'Tổ kỹ thuật/them-bao-cao-ke-hoach-tuan', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@themBaoCaoKeHoachTuan', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@themBaoCaoKeHoachTuan', '', '', 1122, '2021-06-03 14:00:10', '2021-06-23 16:52:19', 'bao-cao-tuan/vien-thong-huyen/them-bao-cao-ke-hoach-tuan', 1, 2, 1000, NULL),
	(1130, 'Tổ kỹ thuật/xoa-bao-cao-ke-hoach-tuan', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@xoaBaoCaoKeHoachTuan', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@xoaBaoCaoKeHoachTuan', '', '', 1122, '2021-06-03 14:00:10', '2021-06-23 16:52:19', 'bao-cao-tuan/vien-thong-huyen/xoa-bao-cao-ke-hoach-tuan', 1, 2, 1000, NULL),
	(1131, 'Tổ kỹ thuật/bc-is-group-ke-hoach-tuan', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@bcIsGroupKeHoachTuan', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@bcIsGroupKeHoachTuan', '', '', 11122, '2021-06-03 14:00:10', '2021-06-23 16:52:19', 'bao-cao-tuan/vien-thong-huyen/bc-is-group-ke-hoach-tuan', 1, 2, 1000, NULL),
	(1132, 'Tổ kỹ thuật/danh-sach-bao-cao-tong-hop', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@danhSachBaoCaoTongHop', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@danhSachBaoCaoTongHop', '', '', 1122, '2021-06-03 14:00:10', '2021-06-23 16:52:19', 'bao-cao-tuan/vien-thong-huyen/danh-sach-bao-cao-tong-hop', 1, 2, 1000, NULL),
	(1133, 'Phòng ban/Trung tâm', 'GET | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@baoCaoTuanVienThongHuyen', 'GET', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@baoCaoTuanVienThongHuyen', '', '', 1109, '2021-06-03 14:00:10', '2021-06-23 16:52:19', 'bao-cao-tuan/don-vi-truc-thuoc-khac', 1, 1, 1000, NULL),
	(1144, 'Danh mục chỉ số ĐHSXKD', 'GET | App\\Modules\\DmChiSo\\Controllers\\DmChiSoController@dmChiSo', 'GET', 'App\\Modules\\DmChiSo\\Controllers\\DmChiSoController@dmChiSo', '', '', 1, '2021-06-03 14:00:10', '2021-06-23 16:52:20', 'dm-chi-so-dhsxkd', 1, 1, 24, '<i class="menu-icon icon-list"></i>'),
	(1145, 'Xem danh sách chỉ số', 'POST | App\\Modules\\DmChiSo\\Controllers\\DmChiSoController@danhSachDmChiSo', 'POST', 'App\\Modules\\DmChiSo\\Controllers\\DmChiSoController@danhSachDmChiSo', '', '', 1144, '2021-06-03 14:00:10', '2021-06-23 16:52:20', 'danh-sach-dm-chi-so', 1, 2, 1000, NULL),
	(1146, 'Thêm chỉ số', 'POST | App\\Modules\\DmChiSo\\Controllers\\DmChiSoController@themDmChiSo', 'POST', 'App\\Modules\\DmChiSo\\Controllers\\DmChiSoController@themDmChiSo', '', '', 1144, '2021-06-03 14:00:10', '2021-06-23 16:52:20', 'them-dm-chi-so', 1, 2, 1000, NULL),
	(1147, 'Chi tiết chỉ số', 'POST | App\\Modules\\DmChiSo\\Controllers\\DmChiSoController@dmChiSoSingle', 'POST', 'App\\Modules\\DmChiSo\\Controllers\\DmChiSoController@dmChiSoSingle', '', '', 1144, '2021-06-03 14:00:10', '2021-06-23 16:52:20', 'dm-chi-so-single', 1, 2, 1000, NULL),
	(1148, 'Cập nhật danh mục chỉ số', 'POST | App\\Modules\\DmChiSo\\Controllers\\DmChiSoController@capNhatDmChiSo', 'POST', 'App\\Modules\\DmChiSo\\Controllers\\DmChiSoController@capNhatDmChiSo', '', '', 1144, '2021-06-03 14:00:10', '2021-06-23 16:52:20', 'cap-nhat-dm-chi-so', 1, 2, 1000, NULL),
	(1149, 'Xóa danh mục chỉ số', 'POST | App\\Modules\\DmChiSo\\Controllers\\DmChiSoController@xoaDmChiSo', 'POST', 'App\\Modules\\DmChiSo\\Controllers\\DmChiSoController@xoaDmChiSo', '', '', 1144, '2021-06-03 14:00:10', '2021-06-23 16:52:20', 'xoa-dm-chi-so', 1, 2, 1000, NULL),
	(1150, 'Tổ kỹ thuật/danh-sach-bao-cao-dhsxkd', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@danhSachBaoCaoDhsxkd', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@danhSachBaoCaoDhsxkd', '', '', 1122, '2021-06-04 14:03:53', '2021-06-23 16:52:19', 'bao-cao-tuan/vien-thong-huyen/danh-sach-bao-cao-dhsxkd', 1, 2, 1000, NULL),
	(1151, 'Tổ kỹ thuật/vien-thong-huyen-cap-nhat-ghi-chu-bao-cao-dhsxkd', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@capNhatGhiChuBaoCaoDhsxkd', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@capNhatGhiChuBaoCaoDhsxkd', '', '', 1122, '2021-06-04 14:03:53', '2021-06-23 16:52:19', 'bao-cao-tuan/vien-thong-huyen/vien-thong-huyen-cap-nhat-ghi-chu-bao-cao-dhsxkd', 1, 2, 1000, NULL),
	(1152, 'Tổ kỹ thuật/vien-thong-huyen-lay-so-lieu-bao-cao-dhsxkd', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@laySoLieuBaoCaoDhsxkd', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@laySoLieuBaoCaoDhsxkd', '', '', 1122, '2021-06-04 14:03:53', '2021-06-23 16:52:19', 'bao-cao-tuan/vien-thong-huyen/vien-thong-huyen-lay-so-lieu-bao-cao-dhsxkd', 1, 2, 1000, NULL),
	(1153, 'Đơn vị trực thuộc khác/Chốt số liệu', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@baoCaoTuanChotSoLieu', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@baoCaoTuanChotSoLieu', '', '', 1133, '2021-06-04 14:03:53', '2021-06-23 16:52:19', 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-bao-cao-tuan-chot-so-lieu', 1, 2, 1000, NULL),
	(1154, 'Đơn vị trực thuộc khác/don-vi-truc-thuoc-khac-danh-sach-bao-cao-tuan-hien-tai', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@danhSachBaoCaoTuanHienTai', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@danhSachBaoCaoTuanHienTai', '', '', 1133, '2021-06-04 14:03:53', '2021-06-23 16:52:19', 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-danh-sach-bao-cao-tuan-hien-tai', 1, 2, 1000, NULL),
	(1155, 'Đơn vị trực thuộc khác/don-vi-truc-thuoc-khac-them-bao-cao-tuan-hien-tai', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@themBaoCaoTuanHienTai', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@themBaoCaoTuanHienTai', '', '', 1133, '2021-06-04 14:03:53', '2021-06-23 16:52:19', 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-them-bao-cao-tuan-hien-tai', 1, 2, 1000, NULL),
	(1156, 'Đơn vị trực thuộc khác/don-vi-truc-thuoc-khac-xoa-bao-cao-tuan-hien-tai', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@xoaBaoCaoTuanHienTai', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@xoaBaoCaoTuanHienTai', '', '', 1133, '2021-06-04 14:03:53', '2021-06-23 16:52:20', 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-xoa-bao-cao-tuan-hien-tai', 1, 2, 1000, NULL),
	(1157, 'Đơn vị trực thuộc khác/don-vi-truc-thuoc-khac-bc-is-group-tuan-hien-tai', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@bcIsGroupTuanHienTai', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@bcIsGroupTuanHienTai', '', '', 1133, '2021-06-04 14:03:53', '2021-06-23 16:52:20', 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-bc-is-group-tuan-hien-tai', 1, 2, 1000, NULL),
	(1158, 'Đơn vị trực thuộc khác/don-vi-truc-thuoc-khac-danh-sach-bao-cao-ke-hoach-tuan', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@danhSachBaoCaoKeHoachTuan', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@danhSachBaoCaoKeHoachTuan', '', '', 1133, '2021-06-04 14:03:53', '2021-06-23 16:52:20', 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-danh-sach-bao-cao-ke-hoach-tuan', 1, 2, 1000, NULL),
	(1159, 'Đơn vị trực thuộc khác/don-vi-truc-thuoc-khac-them-bao-cao-ke-hoach-tuan', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@themBaoCaoKeHoachTuan', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@themBaoCaoKeHoachTuan', '', '', 1133, '2021-06-04 14:03:53', '2021-06-23 16:52:20', 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-them-bao-cao-ke-hoach-tuan', 1, 2, 1000, NULL),
	(1160, 'Đơn vị trực thuộc khác/don-vi-truc-thuoc-khac-xoa-bao-cao-ke-hoach-tuan', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@xoaBaoCaoKeHoachTuan', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@xoaBaoCaoKeHoachTuan', '', '', 11133, '2021-06-04 14:03:53', '2021-06-23 16:52:20', 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-xoa-bao-cao-ke-hoach-tuan', 1, 2, 1000, NULL),
	(1161, 'Đơn vị trực thuộc khác/don-vi-truc-thuoc-khac-bc-is-group-ke-hoach-tuan', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@bcIsGroupKeHoachTuan', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@bcIsGroupKeHoachTuan', '', '', 1133, '2021-06-04 14:03:53', '2021-06-23 16:52:20', 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-bc-is-group-ke-hoach-tuan', 1, 2, 1000, NULL),
	(1162, 'Đơn vị trực thuộc khác/don-vi-truc-thuoc-khac-danh-sach-bao-cao-dhsxkd', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@danhSachBaoCaoDhsxkd', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@danhSachBaoCaoDhsxkd', '', '', 1133, '2021-06-04 14:03:53', '2021-06-23 16:52:20', 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-danh-sach-bao-cao-dhsxkd', 1, 2, 1000, NULL),
	(1163, 'Đơn vị trực thuộc khác/don-vi-truc-thuoc-khac-cap-nhat-ghi-chu-bao-cao-dhsxkd', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@capNhatGhiChuBaoCaoDhsxkd', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@capNhatGhiChuBaoCaoDhsxkd', '', '', 1133, '2021-06-04 14:03:53', '2021-06-23 16:52:20', 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-cap-nhat-ghi-chu-bao-cao-dhsxkd', 1, 2, 1000, NULL),
	(1165, 'Đơn vị trực thuộc khác/don-vi-truc-thuoc-khac-danh-sach-bao-cao-tong-hop', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@danhSachBaoCaoTongHop', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@danhSachBaoCaoTongHop', '', '', 1133, '2021-06-04 14:03:53', '2021-06-23 16:52:20', 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-danh-sach-bao-cao-tong-hop', 1, 2, 1000, NULL),
	(1166, 'Trung tâm Viễn Thông', 'GET | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@baoCaoTuan', 'GET', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@baoCaoTuan', '', '', 1109, '2021-06-04 14:03:53', '2021-06-23 16:52:20', 'bao-cao-tuan/trung-tam-vien-thong', 1, 1, 1000, NULL),
	(1167, 'Trung tâm viễn thông/trung-tam-vien-thong-bao-cao-tuan-chot-so-lieu', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@baoCaoTuanChotSoLieu', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@baoCaoTuanChotSoLieu', '', '', 1166, '2021-06-04 14:03:53', '2021-06-23 16:52:20', 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-bao-cao-tuan-chot-so-lieu', 1, 2, 1000, NULL),
	(1168, 'Trung tâm viễn thông/trung-tam-vien-thong-danh-sach-bao-cao-tuan-hien-tai', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@danhSachBaoCaoTuanHienTai', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@danhSachBaoCaoTuanHienTai', '', '', 1166, '2021-06-04 14:03:53', '2021-06-23 16:52:20', 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-danh-sach-bao-cao-tuan-hien-tai', 1, 2, 1000, NULL),
	(1169, 'Trung tâm viễn thông/trung-tam-vien-thong-them-bao-cao-tuan-hien-tai', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@themBaoCaoTuanHienTai', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@themBaoCaoTuanHienTai', '', '', 1166, '2021-06-04 14:03:53', '2021-06-23 16:52:20', 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-them-bao-cao-tuan-hien-tai', 1, 2, 1000, NULL),
	(1170, 'Trung tâm viễn thông/trung-tam-vien-thong-xoa-bao-cao-tuan-hien-tai', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@xoaBaoCaoTuanHienTai', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@xoaBaoCaoTuanHienTai', '', '', 1166, '2021-06-04 14:03:53', '2021-06-23 16:52:20', 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-xoa-bao-cao-tuan-hien-tai', 1, 2, 1000, NULL),
	(1171, 'Trung tâm viễn thông/trung-tam-vien-thong-bc-is-group-tuan-hien-tai', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@bcIsGroupTuanHienTai', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@bcIsGroupTuanHienTai', '', '', 1166, '2021-06-04 14:03:53', '2021-06-23 16:52:20', 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-bc-is-group-tuan-hien-tai', 1, 2, 1000, NULL),
	(1172, 'Trung tâm viễn thông/trung-tam-vien-thong-danh-sach-bao-cao-ke-hoach-tuan', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@danhSachBaoCaoKeHoachTuan', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@danhSachBaoCaoKeHoachTuan', '', '', 1166, '2021-06-04 14:03:53', '2021-06-23 16:52:20', 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-danh-sach-bao-cao-ke-hoach-tuan', 1, 2, 1000, NULL),
	(1173, 'Trung tâm viễn thông/trung-tam-vien-thong-them-bao-cao-ke-hoach-tuan', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@themBaoCaoKeHoachTuan', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@themBaoCaoKeHoachTuan', '', '', 1166, '2021-06-04 14:03:53', '2021-06-23 16:52:20', 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-them-bao-cao-ke-hoach-tuan', 1, 2, 1000, NULL),
	(1174, 'Trung tâm viễn thông/trung-tam-vien-thong-xoa-bao-cao-ke-hoach-tuan', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@xoaBaoCaoKeHoachTuan', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@xoaBaoCaoKeHoachTuan', '', '', 1166, '2021-06-04 14:03:53', '2021-06-23 16:52:20', 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-xoa-bao-cao-ke-hoach-tuan', 1, 2, 1000, NULL),
	(1175, 'Trung tâm viễn thông/trung-tam-vien-thong-bc-is-group-ke-hoach-tuan', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@bcIsGroupKeHoachTuan', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@bcIsGroupKeHoachTuan', '', '', 1166, '2021-06-04 14:03:53', '2021-06-23 16:52:20', 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-bc-is-group-ke-hoach-tuan', 1, 2, 1000, NULL),
	(1176, 'Trung tâm viễn thông/trung-tam-vien-thong-danh-sach-bao-cao-dhsxkd', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@danhSachBaoCaoDhsxkd', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@danhSachBaoCaoDhsxkd', '', '', 1166, '2021-06-04 14:03:53', '2021-06-23 16:52:20', 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-danh-sach-bao-cao-dhsxkd', 1, 2, 1000, NULL),
	(1177, 'Trung tâm viễn thông/trung-tam-vien-thong-cap-nhat-ghi-chu-bao-cao-dhsxkd', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@capNhatGhiChuBaoCaoDhsxkd', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@capNhatGhiChuBaoCaoDhsxkd', '', '', 1166, '2021-06-04 14:03:53', '2021-06-23 16:52:20', 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-cap-nhat-ghi-chu-bao-cao-dhsxkd', 1, 2, 1000, NULL),
	(1178, 'Trung tâm viễn thông/trung-tam-vien-thong-lay-so-lieu-bao-cao-dhsxkd', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@laySoLieuBaoCaoDhsxkd', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@laySoLieuBaoCaoDhsxkd', '', '', 1166, '2021-06-04 14:03:53', '2021-06-23 16:52:20', 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-lay-so-lieu-bao-cao-dhsxkd', 1, 2, 1000, NULL),
	(1179, 'Trung tâm viễn thông/trung-tam-vien-thong-danh-sach-bao-cao-tong-hop', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@danhSachBaoCaoTongHop', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@danhSachBaoCaoTongHop', '', '', 1166, '2021-06-04 14:03:53', '2021-06-23 16:52:20', 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-danh-sach-bao-cao-tong-hop', 1, 2, 1000, NULL),
	(1180, 'Tổ kỹ thuật/cap-nhat-bao-cao-tuan-hien-tai', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@capNhatBaoCaoTuanHienTai', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@capNhatBaoCaoTuanHienTai', '', '', 1122, '2021-06-13 02:10:12', '2021-06-23 16:52:19', 'bao-cao-tuan/vien-thong-huyen/cap-nhat-bao-cao-tuan-hien-tai', 1, 2, 1000, NULL),
	(1181, 'Tổ kỹ thuật/lay-du-lieu-tu-ke-hoach-tuan', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@layDuLieuTuKeHoachTuan', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@layDuLieuTuKeHoachTuan', '', '', 1122, '2021-06-13 02:10:12', '2021-06-23 16:52:19', 'bao-cao-tuan/vien-thong-huyen/lay-du-lieu-tu-ke-hoach-tuan', 1, 2, 1000, NULL),
	(1182, 'Tổ kỹ thuật/cap-nhat-bao-cao-ke-hoach-tuan', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@capNhatBaoCaoKeHoachTuan', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongHuyen\\VienThongHuyenController@capNhatBaoCaoKeHoachTuan', '', '', 1122, '2021-06-13 02:10:12', '2021-06-23 16:52:19', 'bao-cao-tuan/vien-thong-huyen/cap-nhat-bao-cao-ke-hoach-tuan', 1, 2, 1000, NULL),
	(1183, 'Đơn vị trực thuộc khác/don-vi-truc-thuoc-khac-cap-nhat-bao-cao-tuan-hien-tai', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@capNhatBaoCaoTuanHienTai', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@capNhatBaoCaoTuanHienTai', '', '', 1133, '2021-06-13 02:10:12', '2021-06-23 16:52:19', 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-cap-nhat-bao-cao-tuan-hien-tai', 1, 2, 1000, NULL),
	(1184, 'Đơn vị trực thuộc khác/don-vi-truc-thuoc-khac-lay-du-lieu-tu-ke-hoach-tuan', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@layDuLieuTuKeHoachTuan', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@layDuLieuTuKeHoachTuan', '', '', 1133, '2021-06-13 02:10:12', '2021-06-23 16:52:20', 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-lay-du-lieu-tu-ke-hoach-tuan', 1, 2, 1000, NULL),
	(1185, 'Đơn vị trực thuộc khác/don-vi-truc-thuoc-khac-cap-nhat-bao-cao-ke-hoach-tuan', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@capNhatBaoCaoKeHoachTuan', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@capNhatBaoCaoKeHoachTuan', '', '', 1133, '2021-06-13 02:10:12', '2021-06-23 16:52:20', 'bao-cao-tuan/don-vi-truc-thuoc-khac/don-vi-truc-thuoc-khac-cap-nhat-bao-cao-ke-hoach-tuan', 1, 2, 1000, NULL),
	(1186, 'Trung tâm viễn thông/trung-tam-vien-thong-cap-nhat-bao-cao-tuan-hien-tai', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@capNhatBaoCaoTuanHienTai', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@capNhatBaoCaoTuanHienTai', '', '', 1166, '2021-06-13 02:10:12', '2021-06-23 16:52:20', 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-cap-nhat-bao-cao-tuan-hien-tai', 1, 2, 1000, NULL),
	(1187, 'Trung tâm viễn thông/trung-tam-vien-thong-cap-nhat-bao-cao-ke-hoach-tuan', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@capNhatBaoCaoKeHoachTuan', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@capNhatBaoCaoKeHoachTuan', '', '', 1166, '2021-06-13 02:10:12', '2021-06-23 16:52:20', 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-cap-nhat-bao-cao-ke-hoach-tuan', 1, 2, 1000, NULL),
	(1188, 'Trung tâm viễn thông/trung-tam-vien-thong-lay-du-lieu-tu-ke-hoach-tuan', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@layDuLieuTuKeHoachTuan', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@layDuLieuTuKeHoachTuan', '', '', 1166, '2021-06-13 02:10:12', '2021-06-23 16:52:20', 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-lay-du-lieu-tu-ke-hoach-tuan', 1, 2, 1000, NULL),
	(1189, 'Viễn thông tỉnh', 'GET | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongTinh\\VienThongTinhController@baoCaoTuan', 'GET', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongTinh\\VienThongTinhController@baoCaoTuan', '', '', 1109, '2021-06-13 02:10:12', '2021-06-23 16:52:20', 'bao-cao-tuan/vien-thong-tinh', 1, 1, 1000, NULL),
	(1190, 'Viễn thông tỉnh/vien-thong-tinh-danh-sach-bao-cao-tong-hop', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongTinh\\VienThongTinhController@danhSachBaoCaoTongHop', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongTinh\\VienThongTinhController@danhSachBaoCaoTongHop', '', '', 1189, '2021-06-13 02:10:12', '2021-06-23 16:52:20', 'bao-cao-tuan/vien-thong-tinh/vien-thong-tinh-danh-sach-bao-cao-tong-hop', 1, 2, 1000, NULL),
	(1191, 'API get file', 'POST | App\\Modules\\API\\Controllers\\ApiPaycController@getFile', 'POST', 'App\\Modules\\API\\Controllers\\ApiPaycController@getFile', '', '', 1064, '2021-06-17 07:38:51', '2021-06-23 16:52:19', 'api/get-file', 1, 2, 1000, NULL),
	(1192, 'Trung tâm viễn thông/trung-tam-vien-thong-gui-thong-bao-nhac-nho-qua-telegram', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@guiThongBaoNhacNhoQuaTelegram', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\TrungTamVienThong\\TrungTamVienThongController@guiThongBaoNhacNhoQuaTelegram', '', '', 1166, '2021-06-17 07:38:52', '2021-06-23 16:52:20', 'bao-cao-tuan/trung-tam-vien-thong/trung-tam-vien-thong-gui-thong-bao-nhac-nho-qua-telegram', 1, 2, 1000, NULL),
	(1193, 'Viễn thông tỉnh/vien-thong-tinh-gui-thong-bao-nhac-nho-qua-telegram', 'POST | App\\Modules\\BaoCaoTuan\\Controllers\\VienThongTinh\\VienThongTinhController@guiThongBaoNhacNhoQuaTelegram', 'POST', 'App\\Modules\\BaoCaoTuan\\Controllers\\VienThongTinh\\VienThongTinhController@guiThongBaoNhacNhoQuaTelegram', '', '', 1189, '2021-06-17 07:38:52', '2021-06-23 16:52:20', 'bao-cao-tuan/vien-thong-tinh/vien-thong-tinh-gui-thong-bao-nhac-nho-qua-telegram', 1, 2, 1000, NULL),
	(1194, 'Danh mục tuần báo cáo', 'GET | App\\Modules\\DmTuan\\Controllers\\DmTuanController@dmTuan', 'GET', 'App\\Modules\\DmTuan\\Controllers\\DmTuanController@dmTuan', '', '', 1, '2021-06-17 07:38:52', '2021-06-23 16:52:20', 'dm-tuan', 1, 1, 25, '<i class="menu-icon icon-list"></i>'),
	(1195, 'Xem danh mục tuần', 'POST | App\\Modules\\DmTuan\\Controllers\\DmTuanController@danhSachDmTuan', 'POST', 'App\\Modules\\DmTuan\\Controllers\\DmTuanController@danhSachDmTuan', '', '', 1194, '2021-06-17 07:38:52', '2021-06-23 16:52:20', 'danh-sach-dm-tuan', 1, 2, 1000, NULL),
	(1196, 'Thêm danh mục tuần', 'POST | App\\Modules\\DmTuan\\Controllers\\DmTuanController@themDmTuan', 'POST', 'App\\Modules\\DmTuan\\Controllers\\DmTuanController@themDmTuan', '', '', 1194, '2021-06-17 07:38:52', '2021-06-23 16:52:20', 'them-dm-tuan', 1, 2, 1000, NULL),
	(1197, 'Thêm danh mục tuần (hàng loạt)', 'POST | App\\Modules\\DmTuan\\Controllers\\DmTuanController@themDmTuanHangLoat', 'POST', 'App\\Modules\\DmTuan\\Controllers\\DmTuanController@themDmTuanHangLoat', '', '', 1194, '2021-06-17 07:38:52', '2021-06-23 16:52:20', 'them-dm-tuan-hang-loat', 1, 2, 1000, NULL),
	(1198, 'Xem chi tiết danh mục tuần', 'POST | App\\Modules\\DmTuan\\Controllers\\DmTuanController@dmTuanSingle', 'POST', 'App\\Modules\\DmTuan\\Controllers\\DmTuanController@dmTuanSingle', '', '', 1194, '2021-06-17 07:38:52', '2021-06-23 16:52:20', 'dm-tuan-single', 1, 2, 1000, NULL),
	(1199, 'Cập nhật danh mục tuần', 'POST | App\\Modules\\DmTuan\\Controllers\\DmTuanController@capNhatDmTuan', 'POST', 'App\\Modules\\DmTuan\\Controllers\\DmTuanController@capNhatDmTuan', '', '', 1194, '2021-06-17 07:38:52', '2021-06-23 16:52:20', 'cap-nhat-dm-tuan', 1, 2, 1000, NULL),
	(1200, 'Xóa danh mục tuần', 'POST | App\\Modules\\DmTuan\\Controllers\\DmTuanController@xoaDmTuan', 'POST', 'App\\Modules\\DmTuan\\Controllers\\DmTuanController@xoaDmTuan', '', '', 1194, '2021-06-17 07:38:52', '2021-06-23 16:52:20', 'xoa-dm-tuan', 1, 2, 1000, NULL),
	(1201, 'API lưu file', 'POST | App\\Modules\\API\\Controllers\\ApiPaycController@luuFile', 'POST', 'App\\Modules\\API\\Controllers\\ApiPaycController@luuFile', '', '', 1064, '2021-06-23 16:52:19', '2021-06-24 07:53:22', 'api/luu-file', 1, 2, 1000, NULL),
	(1202, 'Xuất báo cáo', 'GET | App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@xuatBaoCao', 'GET', 'App\\Modules\\BaoCaoTuan\\Controllers\\DonViTrucThuocKhac\\DonViTrucThuocKhacController@xuatBaoCao', '', '', 1133, '2021-06-23 16:52:20', '2021-06-24 07:52:50', 'bao-cao-tuan/don-vi-truc-thuoc-khac/xuat-bao-cao', 1, 2, 1000, NULL),
	(1203, 'Log liên thông ĐHSXKD', 'GET | App\\Modules\\BcLogDhsxkd\\Controllers\\BcLogDhsxkdController@bcLogDhsxkd', 'GET', 'App\\Modules\\BcLogDhsxkd\\Controllers\\BcLogDhsxkdController@bcLogDhsxkd', '', '', 1, '2021-06-23 16:52:20', '2021-06-24 07:59:56', 'log-dhsxkd', 1, 1, 26, '<i class="fa fa-rss-square menu-icon"></i>'),
	(1204, 'Xem danh sách log liên thông ĐHSXKD', 'POST | App\\Modules\\BcLogDhsxkd\\Controllers\\BcLogDhsxkdController@danhSachBcLogDhsxkd', 'POST', 'App\\Modules\\BcLogDhsxkd\\Controllers\\BcLogDhsxkdController@danhSachBcLogDhsxkd', '', '', 1203, '2021-06-23 16:52:20', '2021-06-24 07:54:41', 'danh-sach-bc-log-dhsxkd', 1, 2, 1000, NULL),
	(1205, 'Map đơn vị liên thông ĐHSXKD', 'GET | App\\Modules\\MapDonViDhsxkd\\Controllers\\MapDonViDhsxkdController@mapDonViDhsxkd', 'GET', 'App\\Modules\\MapDonViDhsxkd\\Controllers\\MapDonViDhsxkdController@mapDonViDhsxkd', '', '', 1, '2021-06-23 16:52:20', '2021-06-24 08:00:27', 'map-don-vi-dhsxkd', 1, 1, 27, '<i class="fa fa-link menu-icon"></i>'),
	(1206, 'Xem danh sách đơn vị liên thông ĐHSXKD', 'POST | App\\Modules\\MapDonViDhsxkd\\Controllers\\MapDonViDhsxkdController@danhSachMapDonViDhsxkd', 'POST', 'App\\Modules\\MapDonViDhsxkd\\Controllers\\MapDonViDhsxkdController@danhSachMapDonViDhsxkd', '', '', 1205, '2021-06-23 16:52:20', '2021-06-24 07:55:44', 'danh-sach-map-don-vi-dhsxkd', 1, 2, 1000, NULL),
	(1207, 'Quét đơn vị liên thông ĐHSXKD', 'POST | App\\Modules\\MapDonViDhsxkd\\Controllers\\MapDonViDhsxkdController@quetDonViLienThongDhsxkd', 'POST', 'App\\Modules\\MapDonViDhsxkd\\Controllers\\MapDonViDhsxkdController@quetDonViLienThongDhsxkd', '', '', 1205, '2021-06-23 16:52:20', '2021-06-24 07:56:02', 'quet-don-vi-lien-thong-dhsxkd', 1, 2, 1000, NULL),
	(1208, 'Thêm đơn vị liên thông ĐHSXKD', 'POST | App\\Modules\\MapDonViDhsxkd\\Controllers\\MapDonViDhsxkdController@themMapDonViDhsxkd', 'POST', 'App\\Modules\\MapDonViDhsxkd\\Controllers\\MapDonViDhsxkdController@themMapDonViDhsxkd', '', '', 1205, '2021-06-23 16:52:20', '2021-06-24 07:56:19', 'them-map-don-vi-dhsxkd', 1, 2, 1000, NULL),
	(1209, 'Xem chi tiết đơn vị liên thông ĐHSXKD', 'POST | App\\Modules\\MapDonViDhsxkd\\Controllers\\MapDonViDhsxkdController@mapDonViDhsxkdSingle', 'POST', 'App\\Modules\\MapDonViDhsxkd\\Controllers\\MapDonViDhsxkdController@mapDonViDhsxkdSingle', '', '', 1205, '2021-06-23 16:52:20', '2021-06-24 07:56:41', 'map-don-vi-dhsxkd-single', 1, 2, 1000, NULL),
	(1210, 'Cập nhật đơn vị liên thông ĐHSXKD', 'POST | App\\Modules\\MapDonViDhsxkd\\Controllers\\MapDonViDhsxkdController@capNhatMapDonViDhsxkd', 'POST', 'App\\Modules\\MapDonViDhsxkd\\Controllers\\MapDonViDhsxkdController@capNhatMapDonViDhsxkd', '', '', 1205, '2021-06-23 16:52:20', '2021-06-24 07:57:04', 'cap-nhat-map-don-vi-dhsxkd', 1, 2, 1000, NULL),
	(1211, 'Xóa đơn vị liên thông ĐHSXKD', 'POST | App\\Modules\\MapDonViDhsxkd\\Controllers\\MapDonViDhsxkdController@xoaMapDonViDhsxkd', 'POST', 'App\\Modules\\MapDonViDhsxkd\\Controllers\\MapDonViDhsxkdController@xoaMapDonViDhsxkd', '', '', 1205, '2021-06-23 16:52:20', '2021-06-24 07:57:22', 'xoa-map-don-vi-dhsxkd', 1, 2, 1000, NULL),
	(1212, 'Phân quyền báo cáo tuần', 'POST | App\\Modules\\User\\Controllers\\UserController@userPermisionReportSingle', 'POST', 'App\\Modules\\User\\Controllers\\UserController@userPermisionReportSingle', '', '', 1058, '2021-06-23 16:52:21', '2021-06-24 07:58:03', 'user-permison-report-single', 1, 2, 1000, NULL),
	(1213, 'Cập nhật quyền báo cáo tuần', 'POST | App\\Modules\\User\\Controllers\\UserController@updatePermisionReportUser', 'POST', 'App\\Modules\\User\\Controllers\\UserController@updatePermisionReportUser', '', '', 1058, '2021-06-23 16:52:21', '2021-06-24 07:58:32', 'update-permision-report-user', 1, 2, 1000, NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.admin_role: ~9 rows (approximately)
/*!40000 ALTER TABLE `admin_role` DISABLE KEYS */;
INSERT INTO `admin_role` (`id`, `role_name`, `id_don_vi`, `state`, `created_at`, `updated_at`) VALUES
	(1, 'Vãng lai', 1, 1, '2021-03-15 15:49:58', '2021-03-15 15:50:09'),
	(2, 'ADMIN', 1, 1, NULL, '2021-03-15 15:50:19'),
	(3, 'Báo cáo tuần - VTT', 1, 1, '2021-06-17 08:36:58', '2021-06-17 08:38:39'),
	(4, 'Báo cáo tuần - TTVT', 1, 1, '2021-06-17 08:36:35', '2021-06-17 08:38:42'),
	(5, 'Báo cáo tuần - Tổ kỹ thuật', 1, 1, '2021-06-17 08:36:25', '2021-06-17 08:38:47'),
	(6, 'Báo cáo tuần - Phòng ban trực thuộc', 1, 1, '2021-06-17 08:37:48', '2021-06-17 08:40:31'),
	(7, 'Báo cáo tuần - TTCNTT', 1, 1, '2021-06-17 08:07:41', '2021-06-17 08:40:39'),
	(8, 'Báo cáo tuần - TTĐHTT', 1, 1, '2021-06-17 08:07:41', '2021-06-17 08:40:43'),
	(9, 'Báo cáo tuần - TTKD', 1, 1, '2021-06-17 08:07:41', '2021-06-17 08:40:45');
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
) ENGINE=InnoDB AUTO_INCREMENT=1760 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.admin_rule: ~412 rows (approximately)
/*!40000 ALTER TABLE `admin_rule` DISABLE KEYS */;
INSERT INTO `admin_rule` (`id`, `role_id`, `resource_id`, `created_at`, `updated_at`) VALUES
	(939, 2, 964, '2021-06-17 08:48:40', '2021-06-17 08:48:40'),
	(940, 2, 993, '2021-06-17 08:48:40', '2021-06-17 08:48:40'),
	(941, 2, 1048, '2021-06-17 08:48:40', '2021-06-17 08:48:40'),
	(942, 2, 1049, '2021-06-17 08:48:40', '2021-06-17 08:48:40'),
	(943, 2, 1074, '2021-06-17 08:48:40', '2021-06-17 08:48:40'),
	(944, 2, 1050, '2021-06-17 08:48:40', '2021-06-17 08:48:40'),
	(945, 2, 1051, '2021-06-17 08:48:40', '2021-06-17 08:48:40'),
	(946, 2, 1052, '2021-06-17 08:48:40', '2021-06-17 08:48:40'),
	(947, 2, 1053, '2021-06-17 08:48:40', '2021-06-17 08:48:40'),
	(948, 2, 1054, '2021-06-17 08:48:40', '2021-06-17 08:48:40'),
	(949, 2, 1073, '2021-06-17 08:48:40', '2021-06-17 08:48:40'),
	(950, 2, 965, '2021-06-17 08:48:40', '2021-06-17 08:48:40'),
	(951, 2, 1006, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(952, 2, 966, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(953, 2, 967, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(954, 2, 968, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(955, 2, 969, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(956, 2, 1071, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(957, 2, 1072, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(958, 2, 970, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(959, 2, 971, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(960, 2, 972, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(961, 2, 973, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(962, 2, 974, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(963, 2, 975, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(964, 2, 976, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(965, 2, 977, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(966, 2, 978, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(967, 2, 979, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(968, 2, 980, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(969, 2, 981, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(970, 2, 982, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(971, 2, 983, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(972, 2, 984, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(973, 2, 985, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(974, 2, 986, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(975, 2, 987, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(976, 2, 988, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(977, 2, 989, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(978, 2, 990, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(979, 2, 991, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(980, 2, 992, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(981, 2, 994, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(982, 2, 995, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(983, 2, 1035, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(984, 2, 1036, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(985, 2, 1042, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(986, 2, 1043, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(987, 2, 1044, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(988, 2, 1045, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(989, 2, 1046, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(990, 2, 1047, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(991, 2, 1055, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(992, 2, 1056, '2021-06-17 08:48:41', '2021-06-17 08:48:41'),
	(993, 2, 1109, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(994, 2, 1122, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(995, 2, 1123, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(996, 2, 1124, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(997, 2, 1125, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(998, 2, 1126, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(999, 2, 1127, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1000, 2, 1128, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1001, 2, 1129, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1002, 2, 1130, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1003, 2, 1132, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1004, 2, 1150, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1005, 2, 1151, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1006, 2, 1152, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1007, 2, 1180, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1008, 2, 1181, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1009, 2, 1182, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1010, 2, 1133, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1011, 2, 1153, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1012, 2, 1154, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1013, 2, 1155, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1014, 2, 1156, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1015, 2, 1157, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1016, 2, 1158, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1017, 2, 1159, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1018, 2, 1161, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1019, 2, 1162, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1020, 2, 1163, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1021, 2, 1165, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1022, 2, 1183, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1023, 2, 1184, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1024, 2, 1185, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1025, 2, 1166, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1026, 2, 1167, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1027, 2, 1168, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1028, 2, 1169, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1029, 2, 1170, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1030, 2, 1171, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1031, 2, 1172, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1032, 2, 1173, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1033, 2, 1174, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1034, 2, 1175, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1035, 2, 1176, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1036, 2, 1177, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1037, 2, 1178, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1038, 2, 1179, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1039, 2, 1186, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1040, 2, 1187, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1041, 2, 1188, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1042, 2, 1192, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1043, 2, 1189, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1044, 2, 1190, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1045, 2, 1193, '2021-06-17 08:48:42', '2021-06-17 08:48:42'),
	(1056, 2, 996, '2021-06-17 08:48:45', '2021-06-17 08:48:45'),
	(1057, 2, 997, '2021-06-17 08:48:45', '2021-06-17 08:48:45'),
	(1058, 2, 998, '2021-06-17 08:48:45', '2021-06-17 08:48:45'),
	(1059, 2, 999, '2021-06-17 08:48:45', '2021-06-17 08:48:45'),
	(1060, 2, 1000, '2021-06-17 08:48:45', '2021-06-17 08:48:45'),
	(1061, 2, 1001, '2021-06-17 08:48:45', '2021-06-17 08:48:45'),
	(1062, 2, 1003, '2021-06-17 08:48:45', '2021-06-17 08:48:45'),
	(1063, 2, 1004, '2021-06-17 08:48:45', '2021-06-17 08:48:45'),
	(1064, 2, 1005, '2021-06-17 08:48:45', '2021-06-17 08:48:45'),
	(1065, 2, 893, '2021-06-17 08:48:46', '2021-06-17 08:48:46'),
	(1066, 2, 894, '2021-06-17 08:48:46', '2021-06-17 08:48:46'),
	(1067, 2, 895, '2021-06-17 08:48:46', '2021-06-17 08:48:46'),
	(1068, 2, 896, '2021-06-17 08:48:46', '2021-06-17 08:48:46'),
	(1069, 2, 897, '2021-06-17 08:48:46', '2021-06-17 08:48:46'),
	(1070, 2, 898, '2021-06-17 08:48:46', '2021-06-17 08:48:46'),
	(1071, 2, 899, '2021-06-17 08:48:46', '2021-06-17 08:48:46'),
	(1072, 2, 900, '2021-06-17 08:48:46', '2021-06-17 08:48:46'),
	(1073, 2, 901, '2021-06-17 08:48:46', '2021-06-17 08:48:46'),
	(1074, 2, 902, '2021-06-17 08:48:46', '2021-06-17 08:48:46'),
	(1075, 2, 887, '2021-06-17 08:48:47', '2021-06-17 08:48:47'),
	(1076, 2, 888, '2021-06-17 08:48:47', '2021-06-17 08:48:47'),
	(1077, 2, 889, '2021-06-17 08:48:47', '2021-06-17 08:48:47'),
	(1078, 2, 890, '2021-06-17 08:48:47', '2021-06-17 08:48:47'),
	(1079, 2, 891, '2021-06-17 08:48:47', '2021-06-17 08:48:47'),
	(1080, 2, 892, '2021-06-17 08:48:47', '2021-06-17 08:48:47'),
	(1081, 2, 903, '2021-06-17 08:48:48', '2021-06-17 08:48:48'),
	(1082, 2, 904, '2021-06-17 08:48:48', '2021-06-17 08:48:48'),
	(1083, 2, 905, '2021-06-17 08:48:48', '2021-06-17 08:48:48'),
	(1084, 2, 906, '2021-06-17 08:48:48', '2021-06-17 08:48:48'),
	(1085, 2, 907, '2021-06-17 08:48:48', '2021-06-17 08:48:48'),
	(1086, 2, 908, '2021-06-17 08:48:48', '2021-06-17 08:48:48'),
	(1087, 2, 909, '2021-06-17 08:48:48', '2021-06-17 08:48:48'),
	(1088, 2, 885, '2021-06-17 08:48:48', '2021-06-17 08:48:48'),
	(1089, 2, 886, '2021-06-17 08:48:48', '2021-06-17 08:48:48'),
	(1090, 2, 883, '2021-06-17 08:48:49', '2021-06-17 08:48:49'),
	(1091, 2, 884, '2021-06-17 08:48:49', '2021-06-17 08:48:49'),
	(1092, 2, 1065, '2021-06-17 08:48:50', '2021-06-17 08:48:50'),
	(1093, 2, 1066, '2021-06-17 08:48:50', '2021-06-17 08:48:50'),
	(1094, 2, 1067, '2021-06-17 08:48:50', '2021-06-17 08:48:50'),
	(1095, 2, 1068, '2021-06-17 08:48:50', '2021-06-17 08:48:50'),
	(1096, 2, 1069, '2021-06-17 08:48:50', '2021-06-17 08:48:50'),
	(1097, 2, 1070, '2021-06-17 08:48:50', '2021-06-17 08:48:50'),
	(1098, 2, 1079, '2021-06-17 08:48:50', '2021-06-17 08:48:50'),
	(1099, 2, 1080, '2021-06-17 08:48:50', '2021-06-17 08:48:50'),
	(1100, 2, 1081, '2021-06-17 08:48:50', '2021-06-17 08:48:50'),
	(1101, 2, 1082, '2021-06-17 08:48:50', '2021-06-17 08:48:50'),
	(1102, 2, 1083, '2021-06-17 08:48:50', '2021-06-17 08:48:50'),
	(1103, 2, 1084, '2021-06-17 08:48:50', '2021-06-17 08:48:50'),
	(1104, 2, 1085, '2021-06-17 08:48:51', '2021-06-17 08:48:51'),
	(1105, 2, 1086, '2021-06-17 08:48:51', '2021-06-17 08:48:51'),
	(1106, 2, 1087, '2021-06-17 08:48:51', '2021-06-17 08:48:51'),
	(1107, 2, 1088, '2021-06-17 08:48:51', '2021-06-17 08:48:51'),
	(1108, 2, 1089, '2021-06-17 08:48:51', '2021-06-17 08:48:51'),
	(1109, 2, 1090, '2021-06-17 08:48:51', '2021-06-17 08:48:51'),
	(1110, 2, 1091, '2021-06-17 08:48:52', '2021-06-17 08:48:52'),
	(1111, 2, 1092, '2021-06-17 08:48:52', '2021-06-17 08:48:52'),
	(1112, 2, 1093, '2021-06-17 08:48:52', '2021-06-17 08:48:52'),
	(1113, 2, 1094, '2021-06-17 08:48:52', '2021-06-17 08:48:52'),
	(1114, 2, 1095, '2021-06-17 08:48:52', '2021-06-17 08:48:52'),
	(1115, 2, 1096, '2021-06-17 08:48:52', '2021-06-17 08:48:52'),
	(1116, 2, 1097, '2021-06-17 08:48:53', '2021-06-17 08:48:53'),
	(1117, 2, 1098, '2021-06-17 08:48:53', '2021-06-17 08:48:53'),
	(1118, 2, 1099, '2021-06-17 08:48:53', '2021-06-17 08:48:53'),
	(1119, 2, 1100, '2021-06-17 08:48:53', '2021-06-17 08:48:53'),
	(1120, 2, 1101, '2021-06-17 08:48:53', '2021-06-17 08:48:53'),
	(1121, 2, 1102, '2021-06-17 08:48:53', '2021-06-17 08:48:53'),
	(1122, 2, 1103, '2021-06-17 08:48:55', '2021-06-17 08:48:55'),
	(1123, 2, 1104, '2021-06-17 08:48:55', '2021-06-17 08:48:55'),
	(1124, 2, 1105, '2021-06-17 08:48:55', '2021-06-17 08:48:55'),
	(1125, 2, 1106, '2021-06-17 08:48:55', '2021-06-17 08:48:55'),
	(1126, 2, 1107, '2021-06-17 08:48:55', '2021-06-17 08:48:55'),
	(1127, 2, 1108, '2021-06-17 08:48:55', '2021-06-17 08:48:55'),
	(1128, 2, 1144, '2021-06-17 08:48:56', '2021-06-17 08:48:56'),
	(1129, 2, 1145, '2021-06-17 08:48:56', '2021-06-17 08:48:56'),
	(1130, 2, 1146, '2021-06-17 08:48:56', '2021-06-17 08:48:56'),
	(1131, 2, 1147, '2021-06-17 08:48:56', '2021-06-17 08:48:56'),
	(1132, 2, 1148, '2021-06-17 08:48:56', '2021-06-17 08:48:56'),
	(1133, 2, 1149, '2021-06-17 08:48:56', '2021-06-17 08:48:56'),
	(1134, 2, 1194, '2021-06-17 08:48:56', '2021-06-17 08:48:56'),
	(1135, 2, 1195, '2021-06-17 08:48:56', '2021-06-17 08:48:56'),
	(1136, 2, 1196, '2021-06-17 08:48:56', '2021-06-17 08:48:56'),
	(1137, 2, 1197, '2021-06-17 08:48:56', '2021-06-17 08:48:56'),
	(1138, 2, 1198, '2021-06-17 08:48:56', '2021-06-17 08:48:56'),
	(1139, 2, 1199, '2021-06-17 08:48:56', '2021-06-17 08:48:56'),
	(1140, 2, 1200, '2021-06-17 08:48:56', '2021-06-17 08:48:56'),
	(1207, 3, 1109, '2021-06-17 08:49:13', '2021-06-17 08:49:13'),
	(1257, 3, 1189, '2021-06-17 08:49:13', '2021-06-17 08:49:13'),
	(1258, 3, 1190, '2021-06-17 08:49:13', '2021-06-17 08:49:13'),
	(1259, 3, 1193, '2021-06-17 08:49:13', '2021-06-17 08:49:13'),
	(1325, 1, 996, '2021-06-17 16:26:50', '2021-06-17 16:26:50'),
	(1326, 1, 997, '2021-06-17 16:26:50', '2021-06-17 16:26:50'),
	(1327, 1, 998, '2021-06-17 16:26:50', '2021-06-17 16:26:50'),
	(1328, 1, 999, '2021-06-17 16:26:50', '2021-06-17 16:26:50'),
	(1329, 1, 1000, '2021-06-17 16:26:50', '2021-06-17 16:26:50'),
	(1330, 1, 1001, '2021-06-17 16:26:50', '2021-06-17 16:26:50'),
	(1331, 1, 1003, '2021-06-17 16:26:50', '2021-06-17 16:26:50'),
	(1332, 1, 1004, '2021-06-17 16:26:50', '2021-06-17 16:26:50'),
	(1333, 1, 1005, '2021-06-17 16:26:50', '2021-06-17 16:26:50'),
	(1334, 7, 996, '2021-06-17 16:30:02', '2021-06-17 16:30:02'),
	(1335, 7, 997, '2021-06-17 16:30:02', '2021-06-17 16:30:02'),
	(1336, 7, 998, '2021-06-17 16:30:02', '2021-06-17 16:30:02'),
	(1337, 7, 999, '2021-06-17 16:30:02', '2021-06-17 16:30:02'),
	(1338, 7, 1000, '2021-06-17 16:30:02', '2021-06-17 16:30:02'),
	(1339, 7, 1001, '2021-06-17 16:30:02', '2021-06-17 16:30:02'),
	(1340, 7, 1003, '2021-06-17 16:30:02', '2021-06-17 16:30:02'),
	(1341, 7, 1004, '2021-06-17 16:30:02', '2021-06-17 16:30:02'),
	(1342, 7, 1005, '2021-06-17 16:30:02', '2021-06-17 16:30:02'),
	(1343, 5, 996, '2021-06-23 16:51:13', '2021-06-23 16:51:13'),
	(1344, 5, 997, '2021-06-23 16:51:13', '2021-06-23 16:51:13'),
	(1345, 5, 998, '2021-06-23 16:51:13', '2021-06-23 16:51:13'),
	(1346, 5, 999, '2021-06-23 16:51:13', '2021-06-23 16:51:13'),
	(1347, 5, 1000, '2021-06-23 16:51:13', '2021-06-23 16:51:13'),
	(1348, 5, 1001, '2021-06-23 16:51:13', '2021-06-23 16:51:13'),
	(1349, 5, 1003, '2021-06-23 16:51:13', '2021-06-23 16:51:13'),
	(1350, 5, 1004, '2021-06-23 16:51:13', '2021-06-23 16:51:13'),
	(1351, 5, 1005, '2021-06-23 16:51:13', '2021-06-23 16:51:13'),
	(1352, 5, 1109, '2021-06-23 16:51:14', '2021-06-23 16:51:14'),
	(1353, 5, 1122, '2021-06-23 16:51:14', '2021-06-23 16:51:14'),
	(1354, 5, 1123, '2021-06-23 16:51:14', '2021-06-23 16:51:14'),
	(1355, 5, 1124, '2021-06-23 16:51:14', '2021-06-23 16:51:14'),
	(1356, 5, 1125, '2021-06-23 16:51:14', '2021-06-23 16:51:14'),
	(1357, 5, 1126, '2021-06-23 16:51:14', '2021-06-23 16:51:14'),
	(1358, 5, 1127, '2021-06-23 16:51:14', '2021-06-23 16:51:14'),
	(1359, 5, 1128, '2021-06-23 16:51:14', '2021-06-23 16:51:14'),
	(1360, 5, 1129, '2021-06-23 16:51:14', '2021-06-23 16:51:14'),
	(1361, 5, 1130, '2021-06-23 16:51:14', '2021-06-23 16:51:14'),
	(1362, 5, 1132, '2021-06-23 16:51:14', '2021-06-23 16:51:14'),
	(1363, 5, 1150, '2021-06-23 16:51:14', '2021-06-23 16:51:14'),
	(1364, 5, 1151, '2021-06-23 16:51:14', '2021-06-23 16:51:14'),
	(1365, 5, 1152, '2021-06-23 16:51:14', '2021-06-23 16:51:14'),
	(1366, 5, 1180, '2021-06-23 16:51:14', '2021-06-23 16:51:14'),
	(1367, 5, 1181, '2021-06-23 16:51:14', '2021-06-23 16:51:14'),
	(1368, 5, 1182, '2021-06-23 16:51:14', '2021-06-23 16:51:14'),
	(1405, 2, 1205, '2021-06-24 07:51:21', '2021-06-24 07:51:21'),
	(1406, 2, 1203, '2021-06-24 07:51:22', '2021-06-24 07:51:22'),
	(1407, 2, 1202, '2021-06-24 07:51:23', '2021-06-24 07:51:23'),
	(1408, 2, 1058, '2021-06-24 08:01:14', '2021-06-24 08:01:14'),
	(1409, 2, 1059, '2021-06-24 08:01:14', '2021-06-24 08:01:14'),
	(1410, 2, 1060, '2021-06-24 08:01:14', '2021-06-24 08:01:14'),
	(1411, 2, 1061, '2021-06-24 08:01:14', '2021-06-24 08:01:14'),
	(1412, 2, 1062, '2021-06-24 08:01:14', '2021-06-24 08:01:14'),
	(1413, 2, 1063, '2021-06-24 08:01:14', '2021-06-24 08:01:14'),
	(1414, 2, 1075, '2021-06-24 08:01:14', '2021-06-24 08:01:14'),
	(1415, 2, 1076, '2021-06-24 08:01:14', '2021-06-24 08:01:14'),
	(1416, 2, 1077, '2021-06-24 08:01:14', '2021-06-24 08:01:14'),
	(1417, 2, 1078, '2021-06-24 08:01:14', '2021-06-24 08:01:14'),
	(1418, 2, 1212, '2021-06-24 08:01:14', '2021-06-24 08:01:14'),
	(1419, 2, 1213, '2021-06-24 08:01:14', '2021-06-24 08:01:14'),
	(1420, 2, 1064, '2021-06-24 08:01:22', '2021-06-24 08:01:22'),
	(1421, 2, 1025, '2021-06-24 08:01:22', '2021-06-24 08:01:22'),
	(1422, 2, 1026, '2021-06-24 08:01:22', '2021-06-24 08:01:22'),
	(1423, 2, 1027, '2021-06-24 08:01:22', '2021-06-24 08:01:22'),
	(1424, 2, 1028, '2021-06-24 08:01:22', '2021-06-24 08:01:22'),
	(1425, 2, 1030, '2021-06-24 08:01:22', '2021-06-24 08:01:22'),
	(1426, 2, 1031, '2021-06-24 08:01:22', '2021-06-24 08:01:22'),
	(1427, 2, 1032, '2021-06-24 08:01:22', '2021-06-24 08:01:22'),
	(1428, 2, 1033, '2021-06-24 08:01:22', '2021-06-24 08:01:22'),
	(1429, 2, 1034, '2021-06-24 08:01:22', '2021-06-24 08:01:22'),
	(1430, 2, 1041, '2021-06-24 08:01:22', '2021-06-24 08:01:22'),
	(1431, 2, 1191, '2021-06-24 08:01:22', '2021-06-24 08:01:22'),
	(1432, 2, 1201, '2021-06-24 08:01:22', '2021-06-24 08:01:22'),
	(1433, 3, 996, '2021-06-24 08:01:37', '2021-06-24 08:01:37'),
	(1434, 3, 997, '2021-06-24 08:01:37', '2021-06-24 08:01:37'),
	(1435, 3, 998, '2021-06-24 08:01:37', '2021-06-24 08:01:37'),
	(1436, 3, 999, '2021-06-24 08:01:37', '2021-06-24 08:01:37'),
	(1437, 3, 1000, '2021-06-24 08:01:37', '2021-06-24 08:01:37'),
	(1438, 3, 1001, '2021-06-24 08:01:37', '2021-06-24 08:01:37'),
	(1439, 3, 1003, '2021-06-24 08:01:37', '2021-06-24 08:01:37'),
	(1440, 3, 1004, '2021-06-24 08:01:37', '2021-06-24 08:01:37'),
	(1441, 3, 1005, '2021-06-24 08:01:37', '2021-06-24 08:01:37'),
	(1442, 4, 1109, '2021-06-24 08:01:55', '2021-06-24 08:01:55'),
	(1475, 4, 1166, '2021-06-24 08:01:55', '2021-06-24 08:01:55'),
	(1476, 4, 1167, '2021-06-24 08:01:55', '2021-06-24 08:01:55'),
	(1477, 4, 1168, '2021-06-24 08:01:55', '2021-06-24 08:01:55'),
	(1478, 4, 1169, '2021-06-24 08:01:55', '2021-06-24 08:01:55'),
	(1479, 4, 1170, '2021-06-24 08:01:55', '2021-06-24 08:01:55'),
	(1480, 4, 1171, '2021-06-24 08:01:55', '2021-06-24 08:01:55'),
	(1481, 4, 1172, '2021-06-24 08:01:55', '2021-06-24 08:01:55'),
	(1482, 4, 1173, '2021-06-24 08:01:55', '2021-06-24 08:01:55'),
	(1483, 4, 1174, '2021-06-24 08:01:55', '2021-06-24 08:01:55'),
	(1484, 4, 1175, '2021-06-24 08:01:55', '2021-06-24 08:01:55'),
	(1485, 4, 1176, '2021-06-24 08:01:55', '2021-06-24 08:01:55'),
	(1486, 4, 1177, '2021-06-24 08:01:55', '2021-06-24 08:01:55'),
	(1487, 4, 1178, '2021-06-24 08:01:55', '2021-06-24 08:01:55'),
	(1488, 4, 1179, '2021-06-24 08:01:55', '2021-06-24 08:01:55'),
	(1489, 4, 1186, '2021-06-24 08:01:55', '2021-06-24 08:01:55'),
	(1490, 4, 1187, '2021-06-24 08:01:55', '2021-06-24 08:01:55'),
	(1491, 4, 1188, '2021-06-24 08:01:55', '2021-06-24 08:01:55'),
	(1492, 4, 1192, '2021-06-24 08:01:55', '2021-06-24 08:01:55'),
	(1496, 4, 996, '2021-06-24 08:02:03', '2021-06-24 08:02:03'),
	(1497, 4, 997, '2021-06-24 08:02:03', '2021-06-24 08:02:03'),
	(1498, 4, 998, '2021-06-24 08:02:03', '2021-06-24 08:02:03'),
	(1499, 4, 999, '2021-06-24 08:02:03', '2021-06-24 08:02:03'),
	(1500, 4, 1000, '2021-06-24 08:02:03', '2021-06-24 08:02:03'),
	(1501, 4, 1001, '2021-06-24 08:02:03', '2021-06-24 08:02:03'),
	(1502, 4, 1003, '2021-06-24 08:02:03', '2021-06-24 08:02:03'),
	(1503, 4, 1004, '2021-06-24 08:02:03', '2021-06-24 08:02:03'),
	(1504, 4, 1005, '2021-06-24 08:02:03', '2021-06-24 08:02:03'),
	(1505, 6, 996, '2021-06-24 08:02:17', '2021-06-24 08:02:17'),
	(1506, 6, 997, '2021-06-24 08:02:17', '2021-06-24 08:02:17'),
	(1507, 6, 998, '2021-06-24 08:02:17', '2021-06-24 08:02:17'),
	(1508, 6, 999, '2021-06-24 08:02:17', '2021-06-24 08:02:17'),
	(1509, 6, 1000, '2021-06-24 08:02:17', '2021-06-24 08:02:17'),
	(1510, 6, 1001, '2021-06-24 08:02:17', '2021-06-24 08:02:17'),
	(1511, 6, 1003, '2021-06-24 08:02:17', '2021-06-24 08:02:17'),
	(1512, 6, 1004, '2021-06-24 08:02:17', '2021-06-24 08:02:17'),
	(1513, 6, 1005, '2021-06-24 08:02:17', '2021-06-24 08:02:17'),
	(1514, 6, 1109, '2021-06-24 08:02:18', '2021-06-24 08:02:18'),
	(1531, 6, 1133, '2021-06-24 08:02:18', '2021-06-24 08:02:18'),
	(1532, 6, 1153, '2021-06-24 08:02:18', '2021-06-24 08:02:18'),
	(1533, 6, 1154, '2021-06-24 08:02:18', '2021-06-24 08:02:18'),
	(1534, 6, 1155, '2021-06-24 08:02:18', '2021-06-24 08:02:18'),
	(1535, 6, 1156, '2021-06-24 08:02:18', '2021-06-24 08:02:18'),
	(1536, 6, 1157, '2021-06-24 08:02:18', '2021-06-24 08:02:18'),
	(1537, 6, 1158, '2021-06-24 08:02:18', '2021-06-24 08:02:18'),
	(1538, 6, 1159, '2021-06-24 08:02:18', '2021-06-24 08:02:18'),
	(1539, 6, 1161, '2021-06-24 08:02:18', '2021-06-24 08:02:18'),
	(1540, 6, 1162, '2021-06-24 08:02:18', '2021-06-24 08:02:18'),
	(1541, 6, 1163, '2021-06-24 08:02:18', '2021-06-24 08:02:18'),
	(1542, 6, 1165, '2021-06-24 08:02:18', '2021-06-24 08:02:18'),
	(1543, 6, 1183, '2021-06-24 08:02:18', '2021-06-24 08:02:18'),
	(1544, 6, 1184, '2021-06-24 08:02:18', '2021-06-24 08:02:18'),
	(1545, 6, 1185, '2021-06-24 08:02:18', '2021-06-24 08:02:18'),
	(1546, 6, 1202, '2021-06-24 08:02:18', '2021-06-24 08:02:18'),
	(1568, 7, 1109, '2021-06-24 08:02:37', '2021-06-24 08:02:37'),
	(1585, 7, 1133, '2021-06-24 08:02:37', '2021-06-24 08:02:37'),
	(1586, 7, 1153, '2021-06-24 08:02:37', '2021-06-24 08:02:37'),
	(1587, 7, 1154, '2021-06-24 08:02:37', '2021-06-24 08:02:37'),
	(1588, 7, 1155, '2021-06-24 08:02:37', '2021-06-24 08:02:37'),
	(1589, 7, 1156, '2021-06-24 08:02:37', '2021-06-24 08:02:37'),
	(1590, 7, 1157, '2021-06-24 08:02:37', '2021-06-24 08:02:37'),
	(1591, 7, 1158, '2021-06-24 08:02:37', '2021-06-24 08:02:37'),
	(1592, 7, 1159, '2021-06-24 08:02:37', '2021-06-24 08:02:37'),
	(1593, 7, 1161, '2021-06-24 08:02:37', '2021-06-24 08:02:37'),
	(1594, 7, 1162, '2021-06-24 08:02:37', '2021-06-24 08:02:37'),
	(1595, 7, 1163, '2021-06-24 08:02:37', '2021-06-24 08:02:37'),
	(1596, 7, 1165, '2021-06-24 08:02:37', '2021-06-24 08:02:37'),
	(1597, 7, 1183, '2021-06-24 08:02:37', '2021-06-24 08:02:37'),
	(1598, 7, 1184, '2021-06-24 08:02:37', '2021-06-24 08:02:37'),
	(1599, 7, 1185, '2021-06-24 08:02:37', '2021-06-24 08:02:37'),
	(1600, 7, 1202, '2021-06-24 08:02:37', '2021-06-24 08:02:37'),
	(1622, 8, 996, '2021-06-24 08:02:46', '2021-06-24 08:02:46'),
	(1623, 8, 997, '2021-06-24 08:02:46', '2021-06-24 08:02:46'),
	(1624, 8, 998, '2021-06-24 08:02:46', '2021-06-24 08:02:46'),
	(1625, 8, 999, '2021-06-24 08:02:46', '2021-06-24 08:02:46'),
	(1626, 8, 1000, '2021-06-24 08:02:46', '2021-06-24 08:02:46'),
	(1627, 8, 1001, '2021-06-24 08:02:46', '2021-06-24 08:02:46'),
	(1628, 8, 1003, '2021-06-24 08:02:46', '2021-06-24 08:02:46'),
	(1629, 8, 1004, '2021-06-24 08:02:46', '2021-06-24 08:02:46'),
	(1630, 8, 1005, '2021-06-24 08:02:46', '2021-06-24 08:02:46'),
	(1631, 8, 1109, '2021-06-24 08:02:47', '2021-06-24 08:02:47'),
	(1648, 8, 1133, '2021-06-24 08:02:47', '2021-06-24 08:02:47'),
	(1649, 8, 1153, '2021-06-24 08:02:47', '2021-06-24 08:02:47'),
	(1650, 8, 1154, '2021-06-24 08:02:47', '2021-06-24 08:02:47'),
	(1651, 8, 1155, '2021-06-24 08:02:47', '2021-06-24 08:02:47'),
	(1652, 8, 1156, '2021-06-24 08:02:47', '2021-06-24 08:02:47'),
	(1653, 8, 1157, '2021-06-24 08:02:47', '2021-06-24 08:02:47'),
	(1654, 8, 1158, '2021-06-24 08:02:47', '2021-06-24 08:02:47'),
	(1655, 8, 1159, '2021-06-24 08:02:47', '2021-06-24 08:02:47'),
	(1656, 8, 1161, '2021-06-24 08:02:47', '2021-06-24 08:02:47'),
	(1657, 8, 1162, '2021-06-24 08:02:47', '2021-06-24 08:02:47'),
	(1658, 8, 1163, '2021-06-24 08:02:47', '2021-06-24 08:02:47'),
	(1659, 8, 1165, '2021-06-24 08:02:47', '2021-06-24 08:02:47'),
	(1660, 8, 1183, '2021-06-24 08:02:47', '2021-06-24 08:02:47'),
	(1661, 8, 1184, '2021-06-24 08:02:47', '2021-06-24 08:02:47'),
	(1662, 8, 1185, '2021-06-24 08:02:47', '2021-06-24 08:02:47'),
	(1663, 8, 1202, '2021-06-24 08:02:47', '2021-06-24 08:02:47'),
	(1685, 9, 1109, '2021-06-24 08:02:58', '2021-06-24 08:02:58'),
	(1702, 9, 1133, '2021-06-24 08:02:58', '2021-06-24 08:02:58'),
	(1703, 9, 1153, '2021-06-24 08:02:58', '2021-06-24 08:02:58'),
	(1704, 9, 1154, '2021-06-24 08:02:58', '2021-06-24 08:02:58'),
	(1705, 9, 1155, '2021-06-24 08:02:58', '2021-06-24 08:02:58'),
	(1706, 9, 1156, '2021-06-24 08:02:58', '2021-06-24 08:02:58'),
	(1707, 9, 1157, '2021-06-24 08:02:58', '2021-06-24 08:02:58'),
	(1708, 9, 1158, '2021-06-24 08:02:58', '2021-06-24 08:02:58'),
	(1709, 9, 1159, '2021-06-24 08:02:58', '2021-06-24 08:02:58'),
	(1710, 9, 1161, '2021-06-24 08:02:58', '2021-06-24 08:02:58'),
	(1711, 9, 1162, '2021-06-24 08:02:58', '2021-06-24 08:02:58'),
	(1712, 9, 1163, '2021-06-24 08:02:58', '2021-06-24 08:02:58'),
	(1713, 9, 1165, '2021-06-24 08:02:58', '2021-06-24 08:02:58'),
	(1714, 9, 1183, '2021-06-24 08:02:58', '2021-06-24 08:02:58'),
	(1715, 9, 1184, '2021-06-24 08:02:58', '2021-06-24 08:02:58'),
	(1716, 9, 1185, '2021-06-24 08:02:58', '2021-06-24 08:02:58'),
	(1717, 9, 1202, '2021-06-24 08:02:58', '2021-06-24 08:02:58'),
	(1739, 9, 996, '2021-06-24 08:03:00', '2021-06-24 08:03:00'),
	(1740, 9, 997, '2021-06-24 08:03:00', '2021-06-24 08:03:00'),
	(1741, 9, 998, '2021-06-24 08:03:00', '2021-06-24 08:03:00'),
	(1742, 9, 999, '2021-06-24 08:03:00', '2021-06-24 08:03:00'),
	(1743, 9, 1000, '2021-06-24 08:03:00', '2021-06-24 08:03:00'),
	(1744, 9, 1001, '2021-06-24 08:03:00', '2021-06-24 08:03:00'),
	(1745, 9, 1003, '2021-06-24 08:03:00', '2021-06-24 08:03:00'),
	(1746, 9, 1004, '2021-06-24 08:03:00', '2021-06-24 08:03:00'),
	(1747, 9, 1005, '2021-06-24 08:03:00', '2021-06-24 08:03:00'),
	(1748, 1, 964, '2021-06-24 08:03:23', '2021-06-24 08:03:23'),
	(1749, 1, 993, '2021-06-24 08:03:23', '2021-06-24 08:03:23'),
	(1750, 1, 1048, '2021-06-24 08:03:23', '2021-06-24 08:03:23'),
	(1751, 1, 1049, '2021-06-24 08:03:23', '2021-06-24 08:03:23'),
	(1752, 1, 1074, '2021-06-24 08:03:23', '2021-06-24 08:03:23'),
	(1753, 1, 1050, '2021-06-24 08:03:23', '2021-06-24 08:03:23'),
	(1754, 1, 1051, '2021-06-24 08:03:23', '2021-06-24 08:03:23'),
	(1755, 1, 1052, '2021-06-24 08:03:23', '2021-06-24 08:03:23'),
	(1756, 1, 1053, '2021-06-24 08:03:23', '2021-06-24 08:03:23'),
	(1757, 1, 1054, '2021-06-24 08:03:23', '2021-06-24 08:03:23'),
	(1758, 1, 1073, '2021-06-24 08:03:23', '2021-06-24 08:03:23'),
	(1759, 1, 965, '2021-06-24 08:03:24', '2021-06-24 08:03:24');
/*!40000 ALTER TABLE `admin_rule` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.bc_dhsxkd
CREATE TABLE IF NOT EXISTS `bc_dhsxkd` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ma_don_vi` varchar(50) DEFAULT NULL,
  `ma_dinh_danh` varchar(50) DEFAULT NULL,
  `id_thoigian_baocao` int DEFAULT NULL,
  `id_user_bao_cao` int unsigned NOT NULL,
  `chi_so` varchar(250) DEFAULT NULL,
  `gia_tri` varchar(50) DEFAULT NULL,
  `is_group` int NOT NULL COMMENT '0 là không phải group; 1 là group',
  `ghi_chu` varchar(50) DEFAULT NULL,
  `loai_chi_so` varchar(250) DEFAULT 'PHAT_TRIEN_MOI' COMMENT 'PHAT_TRIEN_MOI, XU_LY_SUY_HAO, PAKN,...',
  `suy_hao` varchar(50) DEFAULT NULL,
  `suy_hao_con_lai` varchar(50) DEFAULT NULL,
  `trang_thai` int NOT NULL COMMENT '0 chưa chốt; 1 đã chốt',
  `sap_xep` int NOT NULL COMMENT 'Sắp xếp theo tuần',
  PRIMARY KEY (`id`),
  KEY `FK_bc_dhsxkd_users` (`id_user_bao_cao`),
  KEY `FK_bc_dhsxkd_bc_dm_thoi_gian_bao_cao` (`id_thoigian_baocao`),
  CONSTRAINT `FK_bc_dhsxkd_bc_dm_thoi_gian_bao_cao` FOREIGN KEY (`id_thoigian_baocao`) REFERENCES `bc_dm_thoi_gian_bao_cao` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_bc_dhsxkd_users` FOREIGN KEY (`id_user_bao_cao`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=457 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.bc_dhsxkd: ~30 rows (approximately)
/*!40000 ALTER TABLE `bc_dhsxkd` DISABLE KEYS */;
INSERT INTO `bc_dhsxkd` (`id`, `ma_don_vi`, `ma_dinh_danh`, `id_thoigian_baocao`, `id_user_bao_cao`, `chi_so`, `gia_tri`, `is_group`, `ghi_chu`, `loai_chi_so`, `suy_hao`, `suy_hao_con_lai`, `trang_thai`, `sap_xep`) VALUES
	(427, 'VT_TPO', '001.02.01.H59', NULL, 41, 'lapmoi_fiber', '463', 0, '', 'PHAT_TRIEN_MOI', NULL, NULL, 0, 427),
	(428, 'VT_TPO', '001.02.01.H59', NULL, 41, 'mega_sang_fiber', '62', 0, '', 'PHAT_TRIEN_MOI', NULL, NULL, 0, 428),
	(429, 'VT_TPO', '001.02.01.H59', NULL, 41, 'lapmoi_mytv', '1093', 0, '', 'PHAT_TRIEN_MOI', NULL, NULL, 0, 429),
	(430, 'VT_TPO', '001.02.01.H59', NULL, 41, 'lapmoi_ddtrasau', '21', 0, '', 'PHAT_TRIEN_MOI', NULL, NULL, 0, 430),
	(431, 'VT_TPO', '001.02.01.H59', NULL, 41, 'lapmoi_ddtratruoc', '393', 0, '', 'PHAT_TRIEN_MOI', NULL, NULL, 0, 431),
	(432, 'VT_TPO', '001.02.01.H59', NULL, 41, 'lapmoi_mnp', '17', 0, '', 'PHAT_TRIEN_MOI', NULL, NULL, 0, 432),
	(433, 'VT_TPO', '001.02.01.H59', NULL, 41, 'Nguyễn Duy Sơn', '15', 0, '', 'XU_LY_SUY_HAO', '15', '0', 0, 433),
	(434, 'VT_TPO', '001.02.01.H59', NULL, 41, 'Lê Quốc', '27', 0, '', 'XU_LY_SUY_HAO', '27', '0', 0, 434),
	(435, 'VT_TPO', '001.02.01.H59', NULL, 41, 'Bí Minh Lý', '37', 0, '', 'XU_LY_SUY_HAO', '37', '0', 0, 435),
	(436, 'VT_TPO', '001.02.01.H59', NULL, 41, 'Nguyễn Văn Tình', '13', 0, '', 'XU_LY_SUY_HAO', '13', '0', 0, 436),
	(437, 'VT_TPO', '001.02.01.H59', NULL, 41, 'Trần Nhật Tài', '29', 0, '', 'XU_LY_SUY_HAO', '36', '0', 0, 437),
	(438, 'VT_TPO', '001.02.01.H59', NULL, 41, 'Đào Bá Linh', '46', 0, '', 'XU_LY_SUY_HAO', '51', '0', 0, 438),
	(439, 'VT_TPO', '001.02.01.H59', NULL, 41, 'Dương Nguyên Anh Tú', '24', 0, '', 'XU_LY_SUY_HAO', '24', '0', 0, 439),
	(440, 'VT_TPO', '001.02.01.H59', NULL, 41, 'Nguyễn Việt Cường', '46', 0, '', 'XU_LY_SUY_HAO', '48', '0', 0, 440),
	(441, 'VT_TPO', '001.02.01.H59', NULL, 41, 'Đoàn Văn Út', '47', 0, '', 'XU_LY_SUY_HAO', '49', '0', 0, 441),
	(442, 'VT_TPO', '001.02.01.H59', NULL, 41, 'Huỳnh Minh Thiện', '36', 0, '', 'XU_LY_SUY_HAO', '46', '0', 0, 442),
	(443, 'VT_TPO', '001.02.01.H59', NULL, 41, 'Nguyễn Xuân Minh', '36', 0, '', 'XU_LY_SUY_HAO', '38', '0', 0, 443),
	(444, 'VT_TPO', '001.02.01.H59', NULL, 41, 'Võ Hoàng Phúc', '44', 0, '', 'XU_LY_SUY_HAO', '48', '0', 0, 444),
	(445, 'VT_TPO', '001.02.01.H59', NULL, 41, 'Đoàn Lê Nhân Ái', '37', 0, '', 'XU_LY_SUY_HAO', '58', '0', 0, 445),
	(446, 'VT_TPO', '001.02.01.H59', NULL, 41, 'Trần Văn Lượm', '43', 0, '', 'XU_LY_SUY_HAO', '43', '0', 0, 446),
	(447, 'VT_TPO', '001.02.01.H59', NULL, 41, 'Trần Nguyễn Trung Tín', '45', 0, '', 'XU_LY_SUY_HAO', '53', '0', 0, 447),
	(448, 'VT_TPO', '001.02.01.H59', NULL, 41, 'home_internet', '65', 0, '', 'GOI_HOME', NULL, NULL, 0, 448),
	(449, 'VT_TPO', '001.02.01.H59', NULL, 41, 'home_mobile', '1', 0, '', 'GOI_HOME', NULL, NULL, 0, 449),
	(450, 'VT_TPO', '001.02.01.H59', NULL, 41, 'home_tv', '273', 0, '', 'GOI_HOME', NULL, NULL, 0, 450),
	(451, 'VT_TPO', '001.02.01.H59', NULL, 41, 'home_combo', '4', 0, '', 'GOI_HOME', NULL, NULL, 0, 451),
	(452, 'VT_TPO', '001.02.01.H59', NULL, 41, 'tongphieu_tc', '1874', 0, '', 'XU_LU_DUNG_HAN', NULL, NULL, 0, 452),
	(453, 'VT_TPO', '001.02.01.H59', NULL, 41, 'dunghan_tc', '1859', 0, '', 'XU_LU_DUNG_HAN', NULL, NULL, 0, 453),
	(454, 'VT_TPO', '001.02.01.H59', NULL, 41, 'tongphieu_bh', '3724', 0, '', 'XU_LU_DUNG_HAN', NULL, NULL, 0, 454),
	(455, 'VT_TPO', '001.02.01.H59', NULL, 41, 'dunghan_bh', '3572', 0, '', 'XU_LU_DUNG_HAN', NULL, NULL, 0, 455),
	(456, 'VT_TPO', '001.02.01.H59', NULL, 41, 'so_tram_mll', '22', 0, '', 'MLL', NULL, NULL, 0, 456);
/*!40000 ALTER TABLE `bc_dhsxkd` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.bc_dm_chi_so
CREATE TABLE IF NOT EXISTS `bc_dm_chi_so` (
  `id` int NOT NULL AUTO_INCREMENT,
  `chi_so` varchar(250) NOT NULL,
  `mo_ta` varchar(250) DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `sap_xep` int DEFAULT NULL,
  `ngay_cap_nhat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `chi_so` (`chi_so`),
  KEY `FK_bc_dm_chi_so_bc_dm_chi_so` (`parent_id`),
  CONSTRAINT `FK_bc_dm_chi_so_bc_dm_chi_so` FOREIGN KEY (`parent_id`) REFERENCES `bc_dm_chi_so` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.bc_dm_chi_so: ~15 rows (approximately)
/*!40000 ALTER TABLE `bc_dm_chi_so` DISABLE KEYS */;
INSERT INTO `bc_dm_chi_so` (`id`, `chi_so`, `mo_ta`, `parent_id`, `sap_xep`, `ngay_cap_nhat`) VALUES
	(6, 'lapmoi_fiber', 'Lắp mới Fiber', NULL, 6, '2021-06-23 20:09:34'),
	(7, 'mega_sang_fiber', 'Chuyển mega sang fiber', NULL, 7, '2021-06-23 20:09:54'),
	(8, 'lapmoi_mytv', 'Lắp mới MyTV', NULL, 8, '2021-06-23 20:10:11'),
	(9, 'lapmoi_ddtrasau', 'Phát triển di động trả sau', NULL, 9, '2021-06-23 20:10:34'),
	(10, 'lapmoi_ddtratruoc', 'Phát triển di động trả trước', NULL, 10, '2021-06-23 20:10:52'),
	(11, 'lapmoi_mnp', 'Chuyển mạng giử số', NULL, 11, '2021-06-23 20:11:13'),
	(12, 'home_internet', 'home_internet', NULL, 12, '2021-06-23 16:55:12'),
	(13, 'home_mobile', 'home_mobile', NULL, 13, '2021-06-23 16:55:12'),
	(14, 'home_tv', 'home_tv', NULL, 14, '2021-06-23 16:55:12'),
	(15, 'home_combo', 'home_combo', NULL, 15, '2021-06-23 16:55:12'),
	(16, 'tongphieu_tc', 'tongphieu_tc', NULL, 16, '2021-06-23 16:55:12'),
	(17, 'dunghan_tc', 'dunghan_tc', NULL, 17, '2021-06-23 16:55:12'),
	(18, 'tongphieu_bh', 'tongphieu_bh', NULL, 18, '2021-06-23 16:55:12'),
	(19, 'dunghan_bh', 'dunghan_bh', NULL, 19, '2021-06-23 16:55:12'),
	(20, 'so_tram_mll', 'Số trạm mất liên lạc', NULL, 20, '2021-06-23 20:11:40');
/*!40000 ALTER TABLE `bc_dm_chi_so` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.bc_dm_quyen_bao_cao_tuan
CREATE TABLE IF NOT EXISTS `bc_dm_quyen_bao_cao_tuan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ma_nhom_quyen` varchar(50) NOT NULL,
  `ten_nhom_quyen` varchar(250) NOT NULL,
  `trang_thai` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma_nhom_quyen` (`ma_nhom_quyen`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.bc_dm_quyen_bao_cao_tuan: ~10 rows (approximately)
/*!40000 ALTER TABLE `bc_dm_quyen_bao_cao_tuan` DISABLE KEYS */;
INSERT INTO `bc_dm_quyen_bao_cao_tuan` (`id`, `ma_nhom_quyen`, `ten_nhom_quyen`, `trang_thai`) VALUES
	(1, 'BAO_CAO_TUAN_HIEN_TAI', 'Báo cáo tuần hiện tại', 1),
	(2, 'BAO_CAO_KE_HOACH_TUAN', 'Báo cáo kế hoạch tuần', 1),
	(3, 'BAO_CAO_DHSXKD', 'Báo cáo ĐHSXKD', 1),
	(4, 'XEM_BAO_CAO_TONG_HOP', 'Báo cáo tổng hợp', 1),
	(5, 'XEM_BAO_CAO_TOAN_DON_VI', 'Xem báo cáo toàn đơn vị', 1),
	(6, 'IN_BAO_CAO', 'In báo cáo', 1),
	(7, 'GUI_THONG_BAO_QUA_TELEGRAM', 'Gửi thông báo qua Telegram', 1),
	(8, 'XUAT_BAO_CAO_SANG_WORD', 'Xuất báo cáo sang word', 1),
	(9, 'DUYET_VA_GUI_BAO_CAO', 'Duyệt và gửi báo cáo', 1),
	(10, 'XUAT_BAO_CAO', 'Xuất báo cáo', 1);
/*!40000 ALTER TABLE `bc_dm_quyen_bao_cao_tuan` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.bc_dm_thoi_gian_bao_cao
CREATE TABLE IF NOT EXISTS `bc_dm_thoi_gian_bao_cao` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ma_don_vi` varchar(50) DEFAULT NULL,
  `ma_dinh_danh` varchar(50) DEFAULT NULL,
  `id_tuan` int DEFAULT NULL,
  `thoi_gian_lay_so_lieu` datetime DEFAULT NULL,
  `thoi_gian_chot_so_lieu` datetime DEFAULT NULL,
  `ghi_chu` varchar(250) DEFAULT NULL,
  `trang_thai` int NOT NULL DEFAULT '0' COMMENT '0 chưa chốt; 1 đã chốt',
  PRIMARY KEY (`id`),
  KEY `FK_bc_thoigian_bc_donvi_bc_dm_tuan` (`id_tuan`),
  CONSTRAINT `FK_bc_thoigian_bc_donvi_bc_dm_tuan` FOREIGN KEY (`id_tuan`) REFERENCES `bc_dm_tuan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.bc_dm_thoi_gian_bao_cao: ~23 rows (approximately)
/*!40000 ALTER TABLE `bc_dm_thoi_gian_bao_cao` DISABLE KEYS */;
INSERT INTO `bc_dm_thoi_gian_bao_cao` (`id`, `ma_don_vi`, `ma_dinh_danh`, `id_tuan`, `thoi_gian_lay_so_lieu`, `thoi_gian_chot_so_lieu`, `ghi_chu`, `trang_thai`) VALUES
	(1, 'VT_TPO', '001.09.01.H59', 576, '2021-06-18 16:30:00', NULL, NULL, 2),
	(80, 'VT_CTH', '002.09.01.H59', 576, '2021-06-18 16:30:00', NULL, NULL, 2),
	(81, 'VT_CLG', '001.10.01.H59', 576, '2021-06-18 16:30:00', NULL, NULL, 2),
	(82, 'VT_TCN', '002.10.01.H59', 576, '2021-06-18 16:30:00', NULL, NULL, 2),
	(83, 'VT_CKE', '003.10.01.H59', 576, '2021-06-18 16:30:00', NULL, NULL, 2),
	(84, 'VT_CNG', '001.11.01.H59', 576, '2021-06-18 16:30:00', NULL, NULL, 2),
	(85, 'VT_TCU', '002.11.01.H59', 576, '2021-06-18 16:30:00', NULL, NULL, 2),
	(86, 'VT_DHI', '003.11.01.H59', 576, '2021-06-18 16:30:00', NULL, NULL, 2),
	(87, 'VT_TXDHI', '004.11.01.H59', 576, '2021-06-18 16:30:00', NULL, NULL, 2),
	(88, 'NSTH', '000.01.01.H59', 576, '2021-06-18 16:30:00', NULL, NULL, 2),
	(89, 'KTDT', '000.02.01.H59', 576, '2021-06-18 16:30:00', NULL, NULL, 2),
	(90, 'KHKT', '000.03.01.H59', 576, '2021-06-18 16:30:00', NULL, NULL, 2),
	(91, 'KCTD', '000.04.01.H59', 576, '2021-06-18 16:30:00', NULL, NULL, 2),
	(92, 'CD', '000.05.01.H59', 576, '2021-06-18 16:30:00', NULL, NULL, 2),
	(93, 'DTN', '000.06.01.H59', 576, '2021-06-18 16:30:00', NULL, NULL, 2),
	(94, 'TTCNTT', '000.07.01.H59', 576, '2021-06-24 08:24:51', NULL, NULL, 2),
	(95, 'TTDHTT', '000.08.01.H59', 576, '2021-06-18 16:30:00', NULL, NULL, 2),
	(96, 'TTVT1', '000.09.01.H59', 576, '2021-06-18 16:30:00', NULL, NULL, 2),
	(97, 'TTVT2', '000.10.01.H59', 576, '2021-06-18 16:30:00', NULL, NULL, 2),
	(98, 'TTVT3', '000.11.01.H59', 576, '2021-06-18 16:30:00', NULL, NULL, 2),
	(99, 'TTKD', '000.12.01.H59', 576, '2021-06-18 16:30:00', NULL, NULL, 2),
	(100, 'VT_TPO', '001.09.01.H59', 577, '2021-06-24 07:45:25', NULL, NULL, 0),
	(101, 'TTCNTT', '000.07.01.H59', 577, '2021-06-24 08:05:03', NULL, NULL, 0),
	(102, 'TTCNTT', '000.07.01.H59', 575, '2021-06-24 08:26:52', NULL, NULL, 0);
/*!40000 ALTER TABLE `bc_dm_thoi_gian_bao_cao` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.bc_dm_tuan
CREATE TABLE IF NOT EXISTS `bc_dm_tuan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nam` int DEFAULT NULL,
  `thang` int DEFAULT NULL,
  `tuan` int DEFAULT NULL,
  `tu_ngay` date DEFAULT NULL,
  `den_ngay` date DEFAULT NULL,
  `trang_thai` int NOT NULL DEFAULT '0' COMMENT '0 không hoạt động; 1 hoạt động',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1072 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.bc_dm_tuan: ~521 rows (approximately)
/*!40000 ALTER TABLE `bc_dm_tuan` DISABLE KEYS */;
INSERT INTO `bc_dm_tuan` (`id`, `nam`, `thang`, `tuan`, `tu_ngay`, `den_ngay`, `trang_thai`) VALUES
	(575, 2021, NULL, 25, '2021-06-07', '2021-06-11', 1),
	(576, 2021, NULL, 26, '2021-06-14', '2021-06-18', 1),
	(577, 2021, NULL, 27, '2021-06-21', '2021-06-25', 1),
	(578, 2021, NULL, 28, '2021-06-28', '2021-07-02', 1);
/*!40000 ALTER TABLE `bc_dm_tuan` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.bc_ke_hoach_tuan
CREATE TABLE IF NOT EXISTS `bc_ke_hoach_tuan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ma_don_vi` varchar(50) DEFAULT NULL,
  `ma_dinh_danh` varchar(50) DEFAULT NULL,
  `id_tuan` int DEFAULT NULL,
  `id_user_bao_cao` int unsigned DEFAULT NULL,
  `noi_dung` longtext,
  `ghi_chu` varchar(250) DEFAULT NULL,
  `thoi_gian_bao_cao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_group` int NOT NULL COMMENT '0 không phải là group; 1 là group',
  `id_dich_vu` int DEFAULT NULL,
  `trang_thai` int NOT NULL COMMENT '0 chưa chốt; 1 đã chốt',
  `sap_xep` int NOT NULL COMMENT 'Sắp xếp theo tuần',
  PRIMARY KEY (`id`),
  KEY `FK_bc_ke_hoach_tuan_users` (`id_user_bao_cao`),
  KEY `FK_bc_ke_hoach_tuan_bc_dm_tuan` (`id_tuan`),
  CONSTRAINT `FK_bc_ke_hoach_tuan_bc_dm_tuan` FOREIGN KEY (`id_tuan`) REFERENCES `bc_dm_tuan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_bc_ke_hoach_tuan_users` FOREIGN KEY (`id_user_bao_cao`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=453 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.bc_ke_hoach_tuan: ~38 rows (approximately)
/*!40000 ALTER TABLE `bc_ke_hoach_tuan` DISABLE KEYS */;
INSERT INTO `bc_ke_hoach_tuan` (`id`, `ma_don_vi`, `ma_dinh_danh`, `id_tuan`, `id_user_bao_cao`, `noi_dung`, `ghi_chu`, `thoi_gian_bao_cao`, `is_group`, `id_dich_vu`, `trang_thai`, `sap_xep`) VALUES
	(396, 'TTCNTT', '000.07.01.H59', 576, 51, 'VNPT iOffice/eOffice', NULL, '2021-06-18 08:01:01', 3, 10, 0, 510),
	(397, 'TTCNTT', '000.07.01.H59', 576, 51, 'Tiếp tục hỗ trợ các đơn vị, theo dõi tình hình hoạt động iOffice của UBND;', NULL, '2021-06-18 08:01:24', 1, 10, 0, 510),
	(398, 'TTCNTT', '000.07.01.H59', 576, 51, 'Phối hợp với IT5, Egov xử lý các lỗi tồn đọng và phát sinh', NULL, '2021-06-18 08:01:37', 1, 10, 0, 510),
	(399, 'TTCNTT', '000.07.01.H59', 576, 51, 'Outsource: Tiếp tục thực hiện outsource các yêu cầu, fix lỗi nếu có.', NULL, '2021-06-18 08:01:51', 1, 10, 0, 510),
	(406, 'TTCNTT', '000.07.01.H59', 576, 50, 'Phần mềm VNPT-HIS', NULL, '2021-06-18 09:23:50', 3, 9, 0, 50406),
	(407, 'TTCNTT', '000.07.01.H59', 576, 50, 'Phối hợp với TT Ehealth liên thông HSSK ver 2.0 sau khi TTKD xác nhận manday thực hiện;', NULL, '2021-06-18 09:23:59', 2, 9, 0, 50407),
	(408, 'TTCNTT', '000.07.01.H59', 576, 50, 'Thực hiện outsource các y.c;', NULL, '2021-06-18 09:24:10', 2, 9, 0, 50408),
	(409, 'TTCNTT', '000.07.01.H59', 576, 50, 'Kiểm tra lại các dịch vụ VNPT - HIS/LIS/PACS/HMIS sau khi VNPT - IT cập nhật;', NULL, '2021-06-18 09:24:17', 2, 9, 0, 50409),
	(410, 'TTCNTT', '000.07.01.H59', 576, 50, 'Tiếp nhận các y/c bổ sung, chỉnh sửa từ các đơn vị sử dụng;', NULL, '2021-06-18 09:24:24', 2, 9, 0, 50410),
	(411, 'TTCNTT', '000.07.01.H59', 576, 52, 'Triển khai phần mềm Hóa đơn điện tử', NULL, '2021-06-18 09:39:41', 3, 14, 0, 52411),
	(412, 'TTCNTT', '000.07.01.H59', 576, 53, 'vnPortal', NULL, '2021-06-18 09:51:23', 3, 13, 0, 53412),
	(413, 'TTCNTT', '000.07.01.H59', 576, 53, 'Hỗ trợ đơn vị sử dụng', NULL, '2021-06-18 09:51:46', 2, 13, 0, 53413),
	(416, 'TTCNTT', '000.07.01.H59', 576, 37, 'CSDLQG-DC', NULL, '2021-06-18 10:54:54', 3, 16, 0, 37416),
	(417, 'TTCNTT', '000.07.01.H59', 576, 37, 'Tiếp tục tiếp nhận y/c và hỗ trợ các đơn vị sử dụng hệ thống.', NULL, '2021-06-18 10:55:03', 2, 16, 0, 37417),
	(418, 'TTCNTT', '000.07.01.H59', 576, 57, 'LGSP', NULL, '2021-06-18 11:00:19', 3, 15, 0, 57418),
	(419, 'TTCNTT', '000.07.01.H59', 576, 57, 'Tiếp tục tiếp nhận y/c và hỗ trợ các đơn vị sử dụng hệ thống.', NULL, '2021-06-18 11:02:34', 2, 12, 0, 57419),
	(420, 'TTCNTT', '000.07.01.H59', 576, 49, 'Triển khai phần mềm ĐHSXKD tập trung', NULL, '2021-06-18 11:11:04', 3, 2, 0, 49420),
	(421, 'TTCNTT', '000.07.01.H59', 576, 49, 'Mobile App VNPT-TVH-CO:', NULL, '2021-06-18 11:11:28', 2, 2, 0, 49421),
	(422, 'TTCNTT', '000.07.01.H59', 576, 49, 'Phiên bản IOS: Hoàn thiện chức năng nhận thông báo và xây dựng module lương trực tuyến;', NULL, '2021-06-18 11:11:39', 1, 2, 0, 49422),
	(423, 'TTCNTT', '000.07.01.H59', 576, 49, 'Phiên bản Android: Sửa lỗi nếu có;', NULL, '2021-06-18 11:11:51', 1, 2, 0, 49423),
	(424, 'TTCNTT', '000.07.01.H59', 576, 49, 'Nâng cấp chương trình quản lý tài sản: tối ưu các xử lý để tăng tốc độ;', NULL, '2021-06-18 11:12:02', 2, 2, 0, 49424),
	(425, 'TTCNTT', '000.07.01.H59', 576, 49, 'Xây dựng công cụ theo dõi thời gian xử lý phiếu KHDN (phiếu thi công và báo hỏng);', NULL, '2021-06-18 11:12:12', 2, 2, 0, 49425),
	(426, 'TTCNTT', '000.07.01.H59', 576, 49, 'Chỉnh sửa Dashboard theo yêu cầu;', NULL, '2021-06-18 11:12:25', 2, 2, 0, 49426),
	(427, 'TTCNTT', '000.07.01.H59', 576, 3, 'VNPT-iGate', NULL, '2021-06-18 13:28:45', 3, 11, 0, 3427),
	(428, 'TTCNTT', '000.07.01.H59', 576, 3, 'Thực hiện upcode và kiểm tra lại hệ thống sau khi hoàn tất quá trình upcode', NULL, '2021-06-18 13:28:50', 2, 11, 0, 3428),
	(429, 'TTCNTT', '000.07.01.H59', 576, 3, 'Phối hợp ITKV 5 xử lý lỗi tồn động, phát sinh trong quá trình triển khai, outsource các yêu cầu người dùng', NULL, '2021-06-18 13:29:00', 2, 11, 0, 3429),
	(430, 'TTCNTT', '000.07.01.H59', 576, 3, 'Tiếp tục cập nhật thông tin bộ thủ tục hành chính theo yêu cầu của UBND huyện Tiểu Cần', NULL, '2021-06-18 13:29:10', 2, 11, 0, 3430),
	(431, 'TTCNTT', '000.07.01.H59', 576, 3, 'Hỗ trợ xử lý lỗi đồng bộ hồ sơ đất đai của Sở Tài nguyên và Môi trường', NULL, '2021-06-18 13:29:19', 2, 11, 0, 3431),
	(432, 'TTCNTT', '000.07.01.H59', 576, 3, 'Cập nhật thời gian xử lý của quy trình đối với thủ tục liên thông phần mềm quản lý đất đai VILIS theo yêu cầu của Sở Tài nguyên Môi trường', NULL, '2021-06-18 13:29:31', 2, 11, 0, 3432),
	(433, 'TTCNTT', '000.07.01.H59', 576, 3, 'Outsource:', NULL, '2021-06-18 13:29:43', 2, 11, 0, 3433),
	(434, 'TTCNTT', '000.07.01.H59', 576, 3, 'Tiếp tục cập nhật API isodaihoccantho thêm cột dữ liệu trạng thái thủ tục', NULL, '2021-06-18 13:29:54', 1, 11, 0, 3434),
	(435, 'TTCNTT', '000.07.01.H59', 576, 3, 'Tiếp tục cập nhật API tra cứu hồ sơ theo mã thủ tục cho phép tra cứu hồ sơ của những thủ tục có trạng thái đã đóng', NULL, '2021-06-18 13:30:02', 1, 11, 0, 3435),
	(436, 'TTCNTT', '000.07.01.H59', 576, 3, 'Rà soát, tổng hợp, sao lưu lại source code của các yêu cầu đã thực hiện hotfix trước đó, tạo yêu cầu outsource và merge code đã hotfix, chuẩn bị nâng cấp phiên bản mới nhất', NULL, '2021-06-18 13:30:13', 1, 11, 0, 3436),
	(437, 'TTCNTT', '000.07.01.H59', 576, 3, 'Hỗ trợ điều chỉnh hệ thống đồng bộ hồ sơ đất đai cho phép cập nhật lại hạn xử lý, ngày trả kết quả của hồ sơ', NULL, '2021-06-18 13:30:22', 1, 11, 0, 3437),
	(438, 'TTCNTT', '000.07.01.H59', 576, 54, 'vnEdu', NULL, '2021-06-18 14:19:56', 3, 12, 0, 54438),
	(439, 'TTCNTT', '000.07.01.H59', 576, 54, 'Tiếp tục hỗ trợ các trường sử dụng phần mềm.', NULL, '2021-06-18 14:20:00', 2, 12, 0, 54439),
	(440, 'TTCNTT', '000.07.01.H59', 576, 54, 'Công việc thường xuyên.', NULL, '2021-06-18 14:20:09', 2, 12, 0, 54440),
	(441, 'TTCNTT', '000.07.01.H59', 576, 38, 'Các công việc thường xuyên khác', NULL, '2021-06-18 15:44:49', 3, 17, 0, 38441);
/*!40000 ALTER TABLE `bc_ke_hoach_tuan` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.bc_log_dhsxkd
CREATE TABLE IF NOT EXISTS `bc_log_dhsxkd` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `send_body` longtext,
  `respone_body` longtext,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_bc_log_dhsxkd_users` (`user_id`),
  CONSTRAINT `FK_bc_log_dhsxkd_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.bc_log_dhsxkd: ~21 rows (approximately)
/*!40000 ALTER TABLE `bc_log_dhsxkd` DISABLE KEYS */;
INSERT INTO `bc_log_dhsxkd` (`id`, `user_id`, `send_body`, `respone_body`, `created_at`) VALUES
	(25, 2, '{"method":"GET","url":"https:\\/\\/api.vnpttravinh.vn\\/bao-cao-tuan\\/don-vi","headers":{"Content-Type":"application\\/json","Accept":"application\\/json","x-access-token":"ZXlKaGJHY2lPaUpJVXpJMU5pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SnBaQ0k2SWtobWRIRmFWeUlzSW1saGRDSTZNVFl5TXpZMk1qQXlOQ3dpWlhod0lqb3pNVGN4TmpneE1EUTBNalI5LmJacnBTVmtKQzJJRlN5X056V1BwUm1XQWZLdEFXdDhFbzlMUElFeHNLV00"}}', '[{"donvi_id":0,"ten_dv":"-- Toàn tỉnh --"},{"donvi_id":9,"ten_dv":"TTVT1 - Khu vực Châu Thành"},{"donvi_id":10,"ten_dv":"TTVT1 - Khu vực Tp. Trà Vinh"},{"donvi_id":11,"ten_dv":"TTVT2 - Khu vực Càng Long"},{"donvi_id":12,"ten_dv":"TTVT2 - Khu vực Tiểu Cần"},{"donvi_id":13,"ten_dv":"TTVT2 - Khu vực Cầu Kè"},{"donvi_id":14,"ten_dv":"TTVT3 - Khu vực Cầu Ngang"},{"donvi_id":15,"ten_dv":"TTVT3 - Khu vực Trà Cú"},{"donvi_id":16,"ten_dv":"TTVT3 - Khu vực Duyên Hải"},{"donvi_id":26,"ten_dv":"TTVT3 - Khu vực TX Duyên Hải"}]', '2021-06-23 16:52:42'),
	(26, 41, '{"method":"GET","url":"https:\\/\\/api.vnpttravinh.vn\\/bao-cao-tuan\\/don-vi","headers":{"Content-Type":"application\\/json","Accept":"application\\/json","x-access-token":"ZXlKaGJHY2lPaUpJVXpJMU5pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SnBaQ0k2SWtobWRIRmFWeUlzSW1saGRDSTZNVFl5TXpZMk1qQXlOQ3dpWlhod0lqb3pNVGN4TmpneE1EUTBNalI5LmJacnBTVmtKQzJJRlN5X056V1BwUm1XQWZLdEFXdDhFbzlMUElFeHNLV00"}}', '{"message":"Lấy dữ liệu thành công","errors":0,"access_token":null,"token_type":null,"expires_at":"2021-06-23 16:55:07","data":{"donvi_id":10,"lapmoi_fiber":463,"mega_sang_fiber":62,"lapmoi_mytv":1093,"lapmoi_ddtrasau":21,"lapmoi_ddtratruoc":393,"lapmoi_mnp":17}}', '2021-06-23 16:55:07'),
	(27, 41, '{"method":"GET","url":"https:\\/\\/api.vnpttravinh.vn\\/bao-cao-tuan\\/don-vi","headers":{"Content-Type":"application\\/json","Accept":"application\\/json","x-access-token":"ZXlKaGJHY2lPaUpJVXpJMU5pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SnBaQ0k2SWtobWRIRmFWeUlzSW1saGRDSTZNVFl5TXpZMk1qQXlOQ3dpWlhod0lqb3pNVGN4TmpneE1EUTBNalI5LmJacnBTVmtKQzJJRlN5X056V1BwUm1XQWZLdEFXdDhFbzlMUElFeHNLV00"}}', '{"message":"Lấy dữ liệu thành công","errors":0,"access_token":null,"token_type":null,"expires_at":"2021-06-23 16:55:11","data":[{"donvi_id":10,"ten_nv":"Nguyễn Duy Sơn","tong_phieu":15,"dang_xuly":0,"da_xuly":15,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Lê Quốc","tong_phieu":27,"dang_xuly":0,"da_xuly":27,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Bí Minh Lý","tong_phieu":37,"dang_xuly":0,"da_xuly":37,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Nguyễn Văn Tình","tong_phieu":13,"dang_xuly":0,"da_xuly":13,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Trần Nhật Tài","tong_phieu":36,"dang_xuly":7,"da_xuly":29,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Đào Bá Linh","tong_phieu":51,"dang_xuly":6,"da_xuly":45,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Dương Nguyên Anh Tú","tong_phieu":24,"dang_xuly":0,"da_xuly":24,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Nguyễn Việt Cường","tong_phieu":48,"dang_xuly":2,"da_xuly":46,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Đoàn Văn Út","tong_phieu":49,"dang_xuly":2,"da_xuly":47,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Huỳnh Minh Thiện","tong_phieu":46,"dang_xuly":10,"da_xuly":36,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Nguyễn Xuân Minh","tong_phieu":38,"dang_xuly":2,"da_xuly":36,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Võ Hoàng Phúc","tong_phieu":48,"dang_xuly":4,"da_xuly":44,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Đoàn Lê Nhân Ái","tong_phieu":58,"dang_xuly":21,"da_xuly":37,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Trần Văn Lượm","tong_phieu":43,"dang_xuly":0,"da_xuly":43,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Trần Nguyễn Trung Tín","tong_phieu":53,"dang_xuly":8,"da_xuly":45,"suyhao_conlai":0}]}', '2021-06-23 16:55:11'),
	(28, 41, '{"method":"GET","url":"https:\\/\\/api.vnpttravinh.vn\\/bao-cao-tuan\\/don-vi","headers":{"Content-Type":"application\\/json","Accept":"application\\/json","x-access-token":"ZXlKaGJHY2lPaUpJVXpJMU5pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SnBaQ0k2SWtobWRIRmFWeUlzSW1saGRDSTZNVFl5TXpZMk1qQXlOQ3dpWlhod0lqb3pNVGN4TmpneE1EUTBNalI5LmJacnBTVmtKQzJJRlN5X056V1BwUm1XQWZLdEFXdDhFbzlMUElFeHNLV00"}}', '{"message":"Lấy dữ liệu thành công","errors":0,"access_token":null,"token_type":null,"expires_at":"2021-06-23 16:55:12","data":{"donvi_id":10,"home_internet":65,"home_mobile":1,"home_tv":273,"home_combo":4}}', '2021-06-23 16:55:12'),
	(29, 41, '{"method":"GET","url":"https:\\/\\/api.vnpttravinh.vn\\/bao-cao-tuan\\/don-vi","headers":{"Content-Type":"application\\/json","Accept":"application\\/json","x-access-token":"ZXlKaGJHY2lPaUpJVXpJMU5pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SnBaQ0k2SWtobWRIRmFWeUlzSW1saGRDSTZNVFl5TXpZMk1qQXlOQ3dpWlhod0lqb3pNVGN4TmpneE1EUTBNalI5LmJacnBTVmtKQzJJRlN5X056V1BwUm1XQWZLdEFXdDhFbzlMUElFeHNLV00"}}', '{"message":"Lấy dữ liệu thành công","errors":0,"access_token":null,"token_type":null,"expires_at":"2021-06-23 16:55:12","data":{"donvi_id":10,"tongphieu_tc":1874,"dunghan_tc":1859,"tongphieu_bh":3724,"dunghan_bh":3572}}', '2021-06-23 16:55:12'),
	(30, 41, '{"method":"GET","url":"https:\\/\\/api.vnpttravinh.vn\\/bao-cao-tuan\\/don-vi","headers":{"Content-Type":"application\\/json","Accept":"application\\/json","x-access-token":"ZXlKaGJHY2lPaUpJVXpJMU5pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SnBaQ0k2SWtobWRIRmFWeUlzSW1saGRDSTZNVFl5TXpZMk1qQXlOQ3dpWlhod0lqb3pNVGN4TmpneE1EUTBNalI5LmJacnBTVmtKQzJJRlN5X056V1BwUm1XQWZLdEFXdDhFbzlMUElFeHNLV00"}}', '{"message":"Lấy dữ liệu thành công","errors":0,"access_token":null,"token_type":null,"expires_at":"2021-06-23 16:55:25","data":{"donvi_id":10,"so_tram_mll":22}}', '2021-06-23 16:55:25'),
	(31, 41, '{"method":"GET","url":"https:\\/\\/api.vnpttravinh.vn\\/bao-cao-tuan\\/don-vi","headers":{"Content-Type":"application\\/json","Accept":"application\\/json","x-access-token":"ZXlKaGJHY2lPaUpJVXpJMU5pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SnBaQ0k2SWtobWRIRmFWeUlzSW1saGRDSTZNVFl5TXpZMk1qQXlOQ3dpWlhod0lqb3pNVGN4TmpneE1EUTBNalI5LmJacnBTVmtKQzJJRlN5X056V1BwUm1XQWZLdEFXdDhFbzlMUElFeHNLV00"}}', '{"message":"Lấy dữ liệu thành công","errors":0,"access_token":null,"token_type":null,"expires_at":"2021-06-23 16:56:36","data":{"donvi_id":10,"lapmoi_fiber":463,"mega_sang_fiber":62,"lapmoi_mytv":1093,"lapmoi_ddtrasau":21,"lapmoi_ddtratruoc":393,"lapmoi_mnp":17}}', '2021-06-23 16:56:36'),
	(32, 41, '{"method":"GET","url":"https:\\/\\/api.vnpttravinh.vn\\/bao-cao-tuan\\/don-vi","headers":{"Content-Type":"application\\/json","Accept":"application\\/json","x-access-token":"ZXlKaGJHY2lPaUpJVXpJMU5pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SnBaQ0k2SWtobWRIRmFWeUlzSW1saGRDSTZNVFl5TXpZMk1qQXlOQ3dpWlhod0lqb3pNVGN4TmpneE1EUTBNalI5LmJacnBTVmtKQzJJRlN5X056V1BwUm1XQWZLdEFXdDhFbzlMUElFeHNLV00"}}', '{"message":"Lấy dữ liệu thành công","errors":0,"access_token":null,"token_type":null,"expires_at":"2021-06-23 16:56:41","data":[{"donvi_id":10,"ten_nv":"Nguyễn Duy Sơn","tong_phieu":15,"dang_xuly":0,"da_xuly":15,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Lê Quốc","tong_phieu":27,"dang_xuly":0,"da_xuly":27,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Bí Minh Lý","tong_phieu":37,"dang_xuly":0,"da_xuly":37,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Nguyễn Văn Tình","tong_phieu":13,"dang_xuly":0,"da_xuly":13,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Trần Nhật Tài","tong_phieu":36,"dang_xuly":7,"da_xuly":29,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Đào Bá Linh","tong_phieu":51,"dang_xuly":6,"da_xuly":45,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Dương Nguyên Anh Tú","tong_phieu":24,"dang_xuly":0,"da_xuly":24,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Nguyễn Việt Cường","tong_phieu":48,"dang_xuly":2,"da_xuly":46,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Đoàn Văn Út","tong_phieu":49,"dang_xuly":2,"da_xuly":47,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Huỳnh Minh Thiện","tong_phieu":46,"dang_xuly":10,"da_xuly":36,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Nguyễn Xuân Minh","tong_phieu":38,"dang_xuly":2,"da_xuly":36,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Võ Hoàng Phúc","tong_phieu":48,"dang_xuly":4,"da_xuly":44,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Đoàn Lê Nhân Ái","tong_phieu":58,"dang_xuly":21,"da_xuly":37,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Trần Văn Lượm","tong_phieu":43,"dang_xuly":0,"da_xuly":43,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Trần Nguyễn Trung Tín","tong_phieu":53,"dang_xuly":8,"da_xuly":45,"suyhao_conlai":0}]}', '2021-06-23 16:56:41'),
	(33, 41, '{"method":"GET","url":"https:\\/\\/api.vnpttravinh.vn\\/bao-cao-tuan\\/don-vi","headers":{"Content-Type":"application\\/json","Accept":"application\\/json","x-access-token":"ZXlKaGJHY2lPaUpJVXpJMU5pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SnBaQ0k2SWtobWRIRmFWeUlzSW1saGRDSTZNVFl5TXpZMk1qQXlOQ3dpWlhod0lqb3pNVGN4TmpneE1EUTBNalI5LmJacnBTVmtKQzJJRlN5X056V1BwUm1XQWZLdEFXdDhFbzlMUElFeHNLV00"}}', '{"message":"Lấy dữ liệu thành công","errors":0,"access_token":null,"token_type":null,"expires_at":"2021-06-23 16:56:41","data":{"donvi_id":10,"home_internet":65,"home_mobile":1,"home_tv":273,"home_combo":4}}', '2021-06-23 16:56:41'),
	(34, 41, '{"method":"GET","url":"https:\\/\\/api.vnpttravinh.vn\\/bao-cao-tuan\\/don-vi","headers":{"Content-Type":"application\\/json","Accept":"application\\/json","x-access-token":"ZXlKaGJHY2lPaUpJVXpJMU5pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SnBaQ0k2SWtobWRIRmFWeUlzSW1saGRDSTZNVFl5TXpZMk1qQXlOQ3dpWlhod0lqb3pNVGN4TmpneE1EUTBNalI5LmJacnBTVmtKQzJJRlN5X056V1BwUm1XQWZLdEFXdDhFbzlMUElFeHNLV00"}}', '{"message":"Lấy dữ liệu thành công","errors":0,"access_token":null,"token_type":null,"expires_at":"2021-06-23 16:56:41","data":{"donvi_id":10,"tongphieu_tc":1874,"dunghan_tc":1859,"tongphieu_bh":3724,"dunghan_bh":3572}}', '2021-06-23 16:56:41'),
	(35, 41, '{"method":"GET","url":"https:\\/\\/api.vnpttravinh.vn\\/bao-cao-tuan\\/don-vi","headers":{"Content-Type":"application\\/json","Accept":"application\\/json","x-access-token":"ZXlKaGJHY2lPaUpJVXpJMU5pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SnBaQ0k2SWtobWRIRmFWeUlzSW1saGRDSTZNVFl5TXpZMk1qQXlOQ3dpWlhod0lqb3pNVGN4TmpneE1EUTBNalI5LmJacnBTVmtKQzJJRlN5X056V1BwUm1XQWZLdEFXdDhFbzlMUElFeHNLV00"}}', '{"message":"Lấy dữ liệu thành công","errors":0,"access_token":null,"token_type":null,"expires_at":"2021-06-23 16:56:47","data":{"donvi_id":10,"so_tram_mll":22}}', '2021-06-23 16:56:47'),
	(36, 41, '{"method":"GET","url":"https:\\/\\/api.vnpttravinh.vn\\/bao-cao-tuan\\/don-vi","headers":{"Content-Type":"application\\/json","Accept":"application\\/json","x-access-token":"ZXlKaGJHY2lPaUpJVXpJMU5pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SnBaQ0k2SWtobWRIRmFWeUlzSW1saGRDSTZNVFl5TXpZMk1qQXlOQ3dpWlhod0lqb3pNVGN4TmpneE1EUTBNalI5LmJacnBTVmtKQzJJRlN5X056V1BwUm1XQWZLdEFXdDhFbzlMUElFeHNLV00"}}', '{"message":"Lấy dữ liệu thành công","errors":0,"access_token":null,"token_type":null,"expires_at":"2021-06-23 20:22:07","data":{"donvi_id":10,"lapmoi_fiber":463,"mega_sang_fiber":62,"lapmoi_mytv":1093,"lapmoi_ddtrasau":21,"lapmoi_ddtratruoc":393,"lapmoi_mnp":17}}', '2021-06-23 20:22:07'),
	(37, 41, '{"method":"GET","url":"https:\\/\\/api.vnpttravinh.vn\\/bao-cao-tuan\\/don-vi","headers":{"Content-Type":"application\\/json","Accept":"application\\/json","x-access-token":"ZXlKaGJHY2lPaUpJVXpJMU5pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SnBaQ0k2SWtobWRIRmFWeUlzSW1saGRDSTZNVFl5TXpZMk1qQXlOQ3dpWlhod0lqb3pNVGN4TmpneE1EUTBNalI5LmJacnBTVmtKQzJJRlN5X056V1BwUm1XQWZLdEFXdDhFbzlMUElFeHNLV00"}}', '{"message":"Lấy dữ liệu thành công","errors":0,"access_token":null,"token_type":null,"expires_at":"2021-06-23 20:22:10","data":[{"donvi_id":10,"ten_nv":"Nguyễn Duy Sơn","tong_phieu":15,"dang_xuly":0,"da_xuly":15,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Lê Quốc","tong_phieu":27,"dang_xuly":0,"da_xuly":27,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Bí Minh Lý","tong_phieu":37,"dang_xuly":0,"da_xuly":37,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Nguyễn Văn Tình","tong_phieu":13,"dang_xuly":0,"da_xuly":13,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Trần Nhật Tài","tong_phieu":36,"dang_xuly":7,"da_xuly":29,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Đào Bá Linh","tong_phieu":51,"dang_xuly":5,"da_xuly":46,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Dương Nguyên Anh Tú","tong_phieu":24,"dang_xuly":0,"da_xuly":24,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Nguyễn Việt Cường","tong_phieu":48,"dang_xuly":2,"da_xuly":46,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Đoàn Văn Út","tong_phieu":49,"dang_xuly":2,"da_xuly":47,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Huỳnh Minh Thiện","tong_phieu":46,"dang_xuly":10,"da_xuly":36,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Nguyễn Xuân Minh","tong_phieu":38,"dang_xuly":2,"da_xuly":36,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Võ Hoàng Phúc","tong_phieu":48,"dang_xuly":4,"da_xuly":44,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Đoàn Lê Nhân Ái","tong_phieu":58,"dang_xuly":21,"da_xuly":37,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Trần Văn Lượm","tong_phieu":43,"dang_xuly":0,"da_xuly":43,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Trần Nguyễn Trung Tín","tong_phieu":53,"dang_xuly":8,"da_xuly":45,"suyhao_conlai":0}]}', '2021-06-23 20:22:10'),
	(38, 41, '{"method":"GET","url":"https:\\/\\/api.vnpttravinh.vn\\/bao-cao-tuan\\/don-vi","headers":{"Content-Type":"application\\/json","Accept":"application\\/json","x-access-token":"ZXlKaGJHY2lPaUpJVXpJMU5pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SnBaQ0k2SWtobWRIRmFWeUlzSW1saGRDSTZNVFl5TXpZMk1qQXlOQ3dpWlhod0lqb3pNVGN4TmpneE1EUTBNalI5LmJacnBTVmtKQzJJRlN5X056V1BwUm1XQWZLdEFXdDhFbzlMUElFeHNLV00"}}', '{"message":"Lấy dữ liệu thành công","errors":0,"access_token":null,"token_type":null,"expires_at":"2021-06-23 20:22:10","data":{"donvi_id":10,"home_internet":65,"home_mobile":1,"home_tv":273,"home_combo":4}}', '2021-06-23 20:22:10'),
	(39, 41, '{"method":"GET","url":"https:\\/\\/api.vnpttravinh.vn\\/bao-cao-tuan\\/don-vi","headers":{"Content-Type":"application\\/json","Accept":"application\\/json","x-access-token":"ZXlKaGJHY2lPaUpJVXpJMU5pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SnBaQ0k2SWtobWRIRmFWeUlzSW1saGRDSTZNVFl5TXpZMk1qQXlOQ3dpWlhod0lqb3pNVGN4TmpneE1EUTBNalI5LmJacnBTVmtKQzJJRlN5X056V1BwUm1XQWZLdEFXdDhFbzlMUElFeHNLV00"}}', '{"message":"Lấy dữ liệu thành công","errors":0,"access_token":null,"token_type":null,"expires_at":"2021-06-23 20:22:11","data":{"donvi_id":10,"tongphieu_tc":1874,"dunghan_tc":1859,"tongphieu_bh":3724,"dunghan_bh":3572}}', '2021-06-23 20:22:11'),
	(40, 41, '{"method":"GET","url":"https:\\/\\/api.vnpttravinh.vn\\/bao-cao-tuan\\/don-vi","headers":{"Content-Type":"application\\/json","Accept":"application\\/json","x-access-token":"ZXlKaGJHY2lPaUpJVXpJMU5pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SnBaQ0k2SWtobWRIRmFWeUlzSW1saGRDSTZNVFl5TXpZMk1qQXlOQ3dpWlhod0lqb3pNVGN4TmpneE1EUTBNalI5LmJacnBTVmtKQzJJRlN5X056V1BwUm1XQWZLdEFXdDhFbzlMUElFeHNLV00"}}', '{"message":"Lấy dữ liệu thành công","errors":0,"access_token":null,"token_type":null,"expires_at":"2021-06-23 20:22:25","data":{"donvi_id":10,"so_tram_mll":22}}', '2021-06-23 20:22:25'),
	(41, 41, '{"method":"GET","url":"https:\\/\\/api.vnpttravinh.vn\\/bao-cao-tuan\\/don-vi","headers":{"Content-Type":"application\\/json","Accept":"application\\/json","x-access-token":"ZXlKaGJHY2lPaUpJVXpJMU5pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SnBaQ0k2SWtobWRIRmFWeUlzSW1saGRDSTZNVFl5TXpZMk1qQXlOQ3dpWlhod0lqb3pNVGN4TmpneE1EUTBNalI5LmJacnBTVmtKQzJJRlN5X056V1BwUm1XQWZLdEFXdDhFbzlMUElFeHNLV00"}}', '{"message":"Lấy dữ liệu thành công","errors":0,"access_token":null,"token_type":null,"expires_at":"2021-06-23 20:23:44","data":{"donvi_id":10,"lapmoi_fiber":463,"mega_sang_fiber":62,"lapmoi_mytv":1093,"lapmoi_ddtrasau":21,"lapmoi_ddtratruoc":393,"lapmoi_mnp":17}}', '2021-06-23 20:23:44'),
	(42, 41, '{"method":"GET","url":"https:\\/\\/api.vnpttravinh.vn\\/bao-cao-tuan\\/don-vi","headers":{"Content-Type":"application\\/json","Accept":"application\\/json","x-access-token":"ZXlKaGJHY2lPaUpJVXpJMU5pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SnBaQ0k2SWtobWRIRmFWeUlzSW1saGRDSTZNVFl5TXpZMk1qQXlOQ3dpWlhod0lqb3pNVGN4TmpneE1EUTBNalI5LmJacnBTVmtKQzJJRlN5X056V1BwUm1XQWZLdEFXdDhFbzlMUElFeHNLV00"}}', '{"message":"Lấy dữ liệu thành công","errors":0,"access_token":null,"token_type":null,"expires_at":"2021-06-23 20:23:47","data":[{"donvi_id":10,"ten_nv":"Nguyễn Duy Sơn","tong_phieu":15,"dang_xuly":0,"da_xuly":15,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Lê Quốc","tong_phieu":27,"dang_xuly":0,"da_xuly":27,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Bí Minh Lý","tong_phieu":37,"dang_xuly":0,"da_xuly":37,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Nguyễn Văn Tình","tong_phieu":13,"dang_xuly":0,"da_xuly":13,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Trần Nhật Tài","tong_phieu":36,"dang_xuly":7,"da_xuly":29,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Đào Bá Linh","tong_phieu":51,"dang_xuly":5,"da_xuly":46,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Dương Nguyên Anh Tú","tong_phieu":24,"dang_xuly":0,"da_xuly":24,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Nguyễn Việt Cường","tong_phieu":48,"dang_xuly":2,"da_xuly":46,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Đoàn Văn Út","tong_phieu":49,"dang_xuly":2,"da_xuly":47,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Huỳnh Minh Thiện","tong_phieu":46,"dang_xuly":10,"da_xuly":36,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Nguyễn Xuân Minh","tong_phieu":38,"dang_xuly":2,"da_xuly":36,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Võ Hoàng Phúc","tong_phieu":48,"dang_xuly":4,"da_xuly":44,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Đoàn Lê Nhân Ái","tong_phieu":58,"dang_xuly":21,"da_xuly":37,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Trần Văn Lượm","tong_phieu":43,"dang_xuly":0,"da_xuly":43,"suyhao_conlai":0},{"donvi_id":10,"ten_nv":"Trần Nguyễn Trung Tín","tong_phieu":53,"dang_xuly":8,"da_xuly":45,"suyhao_conlai":0}]}', '2021-06-23 20:23:47'),
	(43, 41, '{"method":"GET","url":"https:\\/\\/api.vnpttravinh.vn\\/bao-cao-tuan\\/don-vi","headers":{"Content-Type":"application\\/json","Accept":"application\\/json","x-access-token":"ZXlKaGJHY2lPaUpJVXpJMU5pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SnBaQ0k2SWtobWRIRmFWeUlzSW1saGRDSTZNVFl5TXpZMk1qQXlOQ3dpWlhod0lqb3pNVGN4TmpneE1EUTBNalI5LmJacnBTVmtKQzJJRlN5X056V1BwUm1XQWZLdEFXdDhFbzlMUElFeHNLV00"}}', '{"message":"Lấy dữ liệu thành công","errors":0,"access_token":null,"token_type":null,"expires_at":"2021-06-23 20:23:47","data":{"donvi_id":10,"home_internet":65,"home_mobile":1,"home_tv":273,"home_combo":4}}', '2021-06-23 20:23:47'),
	(44, 41, '{"method":"GET","url":"https:\\/\\/api.vnpttravinh.vn\\/bao-cao-tuan\\/don-vi","headers":{"Content-Type":"application\\/json","Accept":"application\\/json","x-access-token":"ZXlKaGJHY2lPaUpJVXpJMU5pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SnBaQ0k2SWtobWRIRmFWeUlzSW1saGRDSTZNVFl5TXpZMk1qQXlOQ3dpWlhod0lqb3pNVGN4TmpneE1EUTBNalI5LmJacnBTVmtKQzJJRlN5X056V1BwUm1XQWZLdEFXdDhFbzlMUElFeHNLV00"}}', '{"message":"Lấy dữ liệu thành công","errors":0,"access_token":null,"token_type":null,"expires_at":"2021-06-23 20:23:47","data":{"donvi_id":10,"tongphieu_tc":1874,"dunghan_tc":1859,"tongphieu_bh":3724,"dunghan_bh":3572}}', '2021-06-23 20:23:47'),
	(45, 41, '{"method":"GET","url":"https:\\/\\/api.vnpttravinh.vn\\/bao-cao-tuan\\/don-vi","headers":{"Content-Type":"application\\/json","Accept":"application\\/json","x-access-token":"ZXlKaGJHY2lPaUpJVXpJMU5pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SnBaQ0k2SWtobWRIRmFWeUlzSW1saGRDSTZNVFl5TXpZMk1qQXlOQ3dpWlhod0lqb3pNVGN4TmpneE1EUTBNalI5LmJacnBTVmtKQzJJRlN5X056V1BwUm1XQWZLdEFXdDhFbzlMUElFeHNLV00"}}', '{"message":"Lấy dữ liệu thành công","errors":0,"access_token":null,"token_type":null,"expires_at":"2021-06-23 20:23:52","data":{"donvi_id":10,"so_tram_mll":22}}', '2021-06-23 20:23:52');
/*!40000 ALTER TABLE `bc_log_dhsxkd` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.bc_map_don_vi_dhsxkd
CREATE TABLE IF NOT EXISTS `bc_map_don_vi_dhsxkd` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_don_vi` int unsigned DEFAULT NULL,
  `id_don_vi_dhsxkd` varchar(250) NOT NULL DEFAULT '0',
  `ten_don_vi_dhsxkd` varchar(250) DEFAULT NULL,
  `state` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_map_don_vi_dhsxkd_don_vi` (`id_don_vi`),
  CONSTRAINT `FK_map_don_vi_dhsxkd_don_vi` FOREIGN KEY (`id_don_vi`) REFERENCES `don_vi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.bc_map_don_vi_dhsxkd: ~10 rows (approximately)
/*!40000 ALTER TABLE `bc_map_don_vi_dhsxkd` DISABLE KEYS */;
INSERT INTO `bc_map_don_vi_dhsxkd` (`id`, `id_don_vi`, `id_don_vi_dhsxkd`, `ten_don_vi_dhsxkd`, `state`) VALUES
	(13, 2, '0', '-- Toàn tỉnh --', 1),
	(14, 17, '9', 'TTVT1 - Khu vực Châu Thành', 1),
	(15, 16, '10', 'TTVT1 - Khu vực Tp. Trà Vinh', 1),
	(16, NULL, '11', 'TTVT2 - Khu vực Càng Long', 1),
	(17, NULL, '12', 'TTVT2 - Khu vực Tiểu Cần', 1),
	(18, NULL, '13', 'TTVT2 - Khu vực Cầu Kè', 1),
	(19, NULL, '14', 'TTVT3 - Khu vực Cầu Ngang', 1),
	(20, NULL, '15', 'TTVT3 - Khu vực Trà Cú', 1),
	(21, NULL, '16', 'TTVT3 - Khu vực Duyên Hải', 1),
	(22, NULL, '26', 'TTVT3 - Khu vực TX Duyên Hải', 1);
/*!40000 ALTER TABLE `bc_map_don_vi_dhsxkd` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.bc_quyen_bao_cao
CREATE TABLE IF NOT EXISTS `bc_quyen_bao_cao` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `id_dm_quyen_bao_cao` int NOT NULL,
  `tu_ngay` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `den_ngay` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_bc_quyen_bao_cao_users` (`user_id`),
  KEY `FK_bc_quyen_bao_cao_bc_dm_quyen_bao_cao_tuan` (`id_dm_quyen_bao_cao`),
  CONSTRAINT `FK_bc_quyen_bao_cao_bc_dm_quyen_bao_cao_tuan` FOREIGN KEY (`id_dm_quyen_bao_cao`) REFERENCES `bc_dm_quyen_bao_cao_tuan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_bc_quyen_bao_cao_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=178 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.bc_quyen_bao_cao: ~75 rows (approximately)
/*!40000 ALTER TABLE `bc_quyen_bao_cao` DISABLE KEYS */;
INSERT INTO `bc_quyen_bao_cao` (`id`, `user_id`, `id_dm_quyen_bao_cao`, `tu_ngay`, `den_ngay`) VALUES
	(59, 38, 3, '2021-06-17 15:35:33', NULL),
	(60, 38, 4, '2021-06-17 15:35:34', NULL),
	(61, 38, 5, '2021-06-17 15:35:37', NULL),
	(62, 38, 6, '2021-06-17 15:35:38', NULL),
	(63, 38, 7, '2021-06-17 15:35:39', NULL),
	(64, 38, 8, '2021-06-17 15:35:39', NULL),
	(65, 38, 9, '2021-06-17 15:35:44', NULL),
	(68, 39, 3, '2021-06-17 15:36:04', NULL),
	(69, 39, 4, '2021-06-17 15:36:05', NULL),
	(70, 39, 5, '2021-06-17 15:36:06', NULL),
	(71, 39, 6, '2021-06-17 15:36:07', NULL),
	(72, 39, 8, '2021-06-17 15:36:10', NULL),
	(75, 37, 3, '2021-06-17 15:36:24', NULL),
	(76, 37, 4, '2021-06-17 15:36:25', NULL),
	(77, 37, 5, '2021-06-17 15:36:25', NULL),
	(78, 37, 6, '2021-06-17 15:36:26', NULL),
	(79, 37, 7, '2021-06-17 15:36:27', NULL),
	(80, 37, 8, '2021-06-17 15:36:27', NULL),
	(81, 37, 9, '2021-06-17 15:36:28', NULL),
	(84, 3, 3, '2021-06-17 15:36:36', NULL),
	(85, 3, 4, '2021-06-17 15:36:37', NULL),
	(86, 3, 5, '2021-06-17 15:36:37', NULL),
	(87, 3, 6, '2021-06-17 15:36:38', NULL),
	(88, 3, 7, '2021-06-17 15:36:39', NULL),
	(89, 3, 8, '2021-06-17 15:36:40', NULL),
	(90, 3, 9, '2021-06-17 15:36:40', NULL),
	(96, 49, 4, '2021-06-17 15:37:29', NULL),
	(99, 50, 4, '2021-06-17 15:37:40', NULL),
	(102, 51, 4, '2021-06-17 15:37:51', NULL),
	(107, 52, 4, '2021-06-17 15:38:14', NULL),
	(110, 53, 4, '2021-06-17 15:38:27', NULL),
	(115, 54, 4, '2021-06-17 15:38:57', NULL),
	(128, 50, 1, '2021-06-17 16:12:43', NULL),
	(129, 50, 2, '2021-06-17 16:12:46', NULL),
	(130, 49, 2, '2021-06-17 16:13:26', NULL),
	(131, 49, 1, '2021-06-17 16:13:42', NULL),
	(132, 51, 1, '2021-06-17 16:14:14', NULL),
	(133, 51, 2, '2021-06-17 16:14:20', NULL),
	(134, 3, 1, '2021-06-17 16:14:37', NULL),
	(135, 3, 2, '2021-06-17 16:14:43', NULL),
	(138, 54, 1, '2021-06-17 16:15:17', NULL),
	(141, 54, 2, '2021-06-17 16:15:59', NULL),
	(142, 53, 1, '2021-06-17 16:16:20', NULL),
	(143, 53, 2, '2021-06-17 16:16:23', NULL),
	(144, 52, 1, '2021-06-17 16:16:48', NULL),
	(145, 52, 2, '2021-06-17 16:17:08', NULL),
	(147, 3, 10, '2021-06-17 22:38:08', NULL),
	(148, 37, 10, '2021-06-17 22:38:19', NULL),
	(149, 38, 10, '2021-06-17 22:38:31', NULL),
	(150, 39, 10, '2021-06-17 22:39:00', NULL),
	(151, 2, 1, '2021-06-18 07:26:29', NULL),
	(152, 2, 2, '2021-06-18 07:26:30', NULL),
	(153, 2, 3, '2021-06-18 07:26:31', NULL),
	(154, 2, 4, '2021-06-18 07:26:32', NULL),
	(155, 2, 5, '2021-06-18 07:26:33', NULL),
	(156, 2, 6, '2021-06-18 07:26:33', NULL),
	(157, 2, 7, '2021-06-18 07:26:35', NULL),
	(158, 2, 8, '2021-06-18 07:26:35', NULL),
	(159, 2, 9, '2021-06-18 07:26:37', NULL),
	(160, 2, 10, '2021-06-18 07:26:38', NULL),
	(161, 37, 1, '2021-06-18 09:25:19', NULL),
	(162, 37, 2, '2021-06-18 09:26:19', NULL),
	(163, 39, 1, '2021-06-18 09:27:05', NULL),
	(164, 39, 2, '2021-06-18 09:27:09', NULL),
	(165, 38, 1, '2021-06-18 09:27:30', NULL),
	(166, 38, 2, '2021-06-18 09:27:33', NULL),
	(169, 57, 1, '2021-06-18 10:59:37', NULL),
	(170, 57, 2, '2021-06-18 10:59:41', NULL),
	(171, 58, 5, '2021-06-18 11:03:27', NULL),
	(172, 58, 6, '2021-06-18 11:03:32', NULL),
	(173, 58, 8, '2021-06-18 11:03:34', NULL),
	(174, 58, 10, '2021-06-18 11:03:37', NULL),
	(175, 58, 4, '2021-06-18 11:05:42', NULL),
	(176, 58, 1, '2021-06-18 11:06:00', NULL),
	(177, 58, 2, '2021-06-18 11:06:01', NULL);
/*!40000 ALTER TABLE `bc_quyen_bao_cao` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.bc_tuan_hien_tai
CREATE TABLE IF NOT EXISTS `bc_tuan_hien_tai` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ma_don_vi` varchar(50) DEFAULT NULL,
  `ma_dinh_danh` varchar(50) DEFAULT NULL,
  `id_tuan` int DEFAULT NULL,
  `id_user_bao_cao` int unsigned NOT NULL,
  `noi_dung` longtext,
  `ghi_chu` varchar(250) DEFAULT NULL,
  `thoi_gian_bao_cao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_group` int NOT NULL COMMENT '0 là không phải group; 1 là group',
  `id_dich_vu` int DEFAULT NULL,
  `trang_thai` int NOT NULL COMMENT '0 chưa chốt; 1 đã chốt',
  `sap_xep` int NOT NULL COMMENT 'Sắp xếp theo tuần',
  PRIMARY KEY (`id`),
  KEY `FK_bc_tuan_hien_tai_bc_dm_tuan` (`id_tuan`),
  KEY `FK_bc_tuan_hien_tai_users` (`id_user_bao_cao`),
  CONSTRAINT `FK_bc_tuan_hien_tai_bc_dm_tuan` FOREIGN KEY (`id_tuan`) REFERENCES `bc_dm_tuan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_bc_tuan_hien_tai_users` FOREIGN KEY (`id_user_bao_cao`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=865 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.bc_tuan_hien_tai: ~103 rows (approximately)
/*!40000 ALTER TABLE `bc_tuan_hien_tai` DISABLE KEYS */;
INSERT INTO `bc_tuan_hien_tai` (`id`, `ma_don_vi`, `ma_dinh_danh`, `id_tuan`, `id_user_bao_cao`, `noi_dung`, `ghi_chu`, `thoi_gian_bao_cao`, `is_group`, `id_dich_vu`, `trang_thai`, `sap_xep`) VALUES
	(605, 'TTCNTT', '000.07.01.H59', 576, 51, 'VNPT iOffice/eOffice', NULL, '2021-06-18 07:55:19', 3, 10, 0, 510),
	(608, 'TTCNTT', '000.07.01.H59', 576, 51, 'Tình trạng hoạt động của các hệ thống:', NULL, '2021-06-18 07:57:02', 2, 10, 0, 510),
	(609, 'TTCNTT', '000.07.01.H59', 576, 51, 'iOffice v4 tỉnh ủy: 8h130 - 8h25(12/06/2021), 13h19 - 13h24(16/06/2021): lặp lại lỗi 502 làm gián đoạn dịch vụ, tiếp tục phối hợp với IT5 và eGov kiểm tra lại hệ thống.', NULL, '2021-06-18 07:57:22', 1, 10, 0, 510),
	(611, 'TTCNTT', '000.07.01.H59', 576, 51, 'iOffice v4 cụm Tân Thuận: hoạt động ổn định.', NULL, '2021-06-18 07:57:49', 1, 10, 0, 510),
	(612, 'TTCNTT', '000.07.01.H59', 576, 51, 'eOffice Bưu điện: Ký số hoạt động không ổn định, thường xuất hiện lỗi ERROR_HASH_SIGNER, egov đã tiếp nhận phản ánh và đang tìm nguyên nhân khắc phục.', NULL, '2021-06-18 07:58:08', 1, 10, 0, 510),
	(614, 'TTCNTT', '000.07.01.H59', 576, 51, 'Tình hình hỗ trợ các đơn vị: Tổng lượt hỗ trợ các đơn vị 51, trong đó:', NULL, '2021-06-18 07:58:36', 2, 10, 0, 510),
	(615, 'TTCNTT', '000.07.01.H59', 576, 51, 'UBND các cấp và các phòng/trung tâm trực thuộc: 9 lượt.', NULL, '2021-06-18 07:58:52', 1, 10, 0, 510),
	(616, 'TTCNTT', '000.07.01.H59', 576, 51, 'Sở/Ban/Ngành và các phòng/trung tâm trực thuộc: 32 lượt.', NULL, '2021-06-18 07:59:06', 1, 10, 0, 510),
	(617, 'TTCNTT', '000.07.01.H59', 576, 51, 'Ngành Giáo dục: 1 lượt.', NULL, '2021-06-18 07:59:21', 1, 10, 0, 510),
	(618, 'TTCNTT', '000.07.01.H59', 576, 51, 'Nội bộ VNPT: 7 lượt.', NULL, '2021-06-18 07:59:34', 1, 10, 0, 510),
	(619, 'TTCNTT', '000.07.01.H59', 576, 51, 'Đơn vị khác: 2 lượt.', NULL, '2021-06-18 07:59:47', 1, 10, 0, 510),
	(620, 'TTCNTT', '000.07.01.H59', 576, 51, 'Outsource/Fix lỗi', NULL, '2021-06-18 08:00:07', 2, 10, 0, 510),
	(621, 'TTCNTT', '000.07.01.H59', 576, 51, 'Kiểm tra và fix lỗi treo không load được danh sách văn bản sau khi phát hành văn bản đi ở đơn vị UBND TP Trà Vinh.', NULL, '2021-06-18 08:00:25', 1, 10, 0, 510),
	(622, 'TTCNTT', '000.07.01.H59', 576, 51, 'Xây dựng chức năng chọn đơn vị nhận và hạn xử lý khi chuyên viên dự thảo văn bản phúc đáp: Thực hiện BA.', NULL, '2021-06-18 08:00:40', 2, 10, 0, 510),
	(645, 'TTCNTT', '000.07.01.H59', 576, 53, 'vnPortal', NULL, '2021-06-18 09:18:01', 3, 13, 0, 53645),
	(647, 'TTCNTT', '000.07.01.H59', 576, 50, 'BV, TTYT, PKĐK:', NULL, '2021-06-18 09:19:15', 2, 9, 0, 50647),
	(648, 'TTCNTT', '000.07.01.H59', 576, 50, 'BV trường ĐHTV: Phân quyền dược; Tiếp nhận yêu cầu khi gõ thuốc khám bệnh nội trú cột dạng thuốc lấy đơn vị tính; Kiểm tra báo cáo mẫu 21 tháng 04/2021; Cấu hình tài khoản mở khoá chức năng chỉnh sửa thông tin bệnh nhân; Hướng dẫn cập nhật tỉ lệ thanh toán TTPT; Tiếp nhận yêu cầu chỉnh sửa phiếu hoàn trả khoa phòng; Tiếp nhận yêu cầu chỉnh sửa giao diện cảnh báo tương tác hoạt chất;', NULL, '2021-06-18 09:19:29', 1, 9, 0, 50648),
	(649, 'TTCNTT', '000.07.01.H59', 576, 50, 'TTYT huyện DHI: Thêm mới kho dược và phân quyền nhân viên; Kiểm tra số lượng hồ sơ xuất XML 4210 và cổng không khớp;', NULL, '2021-06-18 09:19:41', 1, 9, 0, 50649),
	(650, 'TTCNTT', '000.07.01.H59', 576, 50, 'BV QDY: Thêm mới kho dược và phân quyền dược nhân viên quản lý;', NULL, '2021-06-18 09:19:52', 1, 9, 0, 50650),
	(651, 'TTCNTT', '000.07.01.H59', 576, 50, 'TTYT huyện Càng Long: Kiểm tra cấp giường bệnh nhân không được;', NULL, '2021-06-18 09:20:00', 1, 9, 0, 50651),
	(652, 'TTCNTT', '000.07.01.H59', 576, 50, 'TTYT TX DHI: Thêm nơi đăng ký KCB ban đầu;', NULL, '2021-06-18 09:20:08', 1, 9, 0, 50652),
	(653, 'TTCNTT', '000.07.01.H59', 576, 50, 'PKĐK An Phúc: Hướng dẫn cập nhật cận lâm sàng Nội sôi thuộc nhóm 8;', NULL, '2021-06-18 09:20:18', 1, 9, 0, 50653),
	(654, 'TTCNTT', '000.07.01.H59', 576, 50, 'PKĐK Sài Gòn Thành Vinh: Hướng dẫn xem báo cáo KBH; Kiểm tra lỗi không thanh toán viện phí cho bệnh nhân; Thêm mới thuốc dịch vụ;', NULL, '2021-06-18 09:20:28', 1, 9, 0, 50654),
	(655, 'TTCNTT', '000.07.01.H59', 576, 50, 'TTYT huyện Châu Thành: Kiểm tra kết nối Lis Microservice;', NULL, '2021-06-18 09:20:41', 1, 9, 0, 50655),
	(656, 'TTCNTT', '000.07.01.H59', 576, 50, 'BV Quân Dân Y: Map chỉ số xét nghiệm, cấu hình giá trị bình thường chỉ số xét nghiệm;', NULL, '2021-06-18 09:20:48', 1, 9, 0, 50656),
	(657, 'TTCNTT', '000.07.01.H59', 576, 50, 'Các TYT:', NULL, '2021-06-18 09:21:14', 2, 9, 0, 50657),
	(658, 'TTCNTT', '000.07.01.H59', 576, 50, 'TYT Thuận Hoà: Thêm thuốc vào DMDC;', NULL, '2021-06-18 09:22:13', 1, 9, 0, 50658),
	(659, 'TTCNTT', '000.07.01.H59', 576, 50, 'TYT Long Hữu: Khoá tài khoản người dùng không sử dụng;', NULL, '2021-06-18 09:22:19', 1, 9, 0, 50659),
	(660, 'TTCNTT', '000.07.01.H59', 576, 50, 'TYT Phước Hưng: Cài đặt công cụ kiểm tra thẻ BHYT;', NULL, '2021-06-18 09:22:25', 1, 9, 0, 50660),
	(661, 'TTCNTT', '000.07.01.H59', 576, 50, 'TYT Hùng Hoà: Kiểm tra lỗi cảnh báo khi thêm nhân khẩu;', NULL, '2021-06-18 09:22:32', 1, 9, 0, 50661),
	(662, 'TTCNTT', '000.07.01.H59', 576, 50, 'Các công tác khác:', NULL, '2021-06-18 09:23:00', 2, 9, 0, 50662),
	(663, 'TTCNTT', '000.07.01.H59', 576, 50, 'Tạo mới, bổ sung thông tin, viết urd, chuyển trạng thái các y/c: IT360-197515; IT360-197515; IT360-197560; IT360-196263; IT360-197345; IT360-195365;...', NULL, '2021-06-18 09:23:08', 1, 9, 0, 50663),
	(664, 'TTCNTT', '000.07.01.H59', 576, 50, 'Kiểm tra lại dịch vụ VNPT - HIS sau khi VNPT - IT cập nhật (tối ngày 15/06);', NULL, '2021-06-18 09:23:14', 1, 9, 0, 50664),
	(665, 'TTCNTT', '000.07.01.H59', 576, 50, 'Trao đổi với TTKD và BV trường ĐHTV về phương án đầu tư hạ tầng máy chủ PACS;', NULL, '2021-06-18 09:23:21', 1, 9, 0, 50665),
	(666, 'TTCNTT', '000.07.01.H59', 576, 50, 'Theo dõi tài nguyên máy chủ PACS và gửi công văn thông báo đến đơn vị sử dụng;', NULL, '2021-06-18 09:23:28', 1, 9, 0, 50666),
	(678, 'TTCNTT', '000.07.01.H59', 576, 52, 'Triển khai phần mềm Hóa đơn điện tử', NULL, '2021-06-18 09:42:15', 3, 14, 0, 52678),
	(680, 'TTCNTT', '000.07.01.H59', 576, 53, 'Hỗ trợ đơn vị sử dụng: Sở TT&TT, Sở GD&ĐT, UB Mặt  Trận Tổ Quốc tỉnh Trà vinh', NULL, '2021-06-18 09:50:28', 2, 13, 0, 53680),
	(681, 'TTCNTT', '000.07.01.H59', 576, 53, 'Phối hợp Sở TT&TT fix lổi không bakup database', NULL, '2021-06-18 09:50:44', 2, 13, 0, 53681),
	(682, 'TTCNTT', '000.07.01.H59', 576, 53, 'Cung cấp lại thông tin tài khoản quản trị cho trường tiểu học Phương Thạnh A - Càng Long.', NULL, '2021-06-18 09:50:52', 2, 13, 0, 53682),
	(686, 'TTCNTT', '000.07.01.H59', 576, 50, ' Phần mềm VNPT-HIS', NULL, '2021-06-18 09:19:15', 3, 9, 0, 50646),
	(687, 'TTCNTT', '000.07.01.H59', 576, 37, 'CSDLQG-DC', NULL, '2021-06-18 10:42:30', 3, 16, 0, 37687),
	(689, 'TTCNTT', '000.07.01.H59', 576, 3, 'VNPT-iGate', NULL, '2021-06-18 10:44:40', 3, 11, 0, 3689),
	(697, 'TTCNTT', '000.07.01.H59', 576, 37, 'Tiếp nhận thông tin các sự cố truy cập hệ thống phần mềm từ các đơn vị, phối hợp kiểm tra hệ thống và gửi y/c xử lý về BDA;', NULL, '2021-06-18 10:53:52', 2, 16, 0, 37697),
	(701, 'TTCNTT', '000.07.01.H59', 576, 49, 'Phần mềm ĐHSXKD tập trung', NULL, '2021-06-18 11:02:05', 3, 2, 0, 49701),
	(705, 'TTCNTT', '000.07.01.H59', 576, 57, 'LGSP', NULL, '2021-06-18 11:04:29', 3, 15, 0, 57705),
	(706, 'TTCNTT', '000.07.01.H59', 576, 57, 'Tích hợp API dịch vụ công cung cấp cho VBDLis vào LGSP;', NULL, '2021-06-18 11:04:36', 2, 15, 0, 57706),
	(707, 'TTCNTT', '000.07.01.H59', 576, 49, 'Mobile App VNPT-TVH-CO:', NULL, '2021-06-18 11:05:12', 2, 2, 0, 49707),
	(708, 'TTCNTT', '000.07.01.H59', 576, 49, 'Phiên bản Android: Hoàn thành chức năng nhận thông báo; bổ sung kênh bản tin cấp 2; bổ sung chi tiết lương khuyến khích; bổ sung chức năng công khai phản ánh kiến nghị gửi thông báo đến tất cả người dùng;', NULL, '2021-06-18 11:05:37', 1, 2, 0, 49708),
	(709, 'TTCNTT', '000.07.01.H59', 576, 49, 'Phiên bản IOS: Xây dựng chức năng nhận thông báo đã xong nhưng còn lỗi khi đóng ứng dụng không nhận nữa (đang tìm giải pháp khắc phục);', NULL, '2021-06-18 11:06:07', 1, 2, 0, 49709),
	(710, 'TTCNTT', '000.07.01.H59', 576, 49, 'Chương trình Dashboard:', NULL, '2021-06-18 11:06:23', 2, 2, 0, 49710),
	(711, 'TTCNTT', '000.07.01.H59', 576, 49, 'Sửa báo cáo Tiền điện – dầu tiêu thụ: Thêm đường line thể hiện giá trị cùng kỳ của năm n-1;', NULL, '2021-06-18 11:06:38', 1, 2, 0, 49711),
	(712, 'TTCNTT', '000.07.01.H59', 576, 49, 'Cập nhật danh sách trạm chạy theo đơn vị được chọn khi xem báo cáo theo đơn vị;', NULL, '2021-06-18 11:06:54', 1, 2, 0, 49712),
	(713, 'TTCNTT', '000.07.01.H59', 576, 49, 'Thay đổi mức suy hao top địa bàn có số thuê bao lớn hơn 10;', NULL, '2021-06-18 11:07:07', 1, 2, 0, 49713),
	(715, 'TTCNTT', '000.07.01.H59', 576, 49, 'Chương trình lương:', NULL, '2021-06-18 11:07:39', 2, 2, 0, 49715),
	(716, 'TTCNTT', '000.07.01.H59', 576, 49, 'Sửa công thức tính tiền phạt hủy Fiber;', NULL, '2021-06-18 11:07:57', 1, 2, 0, 49716),
	(717, 'TTCNTT', '000.07.01.H59', 576, 49, 'Kiểm tra giảm trừ sản lượng, doanh thu tính lương đơn giá cho TVH;', NULL, '2021-06-18 11:08:10', 1, 2, 0, 49717),
	(718, 'TTCNTT', '000.07.01.H59', 576, 49, 'Hỗ trợ kiểm tra và đối soát lương khuyến khích cho các đơn vị;', NULL, '2021-06-18 11:08:26', 1, 2, 0, 49718),
	(719, 'TTCNTT', '000.07.01.H59', 576, 49, 'Quản lý tài sản:', NULL, '2021-06-18 11:08:46', 2, 2, 0, 49719),
	(720, 'TTCNTT', '000.07.01.H59', 576, 49, 'Hỗ trợ đối chiếu và cập nhật thông tin các trạm trong quản lý tiền điện và danh sách CSHT hiện có;', NULL, '2021-06-18 11:08:58', 1, 2, 0, 49720),
	(721, 'TTCNTT', '000.07.01.H59', 576, 49, 'Bổ sung chức năng nhập lịch sử tác động vào CSHT;', NULL, '2021-06-18 11:09:07', 1, 2, 0, 49721),
	(722, 'TTCNTT', '000.07.01.H59', 576, 49, 'Chương trình BSC: Thực hiện chuyển các xử lý logic dữ liệu vào trong store của Database để thuận tiện điều chỉnh khi có thay đổi;', NULL, '2021-06-18 11:09:28', 2, 2, 0, 49722),
	(723, 'TTCNTT', '000.07.01.H59', 576, 49, 'Chương trình Phản ánh kiến nghị: Bổ sung tính năng thông báo cho người dùng khi có phản ánh kiến nghị mới được công khai;', NULL, '2021-06-18 11:09:40', 2, 2, 0, 49723),
	(724, 'TTCNTT', '000.07.01.H59', 576, 49, 'Xây dựng bộ API kết xuất dữ liệu từ hệ thống ĐHSXKD hỗ trợ chương trình báo cáo tuần;', NULL, '2021-06-18 11:09:50', 2, 2, 0, 49724),
	(725, 'TTCNTT', '000.07.01.H59', 576, 49, 'Hỗ trợ kết xuất dữ liệu hiện trạng cáp đồng (mytv riêng lẻ, mega riêng lẻ, mytv cùng đường truyền mega) số lượng, doanh thu, tuổi cho phòng KTĐT;', NULL, '2021-06-18 11:10:05', 2, 2, 0, 49725),
	(726, 'TTCNTT', '000.07.01.H59', 576, 49, 'Hỗ trợ kết xuất dữ liệu tình hình thu hồi TBĐC cho phòng KHKT;', NULL, '2021-06-18 11:10:18', 2, 2, 0, 49726),
	(727, 'TTCNTT', '000.07.01.H59', 576, 49, 'Xây dựng phương án cập nhật tọa độ thuê bao kết xuất từ phiếu B2A cho tập khách hàng chưa có thông tin tọa độ trên hệ thống ĐHSXKD.', NULL, '2021-06-18 11:10:30', 2, 2, 0, 49727),
	(729, 'TTCNTT', '000.07.01.H59', 576, 3, 'Cập nhật thông tin bộ thủ tục hành chính theo yêu cầu của Sở Giao thông Vận Tải', NULL, '2021-06-18 13:24:00', 2, 11, 0, 3729),
	(730, 'TTCNTT', '000.07.01.H59', 576, 3, 'Hỗ trợ xử lý lỗi trong thanh toán nghĩa vụ tài chính lĩnh vực đất đai của Sở Tài nguyên và Môi trường', NULL, '2021-06-18 13:24:13', 2, 11, 0, 3730),
	(732, 'TTCNTT', '000.07.01.H59', 576, 3, 'Outsource:', NULL, '2021-06-18 13:26:52', 2, 11, 0, 3732),
	(733, 'TTCNTT', '000.07.01.H59', 576, 3, 'Thêm api cho phép cập nhật ngày hẹn trả theo mã biên nhận đối với liên thông phần mềm đất đai VILIS của Sở Tài nguyên và Môi trường', NULL, '2021-06-18 13:27:12', 1, 11, 0, 3733),
	(734, 'TTCNTT', '000.07.01.H59', 576, 3, 'Thêm api cho phép cập nhật hạn xử lý theo mã biên nhận đối với liên thông phần mềm đất đai VILIS của Sở Tài nguyên và Môi trường', NULL, '2021-06-18 13:27:23', 1, 11, 0, 3734),
	(735, 'TTCNTT', '000.07.01.H59', 576, 3, 'Hỗ trợ điều chỉnh hệ thống đồng bộ hồ sơ đất đai sửa lỗi hồ sơ trường hợp chuyển bước kế tiếp', NULL, '2021-06-18 13:27:32', 1, 11, 0, 3735),
	(736, 'TTCNTT', '000.07.01.H59', 576, 3, 'Công tác khác', NULL, '2021-06-18 13:27:54', 2, 11, 0, 3736),
	(737, 'TTCNTT', '000.07.01.H59', 576, 3, 'Hỗ trợ xử lý lỗi đồng bộ hồ sơ đất đai của Sở Tài nguyên và Môi trường', NULL, '2021-06-18 13:28:13', 1, 11, 0, 3737),
	(738, 'TTCNTT', '000.07.01.H59', 576, 3, 'Cập nhật hình thức thanh toán cho các thủ tục mức độ 3, mức độ 4.', NULL, '2021-06-18 13:28:22', 1, 11, 0, 3738),
	(739, 'TTCNTT', '000.07.01.H59', 576, 3, 'Xuất báo cáo và xử lý số liệu báo cáo tháng theo yêu cầu của Sở Thông tin và Truyền thông', NULL, '2021-06-18 13:28:31', 1, 11, 0, 3739),
	(740, 'TTCNTT', '000.07.01.H59', 576, 54, 'vnEdu', NULL, '2021-06-18 14:19:00', 3, 12, 0, 54740),
	(741, 'TTCNTT', '000.07.01.H59', 576, 54, 'Hỗ trợ các trường, giáo viên sử dụng phần mềm.', NULL, '2021-06-18 14:19:10', 2, 12, 0, 54741),
	(742, 'TTCNTT', '000.07.01.H59', 576, 54, 'Làm việc với trung tâm eEdu cập nhật lại form sổ học bạ, sổ điểm tổng hợp.', NULL, '2021-06-18 14:19:23', 2, 12, 0, 54742),
	(743, 'TTCNTT', '000.07.01.H59', 576, 54, 'Khai báo năm học 2021-2022 cho tỉnh trên hệ thống', NULL, '2021-06-18 14:19:34', 2, 12, 0, 54743),
	(744, 'TTCNTT', '000.07.01.H59', 576, 52, 'Hệ thống chính thức:\r', NULL, '2021-06-18 15:38:44', 2, 14, 0, 52744),
	(745, 'TTCNTT', '000.07.01.H59', 576, 52, 'Thực hiện bổ sung thêm danh mục hình thức thanh toán  cho CÔNG TY TRÁCH NHIỆM HỮU HẠN DỊCH VỤ VÀ THƯƠNG MẠI KHẢI HỒNG THUẬN;\r', NULL, '2021-06-18 15:38:44', 1, 14, 0, 52745),
	(746, 'TTCNTT', '000.07.01.H59', 576, 52, 'Thực hiện chuyển đổi mẫu hoá đơn GTGT sang mẫu hoá đơn bán hàng cho DOANH NGHIỆP TN THƯƠNG MẠI VÀNG KIM HỒNG;\r', NULL, '2021-06-18 15:38:44', 1, 14, 0, 52746),
	(747, 'TTCNTT', '000.07.01.H59', 576, 52, 'Thực hiện mở số lượng số lẻ ở cột đơn giá cho CÔNG TY TNHH MỘT THÀNH VIÊN NGỌC HIẾU;\r', NULL, '2021-06-18 15:38:44', 1, 14, 0, 52747),
	(748, 'TTCNTT', '000.07.01.H59', 576, 52, 'Thực hiện thay đổi mẫu hoá đơn cho CÔNG TY TNHH NTN NGỌC THƯƠNG;\r', NULL, '2021-06-18 15:38:44', 1, 14, 0, 52748),
	(749, 'TTCNTT', '000.07.01.H59', 576, 52, 'Thực hiện cấu hình cho phép chọn ngày hoá đơn và điều chỉnh mẫu hoá đơn cho phép hiển thị ngày ký theo ngày hoá đơn cho các KH:\r', NULL, '2021-06-18 15:38:44', 1, 14, 0, 52749),
	(750, 'TTCNTT', '000.07.01.H59', 576, 52, 'DOANH NGHIỆP TN THƯƠNG MẠI VÀNG KIM HỒNG;\r', NULL, '2021-06-18 15:38:44', 1, 14, 0, 52750),
	(751, 'TTCNTT', '000.07.01.H59', 576, 52, 'CÔNG TY TNHH CÀ PHÊ NGUYÊN TV;\r', NULL, '2021-06-18 15:38:44', 1, 14, 0, 52751),
	(752, 'TTCNTT', '000.07.01.H59', 576, 52, 'CÔNG TY TRÁCH NHIỆM HỮU HẠN MỘT THÀNH VIÊN TƯỜNG QUYỀN;\r', NULL, '2021-06-18 15:38:44', 1, 14, 0, 52752),
	(753, 'TTCNTT', '000.07.01.H59', 576, 52, 'Chuyển hệ thống chính thức cho các KH:\r', NULL, '2021-06-18 15:38:44', 1, 14, 0, 52753),
	(754, 'TTCNTT', '000.07.01.H59', 576, 52, 'CÔNG TY TNHH TƯ VẤN XÂY DỰNG THƯƠNG MẠI VÀ DỊCH VỤ Y&N;<br />', NULL, '2021-06-18 15:38:44', 0, 14, 0, 52754),
	(755, 'TTCNTT', '000.07.01.H59', 576, 52, 'CÔNG TY TNHH MAY GIÀY DA HỒNG PHÁT;\r', NULL, '2021-06-18 15:38:44', 0, 14, 0, 52755),
	(756, 'TTCNTT', '000.07.01.H59', 576, 52, 'DOANH NGHIỆP TN THƯƠNG MẠI VÀNG KIM HỒNG;\r', NULL, '2021-06-18 15:38:44', 0, 14, 0, 52756),
	(757, 'TTCNTT', '000.07.01.H59', 576, 52, 'CÔNG TY TNHH THÉP NGỌC TIẾN PHÁT;\r', NULL, '2021-06-18 15:38:44', 0, 14, 0, 52757),
	(758, 'TTCNTT', '000.07.01.H59', 576, 52, 'CÔNG TY TNHH NTN NGỌC THƯƠNG;\r', NULL, '2021-06-18 15:38:44', 0, 14, 0, 52758),
	(759, 'TTCNTT', '000.07.01.H59', 576, 52, 'HTX NÔNG NGHIỆP THƯƠNG MẠI VÀ SXDV XU N THÀNH;\r', NULL, '2021-06-18 15:38:44', 0, 14, 0, 52759),
	(760, 'TTCNTT', '000.07.01.H59', 576, 52, 'CÔNG TY TNHH CÀ PHÊ NGUYÊN TV;\r', NULL, '2021-06-18 15:38:44', 0, 14, 0, 52760),
	(761, 'TTCNTT', '000.07.01.H59', 576, 52, 'CÔNG TY TRÁCH NHIỆM HỮU HẠN MỘT THÀNH VIÊN TƯỜNG QUYỀN;\r', NULL, '2021-06-18 15:38:45', 0, 14, 0, 52761),
	(762, 'TTCNTT', '000.07.01.H59', 576, 52, 'Hệ thống demo:\r', NULL, '2021-06-18 15:38:45', 2, 14, 0, 52762),
	(763, 'TTCNTT', '000.07.01.H59', 576, 52, 'Thiết kế mẫu và khởi tạo hệ thống demo cho các KH:\r', NULL, '2021-06-18 15:38:45', 1, 14, 0, 52763),
	(764, 'TTCNTT', '000.07.01.H59', 576, 52, 'CÔNG TY TNHH TƯ VẤN THIẾT KẾ TM DV THÙY TR N;\r', NULL, '2021-06-18 15:38:45', 0, 14, 0, 52764),
	(765, 'TTCNTT', '000.07.01.H59', 576, 52, 'HTX NÔNG NGHIỆP THƯƠNG MẠI VÀ SXDV XU N THÀNH;', NULL, '2021-06-18 15:38:45', 0, 14, 0, 52765),
	(766, 'TTCNTT', '000.07.01.H59', 576, 38, 'Các công việc thường xuyên khác', NULL, '2021-06-18 15:44:41', 3, 17, 0, 38766),
	(865, 'TTCNTT', '000.07.01.H59', 577, 38, 'Các công việc thường xuyên khác', NULL, '2021-06-24 08:20:27', 3, 17, 0, 865);
/*!40000 ALTER TABLE `bc_tuan_hien_tai` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.chuc_danh
CREATE TABLE IF NOT EXISTS `chuc_danh` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ten_chuc_danh` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.chuc_danh: ~3 rows (approximately)
/*!40000 ALTER TABLE `chuc_danh` DISABLE KEYS */;
INSERT INTO `chuc_danh` (`id`, `ten_chuc_danh`, `state`) VALUES
	(1, 'Kỹ sư', 1),
	(2, 'Thạc sỹ', 1),
	(6, 'Tiến sỹ', 1);
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `sap_xep` int NOT NULL DEFAULT '1',
  `state` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_dich_vu_nhom_dich_vu` (`id_nhom_dich_vu`),
  CONSTRAINT `FK_dich_vu_nhom_dich_vu` FOREIGN KEY (`id_nhom_dich_vu`) REFERENCES `nhom_dich_vu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.dich_vu: ~12 rows (approximately)
/*!40000 ALTER TABLE `dich_vu` DISABLE KEYS */;
INSERT INTO `dich_vu` (`id`, `id_nhom_dich_vu`, `ten_dich_vu`, `sap_xep`, `state`) VALUES
	(1, 1, 'Dịch vụ viễn thông', 1000, 1),
	(2, 7, 'Phần mềm ĐHSXKD tập trung', 1, 1),
	(9, 7, 'Phần mềm VNPT-HIS', 2, 1),
	(10, 7, 'VNPT iOffice/eOffice', 3, 1),
	(11, 7, 'VNPT-iGate', 4, 1),
	(12, 7, 'vnEdu', 5, 1),
	(13, 7, 'vnPortal', 6, 1),
	(14, 7, 'Triển khai phần mềm Hóa đơn điện tử', 7, 1),
	(15, 7, 'LGSP', 8, 1),
	(16, 7, 'CSDLQG-DC', 9, 1),
	(17, 7, 'Các công việc thường xuyên khác', 10, 1),
	(18, 7, '', 11, 1);
/*!40000 ALTER TABLE `dich_vu` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.dm_cap_don_vi
CREATE TABLE IF NOT EXISTS `dm_cap_don_vi` (
  `id` int NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.dm_tham_so_he_thong: ~14 rows (approximately)
/*!40000 ALTER TABLE `dm_tham_so_he_thong` DISABLE KEYS */;
INSERT INTO `dm_tham_so_he_thong` (`id`, `ma_tham_so`, `ten_tham_so`, `loai_tham_so`, `gia_tri_tham_so`, `mo_ta_tham_so`) VALUES
	(1, 'CAP_TIEP_NHAN_MAC_DINH', 'Cấp tiếp nhận yêu cầu mặc định', 'Nvarchar2', 'HUYEN', 'XA cấp xã; \r\nHUYEN cấp huyện;\r\n TTVT cấp Trung tâm viễn thông; \r\nTTCNTT cấp trung tâm CNTT; \r\nTTDHTT cấp Trung tâm DHTT; \r\nTTKD cấp Trung tâm kinh doanh; \r\nVTT cấp viễn thông tỉnh; \r\nUBT cấp Ủy ban tỉnh'),
	(2, 'MA_NHOM_CHUC_VU_NHAN_PAKN', 'Nhóm chức vụ nhận PAKN', 'Nvarchar2', 'TIEP_NHAN', 'LANH_DAO là lãnh đạo nhận PAKN, XU_LY là chuyên viên xử lý sẽ nhận PAKN; ngược lại là nhóm tiếp nhận'),
	(3, 'SECRET_KEY_API_TAO_TAI_KHOAN', 'Khóa bảo mật khi gọi API tạo tài khoản', 'Nvarchar2', 'GDMpLecTjBD1USC5qkPFdiRu7nNtgHuK7JIMXZOi', 'Là khóa bảo mật truyền vào khi gọi API tạo tài khoản'),
	(4, 'MA_NHOM_CHUC_VU_DUYET_DANG_KY_PAKN', 'Mã nhóm chức vụ duyệt các phản ánh, yêu cầu do cán bộ đăng ký', 'Nvarchar2', 'LANH_DAO', 'Mã nhóm chức vụ duyệt các phản ánh, yêu cầu do cán bộ đăng ký'),
	(5, 'TRA_LOI_KHI_HOAN_TAT', 'Cho phép hệ thống tự gửi nội dung hoàn tất vào mục trả lời yêu cầu', 'Nvarchar2', '1', '1 cho phép; 0 không cho phép'),
	(7, 'CHO_PHEP_TRA_LAI_KH_KHI_TIEP_NHAN', 'Cho phép cán bộ trả yêu cầu lại cho khách hàng khi tiếp nhận hồ sơ', 'Nvarchar2', '0', '1 cho phép; 0 không cho phép'),
	(8, 'CHO_PHEP_TRA_LAI_KH_KHI_LANH_DAO_DUYET', 'Cho phép trả lại người dân trong chức năng danh sách chờ lãnh đạo duyệt', 'Nvarchar2', '1', '1 cho phép; 0 không cho phép'),
	(9, 'CHO_PHEP_HUY_YC_KHI_TIEP_NHAN', 'Cho phép cán bộ tiếp nhận hủy yêu cầu  khi tiếp nhận hồ sơ', 'Nvarchar2', '0', '1 cho phép; 0 không cho phép'),
	(10, 'CHO_PHEP_HUY_YC_KHI_LANH_DAO_DUYET', 'Cho phép cán bộ tiếp nhận hủy yêu cầu  khi tiếp nhận hồ sơ', 'Nvarchar2', '1', '1 cho phép; 0 không cho phép'),
	(13, 'BC_BAO_CAO_THEO_MA_DINH_DANH', 'Báo cáo số liệu theo mã định danh', 'Nvarchar2', '0', 'Trong đơn vị có 2 mã: Mã đơn vị và Mã định danh.\r\n- Nếu chưa có mã định danh cho Viễn thông thì giá trị tham số là 0\r\n- Nếu đã có mã định danh thì giá trị tham số là 1\r\n<b>*** Chú ý*** </b>Mặc định là <B>0</B> (Sử dụng cột mã đơn vị)'),
	(14, 'BC_THOI_GIAN_CHOT_BAO_CAO', 'Báo cáo số liệu theo mã định danh', 'Nvarchar2', '16:30:00', 'Thời gian chốt báo cáo H:i:s'),
	(15, 'BC_DM_MA_CAP_DON_VI_TRUC_THUOC_KHAC', 'Danh sách các mã cấp trực thuộc viễn thông tỉnh', 'Nvarchar2', 'TTCNTT,TTDHTT,TTKD,PHONG', 'Danh sách các mã cấp trực thuộc viễn thông tỉnh\r\nLà các đơn vị khác các đơn vị sau: TTYT, Viễn thông huyện, thành phố, thị xã, VTT\r\nCách nhau bởi dấu ,'),
	(16, 'BC_NOI_DUNG_NHAC_NHO_MAC_DINH', 'Nội dung nhắc nhở các đơn vị nộp báo cáo', 'Nvarchar2', '- Đã sắp hết thời gian báo cáo các đơn vị vui lòng tranh thủ hoàn thành báo cáo.\r\n- Danh sách các đơn vị chưa hoàn hoàn thành báo cáo gồm:', 'Nội dung nhắc nhở các đơn vị nộp báo cáo'),
	(18, 'BC_TU_DONG_THEM_DM_CHI_SO_DHSXKD', 'Cho phép hệ thống tự động thêm chỉ số ĐHSXKD', 'Nvarchar2', '1', '1 tự động điền; 0 không điền');
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
  `order` int NOT NULL DEFAULT '1000',
  `la_don_vi_xu_ly` int NOT NULL DEFAULT '0',
  `state` int NOT NULL DEFAULT '1' COMMENT '0: không hoạt động; 1: hoạt động',
  PRIMARY KEY (`id`),
  KEY `FK_don_vi_don_vi` (`parent_id`),
  KEY `order` (`order`),
  KEY `FK_don_vi_dm_phuong_xa` (`ma_phuong_xa`),
  CONSTRAINT `FK_don_vi_dm_phuong_xa` FOREIGN KEY (`ma_phuong_xa`) REFERENCES `dm_phuong_xa` (`ma_phuong_xa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_don_vi_don_vi` FOREIGN KEY (`parent_id`) REFERENCES `don_vi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.don_vi: ~28 rows (approximately)
/*!40000 ALTER TABLE `don_vi` DISABLE KEYS */;
INSERT INTO `don_vi` (`id`, `ma_don_vi`, `ten_don_vi`, `ma_phuong_xa`, `ma_cap`, `ma_dinh_danh`, `email`, `co_dinh`, `di_dong`, `fax`, `parent_id`, `order`, `la_don_vi_xu_ly`, `state`) VALUES
	(1, NULL, 'Tỉnh Trà Vinh', 29239, 'UBT', '', NULL, NULL, NULL, NULL, NULL, 0, 0, 1),
	(2, 'VTT', 'Viễn thông Trà Vinh', 29236, 'VTT', '000.00.01.H59', NULL, NULL, NULL, NULL, 1, 1, 1, 1),
	(12, 'TTCNTT', 'Trung tâm Công nghệ Thông tin', 29236, 'TTCNTT', '000.07.01.H59', NULL, NULL, NULL, NULL, 2, 8, 1, 1),
	(13, 'TTVT1', 'Trung tâm Viễn Thông 1 - TVH', 29236, 'TTVT', '000.09.01.H59', NULL, NULL, NULL, NULL, 2, 10, 1, 1),
	(14, 'TTVT2', 'Trung tâm Viễn Thông 2 - TVH', 29236, 'TTVT', '000.10.01.H59', NULL, NULL, NULL, NULL, 2, 11, 1, 1),
	(15, 'TTVT3', 'Trung tâm Viễn Thông 3 - TVH', 29236, 'TTVT', '000.11.01.H59', NULL, NULL, NULL, NULL, 2, 12, 1, 1),
	(16, 'VT_TPO', 'Khu vực Thành phố Trà Vinh', 29239, 'HUYEN', '001.09.01.H59', NULL, NULL, NULL, NULL, 13, 14, 1, 1),
	(17, 'VT_CTH', 'Khu vực Châu Thành - TVH', 29374, 'HUYEN', '002.09.01.H59', NULL, NULL, NULL, NULL, 13, 15, 1, 1),
	(18, NULL, 'Phòng giải pháp', 29236, NULL, NULL, NULL, NULL, NULL, NULL, 12, 1000, 1, 1),
	(19, NULL, 'Phòng tổng hợp', 29236, NULL, NULL, NULL, NULL, NULL, NULL, 12, 1000, 1, 1),
	(20, 'VT_CKE', 'Khu vực Cầu Kè', 29308, 'HUYEN', '003.10.01.H59', NULL, NULL, NULL, NULL, 14, 18, 1, 1),
	(21, 'VT_CLG', 'Khu vực Càng Long', 29266, 'HUYEN', '001.10.01.H59', NULL, NULL, NULL, NULL, 14, 16, 1, 1),
	(22, 'VT_TCU', 'Khu vực Trà Cú', 29461, 'HUYEN', '002.11.01.H59', NULL, NULL, NULL, NULL, 15, 20, 1, 1),
	(24, 'VT_CNG', 'Khu vực Cầu Ngang', 29416, 'HUYEN', '001.11.01.H59', NULL, NULL, NULL, NULL, 15, 19, 1, 1),
	(25, 'VT_DHI', 'Khu vực huyện Duyên Hải', 29497, 'HUYEN', '003.11.01.H59', NULL, NULL, NULL, NULL, 15, 21, 1, 1),
	(26, 'VT_TXDHI', 'Khu vực thị xã Duyên Hải', 29512, 'HUYEN', '004.11.01.H59', NULL, NULL, NULL, NULL, 15, 22, 1, 1),
	(33, NULL, 'Ban giám đốc', 29236, NULL, NULL, NULL, NULL, NULL, NULL, 13, 1000, 1, 1),
	(34, NULL, 'Ban giám đốc - TVH', 29236, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, 1, 1),
	(37, 'TTKD', 'Trung tâm Kinh doanh', 29236, 'TTKD', '000.12.01.H59', NULL, NULL, NULL, NULL, 2, 13, 1, 1),
	(38, 'TTDHTT', 'Trung tâm Điều hành Thông tin', 29236, 'TTDHTT', '000.08.01.H59', NULL, NULL, NULL, NULL, 2, 9, 1, 1),
	(39, 'NSTH', 'Phòng Nhân sự - Tổng hợp - TVH', 29236, 'PHONG', '000.01.01.H59', NULL, NULL, NULL, NULL, 2, 2, 1, 1),
	(40, 'KTDT', 'Phòng Kỹ thuật - Đầu tư - TVH', 29236, 'PHONG', '000.02.01.H59', NULL, NULL, NULL, NULL, 2, 3, 1, 1),
	(41, 'KHKT', 'Phòng Kế hoạch - Kế toán - TVH', 29236, 'PHONG', '000.03.01.H59', NULL, NULL, NULL, NULL, 2, 4, 1, 1),
	(42, 'KCTD', 'Khối chuyên trách đảng - TVH', 29236, 'PHONG', '000.04.01.H59', NULL, NULL, NULL, NULL, 2, 5, 1, 1),
	(43, 'CD', 'Công đoàn VNPT Trà Vinh - TVH', 29236, 'PHONG', '000.05.01.H59', NULL, NULL, NULL, NULL, 2, 6, 1, 1),
	(44, NULL, 'Ban giám đốc', 29236, NULL, NULL, NULL, NULL, NULL, NULL, 12, 1000, 1, 1),
	(45, 'DTN', 'Đoàn thanh niên viễn thông Trà Vinh - TVH', 29236, 'PHONG', '000.06.01.H59', NULL, NULL, NULL, NULL, 2, 7, 1, 1),
	(46, 'VT_TCN', 'Khu vực Tiểu Cần', 29341, 'HUYEN', '002.10.01.H59', NULL, NULL, NULL, NULL, 14, 17, 1, 1);
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `sap_xep` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.nhom_dich_vu: ~7 rows (approximately)
/*!40000 ALTER TABLE `nhom_dich_vu` DISABLE KEYS */;
INSERT INTO `nhom_dich_vu` (`id`, `ma_nhom_dich_vu`, `ten_nhom_dich_vu`, `state`, `sap_xep`) VALUES
	(1, 'DV_VT', 'Dịch vụ Viễn Thông', 1, 1),
	(2, 'DV_HUYEN', 'Dịch vụ cấp huyện', 1, 1),
	(3, 'DV_XA', 'Dịch vụ cấp xã', 1, 1),
	(4, 'DV_TTVT', 'Dịch vụ cấp TTVT', 1, 1),
	(5, 'DV_DHTT', 'Dịch vụ ĐHTT', 1, 1),
	(6, 'DV_KD', 'Dịch vụ hỗ trợ kinh doanh', 1, 1),
	(7, 'DV_CNTT', 'Dịch vụ CNTT', 1, 2);
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

-- Dumping data for table vnptpayc.oauth_access_tokens: ~26 rows (approximately)
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
	('50c58ec897160bbd787e94ec638d0af9c78f410ea47a95376f18a56149552490a80add6798cf59f3', 35, 1, 'Personal Access Token', '[]', 0, '2021-06-16 09:21:54', '2021-06-16 09:21:54', '2021-06-23 09:21:54'),
	('5686828bc20556864bd052738a401e2d0e895e00e16ab87c3f0705219f58b6ca00b5b08fbdc9d942', 9, 1, 'Personal Access Token', '[]', 0, '2021-03-18 10:33:58', '2021-03-18 10:33:58', '2022-03-18 10:33:58'),
	('5b86734b7c13af207eb1db1119d4a44d17056607197ddffe361912495b904263548dc3a2b0208b59', 36, 1, 'Personal Access Token', '[]', 0, '2021-05-27 10:15:52', '2021-05-27 10:15:52', '2021-06-03 10:15:52'),
	('77ce018aaa53c802abf194d4d6704745be07c3406ffbbc00e95a9b9e1360f95a3c9e58d53f21c88d', 11, 1, 'Personal Access Token', '[]', 0, '2021-03-19 10:40:12', '2021-03-19 10:40:12', '2021-03-26 10:40:12'),
	('85a015496e911293796ccb5dd1fed51c45a8d8a9073248b978b0f6f0e14d459bee9c1d4e1212cb21', 2, 1, 'Personal Access Token', '[]', 0, '2021-06-18 15:59:14', '2021-06-18 15:59:14', '2021-06-25 15:59:14'),
	('877cd02f5c4acd58baf85ac200d38c0535df43c5a7625cef75e25809176b7fb79cc3dbe33f44b8a3', 11, 1, 'Personal Access Token', '[]', 0, '2021-03-19 08:12:07', '2021-03-19 08:12:07', '2021-03-26 08:12:07'),
	('9598bce90b7426af3afbe4699626b9e4bafe70121cb0ee526fe1e232a48a2f522e54c17885f9c289', 2, 1, 'Personal Access Token', '[]', 0, '2021-06-16 09:23:40', '2021-06-16 09:23:40', '2021-06-23 09:23:40'),
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

-- Dumping data for table vnptpayc.oauth_personal_access_clients: ~1 rows (approximately)
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

-- Dumping data for table vnptpayc.password_resets: ~2 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
	('thanhpv.tvh', '$2y$10$GeJq5nbaNzdeY8UqlCnDIOIh6uSHYw5iZcRhpKuPxDrBtqBT4qAG.', '2019-06-20 02:17:07'),
	('p.thanhit@gmail.com', '$2y$10$Wfx0JhILSAPlPh3cft0SI.URV3epGiCzhxsZLostXaPcvYo2uwDE2', '2021-04-08 08:44:50');
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
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.payc: ~6 rows (approximately)
/*!40000 ALTER TABLE `payc` DISABLE KEYS */;
INSERT INTO `payc` (`id`, `id_user_tao`, `id_dich_vu`, `so_phieu`, `tieu_de`, `noi_dung`, `file_payc`, `ma_phuong_xa`, `vi_do`, `kinh_do`, `ngay_tao`, `han_xu_ly_mong_muon`, `han_xu_ly_duoc_giao`, `ngay_hoan_tat`, `trang_thai`) VALUES
	(84, 2, 2, '140621-0001', 'Phan Văn Thanh kiểm thử phản ánh kiến nghị lần 1', '<p><br></p>', 'QuyếtđịnhthànhlậpnhómLantỏacủaMạnglướiĐạisứtruyềnthôngVNPTđịabàntỉnhTràVinh(1)_16236349800.pdf;', 29236, NULL, NULL, '2021-06-14 08:43:00', '2021-06-14 17:00:00', NULL, NULL, 1),
	(86, 2, 2, '160621-0001', 'Kiểm thử chức năng tải file  hệ thống trên điện thoại', '<p>Kiểm thử chức năng tải file&nbsp; hệ thống trên điện thoại<br></p>', 'QuyếtđịnhthànhlậpnhómLantỏacủaMạnglướiĐạisứtruyềnthôngVNPTđịabàntỉnhTràVinh(1)_16238086080.pdf;', 29236, NULL, NULL, '2021-06-16 08:56:48', '2021-06-16 17:00:00', NULL, NULL, 1),
	(87, 2, 2, '160621-0002', 'Kiểm tra chức năng thông báo khi gửi PAKN thành công.', '<p>Kiểm tra chức năng thông báo khi gửi PAKN thành công.<br></p>', 'QuyếtđịnhthànhlậpnhómLantỏacủaMạnglướiĐạisứtruyềnthôngVNPTđịabàntỉnhTràVinh(1)_16238089870.pdf;', 29236, NULL, NULL, '2021-06-16 09:03:07', '2021-06-16 17:00:00', NULL, NULL, 1),
	(88, 50, 2, '170621-0001', 'Kiểm thử chức năng gửi PAKN nhóm quyền Báo cáo tuần - TTCNTT', '<p>Kiểm thử chức năng gửi PAKN nhóm quyền Báo cáo tuần - TTCNTT<br></p>', 'QuyếtđịnhthànhlậpnhómLantỏacủaMạnglướiĐạisứtruyềnthôngVNPTđịabàntỉnhTràVinh(1)_16238944030.pdf;', 29236, NULL, NULL, '2021-06-17 08:46:43', '2021-06-17 17:00:00', NULL, NULL, 1),
	(89, 1, 1, '230621-0001', 'Phan Văn Thanh test api lưu file', 'Test api chơi được không bạn', 'api_1624436092_0test.pdf;api_1624436092_1test.pdf;', 29236, NULL, NULL, '2021-06-23 15:14:52', '2021-03-15 16:01:02', NULL, NULL, 1),
	(90, 1, 1, '230621-0002', 'Mạng quá chậm', 'Test api chơi được không bạn', 'api_1624436266_0QuyếtđịnhthànhlậpnhómLantỏacủaMạnglướiĐạisứtruyềnthôngVNPTđịabàntỉnhTràVinh(1)_16238086080.pdf;api_1624436266_1QuyếtđịnhthànhlậpnhómLantỏacủaMạnglướiĐạisứtruyềnthôngVNPTđịabàntỉnhTràVinh(1)_16238086080.pdf;', 29236, NULL, NULL, '2021-06-23 15:17:46', '2021-05-15 16:01:02', NULL, NULL, 1);
/*!40000 ALTER TABLE `payc` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.payc_binh_luan
CREATE TABLE IF NOT EXISTS `payc_binh_luan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_payc` int NOT NULL DEFAULT '1',
  `id_user` int unsigned DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `file` varchar(250) DEFAULT NULL,
  `ma_loai` varchar(50) NOT NULL DEFAULT 'BINH_LUAN' COMMENT 'BINH_LUAN; TRA_LOI',
  `ho_ten` varchar(250) DEFAULT NULL,
  `noi_dung` longtext,
  `hai_long` int NOT NULL DEFAULT '0',
  `khong_hai_long` int NOT NULL DEFAULT '0',
  `trang_thai` int NOT NULL DEFAULT '0',
  `ngay_binh_luan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_payc_binh_luan_payc` (`id_payc`),
  KEY `FK_payc_binh_luan_users` (`id_user`),
  KEY `FK_payc_binh_luan_payc_binh_luan` (`parent_id`),
  CONSTRAINT `FK_payc_binh_luan_payc` FOREIGN KEY (`id_payc`) REFERENCES `payc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payc_binh_luan_payc_binh_luan` FOREIGN KEY (`parent_id`) REFERENCES `payc_binh_luan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payc_binh_luan_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.payc_binh_luan: ~0 rows (approximately)
/*!40000 ALTER TABLE `payc_binh_luan` DISABLE KEYS */;
/*!40000 ALTER TABLE `payc_binh_luan` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.payc_can_bo_nhan
CREATE TABLE IF NOT EXISTS `payc_can_bo_nhan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_xu_ly_yeu_cau` int NOT NULL,
  `id_user_nhan` int unsigned NOT NULL,
  `ngay_nhan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `han_xu_ly` datetime DEFAULT NULL,
  `ngay_hoan_tat` datetime DEFAULT NULL,
  `vai_tro` int NOT NULL DEFAULT '0',
  `trang_thai` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_payc_can_bo_nhan_payc_canbo_xuly_yeucau` (`id_xu_ly_yeu_cau`),
  KEY `FK_payc_can_bo_nhan_users` (`id_user_nhan`),
  CONSTRAINT `FK_payc_can_bo_nhan_payc_canbo_xuly_yeucau` FOREIGN KEY (`id_xu_ly_yeu_cau`) REFERENCES `payc_xu_ly` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payc_can_bo_nhan_users` FOREIGN KEY (`id_user_nhan`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=215 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.payc_can_bo_nhan: ~6 rows (approximately)
/*!40000 ALTER TABLE `payc_can_bo_nhan` DISABLE KEYS */;
INSERT INTO `payc_can_bo_nhan` (`id`, `id_xu_ly_yeu_cau`, `id_user_nhan`, `ngay_nhan`, `han_xu_ly`, `ngay_hoan_tat`, `vai_tro`, `trang_thai`) VALUES
	(204, 357, 3, '2021-06-14 08:51:02', NULL, '2021-06-14 08:53:55', 1, 2),
	(206, 359, 37, '2021-06-14 08:53:55', NULL, '2021-06-16 09:15:55', 0, 2),
	(211, 363, 3, '2021-06-16 09:15:55', NULL, NULL, 1, 0),
	(212, 364, 55, '2021-06-17 08:46:43', NULL, NULL, 0, 0),
	(213, 365, 46, '2021-06-23 15:14:52', NULL, NULL, 0, 0),
	(214, 366, 46, '2021-06-23 15:17:46', NULL, NULL, 0, 0);
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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.payc_trang_thai_xu_ly: ~18 rows (approximately)
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
) ENGINE=InnoDB AUTO_INCREMENT=367 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.payc_xu_ly: ~9 rows (approximately)
/*!40000 ALTER TABLE `payc_xu_ly` DISABLE KEYS */;
INSERT INTO `payc_xu_ly` (`id`, `id_payc`, `id_user_xu_ly`, `id_xu_ly`, `noi_dung_xu_ly`, `file_xu_ly`, `ngay_xu_ly`, `state`) VALUES
	(352, 84, 2, 1, '', '', '2021-06-14 08:43:00', 0),
	(357, 84, 37, 20, 'Mỹ Phối hợp xử lý', NULL, '2021-06-14 08:51:02', 0),
	(359, 84, 3, 22, NULL, NULL, '2021-06-14 08:53:55', 0),
	(361, 86, 2, 1, '', '', '2021-06-16 08:56:49', 0),
	(362, 87, 2, 1, '', '', '2021-06-16 09:03:07', 0),
	(363, 84, 37, 20, 'Chuyển Mỹ và Thanh cùng xử lý', NULL, '2021-06-16 09:15:55', 0),
	(364, 88, 50, 1, '', '', '2021-06-17 08:46:43', 0),
	(365, 89, 1, 1, '', '', '2021-06-23 15:14:52', 0),
	(366, 90, 1, 1, '', '', '2021-06-23 15:17:46', 0);
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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.to_do: ~2 rows (approximately)
/*!40000 ALTER TABLE `to_do` DISABLE KEYS */;
INSERT INTO `to_do` (`id`, `id_user`, `noi_dung`, `file`, `ngay_tao`, `ngay_giao`, `han_xu_ly`, `ngay_hoan_thanh`, `sap_xep`, `trang_thai`) VALUES
	(42, 2, 'Test 2', NULL, '2021-06-18 07:56:04', '2021-06-18 07:56:04', '2021-06-19 07:55:00', '2021-06-22 09:10:22', 2, 1),
	(44, 2, 'Test 3', NULL, '2021-06-22 07:44:32', '2021-06-22 07:44:32', NULL, NULL, 1, 1);
/*!40000 ALTER TABLE `to_do` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hinh_anh` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'logo.png',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `di_dong` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loai_tai_khoan` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'KHACH_HANG' COMMENT 'KHACH_HANG; CAN_BO',
  `state` int DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.users: ~23 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `hinh_anh`, `remember_token`, `created_at`, `updated_at`, `di_dong`, `loai_tai_khoan`, `state`) VALUES
	(1, 'Chế độ ẩn danh', 'guest@vnpt.vn', '$2y$10$VZI0siYq7lRPvqt8e.QbXOWDBelj91YwJoLsEKx4GxbWH5XQb87xO', 'photo_2019-10-21_18-00-43_16177906110.jpg', '35xOWSUdceM6lRhePiHS9Y3xwvvLupgJWeYIzh2FMjMl22RuUJURMmX7oElG', NULL, '2021-06-10 10:09:36', '0941138484', 'KHACH_HANG', 1),
	(2, 'Quản trị hệ thống', 'admin@vnpt.vn', '$2y$10$OcK0kyfMtKmByQ2ZmToC/uf.8ekeOk.Snc4LqXXDrnZrHO8oencTC', 'photo_2019-10-21_18-00-43_16177906110.jpg', 'ERQBO995UfXjvQOu2bN5AuammsaUaXDvpnabuBZyyev2yni2161PT6pit3qS', NULL, '2021-06-24 08:08:42', '0941138484', 'CAN_BO', 1),
	(3, 'Phan Văn Thanh', 'thanhpv.tvh@vnpt.vn', '$2y$10$qtkXLgyhBiGhZE4a.4DPjuirvK03vKh9llBKgkA.gbBD0n8b1l84C', '/user.png', NULL, '2021-06-14 08:36:04', '2021-06-17 15:33:13', '0941138484', 'CAN_BO', 1),
	(35, 'API', 'api.tvh@vnpt.vn', '$2y$10$7XXsD688amtqziOa0CJb6er2R6hvpBj0jWMeNFSOGuhxow2Z13ZMy', '/user.png', NULL, '2021-05-27 10:15:36', '2021-05-27 10:15:36', NULL, 'API', 1),
	(37, 'Nguyễn Chí Thanh', 'thanhnc.tvh@vnpt.vn', '$2y$10$s6e4H9NTKjvpV8lwgz3ga.yTtDREGwLuGwdhDn36bP2g/m42Gr7la', 'anh_16239233080.jpg', 'IlRmpzqR0qmArNdnwAdbX0xvnQE4y6N2zmlbT3tGBQp5XJ9N3p6NLeUzjbtD', '2021-06-10 10:11:50', '2021-06-23 20:12:01', '0913658639', 'CAN_BO', 1),
	(38, 'Nguyễn Hữu Quang', 'quangnh.tvh@vnpt.vn', '$2y$10$7QFUeePm1u3YNRUIJj.5sOwsFSGLIf7rTUsVucW6CoQZv1BRtGDyy', 'AnhQuang_16240091410.jpg', NULL, '2021-06-10 10:12:28', '2021-06-18 16:39:01', '0913891014', 'CAN_BO', 1),
	(39, 'Nguyễn Văn Nam', 'namnv.tvh@vnpt.vn', '$2y$10$2EM8xaShb53j2uxd6MMrke6r/hg/bLMOYkaVatlF2ueNfpUlrnZI6', '/user.png', NULL, '2021-06-10 10:13:08', '2021-06-18 10:48:57', '0919363999', 'CAN_BO', 1),
	(40, 'Hồ Thanh Cao', 'caoht.tvh@vnpt.vn', '$2y$10$Wfkw.2H.KHQp8sw1e70tVu5F.EuPb8srhogB1uJ6RE3BNqp.HZVjG', '/user.png', NULL, '2021-06-10 10:17:04', '2021-06-10 10:17:04', '0913890084', 'CAN_BO', 1),
	(41, 'Đặng Văn Nghĩa', 'nghiadv.tvh@vnpt.vn', '$2y$10$BQOVxabz/KFKIVj41HVUBOsJihwsOh3f4.vhMVzeSq/YGCQl1chY.', '/user.png', NULL, '2021-06-10 10:21:04', '2021-06-23 16:50:35', '0919329629', 'CAN_BO', 1),
	(42, 'Nguyễn Văn Ngon', 'ngonnv.tvh@vnpt.vn', '$2y$10$sX/p/FdLQAR2gqdroit9uO7i0//HyGCX6cnQzsFIhkT2OymqU.Tua', '/user.png', NULL, '2021-06-10 10:22:13', '2021-06-10 10:22:13', '0918136456', 'CAN_BO', 1),
	(43, 'Bạch Tuấn Kiệt', 'kietbt.tvh@vnpt.vn', '$2y$10$HzEoUTDOFc792WW7/PyRJ.90VDx8lyb141oV7cmg16V6y3azBoZL6', '/user.png', NULL, '2021-06-11 13:41:01', '2021-06-11 13:41:01', '0913633215', 'CAN_BO', 1),
	(45, 'Nguyễn Duy Sơn', 'sonnd.tvh@vnpt.vn', '$2y$10$DyeI6HHVOpruUYkBhV0/gO5qMPACp5YbF3YwwXS9whBqvV2XXXrny', '/user.png', NULL, '2021-06-14 08:32:54', '2021-06-14 08:32:54', '0919329666', 'CAN_BO', 1),
	(46, 'Nguyễn Thị Kim Chi', 'chintk.tvh@vnpt.vn', '$2y$10$0ffdrnejzltTXS1n193Vb.tAaTwuR3ocBJ/BqUd9WOcuFoQFVtT2W', '/user.png', NULL, '2021-06-14 08:34:08', '2021-06-14 08:34:08', '0919896606', 'CAN_BO', 1),
	(49, 'Huỳnh Sa Quang', 'quanghs.tvh@vnpt.vn', '$2y$10$NkEArFNoNGsJw05ZUPiwEuf1.Q2teuJI.9f0CDK.u7enaGTCjIV3G', '/user.png', 'xYN7Od17WJg1s2wVrFuQJWdcCa4oCvcdhCwwEjq4FlAWwrbsr8g58lQ0z6jP', '2021-06-17 08:23:13', '2021-06-18 16:26:50', '0911759134', 'CAN_BO', 1),
	(50, 'Từ Minh Khoa', 'khoatm.tvh@vnpt.vn', '$2y$10$eqWaDva1yD7E8pw5ILepa.CpAVP5yYF8brnfHYQ8Zr9LM7ODwvXbi', '/user.png', 'o07dfOzSafCwBxoTt6PGLVkTBlvv6bsbkJHMUOxaHqRhjyGtbrXt3qR9YKVl', '2021-06-17 08:23:52', '2021-06-17 16:37:26', '0941230111', 'CAN_BO', 1),
	(51, 'Huỳnh Minh Luân', 'luanhm.tvh@vnpt.vn', '$2y$10$w7kEDPmNfiQjFGVlDPwivOP8yiTBR4tQc0q4Oatzaqrqz9adnQnLq', '1_16239783520.jpg', 'mJfcwZO8KaM1Yt5DTGIjVzqeupCIqw4ZiEr4cNUyqDxmuWw2XZzdLGGWZTlS', '2021-06-17 08:24:30', '2021-06-18 08:05:52', '0944322567', 'CAN_BO', 1),
	(52, 'Võ Duy Hưng', 'hungvd.tvh@vnpt.vn', '$2y$10$CNyg7.eyvKXG/Iby3pWNy.Ed8KIjOBvcxcindSY4N5VfPbymm75s.', '/user.png', NULL, '2021-06-17 08:24:59', '2021-06-18 09:38:30', '0911699736', 'CAN_BO', 1),
	(53, 'Hồ Minh Hải', 'haihm.tvh@vnpt.vn', '$2y$10$5nR5.6IdV.g0UnAUy8zJkO1WunApacBV9tZK5OlohCqhMOwhM2BBq', '/user.png', NULL, '2021-06-17 08:25:30', '2021-06-17 08:25:30', '0916961718', 'CAN_BO', 1),
	(54, 'Trần Anh Tuấn', 'tuanta.tvh@vnpt.vn', '$2y$10$vD6/usbPo7QeIJSm.kENaO7XA.UA1HOsWYwkPZ5Jm4/5w4.5GU7y6', '/user.png', 'OnhylnnRavrZBeV2Gnqvm8TzFhY7esgTQ6sM01bX2uaWYvtsHUznVwFJvBSi', '2021-06-17 08:26:06', '2021-06-18 14:35:13', '0911771873', 'CAN_BO', 1),
	(55, 'Trần Thị Thanh Mỹ', 'myttt.tvh@vnpt.vn', '$2y$10$MGPd9Q4E60IPKNRoJB.B4uJ34kVkPKAfKh1anwP2VNNc/X6YXTBu.', '/user.png', NULL, '2021-06-17 08:31:07', '2021-06-17 08:31:07', '0919345358', 'CAN_BO', 1),
	(56, 'Trần Quốc Việt', 'viettq.tvh@vnpt.vn', '$2y$10$yYSpnVfpNG2wftNU3EiGvOj0ebRKoNFwTbrntkvA1vNzC9f1lV0SG', 'AnhankemTrangTien_16239242010.jpg', 'uNHU4rQYyb8VfEYh0y4M56c1hHo1guLoYrAsVtjdNtRSDM2QU7vBMRvauOnR', '2021-06-17 17:03:21', '2021-06-17 17:03:35', '0947874156', 'CAN_BO', 1),
	(57, 'Phạm Kim TÍn', 'tinpk.tvh@vnpt.vn', '$2y$10$SittrT.4rEPdLRFEsUse6e7AjwsDFhpLAkyAtD/J8XkviRxGy3gcq', 'logo.png', NULL, '2021-06-18 10:58:03', '2021-06-18 10:58:03', '0944564033', 'CAN_BO', 1),
	(58, 'Nguyễn Thị Kim Xa', 'xantk.tvh@vnpt.vn', '$2y$10$xQJrK4Ai1HsXNRvxKm0MZOmpNB3ffujGHRMrr/58YExjLPN3F8ZUm', 'logo.png', NULL, '2021-06-18 11:02:39', '2021-06-18 11:02:39', '0917380098', 'CAN_BO', 1);
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
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.users_dich_vu: ~31 rows (approximately)
/*!40000 ALTER TABLE `users_dich_vu` DISABLE KEYS */;
INSERT INTO `users_dich_vu` (`id`, `id_user`, `id_dich_vu`, `tu_ngay`, `den_ngay`, `state`) VALUES
	(36, 2, 2, NULL, NULL, 1),
	(40, 46, 1, NULL, NULL, 1),
	(41, 45, 1, NULL, NULL, 1),
	(43, 43, 1, NULL, NULL, 1),
	(47, 49, 2, NULL, NULL, 1),
	(54, 41, 1, NULL, NULL, 1),
	(55, 42, 1, NULL, NULL, 1),
	(62, 2, 1, NULL, NULL, 1),
	(63, 2, 9, NULL, NULL, 1),
	(64, 2, 10, NULL, NULL, 1),
	(65, 2, 11, NULL, NULL, 1),
	(66, 2, 12, NULL, NULL, 1),
	(67, 2, 13, NULL, NULL, 1),
	(68, 2, 14, NULL, NULL, 1),
	(69, 2, 15, NULL, NULL, 1),
	(70, 2, 16, NULL, NULL, 1),
	(71, 2, 17, NULL, NULL, 1),
	(72, 3, 11, NULL, NULL, 1),
	(80, 37, 16, NULL, NULL, 1),
	(85, 38, 17, NULL, NULL, 1),
	(86, 39, 17, NULL, NULL, 1),
	(91, 50, 9, NULL, NULL, 1),
	(92, 51, 10, NULL, NULL, 1),
	(93, 52, 14, NULL, NULL, 1),
	(94, 53, 13, NULL, NULL, 1),
	(95, 54, 12, NULL, NULL, 1),
	(96, 55, 9, NULL, NULL, 1),
	(97, 57, 15, NULL, NULL, 1),
	(98, 58, 18, NULL, NULL, 1),
	(103, 40, 18, NULL, NULL, 1),
	(104, 37, 1, '2021-06-23', NULL, 1);
/*!40000 ALTER TABLE `users_dich_vu` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.users_don_vi
CREATE TABLE IF NOT EXISTS `users_don_vi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_don_vi` int unsigned NOT NULL,
  `id_user` int unsigned NOT NULL,
  `id_chuc_danh` int unsigned NOT NULL DEFAULT '1',
  `id_chuc_vu` int unsigned NOT NULL DEFAULT '1',
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
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.users_don_vi: ~21 rows (approximately)
/*!40000 ALTER TABLE `users_don_vi` DISABLE KEYS */;
INSERT INTO `users_don_vi` (`id`, `id_don_vi`, `id_user`, `id_chuc_danh`, `id_chuc_vu`, `ngay_bat_dau_cong_tac`, `ngay_ket_thuc_cong_tac`, `state`) VALUES
	(72, 18, 2, 1, 2, NULL, NULL, 1),
	(73, 18, 37, 1, 2, NULL, NULL, 1),
	(74, 44, 38, 1, 2, NULL, NULL, 1),
	(76, 44, 39, 2, 2, NULL, NULL, 1),
	(77, 34, 40, 6, 2, NULL, NULL, 1),
	(78, 16, 41, 1, 2, NULL, NULL, 1),
	(79, 17, 42, 1, 2, NULL, NULL, 1),
	(80, 33, 43, 1, 2, NULL, NULL, 1),
	(82, 16, 45, 1, 4, NULL, NULL, 1),
	(83, 16, 46, 1, 3, NULL, NULL, 1),
	(85, 18, 3, 1, 4, NULL, NULL, 1),
	(86, 19, 49, 1, 4, NULL, NULL, 1),
	(87, 18, 50, 1, 4, NULL, NULL, 1),
	(88, 18, 51, 1, 4, NULL, NULL, 1),
	(89, 18, 52, 1, 4, NULL, NULL, 1),
	(90, 18, 53, 1, 4, NULL, NULL, 1),
	(91, 18, 54, 1, 4, NULL, NULL, 1),
	(92, 18, 55, 2, 3, NULL, NULL, 1),
	(93, 18, 57, 1, 4, '2021-06-18 00:00:00', '2025-12-18 00:00:00', 1),
	(94, 19, 58, 1, 4, '2021-06-18 00:00:00', NULL, 1),
	(95, 18, 56, 1, 4, NULL, NULL, 1);
/*!40000 ALTER TABLE `users_don_vi` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.users_role
CREATE TABLE IF NOT EXISTS `users_role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `role_id` int unsigned NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_role_id` (`user_id`,`role_id`),
  KEY `FK_users_role_admin_role` (`role_id`),
  CONSTRAINT `FK_users_role_admin_role` FOREIGN KEY (`role_id`) REFERENCES `admin_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_users_role_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.users_role: ~16 rows (approximately)
/*!40000 ALTER TABLE `users_role` DISABLE KEYS */;
INSERT INTO `users_role` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '2021-03-17 11:02:46', '2021-03-17 11:02:47'),
	(32, 2, 2, '2021-04-09 16:10:46', '2021-04-09 16:10:46'),
	(38, 37, 2, '2021-06-10 10:34:14', '2021-06-10 10:34:14'),
	(51, 49, 7, '2021-06-17 08:43:00', '2021-06-17 08:43:00'),
	(52, 50, 7, '2021-06-17 08:45:06', '2021-06-17 08:45:06'),
	(53, 38, 7, '2021-06-17 15:34:40', '2021-06-17 15:34:40'),
	(54, 39, 7, '2021-06-17 15:34:49', '2021-06-17 15:34:49'),
	(55, 51, 7, '2021-06-17 15:35:01', '2021-06-17 15:35:01'),
	(56, 52, 7, '2021-06-17 15:35:06', '2021-06-17 15:35:06'),
	(57, 53, 7, '2021-06-17 15:35:11', '2021-06-17 15:35:11'),
	(58, 54, 7, '2021-06-17 15:35:17', '2021-06-17 15:35:17'),
	(59, 55, 7, '2021-06-17 15:35:22', '2021-06-17 15:35:22'),
	(61, 3, 7, '2021-06-18 10:13:56', '2021-06-18 10:13:56'),
	(62, 57, 7, '2021-06-18 10:59:54', '2021-06-18 10:59:54'),
	(63, 58, 7, '2021-06-18 11:03:46', '2021-06-18 11:03:46'),
	(64, 41, 5, '2021-06-23 16:51:01', '2021-06-23 16:51:01');
/*!40000 ALTER TABLE `users_role` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

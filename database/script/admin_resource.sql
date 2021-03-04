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
) ENGINE=InnoDB AUTO_INCREMENT=686 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.admin_resource: ~68 rows (approximately)
/*!40000 ALTER TABLE `admin_resource` DISABLE KEYS */;
INSERT INTO `admin_resource` (`id`, `ten_hien_thi`, `resource`, `method`, `action`, `parameter`, `parameter_value`, `parent_id`, `created_at`, `updated_at`, `uri`, `status`, `show_menu`, `order`, `icon`) VALUES
	(1, 'Root', 'Root', 'GET', '#', '#', '#', NULL, '2021-02-01 09:49:23', '2021-02-02 08:33:17', '#', 1, 1, 0, NULL),
	(601, 'Đăng nhập', 'GET | App\\Http\\Controllers\\Auth\\LoginController@showLoginForm', 'GET', 'App\\Http\\Controllers\\Auth\\LoginController@showLoginForm', '', '', 1, '2021-02-01 09:49:23', '2021-02-19 07:51:52', 'login', 1, 2, 1000, '<i class="icon-login"></i>'),
	(602, 'Nút đăng nhập', 'POST | App\\Http\\Controllers\\Auth\\LoginController@login', 'POST', 'App\\Http\\Controllers\\Auth\\LoginController@login', '', '', 601, '2021-02-01 09:49:23', '2021-02-19 07:51:52', 'login', 1, 2, 1000, NULL),
	(603, 'Đăng xuất', 'POST | App\\Http\\Controllers\\Auth\\LoginController@logout', 'POST', 'App\\Http\\Controllers\\Auth\\LoginController@logout', '', '', 1, '2021-02-01 09:49:23', '2021-02-19 07:51:52', 'logout', 1, 2, 1000, '<i class="icon-logout"></i>'),
	(604, 'Đăng ký', 'GET | App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm', 'GET', 'App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm', '', '', 1, '2021-02-01 09:49:23', '2021-02-19 07:51:52', 'register', 1, 2, 1000, '<i class="icon-user-following mx-0"></i>'),
	(605, 'Nút đăng ký', 'POST | App\\Http\\Controllers\\Auth\\RegisterController@register', 'POST', 'App\\Http\\Controllers\\Auth\\RegisterController@register', '', '', 604, '2021-02-01 09:49:23', '2021-02-19 07:51:52', 'register', 1, 2, 1000, NULL),
	(606, 'Reset mật khẩu', 'GET | App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm', 'GET', 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm', '', '', 1, '2021-02-01 09:49:23', '2021-02-19 07:51:52', 'password/reset', 1, 2, 1000, '<i class="icon-key mx-0"></i>'),
	(607, 'Xác thực email', 'POST | App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail', 'POST', 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail', '', '', 606, '2021-02-01 09:49:23', '2021-02-19 07:51:52', 'password/email', 1, 2, 1000, NULL),
	(608, 'Lấy token reset mật khẩu', 'GET | App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm', 'GET', 'App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm', '', '', 606, '2021-02-01 09:49:23', '2021-02-19 07:51:52', 'password/reset/{token}', 1, 2, 1000, NULL),
	(609, 'Reset lại mật khẩu', 'POST | App\\Http\\Controllers\\Auth\\ResetPasswordController@reset', 'POST', 'App\\Http\\Controllers\\Auth\\ResetPasswordController@reset', '', '', 606, '2021-02-01 09:49:23', '2021-02-19 07:51:52', 'password/reset', 1, 2, 1000, NULL),
	(610, 'Xác nhận lại mật khẩu', 'GET | App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm', 'GET', 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm', '', '', 606, '2021-02-01 09:49:23', '2021-02-19 07:51:52', 'password/confirm', 1, 2, 1000, NULL),
	(611, 'Xác nhận lại mật khẩu lần 2', 'POST | App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm', 'POST', 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm', '', '', 606, '2021-02-01 09:49:23', '2021-02-19 07:51:52', 'password/confirm', 1, 2, 1000, NULL),
	(612, 'Danh mục quận huyện', 'GET | App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyen', 'GET', 'App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyen', '', '', 1, '2021-02-01 09:49:23', '2021-02-19 07:51:52', 'dm-quan-huyen', 1, 1, 5, '<i class="menu-icon icon-location-pin"></i>'),
	(613, 'Nút import danh mục quận huyện', 'POST | App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyenAndImport', 'POST', 'App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyenAndImport', '', '', 612, '2021-02-01 09:49:23', '2021-02-19 07:51:52', 'dm-quan-huyen/import', 1, 2, 1000, NULL),
	(614, 'Danh mục phường xã', 'GET | App\\Modules\\DmXaPhuong\\Controllers\\DmXaPhuongController@dmXaPhuong', 'GET', 'App\\Modules\\DmXaPhuong\\Controllers\\DmXaPhuongController@dmXaPhuong', '', '', 1, '2021-02-01 09:49:23', '2021-02-19 07:51:52', 'dm-xa-phuong', 1, 1, 6, '<i class="menu-icon icon-location-pin"></i>'),
	(615, 'Nút import danh mục phường xã', 'POST | App\\Modules\\DmXaPhuong\\Controllers\\DmXaPhuongController@dmXaPhuongAndImport', 'POST', 'App\\Modules\\DmXaPhuong\\Controllers\\DmXaPhuongController@dmXaPhuongAndImport', '', '', 614, '2021-02-01 09:49:23', '2021-02-19 07:51:52', 'dm-xa-phuong/import', 1, 2, 1000, NULL),
	(616, 'Nhóm quyền', 'GET | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@nhomQuyen', 'GET', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@nhomQuyen', '', '', 1, '2021-02-01 09:49:23', '2021-02-19 07:51:52', 'nhom-quyen', 1, 1, 7, '<i class="menu-icon icon-people"></i>'),
	(617, 'Phân quyền', 'GET | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyen', 'GET', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyen', '', '', 1, '2021-02-01 09:49:23', '2021-02-19 07:51:53', 'phan-quyen', 1, 1, 8, '<i class="menu-icon fa fa-sitemap"></i>'),
	(618, 'Danh sách chức năng', 'GET | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyen', 'GET', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyen', '', '', 1, '2021-02-01 09:49:23', '2021-02-19 07:51:53', 'tai-nguyen', 1, 1, 5, '<i class="menu-icon icon-list"></i>'),
	(620, 'Quét tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@quetTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@quetTaiNguyen', '', '', 618, '2021-02-01 09:49:23', '2021-02-19 07:51:53', 'quet-tai-nguyen', 1, 2, 1000, NULL),
	(621, 'Thêm một tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@themTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@themTaiNguyen', '', '', 618, '2021-02-01 09:49:23', '2021-02-19 07:51:53', 'them-tai-nguyen', 1, 2, 1000, NULL),
	(623, 'Sửa tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@capNhatTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@capNhatTaiNguyen', '', '', 618, '2021-02-01 09:49:23', '2021-02-19 07:51:53', 'cap-nhat-tai-nguyen', 1, 2, 1000, NULL),
	(624, 'Xóa tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@xoaTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@xoaTaiNguyen', '', '', 618, '2021-02-01 09:49:23', '2021-02-19 07:51:53', 'xoa-tai-nguyen', 1, 2, 1000, NULL),
	(626, 'Xem danh sách quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@danhSachNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@danhSachNhomQuyen', '', '', 616, '2021-02-02 07:59:22', '2021-02-19 07:51:52', 'danh-sach-nhom-quyen', 1, 2, 1000, NULL),
	(627, 'Thêm nhóm quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@themNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@themNhomQuyen', '', '', 616, '2021-02-02 07:59:22', '2021-02-19 07:51:52', 'them-nhom-quyen', 1, 2, 1000, NULL),
	(629, 'Cập nhật nhóm quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@capNhatNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@capNhatNhomQuyen', '', '', 616, '2021-02-02 07:59:22', '2021-02-19 07:51:52', 'cap-nhat-nhom-quyen', 1, 2, 1000, NULL),
	(630, 'Xóa nhóm quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@xoaNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@xoaNhomQuyen', '', '', 616, '2021-02-02 07:59:22', '2021-02-19 07:51:52', 'xoa-nhom-quyen', 1, 2, 1000, NULL),
	(631, 'Phân quyền', 'POST | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenPost', 'POST', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenPost', '', '', 617, '2021-02-02 07:59:22', '2021-02-19 07:51:53', 'phan-quyen-post', 1, 2, 1000, NULL),
	(632, 'Danh sách nhóm quyền (Phân quyền)', 'POST | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachNhomQuyen', 'POST', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachNhomQuyen', '', '', 617, '2021-02-02 07:59:22', '2021-02-19 07:51:53', 'phan-quyen/danh-sach-nhom-quyen', 1, 2, 1000, NULL),
	(633, 'Danh sách quyền theo nhóm quyền (Phân quyền)', 'POST | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachQuyenTheoNhomQuyenId', 'POST', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachQuyenTheoNhomQuyenId', '', '', 617, '2021-02-02 07:59:22', '2021-02-19 07:51:53', 'phan-quyen/danh-sach-quyen-theo-nhom-quyen-id', 1, 2, 1000, NULL),
	(636, 'Danh mục đơn vị', 'GET | App\\Modules\\DonVi\\Controllers\\DonViController@donVi', 'GET', 'App\\Modules\\DonVi\\Controllers\\DonViController@donVi', '', '', 1, '2021-02-02 15:38:41', '2021-02-19 07:51:52', 'don-vi', 1, 1, 6, '<i class="menu-icon fa fa-cubes"></i>'),
	(637, 'Xem danh sách đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@danhSachDonVi', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@danhSachDonVi', '', '', 636, '2021-02-02 15:38:41', '2021-02-19 07:51:52', 'danh-sach-don-vi', 1, 2, 1000, NULL),
	(638, 'Thêm đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@themDonVi', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@themDonVi', '', '', 636, '2021-02-02 15:38:41', '2021-02-19 07:51:52', 'them-don-vi', 1, 2, 1000, NULL),
	(640, 'Cập nhật đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@capNhatDonVi', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@capNhatDonVi', '', '', 636, '2021-02-02 15:38:41', '2021-02-19 07:51:52', 'cap-nhat-don-vi', 1, 2, 1000, NULL),
	(641, 'Xóa đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@xoaDonVi', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@xoaDonVi', '', '', 636, '2021-02-02 15:38:41', '2021-02-19 07:51:52', 'xoa-don-vi', 1, 2, 1000, NULL),
	(642, 'Đơn vị single', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@donViSingle', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@donViSingle', '', '', 636, '2021-02-04 13:30:50', '2021-02-19 07:51:52', 'don-vi-single', 1, 2, 1000, NULL),
	(643, 'To do', 'GET | App\\Modules\\ToDo\\Controllers\\ToDoController@toDo', 'GET', 'App\\Modules\\ToDo\\Controllers\\ToDoController@toDo', '', '', 653, '2021-02-04 13:30:50', '2021-02-19 07:51:53', 'to-do', 1, 1, 7, '<i class="icon-clock menu-icon"></i>'),
	(644, 'Danh sách to do', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@danhSachToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@danhSachToDo', '', '', 653, '2021-02-04 13:30:50', '2021-02-19 07:51:53', 'danh-sach-to-do', 1, 2, 1000, NULL),
	(645, 'Thêm to do', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@themToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@themToDo', '', '', 653, '2021-02-04 13:30:50', '2021-02-19 07:51:53', 'them-to-do', 1, 2, 1000, NULL),
	(647, 'Cập nhật to do', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@capNhatToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@capNhatToDo', '', '', 653, '2021-02-04 13:30:50', '2021-02-19 07:51:53', 'cap-nhat-to-do', 1, 2, 1000, NULL),
	(648, 'Xóa to do', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@xoaToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@xoaToDo', '', '', 653, '2021-02-04 13:30:50', '2021-02-19 07:51:53', 'xoa-to-do', 1, 2, 1000, NULL),
	(651, 'Nhóm quyền single', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@nhomQuyenSingle', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@nhomQuyenSingle', '', '', 616, '2021-02-04 14:32:48', '2021-02-19 07:51:52', 'nhom-quyen-single', 1, 2, 1000, NULL),
	(652, 'To do single', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@toDoSingle', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@toDoSingle', '', '', 653, '2021-02-04 14:32:48', '2021-02-19 07:51:53', 'to-do-single', 1, 2, 1000, NULL),
	(653, 'To do', NULL, 'GET', NULL, NULL, NULL, 1, '2021-02-08 10:47:31', '2021-02-11 12:07:56', NULL, 1, 1, 8, '<i class="icon-clock menu-icon"></i>'),
	(661, 'Gửi PAYC', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@payc', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@payc', '', '', 1, '2021-02-11 12:53:18', '2021-02-19 07:51:52', 'payc', 1, 1, 1, '<i class="menu-icon fa fa-send"></i>'),
	(662, 'PAYC ẩn danh', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycAnDanh', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycAnDanh', '', '', 1, '2021-02-11 12:53:18', '2021-02-19 07:51:52', 'danh-sach-payc-an-danh', 1, 1, 3, '<i class="fa fa-list menu-icon"></i>'),
	(663, 'Thêm PAYC', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@themPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@themPayc', '', '', 661, '2021-02-11 12:53:18', '2021-02-19 07:51:53', 'them-payc', 1, 2, 1000, NULL),
	(664, 'Danh sách chức năng', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@danhSachTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@danhSachTaiNguyen', '', '', 618, '2021-02-11 12:53:18', '2021-02-19 07:51:53', 'danh-sach-tai-nguyen', 1, 2, 1000, NULL),
	(665, 'Tài nguyên Single', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyenSingle', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyenSingle', '', '', 618, '2021-02-11 12:53:18', '2021-02-19 07:51:53', 'tai-nguyen-single', 1, 2, 1000, NULL),
	(666, 'Trang chủ', 'GET | App\\Modules\\TrangChu\\Controllers\\TrangChuController@home', 'GET', 'App\\Modules\\TrangChu\\Controllers\\TrangChuController@home', '', '', 1, '2021-02-11 12:53:18', '2021-02-19 07:51:53', '/', 1, 2, 1000, '<i class="fa fa-home menu-icon"></i>'),
	(667, 'PAYC của tôi', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycCuaToi', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycCuaToi', '', '', 1, '2021-02-11 18:17:59', '2021-02-19 07:51:52', 'danh-sach-payc-cua-toi', 1, 1, 2, '<i class="icon-briefcase menu-icon"></i>'),
	(668, 'PAYC chờ tiếp nhận', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoTiepNhan', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoTiepNhan', '', '', 684, '2021-02-14 18:42:02', '2021-02-19 07:51:52', 'danh-sach-payc-cho-tiep-nhan', 1, 1, 1000, NULL),
	(669, 'danh-sach-payc-da-tiep-nhan', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycDaTiepNhan', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycDaTiepNhan', '', '', 1, '2021-02-14 20:05:42', '2021-02-19 07:51:52', 'danh-sach-payc-da-tiep-nhan', 1, 1, 1000, NULL),
	(670, 'danh-sach-payc-da-hoan-tat', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycDaHoanTat', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycDaHoanTat', '', '', 1, '2021-02-14 20:05:42', '2021-02-19 07:51:52', 'danh-sach-payc-da-hoan-tat', 1, 1, 1000, NULL),
	(671, 'danh-sach-payc-da-chuyen-xu-ly', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycDaChuyenXuLy', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycDaChuyenXuLy', '', '', 1, '2021-02-14 20:05:42', '2021-02-19 07:51:53', 'danh-sach-payc-da-chuyen-xu-ly', 1, 1, 1000, NULL),
	(672, 'danh-sach-payc-dang-xu-ly', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycDangXuLy', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycDangXuLy', '', '', 1, '2021-02-14 20:05:42', '2021-02-19 07:51:53', 'danh-sach-payc-dang-xu-ly', 1, 1, 1000, NULL),
	(673, 'danh-sach-payc-da-chuyen-lanh-dao-duyet', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycDaChuyenLanhDaoDuyet', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycDaChuyenLanhDaoDuyet', '', '', 1, '2021-02-14 20:05:42', '2021-02-19 07:51:53', 'danh-sach-payc-da-chuyen-lanh-dao-duyet', 1, 1, 1000, NULL),
	(674, 'danh-sach-payc-da-chuyen-lanh-dao-khac-duyet', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycDaChuyenLanhDaoKhacDuyet', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycDaChuyenLanhDaoKhacDuyet', '', '', 1, '2021-02-14 20:05:42', '2021-02-19 07:51:53', 'danh-sach-payc-da-chuyen-lanh-dao-khac-duyet', 1, 1, 1000, NULL),
	(675, 'danh-sach-payc-cho-duyet', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoDuyet', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoDuyet', '', '', 1, '2021-02-14 20:05:42', '2021-02-19 07:51:53', 'danh-sach-payc-cho-duyet', 1, 1, 1000, NULL),
	(676, 'danh-sach-payc-da-duyet', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycDaDuyet', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycDaDuyet', '', '', 1, '2021-02-14 20:05:42', '2021-02-19 07:51:53', 'danh-sach-payc-da-duyet', 1, 1, 1000, NULL),
	(677, 'danh-sach-payc-tra-lai-buoc-tiep-nhan', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycTraLaiBuocTiepNhan', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycTraLaiBuocTiepNhan', '', '', 1, '2021-02-14 20:05:42', '2021-02-19 07:51:53', 'danh-sach-payc-tra-lai-buoc-tiep-nhan', 1, 1, 1000, NULL),
	(678, 'danh-sach-payc-tra-lai-can-bo-xu-ly', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycTraLaiCanBoXuLy', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycTraLaiCanBoXuLy', '', '', 1, '2021-02-14 20:05:42', '2021-02-19 07:51:53', 'danh-sach-payc-tra-lai-can-bo-xu-ly', 1, 1, 1000, NULL),
	(679, 'danh-sach-payc-da-huy', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycDaHuy', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycDaHuy', '', '', 1, '2021-02-14 20:05:42', '2021-02-19 07:51:53', 'danh-sach-payc-da-huy', 1, 1, 1000, NULL),
	(680, 'danh-sach-payc-cho-khach-hang-danh-gia', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoKhachHangDanhGia', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoKhachHangDanhGia', '', '', 1, '2021-02-14 20:05:42', '2021-02-19 07:51:53', 'danh-sach-payc-cho-khach-hang-danh-gia', 1, 1, 1000, NULL),
	(681, 'danh-sach-payc-cho-lanh-dao-danh-gia', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoLanhDaoDanhGia', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoLanhDaoDanhGia', '', '', 1, '2021-02-14 20:05:42', '2021-02-19 07:51:53', 'danh-sach-payc-cho-lanh-dao-danh-gia', 1, 1, 1000, NULL),
	(682, 'danh-sach-payc-cho-can-bo-danh-gia', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoCanBoDanhGia', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoCanBoDanhGia', '', '', 1, '2021-02-14 20:05:42', '2021-02-19 07:51:53', 'danh-sach-payc-cho-can-bo-danh-gia', 1, 1, 1000, NULL),
	(684, 'Xử lý PAYC', NULL, 'GET', NULL, NULL, NULL, 1, '2021-02-18 16:04:30', '2021-02-19 07:46:26', NULL, 1, 1, 4, '<i class="icon-calculator menu-icon"></i>'),
	(685, 'danh-sach-payc-cho-cap-nhat', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoCapNhat', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoCapNhat', '', '', 1, '2021-02-19 07:51:53', '2021-02-19 07:51:53', 'danh-sach-payc-cho-cap-nhat', 1, 1, 1000, NULL);
/*!40000 ALTER TABLE `admin_resource` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

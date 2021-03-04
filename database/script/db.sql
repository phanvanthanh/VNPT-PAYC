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
  KEY `admin_resource_parent_foreign` (`parent_id`),
  CONSTRAINT `admin_resource_parent_foreign` FOREIGN KEY (`parent_id`) REFERENCES `admin_resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=712 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.admin_resource: ~78 rows (approximately)
/*!40000 ALTER TABLE `admin_resource` DISABLE KEYS */;
INSERT INTO `admin_resource` (`id`, `ten_hien_thi`, `resource`, `method`, `action`, `parameter`, `parameter_value`, `parent_id`, `created_at`, `updated_at`, `uri`, `status`, `show_menu`, `order`, `icon`) VALUES
	(1, 'Root', 'Root', 'GET', '#', '#', '#', NULL, '2021-02-01 09:49:23', '2021-02-02 08:33:17', '#', 1, 1, 0, NULL),
	(601, 'Đăng nhập', 'GET | App\\Http\\Controllers\\Auth\\LoginController@showLoginForm', 'GET', 'App\\Http\\Controllers\\Auth\\LoginController@showLoginForm', '', '', 1, '2021-02-01 09:49:23', '2021-02-25 11:42:34', 'login', 1, 2, 1000, '<i class="icon-login"></i>'),
	(602, 'Nút đăng nhập', 'POST | App\\Http\\Controllers\\Auth\\LoginController@login', 'POST', 'App\\Http\\Controllers\\Auth\\LoginController@login', '', '', 601, '2021-02-01 09:49:23', '2021-02-25 11:42:34', 'login', 1, 2, 1000, NULL),
	(603, 'Đăng xuất', 'POST | App\\Http\\Controllers\\Auth\\LoginController@logout', 'POST', 'App\\Http\\Controllers\\Auth\\LoginController@logout', '', '', 1, '2021-02-01 09:49:23', '2021-02-25 11:42:34', 'logout', 1, 2, 1000, '<i class="icon-logout"></i>'),
	(604, 'Đăng ký', 'GET | App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm', 'GET', 'App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm', '', '', 1, '2021-02-01 09:49:23', '2021-02-25 11:42:34', 'register', 1, 2, 1000, '<i class="icon-user-following mx-0"></i>'),
	(605, 'Nút đăng ký', 'POST | App\\Http\\Controllers\\Auth\\RegisterController@register', 'POST', 'App\\Http\\Controllers\\Auth\\RegisterController@register', '', '', 604, '2021-02-01 09:49:23', '2021-02-25 11:42:34', 'register', 1, 2, 1000, NULL),
	(606, 'Reset mật khẩu', 'GET | App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm', 'GET', 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm', '', '', 1, '2021-02-01 09:49:23', '2021-02-25 11:42:34', 'password/reset', 1, 2, 1000, '<i class="icon-key mx-0"></i>'),
	(607, 'Xác thực email', 'POST | App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail', 'POST', 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail', '', '', 606, '2021-02-01 09:49:23', '2021-02-25 11:42:34', 'password/email', 1, 2, 1000, NULL),
	(608, 'Lấy token reset mật khẩu', 'GET | App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm', 'GET', 'App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm', '', '', 606, '2021-02-01 09:49:23', '2021-02-25 11:42:34', 'password/reset/{token}', 1, 2, 1000, NULL),
	(609, 'Reset lại mật khẩu', 'POST | App\\Http\\Controllers\\Auth\\ResetPasswordController@reset', 'POST', 'App\\Http\\Controllers\\Auth\\ResetPasswordController@reset', '', '', 606, '2021-02-01 09:49:23', '2021-02-25 11:42:34', 'password/reset', 1, 2, 1000, NULL),
	(610, 'Xác nhận lại mật khẩu', 'GET | App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm', 'GET', 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm', '', '', 606, '2021-02-01 09:49:23', '2021-02-25 11:42:34', 'password/confirm', 1, 2, 1000, NULL),
	(611, 'Xác nhận lại mật khẩu lần 2', 'POST | App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm', 'POST', 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm', '', '', 606, '2021-02-01 09:49:23', '2021-02-25 11:42:34', 'password/confirm', 1, 2, 1000, NULL),
	(612, 'Danh mục quận huyện', 'GET | App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyen', 'GET', 'App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyen', '', '', 1, '2021-02-01 09:49:23', '2021-02-25 11:42:34', 'dm-quan-huyen', 1, 1, 6, '<i class="menu-icon icon-location-pin"></i>'),
	(613, 'Nút import danh mục quận huyện', 'POST | App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyenAndImport', 'POST', 'App\\Modules\\DmQuanHuyen\\Controllers\\DmQuanHuyenController@dmQuanHuyenAndImport', '', '', 612, '2021-02-01 09:49:23', '2021-02-25 11:42:34', 'dm-quan-huyen/import', 1, 2, 1000, NULL),
	(614, 'Danh mục phường xã', 'GET | App\\Modules\\DmXaPhuong\\Controllers\\DmXaPhuongController@dmXaPhuong', 'GET', 'App\\Modules\\DmXaPhuong\\Controllers\\DmXaPhuongController@dmXaPhuong', '', '', 1, '2021-02-01 09:49:23', '2021-02-25 11:42:34', 'dm-xa-phuong', 1, 1, 6, '<i class="menu-icon icon-location-pin"></i>'),
	(615, 'Nút import danh mục phường xã', 'POST | App\\Modules\\DmXaPhuong\\Controllers\\DmXaPhuongController@dmXaPhuongAndImport', 'POST', 'App\\Modules\\DmXaPhuong\\Controllers\\DmXaPhuongController@dmXaPhuongAndImport', '', '', 614, '2021-02-01 09:49:23', '2021-02-25 11:42:34', 'dm-xa-phuong/import', 1, 2, 1000, NULL),
	(616, 'Nhóm quyền', 'GET | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@nhomQuyen', 'GET', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@nhomQuyen', '', '', 1, '2021-02-01 09:49:23', '2021-02-25 11:42:34', 'nhom-quyen', 1, 1, 7, '<i class="menu-icon icon-people"></i>'),
	(617, 'Phân quyền', 'GET | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyen', 'GET', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyen', '', '', 1, '2021-02-01 09:49:23', '2021-02-25 11:42:34', 'phan-quyen', 1, 1, 8, '<i class="menu-icon fa fa-sitemap"></i>'),
	(618, 'Danh sách chức năng', 'GET | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyen', 'GET', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyen', '', '', 1, '2021-02-01 09:49:23', '2021-02-25 11:42:34', 'tai-nguyen', 1, 1, 5, '<i class="menu-icon icon-list"></i>'),
	(620, 'Quét tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@quetTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@quetTaiNguyen', '', '', 618, '2021-02-01 09:49:23', '2021-02-25 11:42:34', 'quet-tai-nguyen', 1, 2, 1000, NULL),
	(621, 'Thêm một tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@themTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@themTaiNguyen', '', '', 618, '2021-02-01 09:49:23', '2021-02-25 11:42:34', 'them-tai-nguyen', 1, 2, 1000, NULL),
	(623, 'Sửa tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@capNhatTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@capNhatTaiNguyen', '', '', 618, '2021-02-01 09:49:23', '2021-02-25 11:42:34', 'cap-nhat-tai-nguyen', 1, 2, 1000, NULL),
	(624, 'Xóa tài nguyên', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@xoaTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@xoaTaiNguyen', '', '', 618, '2021-02-01 09:49:23', '2021-02-25 11:42:34', 'xoa-tai-nguyen', 1, 2, 1000, NULL),
	(626, 'Xem danh sách quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@danhSachNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@danhSachNhomQuyen', '', '', 616, '2021-02-02 07:59:22', '2021-02-25 11:42:34', 'danh-sach-nhom-quyen', 1, 2, 1000, NULL),
	(627, 'Thêm nhóm quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@themNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@themNhomQuyen', '', '', 616, '2021-02-02 07:59:22', '2021-02-25 11:42:34', 'them-nhom-quyen', 1, 2, 1000, NULL),
	(629, 'Cập nhật nhóm quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@capNhatNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@capNhatNhomQuyen', '', '', 616, '2021-02-02 07:59:22', '2021-02-25 11:42:34', 'cap-nhat-nhom-quyen', 1, 2, 1000, NULL),
	(630, 'Xóa nhóm quyền', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@xoaNhomQuyen', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@xoaNhomQuyen', '', '', 616, '2021-02-02 07:59:22', '2021-02-25 11:42:34', 'xoa-nhom-quyen', 1, 2, 1000, NULL),
	(631, 'Phân quyền', 'POST | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenPost', 'POST', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenPost', '', '', 617, '2021-02-02 07:59:22', '2021-02-25 11:42:34', 'phan-quyen-post', 1, 2, 1000, NULL),
	(632, 'Danh sách nhóm quyền (Phân quyền)', 'POST | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachNhomQuyen', 'POST', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachNhomQuyen', '', '', 617, '2021-02-02 07:59:22', '2021-02-25 11:42:34', 'phan-quyen/danh-sach-nhom-quyen', 1, 2, 1000, NULL),
	(633, 'Danh sách quyền theo nhóm quyền (Phân quyền)', 'POST | App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachQuyenTheoNhomQuyenId', 'POST', 'App\\Modules\\PhanQuyen\\Controllers\\PhanQuyenController@phanQuyenDanhSachQuyenTheoNhomQuyenId', '', '', 617, '2021-02-02 07:59:22', '2021-02-25 11:42:34', 'phan-quyen/danh-sach-quyen-theo-nhom-quyen-id', 1, 2, 1000, NULL),
	(636, 'Danh mục đơn vị', 'GET | App\\Modules\\DonVi\\Controllers\\DonViController@donVi', 'GET', 'App\\Modules\\DonVi\\Controllers\\DonViController@donVi', '', '', 1, '2021-02-02 15:38:41', '2021-02-25 11:42:34', 'don-vi', 1, 1, 6, '<i class="menu-icon fa fa-cubes"></i>'),
	(637, 'Xem danh sách đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@danhSachDonVi', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@danhSachDonVi', '', '', 636, '2021-02-02 15:38:41', '2021-02-25 11:42:34', 'danh-sach-don-vi', 1, 2, 1000, NULL),
	(638, 'Thêm đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@themDonVi', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@themDonVi', '', '', 636, '2021-02-02 15:38:41', '2021-02-25 11:42:34', 'them-don-vi', 1, 2, 1000, NULL),
	(640, 'Cập nhật đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@capNhatDonVi', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@capNhatDonVi', '', '', 636, '2021-02-02 15:38:41', '2021-02-25 11:42:34', 'cap-nhat-don-vi', 1, 2, 1000, NULL),
	(641, 'Xóa đơn vị', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@xoaDonVi', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@xoaDonVi', '', '', 636, '2021-02-02 15:38:41', '2021-02-25 11:42:34', 'xoa-don-vi', 1, 2, 1000, NULL),
	(642, 'Đơn vị single', 'POST | App\\Modules\\DonVi\\Controllers\\DonViController@donViSingle', 'POST', 'App\\Modules\\DonVi\\Controllers\\DonViController@donViSingle', '', '', 636, '2021-02-04 13:30:50', '2021-02-25 11:42:34', 'don-vi-single', 1, 2, 1000, NULL),
	(643, 'To do', 'GET | App\\Modules\\ToDo\\Controllers\\ToDoController@toDo', 'GET', 'App\\Modules\\ToDo\\Controllers\\ToDoController@toDo', '', '', 653, '2021-02-04 13:30:50', '2021-02-25 11:42:34', 'to-do', 1, 1, 7, '<i class="icon-clock menu-icon"></i>'),
	(644, 'Danh sách to do', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@danhSachToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@danhSachToDo', '', '', 653, '2021-02-04 13:30:50', '2021-02-25 11:42:34', 'danh-sach-to-do', 1, 2, 1000, NULL),
	(645, 'Thêm to do', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@themToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@themToDo', '', '', 653, '2021-02-04 13:30:50', '2021-02-25 11:42:34', 'them-to-do', 1, 2, 1000, NULL),
	(647, 'Cập nhật to do', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@capNhatToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@capNhatToDo', '', '', 653, '2021-02-04 13:30:50', '2021-02-25 11:42:34', 'cap-nhat-to-do', 1, 2, 1000, NULL),
	(648, 'Xóa to do', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@xoaToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@xoaToDo', '', '', 653, '2021-02-04 13:30:50', '2021-02-25 11:42:34', 'xoa-to-do', 1, 2, 1000, NULL),
	(651, 'Nhóm quyền single', 'POST | App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@nhomQuyenSingle', 'POST', 'App\\Modules\\NhomQuyen\\Controllers\\NhomQuyenController@nhomQuyenSingle', '', '', 616, '2021-02-04 14:32:48', '2021-02-25 11:42:34', 'nhom-quyen-single', 1, 2, 1000, NULL),
	(652, 'To do single', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@toDoSingle', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@toDoSingle', '', '', 653, '2021-02-04 14:32:48', '2021-02-25 11:42:34', 'to-do-single', 1, 2, 1000, NULL),
	(653, 'To do', NULL, 'GET', NULL, NULL, NULL, 1, '2021-02-08 10:47:31', '2021-02-11 12:07:56', NULL, 1, 1, 8, '<i class="icon-clock menu-icon"></i>'),
	(661, 'Gửi PAYC', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@payc', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@payc', '', '', 1, '2021-02-11 12:53:18', '2021-02-25 11:42:34', 'payc', 1, 1, 1, '<i class="menu-icon fa fa-send"></i>'),
	(662, 'PAYC ẩn danh', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycAnDanh', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycAnDanh', '', '', 1, '2021-02-11 12:53:18', '2021-02-25 11:42:34', 'danh-sach-payc-an-danh', 1, 1, 3, '<i class="fa fa-list menu-icon"></i>'),
	(663, 'Thêm PAYC', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@themPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@themPayc', '', '', 661, '2021-02-11 12:53:18', '2021-02-25 11:42:34', 'them-payc', 1, 2, 1000, NULL),
	(664, 'Danh sách chức năng', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@danhSachTaiNguyen', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@danhSachTaiNguyen', '', '', 618, '2021-02-11 12:53:18', '2021-02-25 11:42:34', 'danh-sach-tai-nguyen', 1, 2, 1000, NULL),
	(665, 'Tài nguyên Single', 'POST | App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyenSingle', 'POST', 'App\\Modules\\TaiNguyen\\Controllers\\TaiNguyenController@taiNguyenSingle', '', '', 618, '2021-02-11 12:53:18', '2021-02-25 11:42:34', 'tai-nguyen-single', 1, 2, 1000, NULL),
	(666, 'Trang chủ', 'GET | App\\Modules\\TrangChu\\Controllers\\TrangChuController@home', 'GET', 'App\\Modules\\TrangChu\\Controllers\\TrangChuController@home', '', '', 1, '2021-02-11 12:53:18', '2021-02-25 11:42:34', '/', 1, 2, 1000, '<i class="fa fa-home menu-icon"></i>'),
	(667, 'PAYC của tôi', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycCuaToi', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycCuaToi', '', '', 1, '2021-02-11 18:17:59', '2021-02-25 11:42:34', 'danh-sach-payc-cua-toi', 1, 1, 2, '<i class="icon-briefcase menu-icon"></i>'),
	(668, 'PAYC chờ tiếp nhận', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoTiepNhan', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoTiepNhan', '', '', 684, '2021-02-14 18:42:02', '2021-02-25 11:42:34', 'danh-sach-payc-cho-tiep-nhan', 1, 1, 1000, NULL),
	(684, 'Xử lý PAYC', NULL, 'GET', NULL, NULL, NULL, 1, '2021-02-18 16:04:30', '2021-02-19 07:46:26', NULL, 1, 1, 4, '<i class="icon-calculator menu-icon"></i>'),
	(686, 'frm-tiep-nhan-va-chuyen-xu-ly', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmTiepNhanVaChuyenXuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmTiepNhanVaChuyenXuLy', '', '', 1, '2021-02-24 20:48:15', '2021-02-25 11:42:34', 'frm-tiep-nhan-va-chuyen-xu-ly', 1, 2, 1000, NULL),
	(687, 'tiep-nhan-va-chuyen-xu-ly', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@tiepNhanVaChuyenXuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@tiepNhanVaChuyenXuLy', '', '', 1, '2021-02-24 20:48:15', '2021-02-25 11:42:34', 'tiep-nhan-va-chuyen-xu-ly', 1, 2, 1000, NULL),
	(688, 'frm-chuyen-lanh-dao', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmChuyenLanhDao', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmChuyenLanhDao', '', '', 1, '2021-02-24 20:48:15', '2021-02-25 11:42:34', 'frm-chuyen-lanh-dao', 1, 2, 1000, NULL),
	(689, 'chuyen-lanh-dao', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@chuyenLanhDao', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@chuyenLanhDao', '', '', 1, '2021-02-24 20:48:15', '2021-02-25 11:42:34', 'chuyen-lanh-dao', 1, 2, 1000, NULL),
	(690, 'frm-hoan-tat', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmHoanTat', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmHoanTat', '', '', 1, '2021-02-24 20:48:15', '2021-02-25 11:42:34', 'frm-hoan-tat', 1, 2, 1000, NULL),
	(691, 'hoan-tat', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@hoanTat', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@hoanTat', '', '', 1, '2021-02-24 20:48:15', '2021-02-25 11:42:34', 'hoan-tat', 1, 2, 1000, NULL),
	(692, 'frm-tra-lai-khong-xu-ly', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmTraLaiKhongXuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmTraLaiKhongXuLy', '', '', 1, '2021-02-24 20:48:15', '2021-02-25 11:42:34', 'frm-tra-lai-khong-xu-ly', 1, 2, 1000, NULL),
	(693, 'tra-lai-khong-xu-ly', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@traLaiKhongXuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@traLaiKhongXuLy', '', '', 1, '2021-02-24 20:48:15', '2021-02-25 11:42:34', 'tra-lai-khong-xu-ly', 1, 2, 1000, NULL),
	(694, 'frm-huy', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmHuy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmHuy', '', '', 1, '2021-02-24 20:48:15', '2021-02-25 11:42:34', 'frm-huy', 1, 2, 1000, NULL),
	(695, 'huy', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@huy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@huy', '', '', 1, '2021-02-24 20:48:15', '2021-02-25 11:42:34', 'huy', 1, 2, 1000, NULL),
	(696, 'frm-cap-nhat-payc', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmCapNhatPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmCapNhatPayc', '', '', 1, '2021-02-24 20:48:15', '2021-02-25 11:42:34', 'frm-cap-nhat-payc', 1, 2, 1000, NULL),
	(697, 'cap-nhat-payc', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@capNhatPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@capNhatPayc', '', '', 1, '2021-02-24 20:48:15', '2021-02-25 11:42:34', 'cap-nhat-payc', 1, 2, 1000, NULL),
	(698, 'Danh sách chờ xử lý', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoXuLy', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoXuLy', '', '', 684, '2021-02-24 20:48:15', '2021-02-25 11:42:34', 'danh-sach-payc-cho-xu-ly', 1, 1, 1000, NULL),
	(699, 'qtxl', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@qtxl', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@qtxl', '', '', 1, '2021-02-24 20:48:15', '2021-02-25 11:42:34', 'qtxl', 1, 2, 1000, NULL),
	(700, 'xu-ly-to-do', 'GET | App\\Modules\\ToDo\\Controllers\\ToDoController@xuLyToDo', 'GET', 'App\\Modules\\ToDo\\Controllers\\ToDoController@xuLyToDo', '', '', 1, '2021-02-24 20:48:15', '2021-02-25 11:42:34', 'xu-ly-to-do', 1, 1, 1000, NULL),
	(701, 'check-to-do', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@checkToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@checkToDo', '', '', 1, '2021-02-24 20:48:15', '2021-02-25 11:42:34', 'check-to-do', 1, 2, 1000, NULL),
	(702, 'uncheck-to-do', 'POST | App\\Modules\\ToDo\\Controllers\\ToDoController@uncheckToDo', 'POST', 'App\\Modules\\ToDo\\Controllers\\ToDoController@uncheckToDo', '', '', 1, '2021-02-24 20:48:15', '2021-02-25 11:42:34', 'uncheck-to-do', 1, 2, 1000, NULL),
	(703, 'frm-xu-ly', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmXuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmXuLy', '', '', 1, '2021-02-25 06:36:31', '2021-02-25 11:42:34', 'frm-xu-ly', 1, 2, 1000, NULL),
	(704, 'xu-ly', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@xuLy', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@xuLy', '', '', 1, '2021-02-25 06:36:31', '2021-02-25 11:42:34', 'xu-ly', 1, 2, 1000, NULL),
	(705, 'Danh sách chờ duyệt', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoDuyet', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycChoDuyet', '', '', 684, '2021-02-25 06:36:31', '2021-02-25 11:42:34', 'danh-sach-payc-cho-duyet', 1, 1, 1000, NULL),
	(706, 'frm-duyet', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmDuyet', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmDuyet', '', '', 1, '2021-02-25 06:36:31', '2021-02-25 11:42:34', 'frm-duyet', 1, 2, 1000, NULL),
	(707, 'duyet', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@duyet', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@duyet', '', '', 1, '2021-02-25 06:36:31', '2021-02-25 11:42:34', 'duyet', 1, 2, 1000, NULL),
	(708, 'frm-chuyen-bo-phan-tiep-nhan-va-xu-ly-payc', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@frmChuyenBoPhanTiepNhanVaXuLyPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@frmChuyenBoPhanTiepNhanVaXuLyPayc', '', '', 1, '2021-02-25 11:21:45', '2021-02-25 11:42:34', 'frm-chuyen-bo-phan-tiep-nhan-va-xu-ly-payc', 1, 2, 1000, NULL),
	(709, 'chuyen-bo-phan-tiep-nhan-va-xu-ly-payc', 'POST | App\\Modules\\Payc\\Controllers\\PaycController@chuyenBoPhanTiepNhanVaXuLyPayc', 'POST', 'App\\Modules\\Payc\\Controllers\\PaycController@chuyenBoPhanTiepNhanVaXuLyPayc', '', '', 1, '2021-02-25 11:21:45', '2021-02-25 11:42:34', 'chuyen-bo-phan-tiep-nhan-va-xu-ly-payc', 1, 2, 1000, NULL),
	(711, 'Danh sách đã hoàn tất', 'GET | App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycDaHoanTat', 'GET', 'App\\Modules\\Payc\\Controllers\\PaycController@danhSachPaycDaHoanTat', '', '', 684, '2021-02-25 11:42:34', '2021-02-25 11:42:57', 'danh-sach-payc-da-hoan-tat', 1, 1, 1000, NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `admin_rule_role_id_foreign` (`role_id`),
  KEY `admin_rule_resource_id_foreign` (`resource_id`),
  CONSTRAINT `admin_rule_resource_id_foreign` FOREIGN KEY (`resource_id`) REFERENCES `admin_resource` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `admin_rule_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `admin_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.admin_rule: ~42 rows (approximately)
/*!40000 ALTER TABLE `admin_rule` DISABLE KEYS */;
INSERT INTO `admin_rule` (`id`, `role_id`, `resource_id`, `created_at`, `updated_at`) VALUES
	(117, 1, 666, '2021-02-11 13:20:09', '2021-02-11 13:20:09'),
	(121, 2, 662, '2021-02-11 13:20:17', '2021-02-11 13:20:17'),
	(122, 2, 666, '2021-02-11 13:20:19', '2021-02-11 13:20:19'),
	(123, 2, 661, '2021-02-11 13:20:20', '2021-02-11 13:20:20'),
	(124, 2, 663, '2021-02-11 13:20:20', '2021-02-11 13:20:20'),
	(125, 2, 653, '2021-02-11 13:20:21', '2021-02-11 13:20:21'),
	(126, 2, 643, '2021-02-11 13:20:21', '2021-02-11 13:20:21'),
	(127, 2, 644, '2021-02-11 13:20:22', '2021-02-11 13:20:22'),
	(128, 2, 645, '2021-02-11 13:20:22', '2021-02-11 13:20:22'),
	(129, 2, 647, '2021-02-11 13:20:22', '2021-02-11 13:20:22'),
	(130, 2, 648, '2021-02-11 13:20:22', '2021-02-11 13:20:22'),
	(131, 2, 652, '2021-02-11 13:20:22', '2021-02-11 13:20:22'),
	(132, 2, 614, '2021-02-11 13:20:23', '2021-02-11 13:20:23'),
	(133, 2, 615, '2021-02-11 13:20:23', '2021-02-11 13:20:23'),
	(134, 2, 612, '2021-02-11 13:20:24', '2021-02-11 13:20:24'),
	(135, 2, 613, '2021-02-11 13:20:24', '2021-02-11 13:20:24'),
	(136, 2, 617, '2021-02-11 13:20:26', '2021-02-11 13:20:26'),
	(137, 2, 631, '2021-02-11 13:20:26', '2021-02-11 13:20:26'),
	(138, 2, 632, '2021-02-11 13:20:26', '2021-02-11 13:20:26'),
	(139, 2, 633, '2021-02-11 13:20:26', '2021-02-11 13:20:26'),
	(140, 2, 618, '2021-02-11 13:20:28', '2021-02-11 13:20:28'),
	(141, 2, 620, '2021-02-11 13:20:28', '2021-02-11 13:20:28'),
	(142, 2, 621, '2021-02-11 13:20:28', '2021-02-11 13:20:28'),
	(143, 2, 623, '2021-02-11 13:20:28', '2021-02-11 13:20:28'),
	(144, 2, 624, '2021-02-11 13:20:28', '2021-02-11 13:20:28'),
	(145, 2, 664, '2021-02-11 13:20:28', '2021-02-11 13:20:28'),
	(146, 2, 665, '2021-02-11 13:20:28', '2021-02-11 13:20:28'),
	(147, 2, 636, '2021-02-11 13:20:29', '2021-02-11 13:20:29'),
	(148, 2, 637, '2021-02-11 13:20:29', '2021-02-11 13:20:29'),
	(149, 2, 638, '2021-02-11 13:20:29', '2021-02-11 13:20:29'),
	(150, 2, 640, '2021-02-11 13:20:29', '2021-02-11 13:20:29'),
	(151, 2, 641, '2021-02-11 13:20:29', '2021-02-11 13:20:29'),
	(152, 2, 642, '2021-02-11 13:20:29', '2021-02-11 13:20:29'),
	(153, 2, 616, '2021-02-11 13:20:31', '2021-02-11 13:20:31'),
	(154, 2, 626, '2021-02-11 13:20:31', '2021-02-11 13:20:31'),
	(155, 2, 627, '2021-02-11 13:20:31', '2021-02-11 13:20:31'),
	(156, 2, 629, '2021-02-11 13:20:31', '2021-02-11 13:20:31'),
	(157, 2, 630, '2021-02-11 13:20:31', '2021-02-11 13:20:31'),
	(158, 2, 651, '2021-02-11 13:20:31', '2021-02-11 13:20:31'),
	(159, 1, 661, '2021-02-11 13:45:37', '2021-02-11 13:45:37'),
	(160, 1, 663, '2021-02-11 13:45:37', '2021-02-11 13:45:37'),
	(161, 1, 662, '2021-02-11 13:45:39', '2021-02-11 13:45:39');
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
  `id_nhom_chuc_vu` int(11) unsigned NOT NULL DEFAULT 1,
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
	(4, 4, 'Chuyên viên tiếp nhận', 1);
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
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
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
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_users` int(10) unsigned NOT NULL DEFAULT 1 COMMENT 'id người tạo',
  `ten_don_vi` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `dia_chi` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `co_dinh` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `di_dong` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 1,
  `state` int(11) NOT NULL DEFAULT 1 COMMENT '0: không hoạt động; 1: hoạt động',
  PRIMARY KEY (`id`),
  KEY `FK_don_vi_don_vi` (`parent_id`),
  KEY `order` (`order`),
  KEY `FK_don_vi_users` (`id_users`),
  CONSTRAINT `FK_don_vi_don_vi` FOREIGN KEY (`parent_id`) REFERENCES `don_vi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.don_vi: ~2 rows (approximately)
/*!40000 ALTER TABLE `don_vi` DISABLE KEYS */;
INSERT INTO `don_vi` (`id`, `id_users`, `ten_don_vi`, `dia_chi`, `email`, `co_dinh`, `di_dong`, `fax`, `parent_id`, `order`, `state`) VALUES
	(1, 1, 'Vãng lai (Không được xóa)', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1),
	(2, 1, 'Tỉnh Trà Vinh (Không được xóa)', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1);
/*!40000 ALTER TABLE `don_vi` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.nhom_chuc_vu
CREATE TABLE IF NOT EXISTS `nhom_chuc_vu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ten_nhom_chuc_vu` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loai_nhom_chuc_vu` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `state` int(11) NOT NULL DEFAULT 1,
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

-- Dumping structure for table vnptpayc.nhom_dich_vu
CREATE TABLE IF NOT EXISTS `nhom_dich_vu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten_nhom_dich_vu` varchar(200) DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT 1,
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
  `id_user_tao` int(10) unsigned NOT NULL,
  `id_dich_vu` int(11) DEFAULT NULL,
  `so_phieu` varchar(200) DEFAULT NULL,
  `tieu_de` varchar(200) NOT NULL,
  `noi_dung` longtext DEFAULT NULL,
  `file_payc` text DEFAULT NULL,
  `ngay_tao` datetime DEFAULT current_timestamp(),
  `han_xu_ly_mong_muon` datetime DEFAULT NULL,
  `han_xu_ly_duoc_giao` datetime DEFAULT NULL,
  `ngay_hoan_tat` datetime DEFAULT NULL,
  `trang_thai` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `FK_payc_users` (`id_user_tao`),
  KEY `FK_payc_dich_vu` (`id_dich_vu`),
  CONSTRAINT `FK_payc_dich_vu` FOREIGN KEY (`id_dich_vu`) REFERENCES `dich_vu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_payc_users` FOREIGN KEY (`id_user_tao`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.payc: ~0 rows (approximately)
/*!40000 ALTER TABLE `payc` DISABLE KEYS */;
INSERT INTO `payc` (`id`, `id_user_tao`, `id_dich_vu`, `so_phieu`, `tieu_de`, `noi_dung`, `file_payc`, `ngay_tao`, `han_xu_ly_mong_muon`, `han_xu_ly_duoc_giao`, `ngay_hoan_tat`, `trang_thai`) VALUES
	(49, 2, 1, '280221-0001', 'test 01', '<p><br></p>', NULL, '2021-02-28 05:33:38', '2021-02-28 17:00:00', NULL, NULL, 1);
/*!40000 ALTER TABLE `payc` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.payc_canbo_xuly_yeucau
CREATE TABLE IF NOT EXISTS `payc_canbo_xuly_yeucau` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_payc` int(11) NOT NULL,
  `id_user_xu_ly` int(10) unsigned NOT NULL,
  `id_xu_ly` int(11) NOT NULL,
  `noi_dung_xu_ly` longtext DEFAULT NULL,
  `ds_id_user_nhan` varchar(250) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.payc_canbo_xuly_yeucau: ~0 rows (approximately)
/*!40000 ALTER TABLE `payc_canbo_xuly_yeucau` DISABLE KEYS */;
INSERT INTO `payc_canbo_xuly_yeucau` (`id`, `id_payc`, `id_user_xu_ly`, `id_xu_ly`, `noi_dung_xu_ly`, `ds_id_user_nhan`, `file_xu_ly`, `ngay_xu_ly`, `state`) VALUES
	(107, 49, 2, 1, '', '', '', '2021-02-28 05:33:38', 0);
/*!40000 ALTER TABLE `payc_canbo_xuly_yeucau` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.to_do: ~10 rows (approximately)
/*!40000 ALTER TABLE `to_do` DISABLE KEYS */;
INSERT INTO `to_do` (`id`, `id_user`, `noi_dung`, `file`, `ngay_tao`, `ngay_giao`, `han_xu_ly`, `ngay_hoan_thanh`, `sap_xep`, `trang_thai`) VALUES
	(1, 2, 'test2', NULL, '2021-02-04 14:43:11', '2021-02-04 14:43:11', '2021-02-04 10:00:01', NULL, 0, 1),
	(3, 1, 'Công việc 1', NULL, '2021-02-18 08:07:39', '2021-02-18 08:07:39', '2021-03-01 10:00:00', '2021-02-19 16:16:34', 1, 0),
	(4, 1, 'Công việc 2', NULL, '2021-02-18 08:07:45', '2021-02-18 08:07:45', '2021-03-01 10:00:00', NULL, 6, 0),
	(5, 1, 'Công việc 3', NULL, '2021-02-18 08:07:51', '2021-02-18 08:07:51', '2021-03-01 10:00:00', '2021-02-22 10:06:35', 3, 1),
	(6, 1, 'Công việc 4', NULL, '2021-02-18 08:07:57', '2021-02-18 08:07:57', '2021-03-01 10:00:00', NULL, 7, 0),
	(7, 1, 'Công việc 5', NULL, '2021-02-18 08:08:06', '2021-02-18 08:08:06', '2021-03-01 10:00:00', NULL, 5, 0),
	(8, 1, 'Công việc 6', NULL, '2021-02-18 16:31:46', '2021-02-18 16:31:46', '2021-02-20 10:00:00', NULL, 2, 1),
	(9, 1, 'Công việc 7', NULL, '2021-02-18 16:32:31', '2021-02-18 16:32:31', NULL, NULL, 4, 1),
	(10, 1, 'Công việc 8', NULL, '2021-02-18 16:37:53', '2021-02-18 16:37:53', '2021-02-20 10:00:00', '2021-02-22 10:05:47', 8, 1),
	(12, 2, 'test', NULL, '2021-02-19 10:29:44', '2021-02-19 10:29:44', '2021-02-20 10:00:00', '2021-02-22 10:32:16', 9, 1);
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
  `state` int(11) DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table vnptpayc.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `hinh_anh`, `remember_token`, `created_at`, `updated_at`, `di_dong`, `state`) VALUES
	(1, 'guest@gmail.com', 'guest', '$2y$10$VZI0siYq7lRPvqt8e.QbXOWDBelj91YwJoLsEKx4GxbWH5XQb87xO', '/user.png', '35xOWSUdceM6lRhePiHS9Y3xwvvLupgJWeYIzh2FMjMl22RuUJURMmX7oElG', NULL, '2019-08-19 14:44:56', '0941138484', 1),
	(2, 'admin@gmail.com', 'admin', '$2y$10$VZI0siYq7lRPvqt8e.QbXOWDBelj91YwJoLsEKx4GxbWH5XQb87xO', '/user.png', 'oVDGK7bYHuVxkqS2Tr9htsF0N5RkmXAV3W0KlXYDeopVIdSzow98l3mcZaR9', NULL, '2021-02-11 12:11:27', '0941138484', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.users_chuc_vu
CREATE TABLE IF NOT EXISTS `users_chuc_vu` (
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.users_chuc_vu: ~0 rows (approximately)
/*!40000 ALTER TABLE `users_chuc_vu` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_chuc_vu` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Dumping data for table vnptpayc.users_dich_vu: ~3 rows (approximately)
/*!40000 ALTER TABLE `users_dich_vu` DISABLE KEYS */;
INSERT INTO `users_dich_vu` (`id`, `id_user`, `id_dich_vu`, `tu_ngay`, `den_ngay`, `state`) VALUES
	(8, 2, 1, NULL, NULL, 1),
	(10, 2, 2, NULL, NULL, 1),
	(11, 2, 3, NULL, NULL, 1);
/*!40000 ALTER TABLE `users_dich_vu` ENABLE KEYS */;

-- Dumping structure for table vnptpayc.users_don_vi
CREATE TABLE IF NOT EXISTS `users_don_vi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_don_vi` int(10) unsigned NOT NULL,
  `id_users` int(10) unsigned NOT NULL,
  `id_chuc_danh` int(10) unsigned NOT NULL DEFAULT 1,
  `id_chuc_vu` int(10) unsigned NOT NULL DEFAULT 1,
  `ngay_bat_dau_cong_tac` datetime DEFAULT current_timestamp(),
  `ngay_ket_thuc_cong_tac` datetime DEFAULT NULL,
  `state` int(10) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `FK_users_don_vi_users` (`id_users`),
  KEY `FK_users_don_vi_don_vi` (`id_don_vi`),
  KEY `FK_users_don_vi_chuc_danh` (`id_chuc_danh`),
  KEY `FK_users_don_vi_chuc_vu` (`id_chuc_vu`),
  CONSTRAINT `FK_users_don_vi_chuc_danh` FOREIGN KEY (`id_chuc_danh`) REFERENCES `nhom_chuc_vu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_users_don_vi_chuc_vu` FOREIGN KEY (`id_chuc_vu`) REFERENCES `chuc_vu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_users_don_vi_don_vi` FOREIGN KEY (`id_don_vi`) REFERENCES `don_vi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_users_don_vi_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table vnptpayc.users_don_vi: ~0 rows (approximately)
/*!40000 ALTER TABLE `users_don_vi` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_don_vi` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

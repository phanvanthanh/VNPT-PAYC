B1: Cài đặt MYSQL Server và MySql client comant line
B2: Mở MySql comant line và chạy lệnh sau:
CREATE USER 'root'@'desktop-seiegvj' IDENTIFIED WITH mysql_native_password BY 'lovebxTuyen@123';
CREATE USER 'root'@'10.90.199.229' IDENTIFIED WITH mysql_native_password BY 'lovebxTuyen@123';
GRANT ALL PRIVILEGES ON *.* TO 'root'@'desktop-seiegvj' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON *.* TO 'root'@'10.90.199.229' WITH GRANT OPTION;
CREATE USER 'root'@'%' IDENTIFIED WITH mysql_native_password BY 'lovebxTuyen@123';
GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' WITH GRANT OPTION;
#
CREATE DATABASE IF NOT EXISTS `vnptpayc` COLLATE 'utf8_general_ci' ;
GRANT ALL ON `vnptpayc`.* TO 'root'@'%' ;
FLUSH PRIVILEGES ;
B3: tạo kết nối server trong file .env
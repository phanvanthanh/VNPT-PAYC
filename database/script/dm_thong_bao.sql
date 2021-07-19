CREATE TABLE `dm_thong_bao` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`id_user_tao` INT(10) UNSIGNED NULL DEFAULT NULL,
	`noi_dung_thong_bao` LONGTEXT NULL DEFAULT NULL,
	`url_chi_tiet` VARCHAR(250) NULL DEFAULT NULL,
	`sap_xep` INT(11) NULL DEFAULT NULL,
	`state` INT(11) UNSIGNED NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`),
	INDEX `FK_thong_bao_users` (`id_user_tao`),
	CONSTRAINT `FK_thong_bao_users` FOREIGN KEY (`id_user_tao`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=12
;


CREATE TABLE `dm_thong_bao_users` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`id_user` INT(10) UNSIGNED NULL DEFAULT NULL,
	`id_thong_bao` INT(11) UNSIGNED NULL DEFAULT NULL,
	`is_da_xem` INT(11) NULL DEFAULT NULL,
	`ngay_gio_nhan` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`ngay_gio_xem` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`),
	INDEX `FK_users_thong_bao_users` (`id_user`),
	INDEX `FK_users_thong_bao_dm_thong_bao` (`id_thong_bao`),
	CONSTRAINT `FK_users_thong_bao_dm_thong_bao` FOREIGN KEY (`id_thong_bao`) REFERENCES `dm_thong_bao` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT `FK_users_thong_bao_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1693
;

CREATE TABLE `dm_link_quan_tri` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`id_user` INT(10) UNSIGNED NULL DEFAULT NULL,
	`id_dich_vu` INT(11) NULL DEFAULT NULL,
	`link_chuc_nang` VARCHAR(250) NULL DEFAULT NULL,
	`mo_ta` LONGTEXT NULL DEFAULT NULL,
	`ngay_tao` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
	`sap_xep` INT(11) NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	INDEX `FK_dm_link_quan_tri_users` (`id_user`),
	INDEX `FK_dm_link_quan_tri_dich_vu` (`id_dich_vu`),
	CONSTRAINT `FK_dm_link_quan_tri_dich_vu` FOREIGN KEY (`id_dich_vu`) REFERENCES `dich_vu` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT `FK_dm_link_quan_tri_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE SET NULL
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=4
;

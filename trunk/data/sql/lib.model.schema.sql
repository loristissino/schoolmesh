
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- track
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `track`;


CREATE TABLE `track`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`shortcut` VARCHAR(3),
	`description` VARCHAR(255)  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `track_I_1`(`shortcut`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- schoolclass
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `schoolclass`;


CREATE TABLE `schoolclass`
(
	`id` VARCHAR(5)  NOT NULL,
	`grade` INTEGER  NOT NULL,
	`section` VARCHAR(3)  NOT NULL,
	`track_id` INTEGER,
	`description` VARCHAR(255),
	PRIMARY KEY (`id`),
	INDEX `schoolclass_FI_1` (`track_id`),
	CONSTRAINT `schoolclass_FK_1`
		FOREIGN KEY (`track_id`)
		REFERENCES `track` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- year
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `year`;


CREATE TABLE `year`
(
	`id` INTEGER  NOT NULL,
	`description` VARCHAR(7),
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- subject
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `subject`;


CREATE TABLE `subject`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`shortcut` VARCHAR(3)  NOT NULL,
	`description` VARCHAR(255)  NOT NULL,
	`rank` INTEGER,
	PRIMARY KEY (`id`),
	KEY `subject_I_1`(`shortcut`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sf_guard_user_profile
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_user_profile`;


CREATE TABLE `sf_guard_user_profile`
(
	`user_id` INTEGER  NOT NULL,
	`first_name` VARCHAR(50),
	`middle_name` VARCHAR(50),
	`last_name` VARCHAR(50),
	`pronunciation` VARCHAR(100),
	`role_id` INTEGER,
	`gender` VARCHAR(1),
	`email` VARCHAR(50),
	`email_state` INTEGER default 0,
	`email_verification_code` VARCHAR(32),
	`birthdate` DATE,
	`birthplace` VARCHAR(50),
	`import_code` VARCHAR(20),
	`posix_uid` INTEGER,
	`disk_set_soft_blocks_quota` INTEGER default 0,
	`disk_set_hard_blocks_quota` INTEGER default 0,
	`disk_set_soft_files_quota` INTEGER default 0,
	`disk_set_hard_files_quota` INTEGER default 0,
	`disk_used_blocks` INTEGER default 0,
	`disk_used_files` INTEGER default 0,
	`disk_updated_at` DATETIME,
	`system_alerts` VARCHAR(255),
	`is_scheduled_for_deletion` TINYINT default 0,
	`googleapps_account_status` INTEGER,
	`googleapps_account_lastlogin_at` DATETIME,
	`googleapps_account_approved_at` DATETIME,
	`googleapps_account_temporary_password` VARCHAR(10),
	`moodle_account_status` INTEGER,
	`moodle_account_temporary_password` VARCHAR(10),
	`system_account_status` INTEGER,
	`system_account_is_locked` TINYINT,
	PRIMARY KEY (`user_id`),
	CONSTRAINT `sf_guard_user_profile_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `sf_guard_user_profile_FI_2` (`role_id`),
	CONSTRAINT `sf_guard_user_profile_FK_2`
		FOREIGN KEY (`role_id`)
		REFERENCES `role` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- account_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `account_type`;


CREATE TABLE `account_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	`description` TEXT,
	`style` VARCHAR(50),
	`is_external` TINYINT  NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `account_type_U_1` (`name`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- account
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `account`;


CREATE TABLE `account`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`account_type_id` INTEGER  NOT NULL,
	`info` TEXT,
	PRIMARY KEY (`id`),
	UNIQUE KEY `ua` (`user_id`, `account_type_id`),
	CONSTRAINT `account_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `account_FI_2` (`account_type_id`),
	CONSTRAINT `account_FK_2`
		FOREIGN KEY (`account_type_id`)
		REFERENCES `account_type` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- reserved_username
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `reserved_username`;


CREATE TABLE `reserved_username`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(20),
	PRIMARY KEY (`id`),
	KEY `reserved_username_I_1`(`username`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- appointment
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `appointment`;


CREATE TABLE `appointment`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`subject_id` INTEGER  NOT NULL,
	`schoolclass_id` VARCHAR(5)  NOT NULL,
	`year_id` INTEGER  NOT NULL,
	`state` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`import_code` VARCHAR(20),
	PRIMARY KEY (`id`),
	UNIQUE KEY `ussy` (`user_id`, `subject_id`, `schoolclass_id`, `year_id`),
	CONSTRAINT `appointment_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
	INDEX `appointment_FI_2` (`subject_id`),
	CONSTRAINT `appointment_FK_2`
		FOREIGN KEY (`subject_id`)
		REFERENCES `subject` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
	INDEX `appointment_FI_3` (`schoolclass_id`),
	CONSTRAINT `appointment_FK_3`
		FOREIGN KEY (`schoolclass_id`)
		REFERENCES `schoolclass` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
	INDEX `appointment_FI_4` (`year_id`),
	CONSTRAINT `appointment_FK_4`
		FOREIGN KEY (`year_id`)
		REFERENCES `year` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- enrolment
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `enrolment`;


CREATE TABLE `enrolment`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`schoolclass_id` VARCHAR(5)  NOT NULL,
	`year_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`import_code` VARCHAR(20),
	PRIMARY KEY (`id`),
	UNIQUE KEY `usy` (`user_id`, `schoolclass_id`, `year_id`),
	CONSTRAINT `enrolment_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
	INDEX `enrolment_FI_2` (`schoolclass_id`),
	CONSTRAINT `enrolment_FK_2`
		FOREIGN KEY (`schoolclass_id`)
		REFERENCES `schoolclass` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
	INDEX `enrolment_FI_3` (`year_id`),
	CONSTRAINT `enrolment_FK_3`
		FOREIGN KEY (`year_id`)
		REFERENCES `year` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- team
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `team`;


CREATE TABLE `team`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`description` VARCHAR(100),
	`posix_name` VARCHAR(20),
	`quality_code` VARCHAR(10),
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- role
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `role`;


CREATE TABLE `role`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`description` VARCHAR(100),
	`quality_code` VARCHAR(10),
	`posix_name` VARCHAR(20),
	`may_be_main_role` TINYINT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- user_team
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user_team`;


CREATE TABLE `user_team`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`team_id` INTEGER  NOT NULL,
	`role_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `utr` (`user_id`, `team_id`, `role_id`),
	CONSTRAINT `user_team_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
	INDEX `user_team_FI_2` (`team_id`),
	CONSTRAINT `user_team_FK_2`
		FOREIGN KEY (`team_id`)
		REFERENCES `team` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
	INDEX `user_team_FI_3` (`role_id`),
	CONSTRAINT `user_team_FK_3`
		FOREIGN KEY (`role_id`)
		REFERENCES `role` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- wpevent
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `wpevent`;


CREATE TABLE `wpevent`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`appointment_id` INTEGER,
	`user_id` INTEGER,
	`comment` VARCHAR(255),
	`state` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `wpevent_FI_1` (`appointment_id`),
	CONSTRAINT `wpevent_FK_1`
		FOREIGN KEY (`appointment_id`)
		REFERENCES `appointment` (`id`),
	INDEX `wpevent_FI_2` (`user_id`),
	CONSTRAINT `wpevent_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- wpinfo_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `wpinfo_type`;


CREATE TABLE `wpinfo_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(50),
	`description` VARCHAR(200),
	`rank` INTEGER  NOT NULL,
	`state` INTEGER,
	`template` TEXT,
	`example` TEXT,
	`is_required` TINYINT,
	`is_reserved` TINYINT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- wpinfo
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `wpinfo`;


CREATE TABLE `wpinfo`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`appointment_id` INTEGER,
	`wpinfo_type_id` INTEGER,
	`updated_at` DATETIME,
	`content` TEXT,
	PRIMARY KEY (`id`),
	INDEX `wpinfo_FI_1` (`appointment_id`),
	CONSTRAINT `wpinfo_FK_1`
		FOREIGN KEY (`appointment_id`)
		REFERENCES `appointment` (`id`),
	INDEX `wpinfo_FI_2` (`wpinfo_type_id`),
	CONSTRAINT `wpinfo_FK_2`
		FOREIGN KEY (`wpinfo_type_id`)
		REFERENCES `wpinfo_type` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- wptool_item_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `wptool_item_type`;


CREATE TABLE `wptool_item_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`description` VARCHAR(50),
	`rank` INTEGER,
	`state` INTEGER,
	`min_selected` INTEGER,
	`max_selected` INTEGER,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- wptool_item
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `wptool_item`;


CREATE TABLE `wptool_item`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`description` VARCHAR(50),
	`wptool_item_type_id` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `wptool_item_FI_1` (`wptool_item_type_id`),
	CONSTRAINT `wptool_item_FK_1`
		FOREIGN KEY (`wptool_item_type_id`)
		REFERENCES `wptool_item_type` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- wptool_appointment
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `wptool_appointment`;


CREATE TABLE `wptool_appointment`
(
	`appointment_id` INTEGER  NOT NULL,
	`wptool_item_id` INTEGER  NOT NULL,
	PRIMARY KEY (`appointment_id`,`wptool_item_id`),
	CONSTRAINT `wptool_appointment_FK_1`
		FOREIGN KEY (`appointment_id`)
		REFERENCES `appointment` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `wptool_appointment_FI_2` (`wptool_item_id`),
	CONSTRAINT `wptool_appointment_FK_2`
		FOREIGN KEY (`wptool_item_id`)
		REFERENCES `wptool_item` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- wpmodule
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `wpmodule`;


CREATE TABLE `wpmodule`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER,
	`title` VARCHAR(100),
	`period` VARCHAR(100),
	`appointment_id` INTEGER,
	`rank` INTEGER,
	`is_public` TINYINT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `wpmodule_FI_1` (`user_id`),
	CONSTRAINT `wpmodule_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `wpmodule_FI_2` (`appointment_id`),
	CONSTRAINT `wpmodule_FK_2`
		FOREIGN KEY (`appointment_id`)
		REFERENCES `appointment` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- wpitem_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `wpitem_type`;


CREATE TABLE `wpitem_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(50),
	`singular` VARCHAR(50),
	`description` VARCHAR(200),
	`style` VARCHAR(50),
	`rank` INTEGER  NOT NULL,
	`state` INTEGER,
	`is_required` TINYINT,
	`evaluation_min` INTEGER,
	`evaluation_max` INTEGER,
	`evaluation_min_description` VARCHAR(50),
	`evaluation_max_description` VARCHAR(50),
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- wpitem_group
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `wpitem_group`;


CREATE TABLE `wpitem_group`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`wpitem_type_id` INTEGER,
	`wpmodule_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `iti_mi` (`wpitem_type_id`, `wpmodule_id`),
	CONSTRAINT `wpitem_group_FK_1`
		FOREIGN KEY (`wpitem_type_id`)
		REFERENCES `wpitem_type` (`id`),
	INDEX `wpitem_group_FI_2` (`wpmodule_id`),
	CONSTRAINT `wpitem_group_FK_2`
		FOREIGN KEY (`wpmodule_id`)
		REFERENCES `wpmodule` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- wpmodule_item
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `wpmodule_item`;


CREATE TABLE `wpmodule_item`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`wpitem_group_id` INTEGER  NOT NULL,
	`rank` INTEGER  NOT NULL,
	`content` TEXT,
	`evaluation` INTEGER,
	`is_editable` TINYINT,
	PRIMARY KEY (`id`),
	UNIQUE KEY `id_pos` (`id`, `rank`),
	INDEX `wpmodule_item_FI_1` (`wpitem_group_id`),
	CONSTRAINT `wpmodule_item_FK_1`
		FOREIGN KEY (`wpitem_group_id`)
		REFERENCES `wpitem_group` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- subnet
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `subnet`;


CREATE TABLE `subnet`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(40),
	`ip_cidr` VARCHAR(20),
	PRIMARY KEY (`id`),
	KEY `subnet_I_1`(`name`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- workstation
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `workstation`;


CREATE TABLE `workstation`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(40),
	`ip_cidr` VARCHAR(20)  NOT NULL,
	`mac_address` VARCHAR(17),
	`is_enabled` TINYINT default 0,
	`subnet_id` INTEGER,
	PRIMARY KEY (`id`),
	KEY `workstation_I_1`(`name`),
	INDEX `workstation_FI_1` (`subnet_id`),
	CONSTRAINT `workstation_FK_1`
		FOREIGN KEY (`subnet_id`)
		REFERENCES `subnet` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- lanlog
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `lanlog`;


CREATE TABLE `lanlog`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`workstation_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`is_online` TINYINT default 0 NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `lanlog_FI_1` (`user_id`),
	CONSTRAINT `lanlog_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
	INDEX `lanlog_FI_2` (`workstation_id`),
	CONSTRAINT `lanlog_FK_2`
		FOREIGN KEY (`workstation_id`)
		REFERENCES `workstation` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- service
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `service`;


CREATE TABLE `service`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(40),
	`is_enabled_by_default` TINYINT default 0,
	`port` INTEGER  NOT NULL,
	`is_udp` TINYINT default 0,
	PRIMARY KEY (`id`),
	UNIQUE KEY `port_is_udp` (`port`, `is_udp`),
	KEY `service_I_1`(`name`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- workstation_service
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `workstation_service`;


CREATE TABLE `workstation_service`
(
	`workstation_id` INTEGER  NOT NULL,
	`service_id` INTEGER  NOT NULL,
	PRIMARY KEY (`workstation_id`,`service_id`),
	CONSTRAINT `workstation_service_FK_1`
		FOREIGN KEY (`workstation_id`)
		REFERENCES `workstation` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `workstation_service_FI_2` (`service_id`),
	CONSTRAINT `workstation_service_FK_2`
		FOREIGN KEY (`service_id`)
		REFERENCES `service` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- subnet_service
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `subnet_service`;


CREATE TABLE `subnet_service`
(
	`subnet_id` INTEGER  NOT NULL,
	`service_id` INTEGER  NOT NULL,
	PRIMARY KEY (`subnet_id`,`service_id`),
	CONSTRAINT `subnet_service_FK_1`
		FOREIGN KEY (`subnet_id`)
		REFERENCES `subnet` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `subnet_service_FI_2` (`service_id`),
	CONSTRAINT `subnet_service_FK_2`
		FOREIGN KEY (`service_id`)
		REFERENCES `service` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- system_message
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `system_message`;


CREATE TABLE `system_message`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`key` VARCHAR(30),
	PRIMARY KEY (`id`),
	UNIQUE KEY `key` (`key`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- system_message_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `system_message_i18n`;


CREATE TABLE `system_message_i18n`
(
	`content` VARCHAR(255),
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `system_message_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `system_message` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;

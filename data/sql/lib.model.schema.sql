
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
	`first_name` VARCHAR(20),
	`middle_name` VARCHAR(20),
	`last_name` VARCHAR(20),
	`role_id` INTEGER,
	`sex` VARCHAR(1),
	`email` VARCHAR(50),
	`birthdate` DATE,
	`birthplace` VARCHAR(50),
	`import_code` VARCHAR(20),
	`disk_set_soft_blocks_quota` INTEGER default 0,
	`disk_set_hard_blocks_quota` INTEGER default 0,
	`disk_set_soft_files_quota` INTEGER default 0,
	`disk_set_hard_files_quota` INTEGER default 0,
	`disk_used_blocks` INTEGER default 0,
	`disk_used_files` INTEGER default 0,
	`disk_updated_at` DATETIME,
	PRIMARY KEY (`user_id`),
	CONSTRAINT `sf_guard_user_profile_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE,
	INDEX `sf_guard_user_profile_FI_2` (`role_id`),
	CONSTRAINT `sf_guard_user_profile_FK_2`
		FOREIGN KEY (`role_id`)
		REFERENCES `role` (`id`)
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
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`import_code` VARCHAR(20),
	PRIMARY KEY (`id`),
	UNIQUE KEY `ussy` (`user_id`, `subject_id`, `schoolclass_id`, `year_id`),
	CONSTRAINT `appointment_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE RESTRICT,
	INDEX `appointment_FI_2` (`subject_id`),
	CONSTRAINT `appointment_FK_2`
		FOREIGN KEY (`subject_id`)
		REFERENCES `subject` (`id`)
		ON DELETE RESTRICT,
	INDEX `appointment_FI_3` (`schoolclass_id`),
	CONSTRAINT `appointment_FK_3`
		FOREIGN KEY (`schoolclass_id`)
		REFERENCES `schoolclass` (`id`)
		ON DELETE RESTRICT,
	INDEX `appointment_FI_4` (`year_id`),
	CONSTRAINT `appointment_FK_4`
		FOREIGN KEY (`year_id`)
		REFERENCES `year` (`id`)
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
		ON DELETE RESTRICT,
	INDEX `enrolment_FI_2` (`schoolclass_id`),
	CONSTRAINT `enrolment_FK_2`
		FOREIGN KEY (`schoolclass_id`)
		REFERENCES `schoolclass` (`id`)
		ON DELETE RESTRICT,
	INDEX `enrolment_FI_3` (`year_id`),
	CONSTRAINT `enrolment_FK_3`
		FOREIGN KEY (`year_id`)
		REFERENCES `year` (`id`)
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
		ON DELETE RESTRICT,
	INDEX `user_team_FI_2` (`team_id`),
	CONSTRAINT `user_team_FK_2`
		FOREIGN KEY (`team_id`)
		REFERENCES `team` (`id`)
		ON DELETE RESTRICT,
	INDEX `user_team_FI_3` (`role_id`),
	CONSTRAINT `user_team_FK_3`
		FOREIGN KEY (`role_id`)
		REFERENCES `role` (`id`)
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
		ON DELETE RESTRICT,
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
	`description` VARCHAR(200),
	`rank` INTEGER  NOT NULL,
	`state` INTEGER,
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
		ON DELETE RESTRICT,
	INDEX `lanlog_FI_2` (`workstation_id`),
	CONSTRAINT `lanlog_FK_2`
		FOREIGN KEY (`workstation_id`)
		REFERENCES `workstation` (`id`)
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
		ON DELETE CASCADE,
	INDEX `workstation_service_FI_2` (`service_id`),
	CONSTRAINT `workstation_service_FK_2`
		FOREIGN KEY (`service_id`)
		REFERENCES `service` (`id`)
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
		ON DELETE CASCADE,
	INDEX `subnet_service_FI_2` (`service_id`),
	CONSTRAINT `subnet_service_FK_2`
		FOREIGN KEY (`service_id`)
		REFERENCES `service` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;

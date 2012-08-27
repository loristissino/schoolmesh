
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
)Engine=InnoDB;

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
	`is_active` TINYINT default 1,
	PRIMARY KEY (`id`),
	INDEX `schoolclass_FI_1` (`track_id`),
	CONSTRAINT `schoolclass_FK_1`
		FOREIGN KEY (`track_id`)
		REFERENCES `track` (`id`)
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- year
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `year`;


CREATE TABLE `year`
(
	`id` INTEGER  NOT NULL,
	`description` VARCHAR(7),
	`start_date` DATE,
	`end_date` DATE,
	PRIMARY KEY (`id`)
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- term
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `term`;


CREATE TABLE `term`
(
	`id` VARCHAR(10)  NOT NULL,
	`description` VARCHAR(100)  NOT NULL,
	`end_day` INTEGER  NOT NULL,
	`has_formal_evaluation` TINYINT,
	PRIMARY KEY (`id`)
)Engine=InnoDB;

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
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- suggestion
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `suggestion`;


CREATE TABLE `suggestion`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`shortcut` VARCHAR(20)  NOT NULL,
	`content` VARCHAR(255)  NOT NULL,
	`is_selectable` TINYINT,
	`rank` INTEGER,
	PRIMARY KEY (`id`),
	KEY `suggestion_I_1`(`shortcut`)
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- recuperation_hint
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `recuperation_hint`;


CREATE TABLE `recuperation_hint`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER,
	`content` VARCHAR(255)  NOT NULL,
	`is_selectable` TINYINT,
	`rank` INTEGER,
	PRIMARY KEY (`id`),
	KEY `recuperation_hint_I_1`(`user_id`),
	CONSTRAINT `recuperation_hint_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- sf_guard_user_profile
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_user_profile`;


CREATE TABLE `sf_guard_user_profile`
(
	`user_id` INTEGER  NOT NULL,
	`lettertitle` VARCHAR(10),
	`first_name` VARCHAR(50),
	`middle_name` VARCHAR(50),
	`last_name` VARCHAR(50),
	`pronunciation` VARCHAR(100),
	`city` VARCHAR(100),
	`address` VARCHAR(100),
	`info` TEXT,
	`role_id` INTEGER,
	`gender` VARCHAR(1),
	`email` VARCHAR(50),
	`email_state` INTEGER default 0,
	`email_verification_code` VARCHAR(40),
	`mobile` VARCHAR(15),
	`website` VARCHAR(255),
	`office` VARCHAR(255),
	`ptn_notes` VARCHAR(255),
	`birthdate` DATE,
	`birthplace` VARCHAR(50),
	`import_code` VARCHAR(20),
	`system_alerts` VARCHAR(255),
	`is_scheduled_for_deletion` TINYINT default 0,
	`prefers_richtext` TINYINT default 1,
	`preferred_format` VARCHAR(5),
	`preferred_culture` VARCHAR(7),
	`last_action_at` DATETIME,
	`last_login_at` DATETIME,
	`last_login_attempt_at` DATETIME,
	`known_browsers` TEXT,
	`initialization_key` VARCHAR(32),
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
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- account_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `account_type`;


CREATE TABLE `account_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	`description` TEXT,
	`is_external` TINYINT  NOT NULL,
	`rank` INTEGER,
	PRIMARY KEY (`id`),
	UNIQUE KEY `account_type_U_1` (`name`)
)Engine=InnoDB;

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
	`settings` TEXT,
	`exists` TINYINT,
	`is_locked` TINYINT,
	`temporary_password` VARCHAR(10),
	`info_updated_at` DATETIME,
	`last_known_login_at` DATETIME,
	`quota_percentage` INTEGER,
	`updated_at` DATETIME,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE KEY `ua` (`user_id`, `account_type_id`),
	KEY `account_I_1`(`user_id`),
	KEY `account_I_2`(`account_type_id`),
	CONSTRAINT `account_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT `account_FK_2`
		FOREIGN KEY (`account_type_id`)
		REFERENCES `account_type` (`id`)
		ON DELETE RESTRICT
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- reserved_username
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `reserved_username`;


CREATE TABLE `reserved_username`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(20),
	`aliases_to` VARCHAR(20),
	PRIMARY KEY (`id`),
	UNIQUE KEY `reserved_username_U_1` (`username`),
	KEY `reserved_username_I_1`(`aliases_to`)
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- syllabus
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `syllabus`;


CREATE TABLE `syllabus`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50),
	`version` VARCHAR(20),
	`author` VARCHAR(50),
	`href` VARCHAR(255),
	`is_active` TINYINT default 1,
	`evaluation_min` INTEGER,
	`evaluation_max` INTEGER,
	`evaluation_min_description` VARCHAR(50),
	`evaluation_max_description` VARCHAR(50),
	PRIMARY KEY (`id`)
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- syllabus_item
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `syllabus_item`;


CREATE TABLE `syllabus_item`
(
	`syllabus_id` INTEGER,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`rank` INTEGER,
	`ref` VARCHAR(24),
	`level` INTEGER,
	`parent_id` INTEGER,
	`content` TEXT,
	`is_selectable` TINYINT default 0,
	PRIMARY KEY (`id`),
	UNIQUE KEY `ir` (`syllabus_id`, `ref`),
	KEY `syllabus_item_I_1`(`parent_id`),
	CONSTRAINT `syllabus_item_FK_1`
		FOREIGN KEY (`syllabus_id`)
		REFERENCES `syllabus` (`id`),
	CONSTRAINT `syllabus_item_FK_2`
		FOREIGN KEY (`parent_id`)
		REFERENCES `syllabus_item` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- appointment_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `appointment_type`;


CREATE TABLE `appointment_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`description` VARCHAR(255),
	`shortcut` VARCHAR(10),
	`rank` INTEGER,
	`is_active` TINYINT default 1,
	`has_info` TINYINT default 0,
	`has_modules` TINYINT default 0,
	`has_tools` TINYINT default 0,
	`has_attachments` TINYINT default 0,
	PRIMARY KEY (`id`),
	KEY `appointment_type_I_1`(`shortcut`),
	KEY `appointment_type_I_2`(`rank`)
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- appointment
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `appointment`;


CREATE TABLE `appointment`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`subject_id` INTEGER,
	`schoolclass_id` VARCHAR(5),
	`team_id` INTEGER,
	`year_id` INTEGER  NOT NULL,
	`state` INTEGER,
	`hours` INTEGER default 0,
	`is_public` TINYINT,
	`syllabus_id` INTEGER,
	`appointment_type_id` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`import_code` VARCHAR(20),
	PRIMARY KEY (`id`),
	UNIQUE KEY `usasy` (`user_id`, `subject_id`, `appointment_type_id`, `schoolclass_id`, `year_id`),
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
	INDEX `appointment_FI_4` (`team_id`),
	CONSTRAINT `appointment_FK_4`
		FOREIGN KEY (`team_id`)
		REFERENCES `team` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
	INDEX `appointment_FI_5` (`year_id`),
	CONSTRAINT `appointment_FK_5`
		FOREIGN KEY (`year_id`)
		REFERENCES `year` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
	INDEX `appointment_FI_6` (`syllabus_id`),
	CONSTRAINT `appointment_FK_6`
		FOREIGN KEY (`syllabus_id`)
		REFERENCES `syllabus` (`id`),
	INDEX `appointment_FI_7` (`appointment_type_id`),
	CONSTRAINT `appointment_FK_7`
		FOREIGN KEY (`appointment_type_id`)
		REFERENCES `appointment_type` (`id`)
)Engine=InnoDB;

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
	`info` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`import_code` VARCHAR(20),
	PRIMARY KEY (`id`),
	UNIQUE KEY `usy` (`user_id`, `year_id`),
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
)Engine=InnoDB;

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
	`needs_folder` TINYINT default 0,
	`needs_mailing_list` TINYINT default 0,
	`is_public` TINYINT default 0,
	PRIMARY KEY (`id`)
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- role
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `role`;


CREATE TABLE `role`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`male_description` VARCHAR(100),
	`female_description` VARCHAR(100),
	`quality_code` VARCHAR(10),
	`posix_name` VARCHAR(20),
	`may_be_main_role` TINYINT,
	`needs_charge_letter` TINYINT,
	`is_key` TINYINT default 0,
	`default_guardgroup` VARCHAR(20),
	`min` INTEGER default 0,
	`max` INTEGER default 0,
	`forfait_retribution` DECIMAL(10,2),
	`charge_notes` TEXT,
	`confirmation_notes` TEXT,
	`rank` INTEGER,
	PRIMARY KEY (`id`)
)Engine=InnoDB;

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
	`expiry` DATE,
	`notes` TEXT,
	`details` TEXT,
	`charge_reference_number` VARCHAR(20),
	`confirmation_reference_number` VARCHAR(20),
	PRIMARY KEY (`id`),
	UNIQUE KEY `utr` (`user_id`, `team_id`),
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
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- wfevent
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `wfevent`;


CREATE TABLE `wfevent`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`base_table` INTEGER,
	`base_id` INTEGER,
	`created_at` DATETIME,
	`user_id` INTEGER,
	`comment` VARCHAR(255),
	`state` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `wfevent_FI_1` (`user_id`),
	CONSTRAINT `wfevent_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- wpinfo_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `wpinfo_type`;


CREATE TABLE `wpinfo_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(50),
	`description` VARCHAR(255),
	`rank` INTEGER  NOT NULL,
	`code` VARCHAR(30),
	`state_min` INTEGER default 10,
	`state_max` INTEGER default 10,
	`template` TEXT,
	`example` TEXT,
	`is_required` TINYINT default 1,
	`is_confidential` TINYINT default 0,
	`grade_min` INTEGER default 1,
	`grade_max` INTEGER default 5,
	`appointment_type_id` INTEGER,
	PRIMARY KEY (`id`),
	KEY `wpinfo_type_I_1`(`rank`),
	KEY `wpinfo_type_I_2`(`code`),
	KEY `wpinfo_type_I_3`(`state_min`),
	KEY `wpinfo_type_I_4`(`state_max`),
	KEY `wpinfo_type_I_5`(`grade_min`),
	KEY `wpinfo_type_I_6`(`grade_max`),
	INDEX `wpinfo_type_FI_1` (`appointment_type_id`),
	CONSTRAINT `wpinfo_type_FK_1`
		FOREIGN KEY (`appointment_type_id`)
		REFERENCES `appointment_type` (`id`)
)Engine=InnoDB;

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
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- wptool_item_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `wptool_item_type`;


CREATE TABLE `wptool_item_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`description` VARCHAR(50),
	`rank` INTEGER,
	`appointment_type_id` INTEGER,
	`state_min` INTEGER default 10,
	`state_max` INTEGER default 10,
	`min_selected` INTEGER,
	`max_selected` INTEGER,
	`grade_min` INTEGER default 1,
	`grade_max` INTEGER default 5,
	PRIMARY KEY (`id`),
	KEY `wptool_item_type_I_1`(`rank`),
	KEY `wptool_item_type_I_2`(`state_min`),
	KEY `wptool_item_type_I_3`(`state_max`),
	INDEX `wptool_item_type_FI_1` (`appointment_type_id`),
	CONSTRAINT `wptool_item_type_FK_1`
		FOREIGN KEY (`appointment_type_id`)
		REFERENCES `appointment_type` (`id`)
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- wptool_item
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `wptool_item`;


CREATE TABLE `wptool_item`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`description` VARCHAR(50),
	`rank` INTEGER,
	`code` VARCHAR(30),
	`wptool_item_type_id` INTEGER,
	PRIMARY KEY (`id`),
	KEY `wptool_item_I_1`(`rank`),
	KEY `wptool_item_I_2`(`code`),
	INDEX `wptool_item_FI_1` (`wptool_item_type_id`),
	CONSTRAINT `wptool_item_FK_1`
		FOREIGN KEY (`wptool_item_type_id`)
		REFERENCES `wptool_item_type` (`id`)
)Engine=InnoDB;

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
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- wpmodule
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `wpmodule`;


CREATE TABLE `wpmodule`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER,
	`title` VARCHAR(255),
	`period` VARCHAR(255),
	`hours_estimated` INTEGER default 0,
	`hours_used` INTEGER default 0,
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
)Engine=InnoDB;

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
	`state_min` INTEGER default 10,
	`state_max` INTEGER default 10,
	`is_required` TINYINT,
	`appointment_type_id` INTEGER,
	`code` VARCHAR(30),
	`evaluation_min` INTEGER,
	`evaluation_max` INTEGER,
	`evaluation_min_description` VARCHAR(50),
	`evaluation_max_description` VARCHAR(50),
	`grade_min` INTEGER default 1,
	`grade_max` INTEGER default 5,
	PRIMARY KEY (`id`),
	UNIQUE KEY `sc` (`appointment_type_id`, `code`),
	KEY `wpitem_type_I_1`(`state_min`),
	KEY `wpitem_type_I_2`(`state_max`),
	KEY `wpitem_type_I_3`(`code`),
	CONSTRAINT `wpitem_type_FK_1`
		FOREIGN KEY (`appointment_type_id`)
		REFERENCES `appointment_type` (`id`)
)Engine=InnoDB;

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
)Engine=InnoDB;

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
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- student_situation
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `student_situation`;


CREATE TABLE `student_situation`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`term_id` VARCHAR(10)  NOT NULL,
	`wpmodule_item_id` INTEGER  NOT NULL,
	`user_id` INTEGER  NOT NULL,
	`evaluation` INTEGER,
	PRIMARY KEY (`id`),
	UNIQUE KEY `twu` (`term_id`, `wpmodule_item_id`, `user_id`),
	CONSTRAINT `student_situation_FK_1`
		FOREIGN KEY (`term_id`)
		REFERENCES `term` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
	INDEX `student_situation_FI_2` (`wpmodule_item_id`),
	CONSTRAINT `student_situation_FK_2`
		FOREIGN KEY (`wpmodule_item_id`)
		REFERENCES `wpmodule_item` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `student_situation_FI_3` (`user_id`),
	CONSTRAINT `student_situation_FK_3`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- student_suggestion
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `student_suggestion`;


CREATE TABLE `student_suggestion`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`term_id` VARCHAR(10)  NOT NULL,
	`appointment_id` INTEGER  NOT NULL,
	`user_id` INTEGER  NOT NULL,
	`suggestion_id` INTEGER,
	PRIMARY KEY (`id`,`appointment_id`),
	UNIQUE KEY `taus` (`term_id`, `appointment_id`, `user_id`, `suggestion_id`),
	CONSTRAINT `student_suggestion_FK_1`
		FOREIGN KEY (`term_id`)
		REFERENCES `term` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
	INDEX `student_suggestion_FI_2` (`appointment_id`),
	CONSTRAINT `student_suggestion_FK_2`
		FOREIGN KEY (`appointment_id`)
		REFERENCES `appointment` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `student_suggestion_FI_3` (`user_id`),
	CONSTRAINT `student_suggestion_FK_3`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
	INDEX `student_suggestion_FI_4` (`suggestion_id`),
	CONSTRAINT `student_suggestion_FK_4`
		FOREIGN KEY (`suggestion_id`)
		REFERENCES `suggestion` (`id`)
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- student_hint
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `student_hint`;


CREATE TABLE `student_hint`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`term_id` VARCHAR(10)  NOT NULL,
	`appointment_id` INTEGER  NOT NULL,
	`user_id` INTEGER  NOT NULL,
	`recuperation_hint_id` INTEGER,
	PRIMARY KEY (`id`,`appointment_id`),
	UNIQUE KEY `taur` (`term_id`, `appointment_id`, `user_id`, `recuperation_hint_id`),
	CONSTRAINT `student_hint_FK_1`
		FOREIGN KEY (`term_id`)
		REFERENCES `term` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
	INDEX `student_hint_FI_2` (`appointment_id`),
	CONSTRAINT `student_hint_FK_2`
		FOREIGN KEY (`appointment_id`)
		REFERENCES `appointment` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `student_hint_FI_3` (`user_id`),
	CONSTRAINT `student_hint_FK_3`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
	INDEX `student_hint_FI_4` (`recuperation_hint_id`),
	CONSTRAINT `student_hint_FK_4`
		FOREIGN KEY (`recuperation_hint_id`)
		REFERENCES `recuperation_hint` (`id`)
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- student_syllabus_item
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `student_syllabus_item`;


CREATE TABLE `student_syllabus_item`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`term_id` VARCHAR(10)  NOT NULL,
	`appointment_id` INTEGER  NOT NULL,
	`user_id` INTEGER  NOT NULL,
	`syllabus_item_id` INTEGER,
	PRIMARY KEY (`id`,`appointment_id`),
	UNIQUE KEY `taus` (`term_id`, `appointment_id`, `user_id`, `syllabus_item_id`),
	CONSTRAINT `student_syllabus_item_FK_1`
		FOREIGN KEY (`term_id`)
		REFERENCES `term` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
	INDEX `student_syllabus_item_FI_2` (`appointment_id`),
	CONSTRAINT `student_syllabus_item_FK_2`
		FOREIGN KEY (`appointment_id`)
		REFERENCES `appointment` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `student_syllabus_item_FI_3` (`user_id`),
	CONSTRAINT `student_syllabus_item_FK_3`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
	INDEX `student_syllabus_item_FI_4` (`syllabus_item_id`),
	CONSTRAINT `student_syllabus_item_FK_4`
		FOREIGN KEY (`syllabus_item_id`)
		REFERENCES `syllabus_item` (`id`)
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- wpmodule_syllabus_item
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `wpmodule_syllabus_item`;


CREATE TABLE `wpmodule_syllabus_item`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`wpmodule_id` INTEGER,
	`syllabus_item_id` INTEGER,
	`contribution` INTEGER,
	`evaluation` INTEGER,
	PRIMARY KEY (`id`),
	UNIQUE KEY `ws` (`wpmodule_id`, `syllabus_item_id`),
	CONSTRAINT `wpmodule_syllabus_item_FK_1`
		FOREIGN KEY (`wpmodule_id`)
		REFERENCES `wpmodule` (`id`),
	INDEX `wpmodule_syllabus_item_FI_2` (`syllabus_item_id`),
	CONSTRAINT `wpmodule_syllabus_item_FK_2`
		FOREIGN KEY (`syllabus_item_id`)
		REFERENCES `syllabus_item` (`id`)
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- schoolproject
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `schoolproject`;


CREATE TABLE `schoolproject`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`proj_category_id` INTEGER,
	`code` VARCHAR(10),
	`year_id` INTEGER  NOT NULL,
	`user_id` INTEGER  NOT NULL,
	`team_id` INTEGER,
	`title` VARCHAR(255),
	`description` TEXT,
	`notes` TEXT,
	`addressees` TEXT,
	`purposes` TEXT,
	`goals` TEXT,
	`final_report` TEXT,
	`proposals` TEXT,
	`hours_approved` INTEGER,
	`state` INTEGER,
	`submission_date` DATE,
	`reference_number` VARCHAR(20),
	`approval_date` DATE,
	`approval_notes` TEXT,
	`financing_date` DATE,
	`financing_notes` TEXT,
	`confirmation_date` DATE,
	`confirmation_notes` TEXT,
	`evaluation_min` INTEGER,
	`evaluation_max` INTEGER,
	`no_activity_confirm` TINYINT default 0,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `schoolproject_I_1`(`code`),
	KEY `schoolproject_I_2`(`title`),
	INDEX `schoolproject_FI_1` (`proj_category_id`),
	CONSTRAINT `schoolproject_FK_1`
		FOREIGN KEY (`proj_category_id`)
		REFERENCES `proj_category` (`id`),
	INDEX `schoolproject_FI_2` (`year_id`),
	CONSTRAINT `schoolproject_FK_2`
		FOREIGN KEY (`year_id`)
		REFERENCES `year` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
	INDEX `schoolproject_FI_3` (`user_id`),
	CONSTRAINT `schoolproject_FK_3`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
	INDEX `schoolproject_FI_4` (`team_id`),
	CONSTRAINT `schoolproject_FK_4`
		FOREIGN KEY (`team_id`)
		REFERENCES `team` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- proj_category
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `proj_category`;


CREATE TABLE `proj_category`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255),
	`rank` INTEGER  NOT NULL,
	`resources` INTEGER,
	PRIMARY KEY (`id`)
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- proj_deadline
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `proj_deadline`;


CREATE TABLE `proj_deadline`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`schoolproject_id` INTEGER,
	`user_id` INTEGER  NOT NULL,
	`original_deadline_date` DATE,
	`current_deadline_date` DATE,
	`description` VARCHAR(255),
	`notes` TEXT,
	`completed` TINYINT,
	`needs_attachment` TINYINT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `proj_deadline_FI_1` (`schoolproject_id`),
	CONSTRAINT `proj_deadline_FK_1`
		FOREIGN KEY (`schoolproject_id`)
		REFERENCES `schoolproject` (`id`),
	INDEX `proj_deadline_FI_2` (`user_id`),
	CONSTRAINT `proj_deadline_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- proj_financing
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `proj_financing`;


CREATE TABLE `proj_financing`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`description` VARCHAR(255),
	`rank` INTEGER  NOT NULL,
	PRIMARY KEY (`id`)
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- proj_resource_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `proj_resource_type`;


CREATE TABLE `proj_resource_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`description` VARCHAR(255),
	`shortcut` VARCHAR(5)  NOT NULL,
	`role_id` INTEGER,
	`standard_cost` DECIMAL(10,2),
	`measurement_unit` VARCHAR(10),
	`is_monetary` TINYINT default 1,
	`rank` INTEGER,
	`printed_in_submission_letters` TINYINT default 1,
	`printed_in_charge_letters` TINYINT default 1,
	PRIMARY KEY (`id`),
	UNIQUE KEY `s` (`shortcut`),
	INDEX `proj_resource_type_FI_1` (`role_id`),
	CONSTRAINT `proj_resource_type_FK_1`
		FOREIGN KEY (`role_id`)
		REFERENCES `role` (`id`)
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- proj_resource
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `proj_resource`;


CREATE TABLE `proj_resource`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`schoolproject_id` INTEGER,
	`proj_resource_type_id` INTEGER,
	`description` VARCHAR(255),
	`charged_user_id` INTEGER,
	`quantity_estimated` DECIMAL(10,2),
	`quantity_approved` DECIMAL(10,2),
	`amount_funded_externally` DECIMAL(10,2),
	`financing_notes` VARCHAR(255),
	`quantity_final` DECIMAL(10,2),
	`standard_cost` DECIMAL(10,2),
	`is_monetary` TINYINT default 1,
	`scheduled_deadline` DATE,
	PRIMARY KEY (`id`),
	INDEX `proj_resource_FI_1` (`schoolproject_id`),
	CONSTRAINT `proj_resource_FK_1`
		FOREIGN KEY (`schoolproject_id`)
		REFERENCES `schoolproject` (`id`),
	INDEX `proj_resource_FI_2` (`proj_resource_type_id`),
	CONSTRAINT `proj_resource_FK_2`
		FOREIGN KEY (`proj_resource_type_id`)
		REFERENCES `proj_resource_type` (`id`),
	INDEX `proj_resource_FI_3` (`charged_user_id`),
	CONSTRAINT `proj_resource_FK_3`
		FOREIGN KEY (`charged_user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- proj_activity
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `proj_activity`;


CREATE TABLE `proj_activity`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`proj_resource_id` INTEGER,
	`user_id` INTEGER  NOT NULL,
	`beginning` DATETIME,
	`quantity` DECIMAL(10,2),
	`notes` TEXT,
	`created_at` DATETIME,
	`acknowledged_at` DATETIME,
	`acknowledger_user_id` INTEGER,
	`added_by_coordinator` TINYINT default 0,
	`paper_log` TINYINT default 0,
	PRIMARY KEY (`id`),
	INDEX `proj_activity_FI_1` (`proj_resource_id`),
	CONSTRAINT `proj_activity_FK_1`
		FOREIGN KEY (`proj_resource_id`)
		REFERENCES `proj_resource` (`id`),
	INDEX `proj_activity_FI_2` (`user_id`),
	CONSTRAINT `proj_activity_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
	INDEX `proj_activity_FI_3` (`acknowledger_user_id`),
	CONSTRAINT `proj_activity_FK_3`
		FOREIGN KEY (`acknowledger_user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- proj_upshot
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `proj_upshot`;


CREATE TABLE `proj_upshot`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`schoolproject_id` INTEGER,
	`description` VARCHAR(255),
	`indicator` VARCHAR(255),
	`upshot` VARCHAR(255),
	`evaluation` INTEGER,
	`scheduled_date` DATE,
	PRIMARY KEY (`id`),
	INDEX `proj_upshot_FI_1` (`schoolproject_id`),
	CONSTRAINT `proj_upshot_FK_1`
		FOREIGN KEY (`schoolproject_id`)
		REFERENCES `schoolproject` (`id`)
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- informativecontent
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `informativecontent`;


CREATE TABLE `informativecontent`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`shortcut` VARCHAR(40),
	`description` VARCHAR(255),
	PRIMARY KEY (`id`)
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- consent
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `consent`;


CREATE TABLE `consent`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`informativecontent_id` INTEGER,
	`given_at` DATETIME,
	`method` INTEGER,
	`notes` TEXT,
	PRIMARY KEY (`id`),
	UNIQUE KEY `ui` (`user_id`, `informativecontent_id`),
	CONSTRAINT `consent_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
	INDEX `consent_FI_2` (`informativecontent_id`),
	CONSTRAINT `consent_FK_2`
		FOREIGN KEY (`informativecontent_id`)
		REFERENCES `informativecontent` (`id`)
)Engine=InnoDB;

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
)Engine=InnoDB;

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
	`is_active` TINYINT default 0,
	`location_x` FLOAT,
	`location_y` FLOAT,
	`subnet_id` INTEGER,
	PRIMARY KEY (`id`),
	KEY `workstation_I_1`(`name`),
	INDEX `workstation_FI_1` (`subnet_id`),
	CONSTRAINT `workstation_FK_1`
		FOREIGN KEY (`subnet_id`)
		REFERENCES `subnet` (`id`)
)Engine=InnoDB;

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
	`os_used` VARCHAR(100),
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
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- attachment_file
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `attachment_file`;


CREATE TABLE `attachment_file`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`base_table` INTEGER,
	`base_id` INTEGER,
	`internet_media_type` VARCHAR(255),
	`original_file_name` VARCHAR(255),
	`uniqid` VARCHAR(50)  NOT NULL,
	`file_size` BIGINT,
	`is_public` TINYINT default 0,
	`created_at` DATETIME,
	`md5sum` VARCHAR(32),
	PRIMARY KEY (`id`),
	UNIQUE KEY `attachment_file_U_1` (`uniqid`),
	UNIQUE KEY `tim` (`base_table`, `base_id`, `md5sum`),
	INDEX `attachment_file_FI_1` (`user_id`),
	CONSTRAINT `attachment_file_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)Engine=InnoDB;

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
)Engine=InnoDB;

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
)Engine=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;

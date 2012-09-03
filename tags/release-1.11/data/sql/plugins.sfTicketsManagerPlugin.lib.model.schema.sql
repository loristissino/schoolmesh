
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- ticket_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `ticket_type`;


CREATE TABLE `ticket_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`description` VARCHAR(50)  NOT NULL,
	PRIMARY KEY (`id`)
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- ticket
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `ticket`;


CREATE TABLE `ticket`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`referrer` VARCHAR(255),
	`ticket_type_id` INTEGER,
	`content` TEXT,
	`updated_at` DATETIME,
	`state` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `ticket_FI_1` (`ticket_type_id`),
	CONSTRAINT `ticket_FK_1`
		FOREIGN KEY (`ticket_type_id`)
		REFERENCES `ticket_type` (`id`)
)Engine=InnoDB;

#-----------------------------------------------------------------------------
#-- ticket_event
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `ticket_event`;


CREATE TABLE `ticket_event`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`ticket_id` INTEGER,
	`user_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	`content` VARCHAR(255)  NOT NULL,
	`state` INTEGER,
	`assignee_id` INTEGER,
	PRIMARY KEY (`id`),
	KEY `ticket_event_I_1`(`user_id`),
	KEY `ticket_event_I_2`(`assignee_id`),
	INDEX `ticket_event_FI_1` (`ticket_id`),
	CONSTRAINT `ticket_event_FK_1`
		FOREIGN KEY (`ticket_id`)
		REFERENCES `ticket` (`id`),
	CONSTRAINT `ticket_event_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT,
	CONSTRAINT `ticket_event_FK_3`
		FOREIGN KEY (`assignee_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE CASCADE
		ON DELETE RESTRICT
)Engine=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;

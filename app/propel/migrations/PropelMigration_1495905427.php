<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1495905427.
 * Generated on 2017-05-27 23:02:07 by roshan
 */
class PropelMigration_1495905427
{

    public function preUp($manager)
    {
        // add the pre-migration code here
    }

    public function postUp($manager)
    {
        // add the post-migration code here
    }

    public function preDown($manager)
    {
        // add the pre-migration code here
    }

    public function postDown($manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `contact`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_id` INTEGER NOT NULL,
    `first_name` VARCHAR(30) NOT NULL,
    `last_name` VARCHAR(30),
    `gender` SMALLINT,
    `facebook_id` VARCHAR(255),
    `friend_since` DATE,
    `email` VARCHAR(50),
    PRIMARY KEY (`id`),
    INDEX `contact_FI_1` (`user_id`),
    CONSTRAINT `contact_FK_1`
        FOREIGN KEY (`user_id`)
        REFERENCES `fos_user` (`id`)
) ENGINE=InnoDB;

CREATE TABLE `address`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `contact_id` INTEGER,
    `country` VARCHAR(25),
    `district` VARCHAR(25),
    `village_city` VARCHAR(25),
    `address_type` VARCHAR(25),
    PRIMARY KEY (`id`),
    INDEX `address_FI_1` (`contact_id`),
    CONSTRAINT `address_FK_1`
        FOREIGN KEY (`contact_id`)
        REFERENCES `contact` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `phone`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `contact_id` INTEGER,
    `phone_number` VARCHAR(255),
    `phone_type` VARCHAR(255),
    PRIMARY KEY (`id`),
    INDEX `phone_FI_1` (`contact_id`),
    CONSTRAINT `phone_FK_1`
        FOREIGN KEY (`contact_id`)
        REFERENCES `contact` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `fos_user`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(255),
    `username_canonical` VARCHAR(255),
    `email` VARCHAR(255),
    `email_canonical` VARCHAR(255),
    `enabled` TINYINT(1) DEFAULT 0,
    `salt` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `last_login` DATETIME,
    `locked` TINYINT(1) DEFAULT 0,
    `expired` TINYINT(1) DEFAULT 0,
    `expires_at` DATETIME,
    `confirmation_token` VARCHAR(255),
    `password_requested_at` DATETIME,
    `credentials_expired` TINYINT(1) DEFAULT 0,
    `credentials_expire_at` DATETIME,
    `roles` TEXT,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `fos_user_U_1` (`username_canonical`),
    UNIQUE INDEX `fos_user_U_2` (`email_canonical`)
) ENGINE=InnoDB;

CREATE TABLE `fos_group`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `roles` TEXT,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `fos_user_group`
(
    `fos_user_id` INTEGER NOT NULL,
    `fos_group_id` INTEGER NOT NULL,
    PRIMARY KEY (`fos_user_id`,`fos_group_id`),
    INDEX `fos_user_group_FI_2` (`fos_group_id`),
    CONSTRAINT `fos_user_group_FK_1`
        FOREIGN KEY (`fos_user_id`)
        REFERENCES `fos_user` (`id`),
    CONSTRAINT `fos_user_group_FK_2`
        FOREIGN KEY (`fos_group_id`)
        REFERENCES `fos_group` (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `contact`;

DROP TABLE IF EXISTS `address`;

DROP TABLE IF EXISTS `phone`;

DROP TABLE IF EXISTS `fos_user`;

DROP TABLE IF EXISTS `fos_group`;

DROP TABLE IF EXISTS `fos_user_group`;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}
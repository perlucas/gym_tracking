
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- trainee
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `trainee`;

CREATE TABLE `trainee`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `fullname` VARCHAR(150) NOT NULL,
    `dni` VARCHAR(12) NOT NULL,
    `phone` VARCHAR(50) NOT NULL,
    `address` VARCHAR(150) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- attendance
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `attendance`;

CREATE TABLE `attendance`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `trainee_id` INTEGER NOT NULL,
    `timestamp` DATETIME NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `attendance_fi_cf50c7` (`trainee_id`),
    CONSTRAINT `attendance_fk_cf50c7`
        FOREIGN KEY (`trainee_id`)
        REFERENCES `trainee` (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;

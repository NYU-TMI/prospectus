CREATE SCHEMA `prospectus`;

USE `prospectus`;

CREATE TABLE `prospectus`.`user` (
  `uid` VARCHAR(45) NOT NULL,
  `mtwid` VARCHAR(45) NULL,
  `assignid` VARCHAR(45) NULL,
  `experience` INT NULL,
  `hasretire` INT NULL,
  `ip` VARCHAR(45) NULL,
  `location` VARCHAR(45) NULL,
  `created` DATETIME NOT NULL,
  `completed` DATETIME NULL,
  `reward` FLOAT NULL,
  `awarded` INT(1) NULL DEFAULT 0,
  `comments` TEXT NULL,
  PRIMARY KEY (`uid`));

CREATE TABLE `prospectus`.`answer` (
  `uid` VARCHAR(45) NOT NULL,
  `document` VARCHAR(45) NOT NULL,
  `answer1` TEXT NULL,
  `answer2` TEXT NULL,
  `answer3` TEXT NULL,
  `answer4` TEXT NULL,
  `answer5` TEXT NULL,
  `answer6` TEXT NULL,
  `answer7` TEXT NULL,
  `answer8` TEXT NULL,
  `answer9` TEXT NULL,
  `answer10` TEXT NULL,
  `answer11` TEXT NULL,
  PRIMARY KEY (`uid`, `document`),
  FOREIGN KEY (`uid`) REFERENCES `user` (`uid`));

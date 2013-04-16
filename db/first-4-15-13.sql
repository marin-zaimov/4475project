SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';


-- -----------------------------------------------------
-- Table `4475project`.`projects`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `4475project`.`projects` ;

CREATE  TABLE IF NOT EXISTS `4475project`.`projects` (
  `id` INT NOT NULL ,
  `name` VARCHAR(255) NULL ,
  `date` DATETIME NOT NULL ,
  `description` MEDIUMTEXT NULL ,
  `uploadedBy` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `4475project`.`images`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `4475project`.`images` ;

CREATE  TABLE IF NOT EXISTS `4475project`.`images` (
  `id` INT NOT NULL ,
  `projectId` INT NOT NULL ,
  `order` INT NULL ,
  `type` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_images_1` (`projectId` ASC) ,
  CONSTRAINT `fk_images_1`
    FOREIGN KEY (`projectId` )
    REFERENCES `4475project`.`projects` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `4475project`.`algorithms`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `4475project`.`algorithms` ;

CREATE  TABLE IF NOT EXISTS `4475project`.`algorithms` (
  `id` INT NOT NULL ,
  `name` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `4475project`.`algorithm2project`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `4475project`.`algorithm2project` ;

CREATE  TABLE IF NOT EXISTS `4475project`.`algorithm2project` (
  `algorithmId` INT NOT NULL ,
  `projectId` INT NOT NULL ,
  `date` DATETIME NOT NULL ,
  PRIMARY KEY (`projectId`, `algorithmId`) ,
  INDEX `fk_algorithm2project_1` (`algorithmId` ASC) ,
  INDEX `fk_algorithm2project_2` (`projectId` ASC) ,
  CONSTRAINT `fk_algorithm2project_1`
    FOREIGN KEY (`algorithmId` )
    REFERENCES `4475project`.`algorithms` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_algorithm2project_2`
    FOREIGN KEY (`projectId` )
    REFERENCES `4475project`.`projects` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

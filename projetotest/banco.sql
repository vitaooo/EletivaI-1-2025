-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema estacionamento
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema estacionamento
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `estacionamento` DEFAULT CHARACTER SET utf8;
USE `estacionamento`;

CREATE TABLE IF NOT EXISTS `estacionamento`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cpf` INT(11) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `senha` TEXT NOT NULL,
  PRIMARY KEY (`id`,`cpf`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `estacionamento`.`veiculo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estacionamento`.`veiculo` (
  `placa` VARCHAR(7) NOT NULL,
  `modelo` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`placa`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `estacionamento`.`vagas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estacionamento`.`vagas` (
  `lugar` INT NOT NULL AUTO_INCREMENT,
  `entrada` DATE NOT NULL,
  `saida` DATE NOT NULL,
  `pago` BOOLEAN NOT NULL,
  `cliente_id` INT NOT NULL,
  `veiculo_id` VARCHAR(7) NOT NULL,
  PRIMARY KEY (`lugar`),
  INDEX `fk_vagas_cliente_idx` (`cliente_id` ASC),
  CONSTRAINT `fk_vagas_cliente`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `estacionamento`.`cliente` (`cpf`),
    FOREIGN KEY (`veiculo_id`)
    REFERENCES `estacionamento`.`veiculo` (`placa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema projetoVictor
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema projetoVictor
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `projetoVictor` DEFAULT CHARACTER SET utf8;
USE `projetoVictor`;

-- -----------------------------------------------------
-- Table `projetoVictor`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetoVictor`.`veiculo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `placa` VARCHAR(255) NOT NULL,
  `modelo` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `projetoVictor`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetoVictor`.`cliente` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `veiculo_id` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `projetoVictor`.`vaga`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetoVictor`.`vaga` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `localizacao` VARCHAR(255) NOT NULL,
  `disponivel` BOOLEAN NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `projetoVictor`.`reserva` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cliente_id` INT NOT NULL,
  `vaga_id` INT NOT NULL,
  `entrada` DATETIME NOT NULL,
  `saida` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

ALTER TABLE cliente
ADD `senha` VARCHAR(255) NOT NULL AFTER `nome`,
ADD `email` VARCHAR(255) NOT NULL AFTER `senha`;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema projetophp
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `projetophp` DEFAULT CHARACTER SET utf8 ;
USE `projetophp` ;

-- -----------------------------------------------------
-- Tabela `projetophp`.`usuario` (Mantida para login)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetophp`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `senha` TEXT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Tabela `projetophp`.`clientes` (RF2: CRUD de Clientes)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetophp`.`clientes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `cpf` VARCHAR(20) NOT NULL UNIQUE,
  `telefone` VARCHAR(25) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Tabela `projetophp`.`veiculos` (RF1: CRUD de Veículos)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetophp`.`veiculos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `placa` VARCHAR(10) NOT NULL UNIQUE,
  `marca` VARCHAR(100) NULL,
  `modelo` VARCHAR(100) NULL,
  `cor` VARCHAR(50) NULL,
  `cliente_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_veiculos_clientes_idx` (`cliente_id` ASC),
  CONSTRAINT `fk_veiculos_clientes`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `projetophp`.`clientes` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Tabela `projetophp`.`vagas` (RF3: CRUD de Vagas)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetophp`.`vagas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `codigo` VARCHAR(10) NOT NULL UNIQUE,
  `status` ENUM('disponivel', 'ocupada') NOT NULL DEFAULT 'disponivel',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Tabela `projetophp`.`registros` (RF4: Entradas e Saídas)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetophp`.`registros` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `veiculo_id` INT NOT NULL,
  `vaga_id` INT NOT NULL,
  `data_entrada` DATETIME NOT NULL,
  `data_saida` DATETIME NULL,
  `valor_pago` DECIMAL(10,2) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_registros_veiculos_idx` (`veiculo_id` ASC),
  INDEX `fk_registros_vagas_idx` (`vaga_id` ASC),
  CONSTRAINT `fk_registros_veiculos`
    FOREIGN KEY (`veiculo_id`)
    REFERENCES `projetophp`.`veiculos` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_registros_vagas`
    FOREIGN KEY (`vaga_id`)
    REFERENCES `projetophp`.`vagas` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema estacionamento_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `estacionamento_db` DEFAULT CHARACTER SET utf8;
USE `estacionamento_db`;

-- -----------------------------------------------------
-- 1. Tabela Cliente
-- (Agora com Login: Email e Senha)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estacionamento_db`.`cliente` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `cpf` VARCHAR(14) NOT NULL,
  `telefone` VARCHAR(20) NULL,
  `email` VARCHAR(255) NOT NULL, -- Novo campo
  `senha` VARCHAR(255) NOT NULL, -- Novo campo
  PRIMARY KEY (`id`),
  UNIQUE INDEX `cpf_UNIQUE` (`cpf` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC)) -- Email único para login
ENGINE = InnoDB;

-- -----------------------------------------------------
-- 2. Tabela Vaga
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estacionamento_db`.`vaga` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `codigo` VARCHAR(10) NOT NULL,
  `status` ENUM('LIVRE', 'OCUPADA') NOT NULL DEFAULT 'LIVRE',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `codigo_UNIQUE` (`codigo` ASC))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- 3. Tabela Veículo
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estacionamento_db`.`veiculo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `placa` VARCHAR(10) NOT NULL,
  `modelo` VARCHAR(100) NOT NULL,
  `cor` VARCHAR(50) NULL,
  `cliente_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `placa_UNIQUE` (`placa` ASC),
  INDEX `fk_veiculo_cliente_idx` (`cliente_id` ASC),
  CONSTRAINT `fk_veiculo_cliente`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `estacionamento_db`.`cliente` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- 4. Tabela Movimentação
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `estacionamento_db`.`movimentacao` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `veiculo_id` INT NOT NULL,
  `vaga_id` INT NOT NULL,
  `data_entrada` DATETIME NOT NULL,
  `data_saida` DATETIME NULL,
  `valor_total` DECIMAL(10,2) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_movimentacao_veiculo_idx` (`veiculo_id` ASC),
  INDEX `fk_movimentacao_vaga_idx` (`vaga_id` ASC),
  CONSTRAINT `fk_movimentacao_veiculo`
    FOREIGN KEY (`veiculo_id`)
    REFERENCES `estacionamento_db`.`veiculo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimentacao_vaga`
    FOREIGN KEY (`vaga_id`)
    REFERENCES `estacionamento_db`.`vaga` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema campeonatophp
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `campeonatophp` DEFAULT CHARACTER SET utf8;
USE `campeonatophp`;

-- -----------------------------------------------------
-- 1. Tabela Organizador
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `campeonatophp`.`organizador` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- 2. Tabela Campeonato
-- (Agora ligada ao Organizador)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `campeonatophp`.`campeonato` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `organizador_id` INT NOT NULL, -- FK: Quem criou o campeonato
  PRIMARY KEY (`id`),
  INDEX `fk_campeonato_organizador_idx` (`organizador_id` ASC),
  CONSTRAINT `fk_campeonato_organizador`
    FOREIGN KEY (`organizador_id`)
    REFERENCES `campeonatophp`.`organizador` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- 3. Tabela Equipe (Antiga 'time')
-- (Cada equipe pertence a UM campeonato)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `campeonatophp`.`equipe` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `campeonato_id` INT NOT NULL, -- FK: A qual campeonato esse time pertence
  PRIMARY KEY (`id`),
  INDEX `fk_equipe_campeonato_idx` (`campeonato_id` ASC),
  CONSTRAINT `fk_equipe_campeonato`
    FOREIGN KEY (`campeonato_id`)
    REFERENCES `campeonatophp`.`campeonato` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- 4. Tabela Partida
-- (Liga dois times e o campeonato)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `campeonatophp`.`partida` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `campeonato_id` INT NOT NULL,
  `time_casa_id` INT NOT NULL,      -- Referencia ID da equipe
  `time_visitante_id` INT NOT NULL, -- Referencia ID da equipe
  `placar_casa` INT NULL,
  `placar_visitante` INT NULL,
  PRIMARY KEY (`id`),
  
  INDEX `fk_partida_campeonato_idx` (`campeonato_id` ASC),
  INDEX `fk_partida_time_casa_idx` (`time_casa_id` ASC),
  INDEX `fk_partida_time_visitante_idx` (`time_visitante_id` ASC),
  
  CONSTRAINT `fk_partida_campeonato`
    FOREIGN KEY (`campeonato_id`)
    REFERENCES `campeonatophp`.`campeonato` (`id`)
    ON DELETE CASCADE,
    
  CONSTRAINT `fk_partida_time_casa`
    FOREIGN KEY (`time_casa_id`)
    REFERENCES `campeonatophp`.`equipe` (`id`)
    ON DELETE NO ACTION,
    
  CONSTRAINT `fk_partida_time_visitante`
    FOREIGN KEY (`time_visitante_id`)
    REFERENCES `campeonatophp`.`equipe` (`id`)
    ON DELETE NO ACTION)
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
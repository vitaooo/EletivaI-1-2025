SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `academiaphp` DEFAULT CHARACTER SET utf8;
USE `academiaphp`;

-- 1. Tabela Usuário (Admin do sistema)
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC)
) ENGINE = InnoDB;

-- 2. Tabela Planos (Ex: Mensal, Anual)
CREATE TABLE IF NOT EXISTS `plano` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `valor` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- 3. Tabela Professores
CREATE TABLE IF NOT EXISTS `professor` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `especialidade` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- 4. Tabela Alunos
CREATE TABLE IF NOT EXISTS `aluno` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NULL,
  `data_nascimento` DATE NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- 5. Tabela Matrículas (Relaciona Aluno, Professor e Plano)
CREATE TABLE IF NOT EXISTS `matricula` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `aluno_id` INT NOT NULL,
  `professor_id` INT NOT NULL,
  `plano_id` INT NOT NULL,
  `data_inicio` DATE NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_matricula_aluno`
    FOREIGN KEY (`aluno_id`) REFERENCES `aluno` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_matricula_professor`
    FOREIGN KEY (`professor_id`) REFERENCES `professor` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_matricula_plano`
    FOREIGN KEY (`plano_id`) REFERENCES `plano` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- Inserir um usuário padrão (senha: 123) se quiser testar rápido
-- INSERT INTO usuario (nome, email, senha) VALUES ('Admin', 'admin@academia.com', '$2y$10$8.XH/X.XH/X.XH/X.XH/X.XH/X.XH/X.XH/X.XH/X.XH/X.XH');
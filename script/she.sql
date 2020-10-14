CREATE DATABASE IF NOT EXISTS `she` DEFAULT CHARACTER SET utf8 ;
USE `she` ;

-- -----------------------------------------------------
-- Table `mydb`.`curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `curso` (
  `id` INT NOT NULL auto_increment,
  `nome` VARCHAR(255) NOT NULL,
  `sigla` VARCHAR(5) NOT NULL,
  `data_registro` DATETIME NOT NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `mydb`.`administrador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `administrador` (
  `id` INT NOT NULL auto_increment,
  `matricula` VARCHAR(20) NOT NULL,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `senha` VARCHAR(32) NOT NULL,
  `data_registro` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `mydb`.`aluno`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aluno` (
  `id` INT NOT NULL auto_increment,
  `matricula` VARCHAR(20) NOT NULL,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `senha` VARCHAR(32) NOT NULL,
  `turno` INT NOT NULL,
  `status` TINYINT NULL,
  `info_cadastro` VARCHAR(100),
  `data_registro` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `curso_id` INT NOT NULL,
  `administrador_id` INT,
  PRIMARY KEY (`id`),
  
    FOREIGN KEY (`curso_id`)
    REFERENCES `curso` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
      FOREIGN KEY (`administrador_id`)
    REFERENCES `administrador` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `mydb`.`atividade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `atividade` (
  `id` INT NOT NULL auto_increment,
  `nome` VARCHAR(50) NOT NULL,
  `descricao` VARCHAR(255) NULL,
  `max_horas` INT NOT NULL,
  `data_registro` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `mydb`.`aluno_atividade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aluno_atividade` (
  `id` INT NOT NULL auto_increment,
  `descricao` VARCHAR(300) NOT NULL,
  `horas_registradas` INT NOT NULL,
  `status` TINYINT NOT NULL,
  `arquivo` VARCHAR(255) NULL,
  `data_registro` DATETIME NOT NULL,
  `aluno_id` INT NOT NULL,
  `atividade_id` INT NOT NULL,
  `administrador_id` INT NOT NULL,
  PRIMARY KEY (`id`, `aluno_id`, `atividade_id`, `administrador_id`),
 
    FOREIGN KEY (`atividade_id`)
    REFERENCES `atividade` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
 
    FOREIGN KEY (`aluno_id`)
    REFERENCES `aluno` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  
    FOREIGN KEY (`administrador_id`)
    REFERENCES `administrador` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

INSERT INTO curso (nome, sigla, data_registro) VALUES ('Sistema da Informação', 'SI', '2020-01-01 00:00:00');
INSERT INTO curso (nome, sigla, data_registro) VALUES ('Gestão Ambiental', 'GA', '2020-01-01 00:00:00');
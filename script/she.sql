-- MySQL Script generated by MySQL Workbench
-- qua 21 out 2020 15:33:06
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema she
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `she` ;

-- -----------------------------------------------------
-- Schema she
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `she` ;
USE `she` ;

-- -----------------------------------------------------
-- Table `she`.`administrador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `she`.`administrador` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `matricula` VARCHAR(20) NOT NULL,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `senha` VARCHAR(32) NOT NULL,
  `data_registro` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `she`.`curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `she`.`curso` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `sigla` VARCHAR(5) NOT NULL,
  `data_registro` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `she`.`aluno`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `she`.`aluno` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `matricula` VARCHAR(20) NOT NULL,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `senha` VARCHAR(32) NOT NULL,
  `turno` INT NOT NULL,
  `status` TINYINT NULL DEFAULT NULL,
  `info_cadastro` VARCHAR(100) NULL DEFAULT NULL,
  `data_registro` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `curso_id` INT NOT NULL,
  `administrador_id` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  -- INDEX `curso_id` (`curso_id` ASC) VISIBLE,
  -- INDEX `administrador_id` (`administrador_id` ASC) VISIBLE,
  CONSTRAINT `aluno_ibfk_1`
    FOREIGN KEY (`curso_id`)
    REFERENCES `she`.`curso` (`id`),
  CONSTRAINT `aluno_ibfk_2`
    FOREIGN KEY (`administrador_id`)
    REFERENCES `she`.`administrador` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

-- -----------------------------------------------------
-- Table `she`.`dimensao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `she`.`dimensao` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `max_horas` INT NOT NULL,
  `data_registro` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
  ENGINE = InnoDB
  DEFAULT CHARACTER SET = utf8;

-- -----------------------------------------------------
-- Table `she`.`atividade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `she`.`atividade` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `modo_comprovacao` VARCHAR(255) NULL DEFAULT NULL,
  `max_horas` INT NOT NULL,
  `data_registro` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dimensao_id` INT NOT NULL,
  -- INDEX `fk_atividade_dimensao1_idx` (`dimensao_id` ASC) VISIBLE,
  CONSTRAINT `fk_atividade_dimensao1`
    FOREIGN KEY (`dimensao_id`)
    REFERENCES `she`.`dimensao` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `she`.`aluno_atividade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `she`.`aluno_atividade` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(300) NOT NULL,
  `carga_horaria` TIME NOT NULL,
  `status` TINYINT NULL DEFAULT -1,
  `arquivo` VARCHAR(255) NOT NULL,
  `data_inicial` DATE NOT NULL,
  `data_final` DATE NOT NULL,
  `hora_inicial` TIME NULL DEFAULT '00:00:00',
  `hora_final` TIME NULL DEFAULT '00:00:00',
  `observacao` VARCHAR(1000) NULL,
  `motivo` VARCHAR(255) NULL,
  `aluno_id` INT NOT NULL,
  `atividade_id` INT NOT NULL,
  `administrador_id` INT NULL DEFAULT NULL,
  `data_registro` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (`id`, `aluno_id`, `atividade_id`),
  -- INDEX `atividade_id` (`atividade_id` ASC) VISIBLE,
  -- INDEX `aluno_id` (`aluno_id` ASC) VISIBLE,
  CONSTRAINT `aluno_atividade_ibfk_1`
    FOREIGN KEY (`atividade_id`)
    REFERENCES `she`.`atividade` (`id`),
  CONSTRAINT `aluno_atividade_ibfk_2`
    FOREIGN KEY (`aluno_id`)
    REFERENCES `she`.`aluno` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- SET SQL_MODE=@OLD_SQL_MODE;
-- SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
-- SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- Dados da Tabela Curso
INSERT INTO curso (nome, sigla, data_registro) VALUES ('Sistema da Informação', 'SI', DEFAULT);
INSERT INTO curso (nome, sigla, data_registro) VALUES ('Gestão Ambiental', 'GA', DEFAULT);

-- Dados da Tabela Administrador
INSERT INTO administrador (matricula, nome, email, senha, data_registro) VALUES ('123456789', 'Administrador', 'administrador@admin.com','e10adc3949ba59abbe56e057f20f883e', DEFAULT); 

-- Dados da Tabela Dimensão
INSERT INTO dimensao(nome, max_horas, data_registro) VALUES ('ENSINO', 60, DEFAULT);
INSERT INTO dimensao(nome, max_horas, data_registro) VALUES ('PESQUISA', 60, DEFAULT);
INSERT INTO dimensao(nome, max_horas, data_registro) VALUES ('EXTENSÃO', 60, DEFAULT);
INSERT INTO dimensao(nome, max_horas, data_registro) VALUES ('ATIVIDADES EXTRAS', 40, DEFAULT);

-- Dados da Tabela Atividade
INSERT INTO atividade (nome, modo_comprovacao, max_horas, data_registro, dimensao_id) VALUES("Disciplinas cursadas além da grade regular do curso", "Secretaria Geral", 50, DEFAULT,1);
INSERT INTO atividade (nome, modo_comprovacao, max_horas, data_registro, dimensao_id) VALUES("Participação de curso ministrado pela FAETERJ", "Coord. de Extensão", 40, DEFAULT,1);
INSERT INTO atividade (nome, modo_comprovacao, max_horas, data_registro, dimensao_id) VALUES("Cursos externos correlatos ao curso do aluno", "Certificado do curso", 40, DEFAULT,1);
INSERT INTO atividade (nome, modo_comprovacao, max_horas, data_registro, dimensao_id) VALUES("Participação como ouvinte em palestras correlatas ao curso do aluno", "Certificado da palestra / Ata de presença (quando realizada pela IES)", 10, DEFAULT,1);
INSERT INTO atividade (nome, modo_comprovacao, max_horas, data_registro, dimensao_id) VALUES("Iniciação tecnológica e/ou científica", "Certificado", 40, DEFAULT,2);
INSERT INTO atividade (nome, modo_comprovacao, max_horas, data_registro, dimensao_id) VALUES("Trabalhos publicados em periódicos científicos indexados", "Cópia do trabalho", 20, DEFAULT,2);
INSERT INTO atividade (nome, modo_comprovacao, max_horas, data_registro, dimensao_id) VALUES("Trabalhos publicados em periódicos científicos não indexados", "Cópia do trabalho", 10, DEFAULT,2) ;
INSERT INTO atividade (nome, modo_comprovacao, max_horas, data_registro, dimensao_id) VALUES("Trabalhos apresentados em eventos científicos", "Certificado do evento e cópia do resumo", 10, DEFAULT,2);
INSERT INTO atividade (nome, modo_comprovacao, max_horas, data_registro, dimensao_id) VALUES("Participação na publicação de capítulos de livros/revistas científicas", "Copia do trabalho", 10, DEFAULT,2);
INSERT INTO atividade (nome, modo_comprovacao, max_horas, data_registro, dimensao_id) VALUES("Participação em pesquisa ou projetos institucionais na IES", "Coord. de Pesquisa", 20, DEFAULT,2);
INSERT INTO atividade (nome, modo_comprovacao, max_horas, data_registro, dimensao_id) VALUES("Visita técnica", "Certificado / Ata de presença (quando realizada pela IES)", 20, DEFAULT,3);
INSERT INTO atividade (nome, modo_comprovacao, max_horas, data_registro, dimensao_id) VALUES("Participação como ouvinte em banca de TCC", "Ata de presença", 10, DEFAULT,3);
INSERT INTO atividade (nome, modo_comprovacao, max_horas, data_registro, dimensao_id) VALUES("Participação em projeto voltado para a comunidade e/ou de interesse da Instituição.", "Certificado / Comprovante ", 40, DEFAULT,3);
INSERT INTO atividade (nome, modo_comprovacao, max_horas, data_registro, dimensao_id) VALUES("Eventos acadêmicos promovidos por instituições/ órgãos oficiais relacionados à formação profissional do aluno", "Certificado", 15, DEFAULT,3) ;
INSERT INTO atividade (nome, modo_comprovacao, max_horas, data_registro, dimensao_id) VALUES("Representação estudantil em conselho, colegiado e diretório acadêmico.", "Direção ou Coord. de Curso", 15, DEFAULT,3);
INSERT INTO atividade (nome, modo_comprovacao, max_horas, data_registro, dimensao_id) VALUES("Atividades culturais: teatro, cinema, museu,  etc.", "Comprovante da Atividade", 10, DEFAULT,3);
INSERT INTO atividade (nome, modo_comprovacao, max_horas, data_registro, dimensao_id) VALUES("Ministrar curso na FAETERJ", "Certificado pela Coord. de Extensão", 30, DEFAULT,3);
INSERT INTO atividade (nome, modo_comprovacao, max_horas, data_registro, dimensao_id) VALUES("Monitoria (eventos na FAETERJ, externa, de disciplina concluída, de projeto)", "Declaração", 60, DEFAULT,3);
INSERT INTO atividade (nome, modo_comprovacao, max_horas, data_registro, dimensao_id) VALUES("Apresentação de TCC", "Cópia da ata", 5, DEFAULT,4);
INSERT INTO atividade (nome, modo_comprovacao, max_horas, data_registro, dimensao_id) VALUES("Participação em Empresa Junior", "Registro de posse em ata", 30, DEFAULT,4);
INSERT INTO atividade (nome, modo_comprovacao, max_horas, data_registro, dimensao_id) VALUES("Participação em simulado promovido pela IES", "Ata de presença", 20, DEFAULT,4);
INSERT INTO atividade (nome, modo_comprovacao, max_horas, data_registro, dimensao_id) VALUES("Participação em avaliação institucional promovida pela IES", "Ata de presença", 20, DEFAULT,4);
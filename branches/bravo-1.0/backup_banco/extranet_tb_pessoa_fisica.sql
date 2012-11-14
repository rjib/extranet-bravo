CREATE DATABASE  IF NOT EXISTS `extranet` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `extranet`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: extranet
-- ------------------------------------------------------
-- Server version	5.5.24-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tb_pessoa_fisica`
--

DROP TABLE IF EXISTS `tb_pessoa_fisica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_pessoa_fisica` (
  `CO_PESSOA_FISICA` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo da pessoa fisica (Primary Key).',
  `CO_PESSOA` int(11) NOT NULL COMMENT 'Codigo da pessoa (Foreign Key).',
  `CO_ESTADO_CIVIL` int(11) NOT NULL COMMENT 'Codigo do estado civil (Foreign Key).',
  `CPF_PESSOA_FISICA` varchar(14) DEFAULT NULL COMMENT 'CPF da pessoa fisica.',
  `RG_PESSOA_FISICA` varchar(20) DEFAULT NULL COMMENT 'RG  da pessoa fisica.',
  `RG_ORGAO_PESSOA_FISICA` varchar(10) DEFAULT NULL,
  `DT_EMISSAO_RG_PESSOA_FISICA` date DEFAULT NULL COMMENT 'Data emissao RG da pessoa fisica.',
  `DT_NASCIMENTO_PESSOA_FISICA` date DEFAULT NULL COMMENT 'Data de nascimento da pessoa fisica.',
  `TP_SEXO_PESSOA_FISICA` char(1) DEFAULT NULL COMMENT 'Tipo do sexo da pessoa fisica: M - Masculino, F - Feminino.',
  `CO_NACIONALIDADE` int(11) NOT NULL COMMENT 'Codigo do nacionalidade (Foreign Key).',
  `CO_UF` int(11) NOT NULL COMMENT 'Codigo da unidade federativa (Foreign Key).',
  `CO_MUNICIPIO` int(11) NOT NULL COMMENT 'Codigo do municipio (Foreign Key).',
  `CO_NIVEL_FORMACAO` int(11) NOT NULL COMMENT 'Codigo do nivel de formacao (Foreign Key).',
  `CO_PROFISSAO` int(11) DEFAULT NULL COMMENT 'Codigo da profissao (Foreign Key).',
  `NO_PAI` varchar(180) DEFAULT NULL,
  `NO_MAE` varchar(180) DEFAULT NULL,
  PRIMARY KEY (`CO_PESSOA_FISICA`),
  UNIQUE KEY `UK_PESSOA_FISICA_CPF_PESSOA_FISICA` (`CPF_PESSOA_FISICA`),
  UNIQUE KEY `UK_PESSOA_FISICA_RG_PESSOA_FISICA` (`RG_PESSOA_FISICA`),
  KEY `IX_PESSOA_FISICA_CO_PESSOA` (`CO_PESSOA`),
  KEY `IX_PESSOA_FISICA_CO_ESTADO_CIVIL` (`CO_ESTADO_CIVIL`),
  KEY `IX_PESSOA_FISICA_CO_NACIONALIDADE` (`CO_NACIONALIDADE`),
  KEY `IX_PESSOA_FISICA_CO_UF` (`CO_UF`),
  KEY `IX_PESSOA_FISICA_CO_MUNICIPIO` (`CO_MUNICIPIO`),
  KEY `IX_PESSOA_FISICA_CO_NIVEL_FORMACAO` (`CO_NIVEL_FORMACAO`),
  KEY `IX_PESSOA_FISICA_CO_PROFISSAO` (`CO_PROFISSAO`),
  CONSTRAINT `FK_ESTADO_CIVIL_PESSOA_FISICA` FOREIGN KEY (`CO_ESTADO_CIVIL`) REFERENCES `tb_estado_civil` (`CO_ESTADO_CIVIL`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_MUNICIPIO_PESSOA_FISICA` FOREIGN KEY (`CO_MUNICIPIO`) REFERENCES `tb_municipio` (`CO_MUNICIPIO`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_NACIONALIDADE_PESSOA_FISICA` FOREIGN KEY (`CO_NACIONALIDADE`) REFERENCES `tb_nacionalidade` (`CO_NACIONALIDADE`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_NIVEL_FORMACAO_PESSOA_FISICA` FOREIGN KEY (`CO_NIVEL_FORMACAO`) REFERENCES `tb_nivel_formacao` (`CO_NIVEL_FORMACAO`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_PESSOA_PESSOA_FISICA` FOREIGN KEY (`CO_PESSOA`) REFERENCES `tb_pessoa` (`CO_PESSOA`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_PROFISSAO_PESSOA_FISICA` FOREIGN KEY (`CO_PROFISSAO`) REFERENCES `tb_profissao` (`CO_PROFISSAO`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_UF_PESSOA_FISICA` FOREIGN KEY (`CO_UF`) REFERENCES `tb_uf` (`CO_UF`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1 COMMENT='Tabela de Pessoa Fisica.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pessoa_fisica`
--

LOCK TABLES `tb_pessoa_fisica` WRITE;
/*!40000 ALTER TABLE `tb_pessoa_fisica` DISABLE KEYS */;
INSERT INTO `tb_pessoa_fisica` VALUES (6,6,1,'015.306.896-51','13.733.383','SSPMG','2001-01-21','1987-02-27','M',1,13,4048,2,318,'Euripedes Silva','Sonia'),(7,8,1,'235.423.542-44','76.876.876','SSPMG','2001-01-21','1987-02-27','F',1,13,4048,2,318,'',''),(8,9,1,'076.665.886-40','15.327.170','PC/MG','2004-06-08','1986-01-18','F',1,13,4071,8,318,'JOSE MARCILIO FERREIRA','VALDERINA CRUZEIRO FERREIRA'),(9,11,4,'098.064.088-10','21.772.161','SSP/SP','1986-12-03','1971-09-28','M',1,25,9080,11,318,'AVELINO CASA GRANDI','ANTONIA CANDIDO BORGES CASA GRANDI'),(10,12,4,'102.860.598-60','25.128.703','SSP/SP','2008-06-11','1970-09-25','F',1,25,9274,8,318,'CARLOS ALVES VILELA','TEREZA PEREIRA VILELA'),(11,14,1,'016.198.836-94','MG13030394','SSPMG','2000-05-22','1989-01-08','M',1,13,4071,8,318,'MAURICIO DE OLIVEIRA CALDAS','CATARINA MENDES DE OLIVEIRA'),(12,16,5,'065.792.496-25','MG11481118','SSP/MG','1997-10-01','1981-07-14','F',1,13,4048,8,463,'AILTON QUIRINO DA SILVA','LAZARA MARIA DA SILVA'),(13,18,5,'911.194.306-82','M6686866','SSP/MG','1990-05-09','1977-03-12','M',1,13,3275,5,319,'MILTON VIEIRA BRITO','LUZIA VIEIRA BRITO'),(14,19,1,'077.308.716-88','MG13061409','SSPMG','1999-06-08','1986-06-06','M',1,13,4071,10,462,'JOSE AUGUSTO DINIZ','MARIETA DE JESUS FERREIRA DINIZ'),(15,20,1,'087.243.986-08','04404937309','DETRAN MG','2010-03-13','1988-12-13','M',1,10,2475,9,322,'EDVALDO INEZ DE PAULO','AINOAN PEREIRA DE SOUZA'),(16,26,1,'115.768.256-12','MG1321540','SSPMG','2000-05-05','1991-07-08','M',1,13,4048,10,327,'',''),(17,27,2,'111.111.111-11','SP14111','GGG','0000-08-08','0707-07-08','M',2,7,1786,3,327,'',''),(18,28,1,'015.042.996-71','mg11419762','mg11','1998-10-01','1982-10-07','M',1,13,4048,9,327,'José antonio alvarenga','cleusa maria dos santos'),(23,32,1,'015.042.996-72','mg11419763','ssp','1999-05-01','1982-10-01','M',1,13,4048,9,441,'jose antonio alvarenga','cleusa maria dos santos');
/*!40000 ALTER TABLE `tb_pessoa_fisica` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-11-14 17:47:50

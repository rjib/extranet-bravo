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
-- Table structure for table `tb_colaborador`
--

DROP TABLE IF EXISTS `tb_colaborador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_colaborador` (
  `CO_COLABORADOR` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo do colaborador (Primary Key).',
  `DT_CADAS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data e Hora de cadastro do colaborador.',
  `CO_PESSOA` int(11) NOT NULL COMMENT 'Codigo da pessoa (Foreign Key).',
  `CO_CARGO` int(11) NOT NULL COMMENT 'Codigo do cargo (Foreign Key).',
  `CO_SETOR` int(11) NOT NULL COMMENT 'Codigo do setor (Foreign Key).',
  `CO_TIPO_SANGUINEO` int(11) NOT NULL COMMENT 'Codigo do Tipo Sanguineo (Foreign Key).',
  `OBS_COLABORADOR` text COMMENT 'Observacao do colaborador.',
  PRIMARY KEY (`CO_COLABORADOR`),
  UNIQUE KEY `UK_COLABORADOR_CO_PESSOA` (`CO_PESSOA`),
  KEY `IX_COLABORADOR_CO_PESSOA` (`CO_PESSOA`),
  KEY `IX_COLABORADOR_CO_CARGO` (`CO_CARGO`),
  KEY `IX_COLABORADOR_CO_SETOR` (`CO_SETOR`),
  KEY `IX_COLABORADOR_CO_TIPO_SANGUINEO` (`CO_TIPO_SANGUINEO`),
  CONSTRAINT `FK_CARGO_COLABORADOR` FOREIGN KEY (`CO_CARGO`) REFERENCES `tb_cargo` (`CO_CARGO`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_PESSOA_COLABORADOR` FOREIGN KEY (`CO_PESSOA`) REFERENCES `tb_pessoa` (`CO_PESSOA`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_SETOR_COLABORADOR` FOREIGN KEY (`CO_SETOR`) REFERENCES `tb_setor` (`CO_SETOR`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_TIPO_SANGUINEO_COLABORADOR` FOREIGN KEY (`CO_TIPO_SANGUINEO`) REFERENCES `tb_tipo_sanguineo` (`CO_TIPO_SANGUINEO`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COMMENT='Tabela de Colaborador.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_colaborador`
--

LOCK TABLES `tb_colaborador` WRITE;
/*!40000 ALTER TABLE `tb_colaborador` DISABLE KEYS */;
INSERT INTO `tb_colaborador` VALUES (1,'2012-11-16 18:53:44',1,1,1,1,'Observação colaborador'),(2,'2012-11-19 12:03:34',2,1,1,1,''),(3,'2012-11-19 12:57:40',6,2,3,3,''),(4,'2012-11-19 13:11:59',7,3,3,3,''),(5,'2012-11-19 15:31:04',8,2,3,3,''),(6,'2012-11-19 15:31:21',9,2,3,3,''),(7,'2012-11-19 15:31:39',10,3,3,3,'');
/*!40000 ALTER TABLE `tb_colaborador` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-12-07 14:05:44

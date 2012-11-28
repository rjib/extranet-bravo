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
-- Table structure for table `tb_telefone`
--

DROP TABLE IF EXISTS `tb_telefone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_telefone` (
  `CO_TELEFONE` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo do telefone (Primary Key).',
  `DT_CADAS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data e Hora cadastro contato.',
  `CO_PESSOA` int(11) NOT NULL COMMENT 'Codigo da pessoa (Foreign Key).',
  `CO_CONTATO` int(11) NOT NULL COMMENT 'Codigo do contato (Foreign Key).',
  `CO_TIPO_TELEFONE` int(11) NOT NULL COMMENT 'Codigo do tipo de telefone (Foreign Key).',
  `NU_TELEFONE` varchar(14) NOT NULL COMMENT 'Numero do telefone.',
  `FL_FICHA_PESSOA_FISICA` char(1) DEFAULT NULL COMMENT 'Flag se mostra na ficha de pessoa fisica, S - Sim.',
  PRIMARY KEY (`CO_TELEFONE`),
  KEY `IX_TELEFONE_CO_CONTATO` (`CO_CONTATO`),
  KEY `IX_TELEFONE_TIPO_TELEFONE` (`CO_TIPO_TELEFONE`),
  KEY `IX_TELEFONE_CO_PESSOA` (`CO_PESSOA`),
  CONSTRAINT `FK_TELEFONE_CONTATO` FOREIGN KEY (`CO_CONTATO`) REFERENCES `tb_contato` (`CO_CONTATO`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_TELEFONE_PESSOA` FOREIGN KEY (`CO_PESSOA`) REFERENCES `tb_pessoa` (`CO_PESSOA`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_TELEFONE_TIPO_TELEFONE` FOREIGN KEY (`CO_TIPO_TELEFONE`) REFERENCES `tb_tipo_telefone` (`CO_TIPO_TELEFONE`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COMMENT='Tabela de Contato.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_telefone`
--

LOCK TABLES `tb_telefone` WRITE;
/*!40000 ALTER TABLE `tb_telefone` DISABLE KEYS */;
INSERT INTO `tb_telefone` VALUES (3,'2012-11-19 11:25:18',1,34,3,'(34) 9199-0176',''),(4,'2012-11-19 13:09:08',7,35,3,'(34) 9203-1020',''),(5,'2012-11-19 13:09:30',7,35,5,'(34) 3120-5368',''),(6,'2012-11-19 15:30:01',10,36,3,'(34) 9195-9749','');
/*!40000 ALTER TABLE `tb_telefone` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-11-28 16:22:33

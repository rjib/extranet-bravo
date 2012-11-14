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
-- Table structure for table `tb_endereco`
--

DROP TABLE IF EXISTS `tb_endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_endereco` (
  `CO_ENDERECO` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo da endereco (Primary Key).',
  `DT_CADAS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data e Hora de cadastro do endereco.',
  `CO_PESSOA` int(11) NOT NULL COMMENT 'Codigo da pessoa (Foreign Key).',
  `CO_CEP` int(11) NOT NULL COMMENT 'Codigo do cep (Foreign Key).',
  `NU_ENDERECO` varchar(10) NOT NULL COMMENT 'Numero do logradouro.',
  `COMP_ENDERECO` varchar(80) DEFAULT NULL COMMENT 'Complemento do endereco.',
  `TP_PRINCIPAL` varchar(3) DEFAULT NULL COMMENT 'Tipo do endereco e o principal: S - Sim.',
  `TP_COBRANCA` varchar(3) DEFAULT NULL COMMENT 'Tipo do endereco e o de Cobranca: S - Sim.',
  `TP_CORRESPONDENCIA` varchar(3) DEFAULT NULL COMMENT 'Tipo do endereco e o de Correspondencia: S - Sim.',
  PRIMARY KEY (`CO_ENDERECO`),
  KEY `IX_ENDERECO_CO_PESSOA` (`CO_PESSOA`),
  KEY `IX_ENDERECO_CO_CEP` (`CO_CEP`),
  CONSTRAINT `FK_CEP_ENDERECO` FOREIGN KEY (`CO_CEP`) REFERENCES `tb_cep` (`CO_CEP`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_PESSOA_ENDERECO` FOREIGN KEY (`CO_PESSOA`) REFERENCES `tb_pessoa` (`CO_PESSOA`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1 COMMENT='Tabela de Endereco.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_endereco`
--

LOCK TABLES `tb_endereco` WRITE;
/*!40000 ALTER TABLE `tb_endereco` DISABLE KEYS */;
INSERT INTO `tb_endereco` VALUES (1,'2012-07-19 00:12:38',6,13688,'101','','S','',''),(2,'2012-07-19 00:12:50',6,13688,'110','','','S',''),(3,'2012-07-19 01:56:06',7,13688,'100','','S','',''),(4,'2012-07-19 01:56:14',7,13688,'200','','','S',''),(5,'2012-08-25 14:36:33',9,25276,'3738','APTO 302','S','','S'),(6,'2012-08-25 15:02:06',10,36212,'296','','S','',''),(7,'2012-08-25 16:09:30',13,7855,'6835','LOTE 1C GLEBAS','S','',''),(8,'2012-08-25 16:34:39',12,50086,'426','APTO 203','S','',''),(9,'2012-08-25 16:38:15',11,50086,'426','APTO 203','S','',''),(10,'2012-09-03 22:15:14',14,60502,'670','CASA','S','','S'),(11,'2012-09-17 18:20:01',16,54256,'370','','S','','S'),(12,'2012-09-17 18:30:06',17,55037,'916','','S','','S'),(13,'2012-09-17 18:38:53',18,54256,'370','','S','','S'),(14,'2012-09-18 13:56:25',20,22597,'354','','S','','S'),(15,'2012-09-18 14:02:50',21,3146,'2001','DISTRITO INDUSTRIAL','S','',''),(16,'2012-09-18 15:04:34',6,60503,'100','','','S',''),(17,'2012-09-18 15:04:50',6,60505,'90','','','',''),(18,'2012-09-18 17:36:40',22,60505,'20','','S','',''),(24,'2012-10-10 17:09:52',32,59878,'121','','','','S'),(25,'2012-10-10 17:45:15',32,306,'554','','S','',''),(41,'2012-10-11 12:22:04',15,59878,'5','','','S',''),(42,'2012-10-11 12:22:56',15,39318,'222','','','','');
/*!40000 ALTER TABLE `tb_endereco` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-11-14 17:47:46

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COMMENT='Tabela de Endereco.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_endereco`
--

LOCK TABLES `tb_endereco` WRITE;
/*!40000 ALTER TABLE `tb_endereco` DISABLE KEYS */;
INSERT INTO `tb_endereco` VALUES (4,'2012-11-19 10:32:31',1,59878,'121','','S','S','S'),(6,'2012-11-19 12:51:53',6,1773,'68','','S','',''),(7,'2012-11-19 13:08:21',7,29620,'162','','S','',''),(8,'2012-11-19 15:18:23',9,60267,'858','','S','','');
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

-- Dump completed on 2012-11-20 10:39:11

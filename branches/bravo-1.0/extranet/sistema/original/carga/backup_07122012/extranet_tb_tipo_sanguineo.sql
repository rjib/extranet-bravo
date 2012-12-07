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
-- Table structure for table `tb_tipo_sanguineo`
--

DROP TABLE IF EXISTS `tb_tipo_sanguineo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_tipo_sanguineo` (
  `CO_TIPO_SANGUINEO` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo do tipo sanguineo (Primary Key).',
  `DT_CADAS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data e Hora de cadastro do tipo sanguineo.',
  `NO_TIPO_SANGUINEO` varchar(80) NOT NULL COMMENT 'Nome do tipo sanguineo.',
  `DS_TIPO_SANGUINEO` text COMMENT 'Descricao do tipo sanguineo.',
  PRIMARY KEY (`CO_TIPO_SANGUINEO`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='Tabela de Tipo Sanguineo.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_tipo_sanguineo`
--

LOCK TABLES `tb_tipo_sanguineo` WRITE;
/*!40000 ALTER TABLE `tb_tipo_sanguineo` DISABLE KEYS */;
INSERT INTO `tb_tipo_sanguineo` VALUES (1,'2012-06-14 02:12:05','A+',''),(2,'2012-06-14 02:12:24','A-',''),(3,'2012-10-04 19:27:37','O+',''),(4,'2012-10-04 19:27:56','AB','');
/*!40000 ALTER TABLE `tb_tipo_sanguineo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-12-07 14:05:41
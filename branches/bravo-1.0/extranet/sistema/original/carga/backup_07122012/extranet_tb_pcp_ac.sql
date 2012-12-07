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
-- Table structure for table `tb_pcp_ac`
--

DROP TABLE IF EXISTS `tb_pcp_ac`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_pcp_ac` (
  `CO_PCP_AC` int(11) NOT NULL AUTO_INCREMENT COMMENT 'chave primaria da tabela pcp_ac',
  `CO_PCP_AD` int(11) NOT NULL COMMENT 'Codigo do pcp ad (Foreign Key).',
  `DT_CADAS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data e Hora cadastro do ad.',
  PRIMARY KEY (`CO_PCP_AC`),
  KEY `IX_PCP_AC_CO_PCP_AD` (`CO_PCP_AD`),
  CONSTRAINT `FK_CO_PCP_AD_PCP_AC` FOREIGN KEY (`CO_PCP_AD`) REFERENCES `tb_pcp_ad` (`CO_PCP_AD`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1 COMMENT='Tabela de arquivos .AC depois de otimizado pelo optisave';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pcp_ac`
--

LOCK TABLES `tb_pcp_ac` WRITE;
/*!40000 ALTER TABLE `tb_pcp_ac` DISABLE KEYS */;
INSERT INTO `tb_pcp_ac` VALUES (57,43,'2012-12-03 12:12:57'),(58,44,'2012-12-03 12:18:49');
/*!40000 ALTER TABLE `tb_pcp_ac` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-12-07 14:05:40

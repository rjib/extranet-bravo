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
-- Table structure for table `tb_pcp_ad`
--

DROP TABLE IF EXISTS `tb_pcp_ad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_pcp_ad` (
  `CO_PCP_AD` int(11) NOT NULL COMMENT 'Codigo pcp do ad (Primary Key).',
  `DT_CADAS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data e Hora cadastro do ad.',
  `UN_COMPLEMENTAR` int(1) NOT NULL,
  PRIMARY KEY (`CO_PCP_AD`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela de arquivos .AD antes da optisave.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pcp_ad`
--

LOCK TABLES `tb_pcp_ad` WRITE;
/*!40000 ALTER TABLE `tb_pcp_ad` DISABLE KEYS */;
INSERT INTO `tb_pcp_ad` VALUES (1,'2012-11-08 12:05:47',5),(2,'2012-11-08 12:24:48',7);
/*!40000 ALTER TABLE `tb_pcp_ad` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-11-14 17:47:48

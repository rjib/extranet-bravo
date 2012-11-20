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
-- Table structure for table `tb_pcp_op`
--

DROP TABLE IF EXISTS `tb_pcp_op`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_pcp_op` (
  `CO_PCP_OP` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo pcp da op (Primary Key).',
  `CO_NUM` varchar(6) NOT NULL COMMENT 'Codigo da op.',
  `CO_ITEM` varchar(2) NOT NULL COMMENT 'Codigo do item.',
  `CO_SEQUENCIA` varchar(3) NOT NULL COMMENT 'Codigo da sequencia.',
  `CO_PRODUTO` varchar(15) NOT NULL COMMENT 'Codigo do produto.',
  `QTD_PRODUTO` varchar(10) NOT NULL COMMENT 'Quantidade do produto.',
  `QTD_PRODUZIDA` varchar(10) DEFAULT NULL COMMENT 'Quantidade produzida.',
  `DT_EMISSAO` varchar(8) NOT NULL COMMENT 'Data emissao op.',
  `DT_FIM` varchar(8) NOT NULL COMMENT 'Data fim op.',
  `NU_LOTE` varchar(10) DEFAULT NULL COMMENT 'Numero do lote.',
  `CO_RECNO` int(11) NOT NULL COMMENT 'Codigo do recno.',
  `CO_PCP_AD` int(11) DEFAULT NULL COMMENT 'Codigo do pcp ad (Foreign Key).',
  PRIMARY KEY (`CO_PCP_OP`,`CO_RECNO`),
  UNIQUE KEY `UK_PCP_OP_CO_RECNO` (`CO_RECNO`),
  KEY `IX_CO_PRODUTO` (`CO_PRODUTO`),
  KEY `IX_PCP_OP_CO_PCP_AD` (`CO_PCP_AD`),
  CONSTRAINT `FK_CO_PCP_AD_PCP_OP` FOREIGN KEY (`CO_PCP_AD`) REFERENCES `tb_pcp_ad` (`CO_PCP_AD`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela de ordens de producao';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pcp_op`
--

LOCK TABLES `tb_pcp_op` WRITE;
/*!40000 ALTER TABLE `tb_pcp_op` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_pcp_op` ENABLE KEYS */;
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

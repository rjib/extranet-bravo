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
-- Table structure for table `tb_pcp_produto`
--

DROP TABLE IF EXISTS `tb_pcp_produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_pcp_produto` (
  `CO_PCP_PRODUTO` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo pcp do produto (Primary Key).',
  `CO_PRODUTO` varchar(15) NOT NULL COMMENT 'Codigo do produto.',
  `CO_INT_PRODUTO` varchar(7) DEFAULT NULL COMMENT 'Codigo Interno do produto.',
  `CO_COR` varchar(6) DEFAULT NULL COMMENT 'Codigo da Cor.',
  `DS_PRODUTO` varchar(60) DEFAULT NULL COMMENT 'Descricao do produto.',
  `TP_PRODUTO` varchar(2) DEFAULT NULL COMMENT 'Tipo do produto.',
  `TP_UNIDADE` varchar(2) DEFAULT NULL COMMENT 'Tipo Unidade de Medida do produto.',
  `CO_LINHA` varchar(20) DEFAULT NULL COMMENT 'Codigo da Linda.',
  `NU_COMPRIMENTO` varchar(10) DEFAULT NULL COMMENT 'Numero comprimento do produto.',
  `NU_LARGURA` varchar(10) DEFAULT NULL COMMENT 'Numero largura do produto.',
  `NU_ESPESSURA` varchar(10) DEFAULT NULL COMMENT 'Numero espessura do produto.',
  `NU_PESO` varchar(10) DEFAULT NULL COMMENT 'Numero do peso do produto.',
  `CO_RECNO` int(11) NOT NULL COMMENT 'Codigo do recno.',
  PRIMARY KEY (`CO_PCP_PRODUTO`,`CO_RECNO`),
  UNIQUE KEY `UK_PCP_PRODUTO_CO_RECNO` (`CO_RECNO`),
  KEY `IX_CO_PRODUTO` (`CO_PRODUTO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela de produtos ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pcp_produto`
--

LOCK TABLES `tb_pcp_produto` WRITE;
/*!40000 ALTER TABLE `tb_pcp_produto` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_pcp_produto` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-11-20 10:39:14

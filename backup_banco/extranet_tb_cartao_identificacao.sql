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
-- Table structure for table `tb_cartao_identificacao`
--

DROP TABLE IF EXISTS `tb_cartao_identificacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_cartao_identificacao` (
  `CO_CARTAO_IDENTIFICACAO` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo do cartao (Primary Key).',
  `DT_CADAS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data e Hora cadastro cartao.',
  `NU_CARTAO_IDENTIFICACAO` char(3) NOT NULL COMMENT 'Numero de identificacao do cartao.',
  `DS_CARTAO_IDENTIFICACAO` text COMMENT 'Descricao do cartao de identificacao.',
  PRIMARY KEY (`CO_CARTAO_IDENTIFICACAO`),
  UNIQUE KEY `UK_CARTAO_IDENTIFICACAO_NU_CARTAO_IDENTIFICACAO` (`NU_CARTAO_IDENTIFICACAO`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COMMENT='Tabela de Setor.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_cartao_identificacao`
--

LOCK TABLES `tb_cartao_identificacao` WRITE;
/*!40000 ALTER TABLE `tb_cartao_identificacao` DISABLE KEYS */;
INSERT INTO `tb_cartao_identificacao` VALUES (2,'2012-09-20 17:20:32','001','Descrição'),(5,'2012-09-21 22:17:29','002',''),(6,'2012-09-21 22:26:12','003',''),(7,'2012-09-21 22:26:16','004',''),(8,'2012-09-21 22:26:21','005',''),(13,'2012-10-08 13:54:32','006','teste');
/*!40000 ALTER TABLE `tb_cartao_identificacao` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-11-14 17:47:47

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
-- Table structure for table `tb_setor`
--

DROP TABLE IF EXISTS `tb_setor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_setor` (
  `CO_SETOR` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo do setor (Primary Key).',
  `DT_CADAS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data e Hora cadastro setor.',
  `NO_SETOR` varchar(80) NOT NULL COMMENT 'Nome do setor.',
  `DS_SETOR` text COMMENT 'Descricao do setor.',
  PRIMARY KEY (`CO_SETOR`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COMMENT='Tabela de Setor.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_setor`
--

LOCK TABLES `tb_setor` WRITE;
/*!40000 ALTER TABLE `tb_setor` DISABLE KEYS */;
INSERT INTO `tb_setor` VALUES (1,'2012-06-13 22:36:07','Tecnologia da Informação','Tecnologia da Informação'),(2,'2012-06-13 22:36:18','Planejamento e Controle da Produção','Planejamento e Controle da Produção - PCP.'),(3,'2012-09-19 19:26:15','Portaria',''),(4,'2012-09-19 19:26:27','Industria',''),(5,'2012-09-19 19:26:48','RH',''),(6,'2012-09-19 19:26:54','Financeiro',''),(7,'2012-09-19 19:27:02','Comercial',''),(8,'2012-09-19 19:27:09','Engenharia',''),(9,'2012-09-19 19:27:19','Marketing','');
/*!40000 ALTER TABLE `tb_setor` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-11-14 17:47:49

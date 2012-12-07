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
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1 COMMENT='Tabela de Setor.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_cartao_identificacao`
--

LOCK TABLES `tb_cartao_identificacao` WRITE;
/*!40000 ALTER TABLE `tb_cartao_identificacao` DISABLE KEYS */;
INSERT INTO `tb_cartao_identificacao` VALUES (1,'2012-11-19 12:05:46','001','Cartão de Visitante.'),(2,'2012-11-20 12:08:34','002','Cartão de Visitante.'),(3,'2012-11-20 12:09:06','003','Cartão de Visitante.'),(4,'2012-11-20 12:09:10','004','Cartão de Visitante.'),(5,'2012-11-20 12:09:16','005','Cartão de Visitante.'),(6,'2012-11-20 12:09:20','006','Cartão de Visitante.'),(7,'2012-11-20 12:09:25','007','Cartão de Visitante.'),(8,'2012-11-20 12:09:29','008','Cartão de Visitante.'),(9,'2012-11-20 12:09:32','009','Cartão de Visitante.'),(10,'2012-11-20 12:09:37','010','Cartão de Visitante.'),(11,'2012-11-20 12:09:40','011','Cartão de Visitante.'),(12,'2012-11-20 12:09:44','012','Cartão de Visitante.'),(13,'2012-11-20 12:09:48','013','Cartão de Visitante.'),(14,'2012-11-20 12:09:52','014','Cartão de Visitante.'),(15,'2012-11-20 12:09:56','015','Cartão de Visitante.'),(16,'2012-11-20 12:10:00','016','Cartão de Visitante.'),(17,'2012-11-20 12:10:04','017','Cartão de Visitante.'),(19,'2012-11-20 12:10:14','018','Cartão de Visitante.'),(20,'2012-11-20 12:10:17','019','Cartão de Visitante.'),(21,'2012-11-20 12:10:21','020','Cartão de Visitante.'),(22,'2012-11-20 12:10:25','021','Cartão de Visitante.'),(23,'2012-11-20 12:10:29','022','Cartão de Visitante.'),(24,'2012-11-20 12:10:33','023','Cartão de Visitante.'),(25,'2012-11-20 12:10:37','024','Cartão de Visitante.'),(26,'2012-11-20 12:10:40','025','Cartão de Visitante.'),(28,'2012-11-20 12:10:49','026','Cartão de Visitante.'),(29,'2012-11-20 12:10:53','027','Cartão de Visitante.'),(30,'2012-11-20 12:10:57','028','Cartão de Visitante.'),(31,'2012-11-20 12:11:00','029','Cartão de Visitante.'),(32,'2012-11-20 12:11:05','030','Cartão de Visitante.'),(33,'2012-11-20 12:15:51','031','Cartão Prestador de Serviços.'),(34,'2012-11-20 12:15:56','032','Cartão Prestador de Serviços.'),(35,'2012-11-20 12:16:00','033','Cartão Prestador de Serviços.'),(36,'2012-11-20 12:16:05','034','Cartão Prestador de Serviços.'),(37,'2012-11-20 12:16:09','035','Cartão Prestador de Serviços.'),(38,'2012-11-20 12:16:34','036','Cartão Prestador de Serviços.'),(39,'2012-11-20 12:16:39','037','Cartão Prestador de Serviços.'),(40,'2012-11-20 12:16:45','038','Cartão Prestador de Serviços.'),(41,'2012-11-20 12:16:50','039','Cartão Prestador de Serviços.'),(42,'2012-11-20 12:16:55','040','Cartão Prestador de Serviços.'),(43,'2012-11-20 12:17:00','041','Cartão Prestador de Serviços.'),(44,'2012-11-20 12:17:04','042','Cartão Prestador de Serviços.'),(45,'2012-11-20 12:17:08','043','Cartão Prestador de Serviços.'),(46,'2012-11-20 12:17:12','044','Cartão Prestador de Serviços.'),(47,'2012-11-20 12:17:17','045','Cartão Prestador de Serviços.'),(48,'2012-11-20 12:17:21','046','Cartão Prestador de Serviços.'),(49,'2012-11-20 12:17:26','047','Cartão Prestador de Serviços.'),(50,'2012-11-20 12:17:30','048','Cartão Prestador de Serviços.'),(51,'2012-11-20 12:17:35','049','Cartão Prestador de Serviços.'),(52,'2012-11-20 12:17:39','050','Cartão Prestador de Serviços.');
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

-- Dump completed on 2012-12-07 14:05:40

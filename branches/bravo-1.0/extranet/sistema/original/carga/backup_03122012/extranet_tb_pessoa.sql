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
-- Table structure for table `tb_pessoa`
--

DROP TABLE IF EXISTS `tb_pessoa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_pessoa` (
  `CO_PESSOA` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo da pessoa (Primary Key).',
  `DT_CADAS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data e Hora cadastro pessoa.',
  `NO_PESSOA` varchar(180) NOT NULL COMMENT 'Nome da pessoa.',
  `TP_PESSOA` char(1) NOT NULL COMMENT 'Tipo da pessoa F - Fisica, J - Juridica.',
  `EM_PESSOA` varchar(160) DEFAULT NULL COMMENT 'Email da pessoa.',
  `SITE_PESSOA` varchar(180) DEFAULT NULL COMMENT 'WebSite da pessoa.',
  PRIMARY KEY (`CO_PESSOA`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COMMENT='Tabela de Pessoa.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pessoa`
--

LOCK TABLES `tb_pessoa` WRITE;
/*!40000 ALTER TABLE `tb_pessoa` DISABLE KEYS */;
INSERT INTO `tb_pessoa` VALUES (1,'2012-11-16 18:27:32','Ricardo Santos Alvarenga','F','ralvarenga@bravomoveis.com',NULL),(2,'2012-11-19 12:02:36','Euripedes Silva Junior','F','ejunior@bravomoveis.com',''),(6,'2012-11-19 12:48:46','Jerry Leandro do Santos','F','jerryleandrosantos@hotmail.com',''),(7,'2012-11-19 13:02:50','Dinossandre Alves Ferreira','F','dinossandre@yahoo.com.br',''),(8,'2012-11-19 13:15:24','Paulo Alves de Souza Neto','F','',''),(9,'2012-11-19 15:15:49','Oscar Faria Ribeiro Motta','F','oscar_agronegocio@hotmail.com',''),(10,'2012-11-19 15:28:33','José Carlos de Oliveira Costa','F','jcocostabond@yahoo.com.br','');
/*!40000 ALTER TABLE `tb_pessoa` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-12-03 13:23:17

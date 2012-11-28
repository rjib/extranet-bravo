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
-- Table structure for table `tb_nivel_formacao`
--

DROP TABLE IF EXISTS `tb_nivel_formacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_nivel_formacao` (
  `CO_NIVEL_FORMACAO` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo do nivel formacao (Primary Key).',
  `DT_CADAS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data e Hora de cadastro do nivel formacao.',
  `NO_NIVEL_FORMACAO` varchar(80) NOT NULL COMMENT 'Nome do nivel formacao.',
  `DS_NIVEL_FORMACAO` text COMMENT 'Descricao do nivel formacao.',
  PRIMARY KEY (`CO_NIVEL_FORMACAO`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COMMENT='Tabela de Nivel Formacao.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_nivel_formacao`
--

LOCK TABLES `tb_nivel_formacao` WRITE;
/*!40000 ALTER TABLE `tb_nivel_formacao` DISABLE KEYS */;
INSERT INTO `tb_nivel_formacao` VALUES (1,'2012-06-13 22:37:44','1 Grau',''),(2,'2012-06-13 22:37:49','2 Grau',''),(3,'2012-06-13 22:38:00','2 Grau Incompleto',''),(4,'2012-08-25 14:10:25','Não Alfabetizado',''),(5,'2012-08-25 14:10:47','Ensino Fundamental Completo',''),(6,'2012-08-25 14:11:01','Ensino Fundamental Incompleto',''),(7,'2012-08-25 14:11:17','Médio Incompleto',''),(8,'2012-08-25 14:11:25','Médio Completo',''),(9,'2012-08-25 14:11:44','Superior Completo',''),(10,'2012-08-25 14:11:53','Superior Incompleto',''),(11,'2012-08-25 14:12:06','Especialização',''),(12,'2012-08-25 14:12:15','Mestrado',''),(13,'2012-08-25 14:12:24','Doutorado','');
/*!40000 ALTER TABLE `tb_nivel_formacao` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-11-28 16:22:36

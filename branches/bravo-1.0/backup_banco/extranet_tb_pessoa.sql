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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1 COMMENT='Tabela de Pessoa.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pessoa`
--

LOCK TABLES `tb_pessoa` WRITE;
/*!40000 ALTER TABLE `tb_pessoa` DISABLE KEYS */;
INSERT INTO `tb_pessoa` VALUES (6,'2012-07-09 20:55:40','Euripedes Silva Junior','F','ejunior@bravomoveis.com',''),(7,'2012-07-19 01:55:51','DMAE DEPARTAMENTO MUNICIPAL DE AGUA E ESGOTO','J','',''),(8,'2012-08-09 23:39:32','Sheila','F','adsfas',''),(9,'2012-08-25 14:32:00','SHIRLEY APARECIDA FERREIRA','F','',''),(10,'2012-08-25 14:58:40','UNIVSERV UNIAO SERV DE VIGILANCIA LTDA','J','',''),(11,'2012-08-25 15:51:22','ENEIAS JUNIOR CASA GRANDI','F','eneias.junior@hotmail.com',''),(12,'2012-08-25 16:03:52','SIRLENE PEREIRA VILELA CASA GRANDI','F','',''),(13,'2012-08-25 16:07:42','CURINGA CAMINHÕES LTDA','J','',''),(14,'2012-09-03 21:56:16','CARLOS DE OLIVEIRA CALDAS','F','KARLINHO_55@HOTMAIL.COM',''),(15,'2012-09-03 22:04:18','VOTORANTIM METAIS ZINCO S/A','J','',''),(16,'2012-09-17 18:08:51','JULIANA QUIRINO DA SILVA','F','julianaq486@hotmail.com',''),(17,'2012-09-17 18:27:20','SANSONI DE OLIVEIRA E CIA LTDA','J','',''),(18,'2012-09-17 18:36:28','FLAVIO VIEIRA BRITO','F','',''),(19,'2012-09-18 12:21:38','ALEXANDRE AUGUSTO DINIZ','F','alexandre9022010@hotmail.com',''),(20,'2012-09-18 13:55:44','EDUARDO DE SOUZA PAULO','F','',''),(21,'2012-09-18 14:02:06','ARCOM S.A','J','',''),(22,'2012-09-18 15:15:22','ESTRUTURAS METALICAS SAO FRANCISCO LTDA','J','',''),(26,'2012-09-24 18:04:55','Alexsandro Santos de Souza Júnior','F','ajunior@bravomoveis.com',''),(27,'2012-09-24 20:31:06','teste','F','teste','teste'),(28,'2012-10-04 18:59:37','Ricardo Santos Alvarenga','F','ricardoalvarenga101@gmail.com',''),(32,'2012-10-08 13:36:09','Ricardo Santos Alvarenga','F','ricardoalvarenga101@gmail.com','');
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

-- Dump completed on 2012-11-14 17:47:49

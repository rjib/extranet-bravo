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
-- Table structure for table `tb_contato`
--

DROP TABLE IF EXISTS `tb_contato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_contato` (
  `CO_CONTATO` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo do contato (Primary Key).',
  `DT_CADAS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data e Hora cadastro contato.',
  `CO_PESSOA` int(11) NOT NULL COMMENT 'Codigo da pessoa (Foreign Key).',
  `NO_CONTATO` varchar(80) NOT NULL COMMENT 'Nome do contato.',
  PRIMARY KEY (`CO_CONTATO`),
  KEY `IX_CONTATO_CO_PESSOA` (`CO_PESSOA`),
  CONSTRAINT `FK_PESSOA_CONTATO` FOREIGN KEY (`CO_PESSOA`) REFERENCES `tb_pessoa` (`CO_PESSOA`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1 COMMENT='Tabela de Contato.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_contato`
--

LOCK TABLES `tb_contato` WRITE;
/*!40000 ALTER TABLE `tb_contato` DISABLE KEYS */;
INSERT INTO `tb_contato` VALUES (1,'2012-08-25 14:36:58',9,'ANDREIA'),(2,'2012-08-25 15:02:33',10,'PABX'),(3,'2012-08-25 15:53:33',11,'ENEIAS '),(4,'2012-08-25 15:57:22',11,'RONALDO ROSA '),(5,'2012-08-25 15:57:43',11,'SELMA NETTO'),(6,'2012-08-25 16:04:07',12,'SIRLENE'),(7,'2012-08-25 16:04:17',12,'ENEIAS'),(8,'2012-08-25 16:08:08',13,'RECURSOS HUMANOS'),(9,'2012-09-03 21:56:43',14,'CARLOS DE OLIVEIRA CALDAS'),(10,'2012-09-03 21:57:54',14,'RECADOS'),(11,'2012-09-03 22:01:01',14,'COMERCIAL'),(12,'2012-09-17 18:09:13',16,'Recado'),(13,'2012-09-17 18:10:13',16,'JULIANA'),(14,'2012-09-17 18:12:03',16,'LAZARA MARIA - REFERENCIA'),(15,'2012-09-17 18:12:18',16,'JULIANES QUIRNO'),(16,'2012-09-17 18:27:41',17,'SANSONI'),(17,'2012-09-17 18:40:05',18,'FLAVIO'),(18,'2012-09-17 18:40:12',18,'RECADOS'),(20,'2012-09-18 13:56:58',20,'EDUARDO 1'),(21,'2012-09-18 13:57:04',20,'EDUARDO 2'),(22,'2012-09-18 13:57:10',20,'RECADO'),(23,'2012-09-18 17:36:52',22,'COMERCIAL'),(24,'2012-09-19 19:11:09',6,'TESTE'),(25,'2012-09-19 19:15:01',6,'Junior'),(40,'2012-10-10 18:40:12',32,'fulano');
/*!40000 ALTER TABLE `tb_contato` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-11-14 17:47:50

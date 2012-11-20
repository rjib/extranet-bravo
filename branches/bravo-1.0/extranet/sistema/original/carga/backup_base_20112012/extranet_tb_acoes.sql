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
-- Table structure for table `tb_acoes`
--

DROP TABLE IF EXISTS `tb_acoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_acoes` (
  `CO_ACAO` int(11) NOT NULL AUTO_INCREMENT COMMENT 'chave primaria de acoes',
  `FL_EXCLUIR` char(1) NOT NULL DEFAULT '0' COMMENT 'acao excluir',
  `FL_EDITAR` char(1) NOT NULL DEFAULT '0' COMMENT 'acao editar',
  `FL_ADICIONAR` char(1) NOT NULL DEFAULT '0' COMMENT 'acao adicionar',
  `CO_PAPEL_MODULO` int(11) NOT NULL COMMENT 'codigo papel modulo',
  PRIMARY KEY (`CO_ACAO`),
  KEY `IDX_CO_PAPEL_MODULO` (`CO_PAPEL_MODULO`),
  CONSTRAINT `FK_CO_PAPEL_MODULO` FOREIGN KEY (`CO_PAPEL_MODULO`) REFERENCES `tb_papel_modulo` (`CO_PAPEL_MODULO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1 COMMENT='Tabela de acoes';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_acoes`
--

LOCK TABLES `tb_acoes` WRITE;
/*!40000 ALTER TABLE `tb_acoes` DISABLE KEYS */;
INSERT INTO `tb_acoes` VALUES (1,'1','1','1',1),(2,'1','1','1',2),(3,'1','1','1',3),(4,'1','1','1',4),(5,'1','1','1',5),(6,'1','1','1',6),(7,'1','1','1',7),(8,'1','1','1',8),(9,'1','1','1',9),(10,'1','1','1',10),(11,'1','1','1',11),(12,'1','1','1',12),(13,'1','1','1',13),(14,'1','1','1',14),(15,'1','1','1',15),(16,'1','1','1',16),(17,'1','1','1',17),(18,'1','1','1',18),(19,'1','1','1',19),(20,'1','1','1',20),(21,'1','1','1',21),(22,'1','1','1',22),(23,'1','1','1',23),(24,'1','1','1',24),(25,'1','1','1',25),(26,'1','1','1',26),(27,'1','1','1',27),(28,'1','1','1',28),(29,'1','1','1',29),(30,'1','1','1',30),(31,'1','1','1',31),(32,'1','1','1',32),(33,'1','1','1',33),(34,'1','1','1',34),(35,'1','1','1',35),(36,'0','0','0',36),(37,'0','0','0',37);
/*!40000 ALTER TABLE `tb_acoes` ENABLE KEYS */;
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

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
-- Table structure for table `tb_papel_modulo`
--

DROP TABLE IF EXISTS `tb_papel_modulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_papel_modulo` (
  `CO_PAPEL_MODULO` int(11) NOT NULL AUTO_INCREMENT COMMENT 'chave primaria papel modulos',
  `CO_PAPEL` int(11) NOT NULL COMMENT 'fk da tabela papel',
  `CO_MODULO` int(11) NOT NULL COMMENT 'fk da tabela de modulos',
  PRIMARY KEY (`CO_PAPEL_MODULO`),
  KEY `IDX_MODULO_PAPEL` (`CO_PAPEL`),
  KEY `IDX_PAPEL_MODULO` (`CO_MODULO`),
  CONSTRAINT `FK_CO_PAPEL` FOREIGN KEY (`CO_PAPEL`) REFERENCES `tb_papel` (`CO_PAPEL`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_CO_MODULO` FOREIGN KEY (`CO_MODULO`) REFERENCES `tb_modulos` (`CO_MODULO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1 COMMENT='tabela para uniao entre as tabelas modulos e papel';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_papel_modulo`
--

LOCK TABLES `tb_papel_modulo` WRITE;
/*!40000 ALTER TABLE `tb_papel_modulo` DISABLE KEYS */;
INSERT INTO `tb_papel_modulo` VALUES (70,4,156),(75,4,183),(76,4,184);
/*!40000 ALTER TABLE `tb_papel_modulo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-11-14 17:47:46

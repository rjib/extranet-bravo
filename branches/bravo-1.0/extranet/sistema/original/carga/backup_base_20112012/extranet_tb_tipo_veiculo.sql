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
-- Table structure for table `tb_tipo_veiculo`
--

DROP TABLE IF EXISTS `tb_tipo_veiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_tipo_veiculo` (
  `CO_TIPO_VEICULO` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo do tipo veiculo (Primary Key).',
  `DT_CADAS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data e Hora de cadastro do tipo veiculo.',
  `NO_TIPO_VEICULO` varchar(80) NOT NULL COMMENT 'Nome do tipo veiculo.',
  `DS_TIPO_VEICULO` text COMMENT 'Descricao do tipo veiculo.',
  `FL_EXIGE_PLACA` char(1) NOT NULL COMMENT 'Flag que informa se para obrigar a insercao de placa (S/N)',
  PRIMARY KEY (`CO_TIPO_VEICULO`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COMMENT='Tabela de Tipo Sanguineo.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_tipo_veiculo`
--

LOCK TABLES `tb_tipo_veiculo` WRITE;
/*!40000 ALTER TABLE `tb_tipo_veiculo` DISABLE KEYS */;
INSERT INTO `tb_tipo_veiculo` VALUES (1,'2012-08-05 15:44:51','Carro','','S'),(2,'2012-08-05 15:45:00','Ônibus','','S'),(3,'2012-08-05 15:45:09','Motocicleta','','S'),(5,'2012-08-05 15:45:24','Caminhão','','S'),(6,'2012-10-09 12:15:20','Não houve entrada de veículo','Não houve entrada de veículo.','N');
/*!40000 ALTER TABLE `tb_tipo_veiculo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-11-20 10:39:12

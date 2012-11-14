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
-- Table structure for table `tb_pcp_pecas`
--

DROP TABLE IF EXISTS `tb_pcp_pecas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_pcp_pecas` (
  `CO_PCP_PECA` int(11) NOT NULL AUTO_INCREMENT COMMENT 'codigo da peca chave primaria',
  `NU_SCHEMA` int(11) NOT NULL COMMENT 'numero do schema',
  `NU_COMPRIMENTO` varchar(10) NOT NULL COMMENT 'comprimento da peca, de acordo com o plano de corte optisave (.ac)',
  `NU_LARGURA` varchar(10) NOT NULL COMMENT 'Largura da peca, de acordo com o plano de corte optisave (.ac)',
  `NU_ESPESSURA` varchar(10) NOT NULL COMMENT 'Espessura da peca, de acordo com o plano de corte optisave (.ac)',
  `QTD_PECAS` varchar(10) NOT NULL COMMENT 'Quantidade de pecas, de acordo com o plano de corte optisave (.ac)',
  `CO_PCP_AC` int(11) NOT NULL COMMENT 'codigo do arquivo .ac original',
  `CO_INT_PRODUTO` varchar(7) DEFAULT NULL COMMENT 'codigo interno do produto',
  `CO_COR` varchar(6) NOT NULL COMMENT 'Codigo da cor',
  PRIMARY KEY (`CO_PCP_PECA`),
  KEY `FK_CO_PCP_AC_PCP_PECAS` (`CO_PCP_AC`),
  CONSTRAINT `FK_CO_PCP_AC_PCP_PECAS` FOREIGN KEY (`CO_PCP_AC`) REFERENCES `tb_pcp_ac` (`CO_PCP_AC`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=latin1 COMMENT='Tabela de plano de corte, contendo os schemas do optisave';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pcp_pecas`
--

LOCK TABLES `tb_pcp_pecas` WRITE;
/*!40000 ALTER TABLE `tb_pcp_pecas` DISABLE KEYS */;
INSERT INTO `tb_pcp_pecas` VALUES (137,1,'2149','606','180','30',22,'E1040','000700'),(138,1,'2149','606','180','30',22,'E1039','000700'),(139,1,'607','1829','180','100',22,'A1020','000700'),(140,2,'2149','60','180','160',22,'E1040','000700'),(141,2,'2149','146','180','30',22,'E1039','000700'),(142,2,'607','1829','180','100',22,'A1020','000700'),(143,2,'607','1829','180','200',22,'B1016','000700');
/*!40000 ALTER TABLE `tb_pcp_pecas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-11-14 17:47:48

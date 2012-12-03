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
-- Table structure for table `tb_usuario`
--

DROP TABLE IF EXISTS `tb_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_usuario` (
  `CO_USUARIO` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo do usuario (Primary Key).',
  `DT_CADAS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data e Hora de cadastro do usuario.',
  `CO_COLABORADOR` int(11) NOT NULL COMMENT 'Codigo do colaborador (Foreign Key).',
  `CO_PAPEL` int(11) NOT NULL COMMENT 'Codigo do papel (Foreign Key).',
  `LG_USUARIO` varchar(20) NOT NULL COMMENT 'Login do usuario.',
  `PASS_USUARIO` varchar(180) NOT NULL COMMENT 'Senha do usuario.',
  `QT_ACESSO_USUARIO` varchar(10) NOT NULL DEFAULT '0' COMMENT 'Quantidade de acesso do usuario.',
  `ST_USUARIO` int(1) NOT NULL DEFAULT '1' COMMENT 'Status do usuario 0 - Inativo, 1 - Ativo, 2 - Excluido.',
  PRIMARY KEY (`CO_USUARIO`),
  UNIQUE KEY `UK_USUARIO_LG_USUARIO` (`LG_USUARIO`),
  UNIQUE KEY `UK_USUARIO_CO_COLABORADOR` (`CO_COLABORADOR`),
  KEY `IX_USUARIO_CO_COLABORADOR` (`CO_COLABORADOR`),
  KEY `IX_USUARIO_CO_PAPEL` (`CO_PAPEL`),
  CONSTRAINT `FK_COLABORADOR_USUARIO` FOREIGN KEY (`CO_COLABORADOR`) REFERENCES `tb_colaborador` (`CO_COLABORADOR`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_PAPEL_USUARIO` FOREIGN KEY (`CO_PAPEL`) REFERENCES `tb_papel` (`CO_PAPEL`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COMMENT='Tabela de Usuario.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_usuario`
--

LOCK TABLES `tb_usuario` WRITE;
/*!40000 ALTER TABLE `tb_usuario` DISABLE KEYS */;
INSERT INTO `tb_usuario` VALUES (1,'2012-11-16 18:55:00',1,1,'ralvarenga','$1$iQ1.D91.$0EDhgdoNyhnVe/SFdm4Fa/','178',1),(2,'2012-11-19 12:04:04',2,1,'ejunior','$1$4i..5l4.$08D8PWEQPBj642xAOMw0z/','5',1),(3,'2012-11-19 12:58:56',3,2,'jsantos','$1$Z.4.uL4.$J5REVpuXvF22CvFGjblR90','0',1),(4,'2012-11-19 15:33:01',4,2,'dferreira','$1$bF3.I6..$VYAVbcZnRQVZC8Qkp10dn.','0',1),(5,'2012-11-19 15:34:17',5,2,'pneto','$1$Cw0.jo5.$.xA8KA7aLhQ9apTolj2GE/','0',1),(6,'2012-11-19 15:35:30',6,2,'osfaria','$1$bF3.I6..$VYAVbcZnRQVZC8Qkp10dn.','0',1);
/*!40000 ALTER TABLE `tb_usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-12-03 13:23:15

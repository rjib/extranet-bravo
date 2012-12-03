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
-- Table structure for table `tb_acesso_usuario`
--

DROP TABLE IF EXISTS `tb_acesso_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_acesso_usuario` (
  `CO_USUARIO` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo do usuario (Foreign Key).',
  `DT_ACESSO_USUARIO` date NOT NULL COMMENT 'Data de acesso do usuario.',
  `HR_ACESSO_USUARIO` time NOT NULL COMMENT 'Hora de acesso do usuario.',
  `IP_ACESSO_USUARIO` varchar(15) NOT NULL COMMENT 'IP de acesso do usuario.',
  KEY `IX_ACESSO_USUARIO_CO_USUARIO` (`CO_USUARIO`),
  CONSTRAINT `FK_ACESSO_USUARIO_USUARIO` FOREIGN KEY (`CO_USUARIO`) REFERENCES `tb_usuario` (`CO_USUARIO`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_acesso_usuario`
--

LOCK TABLES `tb_acesso_usuario` WRITE;
/*!40000 ALTER TABLE `tb_acesso_usuario` DISABLE KEYS */;
INSERT INTO `tb_acesso_usuario` VALUES (1,'2012-11-20','13:23:37','127.0.0.1'),(2,'2012-11-20','13:29:03','192.168.0.3'),(1,'2012-11-20','13:47:02','127.0.0.1'),(1,'2012-11-20','13:51:02','127.0.0.1'),(1,'2012-11-20','13:52:35','127.0.0.1'),(1,'2012-11-20','13:54:41','127.0.0.1'),(1,'2012-11-20','13:57:02','127.0.0.1'),(1,'2012-11-20','14:02:24','127.0.0.1'),(1,'2012-11-20','14:07:52','127.0.0.1'),(1,'2012-11-20','15:13:21','127.0.0.1'),(1,'2012-11-20','15:20:08','127.0.0.1'),(1,'2012-11-20','15:29:35','127.0.0.1'),(1,'2012-11-21','10:57:03','127.0.0.1'),(1,'2012-11-21','12:38:38','127.0.0.1'),(1,'2012-11-21','13:02:56','127.0.0.1'),(1,'2012-11-21','13:05:52','127.0.0.1'),(1,'2012-11-21','13:07:06','127.0.0.1'),(1,'2012-11-21','13:20:15','127.0.0.1'),(1,'2012-11-21','13:23:23','127.0.0.1'),(2,'2012-11-21','13:31:16','192.168.0.47'),(1,'2012-11-21','15:59:04','127.0.0.1'),(1,'2012-11-21','17:06:07','127.0.0.1'),(1,'2012-11-22','10:36:13','127.0.0.1'),(1,'2012-11-22','10:39:18','127.0.0.1'),(1,'2012-11-22','10:58:11','127.0.0.1'),(1,'2012-11-22','11:14:02','127.0.0.1'),(1,'2012-11-22','11:14:27','127.0.0.1'),(1,'2012-11-22','12:14:54','127.0.0.1'),(1,'2012-11-22','12:23:18','127.0.0.1'),(1,'2012-11-22','13:18:39','127.0.0.1'),(1,'2012-11-22','16:50:42','127.0.0.1'),(1,'2012-11-22','16:51:53','127.0.0.1'),(1,'2012-11-22','16:52:50','127.0.0.1'),(1,'2012-11-22','16:53:13','127.0.0.1'),(1,'2012-11-22','17:07:58','127.0.0.1'),(1,'2012-11-22','17:28:42','127.0.0.1'),(1,'2012-11-22','18:08:07','127.0.0.1'),(1,'2012-11-22','18:12:43','127.0.0.1'),(1,'2012-11-22','18:16:03','127.0.0.1'),(1,'2012-11-22','18:24:50','127.0.0.1'),(1,'2012-11-22','19:28:38','127.0.0.1'),(1,'2012-11-22','19:32:12','127.0.0.1'),(1,'2012-11-22','19:34:43','127.0.0.1'),(1,'2012-11-22','19:37:51','127.0.0.1'),(1,'2012-11-22','19:39:54','127.0.0.1'),(1,'2012-11-22','19:46:23','127.0.0.1'),(1,'2012-11-22','19:51:08','127.0.0.1'),(1,'2012-11-22','20:01:53','127.0.0.1'),(1,'2012-11-23','10:27:29','127.0.0.1'),(1,'2012-11-23','11:13:19','127.0.0.1'),(1,'2012-11-23','11:21:45','127.0.0.1'),(1,'2012-11-23','11:22:15','127.0.0.1'),(1,'2012-11-23','11:25:16','127.0.0.1'),(1,'2012-11-23','11:26:28','127.0.0.1'),(1,'2012-11-23','11:37:34','127.0.0.1'),(1,'2012-11-23','11:40:43','127.0.0.1'),(1,'2012-11-23','11:46:31','127.0.0.1'),(1,'2012-11-23','12:22:02','127.0.0.1'),(1,'2012-11-23','13:02:51','127.0.0.1'),(1,'2012-11-23','13:10:08','127.0.0.1'),(1,'2012-11-23','13:54:48','127.0.0.1'),(1,'2012-11-23','13:56:34','127.0.0.1'),(1,'2012-11-23','14:01:23','127.0.0.1'),(1,'2012-11-23','14:05:02','127.0.0.1'),(1,'2012-11-23','16:13:10','127.0.0.1'),(1,'2012-11-23','16:42:33','127.0.0.1'),(1,'2012-11-23','16:56:05','127.0.0.1'),(1,'2012-11-23','17:10:44','127.0.0.1'),(1,'2012-11-23','17:15:59','127.0.0.1'),(1,'2012-11-23','17:24:05','127.0.0.1'),(2,'2012-11-23','17:58:17','192.168.0.3'),(1,'2012-11-23','18:35:12','127.0.0.1'),(1,'2012-11-26','10:00:35','127.0.0.1'),(1,'2012-11-26','10:09:47','127.0.0.1'),(1,'2012-11-26','11:06:11','127.0.0.1'),(1,'2012-11-26','13:01:53','127.0.0.1'),(1,'2012-11-26','13:06:51','127.0.0.1'),(1,'2012-11-26','13:18:04','127.0.0.1'),(1,'2012-11-26','13:44:47','127.0.0.1'),(1,'2012-11-26','13:47:48','127.0.0.1'),(1,'2012-11-26','13:52:04','127.0.0.1'),(1,'2012-11-26','13:55:09','127.0.0.1'),(1,'2012-11-26','13:57:52','127.0.0.1'),(1,'2012-11-26','14:06:02','127.0.0.1'),(1,'2012-11-26','15:22:26','127.0.0.1'),(1,'2012-11-26','15:33:49','127.0.0.1'),(1,'2012-11-26','15:58:51','127.0.0.1'),(1,'2012-11-26','16:01:56','127.0.0.1'),(1,'2012-11-26','16:08:35','127.0.0.1'),(1,'2012-11-26','16:14:56','127.0.0.1'),(1,'2012-11-26','16:27:29','127.0.0.1'),(1,'2012-11-26','16:37:54','127.0.0.1'),(1,'2012-11-26','17:43:06','192.168.0.116'),(1,'2012-11-26','18:32:16','127.0.0.1'),(1,'2012-11-26','18:34:18','127.0.0.1'),(1,'2012-11-26','18:37:27','127.0.0.1'),(1,'2012-11-27','11:05:39','127.0.0.1'),(1,'2012-11-27','13:13:23','127.0.0.1'),(1,'2012-11-27','13:21:59','127.0.0.1'),(1,'2012-11-27','15:52:35','192.168.0.95'),(1,'2012-11-28','12:14:53','127.0.0.1'),(1,'2012-11-28','13:22:27','127.0.0.1'),(1,'2012-11-28','13:34:58','127.0.0.1'),(1,'2012-11-28','13:43:40','127.0.0.1'),(1,'2012-11-28','14:04:51','127.0.0.1'),(1,'2012-11-28','15:46:59','127.0.0.1'),(1,'2012-11-28','15:51:39','127.0.0.1'),(1,'2012-11-28','15:57:11','127.0.0.1'),(1,'2012-11-28','16:17:54','127.0.0.1'),(1,'2012-11-28','16:23:37','127.0.0.1'),(1,'2012-11-28','16:31:44','127.0.0.1'),(1,'2012-11-28','16:32:02','127.0.0.1'),(1,'2012-11-28','17:08:08','127.0.0.1'),(1,'2012-11-28','17:09:46','127.0.0.1'),(1,'2012-11-28','18:47:33','127.0.0.1'),(1,'2012-11-29','10:43:08','127.0.0.1'),(1,'2012-11-29','13:50:56','127.0.0.1'),(1,'2012-11-29','14:07:00','127.0.0.1'),(1,'2012-11-29','15:17:24','127.0.0.1'),(1,'2012-11-29','15:24:30','127.0.0.1'),(1,'2012-11-29','15:26:59','127.0.0.1'),(1,'2012-11-29','15:35:51','127.0.0.1'),(1,'2012-11-29','15:39:38','127.0.0.1'),(1,'2012-11-29','15:41:53','127.0.0.1'),(1,'2012-11-29','15:42:35','127.0.0.1'),(1,'2012-11-29','15:47:40','127.0.0.1'),(1,'2012-11-29','15:50:26','127.0.0.1'),(1,'2012-11-29','16:06:03','127.0.0.1'),(1,'2012-11-29','17:15:52','127.0.0.1'),(1,'2012-11-29','17:34:28','127.0.0.1'),(1,'2012-11-29','17:55:46','127.0.0.1'),(1,'2012-11-29','17:57:09','127.0.0.1'),(1,'2012-11-29','18:43:37','127.0.0.1'),(1,'2012-11-29','18:44:11','127.0.0.1'),(1,'2012-11-29','18:44:47','127.0.0.1'),(1,'2012-11-29','18:45:55','127.0.0.1'),(1,'2012-11-29','18:46:38','127.0.0.1'),(1,'2012-11-30','10:20:52','127.0.0.1'),(1,'2012-11-30','10:21:49','127.0.0.1'),(1,'2012-11-30','10:37:06','127.0.0.1'),(1,'2012-11-30','10:38:37','127.0.0.1'),(1,'2012-11-30','10:42:28','127.0.0.1'),(1,'2012-11-30','11:21:27','127.0.0.1'),(1,'2012-11-30','11:22:32','127.0.0.1'),(1,'2012-11-30','12:16:22','127.0.0.1'),(1,'2012-11-30','12:31:43','127.0.0.1'),(1,'2012-11-30','12:37:17','127.0.0.1'),(1,'2012-11-30','12:59:52','127.0.0.1'),(1,'2012-11-30','13:30:59','127.0.0.1'),(1,'2012-11-30','13:41:24','127.0.0.1'),(1,'2012-11-30','13:52:06','127.0.0.1'),(1,'2012-11-30','14:06:48','127.0.0.1'),(1,'2012-11-30','14:13:34','127.0.0.1'),(1,'2012-11-30','14:16:27','127.0.0.1'),(1,'2012-11-30','16:06:05','127.0.0.1'),(1,'2012-11-30','16:10:29','127.0.0.1'),(1,'2012-11-30','16:43:38','192.168.0.95'),(1,'2012-11-30','16:57:51','127.0.0.1'),(1,'2012-11-30','17:02:36','127.0.0.1'),(1,'2012-11-30','17:10:03','192.168.0.95'),(1,'2012-11-30','17:50:46','127.0.0.1'),(1,'2012-11-30','18:01:06','127.0.0.1'),(1,'2012-11-30','18:34:22','127.0.0.1'),(1,'2012-11-30','18:54:46','127.0.0.1'),(1,'2012-11-30','19:38:29','127.0.0.1'),(1,'2012-11-30','19:40:20','127.0.0.1'),(1,'2012-11-30','19:42:34','127.0.0.1'),(1,'2012-11-30','19:48:26','127.0.0.1'),(1,'2012-11-30','20:01:24','127.0.0.1'),(1,'2012-11-30','20:12:27','127.0.0.1'),(1,'2012-12-03','10:06:47','127.0.0.1'),(1,'2012-12-03','10:19:42','127.0.0.1'),(1,'2012-12-03','11:16:17','127.0.0.1'),(1,'2012-12-03','11:31:33','127.0.0.1'),(1,'2012-12-03','11:43:45','127.0.0.1'),(1,'2012-12-03','12:44:19','127.0.0.1'),(1,'2012-12-03','12:46:10','127.0.0.1'),(1,'2012-12-03','12:51:29','127.0.0.1'),(1,'2012-12-03','12:56:00','127.0.0.1'),(1,'2012-12-03','12:56:34','127.0.0.1'),(1,'2012-12-03','12:58:38','127.0.0.1'),(2,'2012-12-03','13:20:17','192.168.0.3'),(2,'2012-12-03','13:21:59','192.168.0.3');
/*!40000 ALTER TABLE `tb_acesso_usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-12-03 13:23:10

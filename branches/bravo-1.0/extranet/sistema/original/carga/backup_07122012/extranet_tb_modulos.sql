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
-- Table structure for table `tb_modulos`
--

DROP TABLE IF EXISTS `tb_modulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_modulos` (
  `CO_MODULO` int(11) NOT NULL AUTO_INCREMENT COMMENT 'chave primaria do modulo',
  `CO_PAI` int(11) NOT NULL DEFAULT '0' COMMENT 'codigo do pai se ouver',
  `NO_MODULO` varchar(180) NOT NULL COMMENT 'nome do modulo',
  `FL_ATIVO` char(1) NOT NULL DEFAULT '1' COMMENT 'flag para controle se o modulo esta ou nao ativo 1 = sim, 0=nao',
  `FL_ACOES` char(1) NOT NULL DEFAULT '1' COMMENT 'flag para controle se modulo possui acoes 0=nao, 1=sim',
  `DS_MODULO` text COMMENT 'descricao do modulo',
  PRIMARY KEY (`CO_MODULO`)
) ENGINE=InnoDB AUTO_INCREMENT=186 DEFAULT CHARSET=latin1 COMMENT='Tabela de modulos e submodulos do sistema';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_modulos`
--

LOCK TABLES `tb_modulos` WRITE;
/*!40000 ALTER TABLE `tb_modulos` DISABLE KEYS */;
INSERT INTO `tb_modulos` VALUES (154,0,'Cadastros','1','0','Módulo de cadastros do sistema'),(155,154,'Controle de Acesso','1','0','Módulo para gerenciar o controle de entrada e saída de pessoas dentro da empresa'),(156,154,'Bairros','1','1',NULL),(157,154,'Cargos','1','1',NULL),(158,154,'Cartão Identificação','1','1',NULL),(159,154,'CEPs','1','1',NULL),(160,154,'Cidades','1','1',NULL),(161,154,'Colaboradores','1','1',NULL),(163,154,'Estados','1','1',NULL),(164,154,'Estado Civil','1','1',NULL),(165,154,'Nacionalidade','1','1',NULL),(166,154,'Nível de Formação','1','1',NULL),(167,154,'Pessoas','1','1',NULL),(168,154,'Setores','1','1',NULL),(169,154,'Usuários','1','1',NULL),(170,0,'PCP','1','0',''),(171,170,'Gerar Plano de Corte','1','1',NULL),(172,170,'Importar Plano de Corte Optisave','1','1',NULL),(173,170,'Lista de Cores','1','1',NULL),(174,170,'Ordem de Produção','1','1',NULL),(175,155,'Visitantes','1','1',NULL),(176,155,'Prestador de Serviço','1','1',''),(177,0,'Tipos','1','0',''),(178,177,'Sanguineo','1','1',NULL),(179,177,'E-mail','1','1',NULL),(180,177,'Telefone','1','1',NULL),(181,177,'Veiculo','1','1',NULL),(182,0,'Configurações','1','0',''),(183,182,'Módulos','1','1',NULL),(184,182,'Papel','1','1','Cadastro de papeis'),(185,182,'Trocar Senha','1','1','');
/*!40000 ALTER TABLE `tb_modulos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-12-07 14:05:38

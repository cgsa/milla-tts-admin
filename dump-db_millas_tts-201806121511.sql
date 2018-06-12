-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: db_millas_tts
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu0.16.04.1

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
-- Table structure for table `banner`
--

DROP TABLE IF EXISTS `banner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_imagen` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `id_promociones` int(11) DEFAULT NULL,
  `status` smallint(6) DEFAULT '0',
  `fecha_registro` datetime DEFAULT NULL,
  `data_json` text,
  `controlador` varchar(30) DEFAULT NULL,
  `id_contralador` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `banner_imagenes_FK` (`id_imagen`),
  CONSTRAINT `banner_imagenes_FK` FOREIGN KEY (`id_imagen`) REFERENCES `imagenes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banner`
--

LOCK TABLES `banner` WRITE;
/*!40000 ALTER TABLE `banner` DISABLE KEYS */;
INSERT INTO `banner` VALUES (1,7,'Banner Promoción','Banner Promoción',NULL,1,NULL,'{\"controlador\":\"Promociones\",\"value\":\"1\"}','promociones',1),(2,30,'Bariloche','Vacaciones de invierno en bariloche',NULL,1,'2018-06-12 14:01:54',NULL,'destinos',2);
/*!40000 ALTER TABLE `banner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cruge_authassignment`
--

DROP TABLE IF EXISTS `cruge_authassignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cruge_authassignment` (
  `userid` int(11) NOT NULL,
  `bizrule` text,
  `data` text,
  `itemname` varchar(64) NOT NULL,
  PRIMARY KEY (`userid`,`itemname`),
  KEY `fk_cruge_authassignment_cruge_authitem1` (`itemname`),
  KEY `fk_cruge_authassignment_user` (`userid`),
  CONSTRAINT `fk_cruge_authassignment_cruge_authitem1` FOREIGN KEY (`itemname`) REFERENCES `cruge_authitem` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cruge_authassignment_user` FOREIGN KEY (`userid`) REFERENCES `cruge_user` (`iduser`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cruge_authassignment`
--

LOCK TABLES `cruge_authassignment` WRITE;
/*!40000 ALTER TABLE `cruge_authassignment` DISABLE KEYS */;
/*!40000 ALTER TABLE `cruge_authassignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cruge_authitem`
--

DROP TABLE IF EXISTS `cruge_authitem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cruge_authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cruge_authitem`
--

LOCK TABLES `cruge_authitem` WRITE;
/*!40000 ALTER TABLE `cruge_authitem` DISABLE KEYS */;
INSERT INTO `cruge_authitem` VALUES ('action_banner_admin',0,'',NULL,'N;'),('action_banner_combos',0,'',NULL,'N;'),('action_banner_Create',0,'',NULL,'N;'),('action_banner_Update',0,'',NULL,'N;'),('action_banner_view',0,'',NULL,'N;'),('action_destinos_admin',0,'',NULL,'N;'),('action_destinos_Create',0,'',NULL,'N;'),('action_destinos_Imagenes',0,'',NULL,'N;'),('action_destinos_Registrar',0,'',NULL,'N;'),('action_destinos_Update',0,'',NULL,'N;'),('action_destinos_Upload',0,'',NULL,'N;'),('action_destinos_view',0,'',NULL,'N;'),('action_estadoSistema_admin',0,'',NULL,'N;'),('action_estadoSistema_create',0,'',NULL,'N;'),('action_estadoSistema_update',0,'',NULL,'N;'),('action_estadoSistema_view',0,'',NULL,'N;'),('action_imagenes_admin',0,'',NULL,'N;'),('action_imagenes_Formulario',0,'',NULL,'N;'),('action_imagenes_Registrar',0,'',NULL,'N;'),('action_paises_admin',0,'',NULL,'N;'),('action_panelAdministrativo_index',0,'',NULL,'N;'),('action_promociones_admin',0,'',NULL,'N;'),('action_promociones_Create',0,'',NULL,'N;'),('action_promociones_Formulario',0,'',NULL,'N;'),('action_promociones_Imagenes',0,'',NULL,'N;'),('action_promociones_Registrar',0,'',NULL,'N;'),('action_promociones_Update',0,'',NULL,'N;'),('action_promociones_Upload',0,'',NULL,'N;'),('action_promociones_view',0,'',NULL,'N;'),('action_suscripciones_admin',0,'',NULL,'N;'),('action_suscripciones_Create',0,'',NULL,'N;'),('action_ui_fieldsadmincreate',0,'',NULL,'N;'),('action_ui_fieldsadminlist',0,'',NULL,'N;'),('action_ui_usermanagementadmin',0,'',NULL,'N;'),('action_ui_usermanagementupdate',0,'',NULL,'N;'),('edit-advanced-profile-features',0,'/var/www/html/milla-tts-admin/protected/modules/cruge/views/ui/usermanagementupdate.php linea 125',NULL,'N;'),('USER-AGENTE',0,'',NULL,'N;'),('USER-SISTEMA',0,'',NULL,'N;');
/*!40000 ALTER TABLE `cruge_authitem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cruge_authitemchild`
--

DROP TABLE IF EXISTS `cruge_authitemchild`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cruge_authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `crugeauthitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `cruge_authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `crugeauthitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `cruge_authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cruge_authitemchild`
--

LOCK TABLES `cruge_authitemchild` WRITE;
/*!40000 ALTER TABLE `cruge_authitemchild` DISABLE KEYS */;
/*!40000 ALTER TABLE `cruge_authitemchild` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cruge_field`
--

DROP TABLE IF EXISTS `cruge_field`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cruge_field` (
  `idfield` int(11) NOT NULL AUTO_INCREMENT,
  `fieldname` varchar(20) NOT NULL,
  `longname` varchar(50) DEFAULT NULL,
  `position` int(11) DEFAULT '0',
  `required` int(11) DEFAULT '0',
  `fieldtype` int(11) DEFAULT '0',
  `fieldsize` int(11) DEFAULT '20',
  `maxlength` int(11) DEFAULT '45',
  `showinreports` int(11) DEFAULT '0',
  `useregexp` varchar(512) DEFAULT NULL,
  `useregexpmsg` varchar(512) DEFAULT NULL,
  `predetvalue` mediumblob,
  PRIMARY KEY (`idfield`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cruge_field`
--

LOCK TABLES `cruge_field` WRITE;
/*!40000 ALTER TABLE `cruge_field` DISABLE KEYS */;
INSERT INTO `cruge_field` VALUES (1,'nombreuser','Nombre',1,1,0,20,45,0,'','',''),(2,'apellidouser','Apellido',2,1,0,20,45,0,'','','');
/*!40000 ALTER TABLE `cruge_field` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cruge_fieldvalue`
--

DROP TABLE IF EXISTS `cruge_fieldvalue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cruge_fieldvalue` (
  `idfieldvalue` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) NOT NULL,
  `idfield` int(11) NOT NULL,
  `value` blob,
  PRIMARY KEY (`idfieldvalue`),
  KEY `fk_cruge_fieldvalue_cruge_user1` (`iduser`),
  KEY `fk_cruge_fieldvalue_cruge_field1` (`idfield`),
  CONSTRAINT `fk_cruge_fieldvalue_cruge_field1` FOREIGN KEY (`idfield`) REFERENCES `cruge_field` (`idfield`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_cruge_fieldvalue_cruge_user1` FOREIGN KEY (`iduser`) REFERENCES `cruge_user` (`iduser`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cruge_fieldvalue`
--

LOCK TABLES `cruge_fieldvalue` WRITE;
/*!40000 ALTER TABLE `cruge_fieldvalue` DISABLE KEYS */;
INSERT INTO `cruge_fieldvalue` VALUES (1,1,1,'Admin'),(2,1,2,'Admin');
/*!40000 ALTER TABLE `cruge_fieldvalue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cruge_session`
--

DROP TABLE IF EXISTS `cruge_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cruge_session` (
  `idsession` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) NOT NULL,
  `created` bigint(30) DEFAULT NULL,
  `expire` bigint(30) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `ipaddress` varchar(45) DEFAULT NULL,
  `usagecount` int(11) DEFAULT '0',
  `lastusage` bigint(30) DEFAULT NULL,
  `logoutdate` bigint(30) DEFAULT NULL,
  `ipaddressout` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idsession`),
  KEY `crugesession_iduser` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cruge_session`
--

LOCK TABLES `cruge_session` WRITE;
/*!40000 ALTER TABLE `cruge_session` DISABLE KEYS */;
INSERT INTO `cruge_session` VALUES (1,1,1520863687,1520865487,1,'::1',1,1520863687,NULL,NULL),(2,1,1520870239,1520872039,1,'::1',1,1520870239,NULL,NULL),(3,1,1520899966,1520901766,1,'::1',1,1520899966,NULL,NULL),(4,1,1521157961,1521159761,1,'::1',1,1521157961,NULL,NULL),(5,1,1522973040,1522974840,1,'::1',1,1522973040,NULL,NULL),(6,1,1523833334,1523835134,1,'::1',1,1523833334,NULL,NULL),(7,1,1524342303,1524344103,0,'::1',1,1524342303,NULL,NULL),(8,1,1524344619,1524346419,0,'::1',1,1524344619,NULL,NULL),(9,1,1524346628,1524348428,0,'::1',1,1524346628,NULL,NULL),(10,1,1524348491,1524350291,1,'::1',1,1524348491,NULL,NULL),(11,1,1524358526,1524360326,1,'::1',1,1524358526,NULL,NULL),(12,1,1524361816,1524363616,0,'::1',1,1524361816,NULL,NULL),(13,1,1524410022,1524411822,1,'::1',1,1524410022,NULL,NULL),(14,1,1524411886,1524413686,0,'::1',1,1524411886,NULL,NULL),(15,1,1524414933,1524416733,0,'::1',1,1524414933,NULL,NULL),(16,1,1524418411,1524420211,1,'::1',1,1524418411,NULL,NULL),(17,1,1524437941,1524439741,1,'::1',1,1524437941,NULL,NULL),(18,1,1524445268,1524447068,1,'::1',1,1524445268,NULL,NULL),(19,1,1524448570,1524450370,0,'::1',1,1524448570,NULL,NULL),(20,1,1524450771,1524452571,0,'::1',1,1524450771,NULL,NULL),(21,1,1524452694,1524454494,1,'::1',1,1524452694,NULL,NULL),(22,1,1524619370,1524621170,1,'::1',1,1524619370,NULL,NULL),(23,1,1524917902,1524919702,1,'::1',1,1524917902,NULL,NULL),(24,1,1524937261,1524939061,1,'::1',1,1524937261,NULL,NULL),(25,1,1525026910,1525028710,0,'::1',1,1525026910,NULL,NULL),(26,1,1525029136,1525030936,1,'::1',1,1525029136,NULL,NULL),(27,1,1525032938,1525034738,0,'::1',1,1525032938,NULL,NULL),(28,1,1525036016,1525037816,1,'::1',1,1525036016,NULL,NULL),(29,1,1525041153,1525042953,0,'::1',1,1525041153,NULL,NULL),(30,1,1525043138,1525044938,1,'::1',1,1525043138,NULL,NULL),(31,1,1525056088,1525057888,0,'::1',1,1525056088,1525057210,'::1'),(32,1,1525136029,1525137829,1,'::1',1,1525136029,NULL,NULL),(33,1,1525194077,1525195877,1,'::1',1,1525194077,NULL,NULL),(34,1,1525201300,1525203100,0,'::1',1,1525201300,NULL,NULL),(35,1,1525203130,1525204930,0,'::1',1,1525203130,NULL,NULL),(36,1,1525204991,1525206791,0,'::1',1,1525204991,NULL,NULL),(37,1,1525206870,1525208670,1,'::1',1,1525206870,NULL,NULL),(38,1,1525220664,1525222464,0,'::1',1,1525220664,NULL,NULL),(39,1,1525222531,1525224331,0,'::1',1,1525222531,NULL,NULL),(40,1,1525224482,1525226282,1,'::1',1,1525224482,NULL,NULL),(41,1,1525546659,1525548459,1,'::1',1,1525546659,NULL,NULL),(42,1,1525634518,1525636318,1,'::1',1,1525634518,NULL,NULL),(43,1,1525638630,1525640430,0,'::1',1,1525638630,NULL,NULL),(44,1,1525640817,1525642617,1,'::1',1,1525640817,NULL,NULL),(45,1,1527597583,1527599383,0,'::1',1,1527597583,1527598966,'::1'),(46,1,1527598973,1527600773,0,'::1',1,1527598973,1527599470,'::1'),(47,1,1527599478,1527601278,0,'::1',1,1527599478,NULL,NULL),(48,1,1527601383,1527603183,0,'::1',1,1527601383,NULL,NULL),(49,1,1527603443,1527605243,1,'::1',1,1527603443,NULL,NULL),(50,1,1527607673,1527609473,0,'::1',1,1527607673,NULL,NULL),(51,1,1527609634,1527611434,1,'::1',1,1527609634,NULL,NULL),(52,1,1527617286,1527619086,1,'::1',1,1527617286,NULL,NULL),(53,1,1527624686,1527626486,0,'::1',1,1527624686,NULL,NULL),(54,1,1527626609,1527628409,1,'::1',1,1527626609,NULL,NULL),(55,1,1527696552,1527698352,1,'::1',1,1527696552,NULL,NULL),(56,1,1527700830,1527702630,0,'::1',1,1527700830,1527701070,'::1'),(57,1,1527713335,1527715135,1,'::1',1,1527713335,NULL,NULL),(58,1,1527768439,1527770239,1,'::1',1,1527768439,NULL,NULL),(59,1,1527886067,1527887867,0,'::1',1,1527886067,NULL,NULL),(60,1,1527888103,1527889903,0,'::1',1,1527888103,1527888525,'::1'),(61,1,1528119278,1528121078,0,'::1',1,1528119278,NULL,NULL),(62,1,1528813760,1528815560,0,'::1',1,1528813760,NULL,NULL),(63,1,1528815571,1528817371,1,'::1',1,1528815571,NULL,NULL),(64,1,1528819256,1528821056,0,'::1',1,1528819256,NULL,NULL),(65,1,1528821065,1528822865,0,'::1',1,1528821065,NULL,NULL),(66,1,1528822874,1528824674,1,'::1',1,1528822874,NULL,NULL);
/*!40000 ALTER TABLE `cruge_session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cruge_system`
--

DROP TABLE IF EXISTS `cruge_system`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cruge_system` (
  `idsystem` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `largename` varchar(45) DEFAULT NULL,
  `sessionmaxdurationmins` int(11) DEFAULT '30',
  `sessionmaxsameipconnections` int(11) DEFAULT '10',
  `sessionreusesessions` int(11) DEFAULT '1' COMMENT '1yes 0no',
  `sessionmaxsessionsperday` int(11) DEFAULT '-1',
  `sessionmaxsessionsperuser` int(11) DEFAULT '-1',
  `systemnonewsessions` int(11) DEFAULT '0' COMMENT '1yes 0no',
  `systemdown` int(11) DEFAULT '0',
  `registerusingcaptcha` int(11) DEFAULT '0',
  `registerusingterms` int(11) DEFAULT '0',
  `terms` blob,
  `registerusingactivation` int(11) DEFAULT '1',
  `defaultroleforregistration` varchar(64) DEFAULT NULL,
  `registerusingtermslabel` varchar(100) DEFAULT NULL,
  `registrationonlogin` int(11) DEFAULT '1',
  PRIMARY KEY (`idsystem`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cruge_system`
--

LOCK TABLES `cruge_system` WRITE;
/*!40000 ALTER TABLE `cruge_system` DISABLE KEYS */;
INSERT INTO `cruge_system` VALUES (1,'default',NULL,30,10,1,-1,-1,0,0,0,0,'',0,'','',1);
/*!40000 ALTER TABLE `cruge_system` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cruge_user`
--

DROP TABLE IF EXISTS `cruge_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cruge_user` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `regdate` bigint(30) DEFAULT NULL,
  `actdate` bigint(30) DEFAULT NULL,
  `logondate` bigint(30) DEFAULT NULL,
  `username` varchar(64) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL COMMENT 'Hashed password',
  `authkey` varchar(100) DEFAULT NULL COMMENT 'llave de autentificacion',
  `state` int(11) DEFAULT '0',
  `totalsessioncounter` int(11) DEFAULT '0',
  `currentsessioncounter` int(11) DEFAULT '0',
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cruge_user`
--

LOCK TABLES `cruge_user` WRITE;
/*!40000 ALTER TABLE `cruge_user` DISABLE KEYS */;
INSERT INTO `cruge_user` VALUES (1,NULL,NULL,1528822874,'admin','edwinrzc@gmail.com','b2428a3aa2c94e57b85d731c87018419736070121659caec0ee841a24021e582b4f6402faef67cc84e75531ba1e8a8b45a19a8c0ff98fdfdf5fc0618fb301874',NULL,1,0,0),(2,NULL,NULL,NULL,'invitado','invitado','nopassword',NULL,1,0,0);
/*!40000 ALTER TABLE `cruge_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `destinos`
--

DROP TABLE IF EXISTS `destinos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `destinos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `descripcion` text,
  `coodenadas` varchar(100) DEFAULT NULL,
  `status` smallint(6) DEFAULT '0',
  `fecha_registro` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `destinos`
--

LOCK TABLES `destinos` WRITE;
/*!40000 ALTER TABLE `destinos` DISABLE KEYS */;
INSERT INTO `destinos` VALUES (1,'Capital Federal','Buenos Aires','Buenos Aires es una ciudad cosmopolita y un importante destino turístico.​ Su compleja infraestructura la convierte en una de las metrópolis de mayor importancia en América y es una ciudad global de categoría alfa,​ dadas sus influencias en el comercio, finanzas, moda, arte, gastronomía, educación, entretenimiento y principalmente en su marcada cultura.','-34.6131500, -58.3772300',1,'2018-05-29'),(2,'Río Negro','Bariloche','<div>San Carlos de Bariloche, conocida simplemente como Bariloche,1​ es una ciudad ubicada en la provincia de Río Negro, Argentina, y es la cabecera del departamento Bariloche.</div>','-71.3000000, -41.1500000',1,'2018-06-12');
/*!40000 ALTER TABLE `destinos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galeria_destino`
--

DROP TABLE IF EXISTS `galeria_destino`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `galeria_destino` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_destino` int(11) NOT NULL,
  `id_imagen` int(11) NOT NULL,
  `es_principal` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `galeria_destino_imagenes_FK` (`id_imagen`),
  KEY `galeria_destino_destinos_FK` (`id_destino`),
  CONSTRAINT `galeria_destino_destinos_FK` FOREIGN KEY (`id_destino`) REFERENCES `destinos` (`id`),
  CONSTRAINT `galeria_destino_imagenes_FK` FOREIGN KEY (`id_imagen`) REFERENCES `imagenes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galeria_destino`
--

LOCK TABLES `galeria_destino` WRITE;
/*!40000 ALTER TABLE `galeria_destino` DISABLE KEYS */;
INSERT INTO `galeria_destino` VALUES (1,1,14,0),(11,1,24,1),(12,1,25,0),(13,2,26,1),(14,2,27,0),(15,2,28,0);
/*!40000 ALTER TABLE `galeria_destino` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galeria_promocion`
--

DROP TABLE IF EXISTS `galeria_promocion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `galeria_promocion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_promocion` int(11) NOT NULL,
  `id_imagen` int(11) NOT NULL,
  `es_principal` smallint(6) DEFAULT '0',
  `es_active` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `galeria_promocion_promociones_FK` (`id_promocion`),
  KEY `galeria_promocion_imagenes_FK` (`id_imagen`),
  CONSTRAINT `galeria_promocion_imagenes_FK` FOREIGN KEY (`id_imagen`) REFERENCES `imagenes` (`id`),
  CONSTRAINT `galeria_promocion_promociones_FK` FOREIGN KEY (`id_promocion`) REFERENCES `promociones` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galeria_promocion`
--

LOCK TABLES `galeria_promocion` WRITE;
/*!40000 ALTER TABLE `galeria_promocion` DISABLE KEYS */;
INSERT INTO `galeria_promocion` VALUES (5,1,8,0,0),(6,1,9,0,0),(7,1,10,0,0),(8,1,11,0,0),(9,1,12,0,0),(10,1,13,0,0);
/*!40000 ALTER TABLE `galeria_promocion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galerias`
--

DROP TABLE IF EXISTS `galerias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `galerias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `status` smallint(6) DEFAULT '0',
  `fecha_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galerias`
--

LOCK TABLES `galerias` WRITE;
/*!40000 ALTER TABLE `galerias` DISABLE KEYS */;
/*!40000 ALTER TABLE `galerias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imagenes`
--

DROP TABLE IF EXISTS `imagenes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imagenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(100) NOT NULL,
  `thumb` varchar(100) DEFAULT NULL,
  `crop` varchar(100) DEFAULT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `es_banner` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagenes`
--

LOCK TABLES `imagenes` WRITE;
/*!40000 ALTER TABLE `imagenes` DISABLE KEYS */;
INSERT INTO `imagenes` VALUES (6,'463575-box-info-2-270x270.jpg',NULL,NULL,NULL,0),(7,'347661-bg-counter.jpg',NULL,NULL,NULL,0),(8,'392428-gallery-2-1200x800-original.jpg',NULL,NULL,NULL,0),(9,'310419-gallery-6-1200x800-original.jpg',NULL,NULL,NULL,0),(10,'490720-gallery-4-1200x800-original.jpg',NULL,NULL,NULL,0),(11,'273246-gallery-5-1200x800-original.jpg',NULL,NULL,NULL,0),(12,'117951-gallery-3-1200x800-original.jpg',NULL,NULL,NULL,0),(13,'919566-gallery-1-1200x800-original.jpg',NULL,NULL,NULL,0),(14,'733381-box-info-1-270x270.jpg',NULL,NULL,NULL,0),(15,'588357-box-info-3-270x270.jpg',NULL,NULL,NULL,0),(16,'65668-box-info-4-270x270.jpg',NULL,NULL,NULL,0),(17,'584504-box-info-2-270x270.jpg',NULL,NULL,NULL,0),(18,'701616-box-info-4-270x270.jpg',NULL,NULL,NULL,0),(19,'357360-box-info-5-570x400.jpg',NULL,NULL,NULL,0),(20,'776867-box-info-4-270x270.jpg',NULL,NULL,NULL,0),(21,'692297-box-info-5-570x400.jpg',NULL,NULL,NULL,0),(22,'911999-box-info-4-270x270.jpg',NULL,NULL,NULL,0),(23,'344388-box-info-5-570x400.jpg',NULL,NULL,NULL,0),(24,'180107-box-info-4-270x270.jpg',NULL,NULL,NULL,0),(25,'661674-box-info-5-570x400.jpg',NULL,NULL,NULL,0),(26,'726535-box-info-2-270x270.jpg',NULL,NULL,NULL,0),(27,'748961-box-info-3-270x270.jpg',NULL,NULL,NULL,0),(28,'678360-box-info-4-270x270.jpg',NULL,NULL,NULL,0),(29,'864500-bg-breadcrumbs.jpg',NULL,NULL,NULL,0),(30,'510712-bg-503.jpg',NULL,NULL,NULL,0);
/*!40000 ALTER TABLE `imagenes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imagenes_galerias`
--

DROP TABLE IF EXISTS `imagenes_galerias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imagenes_galerias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_imagen` int(11) NOT NULL,
  `id_galeria` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `imagenes_galerias_galerias_FK` (`id_galeria`),
  KEY `imagenes_galerias_imagenes_FK` (`id_imagen`),
  CONSTRAINT `imagenes_galerias_galerias_FK` FOREIGN KEY (`id_galeria`) REFERENCES `galerias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `imagenes_galerias_imagenes_FK` FOREIGN KEY (`id_imagen`) REFERENCES `imagenes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imagenes_galerias`
--

LOCK TABLES `imagenes_galerias` WRITE;
/*!40000 ALTER TABLE `imagenes_galerias` DISABLE KEYS */;
/*!40000 ALTER TABLE `imagenes_galerias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promociones`
--

DROP TABLE IF EXISTS `promociones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promociones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_lugar` int(11) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `cant_millas` varchar(20) NOT NULL,
  `cant_cuotas` varchar(20) NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `cant_pasajes` smallint(6) DEFAULT NULL,
  `codigo_barra` varchar(100) DEFAULT NULL,
  `id_imagen` int(11) DEFAULT NULL,
  `visibilidad` smallint(6) DEFAULT '0',
  `status` smallint(6) NOT NULL DEFAULT '1',
  `fecha_fin` date DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `promociones_imagenes_FK` (`id_imagen`),
  CONSTRAINT `promociones_imagenes_FK` FOREIGN KEY (`id_imagen`) REFERENCES `imagenes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promociones`
--

LOCK TABLES `promociones` WRITE;
/*!40000 ALTER TABLE `promociones` DISABLE KEYS */;
INSERT INTO `promociones` VALUES (1,1,'Bariloche','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada diam nunc, in lobortis ipsum molestie luctus. Nulla congue elit ut odio molestie, vel pellentesque felis pretium. Vestibulum gravida quam nec justo finibus, eu pulvinar nibh consequat. Curabitur dictum auctor ex, sed ultrices elit faucibus et.&nbsp;','15000','12','2018-07-29',250,'nmnmnmkk76f54bhh6',6,0,1,'2018-07-31','2018-05-29 11:06:06');
/*!40000 ALTER TABLE `promociones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suscripciones`
--

DROP TABLE IF EXISTS `suscripciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suscripciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` int(11) NOT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `suscripciones_UN` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suscripciones`
--

LOCK TABLES `suscripciones` WRITE;
/*!40000 ALTER TABLE `suscripciones` DISABLE KEYS */;
INSERT INTO `suscripciones` VALUES (1,0,'2018-06-12 11:29:57',NULL);
/*!40000 ALTER TABLE `suscripciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'db_millas_tts'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-12 15:11:21

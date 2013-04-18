-- MySQL dump 10.13  Distrib 5.5.29, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: 4475project
-- ------------------------------------------------------
-- Server version	5.5.29-0ubuntu0.12.04.2

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
-- Table structure for table `algorithm2project`
--

DROP TABLE IF EXISTS `algorithm2project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `algorithm2project` (
  `algorithmId` int(11) NOT NULL,
  `projectId` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `output` varchar(255) NOT NULL,
  PRIMARY KEY (`projectId`,`algorithmId`),
  KEY `fk_algorithm2project_1` (`algorithmId`),
  KEY `fk_algorithm2project_2` (`projectId`),
  CONSTRAINT `fk_algorithm2project_1` FOREIGN KEY (`algorithmId`) REFERENCES `algorithms` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_algorithm2project_2` FOREIGN KEY (`projectId`) REFERENCES `projects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `algorithm2project`
--

LOCK TABLES `algorithm2project` WRITE;
/*!40000 ALTER TABLE `algorithm2project` DISABLE KEYS */;
/*!40000 ALTER TABLE `algorithm2project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `algorithms`
--

DROP TABLE IF EXISTS `algorithms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `algorithms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `algorithms`
--

LOCK TABLES `algorithms` WRITE;
/*!40000 ALTER TABLE `algorithms` DISABLE KEYS */;
/*!40000 ALTER TABLE `algorithms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `projectId` int(11) NOT NULL,
  `order` int(11) DEFAULT NULL,
  `cover` varchar(1) NOT NULL DEFAULT 'N',
  `filename` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_images_1` (`projectId`),
  CONSTRAINT `fk_images_1` FOREIGN KEY (`projectId`) REFERENCES `projects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (3,8,0,'Y','egypt 027.jpg'),(6,9,0,'Y','egypt 027.jpg'),(9,10,0,'Y','egypt 027.jpg'),(12,11,0,'Y','egypt 027.jpg'),(13,12,0,'Y','egypt 027.jpg'),(14,13,0,'Y','egypt 027.jpg'),(15,14,0,'Y','egypt 027.jpg'),(16,16,0,'Y','egypt 027.jpg');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL,
  `description` mediumtext,
  `uploadedBy` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (8,'vbn','2013-04-16 10:45:21','vbn','vbn'),(9,'first','2013-04-16 10:46:13','first','Marin'),(10,'qwe','2013-04-16 10:47:35','qwe','qwe'),(11,'fdg','2013-04-16 10:48:45','dfg','dfg'),(12,'zxc','2013-04-16 10:49:19','zxc','zxc'),(13,'test','2013-04-17 16:08:17','tst','marin'),(14,'asdf','2013-04-18 00:15:10','asdf','asdf'),(15,'asd','2013-04-18 00:16:30','asd','asd'),(16,'zxc','2013-04-18 00:18:20','zxc','zxc');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-04-18  0:36:27

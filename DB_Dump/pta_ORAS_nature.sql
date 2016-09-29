-- MySQL dump 10.13  Distrib 5.7.15, for Linux (x86_64)
--
-- Host: localhost    Database: pta
-- ------------------------------------------------------
-- Server version	5.6.17

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
-- Table structure for table `ORAS_nature`
--

DROP TABLE IF EXISTS `ORAS_nature`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ORAS_nature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `raise` varchar(4) DEFAULT NULL,
  `lower` varchar(4) DEFAULT NULL,
  `liked` varchar(10) DEFAULT NULL,
  `disliked` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ORAS_nature`
--

LOCK TABLES `ORAS_nature` WRITE;
/*!40000 ALTER TABLE `ORAS_nature` DISABLE KEYS */;
INSERT INTO `ORAS_nature` VALUES (1,'Hardy','hp','atk','None','Spicy'),(2,'Docile','hp','def','None','Sour'),(3,'Proud','hp','satk','None','Dry'),(4,'Quirky','hp','sdef','None','Bitter'),(5,'Lazy','hp','spd','None','Sweet'),(6,'Desperate','atk','hp','Spicy','None'),(7,'Lonely','atk','def','Spicy','Sour'),(8,'Adamant','atk','satk','Spicy','Dry'),(9,'Naughty','atk','sdef','Spicy','Bitter'),(10,'Brave','atk','spd','Spicy','Sweet'),(11,'Stark','def','hp','Sour','None'),(12,'Bold','def','atk','Sour','Spicy'),(13,'Impish','def','satk','Sour','Dry'),(14,'Lax','def','sdef','Sour','Bitter'),(15,'Relaxed','def','spd','Sour','Sweet'),(16,'Bashful','satk','hp','Dry','None'),(17,'Modest','satk','atk','Dry','Spicy'),(18,'Mild','satk','def','Dry','Sour'),(19,'Rash','satk','sdef','Dry','Bitter'),(20,'Quiet','satk','spd','Dry','Sweet'),(21,'Sickly','sdef','hp','Bitter','None'),(22,'Calm','sdef','atk','Bitter','Spicy'),(23,'Gentle','sdef','def','Bitter','Sour'),(24,'Careful','sdef','satk','Bitter','Dry'),(25,'Sassy','sdef','spd','Bitter','Sweet'),(26,'Serious','spd','hp','Sweet','None'),(27,'Timid','spd','atk','Sweet','Spicy'),(28,'Hasty','spd','def','Sweet','Sour'),(29,'Jolly','spd','satk','Sweet','Dry'),(30,'Naive','spd','sdef','Sweet','Bitter'),(31,'Composed',NULL,NULL,'None','None'),(32,'Dull',NULL,NULL,'None','None'),(33,'Patient',NULL,NULL,'None','None'),(34,'Poised',NULL,NULL,'None','None'),(35,'Stoic',NULL,NULL,'None','None');
/*!40000 ALTER TABLE `ORAS_nature` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-09-29 17:00:54

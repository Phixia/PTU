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
-- Table structure for table `ORAS_TMs_HMs`
--

DROP TABLE IF EXISTS `ORAS_TMs_HMs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ORAS_TMs_HMs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(3) NOT NULL,
  `name` varchar(45) NOT NULL,
  `move_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ORAS_TMs_HMs`
--

LOCK TABLES `ORAS_TMs_HMs` WRITE;
/*!40000 ALTER TABLE `ORAS_TMs_HMs` DISABLE KEYS */;
INSERT INTO `ORAS_TMs_HMs` VALUES (1,'01','Hone Claws',38),(2,'02','Dragon Claw',58),(3,'03','Psyshock',534),(4,'04','Calm Mind',500),(5,'05','Roar',415),(6,'06','Toxic',492),(7,'07','Hail',289),(8,'08','Bulk Up',116),(9,'09','Venoshock',495),(10,'10','Hidden Power',368),(11,'11','Sunny Day',182),(12,'12','Taunt',53),(13,'13','Ice Beam',292),(14,'14','Blizzard',284),(15,'15','Hyper Beam',373),(16,'16','Light Screen',517),(17,'17','Protect',402),(18,'18','Rain Dance',596),(19,'19','Roost',203),(20,'20','Safeguard',418),(21,'21','Frustration',354),(22,'22','Solar Beam',255),(23,'23','Smack Down',560),(24,'24','Thunderbolt',90),(25,'25','Thunder',87),(26,'26','Earthquake',270),(27,'27','Return',414),(28,'28','Dig',267),(29,'29','Psychic',530),(30,'30','Shadow Ball',219),(31,'31','Brick Break',115),(32,'32','Double Team',334),(33,'33','Reflect',537),(34,'34','Sludge Wave',490),(35,'35','Flamethrower',169),(36,'36','Sludge Bomb',489),(37,'37','Sandstorm',559),(38,'38','Fire Blast',161),(39,'39','Rock Tomb',556),(40,'40','Aerial Ace',186),(41,'41','Torment',56),(42,'42','Facade',345),(43,'43','Flame Charge',167),(44,'44','Rest',538),(45,'45','Attract',306),(46,'46','Thief',54),(47,'47','Low Sweep',135),(48,'48','Round',417),(49,'49','Echoed Voice',337),(50,'50','Overheat',179),(51,'51','Steel Wing',582),(52,'52','Focus Blast',127),(53,'53','Energy Ball',231),(54,'54','False Swipe',347),(55,'55','Scald',598),(56,'56','Fling',36),(57,'57','Charge Beam',72),(58,'58','Sky Drop',205),(59,'59','Incinerate',174),(60,'60','Quash',48),(61,'61','Will-O-Wisp',184),(62,'62','Acrobatics',185),(63,'63','Embargo',32),(64,'64','Explosion',343),(65,'65','Shadow Claw',220),(66,'66','Payback',45),(67,'67','Retaliate',413),(68,'68','Giga Impact',357),(69,'69','Rock Polish',553),(70,'70','Flash',350),(71,'71','Stone Edge',562),(72,'72','Volt Switch',93),(73,'73','Thunder Wave',89),(74,'74','Gyro Ball',569),(75,'75','Swords Dance',452),(76,'76','Struggle Bug',21),(77,'77','Psych Up',403),(78,'78','Bulldoze',266),(79,'79','Frost Breath',287),(80,'80','Rock Slide',554),(81,'81','X-Scissor',25),(82,'82','Dragon Tail',63),(83,'83','Infestation',8),(84,'84','Poison Jab',484),(85,'85','Dream Eater',503),(86,'86','Grass Knot',235),(87,'87','Swagger',448),(88,'88','Sleep Talk',433),(89,'89','U-Turn',24),(90,'90','Substitute',445),(91,'91','Flash Cannon',567),(92,'92','Trick Room',546),(93,'93','Wild Charge',95),(94,'94','Rock Smash',142),(95,'95','Snarl',49),(96,'96','Nature Power',393),(97,'97','Dark Pulse',30),(98,'98','Power-Up Punch',138),(99,'99','Dazzling Gleam',101),(100,'100','Confide',321),(101,'A1','Cut',329),(102,'A2','Fly',196),(103,'A3','Surf',600),(104,'A4','Strength',444),(105,'A5','Waterfall',607),(106,'A6','Dive',591);
/*!40000 ALTER TABLE `ORAS_TMs_HMs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-09-29 17:00:55

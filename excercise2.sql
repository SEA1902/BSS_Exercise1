-- MySQL dump 10.19  Distrib 10.3.34-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: BSS_Exercise1
-- ------------------------------------------------------
-- Server version	10.3.34-MariaDB-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `device`
--

DROP TABLE IF EXISTS `device`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `device` (
                          `id` int(11) NOT NULL AUTO_INCREMENT,
                          `name_device` varchar(256) NOT NULL,
                          `ip` varchar(256) NOT NULL,
                          `mac` varchar(256) NOT NULL,
                          `create_date` date NOT NULL,
                          `power_consumption` int(11) NOT NULL,
                          PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device`
--

LOCK TABLES `device` WRITE;
/*!40000 ALTER TABLE `device` DISABLE KEYS */;
INSERT INTO `device` VALUES (1,'TV','123456','12:2b:b2:b3','2022-06-18',50),(2,'TV1','1234678','13:1b:b2:b3','2022-06-18',40),(3,'TV2','125678','12:1b:b2:b3','2022-06-18',30),(4,'TV3','1345678','12:3b:b2:b3','2022-06-18',60),(5,'Washer','1234567','02:2b:b2:b3','2022-06-18',50),(6,'Washer1','123456','12:2b:b1:b3','2022-06-18',10),(7,'Washer2','12378','12:2b:b3:b3','2022-06-18',20),(8,'Washer3','45678','12:2b:b4:b3','2022-06-18',70);
/*!40000 ALTER TABLE `device` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image` (
                         `id` int(11) NOT NULL AUTO_INCREMENT,
                         `url` text NOT NULL,
                         `person_id` int(11) NOT NULL,
                         PRIMARY KEY (`id`),
                         KEY `person_id` (`person_id`),
                         CONSTRAINT `image_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image`
--

LOCK TABLES `image` WRITE;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
INSERT INTO `image` VALUES (1,'https://cdn.pixabay.com/photo/2020/04/30/14/03/mountains-and-hills-5112952__480.jpg',86);
/*!40000 ALTER TABLE `image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
                       `id` int(11) NOT NULL AUTO_INCREMENT,
                       `action` varchar(256) NOT NULL,
                       `date` int(11) NOT NULL,
                       KEY `id` (`id`),
                       CONSTRAINT `log_ibfk_1` FOREIGN KEY (`id`) REFERENCES `device` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` VALUES (1,'turn on',1),(2,'sleep',2),(1,'turn off',1),(3,'turn on',3),(4,'sleep',2),(5,'turn on',1),(6,'sleep',5),(7,'turn on',4),(1,'sleep',3),(2,'turn off',5),(3,'sleep',2),(4,'turn on',2),(1,'turn off',4),(4,'sleep',1),(3,'turn on',1),(5,'turn off',3),(6,'turn on',1),(7,'sleep',1),(1,'sleep',3),(1,'turn on',4),(2,'turn off',5);
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `person`
--

DROP TABLE IF EXISTS `person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `person` (
                          `id` int(11) NOT NULL AUTO_INCREMENT,
                          `name` varchar(256) CHARACTER SET armscii8 NOT NULL,
                          `email` varchar(256) NOT NULL,
                          `gender` smallint(6) NOT NULL,
                          `password` varchar(50) NOT NULL,
                          PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person`
--

LOCK TABLES `person` WRITE;
/*!40000 ALTER TABLE `person` DISABLE KEYS */;
INSERT INTO `person` VALUES (86,'bien','bien@gmail.com',1,'12345678');
/*!40000 ALTER TABLE `person` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-20 15:15:49
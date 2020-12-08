-- MySQL dump 10.13  Distrib 8.0.20, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: 2daw
-- ------------------------------------------------------
-- Server version	8.0.20

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `reservas`
--

DROP TABLE IF EXISTS `reservas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservas` (
  `nombre` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `movil` varchar(10) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(5) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `estado` varchar(10) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `ncomensales` int NOT NULL,
  PRIMARY KEY (`apellidos`),
  UNIQUE KEY `apellidos_UNIQUE` (`apellidos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservas`
--

LOCK TABLES `reservas` WRITE;
/*!40000 ALTER TABLE `reservas` DISABLE KEYS */;
INSERT INTO `reservas` VALUES ('BILALO','ANNOUH','admin@gmail.com','632332237','2020-12-23','13:00','preparada',1),('Tayeb','Bejja','admin@gmail.com','632332217','2020-12-10','19:30','preparada',4),('weef','f3f3f','bilalbejja2016@gmail.com','632332237','2020-12-23','13:00','preparada',5),('Ahmed','Khalifa','khalifa@hotmail.com','970289782','2021-01-06','20:30','preparada',6),('Ahmed','qwrqwr','diego@gmail.com','970289782','2020-12-07','21:30','preparada',3),('uqeyiq','werwe','admin@admin.com','632332237','2020-12-23','13:00','preparada',10),('uqeyiq','werwei','admin@admin.com','632332237','2020-12-23','13:00','preparada',10),('uqeyiq','werweip','admin@admin.com','632332237','2020-12-07','13:00','preparada',10),('uqeyiq','werweo','admin@admin.com','632332237','2020-12-08','13:00','preparada',8),('uqeyiq','werweow','admin@admin.com','632332237','2020-12-08','13:00','preparada',10),('uqeyiq','werweoww','admin@admin.com','632332237','2020-12-08','13:00','preparada',10),('sdad','wewe','@.com','564687987','2020-12-07','19:30','preparada',25);
/*!40000 ALTER TABLE `reservas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-12-08 16:39:34

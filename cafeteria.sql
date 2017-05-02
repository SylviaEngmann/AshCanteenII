CREATE DATABASE  IF NOT EXISTS `cafeteria_db` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `cafeteria_db`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: cafeteria_db
-- ------------------------------------------------------
-- Server version	5.7.17-log

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
-- Table structure for table `c_orders`
--

DROP TABLE IF EXISTS `c_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `c_orders` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `C_Id` int(11) DEFAULT NULL,
  `F_Id` int(11) DEFAULT NULL,
  `E_Id` int(11) DEFAULT NULL,
  `M_Id` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `can_Id` int(11) NOT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `C_Id` (`C_Id`),
  KEY `F_Id` (`F_Id`),
  KEY `E_Id` (`E_Id`),
  KEY `can_Id` (`can_Id`),
  KEY `M_Id` (`M_Id`),
  CONSTRAINT `c_orders_ibfk_1` FOREIGN KEY (`C_Id`) REFERENCES `customers` (`Id`),
  CONSTRAINT `c_orders_ibfk_2` FOREIGN KEY (`F_Id`) REFERENCES `foodlist` (`Id`),
  CONSTRAINT `c_orders_ibfk_3` FOREIGN KEY (`E_Id`) REFERENCES `employees` (`Id`),
  CONSTRAINT `c_orders_ibfk_4` FOREIGN KEY (`can_Id`) REFERENCES `canteens` (`Id`),
  CONSTRAINT `c_orders_ibfk_5` FOREIGN KEY (`M_Id`) REFERENCES `mealtype` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `c_orders`
--

LOCK TABLES `c_orders` WRITE;
/*!40000 ALTER TABLE `c_orders` DISABLE KEYS */;
INSERT INTO `c_orders` VALUES (11,1,1,1,2,2,'2017-04-17 00:00:00',1,15.00);
/*!40000 ALTER TABLE `c_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `canteens`
--

DROP TABLE IF EXISTS `canteens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `canteens` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `canName` varchar(200) NOT NULL,
  `Picture` varchar(255) DEFAULT NULL,
  `fcm` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `canteens`
--

LOCK TABLES `canteens` WRITE;
/*!40000 ALTER TABLE `canteens` DISABLE KEYS */;
INSERT INTO `canteens` VALUES (1,'Akorno','akornno.png','cWmQhuH9vsQ:APA91bGTxMabONk8fygPvGGnYPnbxV-hVOOlbU7zksrjvudo1A8cD24ByzpOYYziaADDQ5\njmKoDA-gDPCwR_vD2hJ-ZiiqyfwTK7q5sS96E4UTrqcNveonSvJfZW0vAHg_z4FuKzGEQn'),(2,'Big Ben','big_ben.png',NULL);
/*!40000 ALTER TABLE `canteens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `cName` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `fcm` varchar(500) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'Renee Dana','ree.d','2241cc56335940bbd858ed33fd4e7fc7','');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `eName` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `Login` int(11) NOT NULL,
  `category` enum('Admin','Employee','','') NOT NULL,
  `canteen` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,'gmk','gmk','gmk','giftym94@gmail.com',1,'Admin',1),(2,'Elsa Frozen','elsa.frozen','elsa','giftym94@gmail.com',1,'Employee',1);
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `foodlist`
--

DROP TABLE IF EXISTS `foodlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `foodlist` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `fName` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Category` int(11) NOT NULL,
  `Picture` varchar(255) NOT NULL,
  `Size` int(11) NOT NULL,
  `canteen` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_food_cat` (`Category`),
  KEY `fk_canteen_id` (`canteen`),
  CONSTRAINT `FK_food_cat` FOREIGN KEY (`Category`) REFERENCES `meal_cat` (`Id`),
  CONSTRAINT `fk_canteen_id` FOREIGN KEY (`canteen`) REFERENCES `canteens` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foodlist`
--

LOCK TABLES `foodlist` WRITE;
/*!40000 ALTER TABLE `foodlist` DISABLE KEYS */;
INSERT INTO `foodlist` VALUES (1,'Jollof Rice','',1,'86903-jollof-rice.png',298,1),(2,'Fried Rice','',1,'71619-yang-zhou-fried-rice-(2)---1.jpg',222,1),(3,'French Fries','',1,'66304-fries.jpg',287,2),(4,'Boiled Egg','',2,'6175-20140430-peeling-eggs-10-thumb-1500xauto-398212.jpg',83,1),(5,'Yam Chips','',1,'71459-yamc.jpg',7,1),(6,'Waakye','',1,'19459-ghana-waakye-chicken-plantain-cabbage.jpg',63,1),(7,'Agushie Stew','',5,'93493-agushie.jpg',17,1),(8,'Beans Stew','',5,'62171-index.jpg',7,1),(9,'Tomato sauce','',5,'74489-basic-tomato-sauce-horiz-a-1200.jpg',80,1),(10,'Shito','',5,'72873-shito.jpg',8,1),(11,'Light Soup','',4,'93142-maxresdefault.jpg',97,1),(13,'Palm nut Soup','',4,'81003-p1060486.jpg',371,1),(14,'Salad','',3,'71314-images.jpg',10,1),(18,'Jollof Rice','',1,'51654-jollof-rice.png',298,2);
/*!40000 ALTER TABLE `foodlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meal_cat`
--

DROP TABLE IF EXISTS `meal_cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meal_cat` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `catName` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meal_cat`
--

LOCK TABLES `meal_cat` WRITE;
/*!40000 ALTER TABLE `meal_cat` DISABLE KEYS */;
INSERT INTO `meal_cat` VALUES (1,'Carbohydrates'),(2,'Protein'),(3,'Vegetables'),(4,'Soups'),(5,'Stews & Sauces');
/*!40000 ALTER TABLE `meal_cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mealtype`
--

DROP TABLE IF EXISTS `mealtype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mealtype` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `mName` varchar(100) DEFAULT NULL,
  `description` text,
  `Price` double NOT NULL,
  `can_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `can_id` (`can_id`),
  CONSTRAINT `mealtype_ibfk_1` FOREIGN KEY (`can_id`) REFERENCES `canteens` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mealtype`
--

LOCK TABLES `mealtype` WRITE;
/*!40000 ALTER TABLE `mealtype` DISABLE KEYS */;
INSERT INTO `mealtype` VALUES (1,'deluxe','',8.5,1),(2,'Classic',NULL,7.5,1),(3,'Americana',NULL,8.5,1);
/*!40000 ALTER TABLE `mealtype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `F_Id` int(11) NOT NULL,
  `category` int(11) DEFAULT NULL,
  `can_Id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `F_Id` (`F_Id`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`F_Id`) REFERENCES `foodlist` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (24,13,4,1),(26,1,1,1),(27,2,1,1),(28,5,1,1),(29,6,1,1),(30,4,2,1),(34,8,5,1),(35,9,5,1),(38,7,5,1),(41,10,5,1),(42,14,3,1);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_history`
--

DROP TABLE IF EXISTS `order_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_history` (
  `oh_id` int(11) NOT NULL AUTO_INCREMENT,
  `F_Id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(5,2) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `tid` int(11) DEFAULT NULL,
  PRIMARY KEY (`oh_id`),
  KEY `FK_pers_id` (`pid`),
  KEY `FK_t_id` (`tid`),
  CONSTRAINT `FK_pers_id` FOREIGN KEY (`pid`) REFERENCES `person` (`pid`),
  CONSTRAINT `FK_t_id` FOREIGN KEY (`tid`) REFERENCES `transaction` (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_history`
--

LOCK TABLES `order_history` WRITE;
/*!40000 ALTER TABLE `order_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `p_orders`
--

DROP TABLE IF EXISTS `p_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `p_orders` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `C_Id` int(11) DEFAULT NULL,
  `F_Id` int(11) DEFAULT NULL,
  `M_Id` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `price` decimal(5,2) DEFAULT NULL,
  `order_type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `F_Id` (`F_Id`),
  KEY `M_Id` (`M_Id`),
  KEY `p_orders_ibfk_1_idx` (`C_Id`),
  CONSTRAINT `p_orders_ibfk_1` FOREIGN KEY (`C_Id`) REFERENCES `person` (`pid`),
  CONSTRAINT `p_orders_ibfk_2` FOREIGN KEY (`F_Id`) REFERENCES `foodlist` (`Id`),
  CONSTRAINT `p_orders_ibfk_3` FOREIGN KEY (`M_Id`) REFERENCES `mealtype` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `p_orders`
--

LOCK TABLES `p_orders` WRITE;
/*!40000 ALTER TABLE `p_orders` DISABLE KEYS */;
INSERT INTO `p_orders` VALUES (5,10,2,NULL,1,7.50,'delivery'),(6,1,2,NULL,1,7.50,'delivery'),(7,1,1,NULL,1,7.50,'delivery'),(8,1,2,NULL,1,7.50,'delivery'),(9,11,1,NULL,2,7.50,'delivery'),(10,11,2,NULL,1,7.50,'delivery'),(12,1,2,NULL,1,7.50,'delivery'),(13,1,1,NULL,1,7.50,'delivery'),(14,1,1,NULL,1,7.50,'delivery'),(15,1,2,NULL,1,7.50,'delivery'),(16,1,1,NULL,1,7.50,'delivery'),(17,1,2,NULL,1,7.50,'delivery'),(18,1,1,NULL,1,7.50,'delivery'),(19,1,1,NULL,1,7.50,'delivery'),(20,1,1,NULL,1,7.50,'delivery'),(21,1,2,NULL,1,7.50,'delivery'),(24,1,1,NULL,1,7.50,'delivery'),(25,1,5,NULL,2,8.50,'delivery');
/*!40000 ALTER TABLE `p_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `person`
--

DROP TABLE IF EXISTS `person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `person` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `fcm` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person`
--

LOCK TABLES `person` WRITE;
/*!40000 ALTER TABLE `person` DISABLE KEYS */;
INSERT INTO `person` VALUES (1,'Ama','Ghana','amag','ca3a1bf1ce60db8017e0bb5e4f56913a','amag',NULL),(9,'sn','sn','sn','afbe94cdbe69a93efabc9f1325fc7dff','sn',NULL),(10,'rejoice','hormeku','reji','485b59fce51a6a0b945a6b4c9a5d23d4','rejoicehormeku@gmail.com',NULL),(11,'Re','Re','re','12eccbdd9b32918131341f38907cbbb5','re@gmail.com',NULL),(12,'','','','d41d8cd98f00b204e9800998ecf8427e','',NULL),(13,'Maame Esi','Mensah','mem','afc4fc7e48a0710a1dc94ef3e8bc5764','mem@gmail.com',NULL),(14,'Sylvia','Engmann','syl','0c7e0e3afed9b89ff0fd10b7a5bff0ce','sylvia@gmail.com','dljJ1R_Rf7c:APA91bHECFfIwCy8Mwg9GkcAkWlHuglZER8GN6-uy5zDnnWnwwLw43e7Y46IqaCAZR8THO9p7intCD9X56ccosM3K4irsUnRFsEJ2mbBkDUC29PSGV2tJk-lCiAKdEG4uGfJvarWPjss');
/*!40000 ALTER TABLE `person` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `review` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `F_Id` int(11) NOT NULL,
  `reviews` text NOT NULL,
  `rating` int(11) NOT NULL,
  `time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review`
--

LOCK TABLES `review` WRITE;
/*!40000 ALTER TABLE `review` DISABLE KEYS */;
INSERT INTO `review` VALUES (8,1,'The rice was quite hard. ',3,'2017-04-25 16:39:31'),(9,5,'Very crispy. Loved it',5,'2017-04-26 01:16:09'),(10,1,'Too salty :(. Can we get better food please?',2,'2017-04-26 08:56:23'),(11,5,'A little more salt please',2,'2017-04-26 09:08:37');
/*!40000 ALTER TABLE `review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp_orders`
--

DROP TABLE IF EXISTS `temp_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_orders` (
  `temp_id` int(11) NOT NULL AUTO_INCREMENT,
  `F_Id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(5,2) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  PRIMARY KEY (`temp_id`),
  KEY `FK_per_id` (`pid`),
  CONSTRAINT `FK_per_id` FOREIGN KEY (`pid`) REFERENCES `person` (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_orders`
--

LOCK TABLES `temp_orders` WRITE;
/*!40000 ALTER TABLE `temp_orders` DISABLE KEYS */;
INSERT INTO `temp_orders` VALUES (53,6,1,7.50,14),(54,5,1,8.50,14);
/*!40000 ALTER TABLE `temp_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `amount` decimal(6,2) DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-28  8:57:11

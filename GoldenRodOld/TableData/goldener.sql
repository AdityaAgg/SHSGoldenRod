-- MySQL dump 10.13  Distrib 5.5.19, for Linux (x86_64)
--
-- Host: 68.178.142.118    Database: goldener
-- ------------------------------------------------------
-- Server version	5.0.96-log

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
-- Table structure for table `Teacher`
--

DROP TABLE IF EXISTS `Teacher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Teacher` (
  `teacher_code` char(2) NOT NULL,
  `teacher_name` varchar(60) NOT NULL,
  PRIMARY KEY  (`teacher_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Teacher`
--

LOCK TABLES `Teacher` WRITE;
/*!40000 ALTER TABLE `Teacher` DISABLE KEYS */;
/*!40000 ALTER TABLE `Teacher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (0,'appdever','falcons2013');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_book`
--

DROP TABLE IF EXISTS `student_book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_book` (
  `SubmitID` int(11) NOT NULL auto_increment,
  `student_id` int(11) unsigned NOT NULL,
  `teacher` varchar(255) NOT NULL,
  `booktitle` varchar(255) NOT NULL,
  `bookID` int(11) NOT NULL,
  `BookDesc` text NOT NULL,
  `Time` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`SubmitID`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `student_book_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`pk_user`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_book`
--

LOCK TABLES `student_book` WRITE;
/*!40000 ALTER TABLE `student_book` DISABLE KEYS */;
INSERT INTO `student_book` VALUES (66,17,'Cahatol, Janny','Chemistry With Applications',23443,'NEW!','2013-07-03 22:38:31'),(67,17,'McCorry, Maureen','World History',137831,'New.','2013-07-05 15:56:24'),(68,2,'Abe, Kirk','aaa',2147483647,'asdasdasda','2013-07-23 03:00:11'),(69,17,'Herzman, Suzanne','A Thousand Splendid Suns',22343,'New!','2013-07-23 03:04:43'),(70,17,'Ritchie, Natasha','Huckleberry Finn',12323,'NEW!','2013-07-24 18:50:22'),(71,17,'Yowell, Jim','Mathematics',159383,'New, highlighter marks on some pages','2013-07-25 22:58:08'),(72,17,'Nguyen, Ken K.','Huckster Finn',1234567,'Ff','2013-08-08 16:23:05');
/*!40000 ALTER TABLE `student_book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `pk_user` int(11) unsigned NOT NULL auto_increment,
  `email` varchar(120) NOT NULL,
  `flname` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `usr_ip` varchar(15) default NULL,
  `usr_nmb_logins` int(10) unsigned NOT NULL default '0',
  `usr_signup_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `usr_userid` varchar(32) default NULL,
  `usr_confirm_hash` varchar(255) NOT NULL,
  `usr_is_confirmed` tinyint(1) NOT NULL default '0',
  `usr_resetpassword_hash` varchar(255) NOT NULL,
  `usr_is_blocked` tinyint(1) NOT NULL default '0',
  `usr_is_admin` tinyint(1) NOT NULL default '0',
  `st_id` int(11) default NULL,
  PRIMARY KEY  (`pk_user`),
  UNIQUE KEY `email` (`email`),
  KEY `pk_user` (`pk_user`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'jyang847@gmail.com','Jerry Yang','121ba6311e9abc8bdc68d4ff9e42c388c798e6eb','99.65.176.93',2,'2013-06-07 03:40:30','7e03f81bfbff749679309f5526f0a618','d1dc854ca830ab494332092e93ee4381aa61940e',1,'',0,0,NULL),(3,'goldenglovemax@gmail.com','Maximilian Chang','5081d27aec3340b7ab2c52635c69ff130af1a27a','24.23.136.70',7,'2013-06-07 05:50:31','f2bc27db1ca9f4d3ccb6ffbb97588bab','ddccdfd9d5eff43e73b2a86528305882c9de0349',1,'',0,0,106692),(6,'divyachallenger09@gmail.com','Aggar','156b929781737e8a1444f376ffa2e3d18b178691','24.6.180.200',0,'2013-06-10 06:28:47',NULL,'5355b775fe62e447a63f97c0eec564d01e9fdfdd',0,'',0,0,NULL),(12,'apmadhani@gmail.com','Akshay Madhani','e6fd77c62c502f5f7cf227b11d535b71f3cd793d','67.169.103.250',6,'2013-06-10 22:10:22','112feb0369249e2055868f331139d2a3','e9223686231b15d0c41ab92c562a32ba8a010522',1,'',0,0,NULL),(17,'adityaaggarwalz200@gmail.com','Aditya Aggarwal','9eac4062b70260d5ece5fa73fd1795a30f382a83','24.6.180.200',246,'2013-06-11 00:00:22','a24970d6066fa6da7c5441e3dffb3dae','84fa9558be0b0fadfcc64f5b9afc8cb1f8583308',1,'b9e224e9f56220bf16c5dc86a745d83b0583fee0',0,0,107070),(18,'Alexlyeh@gmail.com','Alex Yeh','1f6c5c74b7e7c706082c1d814240fecad187a504','75.25.124.96',2,'2013-06-11 00:02:56','a41c7fea6c0299db0a9b8688a636ff1c','f76ebc137aec068c50f4a812b78b8a65e794f1d0',1,'',0,0,106987),(19,'minupal6@gmail.com','minu','52e3a858a216b07047515943254c92c22e757568','24.4.7.203',1,'2013-06-11 03:27:56','dfa70bf4a25ecaeb8c4be6ff619986fe','c226203c51e077e5a492d2af72b7b4b16fd37145',1,'',0,0,106021),(20,'aditya@milestoneinternet.com','Bob Stewart','d42cd925c2df483050e30840437dd1a511d47e15','24.6.180.200',0,'2013-06-24 02:28:29',NULL,'bea2904c2bd3227fcb934e51fef19b23249de19d',0,'f1b5a3fe9c6fa6df9046913a8dccf10c487c6a76',0,0,23232),(21,'benu@milestoneinternet.com','Benu Aggarwal','8130d58a50263b5f3c1a901d9e3a92f623eec6ca','192.5.215.234',0,'2013-07-23 03:01:58',NULL,'ad0f35832e547ce10d6c8b91c6a48dd52be14127',1,'',0,0,232323),(22,'kheyman@lgsuhsd.org','kevin heyman','1d1b01a592536e32b0c81d4b1d94a261b62cca99','166.137.191.29',0,'2013-08-08 16:06:21',NULL,'76ac7f1072d3ae80c3e30327969560c76a796e10',0,'',0,0,123456),(23,'probinson@lgsuhsd.org','Paul Robinson','12ef101bad92fe4697279958cd24547b34dc832f','204.88.157.18',0,'2013-08-08 16:07:15',NULL,'b3b251363ac9929e034fc107279003bdacfe00b4',0,'',0,0,118416);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-08-10  8:25:03

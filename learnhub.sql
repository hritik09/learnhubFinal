CREATE DATABASE  IF NOT EXISTS `learnhub` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `learnhub`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: learnhub
-- ------------------------------------------------------
-- Server version	5.1.36-community-log

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
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course` (
  `courseid` varchar(10) NOT NULL,
  `coursename` varchar(20) DEFAULT NULL,
  `course_creationdate` datetime DEFAULT NULL,
  `course_startdate` datetime DEFAULT NULL,
  `course_enddate` datetime DEFAULT NULL,
  `course_paid` tinyint(1) DEFAULT NULL,
  `course_category` varchar(20) DEFAULT NULL,
  `likes` decimal(10,0) DEFAULT NULL,
  `dislikes` decimal(10,0) DEFAULT NULL,
  `Fees` int(11) DEFAULT NULL,
  PRIMARY KEY (`courseid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course`
--

LOCK TABLES `course` WRITE;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
INSERT INTO `course` VALUES ('145050','Software Engineering','2013-05-09 12:07:49','2013-05-09 00:00:00','2013-05-30 00:00:00',0,'CS',1,0,0),('29267','Database','2013-05-09 15:09:42','2013-05-09 00:00:00','2013-06-19 00:00:00',0,'Computer',0,0,0),('521973','Ramayan','2013-05-09 13:36:26','2013-05-09 00:00:00','2013-07-25 00:00:00',0,'Bharat',0,0,0),('525787','Cricket Basics','2013-05-09 12:54:12','2013-05-09 00:00:00','2013-05-31 00:00:00',0,'Sports',0,0,0);
/*!40000 ALTER TABLE `course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event` (
  `eventid` int(11) NOT NULL AUTO_INCREMENT,
  `courseid` varchar(20) NOT NULL,
  `fileid` int(11) NOT NULL,
  `resp_eventid` int(11) DEFAULT NULL,
  `event_date` datetime NOT NULL,
  `due_date` datetime DEFAULT NULL,
  `event_eval` varchar(2) DEFAULT NULL,
  `event_feedback` varchar(100) DEFAULT NULL,
  `event_type` varchar(20) NOT NULL,
  `event_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`eventid`),
  KEY `courseid_fkd` (`courseid`),
  KEY `file_pkd` (`fileid`),
  CONSTRAINT `courseid_fkd` FOREIGN KEY (`courseid`) REFERENCES `course` (`courseid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `file_pkd` FOREIGN KEY (`fileid`) REFERENCES `file` (`fileid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=998721 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` VALUES (21760,'521973',895111,NULL,'2013-05-09 13:36:26',NULL,NULL,NULL,'ECOCR','Ramanyan'),(546570,'145050',161866,NULL,'2013-05-09 12:07:49',NULL,NULL,NULL,'ECOCR','Software Engineering'),(609436,'525787',772583,NULL,'2013-05-09 12:54:12',NULL,NULL,NULL,'ECOCR','Cricket Basics'),(957397,'29267',920837,NULL,'2013-05-09 15:09:42',NULL,NULL,NULL,'ECOCR','Database'),(998713,'145050',859100,NULL,'2013-05-13 00:00:00','2013-05-09 00:00:00',NULL,NULL,'EQCRE','Soft-1'),(998714,'145050',553131,NULL,'2013-05-09 12:28:58','2013-05-09 12:28:58',NULL,NULL,'ELEVI','Software Engineer'),(998715,'525787',24018,NULL,'2013-05-09 00:00:00','2013-05-16 00:00:00',NULL,NULL,'EQCRE','Cricekt Quiz 1'),(998716,'525787',883575,998715,'2013-05-09 13:08:03','2013-05-09 13:08:03','-2','Good Quiz','EQEVAL','EQEVAL_883575'),(998719,'521973',512054,NULL,'2013-05-09 00:00:00','2013-05-13 00:00:00',NULL,NULL,'EQCRE','Ramayan'),(998720,'521973',175812,NULL,'2013-05-09 15:18:38','2013-05-09 15:18:38',NULL,NULL,'ELEVI','Ramayan ');
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file`
--

DROP TABLE IF EXISTS `file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file` (
  `fileid` int(11) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `filename` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`fileid`),
  KEY `userid_fk` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file`
--

LOCK TABLES `file` WRITE;
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
INSERT INTO `file` VALUES (24018,'Fenil','Cricekt Quiz 1'),(161866,'Bhavin','161866.json'),(175812,'Mansukh','175812.json'),(512054,'Mansukh','Ramayan'),(553131,'Bhavin','553131.json'),(572754,'Bhavin','Quiz_s572754'),(589905,'Bhavin','Quiz_s589905'),(772583,'Fenil','772583.json'),(859100,'Bhavin','Soft-1'),(883575,'Bhavin','Quiz_s883575'),(895111,'Mansukh','895111.json'),(920837,'Ankit','920837.json');
/*!40000 ALTER TABLE `file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messagelist`
--

DROP TABLE IF EXISTS `messagelist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messagelist` (
  `MessageID` double NOT NULL AUTO_INCREMENT,
  `courseid` varchar(10) NOT NULL,
  `Message` text,
  `userid` varchar(20) DEFAULT NULL,
  `Email` text,
  `CreationDate` datetime NOT NULL,
  `ThreadID` double NOT NULL,
  PRIMARY KEY (`MessageID`),
  KEY `courseid_fk` (`courseid`),
  KEY `userid_fk` (`userid`),
  CONSTRAINT `courseid_fk` FOREIGN KEY (`courseid`) REFERENCES `user_course` (`courseid`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `userid_fk` FOREIGN KEY (`userid`) REFERENCES `user_course` (`userid`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messagelist`
--

LOCK TABLES `messagelist` WRITE;
/*!40000 ALTER TABLE `messagelist` DISABLE KEYS */;
/*!40000 ALTER TABLE `messagelist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `threadlist`
--

DROP TABLE IF EXISTS `threadlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `threadlist` (
  `ThreadID` double NOT NULL AUTO_INCREMENT,
  `Title` text,
  `userid` varchar(20) DEFAULT NULL,
  `courseid` varchar(10) NOT NULL,
  `Posts` double DEFAULT NULL,
  `CreationDate` datetime NOT NULL,
  `LastPostedTo` datetime NOT NULL,
  PRIMARY KEY (`ThreadID`),
  KEY `userid_fk_1` (`userid`),
  KEY `courseid_fk_1` (`courseid`),
  CONSTRAINT `courseid_fk_1` FOREIGN KEY (`courseid`) REFERENCES `course` (`courseid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `userid_fk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `threadlist`
--

LOCK TABLES `threadlist` WRITE;
/*!40000 ALTER TABLE `threadlist` DISABLE KEYS */;
INSERT INTO `threadlist` VALUES (1,'Why a need of Software Engineering Course?','Bhavin','145050',2,'2013-05-09 12:09:05','2013-05-09 12:37:35');
/*!40000 ALTER TABLE `threadlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `userid` varchar(15) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `firstname` varchar(20) DEFAULT NULL,
  `lastname` varchar(20) DEFAULT NULL,
  `user_address` varchar(100) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `pincode` bigint(20) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `areacode` int(11) DEFAULT NULL,
  `telephone` bigint(20) DEFAULT NULL,
  `accountid` bigint(20) DEFAULT NULL,
  `balance` int(11) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `security_ques` text NOT NULL,
  `security_ans` text NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('Ankit','d8578edf8458ce06fbc5bb76a58c5ca4','Ankit','Sharma','HOR Men','Gandhinagar','Gujarat','India',382007,'ankitsharma@gmail.co',0,0,0,0,'2013-05-09 00:00:00','What is your name?','Ankit'),('Bhavin','d8578edf8458ce06fbc5bb76a58c5ca4','Bhavin','Khatri','HOR Men','Gandhinagar','Gujarat','India',382007,'khatribhavin@gmail.c',0,0,0,0,'2013-05-09 00:00:00','What is your name?','Bhavin'),('Fenil','d8578edf8458ce06fbc5bb76a58c5ca4','Fenil','Kanjani','HOR Men','Gandhinagar','Gujarat','India',382207,'fenilkanjani@gmail.c',0,0,0,0,'2013-05-09 00:00:00','What is your name?','Fenil'),('Mansukh','d8578edf8458ce06fbc5bb76a58c5ca4','Mansukh','Shrimali','HOR Men','Gandhinagar','Gujarat','India',382007,'mansukhshrimali@gmai',0,0,0,0,'2013-05-09 00:00:00','What is your name?','Mansukh');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_course`
--

DROP TABLE IF EXISTS `user_course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_course` (
  `role` varchar(10) DEFAULT NULL,
  `date_of_joining` datetime DEFAULT NULL,
  `courseid` varchar(10) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `opinion` int(1) DEFAULT NULL,
  PRIMARY KEY (`userid`,`courseid`),
  KEY `courseid` (`courseid`),
  KEY `userid` (`userid`),
  CONSTRAINT `courseid` FOREIGN KEY (`courseid`) REFERENCES `course` (`courseid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `userid` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_course`
--

LOCK TABLES `user_course` WRITE;
/*!40000 ALTER TABLE `user_course` DISABLE KEYS */;
INSERT INTO `user_course` VALUES ('Student','2013-05-09 00:00:00','145050','Ankit','Approved',0),('Owner','2013-05-09 15:09:42','29267','Ankit','Approved',0),('Student','2013-05-09 00:00:00','525787','Ankit','Approved',0),('Owner','2013-05-09 12:07:49','145050','Bhavin','Approved',0),('Student','2013-05-09 00:00:00','29267','Bhavin','Approved',0),('Student','2013-05-09 00:00:00','525787','Bhavin','Approved',0),('Student','2013-05-09 00:00:00','145050','Fenil','Approved',0),('Owner','2013-05-09 12:54:12','525787','Fenil','Approved',0),('Student','2013-05-09 00:00:00','145050','Mansukh','Approved',0),('Owner','2013-05-09 13:36:26','521973','Mansukh','Approved',0),('Student','2013-05-09 00:00:00','525787','Mansukh','Approved',0);
/*!40000 ALTER TABLE `user_course` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-05-09 21:11:54

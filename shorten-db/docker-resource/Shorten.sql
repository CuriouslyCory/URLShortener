/*
SQLyog Community v11.24 (32 bit)
MySQL - 10.0.21-MariaDB-1~jessie : Database - Shorten
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`Shorten` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `Shorten`;

/*Table structure for table `URLs` */

DROP TABLE IF EXISTS `URLs`;

CREATE TABLE `URLs` (
  `iURLID` int(11) NOT NULL AUTO_INCREMENT,
  `mLongURL` blob NOT NULL,
  `cHash` varchar(256) NOT NULL,
  PRIMARY KEY (`iURLID`),
  UNIQUE KEY `cHash` (`cHash`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `URLs` */

insert  into `URLs`(`iURLID`,`mLongURL`,`cHash`) values (1,'http://google.com','aa2239c17609b21eba034c564af878f3eec8ce83ed0f2768597d2bc2fd4e4da5'),(6,'http://bacon.com','5a24eeb5f1b311810dde26b2ee7db3a7d81ac5c195f7745c1b896b29e6f4bb23'),(7,'http://yahoo.com','4e26d9caacefbb1f4750df3430e5db2439259d495830facfef084d7c5d91c5db'),(8,'http://bing.com','cb1d087a1b1ac56d681958660f9923558a8fc9644fa342f832648803ba3b57ed'),(9,'http://reddit.com','73d5c8369c330eb1d13c7db11572f59a4025db57eddc9631774d42e193fe8233'),(10,'http://penny-arcade.com','7de9783a872c3064570cce052ad4327812f0c44cf7a854d88fde9823553cfc9d');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

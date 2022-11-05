/*
SQLyog Community v12.4.3 (64 bit)
MySQL - 5.7.33-0ubuntu0.16.04.1 : Database - mas_report
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`mas_report` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `mas_report`;

/*Table structure for table `tbl_report` */

DROP TABLE IF EXISTS `tbl_report`;

CREATE TABLE `tbl_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_name` varchar(200) DEFAULT NULL,
  `active` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_report` */

insert  into `tbl_report`(`id`,`report_name`,`active`) values 
(1,'cdr report',1),
(2,'cdr report2',1);

/*Table structure for table `tbl_report_field` */

DROP TABLE IF EXISTS `tbl_report_field`;

CREATE TABLE `tbl_report_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_id` int(11) DEFAULT NULL,
  `tbl_id` int(11) DEFAULT NULL,
  `column_name` varchar(200) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_report_field` */

insert  into `tbl_report_field`(`id`,`report_id`,`tbl_id`,`column_name`,`priority`) values 
(35,1,1,'call_date',1),
(36,1,1,'campaign_id',2),
(37,1,1,'end_epoch',3),
(38,1,1,'lead_id',4),
(39,1,1,'start_epoch',5),
(40,1,1,'term_reason',6),
(41,1,1,'uniqueid',7),
(42,1,2,'server_ip',9),
(43,1,2,'uniqueid',10),
(44,1,3,'uniqueid',11),
(45,1,4,'parked_sec',13),
(46,1,4,'parked_time',15),
(47,1,4,'uniqueid',16),
(48,2,1,'call_date',1),
(49,2,1,'length_in_sec',2),
(50,2,1,'start_epoch',3);

/*Table structure for table `tbl_resultant` */

DROP TABLE IF EXISTS `tbl_resultant`;

CREATE TABLE `tbl_resultant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tbl_id` int(11) DEFAULT NULL,
  `column_name` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_resultant` */

insert  into `tbl_resultant`(`id`,`tbl_id`,`column_name`,`created_at`) values 
(144,1,'call_date',NULL),
(145,1,'campaign_id',NULL),
(146,1,'end_epoch',NULL),
(147,1,'lead_id',NULL),
(148,1,'length_in_sec',NULL),
(149,1,'list_id',NULL),
(150,1,'phone_number',NULL),
(151,1,'queue_seconds',NULL),
(152,1,'start_epoch',NULL),
(153,1,'term_reason',NULL),
(154,1,'uniqueid',NULL),
(155,1,'user',NULL),
(156,2,'server_ip',NULL),
(157,2,'uniqueid',NULL),
(158,3,'uniqueid',NULL),
(159,4,'parked_sec',NULL),
(160,4,'parked_time',NULL),
(161,4,'uniqueid',NULL),
(162,5,'full_name',NULL),
(163,5,'user',NULL),
(164,5,'user_id',NULL);

/*Table structure for table `tbl_used` */

DROP TABLE IF EXISTS `tbl_used`;

CREATE TABLE `tbl_used` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tbl_name` varchar(100) DEFAULT NULL,
  `active` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_used` */

insert  into `tbl_used`(`id`,`tbl_name`,`active`) values 
(1,'vicidial_closer_log',1),
(2,'call_log',1),
(3,'vicidial_agent_log',1),
(4,'park_log',1),
(5,'vicidial_users',1);

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `UserType` varchar(100) DEFAULT NULL,
  `active` int(1) DEFAULT '1',
  `createdate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`id`,`user`,`pass`,`UserType`,`active`,`createdate`) values 
(1,'anil','123','admin',1,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

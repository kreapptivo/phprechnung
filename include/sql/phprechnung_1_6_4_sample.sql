-- MySQL dump 10.11
--

--
-- Table structure for table `addressbook`
--

DROP TABLE IF EXISTS `addressbook`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `addressbook` (
  `MYID` bigint(21) NOT NULL auto_increment,
  `PRINT_NAME` tinyint(3) unsigned NOT NULL default '1',
  `PREFIX` varchar(30) collate latin1_german2_ci NOT NULL default '',
  `FIRSTNAME` varchar(50) collate latin1_german2_ci NOT NULL default '',
  `LASTNAME` varchar(50) collate latin1_german2_ci NOT NULL default '',
  `TITLE` varchar(50) collate latin1_german2_ci NOT NULL default '',
  `COMPANY` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `DEPARTMENT` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `ADDRESS` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `CITY` varchar(50) collate latin1_german2_ci NOT NULL default '',
  `STATEPROV` varchar(50) collate latin1_german2_ci NOT NULL default '',
  `POSTALCODE` varchar(20) collate latin1_german2_ci NOT NULL default '',
  `COUNTRY` varchar(50) collate latin1_german2_ci NOT NULL default '',
  `POSITION` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `INITIALS` varchar(50) collate latin1_german2_ci NOT NULL default '',
  `SALUTATION` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `PHONEHOME` varchar(40) collate latin1_german2_ci NOT NULL default '',
  `PHONEOFFI` varchar(40) collate latin1_german2_ci NOT NULL default '',
  `PHONEOTHE` varchar(40) collate latin1_german2_ci NOT NULL default '',
  `PHONEWORK` varchar(40) collate latin1_german2_ci NOT NULL default '',
  `MOBILE` varchar(40) collate latin1_german2_ci NOT NULL default '',
  `PAGER` varchar(40) collate latin1_german2_ci NOT NULL default '',
  `FAX` varchar(40) collate latin1_german2_ci NOT NULL default '',
  `EMAIL` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `EMAIL2` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `URL` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `URL2` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `NOTE` mediumtext collate latin1_german2_ci NOT NULL,
  `CHANGELOG` mediumtext collate latin1_german2_ci NOT NULL,
  `ALTFIELD1` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `ALTFIELD2` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `CATEGORY` smallint(5) unsigned NOT NULL default '1',
  `METHODOFPAY` tinyint(3) unsigned NOT NULL default '1',
  `MESSAGE` smallint(5) unsigned NOT NULL default '1',
  `BIRTHDAY` date NOT NULL default '0000-00-00',
  `BANKNAME` varchar(200) collate latin1_german2_ci NOT NULL default '',
  `BANKACCOUNT` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `BANKNUMBER` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `BANKIBAN` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `BANKBIC` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `TAX_FREE` tinyint(3) unsigned NOT NULL default '2',
  `TAXNR` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `BUSINESS_TAXNR` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `USERNAME` blob NOT NULL,
  `PASSWORD` blob NOT NULL,
  `USERLANGUAGE` tinyint(3) unsigned NOT NULL default '2',
  `USER_ACTIVE` tinyint(3) unsigned NOT NULL default '2',
  `CREATEDBY` varchar(100) collate latin1_german2_ci NOT NULL default 'admin',
  `MODIFIEDBY` varchar(100) collate latin1_german2_ci NOT NULL default 'admin',
  `USERGROUP1` tinyint(3) unsigned NOT NULL default '1',
  `USERGROUP2` tinyint(3) unsigned NOT NULL default '2',
  `CREATED` datetime NOT NULL default '0000-00-00 00:00:00',
  `MODIFIED` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`MYID`),
  KEY `LASTNAME` (`LASTNAME`(20)),
  KEY `FIRSTNAME` (`FIRSTNAME`(20)),
  KEY `COMPANY` (`COMPANY`(20))
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `addressbook`
--

LOCK TABLES `addressbook` WRITE;
/*!40000 ALTER TABLE `addressbook` DISABLE KEYS */;
INSERT INTO `addressbook` VALUES (1,1,'Mr.','John','Doe','','Some Company Inc.','','Some street 1','Some City','','12345','Germany','','','Dear','','','','','','','','','','','','','','','',6,2,1,'0000-00-00','','','','','',2,'','','¯sv¥','¯sv¥©ÿæ',2,1,'admin','admin',1,2,'2008-06-01 09:38:21','2008-06-03 07:27:18'),(2,1,'Mrs.','Very','Important','','Important Inc.','','Important Street 1','Important City','','12345','Germany','','','Dear','','','','','','','','','','','','','','','',7,11,1,'0000-00-00','','','','','',2,'','','xvîÀ∫ãˇ±◊','e\'b¨Í]',1,1,'admin','admin',1,2,'2008-06-03 07:34:09','2008-06-03 07:34:09'),(3,2,'Company','','','','Hello World Inc.','','No Street','The New City','','12345','Germany','','','','','','','','','','','','','','','','','','',7,10,1,'0000-00-00','','','','','',2,'','','\Z∂Z‰MÕö»›','\Z∂Z‰MÕö»›',5,2,'admin','admin',1,2,'2008-06-03 07:39:52','2008-06-03 07:39:52');
/*!40000 ALTER TABLE `addressbook` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `article` (
  `POSITIONID` bigint(21) unsigned NOT NULL auto_increment,
  `POS_NAME` varchar(100) collate latin1_german2_ci NOT NULL,
  `POS_DESC` text collate latin1_german2_ci NOT NULL,
  `POSGROUPID` smallint(5) unsigned NOT NULL,
  `POS_GROUP` varchar(150) collate latin1_german2_ci NOT NULL,
  `POS_PRICE` decimal(21,2) NOT NULL default '0.00',
  `POS_TAX` tinyint(3) unsigned NOT NULL,
  `POS_ACTIVE` tinyint(3) unsigned NOT NULL,
  `NOTE` text collate latin1_german2_ci NOT NULL,
  `POS_INVENTORY` int(11) unsigned NOT NULL,
  `POS_INVENTORY_CURRENT` int(11) unsigned NOT NULL,
  `POS_INVENTORY_PURCHASING` int(11) unsigned NOT NULL,
  `CREATEDBY` varchar(100) collate latin1_german2_ci NOT NULL default 'admin',
  `MODIFIEDBY` varchar(100) collate latin1_german2_ci NOT NULL default 'admin',
  `USERGROUP1` tinyint(3) unsigned NOT NULL default '1',
  `USERGROUP2` tinyint(3) unsigned NOT NULL default '2',
  `CREATED` datetime NOT NULL default '0000-00-00 00:00:00',
  `MODIFIED` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`POSITIONID`),
  KEY `POS_NAME` (`POS_NAME`(20)),
  KEY `POS_DESC` (`POS_DESC`(20))
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (1,'Book3','Apache 2.0',1,'Books','39.99',2,1,'Apache Webserver 2.0',0,0,0,'admin','admin',1,2,'2008-06-01 09:38:53','2008-06-03 06:41:27'),(2,'Book2','MySQL 5.0',1,'Books','49.99',2,1,'MySQL 5.0 Book',0,0,0,'admin','admin',1,2,'2008-06-01 09:39:20','2008-06-03 06:40:16'),(3,'Book1','PHP 5.0',1,'Books','39.99',2,1,'PHP 5.0 Book',0,0,0,'admin','admin',1,2,'2008-06-01 09:39:56','2008-06-03 06:39:15'),(4,'Linux','Linux Administration - Hour',2,'Service','60.00',1,1,'Linux Administration - Hour',0,0,0,'admin','admin',1,2,'2008-06-01 09:40:25','2008-06-03 06:42:11'),(5,'Room12','Single room',3,'Hotel','39.00',2,1,'Single room',0,0,0,'admin','admin',1,2,'2008-06-03 06:43:00','2011-01-28 07:25:53'),(6,'Breakfast','Breakfast buffet',3,'Hotel','5.00',1,1,'Breakfast buffet',0,0,0,'admin','admin',1,2,'2008-06-03 06:43:30','2008-06-03 06:43:30'),(7,'Textfield','If you want only a text field in your invoice / offer, please delete the Quantity and Price and you will have plain text.',2,'Service','0.00',4,1,'Textfield',0,0,0,'admin','admin',1,2,'2008-06-03 07:07:36','2008-06-03 07:07:36'),(8,'This is a little bit longer position name','This is a very long position description. This is a very long position description. This is a very long position description. This is a very long position description. This is a very long position description. This is a very long position description. \r\n\r\nThis is a very long position description. This is a very long position description. This is a very long position description. This is a very long position description. This is a very long position description. This is a very long position description. \r\n',2,'Service','0.00',4,1,'This is a little bit longer position name',0,0,0,'admin','admin',1,2,'2008-06-03 07:08:41','2008-06-03 07:08:41'),(9,'Book4','PostgreSQL 8.4',1,'Books','39.99',2,1,'PostgreSQL 8.4 Administration Book',0,0,0,'admin','admin',1,2,'2011-01-28 07:27:19','2011-01-28 07:31:52');
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cashbook`
--

DROP TABLE IF EXISTS `cashbook`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `cashbook` (
  `CASHBOOKID` bigint(21) unsigned NOT NULL auto_increment,
  `MYID` bigint(21) unsigned NOT NULL,
  `INVOICEID` bigint(21) unsigned NOT NULL,
  `PAYMENTID` bigint(21) NOT NULL,
  `DESCRIPTION` varchar(150) collate latin1_german2_ci NOT NULL default '',
  `CASHBOOK_DATE` date NOT NULL default '0000-00-00',
  `TAKINGS` decimal(21,2) NOT NULL default '0.00',
  `EXPENDITURES` decimal(21,2) NOT NULL default '0.00',
  `CASH_IN_HAND` decimal(21,2) NOT NULL default '0.00',
  `CASH_IN_HAND_STARTING_WITH` decimal(21,2) NOT NULL default '0.00',
  `CANCELED` tinyint(1) unsigned NOT NULL,
  `CREATEDBY` varchar(100) collate latin1_german2_ci NOT NULL default 'admin',
  `MODIFIEDBY` varchar(100) collate latin1_german2_ci NOT NULL default 'admin',
  `USERGROUP1` tinyint(3) unsigned NOT NULL default '1',
  `USERGROUP2` tinyint(3) unsigned NOT NULL default '2',
  `CREATED` datetime NOT NULL default '0000-00-00 00:00:00',
  `MODIFIED` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`CASHBOOKID`),
  KEY `MYID` (`MYID`),
  KEY `INVOICEID` (`INVOICEID`),
  KEY `PAYMENTID` (`PAYMENTID`),
  KEY `DESCRIPTION` (`DESCRIPTION`(20))
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `cashbook`
--

LOCK TABLES `cashbook` WRITE;
/*!40000 ALTER TABLE `cashbook` DISABLE KEYS */;
INSERT INTO `cashbook` VALUES (1,0,0,0,'Cash in hand starting with','2008-06-03','0.00','0.00','250.00','250.00',2,'admin','admin',1,2,'2008-06-03 07:51:25','2008-06-03 07:51:25'),(2,2,1,1,'Direct debit - Invoice-No. 1','2008-06-03','29.97','0.00','279.97','0.00',2,'user','user',1,2,'2008-06-03 16:57:14','2008-06-03 16:57:14'),(3,2,1,1,'Direct debit - Invoice-No. 1','2008-06-03','0.00','29.97','250.00','0.00',2,'user','user',1,2,'2008-06-03 16:57:14','2008-06-03 16:57:14'),(4,2,1,2,'Bar - Invoice-No. 1','2008-06-03','150.00','0.00','400.00','0.00',2,'user','user',1,2,'2008-06-03 17:00:55','2008-06-03 17:00:55'),(5,3,2,3,'Bar - Invoice-No. 2','2008-06-03','29.99','0.00','429.99','0.00',1,'user','user',1,2,'2008-06-03 17:01:26','2008-06-03 17:01:26'),(6,0,0,0,'Privat','2008-06-03','500.00','0.00','929.99','0.00',2,'admin','admin',1,2,'2008-06-03 17:06:05','2008-06-03 17:06:05'),(7,0,0,0,'Privat','2008-06-03','100.00','0.00','1029.99','0.00',1,'admin','admin',1,2,'2008-06-03 17:06:33','2008-06-03 17:06:33'),(8,0,0,0,'Benzin','2008-06-03','0.00','98.99','931.00','0.00',1,'admin','admin',1,2,'2008-06-03 17:06:45','2008-06-03 17:06:45'),(9,3,4,4,'Bar - Invoice-No. 4','2011-01-28','7998000.00','0.00','7998900.00','0.00',1,'admin','admin',1,2,'2011-01-28 07:45:28','2011-01-28 07:45:28'),(10,3,5,0,'Bar - Invoice-No. 5','2011-01-28','0.00','50000.00','7948900.00','0.00',2,'admin','admin',1,2,'2011-01-28 07:50:01','2011-01-28 07:50:01'),(11,3,5,0,'Bar - Invoice-No. 5','2011-01-28','0.00','29980.00','7918920.00','0.00',2,'admin','admin',1,2,'2011-01-28 07:56:09','2011-01-28 07:56:09'),(12,3,6,7,'Bar - Invoice-No. 6','2011-01-28','998.00','0.00','7919918.00','0.00',1,'admin','admin',1,2,'2011-01-28 08:37:24','2011-01-28 08:37:24'),(13,3,8,8,'Bar - Invoice-No. 8','2011-01-31','7998000.00','0.00','15916920.00','0.00',2,'admin','admin',1,2,'2011-01-31 19:59:54','2011-01-31 19:59:54');
/*!40000 ALTER TABLE `cashbook` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `category` (
  `CATEGORYID` smallint(5) unsigned NOT NULL auto_increment,
  `DESCRIPTION` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `CREATEDBY` varchar(100) collate latin1_german2_ci NOT NULL default 'admin',
  `MODIFIEDBY` varchar(100) collate latin1_german2_ci NOT NULL default 'admin',
  `USERGROUP1` tinyint(3) unsigned NOT NULL default '1',
  `USERGROUP2` tinyint(3) unsigned NOT NULL default '2',
  `CREATED` datetime NOT NULL default '0000-00-00 00:00:00',
  `MODIFIED` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`CATEGORYID`),
  KEY `DESCRIPTION` (`DESCRIPTION`(20))
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Authority','admin','admin',1,2,'2008-06-01 09:37:27','2008-06-03 06:29:47'),(2,'Guest','admin','admin',1,2,'2008-06-03 06:29:57','2008-06-03 06:29:57'),(3,'Supplier','admin','admin',1,2,'2008-06-03 06:30:05','2008-06-03 06:30:05'),(4,'Privately','admin','admin',1,2,'2008-06-03 06:30:14','2008-06-03 06:30:14'),(5,'Travel service','admin','admin',1,2,'2008-06-03 06:30:22','2008-06-03 06:30:22'),(6,'No category','admin','admin',1,2,'2008-06-03 06:30:32','2008-06-03 06:30:32'),(7,'Contact','admin','admin',1,2,'2008-06-03 06:30:41','2008-06-03 06:30:41');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customerpos`
--

DROP TABLE IF EXISTS `customerpos`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `customerpos` (
  `CUSTOMERPOSID` bigint(21) unsigned NOT NULL auto_increment,
  `MYID` bigint(21) unsigned NOT NULL,
  `POSITIONID` bigint(21) unsigned NOT NULL,
  `POS_DESC` text collate latin1_german2_ci NOT NULL,
  `POS_QUANTITY` decimal(21,2) NOT NULL default '0.00',
  `POS_PRICE` decimal(21,2) NOT NULL default '0.00',
  `POS_GROUP` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `TAX` tinyint(3) unsigned NOT NULL,
  `TAX_DESC` varchar(50) collate latin1_german2_ci NOT NULL default '',
  `TAX_MULTI` decimal(6,5) NOT NULL default '0.00000',
  `TAX_DIVIDE` decimal(6,5) NOT NULL default '0.00000',
  PRIMARY KEY  (`CUSTOMERPOSID`),
  KEY `MYID` (`MYID`),
  KEY `POSITIONID` (`POSITIONID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `customerpos`
--

LOCK TABLES `customerpos` WRITE;
/*!40000 ALTER TABLE `customerpos` DISABLE KEYS */;
/*!40000 ALTER TABLE `customerpos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `invoice` (
  `INVOICEID` bigint(21) unsigned NOT NULL auto_increment,
  `MYID` bigint(21) unsigned NOT NULL,
  `INVOICE_DATE` date NOT NULL default '0000-00-00',
  `MESSAGEID` smallint(5) unsigned NOT NULL,
  `MESSAGE_DESC` text collate latin1_german2_ci NOT NULL,
  `METHODOFPAYID` tinyint(3) unsigned NOT NULL,
  `METHOD_OF_PAY` varchar(150) collate latin1_german2_ci NOT NULL default '',
  `METHOD_OF_PAY_DATE` date NOT NULL default '0000-00-00',
  `TAX1_TOTAL` decimal(21,2) NOT NULL default '0.00',
  `TAX2_TOTAL` decimal(21,2) NOT NULL default '0.00',
  `TAX3_TOTAL` decimal(21,2) NOT NULL default '0.00',
  `TAX4_TOTAL` decimal(21,2) NOT NULL default '0.00',
  `TAX1_DESC` varchar(50) collate latin1_german2_ci NOT NULL default '',
  `TAX2_DESC` varchar(50) collate latin1_german2_ci NOT NULL default '',
  `TAX3_DESC` varchar(50) collate latin1_german2_ci NOT NULL default '',
  `TAX4_DESC` varchar(50) collate latin1_german2_ci NOT NULL default '',
  `SUBTOTAL1` decimal(21,2) NOT NULL default '0.00',
  `SUBTOTAL2` decimal(21,2) NOT NULL default '0.00',
  `SUBTOTAL3` decimal(21,2) NOT NULL default '0.00',
  `SUBTOTAL4` decimal(21,2) NOT NULL default '0.00',
  `TOTAL_AMOUNT` decimal(21,2) NOT NULL default '0.00',
  `NOTE` text collate latin1_german2_ci NOT NULL,
  `PAID` tinyint(3) unsigned NOT NULL,
  `SUM_PAID` decimal(21,2) NOT NULL default '0.00',
  `DELIVERY_NOTE_PRINTED` tinyint(3) unsigned NOT NULL,
  `DELIVERY_NOTE_MAILED` tinyint(3) unsigned NOT NULL,
  `INVOICE_PRINTED` tinyint(3) unsigned NOT NULL,
  `INVOICE_MAILED` tinyint(3) unsigned NOT NULL,
  `CANCELED` tinyint(3) unsigned NOT NULL,
  `CREATEDBY` varchar(100) collate latin1_german2_ci NOT NULL default 'admin',
  `MODIFIEDBY` varchar(100) collate latin1_german2_ci NOT NULL default 'admin',
  `USERGROUP1` tinyint(3) unsigned NOT NULL default '1',
  `USERGROUP2` tinyint(3) unsigned NOT NULL default '2',
  `CREATED` datetime NOT NULL default '0000-00-00 00:00:00',
  `MODIFIED` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`INVOICEID`),
  KEY `MYID` (`MYID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `invoice`
--

LOCK TABLES `invoice` WRITE;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
INSERT INTO `invoice` VALUES (1,2,'2008-06-03',1,'Thank you for your order.',10,'Direct debit','0000-00-00','7.18','8.50','0.00','0.00','19.00 %','07.00 %','','Tax Free','37.82','121.47','0.00','5.00','179.97','Very',1,'179.97',2,2,2,2,2,'user','user',1,2,'2008-06-03 15:42:09','2008-06-03 17:00:55'),(2,3,'2011-01-27',1,'Thank you for your order.',10,'Direct debit','0000-00-00','9.58','2.62','0.00','0.00','19.00 %','07.00 %','','Tax Free','50.42','37.37','0.00','1.00','100.99','Note',2,'0.00',2,2,2,2,2,'user','admin',1,2,'2008-06-03 15:48:41','2011-01-31 19:56:39'),(3,1,'2011-01-27',1,'Thank you for your order.',2,'Bar','0000-00-00','10.38','5.17','0.00','0.00','19.00 %','07.00 %','','','54.62','73.82','0.00','0.00','143.99','',2,'0.00',2,2,2,2,2,'user','admin',1,2,'2008-06-03 16:43:14','2011-01-31 19:56:42'),(4,3,'2011-01-28',1,'Thank you for your order.',2,'Bar','0000-00-00','0.00','523233.64','0.00','0.00','','07.00 %','','','0.00','7474766.36','0.00','0.00','7998000.00','',2,'0.00',2,2,2,2,2,'admin','admin',1,2,'2011-01-28 07:44:19','2011-01-31 20:00:08'),(5,3,'2011-01-28',1,'Thank you for your order.',2,'Bar','0000-00-00','0.00','-5232.34','0.00','0.00','','07.00 %','','','0.00','-74747.66','0.00','0.00','-79980.00','',2,'0.00',0,0,0,0,2,'admin','admin',1,2,'2011-01-28 07:45:56','2011-01-31 19:56:46'),(6,3,'2011-01-28',1,'Thank you for your order.',2,'Bar','0000-00-00','0.00','523.23','0.00','0.00','','07.00 %','','','0.00','7474.77','0.00','0.00','7998.00','',2,'0.00',0,0,0,0,2,'admin','admin',1,2,'2011-01-28 07:58:14','2011-01-31 19:56:50'),(7,2,'2011-01-31',1,'Thank you for your order.',11,'Payable cash upon receipt','0000-00-00','9.58','2.62','0.00','0.00','19.00 %','07.00 %','','','50.42','37.37','0.00','0.00','99.99','',2,'0.00',2,2,2,2,2,'admin','admin',1,2,'2011-01-31 17:25:42','2011-01-31 19:56:53'),(8,3,'2011-01-31',1,'Thank you for your order.',2,'Bar','0000-00-00','0.00','523233.64','0.00','0.00','','07.00 %','','','0.00','7474766.36','0.00','0.00','7998000.00','',1,'7998000.00',0,0,0,0,2,'admin','admin',1,2,'2011-01-31 19:58:59','2011-01-31 19:59:54'),(9,1,'2011-01-31',1,'Thank you for your order.',2,'Bar','0000-00-00','0.00','2.34','0.00','0.00','','07.00 %','','','0.00','33.36','0.00','0.00','35.70','',2,'0.00',2,2,2,2,2,'admin','admin',1,2,'2011-01-31 20:30:00','2011-01-31 20:30:00');
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoicepos`
--

DROP TABLE IF EXISTS `invoicepos`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `invoicepos` (
  `INVOICEPOSID` bigint(21) unsigned NOT NULL auto_increment,
  `MYID` bigint(21) unsigned NOT NULL,
  `INVOICEID` bigint(21) unsigned NOT NULL,
  `POSITIONID` bigint(21) unsigned NOT NULL,
  `POS_DESC` text collate latin1_german2_ci NOT NULL,
  `POS_QUANTITY` decimal(21,2) NOT NULL default '0.00',
  `POS_PRICE` decimal(21,2) NOT NULL default '0.00',
  `POS_GROUP` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `TAX` tinyint(3) unsigned NOT NULL,
  `TAX_DESC` varchar(50) collate latin1_german2_ci NOT NULL default '',
  `TAX_MULTI` decimal(6,5) NOT NULL default '0.00000',
  `TAX_DIVIDE` decimal(6,5) NOT NULL default '0.00000',
  PRIMARY KEY  (`INVOICEPOSID`),
  KEY `MYID` (`MYID`),
  KEY `INVOICEID` (`INVOICEID`),
  KEY `POSITIONID` (`POSITIONID`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `invoicepos`
--

LOCK TABLES `invoicepos` WRITE;
/*!40000 ALTER TABLE `invoicepos` DISABLE KEYS */;
INSERT INTO `invoicepos` VALUES (1,2,1,3,'PHP 5.0','1.00','39.99','Books',2,'07.00 %','0.07000','1.07000'),(2,2,1,2,'MySQL 5.0','1.00','49.99','Books',2,'07.00 %','0.07000','1.07000'),(3,2,1,1,'Apache 2.0','1.00','39.99','Books',2,'07.00 %','0.07000','1.07000'),(4,2,1,5,'Single room','1.00','40.00','Hotel',1,'19.00 %','0.19000','1.19000'),(5,2,1,6,'Breakfast buffet','1.00','5.00','Hotel',1,'19.00 %','0.19000','1.19000'),(6,2,1,8,'This is a very long position description. This is a very long position description. This is a very long position description. This is a very long position description. This is a very long position description. This is a very long position description. \r\n\r\nThis is a very long position description. This is a very long position description. This is a very long position description. This is a very long position description. This is a very long position description. This is a very long position description. \r\n','1.00','5.00','Service',4,'Tax Free','0.00000','0.00000'),(51,3,2,4,'Linux Administration - Hour','1.00','60.00','Service',1,'19.00 %','0.19000','1.19000'),(52,3,2,8,'This is a very long position description. This is a very long position description. This is a very long position description. This is a very long position description. This is a very long position description. This is a very long position description. \r\n\r\nThis is a very long position description. This is a very long position description. This is a very long position description. This is a very long position description. This is a very long position description. This is a very long position description. \r\n','1.00','1.00','Service',4,'Tax Free','0.00000','0.00000'),(50,3,2,1,'Apache 2.0','1.00','39.99','Books',2,'07.00 %','0.07000','1.07000'),(56,1,3,4,'Linux Administration - Hour','1.00','60.00','Service',1,'19.00 %','0.19000','1.19000'),(55,1,3,6,'Breakfast buffet','1.00','5.00','Hotel',1,'19.00 %','0.19000','1.19000'),(54,1,3,5,'Single room','1.00','39.00','Hotel',2,'07.00 %','0.07000','1.07000'),(53,1,3,1,'Apache 2.0','1.00','39.99','Books',2,'07.00 %','0.07000','1.07000'),(68,3,4,9,'PostgreSQL 8.4','100000.00','39.99','Books',2,'07.00 %','0.07000','1.07000'),(67,3,4,3,'PHP 5.0','100000.00','39.99','Books',2,'07.00 %','0.07000','1.07000'),(58,3,5,9,'PostgreSQL 8.4','1000.00','-39.99','Books',2,'07.00 %','0.07000','1.07000'),(57,3,5,3,'PHP 5.0','1000.00','-39.99','Books',2,'07.00 %','0.07000','1.07000'),(60,3,6,9,'PostgreSQL 8.4','100.00','39.99','Books',2,'07.00 %','0.07000','1.07000'),(59,3,6,3,'PHP 5.0','100.00','39.99','Books',2,'07.00 %','0.07000','1.07000'),(62,2,7,4,'Linux Administration - Hour','1.00','60.00','Service',1,'19.00 %','0.19000','1.19000'),(61,2,7,1,'Apache 2.0','1.00','39.99','Books',2,'07.00 %','0.07000','1.07000'),(66,3,8,9,'PostgreSQL 8.4','100000.00','39.99','Books',2,'07.00 %','0.07000','1.07000'),(65,3,8,3,'PHP 5.0','100000.00','39.99','Books',2,'07.00 %','0.07000','1.07000'),(69,1,9,3,'PHP 5.0','1.00','35.70','Books',2,'07.00 %','0.07000','1.07000');
/*!40000 ALTER TABLE `invoicepos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `message` (
  `MESSAGEID` smallint(5) unsigned NOT NULL auto_increment,
  `DESCRIPTION` text collate latin1_german2_ci NOT NULL,
  `CREATEDBY` varchar(100) collate latin1_german2_ci NOT NULL default 'admin',
  `MODIFIEDBY` varchar(100) collate latin1_german2_ci NOT NULL default 'admin',
  `USERGROUP1` tinyint(3) unsigned NOT NULL default '1',
  `USERGROUP2` tinyint(3) unsigned NOT NULL default '2',
  `CREATED` datetime NOT NULL default '0000-00-00 00:00:00',
  `MODIFIED` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`MESSAGEID`),
  KEY `DESCRIPTION` (`DESCRIPTION`(20))
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (1,'Thank you for your order.','admin','admin',1,2,'2008-06-01 09:36:59','2008-06-03 06:24:00');
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `methodofpay`
--

DROP TABLE IF EXISTS `methodofpay`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `methodofpay` (
  `METHODOFPAYID` tinyint(3) unsigned NOT NULL auto_increment,
  `DESCRIPTION` varchar(150) collate latin1_german2_ci NOT NULL default '',
  `CREATEDBY` varchar(100) collate latin1_german2_ci NOT NULL default 'admin',
  `MODIFIEDBY` varchar(100) collate latin1_german2_ci NOT NULL default 'admin',
  `USERGROUP1` tinyint(3) unsigned NOT NULL default '1',
  `USERGROUP2` tinyint(3) unsigned NOT NULL default '2',
  `CREATED` datetime NOT NULL default '0000-00-00 00:00:00',
  `MODIFIED` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`METHODOFPAYID`),
  KEY `DESCRIPTION` (`DESCRIPTION`(20))
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `methodofpay`
--

LOCK TABLES `methodofpay` WRITE;
/*!40000 ALTER TABLE `methodofpay` DISABLE KEYS */;
INSERT INTO `methodofpay` VALUES (1,'American Express','admin','admin',1,2,'2008-06-01 09:37:13','2008-06-01 09:37:13'),(2,'Bar','admin','admin',1,2,'2008-06-01 09:37:15','2008-06-01 09:37:15'),(3,'Diners Club Int.','admin','admin',1,2,'2008-06-03 06:24:47','2008-06-03 06:24:47'),(4,'EC - Card','admin','admin',1,2,'2008-06-03 06:24:59','2008-06-03 06:24:59'),(5,'MasterCard','admin','admin',1,2,'2008-06-03 06:25:13','2008-06-03 06:25:13'),(6,'Maestro','admin','admin',1,2,'2008-06-03 06:25:23','2008-06-03 06:25:23'),(7,'Scheck','admin','admin',1,2,'2008-06-03 06:25:35','2008-06-03 06:25:35'),(8,'Bank transfer','admin','admin',1,2,'2008-06-03 06:25:51','2008-06-03 06:25:51'),(9,'VISA','admin','admin',1,2,'2008-06-03 06:25:58','2008-06-03 06:25:58'),(10,'Direct debit','admin','admin',1,2,'2008-06-03 06:28:40','2008-06-03 06:28:40'),(11,'Payable cash upon receipt','admin','admin',1,2,'2008-06-03 06:28:56','2008-06-03 06:28:56'),(12,'Immediate payment required without discount','admin','admin',1,2,'2008-06-03 06:29:09','2008-06-03 06:29:09');
/*!40000 ALTER TABLE `methodofpay` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offer`
--

DROP TABLE IF EXISTS `offer`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `offer` (
  `OFFERID` bigint(21) unsigned NOT NULL auto_increment,
  `MYID` bigint(21) unsigned NOT NULL,
  `INVOICEID` bigint(21) unsigned NOT NULL,
  `OFFER_DATE` date NOT NULL default '0000-00-00',
  `MESSAGEID` smallint(5) unsigned NOT NULL,
  `MESSAGE_DESC` text collate latin1_german2_ci NOT NULL,
  `METHODOFPAYID` tinyint(3) unsigned NOT NULL,
  `METHOD_OF_PAY` varchar(150) collate latin1_german2_ci NOT NULL default '',
  `METHOD_OF_PAY_DATE` date NOT NULL default '0000-00-00',
  `STATUS` tinyint(3) NOT NULL default '1',
  `TAX1_TOTAL` decimal(21,2) NOT NULL default '0.00',
  `TAX2_TOTAL` decimal(21,2) NOT NULL default '0.00',
  `TAX3_TOTAL` decimal(21,2) NOT NULL default '0.00',
  `TAX4_TOTAL` decimal(21,2) NOT NULL default '0.00',
  `TAX1_DESC` varchar(50) collate latin1_german2_ci NOT NULL default '',
  `TAX2_DESC` varchar(50) collate latin1_german2_ci NOT NULL default '',
  `TAX3_DESC` varchar(50) collate latin1_german2_ci NOT NULL default '',
  `TAX4_DESC` varchar(50) collate latin1_german2_ci NOT NULL default '',
  `SUBTOTAL1` decimal(21,2) NOT NULL default '0.00',
  `SUBTOTAL2` decimal(21,2) NOT NULL default '0.00',
  `SUBTOTAL3` decimal(21,2) NOT NULL default '0.00',
  `SUBTOTAL4` decimal(21,2) NOT NULL default '0.00',
  `TOTAL_AMOUNT` decimal(21,2) NOT NULL default '0.00',
  `NOTE` text collate latin1_german2_ci NOT NULL,
  `ORDER_PRINTED` tinyint(3) unsigned NOT NULL,
  `ORDER_MAILED` tinyint(3) unsigned NOT NULL,
  `OFFER_PRINTED` tinyint(3) unsigned NOT NULL,
  `OFFER_MAILED` tinyint(3) unsigned NOT NULL,
  `CANCELED` tinyint(3) unsigned NOT NULL,
  `CREATEDBY` varchar(100) collate latin1_german2_ci NOT NULL default 'admin',
  `MODIFIEDBY` varchar(100) collate latin1_german2_ci NOT NULL default 'admin',
  `USERGROUP1` tinyint(3) unsigned NOT NULL default '1',
  `USERGROUP2` tinyint(3) unsigned NOT NULL default '2',
  `CREATED` datetime NOT NULL default '0000-00-00 00:00:00',
  `MODIFIED` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`OFFERID`),
  KEY `MYID` (`MYID`),
  KEY `INVOICEID` (`INVOICEID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `offer`
--

LOCK TABLES `offer` WRITE;
/*!40000 ALTER TABLE `offer` DISABLE KEYS */;
INSERT INTO `offer` VALUES (1,3,0,'2011-01-27',1,'Thank you for your order.',10,'Direct debit','0000-00-00',1,'10.38','2.62','0.00','0.00','19.00 %','07.00 %','','Tax Free','54.62','37.37','0.00','0.00','104.99','Hello',2,2,2,2,2,'user','admin',1,2,'2008-06-03 15:36:28','2011-01-31 19:55:22'),(2,1,3,'2008-06-03',1,'Thank you for your order.',2,'Bar','0000-00-00',3,'15.97','2.62','0.00','0.00','19.00 %','07.00 %','','','84.03','37.37','0.00','0.00','139.99','',2,2,2,2,2,'user','user',1,2,'2008-06-03 16:39:22','2008-06-03 16:43:14'),(3,2,0,'2011-01-27',1,'Thank you for your order.',11,'Payable cash upon receipt','0000-00-00',1,'0.00','11.12','0.00','0.00','','07.00 %','','','0.00','158.84','0.00','0.00','169.96','',2,2,2,2,2,'user','admin',1,2,'2008-06-03 16:40:17','2011-01-31 19:55:45'),(4,3,0,'2011-01-27',1,'Thank you for your order.',10,'Direct debit','0000-00-00',1,'47.90','0.00','0.00','0.00','19.00 %','','','','252.10','0.00','0.00','0.00','300.00','',2,2,2,2,2,'user','admin',1,2,'2008-06-03 16:40:52','2011-01-31 19:55:55');
/*!40000 ALTER TABLE `offer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offerpos`
--

DROP TABLE IF EXISTS `offerpos`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `offerpos` (
  `OFFERPOSID` bigint(21) unsigned NOT NULL auto_increment,
  `OFFERID` bigint(21) unsigned NOT NULL,
  `MYID` bigint(21) unsigned NOT NULL,
  `POSITIONID` bigint(21) unsigned NOT NULL,
  `POS_DESC` text collate latin1_german2_ci NOT NULL,
  `POS_QUANTITY` decimal(21,2) NOT NULL default '0.00',
  `POS_PRICE` decimal(21,2) NOT NULL default '0.00',
  `POS_GROUP` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `TAX` tinyint(3) unsigned NOT NULL,
  `TAX_DESC` varchar(50) collate latin1_german2_ci NOT NULL default '',
  `TAX_MULTI` decimal(6,5) NOT NULL default '0.00000',
  `TAX_DIVIDE` decimal(6,5) NOT NULL default '0.00000',
  PRIMARY KEY  (`OFFERPOSID`),
  KEY `OFFERID` (`OFFERID`),
  KEY `MYID` (`MYID`),
  KEY `POSITIONID` (`POSITIONID`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `offerpos`
--

LOCK TABLES `offerpos` WRITE;
/*!40000 ALTER TABLE `offerpos` DISABLE KEYS */;
INSERT INTO `offerpos` VALUES (23,1,3,3,'PHP 5.0','1.00','39.99','Books',2,'07.00 %','0.07000','1.07000'),(24,1,3,6,'Breakfast buffet','1.00','5.00','Hotel',1,'19.00 %','0.19000','1.19000'),(25,1,3,4,'Linux Administration - Hour','1.00','60.00','Service',1,'19.00 %','0.19000','1.19000'),(26,1,3,7,'If you want only a text field in your invoice / offer, please delete the Quantity and Price and you will have plain text.','0.00','0.00','Service',4,'Tax Free','0.00000','0.00000'),(27,1,3,8,'This is a very long position description. This is a very long position description. This is a very long position description. This is a very long position description. This is a very long position description. This is a very long position description. \r\n\r\nThis is a very long position description. This is a very long position description. This is a very long position description. This is a very long position description. This is a very long position description. This is a very long position description. \r\n','1.00','0.00','Service',4,'Tax Free','0.00000','0.00000'),(6,2,1,1,'Apache 2.0','1.00','39.99','Books',2,'07.00 %','0.07000','1.07000'),(7,2,1,5,'Single room','1.00','40.00','Hotel',1,'19.00 %','0.19000','1.19000'),(8,2,1,4,'Linux Administration - Hour','1.00','60.00','Service',1,'19.00 %','0.19000','1.19000'),(31,3,2,9,'PostgreSQL 8.4','1.00','39.99','Books',2,'07.00 %','0.07000','1.07000'),(30,3,2,1,'Apache 2.0','1.00','39.99','Books',2,'07.00 %','0.07000','1.07000'),(29,3,2,2,'MySQL 5.0','1.00','49.99','Books',2,'07.00 %','0.07000','1.07000'),(32,4,3,4,'Linux Administration - Hour','5.00','60.00','Service',1,'19.00 %','0.19000','1.19000'),(28,3,2,3,'PHP 5.0','1.00','39.99','Books',2,'07.00 %','0.07000','1.07000');
/*!40000 ALTER TABLE `offerpos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `payment` (
  `PAYMENTID` bigint(21) unsigned NOT NULL auto_increment,
  `MYID` bigint(21) unsigned NOT NULL,
  `INVOICEID` bigint(21) unsigned NOT NULL,
  `PAYMENT_DATE` date NOT NULL default '0000-00-00',
  `METHODOFPAYID` tinyint(3) unsigned NOT NULL,
  `METHOD_OF_PAY` varchar(150) collate latin1_german2_ci NOT NULL default '',
  `CARDNR` blob NOT NULL,
  `VALIDTHRU` blob NOT NULL,
  `SUM_PAID` decimal(21,2) NOT NULL default '0.00',
  `NOTE` text collate latin1_german2_ci NOT NULL,
  `CANCELED` tinyint(3) unsigned NOT NULL,
  `CREATEDBY` varchar(100) collate latin1_german2_ci NOT NULL default 'admin',
  `MODIFIEDBY` varchar(100) collate latin1_german2_ci NOT NULL default 'admin',
  `USERGROUP1` tinyint(3) unsigned NOT NULL default '1',
  `USERGROUP2` tinyint(3) unsigned NOT NULL default '2',
  `CREATED` datetime NOT NULL default '0000-00-00 00:00:00',
  `MODIFIED` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`PAYMENTID`),
  KEY `MYID` (`MYID`),
  KEY `INVOICEID` (`INVOICEID`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (1,2,1,'2008-06-03',10,'Direct debit','12345','03/12','29.97','',2,'user','user',1,2,'2008-06-03 16:57:14','2008-06-03 16:57:14'),(2,2,1,'2008-06-03',2,'Bar','','','150.00','',2,'user','user',1,2,'2008-06-03 17:00:55','2008-06-03 17:00:55'),(3,3,2,'2008-06-03',2,'Bar','','','29.99','',1,'user','user',1,2,'2008-06-03 17:01:26','2008-06-03 17:01:26'),(4,3,4,'2011-01-28',2,'Bar','','','7998000.00','',1,'admin','admin',1,2,'2011-01-28 07:45:28','2011-01-28 07:45:28'),(5,3,5,'2011-01-28',2,'Bar','','','-50000.00','',1,'admin','admin',1,2,'2011-01-28 07:50:01','2011-01-28 07:50:01'),(6,3,5,'2011-01-28',2,'Bar','','','-29980.00','',1,'admin','admin',1,2,'2011-01-28 07:56:09','2011-01-28 07:56:09'),(7,3,6,'2011-01-28',2,'Bar','','','998.00','',1,'admin','admin',1,2,'2011-01-28 08:37:24','2011-01-28 08:37:24'),(8,3,8,'2011-01-31',2,'Bar','','','7998000.00','',2,'admin','admin',1,2,'2011-01-31 19:59:54','2011-01-31 19:59:54');
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posgroup`
--

DROP TABLE IF EXISTS `posgroup`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `posgroup` (
  `POSGROUPID` smallint(5) unsigned NOT NULL auto_increment,
  `DESCRIPTION` varchar(150) collate latin1_german2_ci NOT NULL default '',
  `CREATEDBY` varchar(100) collate latin1_german2_ci NOT NULL default 'admin',
  `MODIFIEDBY` varchar(100) collate latin1_german2_ci NOT NULL default 'admin',
  `USERGROUP1` tinyint(3) unsigned NOT NULL default '1',
  `USERGROUP2` tinyint(3) unsigned NOT NULL default '2',
  `CREATED` datetime NOT NULL default '0000-00-00 00:00:00',
  `MODIFIED` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`POSGROUPID`),
  KEY `DESCRIPTION` (`DESCRIPTION`(20))
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `posgroup`
--

LOCK TABLES `posgroup` WRITE;
/*!40000 ALTER TABLE `posgroup` DISABLE KEYS */;
INSERT INTO `posgroup` VALUES (1,'Books','admin','admin',1,2,'2008-03-30 10:47:00','2008-06-03 06:33:33'),(2,'Service','admin','admin',1,2,'2008-03-30 10:47:05','2008-06-03 06:33:41'),(3,'Hotel','admin','admin',1,2,'2008-06-03 06:37:59','2008-06-03 06:37:59'),(4,'Restaurant','admin','admin',1,2,'2008-06-03 06:38:05','2008-06-03 06:38:05');
/*!40000 ALTER TABLE `posgroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `setting` (
  `SETTINGID` smallint(5) unsigned NOT NULL auto_increment,
  `COMPANY_DATE` date NOT NULL default '0000-00-00',
  `PRINT_COMPANY_DATA` tinyint(3) unsigned NOT NULL default '1',
  `PRINT_POSITION_NAME` tinyint(3) unsigned NOT NULL default '1',
  `TAX_FREE` tinyint(3) unsigned NOT NULL default '2',
  `COMPANY_NAME` varchar(150) collate latin1_german2_ci NOT NULL default '',
  `COMPANY_ADDRESS` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `COMPANY_POSTAL` varchar(50) collate latin1_german2_ci NOT NULL default '',
  `COMPANY_CITY` varchar(50) collate latin1_german2_ci NOT NULL default '',
  `COMPANY_COUNTRY` varchar(50) collate latin1_german2_ci NOT NULL default '',
  `COMPANY_PHONE` varchar(50) collate latin1_german2_ci NOT NULL default '',
  `COMPANY_FAX` varchar(50) collate latin1_german2_ci NOT NULL default '',
  `COMPANY_EMAIL` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `COMPANY_URL` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `COMPANY_WAP` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `COMPANY_CURRENCY` varchar(10) collate latin1_german2_ci NOT NULL default 'EUR',
  `COMPANY_SALESPRICE` tinyint(3) unsigned NOT NULL default '2',
  `COMPANY_TAXNR` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `COMPANY_BUSINESS_TAXNR` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `COMPANY_BANKNAME` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `COMPANY_BANKACCOUNT` varchar(50) collate latin1_german2_ci NOT NULL default '',
  `COMPANY_BANKNUMBER` varchar(50) collate latin1_german2_ci NOT NULL default '',
  `COMPANY_BANKIBAN` varchar(50) collate latin1_german2_ci NOT NULL default '',
  `COMPANY_BANKBIC` varchar(50) collate latin1_german2_ci NOT NULL default '',
  `EMAIL_INTERNAL` tinyint(3) unsigned NOT NULL default '1',
  `EMAIL_USE_SIGNATURE` tinyint(3) unsigned NOT NULL default '1',
  `EMAIL_SIGNATURE` text collate latin1_german2_ci NOT NULL,
  `INVENTORY_CHECK_ACTIVE` tinyint(3) unsigned NOT NULL default '2',
  `REMINDER` tinyint(3) unsigned NOT NULL default '1',
  `REMINDER_DAYS` tinyint(3) unsigned NOT NULL default '10',
  `REMINDER_PRICE` decimal(11,2) NOT NULL default '2.50',
  `ENTRYS_PER_PAGE` smallint(5) unsigned NOT NULL default '50',
  `SESSION_SEC` smallint(5) unsigned NOT NULL default '600',
  `COMPANY_LOGO` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `COMPANY_LOGO_WIDTH` varchar(10) collate latin1_german2_ci NOT NULL default '',
  `COMPANY_LOGO_HEIGHT` varchar(10) collate latin1_german2_ci NOT NULL default '',
  `PDF_COMPANY_LOGO_HEIGHT` tinyint(3) unsigned NOT NULL default '15',
  `PDF_COMPANY_LOGO_WIDTH` tinyint(3) unsigned NOT NULL default '50',
  `PDF_FONT` varchar(30) collate latin1_german2_ci NOT NULL default 'Arial',
  `PDF_DIR` varchar(254) collate latin1_german2_ci NOT NULL default '/tmp/',
  `PDF_FONT_SIZE1` tinyint(3) unsigned NOT NULL default '9',
  `PDF_FONT_SIZE2` tinyint(3) unsigned NOT NULL default '10',
  `PDF_TYPE_HEIGHT` tinyint(3) unsigned NOT NULL default '22',
  `PDF_ATTACHMENT_TEXT` text collate latin1_german2_ci NOT NULL,
  `CREATEDBY` varchar(100) collate latin1_german2_ci NOT NULL default 'admin',
  `MODIFIEDBY` varchar(100) collate latin1_german2_ci NOT NULL default 'admin',
  `USERGROUP1` tinyint(3) unsigned NOT NULL default '1',
  `USERGROUP2` tinyint(3) unsigned NOT NULL default '2',
  PRIMARY KEY  (`SETTINGID`),
  UNIQUE KEY `COMPANY_NAME` (`COMPANY_NAME`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `setting`
--

LOCK TABLES `setting` WRITE;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` VALUES (1,'2007-12-01',1,1,2,'Sample Company Inc.','Sample Street 1','12345','Sample City','Germany','+49 (0) 1234 / 1234-0','+49 (0) 1234 / 1234-10','info@sample-company-inc.de','http://www.sample-company-inc.de','','EUR',2,'10/101/10101','DE 1234567890','Sample Bank','123 456 789 0','123 456 78','DE01 1234 5678 9000 0000 00','ABCDEFGHIJ1',1,1,'Sincerely\r\n\r\nYours, The Sample Company\r\n',1,1,10,'2.50',25,600,'logo.png','180','40',15,50,'Arial','/tmp/',9,9,22,'Please find enclosed your {TYPE} {NUMBER} of {DATE} in PDF format.\r\n\r\nIn order to view the {TYPE}, please click\r\nthe attachment and it should automatically\r\nopen the default PDF viewer. If you do not have PDF viewer\r\ninstalled, you will find the link for free download.\r\n\r\nhttp://get.adobe.com/de/reader/\r\n\r\nor\r\n\r\nhttp://www.foxitsoftware.com/downloads/\r\n\r\nYou can print your {TYPE} for your records.\r\n\r\nSincerely\r\n\r\nYours, The Sample Company\r\n','admin','admin',1,2);
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `syslog`
--

DROP TABLE IF EXISTS `syslog`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `syslog` (
  `SYSLOGID` bigint(21) unsigned NOT NULL auto_increment,
  `CREATED` datetime NOT NULL default '0000-00-00 00:00:00',
  `DESCRIPTION` text collate latin1_german2_ci NOT NULL,
  `CREATEDBY` varchar(100) collate latin1_german2_ci NOT NULL default 'admin',
  `USERGROUP1` tinyint(3) unsigned NOT NULL default '1',
  `USERGROUP2` tinyint(3) unsigned NOT NULL default '2',
  PRIMARY KEY  (`SYSLOGID`),
  KEY `DESCRIPTION` (`DESCRIPTION`(20))
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `syslog`
--

LOCK TABLES `syslog` WRITE;
/*!40000 ALTER TABLE `syslog` DISABLE KEYS */;
/*!40000 ALTER TABLE `syslog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tax`
--

DROP TABLE IF EXISTS `tax`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `tax` (
  `TAXID` tinyint(3) unsigned NOT NULL auto_increment,
  `TAX_DIVIDE` decimal(6,5) NOT NULL default '0.00000',
  `TAX_MULTI` decimal(6,5) NOT NULL default '0.00000',
  `TAX_DESC` varchar(50) collate latin1_german2_ci NOT NULL,
  `CREATEDBY` varchar(100) collate latin1_german2_ci NOT NULL default 'admin',
  `MODIFIEDBY` varchar(100) collate latin1_german2_ci NOT NULL default 'admin',
  `USERGROUP1` tinyint(3) unsigned NOT NULL default '1',
  `USERGROUP2` tinyint(3) unsigned NOT NULL default '2',
  `CREATED` datetime NOT NULL default '0000-00-00 00:00:00',
  `MODIFIED` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`TAXID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `tax`
--

LOCK TABLES `tax` WRITE;
/*!40000 ALTER TABLE `tax` DISABLE KEYS */;
INSERT INTO `tax` VALUES (1,'1.19000','0.19000','19.00 %','admin','admin',1,2,'2008-01-01 10:10:00','2008-01-01 10:10:00'),(2,'1.07000','0.07000','07.00 %','admin','admin',1,2,'2008-01-01 10:10:00','2008-01-01 10:10:00'),(3,'1.10700','0.10700','10.70 %','admin','admin',1,2,'2008-01-01 10:10:00','2008-01-01 10:10:00'),(4,'0.00000','0.00000','Tax Free','admin','admin',1,2,'2008-01-01 10:10:00','2008-01-01 10:10:00');
/*!40000 ALTER TABLE `tax` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tmp_invoice`
--

DROP TABLE IF EXISTS `tmp_invoice`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `tmp_invoice` (
  `TMP_INVOICEID` bigint(21) unsigned NOT NULL auto_increment,
  `MYID` bigint(21) unsigned NOT NULL,
  `INVOICEID` bigint(21) unsigned NOT NULL,
  `POSITIONID` bigint(21) unsigned NOT NULL,
  `USERNAME` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `POS_DESC` text collate latin1_german2_ci NOT NULL,
  `POS_QUANTITY` decimal(21,2) NOT NULL default '0.00',
  `POS_PRICE` decimal(21,2) NOT NULL default '0.00',
  `POS_GROUP` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `TAX` tinyint(3) unsigned NOT NULL,
  `TAX_MULTI` decimal(6,5) NOT NULL default '0.00000',
  `TAX_DIVIDE` decimal(6,5) NOT NULL default '0.00000',
  `TAX_DESC` varchar(50) collate latin1_german2_ci NOT NULL default '',
  PRIMARY KEY  (`TMP_INVOICEID`),
  KEY `MYID` (`MYID`),
  KEY `INVOICEID` (`INVOICEID`),
  KEY `POSITIONID` (`POSITIONID`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `tmp_invoice`
--

LOCK TABLES `tmp_invoice` WRITE;
/*!40000 ALTER TABLE `tmp_invoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `tmp_invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tmp_offer`
--

DROP TABLE IF EXISTS `tmp_offer`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `tmp_offer` (
  `TMP_OFFERID` bigint(21) unsigned NOT NULL auto_increment,
  `MYID` bigint(21) unsigned NOT NULL,
  `OFFERID` bigint(21) unsigned NOT NULL,
  `POSITIONID` bigint(21) unsigned NOT NULL,
  `USERNAME` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `POS_DESC` text collate latin1_german2_ci NOT NULL,
  `POS_QUANTITY` decimal(21,2) NOT NULL default '0.00',
  `POS_PRICE` decimal(21,2) NOT NULL default '0.00',
  `POS_GROUP` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `TAX` tinyint(3) unsigned NOT NULL,
  `TAX_MULTI` decimal(6,5) NOT NULL default '0.00000',
  `TAX_DIVIDE` decimal(6,5) NOT NULL default '0.00000',
  `TAX_DESC` varchar(50) collate latin1_german2_ci NOT NULL default '',
  PRIMARY KEY  (`TMP_OFFERID`),
  KEY `MYID` (`MYID`),
  KEY `OFFERID` (`OFFERID`),
  KEY `POSITIONID` (`POSITIONID`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `tmp_offer`
--

LOCK TABLES `tmp_offer` WRITE;
/*!40000 ALTER TABLE `tmp_offer` DISABLE KEYS */;
/*!40000 ALTER TABLE `tmp_offer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `updatetable`
--

DROP TABLE IF EXISTS `updatetable`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `updatetable` (
  `UPDATEID` bigint(21) unsigned NOT NULL auto_increment,
  `CREATED` datetime NOT NULL default '0000-00-00 00:00:00',
  `VERSION` varchar(100) collate latin1_german2_ci NOT NULL default '',
  `LOGINUPDATE` tinyint(3) unsigned NOT NULL default '2',
  `TABLEUPDATE` tinyint(3) unsigned NOT NULL default '2',
  PRIMARY KEY  (`UPDATEID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `updatetable`
--

LOCK TABLES `updatetable` WRITE;
/*!40000 ALTER TABLE `updatetable` DISABLE KEYS */;
INSERT INTO `updatetable` VALUES (1,'2011-01-31 10:10:00','1.6.4',1,1);
/*!40000 ALTER TABLE `updatetable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `user` (
  `USERID` int(11) unsigned NOT NULL auto_increment,
  `FULLNAME` blob NOT NULL,
  `USERNAME` blob NOT NULL,
  `PASSWORD` blob NOT NULL,
  `USERGROUP1` blob NOT NULL,
  `USERGROUP2` blob NOT NULL,
  `LANGUAGE` tinyint(3) unsigned NOT NULL default '2',
  `USER_ACTIVE` tinyint(3) unsigned NOT NULL default '1',
  `LICENSE_ACCEPTED` tinyint(3) unsigned NOT NULL default '2',
  `CREATEDBY` varchar(100) collate latin1_german2_ci NOT NULL default 'admin',
  `MODIFIEDBY` varchar(100) collate latin1_german2_ci NOT NULL default 'admin',
  `CREATED` datetime NOT NULL default '0000-00-00 00:00:00',
  `MODIFIED` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`USERID`),
  UNIQUE KEY `USERNAME` (`USERNAME`(30))
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'ˆXl‡P&ÌÏ6 ˆ\'','ÆxL¿p','ÆxL¿p','p','‡',2,1,1,'admin','admin','2008-03-30 10:33:44','2008-06-03 07:50:41'),(2,'ƒ6h¥3Où&ç','ú9SU','ú9SU','È','T',2,1,1,'admin','user','2008-06-03 06:21:56','2008-06-03 15:29:40');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

-- Dump completed on 2011-01-31 19:31:23

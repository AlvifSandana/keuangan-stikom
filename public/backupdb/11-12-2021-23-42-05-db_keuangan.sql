-- MariaDB dump 10.19  Distrib 10.5.12-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: db_keuangan
-- ------------------------------------------------------
-- Server version	10.5.12-MariaDB-0+deb11u1

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
-- Table structure for table `angkatan`
--

DROP TABLE IF EXISTS `angkatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `angkatan` (
  `id_angkatan` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `nama_angkatan` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_angkatan`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `angkatan`
--

LOCK TABLES `angkatan` WRITE;
/*!40000 ALTER TABLE `angkatan` DISABLE KEYS */;
INSERT INTO `angkatan` VALUES (1,'2020','2021-12-05 11:26:25','2021-12-05 11:26:25'),(2,'2021','2021-12-05 11:26:25','2021-12-05 11:26:25'),(3,'2022','2021-12-05 11:26:25','2021-12-05 11:26:25');
/*!40000 ALTER TABLE `angkatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_paket`
--

DROP TABLE IF EXISTS `item_paket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_paket` (
  `id_item` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `paket_id` int(10) unsigned NOT NULL,
  `nama_item` varchar(100) NOT NULL,
  `nominal_item` int(11) NOT NULL,
  `keterangan_item` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_item`),
  KEY `item_paket_paket_id_foreign` (`paket_id`),
  CONSTRAINT `item_paket_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `paket` (`id_paket`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_paket`
--

LOCK TABLES `item_paket` WRITE;
/*!40000 ALTER TABLE `item_paket` DISABLE KEYS */;
INSERT INTO `item_paket` VALUES (1,1,'DPP',10000000,'','2021-12-05 11:26:25','2021-12-05 11:26:25'),(2,1,'Seragam & Perlengkapan Praktek',1750000,'','2021-12-05 11:26:25','2021-12-05 11:26:25'),(3,1,'Perpustakaan Laboratorium',750000,'','2021-12-05 11:26:25','2021-12-05 11:26:25'),(4,1,'BEM',300000,'','2021-12-05 11:26:25','2021-12-05 11:26:25'),(5,1,'PPKK',600000,'','2021-12-05 11:26:25','2021-12-05 11:26:25'),(6,1,'Semester',3000000,'','2021-12-05 11:26:25','2021-12-05 11:26:25'),(7,1,'Buku Modul',150000,'','2021-12-05 11:26:25','2021-12-05 11:26:25'),(8,1,'UTS/UAS',315000,'','2021-12-05 11:26:25','2021-12-05 11:26:25'),(9,2,'Semester',3000000,'','2021-12-05 11:26:25','2021-12-05 11:26:25'),(10,2,'UTS/UAS',400000,'','2021-12-05 11:26:25','2021-12-05 11:26:25'),(11,2,'Praktik Klinik',2500000,'','2021-12-05 11:26:25','2021-12-05 11:26:25'),(12,2,'PPK',300000,'','2021-12-05 11:26:25','2021-12-05 11:26:25'),(13,3,'Kemahasiswaan',100000,'','2021-12-05 11:26:25','2021-12-05 11:26:25'),(14,3,'Semester',3000000,'','2021-12-05 11:26:25','2021-12-05 11:26:25'),(15,3,'UTS/UAS',400000,'','2021-12-05 11:26:25','2021-12-05 11:26:25'),(16,3,'Praktik Klinik',2500000,'','2021-12-05 11:26:25','2021-12-05 11:26:25'),(17,4,'Semester',3000000,'','2021-12-05 11:26:25','2021-12-05 11:26:25'),(18,4,'UTS/UAS',400000,'','2021-12-05 11:26:25','2021-12-05 11:26:25'),(19,4,'Praktik Klinik',2550000,'','2021-12-05 11:26:25','2021-12-05 11:26:25'),(20,4,'PPK',300000,'','2021-12-05 11:26:25','2021-12-05 11:26:25'),(21,5,'Kemahasiswaan',100000,'','2021-12-05 11:26:25','2021-12-05 11:26:25'),(22,5,'Semester',3000000,'','2021-12-05 11:26:25','2021-12-05 11:26:25'),(23,5,'UTS/UAS',400000,'','2021-12-05 11:26:25','2021-12-05 11:26:25'),(24,5,'Praktik Klinik',3750000,'','2021-12-05 11:26:25','2021-12-05 11:26:25'),(25,6,'Semester',3000000,'','2021-12-05 11:26:25','2021-12-05 11:26:25'),(26,6,'UTS/UAS',400000,'','2021-12-05 11:26:25','2021-12-05 11:26:25'),(27,6,'Praktik Klinik',1800000,'','2021-12-05 11:26:25','2021-12-05 11:26:25'),(28,6,'PPK',300000,'','2021-12-05 11:26:25','2021-12-05 11:26:25'),(29,6,'Pelatihan Skill',3000000,'','2021-12-05 11:26:25','2021-12-05 11:26:25'),(30,6,'LTA KTI',1700000,'','2021-12-05 11:26:25','2021-12-05 11:26:25');
/*!40000 ALTER TABLE `item_paket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mahasiswa`
--

DROP TABLE IF EXISTS `mahasiswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `nim` varchar(20) NOT NULL,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `progdi_id` int(10) unsigned NOT NULL,
  `angkatan_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_mahasiswa`),
  UNIQUE KEY `nim` (`nim`),
  KEY `mahasiswa_progdi_id_foreign` (`progdi_id`),
  KEY `mahasiswa_angkatan_id_foreign` (`angkatan_id`),
  CONSTRAINT `mahasiswa_angkatan_id_foreign` FOREIGN KEY (`angkatan_id`) REFERENCES `angkatan` (`id_angkatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mahasiswa_progdi_id_foreign` FOREIGN KEY (`progdi_id`) REFERENCES `progdi` (`id_progdi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mahasiswa`
--

LOCK TABLES `mahasiswa` WRITE;
/*!40000 ALTER TABLE `mahasiswa` DISABLE KEYS */;
INSERT INTO `mahasiswa` VALUES (1,'1119101710','Jamie Schroeder',2,1,'2021-12-05 11:26:25','2021-12-05 11:26:25'),(2,'1119101711','Jane',2,3,'2021-12-09 15:00:09','2021-12-09 15:00:09');
/*!40000 ALTER TABLE `mahasiswa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (126,'2021-09-19-044225','App\\Database\\Migrations\\CreateTableUser','default','App',1638703560,1),(127,'2021-09-19-044319','App\\Database\\Migrations\\CreateTableProgdi','default','App',1638703560,1),(128,'2021-09-19-044330','App\\Database\\Migrations\\CreateTableAngkatan','default','App',1638703560,1),(129,'2021-09-19-044350','App\\Database\\Migrations\\CreateTableSemester','default','App',1638703560,1),(130,'2021-09-19-044515','App\\Database\\Migrations\\CreateTableMahasiswa','default','App',1638703560,1),(131,'2021-09-19-044539','App\\Database\\Migrations\\CreateTablePaket','default','App',1638703560,1),(132,'2021-09-19-044553','App\\Database\\Migrations\\CreateTableItemPaket','default','App',1638703560,1),(133,'2021-09-19-044618','App\\Database\\Migrations\\CreateTableTagihan','default','App',1638703560,1),(134,'2021-09-19-044623','App\\Database\\Migrations\\CreateTablePembayaran','default','App',1638703560,1),(135,'2021-10-21-033047','App\\Database\\Migrations\\CreateStatusFieldTableTagihan','default','App',1638703560,1),(136,'2021-12-02-062017','App\\Database\\Migrations\\AddDokumenPembayaranFieldTablePembayaran','default','App',1638703560,1),(137,'2021-12-02-063657','App\\Database\\Migrations\\AddDokumenPembayaranNameFieldTablePembayaran','default','App',1638703560,1),(138,'2021-12-04-051349','App\\Database\\Migrations\\AddColumnUserLevelTableUser','default','App',1638703560,1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paket`
--

DROP TABLE IF EXISTS `paket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paket` (
  `id_paket` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `nama_paket` varchar(100) NOT NULL,
  `keterangan_paket` text NOT NULL,
  `semester_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_paket`),
  KEY `paket_semester_id_foreign` (`semester_id`),
  CONSTRAINT `paket_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id_semester`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paket`
--

LOCK TABLES `paket` WRITE;
/*!40000 ALTER TABLE `paket` DISABLE KEYS */;
INSERT INTO `paket` VALUES (1,'D3 KEBIDANAN - Semester 1','D3 KEBIDANAN Semester 1',1,'2021-12-05 11:26:25',NULL),(2,'D3 KEBIDANAN - Semester 2','D3 KEBIDANAN Semester 2',2,'2021-12-05 11:26:25',NULL),(3,'D3 KEBIDANAN - Semester 3','D3 KEBIDANAN Semester 3',3,'2021-12-05 11:26:25',NULL),(4,'D3 KEBIDANAN - Semester 4','D3 KEBIDANAN Semester 4',4,'2021-12-05 11:26:25',NULL),(5,'D3 KEBIDANAN - Semester 5','D3 KEBIDANAN Semester 5',5,'2021-12-05 11:26:25',NULL),(6,'D3 KEBIDANAN - Semester 6','D3 KEBIDANAN Semester 6',6,'2021-12-05 11:26:25',NULL),(7,'D3 GIZI - Semester 1','D3 GIZI Semester 11',1,'2021-12-05 15:42:35','2021-12-05 15:48:53');
/*!40000 ALTER TABLE `paket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pembayaran`
--

DROP TABLE IF EXISTS `pembayaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pembayaran` (
  `id_pembayaran` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `paket_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `mahasiswa_id` int(10) unsigned NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `nominal_pembayaran` int(11) NOT NULL,
  `keterangan_pembayaran` text DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `is_dokumen_pembayaran` tinyint(1) DEFAULT NULL,
  `dokumen_pembayaran` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pembayaran`),
  KEY `pembayaran_paket_id_foreign` (`paket_id`),
  KEY `pembayaran_item_id_foreign` (`item_id`),
  KEY `pembayaran_mahasiswa_id_foreign` (`mahasiswa_id`),
  KEY `pembayaran_user_id_foreign` (`user_id`),
  CONSTRAINT `pembayaran_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `item_paket` (`id_item`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pembayaran_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pembayaran_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `paket` (`id_paket`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pembayaran_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembayaran`
--

LOCK TABLES `pembayaran` WRITE;
/*!40000 ALTER TABLE `pembayaran` DISABLE KEYS */;
INSERT INTO `pembayaran` VALUES (1,1,2,1,'2021-12-08',1750000,NULL,1,NULL,NULL,'2021-12-08 07:15:28','2021-12-08 07:15:28'),(2,1,3,1,'2021-12-08',250000,NULL,1,NULL,NULL,'2021-12-08 07:23:28','2021-12-08 07:23:28'),(3,1,1,1,'2021-12-11',100000,NULL,1,1,'1639226516_7cb4e3c687836a15ab3a.txt','2021-12-11 12:41:56','2021-12-11 12:41:56'),(4,1,1,1,'2021-12-11',100000,NULL,1,1,'1639227020_ed4277922e43f7def79c.png','2021-12-11 12:50:20','2021-12-11 12:50:20');
/*!40000 ALTER TABLE `pembayaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `progdi`
--

DROP TABLE IF EXISTS `progdi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `progdi` (
  `id_progdi` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `nama_progdi` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_progdi`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `progdi`
--

LOCK TABLES `progdi` WRITE;
/*!40000 ALTER TABLE `progdi` DISABLE KEYS */;
INSERT INTO `progdi` VALUES (1,'D3 GIZI','2021-12-05 11:26:25','2021-12-05 11:26:25'),(2,'D3 KEBIDANAN','2021-12-05 11:26:25','2021-12-05 11:26:25'),(3,'S1 FARMASI','2021-12-05 11:26:25','2021-12-05 11:26:25'),(4,'S1 KEPERAWATAN','2021-12-05 11:26:25','2021-12-05 11:26:25');
/*!40000 ALTER TABLE `progdi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `semester`
--

DROP TABLE IF EXISTS `semester`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `semester` (
  `id_semester` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `nama_semester` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_semester`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `semester`
--

LOCK TABLES `semester` WRITE;
/*!40000 ALTER TABLE `semester` DISABLE KEYS */;
INSERT INTO `semester` VALUES (1,'Semester 1','2021-12-05 11:26:25','2021-12-05 11:26:25'),(2,'Semester 2','2021-12-05 11:26:25','2021-12-05 11:26:25'),(3,'Semester 3','2021-12-05 11:26:25','2021-12-05 11:26:25'),(4,'Semester 4','2021-12-05 11:26:25','2021-12-05 11:26:25'),(5,'Semester 5','2021-12-05 11:26:25','2021-12-05 11:26:25'),(6,'Semester 6','2021-12-05 11:26:25','2021-12-05 11:26:25'),(7,'Semester 7','2021-12-05 11:26:25','2021-12-05 11:26:25'),(8,'Semester 8','2021-12-05 11:26:25','2021-12-05 11:26:25');
/*!40000 ALTER TABLE `semester` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagihan`
--

DROP TABLE IF EXISTS `tagihan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagihan` (
  `id_tagihan` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `paket_id` int(10) unsigned NOT NULL,
  `mahasiswa_id` int(10) unsigned NOT NULL,
  `tanggal_tagihan` date NOT NULL,
  `keterangan_tagihan` text NOT NULL,
  `status_tagihan` text DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_tagihan`),
  KEY `tagihan_paket_id_foreign` (`paket_id`),
  KEY `tagihan_mahasiswa_id_foreign` (`mahasiswa_id`),
  KEY `tagihan_user_id_foreign` (`user_id`),
  CONSTRAINT `tagihan_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagihan_paket_id_foreign` FOREIGN KEY (`paket_id`) REFERENCES `paket` (`id_paket`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tagihan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagihan`
--

LOCK TABLES `tagihan` WRITE;
/*!40000 ALTER TABLE `tagihan` DISABLE KEYS */;
INSERT INTO `tagihan` VALUES (2,1,1,'2021-12-08','','belum_lunas',4,'2021-12-08 07:13:46','2021-12-08 07:13:46'),(3,2,1,'2021-12-08','','belum_lunas',4,'2021-12-08 07:13:46','2021-12-08 07:13:46'),(4,3,1,'2021-12-08','','belum_lunas',4,'2021-12-08 07:13:46','2021-12-08 07:13:46'),(5,4,1,'2021-12-08','','belum_lunas',4,'2021-12-08 07:13:46','2021-12-08 07:13:46'),(6,5,1,'2021-12-08','','belum_lunas',4,'2021-12-08 07:13:46','2021-12-08 07:13:46'),(7,6,1,'2021-12-08','','belum_lunas',4,'2021-12-08 07:13:46','2021-12-08 07:13:46'),(8,1,2,'2021-11-09','-','belum_lunas',4,'2021-12-09 15:00:09','2021-12-09 15:00:09'),(9,2,2,'2021-11-09','-','belum_lunas',4,'2021-12-09 15:00:09','2021-12-09 15:00:09'),(10,3,2,'2021-11-09','-','belum_lunas',4,'2021-12-09 15:00:09','2021-12-09 15:00:09'),(11,4,2,'2021-11-09','-','belum_lunas',4,'2021-12-09 15:00:09','2021-12-09 15:00:09'),(12,5,2,'2021-11-09','-','belum_lunas',4,'2021-12-09 15:00:09','2021-12-09 15:00:09'),(13,6,2,'2021-11-09','-','belum_lunas',4,'2021-12-09 15:00:09','2021-12-09 15:00:09');
/*!40000 ALTER TABLE `tagihan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id_user` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `user_level` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Administrator','admin','admin@example.com','123456789','admin','2021-12-05 11:40:06','2021-12-05 21:04:58'),(2,'demo','demo','demo@example.com','$2y$10$QB27cfyEbmFn7o6GwGCkO.ZOQk6Bz0h.58gYNhpbf/b1eiiKmhD7i','demo','2021-12-05 11:40:06','2021-12-05 21:18:20'),(4,'Alvif','alvifsandana','alvifsandana@gmail.com','$2y$10$fh7.XeyEwwTn2M1qHmWi5e3LcCiuacot4gd8DaaVx5jB9.mf4YQG.','admin','2021-12-05 21:01:32','2021-12-05 21:09:41'),(5,'Alvif','dandii','admin@mail.com','$2y$10$rPOGcdkYMsEcEp2OCO2J3u4Pp0Efvc3NGxZEVcOE8qlCKmRugUf5q','demo','2021-12-07 00:20:37','2021-12-07 00:20:37');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-11 23:42:05

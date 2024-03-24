-- MySQL dump 10.13  Distrib 8.3.0, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: laravels
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `appointments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `time_start` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_end` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visited` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `appointments_user_id_foreign` (`user_id`),
  CONSTRAINT `appointments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointments`
--

LOCK TABLES `appointments` WRITE;
/*!40000 ALTER TABLE `appointments` DISABLE KEYS */;
INSERT INTO `appointments` VALUES (1,3,'2024-03-19','11:00','12:00','0','[soin1-p56622]','2024-03-16 21:19:56','2024-03-16 21:19:56'),(2,4,'2024-03-18','08:00','09:00','0',NULL,'2024-03-16 21:20:24','2024-03-16 21:20:24'),(3,3,'2024-03-29','11:00','12:00','1',NULL,'2024-03-16 21:20:35','2024-03-17 18:15:40'),(4,4,'2024-03-18','09:00','10:00','0',NULL,'2024-03-16 21:21:18','2024-03-16 21:21:18'),(5,4,'2024-03-18','12:00','13:00','1',NULL,'2024-03-16 21:21:35','2024-03-17 16:51:42'),(6,3,'2024-03-28','14:00','15:00','1',NULL,'2024-03-17 16:43:42','2024-03-17 16:51:36'),(8,3,'2024-03-21','14:00','15:00','0',NULL,'2024-03-18 11:49:28','2024-03-18 11:49:28'),(9,3,'2024-03-21','14:00','15:00','0',NULL,'2024-03-18 11:49:29','2024-03-18 11:49:29');
/*!40000 ALTER TABLE `appointments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `billing_items`
--

DROP TABLE IF EXISTS `billing_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `billing_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `billing_id` bigint unsigned NOT NULL,
  `invoice_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `billing_items_billing_id_foreign` (`billing_id`),
  CONSTRAINT `billing_items_billing_id_foreign` FOREIGN KEY (`billing_id`) REFERENCES `billings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `billing_items`
--

LOCK TABLES `billing_items` WRITE;
/*!40000 ALTER TABLE `billing_items` DISABLE KEYS */;
INSERT INTO `billing_items` VALUES (1,1,'diagnostic de TEST 2','500','2024-01-16 21:12:33','2024-03-16 21:12:33'),(2,2,'diagnostic de TEST','8494941','2024-04-16 21:12:59','2024-03-16 21:12:59'),(3,1,'bla bla','30000','2023-12-17 00:13:50','2024-03-17 00:14:04'),(4,3,'diagnostic de TEST','100000','2023-03-16 21:22:27','2024-03-16 21:22:27'),(5,4,'diagnostic de TEST','959595','2022-12-16 21:22:47','2024-03-16 21:22:47');
/*!40000 ALTER TABLE `billing_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `billings`
--

DROP TABLE IF EXISTS `billings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `billings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `payment_mode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `due_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposited_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_without_tax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_with_tax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `billings_user_id_foreign` (`user_id`),
  KEY `billings_created_by_foreign` (`created_by`),
  CONSTRAINT `billings_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `billings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `billings`
--

LOCK TABLES `billings` WRITE;
/*!40000 ALTER TABLE `billings` DISABLE KEYS */;
INSERT INTO `billings` VALUES (1,4,1,'Mobile Transaction','Partially Paid','b84328','2024-03-16 21:12:33','2024-03-16 21:12:33','55','445',NULL,'500','500'),(2,3,1,'Cash','Partially Paid','b23108','2024-03-16 21:12:59','2024-03-16 21:12:59','6494941','2000000',NULL,'8494941','8494941'),(3,3,1,'Cash','Partially Paid','b55704','2024-03-16 21:22:27','2024-03-16 21:22:27','99000','1000',NULL,'100000','100000'),(4,3,1,'Cash','Partially Paid','b71796','2024-03-16 21:22:47','2024-03-16 21:22:47','459595','500000',NULL,'959595','959595');
/*!40000 ALTER TABLE `billings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctors`
--

DROP TABLE IF EXISTS `doctors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `speciality` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saturday_from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saturday_to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sunday_from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sunday_to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monday_from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monday_to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tuesday_from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tuesday_to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wednesday_from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wednesday_to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thursday_from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thursday_to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `friday_from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `friday_to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `doctors_user_id_foreign` (`user_id`),
  CONSTRAINT `doctors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctors`
--

LOCK TABLES `doctors` WRITE;
/*!40000 ALTER TABLE `doctors` DISABLE KEYS */;
/*!40000 ALTER TABLE `doctors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` mediumtext COLLATE utf8mb4_unicode_ci,
  `note` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `documents_user_id_foreign` (`user_id`),
  CONSTRAINT `documents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `drugs`
--

DROP TABLE IF EXISTS `drugs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `drugs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `trade_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `generic_name` json DEFAULT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drugs`
--

LOCK TABLES `drugs` WRITE;
/*!40000 ALTER TABLE `drugs` DISABLE KEYS */;
INSERT INTO `drugs` VALUES (1,'test 1','[\"PRODUIT TEST\", \"Sèrum  Hydra_Oxygénant\", \"LOTION TONIQUE OXYGENANTE à l\'extrait de citronelle\", \"GEL NETTOYANT EXFOLIANT\"]',NULL,'2024-03-16 18:24:29','2024-03-16 18:24:29'),(2,'full','[\"PRODUIT TEST\", \"SÉRUM RÉVEILÉCLAT\", \"Sérum Purifiant & Détoxifiant\", \"Sèrum  Hydra_Oxygénant\", \"LOTION TONIQUE ASSAINISSANTE à l\'extrait d\'abre à thé\", \"LOTION TONIQUE OXYGENANTE à l\'extrait de citronelle\", \"LOTION CLARIFIANTE  aux extraits de fruits  et épices\", \"GEL NETTOYANT EXFOLIANT\", \"LOTION TONIQUE Anti-oxydant aux extraits de fleurs de fleurs rouges\", \"GEL NETTOYANT Éclat jeunesse aux trois roses\"]',NULL,'2024-03-16 18:24:51','2024-03-16 18:24:51');
/*!40000 ALTER TABLE `drugs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historys`
--

DROP TABLE IF EXISTS `historys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `historys` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `historys_user_id_foreign` (`user_id`),
  CONSTRAINT `historys_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historys`
--

LOCK TABLES `historys` WRITE;
/*!40000 ALTER TABLE `historys` DISABLE KEYS */;
INSERT INTO `historys` VALUES (1,3,'ojojo','oijiiji','2024-03-17 18:17:05','2024-03-17 18:17:05');
/*!40000 ALTER TABLE `historys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2020_09_10_000506_create_drugs_table',1),(6,'2020_09_10_103451_create_prescriptions_table',1),(7,'2020_09_10_154523_create_prescription_drugs_table',1),(8,'2020_09_14_174033_create_patients_table',1),(9,'2020_09_16_095938_create_settings_table',1),(10,'2020_09_16_230135_create_tests_table',1),(11,'2020_09_16_230830_create_prescription_tests_table',1),(12,'2020_09_18_010549_create_appointments_table',1),(13,'2020_09_18_180127_create_doctors_table',1),(14,'2020_09_19_164615_create_billings_table',1),(15,'2020_09_19_180540_create_billing_items_table',1),(16,'2020_09_29_185732_create_documents_table',1),(17,'2021_11_22_232428_add_balance_to_billings_table',1),(18,'2021_11_23_132554_create_historys_table',1),(19,'2022_05_27_000537_add_reason_to_appointments_table',1),(20,'2022_06_12_123945_create_permission_tables',1),(21,'2022_06_13_132658_add_image_to_users_table',1),(22,'2023_11_17_082936_add_role_id_to_users_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\User',1),(2,'App\\User',2);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patients`
--

DROP TABLE IF EXISTS `patients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `patients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `birthday` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adress` mediumtext COLLATE utf8mb4_unicode_ci,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `medication` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hobbie` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `demande` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allergie` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_patient` json DEFAULT NULL,
  `alimentation` json DEFAULT NULL,
  `digestion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `morphology` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patients_user_id_foreign` (`user_id`),
  CONSTRAINT `patients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patients`
--

LOCK TABLES `patients` WRITE;
/*!40000 ALTER TABLE `patients` DISABLE KEYS */;
INSERT INTO `patients` VALUES (1,3,'2003-12-12','15324678','iuhjiwejoai','Homme',NULL,NULL,NULL,NULL,'[\"Elancé(e)\", \"Amazone\"]','[\"Céréales\", \"Tubercules\", \"Pas d\'alcool\"]','Médiocre','[\"Svelte\", \"Petit(e)\", \"Mince\"]','2024-03-16 18:19:08','2024-03-16 18:19:08'),(2,4,'2005-12-05','4999492962','testtesttedt','Homme','qbiubifuwb8','testhsih','uhqwudha9oi','knkscinoi','[\"Mince\", \"Forte\"]','[\"Céréales\", \"Tubercules\", \"Alcool\", \"Fumeur\"]','Alternée','[\"Svelte\", \"Mince\", \"Rondeur\"]','2024-03-16 18:26:29','2024-03-16 18:26:29');
/*!40000 ALTER TABLE `patients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'add patient','web','2024-03-16 18:13:42','2024-03-16 18:13:42'),(2,'view patient','web','2024-03-16 18:13:42','2024-03-16 18:13:42'),(3,'edit patient','web','2024-03-16 18:13:42','2024-03-16 18:13:42'),(4,'view all patients','web','2024-03-16 18:13:42','2024-03-16 18:13:42'),(5,'delete patient','web','2024-03-16 18:13:42','2024-03-16 18:13:42'),(6,'create health history','web','2024-03-16 18:13:42','2024-03-16 18:13:42'),(7,'delete health history','web','2024-03-16 18:13:43','2024-03-16 18:13:43'),(8,'add medical files','web','2024-03-16 18:13:43','2024-03-16 18:13:43'),(9,'delete medical files','web','2024-03-16 18:13:43','2024-03-16 18:13:43'),(10,'create appointment','web','2024-03-16 18:13:43','2024-03-16 18:13:43'),(11,'view all appointments','web','2024-03-16 18:13:43','2024-03-16 18:13:43'),(12,'delete appointment','web','2024-03-16 18:13:43','2024-03-16 18:13:43'),(13,'edit appointment','web','2024-03-16 18:13:43','2024-03-16 18:13:43'),(14,'create prescription','web','2024-03-16 18:13:44','2024-03-16 18:13:44'),(15,'view prescription','web','2024-03-16 18:13:44','2024-03-16 18:13:44'),(16,'view all prescriptions','web','2024-03-16 18:13:44','2024-03-16 18:13:44'),(17,'edit prescription','web','2024-03-16 18:13:44','2024-03-16 18:13:44'),(18,'delete prescription','web','2024-03-16 18:13:44','2024-03-16 18:13:44'),(19,'print prescription','web','2024-03-16 18:13:44','2024-03-16 18:13:44'),(20,'create drug','web','2024-03-16 18:13:44','2024-03-16 18:13:44'),(21,'edit drug','web','2024-03-16 18:13:44','2024-03-16 18:13:44'),(22,'view drug','web','2024-03-16 18:13:45','2024-03-16 18:13:45'),(23,'delete drug','web','2024-03-16 18:13:45','2024-03-16 18:13:45'),(24,'view all drugs','web','2024-03-16 18:13:45','2024-03-16 18:13:45'),(25,'create diagnostic test','web','2024-03-16 18:13:45','2024-03-16 18:13:45'),(26,'edit diagnostic test','web','2024-03-16 18:13:45','2024-03-16 18:13:45'),(27,'view all diagnostic tests','web','2024-03-16 18:13:45','2024-03-16 18:13:45'),(28,'delete diagnostic test','web','2024-03-16 18:13:45','2024-03-16 18:13:45'),(29,'create invoice','web','2024-03-16 18:13:45','2024-03-16 18:13:45'),(30,'edit invoice','web','2024-03-16 18:13:45','2024-03-16 18:13:45'),(31,'view invoice','web','2024-03-16 18:13:45','2024-03-16 18:13:45'),(32,'view all invoices','web','2024-03-16 18:13:45','2024-03-16 18:13:45'),(33,'delete invoice','web','2024-03-16 18:13:46','2024-03-16 18:13:46'),(34,'print invoice','web','2024-03-16 18:13:46','2024-03-16 18:13:46'),(35,'manage settings','web','2024-03-16 18:13:46','2024-03-16 18:13:46'),(36,'manage roles','web','2024-03-16 18:13:46','2024-03-16 18:13:46');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prescription_drugs`
--

DROP TABLE IF EXISTS `prescription_drugs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prescription_drugs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `prescription_id` bigint unsigned NOT NULL,
  `drug_id` bigint unsigned NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `strength` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dose` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `drug_advice` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prescription_drugs_prescription_id_foreign` (`prescription_id`),
  KEY `prescription_drugs_drug_id_foreign` (`drug_id`),
  CONSTRAINT `prescription_drugs_drug_id_foreign` FOREIGN KEY (`drug_id`) REFERENCES `drugs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `prescription_drugs_prescription_id_foreign` FOREIGN KEY (`prescription_id`) REFERENCES `prescriptions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prescription_drugs`
--

LOCK TABLES `prescription_drugs` WRITE;
/*!40000 ALTER TABLE `prescription_drugs` DISABLE KEYS */;
INSERT INTO `prescription_drugs` VALUES (1,1,1,'pending',NULL,'5','2023-05-03',NULL,'2024-03-16 18:27:54','2024-03-16 23:34:09'),(3,1,2,'new',NULL,'2','2024-03-17',NULL,'2024-03-16 23:34:09','2024-03-16 23:34:09'),(4,2,2,'new',NULL,'10','2024-12-02',NULL,'2024-03-17 03:03:29','2024-03-17 03:03:29');
/*!40000 ALTER TABLE `prescription_drugs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prescription_tests`
--

DROP TABLE IF EXISTS `prescription_tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prescription_tests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `prescription_id` bigint unsigned NOT NULL,
  `test_id` bigint unsigned NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prescription_tests_prescription_id_foreign` (`prescription_id`),
  KEY `prescription_tests_test_id_foreign` (`test_id`),
  CONSTRAINT `prescription_tests_prescription_id_foreign` FOREIGN KEY (`prescription_id`) REFERENCES `prescriptions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `prescription_tests_test_id_foreign` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prescription_tests`
--

LOCK TABLES `prescription_tests` WRITE;
/*!40000 ALTER TABLE `prescription_tests` DISABLE KEYS */;
INSERT INTO `prescription_tests` VALUES (1,1,1,NULL,'2024-03-16 18:27:54','2024-03-16 23:34:09'),(3,2,1,NULL,'2024-03-17 03:03:29','2024-03-17 03:03:29');
/*!40000 ALTER TABLE `prescription_tests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prescriptions`
--

DROP TABLE IF EXISTS `prescriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prescriptions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `doctor_id` bigint unsigned NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `advices` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prescriptions_user_id_foreign` (`user_id`),
  KEY `prescriptions_doctor_id_foreign` (`doctor_id`),
  CONSTRAINT `prescriptions_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `prescriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prescriptions`
--

LOCK TABLES `prescriptions` WRITE;
/*!40000 ALTER TABLE `prescriptions` DISABLE KEYS */;
INSERT INTO `prescriptions` VALUES (1,3,2,'p56622',NULL,'2024-03-16 18:27:54','2024-03-16 18:27:54'),(2,3,2,'p64805',NULL,'2024-03-17 03:03:29','2024-03-17 03:03:29');
/*!40000 ALTER TABLE `prescriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,1),(1,2),(2,2),(3,2),(4,2),(5,2),(6,2),(7,2),(8,2),(9,2),(10,2),(11,2),(12,2),(13,2),(14,2),(15,2),(16,2),(17,2),(18,2),(19,2),(20,2),(21,2),(22,2),(23,2),(24,2),(25,2),(26,2),(27,2),(28,2),(29,2),(30,2),(31,2),(32,2),(33,2),(34,2),(35,2),(36,2),(1,3),(2,3),(3,3),(4,3),(5,3),(6,3),(7,3),(8,3),(9,3),(10,3),(11,3),(12,3),(13,3),(14,3),(15,3),(16,3),(17,3),(18,3),(19,3),(20,3),(21,3),(22,3),(23,3),(24,3),(25,3),(26,3),(27,3),(28,3),(29,3),(30,3),(31,3),(32,3),(33,3),(34,3),(35,3),(36,3);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin','web','2024-03-16 18:13:46','2024-03-16 18:13:46'),(2,'Praticien','web','2024-03-16 18:13:46','2024-03-16 18:13:46'),(3,'Hôte','web','2024-03-16 18:13:46','2024-03-16 18:13:46');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_value` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'system_name','sai i lama gestion soin',NULL,NULL),(2,'address','Etoa-Meki ',NULL,NULL),(3,'phone','+213 657 04 19 93',NULL,NULL),(4,'hospital_email','sai-i-lama@gmail.com',NULL,NULL),(5,'currency','cfa',NULL,NULL),(6,'vat','0',NULL,NULL),(7,'language','fr',NULL,NULL),(8,'appointment_interval','60',NULL,NULL),(9,'saturday_from',NULL,NULL,NULL),(10,'saturday_to',NULL,NULL,NULL),(11,'sunday_from',NULL,NULL,NULL),(12,'sunday_to',NULL,NULL,NULL),(13,'monday_from','08:00',NULL,NULL),(14,'monday_to','17:00',NULL,NULL),(15,'tuesday_from','08:00',NULL,NULL),(16,'tuesday_to','17:00',NULL,NULL),(17,'wednesday_from','08:00',NULL,NULL),(18,'wednesday_to','17:00',NULL,NULL),(19,'thursday_from','08:00',NULL,NULL),(20,'thursday_to','17:00',NULL,NULL),(21,'friday_from','08:00',NULL,NULL),(22,'friday_to','17:00',NULL,NULL),(23,'system_name','sai i lama gestion soin',NULL,NULL),(24,'address','Etoa-Meki ',NULL,NULL),(25,'phone','+213 657 04 19 93',NULL,NULL),(26,'hospital_email','sai-i-lama@gmail.com',NULL,NULL),(27,'currency','cfa',NULL,NULL),(28,'vat','0',NULL,NULL),(29,'language','fr',NULL,NULL),(30,'appointment_interval','60',NULL,NULL),(31,'saturday_from',NULL,NULL,NULL),(32,'saturday_to',NULL,NULL,NULL),(33,'sunday_from',NULL,NULL,NULL),(34,'sunday_to',NULL,NULL,NULL),(35,'monday_from','08:00',NULL,NULL),(36,'monday_to','17:00',NULL,NULL),(37,'tuesday_from','08:00',NULL,NULL),(38,'tuesday_to','17:00',NULL,NULL),(39,'wednesday_from','08:00',NULL,NULL),(40,'wednesday_to','17:00',NULL,NULL),(41,'thursday_from','08:00',NULL,NULL),(42,'thursday_to','17:00',NULL,NULL),(43,'friday_from','08:00',NULL,NULL),(44,'friday_to','17:00',NULL,NULL),(45,'system_name','sai i lama gestion soin',NULL,NULL),(46,'address','Etoa-Meki ',NULL,NULL),(47,'phone','+213 657 04 19 93',NULL,NULL),(48,'hospital_email','sai-i-lama@gmail.com',NULL,NULL),(49,'currency','cfa',NULL,NULL),(50,'vat','0',NULL,NULL),(51,'language','fr',NULL,NULL),(52,'appointment_interval','60',NULL,NULL),(53,'saturday_from',NULL,NULL,NULL),(54,'saturday_to',NULL,NULL,NULL),(55,'sunday_from',NULL,NULL,NULL),(56,'sunday_to',NULL,NULL,NULL),(57,'monday_from','08:00',NULL,NULL),(58,'monday_to','17:00',NULL,NULL),(59,'tuesday_from','08:00',NULL,NULL),(60,'tuesday_to','17:00',NULL,NULL),(61,'wednesday_from','08:00',NULL,NULL),(62,'wednesday_to','17:00',NULL,NULL),(63,'thursday_from','08:00',NULL,NULL),(64,'thursday_to','17:00',NULL,NULL),(65,'friday_from','08:00',NULL,NULL),(66,'friday_to','17:00',NULL,NULL),(67,'system_name','sai i lama gestion soin',NULL,NULL),(68,'address','Etoa-Meki ',NULL,NULL),(69,'phone','+213 657 04 19 93',NULL,NULL),(70,'hospital_email','sai-i-lama@gmail.com',NULL,NULL),(71,'currency','cfa',NULL,NULL),(72,'vat','0',NULL,NULL),(73,'language','fr',NULL,NULL),(74,'appointment_interval','60',NULL,NULL),(75,'saturday_from',NULL,NULL,NULL),(76,'saturday_to',NULL,NULL,NULL),(77,'sunday_from',NULL,NULL,NULL),(78,'sunday_to',NULL,NULL,NULL),(79,'monday_from','08:00',NULL,NULL),(80,'monday_to','17:00',NULL,NULL),(81,'tuesday_from','08:00',NULL,NULL),(82,'tuesday_to','17:00',NULL,NULL),(83,'wednesday_from','08:00',NULL,NULL),(84,'wednesday_to','17:00',NULL,NULL),(85,'thursday_from','08:00',NULL,NULL),(86,'thursday_to','17:00',NULL,NULL),(87,'friday_from','08:00',NULL,NULL),(88,'friday_to','17:00',NULL,NULL),(89,'system_name','sai i lama gestion soin',NULL,NULL),(90,'address','Etoa-Meki ',NULL,NULL),(91,'phone','+213 657 04 19 93',NULL,NULL),(92,'hospital_email','sai-i-lama@gmail.com',NULL,NULL),(93,'currency','cfa',NULL,NULL),(94,'vat','0',NULL,NULL),(95,'language','fr',NULL,NULL),(96,'appointment_interval','60',NULL,NULL),(97,'saturday_from',NULL,NULL,NULL),(98,'saturday_to',NULL,NULL,NULL),(99,'sunday_from',NULL,NULL,NULL),(100,'sunday_to',NULL,NULL,NULL),(101,'monday_from','08:00',NULL,NULL),(102,'monday_to','17:00',NULL,NULL),(103,'tuesday_from','08:00',NULL,NULL),(104,'tuesday_to','17:00',NULL,NULL),(105,'wednesday_from','08:00',NULL,NULL),(106,'wednesday_to','17:00',NULL,NULL),(107,'thursday_from','08:00',NULL,NULL),(108,'thursday_to','17:00',NULL,NULL),(109,'friday_from','08:00',NULL,NULL),(110,'friday_to','17:00',NULL,NULL),(111,'system_name','sai i lama gestion soin',NULL,NULL),(112,'address','Etoa-Meki ',NULL,NULL),(113,'phone','+213 657 04 19 93',NULL,NULL),(114,'hospital_email','sai-i-lama@gmail.com',NULL,NULL),(115,'currency','cfa',NULL,NULL),(116,'vat','0',NULL,NULL),(117,'language','fr',NULL,NULL),(118,'appointment_interval','60',NULL,NULL),(119,'saturday_from',NULL,NULL,NULL),(120,'saturday_to',NULL,NULL,NULL),(121,'sunday_from',NULL,NULL,NULL),(122,'sunday_to',NULL,NULL,NULL),(123,'monday_from','08:00',NULL,NULL),(124,'monday_to','17:00',NULL,NULL),(125,'tuesday_from','08:00',NULL,NULL),(126,'tuesday_to','17:00',NULL,NULL),(127,'wednesday_from','08:00',NULL,NULL),(128,'wednesday_to','17:00',NULL,NULL),(129,'thursday_from','08:00',NULL,NULL),(130,'thursday_to','17:00',NULL,NULL),(131,'friday_from','08:00',NULL,NULL),(132,'friday_to','17:00',NULL,NULL),(133,'system_name','sai i lama gestion soin',NULL,NULL),(134,'address','Etoa-Meki ',NULL,NULL),(135,'phone','+213 657 04 19 93',NULL,NULL),(136,'hospital_email','sai-i-lama@gmail.com',NULL,NULL),(137,'currency','cfa',NULL,NULL),(138,'vat','0',NULL,NULL),(139,'language','fr',NULL,NULL),(140,'appointment_interval','60',NULL,NULL),(141,'saturday_from',NULL,NULL,NULL),(142,'saturday_to',NULL,NULL,NULL),(143,'sunday_from',NULL,NULL,NULL),(144,'sunday_to',NULL,NULL,NULL),(145,'monday_from','08:00',NULL,NULL),(146,'monday_to','17:00',NULL,NULL),(147,'tuesday_from','08:00',NULL,NULL),(148,'tuesday_to','17:00',NULL,NULL),(149,'wednesday_from','08:00',NULL,NULL),(150,'wednesday_to','17:00',NULL,NULL),(151,'thursday_from','08:00',NULL,NULL),(152,'thursday_to','17:00',NULL,NULL),(153,'friday_from','08:00',NULL,NULL),(154,'friday_to','17:00',NULL,NULL);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tests`
--

DROP TABLE IF EXISTS `tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `test_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diagnostic_type` json NOT NULL,
  `comment` mediumtext COLLATE utf8mb4_unicode_ci,
  `sebum_grp` json DEFAULT NULL,
  `hydratation_grp` json DEFAULT NULL,
  `keratinisation_grp` json DEFAULT NULL,
  `follicule_grp` json DEFAULT NULL,
  `relief_grp` json DEFAULT NULL,
  `elasticite_grp` json DEFAULT NULL,
  `sensibilite_grp` json DEFAULT NULL,
  `circulation_grp` json DEFAULT NULL,
  `signes_particuliers_peau` json DEFAULT NULL,
  `Etat_generale_des_mains` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Etat_des_ongles_mains` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signes_particuliers_mains` json DEFAULT NULL,
  `signes_particuliers_ongles_mains` json DEFAULT NULL,
  `soinList_main` json DEFAULT NULL,
  `vernisInput_main` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `obserationInput_main` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reliefInput_main` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cicatrices_main` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `callosites_main` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spInput_main` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skinStateInput_main` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tache_main` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cicatrices_main_dorsal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `callosite_main_dorsal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spInput_main_dorsal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Etat_generale_des_pieds` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Etat_des_ongles_pieds` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signes_particuliers_pieds` json DEFAULT NULL,
  `signes_particuliers_ongles_pieds` json DEFAULT NULL,
  `soinList_pied` json DEFAULT NULL,
  `vernisInput_pied` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `obserationInput_pied` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `etat_pieds` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taches_pieds` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aureoles_pieds` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `veines_face_ext_pieds` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `veines_face_int_pieds` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `douleur_talon_pieds` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spInput_pieds` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tests_user_id_foreign` (`user_id`),
  CONSTRAINT `tests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tests`
--

LOCK TABLES `tests` WRITE;
/*!40000 ALTER TABLE `tests` DISABLE KEYS */;
INSERT INTO `tests` VALUES (1,3,'jqbiuax','[\"DIAGNOSE MAIN\"]','DIAGNOSE MAIN','null','null','null','null','null','null','null','null','null','Normale','Normaux','[\"Rousseurs\", \"Pigmentation\", \"Desquamations\", \"Cicatrices\"]','[\"Epais\", \"Décollés\", \"Colorés\", \"Petites taches\", \"Fripés\", \"Friables et poudreux\", \"Striées\"]','[\"1\", \"2\", \"3\"]',NULL,NULL,NULL,'oui','oui',NULL,NULL,'oui','oui','oui',NULL,'Normale','Normaux','null','null','null',NULL,NULL,NULL,'oui','oui','oui','oui','oui',NULL,'2024-03-16 18:27:03','2024-03-16 18:27:03');
/*!40000 ALTER TABLE `tests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint unsigned NOT NULL DEFAULT '3',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'ADMIN','admin@admin',NULL,'$2y$10$GrqornKXvJdvYzSBHTg/Ue8E9JHLtIuDlyC25gpMZvACCHDg9nG9y','oPVO54ygJwhzbPLZt8udmLb0XLVSljiFaOuwndRZzUaDzKDvusUhdmfglyqW','2024-03-16 18:13:51','2024-03-16 18:13:51',NULL,1),(2,'PRATICIENT','doc@admin',NULL,'$2y$10$gMRF9fR5Cfy2CRfMxRQPxef0uFaiUSgseUoDlRNEwiIh.aza/MAj.',NULL,'2024-03-16 18:13:51','2024-03-16 18:13:51',NULL,2),(3,'test','test@gmail.com',NULL,'$2y$10$h3i8SJj/p55bBsxWCH/bJ.rCauWlCUXovGL6NVL/dXJBTK1BMGLTa',NULL,'2024-03-16 18:19:08','2024-03-16 18:19:08','',3),(4,'test 2','test2@gmail.com',NULL,'$2y$10$/RQiP8KJk2VIbAvIKCqrb.LRV0YwT/Lpkl1/S.Drzop8M9GBZq6Cq',NULL,'2024-03-16 18:26:23','2024-03-16 18:26:23','',3);
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

-- Dump completed on 2024-03-24  2:15:25

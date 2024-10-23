-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: data_inicial
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `table_log`
--

DROP TABLE IF EXISTS `table_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `table_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_idUser` int(11) DEFAULT NULL,
  `log_descripcion` text DEFAULT NULL,
  `log_comando` text DEFAULT NULL,
  `log_fecha` date DEFAULT NULL,
  PRIMARY KEY (`log_id`),
  KEY `log_idUser_idx` (`log_idUser`),
  CONSTRAINT `log_idUser` FOREIGN KEY (`log_idUser`) REFERENCES `table_user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `table_log`
--

LOCK TABLES `table_log` WRITE;
/*!40000 ALTER TABLE `table_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `table_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `table_menu`
--

DROP TABLE IF EXISTS `table_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `table_menu` (
  `id_menu` int(11) NOT NULL,
  `nombre_menu` varchar(45) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `icono` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `page_menu_open` varchar(20) DEFAULT NULL,
  `page_link` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `table_menu`
--

LOCK TABLES `table_menu` WRITE;
/*!40000 ALTER TABLE `table_menu` DISABLE KEYS */;
INSERT INTO `table_menu` VALUES (1,'Usuario',NULL,'far fa-user',1,'usuario','usuarios'),(2,'Menu',NULL,'fas fa-list-ul',1,'menu','menus'),(3,'Timeline',NULL,'far fa-clock',1,'timelines','times'),(1,'Usuario',NULL,'far fa-user',1,'usuario','usuarios'),(2,'Menu',NULL,'fas fa-list-ul',1,'menu','menus'),(3,'Timeline',NULL,'far fa-clock',1,'timelines','times');
/*!40000 ALTER TABLE `table_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `table_menu_sub_menu`
--

DROP TABLE IF EXISTS `table_menu_sub_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `table_menu_sub_menu` (
  `id_menu_sub_menu` int(11) NOT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `id_sub_menu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `table_menu_sub_menu`
--

LOCK TABLES `table_menu_sub_menu` WRITE;
/*!40000 ALTER TABLE `table_menu_sub_menu` DISABLE KEYS */;
INSERT INTO `table_menu_sub_menu` VALUES (1,1,1),(2,1,2),(3,1,3),(4,2,4),(5,3,5);
/*!40000 ALTER TABLE `table_menu_sub_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `table_roles`
--

DROP TABLE IF EXISTS `table_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `table_roles` (
  `rol_id` int(11) NOT NULL,
  `rol_name` varchar(45) DEFAULT NULL,
  `rol_descripcion` text DEFAULT NULL,
  `rol_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `table_roles`
--

LOCK TABLES `table_roles` WRITE;
/*!40000 ALTER TABLE `table_roles` DISABLE KEYS */;
INSERT INTO `table_roles` VALUES (1,'Administrador','administrador',1),(2,'Encargado','encargado del sistema',1),(3,'Provicional','Provicional',2);
/*!40000 ALTER TABLE `table_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `table_roles_sub_menu`
--

DROP TABLE IF EXISTS `table_roles_sub_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `table_roles_sub_menu` (
  `id_rol_sub_menu` int(11) NOT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `id_sub_menu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `table_roles_sub_menu`
--

LOCK TABLES `table_roles_sub_menu` WRITE;
/*!40000 ALTER TABLE `table_roles_sub_menu` DISABLE KEYS */;
INSERT INTO `table_roles_sub_menu` VALUES (1,1,1),(2,1,2),(3,1,3),(4,1,4),(5,1,5);
/*!40000 ALTER TABLE `table_roles_sub_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `table_timeline`
--

DROP TABLE IF EXISTS `table_timeline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `table_timeline` (
  `time_id` int(11) NOT NULL,
  `time_idUser` int(11) DEFAULT NULL,
  `time_codigo` varchar(45) DEFAULT NULL,
  `time_fecha` varchar(20) DEFAULT NULL,
  `time_inicio` varchar(20) DEFAULT NULL,
  `time_fin` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `table_timeline`
--

LOCK TABLES `table_timeline` WRITE;
/*!40000 ALTER TABLE `table_timeline` DISABLE KEYS */;
/*!40000 ALTER TABLE `table_timeline` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `table_user`
--

DROP TABLE IF EXISTS `table_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `table_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_ci` int(11) DEFAULT NULL,
  `user_nick` varchar(50) DEFAULT NULL,
  `user_pass` text DEFAULT NULL,
  `user_nombres` varchar(50) DEFAULT NULL,
  `user_apellidos` varchar(50) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_tlf` varchar(20) DEFAULT NULL,
  `user_rol` int(11) DEFAULT NULL,
  `user_status` int(11) DEFAULT NULL,
  `user_img` text DEFAULT NULL,
  `user_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_ruta` text DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `table_user`
--

LOCK TABLES `table_user` WRITE;
/*!40000 ALTER TABLE `table_user` DISABLE KEYS */;
INSERT INTO `table_user` VALUES (1,2000000,'ADMIN','V1V3RWFXS0JXMG1PYjR3SzNLMldCZz09','Admin','Admin','admin@admin','5555555555',1,1,'storage/ADMIN/default.png','2024-06-21 20:30:55','system/app/Views/Docs/AUN-01/');
/*!40000 ALTER TABLE `table_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `table_user_rol`
--

DROP TABLE IF EXISTS `table_user_rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `table_user_rol` (
  `id_usuario_rol` int(11) NOT NULL AUTO_INCREMENT,
  `user_nick` varchar(45) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `table_user_rol`
--

LOCK TABLES `table_user_rol` WRITE;
/*!40000 ALTER TABLE `table_user_rol` DISABLE KEYS */;
INSERT INTO `table_user_rol` VALUES (1,'ADMIN',1);
/*!40000 ALTER TABLE `table_user_rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `v_timeline`
--

DROP TABLE IF EXISTS `v_timeline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `v_timeline` (
  `login` varchar(50) DEFAULT NULL,
  `nombres` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `rol` varchar(45) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `codigo` varchar(45) DEFAULT NULL,
  `fecha` varchar(20) DEFAULT NULL,
  `inicio` varchar(20) DEFAULT NULL,
  `fin` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_timeline`
--

LOCK TABLES `v_timeline` WRITE;
/*!40000 ALTER TABLE `v_timeline` DISABLE KEYS */;
/*!40000 ALTER TABLE `v_timeline` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-21 16:34:07

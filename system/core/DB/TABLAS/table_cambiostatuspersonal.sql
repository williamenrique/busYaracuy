-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         9.0.1 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando estructura para tabla almacen.table_cambiostatuspersonal
DROP TABLE IF EXISTS `table_cambiostatuspersonal`;
CREATE TABLE IF NOT EXISTS `table_cambiostatuspersonal` (
  `id_cambioPersonal` int NOT NULL AUTO_INCREMENT,
  `id_personal` int NOT NULL,
  `idStatus` int DEFAULT NULL,
  `textCambio` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id_cambioPersonal`),
  KEY `fk_table_cambiostatuspersonal_table_personal1_idx` (`id_personal`),
  KEY `fk_table_cambiostatuspersonal_table_user1_idx` (`user_id`),
  CONSTRAINT `fk_table_cambiostatuspersonal_table_personal1` FOREIGN KEY (`id_personal`) REFERENCES `table_personal` (`id_personal`),
  CONSTRAINT `fk_table_cambiostatuspersonal_table_user1` FOREIGN KEY (`user_id`) REFERENCES `table_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- La exportación de datos fue deseleccionada.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
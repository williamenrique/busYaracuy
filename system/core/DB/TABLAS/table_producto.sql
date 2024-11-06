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

-- Volcando estructura para tabla almacen.table_producto
DROP TABLE IF EXISTS `table_producto`;
CREATE TABLE IF NOT EXISTS `table_producto` (
  `id_producto` int NOT NULL AUTO_INCREMENT,
  `id_enlace_producto` int NOT NULL,
  `id_ubicacion` int NOT NULL,
  `producto` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `tag_producto` int DEFAULT NULL,
  `status_producto` int DEFAULT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `fk_table_producto_table_ubicacion1_idx` (`id_ubicacion`),
  KEY `fk_table_producto_table_enlace_producto1_idx` (`id_enlace_producto`),
  CONSTRAINT `fk_table_producto_table_enlace_producto1` FOREIGN KEY (`id_enlace_producto`) REFERENCES `table_enlace_producto` (`id_enlace_producto`),
  CONSTRAINT `fk_table_producto_table_ubicacion1` FOREIGN KEY (`id_ubicacion`) REFERENCES `table_ubicacion` (`id_ubicacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- La exportación de datos fue deseleccionada.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

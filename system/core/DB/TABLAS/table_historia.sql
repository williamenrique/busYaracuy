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

-- Volcando estructura para tabla almacen.table_historia
DROP TABLE IF EXISTS `table_historia`;
CREATE TABLE IF NOT EXISTS `table_historia` (
  `entrada` int DEFAULT NULL,
  `salida` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `fecha` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `obs` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci,
  `id_producto` int NOT NULL,
  `id_proveedor` int NOT NULL,
  `id_usuario` int NOT NULL,
  KEY `fk_historia_producto1_idx` (`id_producto`),
  KEY `fk_historia_proveedor1_idx` (`id_proveedor`),
  KEY `fk_historia_usuario1_idx` (`id_usuario`),
  CONSTRAINT `fk_historia_producto1` FOREIGN KEY (`id_producto`) REFERENCES `table_producto` (`id_producto`),
  CONSTRAINT `fk_historia_proveedor1` FOREIGN KEY (`id_proveedor`) REFERENCES `table_proveedor` (`id_proveedor`),
  CONSTRAINT `fk_historia_usuario1` FOREIGN KEY (`id_usuario`) REFERENCES `table_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- La exportación de datos fue deseleccionada.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

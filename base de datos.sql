-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.25-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para administrativo
CREATE DATABASE IF NOT EXISTS `administrativo` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `administrativo`;

-- Volcando estructura para tabla administrativo.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `idcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla administrativo.articulo
CREATE TABLE IF NOT EXISTS `articulo` (
  `idarticulo` int(11) NOT NULL AUTO_INCREMENT,
  `idcategoria` int(11) NOT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `precio` decimal(18,2) DEFAULT '0.00',
  `impuesto` int(11) DEFAULT NULL,
  `stock` decimal(18,2) NOT NULL DEFAULT '0.00',
  `imagen` varchar(50) DEFAULT NULL,
  `estado` varchar(50) NOT NULL,
  PRIMARY KEY (`idarticulo`),
  KEY `fk_articulo-categoria_idx` (`idcategoria`),
  CONSTRAINT `fk_articulo-categoria` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla administrativo.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(3) DEFAULT NULL,
  `cedula` varchar(50) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla administrativo.compras
CREATE TABLE IF NOT EXISTS `compras` (
  `idcompras` int(11) NOT NULL AUTO_INCREMENT,
  `idconfirmacion` int(11) DEFAULT '0',
  `idproveedor` int(11) DEFAULT '0',
  `nro_factura` varchar(50) DEFAULT '0',
  `nro_control` varchar(50) DEFAULT '0',
  `cantidad` decimal(18,2) DEFAULT '0.00',
  `total_iva` decimal(18,2) DEFAULT '0.00',
  `sub_total` decimal(18,2) DEFAULT '0.00',
  `total` decimal(18,2) DEFAULT '0.00',
  `estado` int(11) DEFAULT '0',
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT '00:00:00',
  PRIMARY KEY (`idcompras`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla administrativo.proveedor
CREATE TABLE IF NOT EXISTS `proveedor` (
  `idproveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `tipo_documento` varchar(50) NOT NULL,
  `num_documento` varchar(50) NOT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idproveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla administrativo.reng_compras
CREATE TABLE IF NOT EXISTS `reng_compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcompras` int(11) DEFAULT NULL,
  `idfactura` int(11) DEFAULT NULL,
  `idarticulo` int(11) DEFAULT NULL,
  `cantidad` decimal(18,2) DEFAULT NULL,
  `precio` decimal(18,2) DEFAULT NULL,
  `alicuota` decimal(18,2) DEFAULT NULL,
  `iva` decimal(18,2) DEFAULT NULL,
  `total_iva` decimal(18,2) DEFAULT NULL,
  `sub_total` decimal(18,2) DEFAULT NULL,
  `total` decimal(18,2) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_reng_compras_articulo` (`idarticulo`),
  KEY `FK_reng_compras_compras` (`idcompras`),
  CONSTRAINT `FK_reng_compras_articulo` FOREIGN KEY (`idarticulo`) REFERENCES `articulo` (`idarticulo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla administrativo.reng_ventas
CREATE TABLE IF NOT EXISTS `reng_ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idventas` int(11) DEFAULT NULL,
  `idfactura` int(11) DEFAULT NULL,
  `idarticulo` int(11) DEFAULT NULL,
  `cantidad` decimal(18,2) DEFAULT NULL,
  `precio` decimal(18,2) DEFAULT NULL,
  `alicuota` decimal(18,2) DEFAULT NULL,
  `iva` decimal(18,2) DEFAULT NULL,
  `total_iva` decimal(18,2) DEFAULT NULL,
  `sub_total` decimal(18,2) DEFAULT NULL,
  `total` decimal(18,2) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_reng_ventas_articulo` (`idarticulo`),
  CONSTRAINT `FK_reng_ventas_articulo` FOREIGN KEY (`idarticulo`) REFERENCES `articulo` (`idarticulo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla administrativo.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(30) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(42) DEFAULT NULL,
  `rol` int(11) NOT NULL,
  `condicion` tinyint(4) NOT NULL,
  `fecha_creado` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla administrativo.ventas
CREATE TABLE IF NOT EXISTS `ventas` (
  `idventa` int(11) NOT NULL AUTO_INCREMENT,
  `idconfirmacion` int(11) DEFAULT NULL,
  `idcliente` int(11) DEFAULT NULL,
  `tipo_comprobante` varchar(50) DEFAULT NULL,
  `serie_comprobante` varchar(50) DEFAULT NULL,
  `num_comprobante` varchar(50) DEFAULT NULL,
  `cantidad` decimal(18,5) DEFAULT NULL,
  `total_iva` decimal(18,5) DEFAULT NULL,
  `sub_total` decimal(18,5) DEFAULT NULL,
  `total` decimal(18,5) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `hora` time DEFAULT NULL,
  PRIMARY KEY (`idventa`),
  KEY `fk_venta_cliente_idx` (`idcliente`),
  CONSTRAINT `fk_venta_cliente` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- La exportación de datos fue deseleccionada.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.25-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando datos para la tabla administrativo.usuario: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`, `nombres`, `email`, `password`, `rol`, `condicion`, `fecha_creado`) VALUES
	(4, 'JOHAN MARIO FERREIRA FERNANDEZ', 'JOHAN.FERREIRA.JF@GMAIL.COM', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 0, 1, '2018-11-09');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

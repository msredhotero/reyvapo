-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 26-12-2017 a las 20:45:27
-- Versión del servidor: 5.5.20
-- Versión de PHP: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `garantia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbgarantia`
--

CREATE TABLE IF NOT EXISTS `dbgarantia` (
  `idgarantia` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `reflocales` int(11) NOT NULL,
  `refproductos` int(11) NOT NULL,
  `email` varchar(130) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecharegistro` date DEFAULT NULL,
  `fechacompra` date DEFAULT NULL,
  `observaciones` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idgarantia`),
  KEY `fk_garantia_locales_idx` (`reflocales`),
  KEY `fk_garantia_productos_idx` (`refproductos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbproductos`
--

CREATE TABLE IF NOT EXISTS `dbproductos` (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `codigo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `marca` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `modelo` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idproducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `dbproductos`
--

INSERT INTO `dbproductos` (`idproducto`, `nombre`, `codigo`, `marca`, `modelo`) VALUES
(1, 'REYVAPO PEN', 'rv00012', 'EVOD', 'rv3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dbusuarios`
--

CREATE TABLE IF NOT EXISTS `dbusuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `refroles` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nombrecompleto` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idusuario`),
  KEY `fk_dbusuarios_tbroles1_idx` (`refroles`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `dbusuarios`
--

INSERT INTO `dbusuarios` (`idusuario`, `usuario`, `password`, `refroles`, `email`, `nombrecompleto`) VALUES
(1, 'marcos', 'marcos', 1, 'msredhotero@msn.com', 'Saupurein Marcos'),
(2, 'gaston', 'gaston', 1, 'gaston@msn.com', 'Gasty');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `predio_menu`
--

CREATE TABLE IF NOT EXISTS `predio_menu` (
  `idmenu` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `icono` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `Orden` smallint(6) DEFAULT NULL,
  `hover` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `permiso` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idmenu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `predio_menu`
--

INSERT INTO `predio_menu` (`idmenu`, `url`, `icono`, `nombre`, `Orden`, `hover`, `permiso`) VALUES
(1, '../index.php', 'icodashboard', 'Dashboard', 0, NULL, 'Administrador'),
(8, '../logout.php', 'icosalir', 'Salir', 30, NULL, 'Administrador'),
(16, '../usuarios/', 'icojugadores', 'Usuarios', 13, NULL, 'Administrador'),
(26, '../productos/', 'icoventas', 'Productos', 1, NULL, 'Administrador'),
(27, '../locales/', 'icolocalizacion', 'Locales', 2, NULL, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblocales`
--

CREATE TABLE IF NOT EXISTS `tblocales` (
  `idlocal` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `codigo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `domicilio` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `localidad` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `contacto` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `observaciones` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idlocal`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tblocales`
--

INSERT INTO `tblocales` (`idlocal`, `nombre`, `codigo`, `domicilio`, `localidad`, `contacto`, `observaciones`) VALUES
(1, 'Puesto Uno', 'rv12', '36 e/121 y 122', 'Capital Federal', '', 'Local para visita al publico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbroles`
--

CREATE TABLE IF NOT EXISTS `tbroles` (
  `idrol` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  `activo` bit(1) NOT NULL,
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbroles`
--

INSERT INTO `tbroles` (`idrol`, `descripcion`, `activo`) VALUES
(1, 'Administrador', b'1');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `dbgarantia`
--
ALTER TABLE `dbgarantia`
  ADD CONSTRAINT `fk_garantia_locales` FOREIGN KEY (`reflocales`) REFERENCES `tblocales` (`idlocal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_garantia_productos` FOREIGN KEY (`refproductos`) REFERENCES `dbproductos` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

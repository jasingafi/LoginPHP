-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 07-04-2017 a las 02:33:43
-- Versión del servidor: 5.6.34
-- Versión de PHP: 5.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `sistemaalumnos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE IF NOT EXISTS `alumnos` (
  `IdAlumnos` int(11) NOT NULL AUTO_INCREMENT,
  `Identidad` varchar(20) NOT NULL,
  `Nombre` varchar(70) NOT NULL,
  `Telefono` varchar(15) NOT NULL,
  `Correo` varchar(30) NOT NULL,
  PRIMARY KEY (`IdAlumnos`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`IdAlumnos`, `Identidad`, `Nombre`, `Telefono`, `Correo`) VALUES
(2, '1519199000751', 'Jairo S. Galeas', '88477528', 'jairogaleas@gmail.com'),
(3, '150319', 'Sury Acosta', '9999-8888', 'sury@gmail.com'),
(6, '12', 'au', '22', 'au@yahoo.com'),
(8, '1503', 'Franklin Guillen', '2799', 'francklin@guillen.org');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE IF NOT EXISTS `materias` (
  `idmateria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_materia` varchar(30) NOT NULL,
  `unidades` int(20) NOT NULL,
  `idusuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`idmateria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`idmateria`, `nombre_materia`, `unidades`, `idusuario`) VALUES
(7, 'Español', 90, 5),
(8, 'Matematicas', 90, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `idTipousuario` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(20) NOT NULL,
  PRIMARY KEY (`idTipousuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`idTipousuario`, `tipo`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuarios` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_tipousuario` int(11) NOT NULL,
  PRIMARY KEY (`idusuarios`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuarios`, `usuario`, `password`, `id_alumno`, `id_tipousuario`) VALUES
(2, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 2, 1),
(5, 'alumna', 'e1ecf830176d162db2a0151f09e1993c888e86fa', 3, 2),
(10, 'franklin', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 8, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

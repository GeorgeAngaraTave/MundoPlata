-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-06-2016 a las 10:14:34
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `mundoplata`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cumplimientos_efectividad`
--

CREATE TABLE IF NOT EXISTS `cumplimientos_efectividad` (
  `tipo` varchar(30) NOT NULL,
  `id` int(11) NOT NULL,
  `minimo` decimal(10,0) NOT NULL,
  `maximo` decimal(11,0) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cumplimientos_efectividad`
--

INSERT INTO `cumplimientos_efectividad` (`tipo`, `id`, `minimo`, `maximo`) VALUES
('Efectividad A', 1, '96', '100'),
('Efectividad B', 2, '91', '95'),
('Efectividad C', 3, '85', '90');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cumplimientos_efectividad`
--
ALTER TABLE `cumplimientos_efectividad`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cumplimientos_efectividad`
--
ALTER TABLE `cumplimientos_efectividad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

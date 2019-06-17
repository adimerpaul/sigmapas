-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-06-2019 a las 00:04:12
-- Versión del servidor: 10.1.40-MariaDB
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sig`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colegio`
--

CREATE TABLE `colegio` (
  `idcolegio` int(11) NOT NULL,
  `nombre` varchar(55) NOT NULL,
  `lat` float NOT NULL,
  `long` float NOT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'ACTIVO',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `colegio`
--

INSERT INTO `colegio` (`idcolegio`, `nombre`, `lat`, `long`, `estado`, `created`, `idusuario`) VALUES
(5, 'Colegio Nacional Bolivia', -17.9804, -67.1166, 'ACTIVO', '2019-06-17 20:31:29', 1),
(6, 'Escuela Carlos Beltrán Morales', -17.9864, -67.1257, 'ACTIVO', '2019-06-17 20:38:44', 1),
(7, 'Colegio Naciones unidas', -17.981, -67.1194, 'ACTIVO', '2019-06-17 21:09:34', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `minibus`
--

CREATE TABLE `minibus` (
  `idminibus` int(11) NOT NULL,
  `nombre` varchar(55) NOT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'ACTIVO',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idusuario` int(11) NOT NULL,
  `color` varchar(50) NOT NULL,
  `orientacion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `minibus`
--

INSERT INTO `minibus` (`idminibus`, `nombre`, `estado`, `created`, `idusuario`, `color`, `orientacion`) VALUES
(1, '101', 'ACTIVO', '2019-06-13 00:30:44', 1, '#ff00ff', ''),
(4, '19', 'ACTIVO', '2019-06-17 21:54:34', 1, '#008040', ''),
(5, '2', 'ACTIVO', '2019-06-17 21:55:38', 1, '#000000', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntos`
--

CREATE TABLE `puntos` (
  `idpunto` int(11) NOT NULL,
  `lat` float NOT NULL,
  `long` float NOT NULL,
  `idminibus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `puntos`
--

INSERT INTO `puntos` (`idpunto`, `lat`, `long`, `idminibus`) VALUES
(1, -17.9647, -67.106, 1),
(2, -17.97, -67.106, 1),
(3, -17.9903, -67.132, 4),
(4, -17.989, -67.1258, 4),
(5, -17.9895, -67.1121, 4),
(6, -17.9862, -67.0963, 4),
(7, -17.9746, -67.0916, 4),
(8, -18.0095, -67.1361, 5),
(9, -18.0057, -67.136, 5),
(10, -17.9916, -67.1381, 5),
(11, -17.987, -67.134, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `user` varchar(35) NOT NULL,
  `password` varchar(35) NOT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'ACTIVO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `user`, `password`, `estado`) VALUES
(1, 'admin', 'admin', 'ACTIVO');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `colegio`
--
ALTER TABLE `colegio`
  ADD PRIMARY KEY (`idcolegio`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `minibus`
--
ALTER TABLE `minibus`
  ADD PRIMARY KEY (`idminibus`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `puntos`
--
ALTER TABLE `puntos`
  ADD PRIMARY KEY (`idpunto`),
  ADD KEY `puntos_ibfk_1` (`idminibus`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `colegio`
--
ALTER TABLE `colegio`
  MODIFY `idcolegio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `minibus`
--
ALTER TABLE `minibus`
  MODIFY `idminibus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `puntos`
--
ALTER TABLE `puntos`
  MODIFY `idpunto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `colegio`
--
ALTER TABLE `colegio`
  ADD CONSTRAINT `colegio_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `minibus`
--
ALTER TABLE `minibus`
  ADD CONSTRAINT `minibus_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `puntos`
--
ALTER TABLE `puntos`
  ADD CONSTRAINT `puntos_ibfk_1` FOREIGN KEY (`idminibus`) REFERENCES `minibus` (`idminibus`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

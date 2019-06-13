-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-06-2019 a las 03:08:59
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
(1, 'COLEGIO NACINAL BOLVIA', -17.9647, -67.106, 'ACTIVO', '2019-06-12 23:59:08', 1),
(2, 'ESCUELA CARMELA CERRUTO', -17.96, -67.106, 'ACTIVO', '2019-06-12 23:59:08', 1);

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
  `color` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `minibus`
--

INSERT INTO `minibus` (`idminibus`, `nombre`, `estado`, `created`, `idusuario`, `color`) VALUES
(1, '101', 'ACTIVO', '2019-06-13 00:30:44', 1, '#ff00ff');

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
(2, -17.97, -67.106, 1);

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
  MODIFY `idcolegio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `minibus`
--
ALTER TABLE `minibus`
  MODIFY `idminibus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `puntos`
--
ALTER TABLE `puntos`
  MODIFY `idpunto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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

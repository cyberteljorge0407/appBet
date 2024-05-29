-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-05-2024 a las 18:36:14
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbet`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbank`
--

CREATE TABLE `tbank` (
  `idBank` tinyint(2) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbank`
--

INSERT INTO `tbank` (`idBank`, `name`) VALUES
(1, 'INTERBANK'),
(2, 'SCOTIABANK'),
(3, 'BCP'),
(4, 'CONTINENTAL'),
(5, 'BANCO PICHINCHA'),
(6, 'BANCO DE LA NACION');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tplayer`
--

CREATE TABLE `tplayer` (
  `idPlayer` int(10) NOT NULL,
  `names` varchar(70) NOT NULL,
  `surnames` varchar(70) NOT NULL,
  `numDocumento` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `PlayerID` varchar(10) DEFAULT NULL,
  `saldo` decimal(10,2) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `dateRegister` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tplayer`
--

INSERT INTO `tplayer` (`idPlayer`, `names`, `surnames`, `numDocumento`, `email`, `password`, `PlayerID`, `saldo`, `status`, `dateRegister`) VALUES
(1, 'Andres ', 'Calderon Calderon', '76767654', 'cyberteljorge04071995@gmail.com', '12345', '123456789', '231.00', 1, '2024-05-27 21:11:31'),
(2, 'Juan', 'Valera Robles', '76767789', 'juan@gmail.com', '123', '1122334455', '93.00', 1, '2024-05-28 18:49:50'),
(3, 'juan', 'vilchez ', '33443322', 'andres@gmail.com', '123', '1111111111', '5.00', 1, '2024-05-29 11:00:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trecharge`
--

CREATE TABLE `trecharge` (
  `idCharge` int(10) NOT NULL,
  `idPlayer` int(10) NOT NULL,
  `idTypeComunication` tinyint(1) DEFAULT NULL,
  `idUser` int(10) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `vaucher` varchar(30) NOT NULL,
  `fechaVaucher` varchar(20) DEFAULT NULL,
  `horaVaucher` varchar(10) DEFAULT NULL,
  `idBank` tinyint(2) NOT NULL,
  `saldoActual` decimal(10,2) DEFAULT 0.00,
  `actual` tinyint(1) DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `dateRegister` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `trecharge`
--

INSERT INTO `trecharge` (`idCharge`, `idPlayer`, `idTypeComunication`, `idUser`, `monto`, `vaucher`, `fechaVaucher`, `horaVaucher`, `idBank`, `saldoActual`, `actual`, `status`, `dateRegister`) VALUES
(3, 1, 1, 1, '10.00', 'imagen', '2024-10-10', '10', 1, '10.00', 0, 1, '2024-05-28 12:42:22'),
(5, 1, 1, 1, '20.00', 'imagen', '2024-10-10', '20', 1, '30.00', 0, 1, '2024-05-28 13:18:30'),
(6, 1, 1, 1, '0.50', 'VAUCHER28132129.png', '2024-28-05', '13', 3, '30.50', 0, 1, '2024-05-28 13:21:29'),
(7, 1, 1, 1, '4.50', 'VAUCHER28132508.jpeg', '2024-28-05', '10', 1, '35.00', 0, 1, '2024-05-28 13:25:08'),
(10, 1, 1, 1, '80.00', 'VAUCHER28145009.png', '2024-28-05', '12', 2, '115.00', 0, 1, '2024-05-28 14:50:09'),
(11, 1, 1, 1, '50.00', 'VAUCHER28145214.png', '2024-28-05', '15', 1, '165.00', 0, 1, '2024-05-28 14:52:14'),
(12, 1, 1, 1, '20.00', 'VAUCHER28145319.png', '2024-28-05', '14:53', 2, '185.00', 0, 1, '2024-05-28 14:53:19'),
(13, 1, 2, 1, '12.00', 'VAUCHER28183300.png', '2024-28-05', '18:32', 1, '197.00', 0, 1, '2024-05-28 18:33:00'),
(14, 2, 3, 1, '10.00', 'VAUCHER28185027.jpg', '2024-28-05', '18:50', 1, '10.00', 0, 1, '2024-05-28 18:50:27'),
(15, 2, 2, 1, '50.00', 'VAUCHER28185322.png', '2024-28-05', '18:53', 1, '60.00', 0, 1, '2024-05-28 18:53:22'),
(16, 2, 1, 1, '33.00', 'VAUCHER28190847.png', '2024-28-05', '19:08', 2, '93.00', 1, 1, '2024-05-28 19:08:47'),
(17, 1, 2, 1, '34.00', 'VAUCHER28190938.png', '2024-28-05', '19:09', 2, '231.00', 1, 1, '2024-05-28 19:09:38'),
(18, 3, 1, 1, '5.00', 'VAUCHER29110114.png', '2024-29-05', '11:01', 2, '5.00', 1, 1, '2024-05-29 11:01:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ttypecommunication`
--

CREATE TABLE `ttypecommunication` (
  `idTypeComunication` tinyint(1) NOT NULL,
  `name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ttypecommunication`
--

INSERT INTO `ttypecommunication` (`idTypeComunication`, `name`) VALUES
(1, 'Whatsapp'),
(2, 'FB Messenger'),
(3, 'Telegram');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ttypeuser`
--

CREATE TABLE `ttypeuser` (
  `idTypeUser` tinyint(2) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ttypeuser`
--

INSERT INTO `ttypeuser` (`idTypeUser`, `name`) VALUES
(1, 'Asesor'),
(2, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tusuarios`
--

CREATE TABLE `tusuarios` (
  `idUser` int(10) NOT NULL,
  `names` varchar(70) NOT NULL,
  `surnames` varchar(70) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(20) NOT NULL,
  `numDocument` varchar(20) NOT NULL,
  `idTypeUser` tinyint(2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `dateRegister` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tusuarios`
--

INSERT INTO `tusuarios` (`idUser`, `names`, `surnames`, `email`, `password`, `numDocument`, `idTypeUser`, `status`, `dateRegister`) VALUES
(1, 'Kevin', 'Vilchez Giron', 'kevin_1_95@hotmail.com', '123', '76454564', 1, 1, '2024-05-27 20:26:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbank`
--
ALTER TABLE `tbank`
  ADD PRIMARY KEY (`idBank`);

--
-- Indices de la tabla `tplayer`
--
ALTER TABLE `tplayer`
  ADD PRIMARY KEY (`idPlayer`);

--
-- Indices de la tabla `trecharge`
--
ALTER TABLE `trecharge`
  ADD PRIMARY KEY (`idCharge`),
  ADD KEY `idPlayer` (`idPlayer`),
  ADD KEY `idBank` (`idBank`),
  ADD KEY `idTypeComunication` (`idTypeComunication`),
  ADD KEY `idUser` (`idUser`);

--
-- Indices de la tabla `ttypecommunication`
--
ALTER TABLE `ttypecommunication`
  ADD PRIMARY KEY (`idTypeComunication`);

--
-- Indices de la tabla `ttypeuser`
--
ALTER TABLE `ttypeuser`
  ADD PRIMARY KEY (`idTypeUser`);

--
-- Indices de la tabla `tusuarios`
--
ALTER TABLE `tusuarios`
  ADD PRIMARY KEY (`idUser`),
  ADD KEY `idTypeUser` (`idTypeUser`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbank`
--
ALTER TABLE `tbank`
  MODIFY `idBank` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tplayer`
--
ALTER TABLE `tplayer`
  MODIFY `idPlayer` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `trecharge`
--
ALTER TABLE `trecharge`
  MODIFY `idCharge` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `ttypecommunication`
--
ALTER TABLE `ttypecommunication`
  MODIFY `idTypeComunication` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ttypeuser`
--
ALTER TABLE `ttypeuser`
  MODIFY `idTypeUser` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tusuarios`
--
ALTER TABLE `tusuarios`
  MODIFY `idUser` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `trecharge`
--
ALTER TABLE `trecharge`
  ADD CONSTRAINT `trecharge_ibfk_1` FOREIGN KEY (`idBank`) REFERENCES `tbank` (`idBank`),
  ADD CONSTRAINT `trecharge_ibfk_2` FOREIGN KEY (`idPlayer`) REFERENCES `tplayer` (`idPlayer`),
  ADD CONSTRAINT `trecharge_ibfk_3` FOREIGN KEY (`idTypeComunication`) REFERENCES `ttypecommunication` (`idTypeComunication`),
  ADD CONSTRAINT `trecharge_ibfk_4` FOREIGN KEY (`idUser`) REFERENCES `tusuarios` (`idUser`);

--
-- Filtros para la tabla `tusuarios`
--
ALTER TABLE `tusuarios`
  ADD CONSTRAINT `tusuarios_ibfk_1` FOREIGN KEY (`idTypeUser`) REFERENCES `ttypeuser` (`idTypeUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

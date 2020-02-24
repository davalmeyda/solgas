-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-02-2020 a las 23:07:02
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdbalon`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cli` int(11) NOT NULL,
  `nombres_cli` varchar(100) NOT NULL,
  `tipdoc_cli` int(1) NOT NULL,
  `numdoc_cli` varchar(11) NOT NULL,
  `telefono_cli` bigint(11) NOT NULL,
  `direccion_cli` varchar(300) NOT NULL,
  `referencia_cli` varchar(50) NOT NULL,
  `correo_cli` varchar(50) NOT NULL,
  `usuario_cli` varchar(50) NOT NULL,
  `clave_cli` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cli`, `nombres_cli`, `tipdoc_cli`, `numdoc_cli`, `telefono_cli`, `direccion_cli`, `referencia_cli`, `correo_cli`, `usuario_cli`, `clave_cli`) VALUES
(2, 'oscar alberto saibay espinoza', 6, '10462309908', 0, 'av cesar canevaro, 13 de octubre, mz H lt 17 Lima-Lima-San Juan de Miraflores', '', 'osaibay@brufat.com', '', ''),
(3, 'Manuel Fernandez', 6, '10446078661', 0, 'av victor larco herrera, 1004, mz H lt 17 La liberta -Trujillo', '', 'kiramapers@gmail.com', '', ''),
(4, 'Jesús Johan Rufino Saire', 1, '72715987', 0, 'Av algarrobos', '', 'lll.yisus.lll@gmail.com', '', '123'),
(6, 'SARAGON SESTINO', 6, '45987514241', 987548124, 'Lima', 'Mega Ofertus', 'SARAGON_SESTINO@gmail.com', '', ''),
(7, 'Nelly Alquizar Landa', 1, '18039657', 948458294, 'Calle Las Orquídeas 257, California, Victor Larco Herrera', 'A dos cuadras del Parque Grande', 'nellyalquizar@hotmail.com', '', ''),
(8, 'Alvaro Alcantara', 1, '19571700', 914457737, 'Pachacutec 143 ', 'Manuel Soane', 'golegalsac@gmail.com', '', ''),
(9, 'ROMA', 1, '15487985', 965487541, 'Lima', 'Macro', 'roma@gmail.com', '', '1234'),
(10, 'Cliente Prueba 01', 1, '46987984', 879877845, '12345978', 'Macro', 'cliente_prueba_01@gmail.com', '', 'solgas1582217289'),
(11, 'Cliente Prueba 02', 1, '25146546', 987485754, 'Lima', 'Lima', 'cliente_prueba_02@gmail.com', '', 'solgas1582217465');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cli`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

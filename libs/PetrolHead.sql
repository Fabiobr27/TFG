-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: db5000537205.hosting-data.io
-- Tiempo de generación: 11-06-2020 a las 00:07:51
-- Versión del servidor: 5.7.30-log
-- Versión de PHP: 7.0.33-0+deb9u7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbs515838`
--
CREATE DATABASE IF NOT EXISTS `dbs515838` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `dbs515838`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncio`
--

CREATE TABLE `anuncio` (
  `IdAnuncio` int(11) NOT NULL,
  `Marca` varchar(255) NOT NULL,
  `Modelo` varchar(255) DEFAULT NULL,
  `color` varchar(100) DEFAULT NULL,
  `Anio` int(11) DEFAULT NULL,
  `Kilometros` int(11) DEFAULT NULL,
  `Imagen` varchar(255) DEFAULT NULL,
  `Precio` float DEFAULT '0',
  `Telefono` int(11) DEFAULT NULL,
  `Cabecera` varchar(255) NOT NULL,
  `Descripcion` varchar(255) DEFAULT NULL,
  `IdUsu` int(11) DEFAULT NULL,
  `Combustible` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `anuncio`
--

INSERT INTO `anuncio` (`IdAnuncio`, `Marca`, `Modelo`, `color`, `Anio`, `Kilometros`, `Imagen`, `Precio`, `Telefono`, `Cabecera`, `Descripcion`, `IdUsu`, `Combustible`) VALUES
(1, 'Audi', 'A3', 'Blanco', 2018, 50000, 'https://www.mavenehijos.com/img/vehiculo-435651/maven-e-hijos-sportback-2-0-tdi-140cv-ambition-14979636.jpg', 12000, 666123456, 'Se Vende Audi A3', 'se vende coche en perfecto estado , siempre en cochera nunca en circuito', 10, 'Gasolina'),
(3, 'Citroen', 'Berlingo', 'Gris', 1995, 2000000, 'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQGdfHhckFZq0FQW3kBH-nNw39b41paplVMdro-3t6p7JU3IPOY&usqp=CAU', 12000, 12345, 'Citroen Berlingo nueva', 'Adios', 10, 'Gasolina'),
(4, 'BMW', 'M4 GTS', 'Negro', 2019, 5000, 'https://www.km77.com/media/fotos/bmw_serie_4_2013_gts_5796_1.jpg', 50000, 123456, 'Mucho mptro poco piloito', 'Se vende BMW M4 GTS con 450 caballos , se vende por que fue un capricho y no lo puedo mantener', 10, 'Gasolina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `idCom` int(11) NOT NULL,
  `codigoMod` int(11) NOT NULL,
  `idUsu` int(11) NOT NULL,
  `texto` text NOT NULL,
  `fecha` date NOT NULL,
  `positivos` int(11) NOT NULL DEFAULT '0',
  `negativos` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especificaciones`
--

CREATE TABLE `especificaciones` (
  `CodEspe` int(11) NOT NULL,
  `Caballos` int(11) NOT NULL,
  `Año` int(11) NOT NULL,
  `CodigoMod` int(11) NOT NULL,
  `Combustible` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `especificaciones`
--

INSERT INTO `especificaciones` (`CodEspe`, `Caballos`, `Año`, `CodigoMod`, `Combustible`) VALUES
(1, 145, 2019, 1, 'Gasolina'),
(2, 150, 2019, 11, 'Gasolina'),
(3, 639, 2018, 13, 'Gasolina'),
(4, 450, 2019, 21, 'Gasolina'),
(5, 500, 2017, 39, 'Gasolina'),
(6, 432, 2018, 45, 'Gasolina'),
(7, 105, 2015, 48, 'Gasolina'),
(8, 90, 2017, 56, 'Diesel'),
(9, 560, 2016, 63, 'Gasolina'),
(10, 69, 2016, 68, 'Diesel'),
(11, 460, 2018, 71, 'Gasolina'),
(12, 182, 2014, 76, 'Gasolina'),
(13, 275, 2017, 81, 'Gasolina'),
(14, 300, 2016, 87, 'Gasolina'),
(15, 110, 2014, 95, 'Diesel'),
(16, 700, 2013, 100, 'Gasolina'),
(17, 405, 2016, 104, 'Gasolina'),
(18, 132, 2010, 108, 'Diesel'),
(19, 150, 2019, 113, 'Diesel'),
(20, 570, 2020, 120, 'Gasolina'),
(21, 110, 2013, 123, 'Diesel'),
(22, 263, 2018, 131, 'Gasolina'),
(23, 450, 2017, 133, 'Gasolina'),
(24, 300, 2014, 139, 'Gasolina'),
(25, 150, 2017, 144, 'Diesel'),
(26, 200, 2018, 159, 'Gasolina'),
(27, 350, 1995, 161, 'Gasolina'),
(28, 150, 2018, 167, 'Diesel'),
(29, 110, 2014, 2, 'Diesel'),
(30, 200, 2016, 3, 'Gasolina'),
(31, 180, 2014, 4, 'Gasolina'),
(32, 125, 1995, 5, 'Gasolina'),
(34, 140, 2016, 8, 'Gasolina'),
(35, 167, 2005, 7, 'Gasolina'),
(37, 185, 2008, 10, 'Gasolina'),
(38, 105, 1985, 12, 'Gasolina'),
(41, 500, 2019, 14, 'Gasolina'),
(42, 477, 2018, 15, 'Gasolina'),
(44, 150, 2016, 20, 'Diesel'),
(45, 95, 2014, 29, 'Gasolina'),
(46, 150, 2016, 20, 'Diesel'),
(47, 167, 2017, 16, 'Diesel'),
(48, 130, 2016, 26, 'Diesel'),
(49, 150, 2015, 24, 'Diesel'),
(50, 620, 2018, 25, 'Gasolina'),
(51, 510, 2017, 30, 'Gasolina'),
(52, 450, 2014, 28, 'Gasolina'),
(53, 600, 2018, 23, 'Gasolina'),
(54, 450, 2018, 17, 'Gasolina'),
(55, 470, 2017, 31, 'Gasolina'),
(56, 571, 2019, 19, 'Gasolina'),
(57, 354, 2019, 32, 'Diesel'),
(58, 340, 2014, 27, 'Gasolina'),
(59, 310, 2017, 34, 'Gasolina'),
(60, 450, 2017, 40, 'Gasolina'),
(61, 140, 2016, 38, 'Diesel'),
(62, 265, 2018, 33, 'Diesel'),
(63, 116, 2016, 41, 'Diesel'),
(64, 150, 2017, 37, 'Diesel'),
(65, 340, 2018, 36, 'Gasolina'),
(66, 200, 2016, 35, 'Gasolina'),
(67, 466, 2016, 42, 'Gasolina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hilo`
--

CREATE TABLE `hilo` (
  `idHilo` int(11) NOT NULL,
  `idUsu` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `texto` text NOT NULL,
  `fecha` date NOT NULL,
  `positivos` int(11) NOT NULL DEFAULT '0',
  `negativos` int(11) NOT NULL DEFAULT '0',
  `estado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `hilo`
--

INSERT INTO `hilo` (`idHilo`, `idUsu`, `titulo`, `texto`, `fecha`, `positivos`, `negativos`, `estado`) VALUES
(1, 10, '¿Que os parece el nuevo audi a3?', 'A mi sinceramente me gusta mucho , ¿Que opinais ustedes?', '2020-06-03', 0, 0, 0),
(2, 10, 'Tengo un problema con mi coche', 'Cada dia que hace mucho frio a mi coche le cuesta arrancar , ¿Que puede ser? Gracias', '0000-00-00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `IdImagen` int(11) NOT NULL,
  `IdAnuncio` int(11) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `NombreMarca` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `CodigoMarca` int(11) NOT NULL,
  `AñoFundacion` int(11) NOT NULL DEFAULT '1900',
  `logo` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`NombreMarca`, `CodigoMarca`, `AñoFundacion`, `logo`) VALUES
('Abarth', 1, 1900, 'Imagenes/Logos/Abarth.png\r\n'),
('Alfa Romeo', 2, 1900, 'Imagenes/Logos/alfaromeo.jpg'),
('Aston Martin', 3, 1900, 'Imagenes/Logos/astonmartin.png'),
('Audi', 4, 1900, 'Imagenes/Logos/audi.jpg'),
('Bmw', 5, 1900, 'Imagenes/Logos/bmw.jpg'),
('Chevrolet', 6, 1900, 'Imagenes/Logos/chevrolet.jpg'),
('Citroen', 7, 1900, 'Imagenes/Logos/citroen.jpg'),
('Dacia', 9, 1900, 'Imagenes/Logos/dacia.jpg'),
('Ferrari', 10, 1900, 'Imagenes/Logos/ferrari.jpg'),
('Fiat', 11, 1900, '	\r\nImagenes/Logos/fiat.jpg'),
('Ford', 12, 1900, 'Imagenes/Logos/ford.jpg'),
('Honda', 13, 1900, 'Imagenes/Logos/honda.png'),
('Hyundai', 14, 1900, 'Imagenes/Logos/hyundai.png'),
('Jaguar', 15, 1900, 'Imagenes/Logos/jaguar.png'),
('Kia', 16, 1900, 'Imagenes/Logos/kia.png'),
('Lamborghini', 17, 1900, 'Imagenes/Logos/lamborghini.png'),
('Maserati', 18, 1900, 'Imagenes/Logos/maserati.jpg'),
('Mazda', 19, 1900, 'Imagenes/Logos/mazda.jpg'),
('Mercedes-benz', 20, 1900, '	\r\nImagenes/Logos/mercedes.jpg'),
('Nissan', 21, 1900, 'Imagenes/Logos/nissan.jpg'),
('Opel', 22, 1900, 'Imagenes/Logos/opel.png'),
('Peugeot', 23, 1900, 'Imagenes/Logos/peugeot.png'),
('Porsche', 24, 1900, 'Imagenes/Logos/porsche.jpg'),
('Renault', 25, 1900, '	\r\nImagenes/Logos/renault.jpg'),
('Seat', 26, 1900, 'Imagenes/Logos/seat.jpg'),
('Skoda', 27, 1900, 'Imagenes/Logos/skoda.png'),
('Subaru', 28, 1900, 'Imagenes/Logos/subaru.jpg'),
('Toyota', 29, 1900, 'Imagenes/Logos/toyota.jpg'),
('Volkswagen', 30, 1900, 'Imagenes/Logos/volkswagen.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelo`
--

CREATE TABLE `modelo` (
  `NombreMod` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `CodigoMod` int(11) NOT NULL,
  `CodigoMarca` int(11) NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `favorito` tinyint(1) NOT NULL DEFAULT '0',
  `positivos` int(11) NOT NULL DEFAULT '0',
  `negativos` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `modelo`
--

INSERT INTO `modelo` (`NombreMod`, `CodigoMod`, `CodigoMarca`, `imagen`, `favorito`, `positivos`, `negativos`) VALUES
('595', 1, 1, 'Imagenes/Modelos/Abarth/595.jpg', 1, 0, 0),
('Grande Punto', 2, 1, '	\r\nImagenes/Modelos/Abarth/grandePunto.jpg', 0, 0, 0),
('124 Spider', 3, 1, '	\r\nImagenes/Modelos/Abarth/124spider.jpg', 0, 0, 0),
('695', 4, 1, '	\r\nImagenes/Modelos/Abarth/695.jpg', 0, 0, 0),
('155', 5, 2, 'Imagenes/Modelos/Alfa Romeo/155.jpg', 0, 0, 0),
('Spider', 7, 2, '	\r\nImagenes/Modelos/Alfa Romeo/c4Spider.jpg', 0, 0, 0),
('Gt', 8, 2, 'Imagenes/Modelos/Alfa Romeo/gt.jpg', 0, 0, 0),
('Brera', 10, 2, 'Imagenes/Modelos/Alfa Romeo/brera.jpg', 0, 0, 0),
('Giulietta', 11, 2, 'Imagenes/Modelos/Alfa Romeo/gullietta.jpg', 1, 0, 0),
('Sprint', 12, 2, 'Imagenes/Modelos/Alfa Romeo/sprint.jpg', 0, 0, 0),
('DB11', 13, 3, 'Imagenes/Modelos/Aston Martin/db11.jpg', 1, 0, 0),
('DBX', 14, 3, 'Imagenes/Modelos/Aston Martin/DBX.jpg', 0, 0, 0),
('Rapide', 15, 3, 'Imagenes/Modelos/Aston Martin/rapide.jpg', 0, 0, 0),
('A4', 16, 4, 'Imagenes/Modelos/Audi/a4.jpg', 0, 0, 0),
('S6', 17, 4, 'Imagenes/Modelos/Audi/s6.jpg', 0, 0, 0),
('S8', 19, 4, 'Imagenes/Modelos/Audi/s8.jpg', 0, 0, 0),
('A3', 20, 4, 'Imagenes/Modelos/Audi/a3.jpg', 0, 0, 0),
('Rs4', 21, 4, 'Imagenes/Modelos/Audi/rs4.jpg', 0, 0, 0),
('Rs6', 23, 4, 'Imagenes/Modelos/Audi/rs6.jpg', 0, 0, 0),
('Q7', 24, 4, 'Imagenes/Modelos/Audi/q7.jpg', 0, 0, 0),
('R8', 25, 4, 'Imagenes/Modelos/Audi/r8.jpg', 0, 0, 0),
('Q3', 26, 4, 'Imagenes/Modelos/Audi/q3.jpg', 0, 0, 0),
('Tt Rs', 27, 4, 'Imagenes/Modelos/Audi/ttrs.jpg', 0, 0, 0),
('Rs5', 28, 4, 'Imagenes/Modelos/Audi/rs5.jpg', 0, 0, 0),
('A1', 29, 4, 'Imagenes/Modelos/Audi/a1.jpg', 0, 0, 0),
('Rs3', 30, 4, 'Imagenes/Modelos/Audi/rs3.jpg', 0, 0, 0),
('S7', 31, 4, 'Imagenes/Modelos/Audi/s7.jpg', 0, 0, 0),
('Sq5', 32, 4, 'Imagenes/Modelos/Audi/sq5.jpg', 0, 0, 0),
('Serie 7', 33, 5, 'Imagenes/Modelos/BMW/serie7.jpg', 0, 0, 0),
('M3', 34, 5, 'Imagenes/Modelos/BMW/m3.jpg', 0, 0, 0),
('Z4', 35, 5, 'Imagenes/Modelos/BMW/z4.jpg', 0, 0, 0),
('X5', 36, 5, 'Imagenes/Modelos/BMW/x5.jpg', 0, 0, 0),
('X3', 37, 5, 'Imagenes/Modelos/BMW/x3.jpg', 0, 0, 0),
('Serie 1', 38, 5, 'Imagenes/Modelos/BMW/serie1.jpg', 0, 0, 0),
('M4 GTS', 39, 5, 'Imagenes/Modelos/BMW/m4gts.jpg', 0, 0, 0),
('M5', 40, 5, 'Imagenes/Modelos/BMW/M5.jpg', 0, 0, 0),
('X1', 41, 5, 'Imagenes/Modelos/BMW/x1.jpg', 0, 0, 0),
('Corvette', 42, 6, 'Imagenes/Modelos/Chevrolet/corvette.jpg', 0, 0, 0),
('Blazer', 43, 6, 'Imagenes/Modelos/Chevrolet/blazer.jpg', 0, 0, 0),
('Camaro', 45, 6, 'Imagenes/Modelos/Chevrolet/camaro.jpg', 0, 0, 0),
('Saxo', 48, 7, 'Imagenes/Modelos/Citroen/saxo.jpg', 0, 0, 0),
('Xsara', 49, 7, 'Imagenes/Modelos/Citroen/xsara.jpg', 0, 0, 0),
('C3', 50, 7, 'Imagenes/Modelos/Citroen/c3.jpg', 0, 0, 0),
('Berlingo', 51, 7, 'Imagenes/Modelos/Citroen/Berlingo.jpg', 0, 0, 0),
('Ds5', 52, 7, 'Imagenes/Modelos/Citroen/ds5.jpg', 0, 0, 0),
('Logan', 55, 9, 'Imagenes/Modelos/Dacia/logan.jpg', 0, 0, 0),
('Sandero', 56, 9, 'Imagenes/Modelos/Dacia/sandero.jpg', 0, 0, 0),
('Duster', 57, 9, 'Imagenes/Modelos/Dacia/duster.jpg', 0, 0, 0),
('Lodgy', 58, 9, 'Imagenes/Modelos/Dacia/lodgy.jpg', 0, 0, 0),
('F50', 59, 10, 'Imagenes/Modelos/Ferrari/f50.jpg', 0, 0, 0),
('Enzo', 60, 10, 'Imagenes/Modelos/Ferrari/enzo.jpg', 0, 0, 0),
('Superamerica', 61, 10, 'Imagenes/Modelos/Ferrari/superamerica.jpg', 0, 0, 0),
('Testarossa', 62, 10, 'Imagenes/Modelos/Ferrari/testarossa.jpg', 0, 0, 0),
('California', 63, 10, 'Imagenes/Modelos/Ferrari/california.jpg', 0, 0, 0),
('Punto', 64, 11, 'Imagenes/Modelos/Fiat/punto.jpg', 0, 0, 0),
('Bravo', 66, 11, 'Imagenes/Modelos/Fiat/bravo.jpg', 0, 0, 0),
('500', 68, 11, 'Imagenes/Modelos/Fiat/500.jpg', 0, 0, 0),
('Escort', 69, 12, 'Imagenes/Modelos/Ford/escort.jpg', 0, 0, 0),
('Focus', 70, 12, '	\r\nImagenes/Modelos/Ford/focus.jpg', 0, 0, 0),
('Mustang', 71, 12, '	\r\nImagenes/Modelos/Ford/mustang.jpg', 0, 0, 0),
('Fiesta', 72, 12, 'Imagenes/Modelos/Ford/fiesta.jpg', 0, 0, 0),
('Ranger', 73, 12, 'Imagenes/Modelos/Ford/ranger.jpg', 0, 0, 0),
('Sierra', 74, 12, 'Imagenes/Modelos/Ford/sierra.jpg', 0, 0, 0),
('Civic', 76, 13, 'Imagenes/Modelos/Honda/civic.jpg', 0, 0, 0),
('Nsx', 78, 13, 'Imagenes/Modelos/Honda/nsx.jpg', 0, 0, 0),
('S2000', 80, 13, 'Imagenes/Modelos/Honda/s2000.jpg', 0, 0, 0),
('I30 N', 81, 14, 'Imagenes/Modelos/Hyundai/i30n.jpg', 0, 0, 0),
('Veloster', 82, 14, 'Imagenes/Modelos/Hyundai/veloster.jpg', 0, 0, 0),
('Elantra', 83, 14, 'Imagenes/Modelos/Hyundai/elantra.jpg', 0, 0, 0),
('F Type', 87, 15, 'Imagenes/Modelos/Jaguar/fType.jpg', 0, 0, 0),
('I-Pace', 89, 15, 'Imagenes/Modelos/Jaguar/iPace.jpg', 0, 0, 0),
('XKR', 90, 15, 'Imagenes/Modelos/Jaguar/xkr.jpg', 0, 0, 0),
('Rio', 94, 16, 'Imagenes/Modelos/Kia/Rio.jpg', 0, 0, 0),
('Ceed', 95, 16, 'Imagenes/Modelos/Kia/ceed.jpg', 0, 0, 0),
('Proceed', 96, 16, 'Imagenes/Modelos/Kia/proceed.jpg', 0, 0, 0),
('Gallardo', 98, 17, 'Imagenes/Modelos/Lamborghini/Gallardo.jpg', 0, 0, 0),
('Murcielago', 99, 17, 'Imagenes/Modelos/Lamborghini/murcielago.png', 0, 0, 0),
('Aventador', 100, 17, 'Imagenes/Modelos/Lamborghini/aventador.jpg', 0, 0, 0),
('Quattroporte', 101, 18, 'Imagenes/Modelos/Maserati/Quattroporte.jpg', 0, 0, 0),
('Ghibli', 102, 18, 'Imagenes/Modelos/Maserati/Ghibli.jpg', 0, 0, 0),
('Granturismo', 104, 18, 'Imagenes/Modelos/Maserati/granTurismo.jpg', 0, 0, 0),
('Rx7', 107, 19, 'Imagenes/Modelos/Mazda/rx7.jpg', 0, 0, 0),
('Mx5', 108, 19, 'Imagenes/Modelos/Mazda/mx5.jpg', 0, 0, 0),
('Mazda3', 109, 19, 'Imagenes/Modelos/Mazda/mazda3.jpg', 0, 0, 0),
('Rx8', 110, 19, 'Imagenes/Modelos/Mazda/rx8.jpg', 0, 0, 0),
('Cx5', 111, 19, 'Imagenes/Modelos/Mazda/cx5.jpg', 0, 0, 0),
('Clase A', 113, 20, 'Imagenes/Modelos/Mercedes/clasea.jpg', 0, 0, 0),
('Slr Mclaren', 114, 20, 'Imagenes/Modelos/Mercedes/slr.jpg', 0, 0, 0),
('Clase Glk', 115, 20, 'Imagenes/Modelos/Mercedes/glk.jpg', 0, 0, 0),
('Sls Amg', 116, 20, 'Imagenes/Modelos/Mercedes/slsAMG.jpg', 0, 0, 0),
('Micra', 117, 21, '	\r\nImagenes/Modelos/Nissan/micra.jpg', 0, 0, 0),
('200 Sx', 118, 21, '	\r\nImagenes/Modelos/Nissan/200sx.jpg', 0, 0, 0),
('350z', 119, 21, '	\r\nImagenes/Modelos/Nissan/350z.jpg', 0, 0, 0),
('Gtr', 120, 21, 'Imagenes/Modelos/Nissan/gtr.jpg', 0, 0, 0),
('370z', 121, 21, '	\r\nImagenes/Modelos/Nissan/370z.jpg', 0, 0, 0),
('Astra', 123, 22, '	\r\nImagenes/Modelos/opel/astra.jpg', 0, 0, 0),
('Corsa', 125, 22, 'Imagenes/Modelos/opel/corsa.jpg', 0, 0, 0),
('Insignia', 127, 22, 'Imagenes/Modelos/opel/insignea.jpg', 0, 0, 0),
('308', 131, 23, 'Imagenes/Modelos/Peugeot/308.jpg', 0, 0, 0),
('208', 132, 23, 'Imagenes/Modelos/Peugeot/208.jpg', 0, 0, 0),
('911', 133, 24, 'Imagenes/Modelos/Porsche/911.jpg', 0, 0, 0),
('Cayenne', 135, 24, 'Imagenes/Modelos/Porsche/cayanne.jpg', 0, 0, 0),
('Carrera Gt', 136, 24, 'Imagenes/Modelos/Porsche/carreragt.jpg', 0, 0, 0),
('Panamera', 137, 24, 'Imagenes/Modelos/Porsche/panamera.jpg', 0, 0, 0),
('918', 138, 24, 'Imagenes/Modelos/Porsche/918.jpg', 0, 0, 0),
('Megane', 139, 25, '	\r\nImagenes/Modelos/Renault/megane.jpg', 0, 0, 0),
('Clio', 140, 25, 'Imagenes/Modelos/Renault/clio.jpg', 0, 0, 0),
('Ibiza', 144, 26, 'Imagenes/Modelos/Seat/ibiza.jpg', 0, 0, 0),
('Ateca Cupra', 145, 26, '	\r\nImagenes/Modelos/Seat/ateca.jpg', 0, 0, 0),
('Leon', 150, 26, 'Imagenes/Modelos/Seat/leon.jpg', 0, 0, 0),
('Octavia', 151, 27, 'Imagenes/Modelos/Skoda/octavia.jpg', 0, 0, 0),
('Fabia', 152, 27, 'Imagenes/Modelos/Skoda/fabia.jpg', 0, 0, 0),
('Superb', 153, 27, 'Imagenes/Modelos/Skoda/superb.jpg', 0, 0, 0),
('Wrx Sti', 158, 28, 'Imagenes/Modelos/Subaru/wrxSTI.jpg', 0, 0, 0),
('Brz', 159, 28, 'Imagenes/Modelos/Subaru/brz.jpg', 0, 0, 0),
('Supra', 161, 29, 'Imagenes/Modelos/Toyota/supra.jpg', 0, 0, 0),
('Prius', 162, 29, 'Imagenes/Modelos/Toyota/prius.jpg', 0, 0, 0),
('Gt86', 165, 29, 'Imagenes/Modelos/Toyota/gt86.jpg', 0, 0, 0),
('Passat', 166, 30, 'Imagenes/Modelos/Volkswagen/passat.jpg', 0, 0, 0),
('Golf', 167, 30, 'Imagenes/Modelos/Volkswagen/golf.jpg', 0, 0, 0),
('Polo', 168, 30, 'Imagenes/Modelos/Volkswagen/polo.jpg', 0, 0, 0),
('Scirocco', 170, 30, 'Imagenes/Modelos/Volkswagen/scirocco.jpg', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelo_usuario`
--

CREATE TABLE `modelo_usuario` (
  `idUsu` int(11) NOT NULL,
  `codigoMod` int(11) NOT NULL,
  `favorito` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `modelo_usuario`
--

INSERT INTO `modelo_usuario` (`idUsu`, `codigoMod`, `favorito`) VALUES
(3, 1, 0),
(3, 3, 1),
(3, 4, 0),
(3, 5, 0),
(3, 11, 0),
(3, 20, 0),
(3, 34, 0),
(3, 45, 0),
(3, 120, 0),
(10, 1, 1),
(10, 2, 1),
(10, 3, 0),
(10, 7, 0),
(10, 12, 0),
(10, 34, 1),
(10, 39, 0),
(10, 45, 0),
(10, 167, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE `noticia` (
  `idUsu` int(11) NOT NULL,
  `idNoticia` int(11) NOT NULL,
  `Titulo` varchar(255) NOT NULL,
  `Desarrollo` varchar(500) NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`idUsu`, `idNoticia`, `Titulo`, `Desarrollo`, `Fecha`) VALUES
(10, 2, 'Audi saca un nuevo coche electrico', 'me parece que el nuevo bcsauvcuyasvcuyvas', '2020-05-29'),
(10, 3, 'Nueva Gama de vehiculos BM', 'BMW sacara una nueva gama de de vehiculos hibridos para mejorar el medio Ambiente', '2020-05-29'),
(10, 6, 'prueba', 'hola', '2020-06-03'),
(10, 7, 'Prueba video', 'esto es una prueba', '2020-06-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `respuesta` (
  `idRes` int(11) NOT NULL,
  `idHilo` int(11) NOT NULL,
  `idUsu` int(11) NOT NULL,
  `texto` text NOT NULL,
  `fecha` date NOT NULL,
  `positivos` int(11) NOT NULL DEFAULT '0',
  `negativos` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `respuesta`
--

INSERT INTO `respuesta` (`idRes`, `idHilo`, `idUsu`, `texto`, `fecha`, `positivos`, `negativos`) VALUES
(4, 1, 10, 'Me gusta mucho', '2020-06-11', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsu` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `fec_nac` date DEFAULT NULL,
  `foto` varchar(255) DEFAULT 'Imagenes/FotoUsuario/defecto.png',
  `Tipo` varchar(100) NOT NULL DEFAULT 'normal',
  `SerMod` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsu`, `email`, `pass`, `nombre`, `apellidos`, `fec_nac`, `foto`, `Tipo`, `SerMod`) VALUES
(3, 'fabio2000br@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Francisco', 'Benitez', '2019-10-10', 'Imagenes\\FotoUsuario\\defecto.png', 'Admin', 0),
(10, 'admin@gmail.com ', '81dc9bdb52d04dc20036dbd8313ed055', 'Admin', 'Admin', '2020-02-05', '	\r\nImagenes/FotoUsuario/defecto.png', 'Admin', 0),
(22, 'fabio2000r@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Fabio', 'Benitez', '2020-05-30', 'Imagenes/FotoUsuario/defecto.png', 'normal', 0),
(25, 'juanantoniovendecoches@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Fabio', 'Benitez', '0000-00-00', 'Imagenes/FotoUsuario/defecto.png', 'normal', 0),
(52, 'fabio2000br7@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Fabio', 'Benitez', '0000-00-00', 'Imagenes/FotoUsuario/defecto.png', 'normal', 0),
(53, 'pruebavideo@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Petrol', 'Head', '2020-06-11', 'Imagenes/FotoUsuario/defecto.png', 'normal', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anuncio`
--
ALTER TABLE `anuncio`
  ADD PRIMARY KEY (`IdAnuncio`),
  ADD KEY `fk_anuncio` (`IdUsu`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`idCom`),
  ADD KEY `idUsu` (`idUsu`),
  ADD KEY `codigoMod` (`codigoMod`);

--
-- Indices de la tabla `especificaciones`
--
ALTER TABLE `especificaciones`
  ADD PRIMARY KEY (`CodEspe`),
  ADD KEY `CodigoMod` (`CodigoMod`);

--
-- Indices de la tabla `hilo`
--
ALTER TABLE `hilo`
  ADD PRIMARY KEY (`idHilo`),
  ADD KEY `idUsu` (`idUsu`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`IdImagen`),
  ADD KEY `fk_imagenes` (`IdAnuncio`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`CodigoMarca`),
  ADD UNIQUE KEY `CodigoMarca` (`CodigoMarca`);

--
-- Indices de la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD PRIMARY KEY (`CodigoMod`),
  ADD KEY `CodigoMarca` (`CodigoMarca`);

--
-- Indices de la tabla `modelo_usuario`
--
ALTER TABLE `modelo_usuario`
  ADD PRIMARY KEY (`idUsu`,`codigoMod`),
  ADD KEY `codigoMod` (`codigoMod`);

--
-- Indices de la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`idNoticia`),
  ADD KEY `idUsu` (`idUsu`);

--
-- Indices de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD PRIMARY KEY (`idRes`),
  ADD KEY `idHilo` (`idHilo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anuncio`
--
ALTER TABLE `anuncio`
  MODIFY `IdAnuncio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `idCom` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `especificaciones`
--
ALTER TABLE `especificaciones`
  MODIFY `CodEspe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `hilo`
--
ALTER TABLE `hilo`
  MODIFY `idHilo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `IdImagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
  MODIFY `idNoticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `idRes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anuncio`
--
ALTER TABLE `anuncio`
  ADD CONSTRAINT `fk_anuncio` FOREIGN KEY (`IdUsu`) REFERENCES `usuario` (`idUsu`) ON DELETE CASCADE;

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`idUsu`) REFERENCES `usuario` (`idUsu`),
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`codigoMod`) REFERENCES `modelo` (`CodigoMod`);

--
-- Filtros para la tabla `especificaciones`
--
ALTER TABLE `especificaciones`
  ADD CONSTRAINT `especificaciones_ibfk_1` FOREIGN KEY (`CodigoMod`) REFERENCES `modelo` (`CodigoMod`);

--
-- Filtros para la tabla `hilo`
--
ALTER TABLE `hilo`
  ADD CONSTRAINT `hilo_ibfk_1` FOREIGN KEY (`idUsu`) REFERENCES `usuario` (`idUsu`) ON DELETE CASCADE;

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `fk_imagenes` FOREIGN KEY (`IdAnuncio`) REFERENCES `anuncio` (`IdAnuncio`) ON DELETE CASCADE;

--
-- Filtros para la tabla `modelo`
--
ALTER TABLE `modelo`
  ADD CONSTRAINT `modelo_ibfk_1` FOREIGN KEY (`CodigoMarca`) REFERENCES `marcas` (`CodigoMarca`);

--
-- Filtros para la tabla `modelo_usuario`
--
ALTER TABLE `modelo_usuario`
  ADD CONSTRAINT `fk_modelo_usuario` FOREIGN KEY (`idUsu`) REFERENCES `usuario` (`idUsu`) ON DELETE CASCADE,
  ADD CONSTRAINT `modelo_usuario_ibfk_2` FOREIGN KEY (`codigoMod`) REFERENCES `modelo` (`CodigoMod`);

--
-- Filtros para la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD CONSTRAINT `noticia_ibfk_1` FOREIGN KEY (`idUsu`) REFERENCES `usuario` (`idUsu`);

--
-- Filtros para la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD CONSTRAINT `respuesta_ibfk_1` FOREIGN KEY (`idHilo`) REFERENCES `hilo` (`idHilo`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

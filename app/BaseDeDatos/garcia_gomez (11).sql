-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-12-2021 a las 02:19:59
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `garcia_gomez`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `id` int(30) NOT NULL,
  `monto_total` double NOT NULL,
  `id_usuario` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cuenta`
--

INSERT INTO `cuenta` (`id`, `monto_total`, `id_usuario`) VALUES
(1, 0, 37),
(3, 0, 38),
(4, 0, 39);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dominio_vehiculo`
--

CREATE TABLE `dominio_vehiculo` (
  `id` int(30) NOT NULL,
  `id_usuario` int(30) NOT NULL,
  `id_vehiculo` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dominio_vehiculo`
--

INSERT INTO `dominio_vehiculo` (`id`, `id_usuario`, `id_vehiculo`) VALUES
(5, 39, 12),
(7, 38, 13),
(8, 38, 14),
(10, 37, 16),
(11, 37, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadias`
--

CREATE TABLE `estadias` (
  `id` int(30) NOT NULL,
  `duracion_definida` tinyint(1) NOT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `pago_pendiente` tinyint(1) NOT NULL,
  `id_dominio_vehiculo` int(30) NOT NULL,
  `id_historial_zona` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estadias`
--

INSERT INTO `estadias` (`id`, `duracion_definida`, `fecha_inicio`, `fecha_fin`, `pago_pendiente`, `id_dominio_vehiculo`, `id_historial_zona`) VALUES
(72, 1, '2021-11-17 20:17:19', '2021-11-17 21:07:00', 1, 5, 1),
(75, 1, '2021-11-17 21:40:06', '2021-11-17 21:41:00', 1, 5, 1),
(98, 1, '2021-11-18 10:22:45', '2021-11-18 10:23:00', 1, 7, 1),
(99, 1, '2021-11-18 10:30:59', '2021-11-18 10:31:00', 1, 7, 1),
(100, 1, '2021-11-18 10:36:31', '2021-11-18 10:36:00', 1, 7, 1),
(101, 1, '2021-11-18 10:40:40', '2021-11-18 10:40:00', 1, 7, 1),
(102, 1, '2021-11-18 10:46:08', '2021-11-18 10:47:00', 1, 8, 1),
(104, 1, '2021-12-08 19:24:26', '2021-12-08 19:24:37', 0, 10, 1),
(105, 1, '2021-12-08 21:50:34', '2021-12-08 21:51:08', 0, 10, 1),
(106, 1, '2021-12-08 21:51:53', '2021-12-08 21:53:05', 0, 10, 1),
(107, 1, '2021-12-09 01:28:11', '2021-12-09 01:28:22', 1, 10, 1),
(108, 1, '2021-12-09 20:50:35', '2021-12-09 20:50:41', 0, 10, 1),
(109, 1, '2021-12-09 21:02:09', '2021-12-09 21:14:05', 0, 10, 1),
(110, 1, '2021-12-09 21:14:29', '2021-12-09 23:59:00', 0, 10, 1),
(111, 1, '2021-12-10 18:15:39', '2021-12-10 18:23:29', 0, 10, 1),
(112, 1, '2021-12-10 18:25:49', '2021-12-10 18:25:55', 0, 10, 1),
(113, 1, '2021-12-10 18:27:50', '2021-12-10 18:29:40', 0, 10, 1),
(114, 1, '2021-12-10 18:31:13', '2021-12-10 18:31:26', 0, 10, 1),
(115, 1, '2021-12-10 18:33:39', '2021-12-10 18:39:58', 0, 10, 1),
(116, 1, '2021-12-10 18:43:00', '2021-12-10 18:43:05', 0, 10, 1),
(117, 1, '2021-12-10 18:44:19', '2021-12-10 18:44:27', 0, 10, 1),
(118, 1, '2021-12-10 18:45:47', '2021-12-10 18:45:57', 0, 10, 1),
(119, 1, '2021-12-10 18:46:32', '2021-12-10 18:46:39', 0, 10, 1),
(120, 1, '2021-12-10 18:48:58', '2021-12-10 18:49:09', 0, 10, 1),
(121, 1, '2021-12-10 18:51:13', '2021-12-10 18:51:19', 0, 10, 1),
(122, 1, '2021-12-10 18:57:03', '2021-12-10 18:57:13', 0, 10, 1),
(123, 1, '2021-12-10 18:59:09', '2021-12-10 18:59:16', 0, 10, 1),
(124, 1, '2021-12-10 19:00:07', '2021-12-10 19:00:17', 0, 10, 1),
(125, 1, '2021-12-10 19:03:17', '2021-12-10 19:03:30', 0, 10, 1),
(126, 1, '2021-12-10 19:04:11', '2021-12-10 19:04:22', 0, 10, 1),
(127, 1, '2021-12-10 19:06:19', '2021-12-10 19:06:39', 0, 10, 1),
(128, 1, '2021-12-10 19:07:54', '2021-12-10 19:08:02', 0, 10, 1),
(129, 1, '2021-12-10 19:09:04', '2021-12-10 19:09:15', 0, 10, 1),
(130, 1, '2021-12-10 19:09:59', '2021-12-10 19:10:05', 0, 10, 1),
(131, 1, '2021-12-10 19:13:13', '2021-12-10 19:13:28', 0, 10, 1),
(132, 1, '2021-12-10 19:20:04', '2021-12-10 19:20:20', 0, 10, 1),
(133, 1, '2021-12-10 19:20:38', '2021-12-10 19:20:43', 0, 10, 1),
(134, 1, '2021-12-10 19:20:53', '2021-12-10 19:21:00', 0, 10, 1),
(135, 1, '2021-12-10 19:21:39', '2021-12-10 19:21:45', 0, 10, 1),
(136, 1, '2021-12-10 19:51:44', '2021-12-10 19:52:17', 0, 10, 1),
(137, 1, '2021-12-09 18:58:40', '2021-12-09 18:58:50', 1, 10, 1),
(138, 1, '2021-12-09 19:07:55', '2021-12-09 20:30:00', 1, 10, 1),
(139, 1, '2021-12-09 19:19:53', '2021-12-09 20:30:00', 1, 10, 1),
(140, 1, '2021-12-09 19:29:26', '2021-12-09 20:30:00', 1, 10, 1),
(141, 1, '2021-12-09 19:31:36', '2021-12-09 20:30:00', 1, 10, 1),
(143, 1, '2021-12-12 19:36:44', '2021-12-12 19:33:00', 1, 10, 1),
(144, 1, '2021-12-12 19:38:22', '2021-12-12 19:33:00', 1, 10, 1),
(145, 1, '2021-12-12 19:38:51', '2021-12-12 19:33:00', 1, 10, 1),
(146, 1, '2021-12-12 19:39:40', '2021-12-12 19:33:00', 1, 10, 1),
(147, 1, '2021-12-12 19:41:22', '2021-12-12 19:33:00', 1, 10, 1),
(148, 1, '2021-12-12 19:41:44', '2021-12-12 19:33:00', 1, 10, 1),
(149, 1, '2021-12-12 19:43:17', '2021-12-12 19:30:00', 1, 11, 1),
(150, 1, '2021-12-12 19:47:30', '2021-12-12 19:48:00', 1, 10, 1),
(151, 1, '2021-12-12 19:50:25', '2021-12-12 19:51:00', 1, 10, 1),
(152, 1, '2021-12-12 19:50:41', '2021-12-12 19:54:32', 0, 11, 1),
(153, 1, '2021-12-12 19:55:12', '2021-12-12 19:56:00', 1, 10, 1),
(154, 1, '2021-12-12 19:56:41', '2021-12-12 19:57:00', 1, 10, 1),
(155, 1, '2021-12-12 19:59:50', '2021-12-12 20:01:00', 1, 10, 1),
(156, 1, '2021-12-12 20:07:56', '2021-12-12 20:08:00', 0, 10, 1),
(157, 1, '2021-12-12 20:08:51', '2021-12-12 20:09:00', 0, 10, 1),
(158, 1, '2021-12-12 20:09:19', '2021-12-12 20:11:00', 1, 10, 1),
(159, 1, '2021-12-12 20:09:32', '2021-12-12 20:09:45', 0, 11, 1),
(160, 1, '2021-12-12 21:14:29', '2021-12-12 21:15:00', 1, 10, 1),
(162, 1, '2021-12-12 21:52:44', '2021-12-12 23:59:00', 1, 10, 1),
(163, 1, '2021-12-13 11:15:40', '2021-12-13 11:16:02', 1, 10, 1),
(164, 1, '2021-12-13 11:50:43', '2021-12-13 11:51:08', 1, 10, 1),
(165, 1, '2021-12-13 11:51:30', '2021-12-13 11:52:00', 1, 10, 1),
(166, 1, '2021-12-13 11:51:56', '2021-12-13 11:52:00', 1, 10, 1),
(167, 1, '2021-12-13 11:55:09', '2021-12-13 11:56:00', 1, 10, 1),
(168, 1, '2021-12-13 11:57:24', '2021-12-13 11:58:00', 1, 10, 1),
(169, 1, '2021-12-13 11:58:43', '2021-12-13 11:59:00', 0, 10, 1),
(170, 1, '2021-12-13 12:00:11', '2021-12-13 12:01:00', 1, 10, 1),
(171, 1, '2021-12-13 12:22:36', '2021-12-13 12:23:00', 1, 10, 1),
(172, 1, '2021-12-13 12:24:08', '2021-12-13 12:25:00', 1, 10, 1),
(173, 1, '2021-12-13 12:24:32', '2021-12-13 12:24:42', 0, 11, 1),
(174, 1, '2021-12-13 14:18:27', '2021-12-13 14:19:00', 1, 7, 1),
(175, 1, '2021-12-13 16:11:49', '2021-12-13 16:12:00', 1, 7, 1),
(176, 1, '2021-12-13 16:20:41', '2021-12-13 16:21:00', 1, 10, 1),
(177, 1, '2021-12-13 16:22:47', '2021-12-13 16:23:00', 1, 10, 1),
(178, 1, '2021-12-13 16:34:22', '2021-12-13 16:35:01', 1, 10, 1),
(179, 1, '2021-12-13 16:43:26', '2021-12-13 16:43:55', 1, 10, 1),
(180, 1, '2021-12-13 16:48:59', '2021-12-13 16:51:00', 1, 10, 1),
(181, 1, '2021-12-13 16:49:49', '2021-12-13 16:49:57', 1, 11, 1),
(182, 0, '2021-12-13 21:46:20', '2021-12-13 23:59:00', 1, 10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_zonas`
--

CREATE TABLE `historial_zonas` (
  `id` int(11) NOT NULL,
  `comienzo` time NOT NULL,
  `final` time NOT NULL,
  `precio` double NOT NULL,
  `estado` tinyint(4) NOT NULL,
  `id_zona` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `historial_zonas`
--

INSERT INTO `historial_zonas` (`id`, `comienzo`, `final`, `precio`, `estado`, `id_zona`) VALUES
(1, '01:00:00', '23:59:00', 30, 1, 1),
(2, '17:00:00', '20:00:00', 30, 0, 1),
(3, '07:00:00', '13:30:00', 30, 1, 2),
(4, '18:00:00', '20:00:00', 30, 0, 1),
(5, '17:00:00', '21:00:00', 30, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `infracciones`
--

CREATE TABLE `infracciones` (
  `id` int(30) NOT NULL,
  `dia_hora` datetime NOT NULL,
  `calle` varchar(256) NOT NULL,
  `altura` int(30) NOT NULL,
  `id_dominio_vehiculo` int(30) NOT NULL,
  `id_historial_zona` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `infracciones`
--

INSERT INTO `infracciones` (`id`, `dia_hora`, `calle`, `altura`, `id_dominio_vehiculo`, `id_historial_zona`) VALUES
(6, '2021-12-09 16:04:05', '25 de Mayo', 40, 10, 3),
(7, '2021-12-09 16:04:24', 'Buenos Aires', 150, 10, 5),
(10, '2021-12-09 18:05:26', 'San Luis', 150, 10, 1),
(11, '2021-12-09 20:07:34', 'San Luis', 35, 8, 1),
(12, '2021-12-09 20:35:38', 'Brown', 60, 8, 3),
(13, '2021-12-11 17:59:40', 'San Luis', 123, 5, 1),
(14, '2021-12-13 21:48:28', 'Buenos Aires', 50, 11, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `nombre`) VALUES
(1, 'Abarth'),
(2, 'Alfa Romeo'),
(3, 'Aro'),
(4, 'Asia'),
(5, 'Asia Motors'),
(6, 'Aston Martin'),
(7, 'Audi'),
(8, 'Austin'),
(9, 'Auverland'),
(10, 'Bentley'),
(11, 'Bertone'),
(12, 'Bmw'),
(13, 'Cadillac'),
(14, 'Chevrolet'),
(15, 'Chrysler'),
(16, 'Citroen'),
(17, 'Corvette'),
(18, 'Dacia'),
(19, 'Daewoo'),
(20, 'Daf'),
(21, 'Daihatsu'),
(22, 'Daimler'),
(23, 'Dodge'),
(24, 'Ferrari'),
(25, 'Fiat'),
(26, 'Ford'),
(27, 'Galloper'),
(28, 'Gmc'),
(29, 'Honda'),
(30, 'Hummer'),
(31, 'Hyundai'),
(32, 'Infiniti'),
(33, 'Innocenti'),
(34, 'Isuzu'),
(35, 'Iveco'),
(36, 'Iveco-pegaso'),
(37, 'Jaguar'),
(38, 'Jeep'),
(39, 'Kia'),
(40, 'Lada'),
(41, 'Lamborghini'),
(42, 'Lancia'),
(43, 'Land-rover'),
(44, 'Ldv'),
(45, 'Lexus'),
(46, 'Lotus'),
(47, 'Mahindra'),
(48, 'Maserati'),
(49, 'Maybach'),
(50, 'Mazda'),
(51, 'Mercedes-benz'),
(52, 'Mg'),
(53, 'Mini'),
(54, 'Mitsubishi'),
(55, 'Morgan'),
(56, 'Nissan'),
(57, 'Opel'),
(58, 'Peugeot'),
(59, 'Pontiac'),
(60, 'Porsche'),
(61, 'Renault'),
(62, 'Rolls-royce'),
(63, 'Rover'),
(64, 'Saab'),
(65, 'Santana'),
(66, 'Seat'),
(67, 'Skoda'),
(68, 'Smart'),
(69, 'Ssangyong'),
(70, 'Subaru'),
(71, 'Suzuki'),
(72, 'Talbot'),
(73, 'Tata'),
(74, 'Toyota'),
(75, 'Umm'),
(76, 'Vaz'),
(77, 'Volkswagen'),
(78, 'Volvo'),
(79, 'Wartburg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelos`
--

CREATE TABLE `modelos` (
  `id_marca` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `modelos`
--

INSERT INTO `modelos` (`id_marca`, `id`, `nombre`) VALUES
(1, 1, '500'),
(1, 2, 'Grande Punto'),
(1, 3, 'Punto Evo'),
(1, 4, '500c'),
(1, 5, '695'),
(1, 6, 'Punto'),
(2, 7, '155'),
(2, 8, '156'),
(2, 9, '159'),
(2, 10, '164'),
(2, 11, '145'),
(2, 12, '147'),
(2, 13, '146'),
(2, 14, 'Gtv'),
(2, 15, 'Spider'),
(2, 16, '166'),
(2, 17, 'Gt'),
(2, 18, 'Crosswagon'),
(2, 19, 'Brera'),
(2, 20, '90'),
(2, 21, '75'),
(2, 22, '33'),
(2, 23, 'Giulietta'),
(2, 24, 'Sprint'),
(2, 25, 'Mito'),
(3, 26, 'Expander'),
(3, 27, '10'),
(3, 28, '24'),
(3, 29, 'Dacia'),
(4, 30, 'Rocsta'),
(5, 31, 'Rocsta'),
(6, 32, 'Db7'),
(6, 33, 'V8'),
(6, 34, 'Db9'),
(6, 35, 'Vanquish'),
(6, 36, 'V8 Vantage'),
(6, 37, 'Vantage'),
(6, 38, 'Dbs'),
(6, 39, 'Volante'),
(6, 40, 'Virage'),
(6, 41, 'Vantage V8'),
(6, 42, 'Vantage V12'),
(6, 43, 'Rapide'),
(6, 44, 'Cygnet'),
(7, 45, '80'),
(7, 46, 'A4'),
(7, 47, 'A6'),
(7, 48, 'S6'),
(7, 49, 'Coupe'),
(7, 50, 'S2'),
(7, 51, 'Rs2'),
(7, 52, 'A8'),
(7, 53, 'Cabriolet'),
(7, 54, 'S8'),
(7, 55, 'A3'),
(7, 56, 'S4'),
(7, 57, 'Tt'),
(7, 58, 'S3'),
(7, 59, 'Allroad Quattro'),
(7, 60, 'Rs4'),
(7, 61, 'A2'),
(7, 62, 'Rs6'),
(7, 63, 'Q7'),
(7, 64, 'R8'),
(7, 65, 'A5'),
(7, 66, 'S5'),
(7, 67, 'V8'),
(7, 68, '200'),
(7, 69, '100'),
(7, 70, '90'),
(7, 71, 'Tts'),
(7, 72, 'Q5'),
(7, 73, 'A4 Allroad Quattro'),
(7, 74, 'Tt Rs'),
(7, 75, 'Rs5'),
(7, 76, 'A1'),
(7, 77, 'A7'),
(7, 78, 'Rs3'),
(7, 79, 'Q3'),
(7, 80, 'A6 Allroad Quattro'),
(7, 81, 'S7'),
(7, 82, 'Sq5'),
(8, 83, 'Mini'),
(8, 84, 'Montego'),
(8, 85, 'Maestro'),
(8, 86, 'Metro'),
(8, 87, 'Mini Moke'),
(9, 88, 'Diesel'),
(10, 89, 'Brooklands'),
(10, 90, 'Turbo'),
(10, 91, 'Continental'),
(10, 92, 'Azure'),
(10, 93, 'Arnage'),
(10, 94, 'Continental Gt'),
(10, 95, 'Continental Flying Spur'),
(10, 96, 'Turbo R'),
(10, 97, 'Mulsanne'),
(10, 98, 'Eight'),
(10, 99, 'Continental Gtc'),
(10, 100, 'Continental Supersports'),
(11, 101, 'Freeclimber Diesel'),
(12, 102, 'Serie 3'),
(12, 103, 'Serie 5'),
(12, 104, 'Compact'),
(12, 105, 'Serie 7'),
(12, 106, 'Serie 8'),
(12, 107, 'Z3'),
(12, 108, 'Z4'),
(12, 109, 'Z8'),
(12, 110, 'X5'),
(12, 111, 'Serie 6'),
(12, 112, 'X3'),
(12, 113, 'Serie 1'),
(12, 114, 'Z1'),
(12, 115, 'X6'),
(12, 116, 'X1'),
(13, 117, 'Seville'),
(13, 118, 'Sts'),
(13, 119, 'El Dorado'),
(13, 120, 'Cts'),
(13, 121, 'Xlr'),
(13, 122, 'Srx'),
(13, 123, 'Escalade'),
(13, 124, 'Bls'),
(14, 125, 'Corvette'),
(14, 126, 'Blazer'),
(14, 127, 'Astro'),
(14, 128, 'Nubira'),
(14, 129, 'Evanda'),
(14, 130, 'Trans Sport'),
(14, 131, 'Camaro'),
(14, 132, 'Matiz'),
(14, 133, 'Alero'),
(14, 134, 'Tahoe'),
(14, 135, 'Tacuma'),
(14, 136, 'Trailblazer'),
(14, 137, 'Kalos'),
(14, 138, 'Aveo'),
(14, 139, 'Lacetti'),
(14, 140, 'Epica'),
(14, 141, 'Captiva'),
(14, 142, 'Hhr'),
(14, 143, 'Cruze'),
(14, 144, 'Spark'),
(14, 145, 'Orlando'),
(14, 146, 'Volt'),
(14, 147, 'Malibu'),
(15, 148, 'Vision'),
(15, 149, '300m'),
(15, 150, 'Grand Voyager'),
(15, 151, 'Viper'),
(15, 152, 'Neon'),
(15, 153, 'Voyager'),
(15, 154, 'Stratus'),
(15, 155, 'Sebring'),
(15, 156, 'Sebring 200c'),
(15, 157, 'New Yorker'),
(15, 158, 'Pt Cruiser'),
(15, 159, 'Crossfire'),
(15, 160, '300c'),
(15, 161, 'Le Baron'),
(15, 162, 'Saratoga'),
(16, 163, 'Xantia'),
(16, 164, 'Xm'),
(16, 165, 'Ax'),
(16, 166, 'Zx'),
(16, 167, 'Evasion'),
(16, 168, 'C8'),
(16, 169, 'Saxo'),
(16, 170, 'C2'),
(16, 171, 'Xsara'),
(16, 172, 'C4'),
(16, 173, 'Xsara Picasso'),
(16, 174, 'C5'),
(16, 175, 'C3'),
(16, 176, 'C3 Pluriel'),
(16, 177, 'C1'),
(16, 178, 'C6'),
(16, 179, 'Grand C4 Picasso'),
(16, 180, 'C4 Picasso'),
(16, 181, 'Ccrosser'),
(16, 182, 'C15'),
(16, 183, 'Jumper'),
(16, 184, 'Jumpy'),
(16, 185, 'Berlingo'),
(16, 186, 'Bx'),
(16, 187, 'C25'),
(16, 188, 'Cx'),
(16, 189, 'Gsa'),
(16, 190, 'Visa'),
(16, 191, 'Lna'),
(16, 192, '2cv'),
(16, 193, 'Nemo'),
(16, 194, 'C4 Sedan'),
(16, 195, 'Berlingo First'),
(16, 196, 'C3 Picasso'),
(16, 197, 'Ds3'),
(16, 198, 'Czero'),
(16, 199, 'Ds4'),
(16, 200, 'Ds5'),
(16, 201, 'C4 Aircross'),
(16, 202, 'Celysee'),
(17, 203, 'Corvette'),
(18, 204, 'Contac'),
(18, 205, 'Logan'),
(18, 206, 'Sandero'),
(18, 207, 'Duster'),
(18, 208, 'Lodgy'),
(19, 209, 'Nexia'),
(19, 210, 'Aranos'),
(19, 211, 'Lanos'),
(19, 212, 'Nubira'),
(19, 213, 'Compact'),
(19, 214, 'Nubira Compact'),
(19, 215, 'Leganza'),
(19, 216, 'Evanda'),
(19, 217, 'Matiz'),
(19, 218, 'Tacuma'),
(19, 219, 'Kalos'),
(19, 220, 'Lacetti'),
(21, 221, 'Applause'),
(21, 222, 'Charade'),
(21, 223, 'Rocky'),
(21, 224, 'Feroza'),
(21, 225, 'Terios'),
(21, 226, 'Sirion'),
(22, 227, 'Serie Xj'),
(22, 228, 'Xj'),
(22, 229, 'Double Six'),
(22, 230, 'Six'),
(22, 231, 'Series Iii'),
(23, 232, 'Viper'),
(23, 233, 'Caliber'),
(23, 234, 'Nitro'),
(23, 235, 'Avenger'),
(23, 236, 'Journey'),
(24, 237, 'F355'),
(24, 238, '360'),
(24, 239, 'F430'),
(24, 240, 'F512 M'),
(24, 241, '550 Maranello'),
(24, 242, '575m Maranello'),
(24, 243, '599'),
(24, 244, '456'),
(24, 245, '456m'),
(24, 246, '612'),
(24, 247, 'F50'),
(24, 248, 'Enzo'),
(24, 249, 'Superamerica'),
(24, 250, '430'),
(24, 251, '348'),
(24, 252, 'Testarossa'),
(24, 253, '512'),
(24, 254, '355'),
(24, 255, 'F40'),
(24, 256, '412'),
(24, 257, 'Mondial'),
(24, 258, '328'),
(24, 259, 'California'),
(24, 260, '458'),
(24, 261, 'Ff'),
(25, 262, 'Croma'),
(25, 263, 'Cinquecento'),
(25, 264, 'Seicento'),
(25, 265, 'Punto'),
(25, 266, 'Grande Punto'),
(25, 267, 'Panda'),
(25, 268, 'Tipo'),
(25, 269, 'Coupe'),
(25, 270, 'Uno'),
(25, 271, 'Ulysse'),
(25, 272, 'Tempra'),
(25, 273, 'Marea'),
(25, 274, 'Barchetta'),
(25, 275, 'Bravo'),
(25, 276, 'Stilo'),
(25, 277, 'Brava'),
(25, 278, 'Palio Weekend'),
(25, 279, '600'),
(25, 280, 'Multipla'),
(25, 281, 'Idea'),
(25, 282, 'Sedici'),
(25, 283, 'Linea'),
(25, 284, '500'),
(25, 285, 'Fiorino'),
(25, 286, 'Ducato'),
(25, 287, 'Doblo Cargo'),
(25, 288, 'Doblo'),
(25, 289, 'Strada'),
(25, 290, 'Regata'),
(25, 291, 'Talento'),
(25, 292, 'Argenta'),
(25, 293, 'Ritmo'),
(25, 294, 'Punto Classic'),
(25, 295, 'Qubo'),
(25, 296, 'Punto Evo'),
(25, 297, '500c'),
(25, 298, 'Freemont'),
(25, 299, 'Panda Classic'),
(25, 300, '500l'),
(26, 301, 'Maverick'),
(26, 302, 'Escort'),
(26, 303, 'Focus'),
(26, 304, 'Mondeo'),
(26, 305, 'Scorpio'),
(26, 306, 'Fiesta'),
(26, 307, 'Probe'),
(26, 308, 'Explorer'),
(26, 309, 'Galaxy'),
(26, 310, 'Ka'),
(26, 311, 'Puma'),
(26, 312, 'Cougar'),
(26, 313, 'Focus Cmax'),
(26, 314, 'Fusion'),
(26, 315, 'Streetka'),
(26, 316, 'Cmax'),
(26, 317, 'Smax'),
(26, 318, 'Transit'),
(26, 319, 'Courier'),
(26, 320, 'Ranger'),
(26, 321, 'Sierra'),
(26, 322, 'Orion'),
(26, 323, 'Pick Up'),
(26, 324, 'Capri'),
(26, 325, 'Granada'),
(26, 326, 'Kuga'),
(26, 327, 'Grand Cmax'),
(26, 328, 'Bmax'),
(26, 329, 'Tourneo Custom'),
(27, 330, 'Exceed'),
(27, 331, 'Santamo'),
(27, 332, 'Super Exceed'),
(29, 333, 'Accord'),
(29, 334, 'Civic'),
(29, 335, 'Crx'),
(29, 336, 'Prelude'),
(29, 337, 'Nsx'),
(29, 338, 'Legend'),
(29, 339, 'Crv'),
(29, 340, 'Hrv'),
(29, 341, 'Logo'),
(29, 342, 'S2000'),
(29, 343, 'Stream'),
(29, 344, 'Jazz'),
(29, 345, 'Frv'),
(29, 346, 'Concerto'),
(29, 347, 'Insight'),
(29, 348, 'Crz'),
(30, 349, 'H2'),
(30, 350, 'H3'),
(30, 351, 'H3t'),
(31, 352, 'Lantra'),
(31, 353, 'Sonata'),
(31, 354, 'Elantra'),
(31, 355, 'Accent'),
(31, 356, 'Scoupe'),
(31, 357, 'Coupe'),
(31, 358, 'Atos'),
(31, 359, 'H1'),
(31, 360, 'Atos Prime'),
(31, 361, 'Xg'),
(31, 362, 'Trajet'),
(31, 363, 'Santa Fe'),
(31, 364, 'Terracan'),
(31, 365, 'Matrix'),
(31, 366, 'Getz'),
(31, 367, 'Tucson'),
(31, 368, 'I30'),
(31, 369, 'Pony'),
(31, 370, 'Grandeur'),
(31, 371, 'I10'),
(31, 372, 'I800'),
(31, 373, 'Sonata Fl'),
(31, 374, 'Ix55'),
(31, 375, 'I20'),
(31, 376, 'Ix35'),
(31, 377, 'Ix20'),
(31, 378, 'Genesis'),
(31, 379, 'I40'),
(31, 380, 'Veloster'),
(32, 381, 'G'),
(32, 382, 'Ex'),
(32, 383, 'Fx'),
(32, 384, 'M'),
(33, 385, 'Elba'),
(33, 386, 'Minitre'),
(34, 387, 'Trooper'),
(34, 388, 'Pick Up'),
(34, 389, 'D Max'),
(34, 390, 'Rodeo'),
(34, 391, 'Dmax'),
(34, 392, 'Trroper'),
(35, 393, 'Daily'),
(35, 394, 'Massif'),
(36, 395, 'Daily'),
(36, 396, 'Duty'),
(37, 397, 'Serie Xj'),
(37, 398, 'Serie Xk'),
(37, 399, 'Xj'),
(37, 400, 'Stype'),
(37, 401, 'Xf'),
(37, 402, 'Xtype'),
(38, 403, 'Wrangler'),
(38, 404, 'Cherokee'),
(38, 405, 'Grand Cherokee'),
(38, 406, 'Commander'),
(38, 407, 'Compass'),
(38, 408, 'Wrangler Unlimited'),
(38, 409, 'Patriot'),
(39, 410, 'Sportage'),
(39, 411, 'Sephia'),
(39, 412, 'Sephia Ii'),
(39, 413, 'Pride'),
(39, 414, 'Clarus'),
(39, 415, 'Shuma'),
(39, 416, 'Carnival'),
(39, 417, 'Joice'),
(39, 418, 'Magentis'),
(39, 419, 'Carens'),
(39, 420, 'Rio'),
(39, 421, 'Cerato'),
(39, 422, 'Sorento'),
(39, 423, 'Opirus'),
(39, 424, 'Picanto'),
(39, 425, 'Ceed'),
(39, 426, 'Ceed Sporty Wagon'),
(39, 427, 'Proceed'),
(39, 428, 'K2500 Frontier'),
(39, 429, 'K2500'),
(39, 430, 'Soul'),
(39, 431, 'Venga'),
(39, 432, 'Optima'),
(39, 433, 'Ceed Sportswagon'),
(40, 434, 'Samara'),
(40, 435, 'Niva'),
(40, 436, 'Sagona'),
(40, 437, 'Stawra 2110'),
(40, 438, '214'),
(40, 439, 'Kalina'),
(40, 440, 'Serie 2100'),
(40, 441, 'Priora'),
(41, 442, 'Gallardo'),
(41, 443, 'Murcielago'),
(41, 444, 'Aventador'),
(42, 445, 'Delta'),
(42, 446, 'K'),
(42, 447, 'Y10'),
(42, 448, 'Dedra'),
(42, 449, 'Lybra'),
(42, 450, 'Z'),
(42, 451, 'Y'),
(42, 452, 'Ypsilon'),
(42, 453, 'Thesis'),
(42, 454, 'Phedra'),
(42, 455, 'Musa'),
(42, 456, 'Thema'),
(42, 457, 'Zeta'),
(42, 458, 'Kappa'),
(42, 459, 'Trevi'),
(42, 460, 'Prisma'),
(42, 461, 'A112'),
(42, 462, 'Ypsilon Elefantino'),
(42, 463, 'Voyager'),
(43, 464, 'Range Rover'),
(43, 465, 'Defender'),
(43, 466, 'Discovery'),
(43, 467, 'Freelander'),
(43, 468, 'Range Rover Sport'),
(43, 469, 'Discovery 4'),
(43, 470, 'Range Rover Evoque'),
(44, 471, 'Maxus'),
(45, 472, 'Ls400'),
(45, 473, 'Ls430'),
(45, 474, 'Gs300'),
(45, 475, 'Is200'),
(45, 476, 'Rx300'),
(45, 477, 'Gs430'),
(45, 478, 'Gs460'),
(45, 479, 'Sc430'),
(45, 480, 'Is300'),
(45, 481, 'Is250'),
(45, 482, 'Rx400h'),
(45, 483, 'Is220d'),
(45, 484, 'Rx350'),
(45, 485, 'Gs450h'),
(45, 486, 'Ls460'),
(45, 487, 'Ls600h'),
(45, 488, 'Ls'),
(45, 489, 'Gs'),
(45, 490, 'Is'),
(45, 491, 'Sc'),
(45, 492, 'Rx'),
(45, 493, 'Ct'),
(46, 494, 'Elise'),
(46, 495, 'Exige'),
(47, 496, 'Bolero Pickup'),
(47, 497, 'Goa Pickup'),
(47, 498, 'Goa'),
(47, 499, 'Cj'),
(47, 500, 'Pikup'),
(47, 501, 'Thar'),
(48, 502, 'Ghibli'),
(48, 503, 'Shamal'),
(48, 504, 'Quattroporte'),
(48, 505, '3200 Gt'),
(48, 506, 'Coupe'),
(48, 507, 'Spyder'),
(48, 508, 'Gransport'),
(48, 509, 'Granturismo'),
(48, 510, '430'),
(48, 511, 'Biturbo'),
(48, 512, '228'),
(48, 513, '224'),
(48, 514, 'Grancabrio'),
(49, 515, 'Maybach'),
(50, 516, 'Xedos 6'),
(50, 517, '626'),
(50, 518, '121'),
(50, 519, 'Xedos 9'),
(50, 520, '323'),
(50, 521, 'Mx3'),
(50, 522, 'Rx7'),
(50, 523, 'Mx5'),
(50, 524, 'Mazda3'),
(50, 525, 'Mpv'),
(50, 526, 'Demio'),
(50, 527, 'Premacy'),
(50, 528, 'Tribute'),
(50, 529, 'Mazda6'),
(50, 530, 'Mazda2'),
(50, 531, 'Rx8'),
(50, 532, 'Mazda5'),
(50, 533, 'Cx7'),
(50, 534, 'Serie B'),
(50, 535, 'B2500'),
(50, 536, 'Bt50'),
(50, 537, 'Mx6'),
(50, 538, '929'),
(50, 539, 'Cx5'),
(51, 540, 'Clase C'),
(51, 541, 'Clase E'),
(51, 542, 'Clase Sl'),
(51, 543, 'Clase S'),
(51, 544, 'Clase Cl'),
(51, 545, 'Clase G'),
(51, 546, 'Clase Slk'),
(51, 547, 'Clase V'),
(51, 548, 'Viano'),
(51, 549, 'Clase Clk'),
(51, 550, 'Clase A'),
(51, 551, 'Clase M'),
(51, 552, 'Vaneo'),
(51, 553, 'Slklasse'),
(51, 554, 'Slr Mclaren'),
(51, 555, 'Clase Cls'),
(51, 556, 'Clase R'),
(51, 557, 'Clase Gl'),
(51, 558, 'Clase B'),
(51, 559, '100d'),
(51, 560, '140d'),
(51, 561, '180d'),
(51, 562, 'Sprinter'),
(51, 563, 'Vito'),
(51, 564, 'Transporter'),
(51, 565, '280'),
(51, 566, '220'),
(51, 567, '200'),
(51, 568, '190'),
(51, 569, '600'),
(51, 570, '400'),
(51, 571, 'Clase Sl R129'),
(51, 572, '300'),
(51, 573, '500'),
(51, 574, '420'),
(51, 575, '260'),
(51, 576, '230'),
(51, 577, 'Clase Clc'),
(51, 578, 'Clase Glk'),
(51, 579, 'Sls Amg'),
(52, 580, 'Mgf'),
(52, 581, 'Tf'),
(52, 582, 'Zr'),
(52, 583, 'Zs'),
(52, 584, 'Zt'),
(52, 585, 'Ztt'),
(52, 586, 'Mini'),
(52, 587, 'Countryman'),
(52, 588, 'Paceman'),
(54, 589, 'Montero'),
(54, 590, 'Galant'),
(54, 591, 'Colt'),
(54, 592, 'Space Wagon'),
(54, 593, 'Space Runner'),
(54, 594, 'Space Gear'),
(54, 595, '3000 Gt'),
(54, 596, 'Carisma'),
(54, 597, 'Eclipse'),
(54, 598, 'Space Star'),
(54, 599, 'Montero Sport'),
(54, 600, 'Montero Io'),
(54, 601, 'Outlander'),
(54, 602, 'Lancer'),
(54, 603, 'Grandis'),
(54, 604, 'L200'),
(54, 605, 'Canter'),
(54, 606, '300 Gt'),
(54, 607, 'Asx'),
(54, 608, 'Imiev'),
(55, 609, '44'),
(55, 610, 'Plus 8'),
(55, 611, 'Aero 8'),
(55, 612, 'V6'),
(55, 613, 'Roadster'),
(55, 614, '4'),
(55, 615, 'Plus 4'),
(56, 616, 'Terrano Ii'),
(56, 617, 'Terrano'),
(56, 618, 'Micra'),
(56, 619, 'Sunny'),
(56, 620, 'Primera'),
(56, 621, 'Serena'),
(56, 622, 'Patrol'),
(56, 623, 'Maxima Qx'),
(56, 624, '200 Sx'),
(56, 625, '300 Zx'),
(56, 626, 'Patrol Gr'),
(56, 627, '100 Nx'),
(56, 628, 'Almera'),
(56, 629, 'Pathfinder'),
(56, 630, 'Almera Tino'),
(56, 631, 'Xtrail'),
(56, 632, '350z'),
(56, 633, 'Murano'),
(56, 634, 'Note'),
(56, 635, 'Qashqai'),
(56, 636, 'Tiida'),
(56, 637, 'Vanette'),
(56, 638, 'Trade'),
(56, 639, 'Vanette Cargo'),
(56, 640, 'Pickup'),
(56, 641, 'Navara'),
(56, 642, 'Cabstar E'),
(56, 643, 'Cabstar'),
(56, 644, 'Maxima'),
(56, 645, 'Camion'),
(56, 646, 'Prairie'),
(56, 647, 'Bluebird'),
(56, 648, 'Np300 Pick Up'),
(56, 649, 'Qashqai2'),
(56, 650, 'Pixo'),
(56, 651, 'Gtr'),
(56, 652, '370z'),
(56, 653, 'Cube'),
(56, 654, 'Juke'),
(56, 655, 'Leaf'),
(56, 656, 'Evalia'),
(57, 657, 'Astra'),
(57, 658, 'Vectra'),
(57, 659, 'Calibra'),
(57, 660, 'Corsa'),
(57, 661, 'Omega'),
(57, 662, 'Frontera'),
(57, 663, 'Tigra'),
(57, 664, 'Monterey'),
(57, 665, 'Sintra'),
(57, 666, 'Zafira'),
(57, 667, 'Agila'),
(57, 668, 'Speedster'),
(57, 669, 'Signum'),
(57, 670, 'Meriva'),
(57, 671, 'Antara'),
(57, 672, 'Gt'),
(57, 673, 'Combo'),
(57, 674, 'Movano'),
(57, 675, 'Vivaro'),
(57, 676, 'Kadett'),
(57, 677, 'Monza'),
(57, 678, 'Senator'),
(57, 679, 'Rekord'),
(57, 680, 'Manta'),
(57, 681, 'Ascona'),
(57, 682, 'Insignia'),
(57, 683, 'Zafira Tourer'),
(57, 684, 'Ampera'),
(57, 685, 'Mokka'),
(57, 686, 'Adam'),
(58, 687, '306'),
(58, 688, '605'),
(58, 689, '106'),
(58, 690, '205'),
(58, 691, '405'),
(58, 692, '406'),
(58, 693, '806'),
(58, 694, '807'),
(58, 695, '407'),
(58, 696, '307'),
(58, 697, '206'),
(58, 698, '607'),
(58, 699, '308'),
(58, 700, '307 Sw'),
(58, 701, '206 Sw'),
(58, 702, '407 Sw'),
(58, 703, '1007'),
(58, 704, '107'),
(58, 705, '207'),
(58, 706, '4007'),
(58, 707, 'Boxer'),
(58, 708, 'Partner'),
(58, 709, 'J5'),
(58, 710, '604'),
(58, 711, '505'),
(58, 712, '309'),
(58, 713, 'Bipper'),
(58, 714, 'Partner Origin'),
(58, 715, '3008'),
(58, 716, '5008'),
(58, 717, 'Rcz'),
(58, 718, '508'),
(58, 719, 'Ion'),
(58, 720, '208'),
(58, 721, '4008'),
(59, 722, 'Trans Sport'),
(59, 723, 'Firebird'),
(59, 724, 'Trans Am'),
(60, 725, '911'),
(60, 726, 'Boxster'),
(60, 727, 'Cayenne'),
(60, 728, 'Carrera Gt'),
(60, 729, 'Cayman'),
(60, 730, '928'),
(60, 731, '968'),
(60, 732, '944'),
(60, 733, '924'),
(60, 734, 'Panamera'),
(60, 735, '918'),
(61, 736, 'Megane'),
(61, 737, 'Safrane'),
(61, 738, 'Laguna'),
(61, 739, 'Clio'),
(61, 740, 'Twingo'),
(61, 741, 'Nevada'),
(61, 742, 'Espace'),
(61, 743, 'Spider'),
(61, 744, 'Scenic'),
(61, 745, 'Grand Espace'),
(61, 746, 'Avantime'),
(61, 747, 'Vel Satis'),
(61, 748, 'Grand Scenic'),
(61, 749, 'Clio Campus'),
(61, 750, 'Modus'),
(61, 751, 'Express'),
(61, 752, 'Trafic'),
(61, 753, 'Master'),
(61, 754, 'Kangoo'),
(61, 755, 'Mascott'),
(61, 756, 'Master Propulsion'),
(61, 757, 'Maxity'),
(61, 758, 'R19'),
(61, 759, 'R25'),
(61, 760, 'R5'),
(61, 761, 'R21'),
(61, 762, 'R4'),
(61, 763, 'Alpine'),
(61, 764, 'Fuego'),
(61, 765, 'R18'),
(61, 766, 'R11'),
(61, 767, 'R9'),
(61, 768, 'R6'),
(61, 769, 'Grand Modus'),
(61, 770, 'Kangoo Combi'),
(61, 771, 'Koleos'),
(61, 772, 'Fluence'),
(61, 773, 'Wind'),
(61, 774, 'Latitude'),
(61, 775, 'Grand Kangoo Combi'),
(62, 776, 'Siver Dawn'),
(62, 777, 'Silver Spur'),
(62, 778, 'Park Ward'),
(62, 779, 'Silver Seraph'),
(62, 780, 'Corniche'),
(62, 781, 'Phantom'),
(62, 782, 'Touring'),
(62, 783, 'Silvier'),
(63, 784, '800'),
(63, 785, '600'),
(63, 786, '100'),
(63, 787, '200'),
(63, 788, 'Coupe'),
(63, 789, '400'),
(63, 790, '45'),
(63, 791, 'Cabriolet'),
(63, 792, '25'),
(63, 793, 'Mini'),
(63, 794, '75'),
(63, 795, 'Streetwise'),
(63, 796, 'Sd'),
(64, 797, '900'),
(64, 798, '93'),
(64, 799, '9000'),
(64, 800, '95'),
(64, 801, '93x'),
(64, 802, '94x'),
(65, 803, '300'),
(65, 804, '350'),
(65, 805, 'Anibal'),
(65, 806, 'Anibal Pick Up'),
(66, 807, 'Ibiza'),
(66, 808, 'Cordoba'),
(66, 809, 'Toledo'),
(66, 810, 'Marbella'),
(66, 811, 'Alhambra'),
(66, 812, 'Arosa'),
(66, 813, 'Leon'),
(66, 814, 'Altea'),
(66, 815, 'Altea Xl'),
(66, 816, 'Altea Freetrack'),
(66, 817, 'Terra'),
(66, 818, 'Inca'),
(66, 819, 'Malaga'),
(66, 820, 'Ronda'),
(66, 821, 'Exeo'),
(66, 822, 'Mii'),
(67, 823, 'Felicia'),
(67, 824, 'Forman'),
(67, 825, 'Octavia'),
(67, 826, 'Octavia Tour'),
(67, 827, 'Fabia'),
(67, 828, 'Superb'),
(67, 829, 'Roomster'),
(67, 830, 'Scout'),
(67, 831, 'Pickup'),
(67, 832, 'Favorit'),
(67, 833, '130'),
(67, 834, 'S'),
(67, 835, 'Yeti'),
(67, 836, 'Citigo'),
(67, 837, 'Rapid'),
(68, 838, 'Smart'),
(68, 839, 'Citycoupe'),
(68, 840, 'Fortwo'),
(68, 841, 'Cabrio'),
(68, 842, 'Crossblade'),
(68, 843, 'Roadster'),
(68, 844, 'Forfour'),
(69, 845, 'Korando'),
(69, 846, 'Family'),
(69, 847, 'K4d'),
(69, 848, 'Musso'),
(69, 849, 'Korando Kj'),
(69, 850, 'Rexton'),
(69, 851, 'Rexton Ii'),
(69, 852, 'Rodius'),
(69, 853, 'Kyron'),
(69, 854, 'Actyon'),
(69, 855, 'Sports Pick Up'),
(69, 856, 'Actyon Sports Pick Up'),
(69, 857, 'Kodando'),
(70, 858, 'Legacy'),
(70, 859, 'Impreza'),
(70, 860, 'Svx'),
(70, 861, 'Justy'),
(70, 862, 'Outback'),
(70, 863, 'Forester'),
(70, 864, 'G3x Justy'),
(70, 865, 'B9 Tribeca'),
(70, 866, 'Xt'),
(70, 867, '1800'),
(70, 868, 'Tribeca'),
(70, 869, 'Wrx Sti'),
(70, 870, 'Trezia'),
(70, 871, 'Xv'),
(70, 872, 'Brz'),
(71, 873, 'Maruti'),
(71, 874, 'Swift'),
(71, 875, 'Vitara'),
(71, 876, 'Baleno'),
(71, 877, 'Samurai'),
(71, 878, 'Alto'),
(71, 879, 'Wagon R'),
(71, 880, 'Jimny'),
(71, 881, 'Grand Vitara'),
(71, 882, 'Ignis'),
(71, 883, 'Liana'),
(71, 884, 'Grand Vitara Xl7'),
(71, 885, 'Sx4'),
(71, 886, 'Splash'),
(71, 887, 'Kizashi'),
(72, 888, 'Samba'),
(72, 889, 'Tagora'),
(72, 890, 'Solara'),
(72, 891, 'Horizon'),
(73, 892, 'Telcosport'),
(73, 893, 'Telco'),
(73, 894, 'Sumo'),
(73, 895, 'Safari'),
(73, 896, 'Indica'),
(73, 897, 'Indigo'),
(73, 898, 'Grand Safari'),
(73, 899, 'Tl Pick Up'),
(73, 900, 'Xenon Pick Up'),
(73, 901, 'Vista'),
(73, 902, 'Xenon'),
(73, 903, 'Aria'),
(74, 904, 'Carina E'),
(74, 905, '4runner'),
(74, 906, 'Camry'),
(74, 907, 'Rav4'),
(74, 908, 'Celica'),
(74, 909, 'Supra'),
(74, 910, 'Paseo'),
(74, 911, 'Land Cruiser 80'),
(74, 912, 'Land Cruiser 100'),
(74, 913, 'Land Cruiser'),
(74, 914, 'Land Cruiser 90'),
(74, 915, 'Corolla'),
(74, 916, 'Auris'),
(74, 917, 'Avensis'),
(74, 918, 'Picnic'),
(74, 919, 'Yaris'),
(74, 920, 'Yaris Verso'),
(74, 921, 'Mr2'),
(74, 922, 'Previa'),
(74, 923, 'Prius'),
(74, 924, 'Avensis Verso'),
(74, 925, 'Corolla Verso'),
(74, 926, 'Corolla Sedan'),
(74, 927, 'Aygo'),
(74, 928, 'Hilux'),
(74, 929, 'Dyna'),
(74, 930, 'Land Cruiser 200'),
(74, 931, 'Verso'),
(74, 932, 'Iq'),
(74, 933, 'Urban Cruiser'),
(74, 934, 'Gt86'),
(75, 935, '100'),
(75, 936, '121'),
(76, 937, '214'),
(76, 938, '110 Stawra'),
(76, 939, '111 Stawra'),
(76, 940, '215'),
(76, 941, '112 Stawra'),
(77, 942, 'Passat'),
(77, 943, 'Golf'),
(77, 944, 'Vento'),
(77, 945, 'Polo'),
(77, 946, 'Corrado'),
(77, 947, 'Sharan'),
(77, 948, 'Lupo'),
(77, 949, 'Bora'),
(77, 950, 'Jetta'),
(77, 951, 'New Beetle'),
(77, 952, 'Phaeton'),
(77, 953, 'Touareg'),
(77, 954, 'Touran'),
(77, 955, 'Multivan'),
(77, 956, 'Caddy'),
(77, 957, 'Golf Plus'),
(77, 958, 'Fox'),
(77, 959, 'Eos'),
(77, 960, 'Caravelle'),
(77, 961, 'Tiguan'),
(77, 962, 'Transporter'),
(77, 963, 'Lt'),
(77, 964, 'Taro'),
(77, 965, 'Crafter'),
(77, 966, 'California'),
(77, 967, 'Santana'),
(77, 968, 'Scirocco'),
(77, 969, 'Passat Cc'),
(77, 970, 'Amarok'),
(77, 971, 'Beetle'),
(77, 972, 'Up'),
(77, 973, 'Cc'),
(78, 974, '440'),
(78, 975, '850'),
(78, 976, 'S70'),
(78, 977, 'V70'),
(78, 978, 'V70 Classic'),
(78, 979, '940'),
(78, 980, '480'),
(78, 981, '460'),
(78, 982, '960'),
(78, 983, 'S90'),
(78, 984, 'V90'),
(78, 985, 'Classic'),
(78, 986, 'S40'),
(78, 987, 'V40'),
(78, 988, 'V50'),
(78, 989, 'V70 Xc'),
(78, 990, 'Xc70'),
(78, 991, 'C70'),
(78, 992, 'S80'),
(78, 993, 'S60'),
(78, 994, 'Xc90'),
(78, 995, 'C30'),
(78, 996, '780'),
(78, 997, '760'),
(78, 998, '740'),
(78, 999, '240'),
(78, 1000, '360'),
(78, 1001, '340'),
(78, 1002, 'Xc60'),
(78, 1003, 'V60'),
(78, 1004, 'V40 Cross Country'),
(79, 1005, '353'),
(53, 1006, 'Mini'),
(53, 1007, 'Countryman'),
(53, 1008, 'Paceman');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(30) NOT NULL,
  `nombre` varchar(256) NOT NULL,
  `descripcion` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_por_rol`
--

CREATE TABLE `permiso_por_rol` (
  `id` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recuerdame_sesion`
--

CREATE TABLE `recuerdame_sesion` (
  `id` int(30) NOT NULL,
  `hash` varchar(256) NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `id_usuario` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `recuerdame_sesion`
--

INSERT INTO `recuerdame_sesion` (`id`, `hash`, `fecha_fin`, `id_usuario`) VALUES
(21, '28ec6974505ec0fc5f0651a57e8296cf', '2021-12-13 16:41:48', 35),
(23, '492b27fadbcdb4193726e48b70f5713a', '2021-12-15 19:21:47', 37),
(24, '29f5e1609ed326c051845e2656aa66f0', '2021-12-15 21:15:59', 37),
(27, '307d842e35d5cf0a1e8ffa0cb058e0c8', '2021-12-16 01:22:18', 37),
(28, '584280b9b07685229a03a1da444e78a4', '2021-12-16 16:56:04', 37),
(29, '88837f9b8a3d9d21bc1a39c75d7f9ab6', '2021-12-16 18:44:37', 32),
(79, 'b41f773d546d6a62428a03aec5a2146a', '2021-12-18 09:52:45', 36),
(87, '85c61ee12c0f1dd2f2ed78f0103f15f6', '2021-12-18 11:12:08', 38),
(109, 'c635a0d32f68e4186e930c0a6b7b6954', '2022-01-08 00:04:46', 37),
(114, 'b75860230d435e91f4fb28b41fdf6970', '2022-01-08 13:06:02', 37),
(144, '24ac71a52e43a804399119a076a2cb63', '2022-01-11 18:58:14', 37),
(167, 'e5d45f10e5eb17eb51f548f5e75c3203', '2022-01-12 22:08:02', 36);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Administrador', 'Administrador del sistema '),
(2, 'Vendedor', 'Realiza la venta de estadias en la calle'),
(3, 'Inspector', 'Realiza multas a los vehículos en infracción'),
(4, 'Cliente', 'Usuario con el dominio de un vehículo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjetas_de_credito`
--

CREATE TABLE `tarjetas_de_credito` (
  `id` int(30) NOT NULL,
  `numero` int(100) NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `codigo_de_seguridad` varchar(1000) NOT NULL,
  `id_usuario` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tarjetas_de_credito`
--

INSERT INTO `tarjetas_de_credito` (`id`, `numero`, `fecha_vencimiento`, `codigo_de_seguridad`, `id_usuario`) VALUES
(24, 1, '2021-12-31', '$2y$10$aLNSzl4JUfVqzW9k6yIArepAJTeggVljq06jaAKYJ3Cym90.kNG2u', 37),
(25, 2, '2021-12-31', '$2y$10$FkaQUeLLt6HBqvw9Cilzv.d5JcczTqzB9iH13mBt.Bjd5BzwfPLQa', 37);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(30) NOT NULL,
  `dni` varchar(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `fecha_de_nacimiento` date NOT NULL,
  `password` varchar(1000) NOT NULL,
  `id_rol` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `dni`, `nombre`, `apellido`, `email`, `fecha_de_nacimiento`, `password`, `id_rol`) VALUES
(32, '40778000', 'Nicolas ', 'Gomez', 'nico@gmail.com', '2010-03-10', '$2y$10$uPNkehMNrbvc4mSohq23fOTqLJKarWkWD9xqW1h.gY7.sGMTfFVDi', 1),
(33, '43555000', 'Martina Anabel', 'García', 'martinagarciaa012@gmail.com', '2021-10-06', '$2y$10$CJtzNb95H0XcTjb8tjiFaOTON/u5saQ39JZkOs5DoHYCleKyvJ9gG', 1),
(34, '37656222', 'Ricardo', 'Arjona', 'admin@gmail.com', '2021-11-03', '$2y$10$7jefep80E.lJT21fH2xVbeVfB0vYOr8q9rE1iTmjF.5SyIaPMVPLu', 1),
(35, '27565848', 'Jorge', 'Riquelme', 'vendedor@gmail.com', '2021-11-02', '$2y$10$RnUMglO3LDxlgAhNHdP6g.LUVz.nuAiE90Z4G/evIEEeZ3wDXMzWK', 2),
(36, '41444787', 'Susana', 'Lopez', 'inspector@gmail.com', '2021-03-17', '$2y$10$380alf8yHQORGRi7WqW5XeSExmf9FMp0vA5FxQ4oLjX0DHWU2EiGa', 3),
(37, '19565489', 'Juan Carlos ', 'Rodriguez', 'cliente1@gmail.com', '2021-07-22', '$2y$10$Uw9pvd.OHL5u/2oe5BCwZOPuFtw4CtKLt2lSVIS/9bCCeaNVoZ21y', 4),
(38, '30565878', 'Armando', 'Paredes', 'cliente3@gmail.com', '2021-11-02', '$2y$10$/gaKMPyXEpYcrgNooKnDGe.tUtLz6S3VZx8w8jBs1MjF/gEaVEb/e', 4),
(39, '35784123', 'Carlitos', 'Perez', 'cliente2@gmail.com', '2021-11-03', '$2y$10$QhG8lgAG7k796NgCqGMzH.SPzbbA1kw3tqF9qcDf8u9nbZqPT6jNu', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` int(30) NOT NULL,
  `patente` varchar(256) NOT NULL,
  `marca` varchar(256) NOT NULL,
  `modelo` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`id`, `patente`, `marca`, `modelo`) VALUES
(12, 'EEE333', '61', '767'),
(13, 'AA123AA', '7', '57'),
(14, 'ABC123', '14', '125'),
(15, 'AAA122', '19', '209'),
(16, 'LLL333', '1', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(30) NOT NULL,
  `esta_pago` tinyint(1) NOT NULL,
  `id_vendedor` int(30) NOT NULL,
  `id_estadia` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `esta_pago`, `id_vendedor`, `id_estadia`) VALUES
(9, 0, 35, 102),
(10, 0, 35, 174),
(11, 0, 35, 172),
(12, 0, 35, 176),
(13, 0, 35, 180);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas`
--

CREATE TABLE `zonas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(256) NOT NULL,
  `descripcion` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `zonas`
--

INSERT INTO `zonas` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Zona 1', 'Microcentro de Lunes a Viernes '),
(2, 'Zona 2', 'Macrocentro de Lunes a Viernes');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cuenta_usuario` (`id_usuario`);

--
-- Indices de la tabla `dominio_vehiculo`
--
ALTER TABLE `dominio_vehiculo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dominio_id_usuario` (`id_usuario`),
  ADD KEY `dominio_id_vehiculo` (`id_vehiculo`);

--
-- Indices de la tabla `estadias`
--
ALTER TABLE `estadias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estadias_id_dominio_vehiculo` (`id_dominio_vehiculo`),
  ADD KEY `estadias_id_zona` (`id_historial_zona`);

--
-- Indices de la tabla `historial_zonas`
--
ALTER TABLE `historial_zonas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `historial_id_zona` (`id_zona`);

--
-- Indices de la tabla `infracciones`
--
ALTER TABLE `infracciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `infraccion_id_dominio_vehiculo` (`id_dominio_vehiculo`),
  ADD KEY `infraccion_id_zona` (`id_historial_zona`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permiso_por_rol`
--
ALTER TABLE `permiso_por_rol`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permisos_id_rol` (`id_rol`),
  ADD KEY `permisos_id_permisos` (`id_permiso`);

--
-- Indices de la tabla `recuerdame_sesion`
--
ALTER TABLE `recuerdame_sesion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recuerdame_id_usuario` (`id_usuario`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tarjetas_de_credito`
--
ALTER TABLE `tarjetas_de_credito`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero` (`numero`),
  ADD KEY `tarjeta_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `DNI` (`dni`),
  ADD KEY `usuarios_id_rol_fk` (`id_rol`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `patente` (`patente`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venta_id_vendedor` (`id_vendedor`),
  ADD KEY `venta_id_estadia` (`id_estadia`);

--
-- Indices de la tabla `zonas`
--
ALTER TABLE `zonas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `dominio_vehiculo`
--
ALTER TABLE `dominio_vehiculo`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `estadias`
--
ALTER TABLE `estadias`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT de la tabla `historial_zonas`
--
ALTER TABLE `historial_zonas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `infracciones`
--
ALTER TABLE `infracciones`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permiso_por_rol`
--
ALTER TABLE `permiso_por_rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recuerdame_sesion`
--
ALTER TABLE `recuerdame_sesion`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tarjetas_de_credito`
--
ALTER TABLE `tarjetas_de_credito`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `zonas`
--
ALTER TABLE `zonas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD CONSTRAINT `cuenta_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `dominio_vehiculo`
--
ALTER TABLE `dominio_vehiculo`
  ADD CONSTRAINT `dominio_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `dominio_id_vehiculo` FOREIGN KEY (`id_vehiculo`) REFERENCES `vehiculos` (`id`);

--
-- Filtros para la tabla `estadias`
--
ALTER TABLE `estadias`
  ADD CONSTRAINT `estadias_id_dominio_vehiculo` FOREIGN KEY (`id_dominio_vehiculo`) REFERENCES `dominio_vehiculo` (`id`),
  ADD CONSTRAINT `estadias_id_historial_zona` FOREIGN KEY (`id_historial_zona`) REFERENCES `historial_zonas` (`id`);

--
-- Filtros para la tabla `historial_zonas`
--
ALTER TABLE `historial_zonas`
  ADD CONSTRAINT `historial_id_zona` FOREIGN KEY (`id_zona`) REFERENCES `zonas` (`id`);

--
-- Filtros para la tabla `infracciones`
--
ALTER TABLE `infracciones`
  ADD CONSTRAINT `infraccion_id_dominio_vehiculo` FOREIGN KEY (`id_dominio_vehiculo`) REFERENCES `dominio_vehiculo` (`id`),
  ADD CONSTRAINT `infraccion_id_zona` FOREIGN KEY (`id_historial_zona`) REFERENCES `historial_zonas` (`id`);

--
-- Filtros para la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD CONSTRAINT `modelo_marca_fk` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id`);

--
-- Filtros para la tabla `permiso_por_rol`
--
ALTER TABLE `permiso_por_rol`
  ADD CONSTRAINT `permisos_id_permisos` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id`),
  ADD CONSTRAINT `permisos_id_rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`);

--
-- Filtros para la tabla `recuerdame_sesion`
--
ALTER TABLE `recuerdame_sesion`
  ADD CONSTRAINT `recuerdame_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `tarjetas_de_credito`
--
ALTER TABLE `tarjetas_de_credito`
  ADD CONSTRAINT `tarjeta_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_id_rol_fk` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `venta_id_estadia` FOREIGN KEY (`id_estadia`) REFERENCES `estadias` (`id`),
  ADD CONSTRAINT `venta_id_vendedor` FOREIGN KEY (`id_vendedor`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-04-2021 a las 22:13:32
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fincasoft`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `animal`
--

CREATE TABLE `animal` (
  `id_animal` int(11) NOT NULL,
  `referencia` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_dominio_tipo` int(11) NOT NULL,
  `id_dominio_raza` int(11) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT current_timestamp(),
  `id_dominio_estado` int(11) DEFAULT NULL,
  `prenado` int(11) NOT NULL DEFAULT 0,
  `fecha_deteccion_prenado` date DEFAULT NULL,
  `peso` double DEFAULT NULL,
  `id_dominio_sexo` int(11) DEFAULT NULL,
  `color` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_padre` int(11) DEFAULT NULL,
  `id_madre` int(11) DEFAULT NULL,
  `estado_corporal` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_dominio_origen` int(11) DEFAULT NULL,
  `id_tercero_propietario` int(11) DEFAULT NULL,
  `id_usuario_registra` int(11) DEFAULT NULL,
  `motivo_anulacion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_usuario_anula` int(11) DEFAULT NULL,
  `fecha_anula` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `imagen` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `animal`
--

INSERT INTO `animal` (`id_animal`, `referencia`, `id_dominio_tipo`, `id_dominio_raza`, `fecha_nacimiento`, `id_dominio_estado`, `prenado`, `fecha_deteccion_prenado`, `peso`, `id_dominio_sexo`, `color`, `id_padre`, `id_madre`, `estado_corporal`, `id_dominio_origen`, `id_tercero_propietario`, `id_usuario_registra`, `motivo_anulacion`, `id_usuario_anula`, `fecha_anula`, `imagen`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'VC-01', 5, 8, '2019-04-01', 11, 0, NULL, 155, 26, '#8b6746', NULL, NULL, 'Normal', 14, 3, 2, '', NULL, '2021-04-16 03:57:14', '4568_VC-01.jpg', 1, '2021-04-02 22:37:23', '2021-04-13 01:45:50'),
(2, 'VC-02', 5, 8, '2015-03-19', 12, 1, '2021-06-10', 234, 25, NULL, NULL, NULL, 'Normal', 15, 3, 2, '', NULL, '2021-04-18 17:46:06', '6238_VC-02.jpg', 1, '2021-04-02 23:09:51', '2021-04-02 23:14:48'),
(3, 'BOV-01', 5, 9, '2016-01-01', 11, 1, '2021-05-16', 135, 25, '#1410ea', NULL, 2, 'Normal', 15, 4, 2, '', NULL, '2021-04-18 17:19:33', '5545_BOV-01.jpg', 1, '2021-04-08 00:14:55', '2021-04-15 04:58:33'),
(4, 'BOV-10', 5, 9, '2019-01-15', 47, 1, '2021-05-15', 250, 25, '#000000', NULL, 3, 'Normal', 14, 3, 2, 'se vendio', 2, '2021-04-18 17:19:37', '7265_BOV-10.jpg', 0, '2021-04-16 00:10:59', '2021-04-16 04:10:12'),
(5, 'BOV-10-01', 5, 9, '2021-04-15', 45, 0, NULL, 56, 26, '#000000', NULL, 4, 'Normal', 14, 3, 2, '', NULL, '2021-04-16 03:57:14', '', 1, '2021-04-16 03:16:28', '2021-04-16 03:16:28'),
(6, 'BOV-10-02', 5, 9, '2021-04-15', 45, 0, NULL, 35, 25, '#e3e3e3', NULL, 4, 'Normal', 14, 3, 2, '', NULL, '2021-04-16 03:57:14', '', 1, '2021-04-16 03:16:28', '2021-04-16 03:16:28'),
(7, 'BOV-10-04', 5, 9, '2021-04-15', 45, 0, NULL, 70, 26, '#795858', NULL, 4, 'Normal', 14, 3, 2, 'se vendio', 2, '2021-04-16 04:12:04', '', 1, '2021-04-16 04:10:12', '2021-04-16 04:12:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `animal_pesaje`
--

CREATE TABLE `animal_pesaje` (
  `id_animal_pesaje` int(11) NOT NULL,
  `id_animal` int(11) NOT NULL,
  `peso_anterior` double NOT NULL,
  `peso_medido` double NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_usuario_registra` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `animal_pesaje`
--

INSERT INTO `animal_pesaje` (`id_animal_pesaje`, `id_animal`, `peso_anterior`, `peso_medido`, `fecha`, `id_usuario_registra`, `estado`, `created_at`, `updated_at`) VALUES
(4, 3, 120, 120, '2021-04-12 20:12:59', 2, 1, '2021-04-12 20:13:09', '2021-04-12 20:13:09'),
(5, 3, 120, 140, '2021-04-12 20:15:20', 2, 1, '2021-04-12 20:15:27', '2021-04-12 20:15:27'),
(6, 3, 140, 150, '2021-04-12 20:15:36', 2, 1, '2021-04-12 20:15:43', '2021-04-12 20:15:43'),
(7, 3, 150, 135, '2021-04-12 20:15:52', 2, 1, '2021-04-12 20:16:22', '2021-04-12 20:16:22'),
(8, 1, 120, 155, '2021-04-11 03:00:00', 2, 1, '2021-04-13 01:45:50', '2021-04-13 01:45:50'),
(9, 4, 200, 199, '2021-04-16 00:23:04', 2, 1, '2021-04-16 00:23:56', '2021-04-16 00:23:56'),
(10, 4, 199, 250, '2021-04-16 00:24:40', 2, 1, '2021-04-16 00:24:51', '2021-04-16 00:24:51'),
(11, 7, 30, 85, '2021-04-16 04:10:58', 2, 1, '2021-04-16 04:11:16', '2021-04-16 04:11:16'),
(12, 7, 85, 70, '2021-04-16 04:11:40', 2, 1, '2021-04-16 04:12:04', '2021-04-16 04:12:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `animal_produccion`
--

CREATE TABLE `animal_produccion` (
  `id_animal_produccion` int(11) NOT NULL,
  `id_animal` int(11) NOT NULL,
  `id_dominio_unidad_medida` int(11) NOT NULL,
  `valor_produccion` double NOT NULL,
  `fecha_inicio` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_fin` timestamp NOT NULL DEFAULT current_timestamp(),
  `observaciones` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_dominio_concepto` int(11) NOT NULL,
  `id_usuario_registra` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `animal_produccion`
--

INSERT INTO `animal_produccion` (`id_animal_produccion`, `id_animal`, `id_dominio_unidad_medida`, `valor_produccion`, `fecha_inicio`, `fecha_fin`, `observaciones`, `id_dominio_concepto`, `id_usuario_registra`, `estado`, `created_at`, `updated_at`) VALUES
(1, 3, 37, 99, '2021-04-01 22:13:14', '2021-04-07 22:13:14', 'Voto muchos litros el dia 5', 35, 2, 1, '2021-04-12 22:13:57', '2021-04-12 22:13:57'),
(2, 3, 37, 100, '2021-04-08 22:15:14', '2021-04-12 22:15:14', 'Ultimo dia voto bastante leche casi 35 litros', 35, 2, 1, '2021-04-12 22:16:04', '2021-04-12 22:16:39'),
(3, 4, 37, 100, '2021-04-09 00:25:41', '2021-04-16 00:25:41', NULL, 35, 2, 1, '2021-04-16 00:27:19', '2021-04-16 00:27:19'),
(4, 7, 37, 120, '2021-04-02 04:12:26', '2021-04-09 04:12:26', 'Todo ok', 35, 2, 1, '2021-04-16 04:13:07', '2021-04-16 04:13:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `id_caja` int(11) NOT NULL,
  `id_dominio_movimiento` int(11) NOT NULL,
  `id_usuario_registra` int(11) NOT NULL,
  `valor` double NOT NULL,
  `concepto` text COLLATE utf8_spanish_ci NOT NULL,
  `observaciones` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_usuario_anula` int(11) DEFAULT NULL,
  `fecha_anula` timestamp NULL DEFAULT NULL,
  `observaciones_anula` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id_caja`, `id_dominio_movimiento`, `id_usuario_registra`, `valor`, `concepto`, `observaciones`, `id_usuario_anula`, `fecha_anula`, `observaciones_anula`, `estado`, `created_at`, `updated_at`) VALUES
(4, 43, 2, 1200000, 'Compra de bovino BOV-10', 'SE COMPRO A LA FINCA DE AL LADO', NULL, NULL, NULL, 1, '2021-04-16 00:36:27', '2021-04-16 00:36:27'),
(5, 44, 2, 1000000, 'Pago de nomina Laura Maestre', 'Pago correspondiente al mes de marzo', NULL, '2021-04-16 00:39:37', 'Le pague demas', 0, '2021-04-16 00:38:12', '2021-04-16 00:39:37'),
(6, 43, 2, 2000000, 'Vendi una vaca', 'Me salio barata', 2, '2021-04-16 04:14:27', 'ME EQUIVOQUE', 0, '2021-04-16 04:04:43', '2021-04-16 04:14:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dominio`
--

CREATE TABLE `dominio` (
  `id_dominio` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_padre` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dominio`
--

INSERT INTO `dominio` (`id_dominio`, `nombre`, `descripcion`, `id_padre`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Tipos de animal', 'Familia del animal ', NULL, 1, '2021-03-20 16:26:16', '2021-03-20 16:26:16'),
(2, 'Razas', 'Raza del animal', NULL, 1, '2021-03-22 17:19:02', '2021-03-22 17:19:02'),
(3, 'Estado del animal', 'Estado del animal', NULL, 1, '2021-03-22 17:19:20', '2021-03-22 17:19:20'),
(4, 'Origenes del animal', 'Origenes del animal', NULL, 1, '2021-03-22 17:20:22', '2021-03-22 17:20:22'),
(5, 'Bovino', NULL, 1, 1, '2021-03-22 17:37:54', '2021-03-22 17:37:54'),
(6, 'Porcino', NULL, 1, 1, '2021-03-22 17:37:54', '2021-03-22 17:37:54'),
(7, 'Cabrito', NULL, 1, 1, '2021-03-22 17:37:54', '2021-03-22 17:37:54'),
(8, 'Angus', NULL, 2, 1, '2021-03-22 17:40:50', '2021-03-22 17:40:50'),
(9, 'Corriente', NULL, 2, 1, '2021-03-22 17:40:50', '2021-03-22 17:40:50'),
(10, 'Ninguno', NULL, 3, 1, '2021-03-22 17:56:10', '2021-03-22 17:56:10'),
(11, 'Cotero', NULL, 3, 1, '2021-03-22 17:56:10', '2021-03-22 17:56:10'),
(12, 'En ordeño', NULL, 3, 1, '2021-03-22 17:56:10', '2021-03-22 17:56:10'),
(14, 'Nacido en finca', NULL, 4, 1, '2021-03-22 18:19:45', '2021-03-22 18:19:45'),
(15, 'Comprado', NULL, 4, 1, '2021-03-22 18:19:45', '2021-03-22 18:19:45'),
(16, 'Tipos de identificacion', NULL, NULL, 1, '2021-03-22 18:29:50', '2021-03-22 18:29:50'),
(17, 'Cedula de ciudadania', NULL, 16, 1, '2021-03-22 18:31:48', '2021-03-22 18:31:48'),
(18, 'Numero de identificacion personal', NULL, 16, 1, '2021-03-22 18:31:48', '2021-03-22 18:31:48'),
(19, 'Numero de identificcion tributaria', NULL, 16, 1, '2021-03-22 18:31:48', '2021-03-22 18:31:48'),
(20, 'Estados de vacuna', NULL, NULL, 1, '2021-04-02 19:45:57', '2021-04-02 19:45:57'),
(21, 'Aplicada', NULL, 20, 1, '2021-04-02 19:47:16', '2021-04-02 19:47:16'),
(22, 'Programada', NULL, 20, 1, '2021-04-02 19:47:16', '2021-04-02 19:47:16'),
(23, 'Cancelada', NULL, 20, 1, '2021-04-02 19:47:16', '2021-04-02 19:47:16'),
(24, 'Sexo animal', NULL, NULL, 1, '2021-04-10 15:46:12', '2021-04-10 15:46:12'),
(25, 'Hembra', NULL, 24, 1, '2021-04-10 15:46:43', '2021-04-10 15:46:43'),
(26, 'Macho', NULL, 24, 1, '2021-04-10 15:47:02', '2021-04-10 15:47:02'),
(27, 'Tipos de tratamiento', NULL, NULL, 1, '2021-04-12 02:07:08', '2021-04-12 02:07:08'),
(28, 'Vacuna', NULL, 27, 1, '2021-04-12 02:09:28', '2021-04-12 02:09:28'),
(29, 'Purga', NULL, 27, 1, '2021-04-12 02:09:28', '2021-04-12 02:09:28'),
(30, 'Vitaminas', NULL, 27, 1, '2021-04-12 02:09:28', '2021-04-12 02:09:28'),
(31, 'Tratamiento de enfermedad', NULL, 27, 1, '2021-04-12 02:09:28', '2021-04-12 02:09:28'),
(32, 'Antibiotico', NULL, 27, 1, '2021-04-12 02:09:28', '2021-04-12 02:09:28'),
(33, 'Curacion', NULL, 27, 1, '2021-04-12 02:09:28', '2021-04-12 02:09:28'),
(34, 'Conceptos de produccion', 'Son aquellos conceptos que los animales producen', NULL, 1, '2021-04-12 20:43:28', '2021-04-12 20:43:28'),
(35, 'Leche', NULL, 34, 1, '2021-04-12 20:44:19', '2021-04-12 20:44:19'),
(36, 'Unidades de medida', NULL, NULL, 1, '2021-04-12 21:46:28', '2021-04-12 21:46:28'),
(37, 'Litros', NULL, 36, 1, '2021-04-12 21:47:59', '2021-04-12 21:47:59'),
(38, 'Mililitros', NULL, 36, 1, '2021-04-12 21:47:59', '2021-04-12 21:47:59'),
(39, 'Unidades', NULL, 36, 1, '2021-04-12 21:47:59', '2021-04-12 21:47:59'),
(40, 'Kilogramos', NULL, 36, 1, '2021-04-12 21:47:59', '2021-04-12 21:47:59'),
(41, 'Gramos', NULL, 36, 1, '2021-04-12 21:47:59', '2021-04-12 21:47:59'),
(42, 'Movimientos de caja', NULL, NULL, 1, '2021-04-15 16:42:44', '2021-04-15 16:42:44'),
(43, 'Ingreso', NULL, 42, 1, '2021-04-15 16:43:40', '2021-04-15 16:43:40'),
(44, 'Egreso', NULL, 42, 1, '2021-04-15 16:43:40', '2021-04-15 16:43:40'),
(45, 'Tetado', NULL, 3, 1, '2021-04-16 02:47:18', '2021-04-16 02:47:18'),
(46, 'Levante', NULL, 3, 1, '2021-04-16 02:47:52', '2021-04-16 02:47:52'),
(47, 'Amamantando', NULL, 3, 1, '2021-04-16 03:05:18', '2021-04-16 03:05:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id_perfil` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `nombre`, `descripcion`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Super Administrador', NULL, 1, '2021-02-22 02:12:08', '2021-02-22 02:12:08'),
(2, 'Administrador', NULL, 1, '2021-02-22 02:12:29', '2021-02-22 02:12:29'),
(3, 'Trabajador', NULL, 1, '2021-04-18 18:43:16', '2021-04-18 18:43:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tercero`
--

CREATE TABLE `tercero` (
  `id_tercero` int(11) NOT NULL,
  `id_dominio_tipo_identificacion` int(11) NOT NULL DEFAULT 17,
  `identificacion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombres` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellidos` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tercero`
--

INSERT INTO `tercero` (`id_tercero`, `id_dominio_tipo_identificacion`, `identificacion`, `nombres`, `apellidos`, `email`, `telefono`, `imagen`, `estado`, `created_at`, `updated_at`) VALUES
(1, 17, '1065000000', 'FincaSoft', '.', NULL, NULL, NULL, 1, '2021-02-22 02:13:30', '2021-04-18 19:46:31'),
(2, 17, '1065843703', 'Luis Daniel', 'Aponte Daza', 'ldaponte98@gmail.com', '3164689467', NULL, 1, '2021-03-22 16:38:10', '2021-03-22 16:38:10'),
(3, 17, '1065843702', 'Andres Leonardo', 'Perez Florian', 'ldaponte98@gmail.com', '3164999999', '5131_1065843703.jpg', 1, '2021-04-02 22:37:23', '2021-04-02 23:12:33'),
(4, 17, '1065843701', 'Luis francisco', 'Perez Lopez', 'luisfrancisco@gmail.com', '3000000000', '2630_1065843701.jpg', 1, '2021-04-08 00:14:55', '2021-04-08 00:14:58'),
(5, 17, '10658437032', 'Juliana', 'Aponte Perez', NULL, NULL, NULL, 1, '2021-04-18 19:39:08', '2021-04-18 19:43:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamiento`
--

CREATE TABLE `tratamiento` (
  `id_tratamiento` int(11) NOT NULL,
  `id_dominio_tipo` int(11) NOT NULL,
  `id_animal` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_tratamiento_padre` int(11) DEFAULT NULL,
  `id_dominio_estado` int(11) NOT NULL,
  `id_usuario_registra` int(11) NOT NULL,
  `soporte` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tratamiento`
--

INSERT INTO `tratamiento` (`id_tratamiento`, `id_dominio_tipo`, `id_animal`, `nombre`, `descripcion`, `fecha`, `id_tratamiento_padre`, `id_dominio_estado`, `id_usuario_registra`, `soporte`, `estado`, `created_at`, `updated_at`) VALUES
(21, 29, 3, 'Purga estomacal', 'sdfasdfasdfasdfasdf', '2021-04-12 14:23:00', NULL, 23, 2, '1996_2021-04-12-09-24-43.jpg', 1, '2021-04-12 14:24:44', '2021-04-13 01:25:20'),
(22, 29, 3, 'Purga estomacal - 2 Dosis', NULL, '2021-04-20 14:23:00', 21, 22, 2, '1996_2021-04-12-09-24-43.jpg', 1, '2021-04-12 14:24:44', '2021-04-12 14:24:44'),
(23, 29, 3, 'Purga estomacal - 3 Dosis', NULL, '2021-05-28 14:23:00', 21, 22, 2, '1996_2021-04-12-09-24-43.jpg', 1, '2021-04-12 14:24:44', '2021-04-12 14:24:44'),
(24, 28, 4, 'Rabia', 'Esta vacuna sirve para quitar la rabia', '2021-04-15 00:15:00', NULL, 21, 2, NULL, 1, '2021-04-16 00:17:47', '2021-04-16 00:17:47'),
(25, 28, 4, 'Rabia - 2 Dosis', 'Esta vacuna sirve para quitar la rabia', '2021-05-15 00:16:00', 24, 22, 2, NULL, 1, '2021-04-16 00:17:48', '2021-04-16 00:17:48'),
(26, 28, 4, 'Rabia - 3 Dosis', 'Esta vacuna sirve para quitar la rabia', '2021-06-15 00:16:00', 24, 22, 2, NULL, 1, '2021-04-16 00:17:48', '2021-04-16 00:17:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `id_tercero` int(11) NOT NULL,
  `id_perfil` int(11) NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `clave` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `id_tercero`, `id_perfil`, `usuario`, `clave`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 1, '2021-02-22 02:19:06', '2021-04-18 19:46:31');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`id_animal`),
  ADD KEY `fk_animal_tercero_propietario` (`id_tercero_propietario`),
  ADD KEY `fk_animal_dominio_estado` (`id_dominio_estado`),
  ADD KEY `fk_animal_dominio_origen` (`id_dominio_origen`);

--
-- Indices de la tabla `animal_pesaje`
--
ALTER TABLE `animal_pesaje`
  ADD PRIMARY KEY (`id_animal_pesaje`);

--
-- Indices de la tabla `animal_produccion`
--
ALTER TABLE `animal_produccion`
  ADD PRIMARY KEY (`id_animal_produccion`);

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`id_caja`);

--
-- Indices de la tabla `dominio`
--
ALTER TABLE `dominio`
  ADD PRIMARY KEY (`id_dominio`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `tercero`
--
ALTER TABLE `tercero`
  ADD PRIMARY KEY (`id_tercero`),
  ADD KEY `fk_tercero_tipo_identificacion` (`id_dominio_tipo_identificacion`);

--
-- Indices de la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
  ADD PRIMARY KEY (`id_tratamiento`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_usuario_perfil` (`id_perfil`),
  ADD KEY `fk_usuario_tercero` (`id_tercero`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `animal`
--
ALTER TABLE `animal`
  MODIFY `id_animal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `animal_pesaje`
--
ALTER TABLE `animal_pesaje`
  MODIFY `id_animal_pesaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `animal_produccion`
--
ALTER TABLE `animal_produccion`
  MODIFY `id_animal_produccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id_caja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `dominio`
--
ALTER TABLE `dominio`
  MODIFY `id_dominio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tercero`
--
ALTER TABLE `tercero`
  MODIFY `id_tercero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
  MODIFY `id_tratamiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `fk_animal_dominio_estado` FOREIGN KEY (`id_dominio_estado`) REFERENCES `dominio` (`id_dominio`),
  ADD CONSTRAINT `fk_animal_dominio_origen` FOREIGN KEY (`id_dominio_origen`) REFERENCES `dominio` (`id_dominio`),
  ADD CONSTRAINT `fk_animal_tercero_propietario` FOREIGN KEY (`id_tercero_propietario`) REFERENCES `tercero` (`id_tercero`);

--
-- Filtros para la tabla `tercero`
--
ALTER TABLE `tercero`
  ADD CONSTRAINT `fk_tercero_tipo_identificacion` FOREIGN KEY (`id_dominio_tipo_identificacion`) REFERENCES `dominio` (`id_dominio`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_perfil` FOREIGN KEY (`id_perfil`) REFERENCES `perfil` (`id_perfil`),
  ADD CONSTRAINT `fk_usuario_tercero` FOREIGN KEY (`id_tercero`) REFERENCES `tercero` (`id_tercero`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

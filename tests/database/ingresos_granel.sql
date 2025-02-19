-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: db:3306
-- Tiempo de generación: 19-02-2025 a las 20:34:00
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cidb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos_granel`
--

CREATE TABLE `ingresos_granel` (
  `id` int NOT NULL,
  `numero_ingreso` int NOT NULL,
  `producto_id` int NOT NULL,
  `monto` decimal(12,6) NOT NULL,
  `cantidad` int NOT NULL,
  `total` decimal(12,6) NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ingresos_granel`
--

INSERT INTO `ingresos_granel` (`id`, `numero_ingreso`, `producto_id`, `monto`, `cantidad`, `total`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 0.050000, 2975, 80.339875, 1, '2025-01-28 15:41:41', '2025-01-28 15:41:41', NULL),
(2, 2, 26, 2.600000, 2500, 6500.000000, 1, '2025-01-28 15:44:01', '2025-01-28 15:44:01', NULL),
(3, 3, 26, 2.600000, 300, 780.000000, 1, '2025-01-28 16:13:12', '2025-01-28 16:13:12', NULL),
(4, 4, 1, 0.050000, 515, 25.750000, 1, '2025-01-28 17:05:42', '2025-01-28 17:05:42', NULL),
(5, 5, 2, 0.062222, 1000, 62.222000, 1, '2025-01-30 19:26:52', '2025-01-30 19:26:52', NULL),
(6, 6, 14, 3.000000, 1000, 3000.000000, 1, '2025-01-30 21:01:34', '2025-01-30 21:01:34', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ingresos_granel`
--
ALTER TABLE `ingresos_granel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ingresos_granel`
--
ALTER TABLE `ingresos_granel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: db:3306
-- Tiempo de generación: 19-02-2025 a las 20:04:18
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
-- Estructura de tabla para la tabla `granel_embolsados`
--

CREATE TABLE `granel_embolsados` (
  `id` int NOT NULL,
  `numero_embolsado` int NOT NULL,
  `producto_granel_id` int NOT NULL,
  `producto_id` int NOT NULL,
  `tipo` int NOT NULL,
  `cantidad` int NOT NULL,
  `costo_gramo` decimal(12,6) NOT NULL,
  `total` decimal(12,6) NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `granel_embolsados`
--

INSERT INTO `granel_embolsados` (`id`, `numero_embolsado`, `producto_granel_id`, `producto_id`, `tipo`, `cantidad`, `costo_gramo`, `total`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 1, 1, 2, 300, 0.000000, 0.000000, 1, '2025-01-29 23:50:58', '2025-01-29 23:50:58', NULL),
(2, 0, 2, 2, 2, 200, 0.000000, 0.000000, 1, '2025-01-29 23:52:14', '2025-01-29 23:52:14', NULL),
(3, 0, 2, 2, 2, 400, 0.060000, 0.000000, 1, '2025-01-29 23:53:14', '2025-01-29 23:53:14', NULL),
(6, 0, 26, 28, 2, 400, 2.600000, 0.000000, 1, '2025-01-29 23:58:13', '2025-01-29 23:58:13', NULL),
(7, 1, 14, 28, 2, 400, 3.000000, 1200.000000, 1, '2025-01-30 00:05:01', '2025-01-30 00:05:01', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `granel_embolsados`
--
ALTER TABLE `granel_embolsados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productos_id` (`producto_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `producto_granel_id` (`producto_granel_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `granel_embolsados`
--
ALTER TABLE `granel_embolsados`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `granel_embolsados`
--
ALTER TABLE `granel_embolsados`
  ADD CONSTRAINT `granel_embolsados_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `granel_embolsados_ibfk_3` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

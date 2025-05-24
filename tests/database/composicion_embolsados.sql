-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: db:3306
-- Tiempo de generación: 24-05-2025 a las 23:17:22
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.27

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
-- Estructura de tabla para la tabla `composicion_embolsados`
--

CREATE TABLE `composicion_embolsados` (
  `id` int NOT NULL,
  `producto_id` int NOT NULL,
  `producto_granel_id` int NOT NULL,
  `cantidad_por_bolsa` decimal(10,3) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `composicion_embolsados`
--

INSERT INTO `composicion_embolsados` (`id`, `producto_id`, `producto_granel_id`, `cantidad_por_bolsa`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 25, 1, 70.000, '2025-05-23 14:48:17', '2025-05-23 14:48:22', NULL),
(2, 26, 1, 80.000, '2025-05-22 15:58:25', '2025-05-22 15:58:25', NULL),
(3, 26, 2, 85.000, '2025-05-22 16:00:46', '2025-05-22 16:00:46', NULL),
(5, 26, 3, 75.000, '2025-05-22 16:03:47', '2025-05-22 16:03:47', NULL),
(6, 26, 5, 75.000, '2025-05-22 16:03:47', '2025-05-22 16:03:47', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `composicion_embolsados`
--
ALTER TABLE `composicion_embolsados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_producto` (`producto_id`),
  ADD KEY `fk_producto_granel` (`producto_granel_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `composicion_embolsados`
--
ALTER TABLE `composicion_embolsados`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `composicion_embolsados`
--
ALTER TABLE `composicion_embolsados`
  ADD CONSTRAINT `fk_producto` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_producto_granel` FOREIGN KEY (`producto_granel_id`) REFERENCES `productos_granel` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

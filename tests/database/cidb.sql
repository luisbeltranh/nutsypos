-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: db:3306
-- Tiempo de generación: 08-09-2024 a las 20:17:13
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
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id` int NOT NULL,
  `productos_id` int NOT NULL,
  `tipo` int NOT NULL,
  `cantidad` int NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id`, `productos_id`, `tipo`, `cantidad`, `monto`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 8, 0, 18, 4.00, 1, '2024-09-08 17:53:44', '2024-09-08 17:53:44', '0000-00-00 00:00:00'),
(4, 9, 0, 15, 10.00, 1, '2024-09-08 19:07:50', '2024-09-08 19:07:50', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `costo` decimal(10,2) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  `cantidad_total` int NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `categoria`, `nombre`, `descripcion`, `costo`, `precio_venta`, `cantidad_total`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'frutos_secos', 'Almendra', 'Almendra de 10 Bs', 4.00, 10.00, 0, 1, '2024-09-08 14:03:21', '2024-09-08 14:03:21', NULL),
(2, 'frutos_secos', 'Arveja', 'Arveja de 5 Bs', 2.40, 5.00, 20, 1, '2024-09-08 16:44:30', '2024-09-08 16:44:30', NULL),
(3, 'bebidas', 'Coca 500', 'Coca Cola 500ml', 4.00, 6.00, 12, 1, '2024-09-08 16:50:53', '2024-09-08 16:50:53', NULL),
(4, 'bebidas', 'Fanta N 500', 'Fanta Naranja 500ml', 4.00, 6.00, 12, 1, '2024-09-08 16:51:54', '2024-09-08 16:51:54', NULL),
(8, 'bebidas', 'Coca 300', 'Coca Cola 300ml', 3.00, 4.00, 18, 1, '2024-09-08 17:53:44', '2024-09-08 17:53:44', NULL),
(9, 'frutos_secos', 'Pistacho 10', 'Pistacho de 10 Bs', 5.00, 10.00, 0, 1, '2024-09-08 19:07:50', '2024-09-08 19:07:50', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productos_id` (`productos_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `movimientos_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `movimientos_ibfk_3` FOREIGN KEY (`productos_id`) REFERENCES `productos` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

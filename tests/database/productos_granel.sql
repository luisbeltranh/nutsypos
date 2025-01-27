-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: db:3306
-- Tiempo de generación: 27-01-2025 a las 00:49:32
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
-- Estructura de tabla para la tabla `productos_granel`
--

CREATE TABLE `productos_granel` (
  `id` int NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `costo_gramo` decimal(10,2) NOT NULL,
  `precio_venta_gramo` decimal(10,2) NOT NULL,
  `cantidad_total` int NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `productos_granel`
--

INSERT INTO `productos_granel` (`id`, `categoria`, `nombre`, `descripcion`, `costo_gramo`, `precio_venta_gramo`, `cantidad_total`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'snacks', 'Almendra', 'Almendra', 4.00, 10.00, 0, 1, '2024-09-08 14:03:21', '2024-09-08 14:03:21', NULL),
(2, 'snacks', 'Arveja', 'Arveja', 2.40, 5.00, 20, 1, '2024-09-08 16:44:30', '2024-09-08 16:44:30', NULL),
(9, 'snacks', 'Pistacho', 'Pistacho', 5.00, 10.00, 0, 1, '2024-09-08 19:07:50', '2024-09-08 19:07:50', NULL),
(14, 'snacks', 'Postre Dul', 'Postre Dulce', 3.00, 5.00, 0, 1, '2024-09-14 03:22:56', '2024-09-14 03:22:56', NULL),
(21, 'snacks', 'Papa Sal', 'Papa salada', 6.00, 12.00, 0, 1, '2024-10-07 07:35:47', '2024-10-07 07:38:03', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos_granel`
--
ALTER TABLE `productos_granel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos_granel`
--
ALTER TABLE `productos_granel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

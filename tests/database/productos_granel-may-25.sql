-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: db:3306
-- Tiempo de generación: 15-05-2025 a las 01:28:14
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
  `descripcion` text NOT NULL,
  `costo_kg` decimal(10,2) NOT NULL,
  `cantidad_total` decimal(10,3) NOT NULL,
  `minimo` decimal(10,3) NOT NULL,
  `user_id` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `productos_granel`
--

INSERT INTO `productos_granel` (`id`, `categoria`, `nombre`, `descripcion`, `costo_kg`, `cantidad_total`, `minimo`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'snacks', 'Maní sal', 'Maní Salado', 24.50, 5.750, 0.800, 1, '2025-05-02 21:01:44', '2025-05-02 21:01:44', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos_granel`
--
ALTER TABLE `productos_granel`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos_granel`
--
ALTER TABLE `productos_granel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

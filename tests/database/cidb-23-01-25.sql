-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: db:3306
-- Tiempo de generación: 23-01-2025 a las 05:27:44
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
-- Estructura de tabla para la tabla `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`id`, `user_id`, `group`, `created_at`) VALUES
(2, 2, 'user', '2024-09-08 13:49:44'),
(4, 1, 'admin', '2024-09-21 10:11:10'),
(5, 1, 'superadmin', '2024-09-21 10:11:56'),
(6, 1, 'user', '2024-09-21 10:11:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_identities`
--

CREATE TABLE `auth_identities` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `secret` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `secret2` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `extra` text COLLATE utf8mb4_general_ci,
  `force_reset` tinyint(1) NOT NULL DEFAULT '0',
  `last_used_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `auth_identities`
--

INSERT INTO `auth_identities` (`id`, `user_id`, `type`, `name`, `secret`, `secret2`, `expires`, `extra`, `force_reset`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'email_password', NULL, 'luisbeltranh@gmail.com', '$2y$12$cqJ46lCouX2foX2MPPh50.dA.k9.tCjo8z6OCGviJvRLyFKhsMVbq', NULL, NULL, 0, '2025-01-23 00:46:13', '2024-08-25 12:11:23', '2025-01-23 00:46:13'),
(2, 2, 'email_password', NULL, 'luisbeltranh@outlook.com', '$2y$12$li/zMqExX8tRfFkjPxuI8.eBS6p/YKpIMyLm1cziZO/ryv/WLkUlO', NULL, NULL, 0, '2025-01-18 09:27:33', '2024-09-08 13:49:44', '2025-01-18 09:27:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `identifier` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `user_agent`, `id_type`, `identifier`, `user_id`, `date`, `success`) VALUES
(1, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'email_password', 'luisbeltranh@gmail.com', 1, '2024-08-26 02:03:35', 1),
(2, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'email_password', 'luisbeltranh@gmail.com', 1, '2024-08-26 11:10:55', 1),
(3, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'email_password', 'luisbeltranh@gmail.com', 1, '2024-09-06 12:36:15', 1),
(4, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'email_password', 'luisbeltranh@gmail.com', 1, '2024-09-07 02:07:47', 1),
(5, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'email_password', 'luisbeltranh@gmail.com', 1, '2024-09-08 13:12:29', 1),
(6, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'email_password', 'luisbeltranh@gmail.com', 1, '2024-09-08 13:52:49', 1),
(7, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'email_password', 'luisbeltranh@gmail.com', 1, '2024-09-08 16:40:58', 1),
(8, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'email_password', 'luisbeltranh@gmail.com', 1, '2024-09-09 01:14:04', 1),
(9, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'email_password', 'luisbeltranh@gmail.com', 1, '2024-09-12 10:58:14', 1),
(10, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'username', 'lbeltran', NULL, '2024-09-13 02:54:18', 0),
(11, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2024-09-13 02:54:41', 1),
(12, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2024-09-13 11:09:27', 1),
(13, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2024-09-14 00:25:45', 1),
(14, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2024-09-14 11:46:41', 1),
(15, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2024-09-14 23:10:13', 1),
(16, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'username', 'lbeltran', NULL, '2024-09-15 22:29:13', 0),
(17, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2024-09-15 22:29:26', 1),
(18, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'username', 'lbeltran', NULL, '2024-09-17 07:48:09', 0),
(19, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2024-09-17 07:48:24', 1),
(20, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2024-09-18 22:06:43', 1),
(21, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'username', 'lbeltran', NULL, '2024-09-20 10:04:01', 0),
(22, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2024-09-20 10:04:22', 1),
(23, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2024-09-20 22:13:47', 1),
(24, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2024-09-21 07:25:21', 1),
(25, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'username', 'luisb', 2, '2024-09-21 10:15:18', 1),
(26, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2024-09-21 11:29:04', 1),
(27, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2024-09-21 15:39:51', 1),
(28, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2024-09-22 07:02:36', 1),
(29, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2024-09-22 23:31:31', 1),
(30, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2024-09-24 06:38:17', 1),
(31, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2024-09-26 22:14:59', 1),
(32, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2024-09-27 07:38:28', 1),
(33, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2024-09-27 21:58:09', 1),
(34, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'username', 'luisb', 2, '2024-09-27 22:02:48', 1),
(35, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2024-09-27 22:11:45', 1),
(36, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2024-10-02 08:06:00', 1),
(37, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2024-10-02 21:54:26', 1),
(38, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2024-10-06 11:41:31', 1),
(39, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'username', 'lbeltran', NULL, '2024-10-06 20:45:41', 0),
(40, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'username', 'lbeltran', NULL, '2024-10-06 20:45:52', 0),
(41, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'username', 'luisb', 2, '2024-10-06 20:46:02', 1),
(42, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2024-10-07 07:27:07', 1),
(43, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2024-10-08 10:45:02', 1),
(44, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2024-10-09 09:27:39', 1),
(45, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'username', 'admin', NULL, '2025-01-17 22:15:23', 0),
(46, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'username', 'lbeltran', NULL, '2025-01-17 22:15:37', 0),
(47, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'username', 'luis', NULL, '2025-01-17 22:15:56', 0),
(48, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'username', 'luis', NULL, '2025-01-17 22:16:19', 0),
(49, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'username', 'luisb', 2, '2025-01-17 22:17:09', 1),
(50, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2025-01-17 22:17:36', 1),
(51, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'username', 'luisb', 2, '2025-01-18 09:27:33', 1),
(52, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2025-01-18 09:28:48', 1),
(53, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2025-01-18 20:28:08', 1),
(54, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2025-01-19 09:07:36', 1),
(55, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2025-01-20 09:45:47', 1),
(56, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2025-01-20 22:57:43', 1),
(57, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2025-01-21 10:42:51', 1),
(58, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2025-01-22 16:52:38', 1),
(59, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2025-01-22 21:47:13', 1),
(60, '172.21.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'username', 'luisbeltran', 1, '2025-01-23 00:46:14', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_permissions_users`
--

CREATE TABLE `auth_permissions_users` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `permission` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_remember_tokens`
--

CREATE TABLE `auth_remember_tokens` (
  `id` int UNSIGNED NOT NULL,
  `selector` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `hashedValidator` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `expires` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_token_logins`
--

CREATE TABLE `auth_token_logins` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `identifier` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE `ingresos` (
  `id` int NOT NULL,
  `numero_ingreso` int NOT NULL,
  `producto_id` int NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `cantidad` int NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ingresos`
--

INSERT INTO `ingresos` (`id`, `numero_ingreso`, `producto_id`, `monto`, `cantidad`, `total`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 3, 4.00, 12, 48.00, 1, '2024-09-13 13:57:30', '2024-09-13 13:57:30', '0000-00-00 00:00:00'),
(3, 1, 14, 3.00, 0, 0.00, 1, '2024-09-14 03:22:56', '2024-09-14 03:22:56', '0000-00-00 00:00:00'),
(4, 2, 8, 3.00, 18, 54.00, 1, '2024-09-14 11:54:57', '2024-09-14 11:54:57', '0000-00-00 00:00:00'),
(5, 3, 4, 4.00, 18, 72.00, 1, '2024-09-14 11:55:27', '2024-09-14 11:55:27', '0000-00-00 00:00:00'),
(6, 4, 1, 4.00, 30, 120.00, 1, '2024-09-14 11:55:45', '2024-09-14 11:55:45', '0000-00-00 00:00:00'),
(7, 5, 2, 2.40, 30, 72.00, 1, '2024-09-14 11:55:58', '2024-09-14 11:55:58', '0000-00-00 00:00:00'),
(8, 6, 9, 5.00, 30, 150.00, 1, '2024-09-14 11:56:09', '2024-09-14 11:56:09', '0000-00-00 00:00:00'),
(9, 7, 14, 3.00, 30, 90.00, 1, '2024-09-14 11:56:22', '2024-09-14 11:56:22', '0000-00-00 00:00:00'),
(10, 0, 15, 4.60, 0, 0.00, 1, '2024-09-23 00:03:49', '2024-09-23 00:03:49', '0000-00-00 00:00:00'),
(11, 8, 15, 4.60, 6, 27.60, 2, '2024-09-27 22:11:03', '2024-09-27 22:11:03', '0000-00-00 00:00:00'),
(12, 9, 15, 4.60, 6, 27.60, 1, '2024-09-27 22:16:18', '2024-09-27 22:16:18', '0000-00-00 00:00:00'),
(13, 0, 16, 3.00, 0, 0.00, 1, '2024-10-02 08:08:47', '2024-10-02 08:08:47', '0000-00-00 00:00:00'),
(14, 0, 17, 5.00, 0, 0.00, 1, '2024-10-02 08:09:18', '2024-10-02 08:09:18', '0000-00-00 00:00:00'),
(15, 0, 18, 7.00, 0, 0.00, 1, '2024-10-02 09:14:43', '2024-10-02 09:14:43', '0000-00-00 00:00:00'),
(16, 0, 19, 9.00, 0, 0.00, 1, '2024-10-02 09:15:15', '2024-10-02 09:15:15', '0000-00-00 00:00:00'),
(17, 0, 20, 14.00, 0, 0.00, 1, '2024-10-02 09:15:47', '2024-10-02 09:15:47', '0000-00-00 00:00:00'),
(18, 0, 21, 6.00, 0, 0.00, 1, '2024-10-07 07:35:47', '2024-10-07 07:35:47', '0000-00-00 00:00:00'),
(19, 0, 22, 3.00, 0, 0.00, 1, '2024-10-07 07:36:28', '2024-10-07 07:36:28', '0000-00-00 00:00:00'),
(20, 0, 23, 4.70, 0, 0.00, 1, '2025-01-17 22:36:12', '2025-01-17 22:36:12', '0000-00-00 00:00:00'),
(21, 0, 24, 16.50, 0, 0.00, 1, '2025-01-19 18:12:16', '2025-01-19 18:12:16', '0000-00-00 00:00:00'),
(22, 10, 3, 4.60, 24, 110.40, 1, '2025-01-19 18:14:37', '2025-01-19 18:14:37', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2020-12-28-223112', 'CodeIgniter\\Shield\\Database\\Migrations\\CreateAuthTables', 'default', 'CodeIgniter\\Shield', 1724586023, 1),
(2, '2021-07-04-041948', 'CodeIgniter\\Settings\\Database\\Migrations\\CreateSettingsTable', 'default', 'CodeIgniter\\Settings', 1724586023, 1),
(3, '2021-11-14-143905', 'CodeIgniter\\Settings\\Database\\Migrations\\AddContextColumn', 'default', 'CodeIgniter\\Settings', 1724586023, 1);

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
  `tamano` int NOT NULL,
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

INSERT INTO `productos` (`id`, `categoria`, `nombre`, `descripcion`, `tamano`, `costo`, `precio_venta`, `cantidad_total`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'snacks', 'Almendra', 'Almendra de 10 Bs', 0, 4.00, 10.00, 0, 1, '2024-09-08 14:03:21', '2024-09-08 14:03:21', NULL),
(2, 'snacks', 'Arveja', 'Arveja de 5 Bs', 0, 2.40, 5.00, 20, 1, '2024-09-08 16:44:30', '2024-09-08 16:44:30', NULL),
(3, 'bebidas', 'Coca 500', 'Coca Cola 500ml', 500, 4.60, 6.00, 12, 1, '2024-09-08 16:50:53', '2024-09-22 11:30:18', NULL),
(4, 'bebidas', 'Fant Nr 500', 'Fanta Naranja 500ml', 500, 4.60, 6.00, 12, 1, '2024-09-08 16:51:54', '2025-01-18 09:47:17', '2025-01-18 09:47:17'),
(8, 'bebidas', 'Coca 300', 'Coca Cola 300ml', 300, 3.00, 4.00, 18, 1, '2024-09-08 17:53:44', '2024-09-08 17:53:44', NULL),
(9, 'snacks', 'Pistacho 10', 'Pistacho de 10 Bs', 0, 5.00, 10.00, 0, 1, '2024-09-08 19:07:50', '2024-09-08 19:07:50', NULL),
(14, 'snacks', 'Postre Dul', 'Postre Dulce de 5Bs', 0, 3.00, 5.00, 0, 1, '2024-09-14 03:22:56', '2024-09-14 03:22:56', NULL),
(15, 'bebidas', 'Fant Nr 300', 'Fanta Naranja 300', 300, 3.00, 4.00, 0, 1, '2024-09-23 00:03:49', '2025-01-18 09:48:51', '2025-01-18 09:48:51'),
(16, 'bebidas', 'Sprite 300', 'Sprite 300 ml', 300, 3.00, 4.00, 0, 1, '2024-10-02 08:08:47', '2025-01-18 09:48:58', '2025-01-18 09:48:58'),
(17, 'bebidas', 'Sprite 500', 'Sprite 500 ml', 500, 5.00, 6.00, 0, 1, '2024-10-02 08:09:18', '2025-01-18 09:49:04', '2025-01-18 09:49:04'),
(18, 'snacks', 'Pipo Du 8', 'Pipoca Dulce 8 Bs', 8, 7.00, 8.00, 0, 1, '2024-10-02 09:14:43', '2024-10-02 09:25:40', NULL),
(19, 'snacks', 'Pipo Du 10', 'Pipoca Dulce 10 Bs', 10, 9.00, 10.00, 0, 1, '2024-10-02 09:15:14', '2024-10-02 09:26:05', NULL),
(20, 'snacks', 'Pipo Du 15', 'Pipoca Dulce 15 Bs', 15, 14.00, 15.00, 0, 1, '2024-10-02 09:15:47', '2024-10-02 09:26:23', NULL),
(21, 'snacks', 'Papa Sal 12', 'Papa salada de 12', 12, 6.00, 12.00, 0, 1, '2024-10-07 07:35:47', '2024-10-07 07:38:03', NULL),
(22, 'snacks', 'Papa Sal 6', 'Papa Salada de 6', 6, 3.00, 6.00, 0, 1, '2024-10-07 07:36:28', '2024-10-07 07:38:23', NULL),
(23, 'bebidas', 'Fanta gu', 'fanta guarana', 500, 4.70, 6.00, 0, 1, '2025-01-17 22:36:12', '2025-01-17 22:36:26', '2025-01-17 22:36:26'),
(24, 'snacks', 'Cuñape 20', 'Cuñape de 20 Bs', 20, 16.50, 20.00, 0, 1, '2025-01-19 18:12:16', '2025-01-19 18:12:16', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `id` int NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `value` text COLLATE utf8mb4_general_ci,
  `type` varchar(31) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'string',
  `context` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_message` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `last_active` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `status`, `status_message`, `active`, `last_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'luisbeltran', NULL, NULL, 1, '2025-01-23 01:23:05', '2024-08-25 12:11:23', '2024-08-25 12:11:24', NULL),
(2, 'luisb', NULL, NULL, 1, '2025-01-18 09:27:36', '2024-09-08 13:49:44', '2024-09-08 13:49:44', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_information`
--

CREATE TABLE `users_information` (
  `id` int NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellido_paterno` varchar(60) NOT NULL,
  `apellido_materno` varchar(60) NOT NULL,
  `documento_ci` varchar(15) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `telefono_emergencia` varchar(10) NOT NULL,
  `contacto_emergencia` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `users_information`
--

INSERT INTO `users_information` (`id`, `user_id`, `nombres`, `apellido_paterno`, `apellido_materno`, `documento_ci`, `telefono`, `telefono_emergencia`, `contacto_emergencia`, `direccion`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Luis Alberto', 'Beltran', 'Herrera', '3331234', '76204145', '76768588', 'esposa', 'illampu 843', '2024-09-21 17:23:24', '2024-09-21 17:23:24', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int NOT NULL,
  `numero_venta` int NOT NULL,
  `producto_id` int NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `cantidad` int NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `numero_venta`, `producto_id`, `monto`, `cantidad`, `total`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(32, 0, 1, 10.00, 1, 10.00, 1, '2024-09-09 04:16:52', '2024-09-09 04:16:52', '0000-00-00 00:00:00'),
(33, 0, 2, 5.00, 1, 5.00, 1, '2024-09-09 04:16:52', '2024-09-09 04:16:52', '0000-00-00 00:00:00'),
(34, 1, 3, 6.00, 1, 6.00, 1, '2024-09-09 04:17:13', '2024-09-09 04:17:13', '0000-00-00 00:00:00'),
(35, 1, 4, 6.00, 1, 6.00, 1, '2024-09-09 04:17:13', '2024-09-09 04:17:13', '0000-00-00 00:00:00'),
(36, 2, 9, 10.00, 3, 30.00, 1, '2024-09-12 11:35:50', '2024-09-12 11:35:50', '0000-00-00 00:00:00'),
(37, 3, 1, 10.00, 1, 10.00, 1, '2024-09-12 11:37:57', '2024-09-12 11:37:57', '0000-00-00 00:00:00'),
(38, 3, 2, 5.00, 1, 5.00, 1, '2024-09-12 11:37:57', '2024-09-12 11:37:57', '0000-00-00 00:00:00'),
(39, 4, 9, 10.00, 2, 20.00, 1, '2024-09-12 11:38:14', '2024-09-12 11:38:14', '0000-00-00 00:00:00'),
(40, 4, 1, 10.00, 1, 10.00, 1, '2024-09-12 11:38:31', '2024-09-12 11:38:31', '0000-00-00 00:00:00'),
(41, 5, 1, 10.00, 1, 10.00, 1, '2024-09-12 11:42:39', '2024-09-12 11:42:39', '0000-00-00 00:00:00'),
(42, 5, 2, 5.00, 1, 5.00, 1, '2024-09-12 11:42:39', '2024-09-12 11:42:39', '0000-00-00 00:00:00'),
(43, 6, 9, 10.00, 1, 10.00, 1, '2024-09-12 11:43:07', '2024-09-12 11:43:07', '0000-00-00 00:00:00'),
(44, 7, 1, 10.00, 1, 10.00, 1, '2024-09-12 11:52:40', '2024-09-12 11:52:40', '0000-00-00 00:00:00'),
(45, 7, 2, 5.00, 1, 5.00, 1, '2024-09-12 11:52:40', '2024-09-12 11:52:40', '0000-00-00 00:00:00'),
(46, 7, 9, 10.00, 1, 10.00, 1, '2024-09-12 11:52:40', '2024-09-12 11:52:40', '0000-00-00 00:00:00'),
(47, 8, 1, 10.00, 1, 10.00, 1, '2024-09-12 11:52:52', '2024-09-12 11:52:52', '0000-00-00 00:00:00'),
(48, 8, 2, 5.00, 1, 5.00, 1, '2024-09-12 11:52:52', '2024-09-12 11:52:52', '0000-00-00 00:00:00'),
(49, 8, 9, 10.00, 2, 20.00, 1, '2024-09-12 11:52:52', '2024-09-12 11:52:52', '0000-00-00 00:00:00'),
(50, 9, 9, 10.00, 1, 10.00, 1, '2024-09-12 11:53:12', '2024-09-12 11:53:12', '0000-00-00 00:00:00'),
(51, 9, 2, 5.00, 3, 15.00, 1, '2024-09-12 11:53:12', '2024-09-12 11:53:12', '0000-00-00 00:00:00'),
(52, 9, 1, 10.00, 1, 10.00, 1, '2024-09-12 11:53:12', '2024-09-12 11:53:12', '0000-00-00 00:00:00'),
(53, 9, 3, 6.00, 1, 6.00, 1, '2024-09-12 11:53:12', '2024-09-12 11:53:12', '0000-00-00 00:00:00'),
(54, 10, 1, 10.00, 2, 20.00, 1, '2024-09-13 03:11:01', '2024-09-13 03:11:01', '0000-00-00 00:00:00'),
(55, 10, 2, 5.00, 2, 10.00, 1, '2024-09-13 03:11:01', '2024-09-13 03:11:01', '0000-00-00 00:00:00'),
(56, 11, 8, 4.00, 1, 4.00, 1, '2024-09-14 02:03:03', '2024-09-14 02:03:03', '0000-00-00 00:00:00'),
(57, 12, 1, 10.00, 1, 10.00, 1, '2024-09-14 12:13:50', '2024-09-14 12:13:50', '0000-00-00 00:00:00'),
(58, 12, 2, 5.00, 2, 10.00, 1, '2024-09-14 12:13:50', '2024-09-14 12:13:50', '0000-00-00 00:00:00'),
(59, 13, 9, 10.00, 1, 10.00, 1, '2024-09-14 12:14:04', '2024-09-14 12:14:04', '0000-00-00 00:00:00'),
(60, 13, 4, 6.00, 1, 6.00, 1, '2024-09-14 12:14:04', '2024-09-14 12:14:04', '0000-00-00 00:00:00'),
(61, 14, 14, 5.00, 1, 5.00, 1, '2024-09-14 23:11:04', '2024-09-14 23:11:04', '0000-00-00 00:00:00'),
(62, 14, 9, 10.00, 1, 10.00, 1, '2024-09-14 23:11:04', '2024-09-14 23:11:04', '0000-00-00 00:00:00'),
(63, 15, 2, 5.00, 2, 10.00, 1, '2024-09-14 23:13:48', '2024-09-14 23:13:48', '0000-00-00 00:00:00'),
(64, 15, 1, 10.00, 1, 10.00, 1, '2024-09-14 23:13:48', '2024-09-14 23:13:48', '0000-00-00 00:00:00'),
(65, 15, 14, 5.00, 1, 5.00, 1, '2024-09-14 23:13:48', '2024-09-14 23:13:48', '0000-00-00 00:00:00'),
(66, 16, 8, 4.00, 2, 8.00, 1, '2024-09-21 08:27:50', '2024-09-21 08:27:50', '0000-00-00 00:00:00'),
(67, 16, 3, 6.00, 1, 6.00, 1, '2024-09-21 08:27:50', '2024-09-21 08:27:50', '0000-00-00 00:00:00'),
(68, 16, 4, 6.00, 1, 6.00, 1, '2024-09-21 08:27:50', '2024-09-21 08:27:50', '0000-00-00 00:00:00'),
(69, 17, 20, 15.00, 1, 15.00, 1, '2024-10-02 09:36:48', '2024-10-02 09:36:48', '0000-00-00 00:00:00'),
(70, 17, 2, 5.00, 1, 5.00, 1, '2024-10-02 09:36:48', '2024-10-02 09:36:48', '0000-00-00 00:00:00'),
(71, 17, 3, 6.00, 2, 12.00, 1, '2024-10-02 09:36:48', '2024-10-02 09:36:48', '0000-00-00 00:00:00'),
(72, 18, 18, 8.00, 1, 8.00, 1, '2024-10-02 09:37:00', '2024-10-02 09:37:00', '0000-00-00 00:00:00'),
(73, 18, 8, 4.00, 1, 4.00, 1, '2024-10-02 09:37:00', '2024-10-02 09:37:00', '0000-00-00 00:00:00'),
(74, 19, 8, 4.00, 1, 4.00, 1, '2024-10-02 09:37:11', '2024-10-02 09:37:11', '0000-00-00 00:00:00'),
(75, 19, 3, 6.00, 1, 6.00, 1, '2024-10-02 09:37:11', '2024-10-02 09:37:11', '0000-00-00 00:00:00'),
(76, 20, 20, 15.00, 2, 30.00, 1, '2024-10-02 09:37:23', '2024-10-02 09:37:23', '0000-00-00 00:00:00'),
(77, 20, 2, 5.00, 1, 5.00, 1, '2024-10-02 09:37:23', '2024-10-02 09:37:23', '0000-00-00 00:00:00'),
(78, 21, 15, 4.00, 1, 4.00, 1, '2024-10-02 09:40:49', '2024-10-02 09:40:49', '0000-00-00 00:00:00'),
(79, 21, 3, 6.00, 1, 6.00, 1, '2024-10-02 09:40:49', '2024-10-02 09:40:49', '0000-00-00 00:00:00'),
(80, 22, 19, 10.00, 1, 10.00, 1, '2024-10-02 09:43:21', '2024-10-02 09:43:21', '0000-00-00 00:00:00'),
(81, 22, 16, 4.00, 1, 4.00, 1, '2024-10-02 09:43:21', '2024-10-02 09:43:21', '0000-00-00 00:00:00'),
(82, 22, 8, 4.00, 1, 4.00, 1, '2024-10-02 09:43:21', '2024-10-02 09:43:21', '0000-00-00 00:00:00'),
(83, 22, 15, 4.00, 1, 4.00, 1, '2024-10-02 09:43:21', '2024-10-02 09:43:21', '0000-00-00 00:00:00'),
(84, 22, 3, 6.00, 1, 6.00, 1, '2024-10-02 09:43:21', '2024-10-02 09:43:21', '0000-00-00 00:00:00'),
(85, 22, 4, 6.00, 1, 6.00, 1, '2024-10-02 09:43:21', '2024-10-02 09:43:21', '0000-00-00 00:00:00'),
(86, 22, 17, 6.00, 1, 6.00, 1, '2024-10-02 09:43:21', '2024-10-02 09:43:21', '0000-00-00 00:00:00'),
(87, 23, 2, 5.00, 1, 5.00, 1, '2024-10-02 15:30:57', '2024-10-02 15:30:57', '0000-00-00 00:00:00'),
(88, 23, 9, 10.00, 1, 10.00, 1, '2024-10-02 15:30:57', '2024-10-02 15:30:57', '0000-00-00 00:00:00'),
(89, 23, 14, 5.00, 1, 5.00, 1, '2024-10-02 15:30:57', '2024-10-02 15:30:57', '0000-00-00 00:00:00'),
(90, 24, 3, 6.00, 2, 12.00, 1, '2024-10-08 11:56:39', '2024-10-08 11:56:39', '0000-00-00 00:00:00'),
(91, 24, 9, 10.00, 1, 10.00, 1, '2024-10-08 11:56:39', '2024-10-08 11:56:39', '0000-00-00 00:00:00'),
(92, 24, 1, 10.00, 1, 10.00, 1, '2024-10-08 11:56:39', '2024-10-08 11:56:39', '0000-00-00 00:00:00'),
(93, 25, 20, 15.00, 1, 15.00, 1, '2024-10-08 11:56:58', '2024-10-08 11:56:58', '0000-00-00 00:00:00'),
(94, 25, 18, 8.00, 1, 8.00, 1, '2024-10-08 11:56:58', '2024-10-08 11:56:58', '0000-00-00 00:00:00'),
(95, 25, 19, 10.00, 1, 10.00, 1, '2024-10-08 11:56:58', '2024-10-08 11:56:58', '0000-00-00 00:00:00'),
(96, 25, 22, 6.00, 1, 6.00, 1, '2024-10-08 11:56:58', '2024-10-08 11:56:58', '0000-00-00 00:00:00'),
(97, 25, 21, 12.00, 1, 12.00, 1, '2024-10-08 11:56:58', '2024-10-08 11:56:58', '0000-00-00 00:00:00'),
(98, 25, 15, 4.00, 1, 4.00, 1, '2024-10-08 11:56:58', '2024-10-08 11:56:58', '0000-00-00 00:00:00'),
(99, 25, 17, 6.00, 1, 6.00, 1, '2024-10-08 11:56:58', '2024-10-08 11:56:58', '0000-00-00 00:00:00'),
(100, 26, 8, 4.00, 2, 8.00, 1, '2024-10-08 11:58:30', '2024-10-08 11:58:30', '0000-00-00 00:00:00'),
(101, 27, 22, 6.00, 1, 6.00, 1, '2025-01-18 20:34:21', '2025-01-18 20:34:21', '0000-00-00 00:00:00'),
(102, 27, 21, 12.00, 2, 24.00, 1, '2025-01-18 20:34:21', '2025-01-18 20:34:21', '0000-00-00 00:00:00'),
(103, 28, 1, 10.00, 1, 10.00, 1, '2025-01-18 20:34:32', '2025-01-18 20:34:32', '0000-00-00 00:00:00'),
(104, 28, 20, 15.00, 1, 15.00, 1, '2025-01-18 20:34:32', '2025-01-18 20:34:32', '0000-00-00 00:00:00'),
(105, 29, 3, 6.00, 1, 6.00, 1, '2025-01-18 20:34:55', '2025-01-18 20:34:55', '0000-00-00 00:00:00'),
(106, 29, 22, 6.00, 1, 6.00, 1, '2025-01-18 20:34:55', '2025-01-18 20:34:55', '0000-00-00 00:00:00'),
(107, 29, 21, 12.00, 1, 12.00, 1, '2025-01-18 20:34:55', '2025-01-18 20:34:55', '0000-00-00 00:00:00'),
(108, 30, 3, 6.00, 2, 12.00, 1, '2025-01-18 23:15:11', '2025-01-18 23:15:11', '0000-00-00 00:00:00'),
(109, 31, 1, 10.00, 1, 10.00, 1, '2025-01-18 23:15:23', '2025-01-18 23:15:23', '0000-00-00 00:00:00'),
(110, 31, 20, 15.00, 1, 15.00, 1, '2025-01-18 23:15:23', '2025-01-18 23:15:23', '0000-00-00 00:00:00'),
(111, 31, 9, 10.00, 1, 10.00, 1, '2025-01-18 23:15:23', '2025-01-18 23:15:23', '0000-00-00 00:00:00'),
(112, 31, 14, 5.00, 1, 5.00, 1, '2025-01-18 23:15:23', '2025-01-18 23:15:23', '0000-00-00 00:00:00'),
(113, 32, 24, 20.00, 1, 20.00, 1, '2025-01-20 22:58:15', '2025-01-20 22:58:15', '0000-00-00 00:00:00'),
(114, 32, 9, 10.00, 1, 10.00, 1, '2025-01-20 22:58:15', '2025-01-20 22:58:15', '0000-00-00 00:00:00'),
(115, 32, 3, 6.00, 1, 6.00, 1, '2025-01-20 22:58:15', '2025-01-20 22:58:15', '0000-00-00 00:00:00'),
(116, 33, 9, 10.00, 1, 10.00, 1, '2025-01-20 22:58:25', '2025-01-20 22:58:25', '0000-00-00 00:00:00'),
(117, 34, 22, 6.00, 2, 12.00, 1, '2025-01-20 22:58:37', '2025-01-20 22:58:37', '0000-00-00 00:00:00'),
(118, 34, 14, 5.00, 1, 5.00, 1, '2025-01-20 22:58:37', '2025-01-20 22:58:37', '0000-00-00 00:00:00'),
(119, 34, 9, 10.00, 1, 10.00, 1, '2025-01-20 22:58:37', '2025-01-20 22:58:37', '0000-00-00 00:00:00'),
(120, 34, 20, 15.00, 1, 15.00, 1, '2025-01-20 22:58:37', '2025-01-20 22:58:37', '0000-00-00 00:00:00'),
(121, 34, 19, 10.00, 1, 10.00, 1, '2025-01-20 22:58:37', '2025-01-20 22:58:37', '0000-00-00 00:00:00'),
(122, 35, 3, 6.00, 3, 18.00, 1, '2025-01-20 22:58:48', '2025-01-20 22:58:48', '0000-00-00 00:00:00'),
(123, 36, 21, 12.00, 2, 24.00, 1, '2025-01-22 16:52:59', '2025-01-22 16:52:59', '0000-00-00 00:00:00'),
(124, 37, 1, 10.00, 2, 20.00, 1, '2025-01-22 16:53:26', '2025-01-22 16:53:26', '0000-00-00 00:00:00'),
(125, 37, 8, 4.00, 1, 4.00, 1, '2025-01-22 16:53:26', '2025-01-22 16:53:26', '0000-00-00 00:00:00'),
(126, 38, 1, 10.00, 1, 10.00, 1, '2025-01-23 00:50:43', '2025-01-23 00:50:43', '0000-00-00 00:00:00'),
(127, 38, 2, 5.00, 1, 5.00, 1, '2025-01-23 00:50:43', '2025-01-23 00:50:43', '0000-00-00 00:00:00'),
(128, 39, 3, 6.00, 2, 12.00, 1, '2025-01-23 01:04:11', '2025-01-23 01:04:11', '0000-00-00 00:00:00'),
(129, 40, 2, 5.00, 1, 5.00, 1, '2025-01-23 01:16:35', '2025-01-23 01:16:35', '0000-00-00 00:00:00'),
(130, 40, 24, 20.00, 1, 20.00, 1, '2025-01-23 01:16:35', '2025-01-23 01:16:35', '0000-00-00 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `auth_identities`
--
ALTER TABLE `auth_identities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_secret` (`type`,`secret`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type_identifier` (`id_type`,`identifier`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_permissions_users_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `auth_remember_tokens_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `auth_token_logins`
--
ALTER TABLE `auth_token_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type_identifier` (`id_type`,`identifier`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indices de la tabla `users_information`
--
ALTER TABLE `users_information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `auth_identities`
--
ALTER TABLE `auth_identities`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `auth_token_logins`
--
ALTER TABLE `auth_token_logins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `users_information`
--
ALTER TABLE `users_information`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `auth_identities`
--
ALTER TABLE `auth_identities`
  ADD CONSTRAINT `auth_identities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  ADD CONSTRAINT `auth_permissions_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  ADD CONSTRAINT `auth_remember_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD CONSTRAINT `ingresos_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

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

--
-- Filtros para la tabla `users_information`
--
ALTER TABLE `users_information`
  ADD CONSTRAINT `users_information_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

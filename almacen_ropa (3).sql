-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-06-2026 a las 06:13:58
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `almacen_ropa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_venta`
--

CREATE TABLE `detalles_venta` (
  `id` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalles_venta`
--

INSERT INTO `detalles_venta` (`id`, `id_venta`, `id_producto`, `cantidad`, `precio_unitario`) VALUES
(1, 3, 13, 1, 120000.00),
(2, 3, 14, 1, 60000.00),
(3, 3, 15, 1, 100000.00),
(4, 3, 16, 1, 200000.00),
(5, 3, 25, 1, 1200000.00),
(6, 10, 16, 1, 200000.00),
(7, 10, 15, 1, 100000.00),
(8, 10, 14, 1, 60000.00),
(9, 10, 13, 1, 120000.00),
(10, 11, 13, 1, 120000.00),
(11, 11, 14, 1, 60000.00),
(12, 11, 15, 1, 100000.00),
(13, 11, 16, 1, 200000.00),
(14, 12, 13, 1, 120000.00),
(15, 12, 23, 1, 45000.00),
(16, 12, 21, 1, 1200000.00),
(17, 12, 19, 1, 40000.00),
(18, 12, 17, 1, 200000.00),
(19, 13, 15, 1, 100000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `stock`, `imagen`) VALUES
(13, 'Jean REF 001', 120000.00, 2, 'jean1.jpg'),
(14, 'Jean REF 002', 60000.00, 17, 'jean2.jpg'),
(15, 'Jean REF 003', 100000.00, 52, 'jean3.jpg'),
(16, 'Jean REF 004', 200000.00, 87, 'jean4.jpg'),
(17, 'Camisa REF 001', 200000.00, 2, 'Camisa1.jpg'),
(18, 'Camisa REF 002', 120000.00, 45, 'Camisa2.jpg'),
(19, 'Camisa REF 003', 40000.00, 64, 'Camisa3.jpg'),
(20, 'Camisa REF 004', 300000.00, 23, 'Camisa4.jpg'),
(21, 'Vestido REF 001', 1200000.00, 33, 'Vestido1.jpg'),
(22, 'Vestido REF 002', 50000.00, 56, 'Vestido2.jpg'),
(23, 'Vestido REF 003', 45000.00, 31, 'Vestido3.jpg.webp'),
(24, 'Vestido REF 004', 890000.00, 54, 'Vestido4.jpg'),
(25, 'Sudadera REF 001', 1200000.00, 1, 'Sudadera1.jpg'),
(26, 'Sudadera REF 002', 320000.00, 37, 'Sudadera2.jpg'),
(27, 'Sudadera REF 003', 400000.00, 12, 'Sudadera3.jpg'),
(28, 'Sudadera REF 004', 123000.00, 76, 'Sudadera4.jpg'),
(29, 'Vestido REF 005', 70000.00, 23, 'Vestido5.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `rol` enum('admin','empleado') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `rol`) VALUES
(6, 'Juanita Peres', 'VendedoraSN', '$2y$10$ENf.3u3L.GTl4BrhDBApUui.SV6sIhBlJHbb1aS0GwGxpld//TWhK', 'empleado'),
(7, 'Mariana', 'AdminTR', '$2y$10$1A1XtUApwnqor4hCtUMWz.fI4x0I38QfP5ZaclcJyobKjdNOL7oGS', 'admin'),
(9, 'Samir Trochez', 'VendedorPC', '$2y$10$zQ7e4klAt.4fgHemqLXMleQEKzo1oJOwJWuKaHEGITbg9rj/3gCVS', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `total` decimal(10,2) DEFAULT NULL,
  `id_vendedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `fecha`, `total`, `id_vendedor`) VALUES
(1, '2026-06-06 13:26:22', 1680000.00, 6),
(2, '2026-06-06 13:29:24', 1680000.00, 6),
(3, '2026-06-06 13:30:46', 1680000.00, 6),
(4, '2026-06-06 13:42:26', 360000.00, 6),
(5, '2026-06-06 13:42:52', 360000.00, 6),
(6, '2026-06-06 13:42:55', 360000.00, 6),
(7, '2026-06-06 13:43:05', 360000.00, 6),
(8, '2026-06-06 13:43:30', 360000.00, 6),
(9, '2026-06-06 13:47:32', 480000.00, 6),
(10, '2026-06-06 13:51:05', 480000.00, 6),
(11, '2026-06-06 14:43:33', 480000.00, 6),
(12, '2026-06-06 15:02:39', 1605000.00, 6),
(13, '2026-06-06 15:13:38', 100000.00, 6);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalles_venta`
--
ALTER TABLE `detalles_venta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ventas_usuario` (`id_vendedor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalles_venta`
--
ALTER TABLE `detalles_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_usuario` FOREIGN KEY (`id_vendedor`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

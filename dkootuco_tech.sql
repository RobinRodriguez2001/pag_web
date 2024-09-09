-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 08-09-2024 a las 20:12:10
-- Versión del servidor: 10.6.16-MariaDB-cll-lve
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dkootuco_tech`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credenciales`
--

CREATE TABLE `credenciales` (
  `id_usuario` int(11) NOT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `contra` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `credenciales`
--

INSERT INTO `credenciales` (`id_usuario`, `correo`, `contra`) VALUES
(1, 'robindaniel645@gmail.com', '$2y$10$8qxeIRatVqetG6Lu7CiaHOBuSHbBoAtmy5PPdWxc334.xuR7x42gO'),
(2, 'angelinaochoa5@gmail.com', '$2y$10$wIaZCIingX2zzvAZdLt0J..dQQQ0PthRYYWbjxCHbc5Ht1w1WnR9W'),
(3, 'lopez19jorgefigeroa@gmail.com', '$2y$10$War1ZoMfVPn7oNLcgmyPtOQD2lVS1ubkR/ElJknf62k3Ki.1zVG2a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `Id` int(11) NOT NULL,
  `horaSalida` varchar(50) NOT NULL DEFAULT '',
  `horaRegreso` varchar(50) NOT NULL DEFAULT '',
  `fechaSalida` varchar(50) NOT NULL DEFAULT '',
  `fechaRegreso` varchar(50) NOT NULL DEFAULT '0',
  `destino` varchar(50) NOT NULL DEFAULT '0',
  `tipoTransporte` varchar(50) NOT NULL DEFAULT '0',
  `precio` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE `posts` (
  `id` int(6) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `contenido` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `imagen` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id`, `titulo`, `tipo`, `contenido`, `fecha`, `imagen`) VALUES
(52, ' Gamer', 'imagen', 'innovación y vanguardia en el mundo de los videojuegos', '2024-08-24 06:44:31', '1.jpg'),
(53, 'Mouse Gamer', 'imagen', 'Explorala epoca de los video juegos desde la epoca delos 50 hasta la actualidad', '2024-08-24 06:41:22', '11.webp'),
(54, 'computadoras', 'imagen', 'En la industria del diseño gráfico, es fundamental contar con una computadora que pueda manejar tareas complejas y procesamiento de imágenes y gráficos de alta calidad. ', '2024-08-24 06:38:59', 'images.jpeg'),
(55, 'entretenimiento', 'imagen', 'Durante la CES 2024, un grupo de expertos en accesibilidad en videojuegos pidieron que el diseño de futuros juegos y consolas tome más en cuenta a las personas con discapacidad, quienes también son fanáticas del medio y muchas veces quedan excluidos de la comunidad.', '2024-08-24 06:36:38', 'aiai.jpeg'),
(56, 'Audífonos inalámbricos', 'imagen', 'Auriculares inalámbricos, auriculares inalámbricos 2024 Bluetooth 5.3, 0.559 in Driver Stereo, 0.11 oz Mini auriculares 48 horas, 4 micrófonos ENC Bluetooth auriculares en el oído, IP7 impermeable,', '2024-08-24 06:34:56', '61oSH_TG6oL._AC_UF894_1000_QL80_.jpg'),
(57, 'Quienes Somos?', 'video', 'https://www.youtube.com/watch?v=FPxabDsin-Y', '2024-08-24 13:37:18', NULL),
(58, 'Computadoras', 'imagen', 'computadoras de alta tecnologia', '2024-08-24 14:33:27', 'aiai.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `id_producto` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `modelo` text NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `cantidad` varchar(20) NOT NULL DEFAULT '0',
  `precio` varchar(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id_producto`, `nombre`, `modelo`, `imagen`, `cantidad`, `precio`) VALUES
(12, 'Laptop Core i3 6th', 'HP Inc.', '1724218540_monitor.jpg', '23', '280'),
(14, 'ASTRO', 'AUDIFONO ASTRO A10 GEN 2 ', '1724384817_1.jpg', '55', '578'),
(15, 'AUDIFONO LOGITECH', 'G435 INALAMBRICO PARA GAMERS NEGRO CON AMARILLO', '1724385164_2.jpg', '100', '590'),
(18, 'MONITOR LED AOC', 'GAMING CURVO 27\" 1920x1080 165Hz HDMI C27G2', '1724385402_3.jpg', '10', '1640'),
(19, 'Refurbished Microsoft Surface', 'Go 2 Procesador I5 1135G7 2.4Ghz Memoria RAM De 8GB Almacenamiento De 128GB Pantalla De 12.4\" Touch En Ingles', '1724385544_4.jpg', '10', '4540'),
(20, 'Notebook XPS 13 Plus', '13 Plus 9320 Marca Dell Procesador Intel Core i7 Version 1360P De 2.2 Ghz Con 16GB De Memoria RAM 512GB De Almacenamiento En SSD Pantalla De 13\" Touch Con Windows 11 Pro', '1724385967_5.jpg', '45', '16125'),
(24, 'MacBook Pro', 'Apple', '1724386524_Apple_MacBook-Pro_14-16-inch_10182021_big.jpg.large.jpg', '15', '16,000.00'),
(30, 'TECLA RAZER QUARTZ', 'QUARTZ ROSADO PARA TECLADOS GAMING RC21-01490300-R3M1', '1724387870_9.jpg', '100', '230');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `referencia`
--

CREATE TABLE `referencia` (
  `Id` int(11) NOT NULL,
  `Usuario` varchar(50) NOT NULL,
  `Cargo` varchar(50) NOT NULL,
  `Comentario` varchar(1000) NOT NULL,
  `Imagen` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `referencia`
--

INSERT INTO `referencia` (`Id`, `Usuario`, `Cargo`, `Comentario`, `Imagen`) VALUES
(30, 'CARLITOS230', 'Estudiante', 'Hace poco compre un teclado gamer y la verdad estoy satisfecho, tech vende productos de calidad', '1724388092_a.jpeg'),
(31, 'Luis025', 'Entrenador', 'Llevo dos meses usando los audífonos astro y tienen muy buena funcion ', '1724479877_aastro.jpg'),
(32, 'Pamela095', 'Diseñadora', 'En tech encontre la computadora que estaba buscando a un excelente precio.', '1724480323_images.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservar`
--

CREATE TABLE `reservar` (
  `Id` int(11) NOT NULL,
  `Destino` varchar(50) NOT NULL DEFAULT '0',
  `No_pasajeros` int(11) NOT NULL DEFAULT 0,
  `TipoTransporte` varchar(50) NOT NULL DEFAULT '0',
  `Comentario` varchar(300) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transporte`
--

CREATE TABLE `transporte` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `Imagen` varchar(1000) DEFAULT NULL,
  `Info` varchar(10000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `transporte`
--

INSERT INTO `transporte` (`Id`, `Nombre`, `Imagen`, `Info`) VALUES
(86, 'ALL FOR ONE', '1723251861_lDBVr1e.jpg', 'ES EL HDP MAS CABRON'),
(87, 'puerto usb', '1723404304_fondo1.jpg', 'tranferencia de datos');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `credenciales`
--
ALTER TABLE `credenciales`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `referencia`
--
ALTER TABLE `referencia`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `reservar`
--
ALTER TABLE `reservar`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `transporte`
--
ALTER TABLE `transporte`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `credenciales`
--
ALTER TABLE `credenciales`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `referencia`
--
ALTER TABLE `referencia`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `reservar`
--
ALTER TABLE `reservar`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `transporte`
--
ALTER TABLE `transporte`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-04-2021 a las 08:59:17
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
-- Base de datos: `divino_maestro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `id_articulo` int(5) NOT NULL,
  `articulo` varchar(30) NOT NULL,
  `id_fabrica` int(5) NOT NULL,
  `existencia` int(5) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Disparadores `articulos`
--
DELIMITER $$
CREATE TRIGGER `ArticulosEditar` AFTER UPDATE ON `articulos` FOR EACH ROW BEGIN

INSERT INTO bitacora_articulos(id_articulo,ejecutor,actividad_realizada,informacion_anterior,informacion_actual)VALUES(
OLD.id_articulo,CURRENT_USER,'Se ACTUALIZO un articulo',concat('Informacion anterior: ',OLD.articulo,' ',OLD.id_fabrica,' ',OLD.existencia,' ',OLD.descripcion,' ',OLD.condicion),concat('Informacion actual: ',NEW.articulo,' ',NEW.id_fabrica,' ',NEW.existencia,' ',NEW.descripcion,' ',NEW.condicion));

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ArticulosEliminar` AFTER DELETE ON `articulos` FOR EACH ROW BEGIN

INSERT INTO bitacora_articulos(id_articulo,ejecutor,actividad_realizada,informacion_anterior)VALUES(
OLD.id_articulo,CURRENT_USER,'Se ELIMINO un articulo',concat('Informacion eliminada: ',OLD.articulo,' ',OLD.id_fabrica,' ',OLD.existencia,' ',OLD.descripcion,' ',OLD.condicion));

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ArticulosInsertar` AFTER INSERT ON `articulos` FOR EACH ROW BEGIN

INSERT INTO bitacora_articulos(id_articulo,ejecutor,actividad_realizada,informacion_actual)VALUES(
NEW.id_articulo,CURRENT_USER,'Se INSERTO un articulo',concat('Informacion actual: ',NEW.articulo,' ',NEW.id_fabrica,' ',NEW.existencia,' ',NEW.descripcion,' ',NEW.condicion));

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora_articulos`
--

CREATE TABLE `bitacora_articulos` (
  `id_bitacora` int(11) NOT NULL,
  `id_articulo` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `ejecutor` varchar(20) NOT NULL,
  `actividad_realizada` varchar(100) NOT NULL,
  `informacion_actual` text NOT NULL,
  `informacion_anterior` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `bitacora_clientes` (
  `id_bitacora` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `ejecutor` varchar(20) NOT NULL,
  `actividad_realizada` varchar(100) NOT NULL,
  `informacion_actual` text NOT NULL,
  `informacion_anterior` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Estructura de tabla para la tabla `bitacora_envios`
--

CREATE TABLE `bitacora_envios` (
  `id_bitacora` int(11) NOT NULL,
  `id_envio` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `ejecutor` varchar(20) NOT NULL,
  `actividad_realizada` varchar(100) NOT NULL,
  `informacion_actual` text NOT NULL,
  `informacion_anterior` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Estructura de tabla para la tabla `bitacora_fabricas`
--

CREATE TABLE `bitacora_fabricas` (
  `id_bitacora` int(11) NOT NULL,
  `id_fabrica` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `ejecutor` varchar(20) NOT NULL,
  `actividad_realizada` varchar(100) NOT NULL,
  `informacion_actual` text NOT NULL,
  `informacion_anterior` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Estructura de tabla para la tabla `bitacora_pedidos`
--

CREATE TABLE `bitacora_pedidos` (
  `id_bitacora` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `ejecutor` varchar(20) NOT NULL,
  `actividad_realizada` varchar(100) NOT NULL,
  `informacion_actual` text NOT NULL,
  `informacion_anterior` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Estructura de tabla para la tabla `bitacora_usuarios`
--

CREATE TABLE `bitacora_usuarios` (
  `id_bitacora` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `ejecutor` varchar(20) NOT NULL,
  `actividad_realizada` varchar(100) NOT NULL,
  `informacion_actual` text NOT NULL,
  `informacion_anterior` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(5) NOT NULL,
  `codigo_unico` int(5) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `id_envio` int(5) NOT NULL,
  `saldo` float NOT NULL,
  `credito` float NOT NULL,
  `descuento` float NOT NULL,
  `condicion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Disparadores `clientes`
--
DELIMITER $$
CREATE TRIGGER `ClientesEditar` AFTER UPDATE ON `clientes` FOR EACH ROW BEGIN

INSERT INTO bitacora_clientes(id_cliente,ejecutor,actividad_realizada,informacion_anterior,informacion_actual)VALUES(
OLD.id_cliente,CURRENT_USER,'Se ACTUALIZO un cliente',concat('Informacion anterior: ',OLD.codigo_unico,' ',OLD.nombre,' ',OLD.apellido,' ',OLD.id_envio,' ',OLD.saldo,' ',OLD.credito,' ',OLD.descuento,' ',OLD.condicion),concat('Informacion actual: ',NEW.codigo_unico,' ',NEW.nombre,' ',NEW.apellido,' ',NEW.id_envio,' ',NEW.saldo,' ',NEW.credito,' ',NEW.descuento,' ',NEW.condicion));

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ClientesEliminar` AFTER DELETE ON `clientes` FOR EACH ROW BEGIN

INSERT INTO bitacora_clientes(id_cliente,ejecutor,actividad_realizada,informacion_anterior)VALUES(
OLD.id_cliente,CURRENT_USER,'Se ELIMINO un cliente',concat('Informacion anterior: ',OLD.codigo_unico,' ',OLD.nombre,' ',OLD.apellido,' ',OLD.id_envio,' ',OLD.saldo,' ',OLD.credito,' ',OLD.descuento,' ',OLD.condicion));

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ClientesInsertar` AFTER INSERT ON `clientes` FOR EACH ROW BEGIN

INSERT INTO bitacora_clientes(id_cliente,ejecutor,actividad_realizada,informacion_actual)VALUES(
NEW.id_cliente,CURRENT_USER,'Se INSERTO un cliente',concat('Informacion actual: ',NEW.codigo_unico,' ',NEW.nombre,' ',NEW.apellido,' ',NEW.id_envio,' ',NEW.saldo,' ',NEW.credito,' ',NEW.descuento,' ',NEW.condicion));

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envios`
--

CREATE TABLE `envios` (
  `id_envio` int(5) NOT NULL,
  `lugar_envio` varchar(100) NOT NULL,
  `calle` varchar(30) NOT NULL,
  `comuna` varchar(30) NOT NULL,
  `ciudad` varchar(30) NOT NULL,
  `condicion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Disparadores `envios`
--
DELIMITER $$
CREATE TRIGGER `EnviosEditar` AFTER UPDATE ON `envios` FOR EACH ROW BEGIN

INSERT INTO bitacora_envios(id_envio,ejecutor,actividad_realizada,informacion_anterior,informacion_actual)VALUES(
OLD.id_envio,CURRENT_USER,'Se ACTUALIZO una dirección de envio',concat('Informacion anterior: ',OLD.lugar_envio,' ',OLD.calle,' ',OLD.comuna,' ',OLD.ciudad,' ',OLD.condicion),concat('Informacion actual: ',NEW.lugar_envio,' ',NEW.calle,' ',NEW.comuna,' ',NEW.ciudad,' ',NEW.condicion));

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `EnviosEliminar` AFTER DELETE ON `envios` FOR EACH ROW BEGIN

INSERT INTO bitacora_envios(id_envio,ejecutor,actividad_realizada,informacion_anterior)VALUES(
OLD.id_envio,CURRENT_USER,'Se ELIMINO una dirección de envio',concat('Informacion anterior: ',OLD.lugar_envio,' ',OLD.calle,' ',OLD.comuna,' ',OLD.ciudad,' ',OLD.condicion));

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `EnviosInsertar` AFTER INSERT ON `envios` FOR EACH ROW BEGIN

INSERT INTO bitacora_envios(id_envio,ejecutor,actividad_realizada,informacion_actual)VALUES(
NEW.id_envio,CURRENT_USER,'Se INSERTO una dirección de envio',concat('Informacion actual: ',NEW.lugar_envio,' ',NEW.calle,' ',NEW.comuna,' ',NEW.ciudad,' ',NEW.condicion));

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fabricas`
--

CREATE TABLE `fabricas` (
  `id_fabrica` int(5) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `telefono` int(8) NOT NULL,
  `condicion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Disparadores `fabricas`
--
DELIMITER $$
CREATE TRIGGER `FabricasEditar` AFTER UPDATE ON `fabricas` FOR EACH ROW BEGIN

INSERT INTO bitacora_fabricas(id_fabrica,ejecutor,actividad_realizada,informacion_anterior,informacion_actual)VALUES(
OLD.id_fabrica,CURRENT_USER,'Se ACTUALIZO una fabrica',concat('Informacion anterior: ',OLD.nombre,' ',OLD.telefono,' ',OLD.condicion),concat('Informacion actual: ',NEW.nombre,' ',NEW.telefono,' ',NEW.condicion,' ',NEW.condicion));

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `FabricasEliminar` BEFORE DELETE ON `fabricas` FOR EACH ROW BEGIN

INSERT INTO bitacora_fabricas(id_fabrica,ejecutor,actividad_realizada,informacion_anterior)VALUES(
OLD.id_fabrica,CURRENT_USER,'Se ELIMINO una fabrica',concat('Informacion actual: ',OLD.nombre,' ',OLD.telefono,' ',OLD.condicion));

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `FabricasInsertar` AFTER INSERT ON `fabricas` FOR EACH ROW BEGIN

INSERT INTO bitacora_fabricas(id_fabrica,ejecutor,actividad_realizada,informacion_actual)VALUES(
NEW.id_fabrica,CURRENT_USER,'Se INSERTO una fabrica',concat('Informacion actual: ',NEW.nombre,' ',NEW.telefono,' ',NEW.condicion));

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(5) NOT NULL,
  `id_cliente` int(5) NOT NULL,
  `id_envio` int(5) NOT NULL,
  `fecha` datetime NOT NULL,
  `id_articulo` int(5) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `condicion` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Disparadores `pedidos`
--
DELIMITER $$
CREATE TRIGGER `PedidosEditar` AFTER UPDATE ON `pedidos` FOR EACH ROW BEGIN

INSERT INTO bitacora_pedidos(id_pedido,ejecutor,actividad_realizada,informacion_anterior,informacion_actual)VALUES(
OLD.id_pedido,CURRENT_USER,'Se ACTUALIZO un pedido',concat('Informacion anterior: ',OLD.id_cliente,' ',OLD.id_envio,' ',OLD.fecha,' ',OLD.id_articulo,' ',OLD.descripcion,' ',OLD.cantidad,' ',OLD.condicion),concat('Informacion actual: ',NEW.id_cliente,' ',NEW.id_envio,' ',NEW.fecha,' ',NEW.id_articulo,' ',NEW.descripcion,' ',NEW.cantidad,' ',NEW.condicion));

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `PedidosEliminar` AFTER DELETE ON `pedidos` FOR EACH ROW BEGIN

INSERT INTO bitacora_pedidos(id_pedido,ejecutor,actividad_realizada,informacion_anterior)VALUES(
OLD.id_pedido,CURRENT_USER,'Se ELIMINO un pedido',concat('Informacion anterior: ',OLD.id_cliente,' ',OLD.id_envio,' ',OLD.fecha,' ',OLD.id_articulo,' ',OLD.descripcion,' ',OLD.cantidad,' ',OLD.condicion));

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `PedidosInsertar` AFTER INSERT ON `pedidos` FOR EACH ROW BEGIN

INSERT INTO bitacora_pedidos(id_pedido,ejecutor,actividad_realizada,informacion_actual)VALUES(
NEW.id_pedido,CURRENT_USER,'Se INSERTO un pedido',concat('Informacion actual: ',NEW.id_cliente,' ',NEW.id_envio,' ',NEW.fecha,' ',NEW.id_articulo,' ',NEW.descripcion,' ',NEW.cantidad,' ',NEW.condicion));

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Marlon Miranda', 'MarlonMiranda@gmail.com', NULL, '$2y$10$5Mf5o.aFVlTn0jZOik6obukihCJs4R1MmM3mhkJ2WnhLg19pKMZJ.', NULL, '2020-08-01 06:54:11', '2020-08-01 06:54:11');

--
-- Disparadores `users`
--
DELIMITER $$
CREATE TRIGGER `UsuariosEditar` AFTER UPDATE ON `users` FOR EACH ROW BEGIN

INSERT INTO bitacora_usuarios(id_usuario,ejecutor,actividad_realizada,informacion_anterior,informacion_actual)VALUES(
OLD.id,CURRENT_USER,'Se ACTUALIZO un usuario',concat('Informacion anterior: ',OLD.name,' ',OLD.email,' ',OLD.password,' ',OLD.created_at,' ',OLD.updated_at),concat('Informacion actual: ',NEW.name,' ',NEW.email,' ',NEW.password,' ',NEW.created_at,' ',NEW.updated_at));

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UsuariosEliminar` AFTER DELETE ON `users` FOR EACH ROW BEGIN

INSERT INTO bitacora_usuarios(id_usuario,ejecutor,actividad_realizada,informacion_anterior)VALUES(
OLD.id,CURRENT_USER,'Se ELIMINO un usuario',concat('Informacion anterior: ',OLD.name,' ',OLD.email,' ',OLD.password,' ',OLD.created_at,' ',OLD.updated_at));

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UsuariosInsertar` AFTER INSERT ON `users` FOR EACH ROW BEGIN

INSERT INTO bitacora_usuarios(id_usuario,ejecutor,actividad_realizada,informacion_actual)VALUES(
NEW.id,CURRENT_USER,'Se INSERTO un usuario',concat('Informacion actual: ',NEW.name,' ',NEW.email,' ',NEW.password,' ',NEW.created_at,' ',NEW.updated_at));

END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id_articulo`),
  ADD KEY `id_fabrica` (`id_fabrica`);

--
-- Indices de la tabla `bitacora_articulos`
--
ALTER TABLE `bitacora_articulos`
  ADD PRIMARY KEY (`id_bitacora`);

--
-- Indices de la tabla `bitacora_clientes`
--
ALTER TABLE `bitacora_clientes`
  ADD PRIMARY KEY (`id_bitacora`);

--
-- Indices de la tabla `bitacora_envios`
--
ALTER TABLE `bitacora_envios`
  ADD PRIMARY KEY (`id_bitacora`);

--
-- Indices de la tabla `bitacora_fabricas`
--
ALTER TABLE `bitacora_fabricas`
  ADD PRIMARY KEY (`id_bitacora`);

--
-- Indices de la tabla `bitacora_pedidos`
--
ALTER TABLE `bitacora_pedidos`
  ADD PRIMARY KEY (`id_bitacora`);

--
-- Indices de la tabla `bitacora_usuarios`
--
ALTER TABLE `bitacora_usuarios`
  ADD PRIMARY KEY (`id_bitacora`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `id_direccion` (`id_envio`);

--
-- Indices de la tabla `envios`
--
ALTER TABLE `envios`
  ADD PRIMARY KEY (`id_envio`);

--
-- Indices de la tabla `fabricas`
--
ALTER TABLE `fabricas`
  ADD PRIMARY KEY (`id_fabrica`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_envio` (`id_envio`),
  ADD KEY `id_articulo` (`id_articulo`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id_articulo` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bitacora_articulos`
--
ALTER TABLE `bitacora_articulos`
  MODIFY `id_bitacora` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bitacora_clientes`
--
ALTER TABLE `bitacora_clientes`
  MODIFY `id_bitacora` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bitacora_envios`
--
ALTER TABLE `bitacora_envios`
  MODIFY `id_bitacora` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bitacora_fabricas`
--
ALTER TABLE `bitacora_fabricas`
  MODIFY `id_bitacora` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bitacora_pedidos`
--
ALTER TABLE `bitacora_pedidos`
  MODIFY `id_bitacora` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `bitacora_usuarios`
--
ALTER TABLE `bitacora_usuarios`
  MODIFY `id_bitacora` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `envios`
--
ALTER TABLE `envios`
  MODIFY `id_envio` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fabricas`
--
ALTER TABLE `fabricas`
  MODIFY `id_fabrica` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `articulos_ibfk_1` FOREIGN KEY (`id_fabrica`) REFERENCES `fabricas` (`id_fabrica`);

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`id_envio`) REFERENCES `envios` (`id_envio`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`id_envio`) REFERENCES `envios` (`id_envio`),
  ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`id_articulo`) REFERENCES `articulos` (`id_articulo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

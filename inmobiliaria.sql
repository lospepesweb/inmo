-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-07-2017 a las 01:46:13
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inmobiliaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(10) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `direccion` varchar(300) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `asesor` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `direccion`, `telefono`, `correo`, `asesor`) VALUES
(2, 'CLIENTEUNO', 'EN SU CASA', '123456456', 'correo@ej.com', 'ANDRES PETRONIO'),
(4, 'CLIENTEDOS', 'ASD', '123', '123@654.com', 'ASESOR DE VENTAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(10) NOT NULL,
  `id_propiedad` varchar(200) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `tel` varchar(30) NOT NULL,
  `correo` varchar(200) NOT NULL,
  `mensaje` text NOT NULL,
  `estatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `id_propiedad`, `nombre`, `tel`, `correo`, `mensaje`, `estatus`) VALUES
(1, '01bb9921254719b884591127c0f9aae15d1cc475', 'asd', '123', 'asd@jiji.com', 'asd', 'NUEVO'),
(2, '01bb9921254719b884591127c0f9aae15d1cc475', 'asd', '454987', '46@dsa.c60', 'asd', 'NUEVO'),
(3, 'e35ae53607bfabb5c8f117f33e2e6ed8fb021adc', 'dasd', 'das', '123', 'z64', 'NUEVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `iddepartamento` int(11) NOT NULL,
  `idprovincia` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `departamento` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`iddepartamento`, `idprovincia`, `departamento`) VALUES
(1, '18', 'ALBARDÓN'),
(2, '18', 'ANGACO'),
(3, '18', 'CALINGASTA'),
(4, '18', 'CAPITAL'),
(5, '18', 'CAUCETE'),
(6, '18', 'CHIMBAS'),
(7, '18', 'IGLESIA'),
(8, '18', 'JÁCHAL'),
(9, '18', '9 DE JULIO'),
(10, '18', 'POCITO'),
(11, '18', 'RAWSON'),
(12, '18', 'RIVADAVIA'),
(13, '18', 'SAN MARTÍN'),
(14, '18', 'SANTA LUCÍA'),
(15, '18', 'SARMIENTO'),
(16, '18', 'ULLUM'),
(17, '18', 'VALLE FERTIL'),
(19, '18', '25 DE MAYO'),
(20, '18', 'ZONDA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `id` int(10) NOT NULL,
  `id_propiedad` varchar(200) NOT NULL,
  `ruta` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fotos`
--

INSERT INTO `fotos` (`id`, `id_propiedad`, `ruta`) VALUES
(7, '01bb9921254719b884591127c0f9aae15d1cc475', 'fotos/01bb9921254719b884591127c0f9aae15d1cc475151.png'),
(9, '01bb9921254719b884591127c0f9aae15d1cc475', 'fotos/01bb9921254719b884591127c0f9aae15d1cc4751023.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `propiedad` varchar(200) NOT NULL,
  `consecutivo` int(10) NOT NULL,
  `id_cliente` int(10) NOT NULL,
  `provincia` varchar(50) NOT NULL,
  `departamento` varchar(100) NOT NULL,
  `nombre_cliente` varchar(200) NOT NULL,
  `precio` double NOT NULL,
  `barrio` varchar(100) NOT NULL,
  `calle_num` varchar(100) NOT NULL,
  `numero_int` int(10) NOT NULL,
  `m2t` int(10) NOT NULL,
  `banos` int(2) NOT NULL,
  `plantas` int(2) NOT NULL,
  `caracteristicas` text NOT NULL,
  `m2c` int(10) NOT NULL,
  `dormitorios` int(2) NOT NULL,
  `cocheras` int(2) NOT NULL,
  `observaciones` text NOT NULL,
  `forma_pago` varchar(50) NOT NULL,
  `asesor` varchar(200) NOT NULL,
  `tipo_inmueble` varchar(100) NOT NULL,
  `fecha_registro` date NOT NULL,
  `comentario_web` text NOT NULL,
  `operacion` varchar(50) NOT NULL,
  `foto_principal` varchar(200) NOT NULL,
  `mapa` varchar(200) NOT NULL,
  `marcado` varchar(2) NOT NULL,
  `estatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`propiedad`, `consecutivo`, `id_cliente`, `provincia`, `departamento`, `nombre_cliente`, `precio`, `barrio`, `calle_num`, `numero_int`, `m2t`, `banos`, `plantas`, `caracteristicas`, `m2c`, `dormitorios`, `cocheras`, `observaciones`, `forma_pago`, `asesor`, `tipo_inmueble`, `fecha_registro`, `comentario_web`, `operacion`, `foto_principal`, `mapa`, `marcado`, `estatus`) VALUES
('01bb9921254719b884591127c0f9aae15d1cc475', 1, 2, 'SAN JUAN', 'CAPITAL', 'CLIENTEUNO', 3, 'Villa Am&eacute;rica', 'PER&Uacute; 762', 33, 3, 3, 3, 'S', 3, 3, 3, 'S', 'A', 'ANDRES PETRONIO', 'CASA', '2017-07-27', 'A', 'VENTA', 'fotos/principal-94301bb9921254719b884591127c0f9aae15d1cc475.png', '-31.523374, -68.514299', 'SI', 'ACTIVO'),
('e35ae53607bfabb5c8f117f33e2e6ed8fb021adc', 2, 2, 'SAN JUAN', 'RIVADAVIA', 'CLIENTEUNO', 5, 'NATANIA RECIDENCIAL', 'LA CASA DEL LUCHO 123', 0, 4, 5, 4, 'SAD', 4, 5, 6, 'ASD', 'A', 'ASESOR DE VENTAS', 'CASA', '2017-07-22', 'ASD', 'VENTA', 'fotos/foto_principal.png', '-31.536813, -68.595105', '', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `idprovincia` int(11) NOT NULL,
  `provincia` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`idprovincia`, `provincia`) VALUES
(1, 'BUENOS AIRES'),
(2, 'CATAMARCA'),
(3, 'CHACO'),
(4, 'CHUBUT'),
(5, 'CIUDAD AUTÓNOMA DE BUENOS AIRES'),
(6, 'CÓRDOBA'),
(7, 'CORRIENTES'),
(8, 'ENTRE RÍOS'),
(9, 'FORMOSA'),
(10, 'JUJUY'),
(11, 'LA PAMPA'),
(12, 'LA RIOJA'),
(13, 'MENDOZA'),
(14, 'MISIONES'),
(15, 'NEUQUÉN'),
(16, 'RÍO NEGRO'),
(17, 'SALTA'),
(18, 'SAN JUAN'),
(19, 'SAN LUIS'),
(20, 'SANTA CRUZ'),
(21, 'SANTA FE'),
(22, 'SANTIAGO DEL ESTERO'),
(23, 'TIERRA DEL FUEGO'),
(24, 'TUCUMÁN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `slider`
--

CREATE TABLE `slider` (
  `id` int(2) NOT NULL,
  `ruta` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `slider`
--

INSERT INTO `slider` (`id`, `ruta`) VALUES
(2, 'img/1512.png'),
(3, 'img/863.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(3) NOT NULL,
  `nick` varchar(15) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `nivel` varchar(20) NOT NULL,
  `bloqueo` int(1) NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nick`, `pass`, `nombre`, `correo`, `nivel`, `bloqueo`, `foto`) VALUES
(5, 'PETRONIO', 'ec07397240fc2dd836c0078ff0967e875a6d1882', 'ANDRES PETRONIO', 'asd@asd.com', 'Admin', 1, 'fotos_perfil/PETRONIO45.png'),
(6, 'ASESORUNO', '600872ab84ac9dff4aed35148ea01784d91bb064', 'ASESOR DE VENTAS', 'correo@k.com', 'Asesor', 1, 'fotos_perfil/perfil.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`iddepartamento`),
  ADD UNIQUE KEY `idmunicipios_UNIQUE` (`iddepartamento`);

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`propiedad`),
  ADD UNIQUE KEY `consecutivo` (`consecutivo`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`idprovincia`),
  ADD UNIQUE KEY `idestados_UNIQUE` (`idprovincia`);

--
-- Indices de la tabla `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nick` (`nick`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `consecutivo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

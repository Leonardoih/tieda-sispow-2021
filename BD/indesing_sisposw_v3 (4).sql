-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-10-2020 a las 09:07:48
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `indesing_sisposw_v3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id_administrador` int(11) NOT NULL,
  `nick_usuario` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_reg` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(1) COLLATE utf8_spanish_ci NOT NULL,
  `persona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id_administrador`, `nick_usuario`, `clave`, `fecha_reg`, `estado`, `persona`) VALUES
(2, 'administrador', '81dc9bdb52d04dc20036dbd8313ed055', '10/10/2020', '1', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(60) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`) VALUES
(1, 'cereales'),
(2, 'atunes'),
(3, 'pastas'),
(4, 'lacteos'),
(5, 'bebidas'),
(6, 'frutas'),
(7, 'verduras'),
(8, 'aseo'),
(9, 'carnes'),
(10, 'confiterias y golosinas'),
(11, 'condimentos y sazonadores'),
(12, 'harinas'),
(13, 'bebidas alcoholicas'),
(14, 'bebes'),
(15, 'salsas'),
(16, 'cuidado personal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nick_usuario` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_reg` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `estado` varchar(1) COLLATE utf8_spanish_ci NOT NULL,
  `persona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nick_usuario`, `clave`, `fecha_reg`, `estado`, `persona`) VALUES
(8, 'sebastianO', '827ccb0eea8a706c4c34a16891f84e7b', '2020-10-16', '0', 13),
(9, 'manuelC', '827ccb0eea8a706c4c34a16891f84e7b', '2020-10-18', '1', 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_ventas`
--

CREATE TABLE `det_ventas` (
  `id_detalle` int(11) NOT NULL,
  `venta` int(11) NOT NULL,
  `producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` double(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `det_ventas`
--

INSERT INTO `det_ventas` (`id_detalle`, `venta`, `producto`, `cantidad`, `subtotal`) VALUES
(1, 43, 1, 1, 1500.00),
(2, 43, 2, 1, 1300.00),
(3, 43, 3, 1, 1900.00),
(4, 43, 4, 1, 6000.00),
(5, 43, 9, 1, 3000.00),
(6, 43, 11, 1, 6600.00),
(7, 43, 14, 1, 3000.00),
(8, 43, 16, 1, 2500.00),
(9, 43, 24, 1, 4790.00),
(10, 43, 62, 1, 1890.00),
(11, 43, 34, 1, 1511.00),
(12, 43, 77, 1, 11613.00),
(13, 44, 24, 1, 4790.00),
(14, 44, 54, 1, 890.00),
(15, 44, 58, 1, 1920.00),
(16, 45, 1, 5, 7500.00),
(17, 45, 2, 1, 1300.00),
(18, 45, 7, 1, 1600.00),
(19, 46, 2, 10, 13000.00),
(20, 46, 3, 1, 1900.00),
(21, 46, 6, 1, 1250.00),
(22, 46, 5, 1, 7000.00),
(23, 46, 4, 1, 6000.00),
(24, 46, 9, 1, 3000.00),
(25, 46, 15, 1, 3500.00),
(26, 46, 11, 1, 6600.00),
(27, 46, 56, 1, 680.00),
(28, 46, 24, 1, 4790.00),
(29, 46, 31, 1, 14990.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id_persona` int(11) NOT NULL,
  `nombres` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellidos` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nro_identificacion` int(11) NOT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `celular` bigint(11) NOT NULL,
  `correo` varchar(60) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id_persona`, `nombres`, `apellidos`, `nro_identificacion`, `direccion`, `celular`, `correo`) VALUES
(6, 'Manuel', 'Castro', 1143976892, 'cra 28 f1 # 122 b 33', 3176080285, 'manuelcastro911@gmail.com'),
(13, 'juan sebastian', 'ospina minotta', 951103198, 'cra 28 f1 # 122 b 33', 2147483647, 'juasebastian@gmail.com'),
(14, 'juan manuel', 'castro', 95110778, 'cra 28 f1 # 122 b 33', 3184654292, 'manuel25@gmail.com'),
(15, 'leonardo', 'izquierdo', 1114741, 'calle 8 a', 314715, 'leonardo@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `precio` double(20,2) NOT NULL,
  `categoria` int(11) NOT NULL,
  `imagen` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `marca` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `existencia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `precio`, `categoria`, `imagen`, `marca`, `stock`, `existencia`) VALUES
(1, 'Arroz diana Premium', 1500.00, 1, 'imagenes/arrozdiana.jpg', 'diana', 10, 100),
(2, 'Arroz Costeño', 1300.00, 1, 'imagenes/arrozcosteno.jpg', 'costeño', 10, 99),
(3, 'Arroz faraon', 1900.00, 1, 'imagenes/arrozfaraon.jpg', 'Faraon', 10, 197),
(4, 'Atun isabell', 6000.00, 2, 'imagenes/atunisabel.jpg', 'isabell', 10, 176),
(5, 'Atun van camps', 7000.00, 2, 'imagenes/atunvancamps.jpg', 'van camps', 10, 205),
(6, 'Fideos Doria', 1250.00, 3, 'imagenes/fideosdoria.jpg', 'doria', 10, 149),
(7, 'Pasta concha', 1600.00, 3, 'imagenes/pastaslamunecaconcha.jpg', 'la muñeca', 10, 99),
(8, 'spaguettis rancheros', 2250.00, 3, 'imagenes/spaguettisrancheros.jpg', 'doria', 10, 254),
(9, 'Leche entera sanfernando', 3000.00, 4, 'imagenes/lechesanfernando.jpg', 'colanta', 10, 198),
(11, 'yogurt', 6600.00, 4, 'imagenes/yogurt.jpg', 'alpina', 10, 58),
(12, 'manzana', 2800.00, 5, 'imagenes/manzanapostobon.jpg', 'postobon', 10, 79),
(13, 'colombiana', 5590.00, 5, 'imagenes/colombiana.jpg', 'postobon', 10, 60),
(14, 'cocacola zero sin azucar', 3000.00, 5, 'imagenes/cocacolazero.jpg', 'cocacola', 10, 59),
(15, 'pony malta', 3500.00, 5, 'imagenes/ponymalta.jpg', 'babaria', 10, 3499),
(16, 'pony 1 litro', 2500.00, 5, 'imagenes/ponylitro.jpg', 'babaria', 10, 59),
(17, 'pañales pequeñin etapa 1', 17990.00, 14, 'imagenes/pañalesetapa1pequeñin.jpg', 'pequeñin', 10, 100),
(18, 'pañitos humedos', 5000.00, 14, 'imagenes/pañitospequeñin.jpg', 'pequeñin', 10, 100),
(19, 'pañitos humedos ', 5590.00, 14, 'imagenes/pañitoswini.jpg', 'wini', 10, 60),
(20, 'pañitos humedos huggis', 5200.00, 14, 'imagenes/pañitoshuggis.jpg', 'huggis', 10, 200),
(21, 'jabon dove baby', 5700.00, 14, 'imagenes/dovebaby.jpg', 'Dove', 10, 150),
(22, 'aceite johnson', 19900.00, 14, 'imagenes/johnsonbaby.jpg', 'johnson', 10, 200),
(23, 'jabon super riel', 3590.00, 8, 'imagenes/superriel.jpg', 'super riel', 10, 256),
(24, 'jabon rey', 4790.00, 8, 'imagenes/jabonrey.jpg', 'rey', 10, 197),
(25, 'rindex', 3423.00, 8, 'imagenes/rindex.jpg', 'rindex', 10, 150),
(26, '', 7693.00, 8, 'imagenes/coco.webp', 'coco', 10, 100),
(27, 'detergente blancox ropa', 7973.00, 8, 'imagenes/blancosropa.jpg', 'blancox', 10, 100),
(28, 'detergente fab', 9373.00, 8, 'imagenes/fab.jpg', 'fab', 10, 100),
(29, 'clorox', 6390.00, 8, 'imagenes/cloroxori.jpg', 'clorox', 10, 200),
(30, 'clorox 1000', 3790.00, 8, 'imagenes/clorox1000.jpg', 'clorox', 10, 100),
(31, 'clorox floral', 14990.00, 8, 'imagenes/cloroxfloral.jpg', 'clorox', 10, 149),
(32, 'limpido  multiusos', 6250.00, 8, 'imagenes/limpido.jpg', 'limpido', 10, 100),
(33, 'limpido floral', 1179.00, 8, 'imagenes/limpidofloral.jpg', 'limpido', 10, 150),
(34, 'desinfectante lysol', 1511.00, 8, 'imagenes/lysol.jpg', 'lysol', 10, 99),
(35, 'ropa color', 5250.00, 8, 'imagenes/ropacolor.jpg', 'clorox', 10, 200),
(36, 'sazonatodo', 3672.00, 11, 'imagenes/sasonatodo.jpg', 'maggi', 10, 150),
(37, 'guisamac', 2100.00, 11, 'imagenes/guisamac.jpg', 'guisamac', 10, 180),
(38, 'clavo', 1500.00, 11, 'imagenes/clavo.jpg', 'el rey', 10, 220),
(39, 'color', 3390.00, 11, 'imagenes/color.jpg', 'el rey', 10, 125),
(40, 'refisal', 750.00, 11, 'imagenes/refisal.jpg', 'refisal', 10, 160),
(41, 'caldo de ricostilla', 4290.00, 11, 'imagenes/ricostilla.jpg', 'ricostilla', 10, 200),
(42, 'salsa de tomate', 7594.00, 15, 'imagenes/salsatomate.jpg', 'fruco', 10, 130),
(43, 'mostaza', 2690.00, 15, 'imagenes/mostaza.jpg', 'san jorge', 10, 205),
(44, 'mayonesa', 1900.00, 15, 'imagenes/mayonesa.jpg', 'fruco', 10, 125),
(45, 'salsas', 8990.00, 15, 'imagenes/salsas.jpg', 'fruco', 10, 256),
(46, 'salsa aji', 2190.00, 15, 'imagenes/aji.jpg', 'san jorge', 10, 110),
(47, 'salsa bbq', 5990.00, 15, 'imagenes/salsabarbq.jpg', 'fruco', 10, 150),
(48, 'bofe', 3730.00, 9, 'imagenes/bofe.jpg', 'carnes', 10, 100),
(49, 'caderita', 8190.00, 9, 'imagenes/cadera.jpg', 'carnes', 10, 150),
(50, 'carne molida', 5990.00, 9, 'imagenes/molida.jpg', 'carnes', 10, 150),
(51, '', 6480.00, 9, 'imagenes/costillas.jpg', 'carnes', 10, 180),
(52, 'callo de res', 3990.00, 9, 'imagenes/mondongo.jpg', 'carnes', 10, 200),
(53, 'pollo sin vicera', 3190.00, 9, 'imagenes/pollo.jpg', 'carnes', 10, 260),
(54, 'zanahoria', 890.00, 7, 'imagenes/zanahoria.jpg', 'verduras', 10, 179),
(55, 'lechuga', 1552.00, 7, 'imagenes/lechuga.jpg', 'verduras', 10, 120),
(56, 'tomate', 680.00, 7, 'imagenes/tomate.jpg', 'verduras', 10, 177),
(57, 'cebolla larga limpia', 1630.00, 7, 'imagenes/cebolla.jpg', 'verduras', 10, 265),
(58, 'brocoli', 1920.00, 7, 'imagenes/brocoli.jpg', 'verduras', 10, 134),
(59, 'banano', 504.00, 6, 'imagenes/banano.jpg', 'frutas', 10, 189),
(60, 'manzana bolsa x10und', 6780.00, 6, 'imagenes/manzana.jpg', 'frutas', 10, 95),
(61, 'uva importada', 25140.00, 6, 'imagenes/uva.jpg', 'frutas', 10, 180),
(62, 'mango tomy', 1890.00, 6, 'imagenes/mango.jpg', 'frutas', 10, 219),
(63, 'guayaba pera', 690.00, 6, 'imagenes/guayaba.gif', 'frutas', 10, 155),
(64, 'harina de trigo tradicional farallones x 500 g', 1100.00, 12, 'imagenes/harina.jpg', 'farallones', 10, 260),
(65, 'harina promasa amarilla x 1000 g', 3590.00, 12, 'imagenes/promasa.jpg', 'promasa', 10, 196),
(66, 'harina pan', 3490.00, 12, 'imagenes/pan.jpg', 'pan', 10, 220),
(67, 'mezcla lista para pancakes crepes y waffles x 600 g', 7890.00, 12, 'imagenes/wafles.jpg', 'aunt jemima', 10, 126),
(68, 'galleta oreo original x 432 g', 7190.00, 10, 'imagenes/oreo.jpg', 'navisco', 10, 330),
(69, 'arequipe alpina x 500g', 9390.00, 10, 'imagenes/arequipe.jpg', 'alpina', 10, 450),
(70, 'chocolatina jet cruji x 12 unidades', 6590.00, 10, 'imagenes/jet.jpg', 'jet', 10, 460),
(71, 'dulces de gomitas acidas', 4850.00, 10, 'imagenes/troli.jpg', 'trolli', 10, 260),
(72, 'bombones', 12056.00, 10, 'imagenes/bombones.jpg', 'bombones', 10, 335),
(73, 'crema dental colgate maxwhite limpieza completa x 3und x 100 ml c-u', 13990.00, 16, 'imagenes/colgate.jpg', 'colgate', 10, 150),
(74, 'desodorante Yodora crema atitranspirante fresh x 2und x 100g', 8394.00, 16, 'imagenes/yodora.jpg', 'yodora', 10, 230),
(75, 'shampoo savital anticaspa menta eucalipto y sabilax550ml', 9327.00, 16, 'imagenes/savital.jpg', 'savital', 10, 265),
(76, '', 14661.00, 16, 'imagenes/talco.webp', 'yodora', 10, 290),
(77, 'protectores diarios nosotras multiestilo x 150und + Jabón Intimo x 110ml', 11613.00, 16, 'imagenes/protetores.jpg', 'nosotras', 10, 163),
(78, 'toallas higiénicas nosotras Tela Tipo Algodón 4paq x 8und', 10073.00, 16, 'imagenes/toallas.jpg', 'nosotras', 10, 320),
(79, 'Vino Cariñoso x 750 m', 13990.00, 13, 'imagenes/vino.jpg', 'cariñoso', 10, 158),
(80, 'ron viejo de caldas botella x 750ml', 55630.00, 13, 'imagenes/ron.jpg', 'de caldas', 10, 350),
(82, 'Piña colada Jonnyki x 700 ml', 27990.00, 13, 'imagenes/piña.jpg', 'jonnyki', 10, 264);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiones`
--

CREATE TABLE `sesiones` (
  `id_sesion` int(11) NOT NULL,
  `fecha_inicio` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_fin` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `hora_inicio` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `hora_fin` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cliente` int(11) DEFAULT NULL,
  `administrador` int(11) DEFAULT NULL,
  `tipo_de_usuario` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sesiones`
--

INSERT INTO `sesiones` (`id_sesion`, `fecha_inicio`, `fecha_fin`, `hora_inicio`, `hora_fin`, `cliente`, `administrador`, `tipo_de_usuario`) VALUES
(1, '18/ 10/ 2020', NULL, '8:35:27 pm', NULL, 8, NULL, '2'),
(2, '18/ 10/ 2020', NULL, '20:46:35 pm', NULL, 8, NULL, '2'),
(3, '18/ 10/ 2020', NULL, '20:47:59 pm', NULL, 8, NULL, '2'),
(4, '18/ 10/ 2020', '20/05/08', '20:49:15 pm', '1410', 8, NULL, '2'),
(5, '18/ 10/ 2020', '18/ 10/ 2020', '20:52:46 pm', NULL, 8, NULL, '2'),
(6, '18/ 10/ 2020', NULL, '20:55:31 pm', NULL, 8, NULL, '2'),
(7, '18/ 10/ 2020', NULL, '22:26:00 pm', NULL, 9, NULL, '2'),
(8, '24/ 10/ 2020', NULL, '05:20:09 am', NULL, 9, NULL, '2'),
(9, '24/ 10/ 2020', NULL, '07:42:14 am', NULL, 9, NULL, '2'),
(10, '24/ 10/ 2020', NULL, '09:06:12 am', NULL, 9, NULL, '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `fecha_venta` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `total` double(20,2) NOT NULL,
  `metodo_pag` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `cliente`, `fecha_venta`, `total`, `metodo_pag`) VALUES
(43, 8, '2020-10-16', 45604.00, 'Tarjeta'),
(44, 8, '2020-10-18', 7600.00, 'Tarjeta'),
(45, 9, '2020-10-18', 10400.00, 'Tarjeta'),
(46, 9, '2020-10-23', 62710.00, 'Tarjeta');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_administrador`),
  ADD UNIQUE KEY `nick_usuario_UNIQUE` (`nick_usuario`),
  ADD KEY `fk_ADMINISTRADOR_PERSONAS1_idx` (`persona`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `nick_usuario_UNIQUE` (`nick_usuario`),
  ADD KEY `fk_CLIENTES_PERSONAS1_idx` (`persona`);

--
-- Indices de la tabla `det_ventas`
--
ALTER TABLE `det_ventas`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `fk_PRODUCTOS_has_VENTAS_VENTAS1_idx` (`venta`),
  ADD KEY `fk_PRODUCTOS_has_VENTAS_PRODUCTOS1_idx` (`producto`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id_persona`),
  ADD UNIQUE KEY `nro_identificacion_UNIQUE` (`nro_identificacion`),
  ADD UNIQUE KEY `correo_UNIQUE` (`correo`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria_idx` (`categoria`);

--
-- Indices de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD PRIMARY KEY (`id_sesion`),
  ADD KEY `fk_SESIONES_CLIENTES1_idx` (`cliente`),
  ADD KEY `fk_SESIONES_ADMINISTRADOR1_idx` (`administrador`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `fk_FACTURA_CLIENTES1_idx` (`cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id_administrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `det_ventas`
--
ALTER TABLE `det_ventas`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT de la tabla `sesiones`
--
ALTER TABLE `sesiones`
  MODIFY `id_sesion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `fk_ADMINISTRADOR_PERSONAS1` FOREIGN KEY (`persona`) REFERENCES `personas` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `fk_CLIENTES_PERSONAS1` FOREIGN KEY (`persona`) REFERENCES `personas` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `det_ventas`
--
ALTER TABLE `det_ventas`
  ADD CONSTRAINT `fk_PRODUCTOS_has_VENTAS_PRODUCTOS1` FOREIGN KEY (`producto`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `fk_PRODUCTOS_has_VENTAS_VENTAS1` FOREIGN KEY (`venta`) REFERENCES `ventas` (`id_venta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `id_categoria` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD CONSTRAINT `fk_SESIONES_ADMINISTRADOR1` FOREIGN KEY (`administrador`) REFERENCES `administrador` (`id_administrador`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_SESIONES_CLIENTES1` FOREIGN KEY (`cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_FACTURA_CLIENTES1` FOREIGN KEY (`cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

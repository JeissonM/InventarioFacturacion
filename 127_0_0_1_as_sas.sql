-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-10-2018 a las 14:39:56
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `as_sas`
--
CREATE DATABASE IF NOT EXISTS `as_sas` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `as_sas`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `as_categoria`
--
-- Creación: 10-10-2017 a las 22:07:37
--

CREATE TABLE `as_categoria` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(200) NOT NULL DEFAULT 'SIN NOMBRE',
  `descripcion` varchar(500) NOT NULL DEFAULT 'SIN DESCRIPCION'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `as_categoria`:
--

--
-- Volcado de datos para la tabla `as_categoria`
--

INSERT INTO `as_categoria` (`id`, `nombre`, `descripcion`) VALUES
(2, 'AIRES', 'MANTENIMIENTOS, REPARACIONES, INSTALACIONES Y DESMONTES'),
(3, 'CONSTRUCCION   EN LÃMINA ', 'FABRICACIONES   DE TÃšNELES, ENCERRAMIENTOS EN LÃMINAS PARA TODO TIPO DE ÃREAS'),
(4, 'CONSTRUCCIÃ“N CON EQUIPOS METÃLICOS ', 'CONSTRUCCIÃ“N DE PUENTES, Y ESTRUCTURAS PARA FUNCIONES ESPECÃFICAS '),
(5, 'MANTENIMIENTO EN PLANTA ELECTRICA', 'REVISIÃ“N DEL ESTADO DE LA PLANTA PARA SU OPTIMO FUNCIONAMIENTO'),
(6, 'MANTENIMIENTO DE LAS INSTALACIONES', 'MANTENIMIENTO GENERAL ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `as_clientes`
--
-- Creación: 10-10-2017 a las 22:07:37
--

CREATE TABLE `as_clientes` (
  `nit` varchar(100) NOT NULL,
  `nombre` varchar(200) NOT NULL DEFAULT 'NO PRESENTA',
  `descripcion` varchar(300) NOT NULL DEFAULT 'NO PRESENTA',
  `direccion` varchar(200) NOT NULL DEFAULT 'NO PRESENTA',
  `telefono` bigint(20) NOT NULL DEFAULT '0',
  `email` varchar(200) NOT NULL DEFAULT 'NO PRESENTA',
  `ciudad` varchar(150) NOT NULL DEFAULT 'NO PRESENTA'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `as_clientes`:
--

--
-- Volcado de datos para la tabla `as_clientes`
--

INSERT INTO `as_clientes` (`nit`, `nombre`, `descripcion`, `direccion`, `telefono`, `email`, `ciudad`) VALUES
('890901110-8', ' CONCONCRETO', 'CONSTRUCTORA ', 'CENTRO COMERCIAL GUATAPURI', 3217493861, 'FMALDONADO@CONCONCRETO.COM', 'VALLEDUPAR'),
('890903858-7', 'INDUSTRIA NACIONAL DE GASEOSAS S.A.', 'COCA-COLA', 'CARRERA 9 # 7-139', 3135097513, 'ROY.CARRILLO@KOF.COM.MX', 'VALLEDUPAR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `as_configuraciones`
--
-- Creación: 10-10-2017 a las 22:07:37
--

CREATE TABLE `as_configuraciones` (
  `id` bigint(20) NOT NULL,
  `resolucion` varchar(100) NOT NULL DEFAULT 'NO PRESENTA',
  `numeracion` varchar(100) NOT NULL DEFAULT 'NO PRESENTA',
  `nit` varchar(100) NOT NULL DEFAULT 'NO PRESENTA',
  `direccion` varchar(150) NOT NULL DEFAULT 'NO PRESENTA',
  `pagina` varchar(200) NOT NULL DEFAULT 'www.acuerdosysolucionessas.com',
  `telefonos` varchar(200) NOT NULL DEFAULT 'NO PRESENTA',
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `as_configuraciones`:
--

--
-- Volcado de datos para la tabla `as_configuraciones`
--

INSERT INTO `as_configuraciones` (`id`, `resolucion`, `numeracion`, `nit`, `direccion`, `pagina`, `telefonos`, `fecha`) VALUES
(2, '240000036279', 'DEL 51 AL 500', '900788348', 'CARRERA 18E # 38- 16 BARRIO  SAN MARTIN', 'www.acuerdosysolucionessas.com', '5840539 - 3167794183 -3205450330', '2015-11-04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `as_defactura`
--
-- Creación: 10-10-2017 a las 22:07:38
--

CREATE TABLE `as_defactura` (
  `id` bigint(20) NOT NULL,
  `nofactura` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `cliente` varchar(200) DEFAULT 'NO PRESENTA',
  `nit` varchar(200) DEFAULT 'NO PRESENTA',
  `direccion` varchar(100) DEFAULT 'NO PRESENTA',
  `ciudad` varchar(100) DEFAULT 'NO PRESENTA',
  `telefono` bigint(20) DEFAULT NULL,
  `subtotal` double NOT NULL DEFAULT '0',
  `impuesto` double NOT NULL DEFAULT '0',
  `total` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `as_defactura`:
--

--
-- Volcado de datos para la tabla `as_defactura`
--

INSERT INTO `as_defactura` (`id`, `nofactura`, `fecha`, `cliente`, `nit`, `direccion`, `ciudad`, `telefono`, `subtotal`, `impuesto`, `total`) VALUES
(1, '082984', '2015-12-30', 'AGROGAMA', '824002180', 'VALLEDUPAR', 'VALLEDUPAR', 3003168722, 119483, 19117.28, 138600.28);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `as_detalle_factura`
--
-- Creación: 10-10-2017 a las 22:07:38
--

CREATE TABLE `as_detalle_factura` (
  `id` bigint(20) NOT NULL,
  `idfactura` varchar(100) NOT NULL DEFAULT '0',
  `nombre_des` varchar(400) NOT NULL DEFAULT 'NO PRESENTA',
  `cant` bigint(20) NOT NULL DEFAULT '0',
  `valoru` double NOT NULL DEFAULT '0',
  `valtotal` double NOT NULL DEFAULT '0',
  `valorimp` double NOT NULL DEFAULT '0',
  `porimp` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `as_detalle_factura`:
--

--
-- Volcado de datos para la tabla `as_detalle_factura`
--

INSERT INTO `as_detalle_factura` (`id`, `idfactura`, `nombre_des`, `cant`, `valoru`, `valtotal`, `valorimp`, `porimp`) VALUES
(1, '0001', 'RECARGA DE REFRIGERANTE: RECARGA DE GAS REFRIGERANTE ', 2, 60000, 129600, 9600, 8),
(2, '0002', 'CONSTRUCCION DE TUNEL : CONSTRUCCION DE CERRAMIENTO EN LÃMINAS Y TUBOS METALICOS ', 130, 11500, 1739536, 239936, 16),
(3, '0003', 'MANTENIMIENTO GENERAL: DESMONTE DEL DE LA VENTILA LIMPIEZA Y LAVADO DE CONDUCTOS, CONSOLA ', 3, 70000, 243600, 33600, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `as_detalle_factura_de`
--
-- Creación: 10-10-2017 a las 22:07:39
--

CREATE TABLE `as_detalle_factura_de` (
  `id` bigint(20) NOT NULL,
  `idfactura` varchar(100) NOT NULL DEFAULT '0',
  `nombre_des` varchar(400) NOT NULL DEFAULT 'NO PRESENTA',
  `cant` bigint(20) NOT NULL DEFAULT '0',
  `valoru` double NOT NULL DEFAULT '0',
  `valtotal` double NOT NULL DEFAULT '0',
  `valorimp` double NOT NULL DEFAULT '0',
  `porimp` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `as_detalle_factura_de`:
--

--
-- Volcado de datos para la tabla `as_detalle_factura_de`
--

INSERT INTO `as_detalle_factura_de` (`id`, `idfactura`, `nombre_des`, `cant`, `valoru`, `valtotal`, `valorimp`, `porimp`) VALUES
(1, '082984', 'ACTIVO', 1, 119483, 138600.28, 19117.28, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `as_factura`
--
-- Creación: 10-10-2017 a las 22:07:39
--

CREATE TABLE `as_factura` (
  `id` bigint(20) NOT NULL,
  `nofactura` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `cliente` varchar(200) DEFAULT 'NO PRESENTA',
  `nit` varchar(200) DEFAULT 'NO PRESENTA',
  `direccion` varchar(100) DEFAULT 'NO PRESENTA',
  `ciudad` varchar(100) DEFAULT 'NO PRESENTA',
  `telefono` bigint(20) DEFAULT NULL,
  `subtotal` double NOT NULL DEFAULT '0',
  `impuesto` double NOT NULL DEFAULT '0',
  `total` double NOT NULL DEFAULT '0',
  `encab` bigint(20) NOT NULL DEFAULT '0',
  `estado` varchar(20) NOT NULL DEFAULT 'PENDIENTE',
  `saldo` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `as_factura`:
--

--
-- Volcado de datos para la tabla `as_factura`
--

INSERT INTO `as_factura` (`id`, `nofactura`, `fecha`, `cliente`, `nit`, `direccion`, `ciudad`, `telefono`, `subtotal`, `impuesto`, `total`, `encab`, `estado`, `saldo`) VALUES
(1, '0001', '2016-01-05', 'INDUSTRIA NACIONAL DE GASEOSAS S.A.', '890903858-7', 'CARRERA 9 # 7-139', 'VALLEDUPAR-CESAR', 0, 120000, 9600, 129600, 2, 'PAGADO', 0),
(2, '0002', '2016-01-05', ' CONCONCRETO', '890901110-8', 'CENTRO COMERCIAL GUATAPURI', 'VALLEDUPAR', 3217493861, 1499600, 239936, 1739536, 2, 'PENDIENTE', 1739536),
(3, '0003', '2016-01-31', 'INDUSTRIA NACIONAL DE GASEOSAS S.A.', '890903858-7', 'CARRERA 9 # 7-139', 'VALLEDUPAR', 3135097513, 210000, 33600, 243600, 2, 'PENDIENTE', 243600);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `as_mensajes`
--
-- Creación: 10-10-2017 a las 22:07:39
--

CREATE TABLE `as_mensajes` (
  `id` bigint(20) NOT NULL,
  `de` bigint(20) NOT NULL DEFAULT '0',
  `para` bigint(20) NOT NULL DEFAULT '0',
  `asunto` varchar(100) NOT NULL,
  `mensaje` varchar(500) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` varchar(10) NOT NULL DEFAULT 'NO',
  `borrador` varchar(10) DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `as_mensajes`:
--

--
-- Volcado de datos para la tabla `as_mensajes`
--

INSERT INTO `as_mensajes` (`id`, `de`, `para`, `asunto`, `mensaje`, `fecha`, `estado`, `borrador`) VALUES
(1, 80880981, 2015, 'reporte', '<p>buenos dias</p>', '2016-01-03 21:14:19', 'SI', 'NO'),
(2, 1065595007, 80880981, 'feo', '<p>FEO .........</p>', '2016-01-03 22:47:05', 'NO', 'NO'),
(3, 80880981, 1065595007, 'Maluca', '<p>Fea eres tu</p><p><br></p>', '2016-01-03 22:50:30', 'NO', 'NO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `as_privilegios`
--
-- Creación: 10-10-2017 a las 22:07:40
--

CREATE TABLE `as_privilegios` (
  `idUsuario` bigint(20) NOT NULL,
  `perfil` varchar(10) NOT NULL DEFAULT 'SI',
  `mensajes` varchar(10) NOT NULL DEFAULT 'SI',
  `datos` varchar(10) NOT NULL DEFAULT 'NO',
  `factura` varchar(10) NOT NULL DEFAULT 'NO',
  `facturai` varchar(10) NOT NULL DEFAULT 'NO',
  `reportes` varchar(10) NOT NULL DEFAULT 'NO',
  `usuarios` varchar(10) NOT NULL DEFAULT 'NO',
  `config` varchar(10) NOT NULL DEFAULT 'NO',
  `clientes` varchar(10) NOT NULL DEFAULT 'NO',
  `proveedores` varchar(10) NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `as_privilegios`:
--

--
-- Volcado de datos para la tabla `as_privilegios`
--

INSERT INTO `as_privilegios` (`idUsuario`, `perfil`, `mensajes`, `datos`, `factura`, `facturai`, `reportes`, `usuarios`, `config`, `clientes`, `proveedores`) VALUES
(2015, 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI'),
(80880981, 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI'),
(1065595007, 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `as_proveedores`
--
-- Creación: 10-10-2017 a las 22:07:41
--

CREATE TABLE `as_proveedores` (
  `nit` varchar(100) NOT NULL,
  `nombre` varchar(200) NOT NULL DEFAULT 'NO PRESENTA',
  `descripcion` varchar(300) NOT NULL DEFAULT 'NO PRESENTA',
  `direccion` varchar(200) NOT NULL DEFAULT 'NO PRESENTA',
  `telefono` bigint(20) NOT NULL DEFAULT '0',
  `email` varchar(200) NOT NULL DEFAULT 'NO PRESENTA',
  `ciudad` varchar(150) NOT NULL DEFAULT 'NO PRESENTA'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `as_proveedores`:
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `as_servicios`
--
-- Creación: 10-10-2017 a las 22:07:41
--

CREATE TABLE `as_servicios` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(200) NOT NULL DEFAULT 'SIN NOMBRE',
  `descripcion` varchar(500) NOT NULL DEFAULT 'SIN DESCRIPCION',
  `precio` double NOT NULL DEFAULT '0',
  `impuesto` double NOT NULL DEFAULT '0',
  `idcategoria` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `as_servicios`:
--   `idcategoria`
--       `as_categoria` -> `id`
--

--
-- Volcado de datos para la tabla `as_servicios`
--

INSERT INTO `as_servicios` (`id`, `nombre`, `descripcion`, `precio`, `impuesto`, `idcategoria`) VALUES
(1, 'RECARGA DE REFRIGERANTE', 'RECARGA DE GAS REFRIGERANTE ', 80000, 16, 2),
(2, 'CONSTRUCCION DE TUNEL ', 'CONSTRUCCION DE CERRAMIENTO EN LÃMINAS Y TUBOS METALICOS ', 11500, 16, 3),
(3, 'MANTENIMIENTO EN PLANTA ELECTRICA', 'REVISIÃ“N DE PLANTA ELÃ‰CTRICA PARA SU OPTIMO FUNCIONAMIENTO', 700000, 16, 5),
(4, 'CAMBIO DE CAPACITOR', 'REEMPLAZO DE CAPACITOR EN AIRES ', 40000, 16, 2),
(5, 'MANTENIMIENTO  EN LA CONSOLA', 'SE LAVARA Y SE LIMPIAN LOS FILTROS DE AIRE EN LA CONSOLA', 50000, 16, 2),
(6, 'MANTENIMIENTO GENERAL', 'DESMONTE DEL DE LA VENTILA LIMPIEZA Y LAVADO DE CONDUCTOS, CONSOLA ', 70000, 16, 2),
(7, 'MANTENIMIENTO EN INSTALACION', 'ASEO Y LIMPIEZA DE LA BODEGA DE  ALMACENAMIENTO', 400000, 16, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `as_usuarios`
--
-- Creación: 10-10-2017 a las 22:07:41
--

CREATE TABLE `as_usuarios` (
  `identificacion` bigint(20) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) DEFAULT 'NO REGISTRA',
  `direccion` varchar(100) DEFAULT 'NO REGISTRA',
  `telefono` bigint(20) DEFAULT '0',
  `email` varchar(150) DEFAULT 'NO REGISTRA',
  `rol` varchar(100) NOT NULL DEFAULT 'NO PRESENTA',
  `contrasenia` varchar(300) NOT NULL,
  `path` varchar(300) DEFAULT 'img/avatar5.png',
  `estudios` varchar(300) NOT NULL DEFAULT 'NO PRESENTA',
  `notas` varchar(300) NOT NULL DEFAULT 'NO PRESENTA',
  `perfilp` varchar(500) NOT NULL DEFAULT 'NO PRESENTA'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELACIONES PARA LA TABLA `as_usuarios`:
--

--
-- Volcado de datos para la tabla `as_usuarios`
--

INSERT INTO `as_usuarios` (`identificacion`, `nombres`, `apellidos`, `direccion`, `telefono`, `email`, `rol`, `contrasenia`, `path`, `estudios`, `notas`, `perfilp`) VALUES
(2015, 'SUPER', 'ADMINISTRADOR', 'VALLEDUPAR', 0, 'INFO@ACUERDOSYSOLUCIONESSAS.COM', 'GERENTE GENERAL', '65d2ea03425887a717c435081cfc5dbb', 'img/avatar5.png', 'NO PRESENTA', 'NO PRESENTA', 'NO PRESENTA'),
(80880981, 'OSCAR ARMANDO', 'PALOMINO CUADRO', 'CARRERA 18E # 38 -16', 3167794183, 'OSCARPALOMINO785@GMAIL.COM', 'GERENTE', '5e543256c480ac577d30f76f9120eb74', 'img/IMG_20150428_063823.jpg', 'NO PRESENTA', 'NO PRESENTA', 'NO PRESENTA'),
(1065595007, 'MARCELA LEONOR ', 'PALOMINO CUADRO', 'CRA 18 E NÂ°38-16 SAN MARTIN', 3205450330, 'MPALOMINOUESACESAR@GMAIL.COM', 'GESTION HUMANA', 'a2eda25e9bd2d4a4a1a182cb4d59c16a', 'img/391884_2676666555449_962513623_n.jpg', 'NO PRESENTA', 'NO PRESENTA', 'NO PRESENTA');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `as_categoria`
--
ALTER TABLE `as_categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `as_clientes`
--
ALTER TABLE `as_clientes`
  ADD PRIMARY KEY (`nit`);

--
-- Indices de la tabla `as_configuraciones`
--
ALTER TABLE `as_configuraciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `as_defactura`
--
ALTER TABLE `as_defactura`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `as_detalle_factura`
--
ALTER TABLE `as_detalle_factura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkidfac` (`idfactura`);

--
-- Indices de la tabla `as_detalle_factura_de`
--
ALTER TABLE `as_detalle_factura_de`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkidfac` (`idfactura`);

--
-- Indices de la tabla `as_factura`
--
ALTER TABLE `as_factura`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `as_mensajes`
--
ALTER TABLE `as_mensajes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `as_privilegios`
--
ALTER TABLE `as_privilegios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indices de la tabla `as_proveedores`
--
ALTER TABLE `as_proveedores`
  ADD PRIMARY KEY (`nit`);

--
-- Indices de la tabla `as_servicios`
--
ALTER TABLE `as_servicios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idcategoria` (`idcategoria`);

--
-- Indices de la tabla `as_usuarios`
--
ALTER TABLE `as_usuarios`
  ADD PRIMARY KEY (`identificacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `as_categoria`
--
ALTER TABLE `as_categoria`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `as_configuraciones`
--
ALTER TABLE `as_configuraciones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `as_defactura`
--
ALTER TABLE `as_defactura`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `as_detalle_factura`
--
ALTER TABLE `as_detalle_factura`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `as_detalle_factura_de`
--
ALTER TABLE `as_detalle_factura_de`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `as_factura`
--
ALTER TABLE `as_factura`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `as_mensajes`
--
ALTER TABLE `as_mensajes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `as_servicios`
--
ALTER TABLE `as_servicios`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `as_servicios`
--
ALTER TABLE `as_servicios`
  ADD CONSTRAINT `idcat` FOREIGN KEY (`idcategoria`) REFERENCES `as_categoria` (`id`) ON UPDATE CASCADE;


--
-- Metadatos
--
USE `phpmyadmin`;

--
-- Metadatos para la tabla as_categoria
--

--
-- Metadatos para la tabla as_clientes
--

--
-- Metadatos para la tabla as_configuraciones
--

--
-- Metadatos para la tabla as_defactura
--

--
-- Metadatos para la tabla as_detalle_factura
--

--
-- Metadatos para la tabla as_detalle_factura_de
--

--
-- Metadatos para la tabla as_factura
--

--
-- Metadatos para la tabla as_mensajes
--

--
-- Metadatos para la tabla as_privilegios
--

--
-- Metadatos para la tabla as_proveedores
--

--
-- Metadatos para la tabla as_servicios
--

--
-- Metadatos para la tabla as_usuarios
--

--
-- Metadatos para la base de datos as_sas
--

-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-04-2020 a las 18:43:41
-- Versión del servidor: 10.4.10-MariaDB
-- Versión de PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rostros_felices`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_cargo`
--

CREATE TABLE `tb_cargo` (
  `Cargo_Codi` bigint(20) UNSIGNED NOT NULL,
  `Tipo_Cargo` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_cargo`
--

INSERT INTO `tb_cargo` (`Cargo_Codi`, `Tipo_Cargo`) VALUES
(1, 'Manicurista'),
(2, 'Peluquero/a'),
(3, 'Maquilladora '),
(4, 'Pedicurista'),
(5, 'Masajista '),
(6, 'esteticista ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_cliente`
--

CREATE TABLE `tb_cliente` (
  `Cliente_Codi` bigint(10) UNSIGNED NOT NULL,
  `Cliente_Nom` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Cliente_Apell` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Docu_Codi` int(10) UNSIGNED NOT NULL,
  `Documento` int(50) UNSIGNED NOT NULL,
  `Cliente_Email` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Cliente_Cel` int(30) UNSIGNED NOT NULL,
  `Cliente_Direc` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_cliente`
--

INSERT INTO `tb_cliente` (`Cliente_Codi`, `Cliente_Nom`, `Cliente_Apell`, `Docu_Codi`, `Documento`, `Cliente_Email`, `Cliente_Cel`, `Cliente_Direc`) VALUES
(120, 'sebastian', 'gutierrez', 2, 38430403, 'sebas82@hotmail.com', 39498549, 'calle 14B #10-103'),
(121, 'juan', 'restrepo', 3, 2729489480, 'xcamilo20@gmail.com', 34935939, 'calle 23 #7-34, '),
(122, 'jorge', 'acero', 3, 1338728382, 'jorgeacero91@gmail.com', 94893439, 'calle 14B #23-101'),
(123, 'erick', 'cuellar', 4, 127287323, 'erick237@gmail.com', 84040549, 'calle 23A #24-13'),
(124, 'luis', 'aux', 1, 29302402, 'carlosaux20@gmail.com', 340390439, 'calle 23C #24-101'),
(125, 'maria', 'rojas', 5, 719300290, 'valeria66@hotmail.com', 3053801210, 'calle 14B #20-108'),
(126, 'juan', 'restrepo', 7, 792829891, 'juanmanuel21@hotmail.com', 3053201719, 'calle 21A#20-101'),
(127, 'carlos', 'acero', 6, 719901219, 'carlosmario61@gmail.com', 3396219, 'calle 66 #10-102'),
(128, 'laura', 'tovar', 3, 829839293, 'lau27@gmail.com', 3048348949, 'calle 14B #10-78'),
(129, 'juan', 'padilla', 4, 2983928392, 'juanpadilla23@hotmail.com', 305832983, 'calle14C #28-106'),
(130, 'juan', 'rodriguez', 2, 515166161, 'JuanFelipe.Rodriguez1@hotmail.com', 30566218, 'calle 7A#20-118'),
(131, 'angela ', 'orozco', 1, 1513232112, 'Maria.Orozco1@hotmail.com', 350841626, 'calle 23D #20_105');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_empleados`
--

CREATE TABLE `tb_empleados` (
  `Emple_Codi` bigint(10) UNSIGNED NOT NULL,
  `Emple_Nomb` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL COMMENT 'Nombre del empleado',
  `Emple_Apell` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL COMMENT 'apellido del empleado',
  `Documento` int(50) NOT NULL,
  `Cargo_Codi` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_empleados`
--

INSERT INTO `tb_empleados` (`Emple_Codi`, `Emple_Nomb`, `Emple_Apell`, `Documento`, `Cargo_Codi`) VALUES
(10, 'juan', 'montes', 29043343, 1),
(11, 'maria', 'molina', 121921924, 2),
(12, 'angie', 'idrobo', 928912010, 3),
(13, 'edward', 'sierra', 530180312, 4),
(14, 'jhoan', 'quintero', 121829834, 5),
(26, 'prueba', 'pruebita', 1111111, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_productos`
--

CREATE TABLE `tb_productos` (
  `Produc_Codi` bigint(10) UNSIGNED NOT NULL,
  `Produc_Nomb` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Produc_Valor` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_productos`
--

INSERT INTO `tb_productos` (`Produc_Codi`, `Produc_Nomb`, `Produc_Valor`) VALUES
(1, 'Crema Alisadora', 70000),
(2, 'estractor de punto negros', 50000),
(3, 'cera para peinar', 30000),
(4, 'shampoo con keratina ', 40000),
(5, 'Mascarilla rejuvenecedora ', 20000),
(6, 'Delineador de cejas', 15000),
(7, 'cera para depilar', 40000),
(8, 'acondicionador', 17500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_tipo_documento`
--

CREATE TABLE `tb_tipo_documento` (
  `Docu_Codi` bigint(20) UNSIGNED NOT NULL,
  `Docu_Nomb` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_tipo_documento`
--

INSERT INTO `tb_tipo_documento` (`Docu_Codi`, `Docu_Nomb`) VALUES
(1, 'Tarjeta de identidad'),
(2, 'Pasaporte'),
(3, 'Cédula'),
(4, 'N.U.I.P.'),
(5, 'R.U.T.'),
(6, 'N.I.T.'),
(7, 'Registro Civil');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_tratamientos`
--

CREATE TABLE `tb_tratamientos` (
  `Trata_Codi` bigint(20) UNSIGNED NOT NULL,
  `Trara_Nomb` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Trata_Valor` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_tratamientos`
--

INSERT INTO `tb_tratamientos` (`Trata_Codi`, `Trara_Nomb`, `Trata_Valor`) VALUES
(1, 'Rejuvenecimiento Facial con Laser Fraccionado', 2000000),
(2, 'Maquillaje permanente', 100000),
(3, 'Limpieza Facial', 50000),
(4, 'Corte de cabello', 20000),
(5, 'Exfoliación con punta de diamante', 500000),
(6, 'Presoterapia', 200000),
(7, 'Hidrolipoclasia + cavitació', 300000);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_cargo`
--
ALTER TABLE `tb_cargo`
  ADD PRIMARY KEY (`Cargo_Codi`);

--
-- Indices de la tabla `tb_cliente`
--
ALTER TABLE `tb_cliente`
  ADD PRIMARY KEY (`Cliente_Codi`);

--
-- Indices de la tabla `tb_empleados`
--
ALTER TABLE `tb_empleados`
  ADD PRIMARY KEY (`Emple_Codi`);

--
-- Indices de la tabla `tb_productos`
--
ALTER TABLE `tb_productos`
  ADD PRIMARY KEY (`Produc_Codi`);

--
-- Indices de la tabla `tb_tipo_documento`
--
ALTER TABLE `tb_tipo_documento`
  ADD PRIMARY KEY (`Docu_Codi`);

--
-- Indices de la tabla `tb_tratamientos`
--
ALTER TABLE `tb_tratamientos`
  ADD PRIMARY KEY (`Trata_Codi`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_cargo`
--
ALTER TABLE `tb_cargo`
  MODIFY `Cargo_Codi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tb_cliente`
--
ALTER TABLE `tb_cliente`
  MODIFY `Cliente_Codi` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT de la tabla `tb_empleados`
--
ALTER TABLE `tb_empleados`
  MODIFY `Emple_Codi` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `tb_productos`
--
ALTER TABLE `tb_productos`
  MODIFY `Produc_Codi` bigint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tb_tipo_documento`
--
ALTER TABLE `tb_tipo_documento`
  MODIFY `Docu_Codi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tb_tratamientos`
--
ALTER TABLE `tb_tratamientos`
  MODIFY `Trata_Codi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-11-2025 a las 22:02:09
-- Versión del servidor: 10.4.22-MariaDB-log
-- Versión de PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bonanza_cotizaciones`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo`
--

CREATE TABLE `catalogo` (
  `id_Catalogo` int(11) NOT NULL,
  `id_Material` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `catalogo`
--

INSERT INTO `catalogo` (`id_Catalogo`, `id_Material`, `precio`) VALUES
(1, 1, '35.50'),
(2, 2, '250.00'),
(3, 3, '120.00'),
(4, 4, '5.75'),
(5, 5, '12.30'),
(6, 6, '1.50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion`
--

CREATE TABLE `cotizacion` (
  `id_cotizacion` int(100) NOT NULL,
  `id_Cliente` int(100) NOT NULL,
  `Fecha` date NOT NULL DEFAULT current_timestamp(),
  `Subtotal` decimal(10,2) NOT NULL,
  `Descuento` decimal(10,2) NOT NULL,
  `Mano_obra` decimal(10,2) NOT NULL,
  `Impuestos` decimal(10,2) NOT NULL,
  `Total` decimal(10,2) NOT NULL,
  `Notas` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cotizacion`
--

INSERT INTO `cotizacion` (`id_cotizacion`, `id_Cliente`, `Fecha`, `Subtotal`, `Descuento`, `Mano_obra`, `Impuestos`, `Total`, `Notas`) VALUES
(7, 3, '0000-00-00', '21902.00', '2190.20', '800.00', '4102.36', '24614.16', 'Perfecto'),
(17, 28, '0000-00-00', '5000.00', '0.00', '0.00', '800.00', '5800.00', ''),
(20, 6, '0000-00-00', '1116.00', '0.00', '1000.00', '338.56', '2454.56', ''),
(21, 15, '0000-00-00', '400.00', '0.00', '10000.00', '1664.00', '12064.00', ''),
(22, 28, '0000-00-00', '200.00', '0.00', '100.00', '48.00', '348.00', ''),
(23, 28, '0000-00-00', '250.00', '0.00', '150.00', '64.00', '464.00', ''),
(24, 7, '0000-00-00', '200.00', '0.00', '120.00', '51.20', '371.20', ''),
(26, 28, '2025-11-26', '250.00', '0.00', '150.00', '64.00', '464.00', ''),
(27, 6, '2025-11-26', '400.00', '0.00', '200.00', '96.00', '696.00', ''),
(30, 28, '2025-11-26', '3000.00', '0.00', '450.00', '552.00', '4002.00', ''),
(31, 3, '2025-11-26', '2000.00', '0.00', '500.00', '400.00', '2900.00', 'TUo asdasasd'),
(32, 4, '2025-11-26', '7200.00', '0.00', '123.00', '1171.68', '8494.68', 'dsplfpkvopijijdfjopsakjoksk´fksódks'),
(33, 2, '2025-11-26', '5600.00', '0.00', '150.00', '920.00', '6670.00', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion_detalle`
--

CREATE TABLE `cotizacion_detalle` (
  `id_detalle` int(11) NOT NULL,
  `id_cotizacion` int(11) NOT NULL,
  `id_material` int(11) NOT NULL,
  `ancho_cm` decimal(10,2) NOT NULL,
  `alto_cm` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cotizacion_detalle`
--

INSERT INTO `cotizacion_detalle` (`id_detalle`, `id_cotizacion`, `id_material`, `ancho_cm`, `alto_cm`, `cantidad`, `precio_unitario`, `subtotal`) VALUES
(7, 7, 17, '45.00', '12.00', 47, '466.00', '21902.00'),
(16, 17, 19, '0.00', '0.00', 20, '250.00', '5000.00'),
(19, 20, 25, '100.00', '150.00', 2, '200.00', '400.00'),
(20, 20, 19, '120.00', '200.00', 1, '250.00', '250.00'),
(21, 20, 17, '200.00', '140.00', 1, '466.00', '466.00'),
(22, 21, 16, '100.00', '150.00', 2, '200.00', '400.00'),
(23, 22, 25, '100.00', '200.00', 1, '200.00', '200.00'),
(24, 23, 19, '100.00', '150.00', 1, '250.00', '250.00'),
(25, 24, 25, '100.00', '105.00', 1, '200.00', '200.00'),
(27, 26, 19, '100.00', '150.00', 1, '250.00', '250.00'),
(28, 27, 25, '100.00', '150.00', 2, '200.00', '400.00'),
(29, 30, 25, '12.00', '213.00', 15, '200.00', '3000.00'),
(30, 31, 16, '12.00', '12.00', 10, '200.00', '2000.00'),
(31, 32, 25, '12.00', '2.00', 21, '200.00', '4200.00'),
(32, 32, 19, '12.00', '12.00', 12, '250.00', '3000.00'),
(33, 33, 25, '5.00', '8.00', 3, '200.00', '600.00'),
(34, 33, 19, '45.00', '20.00', 20, '250.00', '5000.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id_Inventario` int(11) NOT NULL,
  `id_Material` int(11) DEFAULT NULL,
  `Total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id_Inventario`, `id_Material`, `Total`) VALUES
(1, 1, 50),
(2, 2, 200),
(3, 3, 150),
(4, 4, 500),
(5, 5, 300),
(6, 6, 1000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_cliente`
--

CREATE TABLE `registro_cliente` (
  `id_Cliente` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Apellido` varchar(45) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Correo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `registro_cliente`
--

INSERT INTO `registro_cliente` (`id_Cliente`, `Nombre`, `Apellido`, `Telefono`, `Correo`) VALUES
(1, 'Luis', 'Fernándeza', '777891223', 'Luiza123@gmail.com'),
(2, 'Sofía', 'Martínez', '7772345678', 'sofiama@mail.com'),
(3, 'David', 'Santos', '7773456789', 'davids@mail.com'),
(4, 'Lucía', 'Ramírez', '7774567890', 'luciar@mail.com'),
(5, 'gabriel', 'García', '7775678906', 'gaby@mail.com'),
(6, 'Marta', 'Vargas', '7776789012', 'martav@mail.com'),
(7, 'Omar', 'Valencia', '7776175210', 'vamoo@1232'),
(15, 'Fatima', 'Lara', '7776175210', 'glfo@gmail.com'),
(28, 'Fatima', 'Guzman', '7776175210', 'glfo@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_material`
--

CREATE TABLE `registro_material` (
  `id_material` int(150) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Categoria` varchar(50) NOT NULL,
  `UnidadMedida` varchar(50) NOT NULL,
  `Costo` float NOT NULL,
  `Cantidad` int(100) NOT NULL,
  `Descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `registro_material`
--

INSERT INTO `registro_material` (`id_material`, `Nombre`, `Categoria`, `UnidadMedida`, `Costo`, `Cantidad`, `Descripcion`) VALUES
(15, 'Silicon ', 'Silicona', 'Unidad', 20, 40, 'Silicon Blanco'),
(16, 'Tubo PVC', 'Perfil de aluminio', 'm²', 200, 1, 'Tubo PVC 13\" color blanco'),
(17, 'Vidrio templado..', 'Seleccionar categoría', 'Seleccionar unidad', 466, 75, '                    Vidrio de seguridad templado incoloro de 6mm de espesor. Ideal para puertas, ven'),
(19, 'Perfil Galvanizado...', 'Seleccionar categoría', 'Seleccionar unidad', 250, 8, 'Resistente a la oxidación y el desgaste por impacto. Utilizado en exteriores.\r\n                     '),
(25, 'hola', 'Seleccionar categoría', 'Seleccionar unidad', 200, 19, '  sadsada            \r\n          \r\n                            \r\n          \r\n                ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedor`
--

CREATE TABLE `vendedor` (
  `id_Usuario` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Apellido` varchar(45) DEFAULT NULL,
  `Matricula` varchar(45) DEFAULT NULL,
  `Cargo` varchar(45) DEFAULT NULL,
  `Correo` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vendedor`
--

INSERT INTO `vendedor` (`id_Usuario`, `Nombre`, `Apellido`, `Matricula`, `Cargo`, `Correo`, `pass`) VALUES
(1, 'juan', 'Pérez', 'MAT001', 'Vendedor', 'carlos.perez@bonanza.com', 'pass123'),
(2, 'Ana', 'Gómez', 'MAT002', 'Administrador', 'ana.gomez@bonanza.com', 'admin123'),
(3, 'Luis', 'Ruiz', 'MAT003', 'Técnico', 'luis.ruiz@bonanza.com', 'tec123'),
(4, 'María', 'López', 'MAT004', 'Vendedor', 'maria.lopez@bonanza.com', 'vta123'),
(5, 'Jorge', 'Ramírez', 'MAT005', 'Soporte', 'jorge.ramirez@bonanza.com', 'sup123'),
(6, 'Sofía', 'Hernández', 'MAT006', 'Vendedor', 'sofia.hernandez@bonanza.com', 'venta123'),
(7, 'Omar', 'Valencia', 'VMOO230439', 'Jefe', 'vamoo@1232', '$2y$10$acVV8SzPhUYjKhtEpLB0Bu4huI9Cn1LKYWp7LyFrOgGQn8hux1ZNq'),
(11, 'Maribel', 'Medellin', 'msdfds', 'Jefa', 'Mari@gmail.com', 'Peluchina1'),
(12, 'Joel', 'Valencia', 'JAV2213', 'Jefe', 'jovavi@uotlook.com', 'Villajoel1'),
(14, 'Omar', 'Valencia', 'JAV2213', 'vendedor', 'dasas@gmail.com', '5454894'),
(18, 'Fatima', 'Guzman', 'GLFO231183', 'vendedor', 'glfo@gmail.com', '777Bigotes'),
(20, 'Tadeo', 'Gutierrez', 'tade1231', 'vendedor', 'tede@gmial.com', '123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `catalogo`
--
ALTER TABLE `catalogo`
  ADD PRIMARY KEY (`id_Catalogo`),
  ADD KEY `id_Material` (`id_Material`);

--
-- Indices de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD PRIMARY KEY (`id_cotizacion`);

--
-- Indices de la tabla `cotizacion_detalle`
--
ALTER TABLE `cotizacion_detalle`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_cotizacion` (`id_cotizacion`),
  ADD KEY `id_material` (`id_material`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id_Inventario`),
  ADD KEY `id_Material` (`id_Material`);

--
-- Indices de la tabla `registro_cliente`
--
ALTER TABLE `registro_cliente`
  ADD PRIMARY KEY (`id_Cliente`);

--
-- Indices de la tabla `registro_material`
--
ALTER TABLE `registro_material`
  ADD PRIMARY KEY (`id_material`);

--
-- Indices de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  ADD PRIMARY KEY (`id_Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `catalogo`
--
ALTER TABLE `catalogo`
  MODIFY `id_Catalogo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  MODIFY `id_cotizacion` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `cotizacion_detalle`
--
ALTER TABLE `cotizacion_detalle`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id_Inventario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `registro_cliente`
--
ALTER TABLE `registro_cliente`
  MODIFY `id_Cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `registro_material`
--
ALTER TABLE `registro_material`
  MODIFY `id_material` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  MODIFY `id_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

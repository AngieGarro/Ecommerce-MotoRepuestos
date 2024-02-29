-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-02-2024 a las 03:49:17
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Recordar crear  la base de datos antes de importar los archivos sql
-- Base de datos: `sistemarg`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_detail`
--

CREATE TABLE `order_detail` (
  `Id_Client` int(11) NOT NULL,
  `Client_Name` varchar(50) NOT NULL,
  `Client_Phone` varchar(9) NOT NULL,
  `Client_Email` varchar(45) NOT NULL,
  `Client_Address` varchar(200) NOT NULL,
  `AmountTotal` float NOT NULL,
  `OrderDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `order_detail`
--

INSERT INTO `order_detail` (`Id_Client`, `Client_Name`, `Client_Phone`, `Client_Email`, `Client_Address`, `AmountTotal`, `OrderDate`) VALUES
(14, 'Pepito Testing', '65789823', 'pptest@gmail.com', 'Avenida 3', 50900, '2024-02-11 23:24:33'),
(24, 'Pepito Testing', '89689890', 'pptest@gmail.com', 'Grecia', 36900, '2024-02-12 10:57:16'),
(25, 'Pepito Testing', '89689890', 'pptest@gmail.com', 'Grecia', 36900, '2024-02-12 10:58:07'),
(26, 'Pepito Testing', '89689890', 'pptest@gmail.com', 'Grecia', 88800, '2024-02-12 11:04:33'),
(27, 'Pepito Testing', '89689890', 'pptest@gmail.com', 'Grecia', 88800, '2024-02-12 11:04:47'),
(32, 'Karla Robbin', '89689890', 'pptest@gmail.com', 'Grecia', 235000, '2024-02-28 20:25:45'),
(33, 'Karla Robbin', '89689890', 'pptest@gmail.com', 'Grecia', 235000, '2024-02-28 20:38:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Detail` varchar(150) NOT NULL,
  `Price` float NOT NULL,
  `Code_Product` varchar(100) NOT NULL,
  `Files` varchar(300) NOT NULL,
  `Stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id`, `Name`, `Detail`, `Price`, `Code_Product`, `Files`, `Stock`) VALUES
(40, 'Espejos NS200', 'Espejos Pulsar NS200', 7000, 'E01', '65c7ada21f3ea_EspejosPulsar-NS200.png', 7),
(41, 'Direccional LED', 'Direccional LED Larga GX', 15900, 'DLL01', '65c7ae4919ad4_DireccionalLED-LARGA-GX.png', 2),
(42, 'Casco ', 'Casco Color Fucsia - Espumado grueso', 35000, 'CA01', '65c7ae9ab905e_Casco-Rosa.png', 10),
(43, 'Tapas Laterales', 'Tapas Laterales AX4 - Color Azules', 25000, 'TL01', '65c7aecb3049d_Tapas-Laterales-X4-Azules.png', 9),
(44, 'Bolso Canguro', 'Bolso pequeño tipo canguro estilo dark', 12900, 'B01', '65c7aef067e88_Images-bolso.png', 3),
(45, 'Candado', 'Dandado para casco - Filtro negro', 7000, 'CAC01', '65c7af27beb16_Images-candado.png', 5),
(46, 'Aro Trasero', 'Aro Trasero XR150- 2.15 x 17', 35000, 'AT01', '65c7af7ac7793_AroTrasero-XR150-2.15X17.png', 9),
(47, 'Casco LZ20', 'Casco de color azul', 89000, 'CA01', '65c9daab9cf59_Casco-Rosa.png', 12),
(49, 'Casco LS2', 'Casco LS2 color negro, espumado sencillo', 40000, 'CLS', '65df69b026c5f_LS2 negro.png', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sale`
--

CREATE TABLE `sale` (
  `id_Sale` int(11) NOT NULL,
  `User_idOrder` int(11) NOT NULL,
  `Date_Time` datetime NOT NULL,
  `NameProducts` varchar(300) NOT NULL,
  `Total` float NOT NULL,
  `Client_Name` varchar(100) NOT NULL,
  `Contact` varchar(100) NOT NULL,
  `Cant` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sale`
--

INSERT INTO `sale` (`id_Sale`, `User_idOrder`, `Date_Time`, `NameProducts`, `Total`, `Client_Name`, `Contact`, `Cant`) VALUES
(5, 25, '2024-02-12 10:58:07', 'Candado,Direccional LED,Espejos NS200,Espejos NS200', 36900, 'Pepito Testing', 'Telefono: 89689890 Correo: pptest@gmail.com Direccion: Grecia', ''),
(6, 25, '2024-02-12 10:58:07', 'Candado,Direccional LED,Espejos NS200,Espejos NS200', 36900, 'Pepito Testing', 'Telefono: 89689890 Correo: pptest@gmail.com Direccion: Grecia', ''),
(7, 27, '2024-02-12 11:04:47', 'Bolso Canguro,Tapas Laterales,Casco ,Direccional LED', 88800, 'Pepito Testing', 'Telefono: 89689890 Correo: pptest@gmail.com Direccion: Grecia', ''),
(8, 28, '2024-02-12 12:32:48', 'Bolso Canguro,Tapas Laterales,Casco ,Direccional LED', 88800, 'Pablo Testing V2', 'Telefono: 89689890 Correo: pabptest@gmail.com Direccion: Avenida 500 kilos', ''),
(13, 31, '2024-02-12 13:38:01', 'Direccional LED,Casco ,Espejos NS200', 57900, 'Pepito Testing', 'Telefono: 89689890 Correo: pptest@gmail.com Direccion: Grecia', ''),
(14, 32, '2024-02-28 20:25:45', 'Tapas Laterales,Casco ', 235000, 'Karla Robbin', 'Telefono: 89689890 Correo: pptest@gmail.com Direccion: Grecia', '1;6'),
(15, 32, '2024-02-28 20:25:45', 'Tapas Laterales,Casco ', 235000, 'Karla Robbin', 'Telefono: 89689890 Correo: pptest@gmail.com Direccion: Grecia', '1;6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id_User` int(11) NOT NULL,
  `Last_Name` varchar(100) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Password` char(12) NOT NULL,
  `UserType_id` int(11) NOT NULL,
  `Phone` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id_User`, `Last_Name`, `Email`, `Password`, `UserType_id`, `Phone`) VALUES
(1, 'Carlos Vargas Testing', 'rgmrepuestos@gmail.com', '8acf8506212c', 1, '64788712'),
(30, 'Pepito Testing', 'pptest@gmail.com', '12345678RG', 2, '63875634'),
(32, 'Paola García', 'paogarcia09@gmail.com', 'e207448a8eb5', 2, '87653421'),
(33, 'Luciana Castro', 'lucast@gmail.com', 'lucaspelucas', 2, '63875634');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usertype`
--

CREATE TABLE `usertype` (
  `id_UserType` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usertype`
--

INSERT INTO `usertype` (`id_UserType`, `Name`) VALUES
(1, 'Administrador'),
(2, 'Cliente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`Id_Client`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id_Sale`),
  ADD KEY `User_idUser` (`User_idOrder`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_User`),
  ADD UNIQUE KEY `kEmail` (`Email`),
  ADD KEY `id_UserType` (`UserType_id`),
  ADD KEY `UserType_id` (`UserType_id`);

--
-- Indices de la tabla `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`id_UserType`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `Id_Client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `sale`
--
ALTER TABLE `sale`
  MODIFY `id_Sale` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `usertype`
--
ALTER TABLE `usertype`
  MODIFY `id_UserType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`UserType_id`) REFERENCES `usertype` (`id_UserType`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`UserType_id`) REFERENCES `usertype` (`id_UserType`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-05-2024 a las 06:13:13
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
-- Base de datos: `raccoonxpress`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_authLogin` (IN `p_username` VARCHAR(32), IN `p_user_password` VARCHAR(32))   BEGIN
DECLARE found_user BOOLEAN DEFAULT FALSE;
	SELECT EXISTS
    (
		SELECT username FROM raccoonxpress.users
		WHERE username COLLATE utf8mb4_bin = p_username
		AND user_password COLLATE utf8mb4_bin = p_user_password
	) INTO found_user;
    SELECT found_user;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_register` (IN `username` VARCHAR(32), IN `user_password` VARCHAR(32), IN `email` VARCHAR(64), IN `fullname` VARCHAR(255), IN `birthdate` DATE, IN `gender` TINYINT(1), IN `is_active` TINYINT(1), IN `visibility` TINYINT(1), IN `user_role` TINYINT(1), IN `profile_image` BLOB)   BEGIN
	INSERT INTO raccoonxpress.`users`
    (
    `username`,
    `user_password`,
    `email`,
    `fullname`,
    `birthdate`,
    `gender`,
    `is_active`,
    `visibility`,
    `user_role`,
    `profile_image`
    ) 
    VALUES 
    (
    username,
    user_password,
    email,
    fullname,
    birthdate,
    gender,
    is_active,
    visibility,
    user_role,
    profile_image
    );
    SELECT ROW_COUNT();
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorys`
--

CREATE TABLE `categorys` (
  `category_id` int(11) NOT NULL COMMENT 'ID de la Categoría',
  `category` varchar(255) DEFAULT NULL COMMENT 'Nombre de la Categoría',
  `description` varchar(255) DEFAULT NULL COMMENT 'Descripción de la Categoría',
  `user_id` int(11) NOT NULL COMMENT 'ID del Usuario que creó la Categoría'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL COMMENT 'ID del Producto',
  `name` varchar(255) DEFAULT NULL COMMENT 'Nombre del Producto',
  `description` varchar(255) DEFAULT NULL COMMENT 'Descripción del Producto',
  `quotable` tinyint(1) DEFAULT NULL COMMENT 'Tipo de Venta (true/false)',
  `price` float DEFAULT NULL COMMENT 'Precio del Producto',
  `quantity` int(11) DEFAULT NULL COMMENT 'Cantidad Disponible del Producto',
  `approved` tinyint(1) DEFAULT NULL COMMENT 'Aprobación del Producto (true/false)',
  `image1` blob DEFAULT NULL COMMENT 'Imagen 1 relacionada con el Producto',
  `image2` blob DEFAULT NULL COMMENT 'Imagen 2 relacionada con el Producto',
  `image3` blob DEFAULT NULL COMMENT 'Imagen 3 relacionada con el Producto',
  `video` longblob DEFAULT NULL COMMENT 'Video relacionado con el Producto',
  `category_id` int(11) DEFAULT NULL COMMENT 'ID de la Categoría a la que pertenece el Producto',
  `seller_id` int(11) DEFAULT NULL COMMENT 'ID del Usuario que vende el Producto',
  `admin_approval_id` int(11) DEFAULT NULL COMMENT 'ID del Administrador que aprobó el Producto'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'Id de cada usuario',
  `username` varchar(32) NOT NULL COMMENT 'nombre para el usuario en el aplicativo',
  `user_password` varchar(32) NOT NULL COMMENT 'Contraseña del usuario',
  `email` varchar(64) NOT NULL COMMENT 'Dirección de correo electrónico',
  `fullname` varchar(255) DEFAULT NULL COMMENT 'Nombre completo del usuario',
  `birthdate` date DEFAULT NULL COMMENT 'Fecha de nacimiento del usuario',
  `entry_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Fecha y hora de creación de la cuenta',
  `gender` tinyint(1) DEFAULT NULL COMMENT 'Indicador de género',
  `is_active` tinyint(1) DEFAULT NULL COMMENT 'Indicador de cuenta activa',
  `visibility` tinyint(1) DEFAULT NULL COMMENT 'Indicador de visibilidad',
  `user_role` tinyint(1) NOT NULL COMMENT 'Rol del usuario',
  `profile_image` blob DEFAULT NULL COMMENT 'Imagen perfil'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `email`, `fullname`, `birthdate`, `entry_date`, `gender`, `is_active`, `visibility`, `user_role`, `profile_image`) VALUES
(7, 'ImNot', '-HCLAFax8', 'angel.barbosa@hotmail.com', 'Angel Barbosa', '2024-05-07', '2024-05-14 09:15:06', 0, 1, 1, 0, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorys`
--
ALTER TABLE `categorys`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `seller_id` (`seller_id`),
  ADD KEY `admin_approval_id` (`admin_approval_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorys`
--
ALTER TABLE `categorys`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID de la Categoría';

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID del Producto';

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id de cada usuario', AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categorys`
--
ALTER TABLE `categorys`
  ADD CONSTRAINT `categorys_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categorys` (`category_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`seller_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`admin_approval_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

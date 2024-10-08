-- Tablas necesarias
--  Usuarios, Productos, Listas, Categorias, Productos_Lista, Compras
--  Metodo_Pago, Sala_Chat, Mensajes, Reseñas.
--  Carrito, Productos_Carrito
DROP TABLE `product_categorys`;
DROP TABLE `products`;
DROP TABLE `categorys`;
DROP TABLE `users`;

CREATE TABLE `users` (
    `user_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Id de cada usuario',
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
    `profile_image` mediumblob DEFAULT NULL COMMENT 'Imagen perfil'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `categorys`
(
    `category_id` int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID de la Categoría',
    `name` varchar(255) COMMENT 'Nombre de la Categoría',
    `description` varchar(255) COMMENT 'Descripción de la Categoría',
    `user_id` int NOT NULL COMMENT 'ID del Usuario que creó la Categoría',
    FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `lists`
(
    `list_id` int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID de la Lista',
    `list_name` varchar(32) COMMENT 'Nombre de la Lista',
    `description` varchar(180) COMMENT 'Descripción de la Lista',
    `privacity` boolean COMMENT 'Privacidad de la Lista (true/false)',
    `image` blob COMMENT 'Imagen de la lista',
    `user_id` int COMMENT 'ID del Usuario dueño de la Lista',
    FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`)
);

CREATE TABLE `products`
(
    `product_id` Int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID del Producto',
    `name` varchar(255) COMMENT 'Nombre del Producto',
    `description` varchar(255) COMMENT 'Descripción del Producto',
    `quotable` tinyint COMMENT 'Tipo de Venta (true/false)',
    `price` float COMMENT 'Precio del Producto',
    `quantity` int COMMENT 'Cantidad Disponible del Producto',
    `approved` boolean COMMENT 'Aprobación del Producto (true/false)',
    `image1` mediumblob COMMENT 'Imagen 1 relacionada con el Producto',
    `image2` mediumblob COMMENT 'Imagen 2 relacionada con el Producto',
    `image3` mediumblob COMMENT 'Imagen 3 relacionada con el Producto',
    `video` mediumblob COMMENT 'Video relacionado con el Producto',
    `is_active` tinyint(1) DEFAULT 1 COMMENT 'Indicador de activación del Producto',
    `category_id` int COMMENT 'ID de la Categoría a la que pertenece el Producto',
    `seller_id` int COMMENT 'ID del Usuario que vende el Producto',
    `admin_approval_id` int COMMENT 'ID del Administrador que aprobó el Producto',
	FOREIGN KEY (`seller_id`) REFERENCES `users` (`user_id`),
    FOREIGN KEY (`admin_approval_id`) REFERENCES `users` (`user_id`),
    FOREIGN KEY (`category_id`) REFERENCES `categorys` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE shopping_cart
(
    `shoppingCart_id` int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID del Producto en el Carrito',
    `quantity` int COMMENT 'Cantidad en el Carrito',
    `product_id` int COMMENT 'ID del Producto relacionado con el Carrito',
    `user_id` int COMMENT 'ID del Usuario dueño del Carrito',
    FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
    FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
);

CREATE TABLE `lists_products`
(
    `list_product_id` int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID del Producto en la Lista',
    `product_id` int COMMENT 'ID del Producto relacionado con la Lista',
    `list_id` int COMMENT 'ID de la Lista a la que pertenece el Producto',
    FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
    FOREIGN KEY (`list_id`) REFERENCES `lists` (`list_id`)
);

CREATE TABLE Compras
(
    ID Int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID de la Compra',
    Fecha TIMESTAMP COMMENT 'Fecha y hora de la Compra',
    Cantidad int COMMENT 'Cantidad en el Carrito',
    ID_Producto int COMMENT 'ID del Producto comprado',
    ID_MetodoPago int COMMENT 'ID del Método de Pago asociado a la Compra',
    ID_Usuario int COMMENT 'ID del Usuario',
    FOREIGN KEY (ID_MetodoPago) REFERENCES Metodo_Pago (ID),
    FOREIGN KEY (ID_Producto) REFERENCES Productos (ID),
    FOREIGN KEY (ID_Usuario) REFERENCES Usuarios (ID)
);

CREATE TABLE Reseñas
(
    ID Int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID de la Reseña',
    Valoracion Int COMMENT 'Valoración de la Reseña',
    Comentario varchar(255) COMMENT 'Comentario de la Reseña',
    ID_Usuario int COMMENT 'ID del Usuario que escribió la Reseña',
    ID_Producto int COMMENT 'ID del Producto al que se refiere la Reseña',
    FOREIGN KEY (ID_Usuario) REFERENCES Usuarios (ID),
    FOREIGN KEY (ID_Producto) REFERENCES Productos (ID)
);

CREATE TABLE Sala_Chat
(
    ID int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID de la Sala de Chat',
    Fecha timestamp COMMENT 'Fecha y hora del Chat',
    ID_Usuario1 int COMMENT 'ID del Primer Usuario en la Sala de Chat',
    ID_Usuario2 int COMMENT 'ID del Segundo Usuario en la Sala de Chat',
    ID_Producto int COMMENT 'ID del Producto relacionado con la Sala de Chat',
    FOREIGN KEY (ID_Usuario1) REFERENCES Usuarios (ID),
    FOREIGN KEY (ID_Usuario2) REFERENCES Usuarios (ID),
    FOREIGN KEY (ID_Producto) REFERENCES Productos (ID)
);

CREATE TABLE Mensajes 
(
    ID int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID del Mensaje',
    Mensaje varchar(255) COMMENT 'Contenido del Mensaje',
    ID_Sala int COMMENT 'ID de la Sala de Chat a la que pertenece el Mensaje',
    ID_Usuario int COMMENT 'ID del Usuario que envió el Mensaje',
    FOREIGN KEY (ID_Sala) REFERENCES Sala_Chat (ID),
    FOREIGN KEY (ID_Usuario) REFERENCES Usuarios (ID)
);

CREATE TABLE Metodo_Pago
(
ID Int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID de cada Método de Pago',
Metodo varchar(50) COMMENT 'Nombre o tipo de Método de Pago',
Total float COMMENT 'Monto total asociado al Método de Pago'
);

CREATE VIEW Diccionario_Datos AS
SELECT TABLE_NAME as Tabla, COLUMN_NAME as Columna, COLUMN_COMMENT as Descripcion, DATA_TYPE as Tipo_de_Dato, COLUMN_KEY as Llave, IS_NULLABLE as Nullable
FROM INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_SCHEMA = 'raccoonxpress'; -- // Nombre de la base de datos //
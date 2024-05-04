-- Tablas necesarias
--  Usuarios, Productos, Listas, Categorias, Productos_Lista, Compras
--  Metodo_Pago, Sala_Chat, Mensajes, Reseñas.
--  Carrito, Productos_Carrito

CREATE TABLE Metodo_Pago
(
ID Int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID de cada Método de Pago',
Metodo varchar(50) COMMENT 'Nombre o tipo de Método de Pago',
Total float COMMENT 'Monto total asociado al Método de Pago'
);

CREATE TABLE `users` (
    `id_user` int(11) NOT NULL COMMENT 'Id de cada usuario',
    `username` varchar(32) NOT NULL COMMENT 'nombre para el usuario en el aplicativo',
    `user_password` varchar(32) NOT NULL COMMENT 'Contraseña del usuario',
    `email` varchar(32) NOT NULL COMMENT 'Dirección de correo electrónico',
    `fullname` varchar(255) DEFAULT NULL COMMENT 'Nombre completo del usuario',
    `birthdate` date DEFAULT NULL COMMENT 'Fecha de nacimiento del usuario',
    `entry_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Fecha y hora de creación de la cuenta',
    `genre` tinyint(1) DEFAULT NULL COMMENT 'Indicador de género',
    `is_active` tinyint(1) DEFAULT NULL COMMENT 'Indicador de cuenta activa',
    `visibility` tinyint(1) DEFAULT NULL COMMENT 'Indicador de visibilidad',
    `user_role` tinyint(1) NOT NULL COMMENT `Rol del usuario`,
    `profile_image` blob DEFAULT NULL COMMENT 'Imagen perfil'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE Productos
(
    ID Int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID del Producto',
    Nombre varchar(255) COMMENT 'Nombre del Producto',
    Descripcion varchar(255) COMMENT 'Descripción del Producto',
    TipoVenta boolean COMMENT 'Tipo de Venta (true/false)',
    Precio float COMMENT 'Precio del Producto',
    CantidadDisponible int COMMENT 'Cantidad Disponible del Producto',
    Aprobacion boolean COMMENT 'Aprobación del Producto (true/false)',
    imagen1 blob COMMENT 'Imagen 1 relacionada con el Producto',
    imagen2 blob COMMENT 'Imagen 2 relacionada con el Producto',
    imagen3 blob COMMENT 'Imagen 3 relacionada con el Producto',
    video longblob COMMENT 'Video relacionado con el Producto',
    ID_Categoria int COMMENT 'ID de la Categoría a la que pertenece el Producto',
    ID_Vendedor int COMMENT 'ID del Usuario que vende el Producto',
    ID_AdminAprov int COMMENT 'ID del Administrador que aprobó el Producto',
    FOREIGN KEY (ID_Categoria) REFERENCES Categorias (ID),
	FOREIGN KEY (ID_Vendedor) REFERENCES Usuarios (ID),
    FOREIGN KEY (ID_AdminAprov) REFERENCES Usuarios (ID)
);

CREATE TABLE Categorias
(
    ID Int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID de la Categoría',
    Nombre varchar(255) COMMENT 'Nombre de la Categoría',
    Descripcion varchar(255) COMMENT 'Descripción de la Categoría',
    ID_Usuario int NOT NULL COMMENT 'ID del Usuario que creó la Categoría',
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

CREATE TABLE Listas
(
    ID Int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID de la Lista',
    Nombre varchar(255) COMMENT 'Nombre de la Lista',
    Descripcion varchar(255) COMMENT 'Descripción de la Lista',
    Privacidad boolean COMMENT 'Privacidad de la Lista (true/false)',
    imagen blob COMMENT 'Imagen de la lista',
    ID_Usuario int COMMENT 'ID del Usuario dueño de la Lista',
    FOREIGN KEY (ID_Usuario) REFERENCES Usuarios (ID)
);

CREATE TABLE Productos_Lista
(
    ID int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID del Producto en la Lista',
    ID_Producto int COMMENT 'ID del Producto relacionado con la Lista',
    ID_Lista int COMMENT 'ID de la Lista a la que pertenece el Producto',
    FOREIGN KEY (ID_Producto) REFERENCES Productos (ID),
    FOREIGN KEY (ID_Lista) REFERENCES Listas (ID)
);

-- CREATE TABLE Carrito
-- (
--     ID int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID del Carrito',
--     ID_Usuario int COMMENT 'ID del Usuario dueño del Carrito',
--     FOREIGN KEY (ID_Usuario) REFERENCES Usuarios (ID)
-- );

CREATE TABLE Productos_Carrito
(
    ID int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID del Producto en el Carrito',
--    Disponible boolean COMMENT 'Disponible (true/false) - Indicador de disponibilidad',
    Cantidad int COMMENT 'Cantidad en el Carrito',
--    Unico boolean COMMENT 'Unico (true/false) - Indicador de unicidad',
    Comprado boolean COMMENT 'Comprado (true/false) - Indicador de compra',
--    ID_Carrito int COMMENT 'ID del Carrito al que pertenece el Producto',
    ID_Producto int COMMENT 'ID del Producto relacionado con el Carrito',
    ID_Usuario int COMMENT 'ID del Usuario dueño del Carrito',
    FOREIGN KEY (ID_Producto) REFERENCES Productos (ID),
    FOREIGN KEY (ID_Usuario) REFERENCES Usuarios (ID)
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

CREATE VIEW Diccionario_Datos AS
SELECT TABLE_NAME as Tabla, COLUMN_NAME as Columna, COLUMN_COMMENT as Descripcion, DATA_TYPE as Tipo_de_Dato, COLUMN_KEY as Llave, IS_NULLABLE as Nullable
FROM INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_SCHEMA = 'raccoonxpress'; -- // Nombre de la base de datos //
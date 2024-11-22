

CREATE DATABASE BASEDEDATOS_HOTEL


CREATE TABLE Hotel (
    ID_Hotel INT PRIMARY KEY NOT NULL,
    Nombre VARCHAR(50),
    Ciudad VARCHAR(50),
    Pais VARCHAR(50),
    Telefono VARCHAR(50),
    Cantidad_Estrellas INT)

CREATE TABLE Hotel_Telefono (
    relacion_telefono_hotel INT PRIMARY KEY NOT NULL,
    ID_Hotel INT,
    Telefono NVARCHAR(50),
    FOREIGN KEY (ID_Hotel) REFERENCES Hotel(ID_Hotel))

CREATE TABLE Cliente_Hotel (
    ID_Cliente INT PRIMARY KEY NOT NULL,
    Nombre VARCHAR(50),
    Apellido1 VARCHAR(50),
    Telefono VARCHAR(50),
    Pais VARCHAR(50),
    Ciudad VARCHAR(50)
);

CREATE TABLE Cliente_Telefono (
    Relacion_Telefono_Cliente INT PRIMARY KEY NOT NULL,
    ID_Cliente INT,
    Telefono VARCHAR(50),
    FOREIGN KEY (ID_Cliente) REFERENCES Cliente_Hotel(ID_Cliente)
);


CREATE TABLE Habitacion_Hotel (
    Num_Habitacion INT PRIMARY KEY NOT NULL,
    ID_Hotel INT,
    Tipo_de_Habitacion NVARCHAR(50),
    Precio_por_Noche DECIMAL(10,2),
    FOREIGN KEY (ID_Hotel) REFERENCES Hotel(ID_Hotel)
);


CREATE TABLE Cliente_Habitacion (
    ID_Estancia INT PRIMARY KEY NOT NULL,
    ID_Cliente INT,
    Num_Habitacion INT,
    Fecha_Entrada DATE,
    Fecha_Salida DATE
	FOREIGN KEY (ID_Cliente) REFERENCES Cliente_Hotel(ID_Cliente)
);

CREATE TABLE Opinion_Cliente (
    ID_Opinion INT PRIMARY KEY,
    ID_Cliente INT,
    Fecha_Opinion DATE,
    Calificacion INT,
    Opinion VARCHAR(10),
    FOREIGN KEY (ID_Cliente) REFERENCES Cliente_Hotel (ID_Cliente)
);

CREATE TABLE Pedido_Hotel (
    ID_Pedido INT PRIMARY KEY NOT NULL,
    ID_Hotel INT,
    Fecha DATE
	 FOREIGN KEY (ID_Hotel) REFERENCES Hotel(ID_Hotel)
);

CREATE TABLE Suministro (
    ID_Suministro INT PRIMARY KEY NOT NULL,
    Descripcion VARCHAR(50),
    Empresa VARCHAR(50)
);

CREATE TABLE Pedido_Suministro (
    ID_Pedido INT,
    ID_Suministro INT,
    Cantidad INT,
    Fecha_Pedido DATE,
    Fecha_Recepcion DATE,
    PRIMARY KEY (ID_Pedido, ID_Suministro),
);

CREATE TABLE Restaurante_Hotel (
    ID_Restaurante INT PRIMARY KEY,
    ID_Hotel INT,
    Nombre VARCHAR(50),
    TipoDeComida VARCHAR(20),
    Hora_Apertura TIME,
    Hora_Cierre TIME,
    FOREIGN KEY (ID_Hotel) REFERENCES Hotel(ID_Hotel)
);

CREATE TABLE Reservacion_Restaurante (
    ID_Reservacion INT PRIMARY KEY NOT NULL,
    ID_Restaurante INT,
    Descripcion VARCHAR(50),
    Precio DECIMAL(10, 2),
    Estado VARCHAR(20),
    FOREIGN KEY (ID_Restaurante) REFERENCES Restaurante_Hotel(ID_Restaurante)
);

CREATE TABLE Servicio_Hotel (
    ID_Servicio INT PRIMARY KEY NOT NULL,
    Nombre_Servicio VARCHAR(100),
);

CREATE TABLE Registro_Servicio (
    ID_Registro INT PRIMARY KEY NOT NULL,
    ID_Servicio INT,
    Estado VARCHAR(50),
	FOREIGN KEY (ID_Servicio) REFERENCES Servicio_Hotel(ID_Servicio)
);

CREATE TABLE Reservacion_Cliente (
    ID_Reservacion_Cliente INT PRIMARY KEY,
    ID_Cliente INT,
    Fecha DATE,
    Estado_de_Reservacion VARCHAR(20),
    FOREIGN KEY (ID_Cliente) REFERENCES Cliente_Hotel(ID_Cliente) 
);

CREATE TABLE Check_In (
    ID_Check_In INT PRIMARY KEY,
    ID_Reservacion_Cliente INT,
    Fecha DATE,
    Hora TIME,
    FOREIGN KEY (ID_Reservacion_Cliente) REFERENCES Reservacion_Cliente(ID_Reservacion_Cliente)
);



CREATE TABLE Check_Out (
    ID_Check_Out INT PRIMARY KEY,
    ID_Reservacion_Cliente INT,
    Fecha DATE,
    Hora TIME,
    Numero_Habitacion INT,
    FOREIGN KEY (ID_Reservacion_Cliente) REFERENCES Reservacion_Cliente(ID_Reservacion_Cliente)
);

CREATE TABLE Pago (
    ID_Pago INT PRIMARY KEY,
    ID_Reservacion_Cliente INT,
    Monto DECIMAL(10, 2),
    Fecha_De_Pago DATE,
    Metodo_De_Pago VARCHAR(50),
    FOREIGN KEY (ID_Reservacion_Cliente) REFERENCES Reservacion_Cliente(ID_Reservacion_Cliente)
);

CREATE TABLE PagosAudit (
    AuditID INT IDENTITY(1,1) PRIMARY KEY, 
    ID_Pago INT,
    Monto DECIMAL(10, 2),
    Fecha_De_Pago DATE,
    Metodo_De_Pago VARCHAR(50),
    AuditAction VARCHAR(50), -- Para almacenar el tipo de acci n (por ejemplo, 'INSERT')
    AuditDateTime DATETIME DEFAULT GETDATE() -- Fecha y hora en que se realiz  la acci n
);

CREATE TABLE ReservacionAudit (
    AuditID INT IDENTITY(1,1) PRIMARY KEY,
    ID_Reservacion_Cliente INT,
    ID_Cliente INT,
    Fecha DATE,
    Estado_de_Reservacion VARCHAR(20),
    AuditAction VARCHAR(50),
    AuditTimestamp DATETIME DEFAULT GETDATE()
);

CREATE TABLE HotelAudit (
    ID_Hotel INT,
    Nombre VARCHAR(50),
    Ciudad VARCHAR(50),
    Pais VARCHAR(50),
    Telefono VARCHAR(50),
    Cantidad_Estrellas INT,
    AuditAction VARCHAR(50),
    AuditTimestamp DATETIME DEFAULT GETDATE()
);
--------------

--Registros 

INSERT INTO Hotel (ID_Hotel, Nombre, Ciudad, Pais, Telefono, Cantidad_Estrellas) VALUES
(1, 'Hotel 1', 'Ciudad 18', 'Nicaragua', '557-4826-4104', 3),
(2, 'Hotel 2', 'Ciudad 2', 'Panama', '568-5678-7326', 2),
(3, 'Hotel 3', 'Ciudad 9', 'Nicaragua', '524-2038-7616, 567-3939-6667', 4),
(4, 'Hotel 4', 'Ciudad 12', 'Belize', '575-6097-5787', 1),
(5, 'Hotel 5', 'Ciudad 7', 'Belize', '504-8866-9838', 3),
(6, 'Hotel 6', 'Ciudad 18', 'Nicaragua', '557-4627-5956', 4),
(7, 'Hotel 7', 'Ciudad 20', 'Honduras', '593-3062-6650', 5),
(8, 'Hotel 8', 'Ciudad 10', 'Belize', '598-9548-4806', 2),
(9, 'Hotel 9', 'Ciudad 12', 'Costa Rica', '542-9406-4535', 4),
(10, 'Hotel 10', 'Ciudad 13', 'Panama', '538-9588-9607', 4),
(11, 'Hotel 11', 'Ciudad 15', 'Costa Rica', '543-1685-1652', 1),
(12, 'Hotel 12', 'Ciudad 9', 'Guatemala', '552-1242-6761', 2),
(13, 'Hotel 13', 'Ciudad 14', 'El Salvador', '586-5161-9898', 4),
(14, 'Hotel 14', 'Ciudad 4', 'Panama', '550-4411-9680', 1),
(15, 'Hotel 15', 'Ciudad 3', 'Panama', '504-6027-9760', 2),
(16, 'Hotel 16', 'Ciudad 9', 'Nicaragua', '554-8487-5554', 5),
(17, 'Hotel 17', 'Ciudad 1', 'Nicaragua', '576-8838-9242, 560-7509-3924', 5),
(18, 'Hotel 18', 'Ciudad 20', 'Nicaragua', '525-2167-7740', 1),
(19, 'Hotel 19', 'Ciudad 8', 'Guatemala', '568-9362-3400', 2),
(20, 'Hotel 20', 'Ciudad 15', 'Nicaragua', '509-2319-7503', 4),
(21, 'Hotel 21', 'Ciudad 15', 'Guatemala', '531-2234-4974', 3),
(22, 'Hotel 22', 'Ciudad 2', 'Panama', '545-6621-3605', 4),
(23, 'Hotel 23', 'Ciudad 4', 'Panama', '522-4698-5124, 525-2637-2746', 4),
(24, 'Hotel 24', 'Ciudad 3', 'Guatemala', '510-8857-2311', 2),
(25, 'Hotel 25', 'Ciudad 10', 'Panama', '548-4690-8221', 1),
(26, 'Hotel 26', 'Ciudad 11', 'Panama', '561-2593-8721', 4),
(27, 'Hotel 27', 'Ciudad 19', 'Nicaragua', '540-6387-2379, 541-9667-1778', 3),
(28, 'Hotel 28', 'Ciudad 9', 'Guatemala', '548-5961-5003, 533-4353-1940', 5),
(29, 'Hotel 29', 'Ciudad 18', 'Honduras', '523-7736-1151', 1),
(30, 'Hotel 30', 'Ciudad 13', 'Guatemala', '565-7061-3590', 4),
(31, 'Hotel 31', 'Ciudad 12', 'Belize', '532-4129-2158', 3),
(32, 'Hotel 32', 'Ciudad 8', 'Honduras', '577-8481-6222', 1),
(33, 'Hotel 33', 'Ciudad 7', 'El Salvador', '596-3823-4062', 4),
(34, 'Hotel 34', 'Ciudad 16', 'Guatemala', '593-7553-6521, 558-2734-5675', 5),
(35, 'Hotel 35', 'Ciudad 2', 'Nicaragua', '591-6354-4326, 503-2684-6293', 2),
(36, 'Hotel 36', 'Ciudad 4', 'Panama', '587-1409-7523', 1),
(37, 'Hotel 37', 'Ciudad 1', 'Nicaragua', '518-9401-8978', 2),
(38, 'Hotel 38', 'Ciudad 14', 'Honduras', '555-5548-2016', 3),
(39, 'Hotel 39', 'Ciudad 9', 'Costa Rica', '560-7753-8501', 4),
(40, 'Hotel 40', 'Ciudad 2', 'Belize', '532-5276-5464', 1),
(41, 'Hotel 41', 'Ciudad 4', 'Guatemala', '523-9913-3209', 5),
(42, 'Hotel 42', 'Ciudad 16', 'El Salvador', '580-5030-9730, 551-6482-9834', 2),
(43, 'Hotel 43', 'Ciudad 4', 'Costa Rica', '507-9467-1182', 4),
(44, 'Hotel 44', 'Ciudad 14', 'Honduras', '548-8566-2400', 3),
(45, 'Hotel 45', 'Ciudad 5', 'El Salvador', '538-2345-5715', 1),
(46, 'Hotel 46', 'Ciudad 3', 'Nicaragua', '579-1572-2897, 512-5057-5642', 1),
(47, 'Hotel 47', 'Ciudad 16', 'Honduras', '562-8438-8045', 3),
(48, 'Hotel 48', 'Ciudad 19', 'Guatemala', '507-8272-3173', 5),
(49, 'Hotel 49', 'Ciudad 11', 'Costa Rica', '598-9331-5256, 515-2765-5147', 4),
(50, 'Hotel 50', 'Ciudad 17', 'Honduras', '551-2558-3182', 2);

SELECT * FROM Hotel

INSERT INTO Hotel_Telefono(relacion_telefono_hotel, ID_Hotel, Telefono) VALUES
(1, 1, '557-4826-4104'),
(2, 2, '568-5678-7326'),
(3, 3, '524-2038-7616'),
(4, 3, '567-3939-6667'),
(5, 4, '575-6097-5787'),
(6, 5, '504-8866-9838'),
(7, 6, '557-4627-5956'),
(8, 7, '593-3062-6650'),
(9, 8, '598-9548-4806'),
(10, 9, '542-9406-4535'),
(11, 10, '584-1104-4292'),
(12, 11, '543-1685-1652'),
(13, 12, '552-1242-6761'),
(14, 13, '586-5161-9898'),
(15, 14, '550-4411-9680'),
(16, 15, '504-6027-9760'),
(17, 16, '554-8487-5554'),
(18, 17, '576-8838-9242'),
(19, 18, '525-2167-7740'),
(20, 19, '568-9362-3400'),
(21, 20, '509-2319-7503'),
(22, 21, '531-2234-4974'),
(23, 22, '545-6621-3605'),
(24, 23, '522-4698-5124'),
(25, 24, '525-2637-2746'),
(26, 25, '510-8857-2311'),
(27, 26, '548-4690-8221'),
(28, 27, '561-2593-8721'),
(29, 27, '540-6387-2379'),
(30, 27, '541-9667-1778'),
(31, 28, '548-5961-5003'),
(32, 29, '533-4353-1940'),
(33, 30, '523-7736-1151'),
(34, 31, '565-7061-3590'),
(35, 32, '532-4129-2158'),
(36, 33, '577-8481-6222'),
(37, 34, '596-3823-4062'),
(38, 34, '593-7553-6521'),
(39, 34, '558-2734-5675'),
(40, 35, '591-6354-4326'),
(41, 35, '503-2684-6293'),
(42, 36, '587-1409-7523'),
(43, 37, '518-9401-8978'),
(44, 38, '555-5548-2016'),
(45, 39, '560-7753-8501'),
(46, 40, '532-5276-5464'),
(47, 41, '523-9913-3209'),
(48, 42, '580-5030-9730'),
(49, 42, '551-6482-9834'),
(50, 43, '507-9467-1182'),
(51, 44, '548-8566-2400'),
(52, 45, '538-2345-5715'),
(53, 46, '579-1572-2897'),
(54, 46, '512-5057-5642'),
(55, 47, '562-8438-8045'),
(56, 48, '507-8272-3173'),
(57, 49, '598-9331-5256'),
(58, 49, '515-2765-5147'),
(59, 50, '551-2558-3182');

SELECT * FROM Hotel_Telefono

INSERT INTO Cliente_Hotel(ID_Cliente, Nombre, Apellido1, Telefono, Pais, Ciudad) VALUES
(1, 'Juan', 'G mez', '555-6968 , 555-1475', 'M xico', 'Ciudad de M xico'),
(2, 'Mar a', 'Rodr guez', '555-2345', 'Argentina', 'Buenos Aires'),
(3, 'Luis', 'Hern ndez', '555-3430 , 555-2095', 'Colombia', 'Bogot '),
(4, 'Ana', 'L pez', '555-1930', 'Chile', 'Santiago'),
(5, 'Pedro', 'Mart nez', '555-3695 , 555-4714', 'Per ', 'Lima'),
(6, 'Laura', 'P rez', '555-8539', 'Espa a', 'Madrid'),
(7, 'Jorge', 'S nchez', '555-5813 , 555-6954', 'Venezuela', 'Caracas'),
(8, 'Carmen', 'D az', '555-5019', 'Uruguay', 'Montevideo'),
(9, 'Jos ', 'Ram rez', '555-1581', 'Ecuador', 'Quito'),
(10, 'Daniela', 'Torres', '555-5887 , 555-3512', 'Bolivia', 'La Paz'),
(11, 'Carlos', 'Garc a', '555-1553 , 555-8913', 'Costa Rica', 'San Jos '),
(12, 'Ana', 'V squez', '555-6556 , 555-7853', 'Paraguay', 'Asunci n'),
(13, 'Diego', 'Mendoza', '555-4229', 'Honduras', 'Tegucigalpa'),
(14, 'Luc a', 'Ramos', '555-1839 , 555-8831', 'El Salvador', 'San Salvador'),
(15, 'Miguel', 'Ch vez', '555-7958', 'Guatemala', 'Guatemala'),
(16, 'Paola', 'Moreno', '555-9371', 'Panam ', 'Panam '),
(17, 'Juan', 'Castillo', '555-1979', 'Cuba', 'La Habana'),
(18, 'Gabriela', 'Vega', '555-9494 , 555-1232', 'Rep blica Dominicana', 'Santo Domingo'),
(19, 'Ricardo', 'Ortega', '555-7682', 'Puerto Rico', 'San Juan'),
(20, 'Valeria', 'Romero', '555-5347', 'Nicaragua', 'Managua'),
(21, 'Fernando', 'Silva', '555-3962', 'M xico', 'Ciudad de M xico'),
(22, 'Sof a', 'Reyes', '555-3556', 'Argentina', 'Buenos Aires'),
(23, 'Francisco', 'Soto', '555-7495 , 555-9385', 'Colombia', 'Bogot '),
(24, 'Mariana', 'Campos', '555-6470 , 555-3752', 'Chile', 'Santiago'),
(25, 'Alejandro', 'Guerrero', '555-1486', 'Per ', 'Lima'),
(26, 'Natalia', 'Flores', '555-2363', 'Espa a', 'Madrid'),
(27, 'Cristian', 'Paredes', '555-7128 , 555-7522', 'Venezuela', 'Caracas'),
(28, 'Andrea', 'Salazar', '555-5494 , 555-5299', 'Uruguay', 'Montevideo'),
(29, 'Ra l', 'Medina', '555-9632', 'Ecuador', 'Quito'),
(30, 'Ver nica', 'Guzm n', '555-7258 , 555-6381', 'Bolivia', 'La Paz'),
(31, 'Sebasti n', 'Barrera', '555-4211 , 555-9473', 'Costa Rica', 'San Jos '),
(32, 'Patricia', 'Cruz', '555-9252', 'Paraguay', 'Asunci n'),
(33, 'Hugo', 'Figueroa', '555-1415 , 555-3215', 'Honduras', 'Tegucigalpa'),
(34, 'In s', 'N  ez', '555-7089', 'El Salvador', 'San Salvador'),
(35, 'Gustavo', 'Herrera', '555-7510 , 555-1771', 'Guatemala', 'Guatemala'),
(36, 'Victoria', 'Escobar', '555-9285', 'Panam ', 'Panam '),
(37, 'Rodrigo', 'Valdez', '555-5158 , 555-5453', 'Cuba', 'La Habana'),
(38, 'Adriana', 'Maldonado', '555-6025', 'Rep blica Dominicana', 'Santo Domingo'),
(39, 'Mauricio', 'Zamora', '555-4412', 'Puerto Rico', 'San Juan'),
(40, 'Carolina', 'Miranda', '555-5983', 'Nicaragua', 'Managua'),
(41, ' scar', 'Esquivel', '555-2874', 'M xico', 'Ciudad de M xico'),
(42, 'Lorena', 'Olivares', '555-3677', 'Argentina', 'Buenos Aires'),
(43, 'Felipe', 'Mora', '555-3410', 'Colombia', 'Bogot '),
(44, 'Claudia', 'Vargas', '555-7171 , 555-6232', 'Chile', 'Santiago'),
(45, 'Enrique', 'Pe a', '555-2772', 'Per ', 'Lima'),
(46, 'Teresa', 'Sol s', '555-6604', 'Espa a', 'Madrid'),
(47, ' ngel', 'Navarro', '555-5086 , 555-7490', 'Venezuela', 'Caracas'),
(48, 'M nica', 'R os', '555-8275', 'Uruguay', 'Montevideo'),
(49, 'Esteban', 'Montes', '555-4866 , 555-5458', 'Ecuador', 'Quito'),
(50, 'Cecilia', 'Rojas', '555-4456', 'Bolivia', 'La Paz');

INSERT INTO Cliente_Telefono (Relacion_Telefono_Cliente, ID_Cliente, Telefono) VALUES
(1, 1, '555-6968'),
(2, 1, '555-1475'),
(3, 2, '555-2345'),
(4, 3, '555-3430'),
(5, 3, '555-2905'),
(6, 4, '555-1930'),
(7, 5, '555-3695'),
(8, 5, '555-4714'),
(9, 6, '555-8539'),
(10, 7, '555-5813'),
(11, 7, '555-6954'),
(12, 8, '555-5019'),
(13, 9, '555-1581'),
(14, 10, '555-5887'),
(15, 10, '555-3512'),
(16, 11, '555-1553'),
(17, 11, '555-8913'),
(18, 12, '555-6556'),
(19, 12, '555-7853'),
(20, 13, '555-4229'),
(21, 14, '555-1839'),
(22, 14, '555-8831'),
(23, 15, '555-7958'),
(24, 16, '555-9371'),
(25, 17, '555-1979'),
(26, 18, '555-9494'),
(27, 18, '555-1232'),
(28, 19, '555-7682'),
(29, 20, '555-5347'),
(30, 20, '555-7823'),
(31, 21, '555-3962'),
(32, 21, '555-5613'),
(33, 22, '555-3556'),
(34, 22, '555-1559'),
(35, 23, '555-7495'),
(36, 23, '555-9385'),
(37, 24, '555-6470'),
(38, 24, '555-3752'),
(39, 25, '555-1486'),
(40, 26, '555-2363'),
(41, 27, '555-7128'),
(42, 27, '555-7522'),
(43, 28, '555-5494'),
(44, 28, '555-5299'),
(45, 29, '555-9632'),
(46, 30, '555-7258'),
(47, 30, '555-6381'),
(48, 31, '555-4211'),
(49, 31, '555-9473'),
(50, 32, '555-9252'),
(51, 32, '555-7865'),
(52, 33, '555-1415'),
(53, 33, '555-3215'),
(54, 34, '555-7089'),
(55, 34, '555-3643'),
(56, 35, '555-7510'),
(57, 35, '555-1771'),
(58, 36, '555-9285'),
(59, 37, '555-5158'),
(60, 37, '555-5453'),
(61, 38, '555-6025'),
(62, 39, '555-4412'),
(63, 40, '555-5983'),
(64, 40, '555-5291'),
(65, 41, '555-2874'),
(66, 41, '555-4551'),
(67, 42, '555-5677'),
(68, 43, '555-3410'),
(69, 43, '555-5291'),
(70, 44, '555-7171'),
(71, 44, '555-6232'),
(72, 45, '555-2278'),
(73, 46, '555-6604'),
(74, 46, '555-5134'),
(75, 47, '555-5086'),
(76, 47, '555-7490'),
(77, 48, '555-8275'),
(78, 48, '555-9383'),
(79, 49, '555-4866'),
(80, 49, '555-5458'),
(81, 50, '555-5921');

INSERT INTO Habitacion_Hotel(Num_Habitacion, ID_Hotel, Tipo_de_Habitacion, Precio_por_Noche) VALUES
(101, 8, 'Sencilla', 80),
(102, 8, 'Suite', 620),
(103, 4, 'Suite', 450),
(104, 5, 'Suite', 79),
(105, 8, 'Doble', 194),
(106, 6, 'Sencilla', 105),
(107, 7, 'Doble', 78),
(108, 9, 'Suite', 365),
(109, 9, 'Suite', 368),
(110, 3, 'Doble', 108),
(111, 2, 'Doble', 98),
(112, 5, 'Doble', 199),
(113, 2, 'Sencilla', 69),
(114, 3, 'Sencilla', 101),
(115, 9, 'Sencilla', 65),
(116, 3, 'Suite', 310),
(117, 8, 'Doble', 151),
(118, 7, 'Sencilla', 110),
(119, 1, 'Sencilla', 185),
(120, 5, 'Doble', 104),
(121, 1, 'Doble', 174),
(122, 4, 'Sencilla', 136),
(123, 4, 'Suite', 450),
(124, 9, 'Suite', 620),
(125, 7, 'Sencilla', 50),
(126, 3, 'Sencilla', 168),
(127, 1, 'Suite', 450),
(128, 8, 'Doble', 250),
(129, 9, 'Doble', 180),
(130, 6, 'Sencilla', 118),
(131, 10, 'Sencilla', 82),
(132, 4, 'Suite', 320),
(133, 10, 'Sencilla', 300),
(134, 9, 'Sencilla', 153),
(135, 2, 'Suite', 50),
(136, 4, 'Doble', 177),
(137, 10, 'Doble', 153),
(138, 3, 'Doble', 120),
(139, 8, 'Doble', 194),
(140, 8, 'Doble', 108),
(141, 3, 'Doble', 136),
(142, 3, 'Sencilla', 57),
(143, 6, 'Sencilla', 143),
(144, 10, 'Sencilla', 123),
(145, 6, 'Sencilla', 127),
(146, 6, 'Sencilla', 158),
(147, 5, 'Suite', 300),
(148, 3, 'Sencilla', 64),
(149, 3, 'Doble', 115),
(150, 5, 'Doble', 125);

INSERT INTO Cliente_Habitacion(ID_Estancia, ID_Cliente, Num_Habitacion, Fecha_Entrada, Fecha_Salida) VALUES
(1, 41, 150, '2023-01-01', '2023-01-07'),
(2, 18, 137, '2023-01-08', '2023-01-09'),
(3, 16, 135, '2023-01-15', '2023-01-19'),
(4, 5, 149, '2023-01-23', '2023-01-27'),
(5, 42, 130, '2023-01-30', '2023-02-07'),
(6, 43, 104, '2023-02-07', '2023-02-11'),
(7, 32, 135, '2023-02-14', '2023-02-16'),
(8, 2, 143, '2023-02-21', '2023-02-24'),
(9, 40, 149, '2023-02-24', '2023-03-02'),
(10, 41, 104, '2023-03-03', '2023-03-10'),
(11, 36, 122, '2023-03-23', '2023-04-01'),
(12, 39, 110, '2023-03-31', '2023-04-09'),
(13, 12, 101, '2023-04-09', '2023-04-14'),
(14, 47, 111, '2023-04-14', '2023-04-21'),
(15, 19, 144, '2023-04-22', '2023-04-30'),
(16, 28, 124, '2023-04-29', '2023-05-07'),
(17, 1, 103, '2023-05-07', '2023-05-10'),
(18, 15, 135, '2023-05-14', '2023-05-16'),
(19, 36, 136, '2023-05-22', '2023-05-28'),
(20, 13, 131, '2023-05-29', '2023-06-07'),
(21, 43, 104, '2023-06-07', '2023-06-12'),
(22, 21, 119, '2023-06-13', '2023-06-17'),
(23, 12, 147, '2023-06-20', '2023-06-21'),
(24, 5, 136, '2023-06-28', '2023-07-02'),
(25, 7, 121, '2023-07-05', '2023-07-11'),
(26, 5, 118, '2023-07-13', '2023-07-16'),
(27, 48, 128, '2023-07-20', '2023-07-23'),
(28, 4, 115, '2023-07-27', '2023-07-29'),
(29, 13, 142, '2023-08-04', '2023-08-13'),
(30, 37, 102, '2023-08-11', '2023-08-13'),
(31, 41, 137, '2023-08-19', '2023-08-23'),
(32, 15, 111, '2023-08-26', '2023-08-30'),
(33, 16, 123, '2023-09-03', '2023-09-07'),
(34, 21, 144, '2023-09-10', '2023-09-18'),
(35, 36, 141, '2023-09-18', '2023-09-19'),
(36, 24, 112, '2023-09-25', '2023-09-27'),
(37, 16, 103, '2023-10-02', '2023-10-03'),
(38, 14, 117, '2023-10-10', '2023-10-15'),
(39, 22, 133, '2023-10-17', '2023-10-25'),
(40, 49, 101, '2023-10-25', '2023-10-30'),
(41, 50, 139, '2023-11-01', '2023-11-04'),
(42, 6, 120, '2023-11-08', '2023-11-16'),
(43, 42, 147, '2023-11-16', '2023-11-19'),
(44, 36, 143, '2023-11-23', '2023-11-24'),
(45, 1, 141, '2023-12-01', '2023-12-02'),
(46, 32, 114, '2023-12-08', '2023-12-13'),
(47, 6, 131, '2023-12-16', '2023-12-18'),
(48, 31, 125, '2023-12-23', '2023-12-29'),
(49, 1, 103, '2023-12-31', '2024-01-07');





INSERT INTO Opinion_Cliente(ID_Opinion, ID_Cliente, Fecha_Opinion, Calificacion, Opinion) VALUES
(1, 11, '2024-03-26', 5, 'Excelente'),
(2, 8, '2024-02-09', 1, 'Malo'),
(3, 44, '2023-10-22', 1, 'Malo'),
(4, 43, '2024-06-22', 5, 'Excelente'),
(5, 6, '2024-06-21', 4, 'Bueno'),
(6, 48, '2023-10-19', 5, 'Excelente'),
(7, 31, '2023-11-03', 1, 'Malo'),
(8, 35, '2023-10-13', 1, 'Malo'),
(9, 27, '2023-04-09', 3, 'Regular'),
(10, 43, '2024-03-06', 4, 'Bueno'),
(11, 5, '2023-11-11', 1, 'Malo'),
(12, 21, '2023-09-16', 3, 'Regular'),
(13, 16, '2024-06-29', 4, 'Bueno'),
(14, 33, '2024-07-01', 5, 'Excelente'),
(15, 8, '2024-07-18', 5, 'Excelente'),
(16, 41, '2023-10-07', 3, 'Regular'),
(17, 23, '2023-11-23', 3, 'Regular'),
(18, 20, '2023-09-06', 3, 'Regular'),
(19, 42, '2023-12-23', 3, 'Regular'),
(20, 14, '2023-12-12', 1, 'Malo'),
(21, 37, '2024-04-20', 1, 'Malo'),
(22, 16, '2023-12-13', 5, 'Excelente'),
(23, 18, '2024-02-27', 1, 'Malo'),
(24, 16, '2024-03-18', 3, 'Regular'),
(25, 34, '2024-02-09', 5, 'Excelente'),
(26, 14, '2023-09-09', 4, 'Bueno'),
(27, 11, '2024-01-11', 5, 'Excelente'),
(28, 15, '2024-07-26', 4, 'Bueno'),
(29, 20, '2023-10-06', 5, 'Excelente'),
(30, 44, '2023-09-15', 5, 'Excelente'),
(31, 5, '2024-04-26', 2, 'Malo'),
(32, 28, '2024-06-11', 3, 'Regular'),
(33, 16, '2024-01-22', 3, 'Regular'),
(34, 7, '2024-05-22', 2, 'Malo'),
(35, 48, '2024-01-27', 2, 'Malo'),
(36, 43, '2023-11-22', 4, 'Bueno'),
(37, 37, '2024-03-06', 4, 'Bueno'),
(38, 41, '2024-03-03', 3, 'Regular'),
(39, 5, '2023-11-08', 3, 'Regular'),
(40, 6, '2024-07-04', 2, 'Malo'),
(41, 32, '2023-10-06', 1, 'Malo'),
(42, 12, '2024-01-24', 3, 'Regular'),
(43, 32, '2023-10-02', 2, 'Malo'),
(44, 24, '2024-07-11', 1, 'Malo'),
(45, 33, '2024-03-02', 4, 'Bueno'),
(46, 24, '2024-05-31', 5, 'Excelente'),
(47, 39, '2023-08-19', 3, 'Regular'),
(48, 33, '2023-10-24', 1, 'Malo'),
(49, 6, '2023-09-26', 4, 'Bueno'),
(50, 24, '2024-01-17', 3, 'Regular');

INSERT INTO Pedido_Hotel (ID_Pedido, ID_Hotel, Fecha) VALUES
(1, 34, '2024-01-01'),
(2, 47, '2024-01-02'),
(3, 9, '2024-01-03'),
(4, 34, '2024-01-04'),
(5, 4, '2024-01-05'),
(6, 25, '2024-01-06'),
(7, 7, '2024-01-07'),
(8, 47, '2024-01-08'),
(9, 10, '2024-01-09'),
(10, 14, '2024-01-10'),
(11, 10, '2024-01-11'),
(12, 47, '2024-01-12'),
(13, 23, '2024-01-13'),
(14, 13, '2024-01-14'),
(15, 36, '2024-01-15'),
(16, 39, '2024-01-16'),
(17, 13, '2024-01-17'),
(18, 44, '2024-01-18'),
(19, 41, '2024-01-19'),
(20, 22, '2024-01-20'),
(21, 20, '2024-01-21'),
(22, 42, '2024-01-22'),
(23, 3, '2024-01-23'),
(24, 30, '2024-01-24'),
(25, 17, '2024-01-25'),
(26, 25, '2024-01-26'),
(27, 41, '2024-01-27'),
(28, 24, '2024-01-28'),
(29, 37, '2024-01-29'),
(30, 3, '2024-01-30'),
(31, 40, '2024-01-31'),
(32, 2, '2024-02-01'),
(33, 26, '2024-02-02'),
(34, 41, '2024-02-03'),
(35, 6, '2024-02-04'),
(36, 9, '2024-02-05'),
(37, 47, '2024-02-06'),
(38, 26, '2024-02-07'),
(39, 41, '2024-02-08'),
(40, 50, '2024-02-09'),
(41, 9, '2024-02-10'),
(42, 9, '2024-02-11'),
(43, 48, '2024-02-12'),
(44, 12, '2024-02-13'),
(45, 13, '2024-02-14'),
(46, 39, '2024-02-15'),
(47, 27, '2024-02-16'),
(48, 16, '2024-02-17'),
(49, 17, '2024-02-18'),
(50, 11, '2024-02-19');

INSERT INTO Suministro (ID_Suministro, Descripcion, Empresa) VALUES
(1, 'Mobiliario', 'Muebles Alemania'),
(2, 'Botellas de Coca Cola', 'The Coca-Cola Company'),
(3, 'Art culos de ba o', 'Incesa Standard'),
(4, 'Utensilios de cocina', 'Renakit'),
(5, 'Cerveza nacional', 'Diageo'),
(6, 'Tecnolog a', 'Tecnolog a Avanzada'),
(7, 'Vajilla', 'NOVEX'),
(8, 'Mobiliario', 'Muebles Alemania'),
(9, 'Herramientas', 'EPA'),
(10, 'Papeler a', 'Papeler a MC'),
(11, 'Decoraci n', 'CORE'),
(12, 'Cubiertos', 'Mayca'),
(13, 'Botellas de vino', 'Vinos Premium'),
(14, 'Productos de limpieza', 'Sanipro'),
(15, 'Cubiertos', 'Mayca'),
(16, 'Productos de oficina', 'Office Depot'),
(17, 'Productos de limpieza', 'Sanipro'),
(18, 'Papeler a', 'Papeler a MC'),
(19, 'Decoraci n', 'CORE'),
(20, 'Art culos de ba o', 'Incesa Standard'),
(21, 'Bolsas de sal', 'Sal del Mundo'),
(22, 'Art culos de ba o', 'Incesa Standard'),
(23, 'Art culos de ba o', 'Incesa Standard'),
(24, 'Bolsas de vegetales', 'Vegetales Fresquita'),
(25, 'Herramientas', 'EPA'),
(26, 'Suministros de mantenimiento', 'Grupo Eulen'),
(27, 'Papeler a', 'Papeler a MC'),
(28, 'Decoraci n', 'CORE'),
(29, 'Cubiertos', 'Mayca'),
(30, 'Vajilla', 'NOVEX'),
(31, 'Mobiliario', 'Muebles Alemania'),
(32, 'Decoraci n', 'CORE'),
(33, 'Productos de limpieza', 'Sanipro'),
(34, 'Ropa de cama', 'Ropa de Hogar'),
(35, 'Electrodom sticos', 'Ambitec'),
(36, 'Utensilios de cocina', 'Renakit'),
(37, 'Art culos de ba o', 'Incesa Standard'),
(38, 'Bebidas no alcoh licas', 'FIFCO'),
(39, 'Toallas', 'Vianney'),
(40, 'Equipamiento deportivo', 'Cicadex'),
(41, 'Ropa de cama', 'Ropa de Hogar'),
(42, 'Cristaler a', 'Cristaler a Monaco'),
(43, 'Cerveza nacional', 'Diageo'),
(44, 'Cristaler a', 'Cristaler a Monaco'),
(45, 'Productos de limpieza', 'Sanipro'),
(46, 'Ropa de cama', 'Ropa de Hogar'),
(47, 'Productos de limpieza', 'Sanipro'),
(48, 'Equipamiento deportivo', 'Cicadex'),
(49, 'Cristaler a', 'Cristaler a Monaco'),
(50, 'Papeler a', 'Papeler a MC');

INSERT INTO Pedido_Suministro (ID_Pedido, ID_Suministro, Cantidad, Fecha_Pedido, Fecha_Recepcion) VALUES
(1, 39, 5, '2024-01-01', '2024-01-08'),
(2, 29, 10, '2024-01-02', '2024-01-09'),
(3, 15, 7, '2024-01-03', '2024-01-10'),
(4, 43, 12, '2024-01-04', '2024-01-11'),
(5, 8, 20, '2024-01-05', '2024-01-12'),
(6, 21, 15, '2024-01-06', '2024-01-13'),
(7, 10, 10, '2024-01-07', '2024-01-14'),
(8, 19, 8, '2024-01-08', '2024-01-15'),
(9, 23, 5, '2024-01-09', '2024-01-16'),
(10, 11, 30, '2024-01-10', '2024-01-17'),
(11, 11, 30, '2024-01-11', '2024-01-18'),
(12, 24, 25, '2024-01-12', '2024-01-19'),
(13, 36, 50, '2024-01-13', '2024-01-20'),
(14, 40, 40, '2024-01-14', '2024-01-21'),
(15, 24, 20, '2024-01-15', '2024-01-22'),
(16, 3, 35, '2024-01-16', '2024-01-23'),
(17, 22, 10, '2024-01-17', '2024-01-24'),
(18, 2, 25, '2024-01-18', '2024-01-25'),
(19, 24, 10, '2024-01-19', '2024-01-26'),
(20, 44, 5, '2024-01-20', '2024-01-27'),
(21, 30, 30, '2024-01-21', '2024-01-28'),
(22, 38, 15, '2024-01-22', '2024-01-29'),
(23, 2, 20, '2024-01-23', '2024-01-30'),
(24, 21, 10, '2024-01-24', '2024-01-31'),
(25, 33, 15, '2024-01-25', '2024-02-01'),
(26, 12, 25, '2024-01-26', '2024-02-02'),
(27, 22, 10, '2024-01-27', '2024-02-03'),
(28, 44, 20, '2024-01-28', '2024-02-04'),
(29, 25, 10, '2024-01-29', '2024-02-05'),
(30, 49, 5, '2024-01-30', '2024-02-06'),
(31, 27, 30, '2024-01-31', '2024-02-07'),
(32, 42, 20, '2024-02-01', '2024-02-08'),
(33, 28, 10, '2024-02-02', '2024-02-09'),
(34, 16, 10, '2024-02-03', '2024-02-10'),
(35, 15, 5, '2024-02-04', '2024-02-11'),
(36, 47, 30, '2024-02-05', '2024-02-12'),
(37, 44, 20, '2024-02-06', '2024-02-13'),
(38, 3, 15, '2024-02-07', '2024-02-14'),
(39, 37, 5, '2024-02-08', '2024-02-15'),
(40, 7, 10, '2024-02-09', '2024-02-16'),
(41, 21, 25, '2024-02-10', '2024-02-17'),
(42, 9, 5, '2024-02-11', '2024-02-18'),
(43, 39, 20, '2024-02-12', '2024-02-19'),
(44, 18, 15, '2024-02-13', '2024-02-20'),
(45, 4, 10, '2024-02-14', '2024-02-21'),
(46, 25, 20, '2024-02-15', '2024-02-22'),
(47, 14, 5, '2024-02-16', '2024-02-23'),
(48, 50, 15, '2024-02-17', '2024-02-24'),
(49, 9, 20, '2024-02-18', '2024-02-25'),
(50, 26, 10, '2024-02-19', '2024-02-26');

INSERT INTO Restaurante_Hotel (ID_Restaurante, ID_Hotel, Nombre, TipoDeComida, Hora_Apertura, Hora_Cierre) VALUES
(1, 8, 'Restaurante El Sol', 'Mexicana', '12:00', '22:00'),
(2, 8, 'La Pasta Italiana', 'Italiana', '11:00', '23:00'),
(3, 8, 'Sushi Zen', 'Japonesa', '10:00', '21:00'),
(4, 6, 'Curry House', 'India', '12:00', '23:00'),
(5, 8, 'Tapas del Mar', 'Espa ola', '14:00', '22:00'),
(6, 8, 'Grill & BBQ', 'Americana', '13:00', '23:00'),
(7, 7, 'Green Salad', 'Vegana', '10:00', '20:00'),
(8, 7, 'Bistro Paris', 'Francesa', '17:00', '22:00'),
(9, 9, 'Thai Spice', 'Tailandesa', '12:00', '23:00'),
(10, 5, 'Casa Mediterr nea', 'Mediterr nea', '12:00', '22:00'),
(11, 2, 'El Rancho', 'Mexicana', '12:00', '23:00'),
(12, 5, 'La Trattoria', 'Italiana', '11:00', '23:00'),
(13, 2, 'Sushi Sake', 'Japonesa', '10:00', '21:00'),
(14, 6, 'Curry Palace', 'India', '12:00', '23:00'),
(15, 9, 'Tapas y Vinos', 'Espa ola', '13:00', '22:00'),
(16, 3, 'Burger Town', 'Americana', '12:00', '23:00'),
(17, 7, 'Green Oasis', 'Vegana', '17:00', '20:00'),
(18, 8, 'La Vie en Rose', 'Francesa', '17:00', '22:00'),
(19, 1, 'Thai Garden', 'Tailandesa', '12:00', '22:00'),
(20, 5, 'El Pueblo', 'Mexicana', '12:00', '23:00'),
(21, 1, 'La Dolce Vita', 'Italiana', '11:00', '23:00'),
(22, 4, 'Samurai Sushi', 'Japonesa', '10:00', '21:00'),
(23, 4, 'India Delight', 'India', '12:00', '23:00'),
(24, 9, 'Paella y Mariscos', 'Espa ola', '14:00', '22:00'),
(25, 7, 'BBQ & More', 'Americana', '13:00', '23:00'),
(26, 3, 'Vegan Vibes', 'Vegana', '10:00', '20:00'),
(27, 1, 'French Bistro', 'Francesa', '17:00', '22:00'),
(28, 8, 'Thai Fusion', 'Tailandesa', '12:00', '23:00'),
(29, 2, 'La Cantina', 'Mexicana', '12:00', '22:00'),
(30, 6, 'Italian Bliss', 'Italiana', '11:00', '23:00'),
(31, 10, 'Sushi Wave', 'Japonesa', '10:00', '21:00'),
(32, 4, 'Curry Corner', 'India', '12:00', '23:00'),
(33, 4, 'Tapas Bar', 'Espa ola', '14:00', '22:00'),
(34, 9, 'Burger & Fries', 'Americana', '13:00', '23:00'),
(35, 2, 'Vegan Delight', 'Vegana', '10:00', '20:00'),
(36, 4, 'Le Bistro', 'Francesa', '17:00', '22:00'),
(37, 10, 'Thai Palace', 'Tailandesa', '12:00', '22:00'),
(38, 3, 'Casa Mexicana', 'Mexicana', '12:00', '23:00'),
(39, 8, 'Pasta Fresca', 'Italiana', '11:00', '23:00'),
(40, 8, 'Sushi House', 'Japonesa', '10:00', '21:00'),
(41, 6, 'Spice & Curry', 'India', '12:00', '23:00'),
(42, 3, 'La Bodega', 'Espa ola', '14:00', '22:00'),
(43, 6, 'American Diner', 'Americana', '13:00', '23:00'),
(44, 10, 'Green Leaf', 'Vegana', '10:00', '20:00'),
(45, 4, 'Cafe Paris', 'Francesa', '17:00', '22:00'),
(46, 6, 'Thai Cuisine', 'Tailandesa', '12:00', '22:00'),
(47, 5, 'La Taqueria', 'Mexicana', '12:00', '23:00'),
(48, 3, 'Trattoria Italiana', 'Italiana', '11:00', '23:00'),
(49, 3, 'Sushi Express', 'Japonesa', '10:00', '21:00'),
(50, 5, 'Curry House', 'India', '12:00', '23:00');

INSERT INTO Reservacion_Restaurante(ID_Reservacion, ID_Restaurante, Descripcion, Precio, Estado) VALUES
(1, 17, 'Cena Rom ntica', 45000.00, 'Confirmada'),
(2, 8, 'Almuerzo de Negocios', 30000.00, 'Confirmada'),
(3, 25, 'Fiesta de Cumplea os', 200000.00, 'Cancelada'),
(4, 13, 'Cena Familiar', 80000.00, 'Confirmada'),
(5, 2, 'Despedida de Soltera', 150000.00, 'Confirmada'),
(6, 20, 'Cena de Gala', 120000.00, 'Confirmada'),
(7, 29, 'Aniversario', 70000.00, 'Confirmada'),
(8, 14, 'Desayuno Corporativo', 25000.00, 'Cancelada'),
(9, 3, 'Reuni n de Amigos', 50000.00, 'Confirmada'),
(10, 22, 'Almuerzo Familiar', 60000.00, 'Confirmada'),
(11, 5, 'Cena de Fin de A o', 180000.00, 'Confirmada'),
(12, 32, 'Comida R pida', 15000.00, 'Cancelada'),
(13, 10, 'Conferencia', 50000.00, 'Confirmada'),
(14, 27, 'Cena para Dos', 40000.00, 'Confirmada'),
(15, 11, 'Almuerzo Ejecutivo', 35000.00, 'Confirmada'),
(16, 24, 'Evento Especial', 250000.00, 'Confirmada'),
(17, 4, 'Reuni n de Trabajo', 90000.00, 'Confirmada'),
(18, 36, 'Desayuno de Trabajo', 30000.00, 'Confirmada'),
(19, 6, 'Cita Rom ntica', 60000.00, 'Cancelada'),
(20, 9, 'Cena Tem tica', 80000.00, 'Confirmada'),
(21, 23, 'Despedida de A o', 200000.00, 'Confirmada'),
(22, 18, 'Evento Corporativo', 200000.00, 'Confirmada'),
(23, 30, 'Fiesta Infantil', 100000.00, 'Confirmada'),
(24, 21, 'Cena Formal', 75000.00, 'Confirmada'),
(25, 12, 'Evento Cultural', 150000.00, 'Confirmada'),
(26, 16, 'Almuerzo de Reuni n', 40000.00, 'Cancelada'),
(27, 19, 'Cena Casual', 60000.00, 'Confirmada'),
(28, 35, 'Desayuno Formal', 20000.00, 'Confirmada'),
(29, 28, 'Cena Especial', 85000.00, 'Confirmada'),
(30, 7, 'Despedida de Amigo', 100000.00, 'Confirmada'),
(31, 31, 'Fiesta de Graduaci n', 250000.00, 'Confirmada'),
(32, 26, 'Brunch Dominical', 35000.00, 'Cancelada'),
(33, 40, 'Cena Buffet', 50000.00, 'Confirmada'),
(34, 15, 'Almuerzo Tem tico', 40000.00, 'Confirmada'),
(35, 34, 'Cena a la Carta', 60000.00, 'Confirmada'),
(36, 1, 'Evento de Caridad', 60000.00, 'Confirmada'),
(37, 45, 'Cena de Gala', 70000.00, 'Confirmada'),
(38, 46, 'Cena para Amigos', 60000.00, 'Confirmada'),
(39, 33, 'Desayuno Buffet', 30000.00, 'Cancelada'),
(40, 42, 'Almuerzo Empresarial', 50000.00, 'Confirmada'),
(41, 48, 'Cena con M sica', 45000.00, 'Confirmada'),
(42, 47, 'Almuerzo al Aire Libre', 60000.00, 'Confirmada'),
(43, 50, 'Cena de Navidad', 150000.00, 'Confirmada'),
(44, 49, 'Reuni n de Clase', 50000.00, 'Confirmada'),
(45, 37, 'Fiesta de Fin de Curso', 200000.00, 'Confirmada'),
(46, 41, 'Desayuno Ejecutivo', 50000.00, 'Cancelada'),
(47, 43, 'Almuerzo de Celebraci n', 60000.00, 'Confirmada'),
(48, 44, 'Cena Buffet Internacional', 50000.00, 'Confirmada'),
(49, 38, 'Almuerzo con Amigos', 40000.00, 'Confirmada'),
(50, 39, 'Cena de Fin de Semana', 100000.00, 'Confirmada');

INSERT INTO Servicio_Hotel (ID_Servicio, Nombre_Servicio) VALUES
(1, 'Servicio de Habitaci n'),
(2, 'Spa'),
(3, 'Gimnasio'),
(4, 'Desayuno Buffet'),
(5, 'WiFi'),
(6, 'Estacionamiento'),
(7, 'Lavander a'),
(8, 'Traslado al Aeropuerto'),
(9, 'Restaurante Gourmet'),
(10, 'Bar'),
(11, 'Piscina'),
(12, 'Sala de Conferencias'),
(13, 'Tours'),
(14, 'Actividades Infantiles'),
(15, 'Alquiler de Bicicletas'),
(16, 'Servicio de Canguro'),
(17, 'Peluquer a'),
(18, 'Minibar'),
(19, 'Sauna'),
(20, 'Jacuzzi'),
(21, 'Servicio de Despertador'),
(22, 'Guardaequipaje'),
(23, 'Caja Fuerte'),
(24, 'Catering'),
(25, 'Tienda de Regalos'),
(26, 'Restaurante'),
(27, 'Actividades Acu ticas'),
(28, 'Servicio de Fotograf a'),
(29, 'Servicio de Florister a'),
(30, 'Servicio M dico'),
(31, 'Servicio de Conserjer a'),
(32, 'Servicio de Traducci n'),
(33, 'Club Nocturno'),
(34, 'Transporte Privado'),
(35, 'Asistencia Tur stica'),
(36, 'Programa de Fidelidad'),
(37, 'Yoga y Meditaci n'),
(38, 'Pista de Tenis'),
(39, 'Golf'),
(40, 'Restaurante Vegetariano'),
(41, 'Piano Bar'),
(42, 'Excursiones de Pesca'),
(43, 'Clases de Cocina'),
(44, 'Servicio de Plancha'),
(45, 'Servicio de Traducci n'),
(46, 'Excursiones en Bote'),
(47, 'Programa de Ni eras'),
(48, 'Servicio de Excursiones'),
(49, 'Servicio de Banquetes'),
(50, 'Centro de Negocios');


INSERT INTO Registro_Servicio (ID_Registro, ID_Servicio, Estado) VALUES
(52, 18, 'Activo'),
(97, 6, 'Activo'),
(79, 14, 'Inactivo'),
(65, 5, 'Pendiente'),
(42, 3, 'Inactivo'),
(33, 4, 'Activo'),
(88, 7, 'Pendiente'),
(76, 2, 'Activo'),
(25, 12, 'Inactivo'),
(50, 1, 'Pendiente'),
(91, 16, 'Activo'),
(45, 10, 'Inactivo'),
(11, 13, 'Pendiente'),
(99, 20, 'Activo'),
(18, 8, 'Inactivo'),
(59, 19, 'Pendiente'),
(70, 9, 'Activo'),
(21, 15, 'Inactivo'),
(34, 11, 'Pendiente'),
(87, 17, 'Activo'),
(39, 6, 'Inactivo'),
(55, 3, 'Pendiente'),
(80, 14, 'Activo'),
(29, 12, 'Inactivo'),
(63, 4, 'Pendiente'),
(41, 8, 'Activo'),
(94, 7, 'Inactivo'),
(16, 11, 'Pendiente'),
(48, 19, 'Activo'),
(26, 5, 'Inactivo'),
(53, 18, 'Pendiente'),
(67, 2, 'Activo'),
(15, 20, 'Inactivo'),
(60, 17, 'Pendiente'),
(85, 10, 'Activo'),
(38, 13, 'Inactivo'),
(23, 1, 'Pendiente'),
(93, 9, 'Activo'),
(19, 14, 'Inactivo'),
(72, 3, 'Pendiente'),
(32, 11, 'Activo'),
(100, 6, 'Inactivo'),
(49, 12, 'Pendiente'),
(74, 2, 'Activo'),
(22, 8, 'Inactivo'),
(64, 4, 'Pendiente'),
(83, 5, 'Activo'),
(56, 17, 'Inactivo'),
(31, 16, 'Pendiente'),
(84, 7, 'Activo');

INSERT INTO Reservacion_Cliente (ID_Reservacion_Cliente, ID_Cliente, Fecha, Estado_de_Reservacion) VALUES
(1, 44, '1974-07-28', 'Cancelada'),
(2, 50, '1995-05-23', 'Cancelada'),
(3, 11, '2004-10-04', 'Cancelada'),
(4, 7, '2000-10-22', 'Confirmada'),
(5, 37, '1982-02-16', 'Pendiente'),
(6, 8, '1992-08-12', 'Pendiente'),
(7, 9, '1979-05-21', 'Confirmada'),
(8, 20, '2001-10-14', 'Cancelada'),
(9, 6, '2016-04-07', 'Confirmada'),
(10, 47, '1970-08-31', 'Cancelada'),
(11, 33, '1996-01-19', 'Pendiente'),
(12, 27, '2020-05-15', 'Pendiente'),
(13, 8, '2007-03-13', 'Confirmada'),
(14, 5, '2009-11-04', 'Pendiente'),
(15, 25, '2004-08-08', 'Cancelada'),
(16, 41, '2011-05-30', 'Confirmada'),
(17, 49, '2008-02-05', 'Pendiente'),
(18, 16, '1983-06-20', 'Cancelada'),
(19, 50, '1998-03-30', 'Confirmada'),
(20, 16, '2017-07-03', 'Pendiente'),
(21, 47, '2003-10-19', 'Confirmada'),
(22, 14, '1987-01-22', 'Pendiente'),
(23, 19, '1991-04-24', 'Confirmada'),
(24, 43, '1993-05-29', 'Pendiente'),
(25, 28, '2006-02-07', 'Confirmada'),
(26, 47, '1997-11-11', 'Cancelada'),
(27, 38, '1997-02-24', 'Pendiente'),
(28, 10, '1975-12-29', 'Confirmada'),
(29, 29, '1984-09-17', 'Pendiente'),
(30, 33, '2005-08-28', 'Cancelada'),
(31, 7, '1990-03-02', 'Confirmada'),
(32, 26, '1978-07-24', 'Pendiente'),
(33, 5, '1988-06-01', 'Confirmada'),
(34, 50, '1994-12-21', 'Pendiente'),
(35, 3, '2012-03-27', 'Confirmada'),
(36, 5, '1999-07-12', 'Pendiente'),
(37, 34, '1977-10-06', 'Cancelada'),
(38, 7, '1986-11-15', 'Confirmada'),
(39, 12, '1980-05-08', 'Pendiente'),
(40, 33, '1994-04-14', 'Pendiente'),
(41, 24, '1973-09-20', 'Cancelada'),
(42, 15, '2019-08-08', 'Confirmada'),
(43, 36, '2000-03-11', 'Pendiente'),
(44, 6, '1985-01-04', 'Confirmada'),
(45, 29, '1993-09-09', 'Cancelada'),
(46, 21, '1971-02-25', 'Confirmada'),
(47, 13, '2000-06-06', 'Pendiente'),
(48, 39, '2024-10-28', 'Confirmada'),
(49, 32, '2006-06-06', 'Confirmada'),
(50, 46, '2024-08-26', 'Confirmada');

INSERT INTO Reservacion_Cliente (ID_Reservacion_Cliente, ID_Cliente, Fecha, Estado_de_Reservacion) VALUES
(1, 44, '1974-07-28', 'Cancelada'),
(2, 5, '1995-05-23', 'Cancelada'),
(3, 7, '2004-10-04', 'Cancelada'),
(4, 9, '2000-10-22', 'Confirmada'),
(5, 37, '1982-02-16', 'Pendiente'),
(6, 13, '1992-08-12', 'Pendiente'),
(7, 50, '1979-05-21', 'Confirmada'),
(8, 20, '2001-10-14', 'Cancelada'),
(9, 33, '2016-04-07', 'Confirmada'),
(10, 17, '1970-08-31', 'Cancelada'),
(11, 33, '1996-01-19', 'Pendiente'),
(12, 27, '2020-05-15', 'Pendiente'),
(13, 28, '2007-03-13', 'Confirmada'),
(14, 25, '2009-11-04', 'Pendiente'),
(15, 25, '2004-08-08', 'Cancelada'),
(16, 41, '2011-05-30', 'Confirmada'),
(17, 49, '2008-02-05', 'Pendiente'),
(18, 19, '1983-06-20', 'Cancelada'),
(19, 25, '1998-03-30', 'Confirmada'),
(20, 16, '2017-07-03', 'Pendiente'),
(21, 47, '2003-10-19', 'Confirmada'),
(22, 14, '1987-01-22', 'Pendiente'),
(23, 1, '1991-04-24', 'Confirmada'),
(24, 43, '1993-05-29', 'Pendiente'),
(25, 39, '2006-02-07', 'Confirmada'),
(26, 7, '1997-11-11', 'Cancelada'),
(27, 38, '1997-02-24', 'Pendiente'),
(28, 10, '1975-12-29', 'Confirmada'),
(29, 5, '1984-09-17', 'Pendiente'),
(30, 26, '2005-08-28', 'Cancelada'),
(31, 47, '1990-03-02', 'Confirmada'),
(32, 9, '1978-07-24', 'Pendiente'),
(33, 8, '1988-06-01', 'Confirmada'),
(34, 50, '1994-12-21', 'Pendiente'),
(35, 25, '2012-03-27', 'Confirmada'),
(36, 35, '1999-07-12', 'Pendiente'),
(37, 34, '1977-10-06', 'Cancelada'),
(38, 8, '1986-11-15', 'Confirmada'),
(39, 12, '1980-05-08', 'Pendiente'),
(40, 50, '1994-04-14', 'Pendiente'),
(41, 24, '1973-09-20', 'Cancelada'),
(42, 15, '2019-08-08', 'Confirmada'),
(43, 8, '2000-03-11', 'Pendiente'),
(44, 46, '1985-01-04', 'Confirmada'),
(45, 29, '1993-09-09', 'Cancelada'),
(46, 21, '1971-02-25', 'Confirmada'),
(47, 13, '2000-06-06', 'Pendiente'),
(48, 39, '2024-10-28', 'Confirmada'),
(49, 32, '2006-06-06', 'Confirmada'),
(50, 46, '2024-08-26', 'Confirmada');

INSERT INTO Check_In (ID_Check_In, ID_Reservacion_Cliente, Fecha, Hora) VALUES
(1, 1, '1990-06-08', '07:09:10'),
(2, 2, '1981-06-10', '10:25:55'),
(3, 3, '2002-02-01', '20:46:03'),
(4, 4, '1990-06-29', '00:07:00'),
(5, 5, '2007-02-19', '03:50:51'),
(6, 6, '1993-02-14', '20:14:39'),
(7, 7, '1993-09-15', '19:59:21'),
(8, 8, '1998-04-03', '12:12:18'),
(9, 9, '2008-08-05', '03:35:51'),
(10, 10, '1995-11-08', '00:51:53'),
(11, 11, '1989-10-01', '02:18:16'),
(12, 12, '2016-12-28', '22:21:33'),
(13, 13, '2021-01-10', '15:22:50'),
(14, 14, '1991-11-26', '20:08:46'),
(15, 15, '1980-01-28', '03:49:09'),
(16, 16, '2008-11-06', '17:47:22'),
(17, 17, '1976-09-09', '23:42:58'),
(18, 18, '1992-11-25', '13:55:55'),
(19, 19, '1979-08-05', '09:25:50'),
(20, 20, '1972-02-04', '09:14:53'),
(21, 21, '1996-03-21', '21:22:44'),
(22, 22, '2003-06-24', '19:27:37'),
(23, 23, '2004-08-15', '20:37:45'),
(24, 24, '2014-04-11', '06:10:59'),
(25, 25, '1994-12-31', '18:57:34'),
(26, 26, '1995-10-29', '05:50:20'),
(27, 27, '1988-06-17', '07:32:56'),
(28, 28, '2024-01-22', '12:11:04'),
(29, 29, '1982-04-08', '07:37:08'),
(30, 30, '1991-03-06', '06:57:20'),
(31, 31, '2009-08-04', '19:32:32'),
(32, 32, '2011-02-27', '15:12:54'),
(33, 33, '2024-02-05', '22:44:01'),
(34, 34, '1993-10-15', '05:27:40'),
(35, 35, '2001-04-29', '17:50:16'),
(36, 36, '1979-05-30', '03:58:09'),
(37, 37, '1990-07-05', '20:35:53'),
(38, 38, '1980-08-23', '03:14:30'),
(39, 39, '2020-04-10', '22:45:38'),
(40, 40, '2018-03-18', '20:15:29'),
(41, 41, '1971-10-05', '21:54:12'),
(42, 42, '2012-08-11', '20:12:33'),
(43, 43, '1972-09-02', '17:50:32'),
(44, 44, '1988-03-10', '21:10:17'),
(45, 45, '1982-01-09', '12:07:28'),
(46, 46, '1989-08-10', '04:06:16'),
(47, 47, '2022-12-11', '23:39:23'),
(48, 48, '1987-01-01', '06:37:56'),
(49, 49, '1972-09-09', '16:43:50'),
(50, 50, '2005-07-17', '11:38:15');


INSERT INTO Check_Out (ID_Check_Out, ID_Reservacion_Cliente, Fecha, Hora) VALUES
(1, 1, '2004-12-26', '18:09:14'),
(2, 2, '1988-02-05', '14:54:10'),
(3, 3, '2023-12-19', '18:52:35'),
(4, 4, '2002-08-04', '17:31:49'),
(5, 5, '2008-11-20', '08:34:54'),
(6, 6, '2007-02-09', '02:21:46'),
(7, 7, '1977-09-06', '22:26:21'),
(8, 8, '1985-05-04', '23:53:12'),
(9, 9, '1979-04-18', '20:01:36'),
(10, 10, '1982-10-17', '19:02:51'),
(11, 11, '1986-06-27', '01:56:16'),
(12, 12, '2022-02-27', '18:06:18'),
(13, 13, '2017-03-29', '12:43:00'),
(14, 14, '1992-09-18', '16:21:34'),
(15, 15, '2016-12-25', '05:16:30'),
(16, 16, '1972-03-06', '08:44:37'),
(17, 17, '1977-10-05', '10:39:20'),
(18, 18, '1984-06-01', '19:30:48'),
(19, 19, '2006-09-24', '23:18:04'),
(20, 20, '2012-12-10', '02:49:00'),
(21, 21, '1985-02-21', '04:39:10'),
(22, 22, '1980-06-25', '07:38:32'),
(23, 23, '1975-09-05', '12:25:55'),
(24, 24, '2011-03-11', '13:48:14'),
(25, 25, '1972-05-30', '21:45:37'),
(26, 26, '1995-12-30', '20:34:53'),
(27, 27, '2018-04-11', '18:07:29'),
(28, 28, '2004-09-24', '04:56:40'),
(29, 29, '2007-11-06', '16:23:03'),
(30, 30, '1997-11-01', '13:40:47'),
(31, 31, '2002-06-02', '09:14:22'),
(32, 32, '1991-12-05', '11:58:06'),
(33, 33, '2004-11-10', '22:51:37'),
(34, 34, '2016-10-29', '04:32:18'),
(35, 35, '1996-04-14', '06:14:35'),
(36, 36, '2018-07-21', '15:32:09'),
(37, 37, '1989-05-15', '01:18:22'),
(38, 38, '1983-08-04', '03:19:00'),
(39, 39, '2015-09-03', '14:16:19'),
(40, 40, '2008-06-11', '12:12:15'),
(41, 41, '2011-02-21', '17:00:03'),
(42, 42, '1980-01-12', '10:52:11'),
(43, 43, '2002-04-16', '05:30:28'),
(44, 44, '2010-03-14', '22:34:20'),
(45, 45, '1998-01-18', '00:53:11'),
(46, 46, '1994-02-20', '02:11:45'),
(47, 47, '2024-07-08', '21:11:33'),
(48, 48, '1981-08-02', '18:45:20'),
(49, 49, '1982-06-01', '22:53:30'),
(50, 50, '1981-01-21', '11:19:49');

INSERT INTO Pago (ID_Pago, ID_Reservacion_Cliente, Monto, Fecha_De_Pago, Metodo_De_Pago ) VALUES
(1, 1, 150.00, '2024-01-15', 'Tarjeta de Cr dito'),
(2, 2, 200.00, '2024-02-10', 'Efectivo'),
(3, 3, 250.00, '2024-03-05', 'Tarjeta de D bito'),
(4, 4, 300.00, '2024-04-20', 'Transferencia Bancaria'),
(5, 5, 350.00, '2024-05-25', 'Tarjeta de Cr dito'),
(6, 6, 400.00, '2024-06-15', 'Efectivo'),
(7, 7, 450.00, '2024-07-10', 'Tarjeta de D bito'),
(8, 8, 500.00, '2024-08-05', 'Transferencia Bancaria'),
(9, 9, 550.00, '2024-09-20', 'Tarjeta de Cr dito'),
(10, 10, 600.00, '2024-10-25', 'Efectivo'),
(11, 11, 650.00, '2024-11-15', 'Tarjeta de D bito'),
(12, 12, 700.00, '2024-12-10', 'Transferencia Bancaria'),
(13, 13, 750.00, '2025-01-05', 'Tarjeta de Cr dito'),
(14, 14, 800.00, '2025-02-20', 'Efectivo'),
(15, 15, 850.00, '2025-03-25', 'Tarjeta de D bito'),
(16, 16, 900.00, '2025-04-15', 'Transferencia Bancaria'),
(17, 17, 950.00, '2025-05-10', 'Tarjeta de Cr dito'),
(18, 18, 1000.00, '2025-06-05', 'Efectivo'),
(19, 19, 1050.00, '2025-07-20', 'Tarjeta de D bito'),
(20, 20, 1100.00, '2025-08-25', 'Transferencia Bancaria'),
(21, 21, 1150.00, '2025-09-15', 'Tarjeta de Cr dito'),
(22, 22, 1200.00, '2025-10-10', 'Efectivo'),
(23, 23, 1250.00, '2025-11-05', 'Tarjeta de D bito'),
(24, 24, 1300.00, '2025-12-20', 'Transferencia Bancaria'),
(25, 25, 1350.00, '2026-01-25', 'Tarjeta de Cr dito'),
(26, 26, 1400.00, '2026-02-15', 'Efectivo'),
(27, 27, 1450.00, '2026-03-10', 'Tarjeta de D bito'),
(28, 28, 1500.00, '2026-04-05', 'Transferencia Bancaria'),
(29, 29, 1550.00, '2026-05-20', 'Tarjeta de Cr dito'),
(30, 30, 1600.00, '2026-06-25', 'Efectivo'),
(31, 31, 1650.00, '2026-07-15', 'Tarjeta de D bito'),
(32, 32, 1700.00, '2026-08-10', 'Transferencia Bancaria'),
(33, 33, 1750.00, '2026-09-05', 'Tarjeta de Cr dito'),
(34, 34, 1800.00, '2026-10-20', 'Efectivo'),
(35, 35, 1850.00, '2026-11-25', 'Tarjeta de D bito'),
(36, 36, 1900.00, '2026-12-15', 'Transferencia Bancaria'),
(37, 37, 1950.00, '2027-01-10', 'Tarjeta de Cr dito'),
(38, 38, 2000.00, '2027-02-05', 'Efectivo'),
(39, 39, 2050.00, '2027-03-20', 'Tarjeta de D bito'),
(40, 40, 2100.00, '2027-04-25', 'Transferencia Bancaria'),
(41, 41, 2150.00, '2027-05-15', 'Tarjeta de Cr dito'),
(42, 42, 2200.00, '2027-06-10', 'Efectivo'),
(43, 43, 2250.00, '2027-07-05', 'Tarjeta de D bito'),
(44, 44, 2300.00, '2027-08-20', 'Transferencia Bancaria'),
(45, 45, 2350.00, '2027-09-25', 'Tarjeta de Cr dito'),
(46, 46, 2400.00, '2027-10-15', 'Efectivo'),
(47, 47, 2450.00, '2027-11-10', 'Tarjeta de D bito'),
(48, 48, 2500.00, '2027-12-05', 'Transferencia Bancaria'),
(49, 49, 2550.00, '2028-01-20', 'Tarjeta de Cr dito'),
(50, 50, 2600.00, '2028-02-25', 'Efectivo');



SELECT * FROM Cliente_Habitacion


---- 1. Procedimiento para obtener todos los hoteles


CREATE PROCEDURE ObtenerHoteles
AS
BEGIN
    SELECT * FROM Hotel
END
GO
-- Ejecuci n del procedimiento para obtener todos los hoteles
EXEC ObtenerHoteles;


---- 2. Procedimiento para ver solo los hoteles que hay en Peru y si no manda una alerta de que no existe el hotel

CREATE PROCEDURE VerHotelesEnPeru
AS
BEGIN
--- se comprueba que existan filas con la condicion
    IF EXISTS (SELECT 1 FROM Hotel WHERE Pais = 'Per ')
    BEGIN
        SELECT *
        FROM Hotel
        WHERE Pais = 'Per ';
    END
--- Si la condicion no se cumple, devuelve una alerta
    ELSE
    BEGIN
        PRINT 'No hay hoteles en Per ';
    END
END;
GO
--- Ejecucion del procediemiento
EXEC VerHotelesEnPeru;
GO

---- 3. Clientes con mas de un telefono

CREATE PROCEDURE VerClientesConMasDeUnTelefono
AS
BEGIN
    SELECT 
        c.ID_Cliente, 
        c.Nombre, 
        c.Apellido1, 
        COUNT(t.Telefono) AS CantidadTelefonos
    FROM 
        Cliente_Hotel c
--- Inner Join se utiliza para combinar las tablas Cliente_Hotel y Cliente_Telefono usando la columna ID_Cliente que esta en ambas tablas 
    INNER JOIN 
        Cliente_Telefono t ON c.ID_Cliente = t.ID_Cliente
    GROUP BY 
        c.ID_Cliente, c.Nombre, c.Apellido1
--- Filtra los grupos de clientes que tienen m s de un n mero de tel fono
    HAVING 
        COUNT(t.Telefono) > 1;
END;
GO
--- Ejecucion del procedimiento 

EXEC VerClientesConMasDeUnTelefono;
GO

---- 4. Procediemiento almacenado para ver cuantas suites hay 

CREATE PROCEDURE ContarSuites
AS
BEGIN
-- Contar las habitaciones que son suites
    SELECT COUNT(*) AS CantidadDeSuites
    FROM Habitacion_Hotel
    WHERE Tipo_de_Habitacion = 'Suite';
END;
GO
--- Ejecucion 
EXEC ContarSuites
GO

---- 5. Procedimiento para obtener datos de un cliente por ID

CREATE PROCEDURE ObtenerClientePorID
--- Parametro que recibe un valor entero
    @IdCliente INT
AS
BEGIN
    SELECT ID_Cliente, Nombre, Apellido1, Telefono, Pais, Ciudad
    FROM Cliente_Hotel
    WHERE ID_Cliente = @IdCliente;
END;
GO
--- Ejecucion 
EXEC ObtenerClientePorID @IdCliente = 2;

---- 6. Procedimiento para obtener los clientes de un pais

CREATE PROCEDURE ObtenerPais
    @Pais VARCHAR(30)
AS
BEGIN
    SELECT *
    FROM Cliente_Hotel
    WHERE Pais = @Pais;
END;
GO
--- Ejecucion
EXEC ObtenerPais @Pais = 'M xico';
GO

---- 7. Procedimiento para obtener datos de clientes por ciudad
GO 
CREATE PROCEDURE ObtenerClientesPorCiudad
---  Par metro que recibe un valor de tipo una cadena de caracteres
    @Ciudad VARCHAR(50)
AS
BEGIN
    SELECT *
    FROM Cliente_Hotel
    WHERE Ciudad = @Ciudad;
END;
GO
--- Ejecucion
EXEC ObtenerClientesPorCiudad @Ciudad = 'Montevideo';

---- 8. Procedimiento para contar clientes por pais 

CREATE PROCEDURE ContarClientesPorPais
AS
BEGIN
    SELECT Pais, COUNT(*) AS CantidadClientes
    FROM Cliente_Hotel
    GROUP BY Pais;
END;
GO
--- Ejecucion
EXEC ContarClientesPorPais;

---- 9. Procedimiento para ver reservaciones canceladas

CREATE PROCEDURE CantidadReservacionesCanceladas
AS
BEGIN
--- Cuenta el n mero total de registros en la tabla Reservacion_Cliente donde el estado de la reservaci n es "Cancelada
    SELECT COUNT(*) AS CantidadCanceladas
    FROM Reservacion_Cliente
    WHERE Estado_de_Reservacion = 'Cancelada';
END;
GO
--- Ejecucion
EXEC CantidadReservacionesCanceladas;

---- 10. Procedimiento para ver reservaciones en una a o

CREATE PROCEDURE ObtenerReservacionesPorA o
    @A o INT
AS
BEGIN
    SELECT *
    FROM Check_Out
--- La funcion extrae el a o de la fecha de la tabla check- out y lo compara con el a o que se ingresa 
    WHERE YEAR(Fecha) = @A o;
END;
GO
--- Ejecucion
EXEC ObtenerReservacionesPorA o @A o = 2024;

---------- Funciones 

----  Las funciones en SQL Server permiten realizar tareas espec ficas de manera eficiente y reutilizable

----1. Funci n para obtener el nombre completo de un cliente por ID


CREATE FUNCTION ObtenerNombreCompletoCliente
(
    @IdCliente INT
)
RETURNS VARCHAR(100)
AS
BEGIN
--- La variable @NombreCompleto almacena el nombre completo del cliente 
    DECLARE @NombreCompleto VARCHAR(100);
    SELECT @NombreCompleto = Nombre + ' ' + Apellido1
    FROM Cliente_Hotel
    WHERE ID_Cliente = @IdCliente;

    RETURN @NombreCompleto;
END;
GO
--- Ejecucion
SELECT dbo.ObtenerNombreCompletoCliente (9) AS NombreCompleto;

---2. Funcion para ver el numero de funciones confirmadas

CREATE FUNCTION ContarReservacionesConfirmadas()
--- La funcion devuelve un numero entero
RETURNS INT
AS
BEGIN
--- Variable almacena el numero de reservaciones confrimadas
    DECLARE @CantidadConfirmadas INT;
--- Devuelve el numero toal de registros en la tabla donde el estado es confirmado
    SELECT @CantidadConfirmadas = COUNT(*)
    FROM Reservacion_Cliente
    WHERE Estado_de_Reservacion = 'Confirmada';

    RETURN @CantidadConfirmadas;
END;
GO
--- Ejecucion
SELECT dbo.ContarReservacionesConfirmadas() AS TotalConfirmadas;

---3. Funcion para ver la ciudad del cliente

CREATE FUNCTION ObtenerCiudadCliente
(
    @IdCliente INT
)
RETURNS VARCHAR(50)
AS
BEGIN
    DECLARE @Ciudad VARCHAR(50);

    SELECT @Ciudad = Ciudad
    FROM Cliente_Hotel
    WHERE ID_Cliente = @IdCliente;

    RETURN @Ciudad;
END;
GO
--- Ejecucion
SELECT dbo.ObtenerCiudadCliente(38) AS Ciudad;

----4. Funcion para ver los pagos en efectivo 
GO
CREATE FUNCTION ContarPagosEnEfectivo()
RETURNS INT
AS
BEGIN
    DEClARE @CantidadPagosEnEfectivo INT;
--- Cuenta el n mero total de registros en la tabla Pago donde el m todo de pago es "Efectivo" 
    SELECT @CantidadPagosEnEfectivo = COUNT(*)
    FROM Pago
    WHERE Metodo_De_Pago = 'Efectivo';

    RETURN @CantidadPagosEnEfectivo;
END;
GO
--- Ejecucion
SELECT dbo.ContarPagosEnEfectivo() AS Efectivo;

----5. Funcion para ver reservacion confirmadas en el restautante 

CREATE FUNCTION ContarReservacionesRestauranteConfirmadas()
RETURNS INT
AS
BEGIN
    DECLARE @CantidadConfirmadas INT;

    SELECT @CantidadConfirmadas = COUNT(*)
    FROM Reservacion_Restaurante
    WHERE Estado = 'Confirmada';

    RETURN @CantidadConfirmadas;
END;
GO
--- Ejecucion
SELECT dbo.ContarReservacionesRestauranteConfirmadas() AS Confirmada;


---- Vistas


---  1. Vista para obtener un resumen de las reservaciones de clientes obtenidas de varias tablas, incluyen el nombre del cliente, el hotel, la habitaci n y el estado de la reservaci n.

CREATE VIEW VistaReservaciones
AS
--- tablas que se agregan a la vista
SELECT 
    rc.ID_Reservacion_Cliente, --- identificador unico
    cl.Nombre AS NombreCliente,
    ht.Nombre AS NombreHotel,
    rc.Fecha AS FechaReservacion,
    rc.Estado_de_Reservacion
FROM 
    Reservacion_Cliente rc
--- Une la tabla Reservacion_Cliente con Cliente_Hotel usando la columna ID_Cliente
INNER JOIN 
    Cliente_Hotel cl ON rc.ID_Cliente = cl.ID_Cliente
--- Une la tabla Cliente_Habitacion on Reservacion_Cliente usando ID_Cliente
INNER JOIN 
    Cliente_Habitacion ch ON rc.ID_Cliente = ch.ID_Cliente
--- Obtiene informacion del numero de habitacion
INNER JOIN 
    Habitacion_Hotel hh ON ch.Num_Habitacion = hh.Num_Habitacion
INNER JOIN 
    Hotel ht ON hh.ID_Hotel = ht.ID_Hotel; 
GO

--- Ejecucion 
SELECT * FROM VistaReservaciones;

--- Vista de suministros pedidos 
---	Vista del resumen de los suministros y los pedidos realizados para cada hotel.

CREATE VIEW VistaSuministrosPedidos
AS

SELECT 
    h.Nombre AS NombreHotel,--- Selecciona el nombre del hotel 
    s.Descripcion AS Suministro, --- selecciona la descripcion del suministro en la tabla suministro
    ps.Cantidad,
    ps.Fecha_Pedido,
    ps.Fecha_Recepcion
FROM 
    Suministro s --- Selecciona los datos de la tabla suministro
--- Union entre la tabla suministro y la tabla pedido suministro
INNER JOIN 
    Pedido_Suministro ps ON s.ID_Suministro = ps.ID_Suministro
--- Uni n  entre la tabla Pedido_Suministro  y la tabla Pedido_Hotel
INNER JOIN 
    Pedido_Hotel ph ON ps.ID_Pedido = ph.ID_Pedido
--- Uni n  entre la tabla Pedido_Hotel  y la tabla Hotel 
INNER JOIN 
    Hotel h ON ph.ID_Hotel = h.ID_Hotel;
GO

--- Ejecucion
SELECT * FROM VistaSuministrosPedidos;

---- 3. Vista para ver los restaurantes de cada hotel

CREATE VIEW VistaRestauranteHotel
AS
--- tablas que se agregan a la vista
SELECT 
    rh.ID_Restaurante, --- identificador unico
    rh.Nombre AS Nombre,
    rh.TipoDeComida AS TipoDeComida,
    rh.Hora_Apertura AS HoraApertura,
	rh.Hora_Cierre AS HoraCierre
    
FROM 
    Restaurante_Hotel rh

INNER JOIN 
    Hotel ht ON rh.ID_Hotel = ht.ID_Hotel; ----- Uni n entre Restaurante_Hotel y Hotel  basada en el ID del hotel
GO

--- Ejecucion
SELECT * FROM VistaRestauranteHotel;

--- 4. Vista para ver las reservaciones de los Restaurantes 

CREATE VIEW VistaReservacionRestaurante
AS
--- tablas que se agregan a la vista
SELECT 
    rr.ID_Reservacion, --- identificador unico
    rr.Descripcion AS Descripcion,
	rr.Precio AS Precio,
	rr.Estado AS Estado,
	rh.Nombre AS NombreRestaurante,
	rh.TipoDeComida AS TipoDeComida
    
FROM 
    Reservacion_Restaurante rr

INNER JOIN 
    Restaurante_Hotel rh ON rr.ID_Restaurante = rh.ID_Restaurante;

GO
--- Ejecucion
SELECT * FROM VistaReservacionRestaurante;

-- 5. Vista para ver las habitaciones de los hotel

CREATE VIEW VistaHabitacionesHotel
AS

SELECT 
    h.Nombre AS NombreHotel,  
    hh.Num_Habitacion, 
    hh.Tipo_de_Habitacion AS TipoHabitacion,  
    hh.Precio_por_Noche,  
    h.Ciudad,  
    h.Pais 
FROM 
    Habitacion_Hotel hh  
INNER JOIN 
    Hotel h ON hh.ID_Hotel = h.ID_Hotel;
GO

--- Ejecuci n

SELECT * FROM VistaHabitacionesHotel


--- Triggers 

--- Ayudan a automatizar y reforzar reglas dentro de la base de datos, manteniendo la consistencia y la integridad de los datos sin intervenci n manual.


---1. Trigger que audita cada insercion en la tabla Pago, se ejecutar  autom ticamente despu s de cada operaci n de inserci n en la tabla pagos

CREATE TRIGGER trg_Pagos_Insert
ON Pago
AFTER INSERT
AS
BEGIN
    SET NOCOUNT ON;

    INSERT INTO PagosAudit (ID_Pago, Monto, Fecha_De_Pago, Metodo_De_Pago, AuditAction) --- accion de insercion de las filas en  la tabla PagosAudit
    SELECT i.ID_Pago, i.Monto, i.Fecha_De_Pago, i.Metodo_De_Pago, 'INSERT'
    FROM inserted i;
END;

--- Insercion de los datos en la tabla pago 
INSERT INTO Pago (ID_Pago, ID_Reservacion_Cliente, Monto, Fecha_De_Pago, Metodo_De_Pago) 
VALUES (51, 1, 2700.00, '2028-03-01', 'Tarjeta de Cr dito');

--- Consulta 
SELECT * FROM PagosAudit WHERE ID_Pago = 51

--- 2. Trigger que audita cada insercion en la tabla Reservaciones 

CREATE TRIGGER trg_ReservacionCliente_Insert
ON Reservacion_Cliente
AFTER INSERT
AS
BEGIN
    SET NOCOUNT ON;

    INSERT INTO ReservacionAudit (ID_Reservacion_Cliente, ID_Cliente, Fecha, Estado_de_Reservacion, AuditAction, AuditTimestamp)
    SELECT i.ID_Reservacion_Cliente, i.ID_Cliente, i.Fecha, i.Estado_de_Reservacion, 'INSERT', GETDATE()
    FROM inserted i;
END;

---- Insercion de valores en la tabla

INSERT INTO Reservacion_Cliente (ID_Reservacion_Cliente, ID_Cliente, Fecha, Estado_de_Reservacion)
VALUES
(53,18, '2024-08-19', 'Confirmada')

--- Consulta 

SELECT * FROM ReservacionAudit WHERE ID_Reservacion_Cliente = 53

--- 3. 

CREATE TRIGGER trg_Hotel_Insert
ON Hotel
AFTER INSERT
AS
BEGIN
    SET NOCOUNT ON;

    INSERT INTO HotelAudit (ID_Hotel, Nombre, Ciudad, Pais, Telefono, Cantidad_Estrellas, AuditAction, AuditTimestamp)
    SELECT i.ID_Hotel, i.Nombre, i.Ciudad, i.Pais, i.Telefono, i.Cantidad_Estrellas, 'INSERT', GETDATE()
    FROM inserted i;
END;

---- Insercion de valores en la tabla
INSERT INTO Hotel (ID_Hotel, Nombre, Ciudad, Pais, Telefono, Cantidad_Estrellas)
VALUES (51, 'Hotel Fiesta', 'Puntarenas', 'Costa Rica', '72569875', 3);

--- Consulta 
SELECT * FROM HotelAudit WHERE ID_Hotel = 51;




-- Eliminar las columnas de tel fono de las tablas Hotel y Cliente_Hotel
ALTER TABLE Hotel DROP COLUMN Telefono;
ALTER TABLE Cliente_Hotel DROP COLUMN Telefono;

-- Crear la nueva tabla RegistroEstancia
CREATE TABLE RegistroEstancia (
    ID_Registro INT PRIMARY KEY NOT NULL,
    ID_Reserva INT NOT NULL,
    ID_Cliente INT NOT NULL,
    Fecha_CheckIn DATE NOT NULL,
    Fecha_CheckOut DATE NOT NULL,
    ID_Habitacion INT NOT NULL,
    Estado VARCHAR(50) NOT NULL,
    FOREIGN KEY (ID_Cliente) REFERENCES Cliente_Hotel(ID_Cliente),
    FOREIGN KEY (ID_Habitacion) REFERENCES Habitacion_Hotel(Num_Habitacion)
);

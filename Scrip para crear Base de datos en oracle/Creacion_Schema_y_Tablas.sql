DROP SCHEMA BASEDEDATOS_HOTEL;

CREATE DATABASE BASEDEDATOS_HOTEL;


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
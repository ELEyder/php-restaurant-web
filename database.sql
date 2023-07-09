drop database if exists tr;
create database tr;
use tr;


CREATE TABLE `clientes` (
  `ClienteID` smallint(5) auto_increment primary key,
  `Nombres` varchar(50) NOT NULL,
  `Apellidos` varchar(50) NOT NULL,
  `Usuario` varchar(100) NOT NULL,
  `Clave` varchar(100) NOT NULL,
  `Correo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `platos` (
  `PlatoID` smallint(5) UNSIGNED NOT NULL,
  `Plato` varchar(50) NOT NULL,
  `Precio` decimal(12,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

insert into platos(PlatoID,Plato,Precio) VALUES
('1','Arroz con Pollo',10.50),
('2','Lomo Saltado',10.00),
('3','Ají de Gallina',10.00),
('4','Asado con Puré y Arroz',10.00),
('5','Tallarines Rojos',10.00),
('6','Pollo al Horno',10.00),
('7','Sudado de Pescado',10.00),
('8','Arroz a la Cubana',10.00),
('9','Tallarines con Champiñones',10.00),
('10','Ceviche Peruano',10.00);

CREATE TABLE `pedidos` ( 
  `PedidoID` smallint(5) auto_increment primary key,
  `Nombres` varchar(50) NOT NULL,
  `Apellidos` varchar(50) NOT NULL,
  `Usuario` varchar(100) NOT NULL,
  `Correo` varchar(255) NOT NULL,
  `Direccion` varchar(255) NOT NULL,
  `Plato` varchar(10) NOT NULL,
  `Cantidad` int NOT NULL,
  `Pagar` decimal(12,2) NOT NULL default 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

insert into clientes(Nombres,Apellidos,Usuario,Clave,Correo) values('admin','admin','admin','admin','admin@admin.com'),
('Marcos','Villanueva','marco','123456','marco@gmail.com');
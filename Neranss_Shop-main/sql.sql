create table usuario (
    id_Usuario int not null AUTO_INCREMENT,
    nombre text, 
    apellido text, 
    dni text, 
    telefono text, 
    correo text, 
    usuario text, 
    contrasena text,
    PRIMARY KEY (`id_Usuario`)
);

create table `detalleventa` (
    `ID` int not null AUTO_INCREMENT, 
    `IDVENTA` text, 
    `IDPRODUCTO` text, 
    `PRECIOUNITARIO` text, 
    `CANTIDAD` text, 
    `DESCARGADO` text,
    PRIMARY KEY (`ID`)
);

create table `ventas` (
    `ID` int not null AUTO_INCREMENT, 
    `ClaveTransaccion` text, 
    `PaypalDatos` text, 
    `Fecha` text, 
    `Correo` text, 
    `Total` text, 
    `status` text,
    PRIMARY KEY (`ID`)
);

create table productos(
id int not null AUTO_INCREMENT,
nombre text,
precio text,
descripcion text,
imagen text,
primary key(id)
)



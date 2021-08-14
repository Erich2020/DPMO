create database miscabar;
use miscabar;
Create Table departamento (id int not null primary key, nombre varchar(45));
Create Table proveedor(id int not null primary key,nombre varchar(45));
Create Table marca (id int not null primary key, nombre varchar(45));
create table producto(id varchar (20) not null primary key, descripcion varchar (300), costo decimal (8,2), precio  decimal (8,2), mayoreo decimal (8,2), fechaCreacion varchar (11), fechaModificacion varchar(11), fk_idDepartamento int not null , fk_idProveedor  int not null, fk_idMarca int not null, fk_presentacionProducto int not null,
Constraint fk_idDepartamento foreign key (fk_idDepartamento) references departamento(id),
constraint fk_idProveedor foreign key (fk_idProveedor) references proveedor(id),
constraint fk_idMarca foreign key (fk_idMarca) references marca(id)
);
Create Table usuario(id int not null primary key, username varchar (20), contrasena varchar (25), tipoUsuario varchar (40));
insert into usuario values(1,'admin','admin', 'administrador');
insert into departamento values (1, 'Sin Departamento' );
insert into proveedor values (1, 'Sin Proveedor');
insert into marca values (1, 'Sin Marca');


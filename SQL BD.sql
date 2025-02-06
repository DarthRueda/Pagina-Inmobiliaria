CREATE DATABASE ProyectoInmueble;
USE ProyectoInmueble;


CREATE TABLE inmobiliaria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    telefono VARCHAR(20) not null,
    correo VARCHAR(255) NOT NULL,
    descripion varchar(255)
);

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    password VARCHAR(255) NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    apellidos VARCHAR(255),
    telefono VARCHAR(20),
    correo VARCHAR(255) UNIQUE NOT NULL
);

CREATE TABLE viviendas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NULL,
    id_inmobiliaria INT NULL,
    precio INT NOT NULL,
    localizacion VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ,
    FOREIGN KEY (id_inmobiliaria) REFERENCES inmobiliaria(id)
);

CREATE TABLE fotos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_vivienda INT NOT NULL,
    foto VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_vivienda)
        REFERENCES viviendas (id)
);

CREATE TABLE filtros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL
);

CREATE TABLE vivienda_filtros (
    id_vivienda INT NOT NULL,
    id_filtro INT NOT NULL,
    PRIMARY KEY (id_vivienda, id_filtro),
    FOREIGN KEY (id_vivienda) REFERENCES viviendas(id),
    FOREIGN KEY (id_filtro) REFERENCES filtros(id)
);

CREATE TABLE me_gustas (
    id_usuario INT NOT NULL,
    id_vivienda INT NOT NULL,
    PRIMARY KEY (id_usuario, id_vivienda),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    FOREIGN KEY (id_vivienda) REFERENCES viviendas(id)
);

CREATE TABLE notificaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_vivienda INT NOT NULL,
    mensaje TEXT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_vivienda) REFERENCES viviendas(id) 
);

CREATE TABLE notificaciones_usuarios (
    id_notificacion INT NOT NULL,
    id_usuario INT NOT NULL,
    leida BOOLEAN DEFAULT FALSE,
    PRIMARY KEY (id_notificacion, id_usuario),
    FOREIGN KEY (id_notificacion) REFERENCES notificaciones(id),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);









CREATE DATABASE tienda;
USE tienda;

CREATE TABLE usuarios (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol VARCHAR(20) NOT NULL
);

CREATE TABLE categorias (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

CREATE TABLE productos (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    categoria_id INT(255) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio FLOAT(10,2) NOT NULL,
    stock INT(255) NOT NULL,
    oferta VARCHAR(2),
    fecha DATE,
    imagen VARCHAR(255),
    FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE CASCADE
);

CREATE TABLE pedidos (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT(255) NOT NULL,
    provincia VARCHAR(100) NOT NULL,
    localidad VARCHAR(100) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    coste FLOAT(10,2) NOT NULL,
    estado VARCHAR(20) NOT NULL,
    fecha DATE,
    hora TIME,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

CREATE TABLE lineas_pedidos (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT(255) NOT NULL,
    producto_id INT(255) NOT NULL,
    unidades INT(255) NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE,
    FOREIGN KEY (producto_id) REFERENCES productos(id) ON DELETE CASCADE
);

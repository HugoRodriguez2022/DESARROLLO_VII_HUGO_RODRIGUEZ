-- Crear la base de datos
CREATE DATABASE biblioteca_db;
USE biblioteca_db;

-- Crear la tabla de usuarios con id como VARCHAR(21) para almacenar grandes números como cadenas
CREATE TABLE usuarios (
    id VARCHAR(21) NOT NULL PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    nombre VARCHAR(100) NOT NULL,
    google_id VARCHAR(100) NOT NULL UNIQUE,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Crear la tabla de libros_guardados con user_id como VARCHAR(21) para almacenar grandes números como cadenas
CREATE TABLE libros_guardados (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id VARCHAR(21) NOT NULL,
    google_books_id VARCHAR(100) NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(255) NOT NULL,
    imagen_portada VARCHAR(255),
    reseña_personal TEXT,
    fecha_guardado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES usuarios(id)
);

--Eliminar base ede datos--
DROP DATABASE IF EXISTS biblioteca_db;

-- Modificar el tipo de datos de la columna id en usuarios a BIGINT
ALTER TABLE usuarios MODIFY COLUMN id BIGINT NOT NULL AUTO_INCREMENT;

-- Modificar el tipo de datos de la columna user_id en libros_guardados a BIGINT
ALTER TABLE libros_guardados MODIFY COLUMN user_id BIGINT;
ALTER TABLE libros_guardados ADD COLUMN resena_personal TEXT;


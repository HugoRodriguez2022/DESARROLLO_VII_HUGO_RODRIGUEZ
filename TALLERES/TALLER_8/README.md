# Sistema de Gestión de Biblioteca

Este proyecto es un sistema de gestión de biblioteca implementado en PHP, utilizando MySQL como base de datos. El sistema permite gestionar libros, usuarios y préstamos de manera sencilla y eficiente.

## Instrucciones de Configuración

### Requisitos Previos

- Servidor web con soporte para PHP (por ejemplo, XAMPP, WAMP, o un servidor LAMP).
- MySQL instalado y en funcionamiento.

### Estructura de la Base de Datos

1. Crea una base de datos llamada `taller8_db` en tu servidor MySQL.
2. Ejecuta las siguientes consultas SQL para crear las tablas necesarias:

```sql
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL
);

CREATE TABLE libros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    isbn VARCHAR(20) NOT NULL UNIQUE,
    anio_publicacion INT NOT NULL,
    cantidad_disponible INT NOT NULL
);

CREATE TABLE prestamos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    libro_id INT NOT NULL,
    fecha_prestamo DATETIME DEFAULT CURRENT_TIMESTAMP,
    fecha_devolucion DATETIME,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (libro_id) REFERENCES libros(id)
);
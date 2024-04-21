CREATE DATABASE IF NOT EXISTS `bd-prueba2024`;

USE bd-prueba2024;

CREATE TABLE Usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_completo VARCHAR(100) NOT NULL,
    documento_identidad VARCHAR(20) UNIQUE NOT NULL,
    correo_electronico VARCHAR(100) UNIQUE NOT NULL,
    clave VARCHAR(100) NOT NULL,
    tipo_usuario ENUM('comun', 'comerciante') NOT NULL
);

CREATE TABLE Transferencias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario_origen INT NOT NULL,
    id_usuario_destino INT NOT NULL,
    monto DECIMAL(10, 2) NOT NULL,
    estado ENUM('completo', 'pendiente','revertido') DEFAULT 'pendiente' NOT NULL,
    FOREIGN KEY (id_usuario_origen) REFERENCES Usuarios(id),
    FOREIGN KEY (id_usuario_destino) REFERENCES Usuarios(id)
);

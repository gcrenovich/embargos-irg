CREATE DATABASE IF NOT EXISTS embargos;
USE embargos;

CREATE TABLE empleados (
  id INT AUTO_INCREMENT PRIMARY KEY,
  legajo INT UNIQUE NOT NULL,
  nombre VARCHAR(100),
  apellido VARCHAR(100),
  remunerativo DECIMAL(10,2),
  no_remunerativo DECIMAL(10,2)
);

CREATE TABLE embargos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  empleado_id INT,
  codigo INT,
  porcentaje DECIMAL(5,2),
  expediente VARCHAR(100),
  oficio VARCHAR(100),
  cuenta_bancaria VARCHAR(50),
  nota TEXT,
  estado ENUM('activo', 'finalizado') DEFAULT 'activo',
  FOREIGN KEY (empleado_id) REFERENCES empleados(id)
);

CREATE TABLE liquidaciones (
  id INT AUTO_INCREMENT PRIMARY KEY,
  empleado_id INT,
  periodo VARCHAR(7),
  codigo INT,
  monto_retencion DECIMAL(10,2),
  FOREIGN KEY (empleado_id) REFERENCES empleados(id)
);
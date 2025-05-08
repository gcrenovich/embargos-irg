<?php
// includes/db.php

// Ajusta estos valores según tu configuración de XAMPP
$servidor   = 'localhost';
$usuario    = 'root';
$password   = '';        // Si tienes contraseña, ponla aquí
$basedatos  = 'gestion_embargos';  // <- Cambiado a tu nombre de BD

$mysqli = new mysqli($servidor, $usuario, $password, $basedatos);
if ($mysqli->connect_error) {
    die('Error de Conexión (' . $mysqli->connect_errno . ') '
        . $mysqli->connect_error);
}

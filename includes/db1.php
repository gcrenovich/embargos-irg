<?php
$mysqli = new mysqli('localhost', 'root', '', 'embargos');
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}
?>
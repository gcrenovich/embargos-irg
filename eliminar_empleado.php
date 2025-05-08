<?php
include 'includes/db.php';
if (isset($_GET['legajo'])) {
    $legajo = $_GET['legajo'];
    $mysqli->query("UPDATE empleados SET activo=0 WHERE legajo=$legajo");
}
header('Location: empleados.php');
exit;

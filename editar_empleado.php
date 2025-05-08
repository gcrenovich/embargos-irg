<?php
include 'includes/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $legajo = $_POST['legajo'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $rem = $_POST['remunerativo'];
    $no_rem = $_POST['no_remunerativo'];
    $mysqli->query("UPDATE empleados SET nombre='$nombre', apellido='$apellido', remunerativo=$rem, no_remunerativo=$no_rem WHERE legajo=$legajo");
    header('Location: empleados.php');
    exit;
}
$legajo = $_GET['legajo'];
$res = $mysqli->query("SELECT * FROM empleados WHERE legajo=$legajo");
$row = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Empleado</title>
</head>
<body>
    <h1>Editar Empleado</h1>
    <form method="POST">
        <input type="hidden" name="legajo" value="<?= $row['legajo'] ?>">
        Nombre: <input type="text" name="nombre" value="<?= $row['nombre'] ?>" required><br>
        Apellido: <input type="text" name="apellido" value="<?= $row['apellido'] ?>" required><br>
        Remunerativo: <input type="number" step="0.01" name="remunerativo" value="<?= $row['remunerativo'] ?>" required><br>
        No Remunerativo: <input type="number" step="0.01" name="no_remunerativo" value="<?= $row['no_remunerativo'] ?>" required><br>
        <button type="submit">Guardar</button>
    </form>
    <a href="empleados.php">Volver al listado</a>
</body>
</html>

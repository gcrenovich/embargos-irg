<?php
include 'includes/db.php';
$resultado = $mysqli->query("SELECT * FROM empleados");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Empleados</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <?php include 'includes/menu.php'; ?>
<div class="container">
    <h1>Listado de Empleados</h1>
    <a href="nuevo_empleado.php" class="button">Nuevo Empleado</a>
    <table>
        <tr><th>Legajo</th><th>Nombre</th><th>Apellido</th><th>Remunerativo</th><th>No Remunerativo</th></tr>
        <?php while ($fila = $resultado->fetch_assoc()): ?>
        <tr>
            <td><?= $fila['legajo'] ?></td>
            <td><?= $fila['nombre'] ?></td>
            <td><?= $fila['apellido'] ?></td>
            <td><?= $fila['remunerativo'] ?></td>
            <td><?= $fila['no_remunerativo'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>
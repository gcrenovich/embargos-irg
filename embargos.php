<?php
include 'includes/db.php';
$resultado = $mysqli->query("SELECT e.id AS emp_id, e.legajo, e.nombre, e.apellido, em.* 
                             FROM empleados e 
                             JOIN embargos em ON e.id = em.empleado_id");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Embargos</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <?php include 'includes/menu.php'; ?>
<div class="container">
    <h1>Listado de Embargos</h1>
    <a href="nuevo_embargo.php" class="button">Nuevo Embargo</a>
    <table>
        <tr><th>Legajo</th><th>Empleado</th><th>Código</th><th>Porcentaje</th><th>Expediente</th><th>Cuenta</th><th>Estado</th></tr>
        <?php while ($fila = $resultado->fetch_assoc()): ?>
        <tr>
            <td><?= $fila['legajo'] ?></td>
            <td><?= $fila['nombre'] . ' ' . $fila['apellido'] ?></td>
            <td><?= $fila['codigo'] ?></td>
            <td><?= $fila['porcentaje'] ?>%</td>
            <td><?= $fila['expediente'] ?></td>
            <td><?= $fila['cuenta_bancaria'] ?></td>
            <td><?= $fila['estado'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>
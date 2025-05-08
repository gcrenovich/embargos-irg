<?php
include 'includes/db.php';
$result = $mysqli->query("SELECT legajo, nombre, apellido, remunerativo, no_remunerativo, activo FROM empleados");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Empleados</title>
</head>
<body>
    <h1>Listado de Empleados</h1>
    <a href="nuevo_empleado.php">Nuevo Empleado</a><br><br>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Legajo</th><th>Nombre</th><th>Apellido</th><th>Remunerativo</th><th>No Remunerativo</th><th>Acciones</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <?php $style = $row['activo'] ? '' : 'style="color:gray;"'; ?>
            <tr <?= $style ?>>
                <td><?= $row['legajo'] ?></td>
                <td><?= $row['nombre'] ?> <?= !$row['activo'] ? '(inactivo)' : '' ?></td>
                <td><?= $row['apellido'] ?></td>
                <td><?= $row['remunerativo'] ?></td>
                <td><?= $row['no_remunerativo'] ?></td>
                <td>
                    <?php if ($row['activo']): ?>
                        <a href="editar_empleado.php?legajo=<?= $row['legajo'] ?>">Editar</a> |
                        <a href="eliminar_empleado.php?legajo=<?= $row['legajo'] ?>" onclick="return confirm('¿Desactivar empleado?')">Eliminar</a>
                    <?php else: ?>
                        <em>Sin acciones</em>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

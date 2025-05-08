<?php
include 'includes/db.php';

// Auto-finalizar embargos comerciales y de vivienda
$mysqli->query("UPDATE embargos 
    SET estado='finalizado' 
    WHERE codigo IN (451,452,591) 
      AND monto_acumulado >= monto_total 
      AND estado='activo'");

// Obtener todos los embargos
$result = $mysqli->query("SELECT e.id, e.empleado_id, emp.nombre, emp.apellido, e.codigo, e.porcentaje, e.expediente, e.oficio, e.cuenta_bancaria, e.monto_total, e.monto_acumulado, e.estado 
    FROM embargos e 
    JOIN empleados emp ON e.empleado_id = emp.legajo");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Embargos</title>
</head>
<body>
    <h1>Listado de Embargos</h1>
    <a href="nuevo_embargo.php">Nuevo Embargo</a><br><br>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th><th>Empleado</th><th>Código</th><th>%</th><th>Expediente</th><th>Oficio</th><th>Cuenta</th><th>Monto Total</th><th>Monto Acumulado</th><th>Estado</th><th>Acciones</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <?php $style = $row['estado'] !== 'activo' ? 'style="color:gray;"' : ''; ?>
            <tr <?= $style ?>>
                <td><?= $row['id'] ?></td>
                <td><?= $row['empleado_id'] ?> - <?= $row['nombre'] ?> <?= $row['apellido'] ?></td>
                <td><?= $row['codigo'] ?></td>
                <td><?= $row['porcentaje'] ?></td>
                <td><?= $row['expediente'] ?></td>
                <td><?= $row['oficio'] ?></td>
                <td><?= $row['cuenta_bancaria'] ?></td>
                <td><?= $row['monto_total'] ?></td>
                <td><?= $row['monto_acumulado'] ?></td>
                <td><?= $row['estado'] ?></td>
                <td>
                    <?php if ($row['estado'] === 'activo'): ?>
                        <a href="editar_embargo.php?id=<?= $row['id'] ?>">Editar</a>
                        <?php if (in_array($row['codigo'], [450,453,454])): ?>
                            | <a href="cesar_embargo.php?id=<?= $row['id'] ?>" onclick="return confirm('¿Cesar embargo de alimentos?')">Cesar</a>
                            | <a href="finalizar_embargo.php?id=<?= $row['id'] ?>" onclick="return confirm('¿Finalizar embargo de alimentos?')">Finalizar</a>
                        <?php endif; ?>
                    <?php else: ?>
                        <em>Sin acciones</em>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

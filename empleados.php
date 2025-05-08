<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Título de la página</title>
    <!-- enlace a tu hoja de estilos -->
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <?php 
        include 'includes/menu.php'; 
    ?>
    <div class="contenido">
    <?php
        include 'includes/db.php';
        $result = $mysqli->query("SELECT legajo, nombre, apellido, remunerativo, no_remunerativo, activo FROM empleados");
    ?>
    <h1>Listado de Empleados</h1>
    <a href="nuevo_empleado.php">
        <button>Nuevo Empleado</button>
    </a>
    <br>
    <table class="tabla-1">
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
                        <a href="editar_empleado.php?legajo=<?= $row['legajo'] ?>"><button>Editar</button></a> |
                        <a href="eliminar_empleado.php?legajo=<?= $row['legajo'] ?>" onclick="return confirm('¿Desactivar empleado?')"><button>Eliminar</button></a>
                    <?php else: ?>
                        <em>Sin acciones</em>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
  </div><!-- /.contenido -->
</body>
</html>

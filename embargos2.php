<?php
// embargos.php
include 'includes/db.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Embargos</title>
    <link rel="stylesheet" href="css/estilos.css">
    <style>
        .inactivo { color: #888 !important; }
        .inactivo td { background: #f0f0f0 !important; }
        .button { /* si ya lo tenés en tu CSS BTP, podés omitir esto */
            display: inline-block;
            padding: 8px 12px;
            background: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .button:hover { background: #0056b3; }
    </style>
</head>
<body>
    <?php include 'includes/menu.php'; ?>

    <div class="container">
        <h1>Embargos</h1>

        <!-- Botón Nuevo Embargo -->
        <a href="nuevo_embargo.php" class="button">Nuevo Embargo</a>

        <table>
            <thead>
                <tr>
                    <th>Legajo</th>
                    <th>Empleado</th>
                    <th>Código</th>
                    <th>%</th>
                    <th>Expediente</th>
                    <th>Cuenta</th>
                    <th>Estado</th>
                    <th>Monto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT em.id, e.legajo, e.nombre, e.apellido, e.remunerativo, e.no_remunerativo,
                           em.codigo, em.porcentaje, em.expediente, em.cuenta_bancaria, em.estado
                    FROM embargos em
                    JOIN empleados e ON em.empleado_id = e.id";
            $res = $mysqli->query($sql);

            while ($row = $res->fetch_assoc()):
                // Calcular monto según código
                $rem = $row['remunerativo'];
                $nrem = $row['no_remunerativo'];
                $pct = $row['porcentaje'] / 100.0;

                switch ($row['codigo']) {
                    case 450:
                    case 453:
                    case 454:
                        $neto = $rem * 0.83;
                        $base = $neto + $nrem;
                        $monto = $base * $pct;
                        break;
                    case 451:
                    case 452:
                        $base = $rem + $nrem;
                        $monto = $base * $pct;
                        break;
                    case 591:
                        $neto = $rem * 0.83;
                        $base = $neto + $nrem;
                        $monto = $base * 0.20;
                        break;
                    default:
                        $monto = 0;
                }

                // Clase para inactivos
                $cls = in_array($row['estado'], ['cesado','finalizado']) ? 'inactivo' : '';
            ?>
                <tr class="<?= $cls ?>">
                    <td><?= $row['legajo'] ?></td>
                    <td><?= htmlspecialchars($row['nombre'].' '.$row['apellido']) ?></td>
                    <td><?= $row['codigo'] ?></td>
                    <td><?= number_format($row['porcentaje'],2) ?>%</td>
                    <td><?= htmlspecialchars($row['expediente']) ?></td>
                    <td><?= htmlspecialchars($row['cuenta_bancaria']) ?></td>
                    <td>
                        <?= ucfirst($row['estado']) ?>
                        <?php if ($cls): ?> <span>(inactivo)</span><?php endif; ?>
                    </td>
                    <td>$<?= number_format($monto,2,',','.') ?></td>
                    <td>
                        <?php if (in_array($row['codigo'], [450,452,453,454])): 
                            $nuevo = $row['estado'] === 'cesado' ? 'activo' : 'cesado';
                        ?>
                            <form method="post" action="cambiar_estado_embargo.php" style="display:inline">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <input type="hidden" name="estado" value="<?= $nuevo ?>">
                                <button type="submit" class="button">
                                    <?= $nuevo === 'activo' ? 'Activar' : 'Cesado' ?>
                                </button>
                            </form>
                        <?php endif; ?>

                        <form method="post" action="eliminar_embargo.php" style="display:inline" 
                              onsubmit="return confirm('¿Eliminar este embargo?')">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="submit" class="button">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

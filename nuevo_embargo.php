<?php
include 'includes/db.php';

$empleado = null;
$mensaje = "";

if (isset($_POST['buscar_legajo'])) {
    $legajo = intval($_POST['legajo']);
    $res = $mysqli->query("SELECT empleado_id, nombre, apellido FROM empleados WHERE legajo = $legajo AND activo = 1");
    if ($res && $res->num_rows > 0) {
        $empleado = $res->fetch_assoc();
    } else {
        $mensaje = "Empleado no encontrado o inactivo.";
    }
}

if (isset($_POST['guardar_embargo'])) {
    $empleado_id = intval($_POST['empleado_id']);
    $codigo = intval($_POST['codigo']);
    $porcentaje = floatval($_POST['porcentaje']);
    $exp = $_POST['expediente'];
    $ofi = $_POST['oficio'];
    $cuenta = $_POST['cuenta_bancaria'];
    $monto_total = isset($_POST['monto_total']) && $_POST['monto_total'] !== "" ? $_POST['monto_total'] : 0;

    $mysqli->query("INSERT INTO embargos (empleado_id, codigo, porcentaje, expediente, oficio, cuenta_bancaria, monto_total, monto_acumulado, estado)
    VALUES ($empleado_id, $codigo, $porcentaje, '$exp', '$ofi', '$cuenta', $monto_total, 0, 'activo')");

    header("Location: embargos.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Embargo</title>
    <link rel="stylesheet" href="css/estilos.css">
    <script>
        function toggleMontoTotal() {
            const codigo = document.getElementById('codigo').value;
            const grupo = document.getElementById('grupo_monto_total');
            const codigosAlimentos = ['450', '452', '453', '454'];
            grupo.style.display = codigosAlimentos.includes(codigo) ? 'none' : 'block';
        }

        document.addEventListener("DOMContentLoaded", function () {
            const codigo = document.getElementById('codigo');
            if (codigo) {
                codigo.addEventListener('change', toggleMontoTotal);
                toggleMontoTotal();
            }
        });
    </script>
</head>
<body>
<?php include 'includes/menu.php'; ?>
<div class="contenido">
    <h1>Registrar Nuevo Embargo</h1>

    <form method="POST">
        <label>Buscar por Legajo:</label>
        <input type="number" name="legajo" required>
        <button type="submit" name="buscar_legajo">Buscar</button>
    </form>

    <?php if ($mensaje): ?>
        <p style="color:red"><?= $mensaje ?></p>
    <?php endif; ?>

    <?php if ($empleado): ?>
        <hr>
        <p><strong>Empleado:</strong> <?= $empleado['nombre'] ?> <?= $empleado['apellido'] ?></p>
        
        <form method="POST">
            
            <input type="hidden" name="empleado_id" value="<?= $empleado['empleado_id'] ?>">

            <div class="form-group">
            <label for="codigo">Código:</label>
            <select name="codigo" id="codigo" required>
                <option value="450">450</option>
                <option value="451">451</option>
                <option value="452">452</option>
                <option value="453">453</option>
                <option value="454">454</option>
                <option value="591">591</option>
            </select>
            </div><br>

            <div class="form-group">
            <label for="porcentaje">Porcentaje:</label>
            <input type="number" step="0.01" name="porcentaje" id="porcentaje" required>
            </div><br>

            <div class="form-group">
            <label for="expediente">Expediente:</label>
            <input type="text" name="expediente" id="expediente" required>
            </div><br>

            <div class="form-group">
            <label for="oficio">Oficio:</label>
            <input type="text" name="oficio" id="oficio" required>
            </div><br>

            <div class="form-group">
            <label for="cuenta_bancaria">Cuenta Bancaria:</label>
            <input type="text" name="cuenta_bancaria" id="cuenta_bancaria" required>
            </div><br>

            <div class="form-group" id="grupo_monto_total">
                <label for="monto_total">Monto Total:</label>
                <input type="number" step="0.01" name="monto_total" id="monto_total">
            </div></br>

            <button type="submit" name="guardar_embargo">Guardar</button>

        </form>
    <?php endif; ?>

    <br>
    <a href="embargos.php">
        <button>Volver al listado</button>
    </a>
</div>
</body>
</html>

<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $empleado = $_POST['empleado_id'];
    $codigo = $_POST['codigo'];
    $porcentaje = $_POST['porcentaje'];
    $exp = $_POST['expediente'];
    $ofi = $_POST['oficio'];
    $cuenta = $_POST['cuenta_bancaria'];
   // $monto_total = $_POST['monto_total'];

//    $mysqli->query("INSERT INTO embargos (empleado_id, codigo, porcentaje, expediente, oficio, cuenta_bancaria, monto_total, monto_acumulado, estado) VALUES 
  //      ($empleado, $codigo, $porcentaje, '$exp', '$ofi', '$cuenta', $monto_total, 0, 'activo')");
   // header('Location: embargos.php');
    //exit;
    //
    $monto_total = isset($_POST['monto_total']) && $_POST['monto_total'] !== "" ? $_POST['monto_total'] : 0;

$mysqli->query("INSERT INTO embargos (empleado_id, codigo, porcentaje, expediente, oficio, cuenta_bancaria, monto_total, monto_acumulado, estado) VALUES 
    ($empleado, $codigo, $porcentaje, '$exp', '$ofi', '$cuenta', $monto_total, 0, 'activo')");
}

$emps = $mysqli->query("SELECT empleado_id, nombre, apellido FROM empleados WHERE activo=1");
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
            const montoGroup = document.getElementById('grupo_monto_total');
            const codigosAlimentos = ['450', '452', '453', '454'];
            if (codigosAlimentos.includes(codigo)) {
                montoGroup.style.display = 'none';
            } else {
                montoGroup.style.display = 'block';
            }
        }
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('codigo').addEventListener('change', toggleMontoTotal);
            toggleMontoTotal(); // inicial
        });
    </script>
</head>
<body>
<?php include 'includes/menu.php'; ?>
<div class="contenido">
    <h1>Registrar Nuevo Embargo</h1>
    <form method="POST">
        <div class="form-group">
            <label for="empleado_id">Empleado</label>
            <select name="empleado_id" id="empleado_id" required>
                <?php while ($e = $emps->fetch_assoc()): ?>
                    <option value="<?= $e['empleado_id'] ?>">
                        <?= $e['empleado_id'] ?> - <?= $e['nombre'] ?> <?= $e['apellido'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="codigo">Código</label>
            <select name="codigo" id="codigo" required>
                <option value="450">450</option>
                <option value="451">451</option>
                <option value="452">452</option>
                <option value="453">453</option>
                <option value="454">454</option>
                <option value="591">591</option>
            </select>
        </div>

        <div class="form-group">
            <label for="porcentaje">Porcentaje</label>
            <input type="number" step="0.01" name="porcentaje" id="porcentaje" required>
        </div>

        <div class="form-group">
            <label for="expediente">Expediente</label>
            <input type="text" name="expediente" id="expediente" required>
        </div>

        <div class="form-group">
            <label for="oficio">Oficio</label>
            <input type="text" name="oficio" id="oficio" required>
        </div>

        <div class="form-group">
            <label for="cuenta_bancaria">Cuenta Bancaria</label>
            <input type="text" name="cuenta_bancaria" id="cuenta_bancaria" required>
        </div>

        <div class="form-group" id="grupo_monto_total">
            <label for="monto_total">Monto Total</label>
            <input type="number" step="0.01" name="monto_total" id="monto_total">
        </div>

        <button type="submit">Guardar</button>
    </form>
    <a href="embargos.php">Volver al listado</a>
</div>
</body>
</html>

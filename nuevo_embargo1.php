<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $empleado = $_POST['empleado_id'];
    $codigo = $_POST['codigo'];
    $porcentaje = $_POST['porcentaje'];
    $exp = $_POST['expediente'];
    $ofi = $_POST['oficio'];
    $cuenta = $_POST['cuenta_bancaria'];
    $monto_total = $_POST['monto_total'];

    $mysqli->query("INSERT INTO embargos (empleado_id, codigo, porcentaje, expediente, oficio, cuenta_bancaria, monto_total, monto_acumulado, estado) VALUES 
        ($empleado, $codigo, $porcentaje, '$exp', '$ofi', '$cuenta', $monto_total, 0, 'activo')");
    header('Location: embargos.php');
    exit;
}

// Obtener empleados activos para el select
$emps = $mysqli->query("SELECT legajo, nombre, apellido FROM empleados WHERE activo=1");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nuevo Embargo</title>
</head>
<body>
    <h1>Registrar Nuevo Embargo</h1>
    <form method="POST">
        Empleado:
        <select name="empleado_id" required>
            <?php while ($e = $emps->fetch_assoc()): ?>
                <option value="<?= $e['legajo'] ?>"><?= $e['legajo'] ?> - <?= $e['nombre'] ?> <?= $e['apellido'] ?></option>
            <?php endwhile; ?>
        </select><br>
        Código:
        <select name="codigo" required>
            <option value="450">450 - Alimentos</option>
            <option value="451">451 - Comercial</option>
            <option value="452">452 - Comercial</option>
            <option value="453">453 - Alimentos</option>
            <option value="454">454 - Alimentos</option>
            <option value="591">591 - Vivienda</option>
        </select><br>
        Porcentaje: <input type="number" step="0.01" name="porcentaje" required><br>
        Expediente: <input type="text" name="expediente" required><br>
        Oficio: <input type="text" name="oficio" required><br>
        Cuenta Bancaria: <input type="text" name="cuenta_bancaria" required><br>
        Monto Total: <input type="number" step="0.01" name="monto_total" required><br>
        <button type="submit">Guardar</button>
    </form>
    <a href="embargos.php">Volver al listado</a>
</body>
</html>

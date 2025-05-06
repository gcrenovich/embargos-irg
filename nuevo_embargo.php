<?php
include 'includes/db.php';
$empleados = $mysqli->query("SELECT id, legajo, nombre, apellido FROM empleados");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $mysqli->prepare("INSERT INTO embargos (empleado_id, codigo, porcentaje, expediente, oficio, cuenta_bancaria, nota, estado) VALUES (?, ?, ?, ?, ?, ?, ?, 'activo')");
    $stmt->bind_param("iidssss", $_POST['empleado_id'], $_POST['codigo'], $_POST['porcentaje'], $_POST['expediente'], $_POST['oficio'], $_POST['cuenta_bancaria'], $_POST['nota']);
    $stmt->execute();
    header("Location: embargos.php");
    exit;
}

$empleado = null;
if (isset($_GET['legajo'])) {
    $legajo = intval($_GET['legajo']);
    $stmt = $mysqli->prepare("SELECT * FROM empleados WHERE legajo = ?");
    $stmt->bind_param("i", $legajo);
    $stmt->execute();
    $empleado = $stmt->get_result()->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Embargo</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <?php include 'includes/menu.php'; ?>
<div class="container">
    <h1>Agregar Embargo</h1>
<!---->
    <form method="get">
    <label>Buscar por Legajo: <input type="number" name="legajo" required></label>
    <input type="submit" value="Buscar">
</form>
<!---->
<?php if ($empleado): ?>
    <h3>Empleado: <?= $empleado['nombre'] . ' ' . $empleado['apellido'] ?> (Legajo <?= $empleado['legajo'] ?>)</h3>
    <form method="post">
        <input type="hidden" name="empleado_id" value="<?= $empleado['id'] ?>">

        <label>Código:
            <select name="codigo" required>
                <option value="">Seleccione</option>
                <option value="450">450 - Embargo General</option>
                <option value="451">451 - Comercial</option>
                <option value="452">452 - Alimentos (bruto)</option>
                <option value="453">453 - Alimentos (neto)</option>
                <option value="454">454 - Alimentos (neto)</option>
                <option value="591">591 - Vivienda</option>
            </select>
        </label><br><br>

        <label>Porcentaje: <input type="number" name="porcentaje" step="0.01" required></label><br><br>
        <label>Expediente: <input type="text" name="expediente"></label><br><br>
        <label>Oficio: <input type="text" name="oficio"></label><br><br>
        <label>Cuenta Bancaria: <input type="text" name="cuenta_bancaria"></label><br><br>
        <label>Nota: <textarea name="nota"></textarea></label><br><br>

        <input type="submit" value="Guardar Embargo">
    </form>
<?php elseif (isset($_GET['legajo'])): ?>
    <p style="color:red;">Empleado no encontrado.</p>
<?php endif; ?>
<!---->
</div>
</body>
</html>
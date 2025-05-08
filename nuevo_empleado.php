<?php
include 'includes/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $mysqli->prepare("INSERT INTO empleados (legajo, nombre, apellido, remunerativo, no_remunerativo) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issdd", $_POST['legajo'], $_POST['nombre'], $_POST['apellido'], $_POST['remunerativo'], $_POST['no_remunerativo']);
    $stmt->execute();
    header("Location: empleados.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Empleado</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <?php include 'includes/menu.php'; ?>

<div class="container">
    <h1>Agregar Empleado</h1>
    
    <form method="post">
        <label>Legajo: <input type="number" name="legajo" required></label><br><br>
        <label>Nombre: <input type="text" name="nombre" required></label><br><br>
        <label>Apellido: <input type="text" name="apellido" required></label><br><br>
        <label>Remunerativo: <input type="number" step="0.01" name="remunerativo" required></label><br><br>
        <label>No Remunerativo: <input type="number" step="0.01" name="no_remunerativo" required></label><br><br>
        <input type="submit" value="Guardar">
    </form>

</div>
</body>
</html>
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
    
    <div class="form-group">
        <label for="legajo">Legajo</label>
        <input type="number" name="legajo" id="legajo" required>
    </div>

    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" required>
    </div>

    <div class="form-group">
        <label for="apellido">Apellido</label>
        <input type="text" name="apellido" id="apellido" required>
    </div>

    <div class="form-group">
        <label for="remunerativo">Remunerativo</label>
        <input type="number" step="0.01" name="remunerativo" id="remunerativo" required>
    </div>

    <div class="form-group">
        <label for="no_remunerativo">No Remunerativo</label>
        <input type="number" step="0.01" name="no_remunerativo" id="no_remunerativo" required>
    </div>

    <input type="submit" value="Guardar">

    </form>
</div>
</body>
</html>
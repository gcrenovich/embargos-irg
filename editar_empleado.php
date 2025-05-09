<?php
    include 'includes/db.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $legajo = $_POST['legajo'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $rem = $_POST['remunerativo'];
        $no_rem = $_POST['no_remunerativo'];
        $mysqli->query("UPDATE empleados SET nombre='$nombre', apellido='$apellido', remunerativo=$rem, no_remunerativo=$no_rem WHERE legajo=$legajo");
        header('Location: empleados.php');
        exit;
    }
    $legajo = $_GET['legajo'];
    $res = $mysqli->query("SELECT * FROM empleados WHERE legajo=$legajo");
    $row = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Empleado</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <?php include 'includes/menu.php'; ?>
    
    <div class="container">

    <h1>Editar Empleado</h1>
    
    <form method="POST">

        <input type="hidden" name="legajo" value="<?= $row['legajo'] ?>">

        <div class="form-group">
            <label for="legajo">Nombre</label>
            <input type="text" name="nombre" value="<?= $row['nombre'] ?>" required>
        </div><br>

        <div class="form-group">
            <label for="legajo">Apellido</label>
            <input type="text" name="apellido" value="<?= $row['apellido'] ?>" required>
        </div><br>

        <div class="form-group">
            <label for="legajo">Remunerativo</label>
            <input type="number" step="0.01" name="remunerativo" value="<?= $row['remunerativo'] ?>" required><br>
        </div><br>

        <div class="form-group">
            <label for="legajo">No Remunerativo</label>
            <input type="number" step="0.01" name="no_remunerativo" value="<?= $row['no_remunerativo'] ?>" required><br>
        </div><br>
        <button type="submit">Guardar</button>
    </form>
    </div></br>
    
    <a href="empleados.php">
        <button>Volver al listado</button>
    </a>
</body>
</html>

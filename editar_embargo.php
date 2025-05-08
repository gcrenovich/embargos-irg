<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $codigo = $_POST['codigo'];
    $porcentaje = $_POST['porcentaje'];
    $exp = $_POST['expediente'];
    $ofi = $_POST['oficio'];
    $cuenta = $_POST['cuenta_bancaria'];
    $monto_total = $_POST['monto_total'];

    $mysqli->query("UPDATE embargos SET codigo=$codigo, porcentaje=$porcentaje, expediente='$exp', oficio='$ofi', cuenta_bancaria='$cuenta', monto_total=$monto_total WHERE id=$id");
    header('Location: embargos.php');
    exit;
}

$id = $_GET['id'];
$res = $mysqli->query("SELECT * FROM embargos WHERE id=$id");
$row = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Embargo</title>
</head>
<body>
    <h1>Editar Embargo</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        Código:
        <select name="codigo" required>
            <option value="450" <?= $row['codigo']==450?'selected':'' ?>>450 - Alimentos</option>
            <option value="451" <?= $row['codigo']==451?'selected':'' ?>>451 - Comercial</option>
            <option value="452" <?= $row['codigo']==452?'selected':'' ?>>452 - Comercial</option>
            <option value="453" <?= $row['codigo']==453?'selected':'' ?>>453 - Alimentos</option>
            <option value="454" <?= $row['codigo']==454?'selected':'' ?>>454 - Alimentos</option>
            <option value="591" <?= $row['codigo']==591?'selected':'' ?>>591 - Vivienda</option>
        </select><br>
        Porcentaje: <input type="number" step="0.01" name="porcentaje" value="<?= $row['porcentaje'] ?>" required><br>
        Expediente: <input type="text" name="expediente" value="<?= $row['expediente'] ?>" required><br>
        Oficio: <input type="text" name="oficio" value="<?= $row['oficio'] ?>" required><br>
        Cuenta Bancaria: <input type="text" name="cuenta_bancaria" value="<?= $row['cuenta_bancaria'] ?>" required><br>
        Monto Total: <input type="number" step="0.01" name="monto_total" value="<?= $row['monto_total'] ?>" required><br>
        <button type="submit">Actualizar</button>
    </form>
    <a href="embargos.php">Volver al listado</a>
</body>
</html>

<?php
include 'includes/db.php';
$id     = intval($_POST['id']);
$estado = $_POST['estado'];
// Validar estado según código si querés
$stmt = $mysqli->prepare("UPDATE embargos SET estado = ? WHERE id = ?");
$stmt->bind_param("si", $estado, $id);
$stmt->execute();
header("Location: embargos.php");
exit;
?>

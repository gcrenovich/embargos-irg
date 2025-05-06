<?php
include 'includes/db.php';
$id = intval($_POST['id']);
$stmt = $mysqli->prepare("DELETE FROM embargos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
header("Location: embargos.php");
exit;
?>

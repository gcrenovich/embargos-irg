<?php
include 'includes/db.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $mysqli->query("UPDATE embargos SET estado='cesado' WHERE id=$id");
}
header('Location: embargos.php');
exit;
?>
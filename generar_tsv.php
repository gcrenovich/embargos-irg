<?php
include 'includes/db.php';

function calcular_embargo($codigo, $rem, $norem, $porcentaje) {
    switch ($codigo) {
        case 450:
            $neto = $rem * 0.83;
            $base = $neto + $norem;
            return $base * ($porcentaje / 100);
        case 451:
        case 452:
            return ($rem + $norem) * ($porcentaje / 100);
        case 453:
        case 454:
            return ($rem * 0.83 + $norem) * ($porcentaje / 100);
        case 591:
            return ($rem * 0.83 + $norem) * 0.20;
        default:
            return 0;
    }
}

$periodo = date("Y-m"); // Simulación de período actual
$tsv = "legajo	concepto	horas	valor\n";

$sql = "SELECT e.id, e.legajo, e.remunerativo, e.no_remunerativo, em.codigo, em.porcentaje
        FROM empleados e
        JOIN embargos em ON e.id = em.empleado_id
        WHERE em.estado = 'activo'";

$resultado = $mysqli->query($sql);

while ($row = $resultado->fetch_assoc()) {
    $monto = calcular_embargo($row['codigo'], $row['remunerativo'], $row['no_remunerativo'], $row['porcentaje']);
    $tsv .= "{$row['legajo']}	{$row['codigo']}	0	" . number_format($monto, 2, '.', '') . "\n";

    // Guardar en tabla liquidaciones
    $stmt = $mysqli->prepare("INSERT INTO liquidaciones (empleado_id, periodo, codigo, monto_retencion) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isid", $row['id'], $periodo, $row['codigo'], $monto);
    $stmt->execute();
}

// Descargar archivo TSV
header("Content-Type: text/tab-separated-values");
header("Content-Disposition: attachment; filename=embargos_$periodo.tsv");
echo $tsv;
exit;
?>
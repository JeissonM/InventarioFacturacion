<?php

require('fpdf.php');
require('config.php');

$modo = $_GET['modo'];
$id = $_GET['id'];

$pdf = new FPDF();
$pdf->AddFont('f1', 'B', 'BaskOldFace.php');
$pdf->AddFont('f2', 'B', 'PoorRichard.php');
$pdf->AddFont('f1b', 'B', 'BaskOldFaceb.php');
$pdf->AddFont('f2b', 'B', 'PoorRichardb.php');
$pdf->AddPage('P', 'Letter');
//Colocamos el logo
$pdf->Image('img/logo.png', 10, 5, 70, 45, 'PNG');
$con = conectar();
//ponemos los datos del encabezado
$hoy = getdate();
$fecha = $hoy["year"] . "-" . $hoy["mon"] . "-" . $hoy["mday"] . " - Hora:" . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
$pdf->SetFont('arial', 'B', 10);
$pdf->Cell(0, 25, 'Fecha Reporte: ' . $fecha, 0, 0, 'R');
$pdf->Ln(4);
$pdf->SetFont('arial', 'B', 14);
$pdf->Cell(0, 30, 'REPORTE DE INVENTARIO (EXISTENCIA)', 0, 0, 'R');
//Definimos los encabezados de la tabla de detalles
$pdf->SetFont('arial', 'B', 10);
$pdf->SetXY(10, 54);
$pdf->Cell(70, 5, 'PRODUCTO', 1);
$pdf->Cell(22, 5, 'COMPRA', 1);
$pdf->Cell(22, 5, 'VENTA', 1);
$pdf->Cell(12, 5, 'IVA', 1);
$pdf->Cell(13, 5, 'CANT.', 1);
$pdf->Cell(56, 5, 'CATEGORIA', 1);
$pdf->Ln(8);
//CONSULTA y llenado de los detalles de la factura
$link = conectar();
if ($modo == 'TODOS') {
    $query = "SELECT s.id, s.nombre, s.descripcion, s.precio, s.impuesto, s.idcategoria, (SELECT c.nombre FROM as_categoria c WHERE c.id=s.idcategoria) as categoria, s.precio_venta, s. existencia, s.unidad_medida FROM as_servicios s ORDER BY s.idcategoria;";
} else {
    $query = "SELECT s.id, s.nombre, s.descripcion, s.precio, s.impuesto, s.idcategoria, (SELECT c.nombre FROM as_categoria c WHERE c.id=s.idcategoria) as categoria, s.precio_venta, s. existencia, s.unidad_medida FROM as_servicios s WHERE idcategoria='" . $id . "' ORDER BY s.idcategoria;";
}
$resultado = $link->query($query);
$pdf->SetFont('Arial', '', 7);
if ($link->affected_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $pdf->Cell(70, 5, substr(utf8_decode($row['nombre']), 0, 35), 0);
        $pdf->Cell(22, 5, "$" . number_format($row['precio'], 2, '.', ''), 0);
        $pdf->Cell(22, 5, "$" . number_format($row['precio_venta'], 2, '.', ''), 0, 0, 'R');
        $pdf->Cell(12, 5, $row['impuesto'] . "%", 0, 0, 'R');
        $pdf->Cell(13, 5, $row['existencia'], 0, 0, 'R');
        $pdf->Cell(56, 5, substr(utf8_decode($row['categoria']), 0, 25), 0);
        $pdf->Ln(5);
    }
}
$pdf->Output('factura.pdf', 'I');
?>
<?php

require('fpdf.php');
require('config.php');

$datos = array();

$f1 = $_GET['f1'];
$f2 = $_GET['f2'];
$tf = $td = $tp = 0;
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
$pdf->Cell(0, 30, 'REPORTE DE VENTAS POR FECHAS', 0, 0, 'R');
//CONSULTA y llenado de los detalles de la factura
$link = conectar();
$query = "SELECT *FROM as_factura WHERE fecha BETWEEN '" . $f1 . "' AND '" . $f2 . "';";
$resultado = $link->query($query);
//Dibujamos el recuadro para los datos del encabezado
$res = $resultado;
if ($link->affected_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $datos[] = array(
            'nofactura' => $row['nofactura'],
            'fecha' => $row['fecha'],
            'cliente' => $row['cliente'],
            'total' => $row['total'],
            'estado' => $row['estado'],
            'saldo' => $row['saldo']
        );
        $tf = $tf + $row['total'];
        $td = $td + $row['saldo'];
    }
}
$tp = $tf - $td;
$pdf->SetFont('arial', 'B', 10);
$pdf->SetXY(10, 54);
$pdf->Cell(0, 23, '', 1, 0, 'L');
$pdf->SetXY(12, 58);
$pdf->Cell(0, 0, 'Fecha Inicial: ' . $f1, 0, 0, 'L');
$pdf->SetXY(12, 63);
$pdf->Cell(0, 0, 'Fecha Final: ' . $f2, 0, 0, 'L');
$pdf->SetXY(12, 68);
$pdf->Cell(0, 0, utf8_decode('Total Facturado Período: $ ' . $tf), 0, 0, 'L');
$pdf->SetXY(12, 73);
$pdf->Cell(0, 0, utf8_decode('Total Pagado Período: $ ' . $tp . '     -     Total Deuda Período: $ ' . $td), 0, 0, 'L');
//Definimos los encabezados de la tabla de detalles
$pdf->SetFont('arial', 'B', 10);
$pdf->SetXY(10, 84);
$pdf->Cell(14, 5, 'No. F.', 1);
$pdf->Cell(20, 5, 'FECHA', 1);
$pdf->Cell(92, 5, 'CLIENTE', 1);
$pdf->Cell(25, 5, 'TOTAL', 1);
$pdf->Cell(20, 5, 'ESTADO', 1);
$pdf->Cell(25, 5, 'SALDO', 1);
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 8);
if (count($datos) > 0) {
    $pdf->SetXY(10, 92);
    foreach ($datos as $d) {
        $pdf->Cell(14, 5, $d['nofactura'], 0);
        $pdf->Cell(20, 5, $d['fecha'], 0);
        $pdf->Cell(92, 5, $d['cliente'], 0, 0);
        $pdf->Cell(25, 5, "$ " . number_format($d['total'], 2, '.', ''), 0, 0, 'R');
        $pdf->Cell(20, 5, $d['estado'], 0, 0);
        $pdf->Cell(25, 5, "$ " . number_format($d['saldo'], 2, '.', ''), 0, 0, 'R');
        $pdf->Ln(5);
    }
}
$pdf->Output('factura.pdf', 'I');
?>
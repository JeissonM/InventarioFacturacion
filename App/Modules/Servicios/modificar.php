<?php

include("../../config.php");
$con = conectar();
$id = $_POST["id"];
$nom = $_POST["nombre"];
$des = $_POST["descripcion"];
$pre = $_POST["precio"];
$por = $_POST["impuesto"];
$cat = $_POST["categoria"];
$pv = $_POST["preciov"];
$und = $_POST["unidad"];
$ex = $_POST["existencia"];
$esdescuento = $_POST["esdescuento"];
$descuento = $_POST["descuento"];
$query = "UPDATE as_servicios SET nombre='" . $nom . "',descripcion='" . $des . "',precio='" . $pre . "',impuesto='" . $por . "',idcategoria='" . $cat . "', precio_venta='" . $pv . "', unidad_medida='" . $und . "', existencia='" . $ex . "', esporcentaje='" . $esdescuento . "',descuento='" . $descuento . "' WHERE id='" . $id . "';";
$result = $con->query($query);
$msg = "";
$i = $con->affected_rows;
if ($i != 0) {
    $msg = "Producto Modificado con Exito!";
} else {
    $msg = "Error al Modificar!";
}
echo $msg;
?>
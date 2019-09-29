<?php

include("../../config.php");
$con = conectar();
$nom = $_POST["nombre"];
$des = $_POST["descripcion"];
$pre = $_POST["precio"];
$cat = $_POST["categoria"];
$imp = $_POST["impuesto"];
$pv = $_POST["preciov"];
$und = $_POST["unidad"];
$ex = $_POST["existencia"];
$query = "INSERT INTO as_servicios(nombre, descripcion, precio, impuesto, idcategoria, precio_venta, unidad_medida, existencia) VALUES ('" . $nom . "','" . $des . "','" . $pre . "','" . $imp . "','" . $cat . "','" . $pv . "','" . $und . "','" . $ex . "');";
$result = $con->query($query);
$msg = "";
$i = $con->affected_rows;
if ($i != 0) {
    $msg = "Producto Almacenado con Exito!";
} else {
    $msg = "Error al Guardar!";
}
echo $msg;
?>
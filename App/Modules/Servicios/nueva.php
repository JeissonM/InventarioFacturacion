<?php

	include("../../config.php");
	$con=conectar();
	$nom=$_POST["nombre"];
	$des=$_POST["descripcion"];
	$pre=$_POST["precio"];
	$cat=$_POST["categoria"];
	$imp=$_POST["impuesto"];
	$query="INSERT INTO as_servicios(nombre, descripcion, precio, impuesto, idcategoria) VALUES ('".$nom."','".$des."','".$pre."','".$imp."','".$cat."');";
	$result =$con -> query($query);
	$msg="";
	$i=$con->affected_rows;
	if ($i!=0){
		$msg="Servicio Almacenado con Exito!";
	}else{
		$msg="Error al Guardar!";
	}
	echo $msg;

?>
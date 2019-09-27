<?php

	include("../../config.php");
	$con=conectar();
	$id=$_POST["id"];
	$nom=$_POST["nombre"];
	$des=$_POST["descripcion"];
	$pre=$_POST["precio"];
	$por=$_POST["impuesto"];
	$cat=$_POST["categoria"];
	$query="UPDATE as_servicios SET nombre='".$nom."',descripcion='".$des."',precio='".$pre."',impuesto='".$por."',idcategoria='".$cat."' WHERE id='".$id."';";
	$result =$con -> query($query);
	$msg="";
	$i=$con->affected_rows;
	if ($i!=0){
		$msg="Servicio Modificado con Exito!";
	}else{
		$msg="Error al Modificar!";
	}
	echo $msg;

?>
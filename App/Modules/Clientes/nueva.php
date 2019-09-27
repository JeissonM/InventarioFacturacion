<?php

	include("../../config.php");
	$con=conectar();
	$nit=$_POST["nit"];
	$nom=$_POST["nom"];
	$des=$_POST["des"];
	$dir=$_POST["dir"];
	$tel=$_POST["tel"];
	$mail=$_POST["mail"];
	$ciu=$_POST["ciu"];
	$query="INSERT INTO as_clientes(nit, nombre, descripcion, direccion, telefono, email, ciudad) 
	VALUES ('{$nit}','{$nom}','{$des}','{$dir}','{$tel}','{$mail}','{$ciu}');";
	$result =$con -> query($query);
	$msg="";
	$i=$con->affected_rows;
	if ($i!=0){
		$msg="Cliente Almacenado con Exito!";
	}else{
		$msg="Error al Guardar!";
	}
	echo $msg;

?>
<?php

	include("../../config.php");
	$con=conectar();
	$nom=$_POST["nombre"];
	$des=$_POST["descripcion"];
	$query="INSERT INTO as_categoria(nombre, descripcion) VALUES ('".$nom."','".$des."');";
	$result =$con -> query($query);
	$msg="";
	$i=$con->affected_rows;
	if ($i!=0){
		$msg="Categoria Almacenada con Exito!";
	}else{
		$msg="Error al Guardar!";
	}
	echo $msg;

?>
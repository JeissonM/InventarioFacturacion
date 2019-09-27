<?php

	include("../../config.php");
	$con=conectar();
	$id=$_POST["id"];
	$nom=$_POST["nombre"];
	$des=$_POST["descripcion"];
	$query="UPDATE as_categoria SET nombre='".$nom."', descripcion='".$des."' WHERE id='".$id."';";
	$result =$con -> query($query);
	$msg="";
	$i=$con->affected_rows;
	if ($i!=0){
		$msg="Categoria Modificada con Exito!";
	}else{
		$msg="Error al Modificar!";
	}
	echo $msg;

?>
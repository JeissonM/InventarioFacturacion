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
	$query="UPDATE as_clientes SET nombre='{$nom}', descripcion='{$des}', direccion='{$dir}',
		telefono='{$tel}', email='{$mail}', ciudad='{$ciu}' WHERE nit='{$nit}';";
	$result =$con -> query($query);
	$msg="";
	$i=$con->affected_rows;
	if ($i!=0){
		$msg="Cliente Modificado con Exito!";
	}else{
		$msg="Error al Modificar!";
	}
	echo $msg;

?>
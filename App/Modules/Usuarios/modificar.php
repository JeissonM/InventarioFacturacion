<?php

	include("../../config.php");
	$con=conectar();
	$id=$_POST["id"];
	$nom=$_POST["nom"];
	$ape=$_POST["ape"];
	$dir=$_POST["dir"];
	$tel=$_POST["tel"];
	$mail=$_POST["mail"];
	$rol=$_POST["rol"];
	$pw=$_POST["pw"];
	$query=" UPDATE as_usuarios SET nombres='".$nom."',apellidos='".$ape."',direccion='".$dir."',telefono='".$tel."',email='".$mail."',rol='".$rol."',contrasenia=md5('".$pw."') WHERE identificacion='".$id."';";
	$result =$con -> query($query);
	$msg="";
	$i=$con->affected_rows;
	if ($i!=0){
		$msg="Usuario Modificado con Exito!";
	}else{
		$msg="Error al Modificar!";
	}
	echo $msg;

?>
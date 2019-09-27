<?php

	include("../../config.php");
	$con=conectar();
	$id=$_POST["id"];
	$nom=$_POST["nom"];
	$ape=$_POST["ape"];
	$dir=$_POST["dir"];
	$tel=$_POST["tel"];
	$mail=$_POST["email"];
	$rol=$_POST["rol"];
	$estudios=$_POST["est"];
	$notas=$_POST["not"];
	$perfilp=$_POST["pp"];
	$query=" UPDATE as_usuarios SET nombres='".$nom."',apellidos='".$ape."',direccion='".$dir."',telefono='".$tel."',email='".$mail."',rol='".$rol."', estudios='".$estudios."', notas='".$notas."', perfilp='".$perfilp."' WHERE identificacion='".$id."';";
	$result =$con -> query($query);
	$i=$con->affected_rows;
	if ($i!=0){
		$msg="Usuario Modificado con Exito!";
	}else{
		$msg="Error al Modificar!";
	}
	echo $msg;

?>
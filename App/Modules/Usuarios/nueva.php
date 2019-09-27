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
	$query="INSERT INTO as_usuarios(identificacion, nombres, apellidos, direccion, telefono, email, rol, contrasenia) VALUES('".$id."','".$nom."','".$ape."','".$dir."','".$tel."','".$mail."','".$rol."', md5('".$pw."'));";
	$query2="INSERT INTO as_privilegios(idUsuario) VALUES ('".$id."')";
	$result =$con -> query($query);
	$msg="";
	$i=$con->affected_rows;
	$result2 =$con -> query($query2);
	$i2=$con->affected_rows;
	if ($i!=0 and $i2!=0){
		$msg="Usuario registrado con Exito!";
	}else{
		$msg="Error al Guardar!";
	}
	echo $msg;

?>
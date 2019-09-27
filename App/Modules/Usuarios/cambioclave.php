<?php

	include("../../config.php");
	$con=conectar();
	$id=$_POST["id"];
	$cv=$_POST["cv"];
	$cn=$_POST["cn"];
	$query=" UPDATE as_usuarios SET contrasenia=md5('".$cn."') WHERE identificacion='".$id."';";
	$result =$con -> query($query);
	$msg="";
	$i=$con->affected_rows;
	if ($i!=0){
		$msg="Su contraseña ha sido cambiada!";
	}else{
		$msg="Error al cambiar!";
	}
	echo $msg;

?>
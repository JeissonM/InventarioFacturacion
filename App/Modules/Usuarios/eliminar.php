<?php

	include("../../config.php");
	$con=conectar();
	$nom=$_POST["id"];
	$query="DELETE FROM as_usuarios WHERE identificacion='".$nom."';";
	$query2="DELETE FROM as_privilegios WHERE idUsuario='".$nom."';";
	$result =$con -> query($query);
	$msg="";
	$i=$con->affected_rows;
	$result2 =$con -> query($query2);
	$i2=$con->affected_rows;
	if ($i>0 and $i2>0){
		$msg="Eliminado de forma Exitosa!";
	}else{
		$msg="Imposible Eliminar!";
	}
	echo $msg;

?>
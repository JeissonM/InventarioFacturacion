<?php

	include("../../config.php");
	$con=conectar();
	$nom=$_POST["id"];
	$query="DELETE FROM as_mensajes WHERE id='".$nom."';";
	$result =$con -> query($query);
	$msg="";
	if ($con->affected_rows>0){
		$msg="Eliminado de forma Exitosa!";
	}else{
		$msg="Imposible Eliminar!";
	}
	echo $msg;

?>
<?php

	include("../../config.php");
	$con=conectar();
	$query="INSERT INTO as_mensajes(de, para, asunto, mensaje, borrador) VALUES ('".$_POST['de']."','".$_POST['para']."','".$_POST['asunto']."','".$_POST['mensaje']."','".$_POST['borrador']."');";
	$result =$con -> query($query);
	$msg="";
	$i=$con->affected_rows;
	if ($i!=0){
		$msg="Mensaje guardado con Exito!";
	}else{
		$msg="No se pudo guardar el mensaje";
	}
	echo $msg;

?>
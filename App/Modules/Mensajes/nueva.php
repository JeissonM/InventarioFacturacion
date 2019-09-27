<?php

	include("../../config.php");
	$con=conectar();
	$query="INSERT INTO as_mensajes(de, para, asunto, mensaje, estado) VALUES ('".$_POST['de']."','".$_POST['para']."','".$_POST['asunto']."','".$_POST['mensaje']."','".$_POST['estado']."');";
	$result =$con -> query($query);
	$msg="";
	$i=$con->affected_rows;
	if ($i!=0){
		$msg="Mensaje Enviado con Exito!";
	}else{
		$msg="No se pudo enviar el mensaje";
	}
	echo $msg;
?>
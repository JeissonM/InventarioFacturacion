<?php

	include("../../config.php");
	$con=conectar();
	$res=$_POST["res"];
	$num=$_POST["num"];
	$nit=$_POST["nit"];
	$dir=$_POST["dir"];
	$web=$_POST["pag"];
	$tel=$_POST["tel"];
	$fecha=$_POST["fecha"];
	$query="INSERT INTO as_configuraciones(resolucion, numeracion, nit, direccion, pagina, telefonos, fecha) 
	VALUES ('{$res}','{$num}','{$nit}','{$dir}','{$web}','{$tel}','{$fecha}');";
	$result =$con -> query($query);
	$msg="";
	$i=$con->affected_rows;
	if ($i!=0){
		$msg="Configuracion Almacenada con Exito!";
	}else{
		$msg="Error al Guardar!";
	}
	echo $msg;

?>
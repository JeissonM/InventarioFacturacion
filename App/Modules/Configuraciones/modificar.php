<?php

	include("../../config.php");
	$con=conectar();
	$id=$_POST["id"];
	$res=$_POST["res"];
	$num=$_POST["num"];
	$nit=$_POST["nit"];
	$dir=$_POST["dir"];
	$web=$_POST["pag"];
	$tel=$_POST["tel"];
	$fecha=$_POST["fecha"];
	$query="UPDATE as_configuraciones SET resolucion='{$res}', numeracion='{$num}', 
	nit='{$nit}' , direccion='{$dir}' , pagina='{$web}', telefonos='{$tel}', fecha='{$fecha}' WHERE id='{$id}';";
	$result =$con -> query($query);
	$msg="";
	$i=$con->affected_rows;
	if ($i!=0){
		$msg="Configuracion Modificada con Exito!";
	}else{
		$msg="Error al Modificar!";
	}
	echo $msg;

?>
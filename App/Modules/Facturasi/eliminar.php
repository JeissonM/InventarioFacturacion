<?php

	include("../../config.php");
	$con=conectar();
	$id=$_POST["id"];

	$query="DELETE FROM as_defactura WHERE nofactura='{$id}';";
	$query2="DELETE FROM as_detalle_factura_de WHERE idfactura='{$id}';";
	$result =$con -> query($query);
	$msg="";
	if ($con->affected_rows>0){
		$result =$con -> query($query2);
		if ($con->affected_rows>0){
			$msg="Eliminado de forma Exitosa!";
		}else{
		$msg="Imposible Eliminar!";
		}
	}else{
		$msg="Imposible Eliminar!";
	}
	echo $msg;

?>
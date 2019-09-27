<?php

	include("../../config.php");
	$con=conectar();
	$id=$_POST["id2"];
	$query="SELECT id, nombre, descripcion, precio, impuesto FROM as_servicios WHERE id='".$id."';";
	$result =$con -> query($query);
	$msg="";
	if ($con->affected_rows>0){
		while ($row=$result -> fetch_assoc()) {
			$msg=$row["id"].";".$row["nombre"].";".$row["descripcion"].";".$row["precio"].";".$row["impuesto"];
		}
	}else{
		$msg="<p>Este servicio no tiene datos asociados...</p>";
	}
	echo $msg;

?>
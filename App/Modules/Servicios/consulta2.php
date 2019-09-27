<?php

	include("../../config.php");
	$con=conectar();
	$id=$_POST["id"];
	$query="SELECT * FROM as_servicios WHERE idcategoria='".$id."';";
	$result =$con -> query($query);
	$msg="";
	if ($con->affected_rows>0){
		$msg="<select class='form-control' name='ser' id='ser' onchange='cambio()'><option value='0'>Seleccione...</option>";
		while ($row=$result -> fetch_assoc()) {
			$msg=$msg."<option value='".$row['id']."'>".$row['nombre']."</option>";
		}
		$msg=$msg."</select>";

	}else{
		$msg="<p>Esta Categoria no tiene servicios asociados...</p>";
	}
	echo $msg;

?>
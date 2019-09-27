<?php

	include("../../config.php");
	$con=conectar();
	$fi=$_POST["fi"];
	$ff=$_POST["ff"];
	$nit=$_POST["nit"];
	$query="SELECT SUM(impuesto) as iva FROM `as_factura` WHERE fecha BETWEEN '{$fi}' AND '{$ff}' AND nit='{$nit}';";
	$result =$con -> query($query);
	$msg="";
	if ($con->affected_rows>0){
		$msg="<center><h3 class='box-title'>Total IVA Generado para el Periodo Seleccionado: ";
		while ($row=$result -> fetch_assoc()) {
			$msg=$msg."$ ".$row["iva"];
		}
		$msg=$msg."</h3></center>";

	}else{
		$msg="<p>La consulta no econtro ningun resultado!</p>";
	}
	echo $msg;

?>
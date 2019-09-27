<?php

	include("../../config.php");
	$con=conectar();
	$query="SELECT * FROM `as_factura` ORDER BY id DESC LIMIT 1;";
	$result =$con -> query($query);
	$msg="";
	$i=$con->affected_rows;
	if ($i==0){
		$msg="1";
	}
	if($i>0){
		while ($row=$result -> fetch_assoc()) {
			$msg=$row["nofactura"]+1;
		}
	}
	echo $msg;
?>
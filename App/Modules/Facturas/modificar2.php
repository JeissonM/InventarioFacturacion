<?php

	include("../../config.php");
	$con=conectar();
	$id=$_POST["nro"];
	$pago=$_POST["pago"];
	$tipo=$_POST["tipo"];
	$msg="";
	if ($tipo==="FINAL"){
		$query="UPDATE as_factura SET saldo='".$pago."' WHERE nofactura='".$id."';";
		$result =$con -> query($query);
		$i=$con->affected_rows;
		if ($i!=0){
			$query2="UPDATE as_factura SET estado='PAGADO' WHERE nofactura='".$id."';";
			$result =$con -> query($query2);
			$j=$con->affected_rows;
			if ($j!=0){
				$msg="Pago Realizado con Exito!";
			}else{
				$msg="Fue Registrado el pago, pero no pudo cambiarse el estado de PENDIENTE a PAGADO!";
			}
		}else{
			$msg="Error al Actualizaar Pago!";
		}
	}elseif($tipo==="NO"){
		$query="UPDATE as_factura SET saldo='".$pago."' WHERE nofactura='".$id."';";
		$result =$con -> query($query);
		$i=$con->affected_rows;
		if ($i!=0){
			$msg="Pago Realizado con Exito!";
		}else{
			$msg="Error al Actualizaar Pago!";
		}
	}
	echo $msg;
?>
<?php

	include("../../config.php");
	$str=$_POST["str"];
	$con=conectar();
	$id=explode(";",$str)[0];
	$perfil=explode(";",$str)[1];
	$mensajes=explode(";",$str)[2];
	$datos=explode(";",$str)[3];
	$factura=explode(";",$str)[4];
	$facturai=explode(";",$str)[5];
	$reportes=explode(";",$str)[6];
	$usuarios=explode(";",$str)[7];
	$clientes=explode(";",$str)[8];
	$config=explode(";",$str)[9];
	$prov=explode(";", $str)[10];
	$query="UPDATE as_privilegios SET perfil='".$perfil."',mensajes='".$mensajes."',datos='".$datos."',
	factura='".$factura."',facturai='".$facturai."',reportes='".$reportes."',
	usuarios='".$usuarios."',config='".$config."', clientes='".$clientes."', proveedores='".$prov."' WHERE idUsuario='".$id."'";
	$result =$con -> query($query);
	$msg="";
	$i=$con->affected_rows;
	if ($i==1){
		$msg="Privilegios almacenados!";
	}else{
		$msg="Error al Guardar!";
	}
	echo $msg;

?>
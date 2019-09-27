<?php
	session_start();
	include("../../config.php");
	$con=conectar();
	$query="SELECT m.id, m.de, (SELECT u.nombres FROM as_usuarios u WHERE u.identificacion=m.de) as den, m.para, (SELECT u.nombres FROM as_usuarios u WHERE u.identificacion=m.para) as paran, m.asunto, m.mensaje, m.fecha, m.estado, m.borrador FROM as_mensajes m ORDER BY fecha desc;";
	$result =$con -> query($query);
	$msg="";
	if ($con->affected_rows>0){
		$msg="<table id='table1' class='table table-hover table-striped'>
			<tbody>";
		while ($row=$result -> fetch_assoc()) {
			
			if ($row["borrador"]==="NO"){
				if ($row["de"]==$_SESSION["id"]){
					$msg=$msg."<tr><td class='mailbox-name'><a href='leermsj.php?para=".$row["paran"]."&de=".$row["den"]."&asunto=".$row["asunto"]."&mensaje=".$row["mensaje"]."&fecha=".$row["fecha"]."&id=".$row["id"]."'>".$row["den"]."</a></td>
											<td class='mailbox-subject'><b>".$row["asunto"]."</b></td>
				                    		<td class='mailbox-date'>".$row["fecha"]."</td>
				                    		<td><button type='button' class='btn btn-danger btn-xs' id='".$row["id"]."' onclick='eliminar(this.id)'><i class='fa fa-trash-o'></i></button></td>		
									</tr>";
				}
			}
			
			
		}
		$msg=$msg."</tbody></table>";

	}else{
		$msg="<p>No Hay Mensajes nuevos!</p>";
	}
	echo $msg;


?>
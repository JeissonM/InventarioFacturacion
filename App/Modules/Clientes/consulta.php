<?php

	include("../../config.php");
	$con=conectar();
	$nom=$_POST["nombre"];
	$query="SELECT *FROM as_clientes WHERE nombre like '%".$nom."%';";
	$result =$con -> query($query);
	$msg="";
	if ($con->affected_rows>0){
		$msg="<table id='tablen' class='table table-bordered table-hover' cellspacing='0' width='100%'>
				<thead>
					<th>Nit</th>
					<th>Nombre</th>
					<th>Descripción</th>
					<th>Dirección</th>
					<th>Telefono</th>
					<th>E-mail</th>
					<th>Ciudad</th>
					<th><center>Acciones</center></th>
				</thead>
			<tbody>";
		while ($row=$result -> fetch_assoc()) {
			$msg=$msg."<tr>
							<td>".$row["nit"]."</td>
							<td>".$row["nombre"]."</td>
							<td>".$row["descripcion"]."</td>
							<td>".$row["direccion"]."</td>
							<td>".$row["telefono"]."</td>
							<td>".$row["email"]."</td>
							<td>".$row["ciudad"]."</td>
							<td><center><button class='btn btn-success btn-md btn-xs' id='".$row["nit"].';'.$row["nombre"].';'.$row["descripcion"].';'.$row["direccion"].';'.$row["telefono"].';'.$row["email"].';'.$row["ciudad"]."' onClick='javascript:ponerDatos(this.id)' data-toggle='modal' data-target='#myModalE'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;&nbsp;<button class='btn btn-danger btn-md btn-xs' id='".$row["nit"]."' onClick='javascript:eliminar(this.id)'><i class='fa fa-remove'></i></button></center></td>
						</tr>";
		}
		$msg=$msg."</tbody></table>";

	}else{
		$msg="<p id='tablen'>La consulta no econtro ningun resultado!</p>";
	}
	echo $msg;

?>
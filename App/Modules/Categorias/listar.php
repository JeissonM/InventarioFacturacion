<?php

	include("../../config.php");
	$con=conectar();
	$query="SELECT *FROM as_categoria ORDER BY nombre asc;";
	$result =$con -> query($query);
	$msg="";
	if ($con->affected_rows>0){
		$msg="<table id='table1' class='table table-bordered table-hover' cellspacing='0' width='100%'>
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Descripción</th>
					<th><center>Acciones</center></th>
				</thead>
			<tbody>";
		while ($row=$result -> fetch_assoc()) {
			$msg=$msg."<tr>
							<td>".$row["id"]."</td>
							<td>".$row["nombre"]."</td>
							<td>".$row["descripcion"]."</td>
							<td><center><button class='btn btn-success btn-md btn-xs' id='".$row["id"].';'.$row["nombre"].';'.$row["descripcion"]."' onClick='javascript:ponerDatos(this.id)' data-toggle='modal' data-target='#myModalE'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;&nbsp;<button class='btn btn-danger btn-md btn-xs' id='".$row["id"]."' onClick='javascript:eliminar(this.id)'><i class='fa fa-remove'></i></button></center></td>
						</tr>";
		}
		$msg=$msg."</tbody></table>";

	}else{
		$msg="<p>No Hay Datos!</p>";
	}
	echo $msg;

?>
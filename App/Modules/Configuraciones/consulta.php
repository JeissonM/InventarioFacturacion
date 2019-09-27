<?php

	include("../../config.php");
	$con=conectar();
	$nom=$_POST["nombre"];
	$query="SELECT *FROM as_configuraciones WHERE id like '%".$nom."%';";
	$result =$con -> query($query);
	$msg="";
	if ($con->affected_rows>0){
		$msg="<table id='table' class='table table-bordered table-hover' cellspacing='0' width='100%'>
				<thead>
					<th>Id</th>
					<th>Resolucion</th>
					<th>Fecha Resolucion</th>
					<th>Numeracion Habilitada</th>
					<th>NIT</th>
					<th>Direccion</th>
					<th>Pagina Web</th>
					<th>Telefonos</th>
					<th><center>Acciones</center></th>
				</thead>
			<tbody>";
		while ($row=$result -> fetch_assoc()) {
			$msg=$msg."<tr>
							<td>".$row["id"]."</td>
							<td>".$row["resolucion"]."</td>
							<td>".$row["fecha"]."</td>
							<td>".$row["numeracion"]."</td>
							<td>".$row["nit"]."</td>
							<td>".$row["direccion"]."</td>
							<td>".$row["pagina"]."</td>
							<td>".$row["telefonos"]."</td>
							<td><center><button class='btn btn-success btn-md btn-xs' id='".$row["id"].';'.$row["resolucion"].';'.$row["fecha"].';'.$row["numeracion"].';'.$row["nit"].';'.$row["direccion"].';'.$row["pagina"].';'.$row["telefonos"]."' onClick='javascript:ponerDatos(this.id)' data-toggle='modal' data-target='#myModalE'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;&nbsp;<button class='btn btn-danger btn-md btn-xs' id='".$row["id"]."' onClick='javascript:eliminar(this.id)'><i class='fa fa-remove'></i></button></center></td>
						</tr>";
		}
		$msg=$msg."</tbody></table>";

	}else{
		$msg="<p id='table'>La consulta no econtro ningun resultado!</p>";
	}
	echo $msg;

?>
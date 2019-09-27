<?php

	include("../../config.php");
	$con=conectar();
	$fi=$_POST["fi"];
	$ff=$_POST["ff"];
	$nit=$_POST["nit"];
	$query="SELECT * FROM `as_defactura` WHERE fecha BETWEEN '{$fi}' AND '{$ff}' AND nit='{$nit}';";
	$result =$con -> query($query);
	$msg="";
	if ($con->affected_rows>0){
		$msg="<table id='table1' class='table table-bordered table-hover' cellspacing='0' width='100%'>
				<thead>
					<th>Id</th>
					<th>No. Factura</th>
					<th>Fecha</th>
					<th>Cliente</th>
					<th>NIT</th>
					<th>Direccion</th>
					<th>Ciudad</th>
					<th>Telefono</th>
					<th>SubTotal</th>
					<th>Impuesto</th>
					<th>Total</th>
					<th><center>Acciones</center></th>
				</thead>
			<tbody>";
		while ($row=$result -> fetch_assoc()) {
			$msg=$msg."<tr>
							<td>".$row["id"]."</td>
							<td>".$row["nofactura"]."</td>
							<td>".$row["fecha"]."</td>
							<td>".$row["cliente"]."</td>
							<td>".$row["nit"]."</td>
							<td>".$row["direccion"]."</td>
							<td>".$row["ciudad"]."</td>
							<td>".$row["telefono"]."</td>
							<td>".$row["subtotal"]."</td>
							<td>".$row["impuesto"]."</td>
							<td>".$row["total"]."</td>
							<td><center><button class='btn btn-primary btn-md btn-xs' id='".$row["nofactura"]."&tipo=normal' onClick='javascript:ver(this.id)'><i class='fa fa-eye'></i></button></center></td>
						</tr>";
		}
		$msg=$msg."</tbody></table>";

	}else{
		$msg="<p>La consulta no econtro ningun resultado!</p>";
	}
	echo $msg;

?>
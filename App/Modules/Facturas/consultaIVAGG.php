<?php

	include("../../config.php");
	$con=conectar();
	$fi=$_POST["fi"];
	$ff=$_POST["ff"];
	$query="SELECT * FROM `as_factura` WHERE fecha BETWEEN '{$fi}' AND '{$ff}';";
	$result =$con -> query($query);
	$msg="";
	if ($con->affected_rows>0){
		$msg="<table id='table1' class='table table-bordered table-hover' cellspacing='0' width='100%'>
				<thead>
					<th>No. Factura</th>
					<th>Fecha</th>
					<th>Cliente</th>
					<th>NIT</th>
					<th>Direccion</th>
					<th>Telefono</th>
					<th>SubTotal</th>
					<th>Impuesto</th>
					<th>Total</th>
					<th>Estado</th>
					<th>Saldo</th>
					<th><center>Acciones</center></th>
				</thead>
			<tbody>";
		while ($row=$result -> fetch_assoc()) {
			if($row["estado"]==="PENDIENTE"){
				$msg=$msg."<tr class='danger'>
							<td>".$row["nofactura"]."</td>
							<td>".$row["fecha"]."</td>
							<td>".$row["cliente"]."</td>
							<td>".$row["nit"]."</td>
							<td>".$row["direccion"]."</td>
							<td>".$row["telefono"]."</td>
							<td>".$row["subtotal"]."</td>
							<td>".$row["impuesto"]."</td>
							<td>".$row["total"]."</td>
							<td>".$row["estado"]."</td>
							<td>".$row["saldo"]."</td>
							<td><center><button class='btn btn-primary btn-md btn-xs' id='".$row["nofactura"]."&tipo=normal' onClick='javascript:ver(this.id)'><i class='fa fa-eye'></i></button></center></td>
						</tr>";
			}else{
				$msg=$msg."<tr class='success'>
							<td>".$row["nofactura"]."</td>
							<td>".$row["fecha"]."</td>
							<td>".$row["cliente"]."</td>
							<td>".$row["nit"]."</td>
							<td>".$row["direccion"]."</td>
							<td>".$row["telefono"]."</td>
							<td>".$row["subtotal"]."</td>
							<td>".$row["impuesto"]."</td>
							<td>".$row["total"]."</td>
							<td>".$row["estado"]."</td>
							<td>".$row["saldo"]."</td>
							<td><center><button class='btn btn-primary btn-md btn-xs' id='".$row["nofactura"]."&tipo=normal' onClick='javascript:ver(this.id)'><i class='fa fa-eye'></i></button></center></td>
						</tr>";
			}
		}
		$msg=$msg."</tbody></table>";

	}else{
		$msg="<p>La consulta no econtro ningun resultado!</p>";
	}
	echo $msg;

?>
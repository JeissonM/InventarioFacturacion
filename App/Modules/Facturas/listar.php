<?php

	include("../../config.php");
	$con=conectar();
	$query="SELECT * FROM `as_factura` ORDER BY fecha DESC;";
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
								<td><center><button class='btn btn-danger btn-md btn-xs' id='".$row["nofactura"]."' onClick='javascript:eliminar(this.id)'><i class='fa fa-remove'></i></button>
								<button class='btn btn-primary btn-md btn-xs' id='".$row["nofactura"]."&tipo=normal' onClick='javascript:ver(this.id)'><i class='fa fa-eye'></i></button>
								<button class='btn btn-success btn-md btn-xs' id='".$row["nofactura"].";".$row["saldo"]."' onClick='javascript:ponerPago(this.id)' data-toggle='modal' data-target='#myModalE'><i class='fa fa-money'></i></button>
								<button class='btn btn-warning btn-md btn-xs' id='".$row["nofactura"]."' onClick='javascript:verFacn(this.id)'><i class='fa fa-print'></i></button></center></td>
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
								<td><center><button class='btn btn-danger btn-md btn-xs' id='".$row["nofactura"]."' onClick='javascript:eliminar(this.id)'><i class='fa fa-remove'></i></button>
								<button class='btn btn-primary btn-md btn-xs' id='".$row["nofactura"]."&tipo=normal' onClick='javascript:ver(this.id)'><i class='fa fa-eye'></i></button>
								<button class='btn btn-warning btn-md btn-xs' id='".$row["nofactura"]."' onClick='javascript:verFacn(this.id)'><i class='fa fa-print'></i></button></center></td>
							</tr>";
			}
		}
		$msg=$msg."</tbody></table>";

	}else{
		$msg="<p>No Hay Datos!</p>";
	}
	echo $msg;

?>
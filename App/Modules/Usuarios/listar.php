<?php

	include("../../config.php");
	$con=conectar();
	$query="SELECT u.identificacion, u.nombres, u.apellidos, u.direccion, u.telefono, u.email, u.rol, u.contrasenia, u.path, u.estudios, u.notas, u.perfilp,(SELECT p.perfil FROM as_privilegios p WHERE p.idUsuario=u.identificacion) as perfil,(SELECT p.mensajes FROM as_privilegios p WHERE p.idUsuario=u.identificacion) as mensajes,(SELECT p.datos FROM as_privilegios p WHERE p.idUsuario=u.identificacion) as datos,(SELECT p.factura FROM as_privilegios p WHERE p.idUsuario=u.identificacion) as factura,(SELECT p.facturai FROM as_privilegios p WHERE p.idUsuario=u.identificacion) as facturai,(SELECT p.reportes FROM as_privilegios p WHERE p.idUsuario=u.identificacion) as reportes,(SELECT p.usuarios FROM as_privilegios p WHERE p.idUsuario=u.identificacion) as usuarios,(SELECT p.clientes FROM as_privilegios p WHERE p.idUsuario=u.identificacion) as clientes,(SELECT p.config FROM as_privilegios p WHERE p.idUsuario=u.identificacion) as config,(SELECT p.proveedores FROM as_privilegios p WHERE p.idUsuario=u.identificacion) as prov FROM as_usuarios u ORDER BY nombres asc;";
	$result =$con -> query($query);
	$msg="";
	if ($con->affected_rows>0){
		$msg="<table id='table1' class='table table-bordered table-hover' cellspacing='0' width='100%'>
				<thead>
					<th>Identificacion</th>
					<th>Nombres</th>
					<th>Apellidos</th>
					<th>Direccion</th>
					<th>Telefono</th>
					<th>E-mail</th>
					<th>Rol</th>
					<th><center>Acciones</center></th>
				</thead>
			<tbody>";
		while ($row=$result -> fetch_assoc()) {
			$msg=$msg."<tr>
							<td>".$row["identificacion"]."</td>
							<td>".$row["nombres"]."</td>
							<td>".$row["apellidos"]."</td>
							<td>".$row["direccion"]."</td>
							<td>".$row["telefono"]."</td>
							<td>".$row["email"]."</td>
							<td>".$row["rol"]."</td>
							<td><center><button class='btn btn-success btn-md btn-xs' id='".$row["identificacion"].';'.$row["nombres"].';'.$row["apellidos"].';'.$row["direccion"].';'.$row["telefono"].';'.$row["email"].';'.$row["rol"]."' onClick='javascript:ponerDatos(this.id)' data-toggle='modal' data-target='#myModalE'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;&nbsp;<button class='btn btn-danger btn-md btn-xs' id='".$row["identificacion"]."' onClick='javascript:eliminar(this.id)'><i class='fa fa-remove'></i></button>&nbsp;&nbsp;&nbsp;<button class='btn btn-info btn-md btn-xs' id='".$row["identificacion"].';'.$row["nombres"].';'.$row["perfil"].';'.$row["mensajes"].';'.$row["datos"].';'.$row["factura"].';'.$row["facturai"].';'.$row["reportes"].';'.$row["usuarios"].';'.$row["clientes"].';'.$row["config"].';'.$row["prov"]."' onClick='javascript:cargaidp(this.id)' data-toggle='modal' data-target='#ModalPrivilegios'><i class='fa fa-unlock'></i></button></center></td>
						</tr>";
		}
		$msg=$msg."</tbody></table>";

	}else{
		$msg="<p>No Hay Datos!</p>";
	}
	echo $msg;

?>
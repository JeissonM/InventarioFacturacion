<?php

include("../../config.php");
$con = conectar();
$query = "SELECT s.id, s.nombre, s.descripcion, s.precio, s.impuesto, s.idcategoria, (SELECT c.nombre FROM as_categoria c WHERE c.id=s.idcategoria) as categoria, s.precio_venta, s. existencia, s.unidad_medida FROM as_servicios s;";
$result = $con->query($query);
$msg = "";
if ($con->affected_rows > 0) {
    $msg = "<table id='tablen' class='table table-bordered table-hover' cellspacing='0' width='100%'>
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Descripción</th>
					<th>Precio Compra</th>
					<th>Precio Venta</th>
                                        <th>Impuesto %</th>
                                        <th>Existencia</th>
					<th>Categoria</th>
					<th><center>Acciones</center></th>
				</thead>
			<tbody>";
    while ($row = $result->fetch_assoc()) {
        $msg = $msg . "<tr>
							<td>" . $row["id"] . "</td>
							<td>" . $row["nombre"] . "</td>
							<td>" . $row["descripcion"] . "</td>
							<td>$ " . $row["precio"] . "</td>
                                                        <td>$ " . $row["precio_venta"] . "</td>
							<td>" . $row["impuesto"] . "%</td>
                                                        <td>" . $row["existencia"] . "  (" . $row["unidad_medida"] . ")</td>
							<td>" . $row["categoria"] . "</td>
							<td><center><button class='btn btn-success btn-md btn-xs' id='" . $row["id"] . ';' . $row["nombre"] . ';' . $row["descripcion"] . ';' . $row["precio"] . ';' . $row["impuesto"] . ';' . $row["categoria"] . ";" . $row["precio_venta"] . ";" . $row["existencia"] . ";" . $row["unidad_medida"] . "' onClick='javascript:ponerDatos(this.id)' data-toggle='modal' data-target='#myModalE'><i class='fa fa-edit'></i></button>&nbsp;&nbsp;&nbsp;<button class='btn btn-danger btn-md btn-xs' id='" . $row["id"] . "' onClick='javascript:eliminar(this.id)'><i class='fa fa-remove'></i></button></center></td>
						</tr>";
    }
    $msg = $msg . "</tbody></table>";
} else {
    $msg = "<p>No hay Datos!</p>";
}
echo $msg;
?>
<?php

include("../../config.php");
$con = conectar();
$query = "SELECT s.id, s.nombre, s.descripcion, s.precio, s.impuesto, s.idcategoria, (SELECT c.nombre FROM as_categoria c WHERE c.id=s.idcategoria) as categoria, s.precio_venta, s. existencia, s.unidad_medida FROM as_servicios s WHERE idcategoria='" . $_GET['id'] . "';";
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
                                                        </tr>";
    }
    $msg = $msg . "</tbody></table>";
} else {
    $msg = "<p>No hay Datos!</p>";
}
echo $msg;
?>
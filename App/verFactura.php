<?php
session_start();
if (empty($_SESSION["logged"])) {
    echo "<script type=\"text/javascript\">alert(\"No tiene permiso para entrar a este apartado\");</script>";
    header("Location: ../index.html");
    exit;
}
include("cabecera.php");
head();
menuTop();
menu("ver");
$nrof = $_GET["id"];
$tipo = $_GET["tipo"];
$query = "";
if ($tipo === "normal") {
    $query = "SELECT *FROM as_factura WHERE nofactura='{$nrof}' ORDER BY fecha desc;";
} elseif ($tipo === "inversa") {
    $query = "SELECT *FROM as_defactura WHERE nofactura='{$nrof}' ORDER BY fecha desc;";
}
$con = conectar();
$result = $con->query($query);
if ($con->affected_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nofactura = $row["nofactura"];
        $fecha = $row["fecha"];
        $cliente = $row["cliente"];
        $nit = $row["nit"];
        $direccion = $row["direccion"];
        $ciudad = $row["ciudad"];
        $telefono = $row["telefono"];
        $subtotal = $row["subtotal"];
        $impuesto = $row["impuesto"];
        $total = $row["total"];
    }
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Visor de Facturas 
            <small>Ferretería FerroCoyot | Admin</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home"></i> Inicio</a></li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">

        <div class="box box-primary color-palette-box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-cart-plus"></i> Factura de Compra o Venta</h3></br></br>
                <form class="form-horizontal" id="con" name="con">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Numero de la Factura</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="nofactura" name="nofactura" value="<?php echo $nofactura ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Fecha Facturacion</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $fecha ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Cliente/Proveedor</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="cliente" name="cliente" value="<?php echo $cliente ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">NIT</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nitc" name="nitc" value="<?php echo $nit ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputName" class="col-sm-1 control-label">Direccion</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $direccion ?>">
                        </div>
                        <label for="inputName" class="col-sm-1 control-label">Ciudad</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="ciudad" name="ciudad" value="<?php echo $ciudad ?>">
                        </div>
                        <label for="inputName" class="col-sm-1 control-label">Telefono</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12" id="tablaser" name="tablaser">
                            <table id='tablen' class='table table-bordered table-hover' cellspacing='0' width='100%'>
                                <thead>
                                    <tr>
                                        <th>Activo/Pasivo</th>
                                        <th>Cantidad</th>
                                        <th>Valor Unitario</th>
                                        <th>% Impuesto</th>
                                        <th>Total Impuesto</th>
                                        <th>Valor Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($tipo === "normal") {
                                        $query = "SELECT *FROM as_detalle_factura WHERE idfactura={$nrof};";
                                    } elseif ($tipo === "inversa") {
                                        $query = "SELECT *FROM as_detalle_factura_de WHERE idfactura={$nrof};";
                                    }
                                    $con = conectar();
                                    $result = $con->query($query);
                                    if ($con->affected_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>
                                              <td>" . $row['nombre_des'] . "</td>
                                              <td>" . $row['cant'] . "</td>
                                              <td>" . $row['valoru'] . "</td>
                                              <td>" . $row['porimp'] . "</td>
                                              <td>" . $row['valorimp'] . "</td>
                                              <td>" . $row['valtotal'] . "</td>
                                            </tr>";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>

                        </div>

                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-1 control-label">Sub Total</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="st" name="st" readonly="readonly" value="<?php echo $subtotal ?>">
                        </div>

                        <label for="inputName" class="col-sm-1 control-label">Valor Impuesto</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="impv" name="impv" readonly="readonly" value="<?php echo $impuesto ?>">
                        </div>
                        <label for="inputName" class="col-sm-1 control-label">Total</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="tota" name="tota" readonly="readonly" value="<?php echo $total ?>">
                        </div>
                    </div>
                    <!-- /.row -->
                    </br>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="button" name="btn2" id="btn2" class="btn btn-success btn-md btn-block" onclick="volver()"><i class="fa fa-mail-reply"></i> Volver</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
pie();
?>
<script type="text/javascript">
    function volver() {
        history.back(1);
    }
</script>
<?php
fin();
?>

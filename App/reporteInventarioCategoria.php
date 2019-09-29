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
menu("reportes");
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Reportes Generales
            <small>Ferretería FerroCoyot | Admin</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="reportes.php"><i class="fa fa-file-pdf-o"></i> Reportes</a></li>
            <li class="active"><a href="reporteInventarioCategoria.php"><i class="fa fa-list"></i> Reporte Inventario por Categoría</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">

        <div class="box box-primary color-palette-box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-file-pdf-o"></i> Reporte de Inventario Por Categoría (Existencia)</h3> 
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label class="col-xs-12 control-label">Seleccione Categoria de Producto</label>
                    <div class="col-xs-12 selectContainer">
                        <select class="form-control" name="cat" id="cat" onchange="ir()">
                            <?php
                            $con = conectar();
                            $query = "SELECT *FROM as_categoria";
                            $result = $con->query($query);
                            if ($con->affected_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
pie();
?>
<script type="text/javascript">
    function ir() {
        var id = 0;
        id = $("#cat").val();
        var url = urlg + "/reporteInventario.php?id=" + id + "&modo=CATEGORIA";
        var a = document.createElement("a");
        a.target = "_blank";
        a.href = url;
        a.click();
    }
</script>
<?php
fin();
?>
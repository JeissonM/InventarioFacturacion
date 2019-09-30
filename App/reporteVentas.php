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
            <li class="active"><a href="reporteVentas.php"><i class="fa fa-list"></i> Reporte de Ventas por Fecha</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">

        <div class="box box-primary color-palette-box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-file-pdf-o"></i> Reporte de Ventas Por Fecha</h3> 
            </div>
            <div class="box-body">
                <div class="form-group">
                    <div class="col-md-4 selectContainer">
                        <label class="control-label">Fecha Inicial</label>
                        <input type="date" class="form-control" id="f1" />
                    </div>
                    <div class="col-md-4 selectContainer">
                        <label class="control-label">Fecha Final</label>
                        <input type="date" class="form-control" id="f2" />
                    </div>
                    <div class="col-md-4 selectContainer">
                        <button style="margin-top: 25px" onclick="ir()" type="button" class="btn btn-sm btn-block btn-primary"><i class="fa fa-print"></i> GENERAR REPORTE</button>
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
        var f1 = $("#f1").val();
        var f2 = $("#f2").val();
        var url = urlg + "/reporteVentasPrint.php?f1=" + f1 + "&f2=" + f2 + "";
        var a = document.createElement("a");
        a.target = "_blank";
        a.href = url;
        a.click();
    }
</script>
<?php
fin();
?>
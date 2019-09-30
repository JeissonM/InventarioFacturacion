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
            <li class="active"><a href="reportes.php"><i class="fa fa-file-pdf-o"></i> Reportes</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">

        <div class="box box-primary color-palette-box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-file-pdf-o"></i> Reportes Generales</h3> 
            </div>
            <ul class="list-group">
                <a href="igg.php"><li class="list-group-item" id="report"><span class="badge"><i class="fa fa-file-pdf-o"></i></span>IVA Generado General</li></a>
                <a href="ign.php"><li class="list-group-item" id="report"><span class="badge"><i class="fa fa-file-pdf-o"></i></span>IVA Generado por NIT</li></a>
                <a href="idg.php"><li class="list-group-item" id="report"><span class="badge"><i class="fa fa-file-pdf-o"></i></span>IVA Descontable General</li></a>
                <a href="idn.php"><li class="list-group-item" id="report"><span class="badge"><i class="fa fa-file-pdf-o"></i></span>IVA Descontable por NIT</li></a>
                <a href="reporteInventario.php?id=0&modo=TODOS" target="_blank"><li class="list-group-item" id="report"><span class="badge"><i class="fa fa-file-pdf-o"></i></span>Reporte de Inventario (Existencia)</li></a>
                <a href="reporteInventarioCategoria.php"><li class="list-group-item" id="report"><span class="badge"><i class="fa fa-file-pdf-o"></i></span>Reporte de Inventario Por Categoría (Existencia)</li></a>
                <a href="reporteVentas.php"><li class="list-group-item" id="report"><span class="badge"><i class="fa fa-file-pdf-o"></i></span>Reporte de Ventas Por Fechas</li></a>
            </ul>

            <!-- /.box-body -->
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
pie();
fin();
?>
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
menu("gestion");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Gestion de Categorias de Productos
            <small>Ferretería FerroCoyot | Admin</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="#"><i class="fa fa-database"></i> Gestionar Datos</a></li>
            <li><a href="categorias.php"><i class="fa fa-folder-open-o"></i> Categorias de Productos</a></li>
            <li class="active"><a href="categoriasservicios.php?id=<?php echo $_GET['id']; ?>"><i class="fa fa-list"></i> Productos</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary color-palette-box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-folder-open-o"></i> Listado de Productos de la Categoría Seleccionada &nbsp;&nbsp;| &nbsp;&nbsp;</h3> 
            </div>
            <div class="box-body">
                <div class="row">
                    <input type="hidden" id="id" value="<?php echo $_GET['id']; ?>" />
                    <div class="col-sm-12 col-md-12 table-responsive" id="tabla" name="tabla">


                    </div>
                </div>
                <!-- /.row -->
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
<script type="text/javascript" src="js/categoriasservicios.js"></script>
<?php
fin();
?>
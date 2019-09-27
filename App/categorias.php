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
            Gestion de Categorias de Servicios
            <small>Ferretería FerroCoyot | Admin</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="#"><i class="fa fa-database"></i> Gestionar Datos</a></li>
            <li class="active"><a href="categorias.php"><i class="fa fa-folder-open-o"></i> Categorias de Servicios</a></li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="box box-primary color-palette-box">
            <div class="box-header with-border">
                <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Crear Categoria</button>
            </div>
        </div>

        <div class="box box-primary color-palette-box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-search"></i> Consulta de Categoria</h3>
                <form class="form-horizontal" id="con" name="con">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Consultar por Nombre</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName" name="inputName" onkeyup="consultar()" placeholder="Nombre de Categoria...">
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-sm-12 col-md-12" id="result" name="result">

                    </div>

                </div>
            </div>
        </div>



        <div class="box box-primary color-palette-box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-folder-open-o"></i> Listado de Categorias &nbsp;&nbsp;| &nbsp;&nbsp;</h3> 
                <button type="button" name="btn" id="btn" class="btn btn-success" onclick="listar()"><i class="fa fa-refresh"></i></button>
            </div>
            <div class="box-body">
                <div class="row">
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
<script type="text/javascript" src="js/categorias.js"></script>
<?php
fin();
?>




<!-- Modal -->
<div class="modal fade modal-success" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Crear Nueva Categoria</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="categoria" name="categoria">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Nombre</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nombre" name="nombre" onfocus="borrar()" placeholder="Nombre Aqui...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Descripcion</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="descripcion" name="descripcion" onfocus="borrar()" placeholder="Descripcion Aqui...">
                        </div>
                    </div>
                    <div id="msj1">

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="
                if (document.categoria.nombre.value.length == 0 || document.categoria.descripcion.value.length == 0) {
                    borrar();
                    mensage('Rellene todos los campos del formulario!', 'danger', 'msj1');
                } else {
                    borrar();
                    guardar();
                }
                        ">Guardar Categoria</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edicion-->
<div class="modal fade modal-success" id="myModalE" name="myModalE" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Editar Categoria</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="cat" name="cat">
                    <input type="hidden" class="form-control" id="id" name="id">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Nombre</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Nombre Aqui...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Descripcion</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="des" name="des" placeholder="Descripcion Aqui...">
                        </div>
                    </div>
                    <div id="msj2">

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="
                if (document.cat.nom.value.length == 0 || document.cat.des.value.length == 0) {
                    borrar();
                    mensage('Rellene todos los campos del formulario!', 'danger', 'msj2');
                } else {
                    borrar();
                    modificar();
                }
                        ">Guardar Categoria</button>
            </div>
        </div>
    </div>
</div>

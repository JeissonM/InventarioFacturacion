<?php
session_start();
  if (empty($_SESSION["logged"])){
    echo "<script type=\"text/javascript\">alert(\"No tiene permiso para entrar a este apartado\");</script>";
    header("Location: ../index.html");
    exit;
  }
include("cabecera.php");
  head();
  menuTop();
  menu("clientes");



?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
        Gestion de Clientes
        <small>Ferretería FerroCoyot | Admin</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active"><a href="clientes.php"><i class="fa fa-users"></i> Clientes</a></li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="box box-primary color-palette-box">
        <div class="box-header with-border">
          <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Crear Cliente</button>
        </div>
      </div>
        <div class="box box-primary color-palette-box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-users"></i> Listado de Clientes &nbsp;&nbsp;| &nbsp;&nbsp;</h3> 
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
      <script type="text/javascript" src="js/clientes.js"></script>
    <?php

    fin();
  ?>




  <!-- Modal -->
<div class="modal fade modal-success" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Crear Nuevo Cliente</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="cliente" name="cliente">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nit</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nit" name="nit" onfocus="borrar()" placeholder="Nit Aqui...">
                    </div>
                  </div>
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
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Direccion</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="dir" name="dir" onfocus="borrar()" placeholder="Direccion Aqui...">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Telefono</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="tel" name="tel" onfocus="borrar()" placeholder="Telefono Aqui...">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">E-mail</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="mail" name="mail" onfocus="borrar()" placeholder="Correo Electronico Aqui...">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Ciudad</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="ciu" name="ciu" onfocus="borrar()" placeholder="Ciudad Aqui...">
                    </div>
                  </div>
                  <div id="msj1">
                      
                  </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="
            if (document.cliente.nit.value.length == 0 || document.cliente.nombre.value.length == 0 || document.cliente.descripcion.value.length == 0 || document.cliente.dir.value.length == 0 || document.cliente.tel.value.length == 0 || document.cliente.mail.value.length == 0 || document.cliente.ciu.value.length == 0){
                borrar();
                mensage('Rellene todos los campos del formulario!','danger','msj1');
            }else{
                borrar();
                guardar();
            }
            ">Guardar Cliente</button>
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
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Editar Cliente</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="cliente2" name="cliente2">
          <input type="hidden" class="form-control" id="id" name="id">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nit</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nit2" name="nit2" onfocus="borrar()" placeholder="Nit Aqui...">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nombre</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nombre2" name="nombre2" onfocus="borrar()" placeholder="Nombre Aqui...">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Descripcion</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="descripcion2" name="descripcion2" onfocus="borrar()" placeholder="Descripcion Aqui...">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Direccion</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="dir2" name="dir2" onfocus="borrar()" placeholder="Direccion Aqui...">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Telefono</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="tel2" name="tel2" onfocus="borrar()" placeholder="Telefono Aqui...">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">E-mail</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="mail2" name="mail2" onfocus="borrar()" placeholder="Correo Electronico Aqui...">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Ciudad</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="ciu2" name="ciu2" onfocus="borrar()" placeholder="Ciudad Aqui...">
                    </div>
                  </div>
                  <div id="msj2">
                      
                  </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="
            if (document.cliente2.nit2.value.length == 0 || document.cliente2.nombre2.value.length == 0 || document.cliente2.descripcion2.value.length == 0 || document.cliente2.dir2.value.length == 0 || document.cliente2.tel2.value.length == 0 || document.cliente2.mail2.value.length == 0){
                borrar();
                mensage('Rellene todos los campos del formulario!','danger','msj2');
            }else{
                borrar();
                modificar();
            }
            ">Guardar Cliente</button>
      </div>
    </div>
  </div>
</div>

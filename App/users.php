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
  menu("users");



?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
        Gestion de Los Usuarios del Sistema
        <small>A&S Sas | Admin</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active"><a href="users.php"><i class="fa fa-users"></i> Usuarios</a></li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="box box-primary color-palette-box">
        <div class="box-header with-border">
          <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Crear Usuario</button>
        </div>
      </div>

      <div class="box box-primary color-palette-box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-search"></i> Consulta de Usuarios</h3>
          <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Consultar por Numero de Identificacion</label>

                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="inputName" onkeyup="consultar()" placeholder="Numero de Identificacion...">
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
          <h3 class="box-title"><i class="fa fa-folder-open-o"></i> Listado de Usuarios &nbsp;&nbsp;| &nbsp;&nbsp;</h3> 
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
      <script type="text/javascript" src="js/usuarios.js"></script>
    <?php

fin();
  ?>





  <!-- Modal -->
<div class="modal fade modal-success" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Crear Nuevo Usuario</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="usuario" name="usuario">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">Identificacion *</label>

                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="id" name="id" required="required" onfocus="borrar()" placeholder="Numero de Identificacion">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">Nombres *</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="nom" name="nom" required="required"onfocus="borrar()" placeholder="Nombres Aqui...">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">Apellidos</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="ape" name="ape" onfocus="borrar()" placeholder="Apellidos Aqui...">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">Direccion</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="dir" name="dir" onfocus="borrar()" placeholder="Direccion Aqui...">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">Telefono</label>

                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="tel" name="tel" onfocus="borrar()" placeholder="Numero Telefonico">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">E-mail</label>

                    <div class="col-sm-9">
                      <input type="email" class="form-control" id="mail" name="mail" onfocus="borrar()" placeholder="Correo Electronico">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">Rol *</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="rol" name="rol" required="required" onfocus="borrar()" placeholder="Ej: ADMINISTRADOR, SECRETARIA">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">Contraseña *</label>

                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="pw" name="pw" required="required" onfocus="borrar()">
                    </div>
                  </div>
                  
                  <div id="msj1">
                      
                  </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="
            if (document.usuario.id.value.length == 0 || document.usuario.nom.value.length == 0 || document.usuario.rol.value.length == 0 || document.usuario.pw.value.length == 0){
                borrar();
                mensage('Los campos con * son obligatorios!','danger','msj1');
            }else{
                borrar();
                guardar();
            }
            ">Guardar Usuario</button>
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
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Editar Usuario</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="usuario2" name="usuario2">
          <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">Identificacion *</label>

                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="id" name="id" required="required" onfocus="borrar()" placeholder="Numero de Identificacion">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">Nombres *</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="nom" name="nom" required="required"onfocus="borrar()" placeholder="Nombres Aqui...">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">Apellidos</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="ape" name="ape" onfocus="borrar()" placeholder="Apellidos Aqui...">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">Direccion</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="dir" name="dir" onfocus="borrar()" placeholder="Direccion Aqui...">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">Telefono</label>

                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="tel" name="tel" onfocus="borrar()" placeholder="Numero Telefonico">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">E-mail</label>

                    <div class="col-sm-9">
                      <input type="email" class="form-control" id="mail" name="mail" onfocus="borrar()" placeholder="Correo Electronico">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">Rol *</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="rol" name="rol" required="required" onfocus="borrar()" placeholder="Ej: ADMINISTRADOR, SECRETARIA">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">Contraseña *</label>

                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="pw" name="pw" required="required" onfocus="borrar()">
                    </div>
                  </div>
                  
                  <div id="msj2">
                      
                  </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="
            if (document.usuario2.id.value.length == 0 || document.usuario2.nom.value.length == 0 || document.usuario2.rol.value.length == 0 || document.usuario2.pw.value.length == 0){
                borrar();
                mensage('Los campos con * son obligatorios!','danger','msj2');
            }else{
                borrar();
                modificar();
            }
            ">Guardar Usuario</button>
      </div>
    </div>
  </div>
</div>




<!-- Modal Privilegios-->
<div class="modal fade modal-success" id="ModalPrivilegios" name="ModalPrivilegios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-unlock"></i> Privilegios de Usuario</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="priv" name="priv">
          <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">Identificacion *</label>

                    <div class="col-sm-9">
                      <input type="number" class="form-control" id="id" name="id" required="required" onfocus="borrar()" placeholder="Numero de Identificacion">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label">Nombres *</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="nom" name="nom" required="required"onfocus="borrar()" placeholder="Nombres Aqui...">
                    </div>
                  </div>
                  <div class="col-sm-12 callout callout-warning">
                      <label class="control-label">Seleccione las Paginas o Modulos que el Usuario puede visitar</label>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12 checkbox">
                      <label>
                        <input type="checkbox" name="check">
                        Perfil (Debe concederse el permiso)
                      </label>
                    </div>
                    <div class="col-sm-12 checkbox">
                      <label>
                        <input type="checkbox" name="check">
                        Mensajes (Debe concederse el permiso)
                      </label>
                    </div>
                    <div class="col-sm-12 checkbox">
                      <label>
                        <input type="checkbox" name="check">
                        Datos
                      </label>
                    </div>
                    <div class="col-sm-12 checkbox">
                      <label>
                        <input type="checkbox" name="check">
                        Facturacion
                      </label>
                    </div>
                    <div class="col-sm-12 checkbox">
                      <label>
                        <input type="checkbox" name="check">
                        Facturacion Inversa
                      </label>
                    </div>
                    <div class="col-sm-12 checkbox">
                      <label>
                        <input type="checkbox" name="check">
                        Reportes
                      </label>
                    </div>
                    <div class="col-sm-12 checkbox">
                      <label>
                        <input type="checkbox" name="check">
                        Usuarios del Sistema
                      </label>
                    </div>
                    <div class="col-sm-12 checkbox">
                      <label>
                        <input type="checkbox" name="check">
                        Clientes
                      </label>
                    </div>
                    <div class="col-sm-12 checkbox">
                      <label>
                        <input type="checkbox" name="check">
                        Configuracion de Factura
                      </label>
                    </div>
                    <div class="col-sm-12 checkbox">
                      <label>
                        <input type="checkbox" name="check">
                        Proveedores
                      </label>
                    </div>
                </div>
                  
                  <div id="msj3">
                      
                  </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="
            if (document.priv.id.value.length == 0 || document.priv.nom.value.length == 0){
                borrar();
                mensage('No Puede Dejar campos Vacios!','danger','msj3');
            }else{
                borrar();
                privilegios();
            }
            ">Guardar Permisos</button>
      </div>
    </div>
  </div>
</div>


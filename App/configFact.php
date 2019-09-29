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
  menu("config");



?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
        Configuracion de la Factura de Venta
        <small>Ferretería FerroCoyot | Admin</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active"><a href="configFact.php"><i class="fa fa-gears"></i> Configuracion de Factura</a></li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="box box-primary color-palette-box">
        <div class="box-header with-border">
          <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Crear Configuracion</button>
        </div>
      </div>

      <div class="box box-primary color-palette-box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-search"></i> Consulta de Configuracion</h3>
          <form class="form-horizontal" id="con" name="con">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Consultar por Id</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" name="inputName" onkeyup="consultar()" placeholder="Id de Configuracion...">
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
          <h3 class="box-title"><i class="fa fa-gears"></i> Listado de Configuraciones &nbsp;&nbsp;| &nbsp;&nbsp;</h3> 
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
      <script type="text/javascript" src="js/configuraciones.js"></script>
    <?php

    fin();
  ?>




  <!-- Modal -->
<div class="modal fade modal-success" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-gears"></i> Crear Nueva Configuracion</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="config" name="config">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Resolucion DIAN Nro.</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nrores" name="nrores" onfocus="borrar()" placeholder="Solo Numero de resolucion...">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Fecha de Resolucion</label>

                    <div class="col-sm-10">
                      <input type="date" class="form-control" id="fecha" name="fecha" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Numeracion habilitada</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="numhab" name="numhab" onfocus="borrar()" placeholder="Ejemplo: DEL 51 AL 500">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">NIT</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nit" name="nit" onfocus="borrar()" placeholder="Solo Numero de NIT...">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Direccion</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="dir" name="dir" onfocus="borrar()" placeholder="Ejemplo: CARRERA 18E No. 38-16 BARRIO SAN MARTIN">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Pagina WEB</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="web" name="web" onfocus="borrar()" placeholder="www.acuerdosysolucionessas.com">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Telefonos</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="tel" name="tel" onfocus="borrar()" placeholder="Escriba los numeros de telefono separados por guion (-)">
                    </div>
                  </div>
                  <div id="msj1">
                      
                  </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="
            if (document.config.nrores.value.length == 0 || document.config.numhab.value.length == 0 || document.config.nit.value.length == 0 || document.config.dir.value.length == 0 || document.config.web.value.length == 0 || document.config.tel.value.length == 0){
                borrar();
                mensage('Rellene todos los campos del formulario!','danger','msj1');
            }else{
                borrar();
                guardar();
            }
            ">Guardar Configuracion</button>
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
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-gears"></i> Editar Configuracion</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="config2" name="config2">
          <input type="hidden" class="form-control" id="id" name="id">
                 
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Resolucion DIAN Nro.</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nrores" name="nrores" onfocus="borrar()" placeholder="Solo Numero de resolucion...">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Fecha de Resolucion</label>

                    <div class="col-sm-10">
                      <input type="date" class="form-control" id="fecha" name="fecha">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Numeracion habilitada</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="numhab" name="numhab" onfocus="borrar()" placeholder="Ejemplo: DEL 51 AL 500">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">NIT</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nit" name="nit" onfocus="borrar()" placeholder="Solo Numero de NIT...">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Direccion</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="dir" name="dir" onfocus="borrar()" placeholder="Ejemplo: CARRERA 18E No. 38-16 BARRIO SAN MARTIN">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Pagina WEB</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="web" name="web" onfocus="borrar()" placeholder="www.acuerdosysolucionessas.com">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Telefonos</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="tel" name="tel" onfocus="borrar()" placeholder="Escriba los numeros de telefono separados por guion (-)">
                    </div>
                  </div>
                  <div id="msj2">
                      
                  </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="
            if (document.config2.nrores.value.length == 0 || document.config2.numhab.value.length == 0 || document.config2.nit.value.length == 0 || document.config2.dir.value.length == 0 || document.config2.web.value.length == 0 || document.config2.tel.value.length == 0){
                borrar();
                mensage('Rellene todos los campos del formulario!','danger','msj1');
            }else{
                borrar();
                modificar();
            }
            ">Guardar Configuracion</button>
      </div>
    </div>
  </div>
</div>

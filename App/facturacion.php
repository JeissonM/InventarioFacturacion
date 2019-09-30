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
  menu("facturacion");

?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
        Facturacion de Productos
        <small>Ferretería FerroCoyot | Admin</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active"><a href="facturacion.php"><i class="fa fa-cart-plus"></i> Facturacion</a></li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">



       <div class="box box-primary color-palette-box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-cart-plus"></i> Listado de Facturas de la mas reciente a la mas antigua &nbsp;&nbsp; | &nbsp;&nbsp;</h3> 
          <button type="button" name="btn" id="btn" class="btn btn-success" onclick="listar()"><i class="fa fa-refresh"></i></button>&nbsp;&nbsp;   &nbsp;&nbsp;
          <button type="button" name="btn2" id="btn2" class="btn btn-success" onclick="factura()"><i class="fa fa-cart-plus"></i> Nueva Factura</button>
          </br></br><div class="has-feedback col-sm-6">
              <input type="text" class="form-control input-sm" id="bnf" name="bnf" onkeyup="buscarnf()" placeholder="Buscar por Numero de Factura">
          </div>
          <div class="has-feedback col-sm-6">
              <input type="text" class="form-control input-sm" id="bc" name="bc" onkeyup="buscarc()" placeholder="Buscar por Cliente">
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-sm-12 col-md-12" id="result" name="result">
                
               
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-md-12  table-responsive" id="tabla" name="tabla">
                
               
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
      <script type="text/javascript" src="js/facturas.js"></script>
    <?php
    fin();
  ?>




  <!-- Modal -->
<div class="modal fade modal-success" id="myModalE" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-money"></i> Realizar Abono a esta Factura</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="p" name="p">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nro Factura</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="n" name="n" onfocus="borrar()"  readonly="readonly">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Saldo Factura</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="s" name="s" onfocus="borrar()"  readonly="readonly">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Valor a Pagar</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="v" name="v" onfocus="borrar()" placeholder="Escriba Valor Aqui...">
                    </div>
                  </div>
                  <div id="msj1">
                      
                  </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="
            if (document.p.n.value.length == 0 || document.p.s.value.length == 0 || document.p.v.value.length == 0){
                borrar();
                mensage('Rellene todos los campos del formulario!','danger','msj1');
            }else{
                borrar();
                guardarPago();
            }
            ">Registrar Pago</button>
      </div>
    </div>
  </div>
</div>

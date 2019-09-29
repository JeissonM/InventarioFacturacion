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
  menu("facturacioni");



?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
        Contra-Facturacion: Facturacion de Activos y Pasivos Entrantes
        <small>Ferretería FerroCoyot | Admin</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active"><a href="facturacioni.php"><i class="fa fa-cart-plus"></i> Facturacion Inversa</a></li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">



       <div class="box box-primary color-palette-box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-cart-plus"></i> Listado de Facturas de la mas reciente a la mas antigua &nbsp;&nbsp; | &nbsp;&nbsp;</h3> 
          <button type="button" name="btn" id="btn" class="btn btn-success" onclick="listar()"><i class="fa fa-refresh"></i></button>&nbsp;&nbsp;   &nbsp;&nbsp;
          <button type="button" name="btn2" id="btn2" class="btn btn-success" onclick="factura()"><i class="fa fa-cart-plus"></i> Nueva Factura de Compra</button>
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
      <script type="text/javascript" src="js/facturasi.js"></script>
    <?php
    fin();
  ?>
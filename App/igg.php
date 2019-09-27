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
  menu("reportes");



?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
        Reportes Generales
        <small>A&S Sas | Admin</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Inicio</a></li>
        <li><a href="reportes.php"><i class="fa fa-file-pdf-o"></i> Reportes</a></li>
        <li class="active"><a href="igg.php"><i class="fa fa-file-pdf-o"></i> Iva generado general</a></li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      
       <div class="box box-primary color-palette-box">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-file-pdf-o"></i> Reporte IVA Generado General Para un Periodo Determinado</h3> 
          </div>
          <div class="box-body">
          <div class="row">
            <div class="form-group">
                    <label for="inputName" class="col-sm-1 control-label">Fecha Inicial</label>
                    <div class="col-sm-3">
                      <input type="date" class="form-control" id="fi" name="fi">
                    </div>
                    <label for="inputName" class="col-sm-1 control-label">Fecha Final</label>
                    <div class="col-sm-3">
                      <input type="date" class="form-control" id="ff" name="ff">
                    </div>
                    <div class="col-sm-4">
                        <button type="button" name="btn2" id="btn2" class="btn btn-success btn-md btn-block" onclick="ivaGGConsulta()"><i class="fa fa-search"></i> Consultar</button>
                    </div>
            </div></br></br>
            <div class="bg-info" id="encb" name="encb">
                          
            </div></br></br>     
            <div class="col-sm-12 col-md-12" id="tabla" name="tabla">
                
               
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
      <script type="text/javascript" src="js/reportes.js"></script>
    <?php
fin();
  ?>
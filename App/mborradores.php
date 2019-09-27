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
  menu("mensajes");



?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
        Buzon de Mensajes
        <small>A&S Sas | Admin</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active"><a href="mensajes.php"><i class="fa fa-envelope-o"></i> Mensajes</a></li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
         <div class="row">
        <div class="col-md-3">
          <a href="nuevomsj.php" class="btn btn-success btn-block margin-bottom">Redactar Nuevo Mensaje</a>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Carpetas</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="mensajes.php"><i class="fa fa-inbox"></i> Entrada
                <span class="label label-primary pull-right"><?php echo contarME(); ?></span></a></li>
                <li><a href="menviados.php"><i class="fa fa-envelope-o"></i> Enviados</a></li>
                <li class="active"><a href="mborradores.php"><i class="fa fa-file-text-o"></i> Borradores</a></li>
                </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
         
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Mensajes guardados como borrador</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Buscar Mail">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              
              <div class="table-responsive mailbox-messages"  id="mborradores" name="mborradores">
                
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php

    pie();
  ?>
  <script src="js/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="js/fastclick/fastclick.js"></script>
<!-- iCheck -->
<script src="js/iCheck/icheck.min.js"></script>
      <script type="text/javascript" src="js/mensajes.js"></script>
<?php
  
  fin();

?>
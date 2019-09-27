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

$de=$_GET["de"];
$para=$_GET["para"];
$asunto=$_GET["asunto"];
$mensaje=$_GET["mensaje"];
$fecha=$_GET["fecha"];
$id=$_GET["id"];
  $con=conectar();
  $query="UPDATE as_mensajes SET estado='SI' WHERE id='{$id}';";
  $result =$con -> query($query);
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
                <li class="active"><a href="mensajes.php"><i class="fa fa-inbox"></i> Entrada
                <span class="label label-primary pull-right"><?php echo contarME(); ?></span></a></li>
                <li><a href="menviados.php"><i class="fa fa-envelope-o"></i> Enviados</a></li>
                <li><a href="mborradores.php"><i class="fa fa-file-text-o"></i> Borradores</a></li>
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
              <h3 class="box-title">Leer Mensaje</h3>

              <div class="box-tools pull-right">
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                <h3><?php echo $asunto ?></h3>
                <h5>De: <?php echo $de ?></br>Para: <?php echo $para ?>
                  <span class="mailbox-read-time pull-right"><?php echo $fecha ?></span></h5>
              </div>
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                <?php echo $mensaje ?>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
            
            <!-- /.box-footer -->
            <div class="box-footer">
              <div class="pull-right">
                <button type="button" class="btn btn-success" onclick="ir()"><i class="fa fa-reply"></i> Responder</button>
              </div>
              <button type="button" class="btn btn-danger" id='<?php echo $id ?>' onclick='eliminar(this.id)' ><i class="fa fa-trash-o"></i> Eliminar</button>
            </div>
            <!-- /.box-footer -->
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
<script>
  $(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function (e) {
      e.preventDefault();
      //detect type
      var $this = $(this).find("a > i");
      var glyph = $this.hasClass("glyphicon");
      var fa = $this.hasClass("fa");

      //Switch states
      if (glyph) {
        $this.toggleClass("glyphicon-star");
        $this.toggleClass("glyphicon-star-empty");
      }

      if (fa) {
        $this.toggleClass("fa-star");
        $this.toggleClass("fa-star-o");
      }
    });
  });
</script>
<?php
  
  fin();

?>
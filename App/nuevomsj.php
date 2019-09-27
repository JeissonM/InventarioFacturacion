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
          <a href="mensajes.php" class="btn btn-success btn-block margin-bottom">Volver a Entrada</a>

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
              <h3 class="box-title">Redactar Nuevo Mensaje</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                  <label class="col-xs-1 control-label">Para</label>
                  <div class="col-xs-11 selectContainer">
                      <select class="form-control" name="size" id="size">
                        <?php
                        $con=conectar();
                        $query="SELECT *FROM as_usuarios";
                        $result =$con -> query($query);
                        if ($con->affected_rows>0){
                            while ($row=$result -> fetch_assoc()){
                              echo "<option value='".$row['identificacion']."'>".$row['nombres']." ".$row['apellidos']."</option>";
                            }
                        }
                        ?>
                      </select>
                  </div>
              </div>
            </br></br>
              <div class="form-group">
                <input class="form-control" placeholder="Asunto:" id="asunto" name="asunto">
              </div>
              <div class="form-group">
                    <textarea id="compose-textarea" name="compose-textarea" class="form-control" style="height: 300px">
                      
                    </textarea>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                <button type="button" class="btn btn-success" onclick="borrador('<?php echo $_SESSION['id']?>')"><i class="fa fa-pencil"></i> Guardar en Borradores</button>
                <button type="submit" class="btn btn-success" onclick="enviar('<?php echo $_SESSION['id']?>')"><i class="fa fa-envelope-o"></i> Enviar</button>
              </div>
              <button type="reset" class="btn btn-danger" onclick="mover()"><i class="fa fa-times"></i> Cancelar</button>
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
<script src="js/mensajes.js"></script>
<script src="js/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    //Add text editor
    $("#compose-textarea").wysihtml5();
  });

  function mover(){
    location.href="mensajes.php";
  }
</script>

<?php
  
  fin();

?>
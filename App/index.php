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
  menu("perfil");
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
        Perfil
        <small>A&S Sas | Admin</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active"><a href="index.php"><i class="fa fa-home"></i> Inicio</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <?php echo "<img class='profile-user-img img-responsive img-circle' src='".$_SESSION["path"]."' alt='Foto de Perfil de Usuario'>"; ?>
              <center><a href="#" class="label label-success" data-toggle="modal" data-target="#myModal">Editar</a></center>
              <h3 class="profile-username text-center"><?php echo $_SESSION["nombres"]." ".$_SESSION["apellidos"]?></h3>

              <p class="text-muted text-center"><?php echo $_SESSION["rol"]?></p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Informacion</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Educacion</strong>

              <p class="text-muted">
                <?php echo $_SESSION["estudios"]?>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Domicilio</strong>

              <p class="text-muted"><?php echo $_SESSION["direccion"]?></p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i>Notas</strong>

              <p><?php echo $_SESSION["notas"]?></p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#biograpy" data-toggle="tab">Perfil Profesional</a></li>
              <li><a href="#settings" data-toggle="tab">Actualizar Informacion</a></li>
              <li><a href="#cambiarpass" data-toggle="tab">Cambiar Contraseña</a></li>
            </ul>

            <div class="tab-content">
              <div class="active tab-pane" id="biograpy">
              <div class="post">
                  <div class="user-block">
                    <?php echo"<img class='img-circle img-bordered-sm' src='".$_SESSION["path"]."' alt='user image'>";?>
                        <span class="username">
                          <a href="index.php"><?php echo $_SESSION["nombres"]." ".$_SESSION["apellidos"]?></a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description"><?php echo $_SESSION["rol"]?></span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                    <?php echo $_SESSION["perfilp"]?>
                  </p>
                  
                </div>
                <!-- /.post -->
            </div>
              <div class="tab-pane" id="settings">
                <form class="form-horizontal" id="act" name="act">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Identificacion</label>

                    <div class="col-sm-10">
                      <input type="number" readonly="readonly" class="form-control" id="id" value="<?php echo $_SESSION["id"]?>" placeholder="Identificacion">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Nombres</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nom" value="<?php echo $_SESSION["nombres"]?>" placeholder="Nombres">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Apellidos</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="ape" value="<?php echo $_SESSION["apellidos"]?>" placeholder="Apellidos">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Domicilio</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="dir" value="<?php echo $_SESSION["direccion"]?>" placeholder="Domicilio">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Telefono</label>

                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="tel" value="<?php echo $_SESSION["telefono"]?>" placeholder="Telefono">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">E-mail</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="email" value="<?php echo $_SESSION["email"]?>" placeholder="E-mail">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Cargo</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="rol" value="<?php echo $_SESSION["rol"]?>" placeholder="Cargo">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Estudios</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="estudios" value="<?php echo $_SESSION["estudios"]?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Notas</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="notas" value="<?php echo $_SESSION["notas"]?>" placeholder="Cargo">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Perfil Profesional</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="pp" value="<?php echo $_SESSION["perfilp"]?>">
                    </div>
                  </div>
                </form>



               <div class="box box-default color-palette-box">
                      <div class="box-header with-border">
                        <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-success" onclick="modificar();">Actualizar Datos</button>
                        </div>
                      </div>
                    </br></br>
                      <div id="msj2">
                      
                  </div>
                  </div>
                    </div>
              </div>



                
              <!-- /.tab-pane -->
              <div class="tab-pane" id="cambiarpass">
                <form class="form-horizontal" id="cp" name="cp">
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Identificacion</label>

                    <div class="col-sm-10">
                      <input type="number" class="form-control" readonly="readonly" id="id" value="<?php echo $_SESSION["id"]?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Contraseña Antigua</label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="pw1" placeholder="Contraseña Antigua">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nueva Contraseña</label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="pwn" placeholder="Nueva Contraseña">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Repita Nueva Contraseña</label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="pwn2" placeholder="Repita Nueva Contraseña">
                    </div>
                  </div>
                  
                  
                </form>
                <div class="box box-default color-palette-box">
                      <div class="box-header with-border">
                        <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-success" onclick="cambiarPass();">Cambiar</button>
                        </div>
                      </div>
                    </br></br>
                      <div id="msj1">
                      
                  </div>
                  </div>
                    </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
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
  <script type="text/javascript" src="js/index.js"></script>
<?php
  fin();
?>

 <!-- Modal -->
<div class="modal fade modal-success" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Cambiar su foto de perfil</h4>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data" method="POST">
            <div class="form-group">
            <input id="archivo" name="archivo" type="file" class="form-control input-md" data-preview-file-type="any">
            </div>
            <div class="form-group">
            <button class="btn btn-warning" name="subir" id="subir">Subir</button>
            <button class="btn btn-danger" type="reset">Resetear</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
if (isset($_POST['subir'])){
  if ($_FILES['archivo']["error"] > 0){
    echo "Error: " . $_FILES['archivo']['error'] . "<br>";
  }else{
      $nombre=$_FILES['archivo']['name'];
      move_uploaded_file($_FILES['archivo']['tmp_name'],"img/" . $_FILES['archivo']['name']);
      $enlace=conectar();
      $cadena="UPDATE as_usuarios SET path='img/".$nombre."' WHERE identificacion='".$_SESSION["id"]."';";
      $result2 =$enlace -> query($cadena); //Aquí está la clave, se ejecuta con MySQL la cadena del insert formada
      if ($enlace->affected_rows>0){
        echo "<script type=\"text/javascript\">alert(\"Actualizacion Exitosa, tendra efecto en su proximo inicio de sesion\"); history.back(1);</script>";
      }
      $enlace -> close();
  }
}
?>
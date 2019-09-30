<?php

function head() {
    echo '<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ferretería FerroCoyot</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <!-- Ionicons -->
   <link rel="stylesheet" href="css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/bootstrap3-wysihtml5.min.css">

  
  <link rel="stylesheet" href="css/DataTables-1.10.18/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="css/fullcalendar.min.css">
  <link rel="stylesheet" href="css/fullcalendar.print.css" media="print">
  <link rel="stylesheet" href="css/AdminLTE.min.css">
    <link rel="stylesheet" href="css/skins/_all-skins.min.css">
     <link rel="stylesheet" href="js/iCheck/flat/blue.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.


  -->
 


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <script src="js/operaciones.js"></script>
  <![endif]-->
  <!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.4 -->
<script src="js/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="js/bootstrap.min.js"></script>
<script src="css/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
<!-- AdminLTE App -->
<script src="js/slimScroll/jquery.slimscroll.min.js"></script>
<!-- Slimscroll -->
<script src="js/bootstrap3-wysihtml5.all.min.js"></script>
<!-- SlimScroll -->
<script src="js/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="js/fastclick/fastclick.js"></script>
<script src="js/app.min.js"></script>
<script type="text/javascript">
var urlg = "http://localhost/Inventario/App";
function datatablep() {
    $("#tablef").DataTable();
}
</script>

</head>
<!--
BODY TAG OPTIONS:

-->
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
';
}

function menuTop() {
    ?>
    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="index.php" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>F</b>FC</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Ferretería FC</b></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only"></span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-danger"><?php echo contarME(); ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">Tu Tienes <?php echo contarME(); ?> Mensajes</li>
                            <li>
                                <!-- inner menu: contains the messages -->
                                <ul class="menu">

                                    <?php
                                    $con = conectar();
                                    $query = "SELECT m.id, m.de, (SELECT u.nombres FROM as_usuarios u WHERE u.identificacion=m.de) as den, m.para, (SELECT u.nombres FROM as_usuarios u WHERE u.identificacion=m.para) as paran, m.asunto, m.mensaje, m.fecha, m.estado, m.borrador FROM as_mensajes m ORDER BY fecha desc;";
                                    $result = $con->query($query);
                                    if ($con->affected_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            if ($row["borrador"] === "NO") {
                                                if ($row["para"] == $_SESSION["id"]) {
                                                    if ($row["estado"] === "NO") {
                                                        echo "<li><a href='mensajes.php'>
                                              <h4>
                                                " . $row["asunto"] . "
                                                <small><i class='fa fa-clock-o'></i> " . $row["fecha"] . "</small>
                                              </h4>
                                          </a></li>";
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                </ul>
                                <!-- /.menu -->
                            </li>
                            <li class="footer"><a href="mensajes.php">Ver Todos los Mensajes</a></li>
                        </ul>
                    </li>
                    <!-- /.messages-menu -->
                    <!-- Notifications Menu -->
                    <li class="dropdown notifications-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-danger"><?php echo contarN(); ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header"><?php echo contarN(); ?> Facturas Pendientes de Pago</li>
                            <li>
                                <!-- Inner Menu: contains the notifications -->
                                <ul class="menu">
                                    <?php
                                    $con = conectar();
                                    $query = "SELECT * FROM as_factura WHERE estado='PENDIENTE' ORDER BY fecha ASC;";
                                    $result = $con->query($query);
                                    if ($con->affected_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<li><a href='facturacion.php'>
                              <i class='fa fa-users text-aqua'></i>" . $row["nofactura"] . " ->" . $row["cliente"] . "
                              </a></li>";
                                        }
                                    }
                                    ?>
                                </ul>
                            </li>
                            <li class="footer"><a href="facturacion.php">Ver Todas las Facturas</a></li>
                        </ul>
                    </li>
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <?php echo "<img src='" . $_SESSION['path'] . "' class='user-image' alt='User Image'>"; ?>
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs"><?php echo $_SESSION['nombres'] . " " . $_SESSION['apellidos'] ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <?php echo "<img src='" . $_SESSION['path'] . "' class='img-circle' alt='User Image'>"; ?>

                                <p>
                                    <?php echo $_SESSION['nombres'] . " " . $_SESSION['apellidos'] ?>
                                    <small><?php echo $_SESSION['rol'] ?> del Sitio</small>
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="index.php" class="btn btn-success btn-flat">Perfil</a>
                                </div>
                                <div class="pull-right">
                                    <a href="logout.php" class="btn btn-success btn-flat">Salir</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <?php
}

function menu($location) {
    echo "<!-- Left side column. contains the logo and sidebar -->
  <aside class='main-sidebar'>

    <!-- sidebar: style can be found in sidebar.less -->
    <section class='sidebar'>

      <!-- Sidebar user panel (optional) -->
      <div class='user-panel'>
        <div class='pull-left image'>
          <img src='" . $_SESSION['path'] . "' class='img-circle' alt='User Image'>
        </div>
        <div class='pull-left info'>
          <p>" . $_SESSION['nombres'] . "</p>
          <!-- Status -->
          <a href='index.php'><i class='fa fa-circle text-success'></i> Conectado</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action='#'' method='get' class='sidebar-form'>
        <div class='input-group'>
          <input type='text' name='q' class='form-control' placeholder='Buscar...'>
              <span class='input-group-btn'>
                <button type='submit' name='search' id='search-btn' class='btn btn-flat'><i class='fa fa-search'></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class='sidebar-menu'>
        <!-- Optionally, you can add icons to the links -->";
    if ($_SESSION["p"] == "SI") {
        if ($location === "perfil") {
            echo '<li class="active"><a href="index.php"><i class="fa fa-user"></i> <span>Perfil</span></a></li>';
        } else {
            echo '<li><a href="index.php"><i class="fa fa-user"></i> <span>Perfil</span></a></li>';
        }
    }
    if ($_SESSION["m"] == "SI") {
        if ($location === "mensajes") {
            echo '<li class="active"><a href="mensajes.php"><i class="fa fa-envelope-o"></i><span>Mensajes</span></a></li>';
        } else {
            echo '<li><a href="mensajes.php"><i class="fa fa-envelope-o"></i><span>Mensajes</span></a></li>';
        }
    }
    if ($_SESSION["d"] == "SI") {
        if ($location === "gestion") {
            echo '<li class="treeview active">
                          <a href="#"><i class="fa fa-database"></i> <span>Gestionar Datos</span> <i class="fa fa-angle-left pull-right"></i></a>
                          <ul class="treeview-menu">
                            <li><a href="categorias.php"><i class="fa fa-folder-open-o"></i>Categoria de Productos</a></li>
                            <li><a href="servicios.php"><i class="fa fa-wrench"></i>Productos</a></li>
                          </ul>
                        </li>';
        } else {
            echo '<li class="treeview">
                          <a href="#"><i class="fa fa-database"></i> <span>Gestionar Datos</span> <i class="fa fa-angle-left pull-right"></i></a>
                          <ul class="treeview-menu">
                            <li><a href="categorias.php"><i class="fa fa-folder-open-o"></i>Categoria de Productos</a></li>
                            <li><a href="servicios.php"><i class="fa fa-wrench"></i>Productos</a></li>
                          </ul>
                        </li>';
        }
    }
    if ($_SESSION["config"] == "SI") {
        if ($location === "config") {
            echo '<li class="active"><a href="configFact.php"><i class="fa fa-gears"></i> <span>Configuracion de Factura</span></a></li>';
        } else {
            echo '<li><a href="configFact.php"><i class="fa fa-gears"></i> <span>Configuracion de Factura</span></a></li>';
        }
    }
    if ($_SESSION["f"] == "SI") {
        if ($location === "facturacion") {
            echo '<li class="active"><a href="facturacion.php"><i class="fa fa-cart-plus"></i> <span>Facturacion</span></a></li>';
        } else {
            echo '<li><a href="facturacion.php"><i class="fa fa-cart-plus"></i> <span>Facturacion</span></a></li>';
        }
    }
    if ($_SESSION["fi"] == "SI") {
        if ($location === "facturacioni") {
            echo '<li class="active"><a href="facturacioni.php"><i class="fa fa-cart-arrow-down"></i> <span>Facturacion Inversa</span></a></li>';
        } else {
            echo '<li><a href="facturacioni.php"><i class="fa fa-cart-arrow-down"></i> <span>Facturacion Inversa</span></a></li>';
        }
    }
    if ($_SESSION["clientes"] == "SI") {
        if ($location === "clientes") {
            echo '<li class="active"><a href="clientes.php"><i class="fa fa-users"></i> <span>Clientes</span></a></li>';
        } else {
            echo '<li><a href="clientes.php"><i class="fa fa-users"></i> <span>Clientes</span></a></li>';
        }
    }
    if ($_SESSION["proveedores"] == "SI") {
        if ($location === "proveedores") {
            echo '<li class="active"><a href="proveedores.php"><i class="fa fa-users"></i> <span>Proveedores</span></a></li>';
        } else {
            echo '<li><a href="proveedores.php"><i class="fa fa-users"></i> <span>Proveedores</span></a></li>';
        }
    }
    if ($_SESSION["u"] == "SI") {
        if ($location === "users") {
            echo '<li class="active"><a href="users.php"><i class="fa fa-users"></i> <span>Usuarios del Sistema</span></a></li>';
        } else {
            echo '<li><a href="users.php"><i class="fa fa-users"></i> <span>Usuarios del Sistema</span></a></li>';
        }
    }
    if ($_SESSION["r"] == "SI") {
        if ($location === "reportes") {
            echo '<li class="active"><a href="reportes.php"><i class="fa fa-file-pdf-o"></i> <span>Reportes</span></a></li>';
        } else {
            echo '<li><a href="reportes.php"><i class="fa fa-file-pdf-o"></i> <span>Reportes</span></a></li>';
        }
    }
    echo '
        <li><a href="logout.php"><i class="fa fa-power-off"></i> <span>Salir</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>';
}

function pie() {
    ?>
    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            Creado por <a href="https://www.facebook.com/jorgejeisson">Jeisson Mandon</a>
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2019 <a href="index.php">Ferretería FerroCoyot</a></strong> Todos los Derechos Reservados.
    </footer>


    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <?php
}

function fin() {
    echo '</body></html>';
}
?>



<?php
include("config.php");

function contarME() {
    $con = conectar();
    $query = "SELECT m.id, m.de, (SELECT u.nombres FROM as_usuarios u WHERE u.identificacion=m.de) as den, m.para, (SELECT u.nombres FROM as_usuarios u WHERE u.identificacion=m.para) as paran, m.asunto, m.mensaje, m.fecha, m.estado, m.borrador FROM as_mensajes m ORDER BY fecha desc;";
    $result = $con->query($query);
    $cont = 0;
    if ($con->affected_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row["borrador"] === "NO") {
                if ($row["para"] == $_SESSION["id"]) {
                    if ($row["estado"] === "NO") {
                        $cont = $cont + 1;
                    }
                }
            }
        }
    }
    echo $cont;
}

function contarN() {
    $con = conectar();
    $query = "SELECT COUNT(estado) as cant FROM as_factura WHERE estado='PENDIENTE';";
    $result = $con->query($query);
    $cont = 0;
    if ($con->affected_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cont = $row["cant"];
        }
    }
    echo $cont;
}
?>
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
        Facturacion de Servicios
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
        <h3 class="box-title"><i class="fa fa-cart-plus"></i> Factura de Venta</h3></br></br>
            <form class="form-horizontal" action="facturar.php" method="POST" id="con" name="con">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Seleccione el Encabezado de la Factura</label>
                        <div class="col-sm-9 selectContainer">
                            <select class="form-control" name="enc" id="enc" onchange="cargarInfo()">
                              <option value="0">Seleccione...</option>
                              <?php
                              $con=conectar();
                              $query="SELECT *FROM as_configuraciones";
                              $result =$con -> query($query);
                              if ($con->affected_rows>0){
                                  while ($row=$result -> fetch_assoc()){
                                    echo "<option value='".$row['resolucion'].";".$row['numeracion'].";".$row['nit'].";".$row['direccion'].";".$row['pagina'].";".$row['telefonos'].";".$row['id']."'>Resoluccion: ".$row['resolucion']." / Numeracion: ".$row['numeracion']." / Nit: ".$row['nit']."</option>";
                                  } 
                              }
                              ?>
                            </select>
                        </div>
                      </div>
                      <div class="bg-info" id="encb">
                          
                      </div>
                    </br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Seleccione el Cliente o NIT</label>
                        <div class="col-sm-10 selectContainer">
                            <select class="form-control" name="snc" id="snc" onchange="cargarInfo2()">
                              <option value="0">Seleccione...</option>
                              <?php
                              $con=conectar();
                              $query="SELECT *FROM as_clientes";
                              $result =$con -> query($query);
                              if ($con->affected_rows>0){
                                  while ($row=$result -> fetch_assoc()){
                                    echo "<option value='".$row['nit'].";".$row['nombre'].";".$row['direccion'].";".$row['ciudad'].";".$row['telefono']."'>Nombre: ".$row['nombre']." / NIT: ".$row['nit']."</option>";
                                  } 
                              }
                              ?>
                            </select>
                        </div>
                      </div>
                    <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Numero de la Factura</label>
                      <div class="col-sm-10">
                        <input type="number" class="form-control" id="nofactura" name="nofactura">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Fecha Facturacion</label>
                      <div class="col-sm-10">
                        <input type="date" class="form-control" id="fecha" name="fecha">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">Señor (es) =>(Cliente)</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="cliente" name="cliente">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputName" class="col-sm-2 control-label">NIT</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nitc" name="nitc">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputName" class="col-sm-1 control-label">Direccion</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="direccion" name="direccion">
                      </div>
                      <label for="inputName" class="col-sm-1 control-label">Ciudad</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="ciudad" name="ciudad">
                      </div>
                      <label for="inputName" class="col-sm-1 control-label">Telefono</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="telefono" name="telefono">
                      </div>
                    </div>
                    <p class="bg-info">
                      <button type="button" class="btn btn-success " data-toggle="modal" data-target="#myModal"><i class="fa fa-wrench"></i> Agregar Servicio</button>
                    </p>
                    <div class="row">
                      <div class="col-sm-12 col-md-12" id="tablaser" name="tablaser">
                          <table id='tablen' class='table table-bordered table-hover' cellspacing='0' width='100%'>
                              <thead>
                                <th>Nombre y Descripcion</th>
                                <th>Cantidad</th>
                                <th>Valor Unitario</th>
                                <th>% Impuesto</th>
                                <th>Valor Impuesto</th>
                                <th>Valor Total</th>
                              </thead>
                            <tbody id="tbDetalle">
                            </tbody>
                          </table>
                         
                      </div>
                     
                    </div>
                    <div class="form-group">
                      <label for="inputName" class="col-sm-1 control-label">Sub Total</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" id="st" name="st" readonly="readonly">
                      </div>
                      
                      <label for="inputName" class="col-sm-1 control-label">Total Impuesto</label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" id="impv" name="impv" readonly="readonly">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputName" class="col-sm-1 control-label">Total Factura</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="tota" name="tota" readonly="readonly">
                      </div>
                      <label for="inputName" class="col-sm-1 control-label">Pago/Abono a Factura</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="pago" name="pago" onkeyup="calculoTotal();">
                      </div>
                      <label for="inputName" class="col-sm-1 control-label">Saldo Pendiente Factura</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="saldo" name="saldo" readonly="readonly">
                      </div>
                    </div>

                    <!-- /.row -->
                </br>
                    <div class="form-group">
                      <div class="col-sm-6">
                        <button type="button" name="btn2" id="btn2" class="btn btn-success btn-md btn-block" onclick="cancelar()"><i class="fa fa-close"></i> Cancelar</button>
                      </div>
                      <div class="col-sm-6">
                        <button type="submit" name="btnf" id="btnf" class="btn btn-success btn-md btn-block"><i class="fa fa-cart-plus"></i> Facturar</button>
                      </div>
                    </div>

            </form>
          </div>
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



if(isset($_POST["btnf"])){
    $factura=new factura();
    $factura->nofactura=$_POST["nofactura"];
    $a=$_POST["nofactura"];
    $factura->fecha=$_POST["fecha"];
    $factura->cliente=strtoupper($_POST["cliente"]);
    $factura->nit=$_POST["nitc"];
    $factura->direccion=strtoupper($_POST["direccion"]);
    $factura->ciudad=strtoupper($_POST["ciudad"]);
    $factura->telefono=$_POST["telefono"];
    
    
    if (isset($_POST["det_nombres"])){
      $n=$_POST["det_nombres"];
      $c=$_POST["det_cant"];
      $vu=$_POST["det_valou"];
      $vi=$_POST["det_imp"];
      $vti=$_POST["det_valimp"];
      $vt=$_POST["det_valt"];
      foreach($n as $p=>$o){
        $factura->agregarDetalle(
          $factura->nofactura,
          $n[$p],
          $c[$p],
          $vu[$p],
          $vi[$p],
          $vti[$p],
          $vt[$p]);
      }
    }
    $factura->subtotal=$_POST["st"];
    $factura->impuesto=$_POST["impv"];
    $factura->total=$_POST["tota"];
    if($_POST["saldo"]==="NaN"){
      $factura->saldo=$_POST["tota"];
    }else{
      $factura->saldo=$_POST["saldo"];
    }
    if($_POST["tota"]===$_POST["pago"]){
      $factura->estado="PAGADO";
    }
    $b="";
    if (isset($_POST["idenc"])){
      $factura->idenc=$_POST["idenc"];
      $b=$_POST["idenc"];
    }
    if (empty($a) || empty($b)){
      echo "<script type=\"text/javascript\">alert(\"La factura no tiene informacion valida\");</script>";
    }else{
      $msg=$factura->guardar();
      $param=explode(";", $msg)[1];
      $msg=explode(";", $msg)[0];
      echo "<script type=\"text/javascript\">alert(\"$msg\");</script>";
      echo "<script type=\"text/javascript\">verFacn(\"$param\");</script>";
    }
}

    class factura{
    private $id="";
    private $nofactura="";
    private $fecha="";
    private $cliente="";
    private $nit="";
    private $direccion="";
    private $ciudad="";
    private $telefono="";
    private $subtotal="";
    private $impuesto="";
    private $total="";
    private $detalleFactura;
    private $idenc="";
    private $saldo="";
    private $estado="PENDIENTE";

    public function agregarDetalle($idfactura,$nombre_des,$cant,$valoru,$valimp,$valtimp,$valtotal){
      $this->detalleFactura[]=array(
          "idfactura"=>$idfactura,
          "nombre_des"=>$nombre_des,
          "cant"=>$cant,
          "valoru"=>$valoru,
          "valimp"=>$valimp,
          "valtimp"=>$valtimp,
          "valtotal"=>$valtotal
        );

    }
    function __construct(){
      $this->detalleFactura=array();
    }
    function __get($propiedad){
      if (isset($this->$propiedad)){
        return $this->$propiedad;
      }else{
        echo "La Propiedad ".$propiedad." no existe en el objeto factura";
      }
      return "";
    }
    function __set($propiedad, $valor){
      if (isset($this->$propiedad)){
        $this->$propiedad=$valor;
      }else{
        echo "La Propiedad ".$propiedad." no existe en el objeto factura";
      }
    }
    function guardar(){
      $con=conectar();  
      if ($this->id>0){
        //actualizar
      }else{
        //insertar
        $sqlquery="INSERT INTO as_factura(nofactura, fecha, cliente, nit, direccion, ciudad, telefono, subtotal, impuesto, total, encab, estado, saldo) 
        VALUES ('{$this->nofactura}','{$this->fecha}','{$this->cliente}','{$this->nit}','{$this->direccion}','{$this->ciudad}',
          '{$this->telefono}','{$this->subtotal}','{$this->impuesto}','{$this->total}','{$this->idenc}','{$this->estado}','{$this->saldo}')";
        $result =$con -> query($sqlquery);
        $x=$con->affected_rows;
        //$this->id=mysql_insert_id($con);
        $j=0;
        $cont=0;
        $cont2=0;
        foreach ($this->detalleFactura as $detalle){
          $sql="INSERT INTO as_detalle_factura(idfactura, nombre_des, cant, valoru, valtotal, valorimp, porimp) 
          VALUES ('{$detalle['idfactura']}','{$detalle['nombre_des']}','{$detalle['cant']}',
            '{$detalle['valoru']}','{$detalle['valtotal']}','{$detalle['valtimp']}','{$detalle['valimp']}')";
          $result =$con -> query($sql);
          $j=$con->affected_rows;
          $cont+=1;
          if($j>0){
            $cont2+=1;
          }
        }
        if($x>0 and $j>0){
          return "Factura almacenada con exito. Se guardaron {$cont2} articulos de {$cont} facturados, se generara la factura para impresion;{$this->nofactura}";
        }else{
          return "Error al facturar!";
        }
      }
      
    }
  }
  ?>



  <!-- Modal -->
<div class="modal fade modal-success" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Agregar Item</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="servicio" name="servicio">
                  
                  <div class="form-group">
                    <label class="col-xs-2 control-label">Categoria</label>
                    <div class="col-xs-10 selectContainer">
                        <select class="form-control" name="size" id="size">
                          <option value="0">Seleccione...</option>
                          <?php
                          $con=conectar();
                          $query="SELECT *FROM as_categoria";
                          $result =$con -> query($query);
                          if ($con->affected_rows>0){
                              while ($row=$result -> fetch_assoc()){
                                echo "<option value='".$row['id']."'>".$row['nombre']."</option>";
                              }
                          }
                          ?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-xs-2 control-label">Servicio</label>
                    <div id="se" class="col-xs-10 selectContainer">
                        
                    </div>
                  </div>
                  <input type="hidden" class="form-control" id="id" name="id" onfocus="borrar()" placeholder="Nombre Aqui...">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nombre</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="nombre" name="nombre" onfocus="borrar()" placeholder="Nombre Aqui...">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Descripcion</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="descripcion" name="descripcion" onfocus="borrar()" placeholder="Nombre Aqui...">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Precio</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="precio" name="precio" onfocus="borrar()" placeholder="Nombre Aqui...">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Impuesto</label>

                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="impuesto" name="impuesto" onfocus="borrar()" placeholder="Escriba asi: para 16% --> 16, para 5.5% --> 5.5">
                    </div>
                  </div>


                  <div id="msj1">
                      
                  </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="add()">Agregar este Servicio</button>
      </div>
    </div>
  </div>
</div>


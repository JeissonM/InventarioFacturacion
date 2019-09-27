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
        Facturacion de Activos y Pasivos Entrantes
        <small>A&S Sas | Admin</small>
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
        <h3 class="box-title"><i class="fa fa-cart-plus"></i> Factura de Compra</h3></br></br>
            <form class="form-horizontal" action="defacturar.php" method="POST" id="con" name="con">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Seleccione el Proveedor o su NIT</label>
                        <div class="col-sm-10 selectContainer">
                            <select class="form-control" name="snc" id="snc" onchange="cargarInfo2()">
                              <option value="0">Seleccione...</option>
                              <?php
                              $con=conectar();
                              $query="SELECT *FROM as_proveedores";
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
                      <label for="inputName" class="col-sm-2 control-label">Se le compro A</label>
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
                      <button type="button" class="btn btn-success " onclick="Add()"><i class="fa fa-wrench"></i> Agregar Item</button>
                    </p>
                    <div class="row">
                      <div class="col-sm-12 col-md-12" id="tablaser" name="tablaser">
                          <table id='tablen' class='table table-bordered table-hover' cellspacing='0' width='100%'>
                              <thead>
                                <th>Activo/Pasivo</th>
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
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="st" name="st" readonly="readonly">
                      </div>
                      <label for="inputName" class="col-sm-1 control-label">Valor Impuesto</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="impv" name="impv" readonly="readonly">
                      </div>
                      <label for="inputName" class="col-sm-1 control-label">Total</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="tota" name="tota" readonly="readonly">
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
      <script type="text/javascript" src="js/facturasi.js"></script>
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
        $o,
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
  if (empty($a)){
    echo "<script type=\"text/javascript\">alert(\"La factura no tiene informacion valida\");</script>";
  }else{
    $msg=$factura->guardar();
    echo "<script type=\"text/javascript\">alert(\"$msg\");</script>";
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

    public function agregarDetalle($idfactura,$nombre_des,$cant,$valoru,$valimp,$totalimp,$valtotal){
      $this->detalleFactura[]=array(
          "idfactura"=>$idfactura,
          "nombre_des"=>$nombre_des,
          "cant"=>$cant,
          "valoru"=>$valoru,
          "impuesto"=>$valimp,
          "totalimp"=>$totalimp,
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
        $sqlquery="INSERT INTO as_defactura(nofactura, fecha, cliente, nit, direccion, ciudad, telefono, subtotal, impuesto, total) 
        VALUES ('{$this->nofactura}','{$this->fecha}','{$this->cliente}','{$this->nit}','{$this->direccion}','{$this->ciudad}',
          '{$this->telefono}','{$this->subtotal}','{$this->impuesto}','{$this->total}')";
        $result =$con -> query($sqlquery);
        $x=$con->affected_rows;
        //$this->id=mysql_insert_id($con);
        $j=0;
        $cont=0;
        $cont2=0;
        foreach ($this->detalleFactura as $detalle){
          $sql="INSERT INTO as_detalle_factura_de(idfactura, nombre_des, cant, valoru, valtotal, valorimp, porimp) 
          VALUES ('{$detalle['idfactura']}','{$detalle['nombre_des']}','{$detalle['cant']}',
            '{$detalle['valoru']}','{$detalle['valtotal']}','{$detalle['totalimp']}','{$detalle['impuesto']}')";
          $result =$con -> query($sql);
          $j=$con->affected_rows;
          $cont+=1;
          if($j>0){
            $cont2+=1;
          }
        }
        if($x>0 and $j>0){
          return "Factura almacenada con exito. Se guardaron {$cont2} articulos de {$cont} facturados, se generara la factura para impresion";
        }else{
          return "Error al facturar!";
        }
      }
      
    }
  }
  ?>
